<template>
  <div>
   <!--    <div class="container">
      <div class="row">
            <div class="col-12 mt-4">
              <bread-crumb-spec></bread-crumb-spec>
            </div>
      </div>
    </div> -->
    <section class="genral-healthcare-discussion">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="headinng-health-care-discussion mb-3">
              <h4 class="text_black font-weight-bold text-center mb-3">General Healthcare<span class="font-weight-normal"> Discussion</span></h4>
              <p class="text_black text_14 w-60 m-auto text-center w-xs-100 w-sm-100 w-md-100">It is a long established fact that a reader will be distracted by the readable content of a page when
                looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as
                opposed to using 'Content here, content here', making it look like readable English.</p>
            </div>
          </div>
        </div>
    <!--     <div class="row">
          <div class="col-12 mt-5">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb bg-white pl-0 text_14 font-weight-bold
				text_xs_10">
                <li class="breadcrumb-item text_12">
                  <a href="#" class="text_black">HOME</a>
                </li>
                <li class="breadcrumb-item text_12 d-none d-lg-block">
                  <a href="#" class="text_black">COMMUNITY</a>
                </li>
                <li class="breadcrumb-item text_12 active text_black" aria-current="page">GENERAL HEALTH</li>
              </ol>
            </nav>
          </div>
        </div> -->
      </div>
    </section>
  </div>
</template>

<script>
export default {
name: "BannerSectionComponent",
props: ['segments'],
 data() {
    return {
       resultSegments: this.segments,
    }
  }
}
</script>

<style scoped>

</style>