
<div class="dc-yourdetails dc-tabsinfo">
    <div class="dc-tabscontenttitle">
        <h3>{{trans('lang.ph.diseases')}} </h3>
    </div>
    <div class="dc-formtheme dc-userform">
        <fieldset>
            <div class="form-group">
                <input type="text" name="diseases" id="tag1" class="form-control" placeholder="Enter diseases"/>
                @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
        </fieldset>
    </div>
</div>
