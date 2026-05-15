@extends('back-end.master')
@push('backend_stylesheets')
    <link href="{{ asset('css/basictable.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-beta.min.css') }}"  rel="stylesheet">
    <link href="{{ asset('css/bootstrap-tagsinput.css') }}"  rel="stylesheet">
    <link href="{{ asset('css/tagsinput-app.css') }}"  rel="stylesheet">

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
                                <h2>{{{ trans('lang.update_symptom') }}}</h2>
                            </div>
                            <div class="dc-dashboardboxcontent dc-addservices">
                                {!! Form::open(['url' => url('admin/symptom/update/'.$symptom->id), 'class' => 'dc-formtheme dc-formsearch edit-speciality-form', 'id' => 'speclity'])!!}
                                    <fieldset>
                                        <input type="hidden" name="type" value="speciality">
                                        <div class="form-group">
                                            {!! Form::text( 'title', e($symptom->title), ['class' =>'form-control'.($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => trans('lang.ph.title')] ) !!}
                                            @if ($errors->has('title'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="services" id="tag1" class="form-control" placeholder="Enter Services"
                                                   style="display: none;"/>
                                            @if ($errors->has('location'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('location') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                         <div class="form-group">
                                      <input type="checkbox" id="test_symptom" name="test_symptom" value="1"<?php echo ($symptom->test_symptom=='1' ? 'checked' : '');?>> <label for="test_symptom">Speciality Test symptom </label>
                                </div>
                                        <div class="form-group">
                                            {!! Form::textarea( 'desc', e($symptom->description), ['id' => 'description','class' =>'form-control', 'placeholder' => trans('lang.ph.desc')] ) !!}
                                        </div>
                                        <div class="dc-settingscontent">
                                            @if (!empty($symptom->image))
                                                <upload-media
                                                :img="'{{ $symptom->image }}'"
                                                :img_id="'symptom_image'"
                                                :img_name="'symptom_image'"
                                                :img_ref="'symptom_image'"
                                                :img_hidden_name="'symptom_image'"
                                                img_hidden_id="'symptom_image'"
                                                :existed_img="'{{$symptom->image}}'"
                                                :url="'{{ url("media/upload-temp-image/symptoms/symptom_image/symptoms") }}'"
                                                :existing_img_url="'{{ url("uploads/symptoms/$symptom->image") }}'"
                                                :size = "'{{ Helper::getImageDetail($symptom->image, 'size', 'uploads/symptoms/') }}'"
                                                :existing_img_name = "'{{ Helper::getImageDetail($symptom->image, 'name', 'uploads/symptoms/') }}'"
                                                >
                                                </upload-media>
                                                @else
                                                <upload-media
                                                    :img="'symptom_image'"
                                                    :img_id="'symptom_image'"
                                                    :img_name="'symptom_image'"
                                                    :img_ref="'symptom_image'"
                                                    :img_hidden_name="'symptom_image'"
                                                    img_hidden_id="'symptom_image'"
                                                    :url="'{{ url("media/upload-temp-image/symptoms/symptom_image/symptoms") }}'"
                                                    >
                                                </upload-media>
                                            @endif
                                        </div>
                                        <div class="form-group dc-btnarea">
                                            {!! Form::submit(trans('lang.update_symptom'), ['class' => 'dc-btn']) !!}
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
      var data =JSON.stringify({!!json_encode($service)!!});
      var stored_data =JSON.stringify({!!json_encode($service_tags)!!});
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
@endpush

