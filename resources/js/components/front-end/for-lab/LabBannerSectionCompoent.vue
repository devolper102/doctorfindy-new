<template>
  <div>
  <!--    <div class="container">
        <div class="row">
              <div class="col-12 mt-4">
                <bread-crumb-spec></bread-crumb-spec>
              </div>
        </div>
    </div>  -->
    <section class="labBanner position-relative">
      <div class="w-100 d-inline-block">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="lab-heading mt-lg-3 d-inline-block">
                <h2 class="text_black font-weight-bold mb-0 text_md_20">DoctorFindy for Labs</h2>
                <p class="text_black mt-3 text_16 w-50 w-md-100">DoctorFindy is here to connect you with Pakistan’s most trusted laboratories. Effective treatment plan depends upon accurate diagnosis. That’s why labs play a vital role in this process. You can book any of your required laboratory tests with us anytime anywhere. Weare very devoted to serve you and your families in our best possible ways.  We offer a great variety of cost effective diagnostic tests. These tests include Blood tests, Urine tests, Liver function tests, Renal function tests, Blood sugar tests, HbA1C, Uric acid and cholesterol level etc. We also offer ECG(Electrocardiogram), CT-scan, MRI, Echocardiography, X-ray & Ultrasound.  
You can book any laboratory test according to your health care needs 24/7 on DoctorFindy. We assure you that your privacy is our main priority. 
 </p>
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
  name: "LabBannerSectionCompoent",
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