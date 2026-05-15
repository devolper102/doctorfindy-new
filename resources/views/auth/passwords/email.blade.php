<!DOCTYPE html>
<html>
<head>
    <title> Forgot password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

<!-- Start forgot you password -->
<section class="forgot-you-password">
    <div class="container">
        <div class="reset_main text-center">
            <div class="d-inline-block">
                <div class="forgot-password-image mt-5 text-center text-lg-left w-80 m-auto">
                    <img src="{{asset('images/forgot-password-image.png')}}" alt=" picture">
                </div>
                <div class="welcome-login-text mt-3 text-left">
							<span class="text_black font-weight-bold text_30">
							Forgot your password?
						    </span>
                    <p class="text_black text_14">Enter your email address below and we'll send you reset password link.
                    </p>
                </div>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group mt-3 mb-2 d-inline-block w-100 text-left">
                        <label class="email_text text_black font-weight-bold">Email address
                        </label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror specialities-background" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus placeholder="Enter Your Email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror       
                    </div>
                    <div class="signup-button mt-2">
                        <button type="submit" class="text_16 knockdoc_btn_bg text-white border-0 w-100 font-weight-bold">Send</button>
                    </div>
                </form>
                <div class="signup-button mt-2 mb-4">
                    <a href="/login" class="text_16 knockdoc_btn_bg text-white w-100 font-weight-bold return_btn d-inline-block text-center">
                        Return to log in
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End forgot you password -->


<script type="text/javascript" src="{{asset('js/frontend/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/frontend/bootstrap.bundle.min.js')}}"> 
</script>
<script type="text/javascript" src="{{asset('js/frontend/bootstrap.min.js')}}"></script>
</body>
</html>
