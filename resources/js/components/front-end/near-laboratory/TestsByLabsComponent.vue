<template>
  
  <div class="top-content">
    <div v-if="tests_meta && tests_meta.introduction" class="row">
      <div id="introduction-test" class="col-12">
        <div class="w-100 d-inline-block mt-3">
         <h2 class="text-blue text_25 text-xs-22">
        Introduction of the {{tests_meta.title}}
      </h2>
      <span class="text_black text_14">
        {{tests_meta.introduction}}
      </span>
      <a class="text-blue text_13 font-weight-bold" href="javascript:void(0)" 
        @click="toggleDescription">
            Read More
          </a>
      </div>
    </div>
    <!-- <div class="w-100 d-inline-block text-center">
        <a class="text-blue text_13 font-weight-bold" href="javascript:void(0)" 
        @click="toggleDescription">
            Read More
          </a>
      </div> -->
  </div>
  <div class="row">
    <div class="col-12">
      <div class="w-100 d-inline-block mt-3">
          <span class="w-100 d-inline-block text-blue text_18 font-weight-bold text-center">
            We compare, you save
          </span>
          <p class="text_black text_14">
            Looking for a lab test but don’t know where to start? We can help you to find the best suitable option. We compare pricing for various lab tests across Pakistan's labs. We also provide online test results and home sampling service for your convenience, so you can receive the care you require without leaving your comfort zone.
          </p>
        </div>
    </div>
  </div>
    
      <!-- <h2 class="text-blue text_22 text-xs-20">
        Introduction of the HbA1c Test
      </h2>
      <span class="text_black text_13">
        HbA1c stands for Hemoglobin A1c. HbA1c is a common test which is done for the diagnosis as well as for the monitoring of blood sugar level in the patients of diabetes mellitus. It is also known as Glycated hemoglobin. It gives an average blood glucose value for approximately 120 days which is around 10 to 12 weeks.  HbA1c refers to hemoglobin which binds to glucose. Hb is basically a protein which is present in red blood cells and responsible for the transportation of oxygen and carbon dioxide. The glucose in the blood binds to the hemoglobin and leads to the formation of Hba1c which is also called Glycated hemoglobin. When there is an increased level of sugar or glucose level in the blood the more binding of glucose to the hemoglobin leads to the increase in the value of HbA1c. 
      </span>
      <span class="read-more mt-2 mb-2">
            <a v-if="showMore" id="show-more" @click="showMoreContent()" class="text-blue font-weight-bold text_15" href="javascript:void(0)">Read More
              <i class="fa fa-angle-double-right" aria-hidden="true"></i>
            </a>
            <a v-if="showLess" id="show-less" @click="showLessContent()" class="text-blue font-weight-bold text_15" href="javascript:void(0)">Read Less
              <i class="fa fa-angle-double-left" aria-hidden="true"></i>
            </a>
        </span> -->
        <!-- <div class="w-100 d-inline-block mt-3">
          <h2 class="text-blue text_18 font-weight-bold mb-3">
            Purpose of the HBA1C Test
          </h2>
          <p class="text_black text_13">
            The purpose of the Hb1Ac Test is to monitor the blood sugar level in the patients of diabetes mellitus. If the person has any sign and symptoms of diabetes mellitus for example; pigmented urination, increased thirst, increased hunger, weight loss, slow healing of cuts and wounds and burning sensation of hands the person must go for the HbA1c Test so that the level and diagnosis of diabetes take place
          </p>
        </div>
        <div class="w-100 d-inline-block mt-3">
          <h2 class="text-blue text_18 font-weight-bold mb-3">
            Role of HbA1c in diabetes management
          </h2>
          <p class="text_black text_13">
            It is recommended to the patients of diabetes mellitus to do HbA1c test once in two months. It is a better index for predicting complications of diabetes like diabetic neuropathy, diabetic foot, diabetic nephropathy, stroke and diabetic cardiomyopathy.
            The sample is stable as compared to the blood glucose measurement even though it is unaffected by the recent food intake that is why no fasting is required before the test. The test can give an average blood glucose value for 10 – 12 weeks which effectively helps in the diabetes management for the patients of diabetes mellitus.
          </p>
        </div> -->
        <!-- <div class="w-100 d-inline-block mt-3">
          <h2 class="text-blue text_18 font-weight-bold mb-3">
            Preparation for the HbA1c Test
          </h2>
          <p class="text_black text_13">
            For the HbA1c test the patient and the physician must be aware of the conditions and factors which can lead to the increase or decrease of HbA1c levels. The sample must be collected in EDTA vacancies and the HbA1c test must be conducted once every two months for the monitoring purpose. The gold standard test for the HbA1c estimation is High Performance Liquid Chromatography (HPLC) while the procedure of enzymatic assay can also be used.  
          </p>
        </div>
        <div class="w-100 d-inline-block text-center lab-testing-image mt-4 mb-4">
          <img src="/images/lab-testing-image.svg" style="height:185px;">
        </div>
        <div class="w-100 d-inline-block mt-3">
          <h2 class="text-blue text_18 font-weight-bold mb-3">
            Procedure of HbA1c Test
          </h2>
          <p class="text_black text_13">
            There are different methods for measuring HBA1c which are listed as under;  
          </p>
          <ul class="w-100 d-inline-block mt-3 lab-list-style pl-xl-3 
          mb-0">
            <li class="w-100 d-inline-block mb-2">
              <span class="list-style"></span>
              <span class="w-90 float-left">
                HPLC
              </span>
            </li>
            <li class="w-100 d-inline-block mb-2">
              <span class="list-style"></span>
              <span class="w-90 float-left">
                Electrophoretic methods
              </span>
            </li>
            <li class="w-100 d-inline-block mb-2">
              <span class="list-style"></span>
              <span class="w-90 float-left">
                Electrospray iontophoresis
              </span>
            </li>
            <li class="w-100 d-inline-block mb-2">
              <span class="list-style"></span>
              <span class="w-90 float-left">
                Mass spectroscopy
              </span>
            </li>
          </ul>
          <p class="text_black text_13 mt-3">
            The standard test for the determination of HbA1c level is the HPLC test. The HPLC result is calculated as a ratio of total hemoglobin by using a chromatogram. For the HbA1c test a healthcare provider will take a blood sample by using a needle to fill a tube or will use a lancet to prick your finger then the sample is passed in the Chromatogram where with specific speed and pressure the sample is treated with the buffer. The buffer separates different molecules of blood according to their polarity, size and charge. After the separation the molecules are detected by a UV- Spectrophotometer. HbA1c is separated from other hemoglobin molecules because of differences in ionic charges. After the analysis of HbA1c molecules the result is issued which determines the level of your blood sugar level. 
          </p>
        </div>
        <div class="w-100 d-inline-block mt-3">
          <h2 class="text-blue text_18 font-weight-bold mb-3">
            Interpretation of HbA1c Results
          </h2>
          <p class="text_black text_13">
            The interpretation of Hba1c values are given in the percentage (%) and as well as it is expressed as estimated average glucose or eAG. The interpretations are briefly discussed as under;  
          </p>
          <ul class="w-100 d-inline-block mt-3 lab-list-style pl-xl-3 
          mb-0">
            <li class="w-100 d-inline-block mb-2">
              <span class="list-style"></span>
              <span class="w-90 float-left">
                HbA1c value less than 5.5% or 110 mg/dl = Normal value
              </span>
            </li>
            <li class="w-100 d-inline-block mb-2">
              <span class="list-style"></span>
              <span class="w-90 float-left">
                HbA1c value 6% or 126 mg/dl = Good control
              </span>
            </li>
            <li class="w-100 d-inline-block mb-2">
              <span class="list-style"></span>
              <span class="w-90 float-left">
                HbA1c value 7% or 154 mg/dl = Adequate control
              </span>
            </li>
            <li class="w-100 d-inline-block mb-2">
              <span class="list-style"></span>
              <span class="w-90 float-left">
                HbA1c value 8% or 183 mg/dl = Inadequate control
              </span>
            </li>
            <li class="w-100 d-inline-block mb-2">
              <span class="list-style"></span>
              <span class="w-90 float-left">
                HbA1c value 9% or 183 mg/dl = Inadequate control
              </span>
            </li>
          </ul>
        </div>
        <div class="w-100 d-inline-block mt-3">
          <h2 class="text-blue text_18 font-weight-bold mb-3">
            Understanding HbA1c levels and their implications
          </h2>
          <p class="text_black text_13">
            The normal range value for HbA1c is less than 5.5%. If the person has less than 5.5% HbA1c then it is considered a normal range. As per the American Diabetes Association if the person has a value of 6.5 % or more than 6.5 % the person is considered as diabetic. If the value is in between 5.5 % to 6.4 % it is considered prediabetes or impaired glucose tolerance.  
          </p>
        </div> -->
       <!--  <div class="w-100 d-inline-block mt-3">
          <h2 class="text-blue text_18 font-weight-bold mb-3">
            Discussion of target HbA1c levels for different individuals
          </h2>
          <p class="text_black text_13">
            The Glycemic HbA1c level is varies in individuals to individuals according to the age which is briefly discussed as under;  
          </p>
          <ul class="w-100 d-inline-block mt-3 lab-list-style pl-xl-3 
          mb-0">
            <li class="w-100 d-inline-block mb-2">
              <span class="list-style"></span>
              <span class="w-90 float-left">
                Toddlers and preschoolers having the age of 6 years the HbA1c level must be 7.5 %  and 8.5%
              </span>
            </li>
            <li class="w-100 d-inline-block mb-2">
              <span class="list-style"></span>
              <span class="w-90 float-left">
                School age Children having the age of 6 – 12 years the HbA1c level must be 8 %
              </span>
            </li>
            <li class="w-100 d-inline-block mb-2">
              <span class="list-style"></span>
              <span class="w-90 float-left">
                Adolescents and young adults having the age of 10 – 19 years the HbA1c level must be 7.5 %
              </span>
            </li>
          </ul>
          <p class="text_black text_13 mt-3">
            The study shows HbA1c increased gradually with age from about 5.16 in the age group of 20 – 29 years to 5.49 in those above 70 years. Among a smaller group of people taken for validation, HbA1c was 5.35 in the age group 20 – 29 years and .74 in those above 70 years. 
          </p>
        </div> -->
        <!-- <div class="w-100 d-inline-block mt-3">
          <h2 class="text-blue text_18 font-weight-bold mb-3">
            Factors Affecting HbA1c Results
          </h2>
          <p class="text_black text_13">
            According to the statistics of the website ResearchGate there are different factors which can affect the result. The results might be to increase HbA1c levels or decrease HbA1c levels. The factors leading to increase HbA1c levels are;  
          </p>
          <ul class="w-100 d-inline-block mt-3 lab-list-style pl-xl-3 
          mb-0">
            <li class="w-100 d-inline-block mb-2">
              <span class="list-style"></span>
              <span class="w-90 float-left">
                Iron deficiency anemia
              </span>
            </li>
            <li class="w-100 d-inline-block mb-2">
              <span class="list-style"></span>
              <span class="w-90 float-left">
                Vitamin B12 deficiency
              </span>
            </li>
            <li class="w-100 d-inline-block mb-2">
              <span class="list-style"></span>
              <span class="w-90 float-left">
                Splenectomy
              </span>
            </li>
            <li class="w-100 d-inline-block mb-2">
              <span class="list-style"></span>
              <span class="w-90 float-left">
                Chronic renal failure
              </span>
            </li>
            <li class="w-100 d-inline-block mb-2">
              <span class="list-style"></span>
              <span class="w-90 float-left">
                Alcoholism
              </span>
            </li>
            <li class="w-100 d-inline-block mb-2">
              <span class="list-style"></span>
              <span class="w-90 float-left">
                Hyperbilirubinemia
              </span>
            </li>
            <li class="w-100 d-inline-block mb-2">
              <span class="list-style"></span>
              <span class="w-90 float-left">
                Chronic opiate use
              </span>
            </li>
          </ul>
          <p class="text_black text_13 mt-3">
            The study shows HbA1c increased gradually with age from about 5.16 in the age group of 20 – 29 years to 5.49 in those above 70 years. Among a smaller group of people taken for validation, HbA1c was 5.35 in the age group 20 – 29 years and .74 in those above 70 years. 
          </p>
          <ul class="w-100 d-inline-block mt-3 lab-list-style pl-xl-3 
          mb-0">
            <li class="w-100 d-inline-block mb-2">
              <span class="list-style"></span>
              <span class="w-90 float-left">
                Hemolytic anemia of various causes
              </span>
            </li>
            <li class="w-100 d-inline-block mb-2">
              <span class="list-style"></span>
              <span class="w-90 float-left">
                Heterozygous thalassemia
              </span>
            </li>
            <li class="w-100 d-inline-block mb-2">
              <span class="list-style"></span>
              <span class="w-90 float-left">
                Erythropoietin supplementation
              </span>
            </li>
            <li class="w-100 d-inline-block mb-2">
              <span class="list-style"></span>
              <span class="w-90 float-left">
                Iron supplements
              </span>
            </li>
            <li class="w-100 d-inline-block mb-2">
              <span class="list-style"></span>
              <span class="w-90 float-left">
                Vitamin C
              </span>
            </li>
            <li class="w-100 d-inline-block mb-2">
              <span class="list-style"></span>
              <span class="w-90 float-left">
                Vitamin E
              </span>
            </li>
            <li class="w-100 d-inline-block mb-2">
              <span class="list-style"></span>
              <span class="w-90 float-left">
                Aspirin
              </span>
            </li>
            <li class="w-100 d-inline-block mb-2">
              <span class="list-style"></span>
              <span class="w-90 float-left">
                Splenomegaly
              </span>
            </li>
          </ul>
        </div>
        <div class="w-100 d-inline-block mt-3">
          <h2 class="text-blue text_18 font-weight-bold mb-3">
            HbA1c test price in Pakistan
          </h2>
          <p class="text_black text_13">
            There are different methods for the diagnosis of HbA1c levels therefore, the rates vary from labs preparations and standards as well as the rates may vary from cities to cities. The approximate range for the HbA1c test starts from 1000 to 3000 PKR. Compared with the government hospitals the price can be as low as 1020 PKR while in the private sector the price can be as high as 3000 PKR according to the standards which they provide.  
          </p>
        </div>
      </div> -->
        <!-- <div class="w-100 d-inline-block mb-3 mt-3">
          <h2 class="w-100 d-inline-block text-blue text_22 text-xs-20">
            We compare, you save
          </h2>
          <p class="text_black text_14">
            Looking for a lab test but don’t know where to start? We can help you to find the best suitable option. We compare pricing for various lab tests across Pakistan's labs. We also provide online test results and home sampling service for your convenience, so you can receive the care you require without leaving your comfort zone.
          </p>
        </div> -->
    <div class="lab_heading mb-3 w-100 d-inline-block mt-4">
      <h2 class="font-weight-bold text_black text_18">{{tests[0].title}} Price and Details ({{testsCount}} tests available)
      </h2>
       <!-- <h3 class="text_14">Last Updated On {{moment().format("dddd")}},
              {{ moment().format("MMMM") }} {{ moment().format("DD") }}, {{ moment().format("YYYY") }}l</h3>  -->
    </div>
    <div class="row">
      <div class="col-12 col-md-6 col-sm-6 col-xl-3 col-lg-4 mb-3" v-for="(test,index) in tests" v-if="index < TestsToShow">
        <div class="test_box bg-white box-shadow p-2 position-relative float-left d-inline-block book-rounded height_box w-100">
          <a href="javascript::void(0)" class=" py-2 position-relative d-inline-block w-100">
            <span class="lab_image d-inline-block w-100 text-center">
              <div class="float-left">
                <img class="float-left" v-lazy="basePath+'/uploads/users/'+test.user.id+'/medium-'+test.user.profile.avatar" :alt="test.user.first_name+' '+test.user.last_name" :name="test.user.first_name+' '+test.user.last_name">
              <span class="d-inline-block mt-4">
                <star-rating
                active-color="#0E4D92" 
                :max-rating="1"
                :show-rating="false"
                :star-size="15"
                :rating="getAverageRating(test.user.feedback)"
                :read-only="true"
                style="margin-top: 2px;"
                >
              </star-rating>
               <span class=" float-left text-center mr-1 ml-1 text-blue font-weight-bold mt-1">{{ getAverageRating(test.user.feedback) }}
                        </span>
              <span v-if="test.user.feedback && test.user.feedback.length > 0" class="number-text d-inline-block ml-2 mt-1">({{test.user.feedback.length}})
              </span>
              </span>
              </div>
              <div v-if="test.user.user_discount_percentage" class="percent_main mb-2 adjust_percentage">
              <span class="d-inline-block book-rounded bg-red text-white text_14 discount-padding">
                {{test.user.user_discount_percentage}}%OFF
              </span>
              <!-- <sub>OFF</sub> -->
            </div>
            <div v-else class="percent_main mb-2 adjust_percentage">
              <span class="d-inline-block book-rounded bg-red text-white text_14 discount-padding">
                20%OFF
              </span>
              <!-- <sub>OFF</sub> -->
            </div>
            </span>
          </a>
          <a :href="'/test/'+test.user.slug+'/'+test.slug" 
          class="font-weight-bold text_black test_name text_13 hidden-line">{{test.title}} in {{test.user.first_name}} {{test.user.last_name}}</a>
          <!-- <div class="test_description mt-2">
            <p><span>Known As:</span> {{test.known_as}}</p>
          </div> -->
          <div class="w-100 d-inline-block lab-checkbox">
            <div class="report-facility w-100 d-inline-block mb-1">
              <a v-if="test.sample_type && test.sample_type !== null" class="d-inline-block float-left" 
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
              <a v-if="test.user && test.user.profile && test.user.profile.online_report_url !== null" class="d-inline-block float-left" 
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
          <div class="position-relative w-100 d-inline-block">
            <a href="javascript:void(0)" @click="labData(test.user.id, test.id)" class="text-green text-center float-left d-inline-block book-rounded font-weight-bold text_12 cart-btn" data-toggle="modal" data-target="#testModal">
            <i aria-hidden="true" class="fa fa-long-arrow-right d-inline-block mr-2"></i>
            Book Test</a>
          <span class="float-right">
            <span class="font-weight-bold text_14" 
            v-if="test.price != '' ">
            <strike class="text-red text_14 ml-1 mr-2">
              <span class="color-date text_13">Rs.{{test.price}}
              </span>
            </strike> 
          </span>
            <span class="font-weight-bold text_15 ml-1" v-if="test.price != '' "><span class="text_12">Rs.</span>{{test.discounted_price}}</span>
            </span>
          </div>
          <!-- <div v-if="test.turn_around_time" class="row">
            <div v-if="test.sample_type" class="col-12 col-lg-6 col-md-6 mt-2">
              <span class="font-weight-bold text_12">Sample Type
              </span>
            </div>
            <div v-if="test.sample_type" class="col-12 col-lg-6 col-md-6 mt-2">
              <span class="font-weight-bold text_12 d-inline-block w-100">{{test.sample_type}}</span>
            </div>
            <div class="col-12 col-lg-6 col-md-6">
              <span class="font-weight-bold text_12">Turn Around Time</span>
            </div>
            <div class="col-12 col-lg-6 col-md-6">
              <span class="font-weight-bold text_12 d-inline-block w-100">{{test.turn_around_time}}</span>
            </div>
          </div> -->
        </div>
      </div>
    </div>
     <div v-if="tests_meta && tests_meta.description" class="row">
      <div class="col-12">
        <div id="all-speciality-content" class="w-100 d-inline-block">
        <div class="w-100 d-inline-block mt-4">
          <span v-html="tests_meta.description"></span>
        </div>
      </div>
    </div>
  </div> 
    <!-- <div class="row">
      <div class="col-12">
        <div class="w-75 d-block m-auto w-xs-100 w-sm-100 w-md-100">
          <div class="w-100 d-inline-block text-center 
          mt-3">
          <span class="w-100 d-inline-block text-blue text_18 font-weight-bold">
            We compare, you save
          </span>
          <p class="text_black text_14">
            Looking for a lab test but don’t know where to start? We can help you to find the best suitable option. We compare pricing for various lab tests across Pakistan's labs. We also provide online test results and home sampling service for your convenience, so you can receive the care you require without leaving your comfort zone.
          </p>
        </div>
        <div class="w-100 d-inline-block text-center mt-3">
          <span class="w-100 d-inline-block text-blue text_18 font-weight-bold">
            How does our system work?
          </span>
          <p class="text_black text_14">
            Now there is no more searching hassle to choose the best lab with low test rates. Enter the required test name you want to search for on our website and add your location; within a minute, we will show your nearest lab services with the best price, discount rates, Lab ratings, and other facilities like home sampling. You can choose whatever you want.
          </p>
        </div>
        <div class="w-100 d-inline-block text-center mt-3">
          <span class="w-100 d-inline-block text-blue text_18 font-weight-bold">
           Why Doctorfindy is the best choice
          </span>
          <p class="text_black text_14">
            Many options are available around you. Still, we give you reasons to choose our services. We provide the most comprehensive lab test booking and cost comparison facility nationwide. Here you can find all the certified Lab services at the lowest price rates. Amazingly, you can select the lab test from your desired lab and choose according to your home sampling facility. So what else do you want? If you find lab sampling at your doorstep. Furthermore, we will give you online test reports, so we care about your precious time and money.
          </p>
        </div>
        </div>
      </div>
    </div> -->
    <div class="w-100 d-inline-block">
      <div class="heading-box mt-3" id="profileDetialFAQ">
        <h2 class="font-weight-bold m-0 text_25 text-xs-22 
        text-blue">
           Frequently Asked Questions
        </h2>
        <div>
           <div class="question_main mb-2 mt-3 position-relative">
              <a data-toggle="collapse" class="collapsed faq_inner pl-3 pt-2 bg-white border-0 box_shadow" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
              <span class="service-text font-weight-bold text_15">What Is {{tests[0].title}}?</span>
              </a>
              <div class="collapse" id="collapseExample">
                 <div class="card card-body custom_collapse 
                 test_faq p-2 pl-3">
                    <span class="text_14">{{tests[0].title}} is one of the vital diagnoses related to your body’s health. The labs collect sample to test your body’s proper functioning and overall health in this test. You may collect the report in 
                      <span v-if="tests[0].turn_around_time">{{tests[0].turn_around_time}}.</span><span v-else>24 – 48 hours.</span><span>Also, you can get the results via SMS or download it from the website.</span></span>
                 </div>
              </div>
           </div>
           <div class="question_main mb-2 
           position-relative">
              <a data-toggle="collapse" class="collapsed faq_inner pl-3 pt-2 bg-white border-0 box_shadow" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
              <span class="service-text font-weight-bold text_15">Can I Give Sample for {{tests[0].title}} Test at Home?</span>
              </a>
              <div class="collapse" id="collapseExample1">
                 <div class="card card-body custom_collapse p-2 
                 pl-3">
                 <span class="text_14">
                    Yes, why not?
                    Just book it at DoctorFindy and leave the rest to us. DoctorFindy books an appointment for you at your desired lab. The lab boy from the specific lab reaches your doorstep at your given date and time.
                    You can conveniently give the sample at your home and get results within the suggested time.
                  </span>
                 </div>
              </div>
           </div>
           <div class="question_main mb-2 
           position-relative">
              <a data-toggle="collapse" class="collapsed faq_inner pl-3 pt-2 bg-white border-0 box_shadow" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
              <span class="service-text font-weight-bold text_15">How Can I Book an Online {{tests[0].title}} Test?</span>
              </a>
              <div class="collapse" id="collapseExample2">
                 <div class="card card-body custom_collapse p-2 
                 pl-3">
                 <span class="text_14">
                    Booking an online {{tests[0].title}} is not a difficult task anymore – thanks to the DoctorFindy online health services. You can book an appointment online. Our representative will confirm the appointment by making a phone call.
                    You can go to the lab or call a lab boy at your home to give the blood sample.
                  </span>
                 </div>
              </div>
           </div>
           <div class="question_main mb-2 
           position-relative">
              <a data-toggle="collapse" class="collapsed faq_inner pl-3 pt-2 bg-white border-0 box_shadow" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample">
              <span class="service-text font-weight-bold text_15">What Is the Price of the {{tests[0].title}} Test?</span>
              </a>
              <div class="collapse" id="collapseExample3">
                 <div class="card card-body custom_collapse p-2 
                 pl-3">
                    <span class="text_14">The prices may vary from lab to lab. However, DoctorFindy brings the best for you. You may get minimal costs from all labs through DoctorFindy. Overall, the {{tests[0].title}} prices vary between {{tests[0].averagePrice}}PKR.</span>
                 </div>
              </div>
           </div>
        </div>
      </div>
    </div>
    <lab-model ref="LabTestModal" :branches="user" :specialitys="specialities" :doctorss="doctors" :hospitalss="hospitals" :diseasess="diseases" :servicess="services" :laboratories="allLaboratories" :cities="allcities" :tests="allTests" :selectlab="lab" :test_id="test_id" :fileSystemDriver="fileSystemDriver"></lab-model>
  </div>
