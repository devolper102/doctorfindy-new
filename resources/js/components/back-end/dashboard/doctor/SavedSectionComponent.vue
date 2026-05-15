<template>
  <div>
    <div class="container" id="wish-list">
      <p class="pb-2 p-2 pl-lg-3 font-weight-bold border-bottom-dark mb-3">Wish list</p>
    </div>
    <div class="row" v-if="savedDoctors.length >= 1">
      <div class="col-lg-6" v-if="savedDoctors.length >= 1">
        <div class="box_radius box_shadow p-3">
          <div class="saved_items">
            <p class="pb-2 border-bottom-dark font-weight-bold">Doctor you saved <span>({{ filteredDoctors.length }})</span></p>
          </div>
          <div v-for="(fdoctor, index) in filteredDoctors" class="user_name_img d-inline-block w-100 mt-2 border-bottom-dark pb-2" v-if="index < toShow">
            <a :href="'/profile/'+fdoctor.slug" class="float-left mr-3">
              <img v-if="fdoctor.profile.avatar"  v-lazy="'/uploads/users/'+fdoctor.id+'/'+fdoctor.profile.avatar" class="img-fluid w-50px h_50 rounded-circle" :alt="fdoctor.first_name + ' ' + fdoctor.last_name">
              <img v-else  v-lazy="'/uploads/users/default/doctor.svg'" class="img-fluid w-50px h_50 rounded-circle" :alt="fdoctor.first_name + ' ' + fdoctor.last_name">
            </a>
            <div class="float-left doctor_detail w-80 w_md_70">
              <a type="submit" class="float-right" @click="removeSaved(fdoctor.id)"><i class="fa fa-times" aria-hidden="true"></i></a>
              <a :href="'/profile/'+fdoctor.slug">
                <p class="">{{ fdoctor.first_name }} {{ fdoctor.last_name }}</p>
              </a>
              <p class="">{{ fdoctor.specialities[0].title }}</p>
            </div>
          </div>
          <div v-if="filteredDoctors.length > 5" class="view_btn text-center w-100">
            <a @click="toShow += 3" class="theme-color-text font-weight-bold"> View All</a>
          </div>
        </div>
      </div>
      <div class="col-lg-6" v-if="savedDoctors.length >= 1">
        <div class="box_radius box_shadow p-3">
          <div class="saved_items">
            <p class="pb-2 border-bottom-dark font-weight-bold">Hospital you saved <span>({{ filteredHospitals.length }})</span></p>
          </div>
          <div v-for="(fhospital, index) in filteredHospitals" class="user_name_img d-inline-block w-100 mt-2 border-bottom-dark pb-2" v-if="index < toShowHospital">
               <a :href="'/profile/'+fhospital.slug" class="float-left mr-3">
              <img v-if="fhospital.profile.avatar"  v-lazy="'/uploads/users/'+fhospital.id+'/'+fhospital.profile.avatar" class="img-fluid w-50px h_50 rounded-circle" :alt="fhospital.first_name + ' ' + fhospital.last_name">
              <img v-else  v-lazy="'/uploads/users/default/doctor.svg'" class="img-fluid w-50px h_50 rounded-circle" :alt="fhospital.first_name + ' ' + fhospital.last_name">
            </a>
            <div class="float-left doctor_detail w-80 w_md_70">
              <a type="submit" class="float-right" @click="removeSavedHospital(fhospital.id)"><i class="fa fa-times" aria-hidden="true"></i></a>

              <a :href="'/profile/'+fhospital.slug">
                <p class="">{{ fhospital.first_name }} {{ fhospital.last_name }}</p>
              </a>
              <p class="">{{ fhospital.location.title }}</p>
            </div>
          </div>
          <div v-if="filteredHospitals.length > 5" class="view_btn text-center w-100">
            <a @click="toShowHospital += 3" class="theme-color-text font-weight-bold"> View All</a>
          </div>
        </div>
      </div>
    </div>
    <div v-else><h6 style="color:black:font-weight:bold;"align="center">No doctors or hospitals saved</h6> </div>
  </div>
