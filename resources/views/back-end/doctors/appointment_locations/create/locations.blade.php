<div class="dc-haslayout">
    <div class="dc-dashboardbox">
        <div class="dc-dashboardboxtitle">
            <h2>{{ trans('lang.appointment_locations') }}</h2>
        </div>
        <div class="dc-dashboardboxcontent dc-clinicloc-holder">
            <div class="dc-tabscontenttitle">
                <h3>{{ trans('lang.avaiable_locations') }}</h3>
            </div>
            <div class="dc-content-holder">
                @if (!empty($doctor_info) && $doctor_info->count() > 0)
                    @foreach ($doctor_info as $key => $info)
                        @php
                            $team = \App\Team::findOrFail($info->id);
                            if($info->user_id != 'online'){
                                $hospital_obj = App\User::findOrFail($team->hospital->id);
                            }


                            $slots = json_decode($team->slots, true);
                            $appointment_days = !empty($slots['days']) ? $slots['days'] : array();
                        @endphp
                        <div class="dc-clinics">
                            @if($team->hospital->id !== null)
                            <div>
                                <figure class="dc-clinicsimg">
                                    <img src="{{ asset('uploads/users/'.$team->hospital->id.'/'.$team->hospital->profile->avatar) }}" alt="{{ trans('lang.img_desc') }}"style="height: 88px; width: 92px;">
                                </figure>
                            </div>
                            @else
                            <div>
                                <figure class="dc-clinicsimg">
                                    <img src="{{ asset('uploads/users/default/online.jpg') }}" alt="{{ trans('lang.img_desc') }}" style="width: 100px;height: 100px;">
                                </figure>
                            </div>
                             @endif
                            
                            <div class="dc-clinics-content">
                                <div class="dc-clinics-title">
                                    <a href="javascript:void(0);">{{ $team->status }}</a>
                                    <h4>{{ Helper::getUserName($team->hospital->id) }} {{ Helper::verifyUser(intVal(clean($team->hospital->id))) }}</h4>
                                    @if($info->user_id == 'online')
                                        <h4> Online Booking Consultation <i data-tipso="<em>Verified User</em>" class="far fa-check-circle dc-tipso"></i></h4>
                                    @endif
                                        <span>
                                        @if (!empty($appointment_days))
                                            <span>
                                                @foreach ($appointment_days as $key => $day)
                                                       <em class="dc-available">{{ ucfirst($day) }},</em>

                                                @endforeach
                                            </span>
                                        @endif
                                    </span>
                                </div>
                                <div class="dc-btnarea">
                                    <a href="{{ route('editLocation', ['id' => intVal(clean($team->id))]) }}" class="dc-btn dc-btn-sm">
                                        {{ trans('lang.view_details') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if ( method_exists($doctor_info,'links') )
                        <div class="dc-categoriescontentholder">
                            {{ $doctor_info->links('pagination.custom') }}
                        </div>
                    @endif
                @else
                    @include('errors.no-record')
                @endif
            </div>
        </div>
    </div>
</div>
