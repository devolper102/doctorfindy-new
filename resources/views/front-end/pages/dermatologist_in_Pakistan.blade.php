@extends('front-end.master') @section('description', '') @section('keywords', '') @section('content')


<body class="stretched no-transition">
            



<div id="search_modal" class="modal">
    <div class="modal-content" style="padding-top: 30px; padding-bottom: 30px; width: 90%; height: 1334px; top: 0; position: fixed;">
        <span class="close" data-modal="search_modal" onclick="toggleModal(event, 'search_modal', 'hide'); getUserCity()">&times;</span>
        <div class="">
            <p class="h2">Search...</p>
            <div class="row header-form">
                <div class="col-3">
                    <select id="user_city_mobile" class="u-full-width" style="box-shadow: 1px 1px 10px #eee; border: 1px solid #00b3d8;">
                        <option value="Pakistan" selected>Pakistan</option>
                                                <option value="Lahore">Lahore</option>
                                                <option value="Karachi">Karachi</option>
                                                <option value="Islamabad">Islamabad</option>
                                                <option value="Rawalpindi">Rawalpindi</option>
                                                <option value="Faisalabad">Faisalabad</option>
                                                <option value="Peshawar">Peshawar</option>
                                                <option value="Multan">Multan</option>
                                                <option value="Quetta">Quetta</option>
                                                <option value="Gujranwala">Gujranwala</option>
                                                <option value="Sargodha">Sargodha</option>
                                                <option value="Abbottabad">Abbottabad</option>
                                                <option value="Attock">Attock</option>
                                                <option value="Bahawalnagar">Bahawalnagar</option>
                                                <option value="Bahawalpur">Bahawalpur</option>
                                                <option value="Bannu">Bannu</option>
                                                <option value="Bhakkar">Bhakkar</option>
                                                <option value="Bhalwal">Bhalwal</option>
                                                <option value="Burewala">Burewala</option>
                                                <option value="Chakwal">Chakwal</option>
                                                <option value="Charsadda">Charsadda</option>
                                                <option value="Chishtian">Chishtian</option>
                                                <option value="Daska">Daska</option>
                                                <option value="Dera Ghazi Khan">Dera Ghazi Khan</option>
                                                <option value="Dina">Dina</option>
                                                <option value="Gojra">Gojra</option>
                                                <option value="Gujrat">Gujrat</option>
                                                <option value="Hafizabad">Hafizabad</option>
                                                <option value="Hyderabad">Hyderabad</option>
                                                <option value="Istanbul">Istanbul</option>
                                                <option value="Izmir">Izmir</option>
                                                <option value="Jacobabad">Jacobabad</option>
                                                <option value="Jhang">Jhang</option>
                                                <option value="Jhelum">Jhelum</option>
                                                <option value="Kamoke">Kamoke</option>
                                                <option value="Kasur">Kasur</option>
                                                <option value="Kayseri">Kayseri</option>
                                                <option value="Khanewal">Khanewal</option>
                                                <option value="kharian">kharian</option>
                                                <option value="Khushab">Khushab</option>
                                                <option value="Kohat">Kohat</option>
                                                <option value="Larkana">Larkana</option>
                                                <option value="Layyah">Layyah</option>
                                                <option value="Lodhran">Lodhran</option>
                                                <option value="Loralai">Loralai</option>
                                                <option value="Mansehra">Mansehra</option>
                                                <option value="Mardan">Mardan</option>
                                                <option value="Mian Channu">Mian Channu</option>
                                                <option value="Mianwali">Mianwali</option>
                                                <option value="Nankana Sahib">Nankana Sahib</option>
                                                <option value="Nawabshah">Nawabshah</option>
                                                <option value="Nowshera">Nowshera</option>
                                                <option value="Okara">Okara</option>
                                                <option value="Pattoki">Pattoki</option>
                                                <option value="Rahim Yar Khan">Rahim Yar Khan</option>
                                                <option value="Riyadh">Riyadh</option>
                                                <option value="Sahiwal">Sahiwal</option>
                                                <option value="Shahkot">Shahkot</option>
                                                <option value="Sheikhupura">Sheikhupura</option>
                                                <option value="shorkot">shorkot</option>
                                                <option value="Sialkot">Sialkot</option>
                                                <option value="Swabi">Swabi</option>
                                                <option value="Swat">Swat</option>
                                                <option value="Talagang">Talagang</option>
                                                <option value="Tarbela">Tarbela</option>
                                                <option value="Taxila">Taxila</option>
                                                <option value="Vehari">Vehari</option>
                                                <option value="Wah Cantt">Wah Cantt</option>
                                            </select>
                </div>
                <div class="col-9">
                    <input type="text" id="search_bar_mobile" class="u-full-width" name="q" autocomplete="off" placeholder="Search for Hospitals, Doctors, Specialities, Services, Diseases and Conditions" style="box-shadow: 1px 1px 10px #eee; border: 1px solid #00b3d8;"></div>
                </div>
            </div>
        </div>
    </div>
</div>          <div class="container">
        <div class="padding mt-2">
            <ul class="breadcrumb">
                <li><a href="https://www.marham.pk">Home</a></li>
                <li><a href="https://www.marham.pk/online-consultation">Online Consultation</a></li>
                <li>Dermatologist</li>
            </ul>
        </div>
        <div class="row mt-2 bg-white padding">
            <div class="col-12">
                <h1 style="font-size: 20px;">Consult a Qualified Dermatologist Online In Bahria Town</h1>
                <label><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-half green-text"></i> 300,000+ patients have used this service</label></center>
            </div>
        </div>
        <div class="row mt-2 bg-white padding">
            <div id="listing_filters" class="row mt-2 bg-white padding" >
    <div class="col-6-sm col-4">
        <label for="filterdata" style="font-size: medium">Filter</label>
        <select class="u-full-width filter ga-event-listing-filter" id="cities" aria-label="Cities" data-event-action="Filter-City">
            <option selected="selected">--- Choose City ---</option>
                                                                                <option value="Abbottabad" data-slug="abbottabad"   >Abbottabad</option>
                                                                                <option value="Faisalabad" data-slug="faisalabad"   >Faisalabad</option>
                                                                                <option value="Gujranwala" data-slug="gujranwala"   >Gujranwala</option>
                                                                                <option value="Haripur" data-slug="haripur"   >Haripur</option>
                                                                                <option value="Hyderabad" data-slug="hyderabad"   >Hyderabad</option>
                                                                                <option value="Islamabad" data-slug="islamabad"   >Islamabad</option>
                                                                                <option value="Karachi" data-slug="karachi"   >Karachi</option>
                                                                                <option value="Lahore" data-slug="lahore"   >Lahore</option>
                                                                                <option value="London" data-slug="london"   >London</option>
                                                                                <option value="Mianwali" data-slug="mianwali"   >Mianwali</option>
                                                                                <option value="Multan" data-slug="multan"   >Multan</option>
                                                                                <option value="Okara" data-slug="okara"   >Okara</option>
                                                                                <option value="Peshawar" data-slug="peshawar"   >Peshawar</option>
                                                                                <option value="Quetta" data-slug="quetta"   >Quetta</option>
                                                                                <option value="Rahim Yar Khan" data-slug="rahim-yar-khan"   >Rahim Yar Khan</option>
                                                                                <option value="Rawalpindi" data-slug="rawalpindi"   >Rawalpindi</option>
                                                                                <option value="Sadiqabad" data-slug="sadiqabad"   >Sadiqabad</option>
                                                                                <option value="Sialkot" data-slug="sialkot"   >Sialkot</option>
                    </select>
    </div>
