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
                        	<h2>Update Affair Detail</h2>
                </div>
                <div class="dc-dashboardboxcontent dc-addspeciality">
                    <form action="{{action('AffairDetailController@update',$affairdetails->id) }}"method="post" enctype="multipart/form-data"> 
                        {{csrf_field()}}
                        @method('post')
                        <div class="form-group">
                                <div class="form-group">
                                   <div class="form-group">
                                     <span class="dc-select">

                                    <select name="affairs_id" id="affairs_id" class="form-control">
                                       <option value="">Select Affair Title</option>                                     
                                       @foreach ($affairs as $key => $affair)
                                        <option value="{{$affair->id}}"@if($affairdetails->affairs_id == $affair->id) selected @endif>{{$affair->title}}</option>
                                        @endforeach
                                    </select>
                                </span>
                                    @if ($errors->has('affairs_id'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('affairs_id')}}</p>   
                                    @endif
                                     
                                </div>
                                <div class="form-group">
                                    <input type="text" name="title" value="{{ $affairdetails->title }}"id="tag2" class="form-control" placeholder="Title" />
                                    @if ($errors->has('title'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('title')}}</p>   
                                    @endif  
                                    
                                </div>
                                <div class="form-group">
                                     <span class="dc-select">
                                    <select name="type" id="type" class="form-control">
                                        <option value="">Select Type</option>
                                        <option value="artical"@if($affairdetails->type == 'artical') selected="selected" @endif>Artical</option>
                                        <option value="non-artical"@if($affairdetails->type == 'non-artical') selected="selected" @endif>Non Artical</option>
                                        
                                    </select>
                                </span>
                                    @if ($errors->has('type'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('type')}}</p>   
                                    @endif
                                     
                                </div>
                                    <div class="form-group">
                                         <span class="dc-select">
                                     <select name="status" id="staturlus" class="form-control">
                                        
                                        <option value="">Select Status</option>
                                        <option value="1"@if($affairdetails->status == '1') selected="selected" @endif>Active</option>
                                        <option value="0"@if($affairdetails->status == '0') selected="selected" @endif>Inactive</option>
                                        
                                    </select>
                                </span>
                                    @if ($errors->has('status'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('status')}}</p>   
                                    @endif
                                </div> 
                                <div class="form-group">
                                    <input type="text" name="url"  class="form-control" placeholder="Url" value="{{ $affairdetails->url }}"/>
                                    @if ($errors->has('url'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('url')}}</p>   
                                    @endif  
                                    
                                </div>
                                 <div class="form-group">
                                    {!! Form::textarea( 'description', e($affairdetails->description), ['id' => 'description','class' =>'form-control', 'placeholder' => trans('lang.ph.desc')] ) !!}
                                </div>

                                <div class="dc-settingscontent">
                                            @if (!empty($affairdetails->image))
                                                <upload-media
                                                :img="'{{ $affairdetails->image }}'"
                                                :img_id="'affair_image'"
                                                :img_name="'affair_image'"
                                                :img_ref="'affair_image'"
                                                :img_hidden_name="'affair_image'"
                                                img_hidden_id="'affair_image'"
                                                :existed_img="'{{$affairdetails->image}}'"
                                                :url="'{{ url("media/upload-temp-image/affairs/affair_image/affair") }}'"
                                                :existing_img_url="'{{ url("uploads/affairs/$affairdetails->image") }}'"
                                                :size = "'{{ Helper::getImageDetail($affairdetails->image, 'size', 'uploads/affairs/') }}'"
                                                :existing_img_name = "'{{ Helper::getImageDetail($affairdetails->image, 'title', 'uploads/affairs/') }}'"
                                                >
                                                </upload-media>
                                                @else
                                                <upload-media
                                                    :img="'affair_image'"
                                                    :img_id="'affair_image'"
                                                    :img_name="'affair_image'"
                                                    :img_ref="'affair_image'"
                                                    :img_hidden_name="'affair_image'"
                                                    img_hidden_id="'affair_image'"
                                                    :url="'{{ url("media/upload-temp-image/affairs/affair_image/affair") }}'"
                                                    >
                                                </upload-media>
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
