@extends('front-end.includes.master')
@section('title', ($category->meta_title ?? $category->name) . ' - Pharmacy | DoctorFindy')
@section('meta_title', $category->meta_title ?? $category->name)
@section('meta_description', $category->meta_description ?? 'Browse medicines in ' . $category->name . ' category')
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
<div id="pharmacy-category" v-cloak>
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
                {{ Breadcrumbs::render('pharmacy-category', $category) }}
            </div>
        </div>
    </div>
    {{--Breadcrumbs Section End--}}

    <div class="container mt-4">
        {{--Category Header Section Start--}}
        <pharmacy-category-header-section
                :file-system-driver="{{ json_encode($filesystemDriver) }}"
                :category="{{ json_encode($category, true) }}"
        ></pharmacy-category-header-section>
        {{--Category Header Section End--}}

        {{--Subcategory Filters Section Start--}}
        <pharmacy-subcategory-filters-section
                :subcategories="{{ json_encode($subcategories, true) }}"
                :current-subcategory="{{ json_encode(request()->get('subcategory')) }}"
        ></pharmacy-subcategory-filters-section>
        {{--Subcategory Filters Section End--}}

        {{--Medicines List Section Start--}}
        <pharmacy-category-medicines-section
                :file-system-driver="{{ json_encode($filesystemDriver) }}"
                :medicines="{{ json_encode($medicines, true) }}"
        ></pharmacy-category-medicines-section>
        {{--Medicines List Section End--}}
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

