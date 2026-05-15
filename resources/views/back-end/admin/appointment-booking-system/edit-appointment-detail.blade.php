@extends('back-end.master')
@section('content')
@php
use Carbon\Carbon;
$hospital = App\User::where('id',$appointment->hospital_id)->first();
if($hospital != null)
{
  $hospital_fname=$hospital->first_name;
  $hospital_lname=$hospital->last_name;
  $hospital_number=$hospital->phone_number;
  $location_id = $appointment->hospital_profile->location_id;
  $location_name = App\Location::where('id', $location_id)->pluck('title')->first();  
}
else
{
    $hospital_fname='';
    $hospital_lname='';
    $hospital_number='';
    $location_id = '';
    $location_name ='';  


}



                            

@endphp
@include('includes.pre-loader')
    <div class="dc-services" id="services">
    	  @if (Session::has('message'))
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
            </div>
        @elseif (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
            </div>
        @endif
 <section class="dc-haslayout">
  <div class="main-section mt-5">
                        
            <div id="edit_appointment_main" class="card card-table">
                            <div class="card-header w-10 
                                d-inline-block">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="appointment-heading w-100 d-inline-block mt-3">
                                          <h4 class="card-title">Edit Appointment Detail</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="edit-appointment-form" class="dc-dashboardboxtitle">
                                {!! Form::open(['url' => url('admin/update-appointment-details/'.$appointment->id.''), 'class' =>'dc-formtheme', 'id' =>'admin-edit-appointment'])!!}
                                <fieldset>
                                    <div class="form-group w-50">
                                        <label>Hospital First Name</label>
                                        {!! Form::text( 'hospital_first_name', e($hospital_fname), ['class' =>'form-control', 'placeholder' => "First Name"] ) !!}
                                        <label>Hospital Last Name</label>
                                        {!! Form::text( 'Hospital_last_name', e($hospital_lname), ['class' =>'form-control', 'placeholder' => "Last Name"] ) !!}
                                    </div>
                                    <div class="form-group w-50 float left">
                                        <label>Location</label>
                                        {!! Form::text( 'location', e($location_name), ['class' =>'form-control', 'placeholder' => "Location"] ) !!}
                                    </div>
                                    

                                    <div class="form-group w-50">
                                        <label>Change Date time</label>
                                        {!! Form::input('dateTime-local', 'appointment_date', $appointment->appointment_date, ['id' => 'date-time-appointment', 'class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group w-30">
                                        <label>Hospital Fees</label>
                                        {!! Form::number('hospital_fee', $appointment->charges, [ 'class' => 'form-control', 'placeholder' => "Enter Hospital Fee"]) !!}
                                    </div>
                                    <div class="form-group w-30">
                                        <label>Hospital Number</label>
                                        {!! Form::number('hospital_number', $hospital_number, [ 'class' => 'form-control', 'placeholder' => "Enter Hospital Number"]) !!}
                                    </div>

                                    <div class="form-group w-30">
                                        <label>Appointment Date:</label>
                                        {{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}}<span class="text-primary">{{$appointment->appointment_time}}</span>
                                    </div>
                                  
                                    {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
                                
                                 </fieldset>
                                {!! Form::close(); !!}
                             </div>
            </div>       
                        
  </div>
  </section>                  	
</div>
@endsection
@push('scripts')
@stack('backend_scripts')
@endpush