</div>
        </div>
        <div id="doctors_div" class="row mt-2 bg-white padding">
            <div class="col-12">
                <h2>Choose Qualified Dermatologist</h2>
                <div class="divider"></div>
            </div>
            <div class="col-12">
                                    <div class="row bg-white padding doctor-card">
    <div class="col-12-sm col-2">
        <div class="col-4-sm col-12">
                        <div class="doctor-image lazy-image" style="border-radius: 4px" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/9226/dr-zafar-ahmed-dermatologist-karachi-34_170X170.png" data-alt="dr-zafar-ahmed-dermatologist-lahore" data-url="https://www.marham.pk/doctors/lahore/dermatologist/dr-zafar-ahmed"></div>
                    </div>

        <div class="col-8-sm col-12">
            <h2 class="d-block d-sm-none"><a href="https://www.marham.pk/doctors/lahore/dermatologist/dr-zafar-ahmed">Dr. Zafar Ahmed</a> <i class="fa fa-check-circle green-text"></i></h2>
                        <div class="">
                <!-- <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> -->
                <span class="rating" data-rating="4.9"></span>
                <span>(4.9 / 5)</span>
            </div>
            <p class="light-grey">(1022 Reviews)</p>
                    </div>
    </div>

    <div class="col-10">
        <div class="row">
            <div class="col-12 doctor-content">
                <h2 class="d-none d-sm-block"><a href="https://www.marham.pk/doctors/lahore/dermatologist/dr-zafar-ahmed">Dr. Zafar Ahmed</a> <i class="fa fa-check-circle green-text"></i></h2>
                <p><b></b></p>
                <p class="light-grey">MBBS, CRCP, D.DERM (Thailand ), Diploma in Dermato-Surgery (Bangkok)</p>
                <p>Consultant  with experience of 24 years </p>
                                <p class="green-text">Available Online: 12:00 PM - 09:00 PM</p>
                
                <div class="list-span mt-2">
                                                            <label> Rs. 1200</label>
                                        <label><i class="fa fa-bell"></i> Also Available for International Patients</label>
                                        <ul class="test-list">
                                                <li style="font-family: Tahoma;">بالوں کا گرنا</li>
                                                <li style="font-family: Tahoma;">وارٹس</li>
                                                <li style="font-family: Tahoma;">سکن الرجی</li>
                                                <a href="https://www.marham.pk/doctors/lahore/dermatologist/dr-zafar-ahmed">
                            <li style="text-decoration: underline;">View All Services</li>
                        </a>
                    </ul>
                    
                    
                </div>

                <div class="listing-doctor-faqs-online">
                    <div class="col-12-sm col-12">
                        <a class="collapsible ga-event-onpanel-doctor-profile-doctor-faqs" data-event-label="faq-booking"><i class="fa fa-angle-down u-pull-down"></i> When Dr. Zafar Ahmed is available?</a>
                        <div class="content">
                            Please book your slot <a href="https://www.marham.pk/online-consultation/request?id=67&d_id=9226">here</a> and agent will give you the earliest online time available. You can also call at 0345-0601773 to book
                        </div>
                    </div>


                                        <div class="col-12-sm col-12">
                        <a class="collapsible ga-event-onpanel-doctor-profile-doctor-faqs" data-event-label="faq-booking"><i class="fa fa-angle-down u-pull-down"></i> What are patients' reviews?</a>
                        <div class="content">
                                                        <div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
                                <div class="col-2-sm col-1">
                                    <img class="align-middle lazy-image" style="padding-right: 5px" data-src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
                                </div>
                                <div class="col-10-sm col-11">
                                    Talia - (Verified Patient)<p></p>
                                    <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
                                        <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
                                        <p>The only lack was on the call scheduling by Marham as I selected the slot of 7pm and got it scheduled for 8:50pm however the video quality of call really needs some improvements and so as the voice and Dr. Zafar has examined my problem very well and properly and I hope to get well according to his prescription.</p>
                                    </div>
                                </div>
                            </div>
                                                    </div>
                    </div>
                    
                                        <div class="col-12-sm col-12">
                        <a class="collapsible ga-event-onpanel-doctor-profile-doctor-faqs" data-event-label="faq-booking"><i class="fa fa-angle-down u-pull-down"></i> What's the speciality and areas of expertise?</a>
                        <div class="content">
                            <p>Dr. Zafar Ahmed is specialist Dermatologist. His area of expertise include Hair Problems,  Acne and Acne Scars, Thread up lighting Warts Removal , Aesthetic Procedures</p>
                        </div>
                    </div>
                                    </div>
            </div>

                    </div>

        <div class="row">
                        <div class="col-12-sm col-4">
                <a href="https://www.marham.pk/online-consultation/request?id=67&d_id=9226" class="button-big ga-event-online-consultation-listing ga-event-oc-speciality-listing-button">Book Online Consultation</a>
            </div>
                                </div>
    </div>
