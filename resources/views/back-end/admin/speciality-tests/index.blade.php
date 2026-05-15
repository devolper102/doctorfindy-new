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
                            <h2>Manage Speciality Test</h2>
                        </div>
                        @if ($tests->count() > 0)
                           <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table id="tests"  class="table table-bordered table-hover dt-responsive nowrap table-responsive"cellspacing="0">
                                    <thead>
                                        <tr>
                                          
                                            <th>Title</th>
                                             <th>Fee</th>
                                            <th>Speciality Name</th>
                                            <th>Type</th>
                                            <th class="action">{{{ trans('lang.action') }}}</th>
                                            <th>Created Date</th>
                                            <th>Updated Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($tests as $key => $test)
                                            <tr class="del-{{{ $test->id }}}">
                                        <td>
                                          {{$test->title}}
                                        </td>
                                         <td>
                                          {{$test->price}}
                                        </td>
                                        <td>
                                            {{optional($test->specialities)->title}}
                                        </td>
                                          @if($test->type == 'national')
                                                <td>National</td>
                                                @else
                                                <td>International</td>
                                                @endif
                                                <td>
                                                    <div class="dc-actionbtn">
                                                        <a href="{{action('Speciality_TestController@edit',$test->id) }}" class="dc-addinfo dc-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                    <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ intVal(clean($test->id)) }}'" :message="'{{trans("Speciality Test Deleted Successfully")}}'" :url="'{{url('admin/test/delete')}}'" :redirect_url="'{{url('admin/speciality-test')}}'"></delete>
                                                    </div>
                                                </td>
                                                
                                                @if ($test && $test->created_at)
                                                    <td>{{ $test->created_at->format('M d, Y, H:i A') }}</td>
                                                @else
                                                    <td>Null</td>
                                                @endif

                                                 @if ($test && $test->updated_at)
                                                    <td>{{ $test->updated_at->format('M d, Y, H:i A') }}</td>
                                                @else
                                                    <td>Null</td>
                                                @endif
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($tests,'links') )
                                    {{ $tests->links('pagination.custom') }}
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
        <div class="dc-dashboardbox mt-5 pt-2">
            <div class="dc-dashboardboxtitle dc-titlewithsearch dc-titlewithdel">
                        	<h2>Add Speciality Test</h2>
                <div class="dc-dashboardboxtitle">

                    <form action="{{ url('admin/store-test') }}"method="post"> 
                        {{csrf_field()}}
                        <div class="form-group">
                              <div class="form-group">
                                    <input type="text" name="title"  class="form-control" placeholder="Enter Title" />
                                    @if ($errors->has('title'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('title')}}</p>   
                                    @endif  
                                </div>
                                <!-- <div class="form-group">
                                    <input type="text" name="title"  class="form-control" placeholder="Enter Url" value="{{ $test->url_title }}"/>
                                    @if ($errors->has('url_title'))  
                                           <p class="text-danger">{{$errors->first('url_title')}}</p>   
                                    @endif  
                                    
                                </div> -->
                                <div class="form-group">
                                    <input type="text" name="price"  class="form-control" placeholder="Enter Fee" />
                                    @if ($errors->has('price'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('price')}}</p>   
                                    @endif  
                                </div>
                                <div class="form-group">
                                     <span class="dc-select">
                                    <select name="speciality_id" id="speciality_id" class="form-control">
                                       <option value="">Select Speciality</option>
                                       @foreach ($specialities as $key => $speciality)
                                        <option value="{{$speciality->id}}">{{$speciality->title}}</option>
                                        @endforeach
                                        
                                    </select>
                                </span>
                                    @if ($errors->has('speciality_id'))  
                                           <p class="text-danger">{{$errors->first('speciality_id')}}</p>   
                                    @endif
                                     
                                </div>
                                  <div class="form-group">
                                    <span class="dc-select">
                                    <select name="type" id="type" class="form-control">
                                       <option value="">Select Type</option>
                                        <option value="national">National</option>
                                        <option value="international">International</option>
                                    </select>
                                    </span>
                                    @if ($errors->has('type'))  
                                           <p class="text-danger">{{$errors->first('type')}}</p>   
                                    @endif
                                </div>
                                 <div class="form-group">
                                    <input type="text" name="symptoms" id="tag" class="form-control" placeholder="Enter Symptoms"/>
                                    @if ($errors->has('symptoms'))  
                                           <p class="text-danger">{{$errors->first('symptoms')}}</p>   
                                    @endif
                                </div>
                                 <div class="form-group">
                                    {!! Form::textarea( 'details', null, ['id' => 'details','class' =>'form-control', 'placeholder' =>
                                    trans('Short details')] ) !!}
                                </div>
                                 <div class="form-group">
                                    {!! Form::textarea( 'description', null, ['id' => 'description','class' =>'form-control', 'placeholder' =>
                                    trans('Description')] ) !!}
                                </div>
                              
                                <div class="form-group dc-btnarea">
                                       <button type="submit" name="submit" class="dc-btn">Create Test</button>
                                </div>      
                                   
                        </div> 

                    </form>
                </div>
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
<script type="text/javascript">
      $(document).ready(function() {
        $('#tests').DataTable();
      } );
</script>
<!--   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  -->
  
    <script src="{{ asset('js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-tagsinput.min.js') }}">
</script>
    <script>
      var data = JSON.stringify({!!json_encode($symptoms)!!});
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

      var elt = $("#tag");
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
