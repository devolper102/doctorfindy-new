@extends('front-end.master') @section('description', '') @section('keywords', '') @section('content')


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
</div>  
<div class="container mt-1">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="row p-2" style="border-bottom: 1px solid #f1f4f8">
                <div class="col-12">
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li><a href="#/find-a-doctor">Find A Doctor</a></li>
                        <li><a href="#/doctors/lahore">Lahore</a></li>
                        <li><a href="#/doctors/lahore/dermatologist">Dermatologist</a></li>
                        <li><a href="#/doctors/lahore/dermatologist/dr-umer-mushtaq">Dr. Umer Mushtaq</a></li>
                        <li>Callcenter</li>
                    </ul>
                </div>
            </div>

            <div class="row bg-white mb-2 row-margin-cut">
                <div class="col-3 col-md-2 p-4">
                                        <img src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/5396/dr-umer-mushtaq-dermatologist-lahore_170X170.jpg" alt="dr-umer-mushtaq-dermatologist-lahore" class="" onerror="revertBackToDiv(this.parentNode, '#/doctors/lahore/dermatologist/dr-umer-mushtaq')" onclick="location.href='#/doctors/lahore/dermatologist/dr-umer-mushtaq'" style="width: 100%; height: auto;">
                                    </div>
                <div class="col-7 col-md-9 mb-2">
                    <h1 class="pt-md-4 pt-3" style="font-size: 14px;">
                        Book Appointment with Dr. Umer Mushtaq
                    </h1>
                    <p class="mt-1">Chughtai Medical Center (Lahore)</p>
                    <p><b>Fee: Rs. 2000</b></p>
                </div>
                <div class="col-2 col-md-1 p-3">
                    <a href="tel:042-32591427" class="ga-goal-20 fb-pixel-purchase" data-doctor-id="5396" data-speciality-id="67" data-label="dr-umer-mushtaq-dermatologist" data-value="600"><i class="fa fa-phone right" style="color: #014e78; font-size: 24px; padding-top: 3px;" aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="row bg-white row-margin-cut">
                <div class="col-12 col-md-12">
                    <div class="slideshow-container">
                                                                        <div class="mySlides fade">
                            <div class="row">
                                                                <div class="col-12 col-md-4">
                                    <button class="appointment-date button-date  button-date-active " data-doctor-hospital-id="7776" data-date="2020-07-13" data-human-readable-date="Mon, Jul 13">Mon, Jul 13</button>
                                </div>
                                                                <div class="col-12 col-md-4">
                                    <button class="appointment-date button-date " data-doctor-hospital-id="7776" data-date="2020-07-14" data-human-readable-date="Tue, Jul 14">Tue, Jul 14</button>
                                </div>
                                                                <div class="col-12 col-md-4">
                                    <button class="appointment-date button-date " data-doctor-hospital-id="7776" data-date="2020-07-15" data-human-readable-date="Wed, Jul 15">Wed, Jul 15</button>
                                </div>
                                                            </div>
                        </div>
                                                <div class="mySlides fade">
                            <div class="row">
                                                                <div class="col-12 col-md-4">
                                    <button class="appointment-date button-date  button-date-active " data-doctor-hospital-id="7776" data-date="2020-07-16" data-human-readable-date="Thu, Jul 16">Thu, Jul 16</button>
                                </div>
                                                                <div class="col-12 col-md-4">
                                    <button class="appointment-date button-date " data-doctor-hospital-id="7776" data-date="2020-07-17" data-human-readable-date="Fri, Jul 17">Fri, Jul 17</button>
                                </div>
                                                                <div class="col-12 col-md-4">
                                    <button class="appointment-date button-date " data-doctor-hospital-id="7776" data-date="2020-07-18" data-human-readable-date="Sat, Jul 18">Sat, Jul 18</button>
                                </div>
                                                            </div>
                        </div>
                                                <div class="mySlides fade">
                            <div class="row">
                                                                <div class="col-12 col-md-4">
                                    <button class="appointment-date button-date  button-date-active " data-doctor-hospital-id="7776" data-date="2020-07-20" data-human-readable-date="Mon, Jul 20">Mon, Jul 20</button>
                                </div>
                                                                <div class="col-12 col-md-4">
                                    <button class="appointment-date button-date " data-doctor-hospital-id="7776" data-date="2020-07-21" data-human-readable-date="Tue, Jul 21">Tue, Jul 21</button>
                                </div>
                                                                <div class="col-12 col-md-4">
                                    <button class="appointment-date button-date " data-doctor-hospital-id="7776" data-date="2020-07-22" data-human-readable-date="Wed, Jul 22">Wed, Jul 22</button>
                                </div>
                                                            </div>
                        </div>
                                                <div class="mySlides fade">
                            <div class="row">
                                                                <div class="col-12 col-md-4">
                                    <button class="appointment-date button-date  button-date-active " data-doctor-hospital-id="7776" data-date="2020-07-23" data-human-readable-date="Thu, Jul 23">Thu, Jul 23</button>
                                </div>
                                                                <div class="col-12 col-md-4">
                                    <button class="appointment-date button-date " data-doctor-hospital-id="7776" data-date="2020-07-24" data-human-readable-date="Fri, Jul 24">Fri, Jul 24</button>
                                </div>
                                                                <div class="col-12 col-md-4">
                                    <button class="appointment-date button-date " data-doctor-hospital-id="7776" data-date="2020-07-25" data-human-readable-date="Sat, Jul 25">Sat, Jul 25</button>
                                </div>
                                                            </div>
                        </div>
                                                <div class="mySlides fade">
                            <div class="row">
                                                                <div class="col-12 col-md-4">
                                    <button class="appointment-date button-date  button-date-active " data-doctor-hospital-id="7776" data-date="2020-07-27" data-human-readable-date="Mon, Jul 27">Mon, Jul 27</button>
                                </div>
                                                                <div class="col-12 col-md-4">
                                    <button class="appointment-date button-date " data-doctor-hospital-id="7776" data-date="2020-07-28" data-human-readable-date="Tue, Jul 28">Tue, Jul 28</button>
                                </div>
                                                                <div class="col-12 col-md-4">
                                    <button class="appointment-date button-date " data-doctor-hospital-id="7776" data-date="2020-07-29" data-human-readable-date="Wed, Jul 29">Wed, Jul 29</button>
                                </div>
                                                            </div>
                        </div>
                                                                    </div>
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                </div>
                <br>
            </div>
            <div class="row bg-white mb-1 justify-content-center row-margin-cut section-request-form">
                <div class="col-12 col-md-10">
                    <form id="appointment_form" action="#/api/doctor-detail/save-appointment-request">
                        <span id="doctor_hospital_span_7776" data-label="dr-umer-mushtaq-dermatologist" data-value="600" data-doctor-id="5396" data-speciality-id="67" dhId="7776"></span>
                        <input type="checkbox" name="i_agree" style="display: none">
                        <div style="text-align:center;margin-top:20px;" class="mb-4">
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                        </div>
                        <div id="first-tab" class="tab">
                            <p class="mt-1">Timings: 06:00 PM - 09:00 PM</p>
                            <p style="font-size: 14px; padding-top:0px; color: #c02942">Select time to book appointment.</p>

                            <ul id="time-list" class="time-list pt-4">
                            </ul>
                        </div>
                        <div id="second-tab" class="tab p-3">
                            <div class="row justify-content-center">
                                <div class="col-md-8 mb-4 mt-2">
                                    <!-- <img src="https://h7u5d3a4.stackpathcdn.com/assets/images/time-slot.png" style="display: block; margin:auto;"> -->
                                    <p class="center justify-content-center"><img src="https://h7u5d3a4.stackpathcdn.com/assets/images/done.png" width="24" height="24"><span class="requested_time green-text pl-2" style="font-size: 24px">7:00 PM</span></p>
                                    <p style="font-size: 12px; padding-top:15px;">To confirm your appointment with Dr. Umer Mushtaq, We need your phone number.</p>
                                    <input type="text" id="patient_phone" name="patient_phone" placeholder="Add Mobile Number e.g 03xx1234567" class="u-full-width" required="required">
                                    <button type="button" onclick="nextPrev(1)" class="mt-4 button-big" style="width: 100%;">Continue</button>
                                </div>
                            </div>
                        </div>
                        <div id="third-tab" class="tab p-3">
                            <div class="row justify-content-center">
                                <div class="col-md-8 mb-4 mt-4">
                                    <img class="lazy-image" data-src="https://h7u5d3a4.stackpathcdn.com/assets/images/user.png" style="display: block; margin:auto;" class="mb-4">
                                    <p style="font-size: 12px; padding-top:30px;">Add the name of patient so doctor and his assistant know you</p>
                                    <input type="text" id="patient_name" name="patient_name" placeholder="Add Patient Name e.g Arshad Razzaq" class="u-full-width" required>
                                    <button type="button" onclick="nextPrev(1)" class="mt-4 button-big" style="width: 100%;">Done</button>
                                </div>
                            </div>
                        </div>
                        <div id="fourth-tab" class="tab">
                            <div class="row justify-content-center">
                                <div class="col-md-8 mb-4 mt-4">
                                    <div class="p-3">
                                        <img src="https://h7u5d3a4.stackpathcdn.com/assets/images/done.png" style="display: block; margin:auto;" class="mb-4">
                                        <p class="" style="text-align: justify;"><b>Your Appoitnment Request has been sent to Dr. Umer Mushtaq for Confirmation.</b> <span style="color: #02942;">You will receive an SMS when appointment is confirmed.</span></p>
                                        <div class="divider"></div>
                                        <div class="mb-2">
                                            <div class="list-grid-70 mt-4">
                                                <span>Requested Time</span>
                                                <span id="display_requested_time" class="requested_time right light-grey">7:00 PM</span>
                                            </div>

                                            <div class="list-grid-70 mt-4">
                                                <span>Appointment Date</span>
                                                <span id="display_requested_date" class="right light-grey">April 30</span>
                                            </div>

                                            <div class="list-grid-70 mt-4">
                                                <span>Mobile Number</span>
                                                <span id="display_patient_phone" class="right light-grey">03341006561</span>
                                            </div>

                                            <div class="list-grid-70 mt-4">
                                                <span>Patient Name</span>
                                                <span id="display_patient_name" class="right light-grey">Asma</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
   
@endsection