</template>

<script>
export default {
  name: 'SavedSectionComponent',
  props: ['doctor', 'doctors', 'hospitals'],
  data() {
    return {
      savedDoctors: [],
      savedHospitals: [],
      filteredHospitals: [],
      filteredDoctors: this.doctors,
      toShow: 5,
      toShowHospital: 5,
    }
  },
  created () {
    let self = this
    if (this.doctor.profile.saved_doctors) {
      self.savedDoctors = JSON.parse(this.doctor.profile.saved_doctors)
    }
    if (this.savedDoctors !== null && this.savedDoctors.length > 0) {
      self.filteredDoctors = []
      this.doctors.forEach(function (x) {
        if(self.savedDoctors.includes(x.id)) {
          if (!self.filteredDoctors.includes(f => f.id === x.id)) {
            self.filteredDoctors.push(x)
          }
        }
      })
    }
    if (this.savedDoctors !== null && this.savedDoctors.length > 0) {
       self.filteredHospitals = []
      this.hospitals.forEach(function (x) {
        if(self.savedDoctors.includes(x.id)) {
          if (!self.filteredHospitals.includes(f => f.id === x.id)) {
            self.filteredHospitals.push(x)
          }
        }
      })
    }
  },
      methods: {
           removeSaved(id) {
            let self = this
             self.alldoctor = []
            Swal.fire({
              title: 'Are you sure? to Remove Saved Doctor ',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              cancelButtonText: 'No',
              confirmButtonText: 'Yes, Cancel it!'
            }).then((result) => {
              if (result.value) {
                //Send Request to server
                axios.delete('/remove-saved-wishlist/'+id)
                    .then((response)=> {
                            Swal.fire(
                              'Cancel!',
                              'Remove Saved Doctor Successfully...',
                              'success'
                            )
                            if (response.data === '' || response.data === null || response.data === 'null') {
                              self.filteredDoctors = 0
                          }
                          else{
                               response.data.forEach(function (x) {
                            if(x.roles[0].name === 'doctor') {
                              self.alldoctor.push(x)
                            }
                          })
                          self.filteredDoctors = self.alldoctor 
                          }   
                    }).catch(() => {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Something went wrong!',
                          footer: '<a href>Why do I have this issue?</a>'
                        });
                    });
                }

            });
          },

          removeSavedHospital(id) {
            let self = this
             self.allhospital = []
            Swal.fire({
              title: 'Are you sure? to Remove Saved Hospital ',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              cancelButtonText: 'No',
              confirmButtonText: 'Yes, Cancel it!'
            }).then((result) => {
              if (result.value) {
                //Send Request to server
                axios.delete('/remove-saved-wishlist/'+id)
                    .then((response)=> {
                            Swal.fire(
                              'Cancel!',
                              'Remove Saved Hospital Successfully...',
                              'success'
                            )
                              if (response.data === '' || response.data === null || response.data === 'null') {
                              self.filteredHospitals = 0
                          }
                          else{
                              response.data.forEach(function (x) {
                            if(x.roles[0].name === 'hospital') {
                              self.allhospital.push(x)
                            }
                          })
                          self.filteredHospitals = self.allhospital  
                          }  
                    }).catch(() => {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Something went wrong!',
                          footer: '<a href>Why do I have this issue?</a>'
                        });
                    });
                }

            });
          }

  },
}
</script>

<style>
img[lazy=loading] {
    background-image: url("/images/loader/loaderss.gif");
    background-position: center;
    background-size: contain;
    display: flex;
    width: auto;
    height: auto;
    background-repeat: no-repeat;
  }
img[lazy=error] {
    background-image: url("/images/loader/healthcare-image.png");
    background-position: center;
    background-size: contain;
    display: flex;
    width: auto;
    height: auto;
    background-repeat: no-repeat;
  }
</style>