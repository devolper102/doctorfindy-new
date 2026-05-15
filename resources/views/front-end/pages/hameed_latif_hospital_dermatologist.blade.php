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
</div>      <div class="container">

    <div class="row mt-2 bg-white padding">
        <div class="col-12">
            <ul class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#/hospitals-in-pakistan">All Hospitals</a></li>
                <li><a href="#/hospitals/lahore">Hospitals in Lahore</a></li>
                <li>Hameed Latif Hospital</li>
            </ul>
        </div>
    </div>

    <div class="row bg-white padding mt-2">
    <div class="col-12">
        <div class="col-3-sm col-2">
                        <div class="profile-photo lazy-image" data-src="https://h7u5d3a4.stackpathcdn.com/assets/hospitals/37/hameed-latif-hospital-27_80X80.jpg" data-alt="Hameed Latif Hospital Image"></div>
                    </div>
        <div class="col-9-sm col-10">
            <div class="pl-2">
                <h1>Hameed Latif Hospital</h1>
                <p>Hameed Latif Hospital, 14 New Abu Bakar Block, New Garden Town, Garden Town, Lahore</p>
                                <p>144 Doctors Onboard</p>
                                                <div class="col-4">
                    <button class="mt-2 button-main" onclick="location.href='tel:04235862623'">Call 04235862623</button>
                </div>
                            </div>
        </div>
    </div>
</div>
    <div class="row mt-2 bg-white padding online-snippet-row" >
    <div class="col-3-sm col-1">
        <img class="lazy-image" style="min-height: 80px; min-width: 80px; max-height: 80px; max-width: 80px" data-src="https://h7u5d3a4.stackpathcdn.com/assets/images/icons/icon-online-consultation.png" alt="Consult Online" width="80" height="80">
    </div>
    <div class="col-8-sm col-6 online-snippet" style="min-height: 136px; max-height: 136px">
        <p style="font-size: 18px; color: #fff;">Consult Best Doctors Online From Home</p>
        <ul class="simple-inline-list">
            <li><i class="fa fa-check fa-fw" style="padding-top: 6px; padding-right: 5px; color: #fce2e7;"></i> Secure Video Call</li>
            <li><i class="fa fa-check fa-fw" style="padding-top: 6px; padding-right: 5px; color: #fce2e7;"></i> Prescription</li>
            <li><i class="fa fa-check fa-fw" style="padding-top: 6px; padding-right: 5px; color: #fce2e7;"></i> Reports Sharing</li>
        </ul>
    </div>
    <div class="col-12-sm col-4">
        <a href="#/online-consultation" class="button-big button-online-snippet ga-event-oc-banner-button"> <i class="fa fa-video" style="color: #c02942"></i> View Online Doctors</a>
    </div>
