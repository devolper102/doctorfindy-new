@extends('back-end.master')
<?php use App\UserMeta;?>
@push('backend_stylesheets')
    <link href="{{ asset('css/basictable.css') }}" rel="stylesheet">
    <style>
        #example{
            width: 100% !important;
        }
        .dtr-details{
            width: 100%;
        }
        .dtr-details li{
            float: none !important;
        }
    </style>
@endpush
@section('content')
@include('includes.pre-loader')
    <div class="dc-specialities" id="specialities">
        @if (Session::has('message'))
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='100' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
            </div>
        @elseif (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='100' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
            </div>
        @endif
        <section class="dc-haslayout">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="dc-dashboardbox">
                        <div class="dc-dashboardboxtitle dc-titlewithsearch dc-titlewithdel">
                            <h2>Activated Doctors</h2>
                        </div>
                        
                        @if ($users->count() > 0)
                            <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table id="registered-doctors" class="table table-striped table-bordered dt-responsive nowrap table-responsive">
                                    <thead>
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
                                            <th class=" text-14 font-weight-bold">{{{ trans('lang.action') }}}</th>
                                            <th class="none  text-14 font-weight-bold border-top border-bottom">Status Action</th>

                                        </tr>
                                    </thead>
                                    <div id="loading">
                                         <img src="{{asset('images/loader/loader.gif')}}" />  
                                    </div>
                                    
                                    <tbody >
                                        @foreach ($users as $key => $user_data)
                                        <tr>
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

                                             @if($user_data->status == 1 || $user_data->status == '1' || $user_data->status == 'register' || $user_data->status == register)
                                                <td class="text-14">Registered</td>
                                            @elseif($user_data->status == 0 || $user_data->status == '0' || $user_data->status =='' || $user_data->status == 'pending')
                                                <td class="text-14">Pending</td>
                                                @elseif($user_data->status == 2 || $user_data->status == '2' || $user_data->status == 'block')
                                                <td class="text-14">Blocked</td>
                                                @else
                                                <td class="text-14">Pending</td>
                                                @endif

                            <td class="">
                           <div class="dc-actionbtn ">
                              <a href="{{ route('adminEditUser',$user_data->id) }}" class="dc-addinfo dc-skillsaddinfo">
                              <i class="lnr lnr-pencil"></i>
                              </a>
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
                                <select class="center" onchange="showDropDown({{$user_data->id}},this.value)">
                                 <option value="none" selected="selected">Please Select</option>
                                 @if($user_data->status == 0 || $user_data->status == '' || $user_data->status == 'pending' || $user_data->status == null || $user_data->status == 'null')
                                      <option value="register">Register</option>
                                 @endif
                                 @if($user_data->status == 1 || $user_data->status == 'register' || $user_data->status == '1')
                                      <option value="pending">Unregister</option>
                                 @endif
                                 @if($user_data->status == 2 || $user_data->status == 'block' || $user_data->status == '2')
                                       <option value="unblock">Unblock</option>
                                 @endif
                                 @if($user_data->status == 1 || $user_data->status == 0 || $user_data->status == '1' || $user_data->status == '0' || $user_data->status == '' || $user_data->status == 'pending' || $user_data->status == null || $user_data->status == 'null')
                                       <option value="block">Block</option>
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
    </div>
@endsection
@push('scripts')
@stack('backend_scripts')
<script type="text/javascript">
$(document).ready(function() {
      localStorage. setItem('clickCount', 1);
       var table = $('#registered-doctors').DataTable({
        "bDestroy": true,
        "defaultContent": "-",
        "targets": "_all",
        "order": [[12, "desc"]]
       });
      $('.dataTables_filter').find('input').addClass("search_field");
      $(document).on('keyup','.search_field',function(){
            var search_value =$(this).val();
            var clickCount =localStorage.getItem('clickCount');
            var url      = window.location.href;
            var base      = window.location.origin;
            var status = '';
            var status_action = '';
            var profile = '';
            var email='';
            var speciality='';
            var eye='<a href="javascript:;" class="dc-addinfo dc-skillsaddinfo disable-eye"><i class="lnr lnr-eye"></i></a>';
            $.ajax({
               type: "GET",
               url: base+"/registered-doctors-search",
               data:{'search':search_value},
               dataType: "json",
               success: function (response) {
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
                                     var none='';
                                    status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="register">Register</option></select></div></div>';

                                 }
                                 else if(item.status===1 || item.status==='register')
                                 {
                                    status='Registered';
                                     var none='';
                                    status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" id="select_action" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="pending">Unregister</option><option value="block">Block</option></select></div></div>';
                                 }
                                 else if(item.status===2 || item.status==='block')
                                 {
                                    status='Blocked';
                                    var none='';
                                    status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" id="select_action" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="unblock">Unblock</option></select></div></div>';
                                 }
                                  else
                                 {
                                    status='Pending';
                                    var none='';
                                    status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="register">Register</option></select></div></div>';
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
                      edit_icon+eye+'</div>',
                      status_action,
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
            var clickCount =localStorage.getItem('clickCount');
            var url      = window.location.href;
            var base      = window.location.origin;
            var status = '';
            var status_action = '';    
            var profile=''; 
            var email='';
            var speciality='';
            var eye='<a href="javascript:;" class="dc-addinfo dc-skillsaddinfo disable-eye"><i class="lnr lnr-eye"></i></a>'; 
            $.ajax({
               type: "GET",
               url: url,
               data:{'clickCount':clickCount},
               dataType: "json",
               success: function (response) {
                 $(".next").removeAttr("disabled");
               localStorage. setItem('clickCount', response[1]);
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
                                    var none='';
                                    status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="register">Register</option></select></div></div>';

                                 }
                                 else if(item.status===1 || item.status==='register')
                                 {
                                    status='Registered';
                                     var none='';
                                    status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" id="select_action" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="pending">Unregister</option><option value="block">Block</option></select></div></div>';
                                 }
                                 else if(item.status===2 || item.status==='block')
                                 {
                                    status='Blocked';
                                    var none='';
                                    status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" id="select_action" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="unblock">Unblock</option></select></div></div>';
                                 }
                                  else
                                 {
                                    status='Pending';
                                    var none='';
                                    status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="register">Register</option></select></div></div>';
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
                      edit_icon+eye+'</div>',
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
function showDropDown(id,value)
{
    var value=value;
    var base  = window.location.origin;
    var table = $('#registered-doctors').DataTable();
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
               var status='';
               var status_action='';
               var eye ='<a href="javascript:;" class="dc-addinfo dc-skillsaddinfo disable-eye"><i class="lnr lnr-eye"></i></a>'; 
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
                                    var none='';
                                    status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="register">Register</option></select></div></div>';

                                 }
                                 else if(item.status===1 || item.status==='register')
                                 {
                                    status='Registered';
                                     var none='';
                                    status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" id="select_action" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="pending">Unregister</option><option value="block">Block</option></select></div></div>';
                                 }
                                 else if(item.status===2 || item.status==='block')
                                 {
                                    status='Blocked';
                                    var none='';
                                    status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" id="select_action" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="unblock">Unblock</option></select></div></div>';
                                 }
                                  else
                                 {
                                    status='Pending';
                                    var none='';
                                    status_action='<div class="col-lg-4 col-12"><div class="dateMain"><select class="center" onchange="showDropDown('+item.id+',value)"><option value="none" selected="selected">Please Select</option><option value="register">Register</option></select></div></div>';
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
                      edit_icon+eye+'</div>',
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
</style>
@endpush
