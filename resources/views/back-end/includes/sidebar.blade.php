<ul class="navbar-nav sidebar sidebar_dark accordion" id="accordionSidebar">
      <div class="sidebar_inner d-inline-block w-100 text-center">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">
          <!-- <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
          </div> -->
          <div class="text-center d-none d-md-inline mt-4">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
          </div>
          <div class="sidebar-brand-text mx-3">DoctorFindy</div>
        </a>
        </div>
        {{ Helper::getSideBarMenu() }}
    </ul