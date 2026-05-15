@extends('back-end.master')
@push('backend_stylesheets')
 <link href="{{ asset('css/basictable.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-beta.min.css') }}"  rel="stylesheet">
    <link href="{{ asset('css/bootstrap-tagsinput.css') }}"  rel="stylesheet">
    <link href="{{ asset('css/tagsinput-app.css') }}"  rel="stylesheet">

     <style>
        #example{
            width: 100% !important;
        }
    </style>
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
            
                         <div class="dc-dashboardbox dc-offered-holder">
                         <div class="dc-dashboardboxtitle dc-titlewithsearch dc-titlewithdel">
                            <h2>Manage Frequently Asked Questions</h2>
                          <!--    <div class="dc-rightarea form_head">
                                {!! Form::open(['url' => url('admin/faq/search'),
                                    'method' => 'get', 'class' => 'dc-formtheme dc-formsearch'])
                                !!}
                                    <fieldset>
                                        <div class="form-group">
                                            <input type="text" name="keyword" value="{{{ !empty($_GET['keyword']) ? $_GET['keyword'] : '' }}}"
                                                class="form-control" placeholder="{{{ trans('Search Faq') }}}">
                                            <button type="submit" class="dc-searchgbtn"><i class="lnr lnr-magnifier"></i></button>
                                        </div>
                                    </fieldset>
                                {!! Form::close() !!}
                            </div> -->
                        </div>
                         @if ($faqs->count() > 0)
                            <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table id="example"  class="table table-bordered table-hover dt-responsive nowrap table-responsive"cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Diseases</th>
                                            <th>Specialities</th>
                                            <th>Services</th>
                                            <th>Symptoms</th>
                                            <th>Treatments</th>
                                            <th>Surgeries</th>
                                            <th>Page URL</th>
                                            <th >{{{ trans('lang.action') }}}</th>
                                            <th class="none">Faq's</th>
                                            <th>Created Date</th>
                                            <th>Updated Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($faqs as $key => $faq)
                                            <tr class="del-{{{ $faq->id }}}">
                                                 <td>
                           <!--  @php
                            $all_data =   DB::table('faq_assign')->where('faq_id',$faq->id)->limit(10)->get();
                             @endphp
                @foreach ($all_data as $key => $data)
                        @if($data->type =='diseases')
                           
                            @php
                            $dis_data =   DB::table('diseases')->where('id',$data->assign_value)->limit(10)->get();
                             @endphp

                            @foreach ($dis_data as $key => $disease)
                             
                              {{$disease->title}}<br>
                            @endforeach
                           {{$data->assign_value}} 
                        @endif
                @endforeach -->
                @php
                $all_data = App\FaqAssign::where('faq_id', $faq->id)->limit(10)->get();
                @endphp

                @foreach ($all_data as $key => $data)
                    @if($data->type == 'diseases')
                        @php
                        $dis_data = $data->disease()->limit(10)->get();
                        @endphp

                        @foreach ($dis_data as $key => $disease)
                            {{ $disease->title }}<br>
                        @endforeach
                        <!-- {{ $data->assign_value }} -->
                    @endif
                @endforeach


                                                </td>
                                                <td>
                                                       <!--  @php
                            $all_data =   DB::table('faq_assign')->where('faq_id',$faq->id)->limit(10)->get();
                             @endphp
                @foreach ($all_data as $key => $data)
                        @if($data->type =='speciality')
                           
                            @php
                            $dis_data =   DB::table('specialities')->where('id',$data->assign_value)->limit(10)->get();
                             @endphp

                            @foreach ($dis_data as $key => $disease)
                             
                              {{$disease->title}}<br>
                            @endforeach
                         
                        @endif
                @endforeach -->
                @php
                $all_data = App\FaqAssign::where('faq_id', $faq->id)->where('type', 'speciality')->limit(10)->get();
                @endphp

                @foreach ($all_data as $key => $data)
                    @php
                    $speciality = $data->speciality;
                    @endphp

                    @if ($speciality)
                        {{ $speciality->title }}<br>
                    @endif
                @endforeach

                                                </td>
                                                <td>
                                                         <!--  @php
                            $all_data =   DB::table('faq_assign')->where('faq_id',$faq->id)->limit(10)->get();
                             @endphp
                @foreach ($all_data as $key => $data)
                        @if($data->type =='service')
                           
                            @php
                            $dis_data =   DB::table('services')->where('id',$data->assign_value)->limit(10)->get();
                             @endphp

                            @foreach ($dis_data as $key => $disease)
                             
                              {{$disease->title}}<br>
                            @endforeach
                         
                        @endif
                @endforeach -->
                @php
                $all_data = App\FaqAssign::where('faq_id', $faq->id)->where('type', 'service')->limit(10)->get();
                @endphp

                @foreach ($all_data as $key => $data)
                    @php
                    $service = $data->service;
                    @endphp

                    @if ($service)
                        {{ $service->title }}<br>
                    @endif
                @endforeach

                                                </td>
                                                <td><!-- 
                                                          @php
                            $all_data =   DB::table('faq_assign')->where('faq_id',$faq->id)->limit(10)->get();
                             @endphp
                @foreach ($all_data as $key => $data)
                        @if($data->type =='symptom')
                           
                            @php
                            $dis_data =   DB::table('symptoms')->where('id',$data->assign_value)->get();
                             @endphp

                            @foreach ($dis_data as $key => $disease)
                             
                              {{$disease->title}}<br>
                            @endforeach
                         
                        @endif
                @endforeach -->
                @php
                    $all_data = App\FaqAssign::where('faq_id', $faq->id)->where('type', 'symptom')->limit(10)->get();
                    @endphp

                    @foreach ($all_data as $key => $data)
                        @php
                        $symptom = $data->symptom;
                        @endphp

                        @if ($symptom)
                            {{ $symptom->title }}<br>
                        @endif
                    @endforeach

                                                </td>
                                                <td>
                                                         <!--  @php
                            $all_data =   DB::table('faq_assign')->where('faq_id',$faq->id)->limit(10)->get();
                             @endphp
                @foreach ($all_data as $key => $data)
                        @if($data->type =='treatment')
                           
                            @php
                            $dis_data =   DB::table('treatments')->where('id',$data->assign_value)->get();
                             @endphp

                            @foreach ($dis_data as $key => $disease)
                             
                              {{$disease->title}}<br>
                            @endforeach
                          
                        @endif
                @endforeach -->
                @php
                    $all_data = App\FaqAssign::where('faq_id', $faq->id)->where('type', 'treatment')->limit(10)->get();
                    @endphp

                    @foreach ($all_data as $key => $data)
                        @php
                        $treatment = $data->treatment;
                        @endphp

                        @if ($treatment)
                            {{ $treatment->title }}<br>
                        @endif
                    @endforeach

                                                </td>
                                                       <td>
                                                         <!--  @php
                            $all_data =   DB::table('faq_assign')->where('faq_id',$faq->id)->limit(10)->get();
                             @endphp
                @foreach ($all_data as $key => $data)
                        @if($data->type =='procedure')
                           
                            @php
                            $dis_data =   DB::table('procedures')->where('id',$data->assign_value)->get();
                             @endphp

                            @foreach ($dis_data as $key => $data)
                             
                              {{$data->title}}<br>
                            @endforeach
                          
                        @endif
                @endforeach -->
                @php
                $all_data = App\FaqAssign::where('faq_id', $faq->id)->where('type', 'procedure')->limit(10)->get();
                @endphp

                @foreach ($all_data as $key => $data)
                    @php
                    $procedure = $data->procedure;
                    @endphp

                    @if ($procedure)
                        {{ $procedure->title }}<br>
                    @endif
                @endforeach

                                                </td>
                                                <td>{{$faq->page_url}}</td>
                                                
                                                <td>
                                                    <div class="dc-actionbtn">
                                                    @if($faq->status ==  0)
                                                        <a class="dc-addinfo dc-skillsaddinfo" onclick="location.href='{{ url('admin/faq',[$status = 1,$faq->id]) }}'"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                    @else
                                                        <a class="dc-addinfo dc-skillsaddinfo" onclick="location.href='{{ url('admin/faq',[$status = 0,$faq->id]) }}'"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                    @endif
                                                        <a href="{{action('FaqController@edit',$faq->id) }}" class="dc-addinfo dc-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>

                                                        <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ $faq->id }}'" :message="'{{'Faq Deleted Successfully'}}'" :url="'{{url('admin/faq/delete')}}'" :redirect_url="'{{url('admin/faq')}}'"></delete>
                                                    </div>
                                                </td>

                                                    @php 
                                               $all_data =  json_decode($faq->description,TRUE);
                                                @endphp
                                                <td>
                                            @foreach ($all_data as $key => $data)
                                                <?php
                                                if ($key % 2 == 0) {
                                                        echo "<b>Question</b>: $data <br>";
                                                    } else {
                                                        echo "<b>Answer</b>: $data <br>";
                                                    }
                                                    ?>
                                            @endforeach
                                                </td>
                                                <td>{{ $faq->created_at->format('M d, Y, H:i A') }}</td>
                                                <td>{{ $faq->updated_at->format('M d, Y, H:i A') }}</td>
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($faqs,'links') )
                                    {{ $faqs->links('pagination.custom') }}
                                @endif
                            </div>
                        @else
                            @include('errors.no-record')
                        @endif
                </div>
              
             </div>     
       
                            
    </div> 
   <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 mt-4">
        <div class="dc-dashboardbox">
            <div class="dc-dashboardboxtitle dc-titlewithsearch dc-titlewithdel">
                        	<h2>Add New Faqs</h2>
                <div class="dc-dashboardboxtitle">

                    <form action="{{ url('admin/store-faq') }}"method="post"> 
                        {{csrf_field()}}
                        <div class="form-group">
                            <div class="form-group">
                                <input type="hidden" name="status" id="status" class="form-control" value="0">
                                <!-- <span class="dc-select"> -->
                                  <!--   <select name="status" id="status" class="form-control">
                                       
                                       <option value="1">approve</option>
                                        <option value="0">disapprove</option>
                                    </select>
                                </span>
                                    @if ($errors->has('status'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('status')}}</p>   
                                    @endif  --> 
                             </div>

                                <div class="form-group">
                                    <input type="text" name="diseases" id="tag6" class="form-control" placeholder="Enter Diseases/Diseases"
                                           />
                                  @if ($errors->has('diseases'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('diseases')}}</p>   
                                    @endif
                                </div>
                                 <div class="form-group">
                                    <input type="text" name="specialities" id="tag1" class="form-control" placeholder="Enter Speciality/Specialities"
                                           />
                                  @if ($errors->has('specialities'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('specialities')}}</p>   
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" name="services" id="tag3" class="form-control" placeholder="Enter Service/Services"
                                           />
                                  @if ($errors->has('services'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('services')}}</p>   
                                    @endif
                                </div> 
                                 <div class="form-group">
                                    <input type="text" name="symptoms" id="tag4" class="form-control" placeholder="Enter Symptom/Symptoms"
                                           />
                                  @if ($errors->has('symptoms'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('symptoms')}}</p>   
                                    @endif
                                </div>
                                 <div class="form-group">
                                    <input type="text" name="treatments" id="tag5" class="form-control" placeholder="Enter Treatment/Treatments"
                                           />
                                  @if ($errors->has('treatments'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('treatments')}}</p>   
                                    @endif
                                </div> 
                                 <div class="form-group">
                                    <input type="text" name="procedures" id="tag7" class="form-control" placeholder="Enter Procedures/Procedures"
                                           />
                                  @if ($errors->has('procedures'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('procedures')}}</p>   
                                    @endif
                                </div>
                                <div class="form-group">
                                        <input name="page_url"  type="text" class="form-control" placeholder="Enter page RUL"  />
                                    </div>
                             <!--  <div class="after-add-more"> -->
                                    <div class="form-group">
                                        <input name="field_name[]"  type="text" class="form-control" placeholder="Enter Question"  />
                                         @if ($errors->has('field_name'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('field_name')}}</p>   
                                    @endif
                                    </div>
                                     <div class="form-group">
                                    {!! Form::textarea( 'field_name[]', null, ['id' => 'description','class' =>'form-control', 'placeholder' => trans('Enter Answer')] ) !!}
                                </div> 
                                  <!--   <div class="form-group change"align="right">
                                        <a class="btn btn-success add-more"style="color: white;"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                    </div>
     -->
                           <!--  </div> -->
								
                               
                                <div class="form-group dc-btnarea">
                                       <button type="submit" name="submit" class="dc-btn">Add Faq</button>
                                </div>      
                                   
                        </div> 

                    </form>
                    
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
{{--<script src="{{ asset('js/jquery.basictable.min.js') }}"></script>--}}
   <script type="text/javascript">
      $(document).ready(function() {
        $('#example').DataTable();
      } );

    </script>
<!-- <script>
$(document).ready(function() {
    $("body").on("click",".add-more",function(){ 
        var html = $(".after-add-more").first().clone();   
          $(html).find(".change").html("<a class='btn btn-danger remove'style='color: white'><i class='fa fa-minus-circle' aria-hidden='true'></i></a>");   
        $(".after-add-more").last().after(html);
    });
    $("body").on("click",".remove",function(){ 
        $(this).parents(".after-add-more").remove();
    });
});
</script> -->

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

      var elt = $("#tag6");
      elt.tagsinput({
        itemValue: "id",
        itemText: "slug",
        typeaheadjs: {
          name: "id",
          displayKey: "slug",
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
      var data = JSON.stringify({!!json_encode($service)!!});
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

     <script>
      var data = JSON.stringify({!!json_encode($symptom)!!});
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

      var elt = $("#tag4");
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
      var data = JSON.stringify({!!json_encode($treatment)!!});
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

      var elt = $("#tag5");
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
      var data = JSON.stringify({!!json_encode($procedures)!!});
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

      var elt = $("#tag7");
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
     <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
  


@endpush
