
@extends('back-end.master')
@section('content')
	@include('includes.pre-loader')
<style >
	.bt-content{
		float: left;
		margin-right: 10px;
		margin-bottom: 15px;
	}
	.membership-content .bt-content{
		margin-top: 15px;
	}
</style>
<div class="container" id="user-profile">


	<appointment-booking-system
			:doctors="{{$doctors}}"
			:hospitals="{{$hospitals}}"
			:specialities="{{$specialities}}"
			:diseases="{{$diseases}}"
			:locations="{{$locations}}"
	>
	</appointment-booking-system>


</div>

@endsection

