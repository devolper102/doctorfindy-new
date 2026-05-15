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
</div>      <div class="container">
    <div class="row bg-white padding mt-2">
        <div class="row mt-2 bg-white padding">
            <div class="col-12">
                <h1>Best Hospitals In Pakistan | Doctors Lists, Addresses And Contact Info</h1>
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li>Find a Hospital</li>
                </ul>
            </div>
        </div>  
    </div>

    <div class="row mt-2 bg-white padding">
        <div class="col-12">
            <h2>Hospitals in Top Cities</h2>
            <ul class="grid-list">
                                <li><a href="#">Hospitals in <span style="color: #c02942">Lahore</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Karachi</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Islamabad</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Rawalpindi</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Faisalabad</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Gujranwala</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Peshawar</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Sialkot</span></a></li>
                                <li><a href="#"">Hospitals in <span style="color: #c02942">Multan</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Sargodha</span></a></li>
                            </ul>
        </div>
    </div>

    <div class="row mt-2 bg-white padding">
        <div class="col-12">
            <h2>Hospitals in Other Cities</h2>
            <ul class="grid-list">
                                <li><a href="#">Hospitals in <span style="color: #c02942">Quetta</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Abbottabad</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Attock</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Bahawalnagar</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Bahawalpur</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Bannu</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Bhakkar</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Bhalwal</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Burewala</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Chakwal</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Charsadda</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Chishtian</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Daska</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Dera Ghazi Khan</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Dina</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Gojra</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Gujrat</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Hafizabad</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Hyderabad</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Istanbul</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Izmir</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Jacobabad</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Jhang</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Jhelum</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Kamoke</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Kasur</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Kayseri</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Khanewal</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">kharian</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Khushab</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Kohat</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Larkana</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Layyah</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Lodhran</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Loralai</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Mansehra</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Mardan</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Mian Channu</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Mianwali</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Nankana Sahib</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Nawabshah</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Nowshera</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Okara</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Pattoki</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Rahim Yar Khan</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Riyadh</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Sahiwal</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Shahkot</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Sheikhupura</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">shorkot</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Swabi</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Swat</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Talagang</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Tarbela</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Taxila</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Vehari</span></a></li>
                                <li><a href="#">Hospitals in <span style="color: #c02942">Wah Cantt</span></a></li>
                            </ul>
        </div>
    </div>

    <!--Consult Online Banner-->
<div class="row mt-2 bg-white padding">
    <div class="col-12">
        <h1><i class="fa fa-circle"></i> Consult doctor online from your home</h1>
        <small>Save time & money and consult doctor through phone</small>
        <ul class="list-cards mt-2">
            <li>
                <a class="ga-event-oc-find-a-doctor-specialities" href="#">
                    <div class="display-block">
                        <img src="https://h7u5d3a4.stackpathcdn.com/assets/images/home-new/psychologist.jpg" alt="Psychologist"/>
                        <div class="divider"></div>
                        <div class="card-content clearfix">
                            <p class="label-big"><small><i class="fa fa-circle"></i></small> Psychologist</p>
                            <small>98% satisfied patients</small>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a class="ga-event-oc-find-a-doctor-specialities" href="#">
                    <div class="display-block">
                        <img src="https://h7u5d3a4.stackpathcdn.com/assets/images/home-new/urologist-online.jpg" alt="Urologist Online"/>
                        <div class="divider"></div>
                        <div class="card-content">
                            <p class="label-big"><small><i class="fa fa-circle"></i></small> Urologist</p>
                            <small>96% satisfied patients</small>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a class="ga-event-oc-find-a-doctor-specialities" href="#">
                    <div class="display-block">
                        <img src="https://h7u5d3a4.stackpathcdn.com/assets/images/home-new/gynecologist-online.jpg" alt="Gynecologist Online"/>
                        <div class="divider"></div>
                        <div class="card-content">
                            <p class="label-big"><small><i class="fa fa-circle"></i></small> Gynecologist</p>
                            <small>99% satisfied patients</small>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a class="ga-event-oc-find-a-doctor-specialities" href="#">
                    <div class="display-block">
                        <img src="https://h7u5d3a4.stackpathcdn.com/assets/images/home-new/nutritionist-online.jpg" alt="Nutritionist Online"/>
                        <div class="divider"></div>
                        <div class="card-content">
                            <p class="label-big"><small><i class="fa fa-circle"></i></small> Nutritionist</p>
                            <small>95% satisfied patients</small>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a class="ga-event-oc-find-a-doctor-specialities" href="#">
                    <div class="display-block">
                        <img src="https://h7u5d3a4.stackpathcdn.com/assets/images/home-new/general-physician-online.jpg" alt="General Physician Online"/>
                        <div class="divider"></div>
                        <div class="card-content">
                            <p class="label-big"><small><i class="fa fa-circle"></i></small> Physician</p>
                            <small>98% satisfied patients</small>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a class="ga-event-oc-find-a-doctor-specialities" href="#">
                    <div class="display-block">
                        <img src="https://h7u5d3a4.stackpathcdn.com/assets/images/home-new/pediatrician-online.jpg" alt="Pediatrician"/>
                        <div class="divider"></div>
                        <div class="card-content">
                            <p class="label-big"><small><i class="fa fa-circle"></i></small> Pediatrician</p>
                            <small>99% satisfied patients</small>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
        <button class="mt-4 d-block d-sm-none button-main ga-event-oc-find-a-doctor-button" onclick="location.href='#'" style="width: 100%;">How to consult online?</button>
        <button class="mt-4 d-none d-sm-block button-main ga-event-oc-find-a-doctor-button" onclick="location.href='#'">How to consult online?</button>
    </div>
