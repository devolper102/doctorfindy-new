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
                        
                       
                        @if ($labDiscounts->count() > 0)
                        <div class="col-md-12">
                        
                            <!-- Recent Orders -->
                            <div class="card card-table">
                                <div class="card-header">
                                    <h4 class="card-title">All lab Discounts</h4>
                                </div>
                                <div class="card-body card-sm-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered dt-responsive nowrap table-responsive"id="online_labDiscount_table">
                                            <thead>
                                                <tr>
                                                    <th>Created Date</th>
                                                    <th>Patient Name</th>
                                                    <th>Phone No.</th>
                                                    <th>Discount Code</th> 
                                                    <th>Address</th>
                                                    <th>Age</th>
                                                    <th class="text-right">Requested Home Sampling</th>
                                                    <th class="action">{{{ trans('lang.action') }}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($labDiscounts as  $key => $labDiscount)

                                                <tr>
                                                     <td>
                                                            {{$labDiscount->created_at}}
                                                    </td>
                                                    <td>
                                                            {{$labDiscount->name}}
                                                    </td>
                                                    <td>
                                                            {{$labDiscount->phone_number}}
                                                    </td>        
                                                    <td>{{$labDiscount->code}}</td>

                                                    <td>{{$labDiscount->address}}</td>
                                                       <td class="text-right">{{$labDiscount->age}}
                                                    </td>
                                                     
                                                    <td>
                                                    {{$labDiscount->home_sampling}}
                                                        
                                                    </td>

<td>
                                                    <div class="dc-actionbtn">
                                                        <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ $labDiscount->id }}'" :message="'{{'Lab Discount Deleted Successfully'}}'" :url="'{{url('admin/lab-discount/delete')}}'" :redirect_url="'{{url('admin/labs/lab_code_listing')}}'"></delete>
                                                    </div>
                                                    </td>
                                                </tr>
                                                <div id="message"></div>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /Recent Orders -->
                            
                        </div>
                        @else
                            @include('errors.no-record')
                        @endif
                    </div>
       </section>                   
</div>
@endsection
@push('scripts')
@stack('backend_scripts')
<script type="text/javascript">
     
      jQuery(document).ready(function() {
        jQuery('#online_labDiscount_table').DataTable({
            "order": [[ 0, "desc" ]],
             "paging": true, 
            "pageLength": 10
      });
});
    </script>
@endpush
