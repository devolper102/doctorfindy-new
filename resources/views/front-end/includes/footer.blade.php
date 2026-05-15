<style>
    .dc-logofooter {
    float: left;
    width: auto;
    margin: 0 0 6px;
}
   .dc-footercontent-navigation h3{color: #fff;
    font-size: 18px;
    font-weight: 400;
    margin: 0;}

.dc-footercontent-navigation . .{color: #fff;
    font-size: 15px;
    padding: 0 0 5px 0;}
    .dc-ftitle h3 {
    color: #fff;
    font-size: 17px;
    font-weight: 400;
    margin: 0 0 10px;
    line-height: 26px;
}

.dc-footercontent-navigation . .:hover{font-weight: bold;}

</style>

@section('footer')

    <footer id="dc-footer" class="dc-footer dc-haslayout">
        <!-- @if (Helper::getFooterSettings('show_contact_info_sec') === 'true')
            @if(!empty(Helper::getFooterSettings('contact_info_img_one')) || !empty(Helper::getFooterSettings('contact_info_img_two')))
                <div class="dc-footertopbar">
                    <div class="container">
                        <div class="row justify-content-center align-self-center">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 push-lg-2">
                                <div class="dc-footer-call-email">
                                    <div class="dc-callinfoholder">
                                        @if (!empty(Helper::getFooterSettings('contact_info_img_one')))
                                            <figure class="dc-callinfoimg">
                                                <img src="{{ asset(Helper::getImage('uploads/settings/general/footer', Helper::getFooterSettings('contact_info_img_one'), 'small-')) }}" alt="{{ trans('lang.img_desc') }}">
                                            </figure>
                                        @endif
                                        <div class="dc-callinfocontent">
                                            <h3>
                                                <span>{{ html_entity_decode(clean(Helper::getFooterSettings('contact_info_title_one'))) }}</span> 
                                                <a href="tel:{{ clean(Helper::getFooterSettings('contact_info_number')) }}">{{ clean(Helper::getFooterSettings('contact_info_number')) }}</a>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="dc-callinfoholder dc-mailinfoholder">
                                        @if (!empty(Helper::getFooterSettings('contact_info_img_two')))
                                            <figure class="dc-callinfoimg">
                                                <img src="{{ asset(Helper::getImage('uploads/settings/general/footer', Helper::getFooterSettings('contact_info_img_two'), 'small-')) }}" alt="{{ trans('lang.img_desc') }}">
                                            </figure>
                                        @endif
                                        <div class="dc-callinfocontent">
                                            <h3>
                                                <span>{{ html_entity_decode(clean(Helper::getFooterSettings('contact_info_title_two'))) }}</span> 
                                                <a href="mailto:{{ clean(Helper::getFooterSettings('contact_info_email')) }}">{{ clean(Helper::getFooterSettings('contact_info_email')) }}</a>
                                            </h3>
                                        </div>
                                    </div>
                                    <span class="dc-or-text">- {{ trans('lang.or') }} -</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif -->
        <div class="dc-fthreecolumns">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xs-6 float-left">
                        <div class="dc-fcol dc-widgetcontactus">
                                  @if (Helper::getFooterSettings('footer_logo') == 'true')
                            <strong class="dc-logofooter"><a href="{{ url('/') }}"><img src="{{ asset(Helper::getFooterSettings('footer_logo')) }}" alt="{{ trans('lang.site_logo') }}"><!-- <h5 style="color: #fff;line-height: 19px;">DoctorFindy</h5> --></a>
                            </strong>
                             @endif  
                            <div class="dc-footercontent">
                                <!-- <div class="dc-description">
                                    {!! clean(\Illuminate\Support\Str::limit(Helper::getFooterSettings('footer_about_us_note'), 100)) !!}
                                </div>
                                @if (!empty(Helper::getFooterSettings('footer_address'))
                                    || !empty(Helper::getFooterSettings('footer_email'))
                                    || !empty(Helper::getFooterSettings('footer_phone'))) -->
                                   <!--  <ul class="dc-footercontactus">
                                        <li><address><i class="lnr lnr-location"></i> {{ html_entity_decode(clean(Helper::getFooterSettings('footer_address'))) }}</address></li>
                                        <li><a href="mailto:{{ clean(Helper::getFooterSettings('footer_email')) }}"><i class="lnr lnr-envelope"></i> {{ clean(Helper::getFooterSettings('footer_email')) }}</a></li>
                                        <li>
                                            <span>
                                                <i class="lnr lnr-phone-handset"></i>
                                                <a href="tel:{{ clean(Helper::getFooterSettings('footer_phone')) }}">{{ clean(Helper::getFooterSettings('footer_phone')) }}</a>
                                            </span>
                                        </li>
                                    </ul> -->
                                    <div class="dc-ftitle">
                                <ul class="navbar-nav dc-footercontent-navigation" style="display:block;width: 100%;">
                                                <li class="">
                                                <a class="" href="{{ url('/about-us') }}">About us</a>
                                                </li>
                                                 <li class="">
                                                <a class="" href="#">Contact us</a>
                                                </li>
                                                <li class="">
                                                <a class="" href="{{url('/doctors-in-pakistan')}}">Doctors</a>
                                                </li>
                                                  <li class="">
                                                <a class="" href="{{url('/hospitals-in-pakistan')}}">Hospitals</a>
                                                </li>
                                                 <li class="">
                                                <a class="" href="#">FAQ</a>
                                                </li>
                                                 <li class="">
                                                <a class="" href="#">Terms and Privacy Policy</a>
                                                </li>
                                                 <li class="">
                                                <a class="" href="{{url('/find-a-doctor')}}">Find-a-doctor</a>
                                                </li>
                                                 <li class="">
                                                <a class="" href="#">Cancelation policy</a>
                                                </li>
                                                 <li class="">
                                                <a class="" href="{{ url('/sitemap') }}">Site Map</a>
                                                </li>
                                                <li style="float: left;margin-right: 10px;">
                                                <a class="mobile_view_inline" href="{{ Helper::getDownloadAppSection('android_url') }}">
                                                    <img src="{{ asset(Helper::getImage('uploads/settings/home', Helper::getDownloadAppSection('android_img'), 'small-', 'default-footer-android.png')) }}" alt="{{ trans('lang.img_desc') }}">
                                                </a>
                                            </li>
                                            <li>
                                                <a class="mobile_view_inline" href="{{ Helper::getDownloadAppSection('ios_url') }}">
                                                    <img src="{{ asset(Helper::getImage('uploads/settings/home', Helper::getDownloadAppSection('ios_img'), 'small-', 'default-footer-ios.png')) }}" alt="{{ trans('lang.img_desc') }}">
                                                </a>
                                            </li>
                                            </ul>

                                        </div>
                                            
                                           
                                @endif

                                @if (Helper::getFooterSettings('show_footer_socials') === 'true')
                                    <div class="dc-fsocialicon">
                                        {{ Helper::displaySocials('footer') }}
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xs-6 float-left">
                        <div class="tg-widgettwitter dc-fcol dc-flatestad dc-twitter-live-wgdets">
                           <!--  <div class="dc-ftitle"><h3>{{ trans('lang.footer_twitter_title') }}</h3></div>  -->            
                           <!--  <div class="dc-footercontent">
                                @include('front-end.includes.twitter')
                            </div> -->
                            <div class="dc-ftitle">
                             <ul class="navbar-nav dc-footercontent-navigation">
                                                <h3>Top Cities</h3>
                                        @foreach(Helper::getAllDoctors() as $doctor)
                                                <li class="">
                                                <a class="" href="{{{url('/doctors/'.clean($doctor->slug))}}}">{{$doctor->title}}
                                                </a>
                                                </li>
                                        @endforeach
                                                
                                                 
                                                 
                                                <li class="view_btn">
                                                    <a href="{{ url('doctors-in-pakistan')}}">View All</a>
                                                </li>
                                            </ul>
                                             </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xs-6 float-left">
                        <div class="dc-fcol dc-newsletterholder">
                            <div class="dc-footercontent dc-newsletterholder">
                                
                                    <div class="dc-footerapps">
                                        <div class="dc-ftitle">
                                       
                                              <ul class="navbar-nav dc-footercontent-navigation">
                                                <h3>Top Specialties</h3>
                                                 @foreach(Helper::getAllSpecialities() as $special)
                                                <li class="">
                                                <a class="" href="{{{url('/search-results?search=&type=doctor&speciality='.clean($special->slug))}}}">{{$special->title}}
                                                </a>
                                                </li>
                                                 @endforeach
                                               
                                                <li class="view_btn">
                                                    <a href="{{ url('speciality')}}">View All</a>
                                                </li>
                                            </ul>
                                        </div>
                                      

                                    </div>
                              

                            </div>
                        </div>

                    </div>
                     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xs-6 float-left">
                                        <div class="dc-ftitle">
                                            <ul class="navbar-nav dc-footercontent-navigation">
                                                <h3>Laboratories</h3>
                                                @foreach(Helper::getAllLaboratory() as $laboratory)

                                                <li class="">
                    <a class="" href="/profile/{{Helper::getLabProfile($laboratory->id)}}">{{ Helper::getUserData($laboratory->id) }}
                                                </a>
                                                </li>
                                                 @endforeach
                                                <li class="view_btn">
                                                    <a href="https://dev.msnsoft.org/search-results?type=laboratory">View All</a>
                                                </li>
                                            </ul>
                                        </div>
                     </div>
                </div>
            </div>
        </div>
        <div class="dc-footerbottom">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <p class="dc-copyright">{{ html_entity_decode(clean(Helper::getFooterSettings('footer_copyright'))) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection

@push('scripts')

@endpush


