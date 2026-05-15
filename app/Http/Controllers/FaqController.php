<?php

namespace App\Http\Controllers;

use App\Faq;
use App\FaqAssign;
use Illuminate\Http\Request;
use View;
use Helper;
use Session;
use DB;
use App\Disease;
use App\Speciality;
use App\Service;
use App\Symptom;
use App\Treatment;
use App\Procedure;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;
// 
class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Faq $faq)
    {
        $this->faq = $faq;
    }
    public function index(Request $request)
    { 
          $diseases = Disease::select('id','title','slug')->get();
          $specialitty = Speciality::select('id','title','slug')->get();
          $service = Service::select('id','title','slug')->get();
          $symptom = Symptom::select('id','title','slug')->get();
          $treatment = Treatment::select('id','title','slug')->get();
          $procedures= Procedure::select('id','title','slug')->get();
          $faqs = Faq::orderBy("id","desc")->get();
         return view('back-end.admin.faqs.index',compact('faqs','diseases','specialitty','service','symptom','treatment','procedures'));
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'status' => 'required',
                'field_name' => 'required|array|min:1'
            ]
        );
        $faqs = new Faq();
        $faqs ->status = $request->status;
        $faqs ->page_url = $request->page_url;
        $faqs ->description = json_encode($request->get('field_name'));
        $faqs ->save();
        $faqs->id;
        $faqassign = new FaqAssign();

        if ($request->diseases !== null) {
            $diseases = explode( ',',$request->diseases);
            foreach ($diseases as $disease){
                // DB::table('faq_assign')->insert(['faq_id' => $faqs->id,'type'=>'diseases','assign_value'=>$disease]);
                FaqAssign::create([
                'faq_id'=>$faqs->id,
                'type'=>'diseases',
                'assign_value'=>$disease,
            ]);  
            }
        }
        else {
            $diseases = 0;
        }
        if ($request->specialities !== null) {
            $specialities = explode( ',',$request->specialities);
            foreach ($specialities as $speciality){
                // DB::table('faq_assign')->insert(['faq_id' => $faqs->id,'type'=>'speciality','assign_value'=>$speciality]);
                FaqAssign::create([
                'faq_id'=>$faqs->id,
                'type'=>'speciality',
                'assign_value'=>$speciality,
            ]);  
            }
        }
        else {
            $specialities = 0;
        }
        if ($request->services !== null) {
            $services = explode( ',',$request->services);
            foreach ($services as $service){
                // DB::table('faq_assign')->insert(['faq_id' => $faqs->id,'type'=>'service','assign_value'=>$service]);
                FaqAssign::create([
                'faq_id'=>$faqs->id,
                'type'=>'service',
                'assign_value'=>$service,
            ]);  
            }
        }
        else {
            $services = 0;
        }
        if ($request->symptoms !== null) {
            $symptoms = explode( ',',$request->symptoms);
            foreach ($symptoms as $symptom){
                // DB::table('faq_assign')->insert(['faq_id' => $faqs->id,'type'=>'symptom','assign_value'=>$symptom]);
                FaqAssign::create([
                'faq_id'=>$faqs->id,
                'type'=>'symptom',
                'assign_value'=>$symptom,
            ]);  
            }
        }
        else {
            $symptoms = 0;
        }
        if ($request->treatments !== null) {
            $treatments = explode( ',',$request->treatments);
            foreach ($treatments as $treatment){
            //     DB::table('faq_assign')->insert(['faq_id' => $faqs->id,'type'=>'treatment','assign_value'=>$treatment]);
                FaqAssign::create([
                'faq_id'=>$faqs->id,
                'type'=>'treatment',
                'assign_value'=>$treatment,
            ]);  
            }
        }
        else {
            $treatments = 0;
        }
         if ($request->procedures !== null) {
            $procedures = explode( ',',$request->procedures);
            foreach ($procedures as $procedure){
                // DB::table('faq_assign')->insert(['faq_id' => $faqs->id,'type'=>'procedure','assign_value'=>$procedure]);
                 FaqAssign::create([
                'faq_id'=>$faqs->id,
                'type'=>'procedure',
                'assign_value'=>$procedure,
            ]);
            }
        }
        else {
            $procedures = 0;
        }

         Session::flash('message','Faqs Created Successfully');  
         return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit($faq)
    {
        $diseases = Disease::select('id','title','slug')->get();
        $specialitty = Speciality::select('id','title','slug')->get();
        $service = Service::select('id','title','slug')->get();
        $symptom = Symptom::select('id','title','slug')->get();
        $treatment = Treatment::select('id','title','slug')->get();
        $procedures= Procedure::select('id','title','slug')->get();
        $dis_all_data = [];
        $spc_all_data = [];
        $ser_all_data = [];
        $sym_all_data = [];
        $tre_all_data = [];
        $pro_all_data = [];

        $faqs = Faq::find($faq); //first table get data
       $newid =  $faqs->id;
//disease
        // $dis_ids =   DB::table('faq_assign')->where('faq_id',$newid)->having('type', 'diseases')->get();
        // foreach ($dis_ids as $key => $data){
        //    $dis_all_data[] =  DB::table('diseases')->where('id',$data->assign_value)->first();
        // }
        // $dis_tags = $dis_all_data ;
       $dis_ids = FaqAssign::where('faq_id', $newid)->where('type', 'diseases')->get();

        $dis_all_data = [];
        foreach ($dis_ids as $key => $data) {
            $dis_all_data[] = Disease::find($data->assign_value);
         }

       $dis_tags = $dis_all_data;
       // dd($dis_all_data);
//speciality
        //  $dis_ids =   DB::table('faq_assign')->where('faq_id',$newid)->having('type', 'speciality')->get();
        // foreach ($dis_ids as $key => $data){
        //    $spc_all_data[] =  DB::table('specialities')->where('id',$data->assign_value)->first();
        // }
        // $spe_tags = $spc_all_data ;
       $dis_ids = FaqAssign::where('faq_id', $newid)->where('type', 'speciality')->get();

        $spc_all_data = [];
        foreach ($dis_ids as $key => $data) {
            $spc_all_data[] = Speciality::find($data->assign_value);
        }

      $spe_tags = $spc_all_data;
//service
        // $dis_ids =   DB::table('faq_assign')->where('faq_id',$newid)->having('type', 'service')->get();
        // foreach ($dis_ids as $key => $data){
        //    $ser_all_data[] =  DB::table('services')->where('id',$data->assign_value)->first();
        // }
        // $ser_tags = $ser_all_data ;
      $dis_ids = FaqAssign::where('faq_id', $newid)->where('type', 'service')->get();

        $ser_all_data = [];
        foreach ($dis_ids as $key => $data) {
            $ser_all_data[] = Service::find($data->assign_value);
        }

        $ser_tags = $ser_all_data;
//symptom
        // $dis_ids =   DB::table('faq_assign')->where('faq_id',$newid)->having('type', 'symptom')->get();
        // foreach ($dis_ids as $key => $data){
        //    $sym_all_data[] =  DB::table('symptoms')->where('id',$data->assign_value)->first();
        // }
        // $sym_tags = $sym_all_data ;
        $dis_ids = FaqAssign::where('faq_id', $newid)->where('type', 'symptom')->get();

        $sym_all_data = [];
        foreach ($dis_ids as $key => $data) {
            $sym_all_data[] = Symptom::find($data->assign_value);
        }

        $sym_tags = $sym_all_data;
//treatment
        // $dis_ids =   DB::table('faq_assign')->where('faq_id',$newid)->having('type', 'treatment')->get();
        // foreach ($dis_ids as $key => $data){
        //    $tre_all_data[] =  DB::table('treatments')->where('id',$data->assign_value)->first();
        // }
        // $tre_tags = $tre_all_data ;
        $dis_ids = FaqAssign::where('faq_id', $newid)->where('type', 'treatment')->get();

        $tre_all_data = [];
        foreach ($dis_ids as $key => $data) {
            $tre_all_data[] = Treatment::find($data->assign_value);
        }

        $tre_tags = $tre_all_data;
//Procedures
        //  $dis_ids =   DB::table('faq_assign')->where('faq_id',$newid)->having('type', 'procedure')->get();
        // foreach ($dis_ids as $key => $data){
        //    $pro_all_data[] =  DB::table('procedures')->where('id',$data->assign_value)->first();
        // }
        // $pro_tags = $pro_all_data ;
        $dis_ids = FaqAssign::where('faq_id', $newid)->where('type', 'procedure')->get();

        $pro_all_data = [];
        foreach ($dis_ids as $key => $data) {
            $pro_all_data[] = Procedure::find($data->assign_value);
        }

        $pro_tags = $pro_all_data;

         return view('back-end.admin.faqs.edit',compact('faqs','diseases','specialitty','service','symptom','treatment','procedures','dis_tags','spe_tags','ser_tags','sym_tags','tre_tags','pro_tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$faq)
    {
       $this->validate(
            $request,
            [
                'status' => 'required',
                'field_name' => 'required'
            ]
        );
      $faqs = Faq::find($faq);
        $faqs ->status = $request->get('status');
        $faqs ->page_url = $request->get('page_url');
        $faqs ->description = json_encode($request->get('field_name'));
        $faqs ->save();
        $faqs->id;//72
        // $dis_ids =   DB::table('faq_assign')->where('faq_id',$faqs->id)->delete();
        //    $faqassign = new FaqAssign();
           FaqAssign::where('faq_id', $faqs->id)->delete();
         $faqassign = new FaqAssign();

//diseases
  if ($request->diseases !== null) {
        $diseases = explode( ',',$request->diseases);
         foreach ($diseases as $disease){
            // DB::table('faq_assign')->insert(['faq_id' => $faqs->id,'type'=>'diseases','assign_value'=>$disease]);  
            FaqAssign::create([
                'faq_id'=>$faqs->id,
                'type'=>'diseases',
                'assign_value'=>$disease,
            ]);    
        // dd($diseases);
            }
    }
        else {
            $diseases = 0;
        }          

//specialitty
if ($request->specialitty !== null) {
     $specialities = explode( ',',$request->specialitty);
            foreach ($specialities as $speciality){
            // DB::table('faq_assign')->insert(['faq_id' => $faqs->id,'type'=>'speciality','assign_value'=>$speciality]); 
            FaqAssign::create([
                'faq_id'=>$faqs->id,
                'type'=>'speciality',
                'assign_value'=>$speciality,
            ]); 
            // dd($specialities);     
            }
        }
    else {
            $specialities = 0;
        }         

//service
if ($request->service !== null) {
    $services = explode( ',',$request->service);
            foreach ($services as $service){
            // DB::table('faq_assign')->insert(['faq_id' => $faqs->id,'type'=>'service','assign_value'=>$service]);
               FaqAssign::create([
                'faq_id'=>$faqs->id,
                'type'=>'service',
                'assign_value'=>$service,
            ]);     
            }
        }
            else {
            $services = 0;
        } 

//symptom
if ($request->symptom !== null) {
     $symptoms = explode( ',',$request->symptom);
            foreach ($symptoms as $symptom){
            // DB::table('faq_assign')->insert(['faq_id' => $faqs->id,'type'=>'symptom','assign_value'=>$symptom]); 
                 FaqAssign::create([
                'faq_id'=>$faqs->id,
                'type'=>'symptom',
                'assign_value'=>$symptom,
            ]);     
            }
            }
            else {
            $symptoms = 0;
        } 

//treatment
if ($request->treatment !== null) {
     $treatments = explode( ',',$request->treatment);
            foreach ($treatments as $treatment){
            // DB::table('faq_assign')->insert(['faq_id' => $faqs->id,'type'=>'treatment','assign_value'=>$treatment]);  
            FaqAssign::create([
                'faq_id'=>$faqs->id,
                'type'=>'treatment',
                'assign_value'=>$treatment,
            ]);         
            }
             }
            else {
            $treatments = 0;
        } 
       
if ($request->procedure !== null) {
     $procedures = explode( ',',$request->procedure);
            foreach ($procedures as $procedure){
            // DB::table('faq_assign')->insert(['faq_id' => $faqs->id,'type'=>'procedure','assign_value'=>$procedure]);
             FaqAssign::create([
                'faq_id'=>$faqs->id,
                'type'=>'procedure',
                'assign_value'=>$procedure,
            ]);       
            }
             }
            else {
            $procedures = 0;
        }
        Session::flash('message','Faq Update Successfully');  
       return Redirect::to('admin/faq');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
         {

        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $json['type'] = 'error';
            $json['message'] = $server->getData()->message;
            return $json;
        }
        $json = array();
        $id = $request['id'];
        
        if (!empty($id)) {
       Faq::where('id', $id)->delete();
       FaqAssign::where('faq_id', $id)->delete();
            $json['type'] = 'success';
            $json['message'] = 'Faq Deleted Successfully';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }
    public function approve($status, $id){
        //dd($status, $id);
        Faq::where('id',$id)->update(array('status'=>$status));
        Session::flash('message','Status Change Successfully');  
       return Redirect::to('admin/faq');
    }
}
