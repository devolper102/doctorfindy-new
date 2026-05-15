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
<div class="container">
    <div class="row bg-white padding mt-2">
        <div class="row mt-2 bg-white padding">
            <div class="col-12">
                <h1>Best Hospitals In Johar Town Lahore | Doctors Lists, Addresses And Contact Info</h1>
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#/hospitals-in-pakistan">All Hospitals</a></li>
                    <li>Lahore</li>
                </ul>
                                <p class="mt-2 text-justify">Lahore, apart from being the city of gardens, also boosts to be the home to some of the <a href="#/hospitals-in-pakistan">best hospitals in Pakistan</a>. Packed with the most qualified and experienced healthcare professionals, outstanding patient care, and latest medical technology that offers the best diagnostic and treatment facilities, these top rated hospitals in Lahore are known for their services nationally and internationally.

For your convenience, we have categorized hospitals and clinics in Lahore according to their versatility in medical services and specialization fields, as well as their highly reasonable fee structure to benefit maximum number of people in need.

Don't know the details of the best hospitals in Lahore?

Visit <a href="#">marham.pk</a> to find out all the details about the best hospitals in Lahore, its staff and services, appointment schedules, and accommodation criterion
</p>
                            </div>
        </div>
    </div>

    <div class="row bg-white padding mt-2">
        <div class="col-2">
            <select id="cities" class="u-full-width">
                <option>Select City</option>
                                <option value="Lahore" data-slug="lahore">Lahore</option>
                                <option value="Karachi" data-slug="karachi">Karachi</option>
                                <option value="Islamabad" data-slug="islamabad">Islamabad</option>
                                <option value="Rawalpindi" data-slug="rawalpindi">Rawalpindi</option>
                                <option value="Faisalabad" data-slug="faisalabad">Faisalabad</option>
                                <option value="Peshawar" data-slug="peshawar">Peshawar</option>
                                <option value="Multan" data-slug="multan">Multan</option>
                                <option value="Quetta" data-slug="quetta">Quetta</option>
                                <option value="Gujranwala" data-slug="gujranwala">Gujranwala</option>
                                <option value="Sargodha" data-slug="sargodha">Sargodha</option>
                                <option value="Abbottabad" data-slug="abbottabad">Abbottabad</option>
                                <option value="Attock" data-slug="attock">Attock</option>
                                <option value="Bahawalnagar" data-slug="bahawalnagar">Bahawalnagar</option>
                                <option value="Bahawalpur" data-slug="bahawalpur">Bahawalpur</option>
                                <option value="Bannu" data-slug="bannu">Bannu</option>
                                <option value="Bhakkar" data-slug="bhakkar">Bhakkar</option>
                                <option value="Bhalwal" data-slug="bhalwal">Bhalwal</option>
                                <option value="Burewala" data-slug="burewala">Burewala</option>
                                <option value="Chakwal" data-slug="chakwal">Chakwal</option>
                                <option value="Charsadda" data-slug="charsadda">Charsadda</option>
                                <option value="Chishtian" data-slug="chishtian">Chishtian</option>
                                <option value="Daska" data-slug="daska">Daska</option>
                                <option value="Dera Ghazi Khan" data-slug="dera-ghazi-khan">Dera Ghazi Khan</option>
                                <option value="Dina" data-slug="dina">Dina</option>
                                <option value="Gojra" data-slug="gojra">Gojra</option>
                                <option value="Gujrat" data-slug="gujrat">Gujrat</option>
                                <option value="Hafizabad" data-slug="hafizabad">Hafizabad</option>
                                <option value="Hyderabad" data-slug="hyderabad">Hyderabad</option>
                                <option value="Istanbul" data-slug="istanbul">Istanbul</option>
                                <option value="Izmir" data-slug="izmir">Izmir</option>
                                <option value="Jacobabad" data-slug="jacobabad">Jacobabad</option>
                                <option value="Jhang" data-slug="jhang">Jhang</option>
                                <option value="Jhelum" data-slug="jhelum">Jhelum</option>
                                <option value="Kamoke" data-slug="kamoke">Kamoke</option>
                                <option value="Kasur" data-slug="kasur">Kasur</option>
                                <option value="Kayseri" data-slug="kayseri">Kayseri</option>
                                <option value="Khanewal" data-slug="khanewal">Khanewal</option>
                                <option value="kharian" data-slug="kharian">kharian</option>
                                <option value="Khushab" data-slug="khushab">Khushab</option>
                                <option value="Kohat" data-slug="kohat">Kohat</option>
                                <option value="Larkana" data-slug="larkana">Larkana</option>
                                <option value="Layyah" data-slug="layyah">Layyah</option>
                                <option value="Lodhran" data-slug="lodhran">Lodhran</option>
                                <option value="Loralai" data-slug="loralai">Loralai</option>
                                <option value="Mansehra" data-slug="mansehra">Mansehra</option>
                                <option value="Mardan" data-slug="mardan">Mardan</option>
                                <option value="Mian Channu" data-slug="mian-channu">Mian Channu</option>
                                <option value="Mianwali" data-slug="mianwali">Mianwali</option>
                                <option value="Nankana Sahib" data-slug="nankana-sahib">Nankana Sahib</option>
                                <option value="Nawabshah" data-slug="nawabshah">Nawabshah</option>
                                <option value="Nowshera" data-slug="nowshera">Nowshera</option>
                                <option value="Okara" data-slug="okara">Okara</option>
                                <option value="Pattoki" data-slug="pattoki">Pattoki</option>
                                <option value="Rahim Yar Khan" data-slug="rahim-yar-khan">Rahim Yar Khan</option>
                                <option value="Riyadh" data-slug="riyadh">Riyadh</option>
                                <option value="Sahiwal" data-slug="sahiwal">Sahiwal</option>
                                <option value="Shahkot" data-slug="shahkot">Shahkot</option>
                                <option value="Sheikhupura" data-slug="sheikhupura">Sheikhupura</option>
                                <option value="shorkot" data-slug="shorkot">shorkot</option>
                                <option value="Sialkot" data-slug="sialkot">Sialkot</option>
                                <option value="Swabi" data-slug="swabi">Swabi</option>
                                <option value="Swat" data-slug="swat">Swat</option>
                                <option value="Talagang" data-slug="talagang">Talagang</option>
                                <option value="Tarbela" data-slug="tarbela">Tarbela</option>
                                <option value="Taxila" data-slug="taxila">Taxila</option>
                                <option value="Vehari" data-slug="vehari">Vehari</option>
                                <option value="Wah Cantt" data-slug="wah-cantt">Wah Cantt</option>
                            </select>
        </div>

                <div class="col-2">
            <select id="areas" class="u-full-width">
                <option>Select Area</option>
                                <option value="bhobatian-chowk-lahore" data-slug="bhobatian-chowk-lahore">, Bhobatian Chowk, Lahore</option>
                                <option value="civil-lines" data-slug="civil-lines">, Civil Lines</option>
                                <option value="91-b-upper-mall-scheme" data-slug="91-b-upper-mall-scheme">91-B Upper Mall Scheme</option>
                                <option value="abbas-block-mustafa-town" data-slug="abbas-block-mustafa-town">Abbas Block Mustafa Town</option>
                                <option value="abdul-sattar-edhi-road" data-slug="abdul-sattar-edhi-road">Abdul Sattar Edhi Road</option>
                                <option value="abdullah-market" data-slug="abdullah-market">Abdullah Market</option>
                                <option value="abul-hassan-isfahani-rd" data-slug="abul-hassan-isfahani-rd">Abul Hassan Isfahani Rd</option>
                                <option value="al-noor-town" data-slug="al-noor-town">Al Noor Town</option>
                                <option value="allama-iqbal-town" data-slug="allama-iqbal-town">Allama Iqbal Town</option>
                                <option value="anarkali" data-slug="anarkali">Anarkali</option>
                                <option value="arif-wala" data-slug="arif-wala">Arif Wala</option>
                                <option value="askari-v" data-slug="askari-v">Askari V</option>
                                <option value="australia" data-slug="australia">Australia</option>
                                <option value="awan-town" data-slug="awan-town">Awan Town</option>
                                <option value="awan-town-lahore" data-slug="awan-town-lahore">Awan Town,Lahore</option>
                                <option value="ayesha-sidiqa-road" data-slug="ayesha-sidiqa-road">Ayesha Sidiqa Road</option>
                                <option value="azad-kashmir" data-slug="azad-kashmir">Azad Kashmir</option>
                                <option value="badami-bagh" data-slug="badami-bagh">Badami Bagh</option>
                                <option value="baghbanpura" data-slug="baghbanpura">Baghbanpura</option>
                                <option value="bahar-shah-road-cantt" data-slug="bahar-shah-road-cantt">Bahar Shah Road, Cantt</option>
                                <option value="bahira-town" data-slug="bahira-town">bahira town</option>
                                <option value="bahrain" data-slug="bahrain">Bahrain</option>
                                <option value="bahria-orchard" data-slug="bahria-orchard">Bahria Orchard</option>
                                <option value="bahria-town" data-slug="bahria-town">Bahria Town</option>
                                <option value="baitul-raza-colony" data-slug="baitul-raza-colony">Baitul Raza Colony</option>
                                <option value="barkat-market" data-slug="barkat-market">Barkat Market</option>
                                <option value="barki" data-slug="barki">Barki</option>
                                <option value="begampura" data-slug="begampura">Begampura</option>
                                <option value="bhagban-pura" data-slug="bhagban-pura">Bhagban Pura</option>
                                <option value="bhakkar-mandi" data-slug="bhakkar-mandi">Bhakkar Mandi</option>
                                <option value="bhubtian-chowk" data-slug="bhubtian-chowk">Bhubtian Chowk</option>
                                <option value="bilal-ganj" data-slug="bilal-ganj">Bilal Ganj</option>
                                <option value="block-a-johar-town" data-slug="block-a-johar-town">Block A Johar town</option>
                                <option value="canal-gardens" data-slug="canal-gardens">Canal Gardens</option>
                                <option value="canal-road" data-slug="canal-road">Canal Road</option>
                                <option value="canal-view-house-society" data-slug="canal-view-house-society">Canal View House Society</option>
                                <option value="canal-view-society" data-slug="canal-view-society">Canal View Society</option>
                                <option value="cantt" data-slug="cantt">Cantt</option>
                                <option value="cavalry-ground" data-slug="cavalry-ground">Cavalry Ground</option>
                                <option value="chah-miran" data-slug="chah-miran">Chah Miran</option>
                                <option value="chowk-chauburji" data-slug="chowk-chauburji">Chowk Chauburji</option>
                                <option value="chungi-amar-sadhu" data-slug="chungi-amar-sadhu">Chungi Amar Sadhu</option>
                                <option value="college-road" data-slug="college-road">College Road</option>
                                <option value="cresent-town" data-slug="cresent-town">Cresent Town</option>
                                <option value="daroghewala" data-slug="daroghewala">Daroghewala</option>
                                <option value="dha" data-slug="dha">DHA</option>
                                <option value="dha-phase-1" data-slug="dha-phase-1">DHA Phase 1</option>
                                <option value="dha-phase-3" data-slug="dha-phase-3">DHA Phase 3</option>
                                <option value="dha-phase-4" data-slug="dha-phase-4">DHA Phase 4</option>
                                <option value="dha-phase-5" data-slug="dha-phase-5">DHA Phase 5</option>
                                <option value="dha-phase-6" data-slug="dha-phase-6">DHA Phase 6</option>
                                <option value="dha-phase-8" data-slug="dha-phase-8">DHA Phase 8</option>
                                <option value="dha-lahore" data-slug="dha-lahore">DHA, Lahore</option>
                                <option value="dharampura" data-slug="dharampura">Dharampura</option>
                                <option value="eme-society" data-slug="eme-society">Eme Society</option>
                                <option value="fb-area" data-slug="fb-area">F.B Area</option>
                                <option value="faisal-town" data-slug="faisal-town">Faisal Town</option>
                                <option value="fateh-garh" data-slug="fateh-garh">Fateh Garh</option>
                                <option value="ferozepur-road" data-slug="ferozepur-road">Ferozepur Road</option>
                                <option value="ferozpur-road" data-slug="ferozpur-road">Ferozpur Road</option>
                                <option value="firdous-market" data-slug="firdous-market">Firdous Market</option>
                                <option value="g-block" data-slug="g-block">G Block</option>
                                <option value="gt-road" data-slug="gt-road">G.T Road</option>
                                <option value="g5-wapda-town-phase-1" data-slug="g5-wapda-town-phase-1">G5 Wapda Town phase 1</option>
                                <option value="gajju-matta" data-slug="gajju-matta">Gajju Matta</option>
                                <option value="garden-town" data-slug="garden-town">Garden Town</option>
                                <option value="garhi-shahu" data-slug="garhi-shahu">Garhi Shahu</option>
                                <option value="ghazi-road" data-slug="ghazi-road">Ghazi Road</option>
                                <option value="ghaziabad" data-slug="ghaziabad">Ghaziabad</option>
                                <option value="gor" data-slug="gor">GOR</option>
                                <option value="gor-1" data-slug="gor-1">GOR 1</option>
                                <option value="green-acres" data-slug="green-acres">Green Acres</option>
                                <option value="green-town" data-slug="green-town">Green Town</option>
                                <option value="gt-road" data-slug="gt-road">GT Road</option>
                                <option value="gul-e-daman" data-slug="gul-e-daman">Gul E Daman</option>
                                <option value="gulberg" data-slug="gulberg">Gulberg</option>
                                <option value="gulberg-3" data-slug="gulberg-3">Gulberg 3</option>
                                <option value="gulberg-ii" data-slug="gulberg-ii">Gulberg II</option>
                                <option value="gulberg-iii" data-slug="gulberg-iii">Gulberg III</option>
                                <option value="gulberg-iv" data-slug="gulberg-iv">Gulberg IV</option>
                                <option value="gulberg-v" data-slug="gulberg-v">Gulberg V</option>
                                <option value="guldasht-town" data-slug="guldasht-town">Guldasht Town</option>
                                <option value="gulshan-e-ravi" data-slug="gulshan-e-ravi">Gulshan e Ravi</option>
                                <option value="gulshan-e-ravi" data-slug="gulshan-e-ravi">Gulshan-e-Ravi</option>
                                <option value="haji-park-housing-scheme" data-slug="haji-park-housing-scheme">Haji Park Housing Scheme</option>
                                <option value="hajvery-housing-scheme" data-slug="hajvery-housing-scheme">Hajvery Housing Scheme</option>
                                <option value="hameedpura-lahore" data-slug="hameedpura-lahore">Hameedpura, Lahore</option>
                                <option value="harbanspura" data-slug="harbanspura">Harbanspura</option>
                                <option value="ichra" data-slug="ichra">Ichra</option>
                                <option value="ideal-garden" data-slug="ideal-garden">Ideal Garden</option>
                                <option value="ideal-garden-housing-scheme" data-slug="ideal-garden-housing-scheme">Ideal Garden Housing Scheme</option>
                                <option value="iqbal-avenue" data-slug="iqbal-avenue">Iqbal Avenue</option>
                                <option value="iqbal-avenue-housing-society" data-slug="iqbal-avenue-housing-society">Iqbal Avenue housing Society</option>
                                <option value="islampura" data-slug="islampura">Islampura</option>
                                <option value="izmir-town" data-slug="izmir-town">Izmir town</option>
                                <option value="j3-block-wapda-town-phase-1" data-slug="j3-block-wapda-town-phase-1">J3 Block wapda town Phase 1</option>
                                <option value="jail-road" data-slug="jail-road">Jail Road</option>
                                <option value="jallo-more" data-slug="jallo-more">Jallo More</option>
                                <option value="jasmine-commercial-area" data-slug="jasmine-commercial-area">Jasmine Commercial Area</option>
                                <option value="johar-town" data-slug="johar-town">Johar Town</option>
                                <option value="jubilee-town" data-slug="jubilee-town">Jubilee Town</option>
                                <option value="jublee-town-lahore" data-slug="jublee-town-lahore">Jublee Town,Lahore</option>
                                <option value="kahna-nau" data-slug="kahna-nau">Kahna Nau</option>
                                <option value="kalyar-road" data-slug="kalyar-road">Kalyar Road</option>
                                <option value="karim-park" data-slug="karim-park">Karim Park</option>
                                <option value="kb-soceity" data-slug="kb-soceity">KB Soceity</option>
                                <option value="khayaban-e-iqbal" data-slug="khayaban-e-iqbal">Khayaban-e-Iqbal</option>
                                <option value="kot-khawaja-saeed" data-slug="kot-khawaja-saeed">Kot Khawaja Saeed</option>
                                <option value="kot-lakhpat" data-slug="kot-lakhpat">Kot Lakhpat</option>
                                <option value="lahore" data-slug="lahore">Lahore</option>
                                <option value="lahore-cantt" data-slug="lahore-cantt">Lahore Cantt</option>
                                <option value="lake-city" data-slug="lake-city">Lake City</option>
                                <option value="lda" data-slug="lda">LDA</option>
                                <option value="lidher" data-slug="lidher">Lidher</option>
                                <option value="madina-colony" data-slug="madina-colony">Madina Colony</option>
                                <option value="main-airport-road" data-slug="main-airport-road">Main Airport Road</option>
                                <option value="main-bedian-road" data-slug="main-bedian-road">Main Bedian Road</option>
                                <option value="main-ferozpur-road" data-slug="main-ferozpur-road">Main Ferozpur Road</option>
                                <option value="main-market" data-slug="main-market">Main Market</option>
                                <option value="main-samanabad" data-slug="main-samanabad">Main samanabad</option>
                                <option value="manawan" data-slug="manawan">Manawan</option>
                                <option value="mandi-stop" data-slug="mandi-stop">Mandi Stop</option>
                                <option value="manga-mandi" data-slug="manga-mandi">Manga Mandi</option>
                                <option value="maraghzar-colony" data-slug="maraghzar-colony">Maraghzar Colony</option>
                                <option value="mateen-avenue" data-slug="mateen-avenue">Mateen Avenue</option>
                                <option value="mia-al-hayat-center" data-slug="mia-al-hayat-center">Mia Al-hayat Center</option>
                                <option value="military-accounts-college-road" data-slug="military-accounts-college-road">Military Accounts, College Road</option>
                                <option value="minar-e-pakistan" data-slug="minar-e-pakistan">Minar-e-Pakistan</option>
                                <option value="misri-shah" data-slug="misri-shah">Misri Shah</option>
                                <option value="mm-alam-road" data-slug="mm-alam-road">MM Alam Road</option>
                                <option value="model-town" data-slug="model-town">Model Town</option>
                                <option value="model-town-ext" data-slug="model-town-ext">Model Town Ext</option>
                                <option value="model-town-extension" data-slug="model-town-extension">Model town Extension</option>
                                <option value="mohnanwal" data-slug="mohnanwal">Mohnanwal</option>
                                <option value="mozang" data-slug="mozang">Mozang</option>
                                <option value="mughalpura" data-slug="mughalpura">Mughalpura</option>
                                <option value="mughalpura-lahore" data-slug="mughalpura-lahore">Mughalpura Lahore</option>
                                <option value="muhammadpura" data-slug="muhammadpura">Muhammadpura</option>
                                <option value="multan-rd" data-slug="multan-rd">Multan Rd</option>
                                <option value="multan-road" data-slug="multan-road">Multan Road</option>
                                <option value="muscat" data-slug="muscat">Muscat</option>
                                <option value="muslim-town" data-slug="muslim-town">Muslim Town</option>
                                <option value="mustafa-town" data-slug="mustafa-town">Mustafa Town</option>
                                <option value="narowal" data-slug="narowal">Narowal,</option>
                                <option value="nasheman-iqbal" data-slug="nasheman-iqbal">Nasheman Iqbal</option>
                                <option value="nawab-town" data-slug="nawab-town">Nawab Town</option>
                                <option value="nazimabad" data-slug="nazimabad">Nazimabad</option>
                                <option value="near-bahria-town" data-slug="near-bahria-town">near Bahria Town</option>
                                <option value="near-govt-mian-meer-hospital-main-infantory-road-lahore" data-slug="near-govt-mian-meer-hospital-main-infantory-road-lahore">Near Govt Mian Meer Hospital Main Infantory Road Lahore</option>
                                <option value="near-mezang-chungi" data-slug="near-mezang-chungi">Near Mezang Chungi</option>
                                <option value="near-minar-e-pakistan" data-slug="near-minar-e-pakistan">Near Minar-e-Pakistan</option>
                                <option value="near-nakhuda-chowk-shadbagh-lahore" data-slug="near-nakhuda-chowk-shadbagh-lahore">Near Nakhuda Chowk, Shadbagh, Lahore</option>
                                <option value="near-shahkam-chowk" data-slug="near-shahkam-chowk">Near Shahkam Chowk</option>
                                <option value="near-wapda-town" data-slug="near-wapda-town">Near Wapda Town</option>
                                <option value="nespak-housing-scheme" data-slug="nespak-housing-scheme">Nespak Housing Scheme</option>
                                <option value="nespak-housing-scheme-phase-ii" data-slug="nespak-housing-scheme-phase-ii">Nespak Housing Scheme Phase II</option>
                                <option value="new-chauburji-park" data-slug="new-chauburji-park">New Chauburji Park</option>
                                <option value="new-garden-town" data-slug="new-garden-town">New Garden Town</option>
                                <option value="new-muslim-town" data-slug="new-muslim-town">New Muslim Town</option>
                                <option value="new-shadbagh" data-slug="new-shadbagh">New Shadbagh</option>
                                <option value="nfc-1" data-slug="nfc-1">NFC-1</option>
                                <option value="niazi-colony" data-slug="niazi-colony">Niazi Colony</option>
                                <option value="nishat-colony" data-slug="nishat-colony">Nishat Colony</option>
                                <option value="nishtar-road-multan" data-slug="nishtar-road-multan">Nishtar Road, Multan</option>
                                <option value="oman" data-slug="oman">Oman</option>
                                <option value="p-block-sabzazar-scheme" data-slug="p-block-sabzazar-scheme">p Block,Sabzazar Scheme</option>
                                <option value="pak-arab-housing-scheme" data-slug="pak-arab-housing-scheme">Pak-Arab Housing Scheme</option>
                                <option value="paragom-city" data-slug="paragom-city">Paragom City</option>
                                <option value="paragon-city" data-slug="paragon-city">Paragon City</option>
                                <option value="pcsir" data-slug="pcsir">PCSIR</option>
                                <option value="pcsir-phase-2" data-slug="pcsir-phase-2">PCSIR Phase 2</option>
                                <option value="pcsir-society-clinic" data-slug="pcsir-society-clinic">PCSIR Society Clinic</option>
                                <option value="pcsir-staff-colony-lahore-punjab" data-slug="pcsir-staff-colony-lahore-punjab">PCSIR Staff Colony, Lahore, Punjab</option>
                                <option value="phase-1" data-slug="phase-1">Phase 1</option>
                                <option value="phase-1-canal-road-lahore" data-slug="phase-1-canal-road-lahore">Phase 1 Canal Road, Lahore</option>
                                <option value="phase-5" data-slug="phase-5">Phase 5</option>
                                <option value="pia-society" data-slug="pia-society">PIA Society</option>
                                <option value="pindi-rajputan" data-slug="pindi-rajputan">Pindi Rajputan</option>
                                <option value="prem-nagar" data-slug="prem-nagar">Prem Nagar</option>
                                <option value="public-health-society" data-slug="public-health-society">Public Health Society</option>
                                <option value="punjab-cooperative-housing-society" data-slug="punjab-cooperative-housing-society">Punjab Cooperative Housing Society</option>
                                <option value="punjab-housing-society" data-slug="punjab-housing-society">Punjab Housing Society</option>
                                <option value="qasurpura" data-slug="qasurpura">Qasurpura</option>
                                <option value="qila-gujjar-singh" data-slug="qila-gujjar-singh">Qila Gujjar Singh</option>
                                <option value="qila-lachman-singh" data-slug="qila-lachman-singh">Qila Lachman Singh</option>
                                <option value="quaid-e-azam-industrial-estate" data-slug="quaid-e-azam-industrial-estate">Quaid e Azam Industrial Estate</option>
                                <option value="queens-road" data-slug="queens-road">queens road</option>
                                <option value="quetta" data-slug="quetta">Quetta</option>
                                <option value="raiwand-road" data-slug="raiwand-road">Raiwand Road</option>
                                <option value="raiwind" data-slug="raiwind">Raiwind</option>
                                <option value="raiwind-road" data-slug="raiwind-road">Raiwind Road</option>
                                <option value="ramgarh" data-slug="ramgarh">Ramgarh</option>
                                <option value="ravi-road" data-slug="ravi-road">Ravi Road</option>
                                <option value="rehman-pura" data-slug="rehman-pura">Rehman Pura</option>
                                <option value="rehmanpura-colony" data-slug="rehmanpura-colony">Rehmanpura Colony</option>
                                <option value="rewaz-garden" data-slug="rewaz-garden">Rewaz Garden</option>
                                <option value="ring-road" data-slug="ring-road">Ring Road</option>
                                <option value="riwaz-garden" data-slug="riwaz-garden">Riwaz Garden</option>
                                <option value="sabzazar" data-slug="sabzazar">Sabzazar</option>
                                <option value="sabzazar-b-block-lahore" data-slug="sabzazar-b-block-lahore">Sabzazar B Block,Lahore</option>
                                <option value="sadar-cantt" data-slug="sadar-cantt">Sadar Cantt</option>
                                <option value="saddar" data-slug="saddar">Saddar</option>
                                <option value="samanabad" data-slug="samanabad">Samanabad</option>
                                <option value="sanda" data-slug="sanda">Sanda</option>
                                <option value="sanda-khurd" data-slug="sanda-khurd">Sanda Khurd</option>
                                <option value="sant-nagar" data-slug="sant-nagar">Sant Nagar</option>
                                <option value="sarai" data-slug="sarai">Sarai</option>
                                <option value="satellite-town" data-slug="satellite-town">Satellite Town</option>
                                <option value="sattelite-town" data-slug="sattelite-town">Sattelite Town</option>
                                <option value="sector-5-dha" data-slug="sector-5-dha">Sector 5 DHA</option>
                                <option value="sector-b-bahria-town" data-slug="sector-b-bahria-town">Sector B Bahria Town</option>
                                <option value="sector-c-bahria-town" data-slug="sector-c-bahria-town">Sector C, Bahria Town</option>
                                <option value="shad-bagh" data-slug="shad-bagh">Shad Bagh</option>
                                <option value="shadbagh" data-slug="shadbagh">Shadbagh</option>
                                <option value="shadman" data-slug="shadman">Shadman</option>
                                <option value="shadman-ii" data-slug="shadman-ii">Shadman II</option>
                                <option value="shadman-i" data-slug="shadman-i">Shadman- I</option>
                                <option value="shah-alam-road" data-slug="shah-alam-road">Shah Alam Road</option>
                                <option value="shah-jamal" data-slug="shah-jamal">Shah Jamal</option>
                                <option value="shahdara" data-slug="shahdara">Shahdara</option>
                                <option value="shahdara-town" data-slug="shahdara-town">Shahdara Town</option>
                                <option value="shahdrah" data-slug="shahdrah">Shahdrah</option>
                                <option value="shalimar" data-slug="shalimar">Shalimar</option>
                                <option value="sheikhupura" data-slug="sheikhupura">Sheikhupura</option>
                                <option value="singhpura" data-slug="singhpura">Singhpura</option>
                                <option value="sodiwal" data-slug="sodiwal">Sodiwal</option>
                                <option value="street-30-g-15-1-g-15-1-g-15-islamabad-islamabad-capital-territory" data-slug="street-30-g-15-1-g-15-1-g-15-islamabad-islamabad-capital-territory">Street 30, G-15/1 G 15/1 G-15, Islamabad, Islamabad Capital Territory</option>
                                <option value="sultan-town" data-slug="sultan-town">Sultan Town</option>
                                <option value="super-town" data-slug="super-town">Super Town</option>
                                <option value="suter-mandi-chowk" data-slug="suter-mandi-chowk">Suter Mandi Chowk</option>
                                <option value="sutlej-avenue" data-slug="sutlej-avenue">Sutlej Avenue</option>
                                <option value="taj-bagh-scheme" data-slug="taj-bagh-scheme">Taj Bagh Scheme</option>
                                <option value="tajpura-scheme" data-slug="tajpura-scheme">Tajpura Scheme</option>
                                <option value="tariq-garden" data-slug="tariq-garden">Tariq Garden</option>
                                <option value="tech-society" data-slug="tech-society">Tech Society</option>
                                <option value="thokar-niaz-baig" data-slug="thokar-niaz-baig">Thokar Niaz Baig</option>
                                <option value="township" data-slug="township">Township</option>
                                <option value="township-sector-a1-lahore" data-slug="township-sector-a1-lahore">Township sector A1, Lahore</option>
                                <option value="township-pia-road" data-slug="township-pia-road">Township, PIA road</option>
                                <option value="township-lahore" data-slug="township-lahore">Township,Lahore</option>
                                <option value="tulspura" data-slug="tulspura">Tulspura</option>
                                <option value="upper-mall-scheme" data-slug="upper-mall-scheme">Upper Mall Scheme</option>
                                <option value="usa" data-slug="usa">USA</option>
                                <option value="usman-colony" data-slug="usman-colony">Usman Colony</option>
                                <option value="usmani-rd-block-a-faisal-town" data-slug="usmani-rd-block-a-faisal-town">Usmani Rd, Block A Faisal Town</option>
                                <option value="valencia-town" data-slug="valencia-town">Valencia Town</option>
                                <option value="wahdat-road" data-slug="wahdat-road">Wahdat Road</option>
                                <option value="walled-city" data-slug="walled-city">Walled city</option>
                                <option value="walton-road" data-slug="walton-road">Walton Road</option>
                                <option value="wapda-town" data-slug="wapda-town">Wapda Town</option>
                                <option value="wapda-town-phase-1" data-slug="wapda-town-phase-1">Wapda town phase 1</option>
                                <option value="yateem-khana" data-slug="yateem-khana">Yateem Khana</option>
                                <option value="zarrar-shaeed-road-cantt" data-slug="zarrar-shaeed-road-cantt">Zarrar Shaeed Road, Cantt</option>
                            </select>
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
    <div class="col-4-sm col-2">
                <div class="doctor-image lazy-image" data-src="https://h7u5d3a4.stackpathcdn.com/assets/hospitals/61/doctors-hospital-15_170X170.jpg" data-alt="Doctors Hospital's Image" data-url="#/hospitals/lahore/doctors-hospital/johar-town"></div>
            </div>
    <div class="col-8-sm col-10">
        <div class="pl-2">
            <h2><a href="#/hospitals/lahore/doctors-hospital/johar-town">Doctors Hospital</a></h2>
            <p><i class="fa fa-location-arrow"> </i>152-G/1, Canal Bank, Johar Town, Lahore</p>
                        <p><i class="fa fa-star"> </i> 111 Doctors Available</p>
                        <div class="">
                <button class="mt-2 button-main" onclick="location.href='#/hospitals/lahore/doctors-hospital/johar-town'">View Details</button>
            </div>
        </div>
    </div>
