<html>
    <head>
        <style>
            @page {
                margin: 10px 0px 50px 0px;
            }
/*
            header {
                position: fixed;
                top: -20px;
                left: 0px;
                right: 0px;
                height: 50px;
                font-family: sans-serif;
                background: url('.$border_image.');
                background-size:1px;
                background-size: 100% 2px;
                background-repeat: no-repeat;
            }*/
           /* footer {
                position: fixed;
                bottom: -39px;
                left: 0px;
                right: 0px;
                height: 50px;
            }*/
            table { border-collapse: collapse; }
            .doctor_specality .comma:last-child{
                display: none;
            }
        </style>
    </head>
    <body>
        <!-- <header >
        <div class="appointment" style="width:100%;display:inline-block;">
            <table >
                <tr>
                    <td>
                        <h1 style="font-size: 26px;line-height: 26px;
                        margin:40px 0 0 85px;font-weight: 500;
                        color: #3D4461;">Appointment receipt</h1>
                    </td>
                </tr>
            </table>
        </div>
        </header> -->
        <!-- <footer style="border-top: 1px solid #eee; text-align: center;margin-top: 80px;padding: 20px 0;">
            <span style="display: block;font-size: 16px;color: #3D4461;line-height: 20px;">
                This is a computer generated patient appointment slip
            </span>
        </footer> -->
<main>
      @php
    $site_logo =  Helper::getGeneralSettings('site_logo');
  @endphp
{{--     <table style="width: 95%; margin: 150px auto 0;font-family: sans-serif;">
        <thead>
            <tr style="text-align: left; border-radius:5px 0 0;">
                <th style="width:15%; padding: 15px 20px;background: #F5F5F5; font-size:14px;">Patient Name</th>
                <th style="width:10%; padding: 15px 20px;background: #F5F5F5; font-size:14px;">Doctor Name</th>
                <th style="width:10%; padding: 15px 20px;background: #F5F5F5; font-size:14px;word-wrap:break-word;">Time</th>
                <th style="width:30%; padding: 15px 20px;background: #F5F5F5; font-size:14px;word-wrap:break-word;">Date</th>
                <th style="width:15%; padding: 15px 20px;background: #F5F5F5; font-size:14px;">Amount</th>
            </tr>
        </thead>
            <tbody>
                    <tr>
                    </tr>
            </tbody>
    </table> --}}
    <div class="container" style="max-width:1100px;
    padding-left:15px; padding-right:15px;margin:0 auto;
    display: block;">
        <div class="logo" style="width:80%;display: block;
        margin-top:10px;float: left;">
                <img src="{{ asset('images/doctorfindy-header-blog-logo.png')}}" alt="DoctorFindy" name="DoctorFindy" />
               {{--  <img src="images/Madilyn.jpg" alt="logo picture" style="width:80px;
                    height: 80px;border-radius:50%;"> --}}
        </div>
        <div class="logo" style="width:20%;float: right;">
            <span style="float: left;">
            <img src="images/logoo.svg" style="width:20px;height: 20px;">
            </span>
            <a href="javascript:void(0)" style="float: left;
            margin-left:30px;color:#000;">
                doctorfindy.com
            </a>
            <span style="float: left;">
            <img src="images/call.jpg" style="width:20px;height: 20px;margin-top: 25px;">
            </span>
            <p style="float:left;margin-top: 25px;margin-left:30px;color:#000;">
               03450435621
            </p>
        </div>
        <div class="appointment" style="width:100%;display:block;text-align: center;">
            <h1 style="font-size: 26px;line-height: 26px;
            margin:40px 0 0 0px;font-weight: 500;
            color: #3D4461;">Discount Receipt</h1>
        </div>
        <div class="hospital-details" style="width:100%;
        display: block;text-align: center;">
             <h1>Congratulations! <span class="font-weight-bold text-capitalize">{{ucfirst($data->name)}}</span></h1>
            <p style="font-size: 14px;font-weight: bold;
            border-bottom: 1px solid #000;
            padding-bottom:8px;">
                You can get <b>20%</b> discount from any chughtai lab all over Pakistan, by showing below information
                <span>
                    <a  style="font-weight: bold;color: #FF465C;
                    text-decoration: none;">
                    </a>
                </span>
            </p>
        </div>
        <div class="verification-text-phone-number"
        style="width:70%;display:block;
        padding: 0;margin:0 auto;">
            <div class="patient_summary"
            style="padding-bottom: 8px;">
                <span style="width:48%;font-size:17px;font-weight: bold;display: inline-block;">
                     Name :
                </span>
                <span style="width:48%;font-size:17px;font-weight: bold;display: inline-block;">
                     {{ucfirst($data->name)}}
                </span>
            </div>
            <div class="patient_summary"
            style="padding-bottom: 8px;">
                <span style="width:48%;font-size:17px;font-weight: bold;display: inline-block;">
                    Phone No :
                </span>
                <span style="width:48%;font-size:17px;font-weight: bold;display: inline-block;">
                    {{$data->phone_number}}
                </span>
            </div>
            <div class="patient_summary"
            style="padding-bottom: 8px;">
                <span style="width:48%;font-size:17px;font-weight: bold;display: inline-block;">
                    Discount Code :
                </span>
                <span style="width:48%;font-size:17px;font-weight: bold;display: inline-block;">
                    {{$data->code}}
                </span>
            </div>
            @if($data->home_sampling === 'yes')

            <div class="patient_summary"
            style="padding-bottom: 8px;">
                <span style="width:48%;font-size:17px;font-weight: bold;display: inline-block;">
                    Age :
                </span>
                <span style="width:48%;font-size:17px;font-weight: bold;display: inline-block;">
                    {{$data->age}}
                </span>
            </div>
            <div class="patient_summary"
            style="padding-bottom: 8px;">
                <span style="width:48%;font-size:17px;font-weight: bold;display: inline-block;">
                    Address :
                </span>
                <span style="width:48%;font-size:17px;font-weight: bold;display: inline-block;">
                    {{ucfirst($data->address)}}
                </span>
            </div>
            <div class="patient_summary"
            style="padding-bottom: 8px;">
                <span style="width:48%;font-size:17px;font-weight: bold;display: inline-block;">
                    Requested Home Sampling :
                </span>
                <span style="width:48%;font-size:17px;font-weight: bold;display: inline-block;">
                    {{ucfirst($data->home_sampling)}}
                </span>
            </div>
            @endif
            <!-- <div class="patient_summary"
            style="padding-bottom: 8px;">
                <span style="width:50%;font-size:17px;font-weight: bold;display: inline-block;">
                  <img src="images/address-image.png" alt="address-image picture" class="img-fluid"> Address
                </span>
            </div> -->
        </div>
    </div>
    <!-- <div style="border-top: 1px solid #eee; text-align: center;margin-top:25px;padding: 20px 0;display: block;">
            <p style="display: block;font-size: 16px;color: #3D4461;line-height: 20px;margin-top:8px;">
                This is a computer generated patient appointment slip
            </p>
        </div> -->
</main>

</body>
</html>