</div>                                  <div class="row bg-white padding doctor-card">
    <div class="col-12-sm col-2">
        <div class="col-4-sm col-12">
                        <div class="doctor-image lazy-image" style="border-radius: 4px" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/5396/dr-umer-mushtaq-dermatologist-lahore_170X170.jpg" data-alt="dr-umer-mushtaq-dermatologist-lahore" data-url="https://www.marham.pk/doctors/lahore/dermatologist/dr-umer-mushtaq"></div>
                    </div>

        <div class="col-8-sm col-12">
            <h2 class="d-block d-sm-none"><a href="https://www.marham.pk/doctors/lahore/dermatologist/dr-umer-mushtaq">Dr. Umer Mushtaq</a> <i class="fa fa-check-circle green-text"></i></h2>
                        <div class="">
                <!-- <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> -->
                <span class="rating" data-rating="4.7"></span>
                <span>(4.7 / 5)</span>
            </div>
            <p class="light-grey">(445 Reviews)</p>
                    </div>
    </div>

    <div class="col-10">
        <div class="row">
            <div class="col-12 doctor-content">
                <h2 class="d-none d-sm-block"><a href="https://www.marham.pk/doctors/lahore/dermatologist/dr-umer-mushtaq">Dr. Umer Mushtaq</a> <i class="fa fa-check-circle green-text"></i></h2>
                <p><b></b></p>
                <p class="light-grey">MBBS, FCPS (Dermatology), CAAAM ( USA )</p>
                <p>Senior Registrar  with experience of 12 years </p>
                                <p class="green-text">Available Online: 04:00 PM - 05:00 PM</p>
                
                <div class="list-span mt-2">
                                                            <label> Rs. 2000</label>
                                        <label><i class="fa fa-bell"></i> Also Available for International Patients</label>
                                        <ul class="test-list">
                                                <li style="font-family: Tahoma;">وارٹس</li>
                                                <li style="font-family: Tahoma;">کیل مہاسے</li>
                                                <li style="font-family: Tahoma;">لیزر ٹریٹمنٹ</li>
                                                <a href="https://www.marham.pk/doctors/lahore/dermatologist/dr-umer-mushtaq">
                            <li style="text-decoration: underline;">View All Services</li>
                        </a>
                    </ul>
                    
                    
                </div>

                <div class="listing-doctor-faqs-online">
                    <div class="col-12-sm col-12">
                        <a class="collapsible ga-event-onpanel-doctor-profile-doctor-faqs" data-event-label="faq-booking"><i class="fa fa-angle-down u-pull-down"></i> When Dr. Umer Mushtaq is available?</a>
                        <div class="content">
                            Please book your slot <a href="https://www.marham.pk/online-consultation/request?id=67&d_id=5396">here</a> and agent will give you the earliest online time available. You can also call at 0345-0601773 to book
                        </div>
                    </div>


                                        <div class="col-12-sm col-12">
                        <a class="collapsible ga-event-onpanel-doctor-profile-doctor-faqs" data-event-label="faq-booking"><i class="fa fa-angle-down u-pull-down"></i> What are patients' reviews?</a>
                        <div class="content">
                                                        <div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
                                <div class="col-2-sm col-1">
                                    <img class="align-middle lazy-image" style="padding-right: 5px" data-src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
                                </div>
                                <div class="col-10-sm col-11">
                                    Osama Aslam - (Verified Patient)<p></p>
                                    <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
                                        <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
                                        <p>it was good
</p>
                                    </div>
                                </div>
                            </div>
                                                        <div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
                                <div class="col-2-sm col-1">
                                    <img class="align-middle lazy-image" style="padding-right: 5px" data-src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
                                </div>
                                <div class="col-10-sm col-11">
                                    aleem haider junejo - (Verified Patient)<p></p>
                                    <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
                                        <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
                                        <p>yes it went well.</p>
                                    </div>
                                </div>
                            </div>
                                                        <div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
                                <div class="col-2-sm col-1">
                                    <img class="align-middle lazy-image" style="padding-right: 5px" data-src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
                                </div>
                                <div class="col-10-sm col-11">
                                    Muhammad Usman - (Verified Patient)<p></p>
                                    <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
                                        <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
                                        <p>satisfied with Dr. and Marham online service. thank  you</p>
                                    </div>
                                </div>
                            </div>
                                                    </div>
                    </div>
                    
                                        <div class="col-12-sm col-12">
                        <a class="collapsible ga-event-onpanel-doctor-profile-doctor-faqs" data-event-label="faq-booking"><i class="fa fa-angle-down u-pull-down"></i> What's the speciality and areas of expertise?</a>
                        <div class="content">
                            <p>Dr. Umer Mushtaq is specialist Dermatologist. His area of expertise include Acne,  Acne Scars,  Melasma,  Hairfall</p>
                        </div>
                    </div>
                                    </div>
            </div>

                    </div>

        <div class="row">
                        <div class="col-12-sm col-4">
                <a href="https://www.marham.pk/online-consultation/request?id=67&d_id=5396" class="button-big ga-event-online-consultation-listing ga-event-oc-speciality-listing-button">Book Online Consultation</a>
            </div>
                                </div>
    </div>
</div>                                  <div class="row bg-white padding doctor-card">
    <div class="col-12-sm col-2">
        <div class="col-4-sm col-12">
                        <div class="doctor-image lazy-image" style="border-radius: 4px" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/7382/dr-jaffar-ali-dermatologist-quetta-82_170X170.jpeg" data-alt="dr-jaffar-ali-dermatologist-lahore" data-url="https://www.marham.pk/doctors/lahore/dermatologist/dr-jaffar-ali"></div>
                    </div>

        <div class="col-8-sm col-12">
            <h2 class="d-block d-sm-none"><a href="https://www.marham.pk/doctors/lahore/dermatologist/dr-jaffar-ali">Dr. Jaffar Ali</a> <i class="fa fa-check-circle green-text"></i></h2>
                        <div class="">
                <!-- <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> -->
                <span class="rating" data-rating="4.7"></span>
                <span>(4.7 / 5)</span>
            </div>
            <p class="light-grey">(159 Reviews)</p>
                    </div>
    </div>

    <div class="col-10">
        <div class="row">
            <div class="col-12 doctor-content">
                <h2 class="d-none d-sm-block"><a href="https://www.marham.pk/doctors/lahore/dermatologist/dr-jaffar-ali">Dr. Jaffar Ali</a> <i class="fa fa-check-circle green-text"></i></h2>
                <p><b></b></p>
                <p class="light-grey">MBBS .MCPS(pak) FDO(aust)</p>
                <p>Consultant  with experience of 32 years </p>
                                <p class="green-text">Available Online: 02:00 PM - 10:00 PM</p>
                
                <div class="list-span mt-2">
                                                            <label> Rs. 500</label>
                                        <label><i class="fa fa-bell"></i> Also Available for International Patients</label>
                                        <ul class="test-list">
                                                <li style="font-family: Tahoma;">لیزر ٹریٹمنٹ</li>
                                                <li style="font-family: Tahoma;">وٹیلیگو</li>
                                                <li style="font-family: Tahoma;">جلے کا علاج</li>
                                                <a href="https://www.marham.pk/doctors/lahore/dermatologist/dr-jaffar-ali">
                            <li style="text-decoration: underline;">View All Services</li>
                        </a>
                    </ul>
                    
                    
                </div>

                <div class="listing-doctor-faqs-online">
                    <div class="col-12-sm col-12">
                        <a class="collapsible ga-event-onpanel-doctor-profile-doctor-faqs" data-event-label="faq-booking"><i class="fa fa-angle-down u-pull-down"></i> When Dr. Jaffar Ali is available?</a>
                        <div class="content">
                            Please book your slot <a href="https://www.marham.pk/online-consultation/request?id=67&d_id=7382">here</a> and agent will give you the earliest online time available. You can also call at 0345-0601773 to book
                        </div>
                    </div>


                                        <div class="col-12-sm col-12">
                        <a class="collapsible ga-event-onpanel-doctor-profile-doctor-faqs" data-event-label="faq-booking"><i class="fa fa-angle-down u-pull-down"></i> What are patients' reviews?</a>
                        <div class="content">
                                                        <div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
                                <div class="col-2-sm col-1">
                                    <img class="align-middle lazy-image" style="padding-right: 5px" data-src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
                                </div>
                                <div class="col-10-sm col-11">
                                    Hanan khan - (Verified Patient)<p></p>
                                    <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
                                        <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
                                        <p>awesome personality</p>
                                    </div>
                                </div>
                            </div>
                                                        <div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
                                <div class="col-2-sm col-1">
                                    <img class="align-middle lazy-image" style="padding-right: 5px" data-src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
                                </div>
                                <div class="col-10-sm col-11">
                                    Sakhawat Ali - (Verified Patient)<p></p>
                                    <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
                                        <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
                                        <p>Satisfied