</div>          <div class="row bg-white padding mt-2">
    <div class="col-4-sm col-2">
                <div class="doctor-image lazy-image" data-src="https://h7u5d3a4.stackpathcdn.com/assets/hospitals/10/iqra-hospital-93_170X170.jpg" data-alt="Iqra Medical Complex Hospital's Image" data-url="#/hospitals/lahore/iqra-medical-complex-hospital/johar-town"></div>
            </div>
    <div class="col-8-sm col-10">
        <div class="pl-2">
            <h2><a href="#/hospitals/lahore/iqra-medical-complex-hospital/johar-town">Iqra Medical Complex Hospital</a></h2>
            <p><i class="fa fa-location-arrow"> </i>Iqra Hospital,Near Akbar Chowk, Moulana Shoukat Ali Road, Johar Town, Lahore</p>
                        <p><i class="fa fa-star"> </i> 55 Doctors Available</p>
                        <div class="">
                <button class="mt-2 button-main" onclick="location.href='#/hospitals/lahore/iqra-medical-complex-hospital/johar-town'">View Details</button>
            </div>
        </div>
    </div>
</div>          <div class="row bg-white padding mt-2">
    <div class="col-4-sm col-2">
                <div class="doctor-image lazy-image" data-src="https://h7u5d3a4.stackpathcdn.com/assets/hospitals/898/horizon-hospital-48_170X170.jpg" data-alt="Horizon Hospital's Image" data-url="#/hospitals/lahore/horizon-hospital/johar-town"></div>
            </div>
    <div class="col-8-sm col-10">
        <div class="pl-2">
            <h2><a href="#/hospitals/lahore/horizon-hospital/johar-town">Horizon Hospital</a></h2>
            <p><i class="fa fa-location-arrow"> </i>Block-D-II, Johar Town, Lahore</p>
                        <p><i class="fa fa-star"> </i> 27 Doctors Available</p>
                        <div class="">
                <button class="mt-2 button-main" onclick="location.href='#/hospitals/lahore/horizon-hospital/johar-town'">View Details</button>
            </div>
        </div>
    </div>
