<!DOCTYPE  html>
      <html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <!--<![endif]-->
        <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{Helper::getTextDirection()}}">
          <!--<![endif]-->
          <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            @if (trim($__env->yieldContent('title')))
            <title>@yield('title')</title>
            @else
            <title>{{ config('app.name') }}</title>
            @endif
            <meta name="facebook-domain-verification" content="72usfjfxxlmapmv83sxgb6s6abwrck" />
            <meta name="title" content="An online doctor booking platform">
            <meta name="description" content="Book Appointment From Home Or Get Online Audio / Video Consultation With Pakistan">
            <link rel="icon" href="{{ asset(Helper::getGeneralSettings('site_favicon')) }}" type="image/x-icon">
            <meta name="google-site-verification" content="ivRgAetCZHPXs0MRVun0R-CzmEbU4_wanDW_7ZtEay8" />
            <meta name="description" content="An online doctor booking platform">
            <meta name="keywords" content="@yield('keywords')">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
            <link rel="apple-touch-icon" href="apple-touch-icon.png">
            @stack('PackageStyle')
            <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
            <link href="{{ asset('css/fontawesome/fontawesome-all.css') }}" rel="stylesheet">
            <link href="{{ asset('css/linearicons.css') }}" rel="stylesheet">
            <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
            <link href="{{ asset('css/rtl.css') }}" rel="stylesheet">
            <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
            <link href="{{ asset('css/transitions.css') }}" rel="stylesheet">
            <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
            <link href="{{ asset('css/themify-icons.css') }}" rel="stylesheet">
            <link href="{{ asset('css/bootstrap4.css') }}" rel="stylesheet">
            <link href="{{ asset('css/main.css') }}" rel="stylesheet">
            <link href="{{ asset('css/frontend/responsive.css') }}" rel="stylesheet">
            {{-- 
            <link href="{{ asset('css/everything.css') }}" rel="stylesheet">
            --}}
             <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            @stack('stylesheets')
            @stack('inlineStyle')
            @php echo \App\Typo::setSiteStyling(); @endphp
            <script type="text/javascript">
              var APP_URL = {!! json_encode(url('/')) !!}
              var Map_key = {!! json_encode(Helper::getGoogleMapApiKey()) !!}
            </script>
            @if (Auth::user())
            <script type="text/javascript">
              var USERID = {!! json_encode(Auth::user()->id) !!}
                window.Laravel = {!! json_encode([
                'csrfToken'=> csrf_token(),
                'user'=> [
                    'authenticated' => auth()->check(),
                    'id' => auth()->check() ? auth()->user()->id : null,
                    'name' => auth()->check() ? auth()->user()->first_name : null,
                    'image' => !empty(auth()->user()->profile->avatar) ? asset('uploads/users/'.auth()->user()->id .'/'.auth()->user()->profile->avatar) : asset('images/user-login.png'),
                    'image_name' => !empty(auth()->user()->profile->avatar) ? auth()->user()->profile->avatar : '',
                    ]
                    ])
                !!};
            </script>
            @endif
            <script>
              window.trans = <?php
                $lang_files = File::files(resource_path() . '/lang/' . App::getLocale());
                $trans = [];
                foreach ($lang_files as $f) {
                    $filename = pathinfo($f)['filename'];
                    $trans[$filename] = trans($filename);
                }
                echo json_encode($trans);
                ?>;
            </script>
             <script src="https://cdn.tiny.cloud/1/xk4t6adscjvw7vlnk1dv6i3usgkfsx7yhw3mbskl7pphsbjf/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
           </head>
          <body class="{{'lang-'.str_replace('_', '-', app()->getLocale())}} {{Helper::getTextDirection()}}">
            {{ \App::setLocale(env('APP_LANG')) }}
            <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]-->
            <!-- Wrapper Start dc-closemenu-->
            <div id="dc-wrapper" class=" dc-wrapper dc-haslayout dc-closemenu">
              @if (Helper::getTopBarSettings('enable_topbar') == 'true')
              <div class="dc-topbar mobile_view_btn">
                <div class="container">
                  <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 less_padding">
                      <div class="dc-helpnum">
                        <span>{{ Helper::getTopBarSettings('title') }}</span>
                        <a class="dc-btn" href="tel:{{ clean(Helper::getTopBarSettings('number')) }}"> <i class="fas fa-phone"></i>Call Now</a>
                      </div>
                      @if (Helper::getTopBarSettings('enable_socials') === 'true')
                      <div class="dc-rightarea">
                        @php Helper::displaySocials('topbar'); @endphp
                      </div>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              @endif
              @php
              $role_type = Helper::getRoleTypeByUserID(Auth::user()->id);
              @endphp
              @if($role_type === 'admin')
              <div id="dc_fix_Header">
                @yield('header')
                <div class="row">
                  <div class="col-12">
                    <header id="dc-header" class="dc-header dc-haslayout dc-header-dashboard back_end_logomain position-absolue">
                      <div class="dc-navigationarea">
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 less_padding">  
                              <div class="dc-userlogedin">
                                <figure class="dc-userimg"><img src="https://doctorfindy.com/images/user-login.png" alt="" alt-text="mr..' '.david"></figure>
                                <div class="dc-username">
                                  <h4>mr. david</h4>
                                  <span>admin</span>
                                </div>
                                <nav class="dc-usernav header-menu">
                                  <ul>
                                    <li class=" "><a href="{{url('admin/dashboard')}}"><i class="ti-desktop"></i><span>Dashboard</span></a></li>
                                    <li class=" "><a href="/users/hospital"><i class="fa fa-hospital"></i><span>Hospitals</span></a></li>
                                    <li class="menu-item-has-children ">
                                      <span class="dc-dropdowarrow"><i class="lnr lnr-chevron-right"></i></span><a href="javascript:;"><i class="fa fa-user-md"></i><span>Doctors</span></a>
                                      <ul class="sub-menu">
                                        <li><a href="/users/doctor">All Doctors</a></li>
                                        <li><a href="/admin/all-online">Online Consultation</a></li>
                                        <li><a href="/admin/all-doctors">Activated Doctors</a></li>
                                        <li><a href="/admin/all-extend-doctors">All Extended Doctors</a></li>
                                      </ul>
                                    </li>
                                    <li class="menu-item-has-children ">
                                      <span class="dc-dropdowarrow"><i class="lnr lnr-chevron-right"></i></span><a href="javascript:;"><i class="fa fa-calendar-check-o"></i><span>Appointments</span></a>
                                      <ul class="sub-menu">
                                        <li><a href="/appointment-booking-system">Appointment Booking</a></li>
                                        <li><a href="/admin/visit-appointment">Visit Appointments</a></li>
                                        <li><a href="/admin/online-appointment">Online Appointments</a></li>
                                        <li><a href="/admin/all-appointment">All Appointments</a></li>
                                        <li><a href="/admin/pending-appointment">Pending Appointments</a></li>
                                        <li><a href="admin/accepted-appointment">Accepted Appointments</a></li>
                                        <li><a href="/admin/cancel-appointment">Cancel Appointments</a></li>
                                      </ul>
                                    </li>
                                    <li class="menu-item-has-children ">
                                      <span class="dc-dropdowarrow"><i class="lnr lnr-chevron-right"></i></span><a href="javascript:;"><i class="fa fa-calendar-check-o"></i><span>Laboratories</span></a>
                                      <ul class="sub-menu">
                                        <li><a href="/users/laboratory">All Laboratories </a></li>
                                        <li><a href="/admin/labs/branches">All Branches</a></li>
                                        <li><a href="/admin/labs/upload_discount">Upload Discount</a></li>
                                      </ul>
                                    </li>
                                    <!-- <li class=" "><a href="/users/laboratory"><i class="fa fa-flask"></i><span>Laboratories</span></a></li> -->
                                    <li class=" "><a href="/admin/booking-tests"><i class="fa fa-flask"></i><span>Booking Tests</span></a></li>
                                    <li class=" "><a href="/users/patient"><i class="fa fa-user-plus"></i><span>Patients</span></a></li>
                                    <li class=" "><a href="/admin/locations"><i class="ti-location-pin"></i><span>Locations</span></a></li>
                                    <li class=" "><a href="/admin/role"><i class="fa fa-group"></i><span>Roles</span></a></li>
                                    <li class=" "><a href="/admin/all-reports"><i class="fa fa-exclamation-triangle"></i><span>Reports</span></a></li>
                                    <li class=" "><a href="/admin/notification"><i class="fa fa-bell"></i><span>Push Notifications</span></a></li>
                                    <li class=" "><a href="/admin/diseases"><i class="fa fa-cogs"></i><span>Diseases</span></a></li>
                                    <li class=" "><a href="/admin/specialities"><i class="fa fa-user-secret"></i><span>Specialities</span></a></li>
                                    <li class=" "><a href="/admin/services"><i class="fab fa-servicestack"></i><span>Services</span></a></li>
                                    <li class=" "><a href="/admin/symptom"><i class="fa fa-snowflake-o"></i><span>Symptoms</span></a></li>
                                    <li class=" "><a href="/admin/treatments"><i class="fa fa-medkit"></i><span>Treatments</span></a></li>
                                    <li class=" "><a href="/admin/faq"><i class="fa fa-question-circle"></i><span>Faqs</span></a></li>
                                    <li class="menu-item-has-children ">
                                      <span class="dc-dropdowarrow"><i class="lnr lnr-chevron-right"></i></span><a href="javascript:;"><i class="fa fa-spinner"></i><span>All Surgeries</span></a>
                                      <ul class="sub-menu">
                                        <li><a href="/admin/procedure">Surgeries</a></li>
                                        <li><a href="/admin/procedure-cost">Surgeries Estimated Cost</a></li>
                                      </ul>
                                    </li>
                                    <li class=" "><a href="/admin/facility"><i class="fa fa-archive"></i><span>Facilities</span></a></li>
                                    <li class=" "><a href="/admin/video-blog"><i class="fa fa-archive"></i><span>Video Blogs</span></a></li>
                                    <li class=" "><a href="/admin/speciality-test"><i class="fa fa-eyedropper"></i><span>Speciality Tests</span></a></li>
                                    <li class=" "><a href="/admin/medicine"><i class="fa fa-plus-square"></i><span>Medicines</span></a></li>
                                    <li class=" "><a href="/admin/diagnose"><i class="fa fa-cog"></i><span>Diagnosis</span></a></li>
                                    <li class=" "><a href="/admin/feedback"><i class="fa fa-commenting"></i><span>Feedbacks</span></a></li>
                                    <li class=" "><a href="/admin/contact-us-users"><i class="fa fa-compress"></i><span>Contact Us Users</span></a></li>
                                    <li class=" "><a href="/admin/site-team"><i class="fa fa-compress"></i><span>Site Team</span></a></li>
                                    <li class="menu-item-has-children ">
                                      <span class="dc-dropdowarrow"><i class="lnr lnr-chevron-right"></i></span><a href="javascript:;"><i class="fa fa-laptop"></i><span>All Demo Requests</span></a>
                                      <ul class="sub-menu">
                                        <li><a href="/admin/doctor/demo-request">Doctor Demo Requests</a></li>
                                        <li><a href="/admin/hospital/demo-request">Hospital Demo Requests</a></li>
                                        <li><a href="/admin/laboratory/demo-request">Laboratort Demo Requests</a></li>
                                      </ul>
                                    </li>
                                    <li class="menu-item-has-children ">
                                      <span class="dc-dropdowarrow"><i class="lnr lnr-chevron-right"></i></span><a href="javascript:;"><i class="fa fa-deaf"></i><span>Vaccinations</span></a>
                                      <ul class="sub-menu">
                                        <li><a href="/admin/vaccination">Vaccination</a></li>
                                        <li><a href="/admin/vaccination-location">Vaccination Location</a></li>
                                        <li><a href="/admin/vaccination-alert">Vaccination Alert</a></li>
                                      </ul>
                                    </li>
                                    <li class="menu-item-has-children ">
                                      <span class="dc-dropdowarrow"><i class="lnr lnr-chevron-right"></i></span><a href="javascript:;"><i class=" fa fa-building"></i><span>Departments</span></a>
                                      <ul class="sub-menu">
                                        <li><a href="/admin/department">Department</a></li>
                                        <li><a href="/admin/department-service">Department Service</a></li>
                                      </ul>
                                    </li>
                                    <li class="menu-item-has-children ">
                                      <span class="dc-dropdowarrow"><i class="lnr lnr-chevron-right"></i></span><a href="javascript:;"><i class="fa fa-pencil-square"></i><span>Current Affairs</span></a>
                                      <ul class="sub-menu">
                                        <li><a href="/admin/affairs">Affair</a></li>
                                        <li><a href="/admin/affair-details">Affair Details</a></li>
                                      </ul>
                                    </li>
                                    <li class="menu-item-has-children ">
                                      <span class="dc-dropdowarrow"><i class="lnr lnr-chevron-right"></i></span><a href="javascript:;"><i class="ti-pencil-alt"></i><span>Manage Articles</span></a>
                                      <ul class="sub-menu">
                                        <li><a href="/create-article">Create Article</a></li>
                                        <li><a href="/admin/categories">Article Categories</a></li>
                                      </ul>
                                    </li>
                                    <li class=" "><a href="/admin/email-templates"><i class="ti-email"></i><span>Email Templates</span></a></li>
                                    <li class="menu-item-has-children ">
                                      <span class="dc-dropdowarrow"><i class="lnr lnr-chevron-right"></i></span><a href="javascript:;"><i class="ti-home"></i><span>Settings</span></a>
                                      <ul class="sub-menu">
                                        <li><a href="/admin/settings/home-page-settings">Home Pages Settings</a></li>
                                        <li><a href="/admin/settings/general-settings">General Settings</a></li>
                                        <li><a href="/profile/settings/account-settings">Security settings</a></li>
                                        <li><a href="/admin/profile-settings">Profile Settings</a></li>
                                        <li><a href="/admin/improvement-options">Improvement Options</a></li>
                                        <li><a href="/admin/url">Create Page</a></li>
                                      </ul>
                                    </li>
                                    <li class="menu-item-has-children ">
                                      <span class="dc-dropdowarrow"><i class="lnr lnr-chevron-right"></i></span><a href="javascript:;"><i class="ti-menu-alt"></i><span>Pages</span></a>
                                      <ul class="sub-menu">
                                        <li><a href="/admin/create/page">Create Page</a></li>
                                        <li><a href="/admin/pages">Pages Listing</a></li>
                                        <li><a href="/admin/packages">Packages</a></li>
                                        <li><a href="/admin/payouts">Payouts</a></li>
                                      </ul>
                                    </li>
                                    <li>
                                      <a href="{{ route('logout') }}" ><i class="lnr lnr-exit"></i>Logout
                                      </a> 
                                    </li>
                                  </ul>
                                </nav>
                              </div>
                              <div class="dc-headerform-holder"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </header>
                  </div>
                </div>
                @yield('banner')
              </div>
              @endif
              @yield('main')
              <div class="dc-contentwrapper" id="dashboard">
                @php
                $role_type = Helper::getRoleTypeByUserID(Auth::user()->id);
                $site_logo =  Helper::getGeneralSettings('site_logo');
                @endphp
                @if($role_type !== 'admin')
                <nav class="navbar navbar-expand navbar-light admin_header topbar mb-0 mb-xl-4 static-top shadow w-100" style="z-index: 99" id="new_navbar">
                  <!-- Sidebar Toggle (Topbar) -->
                  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" onclick="toggleSortDirection()">
                    <i id="menu-bars" class="fa fa-bars" aria-hidden="true"></i>
                  </button>
                  <!-- Topbar Search -->
                  <div class="admin_logo">
                    <div class="text-center d-none d-lg-inline-block mt-3 float-left">
                      <button class="rounded-circle border-0 bladHeader" id="sidebarToggle"></button>
                      
                    </div>
                    <a class="sidebar-brand d-flex align-items-center justify-content-center mt-3 ml-2 w-30 w-xs-100" 
                    href="/">
                      <!-- <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                      </div> -->
                      <div class="sidebar-brand-text mx-3 w-100">
                        <img src="/uploads/settings/general/1634215203-Group 1459.webp" alt="Site Logo" name="Site Logo" />
                      </div>
                    </a>
                  </div>
                  {{--       
                  <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group w-40 search_main backend_search">
                      <input type="text" class="form-control banner_input text_14" id="main_Search" placeholder="Search for doctors, hospitals, specialties, services, disease" data-toggle="dropdown" aria-expanded="false">
                      <span class="input-group-btn">
                      <button class="btn knockdoc_btn_bg banner_btn text-white text_14" type="button">Search 
                      <span>
                      <i class="fa fa-search fa-sm" aria-hidden="true"></i>
                      </span>
                      </button>
                      </span>
                      <div class="dropdown-menu banner_main_search p-0" style="">
                        <p class="p-2 w-100">Specialties</p>
                        <a class="dropdown-item" href="#"><img src="images/banner-1.png" class="w-30px h_30 rounded-circle mr-2">Allergy Immunology</a>
                        <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><img src="images/banner-1.png" class="w-30px h_30 rounded-circle mr-2">Family Medicine</a>
                        <p class="p-2 w-100">Hospitals</p>
                        <a class="dropdown-item" href="#"><img src="images/banner-1.png" class="w-30px h_30 rounded-circle mr-2">Doctor Hospital</a>
                        <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><img src="images/banner-1.png" class="w-30px h_30 rounded-circle mr-2">Jinnah Hospital</a>
                        <p class="p-2 w-100">Doctors</p>
                        <a class="dropdown-item" href="#"><img src="images/banner-1.png" class="w-30px h_30 rounded-circle mr-2">Dr. David</a>
                        <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><img src="images/banner-1.png" class="w-30px h_30 rounded-circle mr-2">Dr. Alex</a>
                        <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><img src="images/banner-1.png" class="w-30px h_30 rounded-circle mr-2">Dr. Smith</a>
                        <p class="p-2 w-100">Services</p>
                        <a class="dropdown-item" href="#"><img src="images/banner-1.png" class="w-30px h_30 rounded-circle mr-2">Book a Test</a>
                        <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><img src="images/banner-1.png" class="w-30px h_30 rounded-circle mr-2">Services</a>
                        <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><img src="images/banner-1.png" class="w-30px h_30 rounded-circle mr-2">Find a doctor</a>
                      </div>
                    </div>
                  </form>
                  --}}
                  <!-- Topbar Navbar -->
                  <ul class="navbar-nav ml-auto" style="width:13%;">
                    <!-- <li class="nav-item dropdown no-arrow d-sm-none">
                      <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-search fa-fw" aria-hidden="true"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                          <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                              <button class="btn btn-primary" type="button">
                              <i class="fas fa-search fa-sm" aria-hidden="true"></i>
                              </button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </li> -->
                    <!-- Nav Item - Messages -->
                    <!-- <li class="nav-item dropdown no-arrow mx-1">
                      <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-envelope fa-fw" aria-hidden="true"></i>
                        <span class="badge badge-danger badge-counter">7</span>
                      </a>
                      <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">
                          Message Center
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                          <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                            <div class="status-indicator bg-success"></div>
                          </div>
                          <div class="font-weight-bold">
                            <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                            <div class="small text-gray-500">Emily Fowler · 58m</div>
                          </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                          <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                            <div class="status-indicator"></div>
                          </div>
                          <div>
                            <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                            <div class="small text-gray-500">Jae Chun · 1d</div>
                          </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                          <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                            <div class="status-indicator bg-warning"></div>
                          </div>
                          <div>
                            <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                            <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                          </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                          <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                            <div class="status-indicator bg-success"></div>
                          </div>
                          <div>
                            <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                            <div class="small text-gray-500">Chicken the Dog · 2w</div>
                          </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                      </div>
                    </li> -->
                    <!-- Nav Item - Alerts -->
                    <!-- <li class="nav-item dropdown no-arrow mx-1">
                      <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw" aria-hidden="true"></i>
                        <span class="badge badge-danger badge-counter">3+</span>
                      </a>
                      <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                          Alerts Center
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                          <div class="mr-3">
                            <div class="icon-circle bg-primary">
                              <i class="fas fa-file-alt text-white" aria-hidden="true"></i>
                            </div>
                          </div>
                          <div>
                            <div class="small text-gray-500">December 12, 2019</div>
                            <span class="font-weight-bold">A new monthly report is ready to download!</span>
                          </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                          <div class="mr-3">
                            <div class="icon-circle bg-success">
                              <i class="fas fa-donate text-white" aria-hidden="true"></i>
                            </div>
                          </div>
                          <div>
                            <div class="small text-gray-500">December 7, 2021</div>
                            $290.29 has been deposited into your account!
                          </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                          <div class="mr-3">
                            <div class="icon-circle bg-warning">
                              <i class="fas fa-exclamation-triangle text-white" aria-hidden="true"></i>
                            </div>
                          </div>
                          <div>
                            <div class="small text-gray-500">December 2, 2021</div>
                            Spending Alert: We've noticed unusually high spending for your account.
                          </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                      </div>
                    </li> -->
                    <li class="nav-item dropdown no-arrow">
                      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      @if(Auth::user()->profile->avatar != null || Auth::user()->profile->avatar != '' ) 
                        <img class="img-profile rounded-circle" src="/uploads/users/{{Auth::user()->id}}/{{Auth::user()->profile->avatar}}" alt="user-Img">
                        @else
                        <img class="img-profile rounded-circle" src="/uploads/users/default/patient.svg" alt="user-Img">
                      {{-- {{$user->first_name ." ".$user->last_name}} --}}
                        <span class="ml-2 d-none d-lg-inline text-gray-600 small user_name">{{Auth::user()->first_name ." ".Auth::user()->last_name}}</span>
                        @endif
                        <p class="ml-2 d-none d-lg-inline text-gray-600 small user_identy position-absolute"> {{$role_type}}</p>
                      </a>
                      <!-- Dropdown - User Information -->
                      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in profile-menu" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="doctor/profile-settings">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400" aria-hidden="true"></i>
                        Profile
                        </a>
                        <a class="dropdown-item" href="/profile/settings/account-settings">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400" aria-hidden="true"></i>
                        Settings
                        </a>
                        <!-- <a class="dropdown-item" href="#">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400" aria-hidden="true"></i>
                        Activity Log
                        </a> -->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400" aria-hidden="true"></i>
                        Logout
                        </a>
                      </div>
                    </li> 
                  </ul>
                </nav>
                @else 
                @include('back-end.includes.header') 
                @endif
                <main id="dc-main" class="dc-main dc-haslayout main_padding">
                  @auth
                  <div id="dc-sidebarwrapper" class="dc-sidebarwrapper">
                    @if($role_type !== 'admin')
                    <!-- Sidebar -->
                    <ul class="navbar-nav sidebar sidebar_dark accordion user_dashboardMain" id="accordionSidebar">
                      <div class="sidebar_inner d-inline-block w-100 text-center">
                        <!-- Sidebar - Brand -->
                        
                        <!-- Divider -->
                        <!-- <hr class="sidebar-divider my-0"> -->
                        <li class="nav-item">
                          <a class="nav-link" href="/">
                          <i class="fas fa-home"></i>
                          <span>Home</span></a>
                        </li>
                        <!-- Nav Item - Dashboard -->
                        <li class="nav-item">
                          <a class="nav-link" href="/{{$role_type}}/dashboard">
                          <i class="fas fa-th-large"></i>
                          <span>Dashboard</span></a>
                        </li>
                        <!-- Divider -->
                        <!-- <hr class="sidebar-divider"> -->
                        <!-- Heading -->
                        <!-- <div class="sidebar-heading">
                          Interface
                          </div> -->
                        @if($role_type === 'doctor')
                        <li class="nav-item">
                          <a class="nav-link" href="/{{$role_type}}/appointments">
                          <i class="fas fa-user-friends"></i>
                          <span>My Appointments</span></a>
                        </li>
                        @endif
                        @if($role_type === 'patient')
                        <li class="nav-item">
                          <a class="nav-link" href="/{{$role_type}}/appointments">
                          <i class="fas fa-calendar-alt"></i>
                          <span>My Appointments</span></a>
                        </li>
                        @endif
                        <li class="nav-item">
                          <a class="nav-link" href="javascript:void(0)">
                          <i class="fas fa-envelope"></i>
                          <span>Inbox</span></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="/{{$role_type}}/all-appointments">
                          <i class="fas fa-calendar-alt"></i>
                          <span>Appointments List</span></a>
                        </li>
                        @if($role_type === 'doctor')
                        <li class="nav-item">
                          <a class="nav-link" href="/appointment-settings">
                          <i class="fas fa-cogs"></i>
                          <span>Appointment Settings</span></a>
                        </li>
                        @endif
                        <li class="nav-item">
                          <a class="nav-link" href="/{{$role_type}}/profile-settings">
                          <i class="fas fa-user-cog"></i>
                          <span>Profile Setting</span></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="/profile/settings/account-settings">
                          <i class="fas fa-user-cog"></i>
                          <span>Account Setting</span></a>
                        </li>
                        @if($role_type === 'doctor')
                        <li class="nav-item">
                          <a class="nav-link" href="/{{$role_type}}/blogs">
                          <i class="fas fa-newspaper"></i>
                          <span>Blogs</span></a>
                        </li>
                        @endif
                        @if($role_type === 'patient')
                        <li class="nav-item">
                          <a class="nav-link" href="/{{$role_type}}/payout-setting">
                          <i class="fas fa-money-check"></i>
                          <span>Payout Settings</span></a>
                        </li>
                        @endif
                        @if($role_type === 'doctor')
                        <li class="nav-item">
                          <a class="nav-link" href="/doctor/orders-settings">
                          <i class="fas fa-money-check"></i>
                          <span>Payout Settings</span></a>
                        </li>
                        @endif
                        <li class="nav-item">
                          <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('dashboard-logout-form').submit();">
                          <i class="fas fa-sign-out-alt"></i>{{{trans('lang.logout')}}}
                          </a>
                          <form id="dashboard-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                          </form>
                        </li>
                        {{--   
                        <li class="nav-item">
                          <a class="nav-link" href="javascript:void(0)">
                          <i class="fas fa-sign-in-alt"></i>
                          <span>Log In</span></a>
                        </li>
                        --}}
                        <!-- Nav Item - Pages Collapse Menu -->
                        <!-- <li class="nav-item">
                          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fas fa-fw fa-cog"></i>
                            <span>Components</span>
                          </a>
                          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                              <h6 class="collapse-header">Custom Components:</h6>
                              <a class="collapse-item" href="buttons.html">Buttons</a>
                              <a class="collapse-item" href="cards.html">Cards</a>
                            </div>
                          </div>
                          </li> -->
                        <!-- Sidebar Toggler (Sidebar) -->
                      </div>
                    </ul>
                    <!-- End of Sidebar -->
                    @else 
                    @include('back-end.includes.dashboard-menu')
                    @endif
                  </div>
                  @endauth
                  <!-- style="width: 88%;float: right;" -->
                  <section class="dc-haslayout dc-dbsectionspace">
                    @yield('content')
                  </section>
                </main>
              </div>
              @yield('footer')
            </div>
            @yield('bootstrap_script')
            <script src="{{ asset('js/app.js') }}"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('js/main.js') }}"></script>
            <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js">
            </script>
            <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
            <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
            <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
         <!--  <script>
        tinymce.PluginManager.add('customfont', function(editor, url) {
            // Define the font families you want to add
            var fontFamilies = [
                { text: 'Open Sans', value: 'Open Sans, sans-serif' },
                // Add more fonts here if needed
            ];

            // Register a custom menu item for fonts
            editor.ui.registry.addMenuItem('customfont', {
                text: 'Font',
                icon: 'font',
                menu: fontFamilies.map(function(font) {
                    return {
                        text: font.text,
                        icon: 'font',
                        onAction: function() {
                            editor.execCommand('fontName', false, font.value);
                        }
                    };
                })
            });

            // Add the custom menu item to the toolbar
            editor.ui.registry.addButton('customfont', {
                icon: 'font',
                tooltip: 'Font',
                onAction: function() {
                    editor.execCommand('fontName', true, 'Open Sans');
                }
            });
        });

        // Initialize TinyMCE
        tinymce.init({
            selector: '#description',
            plugins: 'customfont',
            toolbar: 'customfont | formatselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | removeformat',
            content_style: 'body { font-family: "Open Sans", sans-serif; }',
            // Other configuration options
        });
    </script> -->
            <!-- <script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
            <script>
              CKEDITOR.replace( 'description' );
            </script>
             <script>
              CKEDITOR.replace( 'faq_procedure' );
            </script> -->
            <!-- <script src="node_modules/tinymce/tinymce.min.js"></script>
            <link rel="stylesheet" href="node_modules/tinymce/skins/content/default/content.min.css"> -->
               <!-- <script src="https://cdn.tiny.cloud/1/xk4t6adscjvw7vlnk1dv6i3usgkfsx7yhw3mbskl7pphsbjf/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> -->
           <!--  <script>
    // Define the common configuration options
    // const commonConfig = {
    //     plugins: 'directionality  mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste   a11ychecker typography inlinecss fullscreen',
    //     toolbar: 'ltr rtl | fullscreen | undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | checklist numlist bullist indent outdent | emoticons charmap',
    //     paste_as_text: false, // Retain formatting when pasting
    //     forced_root_block: false,
    // };
     const commonConfig = {
        plugins: 'directionality   anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount  fullscreen removeformat',
        toolbar: 'ltr rtl | fullscreen | undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        paste_as_text: false, // Retain formatting when pasting
        forced_root_block: false,
    };         

    // Initialize the first instance of TinyMCE
    document.addEventListener("DOMContentLoaded", function() {
        tinymce.init({
            selector: '#description',
            ...commonConfig,
        });
    

    // Initialize the second instance of TinyMCE
    tinymce.init({
        selector: '#faq_procedure',
        ...commonConfig,
    });
    tinymce.init({
        selector: '#urdu_decription',
        ...commonConfig,

    });
    });
    </script> -->
    <script>
    // Define the common configuration options
    const commonConfig = {
        plugins: 'directionality anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount fullscreen customfont', 
        toolbar: 'ltr rtl | fullscreen | undo redo | blocks fontfamily fontsizeinput | bold italic underline strikethrough | link image media table mergetags | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat customfont', // Add 'customfont' to the toolbar
        paste_as_text: false, // Retain formatting when pasting
        forced_root_block: false,
    };

    // Define the custom font plugin
    tinymce.PluginManager.add('customfont', function(editor, url) {
        // Define the font families you want to add
        var fontFamilies = [
            { text: 'Open Sans', value: 'Open Sans, sans-serif' },
            // Add more fonts here if needed
        ];

        // Register a custom menu item for fonts
        editor.ui.registry.addMenuItem('customfont', {
            text: 'Font',
            icon: 'font',
            menu: fontFamilies.map(function(font) {
                return {
                    text: font.text,
                    icon: 'font',
                    onAction: function() {
                        editor.execCommand('fontName', false, font.value);
                    }
                };
            })
        });

        // Add the custom menu item to the toolbar
        editor.ui.registry.addButton('customfont', {
            icon: 'font',
            tooltip: 'Font',
            onAction: function() {
                editor.execCommand('fontName', true, 'Open Sans');
            }
        });
    });

    // Initialize TinyMCE for all instances
    document.addEventListener("DOMContentLoaded", function() {
        tinymce.init({
            selector: '#description',
            ...commonConfig,
        });

        tinymce.init({
            selector: '#faq_procedure',
            ...commonConfig,
        });

        tinymce.init({
            selector: '#urdu_decription',
            ...commonConfig,
        });
    });