</div>    
        <div class="row bg-white padding mt-2">
                                <div class="col-12">
            <h2>Available Doctors</h2>
            <div class="row">
                <div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/2899/dr-salman-javed-gastroenterologist-lahore_80X80.jpg" data-alt="dr-salman-javed-gastroenterologist-lahore" data-url="#/doctors/lahore/gastroenterologist/dr-salman-javed"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gastroenterologist/dr-salman-javed">Dr. Salman Javed</a></h3>
                                                <p>Gastroenterologist</p>
                                <p><i class="fa fa-comment"></i> 814 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 14 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gastroenterologist/dr-salman-javed'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/9418/dr-muhammad-hammad-ayub-eye-surgeon-lahore-49_80X80.jpg" data-alt="dr-muhammad-hammad-ayub-eye-surgeon-lahore" data-url="#/doctors/lahore/eye-surgeon/dr-muhammad-hammad-ayub"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/eye-surgeon/dr-muhammad-hammad-ayub">Dr. Muhammad Hammad Ayub</a></h3>
                                                <p>Eye Surgeon</p>
                                <p><i class="fa fa-comment"></i> 25 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 17 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/eye-surgeon/dr-muhammad-hammad-ayub'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/2919/dr-muhammad-mujtaba-psychiatrist-lahore_80X80.jpg" data-alt="dr-muhammad-mujtaba-psychiatrist-lahore" data-url="#/doctors/lahore/psychiatrist/dr-muhammad-mujtaba"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/psychiatrist/dr-muhammad-mujtaba">Dr. Muhammad Mujtaba</a></h3>
                                                <p>Psychiatrist</p>
                                <p><i class="fa fa-comment"></i> 219 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 15 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/psychiatrist/dr-muhammad-mujtaba'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/7227/dr-nazli-hameed-gynecologist-lahore_80X80.JPG" data-alt="dr-nazli-hameed-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-nazli-hameed"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-nazli-hameed">Dr. Nazli Hameed</a></h3>
                                <p>Gynecologist</p>
                                <p><i class="fa fa-comment"></i> 235 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 30 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-nazli-hameed'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/2879/dr-brigr-ramzan-chaudhry-androurologist-lahore_80X80.jpg" data-alt="dr-brig-r-ramzan-chaudhry-endourologist-lahore" data-url="#/doctors/lahore/endourologist/dr-brig-r-ramzan-chaudhry"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/endourologist/dr-brig-r-ramzan-chaudhry">Dr. Brig R Ramzan Chaudhry</a></h3>
                                                <p>Endourologist</p>
                                <p><i class="fa fa-comment"></i> 178 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 40 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/endourologist/dr-brig-r-ramzan-chaudhry'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/5169/dr-ayesha-shahid-sheikh-psychologist-lahore_80X80.jpg" data-alt="dr-ayesha-shahid-sheikh-psychologist-lahore" data-url="#/doctors/lahore/psychologist/dr-ayesha-shahid-sheikh"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/psychologist/dr-ayesha-shahid-sheikh">Dr. Ayesha Shahid Sheikh</a></h3>
                                                <p>Psychologist</p>
                                <p><i class="fa fa-comment"></i> 115 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 5 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/psychologist/dr-ayesha-shahid-sheikh'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div>            </div>
            <h3>Book Appointment with Top Doctors in Lahore</h3>
            <ul class="grid-list">
                <li><a class="ga-event-onpanel-hospital-profile-top-doctors" href="#/doctors/lahore/urologist">Best Urologist in Lahore</a></li>
                <li><a class="ga-event-onpanel-hospital-profile-top-doctors" href="#/doctors/lahore/dermatologist">Best Dermatologist in Lahore</a></li>
                <li><a class="ga-event-onpanel-hospital-profile-top-doctors" href="#/doctors/lahore/psychiatrist">Best Psychiatrist in Lahore</a></li>
                <li><a class="ga-event-onpanel-hospital-profile-top-doctors" href="#/doctors/lahore/gastroenterologist">Best Gastroenterologist in Lahore</a></li>
                <li><a class="ga-event-onpanel-hospital-profile-top-doctors" href="#/doctors/lahore/gynecologist">Best Gynecologist in Lahore</a></li>
                <li><a class="ga-event-onpanel-hospital-profile-top-doctors" href="#/doctors/lahore/neuro-physician">Best Neuro Physician in Lahore</a></li>
                <li><a class="ga-event-onpanel-hospital-profile-top-doctors" href="#/doctors/lahore/psychologist">Best Psychologist in Lahore</a></li>
                <li><a class="ga-event-onpanel-hospital-profile-top-doctors" href="#/doctors/lahore/general-physician">Best General Physician in Lahore</a></li>
                <li><a class="ga-event-onpanel-hospital-profile-top-doctors" href="#/doctors/lahore/pulmonologist">Best Pulmonologist in Lahore</a></li>
                <li><a class="ga-event-onpanel-hospital-profile-top-doctors" href="#/doctors/lahore/nutritionist">Best Nutritionist in Lahore</a></li>
                <li><a class="ga-event-onpanel-hospital-profile-top-doctors" href="#/doctors/lahore/nephrologist">Best Nephrologist in Lahore</a></li>
                <li><a class="ga-event-offpanel-doctor-top-doctors" href="#/find-a-doctor">See All Specialities</a></li>
            </ul>
            <div class="row">
                <div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/4483/dr-rashid-imran-neurologist-lahore_80X80.jpg" data-alt="dr-rashid-imran-neurologist-lahore" data-url="#/doctors/lahore/neuro-physician/dr-rashid-imran"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/neuro-physician/dr-rashid-imran">Dr. Rashid Imran</a></h3>
                                                <p>Neurologist</p>
                                <p><i class="fa fa-comment"></i> 161 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 13 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/neuro-physician/dr-rashid-imran'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/7776/dr-jaida-manzoor-endocrinologist-lahore_80X80.jpg" data-alt="dr-jaida-manzoor-endocrinologist-lahore" data-url="#/doctors/lahore/endocrinologist/dr-jaida-manzoor"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/endocrinologist/dr-jaida-manzoor">Dr. Jaida Manzoor</a></h3>
                                <p>Endocrinologist</p>
                                <p><i class="fa fa-comment"></i> 173 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 15 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/endocrinologist/dr-jaida-manzoor'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/7804/dr-muhammad-bilal-orthopedic-surgeon-lahore-5_80X80.jpg" data-alt="dr-muhammad-bilal-orthopedic-surgeon-lahore" data-url="#/doctors/lahore/orthopedic-surgeon/dr-muhammad-bilal"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/orthopedic-surgeon/dr-muhammad-bilal">Dr. Muhammad Bilal</a></h3>
                                                <p>Orthopedic Surgeon</p>
                                <p><i class="fa fa-comment"></i> 47 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 14 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/orthopedic-surgeon/dr-muhammad-bilal'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/8716/dr-muhammad-usman-amir-rheumatologist-lahore-26_80X80.jpg" data-alt="dr-muhammad-usman-amir-rheumatologist-lahore" data-url="#/doctors/lahore/rheumatologist/dr-muhammad-usman-amir"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/rheumatologist/dr-muhammad-usman-amir">Dr. Muhammad Usman Amir</a></h3>
                                                <p>Rheumatologist</p>
                                <p><i class="fa fa-comment"></i> 78 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 20 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/rheumatologist/dr-muhammad-usman-amir'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/2916/dr-junaid-zaffar-cardiologist-lahore_80X80.jpg" data-alt="dr-junaid-zaffar-cardiologist-lahore" data-url="#/doctors/lahore/cardiologist/dr-junaid-zaffar"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/cardiologist/dr-junaid-zaffar">Dr. Junaid Zaffar</a></h3>
                                                <p>Cardiologist</p>
                                <p><i class="fa fa-comment"></i> 75 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 19 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/cardiologist/dr-junaid-zaffar'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-fawad-ahmad-randhawa-endocrinologist-lahore" data-url="#/doctors/lahore/endocrinologist/dr-fawad-ahmad-randhawa"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/endocrinologist/dr-fawad-ahmad-randhawa">Dr. Fawad Ahmad Randhawa</a></h3>
                                                <p>Endocrinologist</p>
                                <p><i class="fa fa-comment"></i> 105 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 12 Years of Experience</p>
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/endocrinologist/dr-fawad-ahmad-randhawa'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/7322/dr-shaila-ali-pediatric-neuro-physician-lahore-13_80X80.jpg" data-alt="dr-shaila-ali-pediatric-neuro-physician-lahore" data-url="#/doctors/lahore/pediatric-neuro-physician/dr-shaila-ali"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/pediatric-neuro-physician/dr-shaila-ali">Dr. Shaila Ali</a></h3>
                                <p>Pediatric Neuro Physician</p>
                                <p><i class="fa fa-comment"></i> 46 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 11 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/pediatric-neuro-physician/dr-shaila-ali'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/7569/dr-rabia-wajid-gynecologist-lahore_80X80.jpg" data-alt="dr-rabia-wajid-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-rabia-wajid"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-rabia-wajid">Dr. Rabia Wajid</a></h3>
                                                <p>Gynecologist</p>
                                <p><i class="fa fa-comment"></i> 48 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 19 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-rabia-wajid'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/2898/dr-asif-mehmood-gastroenterologist-lahore_80X80.jpg" data-alt="dr-asif-mehmood-gastroenterologist-lahore" data-url="#/doctors/lahore/gastroenterologist/dr-asif-mehmood"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gastroenterologist/dr-asif-mehmood">Dr. Asif Mehmood</a></h3>
                                                <p>Gastroenterologist</p>
                                <p><i class="fa fa-comment"></i> 46 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 12 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gastroenterologist/dr-asif-mehmood'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-farhat-rashid-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-farhat-rashid"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-farhat-rashid">Dr. Farhat Rashid</a></h3>
                                <p>Gynecologist</p>
                                <p><i class="fa fa-comment"></i> 55 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 24 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-farhat-rashid'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/2874/dr-zahid-mahmood-general-surgeon-lahore_80X80.jpg" data-alt="dr-zahid-mahmood-general-surgeon-lahore" data-url="#/doctors/lahore/general-surgeon/dr-zahid-mahmood"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/general-surgeon/dr-zahid-mahmood">Dr. Zahid Mahmood</a></h3>
                                                <p>General Surgeon</p>
                                <p><i class="fa fa-comment"></i> 26 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 25 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/general-surgeon/dr-zahid-mahmood'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/9036/dr-nabeel-iqbal-eye-surgeon-lahore-20_80X80.jpg" data-alt="dr-nabeel-iqbal-eye-surgeon-lahore" data-url="#/doctors/lahore/eye-surgeon/dr-nabeel-iqbal"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/eye-surgeon/dr-nabeel-iqbal">Dr. Nabeel Iqbal</a></h3>
                                                <p>Eye Surgeon</p>
                                <p><i class="fa fa-comment"></i> 50 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 6 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/eye-surgeon/dr-nabeel-iqbal'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/2924/dr-saeed-aftab-ahmed-pediatrician-lahore-41_80X80.jpg" data-alt="dr-saeed-aftab-ahmed-pediatrician-lahore" data-url="#/doctors/lahore/pediatrician/dr-saeed-aftab-ahmed"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/pediatrician/dr-saeed-aftab-ahmed">Dr. Saeed Aftab Ahmed</a></h3>
                                                <p>Pediatrician</p>
                                <p><i class="fa fa-comment"></i> 17 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 22 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/pediatrician/dr-saeed-aftab-ahmed'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/7561/dr-zeeshan-muneer-pediatrician-lahore_80X80.jpg" data-alt="dr-zeeshan-muneer-pediatrician-lahore" data-url="#/doctors/lahore/pediatrician/dr-zeeshan-muneer"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/pediatrician/dr-zeeshan-muneer">Dr. Zeeshan Muneer</a></h3>
                                                <p>Pediatrician</p>
                                <p><i class="fa fa-comment"></i> 14 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 7 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/pediatrician/dr-zeeshan-muneer'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/8536/prof-dr-muhammad-haroon-hamid-pediatrician-lahore-8_80X80.jpg" data-alt="prof-dr-muhammad-haroon-hamid-pediatrician-lahore" data-url="#/doctors/lahore/pediatrician/prof-dr-muhammad-haroon-hamid"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/pediatrician/prof-dr-muhammad-haroon-hamid">Prof. Dr. Muhammad Haroon Hamid</a></h3>
                                                <p>Pediatrician</p>
                                <p><i class="fa fa-comment"></i> 25 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 25 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/pediatrician/prof-dr-muhammad-haroon-hamid'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-naheed-akhtar-rana-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-naheed-akhtar-rana"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-naheed-akhtar-rana">Dr. Naheed Akhtar Rana</a></h3>
                                                <p>Gynecologist</p>
                                <p><i class="fa fa-comment"></i> 8 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 35 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-naheed-akhtar-rana'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/7108/dr-muhammad-suleman-khan-cardiologist-lahore_80X80.jpg" data-alt="dr-muhammad-suleman-khan-cardiologist-lahore" data-url="#/doctors/lahore/cardiologist/dr-muhammad-suleman-khan"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/cardiologist/dr-muhammad-suleman-khan">Dr. Muhammad Suleman Khan</a></h3>
                                                <p>Cardiologist</p>
                                <p><i class="fa fa-comment"></i> 13 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 10 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/cardiologist/dr-muhammad-suleman-khan'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/13217/dr-muhammad-aamir-nephrologist-lahore-35_80X80.jpg" data-alt="dr-muhammad-aamir-nephrologist-lahore" data-url="#/doctors/lahore/nephrologist/dr-muhammad-aamir"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/nephrologist/dr-muhammad-aamir">Dr. Muhammad Aamir</a></h3>
                                <p>Nephrologist</p>
                                <p><i class="fa fa-comment"></i> 16 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 10 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/nephrologist/dr-muhammad-aamir'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/10321/dr-amjad-saeed-mian-general-surgeon-lahore-18_80X80.jpg" data-alt="dr-amjad-saeed-mian-general-surgeon-lahore" data-url="#/doctors/lahore/general-surgeon/dr-amjad-saeed-mian"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/general-surgeon/dr-amjad-saeed-mian">Dr. Amjad Saeed Mian</a></h3>
                                                <p>General Surgeon</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 35 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/general-surgeon/dr-amjad-saeed-mian'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/16371/dr-amer-ahmad-khan-gastroenterologist-lahore-33_80X80.jpg" data-alt="dr-amer-ahmad-khan-gastroenterologist-lahore" data-url="#/doctors/lahore/gastroenterologist/dr-amer-ahmad-khan"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gastroenterologist/dr-amer-ahmad-khan">Dr. Amer Ahmad Khan</a></h3>
                                <p>Gastroenterologist</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 31 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gastroenterologist/dr-amer-ahmad-khan'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/13934/dr-farooq-malik-urologist-lahore-12_80X80.jpg" data-alt="dr-farooq-malik-urologist-lahore" data-url="#/doctors/lahore/urologist/dr-farooq-malik"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/urologist/dr-farooq-malik">Dr. Farooq Malik</a></h3>
                                                <p>Urologist</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 16 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/urologist/dr-farooq-malik'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/15481/dr-zafar-fayyaz-pediatric-gastroenterologist-lahore-26_80X80.jpg" data-alt="dr-zafar-fayyaz-pediatric-gastroenterologist-lahore" data-url="#/doctors/lahore/pediatric-gastroenterologist/dr-zafar-fayyaz"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/pediatric-gastroenterologist/dr-zafar-fayyaz">Dr. Zafar Fayyaz</a></h3>
                                                <p>Pediatric Gastroenterologist</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 17 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/pediatric-gastroenterologist/dr-zafar-fayyaz'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/16188/syed-shaheer-haider-bukhari-anesthetist-lahore-37_80X80.HEIC" data-alt="dr-syed-shaheer-haider-bukhari-anesthetist-lahore" data-url="#/doctors/lahore/anesthetist/dr-syed-shaheer-haider-bukhari"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/anesthetist/dr-syed-shaheer-haider-bukhari">Dr. Syed Shaheer Haider Bukhari</a></h3>
                                                <p>Anesthetist</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 15 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/anesthetist/dr-syed-shaheer-haider-bukhari'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/15821/dr-sobia-zafar-gynecologist-lahore-75_80X80.jpg" data-alt="dr-sobia-zafar-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-sobia-zafar"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-sobia-zafar">Dr. Sobia Zafar</a></h3>
                                <p>Gynecologist</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 15 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-sobia-zafar'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-arshad-mehmood-cardiologist-lahore" data-url="#/doctors/lahore/cardiologist/dr-arshad-mehmood"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/cardiologist/dr-arshad-mehmood">Dr. Arshad Mehmood</a></h3>
                                                <p>Cardiologist</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 15 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/cardiologist/dr-arshad-mehmood'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/5560/dr-babar-hussain-khan-ent-surgeon-lahore_80X80.jpg" data-alt="prof-dr-babar-hussain-khan-ent-surgeon-lahore" data-url="#/doctors/lahore/ent-surgeon/prof-dr-babar-hussain-khan"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/ent-surgeon/prof-dr-babar-hussain-khan">Prof. Dr. Babar Hussain Khan</a></h3>
                                                <p>Ent Surgeon</p>
                                <p><i class="fa fa-comment"></i> 10 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 22 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/ent-surgeon/prof-dr-babar-hussain-khan'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/5943/dr-rehana-amir-gynecologist-lahore_80X80.jpg" data-alt="dr-rehana-amir-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-rehana-amir"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-rehana-amir">Dr. Rehana Amir</a></h3>
                                                <p>Gynecologist</p>
                                <p><i class="fa fa-comment"></i> 13 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 8 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-rehana-amir'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/8348/dr-syed-nasir-abbas-pediatrician-lahore-94_80X80.jpg" data-alt="dr-syed-nasir-abbas-pediatrician-lahore" data-url="#/doctors/lahore/pediatrician/dr-syed-nasir-abbas"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/pediatrician/dr-syed-nasir-abbas">Dr. Syed Nasir Abbas</a></h3>
                                                <p>Pediatrician</p>
                                <p><i class="fa fa-comment"></i> 23 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 7 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/pediatrician/dr-syed-nasir-abbas'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-syed-arsalan-khalid-nephrologist-lahore" data-url="#/doctors/lahore/nephrologist/dr-syed-arsalan-khalid"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/nephrologist/dr-syed-arsalan-khalid">Dr. Syed Arsalan Khalid</a></h3>
                                                <p>Nephrologist</p>
                                <p><i class="fa fa-comment"></i> 7 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 25 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/nephrologist/dr-syed-arsalan-khalid'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/8200/dr-kamran-khalid-plastic-surgeon-lahore-62_80X80.jpg" data-alt="dr-kamran-khalid-plastic-surgeon-lahore" data-url="#/doctors/lahore/plastic-surgeon/dr-kamran-khalid"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/plastic-surgeon/dr-kamran-khalid">Dr. Kamran Khalid</a></h3>
                                                <p>Plastic Surgeon</p>
                                <p><i class="fa fa-comment"></i> 6 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 14 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/plastic-surgeon/dr-kamran-khalid'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/13332/dr-brig-r-anwaar-ul-haq-ent-surgeon-lahore-91_80X80.png" data-alt="dr-brig-r-anwaar-ul-haq-ent-surgeon-lahore" data-url="#/doctors/lahore/ent-surgeon/dr-brig-r-anwaar-ul-haq"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/ent-surgeon/dr-brig-r-anwaar-ul-haq">Dr. Brig (r) Anwaar Ul Haq</a></h3>
                                                <p>Ent Surgeon</p>
                                <p><i class="fa fa-comment"></i> 2 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 30 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/ent-surgeon/dr-brig-r-anwaar-ul-haq'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/8555/dr-rubab-ali-gynecologist-lahore_80X80.jpg" data-alt="dr-rubab-ali-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-rubab-ali"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-rubab-ali">Dr. Rubab Ali</a></h3>
                                                <p>Gynecologist</p>
                                <p><i class="fa fa-comment"></i> 9 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 9 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-rubab-ali'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/8247/dr-ammara-rabbani-plastic-surgeon-lahore-64_80X80.jpg" data-alt="dr-ammara-rabbani-plastic-surgeon-lahore" data-url="#/doctors/lahore/plastic-surgeon/dr-ammara-rabbani"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/plastic-surgeon/dr-ammara-rabbani">Dr. Ammara Rabbani</a></h3>
                                                <p>Plastic Surgeon</p>
                                <p><i class="fa fa-comment"></i> 6 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 5 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/plastic-surgeon/dr-ammara-rabbani'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/13683/dr-farooq-ahmad-rana-general-surgeon-lahore-93_80X80.jpg" data-alt="dr-farooq-ahmad-rana-general-surgeon-lahore" data-url="#/doctors/lahore/general-surgeon/dr-farooq-ahmad-rana"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/general-surgeon/dr-farooq-ahmad-rana">Dr. Farooq Ahmad Rana</a></h3>
                                                <p>General Surgeon</p>
                                <p><i class="fa fa-comment"></i> 1 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 20 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/general-surgeon/dr-farooq-ahmad-rana'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="prof-dr-tayyaba-majeed-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/prof-dr-tayyaba-majeed"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/prof-dr-tayyaba-majeed">Prof. Dr. Tayyaba Majeed</a></h3>
                                <p>Gynecologist</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 31 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/prof-dr-tayyaba-majeed'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-sumbal-altaf-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-sumbal-altaf"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-sumbal-altaf">Dr. Sumbal Altaf</a></h3>
                                                <p>Gynecologist</p>
                                <p><i class="fa fa-comment"></i> 1 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 9 Years of Experience</p>
                                           
                                        <a href="#" class="urdu ga-event-onpanel-hospital-profile-click-urdu" onclick="toggleModal(event, 'contact_modal', 'show')">رابطہ نمبر حاصل کریں</a>
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-sumbal-altaf'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/2886/dr-muhammad-iqbal-chaudhry-orthopedic-surgeon-lahore_80X80.jpg" data-alt="dr-muhammad-iqbal-chaudhry-orthopedic-surgeon-lahore" data-url="#/doctors/lahore/orthopedic-surgeon/dr-muhammad-iqbal-chaudhry"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/orthopedic-surgeon/dr-muhammad-iqbal-chaudhry">Dr. Muhammad Iqbal Chaudhry</a></h3>
                                                <p>Orthopedic Surgeon</p>
                                <p><i class="fa fa-comment"></i> 4 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 29 Years of Experience</p>
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/orthopedic-surgeon/dr-muhammad-iqbal-chaudhry'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-muhammad-tayyab-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-muhammad-tayyab"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-muhammad-tayyab">Dr. Muhammad Tayyab</a></h3>
                                                <p>Gynecologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-muhammad-tayyab'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-talha-mahmood-pulmonologist-lung-specialist-lahore" data-url="#/doctors/lahore/pulmonologist/dr-talha-mahmood"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/pulmonologist/dr-talha-mahmood">Dr. Talha Mahmood</a></h3>
                                                <p>Pulmonologist / Lung Specialist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/pulmonologist/dr-talha-mahmood'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-ghazala-butt-dermatologist-lahore" data-url="#/doctors/lahore/dermatologist/dr-ghazala-butt"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/dermatologist/dr-ghazala-butt">Dr. Ghazala Butt</a></h3>
                                                <p>Dermatologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/dermatologist/dr-ghazala-butt'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-muhammad-ali-orthopedic-surgeon-lahore" data-url="#/doctors/lahore/orthopedic-surgeon/dr-muhammad-ali"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/orthopedic-surgeon/dr-muhammad-ali">Dr. Muhammad Ali</a></h3>
                                                <p>Orthopedic Surgeon</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/orthopedic-surgeon/dr-muhammad-ali'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-talha-abdul-halim-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-talha-abdul-halim"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-talha-abdul-halim">Dr. Talha Abdul Halim</a></h3>
                                                <p>Gynecologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-talha-abdul-halim'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-habib-neuro-surgeon-lahore" data-url="#/doctors/lahore/neuro-surgeon/dr-habib"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/neuro-surgeon/dr-habib">Dr. Habib</a></h3>
                                                <p>Neuro Surgeon</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/neuro-surgeon/dr-habib'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-farrukh-mehmood-dermatologist-lahore" data-url="#/doctors/lahore/dermatologist/dr-farrukh-mehmood"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/dermatologist/dr-farrukh-mehmood">Dr. Farrukh Mehmood</a></h3>
                                                <p>Dermatologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/dermatologist/dr-farrukh-mehmood'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-ruhiya-mufedi-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-ruhiya-mufedi"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-ruhiya-mufedi">Dr. Ruhiya Mufedi</a></h3>
                                                <p>Gynecologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-ruhiya-mufedi'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-rubina-sohail-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-rubina-sohail"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-rubina-sohail">Dr. Rubina Sohail</a></h3>
                                                <p>Gynecologist</p>
                                <p><i class="fa fa-comment"></i> 3 Reviews</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-rubina-sohail'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-muhammad-hammad-eye-surgeon-lahore" data-url="#/doctors/lahore/eye-surgeon/dr-muhammad-hammad"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/eye-surgeon/dr-muhammad-hammad">Dr. Muhammad Hammad</a></h3>
                                                <p>Eye Surgeon</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/eye-surgeon/dr-muhammad-hammad'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-ahmed-nadeem-general-physician-lahore" data-url="#/doctors/lahore/general-physician/dr-ahmed-nadeem"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/general-physician/dr-ahmed-nadeem">Dr. Ahmed Nadeem</a></h3>
                                                <p>General Physician</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/general-physician/dr-ahmed-nadeem'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-tayyaba-majeed-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-tayyaba-majeed"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-tayyaba-majeed">Dr. Tayyaba Majeed</a></h3>
                                                <p>Gynecologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-tayyaba-majeed'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-samina-siddique-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-samina-siddique"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-samina-siddique">Dr. Samina Siddique</a></h3>
                                                <p>Gynecologist</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 5 Years of Experience</p>
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-samina-siddique'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-adil-iqbal-gastroenterologist-lahore" data-url="#/doctors/lahore/gastroenterologist/dr-adil-iqbal"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gastroenterologist/dr-adil-iqbal">Dr. Adil Iqbal</a></h3>
                                                <p>Gastroenterologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gastroenterologist/dr-adil-iqbal'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-rizwan-zafar-ahmed-general-physician-lahore" data-url="#/doctors/lahore/general-physician/dr-rizwan-zafar-ahmed"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/general-physician/dr-rizwan-zafar-ahmed">Dr. Rizwan Zafar Ahmed</a></h3>
                                                <p>General Physician</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/general-physician/dr-rizwan-zafar-ahmed'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-salman-waris-urologist-lahore" data-url="#/doctors/lahore/urologist/dr-salman-waris"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/urologist/dr-salman-waris">Dr. Salman Waris</a></h3>
                                                <p>Urologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/urologist/dr-salman-waris'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-fouzia-naz-general-surgeon-lahore" data-url="#/doctors/lahore/general-surgeon/dr-fouzia-naz"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/general-surgeon/dr-fouzia-naz">Dr. Fouzia Naz</a></h3>
                                <p>General Surgeon</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/general-surgeon/dr-fouzia-naz'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-usman-ahmed-general-physician-lahore" data-url="#/doctors/lahore/general-physician/dr-usman-ahmed"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/general-physician/dr-usman-ahmed">Dr. Usman Ahmed</a></h3>
                                                <p>General Physician</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/general-physician/dr-usman-ahmed'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-adeel-anjum-general-surgeon-lahore" data-url="#/doctors/lahore/general-surgeon/dr-adeel-anjum"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/general-surgeon/dr-adeel-anjum">Dr. Adeel Anjum</a></h3>
                                                <p>General Surgeon</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/general-surgeon/dr-adeel-anjum'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-bilal-zakria-cardiologist-lahore" data-url="#/doctors/lahore/cardiologist/dr-bilal-zakria"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/cardiologist/dr-bilal-zakria">Dr. Bilal Zakria</a></h3>
                                                <p>Cardiologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/cardiologist/dr-bilal-zakria'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-muhammad-akram-cancer-specialist-oncologist-lahore" data-url="#/doctors/lahore/oncologist/dr-muhammad-akram"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/oncologist/dr-muhammad-akram">Dr. Muhammad Akram</a></h3>
                                                <p>Cancer Specialist / Oncologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/oncologist/dr-muhammad-akram'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-zulfiqar-general-physician-lahore" data-url="#/doctors/lahore/general-physician/dr-zulfiqar"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/general-physician/dr-zulfiqar">Dr. Zulfiqar</a></h3>
                                <p>General Physician</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/general-physician/dr-zulfiqar'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-ghulam-mujtaba-zafar-sexologist-lahore" data-url="#/doctors/lahore/sexologist/dr-ghulam-mujtaba-zafar"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/sexologist/dr-ghulam-mujtaba-zafar">Dr. Ghulam Mujtaba Zafar</a></h3>
                                                <p>Sexologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/sexologist/dr-ghulam-mujtaba-zafar'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-ali-feroz-dermatologist-lahore" data-url="#/doctors/lahore/dermatologist/dr-ali-feroz"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/dermatologist/dr-ali-feroz">Dr. Ali Feroz</a></h3>
                                                <p>Dermatologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/dermatologist/dr-ali-feroz'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-arif-mehmood-siddique-gastroenterologist-lahore" data-url="#/doctors/lahore/gastroenterologist/dr-arif-mehmood-siddique"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gastroenterologist/dr-arif-mehmood-siddique">Dr. Arif Mehmood Siddique</a></h3>
                                                <p>Gastroenterologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gastroenterologist/dr-arif-mehmood-siddique'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-farrukh-zaman-khan-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-farrukh-zaman-khan"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-farrukh-zaman-khan">Dr. Farrukh Zaman Khan</a></h3>
                                                <p>Gynecologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-farrukh-zaman-khan'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="jabeen-haider-physiotherapist-lahore" data-url="#/doctors/lahore/physiotherapy/dr-jabeen-haider"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/physiotherapy/dr-jabeen-haider">Jabeen Haider</a></h3>
                                <p>Physiotherapist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/physiotherapy/dr-jabeen-haider'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-masoos-ahmed-interventional-cardiologist-lahore" data-url="#/doctors/lahore/interventional-cardiologist/dr-masoos-ahmed"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/interventional-cardiologist/dr-masoos-ahmed">Dr. Masoos Ahmed</a></h3>
                                <p>Interventional Cardiologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/interventional-cardiologist/dr-masoos-ahmed'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-talha-mahmud-pulmonologist-lung-specialist-lahore" data-url="#/doctors/lahore/pulmonologist/dr-talha-mahmud"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/pulmonologist/dr-talha-mahmud">Dr. Talha Mahmud</a></h3>
                                                <p>Pulmonologist / Lung Specialist</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 15 Years of Experience</p>
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/pulmonologist/dr-talha-mahmud'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-iftikhar-ijaz-nephrologist-lahore" data-url="#/doctors/lahore/nephrologist/dr-iftikhar-ijaz"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/nephrologist/dr-iftikhar-ijaz">Dr. Iftikhar Ijaz</a></h3>
                                                <p>Nephrologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/nephrologist/dr-iftikhar-ijaz'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-farooq-ahmed-rana-general-surgeon-lahore" data-url="#/doctors/lahore/general-surgeon/dr-farooq-ahmed-rana"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/general-surgeon/dr-farooq-ahmed-rana">Dr. Farooq Ahmed Rana</a></h3>
                                                <p>General Surgeon</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 10 Years of Experience</p>
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/general-surgeon/dr-farooq-ahmed-rana'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/2430/dr-khaleeq-ur-rehman-androurologist-lahore_80X80.jpg" data-alt="dr-khaleeq-ur-rehman-urologist-lahore" data-url="#/doctors/lahore/urologist/dr-khaleeq-ur-rehman"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/urologist/dr-khaleeq-ur-rehman">Dr. Khaleeq Ur Rehman</a></h3>
                                                <p>Urologist</p>
                                <p><i class="fa fa-comment"></i> 2 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 32 Years of Experience</p>
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/urologist/dr-khaleeq-ur-rehman'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/2903/dr-adnan-hameed-gill-neurologist-lahore_80X80.jpg" data-alt="dr-adnan-hameed-gill-neurologist-lahore" data-url="#/doctors/lahore/neuro-physician/dr-adnan-hameed-gill"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/neuro-physician/dr-adnan-hameed-gill">Dr. Adnan Hameed Gill</a></h3>
                                                <p>Neurologist</p>
                                <p><i class="fa fa-comment"></i> 12 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 11 Years of Experience</p>
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/neuro-physician/dr-adnan-hameed-gill'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-farhana-muzzaffar-pediatrician-lahore" data-url="#/doctors/lahore/pediatrician/dr-farhana-muzzaffar"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/pediatrician/dr-farhana-muzzaffar">Dr. Farhana Muzzaffar</a></h3>
                                                <p>Pediatrician</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 20 Years of Experience</p>
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/pediatrician/dr-farhana-muzzaffar'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-ahmad-zia-radiologist-lahore" data-url="#/doctors/lahore/radiologist/dr-ahmad-zia"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/radiologist/dr-ahmad-zia">Dr. Ahmad Zia</a></h3>
                                                <p>Radiologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/radiologist/dr-ahmad-zia'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-zohra-khanum-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-zohra-khanum"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-zohra-khanum">Dr. Zohra Khanum</a></h3>
                                                <p>Gynecologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-zohra-khanum'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-rehana-kanwal-mohal-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-rehana-kanwal-mohal"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-rehana-kanwal-mohal">Dr. Rehana Kanwal Mohal</a></h3>
                                                <p>Gynecologist</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 8 Years of Experience</p>
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-rehana-kanwal-mohal'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-mariam-iqbal-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-mariam-iqbal"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-mariam-iqbal">Dr. Mariam Iqbal</a></h3>
                                <p>Gynecologist</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 17 Years of Experience</p>
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-mariam-iqbal'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-zeba-aziz-cancer-specialist-oncologist-lahore" data-url="#/doctors/lahore/oncologist/dr-zeba-aziz"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/oncologist/dr-zeba-aziz">Dr. Zeba Aziz</a></h3>
                                                <p>Cancer Specialist / Oncologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/oncologist/dr-zeba-aziz'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-adnan-younas-general-physician-lahore" data-url="#/doctors/lahore/general-physician/dr-adnan-younas"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/general-physician/dr-adnan-younas">Dr. Adnan Younas</a></h3>
                                                <p>General Physician</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/general-physician/dr-adnan-younas'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-najeeb-ullah-interventional-cardiologist-lahore" data-url="#/doctors/lahore/interventional-cardiologist/dr-najeeb-ullah"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/interventional-cardiologist/dr-najeeb-ullah">Dr. Najeeb Ullah</a></h3>
                                                <p>Interventional Cardiologist</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 10 Years of Experience</p>
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/interventional-cardiologist/dr-najeeb-ullah'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-yasir-rheumatologist-lahore" data-url="#/doctors/lahore/rheumatologist/dr-yasir"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/rheumatologist/dr-yasir">Dr. Yasir</a></h3>
                                                <p>Rheumatologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/rheumatologist/dr-yasir'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-m-akram-cancer-specialist-oncologist-lahore" data-url="#/doctors/lahore/oncologist/dr-m-akram"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/oncologist/dr-m-akram">Dr. M Akram</a></h3>
                                                <p>Cancer Specialist / Oncologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/oncologist/dr-m-akram'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-anjum-rashid-gastroenterologist-lahore" data-url="#/doctors/lahore/gastroenterologist/dr-anjum-rashid"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gastroenterologist/dr-anjum-rashid">Dr. Anjum Rashid</a></h3>
                                                <p>Gastroenterologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gastroenterologist/dr-anjum-rashid'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-ramzan-ch-sexologist-lahore" data-url="#/doctors/lahore/sexologist/dr-ramzan-ch"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/sexologist/dr-ramzan-ch">Dr. Ramzan Ch</a></h3>
                                                <p>Sexologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/sexologist/dr-ramzan-ch'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-shaheen-kosar-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-shaheen-kosar"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-shaheen-kosar">Dr. Shaheen Kosar</a></h3>
                                                <p>Gynecologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-shaheen-kosar'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-shahnaz-kouser-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-shahnaz-kouser"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-shahnaz-kouser">Dr. Shahnaz Kouser</a></h3>
                                <p>Gynecologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-shahnaz-kouser'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-azhar-hussain-gastroenterologist-lahore" data-url="#/doctors/lahore/gastroenterologist/dr-azhar-hussain"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gastroenterologist/dr-azhar-hussain">Dr. Azhar Hussain</a></h3>
                                                <p>Gastroenterologist</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 16 Years of Experience</p>
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gastroenterologist/dr-azhar-hussain'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-ammara-amir-butt-psychiatrist-lahore" data-url="#/doctors/lahore/psychiatrist/dr-ammara-amir-butt"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/psychiatrist/dr-ammara-amir-butt">Dr. Ammara Amir Butt</a></h3>
                                                <p>Psychiatrist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/psychiatrist/dr-ammara-amir-butt'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-shaheen-kousar-malik-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-shaheen-kousar-malik"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-shaheen-kousar-malik">Dr. Shaheen Kousar Malik</a></h3>
                                                <p>Gynecologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-shaheen-kousar-malik'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-rizwan-zafar-gastroenterologist-lahore" data-url="#/doctors/lahore/gastroenterologist/dr-rizwan-zafar"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gastroenterologist/dr-rizwan-zafar">Dr. Rizwan Zafar</a></h3>
                                                <p>Gastroenterologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gastroenterologist/dr-rizwan-zafar'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="mahnaz-nasir-khan-dietitiannutritionist-lahore" data-url="#/doctors/lahore/nutritionist/mahnaz-nasir-khan"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/nutritionist/mahnaz-nasir-khan">Mahnaz Nasir Khan</a></h3>
                                                <p>Dietitian/Nutritionist</p>
                                <p><i class="fa fa-comment"></i> 2 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 18 Years of Experience</p>
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/nutritionist/mahnaz-nasir-khan'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-qaiser-mehmood-psychiatrist-lahore" data-url="#/doctors/lahore/psychiatrist/dr-qaiser-mehmood"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/psychiatrist/dr-qaiser-mehmood">Dr. Qaiser Mehmood</a></h3>
                                                <p>Psychiatrist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/psychiatrist/dr-qaiser-mehmood'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-amtullah-zarreen-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-amtullah-zarreen"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-amtullah-zarreen">Dr. Amtullah Zarreen</a></h3>
                                <p>Gynecologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-amtullah-zarreen'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="rehana-yasmeen-naizi-physiotherapist-lahore" data-url="#/doctors/lahore/physiotherapy/dr-rehana-yasmeen-naizi"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/physiotherapy/dr-rehana-yasmeen-naizi">Rehana Yasmeen Naizi</a></h3>
                                                <p>Physiotherapist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/physiotherapy/dr-rehana-yasmeen-naizi'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-syed-sarfraz-hussain-psychiatrist-lahore" data-url="#/doctors/lahore/psychiatrist/dr-syed-sarfraz-hussain"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/psychiatrist/dr-syed-sarfraz-hussain">Dr. Syed Sarfraz Hussain</a></h3>
                                                <p>Psychiatrist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/psychiatrist/dr-syed-sarfraz-hussain'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-fauzia-anjum-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-fauzia-anjum"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-fauzia-anjum">Dr. Fauzia Anjum</a></h3>
                                                <p>Gynecologist</p>
                                <p><i class="fa fa-comment"></i> 2 Reviews</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-fauzia-anjum'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-tanzeel-qurrat-ijaz-rheumatologist-lahore" data-url="#/doctors/lahore/rheumatologist/dr-tanzeel-qurrat-ijaz"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/rheumatologist/dr-tanzeel-qurrat-ijaz">Dr. Tanzeel Qurrat Ijaz</a></h3>
                                                <p>Rheumatologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/rheumatologist/dr-tanzeel-qurrat-ijaz'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="farhat-batool-psychiatrist-lahore" data-url="#/doctors/lahore/psychiatrist/farhat-batool"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/psychiatrist/farhat-batool">Farhat Batool</a></h3>
                                                <p>Psychiatrist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/psychiatrist/farhat-batool'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-khurram-a-mirza-eye-specialist-lahore" data-url="#/doctors/lahore/eye-specialist/dr-khurram-a-mirza"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/eye-specialist/dr-khurram-a-mirza">Dr. Khurram A Mirza</a></h3>
                                                <p>Eye Specialist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/eye-specialist/dr-khurram-a-mirza'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-amber-waris-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-amber-waris"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-amber-waris">Dr. Amber Waris</a></h3>
                                <p>Gynecologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-amber-waris'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-raja-pervaiz-akhtar-cardiac-surgeon-lahore" data-url="#/doctors/lahore/cardiac-surgeon/dr-raja-pervaiz-akhtar"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/cardiac-surgeon/dr-raja-pervaiz-akhtar">Dr. Raja Pervaiz Akhtar</a></h3>
                                                <p>Cardiac Surgeon</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/cardiac-surgeon/dr-raja-pervaiz-akhtar'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-zia-ul-mazhry-eye-specialist-lahore" data-url="#/doctors/lahore/eye-specialist/dr-zia-ul-mazhry"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/eye-specialist/dr-zia-ul-mazhry">Dr. Zia Ul Mazhry</a></h3>
                                                <p>Eye Specialist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/eye-specialist/dr-zia-ul-mazhry'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-shahida-asad-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-shahida-asad"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-shahida-asad">Dr. Shahida Asad</a></h3>
                                <p>Gynecologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-shahida-asad'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-maryam-rafat-dermatologist-lahore" data-url="#/doctors/lahore/dermatologist/dr-maryam-rafat"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/dermatologist/dr-maryam-rafat">Dr. Maryam Rafat</a></h3>
                                                <p>Dermatologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/dermatologist/dr-maryam-rafat'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-lubna-shehzad-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-lubna-shehzad"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-lubna-shehzad">Dr. Lubna Shehzad</a></h3>
                                <p>Gynecologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-lubna-shehzad'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-kamran-hameed-pulmonologist-lung-specialist-lahore" data-url="#/doctors/lahore/pulmonologist/dr-kamran-hameed"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/pulmonologist/dr-kamran-hameed">Dr. Kamran Hameed</a></h3>
                                                <p>Pulmonologist / Lung Specialist</p>
                                <p><i class="fa fa-comment"></i> 33 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 28 Years of Experience</p>
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/pulmonologist/dr-kamran-hameed'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/6723/dr-ali-feroz-dermatologist-lahore_18_80X80.jpg" data-alt="dr-aly-feroze-dermatologist-lahore" data-url="#/doctors/lahore/dermatologist/dr-aly-feroze"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/dermatologist/dr-aly-feroze">Dr. Aly Feroze</a></h3>
                                                <p>Dermatologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/dermatologist/dr-aly-feroze'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-shariq-sohail-cardiologist-lahore" data-url="#/doctors/lahore/cardiologist/dr-shariq-sohail"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/cardiologist/dr-shariq-sohail">Dr. Shariq Sohail</a></h3>
                                                <p>Cardiologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/cardiologist/dr-shariq-sohail'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-fauzia-khaliq-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-fauzia-khaliq"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-fauzia-khaliq">Dr. Fauzia Khaliq</a></h3>
                                <p>Gynecologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-fauzia-khaliq'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="erum-naz-audiologist-lahore" data-url="#/doctors/lahore/audiologist/erum-naz"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/audiologist/erum-naz">Erum Naz</a></h3>
                                                <p>Audiologist</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 6 Years of Experience</p>
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/audiologist/erum-naz'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-haroon-hameed-pediatrician-lahore" data-url="#/doctors/lahore/pediatrician/dr-haroon-hameed"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/pediatrician/dr-haroon-hameed">Dr. Haroon Hameed</a></h3>
                                                <p>Pediatrician</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/pediatrician/dr-haroon-hameed'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-usama-sabzwari-psychiatrist-lahore" data-url="#/doctors/lahore/psychiatrist/dr-usama-sabzwari"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/psychiatrist/dr-usama-sabzwari">Dr. Usama Sabzwari</a></h3>
                                                <p>Psychiatrist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/psychiatrist/dr-usama-sabzwari'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/7573/dr-nauman-zahoor-ahmed-cardiologist-lahore_80X80.jpg" data-alt="dr-nauman-zahoor-ahmed-cardiologist-lahore" data-url="#/doctors/lahore/cardiologist/dr-nauman-zahoor-ahmed"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/cardiologist/dr-nauman-zahoor-ahmed">Dr. Nauman Zahoor Ahmed</a></h3>
                                                <p>Cardiologist</p>
                                <p><i class="fa fa-comment"></i> 6 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 15 Years of Experience</p>
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/cardiologist/dr-nauman-zahoor-ahmed'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-shoaib-butt-pediatrician-lahore" data-url="#/doctors/lahore/pediatrician/dr-shoaib-butt"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/pediatrician/dr-shoaib-butt">Dr. Shoaib Butt</a></h3>
                                                <p>Pediatrician</p>
                                <p><i class="fa fa-comment"></i> 2 Reviews</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/pediatrician/dr-shoaib-butt'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-farah-asghar-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-farah-asghar"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-farah-asghar">Dr. Farah Asghar</a></h3>
                                <p>Gynecologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-farah-asghar'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-khalid-javed-pediatrician-lahore" data-url="#/doctors/lahore/pediatrician/dr-khalid-javed"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/pediatrician/dr-khalid-javed">Dr. Khalid Javed</a></h3>
                                                <p>Pediatrician</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/pediatrician/dr-khalid-javed'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-farhat-iqbal-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-farhat-iqbal"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-farhat-iqbal">Dr. Farhat Iqbal</a></h3>
                                                <p>Gynecologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-farhat-iqbal'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-rashid-zia-ent-specialist-lahore" data-url="#/doctors/lahore/ent-specialist/dr-rashid-zia"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/ent-specialist/dr-rashid-zia">Dr. Rashid Zia</a></h3>
                                                <p>Ent Specialist</p>
                                <p><i class="fa fa-comment"></i> 1 Reviews</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/ent-specialist/dr-rashid-zia'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-a-j-a-samdani-pediatrician-lahore" data-url="#/doctors/lahore/pediatrician/dr-a-j-a-samdani"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/pediatrician/dr-a-j-a-samdani">Dr. A J A Samdani</a></h3>
                                                <p>Pediatrician</p>
                                <p><i class="fa fa-comment"></i> 1 Reviews</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/pediatrician/dr-a-j-a-samdani'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-samina-rasheed-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-samina-rasheed"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-samina-rasheed">Dr. Samina Rasheed</a></h3>
                                                <p>Gynecologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-samina-rasheed'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-farrukh-mehmood-ent-specialist-lahore" data-url="#/doctors/lahore/ent-specialist/dr-farrukh-mehmood"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/ent-specialist/dr-farrukh-mehmood">Dr. Farrukh Mehmood</a></h3>
                                                <p>Ent Specialist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/ent-specialist/dr-farrukh-mehmood'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-obaid-ullah-pediatrician-lahore" data-url="#/doctors/lahore/pediatrician/dr-obaid-ullah"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/pediatrician/dr-obaid-ullah">Dr. Obaid Ullah</a></h3>
                                                <p>Pediatrician</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/pediatrician/dr-obaid-ullah'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-asad-jamal-dar-eye-specialist-lahore" data-url="#/doctors/lahore/eye-specialist/dr-asad-jamal-dar"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/eye-specialist/dr-asad-jamal-dar">Dr. Asad Jamal Dar</a></h3>
                                                <p>Eye Specialist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/eye-specialist/dr-asad-jamal-dar'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-g-a-sheikh-pediatrician-lahore" data-url="#/doctors/lahore/pediatrician/dr-g-a-sheikh"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/pediatrician/dr-g-a-sheikh">Dr. G A Sheikh</a></h3>
                                <p>Pediatrician</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/pediatrician/dr-g-a-sheikh'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-mujeeb-ur-rehman-abid-neurologist-lahore" data-url="#/doctors/lahore/neuro-physician/dr-mujeeb-ur-rehman-abid"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/neuro-physician/dr-mujeeb-ur-rehman-abid">Dr. Mujeeb Ur Rehman Abid</a></h3>
                                                <p>Neurologist</p>
                                <p><i class="fa fa-comment"></i> 4 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 24 Years of Experience</p>
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/neuro-physician/dr-mujeeb-ur-rehman-abid'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-ahmed-salman-waris-sexologist-lahore" data-url="#/doctors/lahore/sexologist/dr-ahmed-salman-waris"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/sexologist/dr-ahmed-salman-waris">Dr. Ahmed Salman Waris</a></h3>
                                                <p>Sexologist</p>
                                <p><i class="fa fa-comment"></i> 1 Reviews</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/sexologist/dr-ahmed-salman-waris'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-muhammad-bilal-abid-pediatrician-lahore" data-url="#/doctors/lahore/pediatrician/dr-muhammad-bilal-abid"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/pediatrician/dr-muhammad-bilal-abid">Dr. Muhammad Bilal Abid</a></h3>
                                <p>Pediatrician</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/pediatrician/dr-muhammad-bilal-abid'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/6424/dr-syed-najam-hyder-pediatric-cardiologist-lahore_80X80.JPG" data-alt="dr-syed-najam-hyder-pediatric-cardiologist-lahore" data-url="#/doctors/lahore/pediatric-cardiologist/dr-syed-najam-hyder"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/pediatric-cardiologist/dr-syed-najam-hyder">Dr. Syed Najam Hyder</a></h3>
                                                <p>Pediatric Cardiologist</p>
                                <p><i class="fa fa-comment"></i> 1 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 10 Years of Experience</p>
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/pediatric-cardiologist/dr-syed-najam-hyder'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-atiq-ur-rehman-neuro-surgeon-lahore" data-url="#/doctors/lahore/neuro-surgeon/dr-atiq-ur-rehman"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/neuro-surgeon/dr-atiq-ur-rehman">Dr. Atiq Ur Rehman</a></h3>
                                                <p>Neuro Surgeon</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/neuro-surgeon/dr-atiq-ur-rehman'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-rashid-latif-khan-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-rashid-latif-khan"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-rashid-latif-khan">Dr. Rashid Latif Khan</a></h3>
                                                <p>Gynecologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-rashid-latif-khan'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-m-rashid-abid-butt-neurologist-lahore" data-url="#/doctors/lahore/neuro-physician/dr-m-rashid-abid-butt"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/neuro-physician/dr-m-rashid-abid-butt">Dr. M Rashid Abid Butt</a></h3>
                                                <p>Neurologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/neuro-physician/dr-m-rashid-abid-butt'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-nabila-talat-pediatric-surgeon-lahore" data-url="#/doctors/lahore/pediatric-surgeon/dr-nabila-talat"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/pediatric-surgeon/dr-nabila-talat">Dr. Nabila Talat</a></h3>
                                                <p>Pediatric Surgeon</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 20 Years of Experience</p>
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/pediatric-surgeon/dr-nabila-talat'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-habib-sultan-neuro-surgeon-lahore" data-url="#/doctors/lahore/neuro-surgeon/dr-habib-sultan"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/neuro-surgeon/dr-habib-sultan">Dr. Habib Sultan</a></h3>
                                                <p>Neuro Surgeon</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/neuro-surgeon/dr-habib-sultan'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-neelofar-leghari-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-neelofar-leghari"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-neelofar-leghari">Dr. Neelofar Leghari</a></h3>
                                                <p>Gynecologist</p>
                                <p><i class="fa fa-comment"></i> 2 Reviews</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-neelofar-leghari'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-khurram-saadat-orthopedic-surgeon-lahore" data-url="#/doctors/lahore/orthopedic-surgeon/dr-khurram-saadat"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/orthopedic-surgeon/dr-khurram-saadat">Dr. Khurram Saadat</a></h3>
                                                <p>Orthopedic Surgeon</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/orthopedic-surgeon/dr-khurram-saadat'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-yasmeen-shaheen-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-yasmeen-shaheen"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-yasmeen-shaheen">Dr. Yasmeen Shaheen</a></h3>
                                                <p>Gynecologist</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-yasmeen-shaheen'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-nighat-ara-shah-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-nighat-ara-shah"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/gynecologist/dr-nighat-ara-shah">Dr. Nighat Ara Shah</a></h3>
                                                <p>Gynecologist</p>
                                <p><i class="fa fa-comment"></i> 1 Reviews</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/gynecologist/dr-nighat-ara-shah'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-abdul-waheed-cardiac-surgeon-lahore" data-url="#/doctors/lahore/cardiac-surgeon/dr-abdul-waheed"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/cardiac-surgeon/dr-abdul-waheed">Dr. Abdul Waheed</a></h3>
                                                <p>Cardiac Surgeon</p>
                                <div class="">
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/cardiac-surgeon/dr-abdul-waheed'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/6594/dr-shahzad-majeed-bhatti-interventional-cardiologist-lahore_80X80.png" data-alt="dr-shahzad-majeed-bhatti-interventional-cardiologist-lahore" data-url="#/doctors/lahore/interventional-cardiologist/dr-shahzad-majeed-bhatti"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/interventional-cardiologist/dr-shahzad-majeed-bhatti">Dr. Shahzad Majeed Bhatti</a></h3>
                                                <p>Interventional Cardiologist</p>
                                <p><i class="fa fa-comment"></i> 1 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 14 Years of Experience</p>
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/interventional-cardiologist/dr-shahzad-majeed-bhatti'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div><div class="col-4 grid-cards" style="height: 200px;">
    <div class="row">
        <div class="col-3-sm col-3">
            <div class="profile-photo lazy-image" data-src="" data-alt="dr-lt-col-r-abid-hussain-cardiac-surgeon-lahore" data-url="#/doctors/lahore/cardiac-surgeon/dr-lt-col-r-dr-abid-hussain"></div>
        </div>
        <div class="col-9-sm col-9">
            <div class="pl-4">
                <h3><a class="ga-event-onpanel-hospital-profile-click-doctor-name" href="#/doctors/lahore/cardiac-surgeon/dr-lt-col-r-dr-abid-hussain">Dr. Lt Col (r) Abid Hussain</a></h3>
                                                <p>Cardiac Surgeon</p>
                                <p><i class="fa fa-comment"></i> 4 Reviews</p>
                                <div class="">
                                        <p><i class="fa fa-star"></i> 27 Years of Experience</p>
                                           
                                        <button class="mt-2 ga-event-onpanel-hospital-profile-click-doctor-view-profile" onclick="location.href='#/doctors/lahore/cardiac-surgeon/dr-lt-col-r-dr-abid-hussain'">See Doctor Details</button>
                </div>
            </div>
        </div>
    </div>
