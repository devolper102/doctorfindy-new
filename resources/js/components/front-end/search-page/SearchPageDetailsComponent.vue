<template>
  <div>
    <section class="doctor-city d-inline-block w-100">
      <div class="container">
        <h2 class="pt-4 text_18 text-xs-14 font-weight-bold mb-0" v-if=" resultService.length !== 0 && resultDisease.length === 0 && resultSpeciality.length === 0 && resultService.description!==null">A brief intro to {{ resultService.title }}?</h2>
        <!-- <h2 class="pt-4 text_18 text-xs-14 font-weight-bold mb-0" v-else-if=" resultService.length === 0 && resultDisease.length !== 0 && resultSpeciality.length === 0 && resultDisease.description!==null">A brief intro to {{ resultDisease.title }}?</h2> -->
        <!-- <h2 class="pt-4 text_18 text-xs-14 font-weight-bold mb-0" v-else>A brief intro to {{ details.title }}?
        </h2> -->
        <!-- <div class="doctor-description w-80 d-inline-block mt-4 w-xs-100 pl-2 pl-lg-0">
          <span  v-html="details.description"></span>
        </div> -->
        <!-- <div v-if="resultDisease.length!==0 && resultService.length===0 && resultSpeciality.length===0 && resultDisease.description!==null" class="doctor-description w-100 d-inline-block mt-4 w-xs-100 pl-2 pl-lg-0">
          <span  v-html="resultDisease.description"></span>
        </div> -->
        <div v-else-if="resultDisease.length===0 && resultService.length!==0 && resultSpeciality.length===0 && resultService.description!==null" class="doctor-description w-100 d-inline-block mt-4 w-xs-100 pl-2 pl-lg-0">
          <span v-html="resultService.description"></span>
        </div>
        <!-- <div v-else class="doctor-description w-100 d-inline-block mt-4 w-xs-100 pl-2 pl-lg-0">
          <span v-html="details.description"></span>
        </div> -->
        <div class="row">
        <div v-if="details.faqs_assign" class="col-12">
          <div class="accordion md-accordion" v-if="this.resultSpeciality.length > 0 || this.resultSpeciality.length === undefined">
            <!-- Accordion card -->
            <div class="card border-0">

              <!-- Card header -->
              <div class="p-0 heading-doctor-city-pakistan">
                <div href="javascript:void(0)" class="pt-2 pb-0 d-inline-block w-100 main-faq text_15">
                  <h2 class="w-90 d-inline-block text_18 text-xs-16 text-blue font-weight-bold">Frequently Asked Questions
                  </h2>
                </div>
                <!-- <div role="separator" class="dropdown-divider d-inline-block w-100 custom_divider"></div> -->
              </div>
              <!-- Card body -->
              <div v-if="details.faqs_assign" id="doctors_in_karachi">
                <div class="pt-0 pb-2">
                  <div class="accordion" id="FaqS">
                    <div class="card border-0 bg-white box_radius box-shadow mt-2" v-if="faq.faqs" v-for="(faq, index) in details.faqs_assign">
                      <div class="card-header pl-3 pt-2 bg-white border-0 faq_accordian" :id="'faq_one_heading'+faq">
                        <h6 class="mb-0">
                          <a href="#" class="text_black p-0 text-left w-100 collapsed" data-toggle="collapse" :data-target="'#first_faq'+index" aria-expanded="true" aria-controls="first_faq">
                            <span v-html="(JSON.parse(faq.faqs.description))[0].find_replace() " class="w-100 d-inline-block service-text"></span>
                          </a>
                        </h6>
                      </div>
                      <div :id="'first_faq'+index" class="collapse" :aria-labelledby="'faq_one_heading'+faq" data-parent="#FaqS">
                        <div class="card-body p-0 mt-xl-3 mt-1 mb-xl-3 mb-1 faq_details p-2 pl-3">
                          <span v-html="(JSON.parse(faq.faqs.description))[1].find_replace()"></span>
                          <span v-if="index === 4">
                            <span v-for="(user,index) in users">
                          <span
                            v-if="user.roles[0] !== undefined">
                            <span v-if="(user.roles[0].name   === 'doctor') && index < 10" class="w-90 d-inline-block">{{user.first_name}} {{user.last_name}} </span></span>
                            </span>
                          </span>
                        </div>
                      </div>
                      <div role="separator" class="dropdown-divider d-inline-block w-100 custom_divider"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Accordion card -->
          </div>
          <div class="accordion md-accordion" id="Karachi" role="tablist" aria-multiselectable="true" v-else>
            <!-- Accordion card -->
            <div class="card border-0">

              <!-- Card header -->
              <div class="p-0 heading-doctor-city-pakistan" role="tab" id="karachi_doctors">
                <a href="#" class="p-2 d-inline-block w-100 collapsed main-faq text_15">
                  <h2 class="w-90 d-inline-block text_18 text-xs-16 text-blue font-weight-bold mb-0">Frequently Asked Questions 
                  </h2>
                </a>
              </div>
              <!-- Card body -->
              <div v-if="details.faqs_assign.length > 0">
                <div class="card-body p-2">
                  <div class="accordion" id="FaqS">
                    <div class="card border-0 bg-white box_radius box-shadow mt-2" v-for="(faq, index) in details.faqs_assign">
                      <div class="card-header border-0 faq_accordian 
                      bg-white" :id="'faq_one_heading'+index">
                        <h6 class="mb-0">
                          <a href="#" class="text_black p-0 text-left w-100 collapsed pt-2 pb-2" data-toggle="collapse" :data-target="'#first_faq'+index" aria-expanded="true" aria-controls="first_faq">
                            <span v-html="(JSON.parse(faq.faqs.description))[0].find_replace_service() " 
                            class="w-90 d-inline-block service-text 
                            text_15"></span>
                          </a>
                        </h6>
                      </div>
                      <div :id="'first_faq'+index" class="collapse" :aria-labelledby="'faq_one_heading'+faq" data-parent="#FaqS">
                        <div class="card-body mt-xl-2 mt-1 mb-xl-2 mb-1 p-2 pl-3 faq_details">
                          <span class="text_14" v-html="(JSON.parse(faq.faqs.description))[1].find_replace_service()"></span>
                          <span class="text_14" v-if="index === 4">
                            <span class="text_14" v-for="(user,index) in users">
                          <span class="w-90 d-inline-block text_14"  v-if="user.roles[0] !== undefined"><span v-if=" (user.roles[0].name   === 'doctor') && index < 10">{{user.first_name}} {{user.last_name}} </span></span>
                          </span>
                          </span>
                        </div>
                      </div>
                      <div data-v-7645c7bc="" role="separator" class="dropdown-divider d-inline-block w-100 custom_divider"></div>
                    </div>
                  </div>
                </div>
              </div>

                <div v-else>
                <div class="card-body bg-white p-2">
                  <div class="accordion" id="FaqS">
                    <div class="card border-0">
                  <!-- First question -->
                      <div class=" pl-0 pt-2 pb-2 bg-white border-0 faq_accordian" :id="'faq_one_heading'">
                        <h6 class="mb-0">
                          <a href="#" class="text_black p-0 text-left w-100 collapsed pt-2 pb-2" data-toggle="collapse" :data-target="'#first_faq'" aria-expanded="true" aria-controls="first_faq">
                            <span class="w-90 d-inline-block service-text text_15">
                              How can I book an appointment with a doctor for  {{details.title}} <span v-if="resultLocation!=='pakistan'">in {{resultLocation}}, Pakistan?</span><span v-else>?</span>
                            </span>
                          </a>
                        </h6>
                      </div>
                      <div :id="'first_faq'" class="collapse" :aria-labelledby="'faq_one_heading'">
                        <div class="card-body p-0 mb-3 faq_details">
                          <span class="text_14">
                            <p><a href="">Click here</a> to book an appointment with a top {{details.title}} Doctor <span v-if="resultLocation!=='pakistan'">in {{resultLocation}}, Pakistan</span><span v-else>in Pakistan</span>. Or, you can also call at <a href="tel:0345-0435621">0345-0435621</a> from 9AM to 11PM to book your appointment.</p>
                          </span>
                        </div>
                      </div>
                      <!-- Second question -->

                      <div class=" pl-0 pt-2 pb-2 bg-white border-0 faq_accordian" :id="'faq_two_heading'">
                        <h6 class="mb-0">
                          <a href="#" class="text_black p-0 text-left w-100 collapsed pt-2 pb-2" data-toggle="collapse" :data-target="'#second_faq'" aria-expanded="true" aria-controls="second_faq">
                            <span class="w-90 d-inline-block service-text text_15">
                              What is the fee range of the best doctors for {{details.title}} <span v-if="resultLocation!=='pakistan'">in {{resultLocation}}, Pakistan?</span><span v-else>?</span>
                            </span>
                          </a>
                        </h6>
                      </div>
                      <div :id="'second_faq'" class="collapse" :aria-labelledby="'faq_two_heading'">
                        <div class="card-body p-0 mb-3 faq_details">
                          <span class="text_14">
                            <p>The fee for top {{details.title}} Doctors <span v-if="resultLocation!=='pakistan'">in {{resultLocation}}, Pakistan</span><span v-else>in Pakistan</span> ranges from 500 to 3000. You will pay at the reception when you visit the doctor.</p>
                          </span>
                        </div>
                      </div>

                      <!-- third question -->
                      <div class=" pl-0 pt-2 pb-2 bg-white border-0 faq_accordian" :id="'faq_three_heading'">
                        <h6 class="mb-0">
                          <a href="#" class="text_black p-0 text-left w-100 collapsed pt-2 pb-2" data-toggle="collapse" :data-target="'#third_faq'" aria-expanded="true" aria-controls="third_faq">
                            <span class="w-90 d-inline-block service-text text_15">
                              Are there any additional charges to book an appointment with doctors for {{details.title}} <span v-if="resultLocation!=='pakistan'">in {{resultLocation}}, Pakistan</span><span v-else>Pakistan</span> <a href="/">doctorfindy.com</a>?
                            </span>
                          </a>
                        </h6>
                      </div>
                      <div :id="'third_faq'" class="collapse" :aria-labelledby="'faq_three_heading'">
                        <div class="card-body p-0 mb-3 faq_details">
                          <span class="text_14">
                            <p>There will be no additional charges when you book appointment through <a href="/">doctorfindy.com</a></p>
                          </span>
                        </div>
                      </div>

                      <!-- four question -->
                      <div class=" pl-0 pt-2 pb-2 bg-white border-0 faq_accordian" :id="'faq_four_heading'">
                        <h6 class="mb-0">
                          <a href="#" class="text_black p-0 text-left w-100 collapsed pt-2 pb-2" data-toggle="collapse" :data-target="'#forth_faq'" aria-expanded="true" aria-controls="forth_faq">
                            <span class="w-90 d-inline-block service-text text_15">
                              Can I book an online video consultation with the best doctor for {{details.title}} ? </span>
                          </a>
                        </h6>
                      </div>
                      <div :id="'forth_faq'" class="collapse" :aria-labelledby="'faq_four_heading'">
                        <div class="card-body p-0 mb-3 faq_details">
                          <span class="text_14">
                            <p>Yes, you can book an online video consultation with the best doctors near you .Find the list of top doctors near you providing online consultation or call at <a href="tel:0345-0435621">0345-0435621</a></p>

                          </span>
                        </div>
                      </div>

                        <!-- four question -->
                      <div class=" pl-0 pt-2 pb-2 bg-white border-0 faq_accordian" :id="'faq_five_heading'">
                        <h6 class="mb-0">
                          <a href="#" class="text_black p-0 text-left w-100 collapsed pt-2 pb-2" data-toggle="collapse" :data-target="'#fifth_faq'" aria-expanded="true" aria-controls="fifth_faq">
                            <span class="w-90 d-inline-block service-text">
                               Who is the best doctor for {{details.title}} <span v-if="resultLocation!=='pakistan'">in {{resultLocation}}, Pakistan?</span><span v-else>?</span> </span>
                          </a>
                        </h6>
                      </div>
                      <div :id="'fifth_faq'" class="collapse" :aria-labelledby="'faq_five_heading'">
                        <div class="card-body p-0 mb-3 faq_details">
                          <p class="text_14">Top doctors for {{details.title}} <span v-if="resultLocation!=='pakistan'">in {{resultLocation}}, Pakistan are below:</span><span v-else>are below:</span></p>
                          <span class="text_14">
                            <ul v-for="(user,index) in users" v-if="index<9">
                              <a :href="'/doctors/'+user.location.slug+'/'+user.specialities[0].slug+'/'+user.slug">
                                <li>{{user.first_name}} {{user.last_name}}</li>
                              </a>

                            </ul>

                          </span>
                        </div>
                      </div>
                      
                      <div data-v-7645c7bc="" role="separator" class="dropdown-divider d-inline-block w-100 custom_divider"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Accordion card -->
          </div>
        </div>
      </div>
      </div>
      <helpLine-consultation-section>
    </helpLine-consultation-section>
      <div class="container">
      <!-- Related diseases -->
       <div v-if="resultSpeciality.length !== 0 && resultSpeciality.diseases.length !== 0" class="w-100 d-inline-block mt-3">
            <div class="row">
              <div class="col-12">
                <div class="heading-allergy-immunology">
                  <h2 class="text-blue text_20 text-xs-15 font-weight-bold">Related Diseases</h2>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <ul class="disease-allergy-immunology w-100 d-inline-block patient-date mb-0">
                  <li v-for="disease in resultSpeciality.diseases" class=" mr-lg-3 mb-3 w-md-48 float-left">
                    <a class="pt-1 pb-1 pl-2 pr-2 text_black d-inline-block w-100" :href="'/diseases/'+disease.slug">{{ disease.title }}
                    </a>
                  </li>
                </ul>
              </div>
            </div>
        </div>
        <!-- End -->
