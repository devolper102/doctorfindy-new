@extends('front-end.includes.master')

@section('content')
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/article-blogs.min.css') }}" >
     <style type="text/css">
      [v-cloak] { display: none; }
    </style>
<div id="blog">
    <div v-if="loading" id="loader-main">
        <div v-if="loading" id="loader"></div>
    </div>
    <blog-profile-banner-section></blog-profile-banner-section>
    <blog-auther-profile-section></blog-auther-profile-section>
</div>
<script type="text/javascript" src="{{asset('js/blog.min.js')}}"></script>
<link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/highlight.min.js"></script>
@endsection