<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (trim($__env->yieldContent('title')))
        <title>@yield('title')</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif
<meta name="title" content="@yield('meta_title')">
<meta name="description" content="@yield('meta_description')"> 
<meta name="keywords" content="@yield('meta_keywords')"> 

    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="@yield('blog_title')"/>
    <meta property="og:description" content="@yield('blog_description')"/>
    <meta property="og:url" content="@yield('blog_url')"/>
    <meta property="og:site_name" content="DoctorFindy" />
    <meta property="article:published_time" content="@yield('blog_create')" />
    <meta property="article:modified_time" content="@yield('blog_update')" />
    <meta property="og:image" content="@yield('blog_image')" />
    <meta property="og:image:width" content="800" />
    <meta property="og:image:height" content="530" />
    <meta name="facebook-domain-verification" content="72usfjfxxlmapmv83sxgb6s6abwrck" />
    <meta name="image" content="@yield('meta_image')" />
    <meta name="google-site-verification" content="ivRgAetCZHPXs0MRVun0R-CzmEbU4_wanDW_7ZtEay8" />
    <link rel="icon" href="{{ asset(Helper::getGeneralSettings('site_favicon')) }}" type="image/x-icon">
    <link rel="stylesheet" rel=" preload" type="text/css" href="{{ asset('css/font-family.css') }}" >
    <script defer src="https://kit.fontawesome.com/0904c46e05.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
      const APP_URL = {!! json_encode(url('/')) !!};
    </script>

<!-- Global site tag (gtag.js) - Google Analytics -->
{{--<script async src="https://www.googletagmanager.com/gtag/js?id=G-YKSM7QPGLH"></script>--}}

<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5P362P3');</script>

<script defer src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5226038753905201" crossorigin="anonymous"></script>


<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-YKSM7QPGLH');
</script>  
<!-- firebase integration started -->

<!--     <script defer src="https://www.gstatic.com/firebasejs/5.5.9/firebase.js"></script>
    <script defer src="https://www.gstatic.com/firebasejs/5.5.9/firebase-app.js"></script>
    <script defer src="https://www.gstatic.com/firebasejs/5.5.9/firebase-auth.js"></script>
    <script defer src="https://www.gstatic.com/firebasejs/5.5.9/firebase-database.js"></script>
    <script defer src="https://www.gstatic.com/firebasejs/5.5.9/firebase-firestore.js"></script>
    <script defer src="https://www.gstatic.com/firebasejs/5.5.9/firebase-messaging.js"></script>
    <script defer src="https://www.gstatic.com/firebasejs/5.5.9/firebase-functions.js"></script>
 -->
    <!-- firebase integration end -->

    <!-- Comment out (or don't include) services that you don't want to use -->
    <!-- <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-storage.js"></script> -->

    <!-- <script defer src="https://www.gstatic.com/firebasejs/5.5.9/firebase.js"></script>
    <script defer src="https://www.gstatic.com/firebasejs/7.8.0/firebase-analytics.js"></script> --> 

<link rel="canonical" href="{{ url()->current() }}" /> 

</head>
<body>
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5P362P3"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

    
    <div id="recaptcha-container"></div>
    @yield('content')
</body>
<!-- <script>
    // // Your web app's Firebase configuration
                const firebaseConfig = {
                  apiKey: "AIzaSyCp4xWD2jGkSOSkYkgGMRNx0ZJKR9De9sM",
                  authDomain: "doctorfindy-ca476.firebaseapp.com",
                  projectId: "doctorfindy-ca476",
                  storageBucket: "doctorfindy-ca476.appspot.com",
                  messagingSenderId: "394500077394",
                  appId: "1:394500077394:web:06c8724c9933541af16c8b",
                  measurementId: "G-E0PRZJXTJX"
                };

                // Initialize Firebase
                firebase.initializeApp(firebaseConfig);
                //firebase.analytics();
                const messaging = firebase.messaging();
                    messaging
                .requestPermission()
                .then(function () {
                    console.log("Notification permission granted.");
                })
                .catch(function (err) {
                    console.log("Unable to get permission to notify.", err);
                });

                messaging.onMessage(function(payload) {
                    var notify;
                    notify = new Notification(payload.notification.title,{
                        body: payload.notification.body,
                        icon: payload.notification.icon,
                        tag: "Dummy"
                    });
                });
                window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {'size': 'invisible'});
</script> -->
</html>
