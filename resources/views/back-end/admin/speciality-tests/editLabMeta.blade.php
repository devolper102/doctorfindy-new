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
                    <form action="{{action('Speciality_TestController@updateLabMeta',$test->id) }}"method="post"> 
                        {{csrf_field()}}
                        @method('post')
                        <div class="form-group">
                                <div class="form-group">
                                <div class="form-group">
                                    <input type="text" name="title"  class="form-control" placeholder="Enter Title" value="{{ $test->title }}"/>
                                    @if ($errors->has('title'))  
                                           <p class="text-danger">{{$errors->first('title')}}</p>   
                                    @endif  
                                    
                                </div>
                                <div class="form-group">
                                    <input type="text" name="url_title"  class="form-control" placeholder="Enter Url" value="{{ old('url_title', $test->slug) }}"/>
                                    @if ($errors->has('url_title'))  
                                           <p class="text-danger">{{$errors->first('url_title')}}</p>   
                                    @endif  
                                    
                                </div>
                                 <div class="form-group">
                                    <input type="text" name="known_as"  class="form-control" placeholder="Enter known as" value="{{ $test->known_as }}"/>
                                    @if ($errors->has('known_as'))  
                                           <p class="text-danger">{{$errors->first('known_as')}}</p>   
                                    @endif  
                                    
                                </div>
                                   <div class="form-group">
                                    <input type="text" name="meta_title" id="tag2" class="form-control" placeholder="Enter meta title" value="{{ $test->meta_title }}"/>
                                          @if ($errors->has('meta_title'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('meta_title') }}</strong>
                                        </span>
                                            @endif
                                </div>
                                <div class="form-group">
                                        {!! Form::textarea( 'meta_description', e($test->meta_description), ['id' => 'meta_description','class' =>'form-control',
                                        'placeholder' => trans('Meta Description')] )
                                        !!}
                                    </div>
                                     <div class="form-group">
                                        {!! Form::textarea( 'introduction', e($test->introduction), ['id' => 'introduction','class' =>'form-control',
                                        'placeholder' => trans('Introduction')] )
                                        !!}
                                    </div>
                                    <div class="form-group text_area_main">
                                        {!! Form::textarea('description',  e($test->description), [ 'id' => 'description' ]) !!}
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
@endpush
