<template>
  <div>
  <div class="bg-white box_shadow box_radius p-3 w-100 d-inline-block">
                <div class="heading-personal-information mb-2">
                  <p class="text_black font-weight-bold">Personal Information
                  </p>
                </div>
                <div class="col-12 p-0">
                  <div class="row">
                    <div class="col-12 col-lg-4">
                      <div class="form-group  mb-lg-0 input-amount">
                      <label class="text_black mb-2 mt-2">First name</label>
                      <input type="text" class="form-control" id="firstnameInputText" aria-describedby="emailHelp" placeholder="">
                      </div>
                    </div>
                    <div class="col-12 col-lg-4">
                      <div class="form-group  mb-lg-0 input-amount">
                      <label class="text_black mb-2 mt-2">Last name</label>
                      <input type="text" class="form-control" id="lastnameInputText" aria-describedby="emailHelp" placeholder="">
                      </div>
                    </div>
                    <div class="col-12 col-lg-4 p-lg-0">
                      <div class="redio_btns">
                      <div class="radio-button-group d-inline-block mt-5 mb-2">
                        <div class="custom-control custom-radio float-left mr-2">
                          <input type="radio" class="custom-control-input" id="customRadio5" name="example" value="customEx">
                          <label class="custom-control-label text-radio-btn" for="customRadio5">My self
                          </label>
                        </div>
                        <div class="custom-control custom-radio float-left mr-2">
                          <input type="radio" class="custom-control-input" id="customRadio6" name="example" value="customEx">
                          <label class="custom-control-label text-radio-btn" for="customRadio6">Someone else
                          </label>
                        </div>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="visiting-doctor mt-3 mb-2">
                  <p class="text_black font-weight-bold">Who is visiting to doctor?</p>
                </div>
                <div class="row">
                  <div class="col-12 col-lg-8">
                    <div class="form-group float-left mb-0 input-amount w-100">
                      <label class="text_black mb-2 mt-2">Patient name</label>
                      <input type="text" class="form-control" id="patientname" aria-describedby="patientname" placeholder="">
                    </div>
                  </div>
                  <div class="col-12 col-lg-4">
                    <div class="form-group mb-lg-0 input-amount">
                      <label class="text_black mb-2 mt-2">Relation with you
                      </label>
                      <input type="text" class="form-control" id="relationship" aria-describedby="relationship" placeholder="">
                    </div>
                  </div>
                </div>
                <div class="form-group patient-feedback w-100 d-inline-block mb-lg-0 input-amount">
                  <label class="text_14 text_black mb-2 mt-2">Note: 
                    <span>(optional)</span>
                  </label>
                  <textarea class="form-control text_14" rows="4" id="feedback"></textarea>
                </div>
  </div>
  </div>
</template>

<script>
export default {
  name: "PatientInformationSectionComponent",
  props: [],
  data() {
    return {

    }
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