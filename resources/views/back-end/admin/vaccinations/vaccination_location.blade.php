@extends('back-end.master')
@push('backend_stylesheets')
<style type="text/css">
	 #vaccination_location thead tr th{
        min-width: 190px;
    }
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
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                   <div class="dc-dashboardbox">
                        <div class="dc-dashboardboxtitle dc-titlewithsearch dc-titlewithdel">
                            <h2>Manage Vaccination Locations</h2>
                        </div>
                        @if ($vaccination_locations->count() > 0)
                           <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table class="table table-bordered table-hover dt-responsive nowrap table-responsive"cellspacing="0" id="vaccination_location">
                                    <thead>
                                        <tr>
                                            <th>Vaccination</th>
                                            <th>City</th>
                                            <th>Hospital</th>
                                            <th>Hospital Address</th>
                                            
                                            <th class="action">{{{ trans('lang.action') }}}</th>
                                            <th class="none">Room</th>
                                            <th class="none">Contact</th>
                                            <th class="none">Start Time</th>
                                            <th class="none">End Time</th>
                                            <th class="none">Days</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($vaccination_locations as $key => $vaccination_location)
                                            <tr>
                                                
                                                <td>{{optional($vaccination_location->vaccinations)->title}}</td>
                                                <td>{{optional($vaccination_location->locations)->title}}</td>
                                                 <td>{{optional($vaccination_location->users)->first_name}}
                                                    {{optional($vaccination_location->users)->last_name}}

                                                 </td>
                                                 <td>{{$vaccination_location->hospital_address}}</td>
                                                <td>
                                                    <div class="dc-actionbtn">
                                                        <a href="{{action('VaccinationLocationController@edit',$vaccination_location->id) }}" class="dc-addinfo dc-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                
                                                    <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ intVal(clean($vaccination_location->id)) }}'" :message="'{{trans("Vaccination Location Deleted Successfully")}}'" :url="'{{url('admin/vaccination-location/delete')}}'" :redirect_url="'{{url('admin/vaccination-location')}}'"></delete>

                                                    </div>
                                                </td>
                                                 <td>{{$vaccination_location->room}}</td>
                                                 <td>{{$vaccination_location->phone_no}}</td>
                                                 <td>{{$vaccination_location->start_time}}</td>
                                                 <td>{{$vaccination_location->end_time}}</td>
                                                 <td>{{$vaccination_location->days}}</td>
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($vaccination_locations,'links') )
                                    {{ $vaccination_locations->links('pagination.custom') }}
                                @endif
                            </div>
                        @else
                            @include('errors.no-record')
                        @endif
                    </div>
                </div>
    </div>
    <div class="row">       
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-6">
        <div class="dc-dashboardbox mt-5">
            <div class="dc-dashboardboxtitle dc-titlewithsearch dc-titlewithdel">

                        	<h2>Add New Vaccination Location</h2>
                <div class="dc-dashboardboxtitle">

                    <form action="{{ url('admin/store-vaccination-location') }}"method="post"> 
                        {{csrf_field()}}
                        <div class="form-group">
                              <div class="form-group">
                                    <span class="dc-select">
                                    <select name="vaccination_id" id="vaccination_id" class="form-control">
                                       <option value="">Select Vaccination</option>
                                       @foreach ($vaccinations as $key => $vaccination)
                                        <option value="{{$vaccination->id}}">{{$vaccination->title}}</option>
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
                                        <option value="{{$location->id}}">{{$location->title}}</option>
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

                                        <option value="{{$hospital->id}}">{{Helper::getUserData($hospital->id)}}</option>
                                        @endforeach
                                        
                                    </select>
                                </span>
                                    @if ($errors->has('hospital_id'))  
                                           <p class="text-danger">{{$errors->first('hospital_id')}}</p>   
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" name="hospital_address" id="hospital_address" class="form-control" placeholder="Hospital Address"readonly="readonly" />
                                </div>
                                <div class="form-group">
                                    <input type="text" name="room" id="tag2" class="form-control" placeholder="Enter room" />
                                    @if ($errors->has('room'))  
                                           <p class="text-danger">{{$errors->first('room')}}</p>   
                                    @endif  
                                </div>
                                <div class="form-group">
                                    <input type="text" name="phone_no" id="tag2" class="form-control" placeholder="Enter Contact"  />
                                    @if ($errors->has('phone_no'))  
                                           <p class="text-danger">{{$errors->first('phone_no')}}</p>   
                                    @endif  
                                </div>
                                  <div class="form-group">
                                   <input type="time" id="start_time" name="start_time" class="form-control" placeholder="Enter Start Time"/>
                                    @if ($errors->has('start_time'))  
                                           <p class="text-danger">{{$errors->first('start_time')}}</p>   
                                    @endif  
                                </div>
                                  <div class="form-group">
                                   <input type="time" id="end_time" name="end_time"class="form-control" placeholder="Enter End Time"/>
                                    @if ($errors->has('end_time'))  
                                           <p class="text-danger">{{$errors->first('end_time')}}</p>   
                                    @endif  
                                </div>
                                <div class="form-group">
                                      <input type="checkbox" id="monday" name="days[]" value="monday"> <label for="monday"> Monday </label> 
                                    <input type="checkbox" id="tuesday" name="days[]" value="tuesday"> <label for="tuesday"> Tuesday </label> 
                                    <input type="checkbox" id="wednesday" name="days[]" value="wednesday"> <label for="wednesday"> Wednesday </label> 
                                    <input type="checkbox" id="thurday" name="days[]" value="thurday"> <label for="thurday"> Thurday </label> 
                                    <input type="checkbox" id="friday" name="days[]" value="friday"> <label for="friday"> Friday </label> 
                                    <input type="checkbox" id="satchday" name="days[]" value="satchday"> <label for="satchday"> Satchday </label> 
                                    <input type="checkbox" id="sunday" name="days[]" value="sunday">  <label for="sunday"> Sunday </label> 
                                </div>

                              
                                <div class="form-group dc-btnarea">
                                       <button type="submit" name="submit" class="dc-btn">Create Vaccination Location</button>
                                </div>      
                                   
                        </div> 

                    </form>
                </div>
            </div>
        </div>
        </div>
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
<script type="text/javascript">
      $(document).ready(function() {
        $('#vaccination_location').DataTable();
      } );

</script>
@endpush
