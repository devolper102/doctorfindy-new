{!! Form::open(['url' => '', 'class' => 'dc-formtheme dc-services-holder', 'id' => 'manage-update-hospital-services-form', '@submit.prevent' => 'submitUpdateHospitalServices']) !!}
<input type="hidden" name="id" value="<?php echo Auth::id(); ?>">
<input type="hidden" name="role" value="<?php echo Auth::id(); ?>">

<hospital-services
        :hospital_icu="'{{$hospital_icu}}'"
        :hospital_emergency="'{{$hospital_emergency}}'"
        :hospital_ventilator="'{{$hospital_ventilator}}'"
        :hospital_24_service="'{{$hospital_24_service}}'"
        :ambulance="'{{$ambulance}}'"
        :waiting_lounge="'{{$waiting_lounge}}'"
        :laboratory="'{{$laboratory}}'"
        :pharmacy="'{{$pharmacy}}'"
        :blood_bank="'{{$blood_bank}}'"
        :atm="'{{$atm}}'"
        :car_parking="'{{$car_parking}}'"
        :cafeteria="'{{$cafeteria}}'"

>
</hospital-services>

<div class="dc-experienceaccordion">
    <div class="dc-updatall la-btn-setting">
        {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
    </div>
</div>
{!! Form::close() !!}

@push('backend_scripts')
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
@endpush