<!-- Related hospitals -->

          <div v-if="resultSpeciality.length !== 0 && users.length !==0" class="w-100 d-inline-block">
            <div class="row">
              <div class="col-12">
                <div class="heading-allergy-immunology">
                  <h2 class="text-blue text_20 text-xs-15 font-weight-bold">{{details.title}} in Hospitals Near You</h2>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <ul class="disease-allergy-immunology w-100 d-inline-block patient-date 
                hospital-section mb-0">
                  <li v-for="user in users" class=" mr-lg-3 mb-3 w-md-48 float-left" v-if="user && user.doc_teams">
                    <a v-for="docteam in user.doc_teams" class="pt-1 pb-1 pl-2 pr-2 text_black d-inline-block mr-3" :href="'/hospitals/'+user.location.slug+'/'+docteam.hospital.slug">{{docteam.hospital.first_name + ' ' + docteam.hospital.last_name }}
                    </a>
                  </li>
                </ul>
              </div>
            </div>
        </div>

<!-- End -->
<!-- Related Areas of speciality -->

          <div v-if="resultSpeciality.length !== 0" class="w-100 d-inline-block">
            <div v-if="location_areas!==null" class="row">
              <div class="col-12">
                <div class="heading-allergy-immunology">
                  <h2 class="text-blue text_20 text-xs-15 font-weight-bold">{{resultSpeciality.title}} in Areas Near You</h2>
                </div>
              </div>
            </div>
            <div class="row" v-if="location_areas!==null">
              <div class="col-12">
                <ul class="disease-allergy-immunology w-100 d-inline-block patient-date 
                hospital-section mb-0">
                  <li v-for="area in location_areas" class=" mr-lg-3 mb-3 w-md-48 float-left">
                    <a class="pt-1 pb-1 pl-2 pr-2 text_black d-inline-block" :href="'/doctor/specialities/'+resultLocation+'/'+resultSpeciality.slug+'/'+area.slug">
                     Best {{resultSpeciality.title}} in {{area.title}}
                    </a>
                  </li>
                </ul>
              </div>
            </div>
        </div>

