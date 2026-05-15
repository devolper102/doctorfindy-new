@extends('back-end.master')
@push('backend_stylesheets')
    <link href="{{ asset('css/basictable.css') }}" rel="stylesheet">
    <style>
        .action {
            width: 80px !important;
        }
    </style>
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
        .action {
            width: 80px !important;
        }
    </style>
@endpush
@section('content')
    @include('includes.pre-loader')
    <div class="dc-locations" id="locations">
        @if (Session::has('message'))
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time='5' :message="'{{{ Session::get('message') }}}'" v-cloak>
                </flash_messages>
            </div>
        @elseif (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time='5' :message="'{{{ Session::get('error') }}}'" v-cloak>
                </flash_messages>
            </div>
        @endif
        <section class="dc-haslayout">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="dc-dashboardbox">
                        <div class="dc-dashboardboxtitle dc-titlewithsearch dc-titlewithdel">
                            <h2>{{{ trans('lang.manage_disease') }}}</h2>
                            <div class="dc-rightarea form_head">
                                <multi-delete v-cloak v-if="this.is_show"
                                              :title="'{{trans("lang.ph.delete_confirm_title")}}'"
                                              :message="'{{trans("lang.ph.diseases_del_delete_message")}}'"
                                              :url="'{{url('admin/delete-checked-diseases')}}'"
                                              :redirect_url="'{{url('admin/diseases')}}'">
                                </multi-delete>
                            </div>
                        </div>
                        @if ($diseases->count() > 0)
                            <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table class="dc-tablecategories dc-table-responsive" class="table table-bordered table-hover dt-responsive nowrap table-responsive"cellspacing="0" id="checked-val">
                                    <thead>
                                        <tr>
                                            <th>
                                            <span class="dc-checkbox">
                                                <input name="locs[]" id="dc-locs" @click="selectAll" type="checkbox">
                                                <label for="dc-locs"></label>
                                            </span>
                                            </th>
                                            <th>{{{ trans('lang.disease_icon') }}}</th>
                                            <th>{{{ trans('lang.name') }}}</th>
                                            <th>{{{ trans('lang.slug') }}}</th>
                                            <th>Speciality</th>
                                            <th class="action">{{{ trans('lang.action') }}}</th>
                                            <th>Created Date</th>
                                            <th>Updated Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $counter = 0; @endphp
                                    @foreach ($diseases as $key => $disease)
                                        <tr class="del-{{{ $disease->id }}}">
                                            <td>
                                            <span class="dc-checkbox">
                                                <input name="locs[]" @click="selectRecord" value="{{{ intVal(clean($disease->id)) }}}"
                                                       id="wt-check-{{{ $counter }}}" type="checkbox">
                                                <label for="wt-check-{{{ $counter }}}"></label>
                                            </span>
                                            </td>
                                            <td data-th="Icon">
                                            <span class="bt-content">
                                                <figure>
                                                    <img src="{{{ asset(Helper::getDiseaseImage('uploads/disease', $disease->flag, 'extra-small-', 'default.png')) }}}" alt="{{{ html_entity_decode(clean($disease->title)) }}}">
                                                </figure>
                                            </span>
                                            </td>
                                            <td>{{{ html_entity_decode(clean($disease->title)) }}}</td>
                                            <td>{{{ html_entity_decode(clean($disease->slug)) }}}</td>
                                            <td>{{optional($disease->speciality)->title}}</td>
                                            <td>
                                                <div class="dc-actionbtn">
                                                    <a href="{{{ url('admin/diseases/edit') }}}/{{{ html_entity_decode(clean($disease->slug)) }}}"
                                                       class="dc-addinfo dc-skillsaddinfo">
                                                        <i class="lnr lnr-pencil"></i>
                                                    </a>
                                                    <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'"
                                                            :id="'{{ intVal(clean($disease->id)) }}'"
                                                            :message="'{{trans("lang.ph_loc_delete_message")}}'"
                                                            :url="'{{url('admin/diseases/delete')}}'"
                                                            :redirect_url="'{{url('admin/diseases')}}'">
                                                    </delete>
                                                </div>
                                            </td>
                                            <td>{{ $disease->created_at->format('M d, Y, h:i A') }}</td>
                                            <td>{{ $disease->updated_at->format('M d, Y, h:i A') }}</td>
                                        </tr>
                                        @php $counter++; @endphp
                                    @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($diseases,'links') )
                                    {{ $diseases->links('pagination.custom') }}
                                @endif
                            </div>
                        @else
                            @include('errors.no-record')
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">    
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-6 dc-responsive-mt mt-lg-0 mt-xl-0">
                    <div class="dc-dashboardbox dc-offered-holder dc-addnewdisease mt-5 pt-4">
                        <div class="dc-dashboardboxtitle">
                            <h2>{{{ trans('lang.add_new_disease') }}}</h2>
                        </div>
                        <div class="dc-dashboardboxcontent">
                            {!! Form::open([
                            'url' => url('admin/store-disease'),
                            'class' =>'dc-formtheme dc-formprojectinfo dc-formcategory dc-formtheme dc-userform', 'id'=>
                            'diseases-form'
                            ])
                            !!}
                            <fieldset>
                                <div class="form-group">
                                    {!! Form::text( 'title', null, ['class' =>'form-control'.($errors->has('title') ? '
                                    is-invalid' : ''), 'placeholder' => trans('lang.ph.title')] ) !!}
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::text( 'urdu_title', null, ['class' =>'form-control'.($errors->has('urdu_title') ? ' is-invalid' : ''), 'placeholder' => trans('Urdu Title')] ) !!}
                                    @if ($errors->has('urdu_title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('urdu_title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <!-- speciality new field -->
                                <div class="form-group">
                                    <span class="dc-select">
                                        {!! Form::select('speciality_id', $specialities, null, ['class' =>'form-control'.($errors->has('speciality_id') ? ' is-invalid' : ''), 'placeholder' => !empty($specialities) ? trans('lang.ph.select_speciality') : trans('lang.ph.please_add_speciality') ]) !!}
                                        @if ($errors->has('speciality'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('speciality') }}</strong>
                                            </span>
                                        @endif
                                    </span>
                                </div>
                                <!-- endspeciality -->
<!--                                 <div class="form-group">
                                    <input type="text" name="service" id="tag2" class="form-control" placeholder="Enter Services"/>
                                          @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div> -->
                                 <div class="form-group">
                                    <input type="text" name="symptomes" id="tag1" class="form-control" placeholder="Enter Symptomes"/>
                                </div>

                                {{--@if (!empty($diseases))
                                    <div class="form-group">
                                    <span class="dc-select">
                                        <select class="form-control" name="parent">
                                            <option value="0">{{ trans('lang.choose_parent_disease') }}</option>
                                            @php \App\Helper::listTreeCategories('disease'); @endphp
                                        </select>
                                    </span>
                                    </div>
                                @endif--}}
                                <div class="form-group">
                                    {!! Form::textarea( 'urdu_decription', null, ['id' => 'urdu_decription','class' =>'form-control', 'placeholder' => trans('Urdu Description')] ) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::textarea( 'description', null, ['id' => 'description','class' =>'form-control', 'placeholder' =>
                                    trans('lang.ph.disease_desc')] ) !!}
                                </div>
                                <div class="dc-settingscontent form-group">
                                    <div class="dc-formtheme dc-userform">
                                        <upload-media
                                                :img="'disease_image'"
                                                :img_id="'disease_image'"
                                                :img_name="'disease_image'"
                                                :img_ref="'disease_image'"
                                                :img_hidden_name="'disease_image'"
                                                img_hidden_id="'disease_image'"
                                                :url="'{{ url("media/upload-temp-image/disease/disease_image/disease") }}'"
                                        >
                                        </upload-media>
                                    </div>
                                </div>
                                <div class="form-group dc-btnarea">
                                    {!! Form::button(trans('lang.add_disease'), [ 'type' => 'submit' ,'class' => 'dc-btn']) !!}
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
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <script src="{{ asset('js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-tagsinput.min.js') }}"></script>
    <script>
      var data = JSON.stringify({!!json_encode($services)!!});
        /*'[' +
        ' { "value": 2, "text": "Task 2"},' +
        ' { "value": 3, "text": "Task 3"},' +
        ' { "value": 4, "text": "Task 4"},' +
        ' { "value": 5, "text": "Task 5"},' +
        ' { "value": 6, "text": "Task 6"} ]';*/

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

      //insert data to input in load page
      /*elt.tagsinput("add", {
        value: 1,
        title: "task",
      });*/

    </script>
    <script>
      var data = JSON.stringify({!!json_encode($symptomes)!!});
        /*'[' +
        ' { "value": 2, "text": "Task 2"},' +
        ' { "value": 3, "text": "Task 3"},' +
        ' { "value": 4, "text": "Task 4"},' +
        ' { "value": 5, "text": "Task 5"},' +
        ' { "value": 6, "text": "Task 6"} ]';*/

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

      //insert data to input in load page
      /*elt.tagsinput("add", {
        value: 1,
        title: "task",
      });*/

    </script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#checked-val').DataTable();
      } );
</script>
@endpush