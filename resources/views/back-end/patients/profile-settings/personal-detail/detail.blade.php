<div class="dc-yourdetails dc-tabsinfo">
    <div class="dc-tabscontenttitle">
        <h3>{{ trans('lang.your_details') }} </h3>
    </div>
    <div class="dc-formtheme dc-userform">
        <fieldset>
            <div class="form-group form-group-half">
                {!! Form::text( 'first_name',  e(Auth::user()->first_name), ['class' =>'form-control', 'placeholder' => trans('lang.ph.first_name')] ) !!}
            </div>
            <div class="form-group form-group-half">
                {!! Form::text( 'last_name', e(Auth::user()->last_name), ['class' =>'form-control', 'placeholder' => trans('lang.ph.last_name')] ) !!}
            </div>
                 <div class="form-group form-group-half">
                {!! Form::text( 'email',  e(Auth::user()->email), ['class' =>'form-control', 'placeholder' => trans('lang.ph.email')] ) !!}
            </div>
            <div class="form-group form-group-half">
                {!! Form::text( 'phone_number', e(Auth::user()->phone_number), ['class' =>'form-control', 'placeholder' => trans('Phone number')] ) !!}
            </div>
        </fieldset>

    </div>
</div>