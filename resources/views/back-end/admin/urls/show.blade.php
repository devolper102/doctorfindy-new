@extends('back-end.master')
@push('backend_stylesheets')
<style type="text/css">
	
</style>

@endpush
@section('content')
@include('includes.pre-loader')
    <div class="dc-services" id="services">
 <section class="dc-haslayout">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>{{ $urls_show->title }}</h2>
            </div>
            <div class="card-body">
             <p class="card-text">{!! $urls_show->description !!}</p>
             </div>
        </div>
   </div>         	
   
</section>                  	
</div>
@endsection
@push('scripts')
@stack('backend_scripts')

@endpush
