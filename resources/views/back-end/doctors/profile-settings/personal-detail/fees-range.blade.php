<div class="dc-yourdetails dc-tabsinfo">
    <div class="dc-tabscontenttitle">
        <h3>{{trans('lang.ph.fee_range')}} </h3>
    </div>
    <div class="dc-formtheme dc-userform">
        <fieldset>
            <div class="form-group">
                <div class="form-group form-group-half">
                    <input type="number" min="0"step="0.1" value="{{$from_fees}}" name="from_fees" class="form-control" placeholder = {{trans('lang.ph.from_price')}}>
                </div>
                <div class="form-group form-group-half">
                    <input type="number" min="0"step="0.1" value="{{$to_fees}}" name="to_fees" class="form-control" placeholder = {{trans('lang.ph.to_price')}}>
                </div>
            </div>
        </fieldset>
    </div>
</div>