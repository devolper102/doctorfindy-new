<div class="dc-doc-membership dc-tabsinfo dc-formtheme dc-socials-form la-membership-content">
    <fieldset class="membership-content doctor_leave">
        <div class="dc-tabscontenttitle">
            <h3> Languages spoken </h3>
        </div>
        @if($language != '')
                <div class="form-group">
                    <select name="language[]" multiple class="form-control" >
                        <option>Select Languages</option>
                        <option value="english"@if (in_array('english', $language)) selected="selected" @endif>English</option>
                        <option value="urdu"@if (in_array('urdu', $language)) selected="selected" @endif>Urdu</option>
                        <option value="punjabi"@if (in_array('punjabi', $language)) selected="selected" @endif>Punjabi</option>
                        <option value="pashto"@if (in_array('pashto', $language)) selected="selected" @endif>Pashto</option>
                        <option value="sindhi"@if (in_array('sindhi', $language)) selected="selected" @endif>Sindhi</option>
                        <option value="balochi"@if (in_array('balochi', $language)) selected="selected" @endif>Balochi</option>
                        <option value="saraiki"@if (in_array('saraiki', $language)) selected="selected" @endif>Saraiki</option>
                        <option value="kashmiri"@if (in_array('kashmiri', $language)) selected="selected" @endif>Kashmiri</option>
                    </select>
                </div>
            @else
                <div class="form-group">
                    <select name="language[]" multiple class="form-control" >
                        <option>Select Languages</option>
                        <option value="english">English</option>
                        <option value="urdu">Urdu</option>
                        <option value="punjabi">Punjabi</option>
                        <option value="pashto">Pashto</option>
                        <option value="sindhi">Sindhi</option>
                        <option value="balochi">Balochi</option>
                        <option value="saraiki">Saraiki</option>
                        <option value="kashmiri">Kashmiri</option>
                    </select>
                </div>
            @endif    

    </fieldset>
</div>


