@php
    use Carbon\Carbon;
@endphp
@extends('back-end.master')
@push('backend_stylesheets')
  <link href="{{ asset('css/basictable.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-beta.min.css') }}"  rel="stylesheet">
    <link href="{{ asset('css/bootstrap-tagsinput.css') }}"  rel="stylesheet">
    <link href="{{ asset('css/tagsinput-app.css') }}"  rel="stylesheet">


    <style>
        /* autocomplete tagsinput*/
        .label-info {
            background-color: #5bc0de;
            display: inline-block;
            padding: 0.2em 0.6em 0.3em;
            font-size: 75%;
            font-weight: 700;
            line-height: 2;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25em;
            margin-bottom: 10px;
        }
        .bootstrap-tagsinput{
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            display: inline-block;
            padding: 4px 6px;
            color: #555;
            vertical-align: middle;
            border-radius: 4px;
            width: 100%;
            height: auto;
            line-height: 22px;
            cursor: text;
        }
        .top_speciality .bootstrap-tagsinput{
            width: 83%;


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
        .action {
            width: 80px !important;
        }
    </style>

@endpush
@section('content')
@include('includes.pre-loader')
    <div class="dc-services" id="services">
    	  @if (Session::has('message'))
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
            </div>
        @elseif (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
            </div>
        @endif
 <section class="dc-haslayout">
    <div class="row">
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                     <div class="dc-dashboardbox">
                        <div class="dc-dashboardboxtitle dc-titlewithsearch dc-titlewithdel">
                            <h2>Manage Lab Test Meta</h2>
                        </div>
                        @if ($tests->count() > 0)
                           <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table id="tests"  class="table table-bordered table-hover dt-responsive nowrap table-responsive"cellspacing="0">
                                    <thead>
                                        <tr>
                                          
                                            <th>Title</th>
                                            <th>Known as</th>
                                            <th>Created at</th>
                                            <th>Update at</th>
                                            <th class="action">{{{ trans('lang.action') }}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; 
                                        @endphp
                                        @foreach ($tests as $key => $test)
                                            <tr class="del-{{{ $test->id }}}">
                                        <td>
                                          {{$test->title}}
                                        </td>

                                                @if($test->known_as)
                                                <td>{{$test->known_as}}</td>
                                                @else
                                                <td>Null</td>
                                                @endif

                                                @if($test->created_at)
                                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $test->created_at)->format('M d, Y, H:i A') }}</td>
                                                @else
                                                    <td>Null</td>
                                                @endif

                                                 @if($test->updated_at)
                                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $test->updated_at)->format('M d, Y, H:i A') }}</td>
                                                @else
                                                    <td>Null</td>
                                                @endif
                                         
                                         
                                                <td>
                                                    <div class="dc-actionbtn">
                                                        <a href="{{action('Speciality_TestController@editLabMeta',$test->id) }}" class="dc-addinfo dc-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                
                                               
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($tests,'links') )
                                    {{ $tests->links('pagination.custom') }}
                                @endif
                            </div>
                        @else
                            @include('errors.no-record')
                        @endif
                    </div>

              
                </div>
            </div>                     	
    </div>
       </section>                  	
</div>
@endsection
@push('scripts')
@stack('backend_scripts')
<script type="text/javascript">
      $(document).ready(function() {
        $('#tests').DataTable();
      } );
</script>
<!--   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  -->
  
    <script src="{{ asset('js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-tagsinput.min.js') }}">
</script>
@endpush
