<template>
    <div>
        <div class="row">
            <div class="dc-title page_header">
            <h3>Appointment Booking System</h3>
            <!-- <a href="#" class="dc-btn">Refresh Doctors</a> -->
        </div>
            <form action="" class="appointment_form" id="call_appointment_form" @submit.prevent="submitAppointment">
            <div class="col-md-7 pull-left">
                <div class="form_inner">
                    <div class="form-group la-radio-holder">
                        <label>
                            <input name="filter" id="doctor" type="radio" value="doctor" checked="checked"> Display By Doctor Name
                        </label>
                        <label>
                            <input name="filter" id="speciality" type="radio" value="speciality"> Display By Speciality
                        </label>
                        <label>
                            <input name="filter" id="hospital" type="radio" value="hospital"> Display By Hospital Name
                        </label>
                    </div>
                    <div class="form-group la-radio-holder">
                        <div class="book-speciality-dropdown w-100 d-inline-block">
                        <multiselect
                          v-model="selectedSpeciality"
                          :options="specialities"
                          placeholder="Search By Speciality"
                          label="title"
                          track-by="title"
                          @select="specialitySelected"
                          >
                        </multiselect>
                        </div>
                        <div class="book-speciality-dropdown w-100 d-inline-block 
                        mt-3">
                        <multiselect
                          v-model="selectHospital"
                          :options="hospitals"
                          placeholder="Search By Hospital Name"
                          label="title"
                          track-by="title"
                          @select="hospitalSelected"
                          :custom-label="customLabel"
                          >
                        </multiselect>
                        </div>
                    </div>
                    <!-- <span class="bt-content">
                		<span class="dc-checkbox">
                			<input name="today" value="13" id="wt-check-13" type="checkbox" @click="filteredList">
                			<label for="wt-check-13">Today Available Doctors</label>
                		</span>
                	</span> -->
                </div>
                <div class="search_doctors mt-0">
                    <!-- <autocomplete
                                    :source="allDoctors"
                                    placeholder="Search Doctor"
                                    :results-display="formattedDisplay"
                                    @selected="doctorPopulates"
                            >
                            </autocomplete> -->
                    <label class="form-group">
                        <span class="search_text w-sm-100 w-100">Search Doctors:
                        </span>
                        <span class="search_input w-sm-100 mt-3 w-100 search-doctor-input">
                            <input class="w-100 d-inline-block" type="text" v-model="keyword">
        <ul class="search-doctor-wraper w-100 d-inline-block" v-if="docs.length > 0">
            <li class="w-100 d-inline-block p-2" v-for="doc in docs" :key="doc.id">
                <a class="w-100 d-inline-block" href="#" @click="doctorPopulates(doc)">{{formattedDisplay(doc)}}
                </a>
            </li>
        </ul>
                        </span>
                    </label>
                    <!-- <ul class="disease_tags">
                        <li v-for="spec in specialities" class="mr-1">
                            <input name="spec" type="radio" href="#" @click="filteredList" :id="'speciality'+spec.id" :value="spec.id">
                            <label :for="'speciality'+spec.id">{{spec.title}}</label>

                        </li>
                    </ul> -->

                    <div class="dc-visitingdoctor book-appointment-date" 
                    v-if="showSlots">
                        <book-appointment
                                :doctor_data="selectedDoctor"
                                :user_id="selectedDoctor.id"
                                :hospitals="JSON.stringify(selectedDoctorHospitals)"
                                :currency="'PKR'"
                                :type="'visit'"
                        >
                        </book-appointment>
                        <!--     -->
                    </div>

                    <div class="dc-doc-membership dc-tabsinfo dc-formtheme dc-socials-form la-membership-content">
                        <fieldset class="membership-content">
                            <span class="bt-content">
                        		<span class="dc-checkbox">
                        			<input name="book_extra" value="1" id="wt-check-7" type="checkbox" @click="extraBookingCheck">
                        			<label for="wt-check-7">Book Extra</label>
                        		</span>
                        	</span>
                            <span v-if="extraBooking === true">
                                <label style="display: inline-block; margin-left: 20px;">
                                    <input type="date" name="date" id="request_date" class="start_date">
                                </label> ---To---
                                <label style="display: inline-block; margin-left: 0px;">
                                    <input type="time" name="time" id="request_time" class="end_date">
                                </label>
                            </span>

                        </fieldset>

                        <div class="dc-tabscontenttitle mt-3">
                            <h3> Patient Details: </h3>
                        </div>
                        <div class="input-patient-detail">
                            <div class="patient-personal-details mb-3 d-block w-100">
                                <input type="number" placeholder="Patient Phone" name="phone_number" v-model="phone_number">
                                <input type="text" placeholder="Patient First Name" name="first_name" v-model="first_name">
                                <input type="text" placeholder="Patient Last Name" name="last_name" v-model="last_name">
                            </div>
                            <autocomplete
                                    :source="diseases"
                                    placeholder="Disease"
                                    :results-display="formattedDisease"
                                    @selected="onDiseaseSelect"
                            >
                            </autocomplete>
                            <select class="patient-gender" name="gender" v-model="gender">
                                <option value="" selected>Select Gender</option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                                <option value="3">Old</option>
                                <option value="4">Child</option>
                            </select>
                            <autocomplete
                                :source="locations"
                                v-model="patient_location"
                                placeholder="Locations"
                                :results-display="formattedLocation"
                                @selected="onLocationSelect"
                                class="my-3">
                            </autocomplete>

                            <autocomplete
                                    :source="childLocations"
                                    placeholder="Area"
                                    v-model="patient_area"
                                    :results-display="formattedChildLocation"
                                    @selected="onChildLocationSelect"
                            >
                            </autocomplete>

                        </div>
                        <div class="dc-tabscontenttitle mt-3">
                            <h3> Appointment: </h3>
                        </div>
                        <div class="input-patient-detail">
                            <div class="appointment_options w-sm-100">
                                <select class="patient-gender patient-process" placeholder="Appointment Process"  v-model="appointmentProcess">
                                    <option value="" disabled hidden>Select Appointment Process</option>
                                    <option value="1">In Process</option>
                                    <option value="0">Non Process</option>

                                </select>
                                <select  class="patient-gender patient-process" placeholder="Appointment Status" v-model="appointmentStatus">
                                    <option value="" disabled hidden>Select Appointment Status</option>
                                    <option value="1">Confirmed</option>
                                    <option value="0">Non Confirmed</option>

                                </select>
                            </div>
                            <span class="bt-content">
                        		<span class="dc-checkbox">
                        			<input name="follow_up" value="1" id="wt-check-8" type="checkbox">
                        			<label for="wt-check-8">Mark Follow-Up</label>
                        		</span>
                        	</span>
                            <span class="bt-content">
                        		<span class="dc-checkbox">
                        			<input name="direct_booking" value="1" id="wt-check-9" type="checkbox">
                        			<label for="wt-check-9">Direct Booking</label>
                        		</span>
                        	</span>
                            <span class="bt-content">
                        		<span class="dc-checkbox">
                        			<input name="booked" value="1" id="wt-check-10" type="checkbox">
                        			<label for="wt-check-10">Agent Special</label>
                        		</span>
                        	</span>
                        </div>
                        <div class="patient-request">
                        	<span class="bt-content">
                        		<span class="dc-checkbox">
                        			<input name="mark_doctor_as_red" value="11" id="wt-check-11" type="checkbox">
                        			<label for="wt-check-11">Mark Doctor as Red</label><span class="note_text">( If doctor Doesn't take call,ignore patient or doesn't pay, you can mark him/her as red )</span>
                        		</span>
                        	</span>
                            <!-- <input class="custom-checkbox" type="checkbox" value="Mark Doctor as Red">
                            <b>Mark Doctor as Red</b> -->
                            <p></p>
                        </div>
                        <div class="patient-procedure">
                        	<span class="bt-content">
                        		<span class="dc-checkbox">
                        			<input name="agent_special" value="12" id="wt-check-12" type="checkbox">
                        			<label for="wt-check-12">Is Procedure</label>
                        		</span>
                        	</span>
                        </div>
                        
                        <div class="dc-tabscontenttitle mt-3">
                            <h3> Call Center Notes: </h3>
                        </div>
                        <div class="text-notes-call-center">
                            <textarea name="notes" v-model="notes"></textarea>
                        </div>
                        <div class="dc-tabscontenttitle mt-3">
                            <h3>Appointment Notes:</h3>
                        </div>
                        <div class="text-notes-call-center">
                            <textarea name="comments" v-model="comments"></textarea>
                        </div>
                        <div class="input-patient-detail contact-patient-doctor-assistant">
                        	<span class="bt-content">
                        		<span class="dc-checkbox">
                        			<input name="send_message_to_patienet" value="1" id="wt-check-3" type="checkbox">
                        			<label for="wt-check-3">Send Message To Patient</label>
                        		</span>
                        	</span>
                            <span class="bt-content">
                        		<span class="dc-checkbox">
                        			<input name="send_message_to_doctor" value="1" id="wt-check-4" type="checkbox">
                        			<label for="wt-check-4">Send Message To Doctor</label>
                        		</span>
                        	</span>
                            <span class="bt-content">
                        		<span class="dc-checkbox">
                        			<input name="send_message_to_assistance" value="1" id="wt-check-5" type="checkbox">
                        			<label for="wt-check-5">Send Message To Assistance</label>
                        		</span>
                        	</span>
                            <span class="bt-content">
                        		<span class="dc-checkbox">
                        			<input name="send_voice_message_to_patient" value="1" id="wt-check-6" type="checkbox">
                        			<label for="wt-check-6">Send Voice Message To Patient</label>
                        		</span>
                        	</span>
                        </div>
                        <div class="input-patient-detail-under-button">
                            <button type="submit" class="dc-btn">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 pull-left">
                <!-- <div class="doctor-reviews-button">
                    <p> Doctor Reviews</p>
                </div>
                <div class="doctor-reviews-button-under-border" v-if="selectedDoctorReview !== ''">
                    <span class="row">
                        <span class="col-6">Positive Review</span>
                        <span class="col-6">Negitive Review</span>
                    </span>
                    <span class="row">
                        <span class="col-6">{{selectedDoctorReview}}</span>
                        <span class="col-6">?</span>
                    </span>
                </div> -->
                <div class="doctor-reviews-button">
                    <p>Doctor's Upcoming Appointments</p>
                </div>
                <div class="doctor-reviews-button-under-border">
                    <div class="">
                        <div class="dc-recentapointdate">
                            <table class="table table-responsive" v-if="selectedDoctorAppointments !== []">
                                <tr class="header">
                                    <th> {{ trans('lang.doctor') }} </th>
                                    <th> {{ trans('lang.hospital') }} </th>
                                    <th> {{ trans('lang.date') }} </th>
                                    <th> {{ trans('lang.time') }} </th>
                                    <th> {{ trans('lang.status') }} </th>
                                    <th> {{ trans('lang.extra') }} </th>
                                </tr>
                                <tr v-for="appointment in selectedDoctorAppointments" v-if="appointment.appointment_date >= currentDate">
                                    <td>{{selectedDoctor.first_name}} {{selectedDoctor.last_name}}</td>
                                    <td>{{hospitalName(appointment.hospital_id)}}</td>
                                    <td>{{appointment.appointment_date}}</td>
                                    <td>{{appointment.appointment_time}}</td>
                                    <td>{{appointment.status}}</td>
                                    <td>extra's</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="doctor-reviews-button">
                    <p>Patient's Already Booked Appointments</p>
                </div>
                <div class="doctor-reviews-button-under-border select-doctor-checkbox">
                	<span class="bt-content pl-5">
                		<span class="dc-checkbox">
                			<input name="selected_doctor" value="14" id="wt-check-14" type="checkbox">
                			<label for="wt-check-14">Selected Doctor</label>
                		</span>
                	</span>
                    <span class="bt-content pl-5">
                		<span class="dc-checkbox">
                			<input name="showed_up" value="15" id="wt-check-15" type="checkbox">
                			<label for="wt-check-15">Showed Up</label>
                		</span>
                	</span>
                    <table class="table table-responsive" v-if="selectedPatient.appointments_patient !== []">
                        <tr class="header">
                            <th> {{ trans('lang.doctor') }} </th>
                            <th> {{ trans('lang.patient') }} </th>
                            <th> {{ trans('lang.date') }} </th>
                            <th> {{ trans('lang.time') }} </th>
                            <th> {{ trans('lang.booked') }} </th>
                            <th>Charges</th>
                        </tr>
                        <tr v-for="appointment in selectedPatient.appointments_patient">
                            <td>{{appointment.user.first_name}} {{appointment.user.last_name}}</td>
                            <td>{{appointment.patient_name}}</td>
                            <td>{{appointment.appointment_date}}</td>
                            <td>{{appointment.appointment_time}}</td>
                            <td>{{appointment.charges}}</td>
                            <td>{{appointment.status}}</td>
                        </tr>
                    </table>
                </div>
                <div class="book-online-button">
                    <a href="#" class="dc-btn">Book Online Consultation <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                    <a href="#" class="dc-btn">Send Doctor Profile Link To Patients</a>
                </div>
            </div>
        </form>
        </div>

    </div>
