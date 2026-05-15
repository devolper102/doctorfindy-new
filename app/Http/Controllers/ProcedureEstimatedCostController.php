<?php

namespace App\Http\Controllers;

use App\ProcedureEstimatedCost;
use Illuminate\Http\Request;
use DB;
use Helper;

class ProcedureEstimatedCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // $procedure_costs = DB::table('procedure_estimated_costs')->get();
   $procedure_costs = ProcedureEstimatedCost::with('procedures','hospital_data')->latest()->get();
        return view('back-end.admin.procedure-estimated-costs.index',compact('procedure_costs'));
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
        $json = Array();
        $result = ProcedureEstimatedCost::create([
            'first_name' => $request['first_name'],
            'email' => $request['email'],
            'dob' => $request['dob'],
            'hospital_id' => $request['hospital_id'],
            'procedure_id' => $request['procedure_id'],
            'phone_number' => $request['phone_number'],
        ]);
        $json['type'] = 'success';
        $json['message'] = 'Request submitted successfully';
        return $json;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProcedureEstimatedCost  $procedureEstimatedCost
     * @return \Illuminate\Http\Response
     */
    public function show(ProcedureEstimatedCost $procedureEstimatedCost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProcedureEstimatedCost  $procedureEstimatedCost
     * @return \Illuminate\Http\Response
     */
    public function edit(ProcedureEstimatedCost $procedureEstimatedCost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProcedureEstimatedCost  $procedureEstimatedCost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProcedureEstimatedCost $procedureEstimatedCost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProcedureEstimatedCost  $procedureEstimatedCost
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
          ProcedureEstimatedCost::where('id', $id)->delete();
      
            $json['type'] = 'success';
            $json['message'] = 'Procedure Estimated Cost Deleted Successfully';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }
    public function procedureStatusFilter(Request $request)
    {
        $procedures = ProcedureEstimatedCost::where('status', $request->status)->with('procedures','hospital_data')->get();
        // dd($procedures);

        return response()->json(
            [
                'type' => 'success',
                'procedures' => $procedures,
            ]
        );
    }
}
