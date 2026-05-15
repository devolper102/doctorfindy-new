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
    <div class="dc-haslayout dc-main-section">
        <div class="container" id="forum">
            <div class="dc-docsingle-holder">
        <div class="tab-content dc-haslayout">
            <div class="dc-contentdoctab dc-feedback-holder" id="feedback">
                <div class="dc-feedback">
                    <div class="dc-searchresult-head">
                        <div class="dc-title"><h4>{{trans('lang.disease_forum') }}</h4></div>
                        <div class="dc-rightarea">
                            {{--<form action="{{ route('searchQueryFilter') }}" method="GET">
                                <div class="dc-select">
                                    <select name="sort_by" id="forum_sort" v-on:change="resultSortBy()">
                                        <option value='null'>{{ trans('lang.sort_by') }}</option>
                                        @foreach (Helper::sortByArray() as $key => $value)
                                            <option value="{{ html_entity_decode(clean($key)) }}" {{ !empty($_GET['sort_by']) && $_GET['sort_by'] == $key ? 'selected' : ''}}>{{ html_entity_decode(clean($value)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>--}}
                        </div>
                    </div>
                    <div class="dc-consultation-content">
                        @if (!empty($diseases) && $diseases->count() > 0)
                            @foreach ($diseases as $disease)

                                <div class="dc-consultation-details">
                                    <figure class="dc-consultation-img dc-imgcolor1">
                                        <img src="{{ asset(Helper::getImage('uploads/disease', $disease->flag, 'extra-small-', 'default-speciality.png')) }}" alt="{{ trans('lang.ing_desc') }}">
                                    </figure>
                                    <div class="dc-consultation-title">
                                        <h5><a href="{{url('diseases/'.$disease->slug)}}">{{$disease->title}}</a></h5>
                                    </div>
                                    <div class="dc-description">
                                        <p>{!! Str::limit($disease->description,200,'......') !!}</p>
                                    </div>
                                    @php
                                        $meta_users = Helper::diseaseDoctor($disease);
                                    @endphp
                                    @if(count($meta_users) > 0)
                                        <div>
                                            <span>Related Doctors:</span>
                                            @foreach($meta_users as $key => $doctor)
                                                <a href="{{url('profile/'.Helper::getUserSlug($doctor->user_id))}}"><span class="tag_docname"> {{Helper::getUserName($doctor->user_id)}} </span></a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                            @if (method_exists($diseases,'links'))
                                {{ $diseases->links('pagination.custom') }}
                            @endif
                        @else
                            @include('errors.no-record')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>


@endsection
@push('front_end_scripts')
@endpush