</p>
                                    </div>
                                </div>
                            </div>
                                                        <div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
                                <div class="col-2-sm col-1">
                                    <img class="align-middle lazy-image" style="padding-right: 5px" data-src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
                                </div>
                                <div class="col-10-sm col-11">
                                    Fazal Ali - (Verified Patient)<p></p>
                                    <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
                                        <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
                                        <p>Good communication </p>
                                    </div>
                                </div>
                            </div>
                                                    </div>
                    </div>
                    
                                        <div class="col-12-sm col-12">
                        <a class="collapsible ga-event-onpanel-doctor-profile-doctor-faqs" data-event-label="faq-booking"><i class="fa fa-angle-down u-pull-down"></i> What's the speciality and areas of expertise?</a>
                        <div class="content">
                            <p>Dr. Jaffar Ali is specialist Dermatologist. His area of expertise include Hair Problems,  Laser for Acne,  Laser for Hair removal, Acne,  Skin Problems,  Other Skin Issues,  Acne and Acne Scars</p>
                        </div>
                    </div>
                                    </div>
            </div>

                    </div>

        <div class="row">
                        <div class="col-12-sm col-4">
                <a href="https://www.marham.pk/online-consultation/request?id=67&d_id=7382" class="button-big ga-event-online-consultation-listing ga-event-oc-speciality-listing-button">Book Online Consultation</a>
            </div>
                                </div>
    </div>
</div>                                  <div class="row bg-white padding doctor-card">
    <div class="col-12-sm col-2">
        <div class="col-4-sm col-12">
                        <div class="doctor-image lazy-image" style="border-radius: 4px" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/7153/dr-nadia-arshad-chaudhary-dermatologist-islamabad-24_170X170.jpg" data-alt="dr-nadia-arshad-chaudhary-dermatologist-lahore" data-url="https://www.marham.pk/doctors/lahore/dermatologist/dr-nadia-arshad-chaudhary"></div>
                    </div>

        <div class="col-8-sm col-12">
            <h2 class="d-block d-sm-none"><a href="https://www.marham.pk/doctors/lahore/dermatologist/dr-nadia-arshad-chaudhary">Dr. Nadia Arshad Chaudhary</a> <i class="fa fa-check-circle green-text"></i></h2>
                        <div class="">
                <!-- <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> -->
                <span class="rating" data-rating="4.7"></span>
                <span>(4.7 / 5)</span>
            </div>
            <p class="light-grey">(113 Reviews)</p>
                    </div>
    </div>

    <div class="col-10">
        <div class="row">
            <div class="col-12 doctor-content">
                <h2 class="d-none d-sm-block"><a href="https://www.marham.pk/doctors/lahore/dermatologist/dr-nadia-arshad-chaudhary">Dr. Nadia Arshad Chaudhary</a> <i class="fa fa-check-circle green-text"></i></h2>
                <p><b></b></p>
                <p class="light-grey">MBBS, MSC (Clinical Dermatology UK), Diploma in Dermatology Cardiff</p>
                <p>Consultant  with experience of 17 years </p>
                                <p class="green-text">Available Online: 05:00 PM - 08:00 PM</p>
                
                <div class="list-span mt-2">
                                                            <label> Rs. 2000</label>
                                        <label><i class="fa fa-bell"></i> Also Available for International Patients</label>
                                        <ul class="test-list">
                                                <li style="font-family: Tahoma;">لیزر ٹریٹمنٹ</li>
                                                <li style="font-family: Tahoma;">وٹیلیگو</li>
                                                <li style="font-family: Tahoma;">جلے کا علاج</li>
                                                <a href="https://www.marham.pk/doctors/lahore/dermatologist/dr-nadia-arshad-chaudhary">
                            <li style="text-decoration: underline;">View All Services</li>
                        </a>
                    </ul>
                    
                    
                </div>

                <div class="listing-doctor-faqs-online">
                    <div class="col-12-sm col-12">
                        <a class="collapsible ga-event-onpanel-doctor-profile-doctor-faqs" data-event-label="faq-booking"><i class="fa fa-angle-down u-pull-down"></i> When Dr. Nadia Arshad Chaudhary is available?</a>
                        <div class="content">
                            Please book your slot <a href="https://www.marham.pk/online-consultation/request?id=67&d_id=7153">here</a> and agent will give you the earliest online time available. You can also call at 0345-0601773 to book
                        </div>
                    </div>


                                        <div class="col-12-sm col-12">
                        <a class="collapsible ga-event-onpanel-doctor-profile-doctor-faqs" data-event-label="faq-booking"><i class="fa fa-angle-down u-pull-down"></i> What are patients' reviews?</a>
                        <div class="content">
                                                        <div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
                                <div class="col-2-sm col-1">
                                    <img class="align-middle lazy-image" style="padding-right: 5px" data-src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
                                </div>
                                <div class="col-10-sm col-11">
                                    Humda junaid - (Verified Patient)<p></p>
                                    <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
                                        <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
                                        <p>good listner.nice experience </p>
                                    </div>
                                </div>
                            </div>
                                                        <div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
                                <div class="col-2-sm col-1">
                                    <img class="align-middle lazy-image" style="padding-right: 5px" data-src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
                                </div>
                                <div class="col-10-sm col-11">
                                    Humda junaid - (Verified Patient)<p></p>
                                    <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
                                        <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
                                        <p>good listener . ..nice experience </p>
                                    </div>
                                </div>
                            </div>
                                                        <div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
                                <div class="col-2-sm col-1">
                                    <img class="align-middle lazy-image" style="padding-right: 5px" data-src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
                                </div>
                                <div class="col-10-sm col-11">
                                    Mariam Haq - (Verified Patient)<p></p>
                                    <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
                                        <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
                                        <p>it was good Alhumdulillah</p>
                                    </div>
                                </div>
                            </div>
                                                    </div>
                    </div>
                    
                                        <div class="col-12-sm col-12">
                        <a class="collapsible ga-event-onpanel-doctor-profile-doctor-faqs" data-event-label="faq-booking"><i class="fa fa-angle-down u-pull-down"></i> What's the speciality and areas of expertise?</a>
                        <div class="content">
                            <p>Dr. Nadia Arshad Chaudhary is specialist Dermatologist. His area of expertise include Hair Problems,  Laser for Hair removal,  Skin Problems, Botox </p>
                        </div>
                    </div>
                                    </div>
            </div>

                    </div>

        <div class="row">
                        <div class="col-12-sm col-4">
                <a href="https://www.marham.pk/online-consultation/request?id=67&d_id=7153" class="button-big ga-event-online-consultation-listing ga-event-oc-speciality-listing-button">Book Online Consultation</a>
            </div>
                                </div>
    </div>
