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
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-6">
        <div class="dc-dashboardbox">
            <div class="dc-dashboardboxtitle dc-titlewithsearch dc-titlewithdel">
                        	<h2>Edit Page</h2>
                <div class="dc-dashboardboxtitle">
                    <form action="{{action('FaqController@update',$faqs->id) }}"method="post"> 
                        {{csrf_field()}}
                        @method('post')
                        <div class="form-group">
                               <div class="form-group">
                                @if($faqs->status == '1')
                              <input type="hidden" name="status" id="status" class="form-control" value="1">

                              @else 
                              <input type="hidden" name="status" id="status" class="form-control" value="0">
                              @endif
                              <!--
                                <span class="dc-select">
                                    <select name="status" id="status" class="form-control">
                                       <option>Select Status</option>
                                       <option value="1"@if($faqs->status == '1') selected="selected" @endif>approve</option>
                                        <option value="0"@if($faqs->status == '0') selected="selected" @endif>disapprove</option>
                                    </select>
                                </span>
                                    @if ($errors->has('status'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('status')}}</p>   
                                    @endif  
                            </div> -->
                                
                                <div class="form-group">
                                    <input type="text" name="diseases" id="tag1" class="form-control" placeholder="Enter Diseases/Diseases"
                                           />
                                  @if ($errors->has('diseases'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('diseases')}}</p>   
                                    @endif
                                </div>
                                 <div class="form-group">
                                    <input type="text" name="specialitty"  id="tag3" class="form-control" placeholder="Enter Speciality/Specialities"
                                           />
                                  @if ($errors->has('specialitty'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('specialitty')}}</p>   
                                    @endif
                                </div>
                                 <div class="form-group">
                                    <input type="text" name="service"  id="tag4" class="form-control" placeholder="Enter Service/Services"
                                           />
                                  @if ($errors->has('service'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('service')}}</p>   
                                    @endif
                                </div>
                                 <div class="form-group">
                                    <input type="text" name="symptom" id="tag5" class="form-control" placeholder="Enter Symptom/Symptoms"
                                           />
                                  @if ($errors->has('symptom'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('symptom')}}</p>   
                                    @endif
                                </div> 
                                  <div class="form-group">
                                    <input type="text" name="treatment" id="tag6" class="form-control" placeholder="Enter Treatment/Treatments"
                                           />
                                  @if ($errors->has('treatment'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('treatment')}}</p>   
                                    @endif
                                </div> 
                                  <div class="form-group">
                                    <input type="text" name="procedure" id="tag7" class="form-control" placeholder="Enter Procedures/Procedures"
                                           />
                                  @if ($errors->has('procedure'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('procedure')}}</p>   
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" name="page_url"value="{{ $faqs->page_url }}"  class="form-control" placeholder="Enter page RUL"
                                           />
                                </div>
                               @php
                              $all_faqs = json_decode($faqs->description);   
                                                
                            @endphp
                            @foreach($all_faqs as $key =>  $data)
                            
                                @if ($key % 2 == 0)
                                     <div class="form-group">
                                    <input type="text" name="field_name[]"value="{{ $data }}"  class="form-control" placeholder="Enter Question"
                                           />
                                         
                                </div>
                                @else
                                  <div class="form-group">
                                    {!! Form::textarea( 'field_name[]', e($data), ['id' => 'description','class' =>'form-control', 'placeholder' => trans('lang.ph.desc')]) !!}
                                </div>
                              @endif

                                @endforeach
                      
                          <!--   <span id="buildyourform">  
                            </span>
                            <div class="form-group" style="    width: auto;
    float: right;
    margin-top: 15px;">
                              <a type="button" value="Add a field" class="add btn btn-success" id="add" style="color: white;"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                            </div> -->
                            
                                <div class="form-group dc-btnarea">
                                       <input type="submit" name="submit" value="Update"class="dc-btn">
                                </div>          
                        </div> 
                    </form>
                </div>
            </div>
        </div>
        </div>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-6 dc-responsive-mt mt-lg-0 mt-xl-0">
                        
           </div>              	
    </div>
       </section>                  	
