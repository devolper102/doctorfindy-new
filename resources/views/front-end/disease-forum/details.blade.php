{{--
@extends('front-end.master')
@section('description', '')
@section('keywords', '')
@push('front_end_stylesheets')
    <style>
        .tag_docname{
            background-color: #5bc0de;
            display: inline-block;
            padding: 0.2em 0.6em 0.3em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25em;
        }
    </style>
    <link href="{{ asset('css/chosen.css') }}" rel="stylesheet">
@endpush
@section('content')
    @include('includes.pre-loader')
    @php $columns = 'col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12'; @endphp
    <div class="container">
        <div class="row">
            <div class="dc-twocolumns dc-haslayout" id="forum">
                <div class="dc-preloader-section" v-if="loading" v-cloak>
                    <div class="dc-preloader-holder">
                        <div class="dc-loader"></div>
                    </div>
                </div>
                <div class="dc-docsingle-holder">
                    <div class="tab-content dc-haslayout">
                        <div class="dc-contentdoctab dc-feedback-holder" id="feedback">
                            <div class="dc-feedback">
                                <div class="dc-searchresult-head">
                                    <div class="dc-title"><h4> {{trans('lang.disease_forum') }} </h4></div>
                                </div>
                                <div class="dc-consultation-content dc-forumcontent" style="margin: 20px 0 48px 0">
                                            <div class="dc-consultation-details">
                                                <figure class="dc-consultation-img ">
                                                    <img src="{{ asset(Helper::getImage('uploads/disease/', $disease->flag, 'small-', 'default.jpg')) }}" alt="{{ trans('lang.img_desc') }}">
                                                </figure>
                                                <div class="dc-consultation-title">
                                                    <h5><a href="{{url('diseases/'.$disease->slug, $disease->slug)}}">{{$disease->title}}</a></h5>
                                                </div>
                                                <div class="dc-description">
                                                    <p>{{ html_entity_decode(clean($disease->description)) }}</p>
                                                </div>
                                                <div>
                                                    <span>Related Doctors:</span>
                                                    @php
                                                        $meta_users = Helper::diseaseDoctor($disease);
                                                    @endphp
                                                    @foreach($meta_users->diseases as $doctor)
                                                        <a href="{{url('profile/'.Helper::getUserSlug($doctor->user_id))}}"><span class="tag_docname"> {{Helper::getUserName($doctor->user_id)}} </span></a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        --}}
{{--@if ( method_exists($forum->answers,'links') )
                                            {{ $forum->answers->links('pagination.custom') }}
                                        @endif--}}{{--

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection--}}
@extends('front-end.master')
@push('front_end_stylesheets')
    <style>
        .tag_docname{
            background-color: #5bc0de;
            display: inline-block;
            padding: 0.2em 0.6em 0.3em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25em;
        }
    </style>
    <link href="{{ asset('css/chosen.css') }}" rel="stylesheet">
@endpush
@section('content')
    @include('includes.pre-loader')

    <div id="forntend">
        <categories-page
                :disease-title="'{{$disease->title}}'"
                :disease-slug="'{{$disease->slug}}'"
                :disease-description="`{{$disease->description}}`"
                :disease-flag="'{{$disease->flag}}'"
        ></categories-page>
    </div>


@endsection
@push('front_end_scripts')
    <script>
    </script>
@endpush