</div>
<!--Banner ends-->
    <div class="row bg-white padding mt-2">
        <div class="col-12">
            <p>Find complete details about the best hospitals in Pakistan. View doctors, services and appointment details of all the top government and private hospitals in all the cities of Pakistan. Call at Marham helpline: <a href="tel:042-32001427">042-32001427</a> for any queries.</p>
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
</div>  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/autocomplete.js/0.37.1/autocomplete.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/algoliasearch/3.34.0/algoliasearch.min.js"></script>
    <script async src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script type="text/javascript">
        function geoLocationError(error) {
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    alert('Please allow the Location for finding better results');
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert('We Can\'t find out your Location');
                    break;
                case error.TIMEOUT:
                    console.warn('The request to get user location timed out');
                    break;
                case error.UNKNOWN_ERROR:
                    console.warn('An unknown error occurred');
                    break;
            }
        }

        var geoLocationOptions = {
            enableHighAccuracy: true,
            timeout: 5000,
            maximumAge: 0
        };
        // Geolocation Script Ends

        function setUserCity(city) {
            localStorage.setItem("user_city", city);
            if(city == "Pakistan"){
                $("#search_bar").attr('placeholder','Search for Specialities, Services, Diseases and Conditions');
            } else{
                $("#search_bar").attr('placeholder','Search for Hospitals, Doctors, Specialities, Services, Diseases and Conditions');
            }
        }

        function getUserCity() {
            var userCity = localStorage.getItem("user_city");
            if (userCity != "Pakistan"){
                $("#search_bar").attr('placeholder','Search for Hospitals, Doctors, Specialities, Services, Diseases and Conditions');
            }
            else{
                $("#search_bar").attr('placeholder','Search for Specialities, Services, Diseases and Conditions');
            }
            if(document.getElementById('user_city') !== null && document.getElementById('user_city_mobile') !== null) {
                if(userCity !== null) {
                    document.getElementById('user_city').value = userCity;
                    document.getElementById('user_city_mobile').value = userCity;
                } else {
                    document.getElementById('user_city').value = 'Lahore';
                    document.getElementById('user_city_mobile').value = 'Lahore';
                    localStorage.setItem("user_city", "Lahore");
                    userCity = "Lahore";
                }
            }
            return userCity;
        }

        // Menu Script
        function expandMenu(id) {
            if($("#" + id).is(":visible")) {
                $("#" + id).hide().removeClass('show');
            } else {
                $(".dropdown-content").hide();
                $("#" + id).toggle().addClass('show');
            }
        }

        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if($(openDropdown).hasClass('show')) {
                        $(openDropdown).removeClass('show').hide();
                    }
                }
            }
        }

        $(document).on('click','.collapsible',function(){
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.maxHeight){
                    content.style.maxHeight = null;
                } else {
                    content.style.maxHeight = content.scrollHeight + "px";
                }
        });
    // End Menu Script
    // Algolia Search
        const algoliaClient = algoliasearch("C8QTK2HY0Z", "b265f00c723c1f4a6b15f2cc05a600ab");
        const index = algoliaClient.initIndex("marham");
        var myAutocomplete = autocomplete('#search_bar, #search_bar_mobile', {hint: false}, [{
            source: function(query, callback) {
                index.search(query, { hitsPerPage: 7, facetFilters: 'city:' + getUserCity() }).then(function(answer) {
                    callback(answer.hits);
                }, function() {
                    callback([]);
                });
            },
            displayKey: 'title',
            templates: {
                suggestion: function(suggestion) {
                    var span = '<span class="red-text">_type_</span>';
                    type = (suggestion.type == 1 ? '' : ' - ' + (suggestion.type == 2 ? 'Hospital' : (suggestion.type == 3 ? 'Speciality' : (suggestion.type == 4 ? 'Service' : (suggestion.type == 5 ? 'Disease' : '')))));
                    type = span.replace('_type_', type);
                    var sugTemplate = "<a href="+suggestion.url+">"+suggestion._highlightResult.title.value + type + "</a>";
                    return sugTemplate;
                }
            }
        }]).on('autocomplete:selected', function(event, suggestion, dataset) {
            location.href = suggestion.url;
        });
        // End Algolia Search

        /** Algolia Search Bar **/
        $("#user_city, #user_city_mobile").change(function() {
            setUserCity($(this).val());
        });

        $(document).on('keyup', '#search_bar', function() {
            filter = 'city:' + getUserCity();
        });

        /** Helper Functions **/
        $(".scrollTo").click(function(event) {
            event.preventDefault();
            var scrollToId = $(this).attr('data-scroll-to');
            scrollTo(scrollToId);
        });

        function scrollTo(id) {
            $('html, body').animate({
                scrollTop: $("#" + id).offset().top - 70
            }, 1000);
        }

        function ucWords(str) {
            return str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                return letter.toUpperCase();
            });
        }

        function generateImage(imageObj) {
            // return '<img src="' + src + '" onerror="revertBackToDiv(this.parentNode, \''+url+'\')" class="doctor-photo" width="60" height="60" alt="'+alt+'"' + ((url !== '' && (typeof url !== 'undefined')) ? ' onclick="location.href=\''+url+'\'" ' : '') + ' />';
            var image = document.createElement('img');
            image.src = imageObj.dataset.src;
            image.alt = imageObj.dataset.alt;
            if(typeof imageObj.width !== 'undefined' || (typeof imageObj.dataset.width !== 'undefined')) {
                image.width = (typeof imageObj.dataset.width !== 'undefined') ? imageObj.dataset.width : 60;
            }
            if(typeof imageObj.height !== 'undefined' || (typeof imageObj.dataset.height !== 'undefined')) {
                image.height = (typeof imageObj.dataset.height !== 'undefined') ? imageObj.dataset.height : 60;
            }
            image.classList = imageObj.classList;
            image.classList.remove('lazy-image');
            image.style.cssText = imageObj.style.cssText;
            image.setAttribute('onerror', 'revertBackToDiv(this.parentNode, \''+imageObj.dataset.url+'\')');
            if((imageObj.dataset.url !== '' && (typeof imageObj.dataset.url !== 'undefined'))) {
                image.setAttribute('onclick', 'location.href=\''+imageObj.dataset.url+'\'');
            }
            return image;
        }

        function revertBackToDiv(self, url) {
            self.innerHTML = '<img class="profile-photo" src="https://h7u5d3a4.stackpathcdn.com/assets/images/doctor-photo-male.jpg" '+(url.length !== 0 ? 'onclick="location.href=\''+url+'\'"' : '')+' />';
        }
        function createUniqueUserId(){
            var dt = new Date().getTime();
            var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxx'.replace(/[xy]/g, function(c) {
                var r = (dt + Math.random()*16)%16 | 0;
                dt = Math.floor(dt/16);
                return (c=='x' ? r :(r&0x3|0x8)).toString(16);
            });
            return uuid;
        }
        function getUrlParameter(key) {
            key = key.replace(/[*+?^$.\[\]{}()|\\\/]/g, "\\$&");
            var match = location.search.match(new RegExp("[?&]"+key+"=([^&]+)(&|$)"));
            return match && decodeURIComponent(match[1].replace(/\+/g, " "));
        }
        function getVisitorSource() {
            var visitorSource = '';
            if(getUrlParameter('gclid') !== null) {
                visitorSource = 'Google';
            } else if(getUrlParameter('fbclid') !== null) {
                visitorSource = 'Facebook';
            } else if(getUrlParameter('utm_source') !== null) {
                utmSource = getUrlParameter('utm_source');
                utmMedium = getUrlParameter('utm_medium');
                utmCampaign = getUrlParameter('utm_campaign');
                visitorSource = (utmSource.startsWith('Facebook-') || (utmMedium !== null && utmMedium.startsWith('Facebook-')) || (utmCampaign !== null && utmCampaign.startsWith('Facebook-'))) ? 'Facebook' : utmSource;
            } else {
                visitorSource = 'Direct';
            }
            return visitorSource;
        }
        /** Lazy Loading **/
        document.addEventListener("DOMContentLoaded",function(){let lazyObjects=[].slice.call(document.querySelectorAll(".lazy-image, .lazy-iframe"));let active=!1;const lazyLoad=function(){if(active===!1){active=!0;setTimeout(function(){lazyObjects.forEach(function(lazyObject){if((lazyObject.getBoundingClientRect().top<=window.innerHeight&&lazyObject.getBoundingClientRect().bottom>=0)&&getComputedStyle(lazyObject).display!=="none"){if(lazyObject.dataset.src.length != 0){
            lazyObject.tagName == 'DIV' ? $(lazyObject).replaceWith(generateImage(lazyObject)) : lazyObject.src = lazyObject.dataset.src;lazyObject.classList.remove("lazy-image", "lazy-iframe");
        }lazyObjects=lazyObjects.filter(function(image){return image!==lazyObject});if(lazyObjects.length===0){document.removeEventListener("scroll",lazyLoad);window.removeEventListener("resize",lazyLoad);window.removeEventListener("orientationchange",lazyLoad)}}});active=!1},200)}};document.addEventListener("scroll",lazyLoad);window.addEventListener("resize",lazyLoad);window.addEventListener("orientationchange",lazyLoad);window.addEventListener("load",lazyLoad)});

        document.addEventListener("DOMContentLoaded", function() {
            getUserCity();
        });

        /** Video Controls **/
        function stopYoutubeVideo(frameId) {
            var frame = document.getElementById(frameId);
            frame.src = frame.src;
        }

        /** Modal Functions **/
        function toggleModal(e = '', modalId, status = 'show') {
            if(e !== '') { e.preventDefault(); }
            (status == 'show') ? document.getElementById(modalId).style.display = 'block' : ((status == 'hide') ? document.getElementById(modalId).style.display = 'none' : '');
        }

        /** Cookie Functions **/
        function setCookie(name, value, daysToExpire, path) {
            var date = new Date();
            var timezoneOffset = -1 * date.getTimezoneOffset() * 60 * 1000;
            date.setTime(date.getTime() + (daysToExpire * 24 * 60 * 60 * 1000) + timezoneOffset);
            var expires = date.toUTCString();
            document.cookie = name + '=' + value + ';' + 'expires=' + expires + ';' + 'path=' + path;
        }

        function setCookieIfNotExists(name, value, daysToExpire, path) {
            return (getCookie(name) === null) ? setCookie(name, value, daysToExpire, path) : "";
        }

        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for(var i = 0; i <ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return null;
        }
        
        function deleteCookie(name, path = "/") {
            setCookie(name, "", -1, path);
        }

        /** User Page Tracking **/
        function trackUserVisitedPage() {
            if(window.location.href.indexOf('viewed-pages') === -1) {
                var page = {'title': document.title, 'href': window.location.href};
                visitedPages = JSON.parse(getCookie('visitedPages'));
                // Delete if exists
                $.each(visitedPages, function(index, obj) {
                    if((obj.href === page.href)) { delete(visitedPages[index]); }
                });
                // Re-index Array
                var newVisitedPages = [];
                $.each(visitedPages, function(i, v){
                    if((v != null) && (typeof v !== 'undefined')){
                        newVisitedPages.push(v);
                    }
                });
                visitedPages = newVisitedPages;
                visitedPages.push(page);
                // Keep 10 Records
                if(visitedPages.length > 10) {
                    visitedPages = visitedPages.slice(visitedPages.length - 10, visitedPages.length);
                }
                setCookie('visitedPages', JSON.stringify(visitedPages), 4000, "/");
            }
            $.post("#/api/user/url-tracking", {uuid: getCookie('uuid'), url: window.location.href});
        }

        /** Header Specialities Script **/
        var specialitySlug = "";
        $('.speciality').click(function(event) {
            event.preventDefault();
            specialitySlug = $(this).data('slug');
            askForCity(event);
        });
        $('.city-name').click(function(event) {
            event.preventDefault();
            var citySlug = $(this).data('slug');
            redirectUrl(citySlug, specialitySlug);
        });
        $("#other_city").click(function(event) {
            $("#other_cities").show();
        });
        $("#other_cities").change(function() {
            var citySlug = $(this).val();
            redirectUrl(citySlug, specialitySlug);
        });
        function askForCity(e) {
            toggleModal(e, 'city_modal', 'show');
        }
        function redirectUrl(citySlug, specialitySlug) {
            if(citySlug !== '' && specialitySlug !== '') {
                location.href = "#" + citySlug + "/" + specialitySlug;
            }
        }

        $(document).ready(function() {
            setCookieIfNotExists('uuid', createUniqueUserId(), 4000, '/');
            var utmSource = getUrlParameter('utm_source');
            var utmMedium = getUrlParameter('utm_medium');
            var utmCampaign = getUrlParameter('utm_campaign');
            setCookieIfNotExists('visitor_source', getVisitorSource(), 4000, '/');
            var visitorSource = getCookie('visitor_source');
            if((visitorSource == 'Google') && (utmSource === null)) {
                utmSource = 'Google';
            }
            if(utmSource !== null) {
                setCookie('utm_source', utmSource, 1, '/');
            }
            if(utmMedium !== null) {
                setCookie('utm_medium', utmMedium, 1, '/');
            }
            if(utmCampaign !== null) {
                setCookie('utm_campaign', utmCampaign, 1, '/');
            }
            // Track User
            if((utmSource !== null || utmMedium !== null || utmCampaign !== null) || (getCookie('user_visited') == null)) {
                $.post("#/api/user/tracking", {uuid: getCookie('uuid'), visitorSource: visitorSource, utmSource: utmSource, utmMedium: utmMedium, utmCampaign: utmCampaign});
            }
            setCookieIfNotExists('user_visited', 1, 1, '/');
            /** Cookie Settings **/
            trackUserVisitedPage();
            $(".show-more").click(function(e) {
                e.preventDefault();
                $(this).html($(this).data('content'));
            });
            setTimeout(function() {
                                !function(f,b,e,v,n,t,s)
                {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                n.queue=[];t=b.createElement(e);t.async=!0;
                t.src=v;s=b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t,s)}(window, document,'script',
                'https://connect.facebook.net/en_US/fbevents.js');
                fbq('init', '2941007565939100');
                fbq('track', 'PageView');
                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-74117661-1', 'auto');
    ga('send', 'pageview');
                                $.getScript("https://maps.google.com/maps/api/js?key=AIzaSyCyY6jQW8GXyhGksukHQuBOhzfIbsD6Gm8");
            }, 2000);
        });
    </script>
            <script type="text/javascript">function goal3(){ga("send",{hitType:"event",eventCategory:"doctor-registration",eventAction:"doctor-registration",eventLabel:"doctor-registration",eventValue:1})}function goal7(e){var a=e.dataset.label,t=e.dataset.value;ga("send",{hitType:"event",eventCategory:"book-appointment",eventAction:"dr-profile-call",eventLabel:a,eventValue:t})}function goal8(e){var a=e.dataset.action,t=e.dataset.label,n=e.dataset.value;ga("send",{hitType:"event",eventCategory:"online-appointment",eventAction:a,eventLabel:t,eventValue:n})}function goal9(){ga("send",{hitType:"event",eventCategory:"online-appointment-call",eventAction:"direct-call",eventLabel:"direct-call",eventValue:"0"})}function goal11(e){var a=e.dataset.label,t=e.dataset.value;ga("send",{hitType:"event",eventCategory:"book-appointment-on-panel",eventAction:"On-panel-dr-profile-call",eventLabel:a,eventValue:t})}function goal20(e){var a=e.dataset.label,t=e.dataset.value;ga("send",{hitType:"event",eventCategory:"onpanel-dr-profile-hospital",eventAction:"onpanel-dr-profile-hospital-click",eventLabel:a,eventValue:t})}$(document).on("click",".ga-goal-3, .ga-goal-7, .ga-goal-8, .ga-goal-9, .ga-goal-11, .ga-goal-20",function(e){$(this).hasClass("ga-goal-3")?goal3(this):$(this).hasClass("ga-goal-7")?goal7(this):$(this).hasClass("ga-goal-8")?goal8(this):$(this).hasClass("ga-goal-9")?goal9():$(this).hasClass("ga-goal-11")?goal11(this):$(this).hasClass("ga-goal-20")&&goal20(this)});</script>       <script type="text/javascript">function gaEventOnPanelDoctorGrade(n=5){ga("send","event","On-panel-profile","On-panel-grade",1==n?"on-panel-grade-1":2==n?"on-panel-grade-2":3==n?"on-panel-grade-incomplete":4==n?"on-panel-grade-young":"on-panel-grade-others")}function gaEventOnpanelDoctorProfileView(){ga("send","event","On-panel-profile","On-panel-view","on-panel-profile-view")}function gaEventOnpanelDoctorProfileClickBookAppointment(){ga("send","event","On-panel-profile","On-panel-click","profile-book-online-button")}function gaEventOnpanelDoctorProfileClickSendMessage(){ga("send","event","On-panel-profile","On-panel-click","profile-send-message-button")}function gaEventOffpanelDoctorProfileView(){ga("send","event","Off-panel Profile","Off-panel-View","off-panel-doctor-view")}function gaEventOcRequestBasicInfoButton(){try{setTimeout(function(){ga("send","event","oc-conversion-funnel","oc-conversion-click","oc-basic-info-btn")},2e3)}catch(n){}}function gaEventOcRequestVerificationButton(){try{setTimeout(function(){ga("send","event","oc-conversion-funnel","oc-conversion-click","oc-verification-btn")},2e3)}catch(n){}}function gaEventOcRequestNameButton(){ga("send","event","oc-conversion-funnel","oc-conversion-click","oc-name-btn")}function gaEventOcPaymentEvidenceSubmitButton(){ga("send","event","oc-conversion-funnel","oc-conversion-click","oc-evidence-submit-btn")}$(document).on("click",".ga-event-listing-search",function(){ga("send","event","Listing","On-panel-Click","Listing-Search")}),$(document).on("change",".ga-event-listing-filter",function(n){var e=n.target.dataset.eventAction,o=$("#cities :selected").data("slug"),t=void 0!==$("#specialities")?$("#specialities :selected").data("slug"):"",c=$("#areas :selected").data("slug"),i=$("#fee_ranges :selected").data("slug"),l=$("#genders :selected").data("slug");ga("send","event","Listing-Filters",e,"Filter"+(void 0!==o?"+"+o:"")+(void 0!==t?"+"+t:"")+(void 0!==c?"+"+c:"")+(void 0!==i?"+"+i:"")+(void 0!==l?"+"+l:""))}),$(document).on("click",".ga-event-listing-doctor-photo",function(){ga("send","event","Listing","On-panel-Click","Listing-doctor-photo")}),$(document).on("click",".ga-event-listing-doctor-name",function(){ga("send","event","Listing","On-panel-Click","Listing-doctor-name")}),$(document).on("click",".ga-event-listing-urdu-call-button",function(){ga("send","event","Listing","On-panel-Click","Listing-urdu-button")}),$(document).on("click",".ga-event-listing-hospital-name",function(){ga("send","event","Listing","On-panel-Click","Listing-hospital-name")}),$(document).on("click",".ga-event-listing-book-appointment-button",function(){ga("send","event","Listing","On-panel-Click","Listing-book-button")}),$(document).on("click",".ga-event-listing-view-profile-button",function(){ga("send","event","Listing","On-panel-Click","Listing-view-button")}),$(document).on("click",".ga-event-listing-faq",function(n){var e=void 0!==n.target.dataset.eventLabel?n.target.dataset.eventLabel:"Listing-faqs";ga("send","event","Listing","Faqs-Listing",e)}),$(document).on("click",".ga-event-listing-doctor-faq-timings",function(n){ga("send","event","Listing","On-panel-Click","Listing-doctor-faq-timings")}),$(document).on("click",".ga-event-listing-doctor-faq-speciality",function(n){ga("send","event","Listing","On-panel-Click","Listing-doctor-faq-speciality")}),$(document).on("click",".ga-event-listing-doctor-faq-reviews",function(n){ga("send","event","Listing","On-panel-Click","Listing-doctor-faq-reviews")}),$(document).on("click",".ga-event-listing-most-booked",function(n){ga("send","event","Listing","On-panel-Click","Listing-most-booked")}),$(document).on("click",".ga-event-listing-top-reviewed",function(n){ga("send","event","Listing","On-panel-Click","Listing-top-reviews")}),$(document).on("click",".ga-event-listing-consult-online",function(n){ga("send","event","Listing","On-panel-Click","Listing-consult-online")}),$(document).on("click",".ga-event-listing-offpanel-doctor-name",function(){ga("send","event","Listing","Off-panel-click","offpanel-doctor-name")}),$(document).on("click",".ga-event-listing-offpanel-doctor-view-profile",function(){ga("send","event","Listing","Off-panel-click","offpanel-view-button")}),$(document).on("click",".ga-event-onpanel-doctor-profile-book-appointment-fixed-bar",function(){ga("send","event","On-panel-profile","On-panel-click","profile-fixed-book-button")}),$(document).on("click",".ga-event-onpanel-doctor-profile-call-fixed-bar",function(){ga("send","event","On-panel-profile","On-panel-click","profile-fixed-call-button")}),$(document).on("click",".ga-event-onpanel-doctor-profile-click-date",function(){ga("send","event","On-panel-profile","On-panel-click","profile-date-click")}),$(document).on("click",".ga-event-onpanel-doctor-profile-click-time",function(){ga("send","event","On-panel-profile","On-panel-click","profile-time-click")}),$(document).on("click",".ga-event-onpanel-doctor-profile-click-services",function(){ga("send","event","On-panel-profile","On-panel-click","profile-service-click")}),$(document).on("click",".ga-event-onpanel-doctor-profile-click-all-reviews",function(){ga("send","event","On-panel-profile","On-panel-click","profile-reviews-click")}),$(document).on("click",".ga-event-onpanel-doctor-profile-doctor-faqs",function(n){var e=n.target.dataset.eventLabel;ga("send","event","On-panel-profile","On-panel-click",e)}),$(document).on("click",".ga-event-onpanel-doctor-profile-top-doctors",function(n){ga("send","event","On-panel-profile","On-panel-click","profile-top-doctors-click")}),$(document).on("click",".ga-event-offpanel-doctor-contact",function(){ga("send","event","Off-panel Profile","Off-panel-Click","off-panel-contact-button")}),$(document).on("click",".ga-event-offpanel-doctor-faqs",function(){ga("send","event","Off-panel Profile","Off-panel-Click","off-panel-faqs")}),$(document).on("click",".ga-event-offpanel-doctor-top-doctors",function(n){ga("send","event","Off-panel-profile","Off-panel-click","profile-top-doctors-click")}),$(document).on("click",".ga-event-offpanel-doctor-similar-doctor",function(n){ga("send","event","Off-panel-profile","Off-panel-click","profile-similar-doctors-click")}),$(document).on("click",".ga-event-doctor-profile-similar-doctors",function(){ga("send","event","Profile","On-panel-click","profile-similar-doctors")}),$(document).on("click",".ga-event-onpanel-hospital-profile-click-helpline",function(){ga("send","event","Hospital","On-panel-Click","hospital-helpline-button")}),$(document).on("click",".ga-event-onpanel-hospital-profile-click-urdu",function(){ga("send","event","Hospital","On-panel-Click","hospital-urdu-button")}),$(document).on("click",".ga-event-onpanel-hospital-profile-click-doctor-name",function(){ga("send","event","Hospital","On-panel-Click","hospital-doctor-name")}),$(document).on("click",".ga-event-onpanel-hospital-profile-click-doctor-view-profile",function(){ga("send","event","Hospital","On-panel-Click","hospital-view-button")}),$(document).on("click",".ga-event-onpanel-hospital-profile-top-doctors",function(){ga("send","event","Hospital","On-panel-Click","hospital-top-doctors-click")}),$(document).on("click",".ga-event-offpanel-hospital-profile-top-doctors",function(){ga("send","event","Hospital","Off-panel-Click","hospital-top-doctors-click")}),$(document).on("click",".ga-event-offpanel-hospital-profile-click-helpline",function(){ga("send","event","Hospital","Off-panel-Click","hospital-helpline-button")}),$(document).on("click",".ga-event-online-consultation-listing-faq",function(n){var e=void 0!==n.target.dataset.eventLabel?n.target.dataset.eventLabel:"Online-Consultation-Listing-faqs";ga("send","event","Listing","Faqs-Listing",e)}),$(document).on("click",".ga-event-online-consultation-whatsapp",function(n){ga("send","event","Online-Consultation","Online-Consultation-whatsapp","online-consultation-whatsapp-click")}),$(document).on("click",".ga-event-online-consultation-listing",function(n){ga("send","event","Online-Consultation","Book-Online-Consultation","online-consultation-listing-book")}),$(document).on("click",".ga-event-oc-navigation",function(n){ga("send","event","oc-conversion-funnel","oc-conversion-click","oc-nav")}),$(document).on("click",".ga-event-oc-homepage-button",function(n){ga("send","event","oc-conversion-funnel","oc-conversion-click","on-homepage-btn")}),$(document).on("click",".ga-event-oc-homepage-specialities",function(n){ga("send","event","oc-conversion-funnel","oc-conversion-click","oc-homepage-specialities")}),$(document).on("click",".ga-event-oc-find-a-doctor-specialities",function(n){ga("send","event","oc-conversion-funnel","oc-conversion-click","oc-find-a-doctor-specialities")}),$(document).on("click",".ga-event-oc-find-a-doctor-button",function(n){ga("send","event","oc-conversion-funnel","oc-conversion-click","oc-find-a-doctor-btn")}),$(document).on("click",".ga-event-oc-doctor-listing-button",function(n){ga("send","event","oc-conversion-funnel","oc-conversion-click","oc-doctor-listing-btn")}),$(document).on("click",".ga-event-oc-speciality-listing-button",function(n){ga("send","event","oc-conversion-funnel","oc-conversion-click","oc-speciality-listing-btn")}),$(document).on("click",".ga-event-oc-profile-button",function(n){ga("send","event","oc-conversion-funnel","oc-conversion-click","oc-profile-btn")}),$(document).on("click",".ga-event-oc-request-time-slot",function(n){try{setTimeout(function(){ga("send","event","oc-conversion-funnel","oc-conversion-click","oc-time-slot")},2e3)}catch(n){}}),$(document).on("click",".ga-event-oc-payment-method-button",function(n){ga("send","event","oc-conversion-funnel","oc-conversion-click","oc-payment-method-btn")}),$(document).on("click",".ga-event-oc-payment-method-bank",function(n){ga("send","event","oc-conversion-funnel","oc-conversion-click","oc-payment-method-bank")}),$(document).on("click",".ga-event-oc-payment-method-easypaisa",function(n){ga("send","event","oc-conversion-funnel","oc-conversion-click","oc-payment-method-easypaisa")}),$(document).on("click",".ga-event-oc-payment-method-jazzcash",function(n){ga("send","event","oc-conversion-funnel","oc-conversion-click","oc-payment-method-jazzcash")}),$(document).on("click",".ga-event-oc-payment-method-creditcard",function(n){ga("send","event","oc-conversion-funnel","oc-conversion-click","oc-payment-method-creditcard")}),$(document).on("click",".ga-event-oc-payment-evidence-attach-button",function(n){ga("send","event","oc-conversion-funnel","oc-conversion-click","oc-evidence-attach-btn")}),$(document).on("click",".ga-event-forum-book-oc-button",function(n){ga("send","event","oc-conversion-funnel","oc-conversion-click","oc-forum-btn")}),$(document).on("click",".ga-event-oc-banner-button",function(n){ga("send","event","oc-conversion-funnel","oc-conversion-click","oc-snippet-btn")});</script>          <script type="application/ld+json">
    {
        "@context" : "https://schema.org",
        "@type" : "Organization",
        "name" : "Marham",
        "url" : "#",
        "logo": "#/assets/images/app-logo.png",
        "description": "Your next favourite appointment booking system. Find and book appointments online with the best health professionals. Get you health concerns solved faster by reaching out to doctors, hospitals and clinics in a much easier way!",
        "foundingDate": "2015",
        "sameAs" : [
            "https://www.youtube.com/channel/UC4T_g_TV3egBTHD8xzNuBTA",
            "https://www.facebook.com/marham.pk",
            "https://twitter.com/marhampk",
            "https://www.linkedin.com/company/marham",
            "https://www.instagram.com/marhampk"
        ],
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "4 Shershah Road",
            "addressLocality": "Shershah Block, Garden Town",
            "addressRegion": "Lahore",
            "postalCode": "54000",
            "addressCountry": {
                "@type": "Country",
                "name": "Pakistan"
            }
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": " +92 42 32591427",
            "contactType": "Customer Service (Call Center)",
            "email": "info@marham.pk",
            "areaServed": "Pakistan"
        }
    }
