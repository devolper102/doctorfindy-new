<template>
  <div>
    <div class="header_bg w-100 d-inline-block box_radius box_bottom_lr_radius position-relative p-2">
                      <div class=" doctor_image position-relative float-left mr-3">
                        <div class="book-dr-image mt-3 mt-lg-0 mb-3 mb-lg-0 float-left">
                          <img src="/images/banner-1.png" alt="book-dr-image picture" class="img-fluid rounded-circle h_50 w-50px modal_img">
                        </div>
                      </div>
                        <div class="prfile_detail mb-2">
                          <h5 class="d-inline-block font-weight-bold">Dr. Ruby Perrin</h5>
                          <span><img src="/images/black-check.png" alt="Check" class="img-fluid"></span>
                          <span><img src="/images/black-shield.png" alt="Shield" class="img-fluid"></span>
                          <div class="doctor_degree text_black float-left">
                            <p class="text_13">MBBS, CRCP (Dow), D.Derm, Diploma in Dermato-Surgery</p>
                            <p class="text_13">Dermatologist, Cosmetologist</p>
                          </div>
                        </div>
    </div>
      <div class="modal-body">
                  <div class="border-bottom-dark w-100 d-inline-block pb-2">
                    <div class="verification-text-phone-number pb-3">
                      <div class="patient_summary mb-2 overflow-hidden">
                        <span class="text_black font-weight-bold w-50 float-left"> <img src="/images/time-image.png" class="img-fluid mr-2"> Time
                        </span>
                        <span class="float-right text-right text-lg-left w-50">07:00 PM
                        </span>
                      </div>
                      <div class="patient_summary mb-2 overflow-hidden">
                        <span class="text_black font-weight-bold w-50 float-left"> <img src="/images/date-image.png" class="img-fluid mr-2"> Date
                        </span>
                        <span class="float-right text-right text-lg-left w-50">Jul 23, 2020</span>
                      </div>
                      <div class="patient_summary mb-2 overflow-hidden">
                        <span class="text_black font-weight-bold w-50 float-left"> <img src="/images/address-image.png" class="img-fluid mr-2"> Address</span>
                        <span class="float-right w-50 text-right text-lg-left">Jinah Hospital Usmani Rd, Quaid-i-Azam Campus, Lahore</span>
                      </div>
                      <div class="patient_summary mb-2 overflow-hidden">
                        <span class="text_black font-weight-bold w-50 float-left"> <img src="/images/fee-image.png" class="img-fluid mr-2"> Consulting Fee</span>
                        <span class="float-right w-50 text-right text-lg-left">Rs.400</span>
                      </div>
                      <div class="patient_summary mb-2 overflow-hidden">
                        <span class="text_black font-weight-bold w-50 float-left"> <img src="/images/fee-image.png" class="img-fluid mr-2"> Booking Fee</span>
                        <span class="float-right w-50 text-right text-lg-left">Rs.100</span>
                      </div>
                      <div class="patient_summary">
                        <span class="text_black font-weight-bold w-50 float-left"> <img src="/images/fee-image.png" class="img-fluid mr-2"> Video Call Fee</span>
                        <span class="float-right w-50 text-right text-lg-left">Rs.100</span>
                      </div>
                    </div>
                  </div>
                
                <div class="modal-footer pb-0">
                  <div class="verification-text-phone-number w-90 m-auto 
                  text_13">
                    <div class="patient_summary">
                      <span class="text_black font-weight-bold w-50 float-left pl-2 pl-lg-4"> Total</span>
                      <span class="float-right w-50 text-right text-lg-left">Rs.600</span>
                      </div>
                  </div>    
                </div>
              </div>
  </div>
</template>

<script>
export default {
  name: "PatientBookingDoctorSectionComponent",
  props: [],
  data() {
    return {
      date: moment(),
      currentDate: moment().format('DD MMMM YYYY'),
    }
  },
  // computed: {
  //   time: function(){
  //     return this.date.format('h:mm A');
  //   }
  // },
  // mounted: function(){
  //   setInterval(() => {
  //     this.date = moment(this.date.add(1, 'seconds'))
  //   }, 1000);
  // },
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