</script>

            <!-- CkEditor -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/markerclustererplus/2.1.4/markerclusterer.js"></script>
            @stack('scripts')
            <script type="text/javascript">
              /*$("#main_doctor_search").click(function () {
              $("#datas").addClass("absolute_search");
              $("#countryList").addClass("absolute_dropdown");
              });*/
              
              $("#location_main .ais-SearchBox-input").click(function () {
                //  alert("hi");
                $("#location_inner").addClass("absolute_search");
                $("#cityList").addClass("absolute_dropdown");
              });
              // Select values from serach drop down
              $(window).on('load', function() {
                $("#countryList").on("click", "#hits-instant-search-spec li", function(event){
                  event.stopPropagation();
                  var clone = $(this).clone()    //clone the element
                    .end()  //again go back to selected element
                    .text();
              
                  var word = $(this).find('.text-uppercase').text();
                  var dBlock = $(this).find('.d-block').text();
              
                  var text = clone.replace(word,'');
                  var text = text.replace(dBlock,'');
                  var text = $.trim(text);
                  $('#searchbox .ais-SearchBox-input').val(text);
                  $('#submitSearchValue').attr('name', word);
                  $('#submitSearchValue').val(text);
                  $('#searchbox .ais-SearchBox-input').attr("name", "search");
                  $('#searchbox .ais-SearchBox-input').attr("id", "search");
                  $(".dropdown-menu").css('display', "none !important");
              
                  $('#datas').removeClass('absolute_search');
                  $('#countryList').removeClass('absolute_dropdown');
                  $('#countryList').removeClass('show');
                  $("#close_doctor_search").css('display','none');
                  $('#search-btn').click();
                  $("body").removeClass("fixed");
                });
                $("#countryList").on("click", "#hits-instant-search li", function(event){
                  event.stopPropagation();
                  var clone = $(this).clone()    //clone the element
                    .end()  //again go back to selected element
                    .text();
              
                  var word = $(this).find('.text-uppercase').text();
                  var dBlock = $(this).find('.d-block').text();
                  var text = clone.replace(word,'');
                  var text = text.replace(dBlock,'');
                  var text = $.trim(text);
                  $('#searchbox .ais-SearchBox-input').val(text);
                  $('#submitSearchValue').val(text);
                  $('#submitSearchValue').attr('name', 'search');
                  $('#searchbox .ais-SearchBox-input').attr("name", "search");
                  $('#searchbox .ais-SearchBox-input').attr("id", "search");
                  $(".dropdown-menu").css('display', "none !important");
              
                  $('#datas').removeClass('absolute_search');
                  $('#countryList').removeClass('absolute_dropdown');
                  $('#countryList').removeClass('show');
                  $("#close_doctor_search").css('display','none');
                  $('#search-btn').click();
                  $("body").removeClass("fixed");
                });
                $("#countryList").on("click", "#hits-instant-search-disease li", function(event){
                  event.stopPropagation();
                  var clone = $(this).clone()    //clone the element
                    .end()  //again go back to selected element
                    .text();
              
                  var word = $(this).find('.text-uppercase').text();
                  var dBlock = $(this).find('.d-block').text();
                  var text = clone.replace(word,'');
                  var text = text.replace(dBlock,'');
                  var text = $.trim(text);
                  $('#searchbox .ais-SearchBox-input').val(text);
                  $('#submitSearchValue').val(text);
                  $('#submitSearchValue').attr('name', 'diseases');
                  $('#searchbox .ais-SearchBox-input').attr("name", "search");
                  $('#searchbox .ais-SearchBox-input').attr("id", "search");
                  $(".dropdown-menu").css('display', "none !important");
              
                  $('#datas').removeClass('absolute_search');
                  $('#countryList').removeClass('absolute_dropdown');
                  $('#countryList').removeClass('show');
                  $("#close_doctor_search").css('display','none');
                  $('#search-btn').click();
                  $("body").removeClass("fixed");
                });
                $("#countryList").on("click", "#hits-instant-search-hospital li", function(event){
                  event.stopPropagation();
                  var clone = $(this).clone()    //clone the element
                    .end()  //again go back to selected element
                    .text();
              
                  var word = $(this).find('.text-uppercase').text();
                  var dBlock = $(this).find('.d-block').text();
                  var text = clone.replace(word,'');
                  var text = text.replace(dBlock,'');
                  var text = $.trim(text);
                  $('#searchbox .ais-SearchBox-input').val(text);
                  $('#submitSearchValue').val(text);
                  $('#submitSearchValue').attr('name', 'search');
                  $('#searchbox .ais-SearchBox-input').attr("name", "search");
                  $('#searchbox .ais-SearchBox-input').attr("id", "search");
                  $(".dropdown-menu").css('display', "none !important");
              
                  $('#datas').removeClass('absolute_search');
                  $('#countryList').removeClass('absolute_dropdown');
                  $('#countryList').removeClass('show');
                  $("#close_doctor_search").css('display','none');
                  $('#search-btn').click();
                  $("body").removeClass("fixed");
                });
                $("#close_doctor_search").click(function(){
                  $('#datas').removeClass('absolute_search');
                  $('#countryList').removeClass('absolute_dropdown', 'show');
                  $("body").removeClass("fixed");
              
                  $(this).css('display','none');
                });
              
                $("#close_location_search").click(function(){
                  //alert("hi");
                  $('#location_inner').removeClass('absolute_search');
                  $('#cityList').removeClass('absolute_dropdown','show');
                  $(this).css('display','none');
                  $("body").removeClass("fixed");
                });
              
                $(".ais-SearchBox-reset").click(function(){
                  $(".ais-SearchBox-input").val("");
                });
              
                if ($(window).width() <= 992) {
                  $("#main_doctor_search .ais-SearchBox-input").on("click", function(){
                    //alert("hi");
                    $("#close_doctor_search").css('display','block');
                    //$(".show").css('display','none !important');
                    $("body").addClass("fixed");
                  });
              
                  $("#location_main .ais-SearchBox-input").on("click", function(){
                    $("#close_location_search").css('display','block');
                    $("body").addClass("fixed");
                  });
                  $(window).scroll(function() {
                    var sticky_map = $('#search_form'),
                      scroll = $(window).scrollTop();
              
                    if (scroll >= 40) {
                      sticky_map.addClass('sticky_mobile_view_search'); }
                    else {
                      sticky_map.removeClass('sticky_mobile_view_search');
              
                    }
                  });
                }
              
                $("#cityList").on("click", ".ais-Hits-item li", function(event){
                  //alert('city selected')
                  event.stopPropagation();
                  var clone = $(this).clone()    //clone the element
                    .end()  //again go back to selected element
                    .text();
                  var word = $(this).find('.text-uppercase').text();
                  var text = clone.replace(word,'');
                  var text = $.trim(text);
                  $('#locations .ais-SearchBox-input').val(text);
                  $('#submitCityValue').val(text);
                  $('#locations .ais-SearchBox-input').attr("name", "location");
                  $('#locations .ais-SearchBox-input').attr("id", "location");
                  $(".dropdown-menu").css('display', "none !important");
              
                  $('#location_inner').removeClass('absolute_search');
                  $('#cityList').removeClass('absolute_dropdown');
                  $('#cityList').removeClass('show');
                  $('#location_dropdown').removeClass('show');
                  $("#close_location_search").css('display','none');
                  $("body").removeClass("fixed");
                  //alert("remove");
                });
              
              });
              /*window.onscroll = function() {myFunction()};
              
              var header = document.getElementById("dc_fix_Header");
              var sticky = header.offsetTop;
              
              function myFunction() {
                if (window.pageYOffset > 100) {
                  header.classList.add("sticky");
                } else {
                  header.classList.remove("sticky");
                }
              }*/
              $(window).scroll(function() {
                var sticky = $('#dc_fix_Header'),
                  scroll = $(window).scrollTop();
              
                if (scroll >= 40) {
                  sticky.addClass('sticky');
                }
                else {
                  sticky.removeClass('sticky');
                }
                var sticky = $('#new_navbar'),
                  scroll = $(window).scrollTop();
              
                if (scroll >= 40) {
                  sticky.addClass('sticky');
                }
                else {
                  sticky.removeClass('sticky');
                }
              });
              
              $(window).scroll(function() {
                var sticky_map = $('.google_map_main'),
                  scroll = $(window).scrollTop();
              
                if (scroll >= 40) {
                  sticky_map.addClass('sticky_map'); }
                else {
                  sticky_map.removeClass('sticky_map');
              
                }
              });
              
              $(window).scroll(function() {
                var sticky_map = $('.search_main'),
                  scroll = $(window).scrollTop();
              
                if (scroll >= 40) {
                  sticky_map.addClass('sticky_search'); }
                else {
                  sticky_map.removeClass('sticky_search');
              
                }
              });
              $(window).scroll(function() {
                var sticky_map = $('.front_end'),
                  scroll = $(window).scrollTop();
              
                if (scroll >= 40) {
                  sticky_map.addClass('hide_nav'); }
                else {
                  sticky_map.removeClass('hide_nav');
              
                }
              });
              
              $(".mobile_view_search").on("click",function(){
                //alert("hi");
              
                $(".search_main").addClass("first_modal");
                $(".first_modal").show();
              
              });
              
              $("#first_modal_close").on("click",function(){
                $(".first_modal").hide();
              });
              
              $(".dc-userlogedin").on("click",function(){
                if($('.header-menu').height() > 300){
                  $(".header-menu").css({'overflow-y' : 'scroll','height' : '470px'});
                };
                $(".header-menu").toggle();
              });
              
              $('.header-menu').bind('click', function (e) { e.stopPropagation() });
              
              $(".more_filter_btn").on("click",function(){
                $(".filter_outer").slideToggle(500);
              });
              $("#close_filter , .mobile_apply_btn").on("click", function(){
                $(".filter_outer").hide();
              });

              function toggleSortDirection() {
                // alert("hiii");
                var element = document.getElementById("menu-bars");
                var elementcheck = document.getElementsByClassName("fa-bars");
                console.log("element",element,elementcheck);
                if (elementcheck.length > 0) {
                  element.classList.remove("fa-bars");
                  element.classList.add("fa-times");
                }else{
                  // alert('here');
                  element.classList.remove("fa-times");
                element.classList.add("fa-bars");
                }
              }
