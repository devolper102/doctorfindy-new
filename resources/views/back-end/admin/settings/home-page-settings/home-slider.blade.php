{!! Form::open(['class' =>'dc-formtheme dc-userform', 'id' =>'home-banner-form', '@submit.prevent'=>'submitHomeSliderSettings'])!!}
  
    <div class="dc-tabsinfo dc-addslider-holder">
        <home-slider
            :ph_slide_title_one="'{{ trans('Title') }}'"
            :ph_slide_title_two="'{{ trans('Icon Name') }}'"
            :ph_slide_title_url="'{{ trans('URL') }}'"
        >
        </home-slider>
    </div>
    <div class="dc-experienceaccordion">
        <div class="dc-updatall la-btn-setting">
            {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
        </div>
    </div>
{!! Form::close() !!}
 @section('bootstrap_script')
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
@stop 
{{-- @push('backend_stylesheets')
 <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script> 
@endpush --}}