</div>          <div class="row bg-white padding mt-2">
    <div class="col-4-sm col-2">
                <div class="doctor-image lazy-image" data-src="#/assets/images/hospital-default.jpg" data-alt="Ihsan Mumtaz Hospital's Image" data-url="#/hospitals/lahore/ihsan-mumtaz-hospital/johar-town"></div>
            </div>
    <div class="col-8-sm col-10">
        <div class="pl-2">
            <h2><a href="#/hospitals/lahore/ihsan-mumtaz-hospital/johar-town">Ihsan Mumtaz Hospital</a></h2>
            <p><i class="fa fa-location-arrow"> </i>71 Maulana Shaukat Ali Road, Block E Phase 1, Johar Town, Lahore</p>
                        <p><i class="fa fa-star"> </i> 46 Doctors Available</p>
                        <div class="">
                <button class="mt-2 button-main" onclick="location.href='#/hospitals/lahore/ihsan-mumtaz-hospital/johar-town'">View Details</button>
            </div>
        </div>
    </div>
</div>          <div class="row bg-white padding mt-2">
    <div class="col-4-sm col-2">
                <div class="doctor-image lazy-image" data-src="https://h7u5d3a4.stackpathcdn.com/assets/hospitals/1322/1322-6343d291f9652ba9351a3e8a795818102e3ba4e7_170X170.jpg" data-alt="Iqraa Medical Complex Ext Hospital's Image" data-url="#/hospitals/lahore/iqraa-medical-complex-ext-hospital/johar-town"></div>
            </div>
    <div class="col-8-sm col-10">
        <div class="pl-2">
            <h2><a href="#/hospitals/lahore/iqraa-medical-complex-ext-hospital/johar-town">Iqraa Medical Complex Ext Hospital</a></h2>
            <p><i class="fa fa-location-arrow"> </i>Maulana Shaukat Ali Road, Near Shouk Chowk Park,, Johar Town, Lahore</p>
                        <p><i class="fa fa-star"> </i> 27 Doctors Available</p>
                        <div class="">
                <button class="mt-2 button-main" onclick="location.href='#/hospitals/lahore/iqraa-medical-complex-ext-hospital/johar-town'">View Details</button>
            </div>
        </div>
    </div>
