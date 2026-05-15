@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@push('backend_stylesheets')
<link href="{{ asset('css/basictable.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/media/css/site-examples.css?_=2335fc41d55494e8cfce6bcc069c6419">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<style>
   /*table>tbody>tr>td{
   text-align: left;
   }*/
   #roles{
   width: 100% !important;
   }
   #account_settings{
   padding-bottom: 50px;
   }
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
   .dc-haslayout .dc-dbsectionspace{
      width: 100% !important;
   }
   table.dataTable.display tbody tr.odd>.sorting_1, table.dataTable.order-column.stripe tbody tr.odd>.sorting_1{
      background-color: #fff !important;
   }
   table.dataTable.display tbody tr.odd>.sorting_1, table.dataTable.order-column.stripe tbody tr.odd>.sorting_1{
      font-size: 13px !important;
   }
   table.dataTable.row-border tbody tr:first-child th, table.dataTable.row-border tbody tr:first-child td, table.dataTable.display tbody tr:first-child th, table.dataTable.display tbody tr:first-child td{
      font-size: 14px;
   }
   .text-14{
      font-size: 13px !important;
   }
   /*table.dataTable thead .sorting:after, table.dataTable thead .sorting:before, table.dataTable thead .sorting_asc:before, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:after, table.dataTable thead .sorting_desc:before{
      top: -10px !important;
   }*/
   td{
      padding:0px !important;
   }
   table.dataTable.display tbody tr.even>.sorting_1, table.dataTable.order-column.stripe tbody tr.even>.sorting_1{
      background-color: #fff !important;
   }
   table.dataTable.row-border tbody tr:first-child th, table.dataTable.row-border tbody tr:first-child td, table.dataTable.display tbody tr:first-child th, table.dataTable.display tbody tr:first-child td{
      background-color: #fff !important;
      font-size: 13px !important;
   }
   table.dataTable.row-border tbody th, table.dataTable.row-border tbody td, table.dataTable.display tbody th, table.dataTable.display tbody td{
      font-size: 13px !important;
      background-color: #fff !important;
      border-right: none;
   }
   table.dataTable.no-footer{
      border-bottom: 1px solid #dee2e6 !important;
   }
   td{
      padding-top: 10px !important;
      padding-bottom: 10px !important;
      border-top:1px solid #dddddd !important;
      border-bottom:1px solid #dddddd !important;
      vertical-align: middle !important;
   }
   
   th{
      min-width: 65px !important;
   }
   div.dataTables_wrapper div.dataTables_info {
      display: none !important;
      /*font-size: 14px !important; */
   }
   /*div.dataTables_wrapper div.dataTables_paginate{
      display: none !important;
   }*/
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
   .dateMain select{
      width: 100%;
   }
   #reportrange{
      line-height: 25px;
   }
   .dataTables_length select{
      height: auto;
   }
   @media (min-width: 564px){
      .daterangepicker {
          width: 876px !important;
      }
   }
</style>
@endpush
@section('content')
<section class="dc-haslayout" id="account_settings">
   @if (Session::has('message'))
   <div class="flash_msg">
      <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
   </div>
   @elseif (Session::has('error'))
   <div class="flash_msg">
      <flash_messages :message_class="'danger'" :time ='500' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
   </div>
   @endif
   <div class="dc-preloader-section" v-if="is_loading" v-cloak>
      <div class="dc-preloader-holder">
         <div class="dc-loader"></div>
      </div>
   </div>
   <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 float-right">
         @if (Session::has('message'))
         <div class="flash_msg">
            <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
         </div>
         @endif
         <div class="dc-dashboardbox">
            <div class="dc-dashboardboxtitle dc-titlewithsearch">
               <!-- Page Header -->
               <div class="page-header">
                  <div class="row">
                     <div class="col-sm-12">
                        <h3>{{{ 'All '.$role.'s' }}}</h3>
                        <!--  <ul class="breadcrumb">
                           <li class="breadcrumb-item active">Dashboard</li>
                           </ul> -->
                     </div>
                  </div>
               </div>
               <!-- /Page Header -->
               @if($role ==='doctor')
               <div class="row">
                  <div class="col-xl-3 col-sm-6 col-12">
                     <div class="card">
                        <div class="card-body">
                           <div class="dash-widget-header">
                              <span class="dash-widget-icon text-primary border-primary">
                              <i class="fa fa-user-md"></i>
                              </span>
                              <div class="dash-count">
                                 <h3>{{$users_counts}}</h3>
                              </div>
                           </div>
                           <div class="dash-widget-info">
                              <h6 class="text-muted">Doctors</h6>
                              <div class="progress progress-sm">
                                 <div class="progress-bar bg-primary"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12">
                     <div class="card">
                        <div class="card-body">
                           <div class="dash-widget-header">
                              <span class="dash-widget-icon text-success">
                              <i class="fa fa-arrows-alt"></i>
                              </span>
                              <div class="dash-count">
                                 <h3>100</h3>
                              </div>
                           </div>
                           <div class="dash-widget-info">
                              <h6 class="text-muted">Extend Doctors</h6>
                              <div class="progress progress-sm">
                                 <div class="progress-bar bg-success"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12">
                     <div class="card">
                        <div class="card-body">
                           <div class="dash-widget-header">
                              <span class="dash-widget-icon text-warning border-warning">
                              <i class="fa fa-plus-square"></i>
                              </span>
                              <div class="dash-count">
                                 <h3>0</h3>
                              </div>
                           </div>
                           <div class="dash-widget-info">
                              <h6 class="text-muted">Requested Doctors</h6>
                              <div class="progress progress-sm">
                                 <div class="progress-bar bg-warning"style="width: 0%;"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12">
                     <div class="card">
                        <div class="card-body">
                           <div class="dash-widget-header">
                              <span class="dash-widget-icon text-danger border-danger">
                              <i class="fa fa-exclamation-circle"></i>
                              </span>
                              <div class="dash-count">
                                 <h3>0</h3>
                              </div>
                           </div>
                           <div class="dash-widget-info">
                              <h6 class="text-muted">Spam Doctors</h6>
                              <div class="progress progress-sm">
                                 <div class="progress-bar bg-danger" style="width: 0%"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               @endif
               @if($role ==='hospital')
               <div class="row">
                  <div class="col-xl-3 col-sm-6 col-12">
                     <div class="card">
                        <div class="card-body">
                           <div class="dash-widget-header">
                              <span class="dash-widget-icon text-primary border-primary">
                              <i class="fa fa-hospital-o"></i>
                              </span>
                              <div class="dash-count">
                                 <h3>{{$users_counts}}</h3>
                              </div>
                           </div>
                           <div class="dash-widget-info">
                              <h6 class="text-muted">Hospitals</h6>
                              <div class="progress progress-sm">
                                 <div class="progress-bar bg-primary"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12">
                     <div class="card">
                        <div class="card-body">
                           <div class="dash-widget-header">
                              <span class="dash-widget-icon text-success">
                              <i class="fa fa-arrows-alt"></i>
                              </span>
                              <div class="dash-count">
                                 <h3>100</h3>
                              </div>
                           </div>
                           <div class="dash-widget-info">
                              <h6 class="text-muted">Extend Hospitals</h6>
                              <div class="progress progress-sm">
                                 <div class="progress-bar bg-success"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12">
                     <div class="card">
                        <div class="card-body">
                           <div class="dash-widget-header">
                              <span class="dash-widget-icon text-warning border-warning">
                              <i class="fa fa-plus-square"></i>
                              </span>
                              <div class="dash-count">
                                 <h3>0</h3>
                              </div>
                           </div>
                           <div class="dash-widget-info">
                              <h6 class="text-muted">Requested Hospitals</h6>
                              <div class="progress progress-sm">
                                 <div class="progress-bar bg-warning"style="width: 0%;"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12">
                     <div class="card">
                        <div class="card-body">
                           <div class="dash-widget-header">
                              <span class="dash-widget-icon text-danger border-danger">
                              <i class="fa fa-exclamation-circle"></i>
                              </span>
                              <div class="dash-count">
                                 <h3>0</h3>
                              </div>
                           </div>
                           <div class="dash-widget-info">
                              <h6 class="text-muted">Spam Hospitals</h6>
                              <div class="progress progress-sm">
                                 <div class="progress-bar bg-danger" style="width: 0%"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               @endif
               @if($role ==='laboratory')
               <div class="row">
                  <div class="col-xl-3 col-sm-6 col-12">
                     <div class="card">
                        <div class="card-body">
                           <div class="dash-widget-header">
                              <span class="dash-widget-icon text-primary border-primary">
                              <i class="fa fa-flask"></i>
                              </span>
                              <div class="dash-count">
                                 <h3>{{$users_counts}}</h3>
                              </div>
                           </div>
                           <div class="dash-widget-info">
                              <h6 class="text-muted">Laboratories</h6>
                              <div class="progress progress-sm">
                                 <div class="progress-bar bg-primary"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12">
                     <div class="card">
                        <div class="card-body">
                           <div class="dash-widget-header">
                              <span class="dash-widget-icon text-success">
                              <i class="fa fa-arrows-alt"></i>
                              </span>
                              <div class="dash-count">
                                 <h3>100</h3>
                              </div>
                           </div>
                           <div class="dash-widget-info">
                              <h6 class="text-muted">Extend Lab</h6>
                              <div class="progress progress-sm">
                                 <div class="progress-bar bg-success"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>





                  <div class="col-xl-3 col-sm-6 col-12">
                     <div class="card">
                        <div class="card-body">
                           <div class="dash-widget-header">
                              <span class="dash-widget-icon text-warning border-warning">
                              <i class="fa fa-plus-square"></i>
                              </span>
                              <div class="dash-count">
                                 <h3>0</h3>
                              </div>
                           </div>
                           <div class="dash-widget-info">
                              <h6 class="text-muted">Requested Lab</h6>
                              <div class="progress progress-sm">
                                 <div class="progress-bar bg-warning"style="width: 0%;"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12">
                     <div class="card">
                        <div class="card-body">
                           <div class="dash-widget-header">
                              <span class="dash-widget-icon text-danger border-danger">
                              <i class="fa fa-exclamation-circle"></i>
                              </span>
                              <div class="dash-count">
                                 <h3>0</h3>
                              </div>
                           </div>
                           <div class="dash-widget-info">
                              <h6 class="text-muted">Spam Lab</h6>
                              <div class="progress progress-sm">
                                 <div class="progress-bar bg-danger" style="width: 0%"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               @endif
               <div class="dc-rightarea">
                  <form action="{{ route('adminAddUser')}}" method="get">
                     <input type="hidden" name="role" value="{{{$role}}}">
                     <input type="submit" name="submit"class="dc-btn" value="Add new {{$role}}">
                     <!-- <a href="{{ route('adminAddUser')}}" class="dc-btn">Add new user</a> -->
                  </form>
               </div>
            </div>
            <!-- <div>
               <h1>Import File</h1>
               <div>
                  <form method="post" enctype="multipart/form-data" action="{{ url('/import_excel/import') }}">
                     {{ csrf_field() }}
                     <div class="form-group">
                        <table class="table table-responsive">
                           <tr>
                              <td width="40%" align="right">
                                 <select name="role"class="form-control">
                                    <option value="">Select Role</option>
                                    <option value="doctor">Doctor</option>
                                    <option value="hospital">Hospital</option>
                                    <option value="laboratory">Laboratory</option>
                                 </select>
                                 @if ($errors->has('role'))  
                                 <p class="text-danger">{{$errors->first('role')}}</p>
                                 @endif
                              </td>
                              <td width="30">
                                 <input type="file" name="select_file" />
                                 @if ($errors->has('select_file'))  
                                 <p class="text-danger">{{$errors->first('select_file')}}</p>
                                 @endif
                              </td>
                              <td width="30%" align="left">
                                 <input type="submit" name="upload" class="btn btn-primary" value="Upload">
                              </td>
                           </tr>
                           <tr>
                              <td width="40%" align="right"></td>
                              <td width="30"><span class="text-muted">.xls, .xslx</span></td>
                              <td width="30%" align="left"></td>
                           </tr>
                        </table>
                     </div>
                  </form>
               </div>
            </div> -->
            @if (!empty($role_based_users))
            <div class="dc-dashboardboxcontent dc-categoriescontentholder">
               @if($role !=='patient')
               <div class="row mt-3 mb-3">
                  <div class="col-lg-4 col-12">
                     <label>Select Date</label>
                     <div class="dateMain">
                        <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
    <i class="fa fa-calendar"></i>&nbsp;
    <span></span> <i class="fa fa-caret-down"></i>
