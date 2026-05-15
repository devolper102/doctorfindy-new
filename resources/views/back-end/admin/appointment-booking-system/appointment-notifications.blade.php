@extends('back-end.master')
@push('backend_stylesheets')
<style type="text/css">
#online_appointment_table thead tr th{
    min-width: 190px !important;
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
  <div class="main-section mt-5">
                        
                       
                        @if ($appointments->count() > 0)
                        <div class="col-md-12">
                        
                            <!-- Recent Orders -->
                            <div class="card card-table">
                                <div class="card-header">
                                    <h4 class="card-title">Appointment Notifications</h4>
                                </div>
                                <div class="card-body">
                                    <div class="online-appointment-main">
                                        <table class="table table-bordered table-hover dt-responsive nowrap table-responsive" id="notifications_appointment_table">
                                            <thead>
                                                <tr>
                                                    <th>Doctor Name</th>
                                                    <th>Hospital Name</th>
                                                    <th>Patient Name</th>
                                                    <th>Patient Phone</th>
                                                    <th>Speciality</th> 
                                                    <th>Apointment Time</th>
                                                    <th class="text-right">Amount</th>
                                                    <th class="none">Status</th>
                                                    <th class="none">Type</th>
                                                    <th>Notification</th>
                                                    <th class="none">Booked by</th>
                                                     <th>Mark Notification</th>
                                                    <th>Created at</th>
                                                    <th>Updated at</th>
                                                   
                                                </tr>
                                            </thead>
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
                                                    {{$appointment->status}}
                                                        
                                                    </td>
                                                      <td>
                                                        {{$appointment->type}}
                                                    </td>

                                                    @if($appointment->booked_by == 'call-center')
                                                    <td>{{Helper::getUserData($app_patient->id)}} booked appointment through call center</td>
                                                    @else
                                                    <td>{{Helper::getUserData($app_patient->id)}} booked appointment from Doctorfindy</td>
                                                    @endif
                                                 
                                                    
                                                    <td>{{$appointment->booked_by}}</td>

                                @php
                                $notification_status=DB::table('appointment_notification')->select('admin_alert')->where('appointment_id',$appointment->id)->first();
                                    
                                    @endphp

                                                <td>

                                                <div class="col-lg-4 col-12">
                                                <div class="dateMain">
                                                <select class="center" onchange="MarkAsRead({{$appointment->id}},this.value)">
                                                     <option value="none" selected="selected">Mark Notification</option>

                                                     @if($notification_status->admin_alert == 'unread' || $notification_status->admin_alert == 'notification-send')
                                                        <option value="read">Mark Read</option>
                                                     @endif

                                                     @if($notification_status->admin_alert == 'read')
                                                        <option value="unread">Mark UnRead</option>
                                                    @endif
                                                         
                                                     </select>
                                                      </div>
                                                   </div>
                                                      
                                                </td>

                                                    <td class="">{{{ clean(@$appointment->created_at->format('M d, Y, h:i A')) }}}</td>

                                                    <td class="">{{{ clean(@$appointment->updated_at->format('M d, Y, h:i A')) }}}</td>
                                   

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
     
      jQuery(document).ready(function() {
        jQuery('#notifications_appointment_table').DataTable( {
        "order": [],
    } );
      } );

</script>
<script type="text/javascript">
 $(document).ready(function() {
      localStorage. setItem('clickCount', 1);
       var table = $('#notifications_appointment_table').DataTable();
      $(document).on('click', '.next', function () {
            var clickCount =localStorage.getItem('clickCount');
            var url      = window.location.href;
            var base      = window.location.origin;

            $.ajax({
               type: "GET",
               url: url,
               data:{'clickCount':clickCount},
               // contentType: "application/json; charset=utf-8",
               dataType: "json",
               success: function (response) {
                 $(".next").removeAttr("disabled");
               localStorage. setItem('clickCount', response[1]);
               $.each(response[0], function(i, item) {
                   var id=item.id;
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
                    
                  }
                  else
                  {
                    var charges='';
                  }
                  if(item.status!==null)
                  {
                    var appointment_status=item.status;
                   
                  }
                 
                  if(item.type!==null)
                  {
                    var type=item.type;
                  }
                  else
                  {
                    var type='';
                  }
                  if(item.booked_by === 'call-center')
                  {
                     var notification=patient_name+'booked appointment through call center';
                     
                  }
                  else
                  {
                     var notification=patient_name+'booked appointment through doctorfindy.com';
                  }
                  var status=item.status;
                  var marked='Helper::getAppointmentNotificationById(item.id)';

                  if(marked === 'read')
                  {
                     var action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="MarkAsRead('+item.id+',value)"><option value="none" selected="selected">Mark Notification</option><option value="unread">Mark as UnRead</option></div></div>'
                  }
                  else
                  {
                     var action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="MarkAsRead('+item.id+',value)"><option value="none" selected="selected">Mark Notification</option><option value="read">Mark as Read</option></div></div>'
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
                      status,
                      type,
                      notification,
                      booked_by,
                      action,
                      item.created_at,
                      item.updated_at,
                     ]);                    

         }); 

                 
                 table.draw();
               
            },
         });
    });
   
    });
    
    $( window ).load(function() {
      $('.next').addClass('next_button');
    });
</script>
<script type="text/javascript">
    function MarkAsRead(id,value) {
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
                url: base+"/admin/mark-appointment-notification",
                data:{'type':request_type,'selected':value,'id':id},
                dataType: "json",
                success: function (response){

                    table.clear().draw();
               $.each(response, function(i, item) {
                   var id=item.id;
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
                    
                  }
                  else
                  {
                    var charges='';
                  }
                  if(item.status!==null)
                  {
                    var appointment_status=item.status;
                   
                  }
                 
                  if(item.type!==null)
                  {
                    var type=item.type;
                  }
                  else
                  {
                    var type='';
                  }
                  if(item.booked_by === 'call-center')
                  {
                     var notification=patient_name+'booked appointment through call center';
                     
                  }
                  else
                  {
                     var notification=patient_name+'booked appointment through doctorfindy.com';
                  }
                  var status=item.status;
                  var marked='Helper::getAppointmentNotificationById(item.id)';

                  if(marked === 'read')
                  {
                     var action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="MarkAsRead('+item.id+',value)"><option value="none" selected="selected">Mark Notification</option><option value="unread">Mark as UnRead</option></div></div>'
                  }
                  else
                  {
                     var action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="MarkAsRead('+item.id+',value)"><option value="none" selected="selected">Mark Notification</option><option value="read">Mark as Read</option></div></div>'
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
                      status,
                      type,
                      notification,
                      booked_by,
                      action,
                      item.created_at,
                      item.updated_at,
                     ]);                    

         }); 
                 table.draw();

                },

             });
    }
</script>
@endpush
