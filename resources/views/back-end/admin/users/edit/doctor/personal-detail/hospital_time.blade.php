<div class="dc-working-time dc-tabsinfo">
    <div class="dc-tabscontenttitle">
        <h3>{{ trans('lang.working_time') }} </h3>
    </div>
    <div class="dc-sidepadding la-working-time">
        <div class="dc-formtheme dc-userform">
            <fieldset>
                <div class="form-group la-radio-holder">
                    <span class="dc-radio">
                        {!! Form::radio('working_time', '24_hours', ($working_time == '24_hours' ? true : false), ['id' => 'working_time', '@change' => 'checkOther(check_other)', 'v-model' => 'check_other']) !!}    
                        {!! Form::label('working_time', trans('Working Time 24 Hours'), array()) !!}
                    </span>
                    <span class="dc-radio">
                        {!! Form::radio('working_time', 'other', ($working_time != '24_hours' ? true : false), ['id' => 'others', '@change' => 'checkOther(check_other)', 'v-model' => 'check_other']) !!}    
                        {!! Form::label('others', 'others', array()) !!}
                    </span>
                </div>
                <div class="form-group">
                    <div v-if="show_other_time" v-cloak>
                        {!! Form::text('working_time', ($working_time != '24_hours' ? e($working_time) : null), ['class' => 'form-control', 'placeholder' => trans('lang.add_other_time')]) !!}
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>