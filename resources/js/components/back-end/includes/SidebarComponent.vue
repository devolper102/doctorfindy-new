<template>
  <div class="d-flex" id="vueMainSidebar">
    <!--Start Sidebar-->
     

     <ul class="sidebar_dark accordian sidebar navbar-nav vue_sidebar" style="overflow-x:hidden;overflow-y:auto;float:left;" id="accordionSidebar">
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
          <a class="nav-link" href="/doctor/dashboard">
            <i class="fas fa-th-large"></i>
            <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <!-- <hr class="sidebar-divider"> -->

        <!-- Heading -->
        <!-- <div class="sidebar-heading">
          Interface
        </div> -->
        <li class="nav-item">
          <a class="nav-link" href="/doctor/appointments">
            <i class="fas fa-user-friends"></i>
            <span>My Appointments </span></a>
        </li>
<!--         <li class="nav-item">
          <a class="nav-link" href="javascript:void(0)">
            <i class="fas fa-envelope"></i>
            <span>Inbox</span></a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" href="/doctor/all-appointments">
            <i class="fas fa-calendar-alt"></i>
            <span>Appointments List</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/doctor/all-appointments-notification">
            <i class="fas fa-calendar-alt"></i>
            <span>Appointments Notification</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/appointment-settings">
            <i class="fas fa-cogs"></i>
            <span>Appointment Settings</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/doctor/profile-settings">
            <i class="fas fa-user-cog"></i>
            <span>Profile Setting</span></a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="/profile/settings/account-settings">
            <i class="fas fa-user-cog"></i>
            <span>Security Setting</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/doctor/blogs">
            <i class="fas fa-newspaper"></i>
            <span>Blogs</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/doctor/orders-settings">
            <i class="fas fa-money-check"></i>
            <span>Payout Settings</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" @click="logout()">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span></a>
        </li>
   <!--      <li class="nav-item">
          <a class="nav-link" href="javascript:void(0)">
            <i class="fas fa-sign-in-alt"></i>
            <span>Log In</span></a>
        </li> -->
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
    <!--End Sidebar-->
  </div>
</template>

<script>
export default {
name: "SidebarComponent",
  methods: {
    logout() {
      axios.post(APP_URL + '/logout')
          .then(function (response) {
              window.location = APP_URL

          })
          .catch(function (error) {

          })
    },
}
}
</script>

<style scoped>

</style>