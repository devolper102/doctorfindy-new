@extends('back-end.master')
@section('content')
@include('includes.pre-loader')
<link href="{{ asset('css/morris.css') }}" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://code.jquery.com/jquery-1.8.2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<style>
   .morris-hover {
   position:absolute;
   z-index:9;
   }
   .morris-hover.morris-default-style {     border-radius:10px;
   padding:6px;
   color:#666;
   background:rgba(255, 255, 255, 0.8);
   border:solid 2px rgba(230, 230, 230, 0.8);
   font-family:sans-serif;
   font-size:12px;
   text-align:center;
   }
   .morris-hover.morris-default-style .morris-hover-row-label {
   font-weight:bold;
   margin:0.25em 0;
   }
   .morris-hover.morris-default-style .morris-hover-point {
   white-space:nowrap;
   margin:0.1em 0;
   }
   svg { width: 100%; }
   .card {
   border: 1px solid #f0f0f0;
   margin-bottom: 1.875rem;
   }
   .dash-count {
   font-size: 18px;
   margin-left: auto;
   }
   .dash-widget-header {
   align-items: center;
   display: flex;
   margin-bottom: 15px;
   }
   .progress.progress-sm {
   height: 6px;
   }
   h1,h2,h3,h4,h5,h6{
   font-weight: 400 !important;
   }
   .dash-widget-icon {
   align-items: center;
   display: inline-flex;
   font-size: 1.875rem;
   height: 50px;
   justify-content: center;
   line-height: 48px;
   text-align: center;
   width: 50px;
   border: 3px solid;
   border-radius: 50px;
   padding: 28px;
   }
   .border-primary {
   border-color: #00d0f1!important;
   }
   .text-success{
   color: #699834 !important;
   }
   table.table td h2.table-avatar {
   align-items: center;
   display: inline-flex;
   font-size: inherit;
   font-weight: 400;
   margin: 0;
   padding: 0;
   vertical-align: middle;
   white-space: nowrap;
   }
   table.table td h2 a {
   color: #333;
   font-size: 14px;
   }
   .avatar-sm {
   width: 2.5rem;
   height: 2.5rem;
   }
   .avatar {
   position: relative;
   display: inline-block;
   width: 2.5rem;
   height: 2.5rem;
   }
   .avatar > img {
   width: 100%;
   height: 100%;
   object-fit: contain;
   }
   /*.card-table .card-body .table tr td:first-child, .card-table .card-body .table tr th:first-child {
   padding-left: 1.5rem;
   }*/
   .dashboard_table{
   padding: 0px;
   }
   .card-table .table th {
   font-size: 14px;
   }
   .card-table .table td, .card-table .table th {
   border-top: 1px solid #e2e5e8;
   padding: 1rem 0.75rem;
   white-space: nowrap !important;
   }
   .table.table-center td, .table.table-center th {
   vertical-align: middle;
   text-align: left;
   font-size: 14px;
   }
   .table.table-center td i{
   font-size: 10px;
   }
   .check {
   position: absolute;
   display: block;
   margin: 0;
   padding: 0;
   width: 0;
   height: 0;
   visibility: hidden;
   opacity: 0;
   pointer-events: none;
   box-sizing: border-box;
   }
   .checktoggle {
   background-color: #e0001a;
   border-radius: 12px;
   cursor: pointer;
   display: block;
   font-size: 0;
   height: 24px;
   margin-bottom: 0;
   position: relative;
   width: 48px;
   }
   .check:checked + .checktoggle {
   background-color: #55ce63;
   }
   .check:checked + .checktoggle:after {
   left: 100%;
   transform: translate(calc(-100% - 5px), -50%);
   }
   .checktoggle:after {
   content: ' ';
   display: block;
   position: absolute;
   top: 50%;
   left: 0;
   transform: translate(5px, -50%);
   width: 16px;
   height: 16px;
   background-color: #fff;
   border-radius: 50%;
   transition: left 300ms ease, transform 300ms ease;
   }
   @media (max-width: 766px){
   .page-title{
   font-size: 22px;
   margin: 10px;
   }
</style>
<div class="content container-fluid" id="super-dashboard">
    @if (Session::has('message'))
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
            </div>
     @endif
   <div class="page-header">
         
      <div class="row">
         <div class="col-sm-12">
            <h3 class="page-title text-center">Welcome Admin!</h3>
            <ul class="breadcrumb">
               <li class="breadcrumb-item active">Dashboard</li>
            </ul>
         </div>
      </div>
   </div>
   <!-- /Page Header -->
   <div class="row">
      <!-- total doctors -->
      <div class="col-xl-3 col-sm-6 col-12">
         <div class="card">
            <div class="card-body">
               <div class="dash-widget-header">
                  <span class="dash-widget-icon text-primary border-primary">
                  <i class="fa fa-user-md"></i>
                  </span>
                  <div class="dash-count">
                          
                     <h3>{{ $doctors_count ?? 0 }}</h3>
                    
                  </div>
               </div>
               <div class="dash-widget-info">
                  <h6 class="text-muted">Doctors</h6>
                  <div class="progress progress-sm">
                    
                     <div class="progress-bar bg-primary"style="width: {{$doctors_count/100}}%"></div>
                    
                     <div class="progress-bar bg-primary"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- total patients -->
      <div class="col-xl-3 col-sm-6 col-12">
         <div class="card">
            <div class="card-body">
               <div class="dash-widget-header">
                  <span class="dash-widget-icon text-success">
                  <i class="fa fa-user-plus"></i>
                  </span>
                  <div class="dash-count">
                    
                     <h3>{{$patients_count ?? 0}}</h3>
                    
                  </div>
               </div>
               <div class="dash-widget-info">
                  <h6 class="text-muted">Patients</h6>
                  <div class="progress progress-sm">
                     
                     <div class="progress-bar bg-success"style="width: {{$patients_count ?? 1 /100}}%"></div>
                    
                     <div class="progress-bar bg-success"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- total appointments -->
      <div class="col-xl-3 col-sm-6 col-12">
         <div class="card">
            <div class="card-body">
               <div class="dash-widget-header">
                  <span class="dash-widget-icon text-danger border-danger">
                  <i class="fa fa-calendar-check-o"></i>
                  </span>
                  <div class="dash-count">
                     
                     <h3>{{$appointments_count ?? 0}}</h3>
                    
                  </div>
               </div>
               <div class="dash-widget-info">
                  <h6 class="text-muted">Appointments</h6>
                  <div class="progress progress-sm">
                     <div class="progress-bar bg-danger" style="width: {{$appointments_count/100}}%"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
            <!-- notification appointment -->
      <div class="col-xl-3 col-sm-6 col-12">
         <div class="card">
            <div class="card-body">
               <a href="/admin/appointment-notifications">
               <div class="dash-widget-header">
                  <span class="dash-widget-icon text-danger border-danger">
                  <i class="fa fa-calendar-check-o"></i>
                  </span>
                  <div class="dash-count">
                     
                     <h3>{{$appointments_notification ?? 0}}</h3>
                    
                  </div>
               </div>
               <div class="dash-widget-info">
                  <h6 class="text-muted">Appointments Notifications</h6>
                  <div class="progress progress-sm">
                     <div class="progress-bar bg-danger" style="width: {{$appointments_notification/100}}%"></div>
                  </div>
                   <audio id="idAudio">
                     <source src="{{asset('public/uploads/alert/alert.mp3')}}" type="audio/ogg">
        
                  </audio>
               </div>
            </a>
            </div>
         </div>
      </div>
      <!-- total Revenue -->
      <div class="col-xl-3 col-sm-6 col-12">
         <div class="card">
            <div class="card-body">
               <div class="dash-widget-header">
                  <span class="dash-widget-icon text-warning border-warning">
                  <i class="fas fa-money-bill-alt"></i>
                  </span>
                  <div class="dash-count">
                     @if( $total_commission!= 0)
                     <h3>Rs{{$total_commission}}</h3>
                     @else
                     <h3>0</h3>
                     @endif
                  </div>
               </div>
               <div class="dash-widget-info">
                  <h6 class="text-muted">Revenue</h6>
                  <div class="progress progress-sm">
                     <div class="progress-bar bg-warning"style="width: {{$total_commission/100}}%"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- charts  -->
   <div class="row">
      <div class="col-md-12 col-lg-6">
         <!-- Sales Chart -->
         <div class="card card-chart">
            <div class="card-header">
               <h4 class="card-title">Revenue</h4>
            </div>
            <div class="card-body">
               <div id="area-chart"></div>
            </div>
         </div>
         <!-- /Sales Chart -->
      </div>
      <div class="col-md-12 col-lg-6">
         <!-- Invoice Chart -->
         <div class="card card-chart">
            <div class="card-header">
               <h4 class="card-title">Status</h4>
            </div>
            <div class="card-body">
               <div id="line-chart"></div>
            </div>
         </div>
         <!-- /Invoice Chart -->
      </div>
   </div>
   <!-- doctor list  -->
   <div class="row">
      <div class="col-md-12">
         <!-- Recent Orders -->
         <div class="card card-table flex-fill">
            <div class="card-header">
               <h4 class="card-title">Doctors List</h4>
            </div>
            <div class="card-body dashboard_table">
               <div class="table-main">
                  @if ($doctors_list->count() > 0)
                  <table class="table table-hover table-center mb-0 dt-responsive nowrap table-responsive pt-3"id="doctor_table">
                     <thead>
                        <tr>
                           <th>Doctor Name</th>
                           <th>Speciality</th>
                           <th>Earned</th>
                           <th>Reviews</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($doctors_list as $doctor)
                        <?php                      
                           $avg_rating = App\Feedback::where('user_id', $doctor->id)->pluck('avg_rating')->first();
                           $stars  = $avg_rating != 0 ? $avg_rating / 5 * 100 : 0;
                           $disk = env('FILESYSTEM_DRIVER') === 'production' ? 's3' : 'local';
                           // dd($disk);
                           ?>       
                        <tr>
                           <td>
                              <h2 class="table-avatar">
                                 <a href="/profile/{{ clean($doctor->slug) }}" class="avatar avatar-sm mr-2">
    @if ($doctor->profile && is_object($doctor->profile) && property_exists($doctor->profile, 'avatar'))
        <img class="avatar-img rounded-circle" src="{{ asset(Helper::getImage('uploads/users/'.$doctor->id, $doctor->profile->avatar, 'medium-', 'user.jpg')) }}" alt="User Image">
    @else
        <img class="avatar-img rounded-circle" src="{{ Storage::disk($disk)->url('images/user.jpg') }}" alt="Default Image">
    @endif
</a>

                                 <a href="/profile/{{clean($doctor->slug)}}">{{Helper::getUserData($doctor->id)}}</a>
                              </h2>
                           </td>
                           <td>
                              @foreach($doctor->specialities as $speciality)
                              {{$speciality->title}}<br>
                              @endforeach
                           </td>
                           <td>Rs3200.00 </td>
                           <td>
                              @if($doctor->feedbacks->count() > 0)
                              <span class="dc-stars"><span style="width: {{ $stars }}%;"></span></span>
                              @else
                              <span class="dc-stars"><span style="width: {{ $stars }}%;"></span></span>
                              @endif
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
                  @if ( method_exists($doctors_list,'links') )
                  {{ $doctors_list->links('pagination.custom') }}
                  @endif
               </div>
            </div>
         </div>
         <!-- /Recent Orders -->
      </div>
   </div>
   @else
   @include('errors.no-record')
   @endif
   <!-- patient list -->
   <div class="row">
      <div class="col-md-12">
         <!-- Feed Activity -->
         <div class="card  card-table flex-fill">
            <div class="card-header">
               <h4 class="card-title">Patients List</h4>
            </div>
            <div class="card-body">
               <div class="patient-table table-responsive">
                  @if ($patients_list->count() > 0)
                  <table class="table table-hover table-center mb-0 dt-responsive nowrap table-responsive pt-3"id="patient_table">
                     <thead>
                        <tr>
                           <th>Patient Name</th>
                           <th>Phone</th>
                           <th>Last Visit</th>
                           <th>Paid</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($patients_list as $patient)
                        <tr>
                           <td>
                              <h2 class="table-avatar">
                                 <a href="#" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle"src="{{{asset(Helper::getImage('uploads/users/'.$patient->id, optional($patient->profile)->avatar, 'medium-', 'user.jpg'))}}}" alt="User Image"></a>
                                 <a href="#">{{Helper::getUserData($patient->id)}}</a>
                              </h2>
                           </td>
                           <td>{{$patient->phone_number}}</td>
                           <td>20 Oct 2019</td>
                           <td class="text-right">Rs100.00</td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
                  @if ( method_exists($patients_list,'links') )
                  {{ $patients_list->links('pagination.custom') }}
                  @endif
               </div>
            </div>
         </div>
         <!-- /Feed Activity -->
      </div>
      @else
      @include('errors.no-record')
      @endif
   </div>
   <div class="row">
      <div class="col-md-12">
         <!-- Recent Orders -->
         <div class="card card-table">
            <div class="card-header">
               <h4 class="card-title">Appointments List</h4>
            </div>
            <div class="card-body">
               <div class="appointment-main">
                  @if ($appointments_list->count() > 0 )
                  <table class="table table-hover table-center mb-0 dt-responsive nowrap table-responsive pt-3"id="appointment_table">
                     <thead>
                        <tr>
                           <th>Doctor Name</th>
                           <th>Speciality</th>
                           <th>Patient Name</th>
                           <th>Apointment Time</th>
                           <th>Status</th>
                           <th class="text-right none">Amount</th>
                           <th class="none">Type</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($appointments_list as $key => $appointment)
                        <tr>
                           @php
                           $app_doctor = App\User::find($appointment->user_id);
                           $doctor_detail = App\UserMeta::where('user_id',$app_doctor->id)->first();
                           @endphp
                           <td>
                              <h2 class="table-avatar">
                                 @if(!($doctor_detail==null))
                                 <a href="/profile/{{clean($app_doctor->slug)}}" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle"src="{{{asset(Helper::getImage('uploads/users/'.$doctor_detail->user_id,  $doctor_detail->avatar, 'medium-', 'user.jpg'))}}}" alt="User Image"></a>
                                 @else
                                 <a href="/profile/{{clean($app_doctor->slug)}}" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle"src="{{asset('/images/user.jpg')}}" alt="User Image"></a>
                                 @endif
                                 <a href="/profile/{{clean($app_doctor->slug)}}">{{Helper::getUserData($app_doctor->id)}}</a>
                              </h2>
                           </td>
                           <td>Anesthesiology</td>
                           @php
                           $app_patient = App\User::find($appointment->user_id);
                           $patient_detail = App\UserMeta::where('user_id',$app_patient->id)->first();
                           @endphp                          
                           <td>
                              <h2 class="table-avatar">
                                 @if(!($patient_detail==null))
                                 <a href="#" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle"src="{{{asset(Helper::getImage('uploads/users/'.$patient_detail->user_id,  $patient_detail->avatar, 'medium-', 'user.jpg'))}}}" alt="User Image"></a>
                                 @else
                                 <a href="#" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle"src="{{asset('/images/user.jpg')}}" alt="User Image"></a>
                                 @endif
                                 <a href="#">{{Helper::getUserData($app_patient->id)}}</a>
                              </h2>
                           </td>
                           <td>{{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}}<span class="text-primary d-block">{{$appointment->appointment_time}}</span></td>
                           <td>
                              <div class="status-toggle">
                                 <input v-on:click="checkedFunction({{$appointment->id}})" type="checkbox" name="accepted"value="{{$appointment->id}}" id="{{$key}}" class="check"{{  ($appointment->status == 'accepted' ? ' checked' : '') }}>
                                 <label for="{{$key}}" class="checktoggle">checkbox</label>
                              </div>
                           </td>
                           <td class="text-right">
                              Rs{{$appointment->charges}}
                           </td>
                           <td >
                              {{$appointment->type}}
                           </td>
                        </tr>
                        <div id="message"></div>
                        @endforeach
                     </tbody>
                  </table>
                  @if ( method_exists($appointments_list,'links') )
                  {{ $appointments_list->links('pagination.custom') }}
                  @endif
               </div>
            </div>
         </div>
         <!-- /Recent Orders -->
      </div>
      @else
      @include('errors.no-record')
      @endif
   </div>
</div>
<script>
   // function checkedFunction(id) {
   //    $.ajax({
   //         url: "/appointment/status",
   //         type:"get",
   //         data:{
   //           id:id,
   //         },
   //         success:function(response){
   //           console.log(response['message']);
   //          alert('Status Change Successfully');
   
   
   //         },
   
   //        });
   
   // }
   
</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript">
   jQuery(document).ready(function() {
     jQuery('#doctor_table').DataTable();
   } );
   jQuery(document).ready(function() {
     jQuery('#patient_table').DataTable();
   } );
   jQuery(document).ready(function() {
     jQuery('#appointment_table').DataTable();
   } );
   
</script>         
<script>
   $(document).ready(function() {
   lineChart();
   areaChart();
   
   $(window).resize(function() {
   window.lineChart.redraw();
   window.areaChart.redraw();
   });
   });
   
   function lineChart() {
   window.lineChart = Morris.Line({
   element: 'line-chart',
   data: [
    { y: '2006', a: 100, b: 90 },
    { y: '2007', a: 75,  b: 65 },
    { y: '2008', a: 50,  b: 40 },
    { y: '2009', a: 75,  b: 65 },
    { y: '2010', a: 50,  b: 40 },
    { y: '2011', a: 75,  b: 65 },
    { y: '2012', a: 100, b: 90 }
   ],
   xkey: 'y',
   ykeys: ['a', 'b'],
   labels: ['Series A', 'Series B'],
   lineColors: ['#1e88e5','#ff3321'],
   lineWidth: '3px',
   resize: true,
   redraw: true
   });
   }
   
   function areaChart() {
   window.areaChart = Morris.Area({
   element: 'area-chart',
   data: [
    { y: '2006', a: 100, b: 90 },
    { y: '2007', a: 75,  b: 65 },
    { y: '2008', a: 50,  b: 40 },
    { y: '2009', a: 75,  b: 65 },
    { y: '2010', a: 50,  b: 40 },
    { y: '2011', a: 75,  b: 65 },
    { y: '2012', a: 100, b: 90 }
   ],
   xkey: 'y',
   ykeys: ['a', 'b'],
   labels: ['Series A', 'Series B'],
   lineColors: ['#1e88e5','#ff3321'],
   lineWidth: '3px',
   resize: true,
   redraw: true
   });
   }
</script>
@endsection