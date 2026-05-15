<template>
  <div>
    <!-- Start Section Doctor Blog And Tips -->
  <section class="doctor-blog-tips">
    <div class="specialities-background w-100 d-inline-block">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="heading-doctor-blog-tips">
              <h2 class="font-weight-bold text-center mt-4 mb-4 text_xs_25">Doctors Blog and Tips</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-lg-5 mb-4 mb-md-0" v-for="(blog,index) in blogs" v-if="index < blogsToShow">
            <div class="doctor-blog-images d-inline-block w-100">
              <a href="#" class="d-inline-block bg-white w-md-100">
                <iframe class="w-100 border-0" v-lazy="blog.url"></iframe>
              </a>  
                <div class="doctor-blog-under-content bg-white box_shadow p-1 w-100 d-inline-block">
                  <p class="text_12 text_black p-2" style="overflow:hidden;text-overflow:ellipse;" v-html="blog.description">
                  </p>
                 <!--  <p class="text_12 text_black font-weight-bold">talkin about
                  </p>

                  <p class="text_12 text_black font-weight-bold">skin care.</p> -->
                </div>
            </div>
          </div>
            </div>
            <div class="row">
            <div class="col-12">
            <div class="join-doctor-btn mt-3 mb-3 mt-lg-5 text-center">
            <a href="javascript:void(0)" v-if="blogs.length > 8 && blogs.length > blogsToShow-1" @click="blogsToShow += 8"class="rounded-pill knockdoc_btn_bg text-white p-2 btn_padding d-inline-block">View all blogs
            <i class="fa fa-arrow-right ml-3" aria-hidden="true">
              </i>
            </a>
          </div>
          </div>
        </div>
          </div>
          </div>
  </section>
  <!-- End Section Doctor Blog And Tips -->
  </div>
</template>

<script>
export default {
  name: "DoctorBlogsAndTipsSectionComponent",
   props:['allblogs'],
    data: function() {
    return {
        blogsToShow: 8,  
        blogs: this.allblogs,
    }
  },
    async created() {
    const blog = await axios.get('/all-blogs')
    this.blogs = Object.freeze(blog.data)
  },
}
</script>

<style scoped>

</style>