</template>

<script>
  import Autocomplete from 'vuejs-auto-complete'
  import Vue from 'vue'
  import Multiselect  from 'vue-multiselect'
  export default {
    components: {Autocomplete, Multiselect},
    props:['doctors', 'hospitals', 'specialities', 'diseases', 'locations'],
    name: 'AppointmentBookingSystem',
    data: function () {
      return {
        allDoctors: this.doctors,
        currentDate: '',
        search: '',
        selectedDoctor: '',
        selectedDoctorReview: '',
        selectedDoctorHospitals: [],
        selectedLocation: '',
        selectedDoctorUpComingAppointment: [],
        selectedDoctorAppointments: [],
        selectedDisease: [],
        childLocations: [],
        selectedChildLocation: [],
        showChildLocation: false,
        showSlots: false,
        selectedHospital: '',
        extraBooking: false,
        gender: '',
        selectedSpeciality:null,
        selectHospital:null,
        keyword: null,
        docs: [],
        selectedPatient:[],
        filter: '',
        hospital: '',
        hospital_type: '',
        appointment: '',
        type: '',
        first_name: '',
        last_name: '',
        phone_number: '',
        patient_location: '',
        patient_area: '',
        age: '',
        follow_up: '',
        direct_booking: '',
        mark_doctor_as_red: '',
        agent_special: '',
        notes: '',
        comments: '',
        send_message_to_patienet: '',
        send_message_to_doctor: '',
        send_message_to_assistance: '',
        send_voice_message_to_patient: '',
        booked: '',
        appointmentProcess: '',
        appointmentDateTime:'',
        appointmentStatus: '',
          consultation_fee: '',

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

    mounted () {
            // console.log('spe1', this.selectedSpeciality)

    },
    created () {
      // console.log(this.doctors, this.hospitals, this.diseases)
      this.currentDate = (moment().format('YYYY-MM-DD')).toLowerCase()
      // console.log(this.currentDate)
    },
    computed: {

    },
    watch: {
        keyword(after, before) {
            this.getResults();
        }
    },
    methods: {
        getResults() {
            if (this.selectedSpeciality != null){
            var speciality_id =  this.selectedSpeciality.id;
        }
        else{
            var speciality_id = null;
        }
         if (this.selectHospital != null){
            var hospital_id =  this.selectHospital.id;
        }
        else{
            var hospital_id = null;
        }   
            if(this.keyword.length > 2){
            axios.get('/search-for-doctors', { params: { keyword: this.keyword, speciality_id:speciality_id, hospital_id:hospital_id } })
                .then(res => this.docs = res.data)
                .catch(error => {});
        }
        if(this.keyword.length < 1){
            this.docs=[];
        }
        },
        specialitySelected(value,id){
            this.selectedSpeciality = value.id;
            // console.log('spe', this.selectedSpeciality)
        },
        hospitalSelected(value,id){
            this.selectHospital = value.id;
            // console.log('hos', this.selectHospital)
        },
        customLabel (value) {
            // console.log('customLabel', value)
      
        return value.first_name + ' ' + value.last_name;
      
    },
      formattedDisplay (result) {
        this.showSlots = false
        this.selectedDoctorHospitals = []
        var hospitalData = [];
        var hospitalName = '';
        var specialty2 = '';
        var specialty3 = '';
        var specialty4 = '';
        let self = this
        var filter = document.querySelector('input[name="filter"]:checked').value;
        if(result.specialities[1]){
            specialty2 = ' & '+ result.specialities[1].title;
        }
        if(result.specialities[2]){
            specialty3 = ' & '+ result.specialities[2].title;
        }
        if(result.specialities[3]){
            specialty4 = ' & '+ result.specialities[3].title;
        }
        if (filter === 'doctor') {
          return result.first_name + ' ' + result.last_name
        }
        else if (filter === 'speciality') {
          return result.first_name + ' ' + result.last_name + ' [ ' + result.specialities[0].title  + specialty2 + specialty3 + specialty4 + ' ]'
        }
        else if (filter === 'hospital') {
          if (result.doc_teams.length > 0){
            result.doc_teams.forEach(function (hospital) {
              if (hospital.user_id !== 'online') {
                hospitalData.push(self.hospitals.find(x => x.id === JSON.parse(hospital.user_id)))
              } else {
                hospitalData.push(
                  {
                    'id': 'online',
                    'first_name': 'Online',
                    'last_name' : 'Consultation',
                  }
                )
              }
            })
          }
          hospitalData.forEach(function (hos, index) {
            if ( index === 0 ) {
              hospitalName = hospitalName + hos.first_name+' '+hos.last_name
            }
            else {
              hospitalName = hospitalName + ' & ' + hos.first_name+' '+hos.last_name
            }
          })
          return result.first_name + ' ' + result.last_name + ' [' + hospitalName + ' ]'
        }
        else {
          console.log('else')
        }
      },
      // filteredList () {
      //   this.allDoctors = this.doctors
      //   let day = (moment().format('ddd')).toLowerCase()
      //   var today = document.querySelector('input[name="today"]').checked;
      //   var spec = document.querySelector('input[name="spec"]:checked');
      //   if (spec !== null) {
      //     this.allDoctors = this.doctors.filter(function (x) {
      //       let result = false
      //       x.specialities.forEach(function (s) {
      //         // console.log(s.id === JSON.parse(spec.value))
      //         if(s.id === JSON.parse(spec.value)) {
      //           result = true
      //         }
      //       })
      //       return result
      //     })
      //   }
      //   if (today) {
      //     this.allDoctors = this.doctors.filter(function(a){
      //       if (a.profile.available_days !== '' && a.profile.available_days !== null) {
      //         return JSON.parse(a.profile.available_days).includes(day)
      //       }
      //       else {
      //         return false
      //       }
      //     })
      //   }
      //   if (!today && spec === null) {
      //     this.allDoctors = this.doctors
      //   }
      // },
      doctorPopulates (doctor) {
        // console.log('hi', doctor);
        this.docs='';
        this.selectedDoctor = doctor
        this.selectedDoctorReview = doctor.feedbacks.length
        if (doctor.appointments.length > 0) {
          this.selectedDoctorUpComingAppointment = doctor.appointments[
          doctor.appointments.length - 1
            ]
          this.selectedDoctorAppointments = doctor.appointments
        }
        this.selectedDoctorHospital(doctor)
      },
      selectedDoctorHospital (result) {
        let self = this
        if(result.doc_teams.length !== 0)
        {
            result.doc_teams.forEach(function (team) {
            if (team.user_id !== 'online') {
                if (JSON.parse(team.slots) !== null) {

                if(JSON.parse(team.slots).monday && JSON.parse(team.slots).monday.consultation_fee){
                   self.consultation_fee = JSON.parse(team.slots).monday.consultation_fee
                }
                if(JSON.parse(team.slots).tuesday && JSON.parse(team.slots).tuesday.consultation_fee){
                   self.consultation_fee = JSON.parse(team.slots).tuesday.consultation_fee
                }
                if(JSON.parse(team.slots).wednesday && JSON.parse(team.slots).wednesday.consultation_fee){
                   self.consultation_fee = JSON.parse(team.slots).wednesday.consultation_fee
                }
                if(JSON.parse(team.slots).thursday && JSON.parse(team.slots).thursday.consultation_fee){
                   self.consultation_fee = JSON.parse(team.slots).thursday.consultation_fee
                }
                if(JSON.parse(team.slots).friday && JSON.parse(team.slots).friday.consultation_fee){
                   self.consultation_fee = JSON.parse(team.slots).friday.consultation_fee
                }
                if(JSON.parse(team.slots).saturday && JSON.parse(team.slots).saturday.consultation_fee){
                   self.consultation_fee = JSON.parse(team.slots).saturday.consultation_fee
                }
                if(JSON.parse(team.slots).sunday && JSON.parse(team.slots).sunday.consultation_fee){
                   self.consultation_fee = JSON.parse(team.slots).sunday.consultation_fee
                }
            }
            else{
                self.consultation_fee = team.price
            }
                let hos = self.hospitals.find(x => x.id === JSON.parse(team.user_id))
                // console.log('mimi',JSON.parse(team.slots))
                self.selectedDoctorHospitals.push({
                    'id': hos.id,
                    'name': hos.first_name + ' ' + hos.last_name,
                    'avatar': hos.profile.avatar,
                    'fees': self.consultation_fee
                })
            }

        }) 

        }
        this.showSlots = true;

       
      },
      formattedDisease (result) {
        return result.title
      },
      formattedLocation (result) {
        return result.title
      },
      onDiseaseSelect(group) {
        this.selectedDisease = group
      },
      onLocationSelect(group) {
        this.selectedLocation = group
        this.showChildLocation = true;
        this.childLocations = this.locations.filter(x => x.parent === group.value)
      },
      formattedChildLocation (result) {
        return result.title
      },
      onChildLocationSelect(group) {
        this.selectedChildLocation = group
      },
      hospitalName (id) {
          if (id !== null ) {
              let hospital = this.hospitals.find(x => x.id === id)
              return hospital.first_name + ' ' + hospital.last_name
          }
          else {
              return 'Online Consultation'
          }

      },
      locationSelect (id) {
        // console.log(id)

      },
      validate_form () {
        let form_errors = [];
        let self = this
          if (this.phone_number === ''){
              form_errors.push(Vue.prototype.trans('lang.patient_phone_req'));
              form_errors.forEach(element => {
                  self.showError(element)
              });
              return false
          }
        if (this.first_name === ''){
          form_errors.push(Vue.prototype.trans('lang.patient_name_req'));
          form_errors.forEach(element => {
            self.showError(element)
          });
          return false
        }
        if (this.last_name === ''){
          form_errors.push(Vue.prototype.trans('lang.patient_name_req'));
          form_errors.forEach(element => {
            self.showError(element)
          });
          return false
        }
        if (this.selectedDisease === []){
            form_errors.push(Vue.prototype.trans('lang.patient_disease_req'));
            form_errors.forEach(element => {
                self.showError(element)
            });
            return false
        }
        /*if (this.age === ''){
            form_errors.push(Vue.prototype.trans('lang.patient_age_req'));
            form_errors.forEach(element => {
                self.showError(element)
            });
            return false
        }*/
        if (this.gender === ''){
            form_errors.push(Vue.prototype.trans('lang.patient_gender_req'));
            form_errors.forEach(element => {
                self.showError(element)
            });
            return false
        }
        if (this.selectedLocation === ''){
            form_errors.push(Vue.prototype.trans('lang.patient_location_req'));
            form_errors.forEach(element => {
                self.showError(element)
            });
            return false
        }
        if (this.selectedChildLocation === []){
            form_errors.push(Vue.prototype.trans('lang.patient_area_req'));
            form_errors.forEach(element => {
                self.showError(element)
            });
            return false
        }
        // console.log(this.appointmentStatus, this.appointmentProcess)
        if (this.appointmentProcess === ''){
            form_errors.push(Vue.prototype.trans('lang.appt_process'));
            form_errors.forEach(element => {
                self.showError(element)
            });
            return false
        }
        if (this.appointmentStatus === ''){
            form_errors.push(Vue.prototype.trans('lang.appt_status'));
            form_errors.forEach(element => {
                self.showError(element)
            });
            return false
        }
        if (this.direct_booking === ''){

        }
        if (this.mark_doctor_as_red === ''){

        }
        if (this.agent_special === ''){

        }
        if (this.comments === ''){

        }
        if (this.notes === ''){
          form_errors.push(Vue.prototype.trans('lang.app_notes'));
          form_errors.forEach(element => {
            self.showError(element)
          });
          return false
        }
        if (this.send_message_to_patienet === ''){

        }
        if (this.send_message_to_doctor === ''){

        }
        if (this.send_message_to_assistance === ''){

        }
        if (this.send_voice_message_to_patient === ''){

        }
        if (this.booked === ''){

        }
        return true
      },
      submitAppointment () {
        let form_errors = []
        let self = this
        // console.log('charges', self.consultation_fee);
        // if (!this.validate_form()) {
        //   return
        // }
        let data = document.getElementById('call_appointment_form');
        let formData = new FormData(data)
        let a_date = formData.get('appointment[date]')
        let a_day = formData.get('appointment[day]') 
        let hospital_fname = formData.get('hospital_fname');
        let hospital_lname = formData.get('hospital_lname');
        let hospital_number = formData.get('hospital_number');
        let add_hospital_fee = formData.get('added_hospital_charges');  
        if (a_date === "" || a_day === "" || a_day === null || a_date === null) {
          a_date = document.getElementsByName('appointment[date]').value
          a_day = document.getElementsByName('appointment[day]').value
          if(a_date === undefined || a_day === undefined)
          {
            if(self.appointmentDateTime !== null)
            {
              let time=moment(self.appointmentDateTime,'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD hh:mm A');
              formData.append('added_appointment_datetime', time);
            }
            if(hospital_fname !== "" && hospital_fname !==null && hospital_lname !== null && hospital_lname !== "" && hospital_number !==null && hospital_number !== "") 
            {
              formData.append('added_hospital_fname',hospital_fname);
              formData.append('added_hospital_lname',hospital_lname);
              formData.append('added_hospital_num',hospital_number);
              formData.append('added_hospital_fee',add_hospital_fee);
            }
          }

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
        formData.append('charges', self.consultation_fee)

        axios.post(APP_URL + '/callAppointmentBooking', formData)
          .then(function (response) {
                // console.log('user',response.data.patient)
            if (response.data.type === 'success') {
                self.selectedPatient = response.data.patient
                self.showMessage('Appointment Booked successfully')
            } 
            else {
                self.showError('There is Some Error')
            }
          })
          .catch(function (error) { })
      },
      formattedHospitals (result) {
        // console.log(result)
        return result.first_name + ' ' + result.last_name
      },
      extraBookingCheck () {
        this.extraBooking = document.querySelector('input[name="book_extra"]').checked;
        if (this.extraBooking === true) {
          this.showSlots = false;
        }
        else {
          this.showSlots = true;
        }
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
    },
    },
  }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>

</style>