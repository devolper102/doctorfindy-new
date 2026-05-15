@php
    $items = Helper::getDashboardList();
    $output = '';
    $role_type = Helper::getAuthRoleType();
    $profile_link = $role_type == 'doctor' || $role_type == 'hospital' ? route('userProfile', ['slug' => Auth::user()->slug]) : 'javascript:;';
@endphp
<div id="dc-btnmenutoggle" class="dc-btnmenutoggle" >
    <i class="ti-arrow-left"></i>
</div>
<div id="dc-verticalscrollbar" class="dc-verticalscrollbar">
    <div class="dc-companysdetails dc-usersidebar">
        {{--<!-- <figure class="dc-companysimg">
            <img src="{{ asset(Helper::getImage('uploads/users/'.Auth::user()->id, Auth::user()->profile->banner, 'small-', 'user-banner.jpg')) }}" alt="{{ trans('lang.img_desc') }}">
        </figure> -->
        <!-- <figure class="aside_logo">
            <strong class="dc-logo"><a href="{{ url('/') }}"><img src="{{ asset(Helper::getGeneralSettings('site_logo')) }}" alt="{{ trans('lang.site_logo') }}"></a></strong>
        </figure> -->--}}
        <!-- <div class="dc-companysinfo">
            <figure><img src="{{ asset(Helper::getImage('uploads/users/'.Auth::user()->id, Auth::user()->profile->avatar)) }}" alt="{{ trans('lang.img_desc') }}"></figure>
            <div class="dc-title">
                <h2><a href="{{ $profile_link }}"> {{ Helper::getUserName(Auth::user()->id) }}</a></h2>
                <span>@ {{ Auth::user()->slug }} <i class="fa fa-clone"></i></span>
            </div>
        </div> -->
    </div>
    <nav class="dc-navdashboard" style="height: 100%;">
        <ul style="margin-top: 70px;">
           {{ Helper::displayDashboardMenu('profile') }}
           <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('profile-logout-form').submit();">
            <i class="lnr lnr-exit"></i>{{{trans('lang.logout')}}}
            </a>
            <form id="profile-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            </li>
        </ul>
    </nav>
  
</div>
<script>
//     var setDefaultActive = function() {
//     var path = window.location.pathname;

//     var element = document.querySelector(".dc-navdashboard > a[href='" + path + "']");
//     console.log('asdfasdf',element);
//     element.classList.add("active");
// }

// setDefaultActive()
// var path = window.location.pathname;
// var fullpath = path;
// var anchor_val = '[href="'+fullpath+'"]';
// function scrollToAnchor(anchor_val) {
//   alert("" + anchor_val);
//   var e = document.querySelectorAll(anchor_val);
//   console.log('1234',e);
//     for (var i = 0; i < e.length; ++i) {
//        e[i].classList.add('active');
//     }
// }
// scrollToAnchor(anchor_val)
</script>
<style>
    
.sideBar_menu {
    /* -webkit-box-shadow: 0 9px 20px 0 rgb(165 165 165 / 50%);
    box-shadow: 0 15px 20px 0 rgb(165 165 165 / 50%);
    */
    display: inline-block;
    background-color: #fff;
}
.sideBar_menu ul li {
    border-top: 1px solid #eee;
}
.sideBar_menu ul li a {
    color: var(--terthemecolor);
    display: block;
    padding: 10px 19px;
    line-height: inherit;
    position: relative;
}
.sideBar_menu ul li a i {
    color: #999;
    font-size: 14px;
    min-width: 28px;
    line-height: inherit;
    display: inline-block;
    vertical-align: middle;
}

.sideBar_menu ul li {
    width: 100%;
    float: left;
    position: relative;
    line-height: inherit;
    list-style-type: none;
}
</style>
