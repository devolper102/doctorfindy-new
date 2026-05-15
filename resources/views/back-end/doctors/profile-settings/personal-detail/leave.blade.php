<div class="dc-doc-membership dc-tabsinfo dc-formtheme dc-socials-form la-membership-content">
    <fieldset class="membership-content doctor_leave">
        <div class="dc-tabscontenttitle">
            <h3> Doctor Leave </h3>
        </div>
        
                <label> 
                    
                    <input type="checkbox" name="on_leave[]" class="mark_red" id="mark_leave" onchange="validateCheck()" <?php echo (isset($leave[0])=='on' ? 'checked' : '');?>> On Leave
                </label> 
                    
                <label> 
                    
            <input type="date" name="on_leave[]" class="start_date" id="start_date" value='<?php echo (isset($leave[1]) ? $leave[1] : '');?>'>
                 </label> <span class="leave_text">---To---</span>
                <label> 
                    
                <input type="date" name="on_leave[]" class="end_date" id="end_date" value='<?php echo (isset($leave[2]) ? $leave[2] : '');?>'> 
                 </label>

    </fieldset>
</div>


