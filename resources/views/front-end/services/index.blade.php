@extends('front-end.master')
@section('description', '')
@section('keywords', '')
@section('content')    
<div class="container" id="user-profile">

    <services
            :specialities-data="{{$specialities}}"
    >
    </services>
</div>
@endsection