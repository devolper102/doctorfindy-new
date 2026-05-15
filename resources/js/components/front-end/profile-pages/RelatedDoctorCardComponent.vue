<template>
  <div class="booking-doctor-main">
    <div class=" col-12 col-lg-4 col-xl-3 col-md-6 mt-3 mt-lg-3 d-inline-block" v-if="doctors != null" v-for="(doc , index) in doctors" >
      <div class="suggest-doctor bg-white w-100 d-inline-block p-2 box-shadow">
      <div class="doctros_profiles">
        <div class="doctor_data d-inline-block w-100">
            <div class="doctor_image position-relative float-left w-20">
              <div class="position-relative mb-1">
              <img v-if="doc.profile.avatar" v-lazy="basePath+'/uploads/users/'+doc.id+'/medium-'+doc.profile.avatar" :alt="doc.first_name + ' ' + doc.last_name" :name="doc.first_name + ' ' + doc.last_name" class="img-fluid rounded-circle h_50 w_60px h_md_60">
              <img v-else v-lazy="basePath+'/uploads/users/default/doctor.svg'" :alt="doc.first_name + ' ' + doc.last_name" :name="doc.first_name + ' ' + doc.last_name" class="img-fluid rounded-circle h_50 w_60px">
              <a v-if="doc.profile.willing_video" href="javascript:void(0)" class="position-absolute d-table video_icon" style="bottom: 0px;right: 0px;">
                <p class="w_20px h_20 rounded-circle text_14 text-center d-table-cell align-middle text-white bg-blue">
                  <i class="fas fa-video text_12" aria-hidden="true"></i>
                </p>
              </a>
              <a v-if="user && user.speciality" :href="'/doctors/'+doc.location.slug+'/'+user.speciality[0].slug+'/'+doc.slug" class="circle_anchor position-absolute"></a>
              <a v-else :href="'/doctors/'+doc.location.slug+'/'+doc.location.slug+'/'+doc.slug" class="circle_anchor position-absolute"></a>

            </div>
           <!--  <div class="box_percentage">
              <div class="total_rating w-80 m-auto w-md-100">
                <span class="theme-color-text">
                  {{ averageRating(doc.feedbacks) }}
                  <star-rating
                      class="w-30 float-left m-0 vue-star-rating"
                      :max-rating="1"
                      :show-rating="false"
                      v-model="userRating"
                      :increment="userRating"
                      :rating="userRating"
                      inactive-color="#cccccc"
                      active-color="#0E4D92"
                      v-bind:star-size="14"
                  ></star-rating>
                                <i class="fa fa-star" aria-hidden="true"></i> 
                    <span class=" float-left text-center mr-1 ml-1 text-blue">{{ userRating }}</span>
                   <span class="d-inline-block text_black" style="margin-top: 3px;"> ({{ user.feedbacks.length }})</span> 
                </span>
              </div>
            </div> -->
            </div>
            <div class="doctor-name-specialties float-left ml-2 
            w-75 mt-1">
              <div class="w-100 d-inline-block">
                <a v-if="user && user.speciality" class="text_black font-weight-bold w-75 d-inline-block text-truncate text_13" :href="'/doctors/'+doc.location.slug+'/'+user.speciality[0].slug+'/'+doc.slug">{{ doc.first_name }} {{ doc.last_name }}</a>
                <a v-else class="text_black font-weight-bold w-75 d-inline-block text-truncate text_13" :href="'/doctors/'+doc.location.slug+'/'+doc.location.slug+'/'+doc.slug">{{ doc.first_name }} {{ doc.last_name }}</a>
            <span v-if="getSatisfiedPatients(doc) > 0" class="badge safety-box text-white text_12 float-right">
              <i class="fa fa-thumbs-up" aria-hidden="true"></i>
              {{ getSatisfiedPatients(doc) }}%
            </span>
              </div>
            <span v-if="doc.specialities && doc.specialities.length > 0" class="text_12 text_black d-block">
              {{ doc.specialities.length > 0 ? doc.specialities[0].title : '' }}
              <!--<span v-for="spec in doctor.specialities">{{spec.title}} </span>-->
            </span> 
            <span v-else-if="user && user.speciality" class="text_12 text_black d-block">
              {{ user.speciality.length > 0 ? user.speciality[0].title : '' }}
              <!--<span v-for="spec in doctor.specialities">{{spec.title}} </span>-->
            </span>
            <p class="text_12 text_black">Fee<strong v-if="doc.profile.fees_range === '' || doc.profile.fees_range === null || doc.profile.fees_range === 'null'"> Rs {{docFee(doc)}}</strong>
            <strong v-else>
              {{ doc.profile.fees_range}} 
            </strong></p>
                  <p class="text_12 text_black" v-if="doc.profile.total_experience != null"><strong>Experience: {{ doc.profile.total_experience+' '}} Years</strong></p>
                  <p class="text_12 text_black" v-else>Experience<strong></strong></p>
                  <!-- <span class="text_13" v-if="doc.doc_teams.length >= 1 ">
                <i class="fa fa-calendar mr-2 text-blue" aria-hidden="true"></i>
                <span class="text_black text_13">
                  {{ checkAvailability(doc) }}
                </span>
              </span>
                <span class="text_black d-lg-block text_13">
                <span class="font-weight-bold d-block">
                    {{ availableDayName }}
                  </span>
                  <p style="margin:0px;" class="font-weight-bold text_12">{{availableDayString(doc)}}
                  </p>
                </span> -->
            </div>
        </div>
          <div class="view-profile-btn w-100 d-inline-block text-center mt-2 mb-2">
          <!-- <a class="text-white rounded-pill text_15 d-inline-block knockdoc_btn_bg w-90 mb-2" :href="'/profile/'+doc.slug">Book video consultation</a> -->
          <a class="text-white rounded-pill text_14 d-inline-block bg-blue w-90" :href="'/profile/'+doc.slug" data-toggle="modal" data-target="#modal_patient_num">Book appointment</a>
        </div>
      </div>
      </div>
    </div>