</div>            </div>
        </div>
                        <div class="col-12">
            <h2>Clinics in Hameed Latif Hospital</h2>
            <ul class="grid-list">
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/anesthetist">Anesthetist</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/audiologist">Audiologist</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/oncologist">Cancer Specialist / Oncologist</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/cardiac-surgeon">Cardiac Surgeon</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/cardiologist">Cardiologist</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/dermatologist">Dermatologist</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/nutritionist">Dietitian/Nutritionist</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/endocrinologist">Endocrinologist</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/endourologist">Endourologist</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/ent-specialist">Ent Specialist</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/ent-surgeon">Ent Surgeon</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/eye-specialist">Eye Specialist</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/eye-surgeon">Eye Surgeon</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/gastroenterologist">Gastroenterologist</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/general-physician">General Physician</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/general-surgeon">General Surgeon</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/gynecologist">Gynecologist</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/interventional-cardiologist">Interventional Cardiologist</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/nephrologist">Nephrologist</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/neuro-surgeon">Neuro Surgeon</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/neuro-physician">Neurologist</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/orthopedic-surgeon">Orthopedic Surgeon</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/pediatric-cardiologist">Pediatric Cardiologist</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/pediatric-gastroenterologist">Pediatric Gastroenterologist</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/pediatric-neuro-physician">Pediatric Neuro Physician</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/pediatric-surgeon">Pediatric Surgeon</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/pediatrician">Pediatrician</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/physiotherapy">Physiotherapist</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/plastic-surgeon">Plastic Surgeon</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/psychiatrist">Psychiatrist</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/psychologist">Psychologist</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/pulmonologist">Pulmonologist / Lung Specialist</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/radiologist">Radiologist</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/rheumatologist">Rheumatologist</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/sexologist">Sexologist</a></li>
                                <li class="filter-speciality"><a href="#/hospitals/lahore/hameed-latif-hospital/garden-town/urologist">Urologist</a></li>
                            </ul>
        </div>
            </div>
    
    
    
        <div class="row mt-2 bg-white padding">
        <div class="col-12">
            <h2 class="mb-2">Frequently Asked Questions</h2>
            <!-- FAQ -->
                        <button type="button" class="collapsible">Top doctors in Hameed Latif Hospital, Lahore<i class="fa fa-angle-down u-pull-right"></i></button>
            <div class="content">
                <p>Top Doctors in Hameed Latif Hospital, Lahore are:</p>
                                <ul class="grid-list">
                                        <li><a href="#/doctors/lahore/gastroenterologist/dr-salman-javed">Dr. Salman Javed  (814 Reviews) </a></li>
                                                            <li><a href="#/doctors/lahore/eye-surgeon/dr-muhammad-hammad-ayub">Dr. Muhammad Hammad Ayub  (25 Reviews) </a></li>
                                                            <li><a href="#/doctors/lahore/psychiatrist/dr-muhammad-mujtaba">Dr. Muhammad Mujtaba  (219 Reviews) </a></li>
                                                            <li><a href="#/doctors/lahore/gynecologist/dr-nazli-hameed">Dr. Nazli Hameed  (235 Reviews) </a></li>
                                                            <li><a href="#/doctors/lahore/endourologist/dr-brig-r-ramzan-chaudhry">Dr. Brig R Ramzan Chaudhry  (178 Reviews) </a></li>
                                                            <li><a href="#/doctors/lahore/psychologist/dr-ayesha-shahid-sheikh">Dr. Ayesha Shahid Sheikh  (115 Reviews) </a></li>
                                                            <li><a href="#/doctors/lahore/neuro-physician/dr-rashid-imran">Dr. Rashid Imran  (161 Reviews) </a></li>
                                                            <li><a href="#/doctors/lahore/endocrinologist/dr-jaida-manzoor">Dr. Jaida Manzoor  (173 Reviews) </a></li>
                                                            <li><a href="#/doctors/lahore/orthopedic-surgeon/dr-muhammad-bilal">Dr. Muhammad Bilal  (47 Reviews) </a></li>
                                                            <li><a href="#/doctors/lahore/rheumatologist/dr-muhammad-usman-amir">Dr. Muhammad Usman Amir  (78 Reviews) </a></li>
                                                        </ul>
            </div>

            
                        
            <!-- FAQ -->
                        
            <!-- FAQ -->
                        <button type="button" class="collapsible">How to Get Online Appointment in Hameed Latif Hospital<i class="fa fa-angle-down u-pull-right"></i></button>
            <div class="content">
                <p>Call at <a href="tel:04235862623">04235862623</a> to get Online Appointment in Hameed Latif Hospital</p>
                                            </div>
                        
            <!-- FAQ -->
                        
            <!-- FAQ -->
                        <button type="button" class="collapsible">Is Emergency Service available in Hameed Latif Hospital<i class="fa fa-angle-down u-pull-right"></i></button>
            <div class="content">
               <p>Yes, Emergency Service is available in Hameed Latif Hospital</p>
                            </div>
                        
            <!-- FAQ -->
                        <button type="button" class="collapsible">Operational Timings in Hameed Latif Hospital<i class="fa fa-angle-down u-pull-right"></i></button>
            <div class="content">
                                <p>Hameed Latif Hospital is 24/7 operational</p>
                                
                                
            </div>
                        
            <!-- FAQ -->
                        <button type="button" class="collapsible">Address of Hameed Latif Hospital<i class="fa fa-angle-down u-pull-right"></i></button>
            <div class="content">
               <p>Complete Address of Hameed Latif Hospital is Hameed Latif Hospital, Abu Bakar Block, Garden Town, Lahore</p>
                            </div>
                        
            <!-- FAQ -->
                        <button type="button" class="collapsible">Hameed Latif Hospital Contact Number<i class="fa fa-angle-down u-pull-right"></i></button>
            <div class="content">
               <p>You can contact Hameed Latif Hospital at 04235862623</p>
                            </div>
                    </div>
    </div>

    
    
    <div class="row bg-white padding mt-2">
    <div class="col-12">
        <h2>About</h2>
                <p>Hameed Latif Hospital is 324 bedded hospital in Lahore, Pakistan. The hospital offers 24-hour emergency assistance, supported by 14 modern operating rooms, 2 angioplasty and angiography units, correspondence rooms, intensive care units, intensive neonatal intensive care units and well-equipped internal and external clinical services. The diagnostic service offers 24-hour service for all clinical services. Obstetrics, gynaecology and paediatrics have been our main branches for many years. Meanwhile, many new specialities are proposed: cardiac surgery, neurosurgery, angioplasty, angiography, as well as neurological and peripheral interventions, orthopaedic surgery, urology, plastic surgery, cosmetology, laryngology, ophthalmology. , Neurology, pulmonology, endocrinology, gastroenterology, nephrology and dialysis, lithotripsy, laparoscopic surgery and thoracic surgery are available in the permitted cases.<br><br>The hospital has a well-equipped blood bank and diagnostic equipment. Hospital diagnostic devices, such as laboratories and radiology departments, are equipped with the most modern equipment. Hameed Latif Hospital is a standard barrier to provide patients with high-quality medical care. More than 1,000 physicians, nurses, paramedics and auxiliary personnel care for the patient. The hospital has excellent pharmacies and emergency services, available 24 hours a day for all patients.<br><br>A healthy touch, a warm smile, a friendly word characterize everything from our doctor, nurses and auxiliary staff, which guarantees the safety, confidence and comfort of all our patients.<br><br>To understand the patient&#39;s point of view, we focus on providing the best possible medical care, including access to world-class facilities, accurate diagnosis and specialized treatment to ensure rapid recovery.<br><br>You can book an appointment or consult online with these consultants through .pk</p>
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

@endsection