</div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-12">
                     <label>Select City</label>
                     <div class="dateMain">
    <select onchange="filter(this.value)">
                     @foreach ($locations as $location)
             <option selected="selected" value="{{ $location->id }}">{{ $location->title }}</option>
@endforeach
   </select>
</div>
                  </div>
                  <div class="col-lg-4 col-12">
                     <label>Select Area</label>
                     <div class="dateMain">
    <select id="list" name="list" onchange="filterArea(this.value)">
                     
   </select>
</div>
                  </div>
               </div>
               @endif
               <div class="data-table-main">
               <table id="roles"class=" blank_td table table-bordered table-hover dt-responsive nowrap display nowrap table-responsive">
                  <thead class=" border-top border-bottom">
                     <tr class=" border-top border-bottom">
                        <th class="none  text-14 font-weight-bold border-top border-bottom">Created Date</th>
                        <th class=" font-weight-bold text-14 border-top border-bottom">{{{ trans('lang.user_name') }}}</th>
                        <th class=" font-weight-bold text-14 border-top border-bottom">Slug</th>
                        <th class=" font-weight-bold text-14 border-top border-bottom">{{{ trans('lang.ph_email') }}}</th>
                        @if($role !== 'hospital')
                        <th class="none  font-weight-bold text-14 border-top border-bottom">Appointments</th>
                        @endif
                        @if($role === 'hospital')
                        <th class="none  font-weight-bold text-14 border-top border-bottom">Onboard Doctors</th>
                        @endif
                        <th class=" text-14 font-weight-bold border-top border-bottom">{{{ trans('lang.medical_verified') }}}</th>
                        @if ($role !== 'patient')
                        <th class=" text-14 font-weight-bold border-top border-bottom">{{{ trans('lang.user_verified') }}}</th>
                        @endif
                        <th class=" text-14 font-weight-bold">{{{ trans('lang.action') }}}</th>
                        @if($role === 'doctor')
                        <th class="none  text-14 font-weight-bold border-top border-bottom">Hospitals</th>
                        @endif
                        <th class="none  text-14 font-weight-bold border-top border-bottom">City</th>
                        <th class="none  font-weight-light text-14 border-top border-bottom font-weight-bold">Area</th>
                        <th class="none  font-weight-light text-14 border-top border-bottom font-weight-bold">Address</th>
                        <th class="none  font-weight-light text-14 border-top border-bottom font-weight-bold">Longitude</th>
                        <th class="none  font-weight-light text-14 font-weight-bold">Latitude</th>
                        <th class="none  font-weight-bold text-14">Phone</th>
                        @if($role !== 'patient' && $role !== 'hospital' && $role !== 'laboratory')
                        <th class="none  text-14 font-weight-bold border-top border-bottom">Status</th>
                        <th class="none  text-14 font-weight-bold border-top border-bottom">Recomended Status</th>
                        @endif
                        <th class="none  text-14 font-weight-bold border-top border-bottom">Updated Date</th>
                        @if($role !== 'patient' && $role !== 'hospital' && $role !== 'laboratory')
                        <th class="none  text-14 font-weight-bold border-top border-bottom">Action</th>
                        <th class="none  text-14 font-weight-bold border-top border-bottom">Recommend Action</th>
                        @endif
                     </tr>
                  </thead>
                  <input type="hidden" name="" id="role_name" value="{{$role}}">
                  <input type="hidden" name="" id="user_delete" value="{{trans('lang.user_deleted')}}">
                  <input type="hidden" name="" id="confirm_delete" value="{{trans('lang.ph.delete_confirm_title')}}">
                    <div id="loading">
                         <img src="{{asset('images/loader/loader.gif')}}" />  
                    </div>
                  <tbody class="">
                     @foreach ($role_based_users as $key => $user_data)
                     @php
                     if($user_data->profile->verify_medical != null ||$user_data->profile->verify_medical != "" )
                        $verify_medical = json_decode($user_data->profile->verify_medical, true);
                     else
                     $verfiy_medical = [];
                     @endphp
                     
                     @if ($role != 'admin')
                     <tr class="del-{{{ $user_data->id }}} ">
                           <td class="">{{{ clean(@$user_data->created_at->format('M d, Y, h:i A')) }}}</td>
   <td class=" text-14">{{{ ucwords(\App\Helper::getUserName($user_data->id)) }}}</td>
                        <td class=" text-14">{{{ clean($user_data->slug ?? 'N/A') }}}</td>
                        @if($user_data->email !== null)
                        <td class="">{{{ clean($user_data->email) }}}</td>
                        @else
                        <td class="">Not Available</td>
                        @endif
                        @if ($role !=='hospital')
                          @if ($role === 'doctor')
                            @if(count($user_data->appointments_patient) > 0)
                        <td class=""><a href="{{url($role.'/appointments',['id' => $user_data->id])}}">{{ count($user_data->appointments_patient) }}</a></td>
                            @else
                            <td class=""><a href="javascript::void(0)">0</a></td>
                            @endif
                        @endif
                        @endif
                        @if($role === 'hospital')
                        <td class=""><a href="{{route('manageTeams',['id' => $user_data->id])}}">{{ count($user_data->teams) }}</a></td>
                        @endif
                        @if (!empty($verify_medical))
                        <td class="">
                           {{ html_entity_decode(clean($verify_medical['registration_number'])) }}<br>
                           <a href="{{{route('getfile', ['type'=>'users', 'id'=>clean($user_data->id), 'attachment'=>$verify_medical['registration_document']])}}}">
                           {{ trans('lang.download') }}
                           </a>
                        </td>
                        @elseif ($role == 'patient')
                        <td class="">{{ trans('lang.not_available') }}</td>
                        @else
                        <td class="">{{ trans('lang.not_uploaded') }}</td>
                        @endif
                        <td id="verify_cell-{{$user_data->id}}"class="">
                           @if ($user_data->profile->verify_registration == 1)
                           @if ($role !== 'patient')
                           <a href="javascript:;" class="" v-on:click.prevent="verifiedUser('verify_cell-{{$user_data->id}}', '{{$user_data->id}}', 'not_verify')">{{ trans('lang.verified') }}</a>
                           <a href="javascript:;">{{ trans('lang.not_available') }}</a>
                           @endif
                           @else
                           <a href="javascript:;" class="" v-on:click.prevent="verifiedUser('verify_cell-{{$user_data->id}}', '{{$user_data->id}}', 'verify')">{{ trans('lang.not_verified') }}</a>
                           @endif
                        </td>
                        <td class="">
                           <div class="dc-actionbtn ">
                              @if($role !=='patient')
                              <a href="{{ route('adminEditUser',$user_data->id) }}" class="dc-addinfo dc-skillsaddinfo">
                              <i class="lnr lnr-pencil"></i>
                              </a>
                              @endif
                  <delete :title="'{{trans("lang.ph.delete_confirm_title")}}'" :id="'{{$user_data->id}}'" :message="'{{trans("lang.user_deleted")}}'" :url="'{{url('admin/delete-user')}}'"></delete>
                              @if ($role === 'doctor')

                                 @if($user_data->location == ''|| $user_data->location == null || $user_data->location == 'null')
                                 <a href="{{ url('profile/'.clean($user_data->slug)) }}" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>
                                 @else

                                  @if(count($user_data->specialities) == '0')
                                   <a href="{{ url('profile/'.clean($user_data->slug)) }}" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>
                                   @else
                                    <a href="{{ url('doctors/'.clean($user_data->location->slug).'/'.clean($user_data->specialities[0]->slug).'/'.clean($user_data->slug)) }}" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>
                                    @endif

                                 @endif

                              @endif
                              @if ($role === 'hospital')
                                 @if($user_data->location ===''|| $user_data->location === null || $user_data->location ==='null' || $user_data->area ===''|| $user_data->area === null || $user_data->area ==='null' )
                                 <a href="{{ url('profile/'.clean($user_data->slug)) }}" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>
                                 @else
                                 <a href="{{ url('hospitals/'.$user_data->location->slug.'/'.$user_data->slug) }}" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>
                                 @endif
                              @endif
                              @if ($role === 'laboratories')
                                 @if($user_data->location ===''|| $user_data->location === null || $user_data->location ==='null' || $user_data->area ===''|| $user_data->area === null || $user_data->area ==='null' )
                                 <a href="{{ url('profile/'.clean($user_data->slug)) }}" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>
                                 @else
                                 <a href="{{ url('hospitals/'.$user_data->location->slug.'/'.$user_data->slug.'/'.$user_data->area->slug) }}" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>
                                 @endif
                              @endif
                              
                           </div>
                        </td>
                        @if($role === 'doctor')
                        <td class=""><a href="javascript:;">{{ count($user_data->doc_teams) }}</a></td>
                        @endif
                        <td class="">{{{ clean(@$user_data->location->title) }}}</td>
                        <td class="">{{{ clean(@$user_data->area->title) }}}</td>
                        <td class="">{{{ clean(@$user_data->profile->address) }}}</td>
                        <td class="">{{{ clean(@$user_data->profile->longitude) }}}</td>
                        <td class="">{{{ clean(@$user_data->profile->latitude) }}}</td>
                        <td class="">{{{ clean(@$user_data->phone_number) }}}</td>
                        @if($role !== 'patient' && $role !== 'hospital' && $role !== 'laboratory')
                        @if($user_data->status===0 || $user_data->status==='' || $user_data->status==='pending')
                        <td class="">Pending</td>
                        @elseif($user_data->status===1 || $user_data->status==='register')
                        <td class="">Registered</td>
                        @elseif($user_data->status===2 || $user_data->status==='block')
                        <td class="">Blocked</td>
                        @else
                        <td class="">Pending</td>
                        @endif
                        @if($user_data->recommend_status===1 || $user_data->recommend_status==='recommend')
                        <td class="">recommended</td>
                        @else
                        <td class="">Unrecommended</td>
                        @endif
                        @endif

                        <td class="">{{{ clean(@$user_data->updated_at->format('M d, Y, h:i A')) }}}</td>

                        @if($role !== 'patient' && $role !== 'hospital' && $role !== 'laboratory')
                        <td>

                           <div class="col-lg-4 col-12">
                               <div class="dateMain">
                                <select class="center" onchange="showDropDown({{$user_data->id}},this.value)">
                                 <option value="none" selected="selected">Please Select</option>
                                 @if($user_data->status===0 || $user_data->status==='' || $user_data->status==='pending' || $user_data->status=== null || $user_data->status==='null')
                                      <option value="register">Register</option>
                                 @endif
                                 @if($user_data->status===1 || $user_data->status==='register')
                                      <option value="pending">Unregister</option>
                                 @endif
                                 @if($user_data->status===2 || $user_data->status==='block')
                                       <option value="unblock">Unblock</option>
                                 @endif
                                 @if($user_data->status===1 || $user_data->status===0 || $user_data->status==='' || $user_data->status==='pending' || $user_data->status=== null || $user_data->status==='null')
                                       <option value="block">Block</option>
                                 @endif

                                </select>
                              </div>
                           </div>
                              
                        </td>
                        <td>

                           <div class="col-lg-4 col-12">
                               <div class="dateMain">
                                <select class="center" onchange="recomendStatus({{$user_data->id}},this.value)">
                                 <option value="none" selected="selected">Please Select</option>
                                 @if($user_data->recommend_status===0 || $user_data->recommend_status==='' || $user_data->recommend_status==='unrecommend' || $user_data->recommend_status===null || $user_data->recommend_status==='null')
                                      <option value="recommend">Recommend</option>
                                 @endif
                                 @if($user_data->recommend_status===1 || $user_data->recommend_status==='recommend')
                                      <option value="unrecommend">Unrecommend</option>
                                 @endif
                                </select>
                              </div>
                           </div>
                              
                        </td>
                        @endif
                     </tr>
                     @else 
                     exit();
                     @endif
                     @endforeach
                  </tbody>
               </table>
            </div>
            </div>
            @else
            @include('errors.no-record')
            @endif
         </div>
      </div>
   </div>
  
