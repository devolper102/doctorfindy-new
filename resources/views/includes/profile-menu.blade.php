<!-- <div class="dc-userlogedin dropdown-toggle" type="button" id="user_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <figure class="dc-userimg">
        <img src="{{ asset(Helper::getImage('uploads/users/'.Auth::user()->id, Auth::user()->profile->avatar, 'extra-small-', 'user-login.png')) }}" 
            alt="{{ trans('lang.img_desc') }}">
    </figure>
    <div class="dc-username">
        <h4>{{ Helper::getUserName(Auth::user()->id) }}</h4>
        <span>{{ Helper::getRoleTypeByUserID(Auth::user()->id) }}</span>
       
    </div>

    <nav class="dc-usernav dropdown-menu" aria-labelledby="user_dropdown">
        <ul>
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
    </div> -->
    <div class="dc-userlogedin">
    <figure class="dc-userimg">
        <img src="{{ asset(Helper::getImage('uploads/users/'.Auth::user()->id, Auth::user()->profile->avatar, 'extra-small-', 'user-login.png')) }}"
             alt="{{Auth::user()->profile->avatar}}" alt-text="{{Auth::user()->first_name}}.' '.{{Auth::user()->last_name}}">
    </figure>
    <div class="dc-username">
        <h4>{{ Helper::getUserName(Auth::user()->id) }}</h4>
        <span>{{ Helper::getRoleTypeByUserID(Auth::user()->id) }}</span>
       
    </div>
    <nav class="dc-usernav">
        <ul>
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
{{--
@push('front_end_scripts')

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>

    //if (window.matchMedia('(max-width: 1024px)').matches) {
        /*$(document).ready(function(){
          $("#clicked").click(function(){
            alert('hello')
            $("#toggleed").toggle();
          });
        });*/
    //}
</script>

@endpush--}}
