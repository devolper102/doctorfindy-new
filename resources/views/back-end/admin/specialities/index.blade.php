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
            margin-bottom: 10px;
        }
        .bootstrap-tagsinput{
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            display: inline-block;
            padding: 4px 6px;
            color: #555;
            vertical-align: middle;
            border-radius: 4px;
            width: 100%;
            /*height: 50px;*/
            line-height: 22px;
            cursor: text;
        }
        .top_speciality .bootstrap-tagsinput{
             width: 83%;


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
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="dc-dashboardbox">
                        <div class="dc-dashboardboxtitle dc-titlewithsearch dc-titlewithdel">
                            <h2>{{ trans('lang.manage_specialities') }}</h2>

                            <div class="dc-rightarea form_head">
                                <multi-delete
                                        v-cloak
                                        v-if="this.is_show"
                                        :title="'{{trans("lang.ph.delete_confirm_title")}}'"
                                        :message="'{{trans("lang.ph.specialities_del_delete_message")}}'"
                                        :url="'{{url('admin/delete-checked-specialities')}}'"
                                        :redirect_url="'{{url('admin/specialities')}}'"
                                >
                                </multi-delete>
                            </div>
                        </div>
                        <a href="{{ route('uploadSpecialitiesContent') }}" class="dc-btn">Upload Specialities Content</a>
                        @if ($specialities->count() > 0)
                            <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table class="table table-striped table-bordered dt-responsive nowrap table-responsive"cellspacing="0" id="checked-val" >
                                    <thead>
                                    <tr>
                                        <th>
                                            <span class="dc-checkbox">
                                                <input name="speciality[]" id="dc-speciality" @click="selectAll" type="checkbox">
                                                <label for="dc-speciality"></label>
                                            </span>
                                        </th>
                                        <th>{{{ trans('lang.img') }}}</th>
                                        <th>App Image</th>
                                        <th>{{{ trans('lang.name') }}}</th>
                                        <th>{{{ trans('lang.slug') }}}</th>
                                        <th>Title</th>
                                        <th class="action">{{{ trans('lang.action') }}}</th>
                                        <th>Created Date</th>
                                        <th>Updated Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $counter = 0; @endphp
                                    @foreach ($specialities as $key => $speciality)
                                        <tr class="del-{{{ $speciality->id }}}">
                                            <td>
                                                <span class="dc-checkbox">
                                                    <input name="speciality[]" @click="selectRecord" value="{{{ intVal(clean($speciality->id)) }}}" id="wt-check-{{{ $counter }}}" type="checkbox">
                                                    <label for="wt-check-{{{ $counter }}}"></label>
                                                </span>
                                            </td>
                                            <td data-th="Icon"><span class="bt-content"><figure><img src="{{{ asset(Helper::getImage('uploads/specialities', $speciality->image, 'extra-small-', 'speciality-default.png')) }}}" alt="{{{ $speciality->title }}}"></figure></span></td>
                                            <td data-th="Icon"><span class="bt-content"><figure><img src="{{{ asset(Helper::getImage('uploads/specialities', $speciality->app_image, 'null', 'speciality-default.png')) }}}" alt="{{{ $speciality->title }}}"></figure></span></td>
                                            <td>{{{ html_entity_decode(clean($speciality->title)) }}}</td>
                                            <td>{{{ html_entity_decode(clean($speciality->slug)) }}}</td>
                                             <td>{{{ html_entity_decode(clean($speciality->user_type)) }}}</td>
                                            <td>
                                                <div class="dc-actionbtn">
                                                    <a href="{{{ route('editSpeciality', html_entity_decode(clean($speciality->slug))) }}}" class="dc-addinfo dc-skillsaddinfo">
                                                        <i class="lnr lnr-pencil"></i>
                                                    </a>
                                                    <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ intVal(clean($speciality->id)) }}'" :message="'{{trans("lang.ph_speciality_delete_message")}}'" :url="'{{url('admin/specialities/delete')}}'" :redirect_url="'{{url('admin/specialities')}}'"></delete>
                                                </div>
                                            </td>
                                            <td>{{ $speciality->created_at->format('M d, Y, H:i A') }}</td>
                                            <td>{{ $speciality->updated_at->format('M d, Y, H:i A') }}</td>
                                        </tr>
                                        @php $counter++; @endphp
                                    @endforeach
                                    </tbody>
                                </table>
                                {{--@if ( method_exists($specialities,'links') )
                                    {{ $specialities->links('pagination.custom') }}
                                @endif--}}
                            </div>
                        @else
                            @include('errors.no-record')
                        @endif
                    </div>
                </div>
            </div>    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-6">
          
           <div class="dc-dashboardbox mb-4">
            <h4 class="mt-4" align="center">Top Specialties</h4>
                <div class="dc-dashboardboxtitle top_speciality">

                    <form action="{{ url('admin/store-specialities') }}"method="post"> 
                        {{csrf_field()}}
                        <div class="form-group">
                            <div class="form-group">
                                    <input type="text" name="speciality" id="tag2" class="form-control" placeholder="Enter speciality/specialities"  />

                                    @if ($errors->has('speciality'))  
                                       <p class="text-danger">{{$errors->first('speciality')}}</p>   
                                    @endif 
                                    <button type="submit"class="dc-btn" name="Search" style="min-width: 15%;"> Add </button>
                                </div>
                                           
                                   
                        </div> 

                    </form>
                </div>
            </div>
            <div class="dc-dashboardbox">
                        
                        @if ($speciality_top->count() > 0)
                            <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table class="dc-tablecategories dc-table-responsive" id="speciality-table">
                                    <thead>
                                    <tr>
                                        
                                        <th>{{{ trans('lang.img') }}}</th>
                                        <th>{{{ trans('lang.name') }}}</th>
                                        <th>{{{ trans('lang.slug') }}}</th>
                                        <th class="action">{{{ trans('lang.action') }}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $counter = 0; @endphp
                                    @foreach ($speciality_top as $key => $speciality)
                                        <tr class="del-{{{ $speciality->id }}}">
                                          
                                            <td data-th="Icon"><span class="bt-content"><figure><img src="{{{ asset(Helper::getImage('uploads/specialities', $speciality->image, 'extra-small-', 'speciality-default.png')) }}}" alt="{{{ $speciality->title }}}"></figure></span></td>
                                            <td>{{{ html_entity_decode(clean($speciality->title)) }}}</td>
                                            <td>{{{ html_entity_decode(clean($speciality->slug)) }}}</td>
                                            <td>
                                                <div class="dc-actionbtn">
                                                    <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ intVal(clean($speciality->id)) }}'" :message="'{{trans("lang.ph_speciality_delete_message")}}'" :url="'{{url('admin/specialities/deleted')}}'" :redirect_url="'{{url('admin/specialities')}}'"></delete>
                                                </div>
                                            </td>
                                        </tr>
                                        @php $counter++; @endphp
                                    @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($speciality_top,'links') )
                                    {{ $speciality_top->links('pagination.custom') }}
                                @endif
                            </div>
                        @else
                            @include('errors.no-record')
                        @endif
                    </div>
                    
        </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-6 dc-responsive-mt mt-lg-0 mt-xl-0">
                    <div class="dc-dashboardbox">
                        <div class="dc-dashboardboxtitle">
                            <h2>{{{ trans('lang.add_new_speciality') }}}</h2>
                        </div>
                        <div class="dc-dashboardboxcontent dc-addspeciality">
                            {!! Form::open(['url' => url('admin/store-speciality'), 'class' => 'dc-formtheme dc-formsearch dc-formtheme dc-userform', 'id' => 'speclity-form'])!!}
                            <fieldset>
                                <input type="hidden" name="type" value="speciality">
                                <div class="form-group">
                                    {!! Form::text( 'title', null, ['class' =>'form-control'.($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => trans('lang.ph.title')] ) !!}
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
                                  <div class="form-group">
                                    {!! Form::text( 'user_type', null, ['class' =>'form-control'.($errors->has('user_type') ? ' is-invalid' : ''), 'placeholder' => trans('User Type')] ) !!}
                                    @if ($errors->has('user_type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('user_type') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <input type="text" name="location" id="tag1" class="form-control" placeholder="Enter Location/Locations"
                                           style="display: none;"/>
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                 <div class="form-group">
                                    <input type="text" name="symptomes" id="tag3" class="form-control" placeholder="Enter Symptomes"/>
                                </div>

                                <div class="form-group">
                                    {!! Form::textarea( 'urdu_description', null, ['class' =>'form-control', 'placeholder' => trans('Urdu Description')] ) !!}
                                </div>
                                      <div class="form-group">
                                    {!! Form::textarea( 'desc', null, ['id' => 'description','class' =>'form-control', 'placeholder' => trans('lang.ph.desc')] ) !!}
                                </div>
                                <div class="dc-settingscontent form-group">
                                    <div class = "dc-formtheme dc-userform">
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

                                    </div>
                                </div>
                                <div class="form-group dc-btnarea">
                                    {!! Form::button(trans('lang.create_speciality'), [ 'type' => 'submit' ,'class' => 'dc-btn']) !!}
                                </div>
                            </fieldset>
                            {!! Form::close(); !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    @stack('backend_scripts')
   {{--  <script src="{{ asset('js/jquery.basictable.min.js') }}"></script>

    <script type="text/javascript">
      jQuery('.dc-table-responsive').basictable({
        breakpoint: 767,
      });

</script> --}}

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js"></script> -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
    <script src="{{ asset('js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-tagsinput.min.js') }}"></script>
    
    <script type="text/javascript">
      var data = JSON.stringify({!!json_encode($location)!!});
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
      var data = JSON.stringify({!!json_encode($specialitty)!!});
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
     <script type="text/javascript">
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

      var elt = $("#tag3");
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
