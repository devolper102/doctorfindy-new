<template>
	<div>
		<div class="container">
			<div class="booking_section">
          <div class="row">
            <div class="col-12">
              <div class="section-heading mt-3 mb-3 mt-lg-4 mb-lg-4 w-50 float-left w-xs-100">
                <h1 class="font-weight-bold text_xs_20 text_30 text-blue">
                 All Lab Tests ({{tests_count}})
                </h1>
              </div>
              <div class="input-lab-test-search w-50 float-left
              mt-lg-4 w-xs-100 position-relative">
        <input class="w-100 d-inline-block h_37 border-0 book-rounded pl-4 pr-5"
        type="text" v-model="keyword" placeholder="Search Test Name">
        <span class="input-group-btn position-absolute" style="top: 2px; right: 5px;">
          <a href="javascript:void(0)" type="button" class="btn bg-green text_14 text-white" style="border-radius: 10px; padding: 5px 10px;">Search 
            <span><i aria-hidden="true" class="fa fa-search fa-sm">
            </i></span>
          </a>
        </span>
    </div>
            </div>
          </div>
      </div>
		</div>
	</div>
</template>

<script>

export default {
  name: "allLabTestHeadingComponent",
  props: ['tests_count'],
data(){
    return{
      keyword: null,
    }
  },
   watch: {
        keyword(after, before) {
            this.$parent.getResults();
        }
    },
  methods: {

  },

};

</script>

<style>

</style>