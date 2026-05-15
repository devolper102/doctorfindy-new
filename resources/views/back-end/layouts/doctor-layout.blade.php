<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}"> <!--<![endif]-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{Helper::getTextDirection()}}">
<!--<![endif]-->
<head>
  <title>Patient Dashboard</title>
	<meta charset="UTF-8">
	<meta name="description" content="Book a Doctor">
	<meta name="keywords" content="HTML, CSS, JavaScript">
	<meta name="author" content="DoctorFindy">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{asset('css/frontend/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/frontend/bootstrap-grid.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/frontend/bootstrap-reboot.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/backend/common.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/backend/doctor.css')}}">
	<link href="{{ asset('css/themify-icons.css') }}" rel="stylesheet">
	  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
	  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css">
	<script src="https://kit.fontawesome.com/0904c46e05.js" crossorigin="anonymous"></script>
@stack('stylesheets')
    @stack('inlineStyle')
    @php echo \App\Typo::setSiteStyling(); @endphp
    <script type="text/javascript">
      var APP_URL = {!! json_encode(url('/')) !!}
      var Map_key = {!! json_encode(Helper::getGoogleMapApiKey()) !!}
    </script>
    @if (Auth::user())
        <script type="text/javascript">
          var USERID = {!! json_encode(Auth::user()->id) !!}
            window.Laravel = {!! json_encode([
            'csrfToken'=> csrf_token(),
            'user'=> [
                'authenticated' => auth()->check(),
                'id' => auth()->check() ? auth()->user()->id : null,
                'name' => auth()->check() ? auth()->user()->first_name : null,
                'image' => !empty(auth()->user()->profile->avatar) ? asset('uploads/users/'.auth()->user()->id .'/'.auth()->user()->profile->avatar) : asset('images/user-login.png'),
                'image_name' => !empty(auth()->user()->profile->avatar) ? auth()->user()->profile->avatar : '',
                ]
                ])
            !!};
        </script>
    @endif
    <script>
      window.trans = <?php
      $lang_files = File::files(resource_path() . '/lang/' . App::getLocale());
      $trans = [];
      foreach ($lang_files as $f) {
          $filename = pathinfo($f)['filename'];
          $trans[$filename] = trans($filename);
      }
      echo json_encode($trans);
      ?>;
    </script>
</head>
<body id="page-top">
	{{ \App::setLocale(env('APP_LANG')) }}
	<div id="wrapper">
		@yield('sidebar')
		<div id="content-wrapper" class="d-flex flex-column">
		@yield('main')
		@yield('footer')
		</div>
	</div>
 	<!-- Bootstrap core JavaScript-->
  	<script  src="{{asset('js/jquery.min.js')}}"></script>
  	<script src="{{asset('js/backend/sb-admin-2.min.js')}}"></script>
	<script  src="{{asset('js/frontend/bootstrap.bundle.min.js')}}"></script>
	<script  src="{{asset('js/frontend/bootstrap.min.js')}}"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/dashboard.js') }}"></script>
	@stack('scripts')
  	<!-- Custom scripts for all pages-->
</body>
</html>
