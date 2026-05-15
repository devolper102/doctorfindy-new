@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@push('backend_stylesheets')
<link href="{{ asset('css/basictable.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/media/css/site-examples.css?_=2335fc41d55494e8cfce6bcc069c6419">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">
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
   table.dataTable thead .sorting:before, table.dataTable thead .sorting_asc:before,thead .sorting_desc:before{
      top: auto;
   }
   table.dataTable thead .sorting:after
   ,table.dataTable thead .sorting_asc:after,
   table.dataTable thead .sorting_desc:after, table.dataTable{
      right: 1.3em;
   }
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
   }
   td{
      padding-top: 15px !important;
      padding-bottom: 15px !important;
      border-top:1px solid #dddddd !important;
      border-bottom:1px solid #dddddd !important;
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
                        <h3>{{ 'All Branches'}}</h3>
                        <!--  <ul class="breadcrumb">
                           <li class="breadcrumb-item active">Dashboard</li>
                           </ul> -->
                     </div>
                  </div>
               </div>
              
              
               <div class="row">
                  <div class="col-xl-3 col-sm-6 col-12">
                     <div class="card">
                        <div class="card-body">
                           <div class="dash-widget-header">
                              <span class="dash-widget-icon text-primary border-primary">
                              <i class="fa fa-flask"></i>
                              </span>
                              <div class="dash-count">
                                 <h3>100</h3>
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
               <div class="dc-rightarea">
                  <form action="{{ route('labs.create')}}" method="get">
                     <input type="submit" name="submit"class="dc-btn" value="Add new Branch">
                     <!-- <a href="{{ route('adminAddUser')}}" class="dc-btn">Add new user</a> -->
                  </form>
               </div>
            </div>
            @if (!empty($branches))
            <div class="dc-dashboardboxcontent dc-categoriescontentholder">
               <table id="roles"class=" blank_td table table-bordered table-hover dt-responsive nowrap display nowrap table-responsive"style="width: 100%;">
                  <thead class=" border-top border-bottom">
                     <tr class=" border-top border-bottom">
                        <th class=" font-weight-bold text-14 border-top border-bottom">{{ trans('lang.branch') }}</th>
                        <th class=" font-weight-bold text-14 border-top border-bottom">{{ trans('lang.city') }}</th>
                        <th class="none  font-weight-bold text-14 border-top border-bottom">{{ trans('lang.parent_lab') }}</th>
                        <th class="none  font-weight-bold text-14">{{trans('lang.phone_no')}}</th>
                        <th class=" text-14 font-weight-bold">{{ trans('lang.action') }}</th>
                        <th class="none  text-14 font-weight-bold border-top border-bottom">Created Date</th>
                        <th class="none  text-14 font-weight-bold border-top border-bottom">Updated Date</th>
                     </tr>
                  </thead>
                  <tbody class="">
                      @php $counter = 0; @endphp
                        @foreach ($branches as $key => $branch)
                        <tr class="del-{{{ $branch->id }}}">
                           <td>{{$branch->name}}</td>
                           <td>{{$branch->location->title ?? ''}}</td>
                           <td>{{$branch->user->full_name ?? ''}}</td>
                           <td>{{$branch->user->phone_number ?? ''}}</td>
                           <td>
                              <div class="dc-actionbtn">
                                   <a href="{{route('labs.edit',$branch->id) }}" class="dc-addinfo dc-skillsaddinfo">
                                       <i class="lnr lnr-pencil"></i>
                                   </a>
                           
                               <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ intVal(clean($branch->id)) }}'" :message="'{{trans("Branch Deleted Successfully")}}'" :url="'{{route('labs.destroy',$branch->id)}}'" :redirect_url="'{{url('admin/labs')}}'"></delete>

                               </div>
                           </td>
                           <td>{{$branch->created_at}}</td>
                           <td>{{$branch->updated_at}}</td>
                        </tr>
                        @endforeach
                  </tbody>
               </table>
             
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
{{--<script src="{{ asset('js/jquery.basictable.min.js') }}"></script>--}}
<!-- <script type="text/javascript">
   jQuery('.dc-table-responsive').basictable({
           breakpoint: 767,
   });
   </script> -->

<script>
   
   $(document).ready(function() {
    var table = $('#roles').DataTable();
} );

</script>   
<!-- <script>
   $(document).ready(function() {
    $('#roles').DataTable({});
   } );
</script> -->
@endpush