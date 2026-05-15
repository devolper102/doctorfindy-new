<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LabBranch;
use App\Location;
use App\LabDiscount;
use App\User;
use App\Speciality_Test;
use App\LabCode;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LabCodeImport;
use App\Imports\LabTestImport;
use App\Exports\ExportLabTests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Models\Blacklist;
class LabBranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = LabBranch::with('location','user')->get();
        return view('back-end.admin.labs.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $locations = Location::pluck('title','id');
         $labs = User::role('laboratory')->get()->pluck('full_name','id');
        return view('back-end.admin.labs.create',compact('locations','labs'));
    }
   
    public function uploadDiscount()
    {
        // dd("asjdlfjasdlf");
        return view('back-end.admin.labs.uploaddiscount');
    }
    public function labListing()
    {
        $labDiscounts = LabDiscount::latest()->get();
         return view('back-end.admin.labs.lab_code_listing',compact('labDiscounts'));
    }
    public function deleteLabDiscount(Request $request)
     {

        
        $json = array();
        $id = $request['id'];

        if (!empty($id)) {
            $code = LabDiscount::where('id', $id)->pluck('code')->first();
            $updateCodeStatus = LabCode::where('CouponNumber', $code)->first();
            $updateCodeStatus->Status = 0;
            $updateCodeStatus->save();

        // dd($updateCodeStatus);
          LabDiscount::where('id', $id)->delete();
      
            $json['type'] = 'success';
            $json['message'] = 'Lab Discount Deleted Successfully';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
        'name' => 'required',
        'city_id' => 'required',
        'user_id' => 'required'
        ],
        [
            'name.required' => 'Enter branch Name!',
            'city_id.required' => 'Select City!',
            'user_id.required' => 'Select Lab!'
        ]);
        $json = array();
        if (!empty($request)) {

            $branch = LabBranch::create([
                    'name' => $request['name'],
                    'location_id' => $request['city_id'],
                    'user_id' => $request['user_id']
                ]);

            $json['type'] = 'success';
            $json['progressing'] = trans('lang.saving');
            $json['message'] = trans('lang.branch_created');
            return $json;
        }else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.not_authorize');
            return $json;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branch = LabBranch::find($id);
        $locations = Location::pluck('title','id');
        $labs = User::role('laboratory')->get()->pluck('full_name','id');
        return view('back-end.admin.labs.create',compact('branch','locations','labs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        request()->validate([
        'name' => 'required',
        'city_id' => 'required',
        'user_id' => 'required'
        ],
        [
            'name.required' => 'Enter branch Name!',
            'city_id.required' => 'Select City!',
            'user_id.required' => 'Select Lab!'
        ]);
        $branch = LabBranch::find($id);
        $json = array();
        if (!empty($request)) {

         $branch->update([
                    'name' => $request['name'],
                    'location_id' => $request['city_id'],
                    'user_id' => $request['user_id']
                ]);

            $json['type'] = 'success';
            $json['progressing'] = trans('lang.saving');
            $json['message'] = trans('lang.branch_created');
            return $json;
        }else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.not_authorize');
            return $json;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

//     public function getLabDiscount(Request $request)
//     {   
//     // dd($request->all()); 
//     if($request->home_sampling == false || $request->home_sampling == null){
//     $validate = Validator::make( $request->all(), [
//         'name' => 'required',
//         'phone_number' => 'required|min:11',
//     ]);
// }
// else{
//     $validate = Validator::make( $request->all(), [
//         'name' => 'required',
//         'phone_number' => 'required|min:11',
//         'home_sampling' => 'required',
//         'age' => 'required',
//         'address' => 'required',
//     ]);
// }
//         if( $validate->fails())
//         {

//           $response= [
//             'success' => 0, 
//             'data' => $validate->errors()->first()
//           ];
//           return response()->json($response);
//         }
//         $input =$request->all();
//         $userDiscountsCount = LabDiscount::where('phone_number', $input['phone_number'])
//         ->whereMonth('created_at', now()->month)
//         ->count();

//     if ($userDiscountsCount >= 3) {
//         $response = [
//             'success' => 0, 
//             'data' => 'You have already received 3 discount codes this month.'
//         ];
//         return response()->json($response);
//     }
        // $code = LabCode::where('status',0)->first();
        // $input['code'] = $code->CouponNumber;
        // LabDiscount::create($input);
        // $code->update(['Status'=>1]);
//         $response= [
//             'success' => 1, 
//        'data' => $input
//                              ];
//         return response()->json($response);
//     }
//     

