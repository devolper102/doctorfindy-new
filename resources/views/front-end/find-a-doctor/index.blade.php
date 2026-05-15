@extends('front-end.master')
@section('description', '')
@section('keywords', '')
@section('content')
<div class="container" id="user-profile">
    <find-a-doctor
            :specialities-data="{{$specialities}}"
            :top-specialities-data="{{$topspecialities}}"
            :services-data="{{$services}}"
    >
    </find-a-doctor>
</div>
<!-- modal -->
<div id="city_modal" class="modal">
    <div class="modal-content" style="padding-top: 30px; padding-bottom: 30px;">
        <span class="close" data-dismiss="modal">×</span>
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
