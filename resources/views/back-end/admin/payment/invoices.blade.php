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
            	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-6 dc-responsive-mt mt-lg-0 mt-xl-0">
                <div class="dc-dashboardbox">
                        <div class="dc-dashboardboxtitle dc-titlewithsearch dc-titlewithdel">
                            <h2>Doctors Invoices</h2>
                          <!--    <div class="dc-rightarea form_head">
                                {!! Form::open(['url' => url(''),
                                    'method' => 'get', 'class' => 'dc-formtheme dc-formsearch'])
                                !!}
                                    <fieldset>
                                        <div class="form-group">
                                            <input type="text" name="keyword" value="{{{ !empty($_GET['keyword']) ? $_GET['keyword'] : '' }}}"
                                                class="form-control" placeholder="{{{ trans('') }}}">
                                            <button type="submit" class="dc-searchgbtn"><i class="lnr lnr-magnifier"></i></button>
                                        </div>
                                    </fieldset>
                                {!! Form::close() !!}
                            </div> -->
                        </div>
                      
                           <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table class="dc-tablecategories dc-table-responsive" id="checked-val">
                                    <thead>
                                        <tr>
                                          
                                            <th>User Name</th>
                                            <th>Payable</th>
                                            <th>Payment Method</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($allinvoice as $key => $data)
                                      @php
                               $alldata =  DB::table('user_metas')->where('user_id',$data->id)->get();
                               $order_data = DB::table('orders')->where('user_id',$data->id)->get();
                                      @endphp
                                       @foreach ($alldata as $key => $datas)
                                        @foreach ($order_data as $key => $orders)
                                      
                                   

                                            <tr class="">
                                                
                                                <td>{{$data->first_name}} {{$data->last_name}}</td>
                                                  
                                                <td>{{((($datas->starting_price)*($datas->commission))/100)}}</td>
                                                <td>{{$orders->payment_gateway}}</td>
                                                <td>{{$orders->status}}</td>
                                          </tr>
                                       
                                           @endforeach
                                          @endforeach
                                          @endforeach
                                    </tbody>
                                </table>
                               
                            </div>
                       
                    </div>
              
                </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-6">
       
        </div>
                        	
    </div>
       </section>                  	
</div>
@endsection
@push('scripts')
@stack('backend_scripts')

@endpush
