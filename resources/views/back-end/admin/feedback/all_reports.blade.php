@extends('back-end.master')
@push('backend_stylesheets')
<style type="text/css">
	
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
        <div class="dc-dashboardbox pt-3">
                       
            @if ($reports->count() > 0)
            <div class="col-md-12">
            
                <!-- Recent Orders -->
                <div class="card card-table">
                    <div class="card-header">
                        <h4 class="card-title">All Reports</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover dt-responsive nowrap"id="reports">
                                <thead>
                                    <tr>
                                        <th>Doctor/Hospital/Lab Name</th>
                                        <th>User Name</th>
                                        <th> Name</th>
                                        <th>Phone Number</th>
                                         <th>Email</th> 
                                        <th>Submit Time</th>
                                        <th class="action">{{{ trans('lang.action') }}}</th>
                                        <th class="none">Comments</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reports as  $key => $report)
                                    <tr>
                                    @if($report->doctor_id !='')                            
                                    @php
                                        $app_user = App\User::where('id',$report->doctor_id)->with('profile')->first();
                                        
                                    @endphp

                                        <td>
                                                <a href="/profile/{{clean($app_user->slug)}}">{{Helper::getUserData($app_user->id)}}</a>
                                        </td>
                                        @else
                                                                    <td> - </td>
                                        @endif  
                                        @if($report->user_id !='')                            
                                        @php
                                            $app_patient = App\User::where('id',$report->user_id)->with('profile')->first();
                                            
                                        @endphp                       
                                        <td>
                                            @if($app_patient != '')
                                                <b>{{Helper::getUserData($app_patient->id)}}</b>
                                            @else
                                            <b> - </b>
                                            @endif
                                        </td>  
                                         @else
                                            <td> - </td>                         
                                         @endif                                    
                                        <td>{{$report->name}}</td>
                                        <td>{{$report->phone_number}}</td>
                                        <td>{{$report->email}}</td>

                                        <td><span class="text-primary d-block">{{$report->created_at}}</span></td>
                                        <td>
                                        <div class="dc-actionbtn">
                                            <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ $report->id }}'" :message="'{{'Report Deleted Successfully'}}'" :url="'{{url('admin/report/delete')}}'" :redirect_url="'{{url('admin/all-reports')}}'"></delete>
                                        </div>
                                        </td>
                                        <td>
                                        {{$report->description}}
                                            
                                        </td>

                                    </tr>
                                    <div id="message"></div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @else
                @include('errors.no-record')
            @endif
        </div>
    </div>
       </section>                  	
</div>
@endsection
@push('scripts')
@stack('backend_scripts')
<script type="text/javascript">
     
      jQuery(document).ready(function() {
        jQuery('#reports').DataTable();
      } );

    </script>
@endpush