</section>

@endsection
@push('scripts')
@stack('backend_scripts')

<script type="text/javascript">
$(function() {
// alert('here');
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    dateFilter(start, end);
        
    }

    $('#reportrange').daterangepicker({
      // locale: {
      //    format: 'DD/MM/YYYY',
      //    cancelLabel: 'Clear'
      //  },
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

    // cb(start, end);
});
   function dateFilter(startDate, endDate){
      // alert(startDate.format("YYYY-MM-DD"))
   
      // alert(id);
      var base      = window.location.origin;
      var table = $('#roles').DataTable();
      var role =$('#role_name').val();
      var url  = window.location.href;
      var request_type=url.split('/');  
      request_type=request_type[4];


                 $.ajaxSetup({
                   headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
               $.ajax({
               type: "GET",
               url: base+"/admin/date-filter",
               data:{'type':request_type,'startDate':startDate.format("YYYY-MM-DD"),'endDate':endDate.format("YYYY-MM-DD")},
               // contentType: "application/json; charset=utf-8",

               dataType: "json",
               success: function (response) {
               table.clear().draw();
               var email='';
               var count =0;
               var medical_status ='';
               var user_verified ='';
               var status='';
               var action='';
               var recommend_status='';
               var recommend_action='';
               var list ='';
               var eye ='<a href="javascript:;" class="dc-addinfo dc-skillsaddinfo disable-eye"><i class="lnr lnr-eye"></i></a>';        
               $.each(response.role_based_users, function(i, item) {
                 
                 if(item.area===null){
                   var area='';
                 }
                 else{
                  var area=item.area.title;
                 }
                 if(item.profile===null){
                   var address='';
                   var longitude='';
                   var latitude='';
                 }
                 else{
               
                      if(item.profile.address!==undefined)
                      {
                        if(item.profile.address!==null)
                        {
                          var address =item.profile.address
                        }
                        else{
                            var address='';
                        }
                      }
                      else{
                        var address='';
                      }
                      if(item.profile.longitude!==undefined)
                      {
                        if(item.profile.longitude!==null)
                        {
                          var longitude =item.profile.longitude
                        }
                        else{
                            var longitude='';
                        }
                      }
                      else{
                        var longitude='';
                      }
                     if(item.profile.latitude!==undefined)
                      {
                        if(item.profile.latitude!==null)
                        {
                          var latitude =item.profile.latitude
                        }
                        else{
                            var latitude='';
                        }
                      }
                      else{
                        var latitude='';
                      }
                 }
                 if(item.location===null){
                   var location='';
                 }
                 else{
                  var location=item.location.title;
                 }
                 if(item.email===null){
                    email='Not available';
                 }
                 else{
                     email=item.email;
                  }
                 if (role !=='hospital')
                 {
                     if (role === 'doctor')
                     {
                        if(item.appointments.length>0)
                        {
                           count = '<a href="'+base+'/doctor/manage-team/'+item.id+'">'+item.appointments+'</a>'
                        }
                     }
                     if (role === 'patient')
                     {
                        if(item.appointments_patient.length>0)
                        {
                     count = '<a href="'+base+'/patient/manage-team/'+item.id+'">'+item.appointments_patient+'</a>'
                         }
                      }
                  }
                  if(role === 'hospital')
                  {
                     count = '<a href="'+base+'/hospital/manage-team/'+item.id+'">'+item.teams.length+'</a>';
                         
                  }
                  if (item.profile.verify_medical!==null && item.profile.verify_medical!==undefined)
                   {
                      medical_status='<a href="'+base+'/get/'+'users'+'/'+item.id+'/'+item.profile.verify_medical['registration_number']+'">'+item.profile.verify_medical['registration_number']+'</a>';
                   }
                  else if (role === 'patient')
                    {
                      medical_status="Not available yet";
                    }
                  else
                   {
                        medical_status="Not uploaded yet";
                   }
                  if (item.user_meta.verify_registration == 1 && item.user_meta!=undefined) 
                     {  
                         var element='verify-'+item.id;
                        var type='not_verify';
                        var  user_verified='<a href="javascript:void(0)" id="'+element+'" onclick="verifieUserFunction(\''+element+'\','+item.id+',\''+type+'\')">Verfied</a>';
                     }
                  else if (role === 'patient')
                     { 
                        var user_verified ='Not available';
                     }
                  else
                     {                              
                        var element='verify-'+item.id;
                        var type='verify';
                        var  user_verified='<a href="javascript:void(0)" id="'+element+'" onclick="verifieUserFunction(\''+element+'\','+item.id+',\''+type+'\')">Not Verfied</a>';
                     }
                         
                           var edit_icon='<div class="dc-actionbtn border-0"><a href="'+base+'/admin/edit-user/'+item.id+'" class="dc-addinfo dc-skillsaddinfo"> <i class="lnr lnr-pencil"></i></a>';
                           var delete_icon ='<a href="javascript:;" id='+item.id+'  onclick="delete_user('+item.id+')" class="dc-deleteinfo delete_user"><delete :title="{{trans("lang.ph.delete_confirm_title")}}" :id="{{$user_data->id}}" :message="{{trans("lang.user_deleted")}}" :url="'+base+'admin/delete-user"></delete><i class="lnr lnr-trash"></i></a>';
                           if (role === 'doctor')
                           {
                              if(item.location ==''|| item.location == null ||  item.location =='null')
                              {
                                 eye='<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                              else
                              {
                                 eye='<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                           }
                           if (role === 'hospital')
                           {
                              if(item.location ===''|| item.location === null || item.location ==='null' || item.area ===''|| item.area === null || item.area ==='null' )
                              {
                               eye ='<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                              else
                              {
                               eye ='<a href="'+base+'/hospitals/'+item.location.slug+"/"+item.slug+"/"+item.area.slug+')" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                          }
                           if (role === 'laboratories')
                           {
                              if(item.location ===''|| item.location === null || item.location ==='null' || item.area ===''|| item.area === null || item.area ==='null' )
                              {
                                eye= '<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                              else
                              {
                                 eye='<a href="'+base+'/hospitals/'+item.location.slug+"/"+item.slug+"/"+item.area.slug+')" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                           }
                              if (role === 'patient')
                              {
                                  eye ='<a href="javascript:;" class="dc-addinfo dc-skillsaddinfo disable-eye"><i class="lnr lnr-eye"></i></a>';
                              }

                              if(role !== 'patient' && role !== 'hospital' && role !== 'laboratory')
                           {
                                 if(item.status===0 || item.status==='' || item.status==='pending' || item.status=== null || item.status==='null')
                                 {
                                    status='Pending';
                                    var none='';
                                    action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="register">Register</option></select></div></div>';


                                 }
                                 else if(item.status===1 || item.status==='register')
                                 {
                                    status='Registered';
                                    var none='';
                                    action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" id="select_action" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="pending">Unregister</option><option value="block">Block</option></select></div></div>';
                                 }
                                 else if(item.status===2 || item.status==='block')
                                 {
                                    status='Blocked';
                                    var none='';
                                    action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" id="select_action" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="unblock">Unblock</option></select></div></div>';
                                 }
                                  else
                                 {
                                    status='Pending';
                                    var none='';
                                    action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="register">Register</option></select></div></div>';
                                 }
                                  if(item.recommend_status===1 || item.recommend_status==='recommend' || item.recommend_status===null || item.recommend_status==='null')
                                 {
                                    
                                   recommend_status='recommended';
                                    var recomend_none='';
                                    recommend_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" id="select_action" onchange="recomendStatus('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="unrecommend">Unrecommend</option></select></div></div>';

                                 }
                                 else
                                 {
                                    recommend_status='Unrecommended';
                                    var recomend_none='';
                                    recommend_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="recomendStatus('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="recommend">Recommend</option></select></div></div>';
                                 }

                           }
                              
                            
                   if(role==='doctor'){
                      table.row.add([ 
                      item.created_at,
                      item.first_name+' '+item.last_name,
                      item.slug || 'N/A',
                      email,
                      count,
                      medical_status,
                      user_verified,
                      edit_icon+delete_icon+eye+'</div>',
                      '<a href="javascript:;">'+item.doc_teams.length+'</a>',
                      location,
                      area,
                      address,
                      longitude,
                      latitude,
                      item.phone_number,
                      status,
                      recommend_status,
                      item.updated_at,
                      action,
                      recommend_action
                     ]);
                  }
                  else{
                      table.row.add([ 
                      item.created_at,
                      item.first_name+' '+item.last_name,
                      item.slug || 'N/A',
                      email,
                      count,
                      medical_status,
                      user_verified,
                      edit_icon+delete_icon+eye+'</div>',
                      location,
                      area,
                      address,
                      longitude,
                      latitude,
                      item.phone_number,
                      status,
                      recommend_status,
                      item.updated_at,
                      action,
                      recommend_action
                     ]);
                  }
         }); 
               table.draw();
               
            }
         });
      
     };
</script>

<script>
    function filter(id)
    {
      // alert(id);
      var base      = window.location.origin;
      var table = $('#roles').DataTable();
      var role =$('#role_name').val();
      var url  = window.location.href;
      var request_type=url.split('/');  
      request_type=request_type[4];


                 $.ajaxSetup({
                   headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
               $.ajax({
               type: "GET",
               url: base+"/admin/city-filter",
               data:{'type':request_type,'id':id},
               // contentType: "application/json; charset=utf-8",
               dataType: "json",
               success: function (response) {
               table.clear().draw();
               var email='';
               var count =0;
               var medical_status ='';
               var user_verified ='';
               var status='';
               var action='';
               var recommend_status='';
               var recommend_action='';
               var list ='';
               var eye ='<a href="javascript:;" class="dc-addinfo dc-skillsaddinfo disable-eye"><i class="lnr lnr-eye"></i></a>';   
               $.each(response.areas, function (i, item) {
                  $('#list').find('option').remove().end();
});
               $.each(response.areas, function (i, item) {
    $('#list').append($('<option>', { 
        value: item.id,
        text : item.title 
    }));
});            
               $.each(response.role_based_users, function(i, item) {
                 
                 if(item.area===null){
                   var area='';
                 }
                 else{
                  var area=item.area.title;
                 }
                 if(item.profile===null){
                   var address='';
                   var longitude='';
                   var latitude='';
                 }
                 else{
               
                      if(item.profile.address!==undefined)
                      {
                        if(item.profile.address!==null)
                        {
                          var address =item.profile.address
                        }
                        else{
                            var address='';
                        }
                      }
                      else{
                        var address='';
                      }
                      if(item.profile.longitude!==undefined)
                      {
                        if(item.profile.longitude!==null)
                        {
                          var longitude =item.profile.longitude
                        }
                        else{
                            var longitude='';
                        }
                      }
                      else{
                        var longitude='';
                      }
                     if(item.profile.latitude!==undefined)
                      {
                        if(item.profile.latitude!==null)
                        {
                          var latitude =item.profile.latitude
                        }
                        else{
                            var latitude='';
                        }
                      }
                      else{
                        var latitude='';
                      }
                 }
                 if(item.location===null){
                   var location='';
                 }
                 else{
                  var location=item.location.title;
                 }
                 if(item.email===null){
                    email='Not available';
                 }
                 else{
                     email=item.email;
                  }
                 if (role !=='hospital')
                 {
                      if (role === 'doctor')
                     {
                        if(item.appointments.length>0)
                        {
                           count = '<a href="'+base+'/doctor/manage-team/'+item.id+'">'+item.appointments+'</a>'
                        }
                     }
                     if (role === 'patient')
                     {
                        if(item.appointments_patient.length>0)
                        {
                     count = '<a href="'+base+'/patient/manage-team/'+item.id+'">'+item.appointments_patient+'</a>'
                         }
                      }
                  }
                  if(role === 'hospital')
                  {
                     count = '<a href="'+base+'/hospital/manage-team/'+item.id+'">'+item.teams.length+'</a>';
                         
                  }
                  if (item.profile.verify_medical!==null && item.profile.verify_medical!==undefined)
                   {
                      medical_status='<a href="'+base+'/get/'+'users'+'/'+item.id+'/'+item.profile.verify_medical['registration_number']+'">'+item.profile.verify_medical['registration_number']+'</a>';
                   }
                  else if (role === 'patient')
                    {
                      medical_status="Not available yet";
                    }
                  else
                   {
                        medical_status="Not uploaded yet";
                   }
                  if (item.user_meta.verify_registration == 1 && item.user_meta!=undefined) 
                     {  
                         var element='verify-'+item.id;
                        var type='not_verify';
                        var  user_verified='<a href="javascript:void(0)" id="'+element+'" onclick="verifieUserFunction(\''+element+'\','+item.id+',\''+type+'\')">Verfied</a>';
                     }
                  else if (role === 'patient')
                     { 
                        var user_verified ='Not available';
                     }
                  else
                     {                              
                        var element='verify-'+item.id;
                        var type='verify';
                        var  user_verified='<a href="javascript:void(0)" id="'+element+'" onclick="verifieUserFunction(\''+element+'\','+item.id+',\''+type+'\')">Not Verfied</a>';
                     }
                         
                           var edit_icon='<div class="dc-actionbtn border-0"><a href="'+base+'/admin/edit-user/'+item.id+'" class="dc-addinfo dc-skillsaddinfo"> <i class="lnr lnr-pencil"></i></a>';
                           var delete_icon ='<a href="javascript:;" id='+item.id+'  onclick="delete_user('+item.id+')" class="dc-deleteinfo delete_user"><delete :title="{{trans("lang.ph.delete_confirm_title")}}" :id="{{$user_data->id}}" :message="{{trans("lang.user_deleted")}}" :url="'+base+'admin/delete-user"></delete><i class="lnr lnr-trash"></i></a>';
                           if (role === 'doctor')
                           {
                              if(item.location ==''|| item.location == null ||  item.location =='null')
                              {
                                 eye='<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                              else
                              {
                                 eye='<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                           }
                           if (role === 'hospital')
                           {
                              if(item.location ===''|| item.location === null || item.location ==='null' || item.area ===''|| item.area === null || item.area ==='null' )
                              {
                               eye ='<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                              else
                              {
                               eye ='<a href="'+base+'/hospitals/'+item.location.slug+"/"+item.slug+"/"+item.area.slug+')" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                          }
                           if (role === 'laboratories')
                           {
                              if(item.location ===''|| item.location === null || item.location ==='null' || item.area ===''|| item.area === null || item.area ==='null' )
                              {
                                eye= '<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                              else
                              {
                                 eye='<a href="'+base+'/hospitals/'+item.location.slug+"/"+item.slug+"/"+item.area.slug+')" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                           }
                              if (role === 'patient')
                              {
                                  eye ='<a href="javascript:;" class="dc-addinfo dc-skillsaddinfo disable-eye"><i class="lnr lnr-eye"></i></a>';
                              }

                               if(role !== 'patient' && role !== 'hospital' && role !== 'laboratory')
                           {
                               if(item.status===0 || item.status==='' || item.status==='pending' || item.status=== null || item.status==='null')
                                 {
                                    status='Pending';
                                    var none='';
                                    action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="register">Register</option></select></div></div>';


                                 }
                                 else if(item.status===1 || item.status==='register')
                                 {
                                    status='Registered';
                                    var none='';
                                    action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" id="select_action" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="pending">Unregister</option><option value="block">Block</option></select></div></div>';
                                 }
                                 else if(item.status===2 || item.status==='block')
                                 {
                                    status='Blocked';
                                    var none='';
                                    action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" id="select_action" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="unblock">Unblock</option></select></div></div>';
                                 }
                                  else
                                 {
                                    status='Pending';
                                    var none='';
                                    action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="register">Register</option></select></div></div>';
                                 }
                                   if(item.recommend_status===1 || item.recommend_status==='recommend' || item.recommend_status===null || item.recommend_status==='null')
                                 {
                                    
                                   recommend_status='recommended';
                                    var recomend_none='';
                                    recommend_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" id="select_action" onchange="recomendStatus('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="unrecommend">Unrecommend</option></select></div></div>';

                                 }
                                 else
                                 {
                                    recommend_status='Unrecommended';
                                    var recomend_none='';
                                    recommend_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="recomendStatus('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="recommend">Recommend</option></select></div></div>';
                                 }

                           }
                              
                            
                   if(role==='doctor'){
                      table.row.add([ 
                      item.created_at,
                      item.first_name+' '+item.last_name,
                      item.slug || 'N/A',
                      email,
                      count,
                      medical_status,
                      user_verified,
                      edit_icon+delete_icon+eye+'</div>',
                      '<a href="javascript:;">'+item.doc_teams.length+'</a>',
                      location,
                      area,
                      address,
                      longitude,
                      latitude,
                      item.phone_number,
                      status,
                      recommend_status,
                      item.updated_at,
                      action,
                      recommend_action
                     ]);
                  }
                  else{
                      table.row.add([ 
                      item.created_at,
                      item.first_name+' '+item.last_name,
                      item.slug || 'N/A',
                      email,
                      count,
                      medical_status,
                      user_verified,
                      edit_icon+delete_icon+eye+'</div>',
                      location,
                      area,
                      address,
                      longitude,
                      latitude,
                      item.phone_number,
                      status,
                      recommend_status,
                      item.updated_at,
                      action,
                      recommend_action
                     ]);
                  }
         }); 
               table.draw();
               
            }
         });
      
     };
     function filterArea(id)
    {
      // alert(id);
      var base      = window.location.origin;
      var table = $('#roles').DataTable();
      var role =$('#role_name').val();
      var url  = window.location.href;
      var request_type=url.split('/');  
      request_type=request_type[4];


                 $.ajaxSetup({
                   headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
               $.ajax({
               type: "GET",
               url: base+"/admin/area-filter",
               data:{'type':request_type,'id':id},
               // contentType: "application/json; charset=utf-8",
               dataType: "json",
               success: function (response) {
               // console.log(response);
               table.clear().draw();
               var email='';
               var count =0;
               var medical_status ='';
               var user_verified ='';
               var status='';
               var action='';
               var recommend_status='';
               var recommend_action='';
               var list ='';
               var eye ='<a href="javascript:;" class="dc-addinfo dc-skillsaddinfo disable-eye"><i class="lnr lnr-eye"></i></a>';        
               $.each(response.role_based_users, function(i, item) {
                 
                 if(item.area===null){
                   var area='';
                 }
                 else{
                  var area=item.area.title;
                 }
                 if(item.profile===null){
                   var address='';
                   var longitude='';
                   var latitude='';
                 }
                 else{
               
                      if(item.profile.address!==undefined)
                      {
                        if(item.profile.address!==null)
                        {
                          var address =item.profile.address
                        }
                        else{
                            var address='';
                        }
                      }
                      else{
                        var address='';
                      }
                      if(item.profile.longitude!==undefined)
                      {
                        if(item.profile.longitude!==null)
                        {
                          var longitude =item.profile.longitude
                        }
                        else{
                            var longitude='';
                        }
                      }
                      else{
                        var longitude='';
                      }
                     if(item.profile.latitude!==undefined)
                      {
                        if(item.profile.latitude!==null)
                        {
                          var latitude =item.profile.latitude
                        }
                        else{
                            var latitude='';
                        }
                      }
                      else{
                        var latitude='';
                      }
                 }
                 if(item.location===null){
                   var location='';
                 }
                 else{
                  var location=item.location.title;
                 }
                 if(item.email===null){
                    email='Not available';
                 }
                 else{
                     email=item.email;
                  }
                 if (role !=='hospital')
                 {
                      if (role === 'doctor')
                     {
                        if(item.appointments.length>0)
                        {
                           count = '<a href="'+base+'/doctor/manage-team/'+item.id+'">'+item.appointments+'</a>'
                        }
                     }
                     if (role === 'patient')
                     {
                        if(item.appointments_patient.length>0)
                        {
                     count = '<a href="'+base+'/patient/manage-team/'+item.id+'">'+item.appointments_patient+'</a>'
                         }
                      }
                  }
                  if(role === 'hospital')
                  {
                     count = '<a href="'+base+'/hospital/manage-team/'+item.id+'">'+item.teams.length+'</a>';
                         
                  }
                  if (item.profile.verify_medical!==null && item.profile.verify_medical!==undefined)
                   {
                      medical_status='<a href="'+base+'/get/'+'users'+'/'+item.id+'/'+item.profile.verify_medical['registration_number']+'">'+item.profile.verify_medical['registration_number']+'</a>';
                   }
                  else if (role === 'patient')
                    {
                      medical_status="Not available yet";
                    }
                  else
                   {
                        medical_status="Not uploaded yet";
                   }
                  if (item.user_meta.verify_registration == 1 && item.user_meta!=undefined) 
                     {  
                         var element='verify-'+item.id;
                        var type='not_verify';
                        var  user_verified='<a href="javascript:void(0)" id="'+element+'" onclick="verifieUserFunction(\''+element+'\','+item.id+',\''+type+'\')">Verfied</a>';
                     }
                  else if (role === 'patient')
                     { 
                        var user_verified ='Not available';
                     }
                  else
                     {                              
                        var element='verify-'+item.id;
                        var type='verify';
                        var  user_verified='<a href="javascript:void(0)" id="'+element+'" onclick="verifieUserFunction(\''+element+'\','+item.id+',\''+type+'\')">Not Verfied</a>';
                     }
                         
                           var edit_icon='<div class="dc-actionbtn border-0"><a href="'+base+'/admin/edit-user/'+item.id+'" class="dc-addinfo dc-skillsaddinfo"> <i class="lnr lnr-pencil"></i></a>';
                           var delete_icon ='<a href="javascript:;" id='+item.id+'  onclick="delete_user('+item.id+')" class="dc-deleteinfo delete_user"><delete :title="{{trans("lang.ph.delete_confirm_title")}}" :id="{{$user_data->id}}" :message="{{trans("lang.user_deleted")}}" :url="'+base+'admin/delete-user"></delete><i class="lnr lnr-trash"></i></a>';
                           if (role === 'doctor')
                           {
                              if(item.location ==''|| item.location == null ||  item.location =='null')
                              {
                                 eye='<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                              else
                              {
                                 eye='<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                           }
                           if (role === 'hospital')
                           {
                              if(item.location ===''|| item.location === null || item.location ==='null' || item.area ===''|| item.area === null || item.area ==='null' )
                              {
                               eye ='<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                              else
                              {
                               eye ='<a href="'+base+'/hospitals/'+item.location.slug+"/"+item.slug+"/"+item.area.slug+')" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                          }
                           if (role === 'laboratories')
                           {
                              if(item.location ===''|| item.location === null || item.location ==='null' || item.area ===''|| item.area === null || item.area ==='null' )
                              {
                                eye= '<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                              else
                              {
                                 eye='<a href="'+base+'/hospitals/'+item.location.slug+"/"+item.slug+"/"+item.area.slug+')" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                           }
                              if (role === 'patient')
                              {
                                  eye ='<a href="javascript:;" class="dc-addinfo dc-skillsaddinfo disable-eye"><i class="lnr lnr-eye"></i></a>';
                              }
                                if(role !== 'patient' && role !== 'hospital' && role !== 'laboratory')
                           {
                                 if(item.status===0 || item.status==='' || item.status==='pending' || item.status=== null || item.status==='null')
                                 {
                                    status='Pending';
                                    var none='';
                                    action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="register">Register</option></select></div></div>';


                                 }
                                 else if(item.status===1 || item.status==='register')
                                 {
                                    status='Registered';
                                    var none='';
                                    action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" id="select_action" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="pending">Unregister</option><option value="block">Block</option></select></div></div>';
                                 }
                                 else if(item.status===2 || item.status==='block')
                                 {
                                    status='Blocked';
                                    var none='';
                                    action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" id="select_action" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="unblock">Unblock</option></select></div></div>';
                                 }
                                  else
                                 {
                                    status='Pending';
                                    var none='';
                                    action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="register">Register</option></select></div></div>';
                                 }
                                  if(item.recommend_status===1 || item.recommend_status==='recommend' || item.recommend_status===null || item.recommend_status==='null')
                                 {
                                    
                                   recommend_status='recommended';
                                    var recomend_none='';
                                    recommend_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" id="select_action" onchange="recomendStatus('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="unrecommend">Unrecommend</option></select></div></div>';

                                 }
                                 else
                                 {
                                    recommend_status='Unrecommended';
                                    var recomend_none='';
                                    recommend_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="recomendStatus('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="recommend">Recommend</option></select></div></div>';
                                 }

                           }
                              
                            
                   if(role==='doctor'){
                      table.row.add([ 
                      item.created_at,
                      item.first_name+' '+item.last_name,
                      item.slug || 'N/A',
                      email,
                      count,
                      medical_status,
                      user_verified,
                      edit_icon+delete_icon+eye+'</div>',
                      '<a href="javascript:;">'+item.doc_teams.length+'</a>',
                      location,
                      area,
                      address,
                      longitude,
                      latitude,
                      item.phone_number,
                      status,
                      recommend_status,
                      item.updated_at,
                      action,
                      recommend_action
                     ]);
                  }
                  else{
                      table.row.add([ 
                      item.created_at,
                      item.first_name+' '+item.last_name,
                      item.slug || 'N/A',
                      email,
                      count,
                      medical_status,
                      user_verified,
                      edit_icon+delete_icon+eye+'</div>',
                      location,
                      area,
                      address,
                      longitude,
                      latitude,
                      item.phone_number,
                      status,
                      recommend_status,
                      item.updated_at,
                      action,
                      recommend_action
                     ]);
                  }
         }); 
               table.draw();
               
            }
         });
      
     };
    function verifieUserFunction(element_id,id,type_value) {
                  $.ajaxSetup({
                   headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
                  this.is_loading = true;
                  $.ajax({
                     type:'POST',
                     url: '/admin/update/medical-verify',
                     data:{'user_id':id,'type':type_value},
                     success:function(response){
                        // console.log(response,element_id,response.status_text);
                          $('#'+element_id).text(response.status_text);
                            // self.showMessage(response.message);
                          // $('#roles').DataTable().ajax.reload();
                     },
                  });
                                             };
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
    var del_id=0;
  function delete_user(id){
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
                 $.ajaxSetup({
                   headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
               $.ajax({
               type: "POST",
               url: base+"/admin/delete-user",
               data:{'id':del_id},
               // contentType: "application/json; charset=utf-8",
               dataType: "json",
               success: function (response) {
                if(response.type==='success'){
                  $("tbody").load(location.href + "tbody");
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
        
   $(document).ready(function() {
      localStorage. setItem('clickCount', 1);
       // $('.next').addClass('next_button');
       var table = $('#roles').DataTable({
         "order": [[12, "desc"]]
       });
      $('.dataTables_filter').find('input').addClass("search_field");
      $(document).on('keyup','.search_field',function(){
       
            var search_value =$(this).val();confirm_delete
            var role =$('#role_name').val();
            var confirm_delete =$('#confirm_delete').val();
            var user_delete =$('#user_delete').val();
            var clickCount =localStorage.getItem('clickCount');
            var verified =$('#verified').val();
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
               url: base+"/users-search",
               data:{'type':request_type,'search':search_value},
               // contentType: "application/json; charset=utf-8",
               dataType: "json",
               success: function (response) {
               table.clear().draw();
               var email='';
               var count =0;
               var medical_status ='';
               var user_verified ='';
               var eye ='<a href="javascript:;" class="dc-addinfo dc-skillsaddinfo disable-eye"><i class="lnr lnr-eye"></i></a>';
               $.each(response, function(i, item) {
                 
                 if(item.area===null){
                   var area='';
                 }
                 else{
                  var area=item.area.title;
                 }
                 if(item.profile===null){
                   var address='';
                   var longitude='';
                   var latitude='';
                 }
                 else{
               
                      if(item.profile.address!==undefined)
                      {
                        if(item.profile.address!==null)
                        {
                          var address =item.profile.address
                        }
                        else{
                            var address='';
                        }
                      }
                      else{
                        var address='';
                      }
                      if(item.profile.longitude!==undefined)
                      {
                        if(item.profile.longitude!==null)
                        {
                          var longitude =item.profile.longitude
                        }
                        else{
                            var longitude='';
                        }
                      }
                      else{
                        var longitude='';
                      }
                     if(item.profile.latitude!==undefined)
                      {
                        if(item.profile.latitude!==null)
                        {
                          var latitude =item.profile.latitude
                        }
                        else{
                            var latitude='';
                        }
                      }
                      else{
                        var latitude='';
                      }
                 }
                 if(item.location===null){
                   var location='';
                 }
                 else{
                  var location=item.location.title;
                 }
                 if(item.email===null){
                    email='Not available';
                 }
                 else{
                     email=item.email;
                  }
                 if (role !=='hospital')
                 {
                      if (role === 'doctor')
                     {
                        if(item.appointments.length>0)
                        {
                           count = '<a href="'+base+'/doctor/manage-team/'+item.id+'">'+item.appointments+'</a>'
                        }
                     }
                     if (role === 'patient')
                     {
                        if(item.appointments_patient.length>0)
                        {
                     count = '<a href="'+base+'/patient/manage-team/'+item.id+'">'+item.appointments_patient+'</a>'
                         }
                      }
                  }
                  if(role === 'hospital')
                  {
                     count = '<a href="'+base+'/hospital/manage-team/'+item.id+'">'+item.teams.length+'</a>';
                         
                  }
                  if (item.profile && item.profile.verify_medical!==null && item.profile.verify_medical!==undefined)
                   {
                      medical_status='<a href="'+base+'/get/'+'users'+'/'+item.id+'/'+item.profile.verify_medical['registration_number']+'">'+item.profile.verify_medical['registration_number']+'</a>';
                   }
                  else if (role === 'patient')
                    {
                      medical_status="Not available yet";
                    }
                  else
                   {
                        medical_status="Not uploaded yet";
                   }
                  if (item.user_meta && item.user_meta.verify_registration == 1 && item.user_meta!=undefined) 
                     {  
                         var element='verify-'+item.id;
                        var type='not_verify';
                        var  user_verified='<a href="javascript:void(0)" id="'+element+'" onclick="verifieUserFunction(\''+element+'\','+item.id+',\''+type+'\')">Verfied</a>';
                     }
                  else if (role === 'patient')
                     { 
                        var user_verified ='Not available';
                     }
                  else
                     {                              
                        var element='verify-'+item.id;
                        var type='verify';
                        var  user_verified='<a href="javascript:void(0)" id="'+element+'" onclick="verifieUserFunction(\''+element+'\','+item.id+',\''+type+'\')">Not Verfied</a>';
                     }
                         
                           var edit_icon='<div class="dc-actionbtn border-0"><a href="'+base+'/admin/edit-user/'+item.id+'" class="dc-addinfo dc-skillsaddinfo"> <i class="lnr lnr-pencil"></i></a>';
                           var delete_icon ='<a href="javascript:;" id='+item.id+'  onclick="delete_user('+item.id+')" class="dc-deleteinfo delete_user"><delete :title="{{trans("lang.ph.delete_confirm_title")}}" :id="{{$user_data->id}}" :message="{{trans("lang.user_deleted")}}" :url="'+base+'admin/delete-user"></delete><i class="lnr lnr-trash"></i></a>';
                           if (role === 'doctor')
                           {
                              if(item.location ==''|| item.location == null ||  item.location =='null')
                              {
                                 eye='<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                              else
                              {
                                 eye='<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                           }
                           if (role === 'hospital')
                           {
                              if(item.location ===''|| item.location === null || item.location ==='null' || item.area ===''|| item.area === null || item.area ==='null' )
                              {
                               eye ='<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                              else
                              {
                               eye ='<a href="'+base+'/hospitals/'+item.location.slug+"/"+item.slug+"/"+item.area.slug+')" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                          }
                           if (role === 'laboratories')
                           {
                              if(item.location ===''|| item.location === null || item.location ==='null' || item.area ===''|| item.area === null || item.area ==='null' )
                              {
                                eye= '<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                              else
                              {
                                 eye='<a href="'+base+'/hospitals/'+item.location.slug+"/"+item.slug+"/"+item.area.slug+')" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                           }
                              if (role === 'patient')
                              {
                                  eye ='<a href="javascript:;" class="dc-addinfo dc-skillsaddinfo disable-eye"><i class="lnr lnr-eye"></i></a>';
                              }
                               if(role !== 'patient' && role !== 'hospital' && role !== 'laboratory')
                           {
                                if(item.status===0 || item.status==='' || item.status==='pending' || item.status=== null || item.status==='null')
                                 {
                                    status='Pending';
                                    var none='';
                                    action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="register">Register</option></select></div></div>';


                                 }
                                 else if(item.status===1 || item.status==='register')
                                 {
                                    status='Registered';
                                    var none='';
                                    action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" id="select_action" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="pending">Unregister</option><option value="block">Block</option></select></div></div>';
                                 }
                                 else if(item.status===2 || item.status==='block')
                                 {
                                    status='Blocked';
                                    var none='';
                                    action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" id="select_action" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="unblock">Unblock</option></select></div></div>';
                                 }
                                  else
                                 {
                                    status='Pending';
                                    var none='';
                                    action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="register">Register</option></select></div></div>';
                                 }
                                  if(item.recommend_status===1 || item.recommend_status==='recommend' || item.recommend_status===null || item.recommend_status==='null')
                                 {
                                    
                                   recommend_status='recommended';
                                    var recomend_none='';
                                    recommend_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" id="select_action" onchange="recomendStatus('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="unrecommend">Unrecommend</option></select></div></div>';

                                 }
                                 else
                                 {
                                    recommend_status='Unrecommended';
                                    var recomend_none='';
                                    recommend_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="recomendStatus('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="recommend">Recommend</option></select></div></div>';
                                 }

                           }
                              
                            
                   if(role==='doctor'){
                      table.row.add([ 
                      item.created_at,
                      item.first_name+' '+item.last_name,
                      item.slug || 'N/A',
                      email,
                      count,
                      medical_status,
                      user_verified,
                      edit_icon+delete_icon+eye+'</div>',
                      '<a href="javascript:;">'+item.doc_teams.length+'</a>',
                      location,
                      area,
                      address,
                      longitude,
                      latitude,
                      item.phone_number,
                      status,
                      recommend_status,
                      item.updated_at,
                      action,
                      recommend_action
                     ]);
                  }
                  else{
                      table.row.add([ 
                      item.created_at,
                      item.first_name+' '+item.last_name,
                      item.slug || 'N/A',
                      email,
                      count,
                      medical_status,
                      user_verified,
                      edit_icon+delete_icon+eye+'</div>',
                      location,
                      area,
                      address,
                      longitude,
                      latitude,
                      item.phone_number,
                      status,
                      recommend_status,
                      item.updated_at,
                      action,
                      recommend_action
                     ]);
                  }
         }); 
               table.draw();
            },
         });
      });
      $(document).on('click', '.next', function () {
            // console.log("clicked");
            var role =$('#role_name').val();
             var confirm_delete =$('#confirm_delete').val();
            var user_delete =$('#user_delete').val();
            var clickCount =localStorage.getItem('clickCount');
            // console.log(clickCount,'click value');
            var verified =$('#verified').val();
            var url      = window.location.href;
            var base      = window.location.origin;
            var request_type=url.split('/');
            var status = '';
            var recommend_status='';
            var recommend_action='';
            var action='';
            // console.log(url,request_type,base);    
            request_type=request_type[4];
            $.ajax({
               type: "GET",
               url: url,
               data:{'type':request_type,'clickCount':clickCount},
               // contentType: "application/json; charset=utf-8",
               dataType: "json",
               success: function (response) {
               // console.log(response);
                 $(".next").removeAttr("disabled");
               localStorage. setItem('clickCount', response[1]);
               var email='';
               var count =0;
               var medical_status ='';
                 
                $.each(response[0], function(i, item) {
                    // console.log(item.profile.verify_medical,item.profile.address,item.profile.longitude);
                  if(item.profile.verify_medical!== undefined)
                  // console.log(item.profile.verify_medical,item.id);
                 if(item.area===null){
                   var area='';
                 }
                 else{
                  var area=item.area.title;
                 }
                 if(item.location===null){
                   var location='';
                 }
                 else{
                  var location=item.location.title;
                 }
                 if(item.email===null){
                    email='Not available';
                 }
                 else{
                     email=item.email;
                 } 
                 if(item.profile===null){
                   var address='';
                   var longitude='';
                   var latitude='';
                 }
                 else{
               
                      if(item.profile.address!==undefined)
                      {
                        if(item.profile.address!==null)
                        {
                          var address =item.profile.address
                        }
                        else{
                            var address='';
                        }
                      }
                      else{
                        var address='';
                      }
                      if(item.profile.longitude!==undefined)
                      {
                        if(item.profile.longitude!==null)
                        {
                          var longitude =item.profile.longitude
                        }
                        else{
                            var longitude='';
                        }
                      }
                      else{
                        var longitude='';
                      }
                     if(item.profile.latitude!==undefined)
                      {
                        if(item.profile.latitude!==null)
                        {
                          var latitude =item.profile.latitude
                        }
                        else{
                            var latitude='';
                        }
                      }
                      else{
                        var latitude='';
                      }
                 }
                 if (role !=='hospital')
                 {
                      if (role === 'doctor')
                     {
                        if(item.appointments.length>0)
                        {
                           count = '<a href="'+base+'/doctor/manage-team/'+item.id+'">'+item.appointments+'</a>'
                        }
                     }
                     if (role === 'patient')
                     {
                        if(item.appointments_patient.length>0)
                        {
                     count = '<a href="'+base+'/patient/manage-team/'+item.id+'">'+item.appointments_patient+'</a>'
                         }
                      }
                  }
                  if(role === 'hospital')
                  {
                     count = '<a href="'+base+'/hospital/manage-team/'+item.id+'">'+item.teams.length+'</a>';
                         
                  }
                  if (item.profile.verify_medical!==null && item.profile.verify_medical!==undefined)
                   {
                       medical_status='<a href="'+base+'/get/'+'users'+'/'+item.id+'/'+item.profile.verify_medical['registration_number']+'">'+item.profile.verify_medical['registration_number']+'</a>';  
                   }
                  else if (role === 'patient')
                    {
                      medical_status="Not available yet";
                    }
                  else
                   {
                        medical_status="Not uploaded yet";
                   }
                   
                  if (item.user_meta.verify_registration == 1 && item.user_meta!=undefined) 
                     {  
                        //element="verify_cell-"+item.id.toString();
                        var element='verify-'+item.id;
                        var type='not_verify';
                        var  user_verified='<a href="javascript:void(0)" id="'+element+'" onclick="verifieUserFunction(\''+element+'\','+item.id+',\''+type+'\')">Verfied</a>';
                     }
                  else if (role === 'patient')
                     { 
                        var user_verified ='Not available';
                     }
                  else
                     {                              //element="verify_cell-"+item.id.toString();
                        var element='verify-'+item.id;
                        var type='verify';
                        var  user_verified='<a href="javascript:void(0)" id="'+element+'" onclick="verifieUserFunction(\''+element+'\','+item.id+',\''+type+'\')">Not Verfied</a>';
                     }
                  
                     var edit_icon=
                           '<div class="dc-actionbtn border-0"><a href="'+base+'/admin/edit-user/'+item.id+'"  class="dc-addinfo dc-skillsaddinfo"> <i class="lnr lnr-pencil"></i></a>';
                          var delete_icon ='<a href="javascript:;" onclick="delete_user('+item.id+')" id='+item.id+' class="dc-deleteinfo delete_user"><i class="lnr lnr-trash"></i></a>';
                           if (role === 'doctor')
                           {
                              if(item.location ==''|| item.location == null || item.location =='null')
                              {
                                 eye='<a href="'+base+'/profile/"'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                              else
                              {
                                 eye='<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                           }
                           if (role === 'hospital')
                           {
                              if(item.location ===''|| item.location === null || item.location ==='null' || item.area ===''|| item.area === null || item.area ==='null' )
                              {
                               eye ='<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                              else
                              {
                               eye ='<a href="'+base+'/hospitals/'+item.location.slug+'"/"'+item.slug+'"/"'+item.area.slug+')" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                          }
                           if (role === 'laboratories')
                           {
                              if(item.location ===''|| item.location === null || item.location ==='null' || item.area ===''|| item.area === null || item.area ==='null' )
                              {
                                eye= '<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                              else
                              {
                                 eye='<a href="'+base+'/hospitals/'+item.location.slug+'"/"'+item.slug+'"/"'+item.area.slug+')" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                           }
                              if (role === 'patient')
                              {
                                  eye ='<a href="javascript:;" class="dc-addinfo dc-skillsaddinfo disable-eye"><i class="lnr lnr-eye"></i></a>';
                              }
                               if(role !== 'patient' && role !== 'hospital' && role !== 'laboratory')
                           {
                                 if(item.status===0 || item.status==='' || item.status==='pending' || item.status=== null || item.status==='null')
                                 {
                                    status='Pending';
                                    var none='';
                                    action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="register">Register</option></select></div></div>';


                                 }
                                 else if(item.status===1 || item.status==='register')
                                 {
                                    status='Registered';
                                    var none='';
                                    action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" id="select_action" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="pending">Unregister</option><option value="block">Block</option></select></div></div>';
                                 }
                                 else if(item.status===2 || item.status==='block')
                                 {
                                    status='Blocked';
                                    var none='';
                                    action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" id="select_action" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="unblock">Unblock</option></select></div></div>';
                                 }
                                  else
                                 {
                                    status='Pending';
                                    var none='';
                                    action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="register">Register</option></select></div></div>';
                                 }
                                   if(item.recommend_status===1 || item.recommend_status==='recommend' || item.recommend_status===null || item.recommend_status==='null')
                                 {
                                    
                                   recommend_status='recommended';
                                    var recomend_none='';
                                    recommend_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" id="select_action" onchange="recomendStatus('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="unrecommend">Unrecommend</option></select></div></div>';

                                 }
                                 else
                                 {
                                    recommend_status='Unrecommended';
                                    var recomend_none='';
                                    recommend_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="recomendStatus('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="recommend">Recommend</option></select></div></div>';
                                 }

                           }
                   if(role=='doctor'){
                      table.row.add([ 
                      item.created_at,
                      item.first_name+' '+item.last_name,
                      item.slug || 'N/A',
                      email,
                      count,
                      medical_status,
                      user_verified,
                      edit_icon+delete_icon+eye+'</div>',
                      '<a href="javascript:;">'+item.doc_teams.length+'</a>',
                      location,
                      area,
                      address,
                      longitude,
                      latitude,
                      item.phone_number,
                      status,
                      recommend_status,
                      item.updated_at,
                      action,
                      recommend_action
                     ]);
                  }
                  else{
                      table.row.add([ 
                      item.created_at,
                      item.first_name+' '+item.last_name,
                      item.slug || 'N/A',
                      email,
                      count,
                      medical_status,
                      user_verified,
                      edit_icon+delete_icon+eye+'</div>',
                      location,
                      area,
                      address,
                      longitude,
                      latitude,
                      item.phone_number,
                      status,
                      recommend_status,
                      item.updated_at,
                      action,
                      recommend_action
                     ]);
                  }
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
<script>
function showDropDown(id,value)
{
      var value=value;
     var base  = window.location.origin;
      var table = $('#roles').DataTable();
      var role =$('#role_name').val();
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
               url: base+"/admin/status-change-user",
               data:{'type':request_type,'selected':value,'id':id},
               // contentType: "application/json; charset=utf-8",
               dataType: "json",
               success: function (response) {
               table.clear().draw();
               var email='';
               var count =0;
               var medical_status ='';
               var user_verified ='';
               var status='';
               var recommend_status='';
               var recommend_action='';
               var action='';
               var list ='';
               var eye ='<a href="javascript:;" class="dc-addinfo dc-skillsaddinfo disable-eye"><i class="lnr lnr-eye"></i></a>';  

   
               $.each(response.role_based_users, function(i, item) {
                 
                 if(item.area===null){
                   var area='';
                 }
                 else{
                  var area=item.area.title;
                 }
                 if(item.profile===null){
                   var address='';
                   var longitude='';
                   var latitude='';
                 }
                 else{
               
                      if(item.profile.address!==undefined)
                      {
                        if(item.profile.address!==null)
                        {
                          var address =item.profile.address
                        }
                        else{
                            var address='';
                        }
                      }
                      else{
                        var address='';
                      }
                      if(item.profile.longitude!==undefined)
                      {
                        if(item.profile.longitude!==null)
                        {
                          var longitude =item.profile.longitude
                        }
                        else{
                            var longitude='';
                        }
                      }
                      else{
                        var longitude='';
                      }
                     if(item.profile.latitude!==undefined)
                      {
                        if(item.profile.latitude!==null)
                        {
                          var latitude =item.profile.latitude
                        }
                        else{
                            var latitude='';
                        }
                      }
                      else{
                        var latitude='';
                      }
                 }
                 if(item.location===null){
                   var location='';
                 }
                 else{
                  var location=item.location.title;
                 }
                 if(item.email===null){
                    email='Not available';
                 }
                 else{
                     email=item.email;
                  }
                 if (role !=='hospital')
                 {
                      if (role === 'doctor')
                     {
                        if(item.appointments.length>0)
                        {
                           count = '<a href="'+base+'/doctor/manage-team/'+item.id+'">'+item.appointments+'</a>'
                        }
                     }
                     if (role === 'patient')
                     {
                        if(item.appointments_patient.length>0)
                        {
                     count = '<a href="'+base+'/patient/manage-team/'+item.id+'">'+item.appointments_patient+'</a>'
                         }
                      }
                  }
                  if(role === 'hospital')
                  {
                     count = '<a href="'+base+'/hospital/manage-team/'+item.id+'">'+item.teams.length+'</a>';
                         
                  }
                  if (item.profile.verify_medical!==null && item.profile.verify_medical!==undefined)
                   {
                      medical_status='<a href="'+base+'/get/'+'users'+'/'+item.id+'/'+item.profile.verify_medical['registration_number']+'">'+item.profile.verify_medical['registration_number']+'</a>';
                   }
                  else if (role === 'patient')
                    {
                      medical_status="Not available yet";
                    }
                  else
                   {
                        medical_status="Not uploaded yet";
                   }
                  if (item.user_meta.verify_registration == 1 && item.user_meta!=undefined) 
                     {  
                         var element='verify-'+item.id;
                        var type='not_verify';
                        var  user_verified='<a href="javascript:void(0)" id="'+element+'" onclick="verifieUserFunction(\''+element+'\','+item.id+',\''+type+'\')">Verfied</a>';
                     }
                  else if (role === 'patient')
                     { 
                        var user_verified ='Not available';
                     }
                  else
                     {                              
                        var element='verify-'+item.id;
                        var type='verify';
                        var  user_verified='<a href="javascript:void(0)" id="'+element+'" onclick="verifieUserFunction(\''+element+'\','+item.id+',\''+type+'\')">Not Verfied</a>';
                     }
                         
                           var edit_icon='<div class="dc-actionbtn border-0"><a href="'+base+'/admin/edit-user/'+item.id+'" class="dc-addinfo dc-skillsaddinfo"> <i class="lnr lnr-pencil"></i></a>';
                           var delete_icon ='<a href="javascript:;" id='+item.id+'  onclick="delete_user('+item.id+')" class="dc-deleteinfo delete_user"><delete :title="{{trans("lang.ph.delete_confirm_title")}}" :id="{{$user_data->id}}" :message="{{trans("lang.user_deleted")}}" :url="'+base+'admin/delete-user"></delete><i class="lnr lnr-trash"></i></a>';
                           if (role === 'doctor')
                           {
                              if(item.location ==''|| item.location == null ||  item.location =='null')
                              {
                                 eye='<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                              else
                              {
                                 eye='<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                           }
                           if (role === 'hospital')
                           {
                              if(item.location ===''|| item.location === null || item.location ==='null' || item.area ===''|| item.area === null || item.area ==='null' )
                              {
                               eye ='<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                              else
                              {
                               eye ='<a href="'+base+'/hospitals/'+item.location.slug+"/"+item.slug+"/"+item.area.slug+')" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                          }
                           if (role === 'laboratories')
                           {
                              if(item.location ===''|| item.location === null || item.location ==='null' || item.area ===''|| item.area === null || item.area ==='null' )
                              {
                                eye= '<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                              else
                              {
                                 eye='<a href="'+base+'/hospitals/'+item.location.slug+"/"+item.slug+"/"+item.area.slug+')" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                           }
                              if (role === 'patient')
                              {
                                  eye ='<a href="javascript:;" class="dc-addinfo dc-skillsaddinfo disable-eye"><i class="lnr lnr-eye"></i></a>';
                              }

                                 if(role !== 'patient' && role !== 'hospital' && role !== 'laboratory')
                           {
                                 if(item.status===0 || item.status==='' || item.status==='pending' || item.status=== null || item.status==='null')
                                 {
                                    status='Pending';
                                    var none='';
                                    action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="register">Register</option></select></div></div>';


                                 }
                                 else if(item.status===1 || item.status==='register')
                                 {
                                    status='Registered';
                                    var none='';
                                    action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" id="select_action" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="pending">Unregister</option><option value="block">Block</option></select></div></div>';
                                 }
                                 else if(item.status===2 || item.status==='block')
                                 {
                                    status='Blocked';
                                    var none='';
                                    action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" id="select_action" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="unblock">Unblock</option></select></div></div>';
                                 }
                                  else
                                 {
                                    status='Pending';
                                    var none='';
                                    action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="register">Register</option></select></div></div>';
                                 }
                                   if(item.recommend_status===1 || item.recommend_status==='recommend' || item.recommend_status===null || item.recommend_status==='null')
                                 {
                                    
                                   recommend_status='recommended';
                                    var recomend_none='';
                                    recommend_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" id="select_action" onchange="recomendStatus('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="unrecommend">Unrecommend</option></select></div></div>';

                                 }
                                 else
                                 {
                                    recommend_status='Unrecommended';
                                    var recomend_none='';
                                    recommend_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="recomendStatus('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="recommend">Recommend</option></select></div></div>';
                                 }


                           }
                              
                            
                   if(role==='doctor'){
                      table.row.add([ 
                      item.created_at,
                      item.first_name+' '+item.last_name,
                      item.slug || 'N/A',
                      email,
                      count,
                      medical_status,
                      user_verified,
                      edit_icon+delete_icon+eye+'</div>',
                      '<a href="javascript:;">'+item.doc_teams.length+'</a>',
                      location,
                      area,
                      address,
                      longitude,
                      latitude,
                      item.phone_number,
                      status,
                      recommend_status,
                      item.updated_at,
                      action,
                      recommend_action
                     ]);
                  }
                  else{
                      table.row.add([ 
                      item.created_at,
                      item.first_name+' '+item.last_name,
                      item.slug || 'N/A',
                      email,
                      count,
                      medical_status,
                      user_verified,
                      edit_icon+delete_icon+eye+'</div>',
                      location,
                      area,
                      address,
                      longitude,
                      latitude,
                      item.phone_number,
                      status,
                      recommend_status,
                      item.updated_at,
                      action,
                      recommend_action
                     ]);
                  }
         }); 
               table.draw();
               
            }
         });
}
</script>
<script>
function recomendStatus(id,value)
{
      var value=value;
     var base  = window.location.origin;
      var table = $('#roles').DataTable();
      var role =$('#role_name').val();
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
               url: base+"/admin/recomend-status-change-user",
               data:{'type':request_type,'selected':value,'id':id},
               // contentType: "application/json; charset=utf-8",
               dataType: "json",
               success: function (response) {
               table.clear().draw();
               var email='';
               var count =0;
               var medical_status ='';
               var user_verified ='';
               var status='';
               var action='';
               var recommend_status='';
               var recommend_action='';
               var list ='';
               var eye ='<a href="javascript:;" class="dc-addinfo dc-skillsaddinfo disable-eye"><i class="lnr lnr-eye"></i></a>';  

   
               $.each(response.role_based_users, function(i, item) {
                 
                 if(item.area===null){
                   var area='';
                 }
                 else{
                  var area=item.area.title;
                 }
                 if(item.profile===null){
                   var address='';
                   var longitude='';
                   var latitude='';
                 }
                 else{
               
                      if(item.profile.address!==undefined)
                      {
                        if(item.profile.address!==null)
                        {
                          var address =item.profile.address
                        }
                        else{
                            var address='';
                        }
                      }
                      else{
                        var address='';
                      }
                      if(item.profile.longitude!==undefined)
                      {
                        if(item.profile.longitude!==null)
                        {
                          var longitude =item.profile.longitude
                        }
                        else{
                            var longitude='';
                        }
                      }
                      else{
                        var longitude='';
                      }
                     if(item.profile.latitude!==undefined)
                      {
                        if(item.profile.latitude!==null)
                        {
                          var latitude =item.profile.latitude
                        }
                        else{
                            var latitude='';
                        }
                      }
                      else{
                        var latitude='';
                      }
                 }
                 if(item.location===null){
                   var location='';
                 }
                 else{
                  var location=item.location.title;
                 }
                 if(item.email===null){
                    email='Not available';
                 }
                 else{
                     email=item.email;
                  }
                 if (role !=='hospital')
                 {
                      if (role === 'doctor')
                     {
                        if(item.appointments.length>0)
                        {
                           count = '<a href="'+base+'/doctor/manage-team/'+item.id+'">'+item.appointments+'</a>'
                        }
                     }
                     if (role === 'patient')
                     {
                        if(item.appointments_patient.length>0)
                        {
                     count = '<a href="'+base+'/patient/manage-team/'+item.id+'">'+item.appointments_patient+'</a>'
                         }
                      }
                  }
                  if(role === 'hospital')
                  {
                     count = '<a href="'+base+'/hospital/manage-team/'+item.id+'">'+item.teams.length+'</a>';
                         
                  }
                  if (item.profile.verify_medical!==null && item.profile.verify_medical!==undefined)
                   {
                      medical_status='<a href="'+base+'/get/'+'users'+'/'+item.id+'/'+item.profile.verify_medical['registration_number']+'">'+item.profile.verify_medical['registration_number']+'</a>';
                   }
                  else if (role === 'patient')
                    {
                      medical_status="Not available yet";
                    }
                  else
                   {
                        medical_status="Not uploaded yet";
                   }
                  if (item.user_meta.verify_registration == 1 && item.user_meta!=undefined) 
                     {  
                         var element='verify-'+item.id;
                        var type='not_verify';
                        var  user_verified='<a href="javascript:void(0)" id="'+element+'" onclick="verifieUserFunction(\''+element+'\','+item.id+',\''+type+'\')">Verfied</a>';
                     }
                  else if (role === 'patient')
                     { 
                        var user_verified ='Not available';
                     }
                  else
                     {                              
                        var element='verify-'+item.id;
                        var type='verify';
                        var  user_verified='<a href="javascript:void(0)" id="'+element+'" onclick="verifieUserFunction(\''+element+'\','+item.id+',\''+type+'\')">Not Verfied</a>';
                     }
                         
                           var edit_icon='<div class="dc-actionbtn border-0"><a href="'+base+'/admin/edit-user/'+item.id+'" class="dc-addinfo dc-skillsaddinfo"> <i class="lnr lnr-pencil"></i></a>';
                           var delete_icon ='<a href="javascript:;" id='+item.id+'  onclick="delete_user('+item.id+')" class="dc-deleteinfo delete_user"><delete :title="{{trans("lang.ph.delete_confirm_title")}}" :id="{{$user_data->id}}" :message="{{trans("lang.user_deleted")}}" :url="'+base+'admin/delete-user"></delete><i class="lnr lnr-trash"></i></a>';
                           if (role === 'doctor')
                           {
                              if(item.location ==''|| item.location == null ||  item.location =='null')
                              {
                                 eye='<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                              else
                              {
                                 eye='<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                           }
                           if (role === 'hospital')
                           {
                              if(item.location ===''|| item.location === null || item.location ==='null' || item.area ===''|| item.area === null || item.area ==='null' )
                              {
                               eye ='<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                              else
                              {
                               eye ='<a href="'+base+'/hospitals/'+item.location.slug+"/"+item.slug+"/"+item.area.slug+')" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                          }
                           if (role === 'laboratories')
                           {
                              if(item.location ===''|| item.location === null || item.location ==='null' || item.area ===''|| item.area === null || item.area ==='null' )
                              {
                                eye= '<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                              else
                              {
                                 eye='<a href="'+base+'/hospitals/'+item.location.slug+"/"+item.slug+"/"+item.area.slug+')" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                           }
                              if (role === 'patient')
                              {
                                  eye ='<a href="javascript:;" class="dc-addinfo dc-skillsaddinfo disable-eye"><i class="lnr lnr-eye"></i></a>';
                              }

                                 if(role !== 'patient' && role !== 'hospital' && role !== 'laboratory')
                           {
                                if(item.status===0 || item.status==='' || item.status==='pending' || item.status=== null || item.status==='null')
                                 {
                                    status='Pending';
                                    var none='';
                                    action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="register">Register</option></select></div></div>';


                                 }
                                 else if(item.status===1 || item.status==='register')
                                 {
                                    status='Registered';
                                    var none='';
                                    action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" id="select_action" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="pending">Unregister</option><option value="block">Block</option></select></div></div>';
                                 }
                                 else if(item.status===2 || item.status==='block')
                                 {
                                    status='Blocked';
                                    var none='';
                                    action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" id="select_action" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="unblock">Unblock</option></select></div></div>';
                                 }
                                  else
                                 {
                                    status='Pending';
                                    var none='';
                                    action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="register">Register</option></select></div></div>';
                                 }
                                  if(item.recommend_status===1 || item.recommend_status==='recommend' || item.recommend_status===null || item.recommend_status==='null')
                                 {
                                    
                                   recommend_status='recommended';
                                    var recomend_none='';
                                    recommend_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" id="select_action" onchange="recomendStatus('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="unrecommend">Unrecommend</option></select></div></div>';

                                 }
                                 else
                                 {
                                    recommend_status='Unrecommended';
                                    var recomend_none='';
                                    recommend_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="recomendStatus('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="recommend">Recommend</option></select></div></div>';
                                 }

                           }
                              
                            
                   if(role==='doctor'){
                      table.row.add([ 
                      item.created_at,
                      item.first_name+' '+item.last_name,
                      item.slug || 'N/A',
                      email,
                      count,
                      medical_status,
                      user_verified,
                      edit_icon+delete_icon+eye+'</div>',
                      '<a href="javascript:;">'+item.doc_teams.length+'</a>',
                      location,
                      area,
                      address,
                      longitude,
                      latitude,
                      item.phone_number,
                      status,
                      recommend_status,
                      item.updated_at,
                      action,
                      recommend_action
                     ]);
                  }
                  else{
                      table.row.add([ 
                      item.created_at,
                      item.first_name+' '+item.last_name,
                      item.slug || 'N/A',
                      email,
                      count,
                      medical_status,
                      user_verified,
                      edit_icon+delete_icon+eye+'</div>',
                      location,
                      area,
                      address,
                      longitude,
                      latitude,
                      item.phone_number,
                      status,
                      recommend_status,
                      item.updated_at,
                      action,
                      recommend_action
                     ]);
                  }
         }); 
               table.draw();
               
            }
         });
}
</script>   
<!-- <script>
   $(document).ready(function() {
    $('#roles').DataTable({});
   } );
</script> -->
@endpush
