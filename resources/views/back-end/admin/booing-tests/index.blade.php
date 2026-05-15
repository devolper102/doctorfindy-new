@extends('back-end.master')
@push('backend_stylesheets') 
   
@endpush
@section('content')
@include('includes.pre-loader')
    <div class="dc-locations" id="locations">
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
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 float-right">
                    <div class="dc-dashboardbox dc-addpage-holdertwo">
                        <div class="dc-dashboardboxtitle dc-titlewithsearch dc-titlewithdel">
                            <h2>All Booking Tests</h2>
                        </div>
                        @if ($tests->count() > 0)
                            <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <div class="all-booking-test">
                                <table class="table table-bordered table-hover dt-responsive nowrap table-responsive" id="booking-tests">
                                    <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>Lab</th>
                                            <th>Preferred Date</th>
                                            <th>Selected Tests</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php $counter = 0; @endphp
                                        @foreach ($tests as $test)
                                            <tr class="del-{{{ $test->id }}}" >
                                                <td>{{$test->full_name}}</td>
                                                <td>{{$test->age}}</td>
                                                <td>{{$test->gender}}</td>
                                                <td>{{$test->email}}</td>
                                                <td>{{$test->phone_number}}</td>
                                                <td>{{$test->address}}</td>
                                                 <td>{{optional($test->location)->title}}</td>
                                                <td><a href="#">{{Helper::getUserData($test->lab_id)}}</a></td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($test->date_preferred)->format('M d, Y') }}
                                                </td>
                                                <td>
                            @php
                            $select_tests = json_decode($test->test_id, true);
                            @endphp

                            @if (is_array($select_tests))
                                @foreach ($select_tests as $select_test)
                                    @if (isset($select_test['name']))
                                        <span><a href="#"> {{$select_test['name']}}</a></span><br />
                                    @endif
                                @endforeach
                            @else
                                <span>No tests available</span>
                            @endif
                        </td>
                                                <td>
                                                    {{$test->created_at->format('M d, Y h:i A')}}
                                                </td>
                                                <td>
                                                    {{$test->updated_at->format('M d, Y h:i A')}}
                                                </td>
                                                <td>{{$test->status}}</td>
                                                
                                            </tr>                                            
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                                @if( method_exists($tests,'links') ) {{ $tests->links('pagination.custom') }} @endif
                            </div>
                        @else
                            @if (file_exists(resource_path('views/extend/errors/no-record.blade.php')))
                                @include('extend.errors.no-record')
                            @else
                                @include('errors.no-record')
                            @endif
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
     
      jQuery(document).ready(function() {
        jQuery('#booking-tests').DataTable( {
        "order": []
    } );
      } );

    </script>
  
   
@endpush
