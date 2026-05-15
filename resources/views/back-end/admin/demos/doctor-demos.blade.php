@extends('back-end.master')
@push('backend_stylesheets')
<style type="text/css">
	#vaccination thead tr th{
        min-width: 190px;
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
                            <h2>Manage Doctors Demo Requests</h2>
                        </div>
                        @if ($doctorDemos->count() > 0)
                           <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table  id="vaccination"  class="table table-bordered table-hover dt-responsive nowrap table-responsive"cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Speciality</th>
                                            <th>PMDC / NCS Select</th>
                                            <th>Number</th>
                                            <th>Phone Number</th>
                                            <th>Email</th>
                                            <th>City</th>
                                            <th class="action">{{{ trans('lang.action') }}}</th>
                                            <th>Created Date</th>
                                            <th>Updated Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($doctorDemos as $key => $demo)
                                            <tr>
                                                
                                                <td>{{$demo->name}}</td>
                                                <td>{{$demo->speciality}}</td>
                                                <td>{{$demo->pdmc_ncs_select}}</td>
                                                <td>{{$demo->number}}</td>
                                                <td>{{$demo->phone_number}}</td>
                                                <td>{{$demo->email}}</td>
                                                <td>{{$demo->city}}</td>
                                               
                                                <td>
                                              
                                                </td>
                                                <td>{{ $demo->created_at->format('M d, Y, H:i A') }}</td>
                                                <td>{{ $demo->updated_at->format('M d, Y, H:i A') }}</td>
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($doctorDemos,'links') )
                                    {{ $doctorDemos->links('pagination.custom') }}
                                @endif
                            </div>
                        @else
                            @include('errors.no-record')
                        @endif
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
        $('#vaccination').DataTable();
      } );
</script>
@endpush
