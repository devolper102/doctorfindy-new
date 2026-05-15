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
            :type="{{json_encode($type, true) }}"
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
        $location = !empty($location) ? $location : [];
        $service = !empty($service) ? $service : [];
        $disease = !empty($disease) ? $disease : [];
        $speciality = !empty($speciality) ? $speciality : [];
        $faqs = !empty($faqs) ? $faqs : [];
        $keyword = !empty($keyword) ? $keyword : [];
        $breadcrumbs = \request()->segments();
        $gender_name = end($breadcrumbs);
        $breadcrumbsdata=[];
    @endphp
    {{--Search Page Section Start--}}
@if (count($breadcrumbs) === 1) 
    @if($speciality != null)
         @if (Request::path() == ($speciality->slug.'-in-pakistan'))
           <div class="container" v-cloak>  
          <div class="row">
                <div class="col-12 mt-4">
                  {{ Breadcrumbs::render('speciality-in-Pakistan', $speciality) }}
                </div>
          </div>
      </div>
        @endif
    @endif
         @if (Request::path() == ('online-doctor-consultation'))
           <div class="container" v-cloak> 
          <div class="row">
                <div class="col-12 mt-4">
                  {{ Breadcrumbs::render('online-doctor-consultation') }}
                </div>
          </div>
      </div>
        @endif
        @if (Request::path() == ('labs'))
           <div class="container" v-cloak> 
          <div class="row">
                <div class="col-12 mt-4">
                  {{ Breadcrumbs::render('labs') }}
                </div>
          </div>
      </div>
        @endif
         @if (Request::path() == ('all-doctors'))
           <div class="container" v-cloak> 
          <div class="row">
                <div class="col-12 mt-4">
                  {{ Breadcrumbs::render('all-doctors') }}
                </div>
          </div>
      </div>
        @endif
         @if (Request::path() == ('all-hospitals'))
           <div class="container" v-cloak> 
          <div class="row">
                <div class="col-12 mt-4">
                  {{ Breadcrumbs::render('all-hospitals') }}
                </div>
          </div>
      </div>
        @endif
         @if (Request::path() == ('search-results'))
         <div class="search-bg w-100 d-inline-block">
           <div class="container" v-cloak> 
          <div class="row">
                <div class="col-12 mt-4">
                  {{ Breadcrumbs::render('search-results') }}
                </div>
          </div>
      </div>
  </div>
        @endif
    @if($speciality != null && $location != null)
            @if (Request::path() == ($speciality->slug.'-in-'.$location->slug))
                   <div class="container" v-cloak> 
                  <div class="row">
                        <div class="col-12 mt-4">
                         {{ Breadcrumbs::render('speciality-in-city',$speciality, $location) }}
                        </div>
                  </div>
              </div> 
            @endif
    @endif
@endif
    @if($location != null)
            @if (Request::path() == ('doctors/'.$location->slug))
                   <div class="container" v-cloak> 
                  <div class="row">
                        <div class="col-12 mt-4">
                         {{ Breadcrumbs::render('doctors-by-city', $location) }}
                        </div>
                  </div>
              </div> 
            @endif
    @endif
@if($location != null && $area != '' )
@if (Request::path() == ('doctors/'.$location->slug.'/'.$area))
       <div class="container" v-cloak> 
      <div class="row">
            <div class="col-12 mt-4">
             {{ Breadcrumbs::render('doctors-by-city-area', $location,$area) }}
            </div>
      </div>
  </div> 
@endif
@endif
 @if($speciality != null)
            @if (Request::path() == ('online-doctor-consultation/'.$speciality->slug))
                   <div class="container" v-cloak> 
                  <div class="row">
                        <div class="col-12 mt-4">
                         {{ Breadcrumbs::render('online-doctor-consultation-speciality',$speciality) }}
                        </div>
                  </div>
              </div> 
            @endif
 @endif
 @if($speciality != null && $location != null)
            @if (Request::path() == ('online-doctor-consultation/'.$speciality->slug.'/'.$location->slug))
                   <div class="container" v-cloak> 
                  <div class="row">
                        <div class="col-12 mt-4">
                         {{ Breadcrumbs::render('online-doctor-consultation-speciality-city',$speciality,$location) }}
                        </div>
                  </div>
              </div> 
            @endif
    @endif