</div>          <div class="row bg-white padding mt-2">
    <div class="col-4-sm col-2">
                <div class="doctor-image lazy-image" data-src="#/assets/images/hospital-default.jpg" data-alt="Chughtai Medical Center Johar Town's Image" data-url="#/hospitals/lahore/chughtai-medical-center-johar-town/johar-town"></div>
            </div>
    <div class="col-8-sm col-10">
        <div class="pl-2">
            <h2><a href="#/hospitals/lahore/chughtai-medical-center-johar-town/johar-town">Chughtai Medical Center Johar Town</a></h2>
            <p><i class="fa fa-location-arrow"> </i>M 7, Khokar Chowk, Johar Town, Lahore</p>
                        <p><i class="fa fa-star"> </i> 11 Doctors Available</p>
                        <div class="">
                <button class="mt-2 button-main" onclick="location.href='#/hospitals/lahore/chughtai-medical-center-johar-town/johar-town'">View Details</button>
            </div>
        </div>
    </div>
</div>  
        <div id="doctors" class="row bg-white padding mt-2">
        <div class="col-12">
            <h2>Top Doctors in Johar Town, Lahore</h2>
                            <div class="row mt-2 bg-white padding doctor-card">
    <div class="col-12-sm col-2">
        <div class="col-4-sm col-12">
                        <div class="doctor-image lazy-image ga-event-listing-doctor-photo" style="border-radius: 4px; " data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/2881/dr-fawad-nasrullah-urologist-lahore_170X170.jpg" data-alt="dr-fawad-nasrullah-urologist-lahore" data-url="#/doctors/lahore/urologist/dr-fawad-nasrullah"></div>
                    </div>

        <div class="col-8-sm col-12">
            <h2 class="d-block d-sm-none"><a class=" ga-event-listing-doctor-name " href="#/doctors/lahore/urologist/dr-fawad-nasrullah">Dr. Fawad Nasrullah</a> <i class="fa fa-check-circle green-text"></i></h2>
                        <div class="" style="display: inline-flex; font-size: 12px;">
                <span class="rating to-be-loaded" data-rating="4.6"></span>
                <span>(4.6 / 5)</span>
            </div>
            
                        <p>Fee: Rs. 2700</p>
                    </div>
    </div>

    <div class="col-10">
        <div class="row">
            <div class="col-8 doctor-content">
                <h2 class="d-none d-sm-block"><a class=" ga-event-listing-doctor-name " href="#/doctors/lahore/urologist/dr-fawad-nasrullah">Dr. Fawad Nasrullah</a> <i class="fa fa-check-circle green-text"></i></h2>
                <p><b>Sexologist, Urologist, Endourologist, Andrologist</b></p>
                <p class="light-grey">MBBS, FCPS (Urology), FACS (USA)</p>
                
                <ul class="grid-list">
                    <li><i class="fa fa-map-marker light-grey"></i> Practices in Johar Town</li>
                                        <li>Available today till 09:00 PM</li>
                                                            <li>21 Years Experience</li>
                                    </ul>
                                <p class="mt-2 green-text"><i class="fa fa-bell"></i> Doctor available for online consultation due to Coronavirus.</p>
                            </div>
            <div class="col-4 col-12-sm listing-review">
                <a href="#/doctors/lahore/urologist/dr-fawad-nasrullah" class="button-big  ga-event-listing-view-profile-button "> View Complete Profile</a>
                                <a href="#/online-consultation/request?id=61&d_id=2881" class="button-big-blue mt-2 ga-event-listing-consult-online" data-label="dr-fawad-nasrullah-urologist" data-value="810"><i class="fa fa-video" style="color: #c02942"></i> Book Online Consultation </a>
                                                <a href="#/doctors/lahore/urologist/dr-fawad-nasrullah/callcenter/18900" class="button-big-blue mt-2 ga-goal-7 fb-pixel-schedule ga-event-listing-book-appointment-button" data-label="dr-fawad-nasrullah-urologist" data-value="810"> Book Appointment </a>
                            </div>
        </div>
    </div>