<!-- End -->
<!-- Labs in cities -->
          <div v-if="this.cities.length > 0" class="w-100 d-inline-block">
            <div class="row mt-2">
              <div class="col-12">
                <div class="heading-allergy-immunology">
                  <h2 class="text-blue text_20 text-xs-15 font-weight-bold">Top Cities Labs</h2>
                </div>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-12">
                <ul class="disease-allergy-immunology w-100 d-inline-block patient-date mb-0">
                  <li v-for="city in cities" class="mr-lg-3 mb-3 w-md-48 float-left">
                    <a class="pt-1 pb-1 pl-2 pr-2 text_black d-inline-block w-100" :href="'/labs/'+city.slug">Labs in {{city.title}}</a>
                  </li>
                </ul>
              </div>
            </div>
        </div>

       <!--   <div v-if="this.cities.length > 0" class="w-100 d-inline-block mb-3">
            <div class="row">
              <div class="col-12">
                <div class="heading-allergy-immunology">
                  <h2 class="text_black text_18 text-xs-14 font-weight-bold">Radiology and Pathology Labs</h2>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <ul class="disease-allergy-immunology w-100 d-inline-block patient-date mb-0">
                  <li v-for="lab in labs" class=" mr-lg-3 mb-3 w-md-48 text-center d-table float-left">
                    <a class="pt-1 pb-1 pl-2 pr-2 text_black d-table-cell align-middle" :href="'/lab/'+lab.location.slug+'/'+lab.slug">{{lab.first_name+' '+lab.last_name}}</a>
                  </li>
                </ul>
              </div>
            </div>
        </div> -->
      </div>
