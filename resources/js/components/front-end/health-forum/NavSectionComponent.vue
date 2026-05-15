<template>
  <div>
    <section class="popular-question-button">
      <div class="doctor_profile w-100 d-inline-block mb-4 p-lg-3 p-1">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-8 col-md-8">
              <div class="popular-question-btn w-100 
          float-left mt-2 pl-lg-0 pl-sm-3">
                <a @click="$parent.sortByPopularQuestions" class="text_black float-left rounded-pill knockdoc_btn_bg text-white p-2 mr-4 w-xs-100 text-xs-center mr-sm-5 mr-md-3">Popular Question</a>
                <a @click="$parent.sortByNewQuestions" class="text_black float-left rounded-pill knockdoc_btn_bg text-white p-2 mr-4 w-xs-100 text-xs-center mt-lg-0 mt-3 mt-sm-0 mr-sm-5 mr-md-3">New Question</a>
                <a @click="$parent.sortByUnansweredQuestions" class="text_black float-left rounded-pill knockdoc_btn_bg text-white p-2 mt-lg-0 mt-3 w-xs-100 text-xs-center mt-sm-0">Unanswerd Question</a>
              </div>
            </div>
            <div class="col-lg-4 col-xs-12 mt-lg-0 mt-3 
            col-md-4 mt-md-2">
              <div class="join-doctor-btn mb-3 mt-lg-2 mt-0 w-100 d-inline-block">
                <a @click="$parent.showQuestionModal" class="rounded-pill knockdoc_btn_bg text-white pt-2 pb-2 pl-5 pr-5 w-xs-100 text-xs-center d-inline-block" data-toggle="modal" data-target="#bypass-grafting-modal">Ask Question
                </a>
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
name: "NavSectionComponent"
}
</script>

<style scoped>

</style>