</div>                          </div>
        </div>
                <!-- FAQ'S -->
                            <div id="faqs" class="row mt-2 bg-white padding">
                    <div class="col-12">
                        <h2 class="mb-2">Frequently Asked Questions</h2>
                        <button type="button" class="collapsible ga-event-online-consultation-listing-faq">What is the fee range of top Dermatologists in Pakistan?<i class="fa fa-angle-down u-pull-right"></i></button>
                        <div class="content">
                            <p>The fee for Dermatologists in Pakistan varies from PKR 500-3000 depending upon doctor's experience and qualification.</p>
                                                    </div>
                        
                        <button type="button" class="collapsible ga-event-online-consultation-listing-faq">Are there any additional charges when you book an appointment through
                            <a href="https://www.marham.pk">marham.pk?</a><i class="fa fa-angle-down u-pull-right"></i></button>
                        <div class="content">
                            <p>No, there are no extra charges to book an appointment through <a href="https://www.marham.pk">marham.pk</a></p>
                                                    </div>
                        
                        <button type="button" class="collapsible ga-event-online-consultation-listing-faq">How can you book an appointment with a Dermatologist? <i class="fa fa-angle-down u-pull-right"></i></button>
                        <div class="content">
                            <p><a href="https://www.marham.pk/online-consultation/dermatologist">Click Here</a> To book your appointment with a Dermatologist. You can also book your appointment with a Dermatologist by calling at  <a href="tel:042-32591427">042-32591427</a> or <a href="tel:042-32591429">042-32591429</a>. There are no extra charges for booking through Marham.</p>
                                                    </div>
                                                <button type="button" class="collapsible ga-event-online-consultation-listing-faq">What is Online Consultation? <i class="fa fa-angle-down u-pull-right"></i></button>
                        <div class="content">
                            <p>Online consultation is a service through which you can contact your doctor from any corner of the world , through a video call. No need to be there in person, you can consult you specialist through a call only.</p>
                                                    </div>
                        <button type="button" class="collapsible ga-event-online-consultation-listing-faq">How Online Consultation is different from Physical Consultation? <i class="fa fa-angle-down u-pull-right"></i></button>
                        <div class="content">
                            <p>Online consultation saves us from many hassles i.e there's no transportation cost, no location boundaries, easy prescription process and also, you don't have to wait in line. Whereas you can suffer from all these in case of physical consultation.</p>
                                                    </div>

                        <button type="button" class="collapsible ga-event-online-consultation-listing-faq" data-event-label="faq-experienced-doctors">Which experienced Dermatologists are available today?<i class="fa fa-angle-down u-pull-right"></i></button>
                        <div class="content">
                                                                                        <p class="mt-2">5 Experienced Best Dermatologists in Pakistan are:</p>
                                                                <ul class="grid-list">
                                                                                                                <li><a href="https://www.marham.pk/doctors/lahore/dermatologist/dr-pervaiz-lateef">Dr. Pervaiz Lateef</a></li>
                                                                                                                    <li><a href="https://www.marham.pk/doctors/lahore/dermatologist/dr-atif-kazmi">Dr. Atif Kazmi</a></li>
                                                                                                                    <li><a href="https://www.marham.pk/doctors/lahore/dermatologist/dr-jaffar-ali">Dr. Jaffar Ali</a></li>
                                                                                                                    <li><a href="https://www.marham.pk/doctors/lahore/dermatologist/dr-shagufta-shafi">Dr. Shagufta Shafi</a></li>
                                                                                                                    <li><a href="https://www.marham.pk/doctors/lahore/dermatologist/dr-samina-noor">Dr. Samina Noor</a></li>
                                                                                                            </ul>
                                                                                        <p class="mt-2">View all the qualified <a href="https://www.marham.pk/doctors/dermatologist">Dermatologists available in Pakistan</a> at Marham.pk</p>
                                                    </div>
                        
                        <button type="button" class="collapsible ga-event-online-consultation-listing-faq" data-event-label="faq-top-review"> Who are the top reviewed Dermatologists in Pakistan?<i class="fa fa-angle-down u-pull-right"></i></button>
                        <div class="content">
                                                                                        <p class="mt-2">Top 5 Dermatologists  in Pakistan are:</p>
                                                                <ul class="grid-list">
                                                                                                                <li><a href="https://www.marham.pk/doctors/lahore/dermatologist/dr-zafar-ahmed">Dr. Zafar Ahmed</a></li>
                                                                                                                    <li><a href="https://www.marham.pk/doctors/lahore/dermatologist/dr-umer-mushtaq">Dr. Umer Mushtaq</a></li>
                                                                                                                    <li><a href="https://www.marham.pk/doctors/lahore/dermatologist/dr-jaffar-ali">Dr. Jaffar Ali</a></li>
                                                                                                                    <li><a href="https://www.marham.pk/doctors/lahore/dermatologist/dr-tariq-niaz-butt">Dr. Tariq Niaz Butt</a></li>
                                                                                                                    <li><a href="https://www.marham.pk/doctors/lahore/dermatologist/dr-anita-kazi">Dr. Anita Kazi</a></li>
                                                                                                            </ul>
                                                                                        <p class="mt-2">View all the qualified <a href="https://www.marham.pk/doctors/dermatologist">Dermatologists available in Pakistan</a> at Marham.pk</p>
                                                    </div>
                                                                    </div>
                </div>
                           <div id="othercities" class="row mt-2 bg-white padding">
           <div class="col-12">
               <h2 class="mb-2">Dermatologist in different cities of Pakistan</h2>
                               <div class="content1">
                                           <ul class="grid-list">
                                                                                                               <li><a href="https://www.marham.pk/online-consultation/dermatologist/abbottabad">Dermatologists in Abbottabad</a></li>
                                                                                                                                               <li><a href="https://www.marham.pk/online-consultation/dermatologist/faisalabad">Dermatologists in Faisalabad</a></li>
                                                                                                                                               <li><a href="https://www.marham.pk/online-consultation/dermatologist/gujranwala">Dermatologists in Gujranwala</a></li>
                                                                                                                                               <li><a href="https://www.marham.pk/online-consultation/dermatologist/haripur">Dermatologists in Haripur</a></li>
                                                                                                                                               <li><a href="https://www.marham.pk/online-consultation/dermatologist/hyderabad">Dermatologists in Hyderabad</a></li>
                                                                                                                                               <li><a href="https://www.marham.pk/online-consultation/dermatologist/islamabad">Dermatologists in Islamabad</a></li>
                                                                                                                                               <li><a href="https://www.marham.pk/online-consultation/dermatologist/karachi">Dermatologists in Karachi</a></li>
                                                                                                                                               <li><a href="https://www.marham.pk/online-consultation/dermatologist/lahore">Dermatologists in Lahore</a></li>
                                                                                                                                               <li><a href="https://www.marham.pk/online-consultation/dermatologist/london">Dermatologists in London</a></li>
                                                                                                                                               <li><a href="https://www.marham.pk/online-consultation/dermatologist/mianwali">Dermatologists in Mianwali</a></li>
                                                                                                                                               <li><a href="https://www.marham.pk/online-consultation/dermatologist/multan">Dermatologists in Multan</a></li>
                                                                                                                                               <li><a href="https://www.marham.pk/online-consultation/dermatologist/okara">Dermatologists in Okara</a></li>
                                                                                                                                               <li><a href="https://www.marham.pk/online-consultation/dermatologist/peshawar">Dermatologists in Peshawar</a></li>
                                                                                                                                               <li><a href="https://www.marham.pk/online-consultation/dermatologist/quetta">Dermatologists in Quetta</a></li>
                                                                                                                                               <li><a href="https://www.marham.pk/online-consultation/dermatologist/rahim-yar-khan">Dermatologists in Rahim Yar Khan</a></li>
                                                                                                                                               <li><a href="https://www.marham.pk/online-consultation/dermatologist/rawalpindi">Dermatologists in Rawalpindi</a></li>
                                                                                                                                               <li><a href="https://www.marham.pk/online-consultation/dermatologist/sadiqabad">Dermatologists in Sadiqabad</a></li>
                                                                                                                                               <li><a href="https://www.marham.pk/online-consultation/dermatologist/sialkot">Dermatologists in Sialkot</a></li>
                                                                                                       </ul>
                                       </div>
                                       </div>
       </div>

                    <button id="load_more_doctors" onclick="javascript:loadMoreDoctors()" class="center button-border" style="margin-top: 2%;"> Load More Dermatologist</button>
            <div id="dom_loader" class="center"></div>
                <div class="row mt-2 bg-white padding">
            <div class="col-12">
                <h2>Why we made this service?</h2>
                <div class="divider"></div>
                <div class="row mt-2">
                    <div class="col-3-sm col-2">
                        <img src="https://h7u5d3a4.stackpathcdn.com/assets/images/team/team/7.jpg" style="width: 100%; border-radius: 50%; box-shadow: 1px 1px 10px #eee; display: block; margin: 0 auto">
                    </div>
                    <div class="col-9-sm col-10">
                        <p class="paragraph" style="font-size: 15px;">Marham is a Pakistani startup & we saw this problem that sometimes it is very difficult for patient to travel or go to doctor due to privacy issue or they cant find 3-4 hours to wait in lobby and get some time from doctor. We as software engineers decided to build an app and website which can help patients in this situation to consult doctor online from anywhere. Patients love <span style="cursor: pointer;" class="show-more" data-content="this service of Marham & It makes me very happy that this team of Pakistan's engineers has done something for people of Pakistan. I love it that we do not work for Foreign clients but for our own people and help them in consult doctor online. Sometime, people who do not even know how to book an appointment, end up sharing their reports with doctor and doing 3-4 video calls. Our support team help every patient. Alhamdulillah"><span style="text-decoration: underline; color: #c02942">Read More</span></span></a></p>
                        <p class="mt-2"><b>- Munam Nauman, A proud software engineer of Pakistan</b></p>
                        <div class="col-12-sm col-4 mb-2">
                            <a href="#" class="button-big cut-margin-bottom scrollTo" data-scroll-to="doctors_div" style="margin-bottom: 10px;">Try our Service</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

                    <div class="row mt-2 bg-white padding">
                <div class="col-12">
                    <h2>What patients say about this service?</h1>
                        <div class="divider"></div>
                </div>
                <div class="col-12">
                    <div id="patiet_reviews">
                        <div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
    <div class="col-2-sm col-1">
        <img class="align-middle" style="padding-right: 5px" src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
    </div>
    <div class="col-10-sm col-11">
        moel - (Verified Patient)<p></p>
        <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
            <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
            <p>Great experience with in depth consultation. </p>
        </div>
        <p class="user-review-detail mt-2">Doctor Name: Dr. Asma Qureshi</p>
    </div>
