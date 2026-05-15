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
                        	<h2>Edit Vaccination Alert</h2>
                            
                <div class="dc-dashboardboxtitle">
                    <form action="{{action('VaccinationAlertController@update',$vaccination_alerts->id) }}"method="post"> 
                        {{csrf_field()}}
                        @method('post')
                        <div class="form-group">
                           <div class="form-group">
                                    <input type="text" name="title" value="{{ $vaccination_alerts->title }}" class="form-control" placeholder="Enter Title" />
                                    @if ($errors->has('title'))  
                                           <p class="text-danger">{{$errors->first('title')}}</p>   
                                    @endif  
                                </div>
                                  <div class="form-group">
                                    <span class="dc-select">
                                    <select name="vaccination_id" id="vaccination_id" class="form-control">
                                       <option value="">Select Vaccination</option>
                                       @foreach ($vaccinations as $key => $vaccination)
                                        <option value="{{$vaccination->id}}"@if($vaccination_alerts->vaccination_id == $vaccination->id) selected @endif>{{$vaccination->title}}</option>
                                        @endforeach
                                    </select>
                                </span>
                                    @if ($errors->has('vaccination_id'))  
                                           <p class="text-danger">{{$errors->first('vaccination_id')}}</p>   
                                    @endif
                                </div>
                              <div class="form-group">
                                   <input type="date" id="start_date" name="start_date"value="{{ $vaccination_alerts->start_date }}" class="form-control" placeholder="Enter Start Date"/>
                                  
                                </div>
                                  <div class="form-group">
                                   <input type="date" id="end_date" name="end_date"value="{{ $vaccination_alerts->end_date }}" class="form-control" placeholder="Enter Start Time"/>
                                  
                                </div>

                                  <div class="form-group">
                                   <input type="time" id="start_time" name="start_time"value="{{ $vaccination_alerts->start_time }}" class="form-control" placeholder="Enter Start Time"/>
                                  
                                </div>
                                  <div class="form-group">
                                   <input type="time" id="end_time" name="end_time"value="{{ $vaccination_alerts->end_time }}"class="form-control" placeholder="Enter End Time"/>
                              
                                </div>
                                  <input type="text" name="url" value="{{ $vaccination_alerts->url }}" class="form-control" placeholder="Enter URL" />
                                    @if ($errors->has('url'))  
                                           <p class="text-danger">{{$errors->first('url')}}</p>   
                                    @endif  
                                </div>
                                   <div class="form-group">
                                      <input type="checkbox" id="alert_parents" name="alert_parents" value="on"<?php echo ($vaccination_alerts->alert_parents=='on' ? 'checked' : '');?>> <label for="alert_parents"> Send Alert to All Parents </label>
                                </div>
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

@endpush
