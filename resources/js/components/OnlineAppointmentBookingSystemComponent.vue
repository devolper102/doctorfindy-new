<template>
    <div>
        <div>
            <form action="" class="appointment_form" id="call_appointment_form" @submit.prevent="submitAppointment">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="book-consultation-heading  text-center mt-4 mb-5">
                                <h4>Book Online Consultation</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2 pl-0">
                            <div class="form-group input-patient-form">
                                <label class="mb-0" for="patient_phone">{{trans('lang.patient_phone')}}</label>
                                <input type="number" class="form-control" name="phone_number" v-model="phone_number" id="patient_phone" :placeholder="trans('lang.patient_phone')">
                                <label class="error" v-if="phone_number_error">{{trans('lang.patient_phone_req')}}</label>
                            </div>
                        </div>
                        <div class="col-2 pl-0">
                            <div class="form-group input-patient-form">
                                <label class="mb-0" for="patient_first_name">{{trans('lang.patient_f_name')}}</label>
                                <input type="text" class="form-control" name="first_name" v-model="first_name" id="patient_first_name" :placeholder="trans('lang.patient_f_name')">
                                <label class="error" v-if="first_name_error">{{trans('lang.patient_name_req')}}</label>
                            </div>
                        </div>
                        <div class="col-2 pl-0">
                            <div class="form-group input-patient-form">
                                <label class="mb-0" for="patient_last_name">{{trans('lang.patient_l_name')}}</label>
                                <input type="text" class="form-control" name="last_name" v-model="last_name" id="patient_last_name" :placeholder="trans('lang.patient_l_name')">
                                <label class="error" v-if="last_name_error">{{trans('lang.patient_name_req')}}</label>
                            </div>
                        </div>
                        <div class="col-2 pl-0">
                            <div class="form-group input-patient-form">
                                <label class="mb-0" for="patient_email">{{trans('lang.patient_email')}}</label>
                                <input type="email" class="form-control" name="email" v-model="email" id="patient_email" :placeholder="trans('lang.patient_email')">
                                <label class="error" v-if="email_error"> {{trans('lang.patient_email_req')}} </label>
                            </div>
                        </div>
                        <div class="col-2 pl-0">
                            <div class="form-group input-patient-form">
                                <label class="mb-0" for="patient_age">{{trans('lang.patient_gender')}}</label>
                                <input type="number" class="form-control" name="patient_age" v-model="patient_age" id="patient_age" aria-describedby="emailHelp" :placeholder="trans('lang.patient_age')">
                                <label class="error" v-if="patient_age_error">{{trans('lang.patient_age_req')}}</label>
                            </div>
                        </div>
                        <div class="col-2 pl-0">
                            <div class="dropdown patient-gender-dropdown">
                                <label class="mb-0" for="patient_gender">{{trans('lang.patient_gender')}}</label>
                                <select class="w-100"
                                        id="patient_gender" name="gender" v-model="gender">
                                    <option class="dropdown-item" disabled="disabled">Choose Gender</option>
                                    <option class="dropdown-item" value="male">Male</option>
                                    <option class="dropdown-item" value="female">Female</option>
                                </select>
                                <label class="error" v-if="gender_error"> {{trans('lang.patient_gender_req')}} </label>
                            </div>
                        </div>
                        <div class="col-2 pl-0">
                            <div class="dropdown patient-gender-dropdown">
                                <label class="mb-0"> {{trans('lang.patient_loc')}} </label>
                                <autocomplete
                                        :source="locations"
                                        :placeholder="trans('lang.patient_loc')"
                                        :results-display="formattedLocation"
                                        @selected="onLocationSelect"
                                        input-class="form-control"
                                >
                                </autocomplete>
                                <label class="error" v-if="patient_location_error"> {{trans('lang.patient_location_req')}} </label>
                            </div>
                        </div>
                        <div class="col-2 pl-0">
                            <div class="dropdown patient-gender-dropdown">
                                <label class="mb-0"> {{trans('lang.patient_area')}} </label>
                                <autocomplete
                                        :source="childLocations"
                                        :placeholder=" trans('lang.patient_area') "
                                        v-model="patient_area"
                                        :results-display="formattedChildLocation"
                                        @selected="onChildLocationSelect"
                                        input-class="form-control"
                                >
                                </autocomplete>
                                <label class="error" v-if="patient_area_error"> {{trans('lang.patient_area_req')}} </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2 pl-0">
                            <div class="dropdown patient-gender-dropdown">
                                <label class="mb-0">
                            <span class="text-primary">
                                1.
                            </span>
                                    {{trans('lang.choose_spec')}}
                                </label>
                                <autocomplete
                                        :source="specialities"
                                        :placeholder="trans('lang.choose_spec')"
                                        :results-display="formattedSpecialities"
                                        @selected="onSpecialtiesSelect"
                                >
                                </autocomplete>
                                <label class="error" v-if="selectedSpecialties_error"> {{trans('lang.patient_spec_req')}} </label>
                            </div>
                        </div>

                        <div class="col-2 pl-0">
                            <div class="form-group input-patient-form">
                                <label class="mb-0" for="choose_doctor">
                            <span class="text-primary">
                                2.
                            </span>
                                    {{trans('lang.choose_doc')}}
                                </label>
                                <span id="choose_doctor">
                                    <autocomplete
                                        :source="allDoctors"
                                        :placeholder="trans('lang.choose_doc')"
                                        :results-display="formattedDisplay"
                                        @selected="onDoctorSelect"
                                    >
                                    </autocomplete>
                                    <label class="error" v-if="selectedDoctor_error"> {{trans('lang.patient_doc_req')}} </label>
                            </span>
                            </div>
                        </div>

                        <div class="col-2 pl-0">
                            <div class="form-group input-patient-form">
                                <label class="mb-0" for="consultation_fee">
                            <span class="text-primary">
                                5.
                            </span>
                                    {{trans('lang.consultation_fee')}}
                                </label>
                                <input type="text" class="form-control" id="consultation_fee" :placeholder="trans('lang.consultation_fee')" name="fee" v-model="fee">
                                <label class="error" v-if="fee_error"> </label>
                            </div>
                        </div>

                        <div class="col-3 pl-0">
                            <div class="dropdown patient-gender-dropdown">
                                <label class="mb-0">
                                    <span class="text-primary">
                                        6.
                                    </span>
                                    {{trans('lang.choose_con_status')}}
                                </label>
                                <select class="text-left w-100" name="appointment_status" id="appointment_status">
                                    <option value="">Choose Status</option>
                                    <option value="approved">Approved</option>
                                    <option value="pending">Pending</option>
                                    <option value="declined">Declined</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-2 pl-0">
                            <div class="form-check mt-4">
                                <label class="form-check-label small">
                                    <input type="checkbox" name="type" class="form-check-input" value="">{{trans('lang.is_free_camp')}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div v-if="show_slots">
                        <appointment-slots
                                :hospital_id="'online'"
                                :doctor_id="selectedDoctor.id"
                                :hospitals="JSON.stringify(selectedDoctorHospitals)"
                                :currency="'PKR'"
                                :type="'online'"
                        >
                        </appointment-slots>
                    </div>
                    <div class="row">
                        <div class="col-12 pl-0 mt-4">
                            <div class="form-group patient-problem">
                                <label class="mb-0" for="comments"> {{trans('lang.patient_prob')}} </label>
                                <textarea id="comments" name="comments" class="form-control" rows="4" v-model="comments" :placeholder="trans('lang.problem_facing')"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 pl-0 mt-3">
                            <div class="form-group patient-problem">
                                <label class="mb-0" for="notes">Notes</label>
                                <textarea id="notes" name="notes" v-model="notes" class="form-control" rows="4" placeholder="Anything to be reminded later?"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">

                    <div class="heading-call-type">
                        <label class="mb-0 mt-3">{{trans('lang.instruction_by_doctor')}}</label>
                    </div>
                    <div class="doctor-instructions p-2">

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mt-4 doctor-oppointment">
                                    <label class="mb-0" for="appointment_instructions"> {{trans('lang.doc_appt_instructions')}} </label>
                                    <textarea id="appointment_instructions" name="appointment_instructions" class="small form-control" rows="5" :placeholder="trans('lang.doc_appt_instructions')"></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mt-4 doctor-oppointment">
                                    <label class="mb-0" for="online_con_instruction"> {{trans('lang.doc_online_consul_instructions')}}
                                    </label>
                                    <textarea id="online_con_instruction" name="online_con_instruction" class="form-control" rows="5" :placeholder="trans('lang.doc_online_consul_instructions')"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="heading-call-type">
                                <label class="mb-0 mt-3"> {{trans('lang.choose_call_type')}} </label>
                            </div>
                            <div class="doctor-instructions p-2">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-check">
                                            <label class="form-check-label small">
                                                <input name="video_call" id="video_call" type="checkbox" class="form-check-input" value="1">
                                                {{trans('lang.video_call_doctor')}}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check">
                                            <label class="form-check-label small">
                                                <input name="audio_call" id="audio_call" type="checkbox" class="form-check-input" value="1">
                                                {{trans('lang.phone_call_doctor')}}
                                            </label>
                                        </div>
                                    </div>
                                    <label class="error" v-if="call_error"> {{trans('lang.call_type_req')}} </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="heading-call-type">
                        <label class="mb-0 mt-3"> {{trans('lang.choose_payment_method')}} </label>
                    </div>
                    <div class="doctor-instructions p-2">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-check mt-2 ml-2">
                                    <label class="form-check-label small">
                                        <input type="checkbox" class="form-check-input mr-1" value="">Askari Bank
                                    </label>
                                </div>
                                <div class="form-check mt-2 ml-2">
                                    <label class="form-check-label small">
                                        <input type="checkbox" class="form-check-input mr-1" value="">Easy Paisa (Asma)
                                    </label>
                                </div>
                                <div class="form-check mt-2 ml-2">
                                    <label class="form-check-label small">
                                        <input type="checkbox" class="form-check-input mr-1" value="">Easy Paisa (Ghulam Ali)
                                    </label>
                                </div>
                                <div class="form-check mt-2 ml-2">
                                    <label class="form-check-label small">
                                        <input type="checkbox" class="form-check-input mr-1" value="">Jazz Cash
                                        (Asma)
                                    </label>
                                </div>
                                <div class="form-check mt-2 ml-2">
                                    <label class="form-check-label small">
                                        <input type="checkbox" class="form-check-input mr-1" value="">Meezan Bank
                                    </label>
                                </div>

                            </div>
                            <div class="col-3">
                                <div class="form-check mt-2 ml-2">
                                    <label class="form-check-label small">
                                        <input type="checkbox" class="form-check-input mr-1" value="">Aeasy Paisa
                                        (Ali)
                                    </label>
                                </div>
                                <div class="form-check mt-2 ml-2">
                                    <label class="form-check-label small">
                                        <input type="checkbox" class="form-check-input mr-1" value="">Easy Paisa
                                        (Ayesha)
                                    </label>
                                </div>
                                <div class="form-check mt-2 ml-2">
                                    <label class="form-check-label small">
                                        <input type="checkbox" class="form-check-input mr-1" value="">Easy Paisa
                                        (Wazzah)
                                    </label>
                                </div>
                                <div class="form-check mt-2 ml-2">
                                    <label class="form-check-label small">
                                        <input type="checkbox" class="form-check-input mr-1" value="">Jazz Cash
                                        (Fahad)
                                    </label>
                                </div>
                                <div class="form-check mt-2 ml-2">
                                    <label class="form-check-label small">
                                        <input type="checkbox" class="form-check-input mr-1" value="">UBL
                                    </label>
                                </div>

                            </div>
                            <div class="col-3">
                                <div class="form-check mt-2 ml-2">
                                    <label class="form-check-label small">
                                        <input type="checkbox" class="form-check-input mr-1" value="">Aeasy Paisa
                                        (Amanullah)
                                    </label>
                                </div>
                                <div class="form-check mt-2 ml-2">
                                    <label class="form-check-label small">
                                        <input type="checkbox" class="form-check-input mr-1" value="">Easy Paisa
                                        (Ehsan)
                                    </label>
                                </div>
                                <div class="form-check mt-2 ml-2">
                                    <label class="form-check-label small">
                                        <input type="checkbox" class="form-check-input mr-1" value="">In Cash
                                    </label>
                                </div>
                                <div class="form-check mt-2 ml-2">
                                    <label class="form-check-label small">
                                        <input type="checkbox" class="form-check-input mr-1" value="">Jazz Cash
                                        (Ghulam Ali)
                                    </label>
                                </div>
                                <div class="form-check mt-2 ml-2">
                                    <label class="form-check-label small">
                                        <input type="checkbox" class="form-check-input mr-1" value="">Western Union
                                    </label>
                                </div>

                            </div>
                            <div class="col-3">
                                <div class="form-check mt-2 ml-2">
                                    <label class="form-check-label small">
                                        <input type="checkbox" class="form-check-input mr-1" value="">Aeasy Paisa
                                        (Naina)
                                    </label>
                                </div>
                                <div class="form-check mt-2 ml-2">
                                    <label class="form-check-label small">
                                        <input type="checkbox" class="form-check-input mr-1" value="">Easy Paisa
                                        (Fahad)
                                    </label>
                                </div>
                                <div class="form-check mt-2 ml-2">
                                    <label class="form-check-label small">
                                        <input type="checkbox" class="form-check-input mr-1" value="">Jazz Cash
                                        (Ali)
                                    </label>
                                </div>
                                <div class="form-check mt-2 ml-2">
                                    <label class="form-check-label small">
                                        <input type="checkbox" class="form-check-input mr-1" value="">Jazz Cash
                                        (Munam)
                                    </label>
                                </div>
                                <div class="form-check mt-2 ml-2">
                                    <label class="form-check-label small">
                                        <input type="checkbox" class="form-check-input mr-1" value="">HBL
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-check mt-5">
                                <label class="form-check-label small font-weight-bold">
                                    <input name="payment_recieved" type="checkbox" class="form-check-input mr-1" value="1"> {{trans('lang.payment_recieved_check')}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">

                            <div class="heading-call-type payment-evidence">
                                <label class="mb-0 mt-1" for="myFile"> {{trans('lang.payment_evidence')}} </label>
                            </div>
                            <div class="doctor-instructions p-2 w-100">
                                <input type="file" id="myFile" name="payment_evidence">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-check mt-4">
                                <label class="form-check-label small">
                                    <input name="send_message_to_patient" value="1" id="wt-check-3" type="checkbox">
                                    {{trans('lang.msg_to_patient')}}
                                </label>
                            </div>
                            <div class="form-check mt-4">
                                <label class="form-check-label small">
                                    <input name="send_message_to_doctor" value="1" id="wt-check-4" type="checkbox">
                                    {{trans('lang.msg_to_doc')}}
                                </label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-check mt-4">
                                <label class="form-check-label small">
                                    <input name="send_email_to_patient" type="checkbox" class="form-check-input mr-1" value="1">
                                    {{trans('lang.email_to_patient')}}
                                </label>
                            </div>
                            <div class="form-check mt-4">
                                <label class="form-check-label small">
                                    <input name="send_email_to_doctor" type="checkbox" class="form-check-input mr-1" value="1">
                                    {{trans('lang.email_to_doc')}}
                                </label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-check mt-4">
                                <label class="form-check-label small">
                                    <input name="send_notification_to_patient" type="checkbox" class="form-check-input mr-1" value="1">
                                    {{trans('lang.notification_to_patient')}}
                                </label>
                            </div>
                            <div class="form-check mt-4">
                                <label class="form-check-label small">
                                    <input name="send_notification_to_doctor" type="checkbox" class="form-check-input mr-1" value="1">
                                    {{trans('lang.notification_to_doc')}}
                                </label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-check mt-4">
                                <label class="form-check-label small">
                                    <input name="send_payment_msg_to_patient" type="checkbox" class="form-check-input mr-1" value="1">
                                    {{trans('lang.payment_msg_to_patient')}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="consultation-btn text-center mt-2 pb-2">
                                <button type="submit" class="btn btn-primary p-2"> {{trans('lang.book_con')}} </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</template>

<script>
  import Autocomplete from 'vuejs-auto-complete'

  export default {
    name: 'OnlineAppointmentBookingSystemComponent',
    components: {Autocomplete,},
    props:['doctors', 'hospitals', 'specialities', 'diseases', 'locations'],
    data: function () {
      return {
        currentDate: '',
        selectedSpecialties: '',
        selectedDoctor: '',
        selectedDoctor_error: false,
        childLocations: [],
        allDoctors: [],
        showChildLocation: false,
        selectedLocation: '',
        selectedLocation_error: false,
        spec: '',
        show_slots: false,

        appointment: '',
        type: '',
        first_name: '',
        first_name_error: false,
        last_name: '',
        last_name_error: false,
        phone_number: '',
        phone_number_error: false,
        email: '',
        email_error: false,
        patient_location: '',
        patient_location_error: false,
        patient_area: '',
        patient_area_error: '',
        patient_age: '',
        patient_age_error: false,
        gender: '',
        gender_error: false,
        appointment_status_error: false,
        comments: '',
        comments_error: false,
        notes: '',
        notes_error: false,
        call_error: false,
        selectedSpecialties_error: false,
        fee: '',
        fee_error: false,
        selectedDoctorHospitals:[],

        notificationSystem: {
          options: {
            theme: 'dark',
            success: {
              position: 'topRight',
              timeout: 4000
            },
            error: {
              position: 'topRight',
              timeout: 7000
            },
            completed: {
              position: 'center',
              timeout: 1000,
              progressBar: false,
            },
            info: {
              overlay: true,
              zindex: 999,
              position: 'center',
              timeout: 3000,
              class: 'iziToast-info',
              onClosing: function (instance, toast, closedBy) {
                vuHome.showCompleted(vuHome.success_message);
              }
            }
          }
        },
      }
    },
    mounted () {},
    created () {
      this.currentDate = (moment().format('YYYY-MM-DD')).toLowerCase()
      console.log(this.currentDate)
    },
    computed: {

    },
    methods: {
      filteredList () {
        let self = this
        // this.allDoctors = this.doctors
        if (self.spec !== null) {
          this.allDoctors = this.doctors.filter(function (x) {
            let result = false
            x.specialities.forEach(function (s) {
              // console.log( s.id === (self.spec), s.id, (self.spec), result, x.specialities)
              if(s.id === JSON.parse(self.spec)) {
                result = true
              }
            })
            return result
          })
        }
        console.log(this.doctors.length , this.allDoctors.length)
      },
      validate_form () {
        let result = true;

        let form_errors = []
        let self = this
        if (this.phone_number === ''){
          form_errors.push(Vue.prototype.trans('lang.patient_phone_req'));
          form_errors.forEach(element => {
            self.showError(element)
          });
          this.phone_number_error = true
          result = false
        }
        else {
          this.phone_number_error = false
        }
        if (this.first_name === '' || this.last_name === '') {
          form_errors.push(Vue.prototype.trans('lang.patient_name_req'));
          form_errors.forEach(element => {
            self.showError(element)
          });
          this.first_name_error = true
          this.last_name_error = true
          result = false
        }
        else {
          this.first_name_error = false
          this.last_name_error = false
        }

        if (this.email === ''){
          form_errors.push(Vue.prototype.trans('lang.patient_phone_req'));
          form_errors.forEach(element => {
            self.showError(element)
          });
          this.email_error = true
          result = false
        }
        else {
          this.email_error = false
        }
        if (this.patient_age === ''){
          form_errors.push(Vue.prototype.trans('lang.patient_age_req'));
          form_errors.forEach(element => {
            self.showError(element)
          });
          this.patient_age_error  = true
          result = false
        }
        else {
          this.patient_age_error  = false
        }
        if ($('#patient_gender').find(":selected").val() == '' || $('#patient_gender').find(":selected").val() === undefined){
          form_errors.push(Vue.prototype.trans('lang.patient_gender_req'));
          form_errors.forEach(element => {
            self.showError(element)
          });
          this.gender_error = true
          result = false
        }
        else {
          this.gender_error = false
        }
        if (this.patient_location === ''){
          form_errors.push(Vue.prototype.trans('lang.patient_location_req'));
          form_errors.forEach(element => {
            self.showError(element)
          });
          this.patient_age_error = true
          result = false
        }
        else {
          this.patient_age_error = false
        }
        if (this.patient_area === '') {
          form_errors.push(Vue.prototype.trans('lang.patient_area_req'));
          form_errors.forEach(element => {
            self.showError(element)
          });
          this.patient_area_error = true
          result = false
        }
        else {
          this.patient_area_error = false
        }

        if (this.selectedSpecialties === '') {
          this.selectedSpecialties_error = true
          result = false
        }
        else {
          this.selectedSpecialties_error = false
        }
        if (this.selectedDoctor === '') {
          this.selectedDoctor_error = true
          result = false
        }
        else {
          this.selectedDoctor_error = false
        }
        if (this.fee === '') {
          this.fee_error = true
          result = false
        }
        else {
          this.fee_error = false
        }
        if ($('#appointment_status').find(":selected").val() === '' || $('#appointment_status').find(":selected").val() === undefined) {
          this.appointment_status_error = true
          result = false
        }
        else {
          this.appointment_status_error = false
        }
        if (this.comments === '') {
          this.comments_error = true
          result = false
        }
        else {
          this.comments_error = false
        }
        if (this.notes === '') {
          this.notes_error = true
          result = false
        }
        else {
          this.notes_error = false
        }
        if (!document.querySelector('#video_call').checked && !document.querySelector('#audio_call').checked) {
          this.call_error = true
          result = false
        }
        else {
          this.call_error = false
        }


        return result
      },
      submitAppointment () {
        let form_errors = []
        let self = this
        if (!this.validate_form()) {
          return
        }
        let data = document.getElementById('call_appointment_form');
        let formData = new FormData(data)

        let a_date = formData.get('appointment[date]')
        let a_day = formData.get('appointment[day]')
          console.log(a_day, a_date)
        if (a_date === "" || a_day === "") {
          a_date = document.getElementsByName('appointment[date]').value
          a_day = document.getElementsByName('appointment[day]').value
        }
        else {
          form_errors.push(Vue.prototype.trans('lang.choose_slot'));
          form_errors.forEach(element => {
            self.showError(element)
          });
          return false
        }
        formData.append('user_id', self.selectedDoctor.id)
        formData.append('appointment[date]', a_date)
        formData.append('appointment[day]', a_day)
        formData.append('charges', self.fee)

        axios.post(APP_URL + '/callAppointmentBooking', formData)
          .then(function (response) {
            if (response.data.type === 'success') {

            } else if (response.data.type === 'error') {

            }
          })
          .catch(function (error) { })
      },
      formattedSpecialities (group) {
        return group.title
      },
      onSpecialtiesSelect (result) {
        this.selectedSpecialties = result.selectedObject
        this.spec = this.selectedSpecialties.id
        this.filteredList()
      },
      formattedDisplay (result) {
        return result.first_name + ' ' + result.last_name
      },
      onDoctorSelect (group) {
        let self = this
        this.selectedDoctor = group.selectedObject

        this.selectedDoctor.doc_teams.forEach(function (team) {

            if (team.user_id === 'online') {
                let consultation_fee = JSON.parse(team.slots).consultation_fee
                self.fee = consultation_fee
                self.selectedDoctorHospitals.push({
                    'id': team.user_id,
                    'name': 'Online Consultation',
                    'avatar': '',
                    'fees': consultation_fee
                })
            }

        })
        self.show_slots = true
      },
      formattedLocation (result) {
        return result.title
      },
      onLocationSelect (group) {
        this.selectedLocation = group
        this.patient_location = group.value
        console.log(this.selectedLocation)
        this.showChildLocation = true;
        this.childLocations = this.locations.filter(x => x.parent === group.value)
      },
      formattedChildLocation (result) {
        return result.title
      },
      onChildLocationSelect(group) {
        this.selectedChildLocation = group
        this.patient_area = group.value
      },
      showCompleted(message) {
        return this.$toast.success(' ', message, this.notificationSystem.options.completed)
      },
      showInfo(message) {
        return this.$toast.info(' ', message, this.notificationSystem.options.info)
      },
      showMessage(message) {
        return this.$toast.success(' ', message, this.notificationSystem.options.success)
      },
      showError(error) {
        return this.$toast.error(' ', error, this.notificationSystem.options.error)
      }

    },
  }
</script>

<style>

    .error {
        color: #ed0808;
        /*font-size: 9px;*/
    }

</style>