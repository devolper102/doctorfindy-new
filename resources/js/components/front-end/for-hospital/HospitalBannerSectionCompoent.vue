<template>
  <div>
 <!--     <div class="container">
        <div class="row">
              <div class="col-12 mt-4">
                <bread-crumb-spec></bread-crumb-spec>
              </div>
        </div>
    </div>  -->
    <section class="hospitalBanner position-relative">
      <div class="w-100 d-inline-block">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="lab-heading d-inline-block py-3 text-lg-left text-center">
                <h2 class="text_black mt-3 font-weight-bold mb-0">DoctorFindy for Clinics and Hospitals</h2>
                <p class="text_black text_18 text_md_14 w-40 w-md-100 mt-3">Join DoctorFindy and Connect with Millions of patients access and manage your account form anywhere any time </p>
                <div class="join-doctor-btn mt-4 mb-4">
                  <a href="#request-demo" class="rounded-pill knockdoc_btn_bg text-white knockdoc_doctor_profile_btn d-inline-block text-center">Join DoctorFindy
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: "HospitalBannerSectionCompoent",
    props:['segments'],
 data() {
    return {
      resultSegments: this.segments,
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