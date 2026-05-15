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
            width: 83%;
            /*height: 50px;*/
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
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="dc-dashboardbox">
                        <div class="dc-dashboardboxtitle dc-titlewithsearch dc-titlewithdel">
                            <h2>{{{ trans('lang.manage_services') }}}</h2>
                            <div class="dc-rightarea form_head">
                                <multi-delete
                                    v-cloak
                                    v-if="this.is_show"
                                    :title="'{{trans("lang.ph.delete_confirm_title")}}'"
                                    :message="'{{trans("lang.ph.services_del_delete_message")}}'"
                                    :url="'{{url('admin/delete-checked-services')}}'"
                                    :redirect_url="'{{url('admin/services')}}'"
                                >
                                </multi-delete>
                            </div>
                        </div>
                        @if ($services->count() > 0)
                            <div class="dc-dashboardboxcontent dc-categoriescontentholder ">
                                <table class="dc-tablecategories dc-table-responsive table table-bordered table-hover dt-responsive nowrap table-responsive" cellspacing="0" id="checked-val">
                                    <thead>
                                        <tr>
                                            <th>
                                                <span class="dc-checkbox">
                                                    <input name="services[]" id="dc-services" @click="selectAll" type="checkbox">
                                                    <label for="dc-services"></label>
                                                </span>
                                            </th>
                                            <th>{{{ trans('lang.name') }}}</th>
                                            <th>{{{ trans('lang.slug') }}}</th>
                                            <th>Speciality</th>
                                            <th>{{{ trans('lang.action') }}}</th>
                                            <th>Created Date</th>
                                            <th>Updated Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($services as $key => $service)
                                            <tr class="del-{{{ $service->id }}}">
                                                <td>
                                                    <span class="dc-checkbox">
                                                        <input name="services[]" @click="selectRecord" value="{{{ intVal(clean($service->id)) }}}" id="wt-check-{{{ $counter }}}" type="checkbox">
                                                        <label for="wt-check-{{{ $counter }}}"></label>
                                                    </span>
                                                </td>
                                                <td>{{{ html_entity_decode(clean($service->title)) }}}</td>
                                                <td>{{{ html_entity_decode(clean($service->slug)) }}}</td>
                                                <td>
                                                    @if($service->speciality !== null)
                                                    {{{ $service->speciality->title }}}
                                                    @else
                                                    -
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="dc-actionbtn">
                                                        <a href="{{{ url('admin/services/edit') }}}/{{{ html_entity_decode(clean($service->slug)) }}}" class="dc-addinfo dc-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                        <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ intVal(clean($service->id)) }}'" :message="'{{trans("lang.ph_loc_service_del_msg")}}'" :url="'{{url('admin/services/delete')}}'" :redirect_url="'{{url('admin/services')}}'"></delete>
                                                         <a href="{{ url('service') }}/{{ $service->slug }}" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>

                                                    </div>
                                                </td>
                                                <td>{{ $service->created_at->format('M d, Y, H:i A') }}</td>
                                                <td>{{ $service->updated_at->format('M d, Y, H:i A') }}</td>
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($services,'links') )
                                    {{ $services->links('pagination.custom') }}
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
            <h4 class="mt-4" align="center">Top Services</h4>
                <div class="dc-dashboardboxtitle">

                    <form action="{{ url('admin/store-services') }}"method="post"> 
                        {{csrf_field()}}
                        <div class="form-group">
                            <div class="form-group">
                                    <input type="text" name="service" id="tag2" class="form-control" placeholder="Enter service/services" />
                                        @if ($errors->has('service'))  
                                          
                                           <p class="text-danger">{{$errors->first('service')}}</p>   
                                    @endif 
                                    <button type="submit"class="dc-btn" name="Search" style="min-width: 15%;"> Add </button>
                                </div>
                                           
                                   
                        </div> 

                    </form>
                </div>
            </div>
         <div class="dc-dashboardbox mt-5 pt-4">   
             @if ($service_tops->count() > 0)
                            <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table class="dc-tablecategories dc-table-responsive" id="checked-val">
                                    <thead>
                                        <tr>
                                           
                                            <th>{{{ trans('lang.name') }}}</th>
                                            <th>{{{ trans('lang.slug') }}}</th>
                                            <th>{{{ trans('lang.action') }}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($service_tops as $key => $service)
                                            <tr class="del-{{{ $service->id }}}">
                                               
                                                <td>{{{ html_entity_decode(clean($service->title)) }}}</td>
                                                <td>{{{ html_entity_decode(clean($service->slug)) }}}</td>
                                                <td>
                                                    <div class="dc-actionbtn">
                                                       
                                                        <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ intVal(clean($service->id)) }}'" :message="'{{trans("lang.ph_loc_service_del_msg")}}'" :url="'{{url('admin/services/deleted')}}'" :redirect_url="'{{url('admin/services')}}'"></delete>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($service_tops,'links') )
                                    {{ $service_tops->links('pagination.custom') }}
                                @endif
                            </div>
                        @else
                            @include('errors.no-record')
                        @endif
                    
                </div>    
        </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-6 dc-responsive-mt mt-lg-0 mt-xl-0">
                    <div class="dc-dashboardbox dc-offered-holder mt-5 pt-4">
                        <div class="dc-dashboardboxtitle">
                            <h2>{{{ trans('lang.add_new_service') }}}</h2>
                        </div>
                        <div class="dc-dashboardboxcontent">
                            {!! Form::open([
                                'url' => url('admin/store-service'),
                                'class' =>'dc-formtheme dc-formprojectinfo dc-formcategory dc-userform', 'id'=> 'services-form'
                                ])
                            !!}
                                <fieldset>
                                     <input type="hidden" name="type" value="service">
                                    <div class="form-group">
                                        {!! Form::text( 'title', null, ['class' =>'form-control'.($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => trans('lang.ph.title')] ) !!}
                                        @if ($errors->has('title'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <span class="dc-select">
                                            {!! Form::select('speciality', $specialities, null, ['class' =>'form-control'.($errors->has('speciality') ? ' is-invalid' : ''), 'placeholder' => !empty($specialities) ? trans('lang.ph.select_speciality') : trans('lang.ph.please_add_speciality') ]) !!}
                                            @if ($errors->has('speciality'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('speciality') }}</strong>
                                                </span>
                                            @endif
                                        </span>
                                    </div>
                                   <div class="form-group">
                                    {!! Form::textarea( 'description', null, ['id' => 'description','class' =>'form-control', 'placeholder' => trans('lang.ph.desc')] ) !!}
                                </div>
                                <div class="dc-settingscontent form-group">
                                    <div class = "dc-formtheme dc-userform">
                                           <upload-media
                                                :img="'service_image'"
                                                :img_id="'service_image'"
                                                :img_name="'service_image'"
                                                :img_ref="'service_image'"
                                                :img_hidden_name="'service_image'"
                                                img_hidden_id="'service_image'"
                                                :url="'{{ url("media/upload-temp-image/services/service_image/service") }}'"
                                        >
                                        </upload-media>
                                    </div>
                                </div>
                                    <div class="form-group dc-btnarea">
                                        {!! Form::button(trans('lang.add_service'), [ 'type' => 'submit' ,'class' => 'dc-btn']) !!}
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
{{--<script src="{{ asset('js/jquery.basictable.min.js') }}"></script>--}}
<script type="text/javascript">
    jQuery('.dc-table-responsive').basictable({
            breakpoint: 767,
    });
</script>


 <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js"></script> -->
<!--     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <script src="{{ asset('js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-tagsinput.min.js') }}"></script>
<script>
      var data = JSON.stringify({!!json_encode($service_all)!!});
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