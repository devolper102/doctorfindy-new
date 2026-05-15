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
                        	<h2>Update Affair</h2>
                <div class="dc-dashboardboxtitle">
                    <form action="{{action('AffairController@update',$affairs->id) }}"method="post"> 
                        {{csrf_field()}}
                        @method('post')
                        <div class="form-group">
                                <div class="form-group">
                                    <input type="text" name="title"value="{{ $affairs->title }}"id="tag2" class="form-control" placeholder="Title" />
                                     @if ($errors->has('title'))  
                                           <p class="text-danger">{{$errors->first('title')}}</p>   
                                    @endif 
                                </div>
                                  <div class="form-group">
                                     <span class="dc-select">
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Select Status</option>
                                        <option value="1"@if($affairs->status == '1') selected="selected" @endif>Active</option>
                                        <option value="0"value="1"@if($affairs->status == '0') selected="selected" @endif>Inactive</option>
                                        
                                    </select>
                                </span>
                                @if ($errors->has('status'))  
                                           <p class="text-danger">{{$errors->first('status')}}</p>   
                                    @endif 
                                     
                                </div>
                                 <div class="form-group">
                                     <span class="dc-select">
                                     <select name="priority" id="priority" class="form-control">
                                        <option value="">Select Priority</option>
                                        <option value="1"value="1"@if($affairs->priority == '1') selected="selected" @endif>Hight Priority </option>
                                        <option value="0"@if($affairs->priority == '0') selected="selected" @endif>Low Priority</option>
                                        
                                    </select>
                                </span>
                                @if ($errors->has('priority'))  
                                           <p class="text-danger">{{$errors->first('priority')}}</p>   
                                    @endif 
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
