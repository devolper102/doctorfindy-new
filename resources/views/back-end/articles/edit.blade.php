@extends('back-end.master')
@section('content')
@include('includes.pre-loader')
    <div class="row" id="articles">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            {!! Form::open(['url' => '', 'class' =>'dc-haslayout dc-dbsectionspace dc-dbsectionspacetest', 'id' =>'update-article-form', '@submit.prevent'=>'updateArticle("'.$article->id.'")'])!!}
                <div class="dc-dashboardbox">
                    <div class="dc-dashboardboxtitle la-switch-option">
                        <h2>{{ trans('lang.edit_article') }}</h2>
                        <div class="float-right">
                            <switch_button v-model="is_featured">{{{ trans('lang.feture_article') }}}</switch_button>
                            <input type="hidden" :value="is_featured" name="is_featured">
                        </div>
                       <!--  <div class="float-right mr-2">
                            <switch_button v-model="statusToggle">{{{ trans('Status') }}}</switch_button>
                                <input type="hidden" :value="statusToggle ? 'approved' : 'pending'" name="status">
                        </div> -->
                       <!--  <div class="float-right mr-2">
                            <label>
                                <input type="checkbox" v-model="statusToggle">
                                {{ trans('Status') }}
                            </label>
                            <input type="hidden" :value="statusToggle ? 'approved' : 'pending'" name="status">
                        </div> -->
                    </div>
                    <div class="dc-dashboardboxcontent dc-addservices dc-articlesservices">
                        <div class="dc-tabscontenttitle">
                            <h3>{{ trans('lang.add_article_detail') }}</h3>
                        </div>
                        <div class="dc-formtheme dc-userform">
                            <fieldset>
                                <div class="form-group">
                                    {!! Form::text('title', e($article->title), ['class' =>
                                    'form-control','placeholder'=>trans('lang.ph.title')]) !!}
                                </div>
                               <div class="form-group">
                                    {!! Form::text('url_title', e($article->url_title), ['class' =>
                                    'form-control','placeholder'=>trans('Title For Url')]) !!}
                                </div>
                                  <div class="form-group dc-tinymceeditor text_area_main">
                        <textarea class="form-control"name="short_description"placeholder="Short Description">{{$article->short_description}}</textarea>
                            </div>
                                <div class="form-group">
                                    {!! Form::textarea('description', e($article->description),
                                        [ 'id' => 'description'])
                                    !!}
                                </div>
                            </fieldset>
                        </div>

                        <div class="dc-profilephoto dc-tabsinfo">
                            <div class="dc-tabscontenttitle">
                                <h3>{{ trans('lang.featured_photo') }}</h3>
                            </div>
                            <div class="dc-profilephotocontent dc-featuredphoto">
                                <div class="dc-description">
                                    <p>{{ trans('lang.featured_photo_desc') }}</p>
                                </div>
                                <div class="dc-formtheme dc-formprojectinfo dc-formcategory">
                                    <div class="dc-settingscontent">
                                        @if(env('FILESYSTEM_DRIVER') == 'production')
    @php
        $imageUrl = 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com/uploads/users/' . Auth::user()->id . '/articles/' . $article->image;
        $backgroundImageUrl = 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com/uploads/users/' . Auth::user()->id . '/articles/' . $article->background_img;
    @endphp
@else
    @php
        $imageUrl = url('uploads/users/'.Auth::user()->id.'/articles/'.$article->image);
        $backgroundImageUrl = url('uploads/users/'.Auth::user()->id.'/articles/'.$article->background_img);
    @endphp
