@extends('back-end.master')
@push('backend_stylesheets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<style type="text/css">
  #online_appointment_table thead tr th{
    min-width: 190px !important;
  }
  #reportrangeAppointment{
    color: #999;
    outline: 0;
    height: 50px;
    background: #fff;
    font-size: 14px;
    -webkit-box-shadow: none;
    box-shadow: none;
    line-height: 18px;
    padding: 10px 20px;
    border-radius: 4px;
    display: inline-block;
    vertical-align: middle;
    border: 2px solid #eee;
    text-transform: inherit;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    font-family: 'Open Sans', sans-serif;
  }
</style>

@endpush
@section('content')
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
  <div class="row">
                        
                       
                        @if ($appointments->count() > 0)
                        <div class="col-md-12">
                        
                            <!-- Recent Orders -->
                            <div class="card card-table">
                                <div class="card-header">
                                    @if (Request::is('admin/all-appointment'))
                                      <h4 class="card-title">All Appointments</h4>
                                    @elseif (Request::is('admin/pending-appointment'))
                                      <h4 class="card-title">Pending Appointments</h4>
                                    @elseif (Request::is('admin/cancel-appointment'))
                                      <h4 class="card-title">Cancel Appointments</h4>
                                    @elseif (Request::is('admin/accepted-appointment'))
                                      <h4 class="card-title">Accepted Appointments</h4>
                                    @endif
                                    <!-- <div>Registration closes in <p id="demo"></p></div> -->
                                </div>
                                <div class="card-body">
                                    <div class="row mt-3 mb-3">
                  <div class="col-lg-4 col-12">
                     <label>Select Date</label>
                     <div class="dateMain">
                        <div id="reportrangeAppointment" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
    <i class="fa fa-calendar"></i>&nbsp;
    <span></span> <i class="fa fa-caret-down"></i>
</div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-12">
                     <label>Select City</label>
                     <div class="dateMain">
    <select onchange="filterAppointmentCity(this.value)" class="w-100">
                     @foreach ($locations as $location)
             <option selected="selected" value="{{ $location->id }}">{{ $location->title }}</option>
@endforeach
   </select>
</div>
                  </div>
                  <div class="col-lg-4 col-12">
                     <label>Select Area</label>
                     <div class="dateMain">
    <select id="appointmentList" name="appointmentList" onchange="filterAppointmentArea(this.value)" class="w-100">
                     
   </select>
