@extends('front-end.includes.master')
@section('title',$page_title) 
@section('meta_title',$meta_title) 
@section('meta_description',$meta_description) 
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
        $users_data = $users;
        $disease = !empty($disease) ? $disease : [];
        $breadcrumbs = \request()->segments();
        $gender_name = end($breadcrumbs);
        $keyword = "";
        if($location == ''){
        $locationSlug =  'pakistan';
      }
        if($location != null){
            $locationSlug =  $location->slug;
      }
      else
      {
        $locationSlug='pakistan';
      }
        if($disease != null && $location != null)
        {
           
                $breadcrumbsdata=Breadcrumbs::generate('diseases-slug-city',$disease,$location);
           
        }
        else
        {
            $breadcrumbsdata=Breadcrumbs::generate('diseases-slug', $disease);
        }

    @endphp
    {{--Search Page Section Start--}}
    <!--     @if($disease != null)
         @if (Request::path() == ('diseases/'.$disease->slug))
         <div class="search-bg w-100 d-inline-block">
           <div class="container" v-cloak>  
          <div class="row">
                <div class="col-12 mt-4">
                  {{ Breadcrumbs::render('diseases-slug', $disease) }}
                </div>
          </div>
      </div>
  </div>
        @endif
        @endif
        @if($disease != null && $location != null)
            @if (Request::path() == ('diseases/'.$disease->slug.'/'.$location->slug))
            <div class="search-bg w-100 d-inline-block">
                   <div class="container" v-cloak> 
                  <div class="row">
                        <div class="col-12 mt-4">
                         {{ Breadcrumbs::render('diseases-slug-city',$disease,$location) }}
                        </div>
                  </div>
              </div> 
          </div>
            @endif
    @endif    -->
    <search-page
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
<script type="text/javascript" src="{{asset('js/searchPage.min.js')}}"></script>
<link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/highlight.min.js"></script>
@endsection