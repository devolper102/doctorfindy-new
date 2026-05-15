@extends('back-end.master')
@push('backend_stylesheets')
    <link href="{{ asset('css/basictable.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-beta.min.css') }}">
    <link href="{{ asset('css/bootstrap-tagsinput.css') }}">
    <link href="{{ asset('css/tagsinput-app.css') }}">

    <style>
        /* autocomplete tagsinput*/
        .label-info {
            background-color: #5bc0de;
            display: inline-block;
            padding: 0.2em 0.6em 0.3em;
            font-size: 75%;
            font-weight: 700;
            line-height: 2;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25em;
        }
        .bootstrap-tagsinput{
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            display: inline-block;
            padding: 4px 6px;
            color: #555;
            vertical-align: middle;
            border-radius: 4px;width: 100%;
            line-height: 22px;
            cursor: text;
        }
        .bootstrap-tagsinput input{
            border:none;
            padding: 0px;
            height: 30px;
        }
        .bootstrap-tagsinput .tag [data-role="remove"]:after {
            content: "x";
            padding: 0px 4px;
            cursor: pointer;
        }
        .tt-menu {
            float: left;
            min-width: 90px;
            padding: 5px;
            margin: 2px 0 0;
            list-style: none;
            font-size: 14px;
            background-color: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 4px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
            background-clip: padding-box;
            cursor: pointer;
        }
    </style>
