@extends('front-end.master')
@section('description', '')
@section('keywords', '')
@push('front_end_stylesheets')
    <style>
        .tag_docname{
            background-color: #5bc0de;
            display: inline-block;
            padding: 0.2em 0.6em 0.3em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25em;
        }
    </style>
    <link href="{{ asset('css/chosen.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="dc-breadcrumbarea">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ol class="dc-breadcrumb">
                    <li><a href="{{ url('/') }}">{{ trans('lang.home') }}</a></li>
                    <li>{{ trans('lang.dermatology') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
    @include('includes.pre-loader')
    <div id="forntend">
        <speciality-page
                :disease-title="'{{$service->title}}'"
                :disease-slug="'{{$service->slug}}'"
                :disease-description="`{{$service->description}}`"
                :disease-flag="'{{$service->flag}}'"
                :user-data="{{$doctors}}"
                :hospitals-data="{{$hospitals}}"
                :specialities-data="{{$services}}"
        ></speciality-page>
    </div>

@endsection
@push('front_end_scripts')
    <script>
    </script>
@endpush
