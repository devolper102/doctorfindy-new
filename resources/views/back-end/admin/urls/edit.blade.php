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
                        	<h2>Edit Page</h2>
                <div class="dc-dashboardboxtitle">
                    <form action="{{action('UrlController@update',$urls->id) }}"method="post"> 
                        {{csrf_field()}}
                        @method('post')
                        <div class="form-group">
                                <div class="form-group">
                                    <input type="text" name="title"value="{{ $urls->title }}"id="tag2" class="form-control" placeholder="Enter Page Name" />
                                     @if ($errors->has('title'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('title')}}</p>   
                                    @endif 
                                </div>
                                <div class="form-group">
                                    <input type="text" name="url" value="{{ $urls->url }}" id="tag2" class="form-control" placeholder="Enter Page url" />
                                    @if ($errors->has('url'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('url')}}</p>   
                                    @endif
                                </div>
                                   <div class="form-group">
                                    <input type="text" name="meta_title"value="{{ $urls->meta_title }}" id="tag2" class="form-control" placeholder="Enter Meta Title" />
                                </div>
                                  <div class="form-group">
                                    <textarea cols="5"name ="meta_description"class="form-control"placeholder="Enter Meta Description" >{{ $urls->meta_description }}</textarea>
                                </div>
                                <div class="form-group">
                                    {!! Form::textarea( 'description', e($urls->description), ['id' => 'description','class' =>'form-control', 'placeholder' => trans('lang.ph.desc')]) !!}
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
