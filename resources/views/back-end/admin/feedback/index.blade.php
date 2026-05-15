@extends('back-end.master')
@push('backend_stylesheets')
    <link href="{{ asset('css/basictable.css') }}" rel="stylesheet">
    <style>
        #example .dtr-details .dtr-data {
            white-space: pre-wrap !important;
        }
        #example .dtr-details .dtr-data .btn-danger {
            margin-top: -10px;
        }
        .btn-primary.disabled, .btn-primary:disabled{
            background-color: #b9b9b9;
            border-color: #b9b9b9;
        }
    </style>
@endpush
@section('content')
    @include('includes.pre-loader')
    <div class="dc-specialities" id="specialities">
        <section class="dc-haslayout">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="dc-dashboardbox">
                        <div class="dc-dashboardboxtitle dc-titlewithsearch dc-titlewithdel">
                            <h2>Manage Reviews Approval/Decline</h2>
                        </div>
                        <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                            <table id="example"  style="width:100%"class="blank_td table table-bordered table-hover dt-responsive nowrap table-responsive">
                                <thead>
                                <tr>
                                    <th>Doctor/Hospital/Lab Name</th>
                                    <th>Patient Name</th>
                                    <th>Waiting Time</th>
                                    <th>Average Rating</th>
                                    <th>Action</th>
                                    <th class="none">Comments</th>
                                    <th class="none">Created Date</th>
                                    <th class="none">Updated Date</th>
                                    <th class="none">Keep Anonymous</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($feedbacks as $feedback)
                                        <tr>
                                            <td><p style="text-align: left;">
                                                {{Helper::getUserData($feedback->user_id)}}
                                            </p></td>
                                             <td><p style="text-align: left;">
                                                {{Helper::getUserData($feedback->patient_id)}}
                                            </p></td>
                                            <td>{{$feedback->waiting_time}}</td>
                                            <td>{{$feedback->avg_rating}}</td>
                                             <td>
                                                <div class="dc-actionbtn">
                                                    @if($feedback->approval === 0 ||$feedback->approval === null)
                                                        <a class="dc-addinfo dc-skillsaddinfo" onclick="location.href='{{ url('admin/feedback',[$status = 1,$feedback->id]) }}'"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                    @else
                                                        <a class="dc-addinfo dc-skillsaddinfo" onclick="location.href='{{ url('admin/feedback',[$status = 0,$feedback->id]) }}'"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                    @endif
                                                    <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ $feedback->id }}'" :message="'{{'Feedback Deleted Successfully'}}'" :url="'{{url('admin/feedback/delete')}}'" :redirect_url="'{{url('admin/feedback')}}'"class="btn btn-danger btn-sm"></delete>
                                                </div>
                                            </td>
                                            <td>{{$feedback->comment}}</td>
                                            <td>{{ $feedback->created_at->format('M d, Y, H:i A') }}</td>
                                            <td>{{ $feedback->updated_at->format('M d, Y, H:i A') }}</td>
                                            <td>{{$feedback->keep_anonymous}}</td>
                                           
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
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
        jQuery('#example').DataTable();
      } );

    </script>

@endpush
