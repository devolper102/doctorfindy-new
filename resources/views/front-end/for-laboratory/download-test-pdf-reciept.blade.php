<div>
    @php
         $testData = json_decode($get_data->test_id);
         @endphp
    <h1>Congratulations! <span class="font-weight-bold text-capitalize">{{$get_data->full_name}}</span></h1>
    
     <p class="doctor_specality" style="font-size:14px;
                    margin:5px 0 0 0">
                    @foreach($testData as $speciality)
                           You have successfully Booked {{$speciality->name}} <span class="comma">,</span>
                    @endforeach
                    </p> 
     <p>with {{$get_data->lab->first_name}} {{$get_data->lab->last_name}} Soon we will get back to you. Test Details are Below:
    </p>
    <p class="doctor_specality" style="font-size:14px;
                    margin:5px 0 0 0">
                    @foreach($testData as $speciality)
                         Test Name:   {{$speciality->name}} <span class="comma">,</span><br>
                         Test price:   {{$speciality->price}} <span class="comma">,</span><br>
                         Test Date:   {{$get_data->date_preferred}} <span class="comma">,</span>
                    @endforeach
                    </p>
</div>