</div><div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
    <div class="col-2-sm col-1">
        <img class="align-middle" style="padding-right: 5px" src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
    </div>
    <div class="col-10-sm col-11">
        Hanan khan - (Verified Patient)<p></p>
        <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
            <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
            <p>awesome personality</p>
        </div>
        <p class="user-review-detail mt-2">Doctor Name: Dr. Jaffar Ali</p>
    </div>
</div><div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
    <div class="col-2-sm col-1">
        <img class="align-middle" style="padding-right: 5px" src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
    </div>
    <div class="col-10-sm col-11">
        Sakhawat Ali - (Verified Patient)<p></p>
        <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
            <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
            <p>Satisfied
</p>
        </div>
        <p class="user-review-detail mt-2">Doctor Name: Dr. Jaffar Ali</p>
    </div>
</div><div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
    <div class="col-2-sm col-1">
        <img class="align-middle" style="padding-right: 5px" src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
    </div>
    <div class="col-10-sm col-11">
        Fazal Ali - (Verified Patient)<p></p>
        <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
            <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
            <p>Good communication </p>
        </div>
        <p class="user-review-detail mt-2">Doctor Name: Dr. Jaffar Ali</p>
    </div>
</div><div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
    <div class="col-2-sm col-1">
        <img class="align-middle" style="padding-right: 5px" src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
    </div>
    <div class="col-10-sm col-11">
        osama - (Verified Patient)<p></p>
        <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
            <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
            <p>Such a Nice person, firstly he heard my problem and than prescribe the medicine, Humble.</p>
        </div>
        <p class="user-review-detail mt-2">Doctor Name: Dr. Jaffar Ali</p>
    </div>
