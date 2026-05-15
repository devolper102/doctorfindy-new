<template>
	<div>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="w-100 d-inline-block bg-lab-test book-rounded p-2">
						<div class="row">
							<div class="col-xl-9 col-12">
								<div class="w-100 d-inline-block">
									<h1 class="text_black mb-0 text_18 w-xs-80 float-xs-left text-xs-15 w-md-60 
									float-md-left">
										{{tests.title}} in {{tests.user.first_name+' '+tests.user.last_name}}
									</h1>
									<div class="w-20 d-xl-none float-left chughtai-logo d-block">
										<img v-lazy="basePath+'/uploads/users/'+tests.user.id+'/medium-'+tests.user.profile.avatar" :alt="tests.user.first_name+' '+tests.user.last_name" :name="tests.user.first_name+' '+tests.user.last_name">
									</div>
									<p class="w-100 d-inline-block">
						            <label class="text-black text_12 mr-sm-2 float-left mt-1">
						              Last Updated On {{moment().format("dddd")}},
						              {{ moment().format("MMMM") }} {{ moment().format("DD") }}, {{ moment().format("YYYY") }}
						            </label>
         						 </p>
								</div>
								<div class="w-100 d-inline-block">
									<div class="w-20 d-inline-block float-left mt-xl-3 w-xs-25 w-md-30">
										<div class="w-100 d-inline-block 
										book-lab-image">
											<img :src="basePath+'/images/book-lab-img.svg'">
										</div>
									</div>
									<div class="w-80 d-inline-block float-left w-xs-70 ml-xl-0 ml-2 w-md-65">
										<div class="w-100 d-inline-block mt-xl-2">
											<span class="text_black text_15 menu-border font-weight-bold">
												{{tests.title}}
											</span>
											<p class="text_black text_12 mb-0 font-weight-bold mt-1 text-xs-10">
												known as : {{tests.known_as}}
											</p>
										</div>
										<div class="add-cart-btn
										d-xl-inline-block d-none d-md-block">
											<a @click="labData(tests.user, tests.id)" class="text-white text_13 bg-blue book-rounded" data-toggle="modal" data-target="#testModal">
												Book Test
											</a>
											<a v-if="tests.title &&tests.user.first_name=='Chughtai' && tests.user.last_name=='Lab'" href="javascript:void(0)" @click="showDiscountModal" class="book-rounded text-center bg-green book-padding text-white ml-2 text_13 position-relative">Get Discount Code
                        <a class="bg-blue d-inline-block discount-icon position-absolute" 
                        href="javascript:void(0)">
                          <span class="d-inline-block">
                          <img :src="basePath+'/images/discount-icon.svg'">
                        </span>
                        </a>
                      </a>
										</div>
										<!-- <div class="cart-icon-image d-xl-inline-block  position-relative d-none d-md-block">
											<a class="bg-white book-rounded menu-border ml-3 cart-icon" href="javascript:void(0)">
											<img src="/images/cart-icon.svg">
											</a>
											<div class="d-inline-block toltip-box bg-white text-center">
							                  <a class="text_12 text-blue" 
							                  href="javascript:void(0)">
							                    Remove Cart
							                  </a>
							                  <span class="position-absolute text-white">
							                    <i class="fa fa-caret-down" aria-hidden="true">
							                    </i>
							                  </span>
                                            </div>
										</div> -->
									</div>

									<div class="w-100 
									d-xl-none d-block float-left">
										<div class="d-inline-block add-cart-btn d-md-none">
											<a @click="labData(tests.user, tests.id)" class="text-white text_12 bg-blue book-rounded text-xs-10" data-toggle="modal" data-target="#testModal">
												Book Test
											</a>
											<!-- {{tests.title}}
											{{tests.user.first_name}} -->
											<a v-if="tests.title &&tests.user.first_name=='Chughtai' && tests.user.last_name=='Lab'"  href="javascript:void(0)"@click="showDiscountModal" class="book-rounded text-center bg-green book-padding text-white ml-2 text_12 position-relative">Get Discount Code
                        <a class="bg-blue d-inline-block discount-icon position-absolute" 
                        href="javascript:void(0)">
                          <span class="d-inline-block">
                          <img :src="basePath+'/images/discount-icon.svg'">
                        </span>
                        </a>
                      </a>
										</div>
										<!-- <div class="d-inline-block cart-icon-image position-relative d-md-none">
											<a class="bg-white book-rounded menu-border ml-xl-3 ml-2 cart-icon" href="javascript:void(0)">
											<img src="/images/cart-icon.svg">
											</a>
											<div class="d-inline-block toltip-box bg-white text-center">
							                  <a class="text_12 text-blue" 
							                  href="javascript:void(0)">
							                    Remove Cart
							                  </a>
							                  <span class="position-absolute text-white">
							                    <i class="fa fa-caret-down" aria-hidden="true">
							                    </i>
							                  </span>
                                            </div>
										</div> -->
										<div class="d-inline-block float-right mt-3">
											<span class="text_black font-weight-bold text_12 float-right">
											<strike class="text-red">
												<span class="ml-1 text_black text_13 text-xs-12">
													Rs.{{tests.price}}
												</span>
											</strike>
											 <span class="ml-1 d-inline-block text_15">
											 	- {{tests.discounted_price}}
											 </span>
										</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-3 d-xl-block d-none">
								<div class="w-100 d-inline-block bg-blue book-rounded p-1">
									<div class="w-20 d-inline-block float-left chughtai-logo">
										<!-- <img src="/images/chughtai-logo.svg"> -->
										<img v-lazy="basePath+'/uploads/users/'+tests.user.id+'/medium-'+tests.user.profile.avatar" :alt="tests.user.first_name+' '+tests.user.last_name" :name="tests.user.first_name+' '+tests.user.last_name">
									</div>
									<div class="w-75 d-inline-block float-left lag-logo-name">
										<p class="text-white 
										text_12">
											{{tests.user.first_name+' '+tests.user.last_name}}
										</p>
										<span class="text-white font-weight-bold text_12 float-right">
											<strike class="text-red">
												<span class="ml-1 text-white text_13">
													Rs.{{tests.price}}
												</span>
											</strike>
											 <span class="ml-1 d-inline-block text_15">
											 	Rs.{{tests.discounted_price}}
											 </span>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-xl-4 mt-3">
				<div class="col-12">
					<div class="w-70 d-block m-auto lab-sample w-xs-100 w-sm-100 w-md-100">
						<div class="row">
							<div class="col-12 col-lg-6 mb-lg-0 
							mb-4">
								<div class="w-15 float-left lab-sample-image">
									<img :src="basePath+'/images/lab-sample-icon.svg'">
								</div>
								<div class="w-80 float-left lab-sample-detail ml-xl-3 ml-2">
									<p class="mb-0 text_black 
									text_15 font-weight-bold">
									Home Sample Collection for FREE
									</p>
									<p class="mb-0 text_black 
									text_12">
										"A trained professional collects your sample from your preferred location. Enjoy the convenience of having your sample collected with expertise and care."
									</p>
								</div>
							</div>
								<div class="col-12 col-lg-6 mb-lg-0 mb-4">
								<div class="w-15 float-left lab-report-image">
									<img :src="basePath+'/images/lab-report-icon.svg'">
								</div>
								<div class="w-80 float-left lab-sample-detail ml-xl-3 ml-2">
									<p class="mb-0 text_black 
									text_15 font-weight-bold">
									Get digital report within a day
									</p>
									<p class="mb-0 text_black 
									text_12">
										"The laboratories listed provide a guaranteed turnaround time of 24 hours starting from the moment the specimen is collected"
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- <div class="row mt-xl-3">
				<div class="col-12">
					<div class="w-100 d-inline-block lab-collapse b-bottom mb-3">
						 <a class="text_15 text-blue w-100 d-inline-block lab-test-inner" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
						    1. What is this test?
						</a>
						<div class="collapse" id="collapseExample">
						  <div class="card card-body border-0 p-2 pl-3">
						    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
						  </div>
						</div>
					</div>
					<div class="w-100 d-inline-block lab-collapse b-bottom mb-3">
						 <a class="text_15 text-blue w-100 d-inline-block lab-test-inner" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">
						    2. Test Preparation?
						</a>
						<div class="collapse" id="collapseExample2">
						  <div class="card card-body border-0 p-2 pl-3">
						    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
						  </div>
						</div>
					</div>
					<div class="w-100 d-inline-block lab-collapse b-bottom mb-3">
						 <a class="text_15 text-blue w-100 d-inline-block lab-test-inner" data-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample">
						    3. Understanding your test result?
						</a>
						<div class="collapse" id="collapseExample3">
						  <div class="card card-body border-0 p-2 pl-3">
						    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
						  </div>
						</div>
					</div>
				</div>
			</div> -->
			<div class="heading-box mt-3 mb-3" id="profileDetialFAQ">
        <h2 class="font-weight-bold m-0 text_black mb-2 text_16">
           FAQs
        </h2>
        <div>
           <div class="question_main mt-2 
           position-relative">
              <a data-toggle="collapse" class="collapsed faq_inner bg-white" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
              <span>Does DoctorFindy Take Any Additional Charges for Appointment Booking for {{tests.user.first_name}} {{tests.user.last_name}} Test?</span>
              </a>
              <div class="collapse" id="collapseExample">
                 <div class="card card-body custom_collapse test_faq p-3">
                    <span>We care for your health and value your concerns; therefore, DoctorFindy doesn't charge additional fees for booking an appointment at {{tests.user.first_name}} {{tests.user.last_name}}.</span>
                 </div>
              </div>
           </div>
           <div class="question_main mt-2 
           position-relative">
              <a data-toggle="collapse" class="collapsed faq_inner bg-white" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
              <span>Can I Get My {{tests.user.first_name}} {{tests.user.last_name}} Test Result Online?</span>
              </a>
              <div class="collapse" id="collapseExample1">
                 <div class="card card-body custom_collapse p-3">
                    Yes, why not?
