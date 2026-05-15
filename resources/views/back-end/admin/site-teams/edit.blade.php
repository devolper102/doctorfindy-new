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
                        	<h2>Edit Team Members</h2>
                <div class="dc-dashboardboxtitle">
                    <form action="{{action('SiteTeamController@update',$siteTeams->id) }}"method="post"> 
                        {{csrf_field()}}
                        @method('post')
                        <div class="form-group">
                                <div class="form-group">
                                    <input type="text" name="full_name"value="{{ $siteTeams->full_name }}"id="tag2" class="form-control" placeholder="Enter Title" />
                                     @if ($errors->has('full_name'))  
                                           <p class="text-danger">{{$errors->first('full_name')}}</p>   
                                    @endif 
                                </div>
                                <div class="form-group">
                                    <input type="text" name="designation"value="{{ $siteTeams->designation }}"id="tag2" class="form-control" placeholder="Enter Title" />
                                     @if ($errors->has('designation'))  
                                           <p class="text-danger">{{$errors->first('designation')}}</p>   
                                    @endif 
                                </div>
                                <div class="form-group">
                                    {!! Form::textarea( 'description', e($siteTeams->description), ['id' => 'description','class' =>'form-control', 'placeholder' => trans('Enter Some Member')]) !!}
                                </div> 
                                 <div class="dc-settingscontent">
                                            @if (!empty($siteTeams->image))
                                                <upload-media
                                                :img="'{{ $siteTeams->image }}'"
                                                :img_id="'team_image'"
                                                :img_name="'team_image'"
                                                :img_ref="'team_image'"
                                                :img_hidden_name="'team_image'"
                                                img_hidden_id="'team_image'"
                                                :existed_img="'{{$siteTeams->image}}'"
                                                :url="'{{ url("media/upload-temp-image/team/team_image/affair") }}'"
                                                :existing_img_url="'{{ url("uploads/team/$siteTeams->image") }}'"
                                                :size = "'{{ Helper::getImageDetail($siteTeams->image, 'size', 'uploads/team/') }}'"
                                                :existing_img_name = "'{{ Helper::getImageDetail($siteTeams->image, 'title', 'uploads/team/') }}'"
                                                >
                                                </upload-media>
                                                @else
                                                <upload-media
                                                    :img="'team_image'"
                                                    :img_id="'team_image'"
                                                    :img_name="'team_image'"
                                                    :img_ref="'team_image'"
                                                    :img_hidden_name="'team_image'"
                                                    img_hidden_id="'team_image'"
                                                    :url="'{{ url("media/upload-temp-image/team/team_image/affair") }}'"
                                                    >
                                                </upload-media>
                                            @endif
                                        </div>
                                <div class="form-group dc-btnarea">
                                       <input type="submit" name="submit" value="Update Team Member"class="dc-btn">
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
