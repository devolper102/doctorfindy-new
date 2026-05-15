@extends('back-end.master')
@push('backend_stylesheets')
<style type="text/css">
	
</style>

@endpush
@section('content')
@php
$appoints=$appointments;
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
  <div class="row">
                        
                       
                        @if ($appointments->count() > 0)
                        <div class="col-md-12">
                        
                            <!-- Recent Orders -->
                            <div id="visit_appointment_main" class="card card-table">
                                <div class="card-header w-10 
                                d-inline-block">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="appointment-heading w-100 d-inline-block mt-3">
                                    <h4 class="card-title">Visit Appointments</h4>
                                </div>
                                    </div>
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
                                <div class="card-body">
                                        <table class="table table-bordered table-hover dt-responsive nowrap table-responsive"id="visit_appointment_table">
                                           
                                            <thead>
                                                <tr>
                                                    <th>Doctor Name</th>
                                                    <th>Hospital Name</th>
                                                    <th>Patient Name</th>
						    <th>Patient Phone # </th>
                                                     <th>Speciality</th> 
                                                    <th>Apointment Time</th>
                                                    <th class="text-right">Amount</th>
                                                    <th class="action">{{{ trans('lang.action') }}}</th>
                                                    <th class="none">Status</th>
                                                    <th class="none">Type</th>
                                                    <th class="none">Comments</th>
                                                    <th class="none">Booked by</th>
                                                    <th class="none">Appointment Status</th>
                                                    <th class="none">Edit Appointment</th>


                                                </tr>
                                            </thead>
                                            <div id="loading">
                                                 <img src="{{asset('images/loader/loader.gif')}}" />  
                                            </div>
                                            <tbody>
                                                @foreach($appointments as  $key => $appointment)

                                                <tr>
                        @php
                            $app_doctor = App\User::where('id',$appointment->user_id)->with('profile')->first();
                            
                        @endphp

                                                    <td>
                                                            <a href="/profile/{{clean($app_doctor->slug)}}">{{Helper::getUserData($app_doctor->id)}}</a>
                                                    </td>
						    
                        @php
                            $app_hospital = App\User::where('id',$appointment->hospital_id)->with('profile')->first();
                            
                        @endphp                        
                                                     <td>
                                                            <a href="/profile/{{clean($app_hospital->slug)}}">{{Helper::getUserData($app_hospital->id)}}</a>
                                                    </td>  
                        @php

                            $app_patient = App\User::where('id',$appointment->patient_id)->with('profile')->first();

                        @endphp            

                                                    <td>
                                                            <b>{{Helper::getUserData($app_patient->id)}}</b>
                                                    </td> 
						    <td>
                                                        {{Helper::getUserPhonumber($app_patient->id)}}
                                                    </td> 
                                                    @if($appointment->doctor_profile->specialities) 
                                                    <td>{{$appointment->doctor_profile->specialities[0]->title}}</td>
                                                    @else
                                                    <td>-</td>
                                                    @endif

                                                    <td>{{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}}<span class="text-primary d-block">{{$appointment->appointment_time}}</span></td>
                                                   <td class="text-right">
                                                        Rs{{$appointment->charges}}
                                                    </td>
                                                    <td>
                                                    <div class="dc-actionbtn">
                                                        <a href="{{ route('adminEditUser',$appointment->doctor_profile->id) }}" class="dc-addinfo dc-skillsaddinfo">
                                                          <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                        <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ $appointment->id }}'" :message="'{{'Visit Apointment Deleted Successfully'}}'" :url="'{{url('admin/visit-appointment/delete')}}'" :redirect_url="'{{url('admin/visit-appointment')}}'"></delete>
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
                                 @if($appointment->status == 'accepted' || $appointment->status == 'cancelled')
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
                                        <td>
                                            <div class="dc-actionbtn">
                                                <a href="{{ route('edit-appointment-details',$appointment->id) }}" class="dc-addinfo dc-skillsaddinfo">
                                                          <i class="lnr lnr-pencil"></i>
                                                        </a>
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
 $(document).ready(function() {
      localStorage. setItem('clickCount', 1);
      localStorage. setItem('selectedOption', 'search-by-patient');
       // $('.next').addClass('next_button');
       var table = $('#visit_appointment_table').DataTable({
        "order": [[10, "desc"]]
       });
       var check_box='';
       $('.dataTables_filter').find('input').addClass("search_field");
      $(document).on('keyup','.search_field',function(){
            
            var search_value =$(this).val();
            var selectedOptionFilter=localStorage.getItem('selectedOption');
            var url      = window.location.href;
            var base      = window.location.origin;
            var status = '';
            var action='';
            var recommend_status='';
            var recommend_action='';
            var request_type=url.split('/'); 
            request_type=request_type[4];
            $.ajax({
               type: "GET",
               url: base+"/visit-appointment-search",
               data:{'type':request_type,'search':search_value ,'selected':selectedOptionFilter},
               // contentType: "application/json; charset=utf-8",
               dataType: "json",
               success: function (response) {
                var status_action='';
               table.clear().draw();
               console.log('reda',response);
               if(response[1] !== 'search-by-patient')
               {
                 $.each(response[0], function(i, item) {
                    if(item.user_id!==null)
                  {
                    if(item.doctor_profile!==null)
                    {
                       if(item.user_id===item.doctor_profile.id)
                    {
                        var doctor_name=item.doctor_profile.first_name+''+item.doctor_profile.last_name;
                    } 
                    }
                    else
                    {
                        var doctor_name='-';
                    }
                    
                  }
                  if(item.hospital_id!==null)
                  {
                    if(item.hospital_profile!==null)
                    {
                        if(item.hospital_id===item.hospital_profile.id)
                    {
                        var hospital_name=item.hospital_profile.first_name+''+item.hospital_profile.last_name;


                    }
                    }
                    else
                    {
                        var hospital_name='-';
                    }
                    
                  }
                  if(item.patient_id!==null)
                  {
                    if(item.patient_id===item.patient_profile.id)
                    {
                        var patient_name=item.patient_profile.first_name+''+item.patient_profile.last_name;
                        var patient_number=item.patient_profile.phone_number;
                    }
                  }
                  if($.isEmptyObject(item.doctor_profile.specialities))
                  {
                    var speciality='-';
                  }
                  else
                  {
                    var speciality=item.doctor_profile.specialities[0].title;
                  }
                  

                  if(item.appointment_date!==null)
                  {
                    var appointment_date=item.appointment_date;
                  }
                  if(item.appointment_time!==null)
                  {

                    var appointment_time=appointment_date+' '+item.appointment_time;
                  }
                   if(item.charges!==null)
                  {
                    var charges=item.charges;
                    var del_id=item.id;
                    var action='<delete :title="{{trans("lang.ph_delete_confirm_title")}}" :id="'+del_id+'" :message="{{"Visit Apointment Deleted Successfully"}}" :url="admin/visit-appointment/delete" :redirect_url="admin/visit-appointment"></delete>';
                    
                  }
                  else
                  {
                    var charges='';
                    var del_id=item.id;
                    var action='<delete :title="{{trans("lang.ph_delete_confirm_title")}}" :id="'+del_id+'" :message="{{"Visit Apointment Deleted Successfully"}}" :url="admin/visit-appointment/delete" :redirect_url="admin/visit-appointment"></delete>';
                  }
                  if(item.status!==null)
                  {
                    var appointment_status=item.status;
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
                  else
                  {
                    var appointment_status='pending';
                    status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="accepted">Accept</option><option value="cancelled">Cancel</option><option value="completed">Completed</option></select></div></div>'
                  }
                  if(item.type!==null)
                  {
                    var type=item.type;
                  }
                  else
                  {
                    var type='';
                  }
                  
                   if(item.comments!==null)
                  {
                    var appointment_comments=item.comments;
                  }
                  else
                  {
                    var appointment_comments='No comments';
                  }
                  var booked_by=item.booked_by;

                   table.row.add([ 
                      doctor_name, 
                      hospital_name,
                      patient_name,
                      patient_number,
                      speciality,
                      appointment_time,
                      charges,
                      action,
                      status,
                      type,
                      appointment_comments,
                      booked_by,
                      status_action,
                     ]);                    

         }); 
                 table.draw();

               }
               else
               {
                  $.each(response[0], function(i, item) {
                    if(item.user_id!==null)
                  {
                    if(item.user!==null)
                    {
                       if(item.user_id===item.user.id)
                    {
                        var doctor_name=item.user.first_name+''+item.user.last_name;
                    } 
                    }
                    else
                    {
                        var doctor_name='-';
                    }
                    
                  }
                  if(item.hospital_id!==null)
                  {
                    if(item.hospital_profile!==null)
                    {
                        if(item.hospital_id===item.hospital_profile.id)
                    {
                        var hospital_name=item.hospital_profile.first_name+''+item.hospital_profile.last_name;


                    }
                    }
                    else
                    {
                        var hospital_name='-';
                    }
                    
                  }
                  if(item.patient_id!==null)
                  {
                    if(item.patient_id===item.patient_profile.id)
                    {
                        var patient_name=item.patient_profile.first_name+''+item.patient_profile.last_name;
                        var patient_number=item.patient_profile.phone_number;
                    }
                  }
                  var speciality='-';



                  if(item.appointment_date!==null)
                  {
                    var appointment_date=item.appointment_date;
                  }
                  if(item.appointment_time!==null)
                  {

                    var appointment_time=appointment_date+' '+item.appointment_time;
                  }
                   if(item.charges!==null)
                  {
                    var charges=item.charges;
                    var del_id=item.id;
                    var action='<delete :title="{{trans("lang.ph_delete_confirm_title")}}" :id="'+del_id+'" :message="{{"Visit Apointment Deleted Successfully"}}" :url="admin/visit-appointment/delete" :redirect_url="admin/visit-appointment"></delete>';
                    
                  }
                  else
                  {
                    var charges='';
                    var del_id=item.id;
                    var action='<delete :title="{{trans("lang.ph_delete_confirm_title")}}" :id="'+del_id+'" :message="{{"Visit Apointment Deleted Successfully"}}" :url="admin/visit-appointment/delete" :redirect_url="admin/visit-appointment"></delete>';
                  }
                  if(item.status!==null)
                  {
                    var appointment_status=item.status;
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
                  else
                  {
                    var appointment_status='pending';
                    status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="accepted">Accept</option><option value="cancelled">Cancel</option><option value="completed">Completed</option></select></div></div>'
                  }
                  if(item.type!==null)
                  {
                    var type=item.type;
                  }
                  else
                  {
                    var type='';
                  }
                  
                   if(item.comments!==null)
                  {
                    var appointment_comments=item.comments;
                  }
                  else
                  {
                    var appointment_comments='No comments';
                  }
                  var booked_by=item.booked_by;

                   table.row.add([ 
                      doctor_name, 
                      hospital_name,
                      patient_name,
                      patient_number,
                      speciality,
                      appointment_time,
                      charges,
                      action,
                      appointment_status,
                      type,
                      appointment_comments,
                      booked_by,
                      status_action,
                     ]);                    

         }); 
                 table.draw();


               }
               
               

            },
         });
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
            var status = '';
            var recommend_status='';
            var recommend_action='';
            var action='';
            // console.log(url,request_type,base); 
            $.ajax({
               type: "GET",
               url: url,
               data:{'clickCount':clickCount},
               // contentType: "application/json; charset=utf-8",
               dataType: "json",
               success: function (response) {
                var status_action='';
                 $(".next").removeAttr("disabled");
               localStorage. setItem('clickCount', response[1]);
                 $.each(response[0], function(i, item) {
                    if(item.user_id!==null)
                  {
                    if(item.doctor_profile!==null)
                    {
                       if(item.user_id===item.doctor_profile.id)
                    {
                        var doctor_name=item.doctor_profile.first_name+''+item.doctor_profile.last_name;
                    } 
                    }
                    else
                    {
                        var doctor_name='-';
                    }
                    
                  }
                  if(item.hospital_id!==null)
                  {
                    if(item.hospital_profile!==null)
                    {
                        if(item.hospital_id===item.hospital_profile.id)
                    {
                        var hospital_name=item.hospital_profile.first_name+''+item.hospital_profile.last_name;


                    }
                    }
                    else
                    {
                        var hospital_name='-';
                    }
                    
                  }
                  if(item.patient_id!==null)
                  {
                    if(item.patient_id===item.patient_profile.id)
                    {
                        var patient_name=item.patient_profile.first_name+''+item.patient_profile.last_name;
                        var patient_number=item.patient_profile.phone_number;
                    }
                  }
                  if($.isEmptyObject(item.doctor_profile.specialities))
                  {
                    var speciality='-';
                  }
                  else
                  {
                    var speciality=item.doctor_profile.specialities[0].title;
                  }

                  if(item.appointment_date!==null)
                  {
                    var appointment_date=item.appointment_date;
                  }
                  if(item.appointment_time!==null)
                  {

                    var appointment_time=appointment_date+' '+item.appointment_time;
                  }
                   if(item.charges!==null)
                  {
                    var charges=item.charges;
                    var del_id=item.id;
                    var action='<delete :title="{{trans("lang.ph_delete_confirm_title")}}" :id="'+del_id+'" :message="{{"Visit Apointment Deleted Successfully"}}" :url="admin/visit-appointment/delete" :redirect_url="admin/visit-appointment"></delete>';
                    
                  }
                  else
                  {
                    var charges='';
                    var del_id=item.id;
                    var action='<delete :title="{{trans("lang.ph_delete_confirm_title")}}" :id="'+del_id+'" :message="{{"Visit Apointment Deleted Successfully"}}" :url="admin/visit-appointment/delete" :redirect_url="admin/visit-appointment"></delete>';
                  }
                  if(item.status!==null)
                  {
                    var appointment_status=item.status;
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
                  else
                  {
                    var appointment_status='pending';
                    status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="accepted">Accept</option><option value="cancelled">Cancel</option><option value="completed">Completed</option></select></div></div>'
                  }
                  if(item.type!==null)
                  {
                    var type=item.type;
                  }
                  else
                  {
                    var type='';
                  }
                  
                   if(item.comments!==null)
                  {
                    var appointment_comments=item.comments;
                  }
                  else
                  {
                    var appointment_comments='No comments';
                  }
                  var booked_by=item.booked_by;

                   table.row.add([ 
                      doctor_name, 
                      hospital_name,
                      patient_name,
                      patient_number,
                      speciality,
                      appointment_time,
                      charges,
                      action,
                      appointment_status,
                      type,
                      appointment_comments,
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
    var table = $('#visit_appointment_table').DataTable();
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
                    if(item.user_id!==null)
                  {
                    if(item.doctor_profile!==null)
                    {
                       if(item.user_id===item.doctor_profile.id)
                    {
                        var doctor_name=item.doctor_profile.first_name+''+item.doctor_profile.last_name;
                    } 
                    }
                    else
                    {
                        var doctor_name='-';
                    }
                    
                  }
                  if(item.hospital_id!==null)
                  {
                    if(item.hospital_profile!==null)
                    {
                        if(item.hospital_id===item.hospital_profile.id)
                    {
                        var hospital_name=item.hospital_profile.first_name+''+item.hospital_profile.last_name;


                    }
                    }
                    else
                    {
                        var hospital_name='-';
                    }
                    
                  }
                  if(item.patient_id!==null)
                  {
                    if(item.patient_id===item.patient_profile.id)
                    {
                        var patient_name=item.patient_profile.first_name+''+item.patient_profile.last_name;
                        var patient_number=item.patient_profile.phone_number;
                    }
                  }

                  if($.isEmptyObject(item.doctor_profile.specialities))
                  {
                    var speciality='-';
                  }
                  else
                  {
                    var speciality=item.doctor_profile.specialities[0].title;
                  }

                  if(item.appointment_date!==null)
                  {
                    var appointment_date=item.appointment_date;
                  }
                  if(item.appointment_time!==null)
                  {

                    var appointment_time=appointment_date+' '+item.appointment_time;
                  }
                   if(item.charges!==null)
                  {
                    var charges=item.charges;
                    var del_id=item.id;
                    var action='<delete :title="{{trans("lang.ph_delete_confirm_title")}}" :id="'+del_id+'" :message="{{"Visit Apointment Deleted Successfully"}}" :url="admin/visit-appointment/delete" :redirect_url="admin/visit-appointment"></delete>';
                    
                  }
                  else
                  {
                    var charges='';
                    var del_id=item.id;
                    var action='<delete :title="{{trans("lang.ph_delete_confirm_title")}}" :id="'+del_id+'" :message="{{"Visit Apointment Deleted Successfully"}}" :url="admin/visit-appointment/delete" :redirect_url="admin/visit-appointment"></delete>';
                  }
                  if(item.status!==null)
                  {
                    var appointment_status=item.status;
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
                  else
                  {
                    var appointment_status='pending';
                    status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="accepted">Accept</option><option value="cancelled">Cancel</option><option value="completed">Completed</option></select></div></div>'
                  }
                  if(item.type!==null)
                  {
                    var type=item.type;
                  }
                  else
                  {
                    var type='';
                  }
                  
                   if(item.comments!==null)
                  {
                    var appointment_comments=item.comments;
                  }
                  else
                  {
                    var appointment_comments='No comments';
                  }
                  var booked_by=item.booked_by;

                   table.row.add([ 
                      doctor_name, 
                      hospital_name,
                      patient_name,
                      patient_number,
                      speciality,
                      appointment_time,
                      charges,
                      action,
                      appointment_status,
                      type,
                      appointment_comments,
                      booked_by,
                      status_action,
                     ]);                    

         }); 
                 table.draw();
            },
    });

}
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
