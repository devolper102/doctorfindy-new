@extends('back-end.master')
@push('backend_stylesheets')
    <link href="{{ asset('css/basictable.css') }}" rel="stylesheet">
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
                             @foreach ($specialities as $servkey => $speciality)
                            <h2>{{{ html_entity_decode(clean($service = Helper::getServiceByID($servkey)->title)) }}} Doctors</h2>
                            @endforeach
                           
                        </div>
                        @if (count($specialities) > 0)
                            <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                              <table id="example" class="table table-striped table-bordered" style="width:100%">
                                                     <thead>
                                                            <tr>
                                                                <th>First Name</th>
                                                                <th>Last Name</th>
                                                                <th>Email</th>
                                                                <th>Location</th>
                                                                <th>Phone Number</th>
                                                                <th>Appointment Number</th>
                                                                <th>Profile</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                          
                                                             @foreach ($specialities as $servkey => $speciality)
                                                            

                                                                @if(count($speciality) > 0)
                                                                @foreach ($speciality as $key => $user)
                                                               <tr>
                                                                    
                                                                    <td class="{{$key}}">
                                                                        {{{ html_entity_decode(clean($user->first_name ?? '')) }}}
                                                                    </td>
                                                                    <td class="{{$key}}">
                                                                        {{{ html_entity_decode(clean($user->last_name ?? '')) }}}
                                                                    </td>
                                                                    <td class="{{$key}}">
                                                                        {{{ html_entity_decode(clean($user->email ?? '')) }}}
                                                                    </td>

                                                                    <td class="{{$key}}">
                                                                        {{{ html_entity_decode(clean($service = Helper::getLocationByID($user->location_id)->title)) }}}
                                                                    </td> 

                                                                    <td class="{{$key}}">
                                                                        {{{ html_entity_decode(clean($user->phone_number ?? '')) }}}
                                                                    </td>

                                                                     <td class="{{$key}}">
                                                                        {{{ html_entity_decode(clean($user->assistant_phone_number ?? '')) }}}
                                                                    </td>
                                                                    
                                                                    <td> <a style="color: #3fabf3" target="_blank" href="{{ url('/profile/'.$user->slug)}}">View</a></td>
                                                              </tr>     
                                                             @endforeach 
                                                             @else
                                                             <?php for ($i=0; $i <= 6; $i++) { 
                                                                echo "<tr><td></td></tr>";
                                                             } ?>
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
   <style type="text/css">
       .dt-bootstrap4{
        padding: 15px;
       }
       .pagination li {

        list-style: none !important;
       }
   </style>
@endsection
@push('scripts')
@stack('backend_scripts')

 <script type="text/javascript">
    

   jQuery(document).ready(function() {
    jQuery('#example').DataTable();
} );

</script>

@endpush
