@extends('back-end.master')
@push('backend_stylesheets')

    <link href="{{ asset('css/basictable.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <link href="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <link href="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/examples/assets/app.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  
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
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="profile_settings">
            <div class="dc-haslayout">
                <div class="dc-dashboardbox dc-dashboardtabsholder">
                    <div class="dc-dashboardboxtitle">
                        <h2>{{ trans('lang.profile_setting') }}</h2>
                    </div>
                    <div class="dc-dashboardtabs">
                        <ul class="dc-tabstitle nav navbar-nav">

                            <li class="nav-item"><a class="active show" data-toggle="tab" href="#dc-skills">{{ trans('lang.personal_detail') }}</a></li>
                            <li class="nav-item"><a data-toggle="tab" href="#dc-education" class="">{{ trans('lang.exp_edu') }}</a></li>
                            <li class="nav-item"><a data-toggle="tab" href="#dc-awards" class="">{{ trans('lang.awards_downloads') }}</a></li>
                            <li class="nav-item"><a data-toggle="tab" href="#dc-services" class="">{{ trans('lang.services') }}</a></li>
                            <li class="nav-item"><a data-toggle="tab" href="#dc-gallery" class="">{{ trans('lang.gallery') }}</a></li> 
                            <li class="nav-item"><a data-toggle="tab" href="#dc-faq" class="">{{ trans('lang.faq') }}</a></li>
                        </ul>
                    </div>
                    <div class="dc-tabscontent tab-content">
                        <div class="dc-personalskillshold tab-pane active fade show" id="dc-skills">
                            @include('back-end.doctors.profile-settings.personal-detail.index')
                        </div>
                        <div class="dc-educationholder tab-pane fade" id="dc-education">
                            @include('back-end.doctors.profile-settings.experience-education.index')
                        </div>
                        <div class="dc-awardsholder tab-pane fade" id="dc-awards">
                            @include('back-end.doctors.profile-settings.awards-downloads.index')
                        </div>
                        <div class="dc-registration tab-pane fade" id="dc-registration">
                            @include('back-end.doctors.profile-settings.registration.index')
                        </div>
                        <div class="dc-services tab-pane fade" id="dc-services">
                            @include('back-end.doctors.profile-settings.services.index')
                        </div>
                        <div class="dc-gallery tab-pane fade" id="dc-gallery">
                            @include('back-end.doctors.profile-settings.gallery.index')
                        </div>
                        <div class="dc-faq tab-pane fade" id="dc-faq">
                            @include('back-end.doctors.profile-settings.faq.index')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-3">
        </div>
        <footer class="dashboard-sticky-footer bg-white box_shadow p-2 d-inline-block mt-4 p-2 border-top w-xs-100 w-md-100">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
          <span>Copyright &copy; Your Website 2020</span>
        </div>
      </div>
    </footer>
    </div>
@endsection


@push('scripts')
    @stack('backend_scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    <script src="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
    <script src="{{ asset('js/jquery.basictable.min.js') }}"></script>
    <script type="text/javascript">
      jQuery('.dc-table-responsive').basictable({
        breakpoint: 767,
      });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    <script src="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script>
      var data = JSON.stringify({!!json_encode($diseases)!!});
      var stored_data =JSON.stringify({!!json_encode($diseases_tags)!!});
      /*'[' +
      ' { "value": 2, "text": "Task 2"},' +
      ' { "value": 3, "text": "Task 3"},' +
      ' { "value": 4, "text": "Task 4"},' +
      ' { "value": 5, "text": "Task 5"},' +
      ' { "value": 6, "text": "Task 6"} ]';*/

      //get data pass to json
      var task = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace("title"),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: jQuery.parseJSON(data) //your can use json type
      });

      task.initialize();

      var elt = $("#tag1");
      $("#tag1")
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

      //insert data to input in load page
      /*elt.tagsinput("add", {
        value: 1,
        title: "task",
      });*/

    </script>
    
    <script>
        $('#userLocation').select2();
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

      let allLocations = {!! $allLocations !!}
      $('#userLocation').change(function (){
          $('.select2 .select2-container .select2-container--default').attr("style", "width: 300 px !important")
          $('#address').empty()
          var options = [];
          let val = $('#userLocation').val()
          let locations = allLocations.filter(x => x.parent === JSON.parse(val))
          if (locations.length < 1) {
              $('#address').empty().append('<option selected="selected" value="whatever">No Area Found</option>');

          }
          locations.forEach(function(item, index)
          {
              let newOption = document.createElement("option");
              newOption.text = item.toString();
              $('#address').append('<option value="' + item.id + '">' + item.title + '</option>');
            })



        });



        // Material Select Initialization
/*      $(document).ready(function() {
          $('.mdb-select').materialSelect();
      });*/

    </script>
@endpush