DoctorFindy can provide you with online test results. You can check them through your DoctorFindy account or send them via email.
                 </div>
              </div>
           </div>
           <div class="question_main mt-2 
           position-relative">
              <a data-toggle="collapse" class="collapsed faq_inner bg-white" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
              <span>How Can I Check For {{tests.user.first_name}} {{tests.user.last_name}} Reports Online?</span>
              </a>
              <div class="collapse" id="collapseExample2">
                 <div class="card card-body custom_collapse p-3">
                    DoctorFindy uploads all the test results. You can enter your invoice number and get the code. This code will help you to view your medical report.
                 </div>
              </div>
           </div>
           <div class="question_main mt-2 
           position-relative">
              <a data-toggle="collapse" class="collapsed faq_inner bg-white" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample">
              <span>How to Book an Appointment for {{tests.user.first_name}} {{tests.user.last_name}} Test Online Through DoctorFindy?</span>
              </a>
              <div class="collapse" id="collapseExample3">
                 <div class="card card-body custom_collapse p-3">
                    <span>Booking a test online is a breeze with DoctorFindy. You can use DoctorFindy's official website or DoctorFindy app for online booking. Or, you can contact our customer services team at 0345-0435621. You can get an appointment for {{tests.user.first_name}} {{tests.user.last_name}} at competitive prices through DoctorFindy..</span>
                 </div>
              </div>
           </div>

           <div v-if="tests.averagePrice" class="question_main mt-2 
           position-relative">
              <a data-toggle="collapse" class="collapsed faq_inner bg-white" data-target="#collapseExample5" aria-expanded="false" aria-controls="collapseExample">
              <span>What is the typical price range for a {{tests.title}} Test in different laboratories?</span>
              </a>
              <div class="collapse" id="collapseExample5">
                 <div class="card card-body custom_collapse p-3">
                    <span>On average, you can expect the cost of a {{tests.title}} test to fall within the range of {{tests.averagePrice}} in various laboratories. You can get an appointment for {{tests.user.first_name}} {{tests.user.last_name}} at competitive prices through DoctorFindy..</span>
                 </div>
              </div>
           </div>
        </div>
      </div>
      <div v-for="(lab, index) in testsOtherLab" v-if="index < 2 && lab.user.id !== user.id" class="row">
              <div class="col-12">
              	
                <div class="heading-allergy-immunology mt-xl-0 
                mt-3">
                  <h2 class="text-blue font-weight-bold text_20 text-xs-15" >{{tests.title}} Price in Other Labs</h2>
                </div>
              </div>
            </div>

        <div class="row mb-2">
      <div class="col-12 col-md-6 col-sm-6 col-xl-3 col-lg-4 mb-3" v-for="(lab, index) in testsOtherLab" v-if="index < 5 && lab.user.id !== user.id">
        <div class="test_box bg-white box-shadow p-2 position-relative float-left d-inline-block book-rounded height_box w-100 other-labs">
          <a href="javascript:void(0)" class=" py-2 position-relative d-inline-block w-100">
            <span class="lab_image d-inline-block w-100 text-center">
              <div class="float-left">
                <!-- <img src="/images/chughtai-logo.svg"> -->
                <img v-lazy="basePath+'/uploads/users/'+lab.user.id+'/medium-'+lab.user.profile.avatar" :alt="lab.user.first_name+' '+lab.user.last_name" :name="lab.user.first_name+' '+lab.user.last_name">
              <span class="d-inline-block mt-4">
                <star-rating
                active-color="#0E4D92" 
                :star-size="15"
                :show-rating="false"
                :rating="getAverageRating(lab.user.feedback)"
                :read-only="true"
                >
              </star-rating>
              <span class="number-text d-inline-block ml-2">{{lab.user.feedback.length}}
              </span>
              </span>
              </div>
              <div class="percent_main mb-2 adjust_percentage">
              <span class="d-inline-block book-rounded bg-red text-white text_14 discount-padding">
                20%OFF
              </span>
            </div>
            </span>
          </a>
          <div class="w-100 d-inline-block lab-checkbox">
            <div class="report-facility w-100 d-inline-block mb-1">
              <a v-if="lab.sample_type && lab.sample_type !== null" class="d-inline-block float-left" 
              href="javascript:void(0)">
                <img class="float-left" :src="basePath+'/images/tick-report-icon.svg'">
              </a>
              <a v-else class="d-inline-block float-left" 
              href="javascript:void(0)">
                <img class="float-left" :src="basePath+'/images/cross-report-icon.svg'">
              </a>
              <label class="form-check-label text_12 ml-2 number-text">Home Sampling</label>
            </div>
            <div class="report-facility w-100 d-inline-block mb-1">
              <a v-if="lab.user && lab.user.profile && lab.user.profile.online_report_url !== null" class="d-inline-block float-left" 
              href="javascript:void(0)">
                <img class="float-left" :src="basePath+'/images/tick-report-icon.svg'">
              </a>
              <a v-else class="d-inline-block float-left" 
              href="javascript:void(0)">
                <img class="float-left" :src="basePath+'/images/cross-report-icon.svg'">
              </a>
              <label class="form-check-label text_12 ml-2 number-text">Online Report Facility</label>
            </div>
          </div>
          <a href="javascript:void(0)" 
          class="font-weight-bold text_black test_name text_13 hidden-line">{{lab.title}} at {{lab.user.first_name+' '+lab.user.last_name}}</a>
          <div class="position-relative w-100 d-inline-block">
            <a @click="labData(lab.user, lab.id)" data-toggle="modal" data-target="#testModal" class="text-green text-center float-left d-inline-block book-rounded font-weight-bold text_12 cart-btn">
            <i class="fa fa-arrow-right d-inline-block mr-2" aria-hidden="true"></i>
          Book Test</a>
          <span class="float-right">
            <span class="font-weight-bold text_14">
            <strike class="text-red text_14 ml-1">
              <span class="color-date text_13">Rs.{{lab.price}}</span>
            </strike> 
          </span>
            <span class="font-weight-bold text_15 ml-1">Rs.{{lab.discounted_price}}</span>
            </span>
          </div>
        </div>
      </div>
    </div>
      	<div class="row">
              <div class="col-12">
                <div class="heading-allergy-immunology mt-xl-0 
                mt-3">
                  <h2 class="text-blue font-weight-bold text_20 text-xs-15">Other {{tests.user.first_name+' '+tests.user.last_name}} Tests and Prices</h2>
                </div>
              </div>
            </div>
      	<div class="row mb-2">
      <div class="col-12 col-md-6 col-sm-6 col-xl-3 col-lg-4 mb-3" v-for="(lab, index) in lab_tests">
        <div class="test_box bg-white box-shadow p-2 position-relative float-left d-inline-block book-rounded height_box w-100 other-labs">
          <a href="javascript:void(0)" class=" py-2 position-relative d-inline-block w-100">
            <span class="lab_image d-inline-block w-100 text-center">
              <div class="float-left">
                <!-- <img src="/images/chughtai-logo.svg"> -->
                <img v-lazy="basePath+'/uploads/users/'+lab.user.id+'/medium-'+lab.user.profile.avatar" :alt="lab.user.first_name+' '+lab.user.last_name" :name="lab.user.first_name+' '+lab.user.last_name">
              <span class="d-inline-block mt-4">
                <star-rating
                active-color="#0E4D92" 
                :star-size="15"
                :show-rating="false"
                :rating="getAverageRating(lab.user.feedback)"
                :read-only="true"
                >
              </star-rating>
              <span class="number-text d-inline-block ml-2">{{lab.user.feedback.length}}
              </span>
              </span>
              </div>
              <div class="percent_main mb-2 adjust_percentage">
              <span class="d-inline-block book-rounded bg-red text-white text_14 discount-padding">
                20%OFF
              </span>
            </div>
            </span>
          </a>
          <a href="javascript:void(0)" 
          class="font-weight-bold text_black test_name text_13 hidden-line">{{lab.title}} at {{lab.user.first_name+' '+lab.user.last_name}}</a>
          <div class="position-relative w-100 d-inline-block">
            <a @click="labData(lab.user, lab.id)" data-toggle="modal" data-target="#testModal" class="text-green text-center float-left d-inline-block book-rounded font-weight-bold text_12 cart-btn">
            <i class="fa fa-arrow-right d-inline-block mr-2" aria-hidden="true"></i>
          Book Test</a>
          <span class="float-right">
            <span class="font-weight-bold text_14">
            <strike class="text-red text_14 ml-1">
              <span class="color-date text_13">Rs.{{lab.price}}</span>
            </strike> 
          </span>
            <span class="font-weight-bold text_15 ml-1">Rs.{{lab.discounted_price}}</span>
            </span>
          </div>
        </div>
      </div>
    </div>
		</div>
		
      
    
		<lab-model ref="LabTestModal" :branches="user" :specialitys="specialities" :doctorss="doctors" :hospitalss="hospitals" :diseasess="diseases" :servicess="services" :laboratories="allLaboratories" :cities="allcities" :tests="allTests" :selectlab="lab" :test_id="test_id" :fileSystemDriver="fileSystemDriver"></lab-model>
    <div class="modal" id="discount_modal" tabindex="-1" role="dialog" aria-labelledby="mobile_number_detail" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content box_radius  box_shadow">
          <div class="modal-header p-0 bg-blue">
            <div class="modal_bg w-100 d-inline-block box_radius box_bottom_lr_radius position-relative bg-blue">
              <button type="button" class="close text-white" v-on:click="hideDiscountModal(false)" aria-label="Close" style="opacity: 1 !important;">
                <span aria-hidden="true" style="padding:4px 10px 0 0;display: inline-block;">&times;</span>
              </button>
              <div class="container">
                <div class="heading-doctor-report p-2">
                  <p class="text-white text_14 text-xs-13">Get Discount
                </p>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-body pt-2 pb-2 pl-3 pr-3">
            <form>
              <div class="form-group w-100 float-left 
              d-inline-block mb-2">
                <label class="text_black text_13 font-weight-bold">Name</label>
                <input v-model="name" type="text" class="form-control h_37 text_14 specialities-background" id="nameInputText" aria-describedby="emailHelp" placeholder="Name">
              </div>
              <!-- <div class="form-group mb-2 w-100 d-inline-block float-left">
                <label class="text_black text_15 font-weight-bold">Email</label>
                <input type="password" class="form-control specialities-background h_37" placeholder="Password" id="discount_password">
              </div> -->
              <div class="form-group mb-2 w-100 d-inline-block float-left mb-2">
                <label class="text_black text_13 font-weight-bold">Phone Number</label>
                <input v-model="phone_number"  type="number" class="form-control specialities-background h_37" placeholder="92345-0435621" id="phone"  @input="formatPhoneNumber" onKeyPress="if(this.value.length==12) return false;">
              </div>
              <div class="form-group mb-2 w-100 d-inline-block float-left mb-2">
                <input v-model="home_sampling" type="checkbox" id="home_sampling" true-value="yes" v-on:click="forHomeSampling()">
                <label class="form-check-label" for="home_sampling">For Home Sampling (گھر سے ٹیسٹ کیلئے)</label>
              </div>
              <div id="home-sampling-field">
              <div class="form-group mb-2 w-100 d-inline-block float-left mb-2">
                <label class="text_black text_13 font-weight-bold">Address</label>
                <input v-model="address" type="text" class="form-control specialities-background h_37" placeholder="address" id="phone">
              </div>
              <div class="form-group mb-2 w-100 d-inline-block float-left mb-2">
                <label class="text_black text_13 font-weight-bold">Age</label>
                <input v-model="age" type="number" class="form-control specialities-background h_37" placeholder="Age" id="age">
              </div>
              </div>
              <div class="modal_footer_btn w-85 m-auto d-block w-xs-100 w-sm-100 w-md-100 w-ipad-100">
                <div class="modal_footer_btn w-100 d-inline-flex m-0 float-left mt-1 ml-0 mr-0 mb-0">
                  <div class="cancle-btn doctor-report-btn w-48 float-left mt-2">
                    <a v-on:click="hideDiscountModal(false)" class="book-border text-blue book-rounded w-100 p-2 text-center font-weight-bold d-inline-block">Cancel</a>
                  </div>
                  <div class="submit-btn w-48 float-right ml-2 mt-2">
                    <a href="javascript:void(0)" @click="getDiscount" class="bg-green book-rounded border-green w-100 text-white p-2 text-center font-weight-bold d-inline-block":disabled="submitting">Submit</a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Discount modal End -->

    <div class="modal" id="response_modal" tabindex="-1" role="dialog" aria-labelledby="mobile_number_detail" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content box_radius  box_shadow">
          <div class="modal-header p-0 bg-blue">
            <div class="modal_bg w-100 d-inline-block box_radius box_bottom_lr_radius position-relative bg-blue">
              <button type="button" class="close text-white" v-on:click="hideSummaryDiscountModal(false)" aria-label="Close" style="opacity: 1 !important;">
                <span aria-hidden="true" style="padding:4px 10px 0 0;display: inline-block;">&times;</span>
              </button>
              <div class="container">
                <div v-if="balance < 10" class="heading-doctor-report p-2">
                  <p class="text-white text_14 text-xs-13">Your Discount Code</p>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-body px-0 py-3 w-80 m-auto">
            <form v-if="balance < 10">
              <!-- <div class="verification-text-phone-number float-right d-block mb-2" id="coupon_summary">
               <a class="text_14 float-left text-blue" :href="'/lab/download-discount/'+c_code">Download <img :src="basePath+'/images/final-save.png'" class="img-fluid"></a> 
               <a class="text_14 float-left theme-color-text" href="" @click.prevent="printme" target="_blank">Print <img src="/images/final-print.png" class="img-fluid"></a>
               
              </div> -->
              <div class="form-group w-100 float-left d-inline-block mb-2 border-bottom">
                <label class="text_black text_13 font-weight-bold">Name :   </label>
                <label class="text_black text_13 font-weight-bold float-right">{{c_name}}</label>
                
              </div>
             
              <div class="form-group mb-2 w-100 d-inline-block float-left mb-2 border-bottom">
                <label class="text_black text_13 font-weight-bold">Phone Number :   </label>
                <label class="text_black text_13 font-weight-bold float-right">{{c_phone_number}}</label>
               
              </div>
              <div class="form-group mb-2 w-100 d-inline-block float-left mb-2 border-bottom">
                <label class="text_black text_13 font-weight-bold">Dicount Code :   </label>
                <label class="text_black text_13 font-weight-bold float-right"><b>{{c_code}}</b></label>
               
              </div>
              <div v-if="c_home_sampling !== null">
              <div class="form-group mb-2 w-100 d-inline-block float-left mb-2 border-bottom">
                <label class="text_black text_13 font-weight-bold">Address :   </label>
                <label class="text_black text_13 font-weight-bold float-right">{{c_address}}</label>
               
              </div>
              <div class="form-group mb-2 w-100 d-inline-block float-left mb-2 border-bottom">
                <label class="text_black text_13 font-weight-bold">Age :   </label>
                <label class="text_black text_13 font-weight-bold float-right">{{c_age}}</label>
               
              </div>
              <div class="form-group mb-2 w-100 d-inline-block float-left mb-2 border-bottom">
                <label class="text_black text_13 font-weight-bold">Requested Home Sampling :   </label>
                <label class="text_black text_13 font-weight-bold float-right">{{c_home_sampling}}</label>
               
              </div>
              </div>
              </form>
            <form v-else>
              <div class="w-100 d-inline-block text-center">
                <img src="/images/pop-img.svg">
                <h2 class="text-black font-weight-bold text_25 mt-3 text-xs-20 text-center discount-font-family">
                  شکریہ!
                </h2>
              </div>
              <div class="form-group w-100  
              d-inline-block mb-2">
                <label class="text_black text_15 font-weight-bold text-right discount-font-family">تصدیق کے بعد آپ کے نمبر پر ڈسکاؤنٹ کوڈ بھیج دیا جائے گا، وہ کوڈ کسی بھی چغتائی لیب میں دکھائیں اور لیب ٹیسٹ پر  <span class="text-red text_30 font-weight-bold text_xs_20">%20</span> ڈسکاؤنٹ حاصل کریں </label>
                              
              </div>
              <div class="form-group w-100  
              d-inline-block mb-2">
                <label class="text_black text_15 font-weight-bold text-right discount-font-family">اگر آپ کو اپنا کوپن نمبر موصول نہیں ہوا تو  3 سے 5 منٹ انتظار کریں پھر ہمیں اس نمبر 03450435621 پر کال یا واٹس ایپ پر رابطہ کریں</label>
                              
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="w-100 text-center call-btn d-inline-block">
                    <a class="text_14 text-white d-inline-block font-weight-bold" href="https://wa.me/+923450435621?text=Hello I am looking for Discount code ">
                      <span>
                        <i class="fa fa-whatsapp mr-2 float-left" aria-hidden="true">
                        </i>
                      </span>
                      Whatsapp Us
                    </a>
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
import moment from 'moment';
import StarRating from 'vue-star-rating';
export default {
  name: "labTestingComponent",
  props: ['specialitys', 'servicess', 'cities', 'diseasess', 'doctorss', 'hospitalss', 'laboratories', 'trendingTopics','managements', 'logged_user', 'segments','tests','symptoms','user','lab_tests', 'fileSystemDriver'],
  components: {StarRating},
  data()
  {
  	return {
  		basePath:'',
  		testsOtherLab:[],
  		submitting: false,   
      discountCodeGenerated: false,
  		moment: moment,
      selectedLocation: [],
      specialities: this.specialitys,
      doctors: this.doctorss,
      hospitals: this.hospitalss,
      diseases: this.diseasess,
      services: this.servicess,
      TestsToShow: 6,
      search: '',
      allLaboratories: [],
      allLocations: this.cities,
      allcities: [],
      allTests: [],
      findTests: [],
      id : '',
      lab:null,
      testsCount:'',
      test_id : '',
      loading: false,
      resultSegments: this.segments,
      name: '',
      phone_number: '',
      c_name:'Name',
      c_phone_number:'Phone Number',
      c_address:'Address',
      c_code:"testCode",
      phone_number:'',
      address:'',
      name:'',
      c_home_sampling:null,
      c_age:'',
      home_sampling:'',
      age:'',
      balance: 0,
  	}
  },
  created(){
  	if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com';
      } else {
        // Use local path for development
        this.basePath = '';
      }
   },
  mounted()
  {
  	var lab_name = this.user.first_name +" "+this.user.last_name;
         this.allLaboratories.push({name:lab_name,id:this.user.id});
      this.cities.forEach(fields => {
         this.allcities.push({name:fields.title,id:fields.id})
      });
      this.user.lab_test.forEach(fields => {
         this.allTests.push({name:fields.title,id:fields.id,price:fields.price,discounted_price:fields.discounted_price,labo_id:fields.lab_id})
      });
      this.getTestOtherLabs(this.tests.slug);
      
  },
    methods:
  {
  	 formatPhoneNumber() {
      if (this.phone_number.startsWith('0')) {
        this.phone_number = '92' + this.phone_number.slice(1);
      }
    },
  	closeModal() {
      document.querySelector('#discount_modal').classList.remove('show')
      document.querySelector('body').classList.remove('scroll')
      /*document.querySelector('#doctor-report-modal').style.display = "none"*/
    },
     getDiscount()
    {
    	if (this.submitting) {
		    return;    }
		  this.submitting = true;
      let self = this;
       axios.post(APP_URL + '/labs/get-discount', {
                        phone_number : this.phone_number,
                        name : this.name,
                        address : this.address,
                        age : this.age,
                        home_sampling : this.home_sampling,
                    })
                    .then((response)=> {
                      if(response.data.success===1)
                      {
                      	if (!this.discountCodeGenerated) {
                             this.discountCodeGenerated = true;
                        document.querySelector('#discount_modal').classList.remove('feedback_modle')
                        document.querySelector('body').classList.remove('scroll')
                        document.querySelector('#discount_modal').style.display = 'none'
                         document.querySelector('#response_modal').classList.add('show')
                        document.querySelector('#response_modal').style.display = "block"
                        document.querySelector('#home-sampling-field').style.display = "none"
                         this.c_name = response.data.data.name;
                         this.c_phone_number = response.data.data.phone_number;
                         this.c_address = response.data.data.address;
                         this.c_code = response.data.data.code;
                         this.c_home_sampling = response.data.data.home_sampling;
                         this.c_age = response.data.data.age;
                         this.balance = response.data.balance;
                         this.phone_number = '';
                         this.name = '';
                         this.address = '';
                         this.age = '';
                         this.home_sampling = '';
                           this.$toasted.show("Your request submitted",{
                            type:'success',
                            duration: 2000
                          });
                         }
                      }
                        else{

                          this.$toasted.show(response.data.data,{
                            type:'error',
                            duration: 4000
                          });
                        } 
                    }); 
    },
    forHomeSampling(){
      document.getElementById('home_sampling').onchange = function() {
    document.getElementById('home-sampling-field').style.display = this.checked ? 'block' : 'none';};
    },
  	getTestOtherLabs(slug)
  	{
  		axios.get('/get-test-other-labs-offering/'+slug)
  		.then((response)=>{
  					this.testsOtherLab = response.data;
  		});
  	},
  	showDiscountModal(){
      this.loading = true
      // if(this.patient.length === undefined) {
        document.querySelector('#discount_modal').classList.add('show')
        document.querySelector('body').classList.add('modal-open')
        document.querySelector('#discount_modal').style.display = "block"
      // }
      // else {
      //   Vue.toasted.show('Please Login First' , { duration: 3000 })
      // }
      this.loading = false
    },
    ResponseDiscountModal(){
      this.loading = true
      // if(this.patient.length === undefined) {
        document.querySelector('#response_modal').classList.add('show')
        document.querySelector('#response_modal').style.display = "block"
      // }
      // else {
      //   Vue.toasted.show('Please Login First' , { duration: 3000 })
      // }
      this.loading = false
    },
    hideDiscountModal(e) {
      this.loading = true
      document.querySelector('#discount_modal').classList.remove('feedback_modle')
      document.querySelector('body').classList.remove('modal-open')
      document.querySelector('#discount_modal').style.display = 'none'
      this.discountCodeGenerated = false;
      this.loading = false
    },
   
    // hideSummaryDiscountModal(e) {
    //   this.loading = true
    //   document.querySelector('#response_modal').classList.remove('feedback_modle')
    //   document.querySelector('body').classList.remove('scroll')
    //   document.querySelector('#response_modal').style.display = 'none'
    //   this.discountCodeGenerated = false;
    //   this.loading = false
    // },
    hideSummaryDiscountModal(e) {
      this.loading = true
      document.querySelector('body').classList.remove('modal-open')
      document.querySelector('#response_modal').style.display = 'none'
      this.discountCodeGenerated = false;
      this.loading = false
    },
    showAddReview(e) {
      this.loading = true
      document.querySelector('#discount_modal').classList.remove('feedback_modle')
      document.querySelector('body').classList.remove('scroll')
      document.querySelector('#discount_modal').style.display = 'none'
      this.loading = false
    },
  	getAverageRating(feedback)
    {
      if (feedback.length > 0) {
        let totalRating = 0;

        for (let i = 0; i < feedback.length; i++) {
          totalRating += feedback[i].avg_rating;
        }

        const averageRating = totalRating / feedback.length;
        return averageRating;
      } else {
        return 0;
      }
      
    },
  	labData(data,id){
          
      this.lab = data;
      this.test_id =id;
    },
       }
};

