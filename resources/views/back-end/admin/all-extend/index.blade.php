@extends('back-end.master')
@push('backend_stylesheets')
    <link href="{{ asset('css/basictable.css') }}" rel="stylesheet">
@endpush
@section('content')
@include('includes.pre-loader')
    <div class="dc-doctors" id="doctors">
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
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 0px;">
                    <div class="dc-dashboardbox">
                        <div class="dc-dashboardboxtitle dc-titlewithsearch dc-titlewithdel" style="padding:0px;">
                            <h2 style="margin: 13px 0 13px 50px;float: none;">All Extended Doctors</h2>
                        </div>
                        @if (count($users) > 0)
                          <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table id="extended-recommended-table" class="table table-hover table-center mb-0 dt-responsive nowrap table-responsive pt-3" style="width: 100%">
                                    <thead>
                                        <tr>
                                          <th>Name</th>
                                          <th>Phone</th>
                                          <th>Asst.Phone</th>
                                          <th>Speciality</th>
                                          <th>Email</th>
                                          <th>City</th>
                                          <th>Area</th>
                                          <th>status</th>
                                          <th>Recommend</th>
                                          <th>Profile</th>
                                          <th>Ext Profile Created Date</th>
                                          <th>Created Date</th>
                                          <th>Updated Date</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $user_data)

                                      <tr>

                                        
                                        <td>{{$user_data->first_name.' '.$user_data->last_name}}</td>

                                        @if(empty($user_data->phone_number))
                                        <td>Not Available</td>
                                        @else
                                        <td>{{$user_data->phone_number}}</td>
                                        @endif

                                        
                                       
                                        
                                        @if($user_data->specialities === null || $user_data->specialities === [] || $user_data->specialities === '')
                                        <td>Not selected</td>  
                                        @else
                                        <td>{{$user_data->specialities[0]->title}}</td>
                                        @endif

                                         @if($user_data->email !== null)
                                            <td>{{{ clean(@$user_data->email) }}}</td>
                                            @else
                                            <td>No Email</td>
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

                                        @if($user_data->status == 0 || $user_data->status == '' || $user_data->status == 'pending')
                                                <td class="text-14">Pending</td>
                                                @elseif($user_data->status == 1 || $user_data->status == 'register')
                                                <td class="text-14">Registered</td>
                                                @elseif($user_data->status == 2 || $user_data->status == 'block')
                                                <td class="text-14">Blocked</td>
                                                @else
                                                <td class="text-14">Pending</td>
                                        @endif

                                        @if($user_data->recommend_status===1 || $user_data->recommend_status==='recommend')
                                        <td class="">recommended</td>
                                        @else
                                        <td class="">Unrecommended</td>
                                        @endif

                                         <td class="">
                                       <div class="dc-actionbtn ">
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
                                          {{Carbon\Carbon::parse($user_data->profile->created_extend)->format('M d, Y, h:i a') }}
                                        </td>
                                        <td>
                                          {{$user_data->created_at->format('M d, Y, h:i a') ?? '' }}
                                        </td>
                                        <td>
                                          {{$user_data->updated_at->format('M d, Y, h:i a') ?? '' }}
                                        </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    </table>  
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
       var table = $('#extended-recommended-table').DataTable({
        "bDestroy": true,
        "defaultContent": "-",
        "targets": "_all",
        "order": [[12, "desc"]]
       });
      $('.dataTables_filter').find('input').addClass("search_field");
      $(document).on('keyup','.search_field',function(){
            var search_value =$(this).val();
            var clickCount =localStorage.getItem('clickCount');
            var url  = window.location.href;
            var base  = window.location.origin;
            var status = '';
            var profile = '';
            var email='';
            var speciality='';
            var eye='<a href="javascript:;" class="dc-addinfo dc-skillsaddinfo disable-eye"><i class="lnr lnr-eye"></i></a>';
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
            var url   = window.location.href;
            var base   = window.location.origin;
            var status = '';  
            var profile=''; 
            var email='';
            var speciality='';
            var eye='<a href="javascript:;" class="dc-addinfo dc-skillsaddinfo disable-eye"><i class="lnr lnr-eye"></i></a>'; 

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

@endpush