</div>
                  </div>
                  <div class="col-lg-4 col-12">
                             <label>Select Search Filter</label>
                             <div class="dateMain">
                                <select onchange="selectedFilter(this.value)">
                                         <option value="search-by-patient">Search by Patient</option>
                                         <option value="search-by-doctor">Search by Doctor</option>
                                         <option value="search-by-hospital">Search by Hospital</option>
                                         <option value="search-by-email">Search by Email</option>
                                </select>
                            </div>
                             </div>
               </div>
                                    <div class="all-appointment-main">
                                        
                                        <table class="table table-bordered table-hover dt-responsive nowrap table-responsive"id="online_appointment_table">
                                            <thead>
                                                <tr>
                                                    <th>Doctor Name</th>
                                                    <th>Patient Name</th>
                                                    <th>Phone Number</th>
                                                    <th>Hospital Name</th>
                                                    <th>Speciality</th>
                                                    <th>City</th> 
                                                    <th>Apointment Time</th>
                                                    <th>Created At</th>
                                                    <th class="text-right">Amount</th>
                                                    <th class="action">{{{ trans('lang.action') }}}</th>
                                                    <th class="none">Status</th>
                                                    <th class="none">Type</th>
                                                    <th class="none">Comments</th>
                                                    <th class="none">Booked by</th>
                                                    <th class="none">Appointment Status</th>

                                                </tr>
                                            </thead>
                                            <div id="loading">
                                                 <img src="{{asset('images/loader/loader.gif')}}" />  
                                            </div>
                                            <tbody>
                                                                                             @foreach($appointments as  $key => $appointment)

                                                <tr>
                                                  
                        @php
                                               
                            $hospital_name = $appointment->hospital_profile->first_name . ' ' . $appointment->hospital_profile->last_name;
                            $patient_name = $appointment->patient_profile->first_name . ' ' . $appointment->patient_profile->last_name;
                            $doctor_name = $appointment->doctor_profile->first_name . ' ' . $appointment->doctor_profile->last_name;
                            $speciality = $appointment->doctor_profile->specialities[0]->title;
                            $city_id = $appointment->hospital_profile->location_id;
                            $city_name = App\Location::where('id', $city_id)->pluck('title')->first();
                        @endphp                            
                        @php
                            $app_doctor = App\User::where('id',$appointment->user_id)->with('profile')->first();
                            
                        @endphp

                                                    <td>
                                                            <a href="/profile/{{clean($app_doctor->slug)}}">{{$doctor_name}}</a>
                                                    </td>

                        @php

                            $app_patient = App\User::where('id',$appointment->patient_id)->with('profile')->first();
                        @endphp                       
                                                    <td>
                                                            <b>{{$patient_name}}</b>
                                                    </td>  
                                                    <td>
                                                        {{Helper::getUserPhonumber($app_patient->id)}}
                                                    </td>
                                                    <td>{{$hospital_name}}</td>
                                                    <td>{{$speciality}}</td>
                                                    <td>{{$city_name}}</td>
                                                    <td>{{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}}<span class="text-primary d-block">{{$appointment->appointment_time}}</span></td>
                                                    <td>{{$appointment->created_at->format('M d, Y H:i:s')}}</td>
                                                    
                                                       <td class="text-right">
                                                        Rs{{$appointment->charges}}
                                                    </td>
                                                     <td>
                                                    <div class="dc-actionbtn">
                                                        <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ $appointment->id }}'" :message="'{{'Online Apointment Deleted Successfully'}}'" :url="'{{url('admin/online-appointment/delete')}}'" :redirect_url="'{{url('admin/online-appointment')}}'"></delete>
                                                    </div>
                                                    </td>
                                                    <td>
                                                    {{$appointment->status}}
                                                        
                                                    </td>
                                                      <td>
                                                        {{$appointment->type}}
                                                    </td>
                                                 
                                                    <td>
                                                        {!!$appointment->comments!!}
                                                    </td>
                                                    <td>{{$appointment->booked_by}}</td>

                                                    <td>

                           <div class="col-lg-4 col-12">
                               <div class="dateMain">
                                <select class="center" onchange="showDropDown({{$appointment->id}},this.value)">
                                 <option value="none" selected="selected">Please Select</option>
                                 @if($appointment->status == 'accepted' || $appointment->status == 'cancelled' || $appointment->status == 'completed')
                                      <option value="pending">Decline</option>
                                 @endif
                                 @if($appointment->status == 'pending' || $appointment->status == 'cancelled' || $appointment->status == 'null' || $appointment->status == null)
                                      <option value="accepted">Accept</option>
                                 @endif
                                 @if($appointment->status == 'pending' || $appointment->status == 'accepted' || $appointment->status == 'null' || $appointment->status == null)
                                       <option value="cancelled">Cancel</option>
                                 @endif
                                 @if($appointment->status == 'pending' || $appointment->status == 'accepted' || $appointment->status == 'null' || $appointment->status == null)
                                       <option value="completed">Complete</option>
                                 @endif

                                </select>
                              </div>
                           </div>
                              
                        </td>
                                                </tr>
                                                <div id="message"></div>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /Recent Orders -->
                            
                        </div>
                        @else
                            @include('errors.no-record')
                        @endif
                    </div>
       </section>                   
