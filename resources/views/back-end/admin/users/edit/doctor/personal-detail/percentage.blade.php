<div class="dc-yourdetails dc-tabsinfo">
    <div class="dc-tabscontenttitle">
        <h3>{{trans('lang.ph.com_per')}} </h3>
    </div>
    <div class="dc-formtheme dc-userform">
        <fieldset>
            <div class="form-group">
                <input type="number" step="0.01" value="{{$commission}}" name="commission" class="form-control" placeholder = "Enter Commission Percentage">
            </div>
        </fieldset>
    </div>
@if($user_role !== 'patient' && $user_role !== 'hospital' && $user_role !== 'laboratory')
<div class="dc-yourdetails dc-tabsinfo">
    <div class="dc-tabscontenttitle">
        <h3>Total Experience and Wait Time </h3>
    </div>
    <div class="dc-formtheme dc-userform">
        <fieldset>
            <div class="form-group">
                <label>Enter Experience Years</label>
                {!! Form::number( 'total_experience', e($total_experience), ['class' =>'form-control', 'placeholder' => "Total Years"] ) !!}
            </div>
            <div class="form-group">
                <label>Enter Waiting Minutes</label>
                {!! Form::number( 'wait_time', e($wait_time), ['class' =>'form-control', 'placeholder' => "Total Minutes"] ) !!}
            </div>
        </fieldset>
    </div>
</div>
@endif
</div>