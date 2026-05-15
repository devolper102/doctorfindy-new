@extends('master')
@push('PackageStyle')
<link href="{{ asset('css/antd.css') }}" rel="stylesheet">
@endpush
@push('stylesheets')
@stack('backend_stylesheets')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" type="text/css">
{{-- 
<link rel="stylesheet" type="text/css" href="{{ asset('css/knockdoc_adminPannel.css') }}">
--}}
<link href="{{ asset('css/dbresponsive.css') }}" rel="stylesheet" type="text/css">
 <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
<link href="{{ asset('css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/emojionearea.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/scrollbar.css') }}" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
   var APP_URL = {!! json_encode(url('/')) !!}
</script>
 <script src="https://cdn.tiny.cloud/1/xk4t6adscjvw7vlnk1dv6i3usgkfsx7yhw3mbskl7pphsbjf/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
{{--    
<link href="{{ asset('css/linearicons.css') }}" rel="stylesheet">
<link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
<link href="{{ asset('css/rtl.css') }}" rel="stylesheet">
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
<link href="{{ asset('css/transitions.css') }}" rel="stylesheet">
<link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/themify-icons.css') }}" rel="stylesheet">
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
<link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap4.css') }}" rel="stylesheet">
--}}
<link href="{{ asset('css/bootstrap4.css') }}" rel="stylesheet">
@php
$role_type = Helper::getRoleTypeByUserID(Auth::user()->id);
@endphp
@if($role_type !== 'admin')
<link href="{{ asset('css/knockdoc_adminPannel.css') }}" rel="stylesheet">
@endif
@endpush
@section('main')
<body>
    <audio id="my-notification" autoplay="false" hidden controls muted>
      <source src="{{ asset('audio/alert.mp3') }}" type="audio/mpeg">
   </audio>
</body>
@yield('header')
@php
$role_type = Helper::getRoleTypeByUserID(Auth::user()->id);
$site_logo =  Helper::getGeneralSettings('site_logo');
@endphp
@yield('banner')

@if($role_type !== 'admin')

