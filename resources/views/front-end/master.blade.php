<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	    @if (trim($__env->yieldContent('title')))
        <title>@yield('title')</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif
    <meta name="title" content="An online doctor booking platform">
    <meta name="description" content="Book Appointment From Home Or Get Online Audio / Video Consultation With Pakistan">
    <link rel="icon" href="{{ asset(Helper::getGeneralSettings('site_favicon')) }}" type="image/x-icon">
    
	<meta name="description" content="An online doctor booking platform">
	<meta name="keywords" content="@yield('keywords')">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<link rel="apple-touch-icon" href="apple-touch-icon.png">


	@stack('PackageStyle')

{{-- 	<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/fontawesome/fontawesome-all.css') }}" rel="stylesheet">
	<link href="{{ asset('css/tipso.css') }}" rel="stylesheet"> --}}
	@stack('front_end_stylesheets')
	@stack('stylesheets')
	@stack('inlineStyle')

	@section('header')
		@include('front-end.includes.header')
	@endsection
	<script type="text/javascript">
		var APP_URL = {!! json_encode(url('/')) !!}
	</script>
	@php
		$inner_page_settings = !empty(App\SiteManagement::getMetaValue('inner_page_data')) ? App\SiteManagement::getMetaValue('inner_page_data') : array();
	@endphp
</head>

<body>
<div class="dc-wrapper dc-haslayout dc-closemenu">
	<main id="dc-main" class="dc-main dc-haslayout">
		@yield('content')
	</main>
</div>

<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
@stack('front_end_scripts')
@include('front-end.includes.footer')
{{-- 
	<script src="{{ asset('js/moment.min.js') }}"></script>
	<script src="{{ asset('js/tipso.js') }}"></script> --}}
</body>
</html>

