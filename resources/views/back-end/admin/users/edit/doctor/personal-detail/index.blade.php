 {!! Form::open(['url' => '', 'class' =>'dc-formtheme', 'id' =>'edit-user-details', '@submit.prevent'=>'updateUserProfile("'.$id.'", "'.trans("lang.update_role_war").'", "'.trans("lang.update_role_note").'")'])!!}
	@include('back-end.admin.users.edit.detail')
    {{-- @include('back-end.admin.users.edit.doctor.personal-detail.fees-range') --}}
    @if($user_role !== 'patient')
    @include('back-end.admin.users.edit.doctor.personal-detail.percentage')
    @endif
    @if($user_role !== 'laboratory' && $user_role !== 'patient')
    @include('back-end.doctors.profile-settings.personal-detail.diseases')
    @endif
    @include('back-end.admin.users.edit.doctor.personal-detail.actions')
    @if($user_role !== 'patient' && $user_role !== 'hospital' && $user_role !== 'laboratory')
    @include('back-end.admin.users.edit.doctor.personal-detail.leave')
    @endif
    @if($user_role =='doctor')
    @include('back-end.admin.users.edit.doctor.personal-detail.spoken')
    @endif
    @if($user_role =='laboratory' || $user_role =='hospital')
    @include('back-end.admin.users.edit.doctor.personal-detail.hospital_time')
    @include('back-end.admin.users.edit.doctor.personal-detail.available_days')
    @endif
    @if($user_role !== 'patient' && $user_role !== 'hospital' && $user_role !== 'laboratory')
    @include('back-end.admin.users.edit.doctor.personal-detail.media')
    @endif
    @if($user_role === 'laboratory')
    @include('back-end.admin.users.edit.doctor.personal-detail.lab_media')
    @endif
    @if($user_role !== 'patient' && $user_role !== 'hospital' && $user_role !== 'laboratory')
    @include('back-end.admin.users.edit.doctor.personal-detail.location')
    @include('back-end.admin.users.edit.doctor.personal-detail.membership')
    @endif
                            <input type="hidden" name="role" value="<?php echo $user_role; ?>">	
                            <div class="dc-experienceaccordion">
                                <div class="dc-updatall la-updateall-holder">
                                    {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
                                </div>
                            </div>
                        {!! Form::close(); !!}