@endif
@yield('footer')
@endsection
@push('scripts')
@stack('backend_scripts')
@yield('bootstrap_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.0.4/popper.js"></script>
{{--<script src="{{ asset('js/scrollbar.min.js') }}"></script>--}}
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/cropperjs"></script>
<script src="https://unpkg.com/dropzone"></script>
<script type="text/javascript">
   $(window).scroll(function () {          
       var $pscroll = $(window).scrollTop();                       
           if($pscroll > 76) {
            $('.dc-sidebarwrapper').addClass('dc-fixednav');
           }else{
            $('.dc-sidebarwrapper').removeClass('dc-fixednav');
           }
       });
</script>
{{--<script src="{{ asset('js/app.js') }}"></script>--}}
{{--<script src="{{ asset('js/vendor/jquery-library.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
<!-- <script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
   CKEDITOR.replace( 'description' );
</script>
<script>
   CKEDITOR.replace( 'faq_procedure' );
</script> -->
<!-- <script src="node_modules/tinymce/tinymce.min.js"></script>
<link rel="stylesheet" href="node_modules/tinymce/skins/content/default/content.min.css"> -->
  <!-- <script src="https://cdn.tiny.cloud/1/xk4t6adscjvw7vlnk1dv6i3usgkfsx7yhw3mbskl7pphsbjf/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    // Define the common configuration options
    const commonConfig = {
        plugins: 'directionality   anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount   fullscreen ',
        toolbar: 'ltr rtl | fullscreen | undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        paste_as_text: false, // Retain formatting when pasting
        forced_root_block: false,
    };

    // Initialize the first instance of TinyMCE
    document.addEventListener("DOMContentLoaded", function() {
        tinymce.init({
            selector: '#description',
            ...commonConfig,
        });
   
    // Initialize the second instance of TinyMCE
    tinymce.init({
        selector: '#faq_procedure',
        ...commonConfig,

    });
     tinymce.init({
        selector: '#urdu_decription',
        ...commonConfig,

    });
     });
</script> -->
<!-- <script>
        tinymce.PluginManager.add('customfont', function(editor, url) {
            // Define the font families you want to add
            var fontFamilies = [
                { text: 'Open Sans', value: 'Open Sans, sans-serif' },
                // Add more fonts here if needed
            ];

            // Register a custom menu item for fonts
            editor.ui.registry.addMenuItem('customfont', {
                text: 'Font',
                icon: 'font',
                menu: fontFamilies.map(function(font) {
                    return {
                        text: font.text,
                        icon: 'font',
                        onAction: function() {
                            editor.execCommand('fontName', false, font.value);
                        }
                    };
                })
            });

            // Add the custom menu item to the toolbar
            editor.ui.registry.addButton('customfont', {
                icon: 'font',
                tooltip: 'Font',
                onAction: function() {
                    editor.execCommand('fontName', true, 'Open Sans');
                }
            });
        });


        // Initialize TinyMCE
        tinymce.init({
            selector: '#description',
            plugins: 'customfont',
            toolbar: 'customfont | formatselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | removeformat',
            content_style: 'body { font-family: "Open Sans", sans-serif; }',
            // Other configuration options
        });
    </script> -->
    <script>
    // Define the common configuration options
    const commonConfig = {
        plugins: 'directionality anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount fullscreen customfont', // Add 'customfont' to the list of plugins
        toolbar: 'ltr rtl | fullscreen | undo redo | blocks fontfamily fontsizeinput | bold italic underline strikethrough | link image media table mergetags | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat customfont', // Add 'customfont' to the toolbar
        paste_as_text: false, // Retain formatting when pasting
        forced_root_block: false,
        
        
    };

    // Define the custom font plugin
    tinymce.PluginManager.add('customfont', function(editor, url) {
        // Define the font families you want to add
        var fontFamilies = [
            { text: 'Open Sans', value: 'Open Sans, sans-serif' },
            // Add more fonts here if needed
        ];

        // Register a custom menu item for fonts
        editor.ui.registry.addMenuItem('customfont', {
            text: 'Font',
            icon: 'font',
            menu: fontFamilies.map(function(font) {
                return {
                    text: font.text,
                    icon: 'font',
                    onAction: function() {
                        editor.execCommand('fontName', false, font.value);
                    }
                };
            })
        });

        // Add the custom menu item to the toolbar
        editor.ui.registry.addButton('customfont', {
            icon: 'font',
            tooltip: 'Font',
            onAction: function() {
                editor.execCommand('fontName', true, 'Open Sans');
            }
        });
    });

    // Initialize TinyMCE for all instances
    document.addEventListener("DOMContentLoaded", function() {
        tinymce.init({
            selector: '#description',
            ...commonConfig,
        });

        tinymce.init({
            selector: '#faq_procedure',
            ...commonConfig,
        });

        tinymce.init({
            selector: '#urdu_decription',
            ...commonConfig,
        });
    });
</script>


<!-- CkEditor -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/markerclustererplus/2.1.4/markerclusterer.js"></script>
--}}
<script src='https://maps.googleapis.com/maps/api/js?v=3&sensor=false&amp;libraries=places&key=AIzaSyCTtKFT6ROLiapWLQf-ATNCdy5fn_VJ68s'></script>
<script>
   $(document).ready(function() {
        $("#lat_area").addClass("d-none");
        $("#long_area").addClass("d-none");
   });
</script>
<script>
   google.maps.event.addDomListener(window, 'load', initialize);
   
   function initialize() {
       console.log('hello world: ')
       var input = document.getElementById('autocomplete');
       // var options = {types: ['(areas)']}
       /*autocomplete.setComponentRestrictions(
            {'country': ['pk']});*/
   
       var options = {
           types: ['(cities)'],
           componentRestrictions: {country: "pk"}
       };
       var autocomplete = new google.maps.places.Autocomplete(input, options);
   
       autocomplete.addListener('place_changed', function() {
           var place = autocomplete.getPlace();
           console.log(place.address_components)
           place.address_components.forEach( function (x, index){
               if (index === 0) {
                   $('#autocomplete').val(x.long_name)
               }
               console.log(x, index)
           })
           $('#address_lat').val(place.geometry['location'].lat());
           $('#address_long').val(place.geometry['location'].lng());
       });
       console.log(autocomplete)
   }
   
   
   $("#bankCard").click(function(e) {
   
    
    var form = $(this).parents('form');
   
    var CardNo = $('#cc-number').val();
    var regCardNo = /^[0-9]{09,16}$/;
    var regibanCardNo = /^[0-9]{00,24}$/;
    var bankName = $('#x_bank').val();
    var ibanName = $('#x_iban').val();
    var bankTitle = $('#x_title').val();
    
    if (form[0].checkValidity() === false) {
      e.preventDefault();
      e.stopPropagation();
    }
    else {
       if (!regCardNo.test(CardNo)) {
       
        $("#cc-number").addClass('required');
        $("#cc-number").focus();
        alert(" Enter a valid 12 to 16 card number");
        return false;
      } else if(ibanName !=''){
        
        var valid = isValidIBANNumber(ibanName);
        if(valid == false){
          $("#x_iban").addClass('required');
          $("#x_iban").focus();
          alert(" Enter a valid 24 digit IBAN number");
          return false;
        }
   
      }else if (bankName == '')
      {
       $("#x_bank").addClass('required');
        $("#x_bank").focus();
        alert("Bank name required");
        return false; 
      } else if (bankTitle == '')
      {
       $("#x_title").addClass('required');
        $("#x_title").focus();
        alert("Account title required");
        return false; 
      } 
      
      
    }
    
    form.addClass('was-validated');
   });
   
   
   
    /*
     * Returns 1 if the IBAN is valid 
     * Returns FALSE if the IBAN's length is not as should be (for CY the IBAN Should be 28 chars long starting with CY )
     * Returns any other number (checksum) when the IBAN is invalid (check digits do not match)
     */
    function isValidIBANNumber(input) {
        var CODE_LENGTHS = {
            AD: 24, AE: 23, AT: 20, AZ: 28, BA: 20, BE: 16, BG: 22, BH: 22, BR: 29,
            CH: 21, CR: 21, CY: 28, CZ: 24, DE: 22, DK: 18, DO: 28, EE: 20, ES: 24,
            FI: 18, FO: 18, FR: 27, GB: 22, GI: 23, GL: 18, GR: 27, GT: 28, HR: 21,
            HU: 28, IE: 22, IL: 23, IS: 26, IT: 27, JO: 30, KW: 30, KZ: 20, LB: 28,
            LI: 21, LT: 20, LU: 20, LV: 21, MC: 27, MD: 24, ME: 22, MK: 19, MR: 27,
            MT: 31, MU: 30, NL: 18, NO: 15, PK: 24, PL: 28, PS: 29, PT: 25, QA: 29,
            RO: 24, RS: 22, SA: 24, SE: 24, SI: 19, SK: 24, SM: 27, TN: 24, TR: 26
        };
        var iban = String(input).toUpperCase().replace(/[^A-Z0-9]/g, ''), // keep only alphanumeric characters
                code = iban.match(/^([A-Z]{2})(\d{2})([A-Z\d]+)$/), // match and capture (1) the country code, (2) the check digits, and (3) the rest
                digits;
        // check syntax and length
        if (!code || iban.length !== CODE_LENGTHS[code[1]]) {
            return false;
        }
        // rearrange country code and check digits, and convert chars to ints
        digits = (code[3] + code[1] + code[2]).replace(/[A-Z]/g, function (letter) {
            return letter.charCodeAt(0) - 55;
        });
        // final check
        return mod97(digits);
    }
    function mod97(string) {
        var checksum = string.slice(0, 2), fragment;
        for (var offset = 2; offset < string.length; offset += 7) {
            fragment = String(checksum) + string.substring(offset, offset + 7);
            checksum = parseInt(fragment, 10) % 97;
        }
        return checksum;
    }
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
          global:false,
          url: base+"/get_appointment_notification_alert",
          dataType: "json",
          success:function(response){
            if(response.count > 0)
            {
               playAudio(response);
            }

          },
          beforeSend: function () {
                    $("#loading").hide();
                },
                complete: function () {
                    $("#loading").hide();
                }
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
<link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/highlight.min.js"></script>
@endpush