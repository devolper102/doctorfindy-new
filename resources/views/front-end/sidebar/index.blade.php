<aside class="dc-sidebar dc-sidebar-grid float-left mt-lg-0 mt-xl-0">
    @if (Route::currentRouteName() == 'userProfile')
        @include('front-end.sidebar.report-user')
    @endif
    @if (!empty($display_get_app_sec) && $display_get_app_sec == 'true')
        @include('front-end.sidebar.get-mobile-app')
    @endif
    @if (!empty($display_get_ad_sec) && $display_get_ad_sec == 'true')
        @include('front-end.sidebar.advertisement')
    @endif
</aside>
