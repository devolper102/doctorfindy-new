<template>
  <div>
    <div class="modal show" id="answer-modal" tabindex="-1" role="dialog" aria-labelledby="mobile_number_detail" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content box_radius  box_shadow">
          <div class="modal-header box_radius box_bottom_lr_radius">
            <div class="w-100 d-inline-block position-relative">
              <button data-dismiss="modal" type="button" class="close" v-on:click="closeModal()" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <div class="container">
                <div class="heading-bypass-grafting ml-3">
                  <p class="text_black
									font-weight-bold text_18 text-xs-13">Leave Answer</p>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-body p-4">
            <form>
              <div class="form-group patient-reviews-feedback">
                <textarea v-model="$parent.answer" class="form-control text_14" rows="8" id="feedback" placeholder="Type......."></textarea>
              </div>
              <div class="modal-footer border-0 p-0 w-100 d-inline-block">
                <div class="modal_footer_btn w-100
					               d-inline-flex m-0 float-left mt-1 ml-0 mr-0 mb-0">
                  <div class="submit-btn w-48 float-left">
                    <a @click="$parent.submitAnswer" class="knockdoc_btn_bg rounded-pill w-100 d-inline-block p-2 text-center appointment_modal border-0 text-white">Submit</a>
                  </div>
                    <div class="cancle-btn w-48 float-right ml-4">
                      <a v-on:click="closeModal()" class="w-100 light_btn_bg rounded-pill w-100 d-inline-block p-2 text-center ml-1">Cancel</a>
                    </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
name: "AnswersSectionComponent",


  methods: {
    showAddReview(e) {
      if (this.patient.length === 0) {
        Vue.toasted.show('Please Login First' , { duration: 3000 })
      }
      else {
        if (document.querySelector('#answer-modal')) {
          this.reviewForm = false
          document.querySelector('#answer-modal').classList.add('fade')
          document.querySelector('#answer-modal').classList.add('abc')
          document.querySelector('#answer-modal').style.display = 'block'
        }
        else{
          this.reviewForm = true
        }
      }
    },
    closeModal(){
        document.querySelector('#answer-modal').classList.remove('show')
        document.querySelector('#answer-modal').classList.remove('abc')
        document.querySelector('#answer-modal').style.display = 'none'
    },
  }
}
</script>

<style scoped>

</style>