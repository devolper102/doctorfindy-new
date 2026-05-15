@extends('front-end.master')
@section('description', '')
@section('keywords', '')
@section('content')
    <div class="container" id="user-profile">

        <all-disease
                :specialities-data="{{$specialities}}"
        >
        </all-disease>
    </div>
@endsection