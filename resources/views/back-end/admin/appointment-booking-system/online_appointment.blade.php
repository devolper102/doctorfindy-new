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
                                    <h4 class="card-title">Online Appointments</h4>
                                </div>
                                <div class="card-body">
                                    <div class="online-appointment-main">
                                        <table class="table table-bordered table-hover dt-responsive nowrap"id="online_appointment_table table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>Doctor Name</th>
                                                    <th>Patient Name</th>
                                                    <th>Speciality</th> 
                                                    <th>Apointment Time</th>
                                                    <th class="text-right">Amount</th>
                                                    <th class="none">Status</th>
                                                    <th class="none">Type</th>
                                                    <th class="none">Comments</th>
                                                    <th class="none">Booked by</th>
                                                    <th class="none">Created at</th>
                                                    <th class="none">Updated at</th>
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
                        @php

                            $app_patient = App\User::where('id',$appointment->patient_id)->with('profile')->first();

                        @endphp                       
                                                    <td>
                                                            <b>{{Helper::getUserData($app_patient->id)}}</b>
                                                    </td>        
                                                    <td>Anesthesiology</td>

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
                                                 
                                                    <td>
                                                        {!!$appointment->comments!!}
                                                    </td>
                                                    <td>{{$appointment->booked_by}}</td>

                                                    <td>{{$appointment->created_at}}</td>

                                                    <td>{{$appointment->updated_at}}</td>
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
        jQuery('#online_appointment_table').DataTable( {
        "order": []
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

                  var booked_by=item.booked_by;

                     table.row.add([ 
                      doctor_name, 
                      patient_name,
                      speciality,
                      appointment_time,
                      charges,
                      status,
                      type,
                      booked_by,
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
@endpush
