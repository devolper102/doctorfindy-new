<template>
  <div>
      <!--  <div class="container">
      <div class="row">
            <div class="col-12 mt-4">
              <bread-crumb-spec></bread-crumb-spec>
            </div>
      </div>
    </div>  --> 
  <!-- <div class="bg-image-about-us">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-12 text-lg-left text-center">
          <div class="heading-about-us w-100 d-inline-block">
            <h1 class="theme-color-text font-weight-bold">‘Who we are?
            </h1>
            <p class="text_black font-weight-bold">We are the team of professionals providing healthcare services online like book appointment with doctor, book a Lab test, and find a hospital in all over Pakistan.</p>
          </div>
        </div>
        <div class="col-lg-6 col-12 text-lg-right text-center">
          <div class="about-us-image w-100 d-inline-block mt-3 mt-lg-5 ml-0 ml-lg-5 mb-3 mb-lg-0">
            <img class="img-fluid w-70" src="/images/about-us-image.png" alt="about-us-image picture">
          </div>
        </div>
      </div>
    </div>
  </div> -->
    <div class="bg-about-us-image ">
            <!-- <img class="img-fluid w-100" src="/images/about-us-img.png" alt="about-us-image picture"> -->
    </div>
  </div>
</template>

<script>
export default {
  name: "WeAreAboutSectionCompoent",
  props:['segments'],
    data: function() {
    return {
          resultSegments: this.segments,
    }
  }

}
</script>

<style>

</style>