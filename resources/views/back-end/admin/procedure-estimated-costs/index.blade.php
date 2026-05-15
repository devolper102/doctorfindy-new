@extends('back-end.master')
@push('backend_stylesheets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<style type="text/css">
  
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
                        
                       
                        @if ($procedure_costs->count() > 0)
                        <div class="col-md-12">
                        
                            <!-- Recent Orders -->
                            <div class="card card-table">
                                <div class="dc-dashboardboxtitle dc-titlewithsearch dc-titlewithdel">
                                    <h2>Surgery Estimated Cost</h2>
                                </div>
                                <div class="card-body">
                                        <div class="col-4 pl-lg-0 pl-md-0">
                     <label>Select Status</label>
                     <div class="dateMain" style="width: 100%;">
    <select onchange="filterStatus(this.value)" style="width: 100%;">
             <option selected disabled>Select status</option>
             <option  value="accepted">Accepted</option>
             <option value="pending">Pending</option>
             <option value="cancel">Cancel</option>
             <option value="flag">Flag</option>
   </select>
</div>
                  </div>
                                        <table class="table table-bordered table-hover dt-responsive nowrap table-responsive"id="procedure_costs_table">
                                            <thead>
                                                <tr>
                                                    <th>Full Name</th>
                                                    <th>Email</th> 
                                                    <th>DOB</th>
                                                    <th>Surgery</th>
                                                    <th>Phone Number</th>
                                                    <th>Hospital</th>
                                                    <th>Status</th>
                                                    <th>Created at</th>
                                                    <th>Updated At</th>
                                                    <th class="action">{{{ trans('lang.action') }}}</th>
                                                    
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($procedure_costs as  $key => $cost)

                                                <tr>
                        
                                                    <td>
                                                    {{$cost->first_name}}
                                                        
                                                    </td>
                                                    <td>
                                                    {{$cost->email}}
                                                        
                                                    </td>
                                                    <td>
                                                    {{$cost->dob}}
                                                        
                                                    </td>
                                                    <td><a href="#">{{optional($cost->procedures)->title}}</a></td>
                                                    <td>
                                                    {{$cost->phone_number}}
                                                        
                                                    </td>
                                                    @php
                            $app_hospital = App\User::where('id',$cost->hospital_id)->with('profile')->first();
                            
                        @endphp
                                                    <td><a href="#">{{Helper::getUserData($app_hospital->id)}}</a>
                                                    </td>
                                                    <td>
                                                    {{$cost->status}}
                                                        
                                                    </td>
                                                     <td>
                                                    {{$cost->created_at->format('M d, Y h:i A')}}
                                                </td>
                                                <td>
                                                    {{$cost->updated_at->format('M d, Y h:i A')}}
                                                </td>
                                                     <td>
                                                    <div class="dc-actionbtn">
                                                        <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ $cost->id }}'" :message="'{{'Procedure Cost Deleted Successfully'}}'" :url="'{{url('admin/procedure-cost/delete')}}'" :redirect_url="'{{url('admin/procedure-cost')}}'"></delete>
                                                    </div>
                                                    </td>
                                                    
                                                </tr>
                                                <div id="message"></div>
                                                @endforeach
                                            </tbody>
                                        </table>
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
        jQuery('#procedure_costs_table').DataTable();
      } );
      function filterStatus(status){
      // alert(startDate.format("YYYY-MM-DD"))
   
      // alert(id);
      var base      = window.location.origin;
      var table = $('#procedure_costs_table').DataTable();
      var url  = window.location.href;
      // var request_type=url.split('/');
      // console.log('type',request_type[4])  
      // request_type=request_type[4];


                 $.ajaxSetup({
                   headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
               $.ajax({
               type: "GET",
               url: base+"/admin/procedure-status-filter",
               data:{'status':status},
               // contentType: "application/json; charset=utf-8",
               dataType: "json",
               success: function (response) {
               console.log('response', response);
               table.clear().draw();
               $.each(response.procedures, function(i, item) {
                if(item.first_name === null){
                   var first_name = '';
                 }
                 else{
                  var first_name = item.first_name;
                 }
                 if(item.last_name === null){
                   var last_name = '';
                 }
                 else{
                  var last_name = item.last_name;
                 }
                  var full_name = first_name+' '+last_name;

               if(item.email === null){
                   var email = '';
                 }
                 else{
                  var email = item.email;

                 }
                 if(item.dob === null){
                   var dob = '';
                 }
                 else{
                  var dob = item.dob;
                 }
                 if(item.procedure_id === null){
                   var procedure_id = '';
                 }
                 else{
                  var procedure_id = item.procedures.title;

                 }
                 if(item.phone_number === null){
                   var phone_number = '';
                 }
                 else{
                  var phone_number = item.phone_number;

                 }
                 if(item.hospital_id === null){
                   var hospital_id = '';
                 }
                 else{
                  var hospital_id = item.hospital_data.first_name+' '+item.hospital_data.last_name;
                 }
                 if(item.created_at === null){
                   var created_at = '';
                 }
                 else{
                  var created_at = item.created_at;
                 }
                 if(item.status === null){
                   var charges = '';
                 }
                 else{
                  var status = item.status;

                 }
                 
               
                 if(item.updated_at === null){
                   var updated_at = '';
                 }
                 else{
                  var updated_at = item.updated_at;
                 }
                 var delete_icon ='<a href="javascript:" id='+item.id+' onclick="delete_procedure('+item.id+')" class="dc-deleteinfo dc-actionbtn"><i class="lnr lnr-trash"></i></a>';

               table.row.add([ 
                full_name,
                email,
                dob,
                procedure_id,
                phone_number,
                hospital_id,
                status,
                created_at,
                updated_at,
                delete_icon,
                ]);
               });
               table.draw();
               }
           });
           };
function delete_procedure(id){
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
               url: base+"/admin/procedure-cost/delete",
               data:{'id':del_id},
               // contentType: "application/json; charset=utf-8",
               dataType: "json",
               success: function (response) {
                if(response.type==='success'){
                    window.location=base+"/admin/procedure-cost";
                }
               
            }
         });
      });
    </script>
@endpush
