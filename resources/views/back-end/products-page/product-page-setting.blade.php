@extends('back-end.master')
@section('content')
@include('includes.pre-loader')
<link rel="stylesheet" type="text/css" href="/css/product-backend.css">
<link rel="stylesheet" type="text/css" href="/css/product-backend-responsive.css">
<link rel="stylesheet" type="text/css" href="/css/product-backend-utilities.css">
    <div id="productBackend">
    	<product-page-setting-section></product-page-setting-section>
    </div>
    <script rel="preload" type="text/javascript" src="/js/products-backend.js"></script>
@endsection 