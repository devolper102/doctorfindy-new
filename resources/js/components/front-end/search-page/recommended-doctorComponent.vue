<template>
	<!-- <div>
		<div class="row mt-4">
			<div class="col-12 col-lg-3 mb-3">
				<div class="suggest-doctor bg-white w-100 d-inline-block p-3 box_radius box_shadow mb-lg-0 mb-3">
					<div class="doctor_image position-relative float-left w-20 w-xs-25 w-sm-30">
						<img class="img-fluid rounded-circle h_60 w_60px" src="/images/banner.jpg" alt="picture">
                        <div class="total_rating w-80 m-auto w-md-100">
                    <span class="theme-color-text d-inline-block mt-2">
                      <star-rating
                          class="w-40 float-left m-0 vue-star-rating"
                          :max-rating="1"
                          :show-rating="false"
                          :rating="rating"
                          inactive-color="#cccccc"
                          active-color="#FF465C"
                          v-bind:star-size="15"
                      ></star-rating>
                        <span class=" float-left text-center mr-1 ml-1 text-15">0</span>
                      </span>
                  </div>
					</div>
					<div class="doctor-name-specialties w-75 float-left ml-2 w-xs-70 w-sm-65">
						<a href="javascript:void(0)" class="text_black font-weight-bold" style="white-space:nowrap">Assist. Prof. Dr. Maryam Raana</a>
						<span class="text_15 text_black d-block">
					        Cardiac Surgeon
					    </span>
					    <p class="text_15 text_black">Experience
					    	<strong>  years</strong>
					    </p>
					    <p class="text_15 text_black">Fee
					        <strong> Rs 
					    		<span>
                                   0
                                </span>
                            </strong>
                        </p>
                        <span class="text_black d-inline-block w-100">
                        	<span class="font-weight-bold">
                               Wednesday
                            </span> 
		                    <p class="font-weight-bold mt-1">
		                    	05:30 PM - 07:00 PM
		                    </p>
                        </span>
					</div>
					<div class="view-profile-btn w-100 d-inline-block text-center mt-4">
						<a href="javascript:void(0)" class="text-white rounded-pill text_15 d-inline-block knockdoc_btn_bg w-90 font-weight-bold">Book</a>
					</div>
				</div>
			</div>
		</div>
	</div> -->
</template>

<script>
import StarRating from 'vue-star-rating'
Vue.component('star-rating', StarRating);
export default {
  name: "recommended-doctorComponent",
 data(){
 	return{
 		rating:1
 	}
 }
  
};

</script>

</script>
