<div class="days_detials w-100">
   <p class="mb-2 w-100 float-left">{{ trans('lang.days_offer_services') }}</p>
   <div class="days_accordians d-inline-block w-100">
      <div class="heading-box-under-collapse slots_accordians">
    
           <div class="days_accordians d-inline-block w-100">
                  <div class="heading-box-under-collapse slots_accordians">

                @foreach ($days as $key => $day)
                    @if (!empty($slots[$key]['slots']))
                        @php
                            $selected_day = Helper::getAppointmentDays($key);
                        @endphp
                       <a class="text_black collapsed w-100 d-inline-block font-weight-bold p-2" data-toggle="collapse" href="#{{$selected_day['name']}}_appointment" role="button" aria-expanded="false" aria-controls="{{$selected_day['name']}}_appointment">{{ html_entity_decode(clean($selected_day['name'])) }}</a>
                       <div role="separator" class="dropdown-divider d-inline-block w-100 custom_divider"></div>
                       <div class="collapse show" id="{{$selected_day['name']}}_appointment">
                           <div class="card card-body collapse-body p-0">
                               <div class="slots_btn d-inline-block">
                                 <div class="btn_group float-right">
                                    <a href="javascript:void(0)" class="mr-1 box_radius text-white green_btn_bg" v-on:click="showAddSlotForm('show_slot_form_{{$key}}')"> Add More</a>
                                     <a href="javascript:void(0)" class="mr-1 box_radius text-white" v-on:click="deleteAllSlot('dc-spaces-wrap-{{$key}}', '{{$key}}', '{{$id}}', 'do u want to delete slot', 'slot deleted', 'successfully')"> Delete All</a>
                                 </div>
                              </div>
                              <div class="appointment_slots">
                                 <ul class="morning text_black d-inline-block text_14 mb-2 p-2">
                                    @php
                                        $starting_time = !empty($slots[$key]['start_time']) ? Carbon\Carbon::parse($slots[$key]['start_time']): '';
                                        $start_time =  !empty($slots[$key]['start_time']) ? $slots[$key]['start_time'] : '';
                                    @endphp
                                    @foreach ($slots[$key]['slots'] as $slot_key => $slot)
                                       @php
                                            $start_slot = explode("-",$slot_key);
                                            $slot_id = $key.'-slot'.'-'.str_replace(array(':', ' '), '', $start_slot[0]);
                                       @endphp
                                     <li class="float-left pl-2 pr-2 mt-3 slot_radius" id="{{$slot_id}}">
                                        <a href="javascript:void(0);" v-on:click="deleteSlot('{{$slot_id}}', '{{$slot_key}}', '{{$key}}', '{{$id}}', 'do u want to delete slot', 'slot deleted', 'successfully')" class="dc-spaces"> <span>{{{$start_slot[0]}}}</span>
                                        <span>{{ trans('lang.spaces') }}:{{{$slot['space']}}}</span><a href="#"><i class="far fa-times-circle"></i></a>
                                    </li>
                                    @endforeach
                                 </ul>
                                 <div class="add_slot p-2" v-if="show_slot_form_{{$key}}">
                                       {!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform dc-form-appointment', 'id' =>'update_slot-form-'.$key, 
                                        '@submit.prevent'=>'updateSlots("'.$key.'","'.$id.'", "update_slot-form-'.$key.'", "location_start_time-")'])!!}
                                    <div class="row"> 
                                        <fieldset>
                                            <start-time
                                                :start_time_id="'location_start_time-{{$key}}'"
                                                :start_time_name="'slots[start_time]'"
                                                :start_time_obj_id="'start_time_obj-{{$key}}'"
                                            ></start-time>
                                            <div class="form-group form-group-half">
                                                <span class="dc-select">
                                                    <select name="slots[duration]" v-model="duration" v-on:change="onChangeTime('start_time_obj-{{$key}}', 'end_time-{{$key}}')">
                                                        <option value="Select Duration" disabled hidden>{{ trans('lang.select_duration') }}</option>
                                                        @foreach ($durations as $duration_key => $value)
                                                            <option value="{{{$duration_key}}}">{{{ $value }}}</option>
                                                        @endforeach
                                                    </select>
                                                </span>
                                            </div>
                                            <div class="form-group form-group-half">
                                                <span class="dc-select">
                                                    <select id="number_of_slots" name="slots[number_of_slots]" class="form-control" v-model="no_of_slot" v-on:change="onChangeTime('start_time_obj-{{$key}}', 'end_time-{{$key}}')">
                                                        @for ($i = 1; $i <= 30; $i++)
                                                            <option value="{{ $i }}">{{ $i }} {{$i > 1 ? 'slots' : 'slot'}}</option>
                                                        @endfor
                                                    </select>
                                                </span>
                                            </div>
                                            <div class="form-group form-group-half">
                                                <span class="dc-select">
                                                    <select name="slots[intervals]" v-model="intervals" v-on:change="onChangeTime('start_time_obj-{{$key}}', 'end_time-{{$key}}')">
                                                        <option value="Select Interval">{{ trans('lang.select_interval') }}</option>
                                                        @foreach ($intervals as $interval_key => $value)
                                                            <option value="{{{$interval_key}}}">{{{ $value }}}</option>
                                                        @endforeach
                                                    </select>
                                                </span>
                                            </div>
                                            <div class="form-group dc-datepicker form-group-half">
                                                <input type="text" value="" id="end_time-{{$key}}" name="slots[end_time]" readonly placeholder="{{ trans('lang.end_time') }}">
                                            </div>
                                        </fieldset>
                                        <fieldset class="dc-spacesholder">
                                            <legend>{{ trans('lang.assign_apointment_spaces') }}</legend>
                                            <div class="form-group form-group-half dc-radio-holder">
                                                @foreach ($spaces as $space_key => $value)
                                                    <span class="dc-radio">
                                                        <input id="dc-spaces{{$space_key}}" type="radio" name="slots[appointment_spaces]" value="{{{$value['value']}}}" checked="" v-model="appointment_space" v-on:change="selectedSpace(appointment_space)">
                                                        <label for="dc-spaces{{$space_key}}">{{{$value['value']}}}</label>
                                                    </span>
                                                @endforeach
                                                <span class="dc-radio">
                                                    <input id="dc-spaces" type="radio" value="other" checked="" v-model="appointment_space" v-on:change="selectedSpace(appointment_space)">
                                                    <label for="dc-spaces">{{ trans('lang.other') }}</label>
                                                </span>
                                            </div>
                                            <div class="form-group form-group-half" v-if="is_show">
                                                <input type="text" id="custom_appt_spaces-{{$key}}" name="slots[appointment_spaces]" class="form-control" placeholder="{{ trans('lang.ph.appointment_spaces') }}">
                                            </div>
                                            {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
                                        </fieldset>
                                    </div>
                                    {!! Form::close() !!}
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     @endif
                     @endforeach
                  </div>
               </div>
