@extends('back-end.master')
@section('content')
@include('includes.pre-loader')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-9" id="account_settings">
            <div class="dc-preloader-section" v-if="is_loading" v-cloak>
                <div class="dc-preloader-holder">
                    <div class="dc-loader"></div>
                </div>
            </div>
            <div class="dc-dashboardbox dc-dashboardtabsholder">
                <div class="dc-dashboardboxtitle">
                    <h2>{{ $_GET['submit'] ?? 'Edit Branch' }}</h2>
                </div>
                <div class="dc-dashboardtabs">
                    <ul class="dc-tabstitle nav navbar-nav">
                        <li class="nav-item">
                            <a class="active show" data-toggle="tab" href="#dc-skills">{{ !empty($_GET['submit']) ? trans('lang.add_new_branch'): 'Edit Branch' }}</a>
                        </li>
                    </ul>
                </div>
                <div class="dc-tabscontent tab-content">
                         <div class="dc-personalskillshold tab-pane active fade show" id="dc-skills">
    {!! Form::open(['url' => '', 'class' =>'dc-formtheme', 'id' =>'create-user-details', '@submit.prevent'=>!empty($_GET['submit']) ? 'createLabBranch' : 'updateLabBranch("'.intVal(clean($branch->id)).'")'] )!!}
        <div class="dc-yourdetails dc-tabsinfo">
            <div class="dc-tabscontenttitle">
                <h3> {{ trans('lang.branch_detail') }} </h3>
            </div>
            <div class="dc-formtheme dc-userform">
                <fieldset>
                    <div class="form-group form-group">
                        {!! Form::text( 'name', $branch->name ?? null, ['class' =>'form-control','placeholder' => trans('lang.name')] ) !!}
                    </div>
                     <div class="form-group">
                        {!! Form::select('city_id', $locations, $branch->location_id ?? null, ['class' => 'form-control','placeholder'=>trans('lang.ph.select_city')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::select('user_id', $labs, $branch->user_id ?? null, ['class' => 'form-control','placeholder'=>trans('lang.ph.select_branch')]) !!}
                    </div>
                    <div class="form-group dc-btnarea">{!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}</div>
                                    </fieldset>
                                </div>
                            </div>
                        {!! Form::close(); !!}
                    </div>  
                </div>
            </div>
        </div>
    </div>
    <style type="text/css">
        .dc-checkbox, .dc-checkbox label, .dc-radio, .dc-radio label{
            width:auto !important;
            margin-left: 0 !important;
        }
        .dc-yourdetails .dc-userform{
            padding: 0px !important;
        }
    </style>
@endsection 