public function getLabDiscount(Request $request)
{
     if ($request->home_sampling == false || $request->home_sampling == null) {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'phone_number' => 'required|min:11',
        ]);
    } else {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'phone_number' => 'required|min:12',
            'home_sampling' => 'required',
            'age' => 'required',
            'address' => 'required',
        ]);
    }

    if ($validate->fails()) {
        return response()->json([
            'success' => 0,
            'data' => $validate->errors()->first()
        ]);
    }

    $input = $request->all();
    if (Blacklist::where('phone_number', $input['phone_number'])->exists()) {
        return response()->json([
            'success' => 0,
            'data' => 'This phone number is blacklisted.'
        ]);
    }

    $userDiscountsCount = LabDiscount::where('phone_number', $input['phone_number'])
        ->whereMonth('created_at', now()->month)
        ->count();

    if ($userDiscountsCount >= 3) {
        return response()->json([
            'success' => 0,
            'data' => 'You have already received 3 discount codes this month.'
        ]);
    }

    $code = LabCode::where('status', 0)->first();
    $input['code'] = $code->CouponNumber;
    LabDiscount::create($input);
    $code->update(['Status' => 1]);
    // Check SMS balance before sending the SMS
    $balanceResponse = Http::get('https://api.itelservices.net/balance.php', [
        'api_key' => env('DAY_WISE_SMS_API_KEY'),
         'user' => env('DAY_WISE_SMS_USER'),
         'pass' => env('DAY_WISE_SMS_PASS'),                        
            ]);
    if ($balanceResponse->successful()) {
        $balance = $balanceResponse->body();
        if (preg_match('/Balance: ([\d,]+\.\d{2})/', $balance, $matches)) {
            $round = (float) str_replace(',', '', $matches[1]);
            $balance=round($round);
                   }
                //    dd($round);
         if ($balance < 10) {
            $response= [
                'success' => 1, 
               'data' => $input,
               'balance'=>$balance
                              ];
                            //   dd($response);
            return response()->json($response);
                      }
        $number = $input['phone_number'];
        $transactionId = Str::random(32);
        $apiKey = env('DAY_WISE_SMS_API_KEY');
        $username = env('DAY_WISE_SMS_USER');
        $password = env('DAY_WISE_SMS_PASS');
        $sender = env('DAY_WISE_SMS_SENDER_ID');
        $text = $input['name'] . ', Discount hasil karne ke liye ye coupon code: ' . $input['code'] . ' qaribi Chughtai branch mein dikhain. For more details contact us on 03450435621.';
        // dd($text);
        $smsResponse = Http::get(env('DAY_WISE_SMS_API_URL'), [
            'transaction_id' => $transactionId,
            'api_key' => $apiKey,
            'number' => $number,
            'user' => $username,
            'pass' => $password,
            'text' => $text,
            'from' => $sender,
            'type' => 'sms'
        ]);

        if ($smsResponse->successful()) {
            return response()->json([
                'success' => 1,
                'data' => 'The discount code has been sent to your phone number.'
            ]);
        } else {
            return response()->json([
                'success' => 0,
                'data' => 'Failed to send SMS. Please try again later.',
                'error' => $smsResponse->json()
            ]);
        }
    } else {
        return response()->json([
            'success' => 0,
            'data' => 'Failed to check SMS balance. Please try again later.',
            'error' => $balanceResponse->json()
        ]);
    }
}

    public function downloadDiscount($number)
    {
        $data  = LabDiscount::where('code',$number)->first();
        // dd($data);
        $user=$data->name;
        
        $pdf = PDF::loadView('front-end.laboratory.discount',['data'=>$data]);
        return $pdf->download($user.'.pdf');
    }
     public function importLabCode()
     {
        $data = Excel::import(new LabCodeImport, request()->file('lab_file'));
        return "file uploaded successfully";
     }
     public function labTestImportExportView()
    {
       return view('back-end.admin.speciality-tests.labTestImport');

    }
    public function blacklistuser()
    {
       return view('back-end.admin.block.blacklist');

    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function labTestExport() 
    {
        return Excel::download(new LabTestImport, 'tests.xlsx');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function labTestImport() 
    {
        $abc = Excel::import(new LabTestImport,request()->file('file')->store('files'));
     // dd('hi', $abc);
        return redirect()->back();
    }
    public function labCodeImport() 
    {

        $abc = Excel::import(new labCodeImport,request()->file('file')->store('files'));
         Session::flash('message', 'File uploaded successfully');
     // dd('hi', $abc);
        return redirect()->back();
    }
}
