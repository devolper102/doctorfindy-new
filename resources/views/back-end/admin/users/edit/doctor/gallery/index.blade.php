{!! Form::open(['url' => '', 'class' =>'dc-formtheme', 'id' =>'gallery-update-upload', '@submit.prevent'=>'uploadUpdateGallery("'.$user_role.'")'])!!}
    @include('back-end.admin.users.edit.doctor.gallery.images')
    @include('back-end.admin.users.edit.doctor.gallery.videos')
    <div class="dc-experienceaccordion">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="role" value="<?php echo $user_role; ?>">
        <div class="dc-updatall la-updateall-holder">
            {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
        </div>
    </div>
{!! Form::close(); !!}