</div>
</template>

<script>
import StarRating from 'vue-star-rating'

Vue.component('star-rating', StarRating);

Vue.filter('dayFormat', function(value) {
  if (value) {
    return moment().day(value).format("dddd")
  }
});
export default {
  name: 'RelatedDoctorCardComponent',
  props: ['doctors','user', 'fileSystemDriver'],
  data() {
    return {
      satisfiedPatients: 0,
      rating: 0.0,
      userRating: 0.0,
      availableDayName: '',
      dayName: '',
      basePath:'',
    }
  },
  created () {
      if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com';
      } else {
        // Use local path for development
        this.basePath = '';
      }
  },
  mounted(){
  },
  methods: {
    getExperienceInNumbers(years) {
        const parts = years.split(' ');
        const number = parts[0];



          const singleDigits = [
        "zero", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten",
        "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen"
        ];

        const tensDigits = [
          "", "", "twenty", "thirty", "forty", "fifty"
        ];

        if (number <= 19) {
          
          return singleDigits[number];
        }
        if (number >= 20 && number <= 50) {
          
          const tens = Math.floor(number / 10);
          const ones = number % 10;

          if (ones === 0) {
            return tensDigits[tens];
          } else {
            return tensDigits[tens] + " " + singleDigits[ones];
          }
        } 
    },
    getRating(doctor){
        if (doctor.feedbacks > 0) {
          this.rating = parseFloat(((avgRating/parseFloat(doctor.feedbacks.length))/5).toFixed(1))
          this.satisfiedPatients =  (doctor.profile.votes  / doctor.feedbacks.length * 100).toFixed(1)
          let avgRating = 0.0
          doctor.feedbacks.forEach(function (feedback){
            avgRating += parseFloat(feedback.avg_rating)
          })
        }
        else {
          this.satisfiedPatients = 0
          this.rating = 0
        }
    },
    averageRating(value) {
      let avgRating = 0.0
      if (value.length > 0) {
        value.forEach(function (feedback){
          avgRating += parseFloat(JSON.parse(feedback.avg_rating))
        })
        this.userRating = parseFloat((avgRating/value.length).toFixed(1))
      }
      else {
        this.userRating = 0
      }
    },
    getSatisfiedPatients(doctor) {
      // Calculate satisfied patients percentage for a specific doctor
      if (doctor.feedbacks && doctor.feedbacks.length > 0 && doctor.profile && doctor.profile.votes) {
        const percentage = (doctor.profile.votes / doctor.feedbacks.length * 100).toFixed(0);
        return parseFloat(percentage);
      }
      return 0;
    },
    docFee(user){
      var docPrice = [];
        if(user.doc_teams.length > 0){

        user.doc_teams.forEach(function(x) {
          docPrice.push(x.price);
        })
        return Math.min.apply(Math, docPrice);
        }
        return 0;
      },
       checkAvailability: function (user) {
      let availableDays = JSON.parse(user.profile.available_days)
      if (availableDays !== '') {
        let availability = '';
        let day1 = ((moment().format('ddd')).toLowerCase().trim());
        let day2 = ((moment().add(1, 'day').format('ddd')).toLowerCase().trim());
        let day3 = ((moment().add(2, 'day').format('ddd')).toLowerCase().trim());
        let day4 = ((moment().add(3, 'day').format('ddd')).toLowerCase().trim());
        let day5 = ((moment().add(4, 'day').format('ddd')).toLowerCase().trim());
        let day6 = ((moment().add(5, 'day').format('ddd')).toLowerCase().trim());
        let day7 = ((moment().add(6, 'day').format('ddd')).toLowerCase().trim());
        if (availableDays !== null) {
          if (availableDays.includes(day1) === true) {
            this.dayName = moment().day(day1).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day1).format('dddd')
            return availability = 'Available Today'
          } else if (availableDays.includes(day2)) {
            this.dayName = moment().day(day2).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day2).format('dddd')
            return availability = ' Available Tomorrow'
          } else if (availableDays.includes(day3)) {
            this.dayName = moment().day(day3).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day3).format('dddd')
            return availability = ' Available on ' + moment().add(2, 'day').format('DD-MM-YYYY  dddd')
          } else if (availableDays.includes(day4)) {
            this.dayName = moment().day(day4).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day4).format('dddd')
            return availability = ' Available on ' + moment().add(3, 'day').format('DD-MM-YYYY  dddd')
          } else if (availableDays.includes(day5)) {
            this.dayName = moment().day(day5).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day5).format('dddd')
            return availability = ' Available on ' + moment().add(4, 'day').format('DD-MM-YYYY  dddd')
          } else if (availableDays.includes(day6)) {
            this.dayName = moment().day(day6).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day6).format('dddd')
            return availability = ' Available on ' + moment().add(5, 'day').format('DD-MM-YYYY  dddd')
          } else if (availableDays.includes(day7)) {
            this.dayName = moment().day(day7).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day7).format('dddd')
            return availability = ' Available on ' + moment().add(6, 'day').format('DD-MM-YYYY  dddd')
          } else {
            return availability = 'Not Available</em>'
          }
        } else {
          return availability = '<em class="dc-dayon">Not Available</em>'
        }
        return availability;
      }
      else {

      }
    },
   availableDayString(user) {
      let length = user.doc_teams.length
      let dayName = this.dayName;
      if(user.doc_teams[0].slots != null && user.doc_teams[0].slots != ""){
        if((JSON.parse(user.doc_teams[0].slots)[this.dayName]) != undefined && (JSON.parse(user.doc_teams[0].slots)[this.dayName]) != null){

          let start_end_time = ((JSON.parse(user.doc_teams[0].slots)[this.dayName]['start_end_time']));
          let start_end_time1 = ((JSON.parse(user.doc_teams[0].slots)[this.dayName]['start_end_time1']));
            if(start_end_time1 != '')
              return start_end_time+"\n"+start_end_time1;
            else
              return start_end_time ?? 'Not Available';
      }else{
        return 'Not Available';
      }
        
      }
      return 'Not Available';
      // return start_time + ` - ` + end_time
    },
  }
}
</script>

<style>
.vue-star-rating{
  float: left;
  margin-right: 5px;
}
/*.doctor_data{
  min-height: 135px;
}*/
</style>