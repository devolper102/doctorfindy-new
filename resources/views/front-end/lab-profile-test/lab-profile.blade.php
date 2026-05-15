@extends('front-end.includes.master')
@section('content')
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/user-profile.min.css') }}" >
     @php
        $breadCrumbs_script_data = Helper::breadCrumbsStructure();
        $organizationStructure_script_data = Helper::organizationStructure();
    @endphp
    <style type="text/css">
      [v-cloak] { display: none; }
    </style>
</head>
<body>

<div id="profile">
    <div v-if="loading" id="loader-main">
        <div v-if="loading" id="loader"></div>
    </div>
<lab-testing-section></lab-testing-section>
</div>
<script type="text/javascript" src="{{asset('js/profile.min.js')}}"></script>
@endsection