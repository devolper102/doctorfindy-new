<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @if (trim($__env->yieldContent('title')))
        <title>@yield('title')</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif
    <link rel="icon" href="{{ asset(Helper::getGeneralSettings('site_favicon')) }}" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="{{asset('css/frontend/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/frontend/bootstrap-grid.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/frontend/bootstrap-reboot.min.css')}}">
    <link href="{{ asset('css/frontend/custom-checkbox.css') }}" rel="stylesheet">
    <link href="{{ asset('css/backend/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/utilities.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-family.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend/footer.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/0904c46e05.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
      const APP_URL = {!! json_encode(url('/')) !!};
    </script>
</head>
<body>

<div id="dashboard">

    <!-- Page Wrapper -->
    <div id="wrapper">


        <!-- Content Wrapper -->
        <appointment-listing
                :doctor="{{ $doctor }}"
                :managements="{{ $managements }}"
        ></appointment-listing>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

</div>

<script type="text/javascript" src="{{asset('js/frontend/bootstrap.bundle.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/frontend/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/frontend/knockdoc.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dashboard.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
    document.getElementById("sidebarToggleTop").addEventListener("click",function()
{

var headermain=document.getElementById("accordionSidebar");
if(headermain.style.display=="block")
{
    headermain.style.display="none";
}
else
{
    headermain.style.display="block";
}
});
</script>
</body>
</html>
   