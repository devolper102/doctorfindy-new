@extends('front-end.includes.master')
@section('title','Pharmacy - Buy Medicines Online in Pakistan | DoctorFindy')
@section('meta_title','Pharmacy - Buy Medicines Online in Pakistan | DoctorFindy')
@section('meta_description','Buy medicines online in Pakistan. Find and order prescription drugs, over-the-counter medicines, and health products from trusted pharmacies.')
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
<div id="pharmacy" v-cloak>
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
                {{ Breadcrumbs::render('pharmacy') }}
            </div>
        </div>
    </div>
    {{--Breadcrumbs Section End--}}

    {{--Pharmacy Slider Section Start--}}
    <pharmacy-slider-section
            :file-system-driver="{{ json_encode($filesystemDriver) }}"
    ></pharmacy-slider-section>
    {{--Pharmacy Slider Section End--}}

    <div class="container mt-4">
        {{--Explore by Category Section Start--}}
        <pharmacy-category-section
                :file-system-driver="{{ json_encode($filesystemDriver) }}"
                :categories="{{ json_encode($categories, true) }}"
        ></pharmacy-category-section>
        {{--Explore by Category Section End--}}

        {{--Top Selling Products Section Start--}}
        <pharmacy-top-products-section
                :file-system-driver="{{ json_encode($filesystemDriver) }}"
                :products="{{ json_encode($topSellingProducts, true) }}"
        ></pharmacy-top-products-section>
        {{--Top Selling Products Section End--}}

        {{--Explore all Medicines Section Start--}}
        <pharmacy-all-medicines-section
                :file-system-driver="{{ json_encode($filesystemDriver) }}"
                :medicines="{{ json_encode($allMedicines, true) }}"
        ></pharmacy-all-medicines-section>
        {{--Explore all Medicines Section End--}}
    </div>

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

