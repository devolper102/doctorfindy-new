@extends('front-end.includes.master')
@section('title',$page_title) 
@section('meta_title',$meta_title) 
@section('meta_description',$meta_description) 
@section('content')
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/all-diseses.min.css') }}" >
       @php
        $breadCrumbs_script_data = Helper::breadCrumbsStructure();
        $organizationStructure_script_data = Helper::organizationStructure();
        $breadcrumbsdata=Breadcrumbs::generate('diseases-slug', $disease);
        $users_data = $users;
        if($location != null){
            $locationSlug =  $location->slug;
          }
          else
          {
            $locationSlug='pakistan';
          }
    @endphp
    <style type="text/css">
      [v-cloak] { display: none; }
    </style>
<div id="listing">
    <div v-if="loading" id="loader-main">
        <div v-if="loading" id="loader"></div>
    </div>
    <header-section
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
            :specialitys = "{{json_encode($specialities, true)}}"
            :cities = "{{json_encode($cities, true)}}"
            :logged_user = "{{json_encode($logged_user, true)}}"
            :managements = "{{json_encode($managements, true)}}"
            :laboratorys="{{ json_encode($laboratories, true) }}"
    ></header-section>
    <disease-categorey
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
            :user-data="{{json_encode($users_data, true)}}"
            :patients-data="{{ json_encode($logged_user, true) }}"
            :hosp="{{ json_encode($hospitals, true) }}"
            :docs="{{ json_encode($doctors, true) }}"
            :result-location="{{json_encode($locationSlug, true) }}"
            :result-service="{{json_encode($service, true) }}"
            :result-disease="{{json_encode($disease, true) }}"
            :result-speciality="{{json_encode($speciality, true)}}"
            :cities="{{json_encode($cities, true)}}"
            :cities-pakistan="{{json_encode($cities_pakistan,true)}}"
            :special = "{{json_encode($specialities, true)}}"
            :labs="{{ json_encode($laboratories, true) }}"
            :dise="{{json_encode($diseases, true) }}"
            :allservices="{{json_encode($services, true) }}"
            :type="{{json_encode($type, true) }}"
            :tests="{{json_encode($tests, true) }}"
            :total-count = "{{$total_count}}"
            :bread_crumb_data="{{json_encode($breadcrumbsdata,true)}}"></disease-categorey>

            <footer-section
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
            :locations = "{{json_encode($cities, true)}}"
            :specialities = "{{json_encode($specialities, true)}}"
            :laboratories = "{{json_encode($laboratories, true)}}"
            :managements = "{{json_encode($managements, true)}}"
            :top_hospitals = "{{json_encode($hospitals, true)}}"
            ></footer-section>
</div>
<script type="text/javascript" src="{{asset('js/listing.min.js')}}"></script>
@endsection
