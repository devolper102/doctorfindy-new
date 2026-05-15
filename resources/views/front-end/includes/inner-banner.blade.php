@php
    $locations = App\Location::all();
    $roles = Spatie\Permission\Models\Role::all()->toArray();
    $doctors = \App\User::role('doctor')->get();
    $hospitals = \App\User::role('hospital')->get();
    $laboratory = \App\User::role('laboratory')->get();
    $specialities = \App\Speciality::all();
    $services = \App\Service::all();
    $diseases = \App\Disease::all();
@endphp


{!! Form::open(['url' => url('search-results'), 'method' => 'get', 'id' =>'search_form', 'class' => '']) !!}
<div class="container">
    <div class="mobile_view_search">
        <p> <i class="fa fa-search" aria-hidden="true"></i> Search for Doctor and Hospitals</p>
    </div>
    <div class="search_main">
        <button type="button" id="first_modal_close" class="close" aria-label="Close">
                <span aria-hidden="true">Cancel</span>
            </button>
            <p class="mobile_search_heading">Search for doctors</p>
        <div class="dropdown-toggle remove_caret" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <button type="button" id="close_doctor_search" class="close" aria-label="Close">
                <span aria-hidden="true">Cancel</span>
            </button>
            <input type="hidden" id="submitSearchValue" value="">
            <input type="hidden" name="type" value="doctor">
            

            <div id="">
                <div class="doctor_search" id="">
                    <main-search-page
                            :location="{{$locations}}"
                            :doctors="{{$doctors}}"
                            :hospitals="{{$hospitals}}"
                            :laboratory="{{$laboratory}}"
                            :specialities="{{$specialities}}"
                            :services="{{$services}}"
                            :diseases="{{$diseases}}"
                    >
                    </main-search-page>
                    {{--<div id="searchbox">
                        <a href="#" class="location_btn">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </a>
                    </div>--}}

                    {{--<div class="dropdown-menu search_location" aria-labelledby="dropdownMenuButton" id="countryList">

                        <div class="title-holder d-flex justify-content-between align-items-center w-100 bg-mediumgray px-3 py-2 border-0">
                            <span class="title pr-2 d-block">
                                <span>specialities and services</span>
                            </span>
                            <span class="text-right dropdown_allview_links">
                                <a onclick="speciality_link(this)" data-id="{{{ url('speciality') }}}" id="myButton">View All</a>
                            </span>
                        </div>
                        <div id="hits-instant-search-spec"></div>

                        <div class="title-holder d-flex justify-content-between align-items-center w-100 bg-mediumgray px-3 py-2 border-0">
                            <span class="title pr-2 d-block">
                                <span>Doctors</span>
                            </span>
                            <span class="text-right dropdown_allview_links">
                                <a onclick="speciality_link(this)" data-id="{{{ url('doctors-in-pakistan') }}}">View All</a>
                            </span>
                        </div>
                        <div id="hits-instant-search"></div>

                        <div class="title-holder d-flex justify-content-between align-items-center w-100 bg-mediumgray px-3 py-2 border-0">
                            <span class="title pr-2 d-block">
                                <span>Disease</span>
                            </span>
                            <span class="text-right">
                                <a href="{{{ url('all-diseases') }}}">View All</a>
                            </span>
                        </div>
                        <div id="hits-instant-search-disease"></div>

                        <div class="title-holder d-flex justify-content-between align-items-center w-100 bg-mediumgray px-3 py-2 border-0">
                            <span class="title pr-2 d-block">
                                <span>Hospitals</span>
                            </span>
                            <span class="text-right dropdown_allview_links">
                                <a onclick="speciality_link(this)" data-id="{{{ url('hospitals-in-pakistan') }}}">View All</a>
                            </span>
                        </div>
                        <div id="hits-instant-search-hospital"></div>

                    </div>--}}
                </div>
            </div>
        </div>
            <!-- Location search -->
        <div id="location_main">
            <div id="location_inner">
                <div class="location_main" id="location_dropdown">
                    <button type="button" id="close_location_search" class="close" aria-label="Close">
                        <span aria-hidden="true">Cancel</span>
                    </button>
                    <div class="dropdown-toggle remove_caret" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <input type="hidden" name="location" id="submitCityValue" value="">
                        
                        <div id="locations"></div>

                        <div class="dropdown-menu search_location" aria-labelledby="dropdownMenuButton1" id="cityList">
                            <div id="hits-instant-search-location"></div>
                        </div>
                    </div>
                    <span href="#" id='#find_btn' class=" detect_btn">
                        <svg style="margin-bottom: 2px;" width="15px" height="15px" viewBox="0 0 561 561" fill="#3d4461">
                            <path d="M280.5,178.5c-56.1,0-102,45.9-102,102c0,56.1,45.9,102,102,102c56.1,0,102-45.9,102-102 C382.5,224.4,336.6,178.5,280.5,178.5z M507.45,255C494.7,147.9,410.55,63.75,306,53.55V0h-51v53.55 C147.9,63.75,63.75,147.9,53.55,255H0v51h53.55C66.3,413.1,150.45,497.25,255,507.45V561h51v-53.55 C413.1,494.7,497.25,410.55,507.45,306H561v-51H507.45z M280.5,459C181.05,459,102,379.95,102,280.5S181.05,102,280.5,102 S459,181.05,459,280.5S379.95,459,280.5,459z"></path>
                        </svg> Detect
                    </span>
                    <a href="#" class="location_btn map_icon">
                        <i id="find_btn" class="fas fa-map-marker-alt"></i>
                    </a>
                     <!-- <a href="#" class="location_right_icon calendar_icon">Search</a> -->
                </div>
            </div>
        </div>

    </div>
     <div class="dc_search_btnarea">
  <input type="submit" name="" class="dc-btn" id="search-btn" value="{{ trans('lang.search') }}" style="display: none;">
</div>  
</div>

</div>
{!! form::close(); !!}
