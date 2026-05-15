@if(!empty($faqs))
    <div class="dc-services-holder dc-aboutinfo" id="doc-faq">
        <div class="dc-infotitle faq_title">
            <h3>{{ trans('lang.faq') }}</h3>
        </div>
        @foreach ($faqs as $key => $data)
            @if (!empty($data))
           
                <div id="dc-accordion" class="dc-accordion" role="tablist" aria-multiselectable="true">
                    <div class="dc-panel">
                        <div class="dc-paneltitle">
                            <span>{{ html_entity_decode(clean($data->question)) }}</span>
                        </div>
                        @if (!empty($data))
                            <div class="dc-panelcontent">
                                <div id="dc-childaccordion" class="dc-childaccordion" role="tablist" aria-multiselectable="true">
                               
                                        <div class="dc-subpanel">
                                            <div class="dc-subpaneltitle">
                                                <span>{!! html_entity_decode(clean($data->answer)) ?? '' !!}</span>
                                            </div>
                                            
                                        </div>
                                   
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@else
    @include('errors.no-record')
@endif

