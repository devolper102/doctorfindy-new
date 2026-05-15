@extends('front-end.includes.master')
@section('title',$page_title) 
@section('meta_title',$meta_title) 
@section('meta_description',$meta_description) 
@section('meta_keywords',$meta_key)
@section('content')
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/search-pages.min.css') }}" >
    <style type="text/css">
      [v-cloak] { display: none; }
    </style>
<div id="search">
     <div v-if="loading" id="loader-main">
        <div v-if="loading" id="loader"></div>
    </div> 
    {{--Header Section Start--}}
    <header-section
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
            :specialitys = "{{json_encode($specialities, true)}}"
            :cities = "{{json_encode($cities, true)}}"
            :logged_user = "{{json_encode($logged_user, true)}}"
            :managements = "{{json_encode($managements, true)}}"
            :laboratorys="{{ json_encode($laboratories, true) }}"
    ></header-section>
    {{--Header Section End--}}
    {{-- Start mobile-fixed-menu Section--}}
    <mobile-fixed-menu-section
    :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
    :managements = "{{json_encode($managements, true)}}">
    </mobile-fixed-menu-section>
    {{--End Start mobile-fixed-menu Section--}}
    @php
        $users_data = $users->items();
        $speciality = !empty($speciality) ? $speciality : [];
        $breadcrumbs = \request()->segments();
        $gender_name = end($breadcrumbs);
        $keyword = "";
        $docs = [];
        $servc = [];
        $dise = [];
        $lab = [];
        $hosp = [];
        $tests = [];
        $specialityStructure = Helper::specialityStructure($speciality->slug,$location);
        if(Request::path() == ($speciality->slug.'-in-'.$location))
        {
            $breadcrumbsdata=Breadcrumbs::generate('speciality-in-city',$speciality, $location);
        }
        else
        {
            $breadcrumbsdata=Breadcrumbs::generate('speciality-in-Pakistan', $speciality);
        }
    @endphp
    {{--Search Page Section Start--}}
<!-- @if (count($breadcrumbs) === 1) 
    @if($speciality != null)
         @if (Request::path() == ($speciality->slug.'-in-pakistan'))
        <div class="search-bg w-100 d-inline-block">
           <div class="container" v-cloak>  
                <div class="row">
                    <div class="col-12 mt-4">
                      {{ Breadcrumbs::render('speciality-in-Pakistan', $speciality) }}
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endif
    @if($speciality != null && $location != 'pakistan')
            @if (Request::path() == ($speciality->slug.'-in-'.$location))
            <div class="search-bg w-100 d-inline-block">
                   <div class="container" v-cloak> 
                  <div class="row">
                        <div class="col-12 mt-4">
                         {{ Breadcrumbs::render('speciality-in-city',$speciality, $location) }}
                        </div>
                  </div>
              </div> 
          </div>
            @endif
    @endif
@endif   -->      
    <search-page
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
            :user-data="{{json_encode($users_data, true)}}"
            :patients-data="{{ json_encode($logged_user, true) }}"
            :hosp="{{ json_encode($hosp, true) }}"
            :docs="{{ json_encode($docs, true) }}"
            :result-location="{{json_encode($location, true) }}"
            :result-service="{{json_encode($service, true) }}"
            :result-disease="{{json_encode($disease, true) }}"
            :result-speciality="{{json_encode($speciality, true)}}"
            :cities="{{json_encode($cities, true)}}"
            :cities-pakistan="{{json_encode($cities_pakistan,true)}}"
            :location_areas="{{json_encode($location_areas,true)}}"
            :special = "{{json_encode($specialities, true)}}"
            :labs="{{ json_encode($lab, true) }}"
            :dise="{{json_encode($dise, true) }}"
            :allservices="{{json_encode($servc, true) }}"
            :type="{{json_encode($type, true) }}"
            :tests="{{json_encode($tests, true) }}"
            :total-count = "{{$total_count}}"
            :bread_crumb_data="{{json_encode($breadcrumbsdata,true)}}"
    >
    </search-page>

    {{--Search Page Section End--}}
    {{--Footer Section--}}
    <footer-section
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
            :locations = "{{json_encode($cities, true)}}"
            :specialities = "{{json_encode($specialities, true)}}"
            :laboratories = "{{json_encode($laboratories, true)}}"
            :managements = "{{json_encode($managements, true)}}"
            :top_hospitals = "{{json_encode($hospitals, true)}}"
    ></footer-section>
    {{--Footer Section--}}
</div>


    @php
        $breadCrumbs_script_data = Helper::breadCrumbsStructure();
        $organizationStructure_script_data = Helper::organizationStructure();
    @endphp

{{--  <script>
  $(".map_toggle").on('click',function(){
  $(".google_map ").toggleClass("toggle_map");
  $(".map_btn").toggleClass("hide_map_btn");
});
  

</script> --}}
<!-- <script type="text/javascript">
    document.addEventListener('click', function(e) {
        if(e.target.id =='show-more') {
            var x = document.getElementById('gynecologist-in-pakistan');
            x.style.display = 'block';
            var y = document.getElementById('show-more');
            y.style.display = 'none';
            var s = document.getElementById('show-less');
            s.style.display = 'block';
        } 
    }, false);

    document.addEventListener('click', function(e) {
        if(e.target.id =='show-less') {
            var x = document.getElementById('gynecologist-in-pakistan');
            x.style.display = 'none';
            var y = document.getElementById('show-more');
            y.style.display = 'block';
            var s = document.getElementById('show-less');
            s.style.display = 'none';
        } 
    }, false);
</script> -->
<script type="text/javascript" src="{{asset('js/searchPage.min.js')}}"></script>
<!-- <link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/highlight.min.js"></script> -->
@endsection