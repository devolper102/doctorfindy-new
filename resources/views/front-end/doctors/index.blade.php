@extends('front-end.master')
@section('description', '')
@section('keywords', '')
@section('content')
<style>
    #dc-main {
        background-color: #f7f7f7;
    }

    .breadcrumb{
        padding: 0px;
        background-color: transparent;
        margin: 0px;
    }

    .bg-white h1 {
        font-size: 16px;
        margin-bottom: 0;
        margin-top: 0;
    }
    
    .bg-white h2 {
        font-size: 17px;
        margin-bottom: 0;
        margin-top: 0;
    }

    .bg-white h3 {
        font-size: 16px;
        margin-bottom: 0;
        margin-top: 0;
    }
    
    ul.breadcrumb>li+li:before {
        content: "/\00a0";
        padding: 0 5px;
        color: #ccc;
    }
    
    .bg-white {
        width: 100%;
        padding: 1rem 2%;
        display: inline-block;
    }
    
    .grid-list {
        display: grid;
        grid-template-columns: 32% 32% 32%;
        grid-gap: 5px;
        padding-left: 0;
        margin-top: 10px;
    }
    
    .grid-list li {
        font-size: 14px;
        float: left;
        line-height: 24px;
        border-radius: 4px;
        margin-bottom: 5px;
        background: #f7f7f7;
        font-family: Poppins, sans-serif;
    }
    
    .grid-list li:hover {
        background: #55acee;
        box-shadow: 1px 1px 5px #ccc;
        color: #fff;
    }
    
    .grid-list li a,
    .grid-list li label {
        padding: 5px 14px;
        text-decoration: none;
        color: #767676;
        display: block;
        word-wrap: break-word;
    }
    
    a,
    i:before {
        transition: none;
    }
    
    .grid-list li a:hover,
    .grid-list li label:hover {
        color: #fff;
    }
    
    .red-text {
        color: #c02942!important;
    }
    @media screen and (max-width: 600px){
        .grid-list {
            display: grid;
            grid-template-columns: 50% 50%;
            grid-gap: 5px;
            padding-left: 0;
            margin-top: 5px;
        }
        .grid-list li a, .grid-list li label{
            padding: 5px;
        }
    }
    /*mobile view css*/
    </style>
<div class="container" id="user-profile">
    <doctors-by-city
            :speciality-doctors="{{$specialities}}"
            :location-data="{{$location}}"
            :areas-data="{{$areas}}"
            :doctors-data="{{$doctors}}"
    >
    </doctors-by-city>
	{{--<div class="row mt-2 bg-white padding">
		<div class="col-12">
			<h1>Best PMDC Verified Doctors In {{$location->title}} </h1>
			<ul class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li><a href="#">Find a Doctor</a></li>
				<li>Lahore</li>
			</ul>
		</div>
	</div>
	<div class="row mt-2 bg-white padding">
        <div class="col-12">
            <div class="form-group" style="margin:0px;">
                <input type="search" name="search" placeholder="search a doctor by city" class="form-control">
            </div>
        </div>
    </div>
    <div class="row mt-2 bg-white padding">
		<div class="col-12">
			<h2>Top Specialists in {{$location->title}}</h2>
			<ul class="grid-list">
				@foreach($specialities as $speciality)
				<li>
					<a href="#">Best {{$speciality->title}} in {{$location->title}}</a>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
	<div class="row mt-2 bg-white padding">
		<div class="col-12">
			<h2>Locate the best doctor near me</h2>
			<ul class="grid-list">
				@foreach($areas as $area)
				<li>
					<a href="#">Doctors in , {{$area->title}} {{$location->title}}</a>
				</li>
				@endforeach($area)
			</ul>
		</div>
	</div>
	<div class="row mt-2 bg-white padding">
		<div class="col-12">
			<h2>Locate the best female doctor near me</h2>
			<ul class="grid-list">
				@foreach($doctors as $doctor)
					@if($doctor->profile->gender == 'female')
						<li>
							<a href="#">Female Doctors in , {{$doctor->profile->address}}</a>
						</li>
					@endif
				@endforeach
			</ul>
		</div>
	</div>--}}
</div>
@endsection