</div><div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
    <div class="col-2-sm col-1">
        <img class="align-middle" style="padding-right: 5px" src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
    </div>
    <div class="col-10-sm col-11">
        Humda junaid - (Verified Patient)<p></p>
        <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
            <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
            <p>good listner.nice experience </p>
        </div>
        <p class="user-review-detail mt-2">Doctor Name: Dr. Nadia Arshad Chaudhary</p>
    </div>
</div><div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
    <div class="col-2-sm col-1">
        <img class="align-middle" style="padding-right: 5px" src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
    </div>
    <div class="col-10-sm col-11">
        Humda junaid - (Verified Patient)<p></p>
        <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
            <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
            <p>good listener . ..nice experience </p>
        </div>
        <p class="user-review-detail mt-2">Doctor Name: Dr. Nadia Arshad Chaudhary</p>
    </div>
</div><div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
    <div class="col-2-sm col-1">
        <img class="align-middle" style="padding-right: 5px" src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
    </div>
    <div class="col-10-sm col-11">
        Onaiza Umar - (Verified Patient)<p></p>
        <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
            <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
            <p>The doc is very cooperative </p>
        </div>
        <p class="user-review-detail mt-2">Doctor Name: Dr. Mahwish Fawad</p>
    </div>
</div><div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
    <div class="col-2-sm col-1">
        <img class="align-middle" style="padding-right: 5px" src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
    </div>
    <div class="col-10-sm col-11">
        Usman Iftkhar - (Verified Patient)<p></p>
        <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
            <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
            <p>It was good
</p>
        </div>
        <p class="user-review-detail mt-2">Doctor Name: Dr. Zulfiqar Ali</p>
    </div>
</div><div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
    <div class="col-2-sm col-1">
        <img class="align-middle" style="padding-right: 5px" src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
    </div>
    <div class="col-10-sm col-11">
        Tanveer Qamar - (Verified Patient)<p></p>
        <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
            <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
            <p>I am very satisfied</p>
        </div>
        <p class="user-review-detail mt-2">Doctor Name: Dr. Zulfiqar Ali</p>
    </div>
</div><div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
    <div class="col-2-sm col-1">
        <img class="align-middle" style="padding-right: 5px" src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
    </div>
    <div class="col-10-sm col-11">
        MOHAMMAD HAMZA - (Verified Patient)<p></p>
        <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
            <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
            <p>good
</p>
        </div>
        <p class="user-review-detail mt-2">Doctor Name: Dr. Zareen Saqib Suleri</p>
    </div>
</div><div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
    <div class="col-2-sm col-1">
        <img class="align-middle" style="padding-right: 5px" src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
    </div>
    <div class="col-10-sm col-11">
        Mariam Haq - (Verified Patient)<p></p>
        <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
            <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
            <p>it was good Alhumdulillah</p>
        </div>
        <p class="user-review-detail mt-2">Doctor Name: Dr. Nadia Arshad Chaudhary</p>
    </div>
</div><div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
    <div class="col-2-sm col-1">
        <img class="align-middle" style="padding-right: 5px" src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
    </div>
    <div class="col-10-sm col-11">
        Amna Shahid - (Verified Patient)<p></p>
        <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
            <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
            <p>She listened effectively and suggested me with good treatment. good experience</p>
        </div>
        <p class="user-review-detail mt-2">Doctor Name: Dr. Nadia Arshad Chaudhary</p>
    </div>
</div><div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
    <div class="col-2-sm col-1">
        <img class="align-middle" style="padding-right: 5px" src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
    </div>
    <div class="col-10-sm col-11">
        Asim - (Verified Patient)<p></p>
        <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
            <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
            <p>nice doctor ðŸ‘</p>
        </div>
        <p class="user-review-detail mt-2">Doctor Name: Dr. Jaffar Ali</p>
    </div>
</div><div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
    <div class="col-2-sm col-1">
        <img class="align-middle" style="padding-right: 5px" src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
    </div>
    <div class="col-10-sm col-11">
        Aneela khaliq - (Verified Patient)<p></p>
        <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
            <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
            <p>I'm satisfied with doctor consultion.  it ended good </p>
        </div>
        <p class="user-review-detail mt-2">Doctor Name: Dr. Nadia Arshad Chaudhary</p>
    </div>
</div><div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
    <div class="col-2-sm col-1">
        <img class="align-middle" style="padding-right: 5px" src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
    </div>
    <div class="col-10-sm col-11">
        Talia - (Verified Patient)<p></p>
        <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
            <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
            <p>The only lack was on the call scheduling by Marham as I selected the slot of 7pm and got it scheduled for 8:50pm however the video quality of call really needs some improvements and so as the voice and Dr. Zafar has examined my problem very well and properly and I hope to get well according to his prescription.</p>
        </div>
        <p class="user-review-detail mt-2">Doctor Name: Dr. Zafar Ahmed</p>
    </div>
</div><div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
    <div class="col-2-sm col-1">
        <img class="align-middle" style="padding-right: 5px" src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
    </div>
    <div class="col-10-sm col-11">
        Raza Imran - (Verified Patient)<p></p>
        <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
            <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
            <p>excellent work </p>
        </div>
        <p class="user-review-detail mt-2">Doctor Name: Dr. Nadia Arshad Chaudhary</p>
    </div>
</div><div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
    <div class="col-2-sm col-1">
        <img class="align-middle" style="padding-right: 5px" src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
    </div>
    <div class="col-10-sm col-11">
        Alishba - (Verified Patient)<p></p>
        <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
            <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
            <p>good experience</p>
        </div>
        <p class="user-review-detail mt-2">Doctor Name: Dr. Zareen Saqib Suleri</p>
    </div>
</div><div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
    <div class="col-2-sm col-1">
        <img class="align-middle" style="padding-right: 5px" src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
    </div>
    <div class="col-10-sm col-11">
        Cinerella Kiddies - (Verified Patient)<p></p>
        <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
            <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
            <p>it was good.</p>
        </div>
        <p class="user-review-detail mt-2">Doctor Name: Dr. Jaffar Ali</p>
    </div>
