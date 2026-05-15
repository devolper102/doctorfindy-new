<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Register - Join DoctorFindy</title>
    <meta name="title" content="An online doctor booking platform">
    <meta name="description" content="Book Appointment From Home Or Get Online Audio / Video Consultation With Pakistan">
    <meta charset="UTF-8">
    <meta name="description" content="Book a Doctor">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="DoctorFindy">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset(Helper::getGeneralSettings('site_favicon')) }}" type="image/x-icon">
    <link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/register.min.css') }}" >
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

<div id="register">
    <register-component
        :sign_up_section = "{{json_encode($sign_up_section, true)}}"
        :site_logo = "{{json_encode($site_logo, true)}}"
    ></register-component>
</div>
<script type="text/javascript" defer  src="{{ asset('js/register.min.js') }}"></script>

</body>
</html>