</script>   <script src="https://h7u5d3a4.stackpathcdn.com/assets/js/jquery.cookie.min.js" type="text/javascript"></script>
<script src="https://www.gstatic.com/firebasejs/3.9.0/firebase.js" type="text/javascript"></script>
<script src="https://www.gstatic.com/firebasejs/3.9.0/firebase-app.js" type="text/javascript"></script>
<script src="https://www.gstatic.com/firebasejs/3.9.0/firebase-messaging.js" type="text/javascript"></script>
<script type="text/javascript">
    $(window).bind('load', function() {
        var config = {
            apiKey: "AIzaSyB586C2fxooDCKNrGVifS2671U3dwkysxw",
            authDomain: "marham-website.firebaseapp.com",
            databaseURL: "https://marham-website.firebaseio.com",
            projectId: "marham-website",
            storageBucket: "marham-website.appspot.com",
            messagingSenderId: "207224008013"
        };
        firebase.initializeApp(config);
        const messaging = firebase.messaging();
        messaging.requestPermission().then(function() {
            getFcmToken();
        }).catch(function(err) {
        });
        messaging.onTokenRefresh(function() {
        messaging.getToken().then(function(refreshedToken) {
                setTokenSentToServer(false);
                sendTokenToServer(refreshedToken);
                getFcmToken();
            }).catch(function(err) {
            });
        });
        messaging.onMessage(function(payload) {
            const notificationTitle = payload.data.heading;
            const notificationOptions = {
                body: payload.data.message,
                icon: "https://h7u5d3a4.stackpathcdn.com/assets/images/app-logo.png"
            };

            var consultationNotificationTypes = ['1001', '1002', '1003', '1004', '1005'];
            setTimeout(() => {
                if ((localStorage.getItem('lastNotificationId') != parseInt(payload.data.notId)) || 
                    (consultationNotificationTypes.includes(payload.data.notification_type) 
                        && ((typeof callRequested !== 'undefined') || (typeof callCancelled !== 'undefined') || (typeof callEnded !== 'undefined') ) )
                ) {
                    localStorage.setItem('lastNotificationId', parseInt(payload.data.notId));
                    if (!("Notification" in window)) {
                        // console.log("This browser does not support system notifications");
                    } else if (Notification.permission === "granted") {
                        // var notification = new Notification(notificationTitle,notificationOptions);
                        var notificationTypes = ['101','102','103', '201','202','203','204','205'];
                        // var consultationNotificationTypes = ['1001', '1002', '1003', '1004', '1005'];

                        if(notificationTypes.includes(payload.data.notification_type)) {
                            if(getLoggedInUser() != null && getLoggedInUser().id == payload.data.userId) {
                                addNotificationToList(payload.data.heading, payload.data.message, payload.data.url, payload.data.notification_type);
                            }
                        } else if(consultationNotificationTypes.includes(payload.data.notification_type)) {
                            if(payload.data.notification_type == '1001') {
                                // Will be called from doctor side on waiting screen
                                if(typeof callRequested !== 'undefined') {
                                    callRequested();
                                }
                            } else if(payload.data.notification_type == '1002') {
                                // Will be called from doctor side on waiting screen
                                if(typeof callCancelled !== 'undefined') {
                                    callCancelled();
                                }
                            } else if(payload.data.notification_type == '1003') {
                                // Will be called from doctor side on consultation screen
                                if(typeof callEnded !== 'undefined') {
                                    callEnded();
                                }
                            } else if(payload.data.notification_type == '1004') {
                                // Will be called from patient side and handled on doctor side
                                // if(typeof callAccepted !== 'undefined') {
                                //  callAccepted();
                                // }
                            } else if(payload.data.notification_type == '1005') {
                                // Will be called from patient side and handled on doctor side
                                // if(typeof callRejected !== 'undefined') {
                                //  callRejected();
                                // }
                            }
                        } else {
                            $.cookie('show_notification_counter', 1);
                            if(payload.data.unseenCount != 0) {
                                $("#notification_count_new").html(payload.data.unseenCount);
                            }
                            var notification = new Notification(notificationTitle, notificationOptions);
                            notification.onclick = function(event) {
                                event.preventDefault();
                                window.open(payload.data.url , '_blank');
                                notification.close();
                            }
                        }
                    }
                }
            }, Math.random() * 1000);
            $("#notification_count").html('Notifications ('+payload.data.count+')');
        });
        function getFcmToken() {
            messaging.getToken().then(function(currentToken) {
                if (currentToken) {
                    $.ajax({
                        url : '#/save-fcm-token',
                        type : 'POST',
                        data :  {_token: $('meta[name="csrf-token"]').attr('content'), fcmToken: currentToken, uuid: getCookie('uuid') },
                        tryCount : 0,
                        retryLimit : 3,
                        success : function(response) {
                            //console.log(response);
                        },
                        error : function(xhr, textStatus, errorThrown ) {
                            if(xhr.status == 422) {
                            } else {
                                this.tryCount++;
                                if (this.tryCount <= this.retryLimit) {
                                    $.ajax(this);
                                    return;
                                }
                            }
                            return;
                        }
                    });
                    sendTokenToServer(currentToken);
                } else {
                    //console.log('No Instance ID token available. Request permission to generate one.');
                    setTokenSentToServer(false);
                }
            }).catch(function(err) {
                //console.log('An error occurred while retrieving token. ', err);
            });
        }

        function sendTokenToServer(currentToken) {
            if (!isTokenSentToServer()) {
              //console.log('Sending token to server...');
              setTokenSentToServer(true);
            } else {
              //console.log('Token already sent to server so won\'t send it again ' + 'unless it changes');
            }
          }
        function isTokenSentToServer() {
            if (window.localStorage.getItem('sentToServer') == 1) {
                  return true;
            }
            return false;
        }
        function setTokenSentToServer(sent) {
            window.localStorage.setItem('sentToServer', sent ? 1 : 0);
            //console.log('Token send to server');
        }

        function getLoggedInUser() {
            return null;
        }
        var page = 1;
        var processRequest = true;
        displayNotifications();

        function displayNotifications() {

            var userId = 0;
            var user = getLoggedInUser();
            if(user != null) {
                userId = user.id;
            }
            getNotificationCount(userId);
            getNotificationList(userId, page);
            $("#notifications_list_container").on('scroll', scrollNotifications);
        }
        function scrollNotifications() {

            if(processRequest){

                if(($("#notifications_list_container").scrollTop() + $("#notifications_list_container").height()) > ($("#notifications_list_new").height() - 100)) {
                    processRequest = false;
                   //$("#notifications_list_container").off('scroll');
                   page++;
                   displayNotifications();
               }
            }
        }

        function getNotificationCount(userId) {
            $.ajax({
                url: '#/api/get-unseen-notifications-count',
                type: "GET",
                data: {
                    userId: userId,
                    appType: 1,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                tryCount : 0,
                retryLimit : 3,
                success: function(response) {
                        //console.log(response);
                    if(response.status) {
                        if( $('#notification_count_new').length ) {

                            if($.cookie('show_notification_counter') != null && $.cookie('show_notification_counter') == 1) {
                                $("#notification_count_new").html(response.count);
                            } else {
                                $("#notification_count_new").html();
                            }
                        }

                        if( $('#notification_count').length ) {
                            $("#notification_count").html('Notifications ('+response.count+')');
                        }
                    } else {
                                                
                        if( $('#notification_count_new').length ) {
                            $("#notification_count_new").html();
                        }

                        if( $('#notification_count').length ) {
                            $("#notification_count").html('Notifications ()');
                        }
                    }
                },
                error : function(xhr, textStatus, errorThrown ) {
                    if(xhr.status == 422) {
                    } else {
                        this.tryCount++;
                        if (this.tryCount <= this.retryLimit) {
                            $.ajax(this);
                            return;
                        }
                    }
                    return;
                }
            });
        }

        function getNotificationList(userId, page) {
            $.ajax({
                url: '#/api/get-notifications-list',
                type: "GET",
                data: {
                    userId: userId,
                    appType: 1,
                    page: page,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                tryCount : 0,
                retryLimit : 3,
                success: function(response) {
                    if(response.status) {
                        if( $('#notifications_list_new').length ) {
                            $("#notifications_list_new").append(response.html);
                        }

                        if( $('#notification_count').length ) {
                            //$("#notification_count").html('Notifications ('+response.count+')');
                        }
                        processRequest = true;
                    } else {
                        if(page == 1) {
                            $("#notifications_list_new").append(response.html);
                        } 
                        processRequest = false;
                    }
                },
                error : function(xhr, textStatus, errorThrown ) {
                    if(xhr.status == 422) {
                    } else {
                        this.tryCount++;
                        if (this.tryCount <= this.retryLimit) {
                            $.ajax(this);
                            return;
                        }
                    }
                    return;
                }
            });
        }
        changeNotificationStatus();
        function changeNotificationStatus() {
            var notificationId = getParam('notif_id');

            var user = getLoggedInUser();

            if(user != null) {
                if(notificationId != 0) {
                    $.ajax({
                        url: '#/api/change-notification-status',
                        type: "GET",
                        data: {
                            notificationId: notificationId,
                            userId: user.id,
                            seen: 1,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        tryCount : 0,
                        retryLimit : 3,
                        success: function(response) {
                            if(response.status) {

                                if( $('#notification_count_new').length ) {
                                    $("#notification_count_new").html(response.count);
                                }

                                if( $('#notification_count').length ) {
                                    $("#notification_count").html('Notifications ('+response.count+')');
                                }
                            }
                        },
                        error : function(xhr, textStatus, errorThrown ) {
                            if(xhr.status == 422) {
                            } else {
                                this.tryCount++;
                                if (this.tryCount <= this.retryLimit) {
                                    $.ajax(this);
                                    return;
                                }
                            }
                            return;
                        }
                    });
                }
            }
        }

        $("#show_notifications_counter").click(function() {
            resetNotificationCounter();
        });

        function resetNotificationCounter() {
            $.cookie('show_notification_counter', 0);
            $("#notification_count_new").html('');
        }

        function getParam(param) {
            var vars = {};
            window.location.href.replace( location.hash, '' ).replace( 
                /[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
                function( m, key, value ) { // callback
                    vars[key] = value !== undefined ? value : '';
                }
            );

            if ( param ) {
                return vars[param] ? vars[param] : 0;   
            }
            return vars;
        }

        function addNotificationToList(title, body, url, notificationType) {

            var loggedInUser = getLoggedInUser();
            var notificationText = '<a class="dropdown-item deck_notification" href='+url+' style="background-color: #f5f5f5">'+
                                        '<div class="notification-item">'+
                                            '<h5>'+title+'</h5>'+
                                            '<p>'+body+'</p>'+
                                            '<label></label>'+
                                        '</div>'+
                                    '</a>';
            if(loggedInUser != null) {

                $("#notifications_list_new").prepend(notificationText);
            } else {
                // if(notificationType == 602) {

                //  $("#notifications_list_new").prepend(notificationText);
                // }
            }
        }
    });
</script>    <script type="application/ld+json">
    {"@context":"http://schema.org","@type":"BreadcrumbList","itemListElement":[{"@type":"ListItem","position":1,"item":{"@id":"#","name":"Home"}}]}
</script>
</body>
</html>
@endsection