</script>

<style>
.lab-collapse .card-body{
	background-color: #DBE5FF;
    font-size: 13px;
}
.cart-icon-image:hover .toltip-box{
    opacity: 1;
    pointer-events: auto;
    z-index: 1;
}
.cart-btn{
    border: 1.5px solid #B3B3B3;
    padding: 6px 10px;
}
.cart-btn:hover {
    background-color: #088F8F;
    color: #fff !important;
}
.toltip-box span{
    top: 14px;
    left: 50px;
}
.lab-sample-image img, .lab-report-image img{
height: 55px;
    width: 55px;
    display: inline-block;
    border-radius: 50%;
}
#home-sampling-field{
  display: none;
}
.cart-icon-image .toltip-box{
display: block;
    opacity:0;
    -webkit-transition: all 400ms ease-in;
    -moz-transition: all 400ms ease-in;
    -ms-transition: all 400ms ease-in;
    -o-transition: all 400ms ease-in;
    transition: all 400ms ease-in;
    pointer-events: none;
    top:-36px;
    border-radius: 5px;
    right:-28px;
    position: absolute;
    border: 1px solid #9f9f9f;
    width: 100px;
}
.add-cart-btn{
    margin-top:37px;
}
.cart-icon-image img{
    height:15px;
}
.cart-icon-image .cart-icon{
    padding:7px !important;
    border: 1.5px solid #8b8b8b;
}
.add-cart-btn a{
    padding: 7px 15px;
}
.book-lab-image img{
    height:110px;
}
.bg-lab-test{
    background-color: #CFEEFF;
}
.chughtai-logo img{
    height: 45px;
    width: 45px;
    display: inline-block;
    border-radius: 50%;
}
.lab-test-inner[data-toggle="collapse"].collapsed:after{
    transform: rotate(0deg) !important;
    float: right;
    content:"\f107"!important;
    font-size: 18px!important;
    color: #243562;
    top: 4px;
    right:10px;
}
.lab-test-inner[data-toggle="collapse"]:after{
   transform: rotate(180deg) !important;
    float: right;
    content: "\f107"!important;
    font-size: 18px!important;
    color: #243562;
    right:10px;
}
.report-facility a{
  width: 13px;
    height: 13px;
    border: 1.5px solid #45444466;
    padding-left: 2px;
    padding-top: 2px;
    margin-top: 4px;
    border-radius: 3px;
}
.report-facility a img{
  height: 6px;
}
.discount-icon{
  width: 22px;
    height: 22px;
    border-radius: 50%;
    top: -5px;
    right: -6px;
    padding:0 !important;
}
.discount-icon span{
margin-left: 1px;
}
.discount-icon span img{
  height: 15px;
}


</style>