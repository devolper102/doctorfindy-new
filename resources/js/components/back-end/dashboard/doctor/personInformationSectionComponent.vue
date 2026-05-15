<template>
  <div>
    <div class="row">
            <div class="col-lg-2 col-12 text-center text-lg-left">
              <div class="user-name-image text-center">
                <img  v-lazy="'/uploads/users/'+this.doctor.id+ '/'+ this.doctor.profile.avatar" class="img-fluid" :alt="this.doctor.first_name" />
              </div>
            </div>
            <div class="col-lg-10 col-12">
              <div class="main-user-name-button w-100 d-inline-block">
                <div class="user-name float-left w-80">
                  <h3 class="font-weight-bold theme-color-text mb-0 text_xs_25">{{this.doctor.first_name}} {{this.doctor.last_name}}</h3>
                  <span class="font-weight-bold text_20">About Me</span>
                  <!-- <a class="text_black text_20" href="#">
                    <i class="fa fa-pencil-square-o ml-5" aria-hidden="true"></i>
                  </a> -->
                </div>
                <div class="creat-article-btn displ d-inline-block mt-2">
                  <a href="/create-article" class="knockdoc_btn_bg text-white float-lg-right float-left">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    Create Article
                      </a>
                </div>
              </div>
              <div class="user-name-content w-100 d-inline-block">
                  <p class="text_14 text_black font-weight-normal">{{this.doctor.profile.short_desc}}</p>
              </div>
            </div>
          </div>
          <footer class="dashboard-sticky-footer bg-white box_shadow p-2 d-inline-block mt-4 p-2 border-top w-xs-100 w-md-100">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
          <span>Copyright &copy; Your Website 2022</span>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
export default {
  name: "personInformationSectionComponent",
  props: ['doctor'],
  data() {
    return {
 
    }
  },

  created () {
              console.log(this.doctor)
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