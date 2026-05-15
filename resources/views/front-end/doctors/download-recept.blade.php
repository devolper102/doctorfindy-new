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
                        color: #3d4461;">Appointment receipt</h1>
                    </td>
                </tr>
            </table>
        </div>
        </header> -->

        <!-- <footer style="border-top: 1px solid #eee; text-align: center;margin-top: 80px;padding: 20px 0;">
            <span style="display: block;font-size: 16px;color: #3d4461;line-height: 20px;">
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
                <th style="width:15%; padding: 15px 20px;background: #f5f5f5; font-size:14px;">Patient Name</th>
                <th style="width:10%; padding: 15px 20px;background: #f5f5f5; font-size:14px;">Doctor Name</th>
                <th style="width:10%; padding: 15px 20px;background: #f5f5f5; font-size:14px;word-wrap:break-word;">Time</th>
                <th style="width:30%; padding: 15px 20px;background: #f5f5f5; font-size:14px;word-wrap:break-word;">Date</th>
                <th style="width:15%; padding: 15px 20px;background: #f5f5f5; font-size:14px;">Amount</th>
            </tr>
        </thead>
        
            <tbody>
                
                    <tr>
                        <td style="padding: 15px 20px;border-top: 1px solid #e2e2e2; font-size:14px;">{{$get_data->patient_profile->first_name}}{{$get_data->patient_profile->last_name}}</td>
                        <td style="padding: 15px 20px;border-top: 1px solid #e2e2e2; font-size:14px;">{{$get_data->doctor_profile->first_name}}{{$get_data->doctor_profile->last_name}}</td>
                        <td style="padding: 15px 20px;border-top: 1px solid #e2e2e2; font-size:14px;">
                            {{$get_data->appointment_time}}
                        </td>
                        <td style="padding: 15px 20px;border-top: 1px solid #e2e2e2;word-wrap:break-word; font-size:14px;">
                            {{$get_data->appointment_date}}
                        </td>
                        <td style="padding: 15px 20px;border-top: 1px solid #e2e2e2; font-size:14px;">{{$get_data->charges}}
                        </td>
                    </tr>
                   
            </tbody>
      
    </table> --}}
    <div class="container" style="max-width:1100px;

    padding-left:15px; padding-right:15px;margin:0 auto;
    display: block;">
        <div class="logo" style="width:100%;display: inline-block;
        margin-top:10px;">
            
                <img src="{{ asset('images/doctorfindy.png')}}" alt="DoctorFindy" name="DoctorFindy" />
               {{--  <img src="images/Madilyn.jpg" alt="logo picture" style="width:80px;
                    height: 80px;border-radius:50%;"> --}}
            
        </div>
        <div class="appointment" style="width:100%;display:inline-block;text-align: center;">
            <h1 style="font-size: 26px;line-height: 26px;
            margin:40px 0 0 0px;font-weight: 500;
            color: #3d4461;">Appointment receipt</h1>
        </div>
        <div class="main-doctor-image-profile" 
        style="width: 50%;margin:30px auto 0;
        display:block;">
            <div class="book-doctor-image" 
            style="width:25%;
            display:inline-block;float:left;">
                   {{--  <img style="width:80px;
                    height: 80px;border-radius:50%;"src="{{{asset(Helper::getImage('uploads/users/'.$get_data->user_id,  $get_data->doctor_profile->profile->avatar, 'medium-', 'user.jpg'))}}}" alt="User Image"> --}}
               {{-- <img src="images/Madilyn.jpg" alt="logo picture" style="width:80px;
                    height: 80px;border-radius:50%;"> --}}
                    <img src="{{ asset('uploads/users/default/doctor.svg')}}" alt="Doctor image" name="Doctor image" style="width:80px;
                    height: 80px;border-radius:50%;"/>
            </div>
            <div class="prfile-detail"
            style="width:75%;display: inline-block;">
                <h5 style="margin:0;font-size:20px;">
                    {{$get_data->doctor_profile->first_name}}{{$get_data->doctor_profile->last_name}}
                    <!-- <span>
                        <img src="images/check.png" alt="check picture">
                    </span>
                    <span>
                        <img src="images/shield.png" alt="check picture">
                    </span> -->
                </h5>
                <div class="doctor_degree text_black">
                    <p style="font-size:14px;
                    margin:10px 0 0 0"> Excellent Doctor! Most trust worthy and amazing experienced </p> 
                    <p class="doctor_specality" style="font-size:14px;
                    margin:5px 0 0 0">
                    @foreach($get_data->doctor_profile->specialities as $speciality)
                            {{$speciality->title}} <span class="comma">,</span>
                    @endforeach
                    </p>
                </div>
            </div>
        </div>
        <div class="hospital-details" style="width:100%;
        display: inline-block;text-align: center;">
            <p style="font-size: 25px;font-weight: bold;
            margin: 10px 0 5px 0;">
                Congratulations!
            </p>
            <p style="font-size: 14px;font-weight: bold;
            border-bottom: 1px solid #000;
            padding-bottom:8px;">
                Your Appointment is Pending
                <span>
                    <a  style="font-weight: bold;color: #ff465c;
                    text-decoration: none;">
                    {{$get_data->doctor_profile->first_name}}{{$get_data->doctor_profile->last_name}}
                    </a>
                </span>
                Our team will contact you for Confirmation.
            </p>
        </div>
        <div class="verification-text-phone-number"
        style="width:100%;display:inline-block;
        padding: 10px 0 10px 40px;">
            <div class="patient_summary" 
            style="padding-bottom: 8px;">
                <span style="width:50%;font-size:17px;font-weight: bold;display: inline-block;">
                    <img src="images/rs.png" alt="rs picture" class="img-fluid"> Price
                </span> 
                    <span style="width:40%;font-size:20px;
                    float: right;">{{$get_data->charges}}
                    </span>
            </div> 
            <div class="patient_summary" 
            style="padding-bottom: 8px;">
                <span style="width:50%;font-size:17px;font-weight: bold;display: inline-block;">
                   <img src="images/date-image.png" alt="date-image picture" class="img-fluid"> Date
                </span> 
                    <span style="width:40%;font-size:20px;
                    float: right;">{{$get_data->appointment_date}}</span>
            </div> 
            <div class="patient_summary" 
            style="padding-bottom: 8px;">
                <span style="width:50%;font-size:17px;font-weight: bold;display: inline-block;">
                   <img src="images/time-image.png" alt="time-image picture" class="img-fluid"> Time
                </span> 
                <span style="width:40%;font-size:17px;
                    float: right;">{{$get_data->appointment_time}}
                </span>
            </div> 
            <div class="patient_summary" 
            style="padding-bottom: 8px;">
                <span style="width:50%;font-size:17px;font-weight: bold;display: inline-block;">
                  <img src="images/address-image.png" alt="address-image picture" class="img-fluid"> Address
                </span> 
                <span style="width:40%;font-size:17px;
                    float: right;">
                    @if($get_data->hospital_id === 0)
                    Online
                    @else
                    {{$get_data->hospital_profile->first_name}}{{$get_data->hospital_profile->last_name}}
                    @endif
                </span>
            </div>
        </div>
    </div>
</main>
<footer style="border-top: 1px solid #eee; text-align: center;margin-top:25px;padding: 20px 0;">
            <span style="display: block;font-size: 16px;color: #3d4461;line-height: 20px;margin-top:8px;">
                This is a computer generated patient appointment slip
            </span>
        </footer>
</body>
</html>
