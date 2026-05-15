{!! Form::open(['url' => '', 'class' => 'dc-formtheme dc-addexperience dc-tabsinfo', 'id' => 'experience-update-form', '@submit.prevent' => 'submitUpdateExperiences']) !!}
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="role" value="<?php echo $user_role; ?>">
    @include('back-end.admin.users.edit.doctor.experience-education.experience')
    <div class="dc-experienceaccordion">
        <div class="dc-updatall la-btn-setting">
            {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
        </div>
    </div>
{!! Form::close() !!}
{!! Form::open(['class' => 'dc-formtheme dc-addeducation', 'id' => 'education-update-form', '@submit.prevent' => 'submitUpdateEducations']) !!}
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="role" value="<?php echo $user_role; ?>">
    @include('back-end.admin.users.edit.doctor.experience-education.education')
    <div class="dc-experienceaccordion">
        <div class="dc-updatall la-btn-setting">
            {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
        </div>
    </div>
{!! Form::close() !!}
