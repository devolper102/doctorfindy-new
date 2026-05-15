<template>
  <div>
    <div class="modal" id="question-modal" tabindex="-1" role="dialog" aria-labelledby="mobile_number_detail" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content box_radius  box_shadow">
          <div class="modal-header p-0">
            <div class="knockdoc_sign_up_bg w-100 d-inline-block box_radius box_bottom_lr_radius position-relative p-2">
              <button type="button" class="close" v-on:click="closeModal(false)" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <div class="container">
                <div class="heading-bypass-grafting ml-3 w-75 float-left">
                  <p class="text_black
									font-weight-bold text_18 text-xs-13">Ask Question</p>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-body p-4">
            <form>
              <div class="form-group w-100 d-inline-block">
                <label class="text_black text_15 mb-0 text-xs-13">Select category</label>
                <div class="select-category">
                  <select v-model="$parent.specialty" class="form-control bg-white box_shadow input-border h_45 text_14" id="exampleFormControlSelect1">
                    <option :value="specialty.id" v-for="specialty in $parent.allspecialities">{{ specialty.title }}</option>
                  </select>
                </div>
              </div>
              <div class="form-group patient-reviews-feedback">
                <label class="text_14 text_black">
                  Question Title
                </label>
                <input v-model="$parent.title" class="form-control text_14" id="title" placeholder="Title">
              </div>
              <div class="form-group patient-reviews-feedback">
                <label class="text_14 text_black">
                  Type Question
                </label>
                <textarea v-model="$parent.question" class="form-control text_14" rows="8" id="feedback" placeholder="Type......."></textarea>
              </div>
              <div class="modal-footer border-0 p-0 w-100 d-inline-block">
                <div class="modal_footer_btn w-100
					               d-inline-flex m-0 float-left mt-1 ml-0 mr-0 mb-0">
                  <div class="submit-btn w-48 float-left">
                    <a @click="$parent.submitQuestion" class="knockdoc_sign_up_bg rounded-pill w-100 text-white p-2 text-center font-weight-bold d-inline-block">Submit</a>
                  </div>
                  <div class="cancle-btn w-48 float-right ml-4">
                    <a @click="$parent.show = !$parent.show" class="rounded-pill w-100 p-2 text-center font-weight-bold d-inline-block">Cancel</a>
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
name: "AskQuestionComponent",

  methods: {
    closeModal(e) {
      document.querySelector('#question-modal').classList.add('fade')
      document.querySelector('#question-modal').classList.remove('abc')
      document.querySelector('#question-modal').style.display = 'none'
    },
  }
}
</script>

<style scoped>

</style>