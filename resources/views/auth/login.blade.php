
<!DOCTYPE HTML >
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Login - Join DoctorFindy</title>
    <meta name="title" content="Login and Check youor Health">
    <meta name="description" content="Book Appointment From Home Or Get Online Audio / Video Consultation With Pakistan">
     <link rel="icon" href="{{ asset(Helper::getGeneralSettings('site_favicon')) }}" type="image/x-icon">
     <link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/login.min.css') }}" >
            <script type="text/javascript" defer src="{{asset('js/frontend/kitfontawesome.js')}}" crossorigin="anonymous"></script>
    <script>
      var APP_URL = <?php echo json_encode(url('/')); ?>
    </script>
</head>
<body>
  @php
        $sign_up_section = !empty(App\SiteManagement::where('meta_key', 'sign_up_section')->first()) ? App\SiteManagement::where('meta_key', 'sign_up_section')->first() : [];
        $site_logo = !empty(App\SiteManagement::where('meta_key', 'general_settings')->first()) ? App\SiteManagement::where('meta_key', 'general_settings')->first() : [];
    @endphp

<div id="login">
    <login-component
        :sign_up_section = "{{json_encode($sign_up_section, true)}}"
        :site_logo = "{{json_encode($site_logo, true)}}"
    ></login-component>
</div>
<script type="text/javascript" defer src="{{ asset('js/login.min.js') }}"></script>
<script>
function showPass() {
  var x = document.getElementById("passwordnumber");
  if (x.type === "password") {
    x.type = "text";
    //document.getElementById('changeText').innerHTML ="Hide Password";
    document.getElementById('showEye').innerHTML ="<i class='fa fa-eye' aria-hidden='true'></i>";
  } else {
    x.type = "password";
    //document.getElementById('changeText').innerHTML ="Show Password";
    document.getElementById('showEye').innerHTML ="<i class='fa fa-eye-slash' aria-hidden='true'></i>";
  }
}
</script>
<style>
    #showEye{
        position: absolute;
        bottom: 5px;
        right: 15px;
    }
    #showEye i{
        cursor: pointer;
    }
    .text_14{
        font-size: 14px;
    }
    @media (max-width: 991px){
        .w-md-100{
            width: 100% !important;
        }
    }
    @media (max-width: 767px){
        .w-sm-100{
            width: 100% !important;
        }
    }
</style>
</body>
</html>