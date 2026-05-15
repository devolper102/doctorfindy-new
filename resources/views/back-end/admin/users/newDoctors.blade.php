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
   table.dataTable.no-footer{
      border-bottom: 1px solid #dee2e6 !important;
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
               
               
               
            </div>
           
            @if (!empty($role_based_users))
            <div class="dc-dashboardboxcontent dc-categoriescontentholder mt-3">
               <table id="roles"class=" blank_td table table-bordered table-hover dt-responsive nowrap display nowrap table-responsive"style="width: 100%;">
                  <thead class=" border-top border-bottom">
                     <tr class=" border-top border-bottom">
                        <th class=" font-weight-bold text-14 border-top border-bottom">{{{ trans('lang.user_name') }}}</th>
                        <th class=" font-weight-bold text-14 border-top border-bottom">{{{ trans('lang.ph_email') }}}</th>
                        <th class="none  text-14 font-weight-bold border-top border-bottom">Created Date</th>
                        <th class="none  text-14 font-weight-bold border-top border-bottom">Updated Date</th>
                        <th class=" font-weight-bold text-14 border-top border-bottom">Speciality</th>
                        <th class="none  font-weight-bold text-14">Phone</th>
                        <th class="none  font-weight-bold text-14">Location</th>
                        <th class="none  font-weight-bold text-14">Area</th>
                        <th class="none  font-weight-bold text-14">Status</th>
                        <th class="none  font-weight-bold text-14">Approve Status</th>

                        <th class=" text-14 font-weight-bold">{{{ trans('lang.action') }}}</th>
                        
                        <th class="none  text-14 font-weight-bold border-top border-bottom">Approve Doctor</th>
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
                    
                     
                     
                     <tr class="del-{{{ $user_data->id }}} ">
                        <td class=" text-14">{{{ ucwords(\App\Helper::getUserName($user_data->id)) }}}</td> 

                        @if($user_data->email !== null && $user_data->email !== 'null' && $user_data->email !== '') 
                        <td class="">{{{ clean($user_data->email) }}}</td>
                         @else
                        <td class="">Not Available</td>
                        @endif

                         <td class="">{{{ clean(@$user_data->created_at->format('M d, Y, h:i A')) }}}</td>
                        <td class="">{{{ clean(@$user_data->updated_at->format('M d, Y, h:i A')) }}}</td>
                        @if(count($user_data->specialities) == '0')               
                         <td class="">No Speciality</td>
                        @else
                        <td class="">{{$user_data->specialities[0]->title}}</td>
                        

                        @endif

                        @if($user_data->phone_number !== null && $user_data->phone_number !== 'null' && $user_data->phone_number !== '') 
                        <td class="">{{{ clean(@$user_data->phone_number) }}}</td>
                        @else
                        <td class="">Not Available</td>
                        @endif

                        @if($user_data->location !== null && $user_data->location !== 'null' && $user_data->location !== '') 
                        <td class="">{{{ clean(@$user_data->location->title) }}}</td>
                        @else
                        <td class="">Not Available</td>
                        @endif

                        @if($user_data->area !== null && $user_data->area !== 'null' && $user_data->area !== '') 
                        <td class="">{{{ clean(@$user_data->area->title) }}}</td>
                        @else
                        <td class="">Not Available</td>
                        @endif

                        @if($user_data->status===0 || $user_data->status==='' || $user_data->status==='pending')
                                                <td class="text-14">Pending</td>
                                                @elseif($user_data->status===1 || $user_data->status==='register')
                                                <td class="text-14">Registered</td>
                                                @elseif($user_data->status===2 || $user_data->status==='block')
                                                <td class="text-14">Blocked</td>
                                                @else
                                                <td class="text-14">Pending</td>
                                                @endif

                        @if($user_data->approve === 'approved')
                                                <td class="text-14">Approved</td>
                                                @else
                                                <td class="text-14">UnApproved</td>
                                                @endif

                         <td class="">
                           <div class="dc-actionbtn ">
                              <a href="{{ route('adminEditUser',$user_data->id) }}" class="dc-addinfo dc-skillsaddinfo">
                              <i class="lnr lnr-pencil"></i>
                              </a>
                  <delete :title="'{{trans("lang.ph.delete_confirm_title")}}'" :id="'{{$user_data->id}}'" :message="'{{trans("lang.user_deleted")}}'" :url="'{{url('admin/delete-user')}}'"></delete>
                             @if($user_data->location == ''|| $user_data->location == null || $user_data->location == 'null')
                                 <a href="{{ url('profile/'.clean($user_data->slug)) }}" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>
                                 @else

                                  @if(count($user_data->specialities) == '0')
                                   <a href="{{ url('profile/'.clean($user_data->slug)) }}" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>
                                   @else
                                    <a href="{{ url('doctors/'.clean($user_data->location->slug).'/'.clean($user_data->specialities[0]->slug).'/'.clean($user_data->slug)) }}" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>
                                    @endif

                                 @endif
                           </div>
                        </td>

                       

                         <td>

                           <div class="col-lg-4 col-12">
                               <div class="dateMain">
                                <select class="center" onchange="approveStatus({{$user_data->id}},this.value)">
                                 <option value="none" selected="selected">Please Select</option>
                                 @if($user_data->approve == 'approved')
                                      <option value="unapprove">UnApprove</option>
                                 @endif
                                 @if($user_data->approve == 'not-approved')
                                      <option value="approve">Approve</option>
                                 @endif
                                 
                                </select>
                              </div>
                           </div>
                              
                        </td>
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



<script>
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
                        console.log(response,element_id,response.status_text);
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
       var table = $('#roles').DataTable({
        "bDestroy": true,
        "order": [[12, "desc"]]
       });
      $('.dataTables_filter').find('input').addClass("search_field");
      $(document).on('keyup','.search_field',function(){
       
            var search_value =$(this).val();
            var role =$('#role_name').val();
            var clickCount =localStorage.getItem('clickCount');
            var url      = window.location.href;
            var base      = window.location.origin;
            var request_type=url.split('/');  
            request_type=request_type[4];
            console.log('check',request_type,base,url,search_value);
            $.ajax({
               type: "GET",
               url: base+"/all-new-doctors-search",
               data:{'type':request_type,'search':search_value},
               dataType: "json",
               success: function (response) {
               table.clear().draw();
               var email='';
               var count =0;
               var medical_status ='';
               var user_verified ='';
               var eye ='<a href="javascript:;" class="dc-addinfo dc-skillsaddinfo disable-eye"><i class="lnr lnr-eye"></i></a>';
               var speciality='';
               $.each(response, function(i, item) {
                 
                  if(item.area===null){
                   var area='Not available';
                 }
                 else{
                  var area=item.area.title;
                 }
                 if(item.location===null){
                   var location='Not available';
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
                 if(item.phone_number===null){
                   var phone_number='Not available';
                 }
                 else{
                  var phone_number=item.phone_number;
                 }
                 if($.isEmptyObject(item.specialities)){
                     speciality='No Speciality';
                 }
                 else{
                     speciality=item.specialities[0].title;
                 } 
                 
                 
                 
                     var edit_icon=
                           '<div class="dc-actionbtn border-0"><a href="'+base+'/admin/edit-user/'+item.id+'"  class="dc-addinfo dc-skillsaddinfo"> <i class="lnr lnr-pencil"></i></a>';
                          var delete_icon= '<a href="javascript:;" id='+item.id+'  onclick="delete_user('+item.id+')" class="dc-deleteinfo delete_user"><delete :title="{{trans("lang.ph.delete_confirm_title")}}" :id="{{$user_data->id}}" :message="{{trans("lang.user_deleted")}}" :url="'+base+'admin/delete-user"></delete><i class="lnr lnr-trash"></i></a>'
                           
                              if(item.location ==''|| item.location == null || item.location =='null' || item.specialities !== null || item.specialities !== '' || item.specialities !== [])
                              {
                                 eye='<a href="'+base+'/profile/"'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                              else
                              {
                                 eye='<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                      if(item.status===0 || item.status==='' || item.status==='pending' || item.status=== null || item.status==='null')
                                 {
                                    status='Pending';

                                 }
                                 else if(item.status===1 || item.status==='register')
                                 {
                                    status='Registered';
                                 }
                                 else if(item.status===2 || item.status==='block')
                                 {
                                    status='Blocked';
                                 }
                                  else
                                 {
                                    status='Pending';
                                 }

                      if(item.approve === 'approved')
                           {
                              var approve_status='approved';
                              var approve_doc_opt='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="approveStatus('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="unapprove">UnApprove</option></div></div>'
                           }
                           else
                           {
                              var approve_status='not-approved';
                              var approve_doc_opt='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="approveStatus('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="approve">Approve</option></div></div>'

                           }
                                 
                      table.row.add([ 
                      item.first_name+item.last_name, 
                      email,
                      item.created_at,
                      item.updated_at,
                      speciality,
                      phone_number,
                      location,
                      area,
                      status,
                      approve_status,
                      edit_icon+delete_icon+eye+'</div>',
                      approve_doc_opt
                     ]);
                  
         }); 
               table.draw();
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
            var role =$('#role_name').val();
             var confirm_delete =$('#confirm_delete').val();
            var user_delete =$('#user_delete').val();
            var clickCount =localStorage.getItem('clickCount');
            var verified =$('#verified').val();
            var url      = window.location.href;
            var base      = window.location.origin;
            var request_type=url.split('/');    
            request_type=request_type[4];
            $.ajax({
               type: "GET",
               url: url,
               data:{'type':request_type,'clickCount':clickCount},
               dataType: "json",
               success: function (response) {
                 $(".next").removeAttr("disabled");
               localStorage. setItem('clickCount', response[1]);
               var email='';
               var speciality='';
               var eye='<a href="javascript:;" class="dc-addinfo dc-skillsaddinfo disable-eye"><i class="lnr lnr-eye"></i></a>';
                 
                $.each(response[0], function(i, item) {
         
                 if(item.area===null){
                   var area='Not available';
                 }
                 else{
                  var area=item.area.title;
                 }
                 if(item.location===null){
                   var location='Not available';
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
                 if(item.phone_number===null){
                   var phone_number='Not available';
                 }
                 else{
                  var phone_number=item.phone_number;
                 }
                 if($.isEmptyObject(item.specialities)){
                     speciality='No Speciality';
                 }
                 else{
                     speciality=item.specialities[0].title;
                 } 
                 
                 
                 
                     var edit_icon=
                           '<div class="dc-actionbtn border-0"><a href="'+base+'/admin/edit-user/'+item.id+'"  class="dc-addinfo dc-skillsaddinfo"> <i class="lnr lnr-pencil"></i></a>';
                          var delete_icon= '<a href="javascript:;" id='+item.id+'  onclick="delete_user('+item.id+')" class="dc-deleteinfo delete_user"><delete :title="{{trans("lang.ph.delete_confirm_title")}}" :id="{{$user_data->id}}" :message="{{trans("lang.user_deleted")}}" :url="'+base+'admin/delete-user"></delete><i class="lnr lnr-trash"></i></a>'
                           
                              if(item.location ==''|| item.location == null || item.location =='null' || item.specialities !== null || item.specialities !== '' || item.specialities !== [])
                              {
                                 eye='<a href="'+base+'/profile/"'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                              else
                              {
                                 eye='<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                      if(item.status===0 || item.status==='' || item.status==='pending' || item.status=== null || item.status==='null')
                                 {
                                    status='Pending';

                                 }
                                 else if(item.status===1 || item.status==='register')
                                 {
                                    status='Registered';
                                 }
                                 else if(item.status===2 || item.status==='block')
                                 {
                                    status='Blocked';
                                 }
                                  else
                                 {
                                    status='Pending';
                                 }
                         if(item.approve === 'approved')
                           {
                              var approve_status='approved';
                              var approve_doc_opt='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="approveStatus('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="unapprove">UnApprove</option></div></div>'
                           }
                           else
                           {
                              var approve_status='not-approved';
                              var approve_doc_opt='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="approveStatus('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="approve">Approve</option></div></div>'

                           }
                           
                   
                      table.row.add([ 
                      item.first_name+item.last_name, 
                      email,
                      item.created_at,
                      item.updated_at,
                      speciality,
                      phone_number,
                      location,
                      area,
                      status,
                      approve_status,
                      edit_icon+delete_icon+eye+'</div>',
                      approve_doc_opt
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
    function approveStatus(id,value) {
         var value=value;
         var base  = window.location.origin;
         var table = $('#roles').DataTable();
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
                url: base+"/admin/approve-new-doctors",
                data:{'type':request_type,'selected':value,'id':id},
                dataType: "json",
                success: function (response){

                  table.clear().draw();
                 $.each(response, function(i, item) {
                 
                  if(item.area===null){
                   var area='Not available';
                 }
                 else{
                  var area=item.area.title;
                 }
                 if(item.location===null){
                   var location='Not available';
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
                 if(item.phone_number===null){
                   var phone_number='Not available';
                 }
                 else{
                  var phone_number=item.phone_number;
                 }
                 if($.isEmptyObject(item.specialities)){
                     speciality='No Speciality';
                 }
                 else{
                     speciality=item.specialities[0].title;
                 } 
                 
                 
                 
                     var edit_icon=
                           '<div class="dc-actionbtn border-0"><a href="'+base+'/admin/edit-user/'+item.id+'"  class="dc-addinfo dc-skillsaddinfo"> <i class="lnr lnr-pencil"></i></a>';
                          var delete_icon= '<a href="javascript:;" id='+item.id+'  onclick="delete_user('+item.id+')" class="dc-deleteinfo delete_user"><delete :title="{{trans("lang.ph.delete_confirm_title")}}" :id="{{$user_data->id}}" :message="{{trans("lang.user_deleted")}}" :url="'+base+'admin/delete-user"></delete><i class="lnr lnr-trash"></i></a>'
                           
                              if(item.location ==''|| item.location == null || item.location =='null' || item.specialities !== null || item.specialities !== '' || item.specialities !== [])
                              {
                                 eye='<a href="'+base+'/profile/"'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                              else
                              {
                                 eye='<a href="'+base+'/profile/'+item.slug+'" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                              }
                      if(item.status===0 || item.status==='' || item.status==='pending' || item.status=== null || item.status==='null')
                                 {
                                    status='Pending';

                                 }
                                 else if(item.status===1 || item.status==='register')
                                 {
                                    status='Registered';
                                 }
                                 else if(item.status===2 || item.status==='block')
                                 {
                                    status='Blocked';
                                 }
                                  else
                                 {
                                    status='Pending';
                                 }

                           if(item.approve === 'approved')
                           {
                              var approve_status='approved';
                              var approve_doc_opt='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="approveStatus('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="unapprove">UnApprove</option></div></div>'
                           }
                           else
                           {
                              var approve_status='not-approved';
                              var approve_doc_opt='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="approveStatus('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="approve">Approve</option></div></div>'

                           }



                                 
                      table.row.add([ 
                      item.first_name+item.last_name, 
                      email,
                      item.created_at,
                      item.updated_at,
                      speciality,
                      phone_number,
                      location,
                      area,
                      status,
                      approve_status,
                      edit_icon+delete_icon+eye+'</div>',
                      approve_doc_opt
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
</style>
@endpush