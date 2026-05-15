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
            
                <div class="dc-dashboardboxtitle">
                        	<h2>Update Speciality Test</h2>
                </div>
                <div class="dc-dashboardboxcontent dc-addspeciality">
                    <form action="{{action('Speciality_TestController@update',$tests->id) }}"method="post"> 
                        {{csrf_field()}}
                        @method('post')
                        <div class="form-group">
                                <div class="form-group">
                                <div class="form-group">
                                    <input type="text" name="title"  class="form-control" placeholder="Enter Title" value="{{ $tests->title }}"/>
                                    @if ($errors->has('title'))  
                                           <p class="text-danger">{{$errors->first('title')}}</p>   
                                    @endif  
                                    
                                </div>
                                 <div class="form-group">
                                    <input type="text" name="price"  class="form-control" placeholder="Enter price" value="{{ $tests->price }}"/>
                                    @if ($errors->has('price'))  
                                           <p class="text-danger">{{$errors->first('price')}}</p>   
                                    @endif  
                                    
                                </div>
                                 <div class="form-group">
                                     <span class="dc-select">
                                    <select name="speciality_id" id="speciality_id" class="form-control">
                                       <option value="">Select Speciality</option>                                   
                                       @foreach ($specialities as $key => $speciality)
                                        <option value="{{$speciality->id}}"@if($tests->speciality_id == $speciality->id) selected @endif>{{$speciality->title}}</option>
                                        @endforeach
                                    </select>
                                </span>
                                    @if ($errors->has('speciality_id'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('speciality_id')}}</p>   
                                    @endif
                                     
                                </div>
                                <div class="form-group">
                                     <span class="dc-select">
                                    <select name="type" id="type" class="form-control">
                                       <option value="">Select Type</option>
                                        <option value="national"@if($tests->type == 'national') selected @endif>National</option>
                                         <option value="international"@if($tests->type == 'international') selected @endif>International</option>
                                    </select>
                                </span>
                                    @if ($errors->has('type'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('type')}}</p>   
                                    @endif 
                                </div>
                                   <div class="form-group">
                                    <input type="text" name="symptoms" id="tag2" class="form-control" placeholder="Enter Symptoms"/>
                                          @if ($errors->has('symptoms'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('symptoms') }}</strong>
                                        </span>
                                            @endif
                                </div>
                                <div class="form-group">
                                        {!! Form::textarea( 'details', e($tests->details), ['id' => 'details','class' =>'form-control',
                                        'placeholder' => trans('Short details')] )
                                        !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::textarea( 'description', e($tests->description), ['id' => 'description','class' =>'form-control',
                                        'placeholder' => trans('lang.ph_desc')] )
                                        !!}
                                    </div>
                                <div class="form-group dc-btnarea">
                                       <input type="submit" name="submit" value="Update"class="dc-btn">
                                </div>          
                        </div> 
                    </form>
                </div>
            
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-6 dc-responsive-mt mt-lg-0 mt-xl-0">
                        
           </div>              	
    </div>
    </div>
    </div>
       </section>                  	
</div>
@endsection
@push('scripts')
@stack('backend_scripts')

    
    

    <script src="{{ asset('js/bootstrap-beta.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    
   
        <script src="{{ asset('js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-tagsinput.min.js') }}"></script>
      <script>
      var data =JSON.stringify({!!json_encode($symptoms)!!});
      var stored_data =JSON.stringify({!!json_encode($symptom_tags)!!});
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
      populate('#tag2', stored_data);

      function populate(frm, data) {

        $.each(JSON.parse(data), function(id, title){
          $(elt).tagsinput('add', title);
        });
      }

    </script>
@endpush
