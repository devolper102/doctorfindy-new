{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform', 'id' =>'health-discussion-section-form', '@submit.prevent'=>'submitHealthDiscussion'])!!}
    <div class="dc-securitysettings dc-tabsinfo">
        <div class="dc-tabscontenttitle la-switch-option">
            <h3>{{ trans('Health Discussion Banner Section') }}</h3>
            <div class="float-right">
                <switch_button v-model="show_health_discussion_banner">{{{ trans('lang.show_or_hide_section') }}}</switch_button>
                <input type="hidden" :value="show_health_discussion_banner" name="show_health_discussion_banner">
            </div>
        </div>
        <div class="dc-settingscontent dc-sidepadding">
            <div class="dc-formtheme dc-userform">
                <fieldset>
                    <div class="form-group">
                        {!! Form::text('title', !empty($health_discussion_title) ? e($health_discussion_title) : null, ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.title')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::textarea('description', !empty($health_discussion_description) ? e($health_discussion_description) : null, ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.desc')]) !!}
                    </div>
                </fieldset>
            </div>
        </div>
         
    </div>
    <div class="dc-experienceaccordion">
        <div class="dc-updatall la-btn-setting">
            {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
        </div>
    </div>
{!! Form::close() !!}
