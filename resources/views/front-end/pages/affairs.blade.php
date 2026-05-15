@extends('front-end.master') @section('description', '') @section('keywords', '') @section('content')

 <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="site-map">
                    <h1> {{$affairDetail->name}} </h1>
                </div>
            </div>
        </div>
        
    </div>
<div class="container">
    {!! $affairDetail->description !!} 
</div>
@endsection