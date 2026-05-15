{{--@extends('back-end.layouts.doctor-layout')
@push('backend_stylesheets')
    <link rel="stylesheet" href="{{ asset('css/chosen.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css">
@endpush
@section('sidebar')
    @include('back-end.includes.sidebar')
@endsection
@include('includes.pre-loader')
     <!-- Content Wrapper -->
@section('main')

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('back-end.includes.topbar')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid" id="doctor-dashboard">

          <div class="row">
            <div class="col-lg-9 col-sm-12 col-md-12">
              <div class="col-xs-12 col-lg-12 p-0">
                <nav>
                  <div class="nav appointment_nav mb-5" id="appointments-main" role="appointments">
                    <a class="active tab_btn position-relative d-inline-block p-2" id="nav-home-tab" data-toggle="tab" href="#today_appointment" role="tab" aria-controls="today-appointment" aria-selected="true"> Today</a>
                    <a class="tab_btn position-relative d-inline-block p-2" data-toggle="tab" href="#tomorrow_appointment" role="tab" aria-controls="tommorrow-appointment" aria-selected="false">Tomorrow</a>
                  </div>
                </nav>
                <div class="tab-content" id="appointment_list">
                  <div class="tab-pane fade show active" id="today_appointment" role="today_appointment" aria-labelledby="today-appointment">
                      <today-table :appointment="{{json_encode($appointments, true)}}"></today-table>
                  </div>
                  <div class="tab-pane fade" id="tomorrow_appointment" role="tomorrow_appointment" aria-labelledby="tomorrow-appointment-tab">
                    <tomorrow-table :tappointments="{{json_encode($tappointments, true)}}"></tomorrow-table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-12 col-md-12 mt-4 mt-lg-0">
              <v-calendar></v-calendar>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->


@endsection
@section('footer')
     @include('back-end.includes.footer')
    <!-- End of Content Wrapper -->
@endsection
@push('scripts')
    <script src="{{ asset('js/chosen.jquery.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>
    <script>
        //jQuery(".dc-chosen-select").chosen();
        $(document).ready(function() {
        $('#today_table').DataTable();
        $('#tomorrow_table').DataTable();
    });
    </script>
@endpush--}}

        <!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @if (trim($__env->yieldContent('title')))
        <title>@yield('title')</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif
    <link rel="icon" href="{{ asset(Helper::getGeneralSettings('site_favicon')) }}" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="{{asset('css/frontend/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/frontend/bootstrap-grid.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/frontend/bootstrap-reboot.min.css')}}">
    <link href="{{ asset('css/frontend/custom-checkbox.css') }}" rel="stylesheet">
    <link href="{{ asset('css/backend/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/utilities.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-family.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend/footer.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/0904c46e05.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
      const APP_URL = {!! json_encode(url('/')) !!};
    </script>
</head>
<body>

<div id="dashboard">

    <!-- Page Wrapper -->
    <div id="wrapper">


        <!-- Content Wrapper -->
        <appointment-listing
                :doctor="{{ $doctor }}"
                :doctors="{{ $doctors }}"
                :hospitals="{{ $hospitals }}"
                :managements="{{ $managements }}"
        ></appointment-listing>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

</div>

<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
<script type="text/javascript" src="{{asset('js/frontend/bootstrap.bundle.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/frontend/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/frontend/knockdoc.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dashboard.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

</body>
</html>
   