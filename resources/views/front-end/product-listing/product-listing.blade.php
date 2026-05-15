@extends('front-end.includes.master')
@section('title','Surgeries cost in Pakistan-pkr - List, Book Appointment Online | KnockDoc') 
@section('meta_title','Surgeries cost in Pakistan-pkr - List, Book Appointment Online | KnockDoc') 
@section('meta_description','All Surgeries and their cost in Pakistan | KnockDoc') 
@section('content')
<!-- <link rel="stylesheet" type="text/css" href="/css/product-listing.css">
<link rel="stylesheet" type="text/css" href="/css/utilities.css"> -->
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/product-listing.css') }}" >
  <link rel="stylesheet" type="text/css" href="/css/product-listing-responsive.css">
  <link rel="stylesheet" type="text/css" href="/css/product-utilities.css">
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
    <product-listing-section 
    :top_products="{{json_encode($top_products,true)}}"
    :top_categories="{{json_encode($top_categories,true)}}"
    :min_price="{{$min_price}}"
    :max_price="{{$max_price}}" 
    :brands="{{json_encode($brands,true)}}"
    :cities="{{json_encode($cities,true)}}"
    :current_category="{{json_encode($current_category,true)}}"
    :categories="{{json_encode($allCategories,true)}}"
    :products="{{json_encode($products,true)}}">
    </product-listing-section>
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
<script rel="preload" type="text/javascript" src="/js/product-frontend.js"></script>
@endsection