//               document.getElementById("sidebarToggleTop").addEventListener("click",function()
// {
//               var headermain=document.getElementById("accordionSidebar");
//               if(headermain.style.display=="block")
//               {
//                   headermain.style.display="none";
//               }
//               else
//               {
//                   headermain.style.display="block";
//               }
//               });
              document.addEventListener("DOMContentLoaded", function() {
              var sidebarToggleTop = document.getElementById("sidebarToggleTop");
              var headermain = document.getElementById("accordionSidebar");

              if (sidebarToggleTop && headermain) {
                  sidebarToggleTop.addEventListener("click", function() {
                      if (headermain.style.display == "block") {
                          headermain.style.display = "none";
               } else {
                headermain.style.display = "block";
                }
        });
    }
});
              $(document).ready(function(){
                $('#sidebarToggle').click(function(){
                    $(".user_dashboardMain").toggleClass('toggle_sidebar');
                    $(".main_padding").toggleClass('sidebar_padding');
                });
              });
            </script>
            <style>
              .dropdown:hover .dropdown-menu {
                  display: block;
              }
              .user_dashboardMain{
                top: 70px;
                position: relative;
              }
              @media (min-width: 576px){
                .topbar .dropdown .profile-menu {
    width: auto;
    right: -66px;
    top: 60px;
  }
}
            </style>
          </body>
        </html> 