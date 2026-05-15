{{--registeration model for book now--}}
<b-modal ref="registeration_modal" size="lg" class="dc-feedbackpopup" id="dc-feedbackpopup" hide-footer title="{{ trans('lang.reg_book_appointment') }}" no-close-on-backdrop @hidden="onClose">
    <section id="sec1" class="sec1">
        <div class="dc-visitingdoctor form-row dc-popup-row" v-cloak v-if="step === 1">
            {!! Form::open(['class' => 'dc-formtheme', 'id' => 'submit_reg_appointment_form', '@submit.prevent'=>'regBookingAppointment']) !!}
            <div class="form-group col-6">
                <input type="text" class="form-control" name="first_name" placeholder="Full Name">
            </div>
            <div class="form-group col-6">
                <div class="country-code">+92</div>
                <input type="text" class="form-control"  name="phone_number" placeholder="3XX XXXX XXX" data-format="3dd - dddd ddd" style="width:80%">
                <small class="text-danger" id="error-phone"></small>
            </div>
            <div class="form-group modal-footer dc-modal-footer">
                {!! Form::submit(trans('lang.continue'), ['class' => 'btn dc-btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </section>
</b-modal>
{{--  Appointment Modal  --}}
<b-modal @hidden="onClose" ref="appointment_modal" size="lg" class="dc-feedbackpopup" id="dc-feedbackpopup" hide-footer title="{{ trans('lang.book_appointment') }}" no-close-on-backdrop>
    <div class="dc-appointmentpopup">
        <div class="dc-modalcontent modal-content">
            <section id="sec1" class="sec1">
                {!! Form::open(['class' => 'dc-formtheme', 'id' => 'submit_appointment_form', '@submit.prevent'=>'checkAppointmentStep1()']) !!}
                <div class="dc-visitingdoctor" v-if="step === 1" v-cloak>
                    <book-appointment
                            :hospitals="'{{ json_encode($doctor_hospitals) }}'"
                            :user_id="'{{ $user->id }}'"
                            :doctor_data="{{ $user }}"
                            :currency="'{{ !empty($symbol['symbol']) ? $symbol['symbol'] : 'Rs' }}'"
                            :type="'visit'"
                    >
                    </book-appointment>
                    <div class="modal-footer dc-modal-footer">
                        {!! Form::submit(trans('lang.book_now'), ['class' => 'btn dc-btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}

                <div class="dc-visitingdoctor form-row dc-popup-row " v-cloak v-if="step === 2">
                    {!! Form::open(['class' => 'dc-formtheme', 'id' => 'submit_reg_appointment_form', '@submit.prevent'=>'checkAppointmentStep1()']) !!}
                    <div class="form-group dc-visitingdoctor dc-popup-doc dc-popup-step3">
                        <strong>Enter mobile number for verification code</strong>
                    </div>
                    <div class="form-group col-8">
                        <div class="country-code">+92</div>
                        <input type="text" class="form-control"  name="phone_number" placeholder="3XX XXXX XXX" data-format="3dd - dddd ddd" style="width:80%">
                        <small class="text-danger" id="error-phone"></small>
                    </div>
                    <div class="form-group modal-footer dc-modal-footer">
                        {!! Form::submit(trans('lang.continue'), ['class' => 'btn dc-btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>

                <div class="dc-visitingdoctor dc-popup-doc dc-popup-step3" v-if="step === 3" v-cloak>

                    <h5>{{ trans('lang.enter_auth_code') }}</h5>
                    <p>{{ trans('lang.verify_code_sent') }}<a href="javascript:void(0)"> @if(Auth::user()){{ Auth::user()->email }}@endif</a></p>
                    <input type="text" placeholder="Authentication Code Here" v-model="appointment.code">
                    <div class="modal-footer dc-modal-footer">
                        <a href="javascript:void(0);" v-on:click="checkAppointmentStep3('{{$user->id}}')" class="btn dc-btn btn-primary">{{ trans('lang.continue') }}</a>
                    </div>

                </div>
                <div class="dc-visitingdoctor dc-popup-doc dc-popup-step4" v-if="step === 4" v-cloak>

                    <div class="dc-modal-body4-title">
                        <h6>{{ trans('lang.congrats') }}</h6>
                        @if (!empty($appointment_confirm))
                            <h4>{{$appointment_confirm}}</h4>
                        @endif
                    </div>
                    <div class="dc-modal-body4-description">
                        <p>{{ $appointment_detail_text }}</p>
                    </div>
                    <div class="modal-footer dc-modal-footer">
                        <a href="javascript:void(0);" v-on:click="finalStep({{false}})" class="btn dc-btn btn-primary">{{trans('lang.offline_scheduled_btn')}}</a>
                        <a href="javascript:void(0);" v-on:click="finalStep({{true}})" class="btn dc-btn btn-primary"> {{trans('lang.checkout')}} </a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</b-modal>


{{--registeration model for book now--}}
<b-modal @hidden="onClose" ref="online_cons_reg_modal" size="lg" class="dc-feedbackpopup" id="dc-feedbackpopup" hide-footer title="{{ trans('lang.reg_book_cons') }}" no-close-on-backdrop>
    <section id="sec1" class="sec1">
        <div class="dc-visitingdoctor form-row dc-popup-row" v-cloak v-if="step === 1">
            {!! Form::open(['class' => 'dc-formtheme', 'id' => 'submit_reg_appointment_form', '@submit.prevent'=>'regBookingOnlineConsultation']) !!}
            <div class="form-group col-6">
                <input type="text" class="form-control" name="first_name" placeholder="Full Name">
            </div>
            <div class="form-group col-6">
                <div class="country-code">+92</div>
                <input type="text" class="form-control"  name="phone_number" placeholder="3XX XXXX XXX" data-format="3dd - dddd ddd" style="width:80%">
                <small class="text-danger" id="error-phone"></small>
            </div>
            <div class="form-group modal-footer dc-modal-footer">
                {!! Form::submit(trans('lang.continue'), ['class' => 'btn dc-btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </section>
</b-modal>
{{--  Appointment Modal  --}}
<b-modal @hidden="onClose" ref="online_consultation_modal" size="lg" class="dc-feedbackpopup" id="dc-feedbackpopup" hide-footer title="{{ trans('lang.book_online_cons_appointment') }}" no-close-on-backdrop>
    <div class="dc-appointmentpopup">
        <div class="dc-modalcontent modal-content">
            <section id="sec1" class="sec1">
                {!! Form::open(['class' => 'dc-formtheme', 'id' => 'submit_appointment_form', '@submit.prevent'=>'checkAppointmentStep1()']) !!}
                <div class="dc-visitingdoctor" v-if="step === 1" v-cloak>
                    <book-appointment
                            :hospitals="'{{ json_encode($doctor_hospitals) }}'"
                            :user_id="'{{ $user->id }}'"
                            :currency="'{{ !empty($symbol['symbol']) ? $symbol['symbol'] : '$' }}'"
                            :type="'online'"
                    >
                    </book-appointment>
                    <div class="modal-footer dc-modal-footer">
                        {!! Form::submit(trans('lang.book_now'), ['class' => 'btn dc-btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
                <div class="dc-visitingdoctor dc-popup-doc dc-popup-step3" v-if="step === 2" v-cloak>
                    <h5>{{ trans('lang.enter_auth_code') }}</h5>
                    <p>{{ trans('lang.verify_code_sent') }}<a href="javascript:void(0)"> @if(Auth::user()){{ Auth::user()->email }}@endif</a></p>
                    <input type="text" placeholder="Authentication Code Here" v-model="appointment.code">
                    <div class="modal-footer dc-modal-footer">
                        <a href="javascript:void(0);" v-on:click="checkAppointmentStep3('{{$user->id}}')" class="btn dc-btn btn-primary">{{ trans('lang.continue') }}</a>
                    </div>
                </div>
                <div class="dc-visitingdoctor dc-popup-doc dc-popup-step4" v-if="step === 3" v-cloak>
                    <div class="dc-modal-body4-title">
                        <h6>{{ trans('lang.congrats') }}</h6>
                        @if (!empty($appointment_confirm))
                            <h4>{{$appointment_confirm}}</h4>
                        @endif
                    </div>
                    <div class="dc-modal-body4-description">
                        <p>{{ $appointment_detail_text }}</p>
                    </div>
                    <div class="modal-footer dc-modal-footer">
                        <a href="javascript:void(0);" v-on:click="finalStep({{$online_appointment}})" class="btn dc-btn btn-primary">{{ $appointment_btn_text }}</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</b-modal>