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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript">
      const APP_URL = {!! json_encode(url('/')) !!};
    </script>
</head>
<body>
 <audio id="my-notification" autoplay="false" hidden controls muted>
      <source src="{{ asset('audio/alert.mp3') }}" type="audio/mpeg">
   </audio>
<div id="dashboard">

    <!-- Page Wrapper -->
    <div id="wrapper" class="position-relative">
        
        <!-- Content Wrapper -->
        <doctor-dashboard
                :doctor="{{ $doctor }}"
                :doctors="{{ $doctors }}"
                :hospitals="{{ $hospitals }}"
                :managements="{{ $managements }}"
        ></doctor-dashboard>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

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
<script>
   setInterval(function(){
   jQuery(document).ready(function() {
          toastr.options = {
          "closeButton": true,
          "newestOnTop": true,
          "positionClass": "toast-top-right"
        };
       var url      = window.location.href;
       var base      = window.location.origin;
       $.ajax({
          type: "GET",
          url: base+"/get_appointment_notification_alert",
          dataType: "json",
          success:function(response){
            if(response.count > 0)
            {
               playAudio(response);
            }

          },
       });
   });
   function playAudio(response)
       {
           var audio=document.getElementById('my-notification');
           audio.muted=false;
           audio.play();
           var message=response.count+' New Appointment Recieved '+response.message;
           toastr.success(message);
       }
    },10000);
</script>
</body>
</html>