</div>
@endsection
@push('scripts')
@stack('backend_scripts')
 <!-- <script type="text/javascript">
    $(document).ready(function() {
    $("#add").click(function() {
        var lastField = $("#buildyourform div:last");
        var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
        var fieldWrapper = $("<div class=\"fieldwrapper\" id=\"field" + intId + "\"/>");
        fieldWrapper.data("idx", intId);
        var fName = $("<div class=\"form-group\"> <input type=\"text\" name=\"field_name[]\"placeholder=\"Enter Question\"class=\"fieldname form-control\" /> </div>");
        var fType = $("<input type=\"text\" name=\"field_name[]\"placeholder=\"Enter Answer\"class=\"fieldname form-control\" />");
        var removeButton = $("<a href=\"javascript:void(0)\" style=\"color:#fff;margin:15px 0;float:left;\" class=\"remove btn btn-danger\" > <i class='fa fa-minus-circle' aria-hidden='true'></i> </a>");

        removeButton.click(function() {
            $(this).parent().remove();
        });
        fieldWrapper.append(fName);
        fieldWrapper.append(fType);
        fieldWrapper.append(removeButton);
        $("#buildyourform").append(fieldWrapper);
    });
 
});

    </script> -->
    <script src="{{ asset('js/bootstrap-beta.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    
   
        <script src="{{ asset('js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-tagsinput.min.js') }}"></script>

    <script>

      var data =JSON.stringify({!!json_encode($diseases)!!});
      var stored_data =JSON.stringify({!!json_encode($dis_tags)!!});
      //get data pass to json
      var task = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace("slug"),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: jQuery.parseJSON(data) //your can use json type
      });

      task.initialize();

      var elt = $("#tag1");
      elt.tagsinput({
        itemValue: "id",
        itemText: "slug",
        typeaheadjs: {
          name: "id",
          displayKey: "slug",
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
      var data =JSON.stringify({!!json_encode($specialitty)!!});
      var stored_data =JSON.stringify({!!json_encode($spe_tags)!!});
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
      populate('#tag3', stored_data);

      function populate(frm, data) {

        $.each(JSON.parse(data), function(id, title){
          $(elt).tagsinput('add', title);
        });
      }

    </script>

     <script>
      var data =JSON.stringify({!!json_encode($service)!!});
      var stored_data =JSON.stringify({!!json_encode($ser_tags)!!});
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
      populate('#tag4', stored_data);

      function populate(frm, data) {

        $.each(JSON.parse(data), function(id, title){
          $(elt).tagsinput('add', title);
        });
      }

    </script>
     <script>
      var data =JSON.stringify({!!json_encode($symptom)!!});
      var stored_data =JSON.stringify({!!json_encode($sym_tags)!!});
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
      populate('#tag5', stored_data);

      function populate(frm, data) {

        $.each(JSON.parse(data), function(id, title){
          $(elt).tagsinput('add', title);
        });
      }

    </script>
     <script>
      var data =JSON.stringify({!!json_encode($treatment)!!});
      var stored_data =JSON.stringify({!!json_encode($tre_tags)!!});
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
        itemText: "title",
        typeaheadjs: {
          name: "id",
          displayKey: "title",
          source: task.ttAdapter()
        }
      });
      populate('#tag6', stored_data);

      function populate(frm, data) {

        $.each(JSON.parse(data), function(id, title){
          $(elt).tagsinput('add', title);
        });
      }

    </script>
       <script>
      var data =JSON.stringify({!!json_encode($procedures)!!});
      var stored_data =JSON.stringify({!!json_encode($pro_tags)!!});
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
      populate('#tag7', stored_data);

      function populate(frm, data) {

        $.each(JSON.parse(data), function(id, title){
          $(elt).tagsinput('add', title);
        });
      }

    </script>

   @endpush
