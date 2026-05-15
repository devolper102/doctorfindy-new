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
                        	<h2>Edit Role</h2>
                <div class="dc-dashboardboxtitle">
                    <form action="{{action('RolesController@update',$roles->id) }}"method="post"> 
                        {{csrf_field()}}
                        @method('post')
                        <div class="form-group">
                                <div class="form-group">
                                    <input type="text" name="name"value="{{ $roles->name }}"id="tag2" class="form-control" placeholder="Enter Role Name" />
                                     @if ($errors->has('name'))  
                                           <p class="text-danger">{{$errors->first('name')}}</p>   
                                    @endif 
                                </div>
                               <div class="form-group">
                                    <input type="text" name="role_type"value="{{ $roles->role_type }}"id="tag2" class="form-control" placeholder="Enter Role Type" />
                                     @if ($errors->has('role_type'))  
                                           <p class="text-danger">{{$errors->first('role_type')}}</p>   
                                    @endif 
                                </div>
                                <div class="form-group">
                                    <input type="text" name="guard_name"value="{{ $roles->guard_name }}"id="tag2" class="form-control" placeholder="Enter Guard Name" />
                                     @if ($errors->has('guard_name'))  
                                           <p class="text-danger">{{$errors->first('guard_name')}}</p>   
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
