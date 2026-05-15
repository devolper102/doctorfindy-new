@extends('back-end.master')
@push('backend_stylesheets')
    <link href="{{ asset('css/basictable.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-beta.min.css') }}"  rel="stylesheet">
    <link href="{{ asset('css/bootstrap-tagsinput.css') }}"  rel="stylesheet">
    <link href="{{ asset('css/tagsinput-app.css') }}"  rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}"  rel="stylesheet">
    


    <style>

        .select2-container .select2-selection--single{
            height:34px !important;
        }
        .select2-container--default .select2-selection--single{
            border: 1px solid #ccc !important;
            border-radius: 0px !important;
        }
        /* autocomplete tagsinput*/ 
        .label-info {
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
        .bootstrap-tagsinput{
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            display: inline-block;
            padding: 4px 6px;
            color: #555;
            vertical-align: middle;
            border-radius: 4px;width: 100%;
            line-height: 22px;
            cursor: text;
        }
        .bootstrap-tagsinput input{
            border:none;
            padding: 0px;
            height: 30px;
        }
        .bootstrap-tagsinput .tag [data-role="remove"]:after {
            content: "x";
            padding: 0px 4px;
            cursor: pointer;
        }
        .tt-menu {
            float: left;
            min-width: 90px;
            padding: 5px;
            margin: 2px 0 0;
            list-style: none;
            font-size: 14px;
            background-color: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 4px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
            background-clip: padding-box;
            cursor: pointer;
        }
    </style>
@endpush
@section('content')
@include('includes.pre-loader')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="account_settings">
            <div class="dc-preloader-section" v-if="is_loading" v-cloak>
                <div class="dc-preloader-holder">
                    <div class="dc-loader"></div>
                </div>
            </div>
            <div class="dc-dashboardbox dc-dashboardtabsholder">
                <div class="dc-dashboardboxtitle">
                    
                    {!! Form::open(['url' => '', 'class' =>'dc-formtheme', 'id' =>'extended-profile', '@submit.prevent'=>'profileChanged'])!!}
                    
                    <div class="doctor_profile_setting">
                    <h2>{{Helper::getUserName($id)}} {{ trans('lang.profile_setting') }}</h2>
                    @if ($user->roles[0]->name === 'doctor')
                                 @if($user->location !=''|| $user->location != null || $user->location =='null')
                    @if($user->specialities->count() > 0)
                    <h5><a class="float-left ml-2" href="{{ url('doctors/'.clean($user->location->slug).'/'.clean($user->specialities[0]->slug).'/'.clean($user->slug)) }}">View Profile</a>
                    </h5>
                        @endif
                        @endif
                        @endif
                        @if ($user->roles[0]->name === 'hospital')
                                 @if($user->location !=''|| $user->location != null || $user->location =='null')
                    <h5><a class="float-left ml-2" href="{{ url('hospitals/'.clean($user->location->slug).'/'.clean($user->slug)) }}">View Profile</a>
                    </h5>
                        
                        @endif
                        @endif
                    @if($user_role !== 'patient' && $user_role !== 'hospital' && $user_role !== 'laboratory')
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <label class="extendedProfile">Extended Profile <input type="checkbox" name="extended" class="extendCheckbox" <?php echo ($extend=='on' ? 'checked' : '');?> onchange="changeExtend()">
                    <input type="submit" id="ext" value="Save &amp; Update" class="dc-btn profileHide">
                    </label>
                    @endif
                    </div>
                    {!! Form::close(); !!}
                
                </div>
                <div class="dc-dashboardtabs">
                        <ul class="dc-tabstitle nav navbar-nav">
                            <li class="nav-item">
                                <a class="active show" data-toggle="tab" href="#dc-skills">{{ trans('lang.personal_detail') }}</a>
                            </li>
                            <li class="nav-item  <?php echo (($extend=='off' || $extend == null) ? 'profileHide' : '');?>" id="profileEX"><a data-toggle="tab" href="#dc-education" class="">{{ trans('lang.exp_edu') }}</a></li>
                            <li class="nav-item  <?php echo (($extend=='off' || $extend == null) ? 'profileHide' : '');?>" id="profileEX1"><a data-toggle="tab" href="#dc-awards" class="">{{ trans('lang.awards_downloads') }}</a></li>
                            <li class="nav-item"><a data-toggle="tab" href="#dc-registration" class="">{{ trans('lang.registration') }}</a></li>  
                            @if($user_role !== 'patient')
                            <li class="nav-item"><a data-toggle="tab" href="#dc-services" class="">{{ trans('lang.services') }}</a></li>   
                            <li class="nav-item <?php echo (($extend=='off' || $extend == null) ? 'profileHide' : '');?>" id="profileEX2"><a data-toggle="tab" href="#dc-hospitals" class="">{{ trans('lang.hospital-services') }}</a></li>
                            <li class="nav-item"><a data-toggle="tab" href="#dc-gallery" class="">{{ trans('lang.gallery') }}</a></li>
                            <li class="nav-item"><a data-toggle="tab" href="#dc-faq" class="">{{ trans('lang.faq') }}</a></li>
                              @endif
                             <li class="nav-item"><a data-toggle="tab" href="#dc-card" class="">{{ trans('lang.card') }}</a></li>
                             <li class="nav-item"><a data-toggle="tab" href="#dc-location" class="">Appointment Locations</a></li>
                        </ul>
                    </div>
                <div class="dc-tabscontent tab-content">
                    <div class="dc-personalskillshold tab-pane active fade show" id="dc-skills">
                        @include('back-end.admin.users.edit.doctor.personal-detail.index')
                    </div>
                    <div class="dc-educationholder tab-pane fade " id="dc-education">
                        @include('back-end.admin.users.edit.doctor.experience-education.index')
                    </div>
                    <div class="dc-awardsholder tab-pane fade" id="dc-awards">
                        @include('back-end.admin.users.edit.doctor.awards-downloads.index')
                    </div>
                    <div class="dc-registration tab-pane fade" id="dc-registration">
                        @include('back-end.admin.users.edit.doctor.registration.index')
                    </div>
                    @if($user_role !== 'patient')
                    <div class="dc-personalskillshold tab-pane fade" id="dc-services">
                        @include('back-end.admin.users.edit.doctor.services.index')
                    </div>
                    <div class="dc-personalskillshold tab-pane fade" id="dc-hospitals">
                        @include('back-end.admin.users.edit.doctor.hospital-services.index')
                    </div>
                    <div class="dc-gallery tab-pane fade" id="dc-gallery">
                        @include('back-end.admin.users.edit.doctor.gallery.index')
                    </div>
                    <div class="dc-faq tab-pane fade" id="dc-faq">
                        @include('back-end.admin.users.edit.doctor.faq.index')
                    </div>
                    @endif
                    <div class="dc-card tab-pane fade" id="dc-card">
                        @include('back-end.admin.users.edit.doctor.bank.index')
                    </div>
                    <div class="dc-card tab-pane fade" id="dc-location">
                        @include('back-end.admin.users.edit.doctor.appointment-location.index')
                    </div>
                    </div>
            </div>
        </div>
    </div>
    <style type="text/css">
        .profileHide {
            display: none !important;
        }
        .extendedProfile{
            float: right;
            font-size: 20px;
            line-height: normal;
        }
    </style>
    <script type="text/javascript">
        function changeExtend()
        {
            $( "#ext" ).click();
        }
        
        function validateCheck()
        {

             if($('#mark_leave').is(":checked"))
             {
                $("#start_date").prop('required',true);
                $("#end_date").prop('required',true);
            } else {

                $("#start_date").prop('required',false);
                $("#end_date").prop('required',false);

            }
        }
   

    </script>
@endsection
@push('scripts')
    @stack('backend_scripts')

   <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-beta.min.js') }}"></script>
    <script src="{{ asset('js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    

    <script>
        $('#userLocation').select2();
        $('#user_area').select2();
      var data =JSON.stringify({!!json_encode($diseases)!!});
      var stored_data =JSON.stringify({!!json_encode($diseases_tags)!!});
      //get data pass to json
      var task = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace("title"),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: jQuery.parseJSON(data) //your can use json type
      });

      task.initialize();

      var elt = $("#tag1");
      elt.tagsinput({
        itemValue: "id",
        itemText: "title",
        typeaheadjs: {
          name: "id",
          displayKey: "title",
          source: task.ttAdapter()
        }
      });
      populate('#tag1', stored_data);

      function populate(frm, data) {

        $.each(JSON.parse(data), function(id, title){
          $(elt).tagsinput('add', title);
        });
      }

      let allLocations = {!! $areas !!}
      $('#userLocation').change(function (){
          $('.select2 .select2-container .select2-container--default').attr("style", "width: 300 px !important")
          $('#user_area').empty()
          var options = [];
          let val = $('#userLocation').val()
          let areas = allLocations.filter(x => x.location_id === JSON.parse(val))
          if (areas.length < 1) {
              $('#user_area').empty().append('<option selected="selected" value="whatever">No Area Found</option>');

          }
          areas.forEach(function(item, index)
          {
              let newOption = document.createElement("option");
              newOption.text = item.toString();
              $('#user_area').append('<option value="' + item.id + '">' + item.title + '</option>');
            })



        });



        // Material Select Initialization
/*      $(document).ready(function() {
          $('.mdb-select').materialSelect();
      });*/

    </script>
@endpush
