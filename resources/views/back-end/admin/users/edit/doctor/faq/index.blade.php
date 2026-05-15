{!! Form::open(['url' => '', 'class' => 'dc-formtheme dc-services-holder', 'id' => 'manage-update-faq-form', '@submit.prevent' => 'submitUpdateFaq']) !!}
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="role" value="<?php echo $user_role; ?>">
<div class="dc-doc-membership dc-tabsinfo dc-formtheme dc-socials-form la-membership-content">
    <fieldset class="membership-content1">
        <div class="dc-tabscontenttitle">
            <h3>{{ trans('lang.faq') }}</h3>
        </div>
        @if (!empty($faqs))
            @php $counter = 0 @endphp
            @foreach ($faqs as $faq_key => $faq_value)
                <div class="wrap-membership1 dc-haslayout">
                    <div class="form-group">
                        <div class="form-group-holder">
                            {!! Form::text('faq['.$counter.'][question]', e($faq_value['question']),
                            ['class' => 'form-control author_title']) !!}
                        </div>
                        <div class="form-group dc-rightarea">
                            @if ($faq_key == 0 )
                                <span class="dc-addinfobtn" @click="addFaq"><i class="fa fa-plus"></i></span> 
                            @else
                                <span class="dc-addinfobtn dc-deleteinfo delete-membership1" data-check="{{{$counter}}}">
                                    <i class="fa fa-trash"></i>
                                </span>
                            @endif
                        </div>
                        <div class="form-group-holder">
                            {!! Form::textarea('faq['.$counter.'][answer]', e($faq_value['answer']),
                            ['class' => 'form-control author_title']) !!}
                        </div>
                    </div>
                </div>
                @php $counter++; @endphp
            @endforeach
        @else
            <div class="wrap-membership dc-haslayout">
                <div class="form-group">
                    <div class="form-group-holder">
                        {!! Form::text('faq[0][question]', null, ['class' => 'form-control author_title',
                        'placeholder' => trans('lang.faq_title')]) !!}
                    </div>
                    <div class="form-group dc-rightarea">
                        <span class="dc-addinfo dc-addinfobtn" @click="addFaq"><i class="fa fa-plus"></i></span>
                    </div>
                     <div class="form-group-holder">
                        {!! Form::textarea('faq[0][answer]', null, ['class' => 'form-control author_title',
                        'placeholder' => trans('lang.faq_answer')]) !!}
                    </div>
                </div>
            </div>
        @endif
        <div v-for="(faq, index) in faqs" v-cloak>
            <div class="wrap-faq dc-haslayout"style="padding: 0 20px;">
                <div class="form-group">
                    <div class="form-group-holder">
                        <input v-bind:name="'faq['+[faq.count]+'][question]'" type="text" class="form-control"
                            v-model="faq.faq_question" placeholder="Enter FAQ question" required>
                    </div>
                    <div class="form-group dc-rightarea">
                        <span class="dc-addinfo dc-deleteinfo dc-addinfobtn" @click="removeFaq(index)"><i class="fa fa-trash"></i></span>
                    </div>
                    <div class="form-group-holder">
                        <textarea v-bind:name="'faq['+[faq.count]+'][answer]'"  class="form-control"
                            v-model="faq.faq_answer" placeholder="Enter FAQ answer" required></textarea>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
</div>
 <div class="dc-experienceaccordion">
        <div class="dc-updatall la-btn-setting">
            {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
        </div>
    </div>
{!! Form::close() !!}

@push('backend_scripts')
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
@endpush