</div>
@endsection
@push('scripts')
@stack('backend_scripts')
<script type="text/javascript">
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();
    function cb(start, end) {
        $('#reportrangeAppointment span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    dateFilter(start, end);
        
    }

    $('#reportrangeAppointment').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    //cb(start, end);
});
    function dateFilter(startDate, endDate){
      // alert(startDate.format("YYYY-MM-DD"))
   
      // alert(id);
      var base      = window.location.origin;
      var table = $('#online_appointment_table').DataTable( {
        "order": [],
         "bDestroy": true,
    } );
      var url  = window.location.href;
      var request_type=url.split('/');
      // console.log('type',request_type[4])  
      request_type=request_type[4];


                 $.ajaxSetup({
                   headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
               $.ajax({
               type: "GET",
               url: base+"/admin/appointment-date-filter",
               data:{'type':request_type,'startDate':startDate.format("YYYY-MM-DD"),'endDate':endDate.format("YYYY-MM-DD")},
               // contentType: "application/json; charset=utf-8",
               dataType: "json",
               success: function (response) {
               // console.log(response);
               table.clear().draw();
                var pagination=$('#tab_pagination').html('');
                var status_action='';
               $.each(response.appointments, function(i, item) {
                if(item.user_id === null){
                   var doctor_name = '';
                   var speciality = '';
                 }
                 else{
                  var doctor_name = item.doctor_profile.first_name+' '+item.doctor_profile.last_name;
                  var speciality = item.doctor_profile.specialities[0].title;
                 }

               if(item.patient_id === null){
                   var patient_name = '';
                   var patient_number ='';
                 }
                 else{
                  var patient_name = item.patient_profile.first_name+' '+item.patient_profile.last_name;
                        var patient_number=item.patient_profile.phone_number;

                 }
                 if(item.hospital_id === null){
                   var hospital_name = '';
                   var city = '';
                 }
                 else{
                  var hospital_name = item.hospital_profile.first_name+' '+item.hospital_profile.last_name;
                  var city = item.hospital_profile.location.title;

                 }
                 if(item.appointment_time === null){
                   var appointment_time = '';
                 }
                 else{
                  var appointment_time = item.appointment_time;

                 }
                 if(item.appointment_date === null){
                   var appointment_date = '';
                 }
                 else{
                  var appointment_date = item.appointment_date+' '+appointment_time;

                 }
                 if(item.created_at === null){
                   var created_at = '';
                 }
                 else{
                  var created_at = item.created_at;
                 }
                 if(item.charges === null){
                   var charges = '';
                 }
                 else{
                  var charges = item.charges;

                 }
                 
               
                 if(item.status === null){
                   var status = '';
                    status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="accepted">Accept</option><option value="cancelled">Cancel</option><option value="completed">Completed</option></select></div></div>'
                 }
                 else{
                  var status = item.status;
                  if(item.status == 'completed')
                    {
                      status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="pending">Decline</option></select></div></div>'
                    }
                    else if(item.status == 'accepted')
                    {
                       status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="pending">Decline</option><option value="cancelled">Cancel</option><option value="completed">Completed</option></select></div></div>'
                    }
                    else if (item.status == 'cancelled')
                    {
                        status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="pending">Decline</option><option value="accepted">Accept</option><option value="completed">Completed</option></select></div></div>'
                    }
                    else
                    {
                        status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="accepted">Accept</option><option value="cancelled">Cancel</option><option value="completed">Completed</option></select></div></div>'
                    }
                 }
                 if(item.type === null){
                   var type = '';
                 }
                 else{
                  var type = item.type;
                 }
                 if(item.comments  === null){
                   var comments  = '';
                 }
                 else{
                  var comments  = item.comments;
                 }
                 var booked_by=item.booked_by;
                 
                 var delete_icon ='<a href="javascript:" id='+item.id+' onclick="delete_appointment('+item.id+')" class="dc-deleteinfo dc-actionbtn"><delete :title="{{trans("lang.ph.delete_confirm_title")}}"  :message="{{trans("lang.user_deleted")}}" :url="'+base+'admin/online-appointment/delete" :redirect_url="'+base+'admin/all-appointment"></delete><i class="lnr lnr-trash"></i></a>';
               table.row.add([ 
                doctor_name,
                patient_name,
                patient_number,
                hospital_name,
                speciality,
                city,
                appointment_date,
                created_at,
                charges,
                delete_icon,
                status,
                type,
                comments,
                booked_by,
                status_action,    
                ]);
               });
               table.draw();
               }
           });
           };
    function filterAppointmentCity(id){
      // alert(startDate.format("YYYY-MM-DD"))
   
      // alert(id);
      var base      = window.location.origin;
      var table = $('#online_appointment_table').DataTable({
        "order": [],
         "bDestroy": true,
      });
      var url  = window.location.href;
      var request_type=url.split('/');
      // console.log('type',request_type[4])  
      request_type=request_type[4];


                 $.ajaxSetup({
                   headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
               $.ajax({
               type: "GET",
               url: base+"/admin/appointment-city-filter",
               data:{'type':request_type,'id':id},
               // contentType: "application/json; charset=utf-8",
               dataType: "json",
               success: function (response) {
               // console.log(response);
               table.clear().draw();
                var pagination=$('#tab_pagination').html('');
                var status_action='';
               $.each(response.areas, function (i, item) {
                  $('#appointmentList').find('option').remove().end();
});
               $.each(response.areas, function (i, item) {
    $('#appointmentList').append($('<option>', { 
        value: item.id,
        text : item.title 
    }));
});
               $.each(response.appointments, function(i, item) {
                if(item.user_id === null){
                   var doctor_name = '';
                   var speciality = '';
                 }
                 else{
                  var doctor_name = item.doctor_profile.first_name+' '+item.doctor_profile.last_name;
                  var speciality = item.doctor_profile.specialities[0].title;
                 }

               if(item.patient_id === null){
                   var patient_name = '';
                   var patient_number='';
                 }
                 else{
                  var patient_name = item.patient_profile.first_name+' '+item.patient_profile.last_name;
                        var patient_number=item.patient_profile.phone_number;
                  
                 }
                 if(item.hospital_id === null){
                   var hospital_name = '';
                   var city = '';
                 }
                 else{
                  var hospital_name = item.hospital_profile.first_name+' '+item.hospital_profile.last_name;
                  var city = item.hospital_profile.location.title;
                 }
                 if(item.appointment_time === null){
                   var appointment_time = '';
                 }
                 else{
                  var appointment_time = item.appointment_time;

                 }
                 if(item.appointment_date === null){
                   var appointment_date = '';
                 }
                 else{
                  var appointment_date = item.appointment_date+' '+appointment_time;

                 }
                 if(item.created_at === null){
                   var created_at = '';
                 }
                 else{
                  var created_at = item.created_at;
                 }
                 if(item.charges === null){
                   var charges = '';
                 }
                 else{
                  var charges = item.charges;

                 }
                 
               
                 if(item.status === null){
                   var status = '';
                   status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="accepted">Accept</option><option value="cancelled">Cancel</option><option value="completed">Completed</option></select></div></div>'
                 }
                 else{
                  var status = item.status;
                  if(item.status == 'completed')
                    {
                      status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="pending">Decline</option></select></div></div>'
                    }
                    else if(item.status == 'accepted')
                    {
                       status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="pending">Decline</option><option value="cancelled">Cancel</option><option value="completed">Completed</option></select></div></div>'
                    }
                    else if (item.status == 'cancelled')
                    {
                        status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="pending">Decline</option><option value="accepted">Accept</option><option value="completed">Completed</option></select></div></div>'
                    }
                    else
                    {
                        status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="accepted">Accept</option><option value="cancelled">Cancel</option><option value="completed">Completed</option></select></div></div>'
                    }
                 }
                 if(item.type === null){
                   var type = '';
                 }
                 else{
                  var type = item.type;
                 }
                 if(item.comments  === null){
                   var comments  = '';
                 }
                 else{
                  var comments  = item.comments;
                 }
                 var booked_by=item.booked_by;
                 
                 var delete_icon ='<a href="javascript:" id='+item.id+' onclick="delete_appointment('+item.id+')" class="dc-deleteinfo dc-actionbtn"><delete :title="{{trans("lang.ph.delete_confirm_title")}}"  :message="{{trans("lang.user_deleted")}}" :url="'+base+'admin/online-appointment/delete" :redirect_url="'+base+'admin/all-appointment"></delete><i class="lnr lnr-trash"></i></a>';
               table.row.add([ 
                doctor_name,
                patient_name,
                patient_number,
                hospital_name,
                speciality,
                city,
                appointment_date,
                created_at,
                charges,
                delete_icon,
                status,
                type,
                comments,
                booked_by,
                status_action,
                        
                ]);
               });
               table.draw();
               }
           });
           };
           function filterAppointmentArea(id){
      // alert(startDate.format("YYYY-MM-DD"))
   
      // alert(id);
      var base      = window.location.origin;
      var table = $('#online_appointment_table').DataTable({
        "order": [],
         "bDestroy": true,
      });
      var url  = window.location.href;
      var request_type=url.split('/');
      // console.log('type',request_type[4])  
      request_type=request_type[4];


                 $.ajaxSetup({
                   headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
               $.ajax({
               type: "GET",
               url: base+"/admin/appointment-area-filter",
               data:{'type':request_type,'id':id},
               // contentType: "application/json; charset=utf-8",
               dataType: "json",
               success: function (response) {
               // console.log(response);
               table.clear().draw();
                var pagination=$('#tab_pagination').html('');
               var status_action='';
               $.each(response.appointments, function(i, item) {
                if(item.user_id === null){
                   var doctor_name = '';
                   var speciality = '';
                 }
                 else{
                  var doctor_name = item.doctor_profile.first_name+' '+item.doctor_profile.last_name;
                  var speciality = item.doctor_profile.specialities[0].title;
                 }

               if(item.patient_id === null){
                   var patient_name = '';
                   var patient_number = '';
                 }
                 else{
                  var patient_name = item.patient_profile.first_name+' '+item.patient_profile.last_name;
                        var patient_number=item.patient_profile.phone_number;
                  
                 }
                 if(item.hospital_id === null){
                   var hospital_name = '';
                   var city = '';
                 }
                 else{
                  var hospital_name = item.hospital_profile.first_name+' '+item.hospital_profile.last_name;
                  var city = item.hospital_profile.location.title;
                 }
                 if(item.appointment_time === null){
                   var appointment_time = '';
                 }
                 else{
                  var appointment_time = item.appointment_time;

                 }
                 if(item.appointment_date === null){
                   var appointment_date = '';
                 }
                 else{
                  var appointment_date = item.appointment_date+' '+appointment_time;

                 }
                 if(item.created_at === null){
                   var created_at = '';
                 }
                 else{
                  var created_at = item.created_at;
                 }
                 if(item.charges === null){
                   var charges = '';
                 }
                 else{
                  var charges = item.charges;

                 }
                 
               
                 if(item.status === null){
                   var status = '';
                   status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="accepted">Accept</option><option value="cancelled">Cancel</option><option value="completed">Completed</option></select></div></div>'
                 }
                 else{
                  var status = item.status;
                  if(item.status == 'completed')
                    {
                      status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="pending">Decline</option></select></div></div>'
                    }
                    else if(item.status == 'accepted')
                    {
                       status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="pending">Decline</option><option value="cancelled">Cancel</option><option value="completed">Completed</option></select></div></div>'
                    }
                    else if (item.status == 'cancelled')
                    {
                        status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="pending">Decline</option><option value="accepted">Accept</option><option value="completed">Completed</option></select></div></div>'
                    }
                    else
                    {
                        status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="accepted">Accept</option><option value="cancelled">Cancel</option><option value="completed">Completed</option></select></div></div>'
                    }
                 }
                 if(item.type === null){
                   var type = '';
                 }
                 else{
                  var type = item.type;
                 }
                 if(item.comments  === null){
                   var comments  = '';
                 }
                 else{
                  var comments  = item.comments;
                 }
                 var booked_by=item.booked_by;

                 var delete_icon ='<a href="javascript:" id='+item.id+' onclick="delete_appointment('+item.id+')" class="dc-deleteinfo dc-actionbtn"><delete :title="{{trans("lang.ph.delete_confirm_title")}}"  :message="{{trans("lang.user_deleted")}}" :url="'+base+'admin/online-appointment/delete" :redirect_url="'+base+'admin/all-appointment"></delete><i class="lnr lnr-trash"></i></a>';
               table.row.add([ 
                doctor_name,
                patient_name,
                patient_number,
                hospital_name,
                speciality,
                city,
                appointment_date,
                created_at,
                charges,
                delete_icon,
                status,
                type,
                comments,
                booked_by,
                status_action,
                        
                ]);
               });
               table.draw();
               }
           });
           };
        function delete_appointment(id){
            del_id=id;
                sweetAlert({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                  });
      };
      $(document).on('click','.confirm',function(){
               var base      = window.location.origin;
               var red_url = base+"/admin/online-appointment/delete";
                 $.ajaxSetup({
                   headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
               $.ajax({
               type: "POST",
               url: base+"/admin/online-appointment/delete",
               data:{'id':del_id},
               // contentType: "application/json; charset=utf-8",
               dataType: "json",
               success: function (response) {
                if(response.type==='success'){
                    window.location=base+"/admin/all-appointment";
                // $('#online_appointment_table').DataTable().ajax.reload(); 
                  // $("tbody").ajax.reload();
                  //  sweetAlert({
                  //   title: 'Successfully Deleted',
                  //   // text: "You won't be able to revert this!",
                  //   icon: 'success',
                  //   // showCancelButton: true,
                  //   confirmButtonColor: 'green',
                  //   cancelButtonColor: '#d33',
                  //   confirmButtonText: 'close'
                  // });
                }
               
            }
         });
      });

     
      

    </script>
  <script>
    jQuery(document).ready(function() {
        jQuery('#online_appointment_table').DataTable({
        "order": [[10, "desc"]]
         "bDestroy": true,
        });
      } );

    var allAppointments = JSON.stringify({!!json_encode($appointments)!!});
    // console.log('xx',allAppointments)
    //   this.appointments.forEach(function (x) {
    //     console.log('x',x)
    //     // if(x.appointment_date === date) {
    //     //   self.appointments_patient.push(x)
    //     // }
    //   })
    // console.log('all appointments',allAppointments)
// Set the date we're counting down to
var countDownDate = new Date("Jan 5, 2021 15:37:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  // document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  // + minutes + "m " + seconds + "s ";
    
  // // If the count down is over, write some text 
  // if (distance < 0) {
  //   clearInterval(x);
  //   document.getElementById("demo").innerHTML = "EXPIRED";
  // }
}, 1000);
</script>
<script type="text/javascript">
 $(document).ready(function() {
      localStorage. setItem('clickCount', 1);
      localStorage. setItem('selectedOption', 'search-by-patient');
       var table = $('#online_appointment_table').DataTable({
        "order": [[10, "desc"]]
       });
       var check_box='';
       $('.dataTables_filter').find('input').addClass("search_field");
      $(document).on('keyup','.search_field',function(){
            
            var search_value =$(this).val();
            var selectedOptionFilter=localStorage.getItem('selectedOption');
            var url      = window.location.href;
            var base      = window.location.origin;
            var request_type=url.split('/'); 
            request_type=request_type[4];
            if(search_value.length > 3)
            {
                $.ajax({
               type: "GET",
               url: base+'/admin/all-appointment-search',
               data:{'type':request_type,'search':search_value ,'selected':selectedOptionFilter},
               dataType: "json",
               success: function (response) {
               table.clear().draw();
               var status_action='';

                   $.each(response[0], function(i, item) {
                if(item.user_id === null){
                   var doctor_name = '';
                   var speciality = '';
                 }
                 else{
                  var doctor_name = item.doctor_profile.first_name+' '+item.doctor_profile.last_name;
                  var speciality = item.doctor_profile.specialities[0].title;
                 }

               if(item.patient_id === null){
                   var patient_name = '';
                   var patient_number = '';
                 }
                 else{
                  var patient_name = item.patient_profile.first_name+' '+item.patient_profile.last_name;
                  var patient_number=item.patient_profile.phone_number;
                 }
                 if(item.hospital_id === null){
                   var hospital_name = '';
                   var city = '';
                 }
                 else{
                  var hospital_name = item.hospital_profile.first_name+' '+item.hospital_profile.last_name;
                  var city = item.hospital_profile.location.title;
                 }
                 if(item.appointment_time === null){
                   var appointment_time = '';
                 }
                 else{
                  var appointment_time = item.appointment_time;

                 }
                 if(item.appointment_date === null){
                   var appointment_date = '';
                 }
                 else{
                  var appointment_date = item.appointment_date+' '+appointment_time;

                 }
                 if(item.created_at === null){
                   var created_at = '';
                 }
                 else{
                  var created_at = item.created_at;
                 }
                 if(item.charges === null){
                   var charges = '';
                 }
                 else{
                  var charges = item.charges;

                 }
                 
               
                 if(item.status === null){
                   var status = '';
                   status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="accepted">Accept</option><option value="cancelled">Cancel</option><option value="completed">Completed</option></select></div></div>'
                 }
                 else{
                  var status = item.status;
                   if(item.status == 'completed')
                    {
                      status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="pending">Decline</option></select></div></div>'
                    }
                    else if(item.status == 'accepted')
                    {
                       status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="pending">Decline</option><option value="cancelled">Cancel</option><option value="completed">Completed</option></select></div></div>'
                    }
                    else if (item.status == 'cancelled')
                    {
                        status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="pending">Decline</option><option value="accepted">Accept</option><option value="completed">Completed</option></select></div></div>'
                    }
                    else
                    {
                        status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="accepted">Accept</option><option value="cancelled">Cancel</option><option value="completed">Completed</option></select></div></div>'
                    }
                 }
                 if(item.type === null){
                   var type = '';
                 }
                 else{
                  var type = item.type;
                 }
                 if(item.comments  === null){
                   var comments  = '';
                 }
                 else{
                  var comments  = item.comments;
                 }

                 var booked_by=item.booked_by;
                 
                 var delete_icon ='<a href="javascript:" id='+item.id+' onclick="delete_appointment('+item.id+')" class="dc-deleteinfo dc-actionbtn"><delete :title="{{trans("lang.ph.delete_confirm_title")}}"  :message="{{trans("lang.user_deleted")}}" :url="'+base+'admin/online-appointment/delete" :redirect_url="'+base+'admin/all-appointment"></delete><i class="lnr lnr-trash"></i></a>';
               table.row.add([ 
                doctor_name,
                patient_name,
                patient_number,
                hospital_name,
                speciality,
                city,
                appointment_date,
                created_at,
                charges,
                delete_icon,
                status,
                type,
                comments,
                booked_by,
                status_action,
                        
                ]);
               });
                 table.draw();

               
               

            },
         });

            }
      });
     $('input[type=search]').on('input', function (e) {
        var check=$(this).val();
        if(''===check)
        {
            window.location.reload(true);
        }
});
      $(document).on('click', '.next', function () {
            var clickCount =localStorage.getItem('clickCount');
            var url      = window.location.href;
            var base      = window.location.origin;
            var request_type=url.split('/');
            request_type=request_type[4];
            $.ajax({
               type: "GET",
               url: base+'/admin/'+request_type,
               data:{'clickCount':clickCount, 'type':request_type,},
               dataType: "json",
               success: function (response) {
                 $(".next").removeAttr("disabled");
               localStorage. setItem('clickCount', response[1]);
               var status_action='';
                 $.each(response[0], function(i, item) {
                if(item.user_id === null){
                   var doctor_name = '';
                   var speciality = '';
                 }
                 else{
                  var doctor_name = item.doctor_profile.first_name+' '+item.doctor_profile.last_name;
                  var speciality = item.doctor_profile.specialities[0].title;
                 }

               if(item.patient_id === null){
                   var patient_name = '';
                   var patient_number='';
                 }
                 else{
                  var patient_name = item.patient_profile.first_name+' '+item.patient_profile.last_name;
                  var patient_number = item.patient_profile.phone_number;
                 }
                 if(item.hospital_id === null){
                   var hospital_name = '';
                   var city = '';
                 }
                 else{
                  var hospital_name = item.hospital_profile.first_name+' '+item.hospital_profile.last_name;
                  var city = item.hospital_profile.location.title;
                 }
                 if(item.appointment_time === null){
                   var appointment_time = '';
                 }
                 else{
                  var appointment_time = item.appointment_time;

                 }
                 if(item.appointment_date === null){
                   var appointment_date = '';
                 }
                 else{
                  var appointment_date = item.appointment_date+' '+appointment_time;

                 }
                 if(item.created_at === null){
                   var created_at = '';
                 }
                 else{
                  var created_at = item.created_at;
                 }
                 if(item.charges === null){
                   var charges = '';
                 }
                 else{
                  var charges = item.charges;

                 }
                 
               
                 if(item.status === null){
                   var status = '';
                   status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="accepted">Accept</option><option value="cancelled">Cancel</option><option value="completed">Completed</option></select></div></div>'
                 }
                 else{
                  var status = item.status;
                    if(item.status == 'completed')
                    {
                      status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="pending">Decline</option></select></div></div>'
                    }
                    else if(item.status == 'accepted')
                    {
                       status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="pending">Decline</option><option value="cancelled">Cancel</option><option value="completed">Completed</option></select></div></div>'
                    }
                    else if (item.status == 'cancelled')
                    {
                        status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="pending">Decline</option><option value="accepted">Accept</option><option value="completed">Completed</option></select></div></div>'
                    }
                    else
                    {
                        status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="accepted">Accept</option><option value="cancelled">Cancel</option><option value="completed">Completed</option></select></div></div>'
                    }

                 }
                 if(item.type === null){
                   var type = '';
                 }
                 else{
                  var type = item.type;
                 }
                 if(item.comments  === null){
                   var comments  = '';
                 }
                 else{
                  var comments  = item.comments;
                 }

                 var booked_by=item.booked_by;
                 
                 var delete_icon ='<a href="javascript:" id='+item.id+' onclick="delete_appointment('+item.id+')" class="dc-deleteinfo dc-actionbtn"><delete :title="{{trans("lang.ph.delete_confirm_title")}}"  :message="{{trans("lang.user_deleted")}}" :url="'+base+'admin/online-appointment/delete" :redirect_url="'+base+'admin/all-appointment"></delete><i class="lnr lnr-trash"></i></a>';
               table.row.add([ 
                doctor_name,
                patient_name,
                patient_number,
                hospital_name,
                speciality,
                city,
                appointment_date,
                created_at,
                charges,
                delete_icon,
                status,
                type,
                comments,
                booked_by,
                status_action,
                        
                ]);
               });
                 table.draw();
               
            },
         });
    });
   
    });
    $('#loading').hide();
               $(document)
                     .ajaxStart(function () {
                        //ajax request went so show the loading image
                         $('#loading').show();
                     })
                   .ajaxStop(function () {
                       //got response so hide the loading image
                        $('#loading').hide();
                    });
    
    $( window ).load(function() {
      $('.next').addClass('next_button');
    });
</script>
<script type="text/javascript">
function selectedFilter(value)
{
    var selectedOption=value;
    localStorage.setItem('selectedOption',selectedOption);
   
}
</script>
<script type="text/javascript">
function showDropDown(id,value)
{
    var value=value;
    var base  = window.location.origin;
    var table = $('#online_appointment_table').DataTable();
    var url  = window.location.href;
    var request_type=url.split('/');  
    request_type=request_type[4];

    $.ajaxSetup({
                   headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
    $.ajax({
            type: "POST",
            url: base+"/admin/changes-appointment-status",
            data:{'type':request_type,'selected':value,'id':id},
            dataType: "json",
            success: function (response){
                var status_action='';
              table.clear().draw();
               $.each(response, function(i, item) {
                if(item.user_id === null){
                   var doctor_name = '';
                   var speciality = '';
                 }
                 else{
                  var doctor_name = item.doctor_profile.first_name+' '+item.doctor_profile.last_name;
                  var speciality = item.doctor_profile.specialities[0].title;
                 }

               if(item.patient_id === null){
                   var patient_name = '';
                 }
                 else{
                  var patient_name = item.patient_profile.first_name+' '+item.patient_profile.last_name;

                 }
                 if(item.hospital_id === null){
                   var hospital_name = '';
                   var city = '';
                 }
                 else{
                  var hospital_name = item.hospital_profile.first_name+' '+item.hospital_profile.last_name;
                  var city = item.hospital_profile.location.title;
                 }
                 if(item.appointment_time === null){
                   var appointment_time = '';
                 }
                 else{
                  var appointment_time = item.appointment_time;

                 }
                 if(item.appointment_date === null){
                   var appointment_date = '';
                 }
                 else{
                  var appointment_date = item.appointment_date+' '+appointment_time;

                 }
                 if(item.created_at === null){
                   var created_at = '';
                 }
                 else{
                  var created_at = item.created_at;
                 }
                 if(item.charges === null){
                   var charges = '';
                 }
                 else{
                  var charges = item.charges;

                 }
                 
               
                 if(item.status === null){
                   var status = '';
                   status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="accepted">Accept</option><option value="cancelled">Cancel</option><option value="completed">Completed</option></select></div></div>'
                 }
                 else{
                  var status = item.status;
                    if(item.status == 'completed')
                    {
                      status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="pending">Decline</option></select></div></div>'
                    }
                    else if(item.status == 'accepted')
                    {
                       status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="pending">Decline</option><option value="cancelled">Cancel</option><option value="completed">Completed</option></select></div></div>'
                    }
                    else if (item.status == 'cancelled')
                    {
                        status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="pending">Decline</option><option value="accepted">Accept</option><option value="completed">Completed</option></select></div></div>'
                    }
                    else
                    {
                        status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="accepted">Accept</option><option value="cancelled">Cancel</option><option value="completed">Completed</option></select></div></div>'
                    }

                 }
                 if(item.type === null){
                   var type = '';
                 }
                 else{
                  var type = item.type;
                 }
                 if(item.comments  === null){
                   var comments  = '';
                 }
                 else{
                  var comments  = item.comments;
                 }

                 var booked_by=item.booked_by;
                 
                 var delete_icon ='<a href="javascript:" id='+item.id+' onclick="delete_appointment('+item.id+')" class="dc-deleteinfo dc-actionbtn"><delete :title="{{trans("lang.ph.delete_confirm_title")}}"  :message="{{trans("lang.user_deleted")}}" :url="'+base+'admin/online-appointment/delete" :redirect_url="'+base+'admin/all-appointment"></delete><i class="lnr lnr-trash"></i></a>';
               table.row.add([ 
                doctor_name,
                patient_name,
                hospital_name,
                speciality,
                city,
                appointment_date,
                created_at,
                charges,
                delete_icon,
                status,
                type,
                comments,
                booked_by,
                status_action,
                        
                ]);
               });
                 table.draw();
            },
    });

}
</script>
<script type="text/javascript">
    $('[data-countdown]').each(function() {
  var $this = $(this), finalDate = $(this).data('countdown');
  $this.countdown(finalDate, function(event) {
    $this.html(event.strftime('%D days %H:%M:%S'));
  });
});
</script>

<style>
        .dataTables_wrapper .dataTables_filter input::-webkit-search-cancel-button {
  -webkit-appearance: button !important;
}
 #loading{
      position: fixed;
    z-index: 9990;
    background: #ffffff;
    left: 220px;
    top: 76px;
    bottom: 0;
    right: 0;
    text-align: center;
   }
   #loading img{
    width: 10%;
    margin-top: 150px;
   }
    .table-pagination span svg{
        width: 20px;
    }
     .table-pagination span .bg-white{
        display:inherit;
    }
    .justify-between .bg-white{
       display:none; 
    }
    .table-pagination p{
        width: 100%;
        float: left;
    }
   .table-pagination .shadow-sm{
    float: right;
    display:flex;
    }
    .table-pagination .text-sm{
        font-size: inherit !important;
    }
    .input-table-search input{
        border-radius: 31px;
    border: 1px solid #ea4335;
    }
    .input-table-search .form-control:focus {
    border-color: #ea4335;
}
</style>
@endpush
