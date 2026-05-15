@extends('back-end.master')
@push('backend_stylesheets')
@endpush
@section('content')
    @include('includes.pre-loader')

    <div class="container" id="user-profile">


        <online-appointment-booking-system
                :doctors="{{$doctors}}"
                :hospitals="{{$hospitals}}"
                :specialities="{{$specialities}}"
                :diseases="{{$diseases}}"
                :locations="{{$locations}}"
        >
        </online-appointment-booking-system>
    </div>

@endsection
@push('scripts')
    @stack('backend_scripts')
@endpush