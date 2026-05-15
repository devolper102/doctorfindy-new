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
                        	<h2>Update Department Service</h2>
                </div>
                <div class="dc-dashboardboxcontent dc-addspeciality">
                    <form action="{{action('DepartmentServiceController@update',$department_services->id) }}"method="post"> 
                        {{csrf_field()}}
                        @method('post')
                        <div class="form-group">
                                <div class="form-group">
                                 <div class="form-group">
                                     <span class="dc-select">
                                    <select name="department_id" id="department_id" class="form-control">
                                       <option value="">Select Department</option>                                   
                                       @foreach ($departments as $key => $department)
                                        <option value="{{$department->id}}"@if($department_services->department_id == $department->id) selected @endif>{{$department->title}}</option>
                                        @endforeach
                                    </select>
                                </span>
                                    @if ($errors->has('department_id'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('department_id')}}</p>   
                                    @endif
                                     
                                </div>
                                <div class="form-group">
                                    <input type="text" name="service"  class="form-control" placeholder="Service" value="{{ $department_services->service }}"/>
                                    @if ($errors->has('service'))  
                                           <p class="text-danger">{{$errors->first('service')}}</p>   
                                    @endif  
                                    
                                </div>
                                 <div class="form-group">
                                    {!! Form::textarea( 'description', e($department_services->description), ['id' => 'description','class' =>'form-control', 'placeholder' => trans('lang.ph.desc')] ) !!}
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