</div>                          <div class="row mt-2 bg-white padding doctor-card">
    <div class="col-12-sm col-2">
        <div class="col-4-sm col-12">
                        <div class="doctor-image lazy-image ga-event-listing-doctor-photo" style="border-radius: 4px; " data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/8090/dr-qurat-ul-ain-sajida-dermatologist-lahore_170X170.jpg" data-alt="dr-qurat-ul-ain-sajida-dermatologist-lahore" data-url="#/doctors/lahore/dermatologist/dr-qurat-ul-ain-sajida"></div>
                    </div>

        <div class="col-8-sm col-12">
            <h2 class="d-block d-sm-none"><a class=" ga-event-listing-doctor-name " href="#/doctors/lahore/dermatologist/dr-qurat-ul-ain-sajida">Dr. Qurat Ul Ain Sajida</a> <i class="fa fa-check-circle green-text"></i></h2>
                        <div class="" style="display: inline-flex; font-size: 12px;">
                <span class="rating to-be-loaded" data-rating="4.5"></span>
                <span>(4.5 / 5)</span>
            </div>
            
                        <p>Fee: Rs. 2500</p>
                    </div>
    </div>

    <div class="col-10">
        <div class="row">
            <div class="col-8 doctor-content">
                <h2 class="d-none d-sm-block"><a class=" ga-event-listing-doctor-name " href="#/doctors/lahore/dermatologist/dr-qurat-ul-ain-sajida">Dr. Qurat Ul Ain Sajida</a> <i class="fa fa-check-circle green-text"></i></h2>
                <p><b>Dermatologist</b></p>
                <p class="light-grey">MBBS, MCPS (Dermatology)</p>
                
                <ul class="grid-list">
                    <li><i class="fa fa-map-marker light-grey"></i> Practices in Johar Town</li>
                                        <li>Available from Jul 15, 2020</li>
                                                            <li>16 Years Experience</li>
                                    </ul>
                            </div>
            <div class="col-4 col-12-sm listing-review">
                <a href="#/doctors/lahore/dermatologist/dr-qurat-ul-ain-sajida" class="button-big  ga-event-listing-view-profile-button "> View Complete Profile</a>
                                                <a href="#/doctors/lahore/dermatologist/dr-qurat-ul-ain-sajida/callcenter/16237" class="button-big-blue mt-2 ga-goal-7 fb-pixel-schedule ga-event-listing-book-appointment-button" data-label="dr-qurat-ul-ain-sajida-dermatologist" data-value="750"> Book Appointment </a>
                            </div>
        </div>
    </div>
