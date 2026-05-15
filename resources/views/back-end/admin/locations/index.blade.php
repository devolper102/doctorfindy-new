@extends('back-end.master')
@push('backend_stylesheets')
<link href="{{ asset('css/basictable.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <link href="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <link href="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/examples/assets/app.css">

    <style>
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
            padding: 1px 6px;
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
        @media (max-width:576px) {
            .bootstrap-tagsinput{
                width: 78%;
            }
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
                        <h2>{{{ trans('lang.manage_locations') }}}</h2>
                        <div class="dc-rightarea form_head">
                            <multi-delete v-cloak v-if="this.is_show"
                                :title="'{{trans("lang.ph.delete_confirm_title")}}'"
                                :message="'{{trans("lang.ph.locations_del_delete_message")}}'"
                                :url="'{{url('admin/delete-checked-locations')}}'"
                                :redirect_url="'{{url('admin/locations')}}'">
                            </multi-delete>
                        </div>
                    </div>
                    @if ($locations->count() > 0)
                    <div class="dc-dashboardboxcontent dc-categoriescontentholder table-responsive">
                        <table class="table table-striped table-bordered dt-responsive nowrap table-responsive" cellspacing="0" id="checked-val">
                            <thead>
                                <tr>
                                    <th>
                                        <span class="dc-checkbox">
                                            <input name="locs[]" id="dc-locs" @click="selectAll" type="checkbox">
                                            <label for="dc-locs"></label>
                                        </span>
                                    </th>
                                    <th>{{{ trans('lang.location_icon') }}}</th>
                                    <th>{{{ trans('lang.name') }}}</th>
                                    <th>{{{ trans('lang.slug') }}}</th>
                                    <th>{{{ trans('lang.action') }}}</th>
                                    <th>Created Date</th>
                                    <th>Updated Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter = 0; @endphp
                                @foreach ($locations as $key => $location)
                                    <tr class="del-{{{ $location->id }}}">
                                        <td>
                                            <span class="dc-checkbox">
                                                <input name="locs[]" @click="selectRecord" value="{{{ intVal(clean($location->id)) }}}"
                                                    id="wt-check-{{{ $counter }}}" type="checkbox">
                                                <label for="wt-check-{{{ $counter }}}"></label>
                                            </span>
                                        </td>
                                        <td data-th="Icon">
                                            <span class="bt-content">
                                                <figure>
                                                    <img src="{{{ asset(Helper::getImage('uploads/locations', $location->flag)) }}}" alt="{{{ html_entity_decode(clean($location->title)) }}}">
                                                </figure>
                                            </span>
                                        </td>
                                        <td>{{{ html_entity_decode(clean($location->title)) }}}</td>
                                        <td>{{{ html_entity_decode(clean($location->slug)) }}}</td>
                                        <td>
                                            <div class="dc-actionbtn">
                                                <a href="{{{ url('admin/locations/edit') }}}/{{{ html_entity_decode(clean($location->slug)) }}}"
                                                    class="dc-addinfo dc-skillsaddinfo">
                                                    <i class="lnr lnr-pencil"></i>
                                                </a>
                                                <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'"
                                                    :id="'{{ intVal(clean($location->id)) }}'"
                                                    :message="'{{trans("lang.ph_loc_delete_message")}}'"
                                                    :url="'{{url('admin/locations/delete')}}'"
                                                    :redirect_url="'{{url('admin/locations')}}'">
                                                </delete>
                                            </div>
                                        </td>
                                        <td>{{ $location->created_at->format('M d, Y, H:i A') }}</td>
                                        <td>{{ $location->updated_at->format('M d, Y, H:i A') }}</td>
                                    </tr>
                                    @php $counter++; @endphp
                                @endforeach
                            </tbody>
                        </table>
                        @if ( method_exists($locations,'links') )
                            {{ $locations->links('pagination.custom') }}
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
                <div class="dc-dashboardbox">
                    <h4 class="mt-4" align="center">Top Locations</h4>
                    <div class="dc-dashboardboxtitle">
                        <form action="{{ url('admin/store-locations') }}"method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <div class="form-group">
                                    <input type="text" name="location" id="tag2" class="form-control" placeholder="Enter location/locations" />
                                     @if ($errors->has('location'))  
                                          
                                           <p class="text-danger">{{$errors->first('location')}}</p>   
                                    @endif 
                                    <button type="submit"class="dc-btn" name="Search" value="Add" style="min-width: 15%;"> Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="dc-dashboardbox">
                    @if ($location_tops->count() > 0)
                        <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                            <table class="dc-tablecategories dc-table-responsive" id="location-table">
                                <thead>
                                <tr>
                                    <th>{{{ trans('lang.location_icon') }}}</th>
                                    <th>{{{ trans('lang.name') }}}</th>
                                    <th>{{{ trans('lang.slug') }}}</th>
                                    <th>{{{ trans('lang.action') }}}</th>
                                </tr>
                                </thead>
                            <tbody>
                                @php $counter = 0; @endphp
                                @foreach ($location_tops as $key => $location)
                                    <tr class="del-{{{ $location->id }}}">
                                       
                                        <td data-th="Icon">
                                            <span class="bt-content">
                                                <figure>
                                                    <img src="{{{ asset(Helper::getImage('uploads/locations', $location->flag)) }}}" alt="{{{ html_entity_decode(clean($location->title)) }}}">
                                                </figure>
                                            </span>
                                        </td>
                                        <td>{{{ html_entity_decode(clean($location->title)) }}}</td>
                                        <td>{{{ html_entity_decode(clean($location->slug)) }}}</td>
                                        <td>
                                            <div class="dc-actionbtn">
                                              
                                               <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'"
                                                    :id="'{{ intVal(clean($location->id)) }}'"
                                                    :message="'{{trans("lang.ph_loc_delete_message")}}'"
                                                    :url="'{{url('admin/locations/deleted')}}'"
                                                    :redirect_url="'{{url('admin/locations')}}'">
                                                </delete>
                                            </div>
                                        </td>
                                    </tr>
                                    @php $counter++; @endphp
                                @endforeach
                            </tbody>
                        </table>
                        @if ( method_exists($location_tops,'links') )
                            {{ $location_tops->links('pagination.custom') }}
                        @endif
                    </div>
                    @else
                    @include('errors.no-record')
                    @endif
         </div>
        </div>
             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-6 dc-responsive-mt mt-lg-0 mt-xl-0">
                <div class="dc-dashboardbox dc-offered-holder dc-addnewlocation">
                    <div class="dc-dashboardboxtitle">
                        <h2>{{{ trans('lang.add_new_location') }}}</h2>
                    </div>
                    <div class="dc-dashboardboxcontent">
                        {!! Form::open([
                        'url' => url('admin/store-location'),
                        'class' =>'dc-formtheme dc-formprojectinfo dc-formcategory dc-formtheme dc-userform ',  'id'=>
                        'locations-form'
                        ])
                        !!}
                        <fieldset>
                            <div class="form-group">

                                {!! Form::text( 'title', null, ['class' =>'form-control'.($errors->has('title') ? '
                                is-invalid' : ''), 'id' => 'autocomplete', 'placeholder' => trans('lang.ph.title')] ) !!}
                                
                                @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                            @if (!empty($locations))
                                <div class="form-group">
                                    <span class="dc-select">
                                        <select class="form-control" name="parent_location">
                                            <option value="0">{{ trans('lang.choose_parent_loc') }}</option>
                                            @php \App\Helper::listTreeCategories('location'); @endphp
                                        </select>
                                    </span>
                                </div>
                            @endif
                            <div class="form-group">
                                {!! Form::textarea( 'loc_desc', null, ['class' =>'form-control','id' =>'description', 'placeholder' =>
                                trans('lang.ph.loc_desc')] ) !!}
                                <input type="hidden" id="address_lat" name="latitude">
                                <input type="hidden" id="address_long" name="longitude">
                            </div>
                            <div class="dc-settingscontent form-group">
                                <div class="dc-formtheme dc-userform">
                                    <upload-media :img="'location_image'" :img_id="'location_image'"
                                        :img_name="'location_image'" :img_ref="'location_image'"
                                        :img_hidden_name="'hidden_location_image'"
                                        :img_hidden_id="'hidden_location_image'"
                                        :url="'{{ url("media/upload-temp-image/locations/location_image/location") }}'">
                                    </upload-media>
                                </div>
                            </div>
                            <div class="form-group dc-btnarea">
                                {!! Form::button(trans('lang.add_loc'), [ 'type' => 'submit' ,'class' => 'dc-btn']) !!}
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
    <script type="text/javascript">
      $(document).ready(function() {
        $('#checked-val').DataTable();
      } );
</script>
{{--<script src="{{ asset('js/jquery.basictable.min.js') }}"></script>--}}
<script type="text/javascript">
    jQuery('.dc-table-responsive').basictable({
            breakpoint: 767,
    });
</script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    <script src="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script>
      var data = JSON.stringify({!!json_encode($location_top)!!});
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

@endpush