<!-- End -->

<!-- Best doctors in cities -->
      <!-- <div class="w-100 pb-2" v-if="specialities.length !== 0 && cities.length!==0">
        <div class="container-fluid">
          <div class="row">
            <div v-for="(location, index) in cities" v-if="location.top === '1' && index < 6" class="col-lg-3 col-md-4 col-12 col-sm-6 mt-lg-0 mt-md-0 mb-0 mb-lg-3 mb-md-3 mt-4">
              <div class="accordion md-accordion visible" :id="'doctor_cities_'+location.slug" role="tablist" aria-multiselectable="true">
               
                <div class="card_main card border-0">

            
                  <div class="card-header p-0 heading-doctor-city-pakistan bg-white" role="tab" :id="location.slug">
                    <a data-toggle="collapse" :data-parent="'#doctor_cities_'+location.slug" :href="'#doctors_in_'+location.slug" aria-expanded="true" :aria-controls="'#doctors_in_'+location.slug" class="p-2 d-inline-block w-100 collapsed pl-0 pr-0 text_black font-weight-bold">Doctors in {{ location.title }}</a>
                  </div>
                  
                  <div :id="'doctors_in_'+location.slug" class="collapse show" role="tabpanel" :aria-labelledby="location.slug" :data-parent="'#doctor_cities_'+location.slug">
                    <div class="card-body p-2">
                      <ul class="navbar-nav doctor-hospital-city">
                        <li v-for="specialty in specialities" class="nav-item">
                          <a class="nav-link p-0 text_black" :href="'/'+specialty.slug+'-in-'+location.slug">Best 
                            {{ specialty.title }} in {{ location.title }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link p-0 text_black" :href="'/lab-tests-in-'+location.slug">
                            Book a Lab Test in {{ location.title }}</a>
                        </li>
                      </ul>
                    </div>
                  </div>

                </div>
                
              </div>
            </div>
                 
            <div class="col-lg-3 col-md-4 col-12 col-sm-6 mt-lg-0 mt-md-0 mb-0 mb-lg-3 mb-md-3">
              <div class="accordion md-accordion visible" :id="'doctor_cities_pakistan'" role="tablist" aria-multiselectable="true">
               
                <div class="card_main card border-0">

                
                  <div class="card-header p-0 heading-doctor-city-pakistan bg-white" role="tab" :id="'doctor_cities_pakistan'">
                    <a data-toggle="collapse" :data-parent="'#doctor_cities_pakistan'" :href="'#doctors_in_pakistan'" aria-expanded="true" :aria-controls="'#doctors_in_pakistan'" class="p-2 d-inline-block w-100 collapsed pl-0 pr-0 text_black font-weight-bold">Book a Lab Test in Pakistan</a>
                  </div>
                 
                  <div :id="'doctors_in_pakistan'" class="collapse show" role="tabpanel" :aria-labelledby="'Pakistan'" :data-parent="'#doctor_cities_pakistan'">
                    <div class="card-body p-2">
                      <ul class="navbar-nav doctor-hospital-city">
                        <li v-for="city in cities_pakistan" class="nav-item">
                          <a class="nav-link p-0 text_black" :href="'/lab-tests-in-'+city.slug">
                            Book a Lab Test in {{ city.title }}</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link p-0 text_black" :href="'/book-a-lab-test'">
                            Book a Lab Test in Pakistan</a>
                        </li>
                      </ul>
                    </div>
                  </div>

                </div>
                
              </div>
            </div>
           
            <div class="col-lg-3 col-md-4 col-12 col-sm-6 mt-lg-0 mt-md-0 mb-0 mb-lg-3 mb-md-3">
              <div class="accordion md-accordion visible" :id="'lab_in_pakistan'" role="tablist" aria-multiselectable="true">
              
                <div class="card_main card border-0">

              
                  <div class="card-header p-0 heading-doctor-city-pakistan bg-white" role="tab" :id="'lab_in_pakistan'">
                    <a data-toggle="collapse" :data-parent="'#lab_in_pakistan'" :href="'#labs_in_pakistan'" aria-expanded="true" :aria-controls="'#labs_in_pakistan'" class="p-2 d-inline-block w-100 collapsed pl-0 pr-0 text_black font-weight-bold">Top Labs in Pakistan</a>
                  </div>
               
                  <div :id="'labs_in_pakistan'" class="collapse show" role="tabpanel" :aria-labelledby="'lab_in_pakistan'" :data-parent="'#lab_in_pakistan'">
                    <div class="card-body p-2">
                      <ul class="navbar-nav doctor-hospital-city">
                        <li v-for="city in cities" class="nav-item">
                          <a class="nav-link p-0 text_black" :href="'/labs/'+city.slug">Best 
                            Labs in {{ city.title }}</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link p-0 text_black" :href="'/find-a-lab-near-you'">View all 
                            Labs in Pakistan</a>
                        </li>
                      </ul>
                    </div>
                  </div>

                </div>
                
              </div>
            </div>
          </div>
 -->
           <!--  <div class="col-lg-3 col-md-6 col-12 col-sm-6 mt-5">
              <div class="accordion md-accordion" id="Lahore" role="tablist" aria-multiselectable="true">

                <div class="card_main card border-0">

                  
                  <div class="card-header p-0 heading-doctor-city-pakistan" role="tab" id="lahore_doctors">
                    <a data-toggle="collapse" data-parent="#Lahore" href="#doctors_in_lahore" aria-expanded="true" aria-controls="doctors_in_lahore" class="p-2 d-inline-block w-100 collapsed bg-white main-faq">A brief intro to {{ details.title }}?</a>
                  </div>
                  
                  <div id="doctors_in_lahore" class="collapse" role="tabpanel" aria-labelledby="lahore_doctors" data-parent="#Lahore">
                    <div class="card-body bg-white p-2">
                      <ul class="navbar-nav doctor-hospital-city">
                        <li class="nav-item">
                          <span class=" p-0" v-html="details.description"></span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
             
              </div>
            </div> -->
            <!-- <div v-if="details.services" class="col-lg-4 col-md-6 col-12 col-sm-6 mt-lg-5 mt-2">
              <div class="accordion md-accordion" id="Islamabad" role="tablist" aria-multiselectable="true">
 -->                <!-- Accordion card -->
                <!-- <div class="card_main card border-0 box_radius"> -->
                  <!-- Card header -->
                 <!--  <div class="card-header p-0 heading-doctor-city-pakistan bg-white" role="tab" id="islamabad_doctors">
                    <a data-toggle="collapse" data-parent="#Islamabad" href="#doctors_in_islamabad" aria-expanded="true" aria-controls="doctors_in_islamabad" class="p-2 d-inline-block w-100 collapsed  main-faq text_15">
                      <span class="w-90 d-inline-block mb-lg-0 mb-1">Related Conditions</span></a>
                  </div> -->
                  <!-- Card body -->
                  <!-- <div id="doctors_in_islamabad" class="collapse" role="tabpanel" aria-labelledby="islamabad_doctors" data-parent="#Islamabad">
                    <div class="card-body bg-white p-2">
                      <ul class="navbar-nav doctor-hospital-city">
                        <span v-if="details.services.length" v-for="service in details.services">
                          <li class="nav-item" v-for="symptom in service.symptoms" v-if="service.symptoms.length">
                            <a class="text_black p-0" > {{ symptom.title }} </a>
                          </li>
                        </span>
                        <span v-else>No conditions</span>
                      </ul>
                    </div>
                  </div> -->
                <!-- </div> -->
                <!-- Accordion card -->
              <!-- </div>
            </div> -->
            <!-- <div v-if="details.users" class="col-lg-4 col-md-6 col-12 col-sm-6 mt-lg-5 mt-2">
              <div class="accordion md-accordion" id="doctor_cities" role="tablist" aria-multiselectable="true"> -->
                <!-- Accordion card -->
                <!-- <div class="card_main card border-0"> -->

                  <!-- Card header -->
                  <!-- <div class="card-header p-0 heading-doctor-city-pakistan bg-white" role="tab" id="other_cities">
                    <a data-toggle="collapse" data-parent="#doctor_cities" href="#doctors_in_other_cities" aria-expanded="true" aria-controls="doctors_in_other_cities" class="p-2 d-inline-block w-100 collapsed main-faq text_15"><span class="w-90 d-inline-block mb-lg-0 mb-1"> Hospitals in {{ details.title }} near you</span></a>
                  </div> -->
                  <!-- Card body -->
                 <!--  <div id="doctors_in_other_cities" class="collapse" role="tabpanel" aria-labelledby="other_cities" data-parent="#doctor_cities">
                    <div class="card-body bg-white p-2">
                      <span v-if="details.users.length">
                      <ul class="navbar-nav doctor-hospital-city">
                        <li class="nav-item" v-for="(user,index) in details.users" v-if="user.roles != undefined">
                          <a v-if=" user.roles[0].name === 'hospital' && index < 10" class="text_black p-0" :href="'/profile/'+user.slug">
                            {{user.first_name}} {{user.last_name}} 
                          </a>
                        </li>
                      </ul>
                      </span>
                      <span v-else>
                        No hospitals
                      </span>
                    </div>
                  </div> -->

                <!-- </div> -->
                <!-- Accordion card -->
              <!-- </div>
            </div> -->
          <!--   <div v-if="details.users" class="col-lg-4 col-md-6 col-12 col-sm-6 mt-lg-5 mt-2">
              <div class="accordion md-accordion" id="Peshawar" role="tablist" aria-multiselectable="true"> -->
                <!-- Accordion card -->
                <!-- <div class="card_main card border-0"> -->

                  <!-- Card header -->
                  <!-- <div class="card-header p-0 heading-doctor-city-pakistan bg-white" role="tab" id="peshawar_doctors">
                    <a data-toggle="collapse" data-parent="#Peshawar" href="#doctors_in_peshawar" aria-expanded="true" aria-controls="doctors_in_peshawar" class="p-2 d-inline-block w-100 collapsed main-faq text_15">
                      <span class="w-90 d-inline-block mb-lg-0 mb-1"> Doctors in {{ details.title }} near you</span></a>
                  </div> -->
                  <!-- Card body -->
                  <!-- <div id="doctors_in_peshawar" class="collapse" role="tabpanel" aria-labelledby="peshawar_doctors" data-parent="#Peshawar">
                    <div class="card-body bg-white p-2">
                      <span v-if="users.length">
                      <ul class="navbar-nav doctor-hospital-city">
                        <li class="nav-item" v-for="(user,index) in users" v-if="user.roles != undefined">
                          <a class="text_black p-0 " v-if="(user.roles[0].name   === 'doctor') && index < 10" :href="'/doctors/'+user.location.slug+'/'+user.specialities[0].slug+'/'+user.slug" >
                            {{user.first_name}} {{user.last_name}} 
                          </a>
                        </li>
                      </ul>
                    </span>
                    <span v-else>
                        No doctors
                    </span>
                    </div>
                  </div> -->

                <!-- </div> -->
                <!-- Accordion card -->
              <!-- </div>
            </div> -->
        <!-- </div>
      </div> -->
    </section>
  </div>
</template>

<script>
var currentLocation = window.location.pathname;
var asd = currentLocation.split('/');
var locationSlug = '';
if(asd[1] == 'diseases'){
var diseaseTreatment = asd[1].replace('diseases','disease');
}
if(asd[1] == 'treatments'){
var diseaseTreatment = asd[1].replace('treatments','treatment');
}
if(asd[3]){
  locationSlug = asd[3]+' ';
}
var slug = asd[2]+' '+diseaseTreatment+' in '+locationSlug+'Pakistan';
slug = slug.replace(/-/g, ' '); 
var onboard='';
var current = currentLocation.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, ' ');
var current_new = currentLocation.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
String.prototype.find_replace = function() {
    return this.replace(/Slug in City/g,current);;
}
String.prototype.find_replace_service = function() {
    let a = this.replace(/SlugBoth in City/g,slug).replace(/onboard_doctors/g,onboard);
    return a;
}

