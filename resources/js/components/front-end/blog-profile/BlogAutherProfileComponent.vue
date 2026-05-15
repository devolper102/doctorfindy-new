<template>
    <div>
        <div class="container-fluid mt-4">
        	<div class="row">
        		<div class="col-lg-8 col-12 mb-3 order-2 order-lg-1 mt-3">
        			<div class="page_content w-85 m-auto w-md-100 w-xs-100 w-sm-100">
        				<div class="w-100 d-inline-block auther-heading">
	        				<h2 class="text_black text_25 text-xs-14 font-weight-bold">
	        					Auther Article’s
	        				</h2>
        			</div>
                  <div class="row mt-3">
                    <div class="specalities-image col-lg-6 col-md-6 col-12 col-sm-6 mb-xl-4 mb-3" v-for="(specialty, index) in 6">
                      <div class="doctor-in-pakistan w-100 w-sm-100 d-inline-block position-relative bg_health_height">
                        <div class="w-100 d-inline-block position-relative">
                          <span class="d-inline-block">
                            <img class="img-fluid book-rounded" src="/images/blog-auther-image.svg">
                            <div class="w-40 text-center d-inline-block p-2 blog-skin-box book-rounded position-absolute auther-skin-box">
                              <span class="text-white text_13">
                              Skin Care</span>
                            </div>
                          </span>
                        </div>
                        <div class="w-100 d-inline-block bg-white box-shadow p-2 border-bottom-radius">
                          <p class="text_13 font-weight-bold mb-0" style="overflow:hidden;height:40px;">
                          	How to get rid of pimples fast!
                          </p>
                          <span class="text_black text_12 d-inline-block mt-2" style="overflow:hidden;height:40px;">
                            Do you want to know how to get rid of pimples? <br>Pimples can be frustrating and embarrassing,
                          </span>
                          <ul class="w-100 d-inline-block mb-0 pl-0 mt-3 position-relative blogs-date mb-2">
                            <li>
                              <span class="text_black font-weight-bold text_12 mr-4 date position-relative">
                                May 11, 2023
                              </span>
                              <span class="text_black font-weight-bold text_12">
                                By Asim Muneer
                              </span>
                            </li>
                          </ul>
                        </div>
                        <a href="javascript:void(0)" class="circle_anchor position-absolute"></a>
                      </div>
                    </div>
                  </div>
              </div>
                </div>
                <div class="col-lg-4 col-12 pl-xl-0 bg-white blog_shadow order-2 orde-lg-2">
    <div class="aside_bar mb-3">
      <div class="w-100 d-inline-block pl-xl-0 pl-3 pr-xl-0 pr-3">
        <h5 class="font-weight-bold mb-2 mt-2 text_black">Recent Blogs
        </h5>
        <div class="treatment-information w-100 d-inline-block p-2">
          <div class="article_list w-100 d-inline-block" v-for="(specialty, index) in 10">
            <div class="w-100 d-inline-block">
              <a href="javascript:void(0)">
                <div class="hairfall-categories pl-2 pb-2 mt-3">
                  <!-- <h5 class="work-color-text font-weight-bold">Popular</h5> -->
                  <div class="row">
                    <div class="w-lg-20 w-24 mr-lg-2 mr-1">
                        <img class="w-100 d-inline-block book-rounded" src="/images/authar-image.svg">
                    </div>
                     <!-- <div v-else class="w-lg-20 mr-lg-2 mr-1">
                       <img src="/images/dummy-image.svg" alt="pictire" style="border-radius: 50%;height: 50px;width: 50px;margin-left:10px;">
                    </div> -->
                    <div class="float-left w-74">
                        <p class="text_black font-weight-bold">
                        	Difference between physical therapy and Rehabilitation
                        </p>
                        <span class="text_black d-block text_13 w-100 d-inline-block mt-1">
                        	Asim Muneer
                        </span>
                        <ul class="w-100 d-inline-block mb-0 pl-0 mt-1 position-relative blogs-date mb-2">
                            <li>
                              <span class="text_black font-weight-bold text_12 mr-4 date position-relative">
                                May 11, 2023
                              </span>
                              <span class="text_black font-weight-bold text_12">
                                By Asim Muneer
                              </span>
                            </li>
                          </ul>
                    </div>
                  </div>
                </div>  
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="border_health"></div>
    <div class="row mt-4">
      <div class="col-12">
        <div class="w-100 d-inline-block">
          <p class="text_black font-weight-bold text_13">Writers Profile</p>
        </div>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col-lg-4 col-6 col-md-4 col-sm-4 mb-3" v-for="(specialty, index) in 6">
        <div class="w-100 d-inline-block writer-image">
          <img class="w-100 d-inline-block book-rounded" src="/images/profile-image.svg">
          <span class="w-100 d-inline-block mt-2 text-center text_13">
            Asim Muneer
          </span>
        </div>
      </div>
    </div>
  </div>
        	</div>
        </div>
    </div>
</template>

<script>

export default {
  name: "BlogAutherProfileComponent",
  
data(){
    return{
      
    }
  },
  methods: {


  },

};

</script>

<style>

</style>