@if($location != null && $area != '' && $speciality != null)
            @if (Request::path() == ('doctor/'.$location->slug.'/'.$area.'/'.$speciality->slug))
                   <div class="container" v-cloak> 
                  <div class="row">
                        <div class="col-12 mt-4">
                         {{ Breadcrumbs::render('doctor-city-area-speciality',$location,$area,$speciality) }}
                        </div>
                  </div>
              </div> 
            @endif
    @endif
{{-- diseases --}}
@if($disease != null)
            @if (Request::path() == ('diseases/'.$disease->slug))
                   <div class="container" v-cloak> 
                  <div class="row">
                        <div class="col-12 mt-4">
                         {{ Breadcrumbs::render('diseases-slug',$disease) }}
                        </div>
                  </div>
              </div> 
            @endif
    @endif
    @if($disease != null && $location != null)
            @if (Request::path() == ('diseases/'.$disease->slug.'/'.$location->slug))
                   <div class="container" v-cloak> 
                  <div class="row">
                        <div class="col-12 mt-4">
                         {{ Breadcrumbs::render('diseases-slug-city',$disease,$location) }}
                        </div>
                  </div>
              </div> 
            @endif
    @endif

    @if($disease != null && $location != null && $area != '')
            @if (Request::path() == ('diseases/'.$disease->slug.'/'.$location->slug.'/'.$area))
                   <div class="container" v-cloak> 
                  <div class="row">
                        <div class="col-12 mt-4">
                         {{ Breadcrumbs::render('diseases-slug-city-area',$disease,$location,$area) }}
                        </div>
                  </div>
              </div> 
            @endif
    @endif
{{-- services --}}
    @if($service != null)
            @if (Request::path() == ('treatments/'.$service->slug))
                   <div class="container" v-cloak> 
                  <div class="row">
                        <div class="col-12 mt-4">
                         {{ Breadcrumbs::render('treatments-slug',$service) }}
                        </div>
                  </div>
              </div> 
            @endif
    @endif
    @if($service != null && $location != null)
            @if (Request::path() == ('treatments/'.$service->slug.'/'.$location->slug))
                   <div class="container" v-cloak> 
                  <div class="row">
                        <div class="col-12 mt-4">
                         {{ Breadcrumbs::render('treatments-slug-city',$service,$location) }}
                        </div>
                  </div>
              </div> 
            @endif
    @endif

    @if($service != null && $location != null && $area != '')
            @if (Request::path() == ('treatments/'.$service->slug.'/'.$location->slug.'/'.$area))
                   <div class="container" v-cloak> 
                  <div class="row">
                        <div class="col-12 mt-4">
                         {{ Breadcrumbs::render('treatments-slug-city-area',$service,$location,$area) }}
                        </div>
                  </div>
              </div> 
            @endif
    @endif

    {{-- labs --}}
        @if($location != null)
            @if (Request::path() == ('labs/'.$location->slug))
                   <div class="container" v-cloak> 
                  <div class="row">
                        <div class="col-12 mt-4">
                         {{ Breadcrumbs::render('labs-city',$location) }}
                        </div>
                  </div>
              </div> 
            @endif
    @endif

      @if($location != null && $area != '')
            @if (Request::path() == ('labs/'.$location->slug.'/'.$area))
                   <div class="container" v-cloak> 
                  <div class="row">
                        <div class="col-12 mt-4">
                         {{ Breadcrumbs::render('labs-city-area',$location,$area) }}
                        </div>
                  </div>
              </div> 
            @endif
    @endif
    {{--   @if($location != null && $speciality != null)
            @if (Request::path() == ('labs/'.$location->slug.'/'.$speciality->slug))
                   <div class="container" v-cloak> 
                  <div class="row">
                        <div class="col-12 mt-4">
                         {{ Breadcrumbs::render('all-labs-city-speciality',$location,$speciality) }}
                        </div>
                  </div>
              </div> 
            @endif
    @endif --}}

     {{-- labs --}}
        @if($location != null)
            @if (Request::path() == ('hospitals/'.$location->slug))
                   <div class="container"  v-cloak> 
                  <div class="row">
                        <div class="col-12 mt-4">
                         {{ Breadcrumbs::render('hospitals-city',$location) }}
                        </div>
                  </div>
              </div> 
            @endif
    @endif

     {{-- @if($location != null && $area != '')
            @if (Request::path() == ('hospitals/'.$location->slug.'/'.$area))
                   <div class="container" v-cloak> 
                  <div class="row">
                        <div class="col-12 mt-4">
                         {{ Breadcrumbs::render('hospitals-city-area',$location) }}
                        </div>
                  </div>
              </div> 
            @endif
    @endif --}}
        @if($location != null && $speciality != null)
            @if (Request::path() == ('doctors/'.$location->slug.'/'.$speciality->slug.'/gender/'.$gender_name))
                   <div class="container" v-cloak> 
                  <div class="row">
                        <div class="col-12 mt-4">
                         {{ Breadcrumbs::render('speciality-by-doctor-gender-wise',$location,$speciality,$gender_name) }}
                        </div>
                  </div>
              </div> 
            @endif
    @endif

      @if($location != null && $area != '' && $speciality != null)
            @if (Request::path() == ('doctors/'.$location->slug.'/'.$area.'/'.$speciality->slug.'/gender/'.$gender_name))
                   <div class="container" v-cloak> 
                  <div class="row">
                        <div class="col-12 mt-4">
                         {{ Breadcrumbs::render('speciality-get-routes-gender-wise',$location,$area,$speciality,$gender_name) }}
                        </div>
                  </div>
              </div> 
            @endif
    @endif
    @if($type=="laboratory")
    <search-page
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
            :user-data="{{json_encode($users_data, true)}}"
            :patients-data="{{ json_encode($logged_user, true) }}"
            :result-service="{{json_encode($service, true) }}"

            :result-type="'{{json_encode($type, true) }}'"

            :result-speciality="{{json_encode($speciality, true)}}"
            :result-disease="{{json_encode($disease, true) }}"

            :result-faqs="{{json_encode($faqs, true)}}"
            :result-faq="{{json_encode($faq, true)}}"
            :result-segments="{{json_encode($segments, true)}}"
            :result-keywords="{{json_encode($keyword, true)}}"
            :cities="{{json_encode($cities, true)}}"
            :special = "{{json_encode($specialities, true)}}"
            :type="{{json_encode($type, true) }}"
            :tests="{{json_encode($tests, true) }}"
            :faq="{{json_encode($faq, true) }}"
            :total-count = "{{$total_count}}"
            :bread_crumb_data="{{json_encode($breadcrumbsdata,true)}}"
    >
    </search-page>
    @else
    <search-page
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
            :user-data="{{json_encode($users_data, true)}}"
            :patients-data="{{ json_encode($logged_user, true) }}"
            :allservices="{{json_encode($services, true) }}"

            :docs="{{ json_encode($doctors, true) }}"
            :result-location="{{json_encode($location, true) }}"
            :hosp="{{ json_encode($hospitals, true) }}"
            :labs="{{ json_encode($laboratories, true) }}"
            :dise="{{json_encode($diseases, true) }}"

            :result-service="{{json_encode($service, true) }}"

            :result-type="'{{json_encode($type, true) }}'"

            :result-speciality="{{json_encode($speciality, true)}}"
            :result-disease="{{json_encode($disease, true) }}"

            :result-faqs="{{json_encode($faqs, true)}}"
            :result-faq="{{json_encode($faq, true)}}"
            :result-segments="{{json_encode($segments, true)}}"
            :result-keywords="{{json_encode($keyword, true)}}"
            :cities="{{json_encode($cities, true)}}"
            :cities-pakistan="{{json_encode($cities_pakistan,true)}}"
            :special = "{{json_encode($specialities, true)}}"
            :type="{{json_encode($type, true) }}"
            :tests="{{json_encode($tests, true) }}"
            :faq="{{json_encode($faq, true) }}"
            :total-count = "{{$total_count}}"
            :bread_crumb_data="{{json_encode($breadcrumbsdata,true)}}"
    >
    </search-page>
    @endif

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

@endsection