export default {
  name: "SearchPageDetailsComponent",
  props: ['users', 'resultLocation', 'resultService', 'resultDisease', 'resultSpeciality','cities','specialities','labs','cities_pakistan','location_areas'],
  data() {
    return {
      details: [],

    }
  },
  created () {
    this.searchTypeCheck();
  },
  mounted () {
  },
  methods:{
    searchTypeCheck () {
      // if(this.resultLocation.length > 0  || this.resultLocation.length === undefined) {
      //   this.details = this.resultLocation
      // }
      if(this.resultService.length > 0 || this.resultService.length === undefined) {
        this.details = this.resultService
      }
      if(this.resultDisease.length > 0  || this.resultDisease.length === undefined) {
        this.details = this.resultDisease;
      }
      if(this.resultSpeciality.length > 0 || this.resultSpeciality.length === undefined) {
        this.details = this.resultSpeciality
        
      }
    
    }
  }

}
</script>

<style>
.doctor-description ul{
 padding-left: 45px;
    padding-top: 10px;
    margin-bottom:10px;
    width: 100%;
    display: inline-block;
}
.doctor-description h3{
  font-size: 16px;
  margin-bottom:15px;
  width: 100%;
    display: inline-block;
    font-weight:bold;
}
.doctor-description ul li{
list-style: disc;
    padding-bottom: 10px;
    float: left;
    margin-right: 30px;
}
.doctor-description ul li::marker{
    color: #06D6A0;
    font-weight: 700;
}
.doctor-description p{
  padding-bottom:10px;
}
.doctor-description p a{
  color: #ff5851;
  font-weight: bold;
}


</style>