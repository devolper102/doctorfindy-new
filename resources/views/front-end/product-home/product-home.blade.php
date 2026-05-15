@extends('front-end.includes.master')
@section('title','Surgeries cost in Pakistan-pkr - List, Book Appointment Online | KnockDoc') 
@section('meta_title','Surgeries cost in Pakistan-pkr - List, Book Appointment Online | KnockDoc') 
@section('meta_description','All Surgeries and their cost in Pakistan | KnockDoc') 
@section('content')
<!-- <link rel="stylesheet" type="text/css" href="css/product-home.css"> -->
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/product-home.css') }}" >
<!-- <link rel="stylesheet" type="text/css" href="css/utilities.css"> -->
  <link rel="stylesheet" type="text/css" href="css/product-home-responsive.css">
  <link rel="stylesheet" type="text/css" href="css/product-utilities.css">
       @php
        $breadCrumbs_script_data = Helper::breadCrumbsStructure();
        $organizationStructure_script_data = Helper::organizationStructure();
    @endphp
    <style type="text/css">
      [v-cloak] { display: none; }
    </style>

<div id="home">
    <div v-if="loading" id="loader-main">
        <div v-if="loading" id="loader"></div>
    </div>
    {{--Header Section Start--}}
   <header-section
            :doctorss="{{ json_encode($doctors, true) }}"
            :hospitalss="{{ json_encode($hospitals, true) }}"
            :specialitys = "{{json_encode($specialities, true)}}"
            :servicess = "{{json_encode($services, true)}}"
            :cities = "{{json_encode($cities, true)}}"
            :logged_user = "{{json_encode($logged_user, true)}}"
            :managements = "{{json_encode($managements, true)}}"
            :laboratorys="{{ json_encode($laboratories, true) }}"
            :diseasess="{{json_encode($diseases, true) }}"
    ></header-section>
    {{--Header Section End--}}
    <product-home-section 
    :top_products="{{json_encode($top_products,true)}}"
    :top_categories="{{json_encode($top_categories,true)}}"
    :product_categories="{{json_encode($product_categories,true)}}"
    :page_setting="{{json_encode($pageSetting,true)}}">
    </product-home-section>
    <product-brand-section 
    :page_setting="{{json_encode($pageSetting,true)}}"
    :product_brands="{{json_encode($product_brands,true)}}"
    :featured_products="{{json_encode($featured_products,true)}}"
    :page_setting="{{json_encode($pageSetting,true)}}">
    </product-brand-section>
    <product-offer-section 
    :current_week_products="{{json_encode($current_week_products,true)}}"
    :current_month_products="{{json_encode($current_month_products,true)}}"
    :page_setting="{{json_encode($pageSetting,true)}}">
    </product-offer-section>
    {{--Footer Section--}}
    <footer-section
    :locations = "{{json_encode($cities, true)}}"
    :specialities = "{{json_encode($specialities, true)}}"
    :laboratories = "{{json_encode($laboratories, true)}}"
    :top_hospitals = "{{json_encode($hospitals, true)}}"
    :managements = "{{json_encode($managements, true)}}"
    ></footer-section>
    {{--Footer Section--}}
</div>
<script rel="preload" type="text/javascript" src="js/product-frontend.js"></script>
@endsection