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
                            <h2>Manage Treatments</h2>
                        <div class="dc-rightarea form_head">
                            <multi-delete v-cloak v-if="this.is_show"
                                :title="'{{trans("lang.ph.delete_confirm_title")}}'"
                                :message="'{{trans("lang.ph.locations_del_delete_message")}}'"
                                :url="'{{url('admin/delete-checked-treatments')}}'"
                                :redirect_url="'{{url('admin/treatments')}}'">
                            </multi-delete>
                        </div>
                    </div>
                        @if ($treatments->count() > 0)
                           <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table class="dc-tablecategories dc-table-responsive table table-bordered table-hover dt-responsive nowrap table-responsive" cellspacing="0" id="checked-val">
                                    <thead>
                                        <tr>
                                           <th>
                                            <span class="dc-checkbox">
                                                <input name="treatments[]" id="dc-locs" @click="selectAll" type="checkbox">
                                            <label for="dc-locs"></label>
                                            </span>
                                            </th>
                                            <th>Name</th>
                                            
                                            <th class="action">{{{ trans('lang.action') }}}</th>
                                            <th>Created Date</th>
                                            <th>Updated Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($treatments as $key => $treatment)
                                            <tr class="del-{{{ $treatment->id }}}">
                                                 <td>
                                            <span class="dc-checkbox">
                                                <input name="locs[]" @click="selectRecord" value="{{{ intVal(clean($treatment->id)) }}}"
                                                    id="wt-check-{{{ $counter }}}" type="checkbox">
                                                <label for="wt-check-{{{ $counter }}}"></label>
                                            </span>
                                        </td>
                                                <td>{{$treatment->title}}</td>
                                               
                                                <td>
                                                    <div class="dc-actionbtn">
                                                        <a href="{{action('TreatmentController@edit',$treatment->id) }}" class="dc-addinfo dc-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                
                                                    <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ intVal(clean($treatment->id)) }}'" :message="'{{trans("Treatment deleted successfully")}}'" :url="'{{url('admin/treatments/delete')}}'" :redirect_url="'{{url('admin/treatments')}}'"></delete>
                                               

                                                       

                                                    </div>
                                                </td>
                                                <td>{{ $treatment->created_at->format('M d, Y, H:i A') }}</td>
                                                <td>{{ $treatment->updated_at->format('M d, Y, H:i A') }}</td>
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($treatments,'links') )
                                    {{ $treatments->links('pagination.custom') }}
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
                    <div class="dc-dashboardbox mt-5 pt-4">
                        <div class="dc-dashboardboxtitle">
                            <h2>{{{ trans('Add New Treatment') }}}</h2>
                        </div>
                        <div class="dc-dashboardboxtitle">

                    <form action="{{ url('admin/store-treatment') }}"method="post"> 
                        {{csrf_field()}}
                        <div class="form-group">
                                <div class="form-group">
                                    <input type="text" name="title" id="tag2" class="form-control" placeholder="Title" />
                                    @if ($errors->has('title'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('title')}}</p>   
                                    @endif  
                                    
                                </div>
                                 <div class="form-group">
                                    <input type="text" name="diseases" id="tag1" class="form-control" placeholder="Enter Diseases/Diseases"
                                           />
                                  @if ($errors->has('diseases'))  
                                          
                                           <p class="text-danger">{{$errors->first('diseases')}}</p>   
                                    @endif
                                </div>
                                 <div class="form-group">
                                    {!! Form::textarea( 'description', null, ['id' => 'description','class' =>'form-control', 'placeholder' => trans('lang.ph.desc')] ) !!}
                                </div> 
                                <div class="form-group dc-btnarea">
                                       <button type="submit" name="submit" class="dc-btn"> Create Treatment</button>
                                </div>      
                                   
                        </div> 

                    </form>
                </div>
                       
                    </div>
                </div>
            </div>    
            </div>
   
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
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    
    <script src="{{ asset('js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-tagsinput.min.js') }}"></script>
   <script>
      var data = JSON.stringify({!!json_encode($diseases)!!});
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
