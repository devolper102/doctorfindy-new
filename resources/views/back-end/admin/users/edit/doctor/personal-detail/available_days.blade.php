<div class="dc-working-days dc-tabsinfo">
    <div class="dc-tabscontenttitle">
        <h3>{{ trans('lang.working_days') }} </h3>
    </div>
    <div class="dc-sidepadding la-working-day">
        <div class="dc-formtheme dc-userform">
            <fieldset>
                <div class="form-group dc-checkbox-holder">
                    @foreach (Helper::getAppointmentDays() as $key => $day)
                        @php
                            $selected_days = in_array($day['title'], $available_days) ? 'checked' : '' ;
                        @endphp
                        <span class="dc-checkbox">
                            <input id="{{ $key }}-day" type="checkbox" name="days[]" value="{{ html_entity_decode(clean($day['title'])) }}" {{$selected_days}}>
                            <label for="{{ $key }}-day"><span>{{ html_entity_decode(clean($day['name'])) }}</span></label> 
                        </span>
                    @endforeach
                    <div class="dc-personalskillshold tab-pane active fade show" id="dc-skills">
                        @include('back-end.admin.users.edit.doctor.personal-detail.location')
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>