</div><div class="row mt-4" style="padding-bottom: 10px; border-bottom: 1px solid #eee;">
    <div class="col-2-sm col-1">
        <img class="align-middle" style="padding-right: 5px" src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" height="40" weight="40" alt="patient-review-image">
    </div>
    <div class="col-10-sm col-11">
        Ms.zaheer - (Verified Patient)<p></p>
        <div style="background-color: #f7f7f7; display: block; border-radius: 4px; padding: 10px;" class="mt-2">
            <p><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></p>
            <p>Doctor listen to me with patience, not like when you visit any doctor physically, he was in no haste which was impressive. Good Job team 
 Marham 
</p>
        </div>
        <p class="user-review-detail mt-2">Doctor Name: Dr. Jaffar Ali</p>
    </div>
</div>                  </div>
                                            <div id="dom_loader" class="center"></div>
                        <button id="load_more_reviews" onclick="loadMoreReviews()" class="center button-border" style="margin-top: 2%"> + View More Reviews</button>
                                    </div>

                <div class="col-12-sm col-12 mb-2">
                    <center><a href="#" class="button-big cut-margin-bottom scrollTo" data-scroll-to="doctors_div" style="margin-bottom: 10px;">Consult Now & Get Help</a></center>
                </div>
            </div>
        
    </div>

    <div id="contact_modal" class="modal">
    <div class="modal-content">
        <span class="close" data-modal="contact_modal" onclick="toggleModal(event, 'contact_modal', 'hide')">&times;</span>
        <h3>Call Here:</h3>
                <button class="mt-2 button-main" onclick="location.href='tel:042-32591427'"><i class="fa fa-phone"></i> Call 042-32591427</button> <br>
                <button class="mt-2 button-main" onclick="location.href='tel:042-32591429'"><i class="fa fa-phone"></i> Call 042-32591429</button>
    </div>
</div>  <div id="city_modal" class="modal">
    <div class="modal-content" style="padding-top: 30px; padding-bottom: 30px;">
        <span class="close" data-modal="city_modal" onclick="toggleModal(event, 'city_modal', 'hide')">&times;</span>
        <p style="font-size: 18px; margin-bottom: 30px;"> Please select your City</p>
        <ul class="grid-list">
                                    <li class="city-name" data-slug="lahore">
                <label for="city_1">Lahore</label>
            </li>
                        <li class="city-name" data-slug="karachi">
                <label for="city_2">Karachi</label>
            </li>
                        <li class="city-name" data-slug="islamabad">
                <label for="city_3">Islamabad</label>
            </li>
                        <li class="city-name" data-slug="rawalpindi">
                <label for="city_6">Rawalpindi</label>
            </li>
                        <li class="city-name" data-slug="faisalabad">
                <label for="city_5">Faisalabad</label>
            </li>
                        <li class="city-name" data-slug="peshawar">
                <label for="city_26">Peshawar</label>
            </li>
                        <li class="city-name" data-slug="multan">
                <label for="city_4">Multan</label>
            </li>
                        <li class="city-name" data-slug="quetta">
                <label for="city_43">Quetta</label>
            </li>
                        <li class="city-name" data-slug="gujranwala">
                <label for="city_19">Gujranwala</label>
            </li>
                        <li class="city-name" data-slug="sargodha">
                <label for="city_7">Sargodha</label>
            </li>
                                    <div class="mt-4">
                <select id="other_cities" name="other_cities">
                    <option>-- Choose Other City --</option>
                                        <option value="abbottabad">Abbottabad</option>
                                        <option value="attock">Attock</option>
                                        <option value="bahawalnagar">Bahawalnagar</option>
                                        <option value="bahawalpur">Bahawalpur</option>
                                        <option value="bannu">Bannu</option>
                                        <option value="bhakkar">Bhakkar</option>
                                        <option value="bhalwal">Bhalwal</option>
                                        <option value="burewala">Burewala</option>
                                        <option value="chakwal">Chakwal</option>
                                        <option value="charsadda">Charsadda</option>
                                        <option value="chishtian">Chishtian</option>
                                        <option value="daska">Daska</option>
                                        <option value="dera-ghazi-khan">Dera Ghazi Khan</option>
                                        <option value="dina">Dina</option>
                                        <option value="gojra">Gojra</option>
                                        <option value="gujrat">Gujrat</option>
                                        <option value="hafizabad">Hafizabad</option>
                                        <option value="hyderabad">Hyderabad</option>
                                        <option value="istanbul">Istanbul</option>
                                        <option value="izmir">Izmir</option>
                                        <option value="jacobabad">Jacobabad</option>
                                        <option value="jhang">Jhang</option>
                                        <option value="jhelum">Jhelum</option>
                                        <option value="kamoke">Kamoke</option>
                                        <option value="kasur">Kasur</option>
                                        <option value="kayseri">Kayseri</option>
                                        <option value="khanewal">Khanewal</option>
                                        <option value="kharian">kharian</option>
                                        <option value="khushab">Khushab</option>
                                        <option value="kohat">Kohat</option>
                                        <option value="larkana">Larkana</option>
                                        <option value="layyah">Layyah</option>
                                        <option value="lodhran">Lodhran</option>
                                        <option value="loralai">Loralai</option>
                                        <option value="mansehra">Mansehra</option>
                                        <option value="mardan">Mardan</option>
                                        <option value="mian-channu">Mian Channu</option>
                                        <option value="mianwali">Mianwali</option>
                                        <option value="nankana-sahib">Nankana Sahib</option>
                                        <option value="nawabshah">Nawabshah</option>
                                        <option value="nowshera">Nowshera</option>
                                        <option value="okara">Okara</option>
                                        <option value="pattoki">Pattoki</option>
                                        <option value="rahim-yar-khan">Rahim Yar Khan</option>
                                        <option value="riyadh">Riyadh</option>
                                        <option value="sahiwal">Sahiwal</option>
                                        <option value="shahkot">Shahkot</option>
                                        <option value="sheikhupura">Sheikhupura</option>
                                        <option value="shorkot">shorkot</option>
                                        <option value="sialkot">Sialkot</option>
                                        <option value="swabi">Swabi</option>
                                        <option value="swat">Swat</option>
                                        <option value="talagang">Talagang</option>
                                        <option value="tarbela">Tarbela</option>
                                        <option value="taxila">Taxila</option>
                                        <option value="vehari">Vehari</option>
                                        <option value="wah-cantt">Wah Cantt</option>
                                    </select>
            </div>
        </ul>
    </div>
</div>  



</body>
</html>
@endsection