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
            
                <div class="dc-dashboardboxtitle">
                        	<h2>Update Test</h2>
                </div>
                <div class="dc-dashboardboxcontent dc-addspeciality">
                    <form action="{{action('MedicineController@update',$medicines->id) }}"method="post"> 
                        {{csrf_field()}}
                        @method('post')
                        <div class="form-group">
                                <div class="form-group">
                                       <div class="form-group">
                                    <input type="text" name="name"  class="form-control" placeholder="Service" value="{{ $medicines->name }}"/>
                                    @if ($errors->has('name'))  
                                           <p class="text-danger">{{$errors->first('name')}}</p>   
                                    @endif  
                                    
                                </div>
                                 <div class="form-group">
                                     <span class="dc-select">
                                    <select name="speciality_id" id="speciality_id" class="form-control">
                                       <option value="">Select Speciality</option>                                   
                                       @foreach ($specialities as $key => $speciality)
                                        <option value="{{$speciality->id}}"@if($medicines->speciality_id == $speciality->id) selected @endif>{{$speciality->title}}</option>
                                        @endforeach
                                    </select>
                                </span>
                                    @if ($errors->has('speciality_id'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('speciality_id')}}</p>   
                                    @endif
                                     
                                </div>
                           
                               
                                <div class="form-group dc-btnarea">
                                       <input type="submit" name="submit" value="Update"class="dc-btn">
                                </div>          
                        </div> 
                    </form>
                </div>
            
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-6 dc-responsive-mt mt-lg-0 mt-xl-0">
                        
           </div>              	
    </div>
    </div>
    </div>
       </section>                  	
</div>
@endsection
@push('scripts')
@stack('backend_scripts')

@endpush
