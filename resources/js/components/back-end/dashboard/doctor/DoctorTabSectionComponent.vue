<template>
  <div>
    <div class=" admin_doctor box_radius mt-4 mb-4 mt-xl-0 mb-xl-0 p-3 d-inline-block w-100">
      <div class="user_name_img w-100 d-inline-block">
        <a class="float-left mr-2">
          <img v-if="doctor.profile.avatar"  v-lazy="'/uploads/users/'+doctor.id+'/'+doctor.profile.avatar" class="img-fluid w-80px h_80 w_md_50px h_md_50 rounded-circle" :alt="doctor.first_name +' '+ doctor.last_name">
          <img v-else  v-lazy="'/uploads/users/default/doctor.svg'" class="img-fluid w-80px h_80 w_md_50px h_md_50 rounded-circle" alt="user Image">
        </a>
        <div class="banner_heading w-50 w-sm-80 float-left">
          <h2 class="text-white font-weight-normal">Welcome <span>{{ doctor.first_name }} {{ doctor.last_name }}</span></h2>
          <div role="separator" class="dropdown-divider"></div>
          <p class="text-white">
            {{ doctor.profile.sub_heading }}
          </p>
        </div>
        <div class="float-left float-lg-right w-sm-100">
          <div class="date_time text-white text-center">
            <p>{{ currentDate }}</p>
            <p>{{ time }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "DoctorTabSectionComponent",
  props: ['doctor'],
  data() {
    return {
      date: moment(),
      currentDate: moment().format('DD MMMM YYYY'),
    }
  },
  computed: {
    time: function(){
      return this.date.format('h:mm:ss A');
    }
  },
  mounted: function(){
    setInterval(() => {
      this.date = moment(this.date.add(1, 'seconds'))
    }, 1000);
  },
  created () {

  }
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