@extends('back-end.master')
@push('backend_stylesheets')
    <link href="{{ asset('css/basictable.css') }}" rel="stylesheet">
@endpush
@section('content')
@php
$specialities=[];
@endphp
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
                            <h2>All Online Consultation Doctors</h2>

                        </div>
                        @if (count($users) > 0)
                            <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table id="all-online-consultation" class="table table-hover table-center mb-0 dt-responsive nowrap table-responsive pt-3" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Speciality</th>
                                        <th>Online Consultation</th>
                                        <th>Online Charges</th>
                                        <th>City</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Doctor Status</th>
                                        <th>Profile</th>
                                    </tr>
                                    </thead>
                                    <div id="loading">
                                         <img src="{{asset('images/loader/loader.gif')}}" />  
                                    </div>
                                    <tbody>
                                    @foreach ($users as $key => $user_data)
                                        <tr>

                                            <td class="text-14">{{{ ucwords(\App\Helper::getUserName($user_data->id)) }}}</td>

                                            @if($user_data->specialities !== null || $user_data->specialities !== [] || $user_data->specialities !== '')
                                            <td class="text-14">{{$user_data->specialities[0]->title}}</td>
                                            @endif

                                            @if($user_data->onlines !== null || $user_data->onlines !== [] || $user_data->onlines !== '')
                                            <td class="text-14">Available</td>
                                            <td class="text-14">{{{ clean(@$user_data->onlines[0]->price) }}}</td>
                                            @endif

                                            <td class="text-14">{{{ clean(@$user_data->location->title) }}}</td>

                                            @if($user_data->phone !== null)
                                            <td class="text-14">{{{ clean(@$user_data->phone) }}}</td>
                                            @else
                                            <td class="text-14">Not Available</td>
                                            @endif

                                            @if($user_data->email !== null)
                                            <td class="text-14">{{{ clean(@$user_data->email) }}}</td>
                                            @else
                                            <td class="text-14">No Email</td>
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
                                 
                                        @if($user_data->specialities !== null && $user_data->specialities !== '' && $user_data->location !=='' && $user_data->location !== null && $user_data->location !=='null')
                                         <td class="text-14"><a href="{{ url('doctors/'.clean($user_data->location->slug).'/'.clean($user_data->specialities[0]->slug).'/'.clean($user_data->slug)) }}" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a></td>
                                         @else
                                         <td class="text-14"><a href="{{ url('profile/'.clean($user_data->slug)) }}" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a></td>
                                        @endif
                                                
                                            
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
       var table = $('#all-online-consultation').DataTable({
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
            var profile = '';
            $.ajax({
               type: "GET",
               url: base+"/all-online-consultation-search",
               data:{'search':search_value},
               dataType: "json",
               success: function (response) {
               table.clear().draw();
               $.each(response, function(i, item) {
                if(item.onlines && item.onlines.length)
                {
                    var name=item.first_name+''+item.last_name;
                    if(item.location !== null)
                    {
                        var city=item.location.title
                    }
                    else
                    {
                        var city='Not available';
                    }
                    if($.isEmptyObject(item.onlines))
                    {
                        var online='available'
                        var price='Not available'
                    }
                    else
                    {
                        var online='available'
                        var price=item.onlines[0].price;
                    }
                    if(item.phone_number !== null)
                    {
                        var phone=item.phone_number
                    }
                    else
                    {
                        var phone='not available'
                    }
                    if(item.email !== null)
                    {
                        var email=item.email
                    }
                    else
                    {
                        var email='Not available'
                    }
                    if($.isEmptyObject(item.specialities)){
                        var speciality='No Speciality';
                     }
                     else{
                        var speciality=item.specialities[0].title;
                     } 
                    if(item.specialities !== null && item.specialities !== '' && item.specialities !== [] && item.location !== null && item.location !=='null')
                    {
                        profile='<a href="'+base+'/profile/'+item.location.slug+'"/"'+item.specialities[0].slug+'"/"'+item.slug+')" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                    }
                    else
                    {
                        profile='<a href="'+base+'/profile/'+item.slug+')" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
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
                    }
                
                 
                   table.row.add([ 
                      name, 
                      speciality,
                      online,
                      price,
                      city,
                      phone,
                      email,
                      status,
                      profile,
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
            var profile='';  
            $.ajax({
               type: "GET",
               url: url,
               data:{'clickCount':clickCount},
               dataType: "json",
               success: function (response) {
                 $(".next").removeAttr("disabled");
               localStorage. setItem('clickCount', response[1]);
                 
                $.each(response[0], function(i, item) {
                    var name=item.first_name+''+item.last_name;
                    if(item.location !== null)
                    {
                        var city=item.location.title
                    }
                    if($.isEmptyObject(item.onlines))
                    {
                        var online='available'
                        var price='Not available'
                    }
                    else
                    {
                        var online='available'
                        var price=item.onlines[0].price;
                    }
                    if(item.phone_number !== null)
                    {
                        var phone=item.phone_number
                    }
                    else
                    {
                        var phone='Not available'
                    }
                    if(item.email !== null)
                    {
                        var email=item.email
                    }
                    else
                    {
                        var email=''
                    }
                    
                    if($.isEmptyObject(item.specialities)){
                        var speciality='No Speciality';
                     }
                     else{
                        var speciality=item.specialities[0].title;
                     } 
                    if(item.location !== null && item.location !=='' && item.location !=='null' && item.specialities !=='' && item.specialities !== null && item.specialities !=='null' )
                    {
                        profile='<a href="'+base+'/profile/'+item.location.slug+'"/"'+item.specialities[0].slug+'"/"'+item.slug+')" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
                    }
                    else
                    {
                        profile='<a href="'+base+'/profile/'+item.slug+')" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>';
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

                    table.row.add([ 
                      name, 
                      speciality,
                      online,
                      price,
                      city,
                      phone,
                      email,
                      status,
                      profile,
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
