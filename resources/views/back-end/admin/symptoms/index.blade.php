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
            height: auto;
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
    <div class="dc-locations" id="locations">
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
                            <h2>{{ trans('lang.manage_symptoms') }}</h2>
                        <div class="dc-rightarea form_head">
                            <multi-delete v-cloak v-if="this.is_show"
                                :title="'{{trans("lang.ph.delete_confirm_title")}}'"
                                :message="'{{trans("lang.ph.locations_del_delete_message")}}'"
                                :url="'{{url('admin/delete-checked-symptoms')}}'"
                                :redirect_url="'{{url('admin/symptom')}}'">
                            </multi-delete>
                        </div>
                    </div>
                        @if ($symptoms->count() > 0)
                           <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table class="dc-tablecategories dc-table-responsive" class="table table-bordered table-hover dt-responsive nowrap table-responsive"cellspacing="0" id="checked-val">
                                    <thead>
                                        <tr>
                                           <th>
                                            <span class="dc-checkbox">
                                                <input name="symptoms[]" id="dc-locs" @click="selectAll" type="checkbox">
                                            <label for="dc-locs"></label>
                                            </span>
                                            </th>
                                            <th>{{{ trans('lang.img') }}}</th>
                                        <th>{{{ trans('lang.name') }}}</th>
                                        <th>{{{ trans('lang.slug') }}}</th>
                                        <th class="action">{{{ trans('lang.action') }}}</th>
                                        <th>Created Date</th>
                                        <th>Updated Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($symptoms as $key => $symptom)
                                            <tr class="del-{{{ $symptom->id }}}">
                                                 <td>
                                            <span class="dc-checkbox">
                                                <input name="locs[]" @click="selectRecord" value="{{{ intVal(clean($symptom->id)) }}}"
                                                    id="wt-check-{{{ $counter }}}" type="checkbox">
                                                <label for="wt-check-{{{ $counter }}}"></label>
                                            </span>
                                        </td>
                                               <td data-th="Icon"><span class="bt-content">
                                                 <figure>
                                                    <img src="{{{ asset(Helper::getImage('uploads/symptoms', $symptom->image)) }}}" alt="{{{ html_entity_decode(clean($symptom->title)) }}}">
                                                </figure>
                                            </span></td>
                                            <td>{{{ html_entity_decode(clean($symptom->title)) }}}</td>
                                            <td>{{{ html_entity_decode(clean($symptom->slug)) }}}</td>
                                               
                                                <td>
                                                   <div class="dc-actionbtn">
                                                    <a href="{{{ url('admin/symptom/edit') }}}/{{{ html_entity_decode(clean($symptom->slug)) }}}" class="dc-addinfo dc-skillsaddinfo">
                                                        <i class="lnr lnr-pencil"></i>
                                                    </a>
                                                    <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ intVal(clean($symptom->id)) }}'" :message="'{{trans("lang.ph_symptom_delete_message")}}'" :url="'{{url('admin/symptom/delete')}}'" :redirect_url="'{{url('admin/symptom')}}'"></delete>
                                                    </div>
                                                </td>
                                                <td>{{ $symptom->created_at->format('M d, Y, H:i A') }}</td>
                                                <td>{{ $symptom->updated_at->format('M d, Y, H:i A') }}</td>
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($symptoms,'links') )
                                    {{ $symptoms->links('pagination.custom') }}
                                @endif
                            </div>
                        @else
                            @include('errors.no-record')
                        @endif
                    </div>
                </div>
            </div>   
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-6">

                    <div class="dc-dashboardbox mt-5">
                        <h4 class="mt-4" align="center">Top Symptoms</h4>
                        <div class="dc-dashboardboxtitle top_speciality">

                            <form action="{{ url('admin/store-symptoms') }}"method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <div class="form-group">
                                        <input type="text" name="symptom" id="tag2" class="form-control" placeholder="Enter Symptoms"  />
                                        @if ($errors->has('symptom'))  
                                         
                                           <p class="text-danger">{{$errors->first('symptom')}}</p>   
                                    @endif 
                                        <button type="submit"class="dc-btn" name="Search" style="min-width: 15%;"> Add </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="dc-dashboardbox mt-5 pt-4">

                        @if ($symptom_top->count() > 0)
                            <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table class="dc-tablecategories dc-table-responsive" id="checked-val">
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
                                    @foreach ($symptom_top as $key => $symptom)
                                        <tr class="del-{{{ $symptom->id }}}">

                                            <td data-th="Icon"><span class="bt-content"><figure><img src="{{{ asset(Helper::getImage('uploads/symptoms', $symptom->image)) }}}" alt="{{{ html_entity_decode(clean($symptom->title)) }}}"></figure></span></td>
                                            <td>{{{ html_entity_decode(clean($symptom->title)) }}}</td>
                                            <td>{{{ html_entity_decode(clean($symptom->slug)) }}}</td>
                                            <td>
                                                <div class="dc-actionbtn">
                                                    <delete
                                                            :title="'{{trans("lang.ph_delete_confirm_title")}}'"
                                                            :id="'{{ intVal(clean($symptom->id)) }}'"
                                                            :message="'{{trans("lang.ph_speciality_delete_message")}}'"
                                                            :url="'{{url('admin/symptom/deleted')}}'"
                                                            :redirect_url="'{{url('admin/symptom')}}'"></delete>
                                                </div>
                                            </td>
                                        </tr>
                                        @php $counter++; @endphp
                                    @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($symptom_top,'links') )
                                    {{ $symptom_top->links('pagination.custom') }}
                                @endif
                            </div>
                        @else
                            @include('errors.no-record')
                        @endif
                    </div>

                </div>
 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-6 dc-responsive-mt mt-lg-0 mt-xl-0">
                    <div class="dc-dashboardbox mt-5 pt-4">
                        <div class="dc-dashboardboxtitle">
                            <h2>{{{ trans('lang.add_new_symptom') }}}</h2>
                        </div>
                        <div class="dc-dashboardboxcontent dc-addspeciality">
                            {!! Form::open(['url' => url('admin/store-symptom'), 'class' => 'dc-formtheme dc-formsearch dc-formtheme dc-userform', 'id' => 'symptom-form'])!!}
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
                                    <input type="text" name="service" id="tag1" class="form-control" placeholder="Enter Service"
                                           style="display: none;"/>
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                  <div class="form-group">
                                      <input type="checkbox" id="test_symptom" name="test_symptom" value="1"> <label for="test_symptom">Speciality Test symptom </label>
                                </div>
                                <div class="form-group">
                                    {!! Form::textarea( 'desc', null, ['id' => 'description','class' =>'form-control', 'placeholder' => trans('lang.ph.desc')] ) !!}
                                </div>
                                <div class="dc-settingscontent form-group">
                                    <div class = "dc-formtheme dc-userform">
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
                                    </div>
                                </div>
                                <div class="form-group dc-btnarea">
                                    {!! Form::button(trans('lang.create_symptom'), [ 'type' => 'submit' ,'class' => 'dc-btn']) !!}
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
{{--    <script src="{{ asset('js/jquery.basictable.min.js') }}"></script>--}}

    <script type="text/javascript">
      jQuery('.dc-table-responsive').basictable({
        breakpoint: 767,
      });

    </script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js"></script> -->
  <!--   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    
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

    <script>
      var data = JSON.stringify({!!json_encode($symptomss)!!});
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
      $(document).ready(function() {
        $('#checked-val').DataTable();
      } );
</script>
@endpush
