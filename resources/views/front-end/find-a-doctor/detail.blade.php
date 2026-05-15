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
    @include('includes.pre-loader')
    <div id="forntend">
        <doctor-by-city
                :doctors="{{$doctors}}"
                :location="`{{$location}}`"
                :specialty="`{{$specialty}}`"
        ></doctor-by-city>
    </div>


@endsection
@push('front_end_scripts')
    <script>
    </script>
@endpush
