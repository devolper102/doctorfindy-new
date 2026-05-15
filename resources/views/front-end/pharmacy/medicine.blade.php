@extends('front-end.includes.master')
@section('title', ($medicine->name ?? 'Medicine') . ' - Pharmacy | DoctorFindy')
@section('meta_title', $medicine->name ?? 'Medicine')
@section('meta_description', $medicine->details->description ?? 'Buy ' . ($medicine->name ?? 'medicine') . ' online in Pakistan')
@section('content')
<head>
   <link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/home.css') }}" >
   <meta name="robots" content="noindex, nofollow">
</head>
<script>
// Add noindex meta tag to head
(function() {
    var meta = document.createElement('meta');
    meta.name = 'robots';
    meta.content = 'noindex, nofollow';
    document.getElementsByTagName('head')[0].appendChild(meta);
})();
</script>
        @php
            $breadCrumbs_script_data = Helper::breadCrumbsStructure();
            $organizationStructure_script_data = Helper::organizationStructure();
            $filesystemDriver = env('FILESYSTEM_DRIVER');
        @endphp
    <style type="text/css">
      [v-cloak] { display: none; }
    </style>
<div id="pharmacy-medicine" v-cloak>
     <div v-if="loading" id="loader-main">
        <div v-if="loading" id="loader"></div>
    </div> 
    {{--Header Section Start--}}
    <header-section
            :file-system-driver="{{ json_encode($filesystemDriver) }}"
            :doctorss="{{ json_encode($doctors, true) }}"
            :hospitalss="{{ json_encode($hospitals, true) }}"
            :specialitys = "{{json_encode($specialities, true)}}"
            :servicess = "{{json_encode($services, true)}}"
            :cities = "{{json_encode($locations, true)}}"
            :logged_user = "{{json_encode($logged_user, true)}}"
            :managements = "{{json_encode($managements, true)}}"
            :laboratorys="{{ json_encode($laboratories, true) }}"
            :diseasess="{{json_encode($diseases, true) }}"
    ></header-section>
    {{--Header Section End--}}

    {{--Start mobile-fixed-menu Section--}}
    <mobile-fixed-menu-section
    :file-system-driver="{{ json_encode($filesystemDriver) }}"
    :managements = "{{json_encode($managements, true)}}">
    </mobile-fixed-menu-section>
    {{--End Start mobile-fixed-menu Section--}}

    {{--Breadcrumbs Section Start--}}
    <div class="container" v-cloak>
        <div class="row">
            <div class="col-12 mt-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pharmacy.index') }}">Pharmacy</a></li>
                        @if($medicine->category)
                        <li class="breadcrumb-item"><a href="{{ route('pharmacy.category', $medicine->category->slug) }}">{{ $medicine->category->name }}</a></li>
                        @endif
                        <li class="breadcrumb-item active" aria-current="page">{{ $medicine->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    {{--Breadcrumbs Section End--}}

    {{--Medicine Detail Section Start--}}
    <pharmacy-medicine-detail-section
            :file-system-driver="{{ json_encode($filesystemDriver) }}"
            :medicine="{{ json_encode($medicine, true) }}"
            :related-medicines="{{ json_encode($relatedMedicines, true) }}"
    ></pharmacy-medicine-detail-section>
    {{--Medicine Detail Section End--}}

    {{--Footer Section--}}
    <footer-section
            :file-system-driver="{{ json_encode($filesystemDriver) }}"
            :locations = "{{json_encode($locations, true)}}"
            :specialities = "{{json_encode($specialities, true)}}"
            :laboratories = "{{json_encode($laboratories, true)}}"
            :managements = "{{json_encode($managements, true)}}"
            :top_hospitals = "{{json_encode($hospitals, true)}}"
    ></footer-section>
    {{--Footer Section--}}
</div>
<script type="text/javascript" src="{{asset('js/pharmacy.min.js')}}"></script>
@endsection

