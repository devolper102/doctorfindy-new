@extends('front-end.includes.master')
@section('meta_title',$article->title) 
@section('meta_description',$article->short_description)
@section('blog_title', $article->title)
@section('blog_description', $article->short_description)
@section('blog_url', url('/health-articles/'.$article->slug))
@section('blog_create', $article->created_at)
@section('blog_image',$article->image) 
@section('blog_update', $article->updated_at)
@section('content')
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/article-blogs.min.css') }}" >
       @php
        $breadCrumbs_script_data = Helper::breadCrumbsStructure();
        $organizationStructure_script_data = Helper::organizationStructure();
        $blog_Structure_script_data = Helper::blogleStructure($article->id);
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
      <div class="container" v-cloak>
      <div class="row">
            <div class="col-12 mt-4 pl-xl-0">
                <div class="w-100 d-inline-block blog-detail-breadcrumb">
                    {{ Breadcrumbs::render('article-show', $article) }}
                </div>
            </div>
      </div>
    </div>
    <article-detail
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
            :article="{{json_encode($article, true)}}"
            :articles="{{json_encode($articles, true)}}"
            :segments="{{ json_encode($segments, true) }}"
    ></article-detail>

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
<link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/highlight.min.js"></script>
@endsection