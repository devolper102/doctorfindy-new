{!! Form::open(['url' => '', 'class' => 'dc-formtheme dc-services-holder', 'id' => 'manage-update-services-form', '@submit.prevent' => 'submitUpdateServices']) !!}
	<input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="role" value="<?php echo $user_role; ?>">
    <profile-speciality></profile-speciality>
    <div class="dc-experienceaccordion">
        <div class="dc-updatall la-btn-setting">
            {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
        </div>
    </div>
{!! Form::close() !!}

@push('backend_scripts')
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
@endpush
