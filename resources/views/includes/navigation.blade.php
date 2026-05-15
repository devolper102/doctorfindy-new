<ul class="navbar-nav">
    @auth
        <li class="nav-item mobile_module">
            <a href="#">{{ trans('lang.mobile_dashboard') }}</a>
        </li>
    @endauth
    <li class="menu-item-has-children page_item_has_children {{ strpos($_SERVER['REQUEST_URI'], '/search-results?type=doctor') !== false ? 'active' : '' }}">
        <a href="javascript:void(0)">{{ trans('lang.doctors') }}<i class="fas fa-chevron-down"></i></a>
        <ul class="sub-menu menu-item-moved">
            <li>
                <a href="{{{ route('speciality',['dermatologist']) }}}">{{ trans('lang.dermatologists') }}</a>
            </li>
            <li>
                <a href="{{{ route('speciality',['urology']) }}}">{{ trans('lang.urologists') }}</a>
            </li>
            <li>
                <a href="{{{ route('speciality',['obstetrics-an-gynecology']) }}}">{{ trans('lang.gynecologists') }}</a>
            </li>
            <li>
                <a href="{{{ route('speciality',['neurology']) }}}">{{ trans('lang.neurologist') }}</a>
            </li>
            <li>
                <a href="{{{ route('speciality',['family-medicine']) }}}">{{ trans('lang.general_physician') }}</a>
            </li>
            <li>
                <a href="{{{ route('speciality',['ophthalmology']) }}}">{{ trans('lang.pulmonologist') }}</a>
            </li>
            <li>
                <a href="{{{ route('speciality',['psychiatry']) }}}">{{ trans('lang.pediatrician') }}</a>
            </li>
            <li>
                <a href="{{{ route('speciality',['surgery']) }}}">{{ trans('lang.cardiologist') }}</a>
            </li>
            <li>
                <a href="{{{ url('find-a-doctor') }}}">{{ trans('lang.all_specialities') }}</a>
            </li>
        </ul>
    </li>

    <li class="menu-item-has-children page_item_has_children {{ strpos($_SERVER['REQUEST_URI'], '/search-results?type=hospital') !== false ? 'active' : '' }}">
        <a href="javascript:void(0)">{{ trans('lang.hospitals') }}<i class="fas fa-chevron-down"></i></a>
        <ul class="sub-menu menu-item-moved">
            <li>
                <a href="{{{ route('doctors-by-city',['lahore']) }}}">{{ trans('lang.lahore') }}</a>
            </li>
            <li>
                <a href="{{{ route('doctors-by-city',['karachi']) }}}">{{ trans('lang.karachi') }}</a>
            </li>
            <li>
                <a href="{{{ route('doctors-by-city',['islamabad']) }}}">{{ trans('lang.islamabad') }}</a>
            </li>
            <li>
                <a href="{{{ route('doctors-by-city',['rawalpindi']) }}}">{{ trans('lang.rawalpindi') }}</a>
            </li>
            <li>
                <a href="{{{ route('doctors-by-city',['multan']) }}}">{{ trans('lang.multan') }}</a>
            </li>
            <li>
                <a href="{{{ route('doctors-by-city',['faisalabad']) }}}">{{ trans('lang.faisalabad') }}</a>
            </li>
            <li>
                <a href="{{{ route('doctors-by-city',['peshawar']) }}}">{{ trans('lang.peshawar') }}</a>
            </li>
            <li>
                <a href="{{{ route('doctors-by-city',['sargodha']) }}}">{{ trans('lang.sargodha') }}</a>
            </li>
            <li>
                <a href="{{{ route('doctors-by-city',['gujranwala']) }}}">{{ trans('lang.gujranwala') }}</a>
            </li>
            <li>
                <a href="{{{ route('doctors-by-city',['bahawalpur']) }}}">{{ trans('lang.bahawalpur') }}</a>
            </li>
            <li>
                <a href="{{{ url('doctors/pakistan') }}}">{{ trans('lang.all_hospitals') }}</a>
            </li>
        </ul>
    </li>
 <li class="menu-item-has-children page_item_has_children {{ strpos($_SERVER['REQUEST_URI'], '/search-results?type=hospital') !== false ? 'active' : '' }}">
        <a href="javascript:void(0)">{{ trans('lang.services') }}<i class="fas fa-chevron-down"></i></a>
        <ul class="sub-menu menu-item-moved">
            <li>
                <a href="{{{ url('diseases') }}}">{{ trans('lang.all_diseases') }}</a>
            </li>
            <li>
                <a href="{{{ url('speciality') }}}">{{ trans('lang.all_specialities') }}</a>
            </li>
            <li>
                <a href="#" style="text-transform: initial;">{{ trans('lang.book_test') }}</a>
            </li>
            <li>
                <a href="{{ url('doctors-in-pakistan') }}" style="text-transform: initial;">Doctors In Pakistan</a>
            </li>
            <li>
                <a href="{{ url('hospitals-in-pakistan') }}" style="text-transform: initial;">Hospitals In Pakistan</a>
            </li>
            <li>
                <a href="{{ url('services') }}" style="text-transform: initial;">Services</a>
            </li>
            <li>
                <a href="{{ url('find-a-doctor') }}" style="text-transform: initial;">Find A Doctor</a>
            </li>
               
           
        </ul>
    </li>
    <li class="nav-item {{ strpos($_SERVER['REQUEST_URI'], '/health-forum') !== false ? 'active' : '' }}">
        <a href="{{ route('forumQuestions') }}">{{ trans('lang.health_forum') }}</a>
    </li>
    <!-- <li class="menu-item-has-children page_item_has_children {{ strpos($_SERVER['REQUEST_URI'], '/search-results?type=doctor') !== false ? 'active' : ''}}">
        <a href="javascript:void(0);">{{ trans('lang.search_results') }}<i class="fas fa-chevron-down"></i></a>
        <ul class="sub-menu menu-item-moved">
            <li>
                <a href="{{{ url('search-results?type=doctor') }}}">{{ trans('lang.search_doctors') }}</a>
            </li>
            <li>
                <a href="{{{ url('search-results?type=hospital') }}}">{{ trans('lang.search_hospitals') }}</a>
            </li>
        </ul>
    </li> -->
    <!-- <li class="menu-item-has-children page_item_has_children {{ strpos($_SERVER['REQUEST_URI'], '/articles') !== false ? 'active' : '' }}">
        <a href="javascript:void(0);">{{ trans('lang.pages') }}<i class="fas fa-chevron-down"></i></a>
        <ul class="sub-menu">
            <li class="nav-item">
                <a href="{{ route('articleListing') }}">{{ trans('lang.articles') }}</a>
            </li>
            @if (Schema::hasTable('pages'))
                @php $pages = App\Page::all(); @endphp
                @if (!empty($pages) && $pages->count() > 0)
                    @foreach ($pages as $key => $page)
                        @php
                            $page_has_child = App\Page::pageHasChild($page->id); 
                            $pageID = Request::segment(2);
                            $meta = !empty($page->meta) ? Helper::getUnserializeData($page->meta) : '';
                            $has_parent = App\Page::pageHasParent($page->id);
                        @endphp
                        @if (!empty($meta['show_page']) && $meta['show_page'] == 'true' && $has_parent == 0)
                            @if (!empty($page_has_child))
                                <li class="menu-item-has-children page_item_has_children dc-notificationicon">
                            @else
                                <li>    
                            @endif
                                <a href="{{url('page/'.$page->slug)}}">{{{ html_entity_decode(clean($page->title)) }}}</a>
                                <ul class="sub-menu">
                                    @foreach($page_has_child as $parent)
                                        @php $child = App\Page::getChildPages($parent->child_id);@endphp
                                        <li><a href="{{url('page/'.$child->slug.'/')}}">{{{ html_entity_decode(clean($child->title)) }}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endif
        </ul>
        
    </li> -->
</ul>
@guest
<div class="join_now mobile_module">
        <a href="{{{ url('/register') }}}">{{ trans('lang.join_now') }}</a>
    </div>
    <!-- <div class="dc-loginarea mobile_module">
        <div class="dc-loginoption">
            <a href="javascript:void(0);" id="dc-loginbtn" class="dc-loginbtn">{{ trans('lang.login') }}</a>
            <div class="dc-loginformhold">
                <form method="POST" action="{{ route('login') }}" class="dc-formtheme dc-loginform do-login-form">
                    @csrf
                    <fieldset>
                        <div class="form-group">
                            <input id="email" type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                placeholder="{{ trans('lang.ph_email') }}" required autofocus>
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input id="password" type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                placeholder="{{ trans('lang.ph_pass') }}" required>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="dc-logininfo">
                            <span class="dc-checkbox">
                                <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">{{{ trans('lang.remember') }}}</label>
                            </span>
                            <button type="submit" class="dc-btn do-login-button">{{{ trans('lang.login') }}}</button>
                        </div>
                    </fieldset>
                    <div class="dc-loginfooterinfo">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="dc-forgot-password">{{{ trans('lang.forget_pass') }}}</a>
                        @endif
                        <a href="{{{ route('register') }}}">{{{ trans('lang.create_account') }}}</a>
                    </div>
                </form>
            </div>
        </div>
    </div> -->
@endguest
<div class="dc-helpnum desktop_btn">
        <span>{{ Helper::getTopBarSettings('title') }}</span>
        <!-- remove dc-btn class from down anchor -->
        <a class="" style="min-width: 90px;padding:0px;" href="tel:{{ clean(Helper::getTopBarSettings('number')) }}"> <i class="fas fa-phone"></i><!-- {{ clean(Helper::getTopBarSettings('number')) }} --> Call Now</a>
</div>