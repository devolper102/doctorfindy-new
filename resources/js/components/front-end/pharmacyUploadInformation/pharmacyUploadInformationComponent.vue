<template>
	<div>
		<div class="container">
			<div class="row mt-4 mb-4">
				<div class="col-12 p-0">
					<div class="pharmacy-upload-information w-70 d-block m-auto w-xs-100 w-sm-100 w-md-100 w-ipad-100">
						<div class="process-wrapper d-flex align-items-center p-3 box_radius">
    <div class="process-card w-80 m-auto d-block w-xs-100 w-sm-100 w-md-100 w-ipad-100 mt-4 mb-4">

      <!-- STEPS HEADER -->
      <div class="steps">
        <div
          class="step"
          :class="{ active: step >= 1, done: step > 1 }"
        >
          <span>
					  <template v-if="step > 1">
            <img src="/images/tick-white-icon.svg" alt="picture">     
            </template>
					  <template v-else>1</template>
					</span>
          <p class="text_14 time-text">Upload<br>Prescription</p>
        </div>

        <div class="line" :class="{ active: step > 1 }"></div>

        <div
          class="step"
          :class="{ active: step >= 2, done: step > 2 }"
        >
          <span>
					  <template v-if="step > 2">
            <img src="/images/tick-white-icon.svg" alt="picture">     
            </template>
					  <template v-else>2</template>
					</span>
          <p class="text_14 time-text">Your<br>Information
          </p>
        </div>

        <div class="line" :class="{ active: step > 2 }"></div>

        <div
          class="step"
          :class="{ active: step === 3 }"
        >
          <span>
					  <template v-if="step > 3">
            <img src="/images/tick-white-icon.svg" alt="picture">     
            </template>
					  <template v-else>3</template>
					</span>
          <p class="text_14 time-text">Doorstep<br>Delivery
          </p>
        </div>
      </div>

      <!-- STEP 1 -->
      <div v-if="step === 1" class="content">
        <h3 class="text_black text_25 text-xs-20">Upload Prescription Guide</h3>
        <p class="sub text_14 mb-2">
          Please upload image of valid prescription from your doctor.
        </p>

        <div class="upload-box bg-white text-center mb-3 mt-3 box_radius">
          <div class="upload-icon">
          	<img src="/images/upload-icon-image.svg">
          </div>
        </div>
        <div class="note w-100 d-inline-block">
        	<p class="font-weight-bold text_black text_15">Note:</p>
        	<p class="color-date text_14">
        		Please ensure you upload a clear image containing the doctor's details,
          date of prescription, patient information, and dosage details.
        	</p>
        </div>
        <div class="w-100 d-inline-block text-center mt-3 mb-3">
        <button class="text_14 book-rounded text-white bg-green pt-1 pb-1 pl-4 pr-4 border-green" @click="step = 2">
          PLACE ORDER
        </button>
      </div>
      </div>
      <!-- STEP 2 -->
      <div v-if="step === 2" class="content">
        <input class="text_14 w-100 d-inline-block mb-2 book-rounded" type="text" placeholder="Name">
        <div class="phone-row w-100 d-inline-block position-relative">
          <input class="text_14 w-100 d-inline-block mb-2 book-rounded" type="text" placeholder="Phone Number">
          <button class="verification-code-btn bg-green text-white book-rounded text_14 position-absolute border-0" data-toggle="modal" data-target="#VerificationCodeModal">Send Verification Code
          </button>
        </div>
        <input class="text_14 w-100 d-inline-block mb-2 book-rounded" type="email" placeholder="Email">
        <textarea class="text_14 w-100 d-inline-block mb-2 book-rounded" placeholder="Message" rows="4"></textarea>
        <div class="actions w-100 d-inline-block 
        text-center">
          <button class="service-text book-rounded text_14 pt-1 pb-1 pl-4 pr-4 service-border" @click="step = 1">BACK</button>
          <button class="text_14 book-rounded text-white bg-green ml-2 pt-1 pb-1 pl-4 pr-4 border-green" 
          @click="step = 3">CONFIRM
          </button>
        </div>
      </div>

      <!-- STEP 3 -->
      <div v-if="step === 3" class="content center">
        <img class="mb-3" src="/images/thanks-image.svg" alt="picture">
        <p class="text_black text_14">
          Thanks for placing order
          <strong class="order text-green">RBD19203983
          </strong><br>
          We will send you a notification within 24 hours
        </p>
        <p class="text_black text_14 mt-2">
          If you have any questions or queries then feel free to get in contact us.
        </p>
        <button class="text_14 book-rounded text-white bg-green mt-3 pt-1 pb-1 pl-4 pr-4 border-green">DONE</button>
        <div class="w-23 w-xs-50 w-sm-50 w-md-100 w-ipad-100 d-block m-auto">
		        <div class="mt-3 d-flex">
		        	<img class="mb-3" src="/images/download-pdf-image.svg" alt="picture">
		        <a class="text-green text_14 ml-2" href="javascript:void(0)">
		        Download as PDF</a>
	      </div>
        </div>
      </div>
    </div>
  </div>
					</div>
				</div>
			</div>
		</div>

<!--start Verification Code Modal -->
<div class="modal fade" id="VerificationCodeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header border-0 pb-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pt-0 pb-0">
        <div class="w-100 d-inline-block verification-code-modal">
  <div class="otp-card w-100 d-inline-block text-center 
  mt-3">
    <div class="otp-icon mb-3">
      <img src="/images/otp-icon-image.svg" alt="picture">
    </div>
    <p class="otp-text text_14 mb-3">
      Enter the OTP sent to :
      <span class="text_14 font-weight-bold text-green">123412341234</span>
    </p>
    <div class="otp-inputs">
      <input type="text" maxlength="1" autofocus>
      <input type="text" maxlength="1">
      <input type="text" maxlength="1">
      <input type="text" maxlength="1">
    </div>

    <!-- RESEND -->
    <p class="resend-text text_14 mb-3">
      Didn't receive Code?
      <a class="text_14 font-weight-bold text-green" href="javascript:void(0)">Re-send Code?</a>
    </p>
  </div>
        </div>
        <div class="modal-footer w-100 d-inline-block pt-0 border-0 text-center">
        <button type="button" class="text_14 book-rounded text-white bg-green pt-1 pb-1 pl-4 pr-4 border-green">Submit
        </button>
      </div>
      </div>
    </div>
  </div>
</div>
<!--end Verification Code Modal -->
	</div>
</template>

<script>

export default {
  name: "pharmacyUploadInformationComponent",
  data() {
    return {
      step: 1,
    };
  }
};

</script>

<style>

</style>