@endif
                                        @if (!empty($article->image))
                                            <upload-media-blog
                                            :img="'{{ $article->image }}'"
                                            :img_id="'feature_img'"
                                            :img_name="'feature_img'"
                                            :img_ref="'feature_img'"
                                            :img_hidden_name="'hidden_feature_img'"
                                            :img_hidden_id="'hidden_feature_img'"
                                            :existed_img="'{{ $article->image }}'"
                                            :url="'{{ url("media/upload-temp-image/users/feature_img/articles") }}'"
                                            :existing_img_url="'{{ $imageUrl }}'"
                                            :size = "'{{ Helper::getImageDetail( $article->image, 'size', 'uploads/users/' .Auth::user()->id. '/articles/') }}'"
                                            :existing_img_name = "'{{ Helper::getImageDetail( $article->image, 'name', 'uploads/users/' .Auth::user()->id) }}'"
                                            >
                                            </upload-media-blog>
                                        @else
                                            <div class = "dc-formtheme dc-userform">
                                                <upload-media-blog
                                                :img="'feature_img'"
                                                :img_id="'feature_img'"
                                                :img_name="'feature_img'"
                                                :img_ref="'feature_img'"
                                                :img_hidden_name="'hidden_feature_img'"
                                                :img_hidden_id="'hidden_feature_img'"
                                                :url="'{{ url("media/upload-temp-image/users/feature_img/articles") }}'"
                                                >
                                                </upload-media-blog>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dc-profilephoto dc-tabsinfo">
                            <div class="dc-tabscontenttitle">
                                <h3>Background Image</h3>
                            </div>
                            <div class="dc-profilephotocontent dc-backgroundimg">
                                <div class="dc-description">
                                    <p>Upload Background Image</p>
                                </div>
                                <div class="dc-formtheme dc-formprojectinfo dc-formcategory">
                                    <div class="dc-settingscontent">
                                        @if (!empty($article->background_img))
                                            <upload-media-blog
                                            :img="'{{ $article->background_img }}'"
                                            :img_id="'background_img'"
                                            :img_name="'background_img'"
                                            :img_ref="'background_img'"
                                            :img_hidden_name="'hidden_background_img'"
                                            :img_hidden_id="'hidden_background_img'"
                                            :existed_img="'{{ $article->background_img }}'"
                                            :url="'{{ url("media/upload-temp-image/users/background_img/articles") }}'"
                                            :existing_img_url="'{{ $backgroundImageUrl }}'"
                                            :size = "'{{ Helper::getImageDetail( $article->background_img, 'size', 'uploads/users/' .Auth::user()->id. '/articles/') }}'"
                                            :existing_img_name = "'{{ Helper::getImageDetail( $article->background_img, 'name', 'uploads/users/' .Auth::user()->id) }}'"
                                            >
                                            </upload-media-blog>
                                        @else
                                            <div class = "dc-formtheme dc-userform">
                                                <upload-media-blog
                                                :img="'background_img'"
                                                :img_id="'background_img'"
                                                :img_name="'background_img'"
                                                :img_ref="'background_img'"
                                                :img_hidden_name="'hidden_background_img'"
                                                :img_hidden_id="'hidden_background_img'"
                                                :url="'{{ url("media/upload-temp-image/users/background_img/articles") }}'"
                                                >
                                                </upload-media-blog>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                                    <span class="dc-select">
                                    <select name="reading_time" id="vaccination_id" class="form-control">
                                       <option value="">Select Reading Time in Minutes </option>
    <option value="1" @if($article->reading_time == 1) selected @endif>1 Minutes</option>
    <option value="2" @if($article->reading_time == 2) selected @endif>2 Minutes</option>
    <option value="3" @if($article->reading_time == 3) selected @endif>3 Minutes</option>
    <option value="4" @if($article->reading_time == 4) selected @endif>4 Minutes</option>
    <option value="5" @if($article->reading_time == 5) selected @endif>5 Minutes</option>
    <option value="6" @if($article->reading_time == 6) selected @endif>6 Minutes</option>
    <option value="7" @if($article->reading_time == 7) selected @endif>7 Minutes</option>
    <option value="8" @if($article->reading_time == 8) selected @endif>8 Minutes</option>
    <option value="9" @if($article->reading_time == 9) selected @endif>9 Minutes</option>
    <option value="10"@if($article->reading_time == 10) selected @endif>10 Minutes</option>
    <option value="11" @if($article->reading_time == 11) selected @endif>11 Minutes</option>
    <option value="12" @if($article->reading_time == 12) selected @endif>12 Minutes</option>
    <option value="13" @if($article->reading_time == 13) selected @endif>13 Minutes</option>
    <option value="14" @if($article->reading_time == 14) selected @endif>14 Minutes</option>
    <option value="15" @if($article->reading_time == 15) selected @endif>15 Minutes</option>
                                        
                                    </select>
                                </span>
                                </div>
                        @if (!empty($categories) && count($categories) > 0)
                            <div class="dc-profilephoto dc-tabsinfo">
                                <div class="dc-tabscontenttitle">
                                    <h3>{{ trans('lang.select_category') }}</h3>
                                </div>
                                <article-cats :placeholder="'{{ trans('lang.all_cats_selected') }}'"></article-cats>
                            </div>
                        @endif
                        <div class="dc-btnarea">
                            {!! Form::submit(trans('lang.post_now'), ['class' => 'dc-btn']) !!}
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@push('backend_scripts')

@endpush


