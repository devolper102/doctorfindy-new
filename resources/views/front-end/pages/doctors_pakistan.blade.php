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
                <h1>Best PMDC Verified Doctors In Pakistan</h1>
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li>Find a Doctor</li>
                </ul>
            </div>
        </div>  
    </div>

    <div class="row mt-2 bg-white padding">
        <div class="col-12">
            <h2>Doctors in  Top Cities</h2>
            <ul class="grid-list">
                                <li><a href="#">Doctors in <span style="color: #c02942">Lahore</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Karachi</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Islamabad</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Rawalpindi</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Faisalabad</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Gujranwala</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Peshawar</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Sialkot</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Multan</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Sargodha</span></a></li>
                            </ul>
        </div>
    </div>

    <div class="row mt-2 bg-white padding">
        <div class="col-12">
            <h2>Doctors in Other Cities</h2>
            <ul class="grid-list">
                                <li><a href="#">Doctors in <span style="color: #c02942">Quetta</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Abbottabad</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Attock</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Bahawalnagar</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Bahawalpur</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Bannu</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Bhakkar</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Bhalwal</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Burewala</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Chakwal</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Charsadda</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Chishtian</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Daska</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Dera Ghazi Khan</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Dina</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Gojra</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Gujrat</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Hafizabad</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Hyderabad</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Istanbul</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Izmir</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Jacobabad</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Jhang</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Jhelum</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Kamoke</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Kasur</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Kayseri</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Khanewal</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">kharian</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Khushab</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Kohat</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Larkana</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Layyah</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Lodhran</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Loralai</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Mansehra</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Mardan</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Mian Channu</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Mianwali</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Nankana Sahib</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Nawabshah</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Nowshera</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Okara</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Pattoki</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Rahim Yar Khan</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Riyadh</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Sahiwal</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Shahkot</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Sheikhupura</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">shorkot</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Swabi</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Swat</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Talagang</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Tarbela</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Taxila</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Vehari</span></a></li>
                                <li><a href="#">Doctors in <span style="color: #c02942">Wah Cantt</span></a></li>
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
                    <a href="#">
                    <div class="display-block">
                        <img src="https://h7u5d3a4.stackpathcdn.com/assets/images/home-new/psychologist.jpg" alt=""/>
                        <div class="divider"></div>
                        <div class="card-content clearfix">
                            <p class="label-big"><small><i class="fa fa-circle"></i></small> Psychologist</p>
                            <small>98% satisfied patients</small>
                        </div>
                    </div></a>
                </li>

                <li>
                    <a href="#">
                    <div class="display-block">
                        <img src="https://h7u5d3a4.stackpathcdn.com/assets/images/home-new/urologist-online.jpg" alt=""/>
                        <div class="divider"></div>
                        <div class="card-content">
                            <p class="label-big"><small><i class="fa fa-circle"></i></small> Urologist</p>
                            <small>96% satisfied patients</small>
                        </div>
                    </div></a>
                </li>

                <li>
                    <a href="#">
                    <div class="display-block">
                        <img src="https://h7u5d3a4.stackpathcdn.com/assets/images/home-new/gynecologist-online.jpg" alt=""/>
                        <div class="divider"></div>
                        <div class="card-content">
                            <p class="label-big"><small><i class="fa fa-circle"></i></small> Gynecologist</p>
                            <small>99% satisfied patients</small>
                        </div>
                    </div></a>
                </li>

                <li>
                    <a href="#">
                    <div class="display-block">
                        <img src="https://h7u5d3a4.stackpathcdn.com/assets/images/home-new/nutritionist-online.jpg" alt=""/>
                        <div class="divider"></div>
                        <div class="card-content">
                            <p class="label-big"><small><i class="fa fa-circle"></i></small> Nutritionist</p>
                            <small>95% satisfied patients</small>
                        </div>
                    </div></a>
                </li>

                <li>
                    <a href="#">
                    <div class="display-block">
                        <img src="https://h7u5d3a4.stackpathcdn.com/assets/images/home-new/general-physician-online.jpg" alt=""/>
                        <div class="divider"></div>
                        <div class="card-content">
                            <p class="label-big"><small><i class="fa fa-circle"></i></small> Physician</p>
                            <small>98% satisfied patients</small>
                        </div>
                    </div></a>
                </li>

                <li>
                    <a href="#">
                    <div class="display-block">
                        <img src="https://h7u5d3a4.stackpathcdn.com/assets/images/home-new/pediatrician-online.jpg" alt=""/>
                        <div class="divider"></div>
                        <div class="card-content">
                            <p class="label-big"><small><i class="fa fa-circle"></i></small> Pediatrician</p>
                            <small>99% satisfied patients</small>
                        </div>
                    </div></a>
                </li>
            </ul>
            <button class="mt-4 d-block d-sm-none button-main" onclick="location.href='#'" style="width: 100%;">How to consult online?</button>
            <button class="mt-4 d-none d-sm-block button-main" onclick="location.href='#/online-consultation'">How to consult online?</button>

        </div>
    </div>
    <!--Banner ends -->

    <div class="row bg-white padding mt-2">
        <div class="col-12">
            <p>You can book appointment by calling at <a href="tel:042-30001427">042-30001427</a> or <a href="tel:042-30001429">042-30001429</a>. You can also book online by choosing an available date and time slot on the profile of doctor. There are no extra charges for booking through Marham.</p>
        </div>
    </div>
</div>
    <div id="contact_modal" class="modal">
    <div class="modal-content">
        <span class="close" data-modal="contact_modal" onclick="toggleModal(event, 'contact_modal', 'hide')">&times;</span>
        <h3>Call Here:</h3>
                <button class="mt-2 button-main" onclick="location.href='tel:042-00591427'"><i class="fa fa-phone"></i> Call 042-32591427</button> <br>
                <button class="mt-2 button-main" onclick="location.href='tel:042-00591429'"><i class="fa fa-phone"></i> Call 042-32591429</button>
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