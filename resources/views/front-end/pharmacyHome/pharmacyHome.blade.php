@extends('front-end.includes.master')
@section('title','Pharmacy home') 
@section('meta_title','Pharmacy home') 
@section('meta_description','APharmacy home Content') 
@section('content')
   <link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/home.css') }}" >
   <link rel="stylesheet" type="text/css" href="/css/pharmacy-responsive.css">
   <link rel="stylesheet" type="text/css" href="/css/pharmacy.css">
<div id="pharmacy-category" v-cloak>
     <div v-if="loading" id="loader-main">
        <div v-if="loading" id="loader"></div>
    </div> 
    <pharmacy-search-section></pharmacy-search-section>
   <pharmacy-banner-home-section></pharmacy-banner-home-section>
   <pharmacy-delivery-section></pharmacy-delivery-section>
   <subscribe-email-section></subscribe-email-section>
</div>
<script type="text/javascript" src="{{asset('js/pharmacy.min.js')}}"></script>
@endsection

