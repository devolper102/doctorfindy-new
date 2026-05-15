<template>
  <div>
    <header>
      <nav class="navbar navbar-expand navbar-light admin_header topbar static-top shadow w-100" id="vueFullHeader" @scroll="handleSCroll">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-lg-none rounded-circle ml-0" @click="toggleSortDirection()">
          <i id="menu-bars" class="fa fa-bars" aria-hidden="true"></i>
        </button>
        <div class="admin_logo">
          <div class="text-center d-none d-md-inline mt-4 float-left">
            <button class="rounded-circle border-0" id="sidebarToggle" @click="toggleFunction()"></button>
            
          </div>
          <a class="sidebar-brand d-inline-block float-left mt-4" href="/">
            <!-- <div class="sidebar-brand-icon rotate-n-15">
              <i class="fas fa-laugh-wink"></i>
            </div> -->
            <div class="sidebar-brand-text mx-3 w-25 logo-brand-image">
              <img v-lazy="'/uploads/settings/general/'+ main_logo" alt="Site Logo" name="Site Logo" />
            </div>
          </a>
        </div>
        <!-- Topbar Search -->
     <!--    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
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
        </form> -->

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

          <!-- Nav Item - Search Dropdown (Visible Only XS) -->
          <li class="nav-item dropdown no-arrow d-sm-none">
            <!-- <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-search fa-fw" aria-hidden="true"></i>
            </a> -->
            <!-- Dropdown - Messages -->
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
          </li>
          <!-- <div class="topbar-divider d-none d-sm-block"></div> -->

          <!-- Nav Item - User Information -->
          <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img v-if="doctor.profile.avatar" v-lazy="'/uploads/users/'+doctor.id+'/'+doctor.profile.avatar" class="img-profile rounded-circle" :alt="doctor.first_name +' '+ doctor.last_name">
          <img v-else v-lazy="'/uploads/users/default/doctor.svg'" class="img-profile rounded-circle" alt="user Image">
              <span class="ml-2 d-none d-lg-inline text-gray-600 small user_name">{{doctor.first_name}} {{doctor.last_name}}</span>
              <p class="ml-2 d-none d-lg-inline text-gray-600 small user_identy position-absolute"> Doctor</p>

            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="/doctor/profile-settings">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400" aria-hidden="true"></i>
                Profile
              </a>
              <a class="dropdown-item" href="/profile/settings/account-settings">
                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400" aria-hidden="true"></i>
                Settings
              </a>
<!--               <a class="dropdown-item" href="#">
                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400" aria-hidden="true"></i>
                Activity Log
              </a> -->
              <div class="dropdown-divider"></div>
              <a class="dropdown-item"  @click="logout()">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400" aria-hidden="true"></i>
                Logout
              </a>
            </div>
          </li>

        </ul>

      </nav>
    </header>
  </div>
</template>
<script>
export default {
  name: "HeaderComponent",
  props: ['managements','doctor'],
  data() {
    return {
     site_logo: '' ,
    }
  },
  created (){
       this.site_logo = this.managements.find(pf =>pf.meta_key ==='general_settings')
       this.main_logo = JSON.parse(this.site_logo.meta_value).site_logo;
      window.addEventListener('scroll', this.handleSCroll);
  },
  destroyed () {
    window.removeEventListener('scroll', this.handleSCroll);
  },

  methods: {
    logout() {
      axios.post(APP_URL + '/logout')
          .then(function (response) {
              window.location = APP_URL

          })
          .catch(function (error) {

          })
    },
    toggleSortDirection() {
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
    },
    toggleFunction(){
      var elementcheck = document.getElementsByClassName("dashboard_inner");
      elementcheck[0].classList.toggle("layout_main");
    },
    handleSCroll (event) {
        let header = document.querySelector("#vueFullHeader");
        if (window.scrollY > 10) {
          header.classList.add('sticky');
        }else{
          header.classList.remove('sticky');
        } 
      },
  }


}


</script>

<style scoped>
.sticky {
    position: fixed !important;
    top: 0;
    left: 0;
    animation: smoothScroll 0.5s forwards;
    z-index: 999;
  }
</style>