@endpush
@section('content')
@include('includes.pre-loader')
    <div class="dc-specialities" id="specialities">
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
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <div class="dc-haslayout dc-dbsectionspace">
                        <div class="dc-dashboardbox">
                            <div class="dc-dashboardboxtitle">
                                <h2>{{{ trans('lang.update_speciality') }}}</h2>
                            </div>
                            <div class="dc-dashboardboxcontent dc-addservices"><span class="font-weight-bold">{{{ trans('Speciality slug') }}}</span>
                                {!! Form::open(['url' => url('admin/specialities/update/'.$speciality->id), 'class' => 'dc-formtheme dc-formsearch edit-speciality-form', 'id' => 'speclity'])!!}
                                    <fieldset>
                                        <input type="hidden" name="type" value="speciality">
                                        <div class="form-group">
                                            {!! Form::text( 'slug', e($speciality->slug), ['class' =>'form-control'.($errors->has('slug') ? ' is-invalid' : ''), 'placeholder' => trans('lang.ph.slug')] ) !!}
                                            @if ($errors->has('slug'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('slug') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            {!! Form::text( 'title', e($speciality->title), ['class' =>'form-control'.($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => trans('lang.ph.title')] ) !!}
                                            @if ($errors->has('title'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                           <div class="form-group">
                                            {!! Form::text( 'urdu_title', e($speciality->urdu_title), ['class' =>'form-control'.($errors->has('urdu_title') ? ' is-invalid' : ''), 'placeholder' => trans('Urdu Title')] ) !!}
                                            @if ($errors->has('urdu_title'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('urdu_title') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            {!! Form::text( 'user_type', e($speciality->user_type), ['class' =>'form-control'.($errors->has('user_type') ? ' is-invalid' : ''), 'placeholder' => trans('User Type')] ) !!}
                                            @if ($errors->has('user_type'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('user_type') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="location" id="tag1" class="form-control" placeholder="Enter Location/Locations"
                                                   style="display: none;"/>
                                            @if ($errors->has('location'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('location') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                          <div class="form-group">
                                            <input type="text" name="symptomes" id="tag2" class="form-control" placeholder="Enter Symptomes"/>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::textarea( 'urdu_description', e($speciality->urdu_description), ['class' =>'form-control', 'placeholder' => trans('Urdu Description')] ) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::textarea( 'known_as', e($speciality->known_as), ['class' =>'form-control', 'placeholder' => trans('Known as')] ) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::textarea( 'meta_key', e($speciality->meta_key), ['class' =>'form-control', 'placeholder' => trans('Meta Keyword')] ) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::textarea( 'meta_title', e($speciality->meta_title), ['class' =>'form-control', 'placeholder' => trans('Meta Title')] ) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::textarea( 'meta_description', e($speciality->meta_description), ['class' =>'form-control', 'placeholder' => trans('Meta Description')] ) !!}
                                        </div>
                                          <div class="form-group">
                                            {!! Form::textarea( 'desc', e($speciality->description), ['id' => 'description','class' =>'form-control', 'placeholder' => trans('lang.ph.desc')] ) !!}
                                        </div>
                                        <div class="dc-settingscontent">
                                            @if (!empty($speciality->image))
                                                <upload-media
                                                :img="'{{ $speciality->image }}'"
                                                :img_id="'speciality_image'"
                                                :img_name="'speciality_image'"
                                                :img_ref="'speciality_image'"
                                                :img_hidden_name="'speciality_image'"
                                                img_hidden_id="'speciality_image'"
                                                :existed_img="'{{$speciality->image}}'"
                                                :url="'{{ url("media/upload-temp-image/specialities/speciality_image/speciality") }}'"
                                                :existing_img_url="'{{ url("uploads/specialities/$speciality->image") }}'"
                                                :size = "'{{ Helper::getImageDetail($speciality->image, 'size', 'uploads/specialities/') }}'"
                                                :existing_img_name = "'{{ Helper::getImageDetail($speciality->image, 'name', 'uploads/specialities/') }}'"
                                                >
                                                </upload-media>
                                                @else
                                                <upload-media
                                                    :img="'speciality_image'"
                                                    :img_id="'speciality_image'"
                                                    :img_name="'speciality_image'"
                                                    :img_ref="'speciality_image'"
                                                    :img_hidden_name="'speciality_image'"
                                                    img_hidden_id="'speciality_image'"
                                                    :url="'{{ url("media/upload-temp-image/specialities/speciality_image/speciality") }}'"
                                                    >
                                                </upload-media>
                                            @endif
                                        </div>
                                        <div class="dc-settingscontent">
                                            @if (!empty($speciality->app_image))
                                                <upload-media
                                                :img="'{{ $speciality->app_image }}'"
                                                :img_id="'speciality_app_image'"
                                                :img_name="'speciality_app_image'"
                                                :img_ref="'speciality_app_image'"
                                                :img_hidden_name="'speciality_app_image'"
                                                img_hidden_id="'speciality_app_image'"
                                                :existed_img="'{{$speciality->app_image}}'"
                                                :url="'{{ url("media/upload-temp-image/specialities/speciality_app_image/speciality") }}'"
                                                :existing_img_url="'{{ url("uploads/specialities/$speciality->app_image") }}'"
                                                :size = "'{{ Helper::getImageDetail($speciality->app_image, 'size', 'uploads/specialities/') }}'"
                                                :existing_img_name = "'{{ Helper::getImageDetail($speciality->app_image, 'name', 'uploads/specialities/') }}'"
                                                >
                                                </upload-media>
                                                @else
                                                <upload-media
                                                    :img="'speciality_app_image'"
                                                    :img_id="'speciality_app_image'"
                                                    :img_name="'speciality_app_image'"
                                                    :img_ref="'speciality_app_image'"
                                                    :img_hidden_name="'speciality_app_image'"
                                                    img_hidden_id="'speciality_app_image'"
                                                    :url="'{{ url("media/upload-temp-image/specialities/speciality_app_image/speciality") }}'"
                                                    >
                                                </upload-media>
                                            @endif
                                        </div>
                                        <div class="form-group dc-btnarea">
                                            {!! Form::submit(trans('lang.update_speciality'), ['class' => 'dc-btn']) !!}
                                        </div>
                                    </fieldset>
                                {!! Form::close(); !!}
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
{{--    <script src="{{ asset('js/jquery.basictable.min.js') }}"></script>--}}

    <script type="text/javascript">
      jQuery('.dc-table-responsive').basictable({
        breakpoint: 767,
      });

    </script>

<script src="{{ asset('js/bootstrap-beta.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    
   
        <script src="{{ asset('js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-tagsinput.min.js') }}"></script>
    <script>
      var data =JSON.stringify({!!json_encode($location)!!});
      var stored_data =JSON.stringify({!!json_encode($loc_tags)!!});
      //get data pass to json
      var task = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace("title"),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: jQuery.parseJSON(data) //your can use json type
      });

      task.initialize();

      var elt = $("#tag1");
      elt.tagsinput({
        itemValue: "id",
        itemText: "title",
        typeaheadjs: {
          name: "id",
          displayKey: "title",
          source: task.ttAdapter()
        }
      });
      populate('#tag1', stored_data);

      function populate(frm, data) {

        $.each(JSON.parse(data), function(id, title){
          $(elt).tagsinput('add', title);
        });
      }

    </script>
    <script>
      var data =JSON.stringify({!!json_encode($symptomes)!!});
      var stored_data =JSON.stringify({!!json_encode($sym_tags)!!});
      //get data pass to json
      var task = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace("title"),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: jQuery.parseJSON(data) //your can use json type
      });

      task.initialize();

      var elt = $("#tag2");
      elt.tagsinput({
        itemValue: "id",
        itemText: "title",
        typeaheadjs: {
          name: "id",
          displayKey: "title",
          source: task.ttAdapter()
        }
      });
      populate('#tag2', stored_data);

      function populate(frm, data) {

        $.each(JSON.parse(data), function(id, title){
          $(elt).tagsinput('add', title);
        });
      }

    </script>
@endpush

