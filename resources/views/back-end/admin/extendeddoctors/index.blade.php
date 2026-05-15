@extends('back-end.master')
@push('backend_stylesheets')
    <link href="{{ asset('css/basictable.css') }}" rel="stylesheet">
@endpush
@section('content')
    @include('includes.pre-loader')
    <div class="dc-specialities" id="specialities">
        <section class="dc-haslayout">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="dc-dashboardbox">
                        <div class="dc-dashboardboxtitle dc-titlewithsearch dc-titlewithdel">
                            <h2>All Cities Extended Doctors</h2>
                        </div>
                        <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                            <table id="example" class="table table-striped table-bordered" style="width:100%;overflow-x: scroll;display: block;">
                                <thead>
                                    <tr>
                                        <th>City</th>
                                        <th>specialities</th>
                                        <th>Total</th>
                                        <th>Completed</th>
                                        <th>Completed(without Video, Scheduler)</th>
                                        <th>Completed(without Video, Scheduler, Appt. Number)</th>
                                        <th>Reviews</th>
                                        <th>Emr</th>
                                        <th>Interview</th>
                                        <th>Scheduler</th>
                                        <th>Forum Questions</th>
                                        <th>Area of Interest</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $data)
                                    @php
                                        $locations = $data->locations()->get();
                                    @endphp
                                            @foreach($locations as $location)
                                                <tr>
                                                <td>{{$location->title}}</td>
                                                <td>{{$data->title}}</td>
                                                <td>{{Helper::all_cities_extended_doc($location, $data->id)}}</td>
                                                <td>{{Helper::prof_comp($location, $data->id)}}</td>
                                                <td>{{Helper::prof_comp_without_vid_sche($location, $data->id)}}</td>
                                                <td>{{{ html_entity_decode(clean($service = Helper::prof_comp_without_vid_sche_appt($location, $data->id))) }}}</td>
                                                <td>{{{ html_entity_decode(clean($service = Helper::feedbackcount($location, $data->id))) }}}</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>{{Helper::ques_count($location, $data->id)}}</td>
                                                <td>0</td>
                                            </tr>
                                    @endforeach
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