</template>

<script>
import moment from 'moment';
import StarRating from 'vue-star-rating';
export default {
name: "TestsByLabsComponent",
components: {StarRating},
  props: ['specialitys', 'servicess', 'cities', 'diseasess', 'doctorss', 'hospitalss', 'laboratories', 'trendingTopics','managements', 'logged_user', 'segments','tests','symptoms','user','users','tests_meta', 'fileSystemDriver'],
  data() {
    return {
      basePath:'',
      showFullDescription: false,
      showMore:true,
        showLess:false,
      moment: moment,
      selectedLocation: [],
      specialities: this.specialitys,
      doctors: this.doctorss,
      hospitals: this.hospitalss,
      diseases: this.diseasess,
      services: this.servicess,
      TestsToShow: this.tests.length,
      search: '',
      allLaboratories: [],
      allLocations: this.cities,
      allcities: [],
      allTests: [],
      findTests: [],
      id : '',
      lab:[],
      test_id : '',
      testsCount:'',
    }
  },
  created () {
    // this.tests = JSON.parse(this.user.lab_test);
      if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = '';
      } else {
        // Use local path for development
        this.basePath = '';
      }

  },
  mounted(){
    // if(this.tests_meta.description)
    // {
    //    var all_data = document.getElementById('all-speciality-content');
    //   localStorage.setItem('height', all_data.offsetHeight);
    //   if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
    //       all_data.style.height = '225px';
    //     }else{
    //       all_data.style.height = '155px';
    //     }
    // }
      var intial_data = document.getElementById('introduction-test');
      intial_data.scrollIntoView({ behavior: 'smooth'});
   
      
      this.users.forEach(fields => {
        var lab_name = fields.first_name +" "+fields.last_name;

         this.allLaboratories.push({first_name:fields.first_name,last_name:fields.last_name,name:lab_name,id:fields.id})
      }); 
      //   var lab_name = this.user.first_name +" "+this.user.last_name;
      //    this.allLaboratories.push({name:lab_name,id:this.user.id});
      this.cities.forEach(fields => {
         this.allcities.push({name:fields.title,id:fields.id})
      });
      this.tests.forEach(fields => {
         this.allTests.push({name:fields.title,id:fields.id,price:fields.price,discounted_price:fields.discounted_price,labo_id:fields.lab_id})
      });
      this.testsCount = this.tests.length;
  },
  methods: {
       toggleDescription() {
        // this.showFullDescription = !this.showFullDescription;

        // if(this.showFullDescription === false)
        // {
        //   var all_data = document.getElementById('all-speciality-content');
        //   if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        //     all_data.style.height = '225px';
        //   }else{
        //     all_data.style.height = '155px';
        //   }
        //   all_data.scrollIntoView({ behavior: 'smooth'});
        // }
        // else
        // {
          // var height = localStorage.getItem('height');
          var all_data = document.getElementById('all-speciality-content');
          // all_data.style.height = height+'px';
          all_data.scrollIntoView({ behavior: 'smooth'});
        // }
        
      },
    showMoreContent(){
        var height = localStorage.getItem('height');
        var all_data = document.getElementById('all-speciality-content');
        all_data.style.height = height+'px';
        this.showLess = true;
        this.showMore = false;
      },
      showLessContent(){
        var all_data = document.getElementById('all-speciality-content');
        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
          all_data.style.height = '225px';
        }else{
          all_data.style.height = '155px';
        }
        all_data.scrollIntoView({ behavior: 'smooth'});
        this.showLess = false;
        this.showMore = true;
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
      // findTest(id){
      //     this.$refs.LabTestModal.selectedFirstLab();
      //          let self = this
      //         self.findTests = [];
      //     self.tests.forEach(function (x) {
      //       if (x.id === id) {
      //           self.findTests.push(x)
      //       }
      // })
      //   },
        labData(data,id){
          let tuser = this.users.filter((item) => {
          return (item.id == data)
        })
        

      this.lab = tuser[0];
      this.test_id =id;
      // console.log('seeeehere',this.lab,this.test_id);
    },
  }
}
</script>

<style scoped>
.test_name{
  display: inline-block;
  height: 45px;
}
.lab_image img {
  width: 60px;
  border-radius: 135px;
  height: 60px;
}
#profile{
  background-color: #FAFAFA!important;
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
.adjust_percentage{
  position: absolute;
  top: 0px;
  right: 0px;
  text-align: right;
}
.test_box:hover .add_testBtn {
  background-color: #EA4335;
  color: #fff !important;
}
.cart-btn{
  border: 1.5px solid #B3B3B3;
    padding: 6px 10px;
}
.cart-btn:hover{
  background-color: #088F8F;
    border: 1px solid #088F8F !important;
    color: #fff !important;
}
.lab-list-style li .list-style{
  width: 4px;
    height: 4px;
    display: inline-block;
    background: #000;
    border-radius: 50%;
    float: left;
    margin-top: 9px;
    margin-right: 20px;
}




</style>