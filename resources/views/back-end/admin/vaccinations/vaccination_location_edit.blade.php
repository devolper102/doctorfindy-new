@extends('back-end.master')
@push('backend_stylesheets')
<style type="text/css">
	
</style>

@endpush
@section('content')
@include('includes.pre-loader')
    <div class="dc-services" id="services">
    	  @if (Session::has('message'))
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
            </div>
        @elseif (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
            </div>
        @endif
 <section class="dc-haslayout">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-6">
        <div class="dc-dashboardbox">
            <div class="dc-dashboardboxtitle dc-titlewithsearch dc-titlewithdel">
                        	<h2>Edit Vaccination Location</h2>
                            
                <div class="dc-dashboardboxtitle">
                    <form action="{{action('VaccinationLocationController@update',$vaccination_locations->id) }}"method="post"> 
                        {{csrf_field()}}
                        @method('post')
                        <div class="form-group">
                                  <div class="form-group">
                                    <span class="dc-select">
                                    <select name="vaccination_id" id="vaccination_id" class="form-control">
                                       <option value="">Select Vaccination</option>
                                       @foreach ($vaccinations as $key => $vaccination)
                                        <option value="{{$vaccination->id}}"@if($vaccination_locations->vaccination_id == $vaccination->id) selected @endif>{{$vaccination->title}}</option>
                                        @endforeach
                                    </select>
                                </span>
                                    @if ($errors->has('vaccination_id'))  
                                           <p class="text-danger">{{$errors->first('vaccination_id')}}</p>   
                                    @endif
                                </div>
                               <div class="form-group">
                                    <span class="dc-select">
                                    <select name="city" id="city" class="form-control">
                                       <option value="">Select City</option>
                                      @foreach ($locations as $key => $location)
                                        <option value="{{$location->id}}"@if($vaccination_locations->city == $location->id) selected @endif>{{$location->title}}</option>
                                        @endforeach
                                    </select>
                                </span>
                                    @if ($errors->has('city'))  
                                           <p class="text-danger">{{$errors->first('city')}}</p>   
                                    @endif
                                </div> 

                                   <div class="form-group">
                                    <span class="dc-select">
                                    <select name="hospital_id" id="aioConceptName" class="form-control">
                                       <option value="">Select Hospital</option>
                                      @foreach ($hospitals as $key => $hospital)

                                        <option value="{{$hospital->id}}"@if($vaccination_locations->hospital_id == $hospital->id) selected @endif>{{Helper::getUserData($hospital->id)}}</option>
                                        @endforeach
                                        
                                    </select>
                                </span>
                                    @if ($errors->has('hospital_id'))  
                                           <p class="text-danger">{{$errors->first('hospital_id')}}</p>   
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" name="hospital_address"value="{{$vaccination_locations->hospital_address}}" id="hospital_address" class="form-control" placeholder="Hospital Address"readonly="readonly" />
                                </div>
                                <div class="form-group">
                                    <input type="text" name="room" value="{{ $vaccination_locations->room }}"id="tag2" class="form-control" placeholder="Enter room" />
                                    @if ($errors->has('room'))  
                                           <p class="text-danger">{{$errors->first('room')}}</p>   
                                    @endif  
                                </div>
                                <div class="form-group">
                                    <input type="text" name="phone_no"value="{{ $vaccination_locations->phone_no }}" id="tag2" class="form-control" placeholder="Enter Contant"  />
                                    @if ($errors->has('phone_no'))  
                                           <p class="text-danger">{{$errors->first('phone_no')}}</p>   
                                    @endif  
                                </div>
                                  <div class="form-group">
                                   <input type="time" id="start_time" name="start_time"value="{{ $vaccination_locations->start_time }}" class="form-control" placeholder="Enter Start Time"/>
                                  
                                </div>
                                  <div class="form-group">
                                   <input type="time" id="end_time" name="end_time"value="{{ $vaccination_locations->end_time }}"class="form-control" placeholder="Enter End Time"/>
                              
                                </div>
                                <?php
                                $all_days = json_decode($vaccination_locations->days);
                                ?>
                               @if($all_days != '')
                                <div class="form-group">
                                      <input type="checkbox" id="monday" name="days[]"value="monday"@if (in_array('monday', $all_days)) checked="checked" @endif> <label for="monday"> Monday </label>

                                    <input type="checkbox" id="tuesday" name="days[]" value="tuesday"@if (in_array('tuesday', $all_days)) checked="checked" @endif> <label for="tuesday"> Tuesday </label>

                                    <input type="checkbox" id="wednesday" name="days[]" value="wednesday"@if (in_array('wednesday', $all_days)) checked="checked" @endif> <label for="wednesday"> Wednesday </label>
                                    <input type="checkbox" id="thurday" name="days[]" value="thurday"@if (in_array('thurday', $all_days)) checked="checked" @endif> <label for="thurday"> Thurday </label>

                                    <input type="checkbox" id="friday" name="days[]" value="friday"@if (in_array('friday', $all_days)) checked="checked" @endif> <label for="friday"> Friday </label>

                                    <input type="checkbox" id="satchday" name="days[]" value="satchday"@if (in_array('satchday', $all_days)) checked="checked" @endif> <label for="satchday"> Satchday </label>
                                    <input type="checkbox" id="sunday" name="days[]" value="sunday"@if (in_array('sunday', $all_days)) checked="checked" @endif> <label for="sunday"> Sunday </label>

                                </div>
                                @else
                                <div class="form-group">
                                      <input type="checkbox" id="monday" name="days[]" value="monday"> <label for="monday"> Monday </label> 
                                    <input type="checkbox" id="tuesday" name="days[]" value="tuesday"> <label for="tuesday"> Tuesday </label> 
                                    <input type="checkbox" id="wednesday" name="days[]" value="wednesday"> <label for="wednesday"> Wednesday </label> 
                                    <input type="checkbox" id="thurday" name="days[]" value="thurday"> <label for="thurday"> Thurday </label> 
                                    <input type="checkbox" id="friday" name="days[]" value="friday"> <label for="friday"> Friday </label> 
                                    <input type="checkbox" id="satchday" name="days[]" value="satchday"> <label for="satchday"> Satchday </label> 
                                    <input type="checkbox" id="sunday" name="days[]" value="sunday">  <label for="sunday"> Sunday </label> 
                                </div>
                                @endif
                                <div class="form-group dc-btnarea">
                                       <input type="submit" name="submit" value="Update"class="dc-btn">
                                </div>          
                        </div> 
                    </form>
                </div>
            </div>
        </div>
        </div>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-6 dc-responsive-mt mt-lg-0 mt-xl-0">
                        
           </div>              	
    </div>
       </section>                  	
</div>
@endsection
@push('scripts')
@stack('backend_scripts')
<script >
    var hospitals = {!! json_encode($hospitals) !!}
    var data
$(function() {
  $("#aioConceptName").on("change", function() {
    let id = $("#aioConceptName").val()
    let hospital = hospitals.find(x => JSON.parse(x.id) === JSON.parse(id))
    data = hospital.profile.address
    document.getElementById('hospital_address').value = data 

  });
});
</script>
@endpush
