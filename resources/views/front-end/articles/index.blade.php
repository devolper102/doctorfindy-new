@extends('front-end.includes.master')
@section('title','Health Categories') 
@section('meta_title','All categories of health articles') 
@section('meta_description','Read article about all health categories') 
@section('content')
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/article-blogs.min.css') }}" >
      @php
        $breadCrumbs_script_data = Helper::breadCrumbsStructure();
        $organizationStructure_script_data = Helper::organizationStructure();
        $bread_crumb=Breadcrumbs::generate('article-category', $categories);
    @endphp
     <style type="text/css">
      [v-cloak] { display: none; }
    </style>

<div id="blog">
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
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
    ></header-section>
    {{--Header Section End--}}
    {{-- Start mobile-fixed-menu Section--}}
    <mobile-fixed-menu-section
    :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
    :managements = "{{json_encode($managements, true)}}">
    </mobile-fixed-menu-section>
    {{--End Start mobile-fixed-menu Section--}}
       {{--<div class="container" v-cloak>
      <div class="row">
            <div class="col-12 mt-4">
                {{ Breadcrumbs::render('article-category', $categories) }}
            </div>
      </div>
    </div>--}}
    <article-section
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
            :bread_crumb="{{ json_encode($bread_crumb,true) }}"
            :round_articles="{{ json_encode($roundArticles,true) }}"
            :articles="{{ json_encode($articles, true) }}"
            :categories="{{ json_encode($categories, true) }}"
            :segments="{{ json_encode($segments, true) }}"
            :logged_user = "{{json_encode($logged_user, true)}}"
    ></article-section>
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
<script type="text/javascript" src="{{asset('js/blog.min.js')}}"></script>
<script type="text/javascript">
var header = document.getElementById("myDIV");
var btns = header.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active");
  current[0].className = current[0].className.replace(" active", "");
  this.className += " active";
  });
}
</script>
<link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/highlight.min.js"></script>
@endsection