</div>                          <div class="row mt-2 bg-white padding doctor-card">
    <div class="col-12-sm col-2">
        <div class="col-4-sm col-12">
                        <div class="doctor-image lazy-image ga-event-listing-doctor-photo" style="border-radius: 4px; " data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/8110/dr-saima-zaki-gynecologist-lahore-44_170X170.jpeg" data-alt="dr-saima-zaki-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-saima-zaki"></div>
                    </div>

        <div class="col-8-sm col-12">
            <h2 class="d-block d-sm-none"><a class=" ga-event-listing-doctor-name " href="#/doctors/lahore/gynecologist/dr-saima-zaki">Dr. Saima Zaki</a> <i class="fa fa-check-circle green-text"></i></h2>
                        <div class="" style="display: inline-flex; font-size: 12px;">
                <span class="rating to-be-loaded" data-rating="4.7"></span>
                <span>(4.7 / 5)</span>
            </div>
            
                        <p>Fee: Rs. 1500</p>
                    </div>
    </div>

    <div class="col-10">
        <div class="row">
            <div class="col-8 doctor-content">
                <h2 class="d-none d-sm-block"><a class=" ga-event-listing-doctor-name " href="#/doctors/lahore/gynecologist/dr-saima-zaki">Dr. Saima Zaki</a> <i class="fa fa-check-circle green-text"></i></h2>
                <p><b>Gynecologist</b></p>
                <p class="light-grey">MBBS, MCPS,FCPS (Obstetrics & Gynaecolog...</p>
                
                <ul class="grid-list">
                    <li><i class="fa fa-map-marker light-grey"></i> Practices in Johar Town</li>
                                        <li>Available today till 09:30 PM</li>
                                                            <li>19 Years Experience</li>
                                    </ul>
                                <p class="mt-2 green-text"><i class="fa fa-bell"></i> Doctor available for online consultation due to Coronavirus.</p>
                            </div>
            <div class="col-4 col-12-sm listing-review">
                <a href="#/doctors/lahore/gynecologist/dr-saima-zaki" class="button-big  ga-event-listing-view-profile-button "> View Complete Profile</a>
                                <a href="#/online-consultation/request?id=79&d_id=8110" class="button-big-blue mt-2 ga-event-listing-consult-online" data-label="dr-saima-zaki-gynecologist" data-value="450"><i class="fa fa-video" style="color: #c02942"></i> Book Online Consultation </a>
                                                <a href="#/doctors/lahore/gynecologist/dr-saima-zaki/callcenter/16267" class="button-big-blue mt-2 ga-goal-7 fb-pixel-schedule ga-event-listing-book-appointment-button" data-label="dr-saima-zaki-gynecologist" data-value="450"> Book Appointment </a>
                            </div>
        </div>
    </div>
</div>                          <div class="row mt-2 bg-white padding doctor-card">
    <div class="col-12-sm col-2">
        <div class="col-4-sm col-12">
                        <div class="doctor-image lazy-image ga-event-listing-doctor-photo" style="border-radius: 4px; " data-src="https://q4q4u7z4.stackpathcdn.com/assets/doctors/1732/dr-misbah-malik-gynecologist-lahore-26_170X170.jpg" data-alt="dr-misbah-malik-gynecologist-lahore" data-url="#/doctors/lahore/gynecologist/dr-misbah-malik"></div>
                    </div>

        <div class="col-8-sm col-12">
            <h2 class="d-block d-sm-none"><a class=" ga-event-listing-doctor-name " href="#/doctors/lahore/gynecologist/dr-misbah-malik">Dr. Misbah Malik</a> <i class="fa fa-check-circle green-text"></i></h2>
                        <div class="" style="display: inline-flex; font-size: 12px;">
                <span class="rating to-be-loaded" data-rating="4.8"></span>
                <span>(4.8 / 5)</span>
            </div>
            
                        <p>Fee: Rs. 1500 - 2500</p>
                    </div>
    </div>

    <div class="col-10">
        <div class="row">
            <div class="col-8 doctor-content">
                <h2 class="d-none d-sm-block"><a class=" ga-event-listing-doctor-name " href="#/doctors/lahore/gynecologist/dr-misbah-malik">Dr. Misbah Malik</a> <i class="fa fa-check-circle green-text"></i></h2>
                <p><b>Gynecologist</b></p>
                <p class="light-grey">MBBS, MCPS, FCPS</p>
                
                <ul class="grid-list">
                    <li><i class="fa fa-map-marker light-grey"></i> Practices in Johar Town</li>
                                        <li>Available today till 10:00 PM</li>
                                                            <li>20 Years Experience</li>
                                    </ul>
                                <p class="mt-2 green-text"><i class="fa fa-bell"></i> Doctor available for online consultation due to Coronavirus.</p>
                            </div>
            <div class="col-4 col-12-sm listing-review">
                <a href="#/doctors/lahore/gynecologist/dr-misbah-malik" class="button-big  ga-event-listing-view-profile-button "> View Complete Profile</a>
                                <a href="#/online-consultation/request?id=79&d_id=1732" class="button-big-blue mt-2 ga-event-listing-consult-online" data-label="dr-misbah-malik-gynecologist" data-value="600"><i class="fa fa-video" style="color: #c02942"></i> Book Online Consultation </a>
                                                <a href="#/doctors/lahore/gynecologist/dr-misbah-malik/callcenter/9612" class="button-big-blue mt-2 ga-goal-7 fb-pixel-schedule ga-event-listing-book-appointment-button" data-label="dr-misbah-malik-gynecologist" data-value="600"> Book Appointment </a>
                            </div>
        </div>
    </div>
</div>                  </div>
    </div>
    
        <button id="load_more_hospitals" onclick="javascript:loadMoreHospitals()" class="center button-border" style="margin-top: 2%"> + View More Hospitals</button>
    <div id="dom_loader" class="center">
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