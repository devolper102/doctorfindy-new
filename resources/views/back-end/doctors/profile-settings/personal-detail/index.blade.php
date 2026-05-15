{!! Form::open(['url' => '', 'class' =>'dc-formtheme', 'id' =>'submit-personal-details', '@submit.prevent'=>'submitPersonalDetails("'.$user_role.'")'])!!}
    @include('back-end.doctors.profile-settings.personal-detail.detail')
    @include('back-end.doctors.profile-settings.personal-detail.fees-range')
    @include('back-end.doctors.profile-settings.personal-detail.diseases')
    @include('back-end.doctors.profile-settings.personal-detail.leave')
    @include('back-end.doctors.profile-settings.personal-detail.spoken')
    @include('back-end.doctors.profile-settings.personal-detail.media')
    @include('back-end.doctors.profile-settings.personal-detail.location')
    @include('back-end.doctors.profile-settings.personal-detail.membership')
    <div class="dc-experienceaccordion">
        <div class="dc-updatall la-updateall-holder">
            {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
        </div>
    </div>
{!! Form::close(); !!}
