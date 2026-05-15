{!! Form::open(['url' => '', 'class' => 'dc-formtheme dc-services-holder', 'id' => 'manage-update-card-form', '@submit.prevent' => 'submitUpdateCard']) !!}
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="role" value="<?php echo $user_role; ?>">
<div class="dc-doc-membership dc-tabsinfo dc-formtheme dc-socials-form la-membership-content">
    <fieldset class="membership-content">
        <div class="dc-tabscontenttitle">
            <h3>{{ trans('lang.card') }}</h3>
        </div>
        
            <div id="pay-invoice" class="card">
                <div class="card-body">
                          
                       
                        <div class="form-group">
                            <label for="cc-number" class="control-label mb-1">Card number</label>
                            <input id="cc-number" name="cc-number" type="tel" class="form-control cc-number identified visa" required autocomplete="off" value="<?php echo($bank_data->cc_number ?? ''); ?>" >
                            <span class="invalid-feedback">Enter a valid 12 to 16 digit card number</span>
                        </div>
                        
                        <div class="form-group">
                            <label for="x_iban" class="control-label mb-1">IBAN</label>
                            <input id="x_iban" name="x_iban" type="text" class="form-control" data-val="true" data-rule-iban="true" data-val-required="Please enter the iban number" autocomplete="postal-code" value="<?php echo($bank_data->x_iban ?? ''); ?>">
                            <span class="help-block" data-valmsg-for="x_bank" data-valmsg-replace="true"></span>
                        </div>
                        <div class="form-group">
                            <label for="x_bank" class="control-label mb-1">Bank Name</label>
                            <input id="x_bank" name="x_bank" type="text" class="form-control" data-val="true" data-val-required="Please enter the bank name" autocomplete="postal-code" value="<?php echo($bank_data->x_bank ?? ''); ?>">
                            <span class="help-block" data-valmsg-for="x_bank" data-valmsg-replace="true"></span>
                        </div>
                         <div class="form-group">
                            <label for="x_title" class="control-label mb-1">Account Title</label>
                            <input id="x_title" name="x_title" type="text" class="form-control"  data-val="true" data-val-required="Please enter the account title" value="<?php echo($bank_data->x_title ?? ''); ?>">
                            <span class="help-block" data-valmsg-for="x_title" data-valmsg-replace="true"></span>
                        </div>
                        
                        <div>
                           
                        </div>
                 
                </div>
            </div>
        
    

    </fieldset>
</div>
 <div class="dc-experienceaccordion">
        <div class="dc-updatall la-btn-setting">
            {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn','id'=>'bankCard']) !!}
        </div>
    </div>
{!! Form::close() !!}

@push('backend_scripts')
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
@endpush
