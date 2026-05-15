<div class="dc-yourdetails dc-tabsinfo">
    <div class="dc-tabscontenttitle">
        <h3> {{ trans('lang.user_details') }} </h3>
    </div>
    <div class="dc-formtheme dc-userform">
        <fieldset>
        <!--  @if ($user_role == 'doctor')
            <div class="dc-name-wrapper">
                    <div class="form-group form-group-half gender-input">
                        <span class="dc-select">
                            {!! Form::select('base_name', Helper::getDoctorArray(), $gender_title, array()) !!}
                    </span>
                    </div>
            @endif -->
            <div class="form-group form-group-half">
                {!! Form::text( 'first_name', e($user->first_name), ['class' =>'form-control', 'placeholder' => trans('lang.ph.first_name')] ) !!}
            </div>
            <div class="form-group form-group-half">
                {!! Form::text( 'last_name', e($user->last_name), ['class' =>'form-control', 'placeholder' => trans('lang.ph.last_name')] ) !!}
            </div>
        <!--  @if ($user_role == 'doctor')
            </div>
            @endif -->
            @if($user_role !== 'patient' && $user_role !== 'hospital' && $user_role !== 'laboratory')
            <div class="form-group form-group-half">
                {!! Form::text( 'pmdc_number', e($user->pmdc_number) ?? '', ['class' =>'form-control', 'placeholder' => trans('lang.pmdc_number')] ) !!}
            </div>
            <div class="form-group form-group-half">
                {!! Form::text( 'ncs_number', e($user->ncs_number) ?? '', ['class' =>'form-control', 'placeholder' => trans('lang.ncs_number')] ) !!}
            </div>
            @endif
            <div class="form-group form-group-half">
                {!! Form::email( 'email', e($user->email), ['class' =>'form-control', 'placeholder' => trans('lang.ph.email')] ) !!}
            </div>
            <div class="form-group form-group-half">
                {!! Form::password('password', ['class' => 'form-control','placeholder' => trans('lang.ph.newpass')]) !!}
            </div>
            <div class="form-group form-group-half">
                {!! Form::tel('phone_number',e($user->phone_number), ['class' => 'form-control','placeholder' => trans('lang.ph_num')]) !!}
            </div>
            @if($user_role !== 'patient' && $user_role !== 'hospital' && $user_role !== 'laboratory')
            <div class="form-group">
                {!! Form::tel('assistant_phone_number',e($user->assistant_phone_number), ['class' => 'form-control','placeholder' => trans('Assistant Phone Number')]) !!}
            </div>
            @endif
            @if ($user_role != 'patient')
             <div class="form-group">
                    {!! Form::text( 'address', e($address), ['class' =>'form-control', 'placeholder' => trans('Enter Adress')] ) !!}
                </div>
                <div class="form-group">
                    {!! Form::text( 'subheading', e($sub_heading), ['class' =>'form-control', 'placeholder' => trans('lang.ph.sub_heading_optional')] ) !!}
                </div>
                <div class="form-group">
                    {!! Form::textarea( 'short_desc', e($short_desc), ['class' =>'form-control', 'rows' => 3, 'placeholder' => trans('lang.ph.short_description')] ) !!}
                </div>
                <div class="form-group">
                    {!! Form::text( 'meta_description', e($meta_description), ['class' =>'form-control', 'placeholder' => trans('Meta Description')] ) !!}
                </div>
                <div class="form-group">
                    {!! Form::text( 'meta_title', e($meta_title), ['class' =>'form-control', 'placeholder' => trans('Meta Title')] ) !!}
                </div>
                <div class="form-group">
                    {!! Form::text( 'meta_intro', e($meta_intro), ['class' =>'form-control', 'placeholder' => trans('Meta Intro')] ) !!}
                </div>
                <div class="form-group">
                    {!! Form::text( 'meta_keywords', e($meta_keywords), ['class' =>'form-control', 'placeholder' => trans('Meta Keywords')] ) !!}
                </div>
                   <div class="form-group">
                                    {!! Form::textarea( 'description', e($description), ['id' => 'description','class' =>'form-control', 'placeholder' => trans('lang.ph.desc')] ) !!}
            </div> 
            <!-- <div class="dc-personalskillshold tab-pane active fade show" id="dc-skills">
                        @include('back-end.admin.users.edit.doctor.personal-detail.location')
                    </div> -->
            @endif
        </fieldset>
    </div>
</div>
@if($user_role !== 'patient' && $user_role !== 'hospital' && $user_role !== 'laboratory')
<div class="dc-yourdetails dc-tabsinfo">
    <div class="dc-tabscontenttitle">
        <h3> {{ trans('lang.book_now_video') }} </h3>
    </div>
    <div class="dc-formtheme dc-userform">
        <div class="dc-formtheme dc-userform">
            <fieldset>

                @if ($user_role != 'patient')

                    <div class="form-group video_consultation">
                        <label>

                            <input type="checkbox" name="willing_video" class="willing_video" <?php echo ($willing_video=='on' ? 'checked' : '');?>> Willing For Video Consultancy
                        </label>

                        <label>
                            <input type="checkbox" name="willing_home_visit" class="willing_home_visit" <?php echo ($willing_home_visit=='on' ? 'checked' : '');?>> Willing To See Patients At Home
                        </label>
                    </div>

                @endif
            </fieldset>
        </div>
    </div>
</div>
@endif
<div class="dc-yourdetails dc-tabsinfo">
    @if($user_role !== 'patient' && $user_role !== 'hospital' && $user_role !== 'laboratory')
    <div class="dc-tabscontenttitle">
        <h3> {{ trans('lang.gender') }} </h3>
    </div>
    @endif
    <div class="dc-formtheme dc-userform">
        <div class="dc-formtheme dc-userform">
            <fieldset>
                @if($user_role !== 'hospital' && $user_role !== 'laboratory')
                <div class="form-group la-radio-holder">

                    <label style="display:inline-block"> Male:  {!! Form::radio( 'gender','male',($gender == 'male' ? true : false),['id' => 'male']) !!}</label>
                    <label style="display:inline-block; margin-left: 20px">Female:
                        {!! Form::radio('gender','female',($gender == 'female' ? true : false), ['id' => 'female']) !!}
                    </label>

                </div>
                @endif
                <div class="form-group">
                    @if (!empty($roles))
                        <ul class="dc-startoption">
                            @foreach ($roles as $key => $role)
                                @if (!in_array($role['id'] == 1, $roles))
                                    <li>
                                        <span class="dc-radio">
                                            <input id="dc-company-{{$key}}" type="radio" v-on:change="changeRole('dc-company-{{$key}}', '{{$user_role}}')" name="role" value="{{{ $role['role_type'] }}}" {{$user_role == $role['role_type'] ? 'checked' : ''}}>
                                            <label for="dc-company-{{$key}}">{{{ $role['name'] }}}</label>
                                        </span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        <div class="dc-description dc-update-role">
                            <p>{{ trans('lang.update_role_note') }}</p>
                        </div>
                    @endif
                </div>
            </fieldset>
        </div>
    </div>
</div>

