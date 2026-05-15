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
                            <h2>Update Surgery </h2>
                <div class="dc-dashboardboxtitle">
                    <form action="{{action('ProcedureController@update',$procedure->id) }}"method="post"> 
                        {{csrf_field()}}
                        @method('post')
                        <div class="form-group">
                            <div class="form-group">
                                <span class="font-weight-bold">Surgery Slug</span>
                                    <input type="text" name="slug"value="{{ $procedure->slug }}" class="form-control" placeholder="Enter slug" />
                                     @if ($errors->has('slug'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('slug')}}</p>   
                                    @endif 
                                </div>
                                <div class="form-group">
                                    <input type="text" name="title"value="{{ $procedure->title }}" class="form-control" placeholder="Enter Title" />
                                     @if ($errors->has('title'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('title')}}</p>   
                                    @endif 
                                </div>
                                 <div class="form-group">
                                    <input type="text" name="fee"value="{{ $procedure->fee }}" class="form-control" placeholder="Enter Fee" />
                                     @if ($errors->has('fee'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('fee')}}</p>   
                                    @endif 
                                </div>
                                <div class="form-group">
                                    <input type="text" name="range" value="{{ $procedure->range }}" class="form-control" placeholder="Enter Procedure Range" />
                                </div>
                                  <div class="form-group">
                                    <input type="text" name="procedure_type"value="{{ $newdetails['procedure_type'] }}" class="form-control" placeholder="Enter Procedure Type" />
                                     @if ($errors->has('procedure_type'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('procedure_type')}}</p>   
                                    @endif 
                                </div>
                                  <div class="form-group">
                                    <input type="text" name="function"value="{{ $newdetails['function'] }}" class="form-control" placeholder="Enter Function" />
                                     @if ($errors->has('function'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('function')}}</p>   
                                    @endif 
                                </div>
                                  <div class="form-group">
                                    <input type="text" name="common_names"value="{{ $newdetails['common_names'] }}" class="form-control" placeholder="Enter Common Names" />
                                     @if ($errors->has('common_names'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('common_names')}}</p>   
                                    @endif 
                                </div>
                                  <div class="form-group">
                                    <input type="text" name="pain_intensity"value="{{ $newdetails['pain_intensity'] }}" class="form-control" placeholder="Enter Pain Intensity" />
                                     @if ($errors->has('pain_intensity'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('pain_intensity')}}</p>   
                                    @endif 
                                </div>
                                  <div class="form-group">
                                    <input type="text" name="procedure_duration"value="{{ $newdetails['procedure_duration'] }}" class="form-control" placeholder="Enter Procedure Duration" />
                                     @if ($errors->has('procedure_duration'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('procedure_duration')}}</p>   
                                    @endif 
                                </div>
                                  <div class="form-group">
                                    <input type="text" name="hospital_days"value="{{ $newdetails['hospital_days'] }}" class="form-control" placeholder="Enter Hospital Days" />
                                     @if ($errors->has('hospital_days'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('hospital_days')}}</p>   
                                    @endif 
                                </div>
                                 <div class="form-group">
                                     <span class="dc-select">
                                    <select name="anesthesia_type" id="anesthesia_type" class="form-control">
                                       <option value="">Select Anesthesia Type</option>
                                        <option value="general"@if($newdetails['anesthesia_type'] == 'general') selected @endif>General</option>
                                         <option value="local"@if($newdetails['anesthesia_type'] == 'local') selected @endif>Local</option>
                                    </select>
                                </span>
                                    @if ($errors->has('anesthesia_type'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('anesthesia_type')}}</p>   
                                    @endif 
                                </div>
                                 <div class="form-group">
                                            <input type="text" name="doctor" id="tag1" class="form-control" placeholder="Enter Doctor/Doctors"
                                                   />
                                           @if ($errors->has('doctor'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('doctor')}}</p>   
                                         @endif 
                                  </div>
                                   <div class="form-group">
                                            <input type="text" name="cities" id="tag3" class="form-control" placeholder="Enter Cities"
                                                   />
                                  </div>
                                  <div class="form-group">
                                            {!! Form::textarea( 'meta_key', e($procedure->meta_key), ['class' =>'form-control', 'placeholder' => trans('Meta Keyword')] ) !!}
                                    </div>
                                    <div class="form-group">
                                            {!! Form::textarea( 'meta_title', e($procedure->meta_title), ['class' =>'form-control', 'placeholder' => trans('Meta Title')] ) !!}
                                    </div>
                                    <div class="form-group">
                                            {!! Form::textarea( 'meta_description', e($procedure->meta_description), ['class' =>'form-control', 'placeholder' => trans('Meta Description')] ) !!}
                                    </div>
                                    <div class="form-group">
                                            {!! Form::textarea( 'intro_procedure', e($procedure->intro_procedure), ['class' =>'form-control', 'placeholder' => trans('Procedure Introduction')] ) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::textarea( 'description', e($procedure->description), ['id' => 'description','class' =>'form-control',
                                        'placeholder' => trans('lang.ph_desc')] )
                                        !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::textarea( 'faq_procedure', e($procedure->faq_procedure), ['id' => 'faq_procedure','class' =>'form-control',
                                        'placeholder' => trans('Procedure Faq')] )
                                        !!}
                                    </div>
                                    <div class="dc-settingscontent" style="float: left;">
                                            @if (!empty($procedure->image))
                                                <upload-media
                                                :img="'{{ $procedure->image }}'"
                                                :img_id="'procedure_image'"
                                                :img_name="'procedure_image'"
                                                :img_ref="'procedure_image'"
                                                :img_hidden_name="'procedure_image'"
                                                img_hidden_id="'procedure_image'"
                                                :existed_img="'{{$procedure->image}}'"
                                                :url="'{{ url("media/upload-temp-image/procedure/procedure_image/procedure") }}'"
                                                :existing_img_url="'{{ url("uploads/procedure/$procedure->image") }}'"
                                                :size = "'{{ Helper::getImageDetail($procedure->image, 'size', 'uploads/procedure/') }}'"
                                                :existing_img_name = "'{{ Helper::getImageDetail($procedure->image, 'name', 'uploads/procedure/') }}'"
                                                >
                                                </upload-media>
                                                @else
                                                <upload-media
                                                    :img="'procedure_image'"
                                                    :img_id="'procedure_image'"
                                                    :img_name="'procedure_image'"
                                                    :img_ref="'procedure_image'"
                                                    :img_hidden_name="'procedure_image'"
                                                    img_hidden_id="'procedure_image'"
                                                    :url="'{{ url("media/upload-temp-image/procedure/procedure_image/procedure") }}'"
                                                    >
                                                </upload-media>
                                            @endif
                                        </div>
                               
                                <div class="form-group dc-btnarea">
                                       <input type="submit" name="submit" value="Update Surgery"class="dc-btn">
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
{{-- <script src="{{ asset('js/jquery.basictable.min.js') }}"></script>--}}

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
        
      var data =JSON.stringify({!!json_encode($result)!!});
      var stored_data =JSON.stringify({!!json_encode($user_tags)!!});
      //get data pass to json
      var task = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace("first_name"),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: jQuery.parseJSON(data) //your can use json type
      });

      task.initialize();

      var elt = $("#tag1");
      elt.tagsinput({
        itemValue: "id",
        itemText: "first_name",
        typeaheadjs: {
          name: "id",
          displayKey: "first_name",
          source: task.ttAdapter()
        }
      });
      populate('#tag1', stored_data);

      function populate(frm, data) {

        $.each(JSON.parse(data), function(id, first_name){
          $(elt).tagsinput('add', first_name);
        });
      }

    </script>
        <script>
        
      var data =JSON.stringify({!!json_encode($cities)!!});
      var stored_data =JSON.stringify({!!json_encode($cities_tags)!!});
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
@endpush
