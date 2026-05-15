<template>
  <div>
       <div class="payment-section mt-4">
                <h4 class="text_black mb-0">Payment</h4>
                <span class="text_black text_20">Choose payment method below
                </span>
              </div>
              <div class="row mt-2">
                <div class="col-12 col-lg-4">
                  <div class="bg-white box_shadow box_radius w-100 h-100 d-inline-block p-2">
                    <div class="payment_box text-center">
                      <img class="img-fluid" src="/images/credit-card-image.png" alt="credit-card-image picture">
                      <p class="text_black text_12 m-2">PAY WITH CREDIT CARD</p>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-lg-4 mt-3 mb-3 mt-lg-0 mb-lg-0">
                  <div class="bg-white box_shadow box_radius w-100 h-100 d-inline-block p-2">
                    <div class="payment_box text-center">
                      <img class="img-fluid" src="/images/jazz-cash-image.png" alt="jazz-cash-image picture">
                      <p class="text_black text_12 m-2">PAY WITH JAZZ CASH</p>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-lg-4">
                  <div class="bg-white box_shadow box_radius w-100 h-100 d-inline-block p-2">
                    <div class="payment_box text-center mt-mb-1">
                      <img class="img-fluid" src="/images/pay-visit-image.png" alt="pay-visit-image picture">
                      <p class="text_black text_12 m-2">PAY ON VISIT</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="bg-white box_radius box_shadow w-100 d-inline-block p-3 mt-4 mb-4">
                <div class="jazz-cash-account">
                  <h5 class="text_black">Jazz cash account</h5>
                </div>
                  <div class="row">
                    <div class="col-12 col-lg-7">
                      <div class="form-group w-100 float-left input-amount">
                        <label class="text_black mb-2 mt-2">Account number
                        </label>
                        <input type="number" class="form-control" id="cashInputNumber" aria-describedby="emailHelp" placeholder="0300***********">
                      </div>
                    </div>
                    <div class="col-12 col-lg-5">
                      <div class="jazz-cash-price float-left text-center mt-4">
                        <span>Rs:600</span>
                      </div>
                      <div class="form-group pay-btn w-50 float-left mt-4 ml-2 ml-lg-4">
                        <button class="knockdoc_btn_bg text-white border-0 form-control rounded-pill">Pay</button>
                      </div>
                    </div>
                  </div>
              </div>
  </div>
</template>

<script>
export default {
  name: "PatientChoosePaymentMethodSectionComponent",
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