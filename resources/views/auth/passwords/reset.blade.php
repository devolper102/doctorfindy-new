<!DOCTYPE html>
<html>
<head>
    <title> Forgot password</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/frontend/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/frontend/bootstrap-grid.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/frontend/bootstrap-reboot.min.css')}}">
    <link href="{{ asset('css/frontend/custom-checkbox.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend/procedures.css') }}" rel="stylesheet">
    <link href="{{ asset('css/utilities.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend/mobile-responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend/footer.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/0904c46e05.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
      var APP_URL = {!! json_encode(url('/')) !!}
    </script>
</head>
<body>

<!-- Start section new password -->
<section class="new-password">
    <div class="container">
        <div class="w-40 m-auto w-sm-100">
            <div class="w-100 d-inline-block">
                <div class="forgot-password-image mt-5 text-center w-100">
                    <img src="{{asset('images/new-password-image.png')}}" alt=" picture">
                </div>

                <div class="text-center m-auto">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                        <div class="welcome-login-text mt-4 float-left d-block">
                            <span class="text_black font-weight-bold text_30">Enter new password</span>
                        </div>
                        <div class="form-group d-block mb-1">
                            <label class="text_black text_13 font-weight-bold float-left">
                                New Password </label>
                            <input name="password" type="password" class="form-control specialities-background" placeholder="" id="password">
                        </div>
                        <div class="form-group d-block mb-2">
                            <label class="text_black text_13 font-weight-bold float-left">Re-type Password </label>
                            <input name="password_confirmation" type="password" class="form-control specialities-background" placeholder="" id="password_confirmation">
                        </div>
                        <div class="signup-button mt-3 mb-4 text-center">
                            <button class="text_16 knockdoc_btn_bg text-white border-0 w-100 font-weight-bold" type="submit">Submit </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End section new password -->

<script type="text/javascript" src="{{asset('js/frontend/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/frontend/bootstrap.bundle.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/frontend/bootstrap.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
  $('.select2').select2();
</script>
</body>
</html>

