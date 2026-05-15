@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@push('stylesheets')
    <style>
        body {
            background: #fff;
        }

        form {
            margin: 0;
            padding: 0;
        }

    

.booking-card{width: 348px;
display: inline-block;
background-color: #fff;
box-shadow: 0 0 15px 0 rgba(0, 0, 0, .1);}
.card-header .card-title{font-size: 1.12em;
    color: #272b41;
    font-weight: 500;
    margin-bottom: 0;}

.booking-doc-info .booking-doc-img{
    width: 80px;
    height: 80px;
    display: inline-block;
    background-color: #38b44e;
    border-radius: 4px;
    float: left;
    margin-right: 15px;
}

.card-body{padding: 1.5rem;
display: inline-block;}
.booking-doc-info{
    display: inline-block;
    width: 100%;
}
.booking-info{width: auto;
    display: inline-block;}
.booking-info h4{font-size: 1.12em;
margin-bottom: 0;}
.booking-info h4 a{
    color: #272b41;
    font-weight: 500;
}
.booking-info h4 a:hover{color: #09dca4;}
.rating {
    margin: 0 0 7px;
   width: auto;
    display: inline-block;
}
.rating .filled{color: #f4c150;}
.rating i{color: #dedfe0;}
.clinic-details .doc-location{color: #757575;
    font-size: 14px;
    margin-bottom: 25px;}
.booking-summary .booking-item-wrap .booking-date li{font-size: 14px;
    font-weight: 500;
    color: #272b41;
    text-transform: capitalize;
    margin-bottom: 6px;}
.booking-summary .booking-item-wrap .booking-date{margin-bottom: 0;}
.booking-summary .booking-item-wrap .booking-date span{float: right;
    color: #757575;
    font-weight: 400;
    font-size: 15px;}

.booking-fee li{font-size: 14px;
    font-weight: 500;
    color: #272b41;
    margin-bottom: 6px;}
.booking-fee span{float: right;
    color: #757575;
    font-weight: 400;
    font-size: 15px;}

.booking-total{border-top: 1px solid #e4e4e4;
    margin-top: 20px;
    padding-top: 20px;}

.booking-total .booking-total-list li span {
    font-size: 18px;
    font-weight: 600;
    color: #272b41;
    font-weight: bold;
}
.booking-total .booking-total-list{margin-bottom: 0;}
.booking-total .booking-total-list li .total-cost {
    color: #20c0f3;
    font-size: 16px;
    float: right;
    font-weight: bold;
}

.card{background-color: #fff;
width: 100%;
display: inline-block;
box-shadow: 0 0 15px 0 rgba(0, 0, 0, .1);
border: 1px solid #f0f0f0;}
.info-widget .card-title{font-size: 1.12em;
    color: #272b41;
    font-weight: 500;}
.card-label input{border: 1px solid #dbdbdb;
padding: 5px 15px;
width: 243px;}
.dc-tabbtns label {min-width: 126px;}
.dc-title .visiting-doctor-text{margin-top: 6px;
display: inline-block;}
.form-group-half{margin-top: 20px;
width: 49%;}
.dc-select{margin-left: 9px;}
.sj-paymentmethod li img{width: 100px;}
.sj-paymentmethod li a span label{display: block;
    font-size: 14px;}

.sj-paymentmethod li{margin-bottom: 10px;}

.modal-content{width: 500px;}

.modal-dialog .modal-content .modal-header .close{color: #fc413c;}
.modal-header .modal-title{margin-bottom: 9px;}
.modal-header .modal-title p{margin:0;}
.modal-body span{
    color: #757575;
    font-size: 15px;
    font-weight: 500;
}
.sj-paymentmethod li a i{display: block;}












    </style>
@endpush
@section('content')
@include('includes.pre-loader')
    <section class="wt-haslayout wt-dbsectionspace" id="user-profile">
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <form>
                            <div class="info-widget">
                                <h4 class="card-title">Personal Information</h4>
                            </div>
                            <div class="form-group card-label">
                                <input placeholder="Full Name" name="title" type="text" class="form-control">
                                <input placeholder="Email" name="title" type="text" class="form-control">
                            </div>
                           <!--  
                             <div class="form-group card-label">
                                <input placeholder="Email" name="title" type="text" class="form-control">
                            </div> -->

                        </form>
        <div data-v-f0f63c70="" class="dc-title popup_btns">
            <span class="visiting-doctor-text" data-v-f0f63c70="">Who is Visiting To Doctor? :
            </span> <!----> <div data-v-f0f63c70="" class="dc-tabbtns">
                <input data-v-f0f63c70="" id="dc-myself" type="radio" name="patient" value="myself" checked="checked"> <label data-v-f0f63c70="" for="dc-myself" class="tab active">
              Myself
        </label> <input data-v-f0f63c70="" id="dc-someone" type="radio" name="patient" value="someone"> <label data-v-f0f63c70="" for="dc-someone" class="tab some-one-button">
              Someone Else
          </label>
      </div>
       <div data-v-f0f63c70="" class="form-group form-group-half"><input data-v-f0f63c70="" type="text" id="patient_name" name="patient_name" placeholder="Patient Name:" class="form-control"></div>

                <div data-v-f0f63c70="" class="form-group form-group-half"><span data-v-f0f63c70="" class="dc-select"><select data-v-f0f63c70="" data-placeholder="Relation With You?*" name="relation" id="relation"><option data-v-f0f63c70="" value="">Relation With You?*</option> <option data-v-f0f63c70="" value="brother">Brother</option> <option data-v-f0f63c70="" value="wife">Wife</option> <option data-v-f0f63c70="" value="mother">Mother</option> <option data-v-f0f63c70="" value="sister">Sister</option>
                     <option data-v-f0f63c70="" value="sister">Cusin</option>
                </select></span></div>
      </div>

              

                    </div>

                </div>
                <div class="wt-dashboardbox">
                    @if (Session::has('message'))
                        <div class="flash_msg">
                            <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
                        </div>
                        @php session()->forget('message') @endphp;
                    @elseif (Session::has('error'))
                        <div class="flash_msg">
                            {{--  <flash_messages :message_class="'danger'" :time ='5' :message="'{{{ str_replace("'s", " ", Session::get('error')) }}}'" v-cloak></flash_messages>  --}}
                        </div>
                        @php session()->forget('error'); @endphp
                    @endif
                   <!--  <div class="sj-checkoutjournal">
                        <div class="sj-title">
                            <h3>{{{trans('lang.checkout')}}}</h3>
                        </div>
                        @php
                            session()->put(['product_id' => e($appointment->id)]);
                            session()->put(['price' => e($appointment->charges)]);
                            session()->put(['name' => e('appointment:'.$appointment->appointment_date.'-'.$appointment->appointment_time)]);
                            session()->put(['type' => 'appointment']);
                        @endphp 
                        <table class="sj-checkouttable">
                            <thead>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="sj-checkpaydetails">
                                            {{ trans('lang.doctor_name') }}
                                        </div>
                                    </td>
                                    <td>{{ Helper::getUserName($appointment->user_id) }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('lang.appointment_date') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M, Y') }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('lang.appointment_time') }}</td>
                                    <td>{{ $appointment->appointment_time }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('lang.appointment_status') }}</td>
                                    <td>{{ $appointment->status }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('lang.total') }}</td>
                                    <td>{{ !empty($symbol['symbol']) ? $symbol['symbol'] : '$' }}{{ $appointment->charges }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div> -->

                    @if (!empty($payment_gateway))
                        <div class="sj-checkpaymentmethod">
                            <div class="sj-title">
                                <h3>{{ trans('lang.select_pay_method') }}</h3>
                            </div>
                            <div class="sj-paymentmethodcontent">
                                <ul class="sj-paymentmethod">
                                    @foreach ($payment_gateway as $gateway)
                                        <li>
                                            @if ($gateway == "paypal")
                                                @php session()->put(['gateway' => 'paypal']); @endphp
                        <a class="jazz-cash-payment-box" href="{{{url('paypal/ec-checkout')}}}"data-toggle="modal" data-target="#jazz_cash_modal">
                                                    <!-- <i class="fab fa-paypal"></i> -->
                            <i class="fas fa-money-bill-alt" aria-hidden="true"></i>
        <!-- <img src="{{asset('/images/jazz-cash-seeklogo.png')}}" alt="jazz-cash-seeklogo picture"> -->

                                                    <span><em>{{ trans('lang.pay_amount_via') }}</em>{{ trans('lang.jazz_cash_payment') }}
                                                        <label>0344xxxxxxxx</label>
                                                        
                                                    </span>
                                                </a>
                                                    @elseif ($gateway == "stripe")
                                                @php session()->put(['gateway' => 'stripe']); @endphp
                                                <a href="javascrip:void(0);" v-on:click.prevent="getStriprForm">
                                                    <!-- <i class="fab fa-stripe-s"></i> -->
                <i class="fas fa-money-bill-alt" aria-hidden="true"></i>                                    
     <!--  <img src="{{asset('/images/jazz-cash-seeklogo.png')}}" alt="jazz-cash-seeklogo picture">   -->                                             
                                                    <span><em>{{ trans('lang.pay_amount_via_Card') }}
                                                    </em> {{  trans('lang.jazz_cash_card') }}
                                                    <label>5555555555554444</label>
                                                </span>
                                                </a>
<li>
    <a href="http://knockdoc.test/paypal/ec-checkout" data-toggle="modal" data-target="#pay_amount_modal">
        <i class="fas fa-money-bill-alt" aria-hidden="true"></i>
   <!--  <img src="http://knockdoc.test/images/jazz-cash-seeklogo.png" alt="jazz-cash-seeklogo picture"> --> <span>
        <em>Pay Amount  on </em> Visit
        </span></a></li>
   


  <!-- Modal -->
  <div class="modal fade" id="jazz_cash_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Jazz Cash Payment</h4>
        </div>
        <div class="modal-body">
          <div role="document" id="la-pay-stripe___BV_modal_content_" tabindex="-1"><div id="la-pay-stripe___BV_modal_body_" class="modal-body"><div class="d-block text-center">
            <form method="POST" id="stripe-payment-form" role="form" action="" class="dc-formtheme wt-form-paycard">
            <input type="hidden" name="_token" value="zeiB1tln72r01ZHpuMLW6wAum5KJRXMEsn9gCBFU">
             <fieldset>
            <div class="form-group wt-inputwithicon "><label>Jazz cash account 
            </label> <input id="card_no" type="text" name="card_no" value="" autofocus="autofocus" placeholder="0300xxxxxxxx" class="form-control">
        </div> 
            <div class="form-group wt-btnarea">
                <input type="submit" name="button" value="Pay Rs0" class="wt-btn">
          </div>
          </fieldset>
          </form>
      </div>
      </div>
      </div>
        </div>
        
      </div>
      
    </div>
  </div>    

 <div class="modal fade" id="pay_amount_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">
            Your appointment is fixed with <strong>dr sadiq </strong>at 
                <strong>
                16 nov 2020 9pm. 
            </strong>
          </h4>
        </div>
        <div class="modal-body">
             <span>Payment will be cash</span>
          <div role="document" id="la-pay-stripe___BV_modal_content_" tabindex="-1"><div id="la-pay-stripe___BV_modal_body_" class="modal-body"><div class="d-block text-center">
            <form method="POST" id="stripe-payment-form" role="form" action="" class="dc-formtheme wt-form-paycard">
            <input type="hidden" name="_token" value="zeiB1tln72r01ZHpuMLW6wAum5KJRXMEsn9gCBFU">

             <fieldset>
            <div class="form-group wt-btnarea">
                <input type="submit" name="button" value="Proceed" class="wt-btn">
          </div>
          </fieldset>
          </form>
      </div>
      </div>
      </div>
        </div>
        
      </div>
      
    </div>
  </div>    

                                            @endif
                                        </li>

                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <b-modal id="la-pay-stripe" ref="appointmentCheckout" hide-footer title="Stripe Payment" class="la-pay-stripe" :no-close-on-backdrop="true">
                            <div class="d-block text-center">
                                <form class="dc-formtheme wt-form-paycard" method="POST" id="stripe-payment-form" role="form" action="" @submit.prevent='submitStripeFrom' v-cloak>
                                    {{ csrf_field() }}
                                    <fieldset>
                                        <div class="form-group wt-inputwithicon {{ $errors->has('card_no') ? ' has-error' : '' }}">
                                            <label>{{ trans('lang.card_no') }}</label>
                                            <img src="{{asset('images/pay-icon.png')}}">
                                            <input id="card_no" type="text" class="form-control" name="card_no" value="{{ old('card_no') }}" autofocus>
                                            @if ($errors->has('card_no'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('card_no') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('ccExpiryMonth') ? ' has-error' : '' }}">
                                            <label>{{ trans('lang.expiry_month') }}</label>
                                            <input id="ccExpiryMonth" type="number" class="form-control" name="ccExpiryMonth" value="{{ old('ccExpiryMonth') }}" min="1" max="12" autofocus>
                                            @if ($errors->has('ccExpiryMonth'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('ccExpiryMonth') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('ccExpiryYear') ? ' has-error' : '' }}">
                                            <label>{{ trans('lang.expiry_year') }}</label>
                                            <input id="ccExpiryYear" type="text" class="form-control" name="ccExpiryYear" value="{{ old('ccExpiryYear') }}" autofocus>
                                            @if ($errors->has('ccExpiryYear'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('ccExpiryYear') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group wt-inputwithicon {{ $errors->has('cvvNumber') ? ' has-error' : '' }}">
                                            <label>{{ trans('lang.cvc_no') }}</label>
                                            <img src="{{asset('images/pay-img.png')}}">
                                            <input id="cvvNumber" type="number" class="form-control" name="cvvNumber" value="{{ old('cvvNumber') }}" autofocus>
                                            @if ($errors->has('cvvNumber'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('cvvNumber') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group wt-btnarea">
                                            <input type="submit" name="button" class="wt-btn" value="Pay {{ !empty($symbol['symbol']) ? $symbol['symbol'] : '$' }}{{$appointment->charges}}">
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </b-modal>
                    @endif



                        @php
                            header('Access-Control-Allow-Origin: *');
                                $appointment_id = request()->route('id');
            $appointment_data = App\Appointment::where('id', $appointment_id)->first();
            $patient_data = \App\User::where('id', $appointment_data->patient_id)->first();

            $orderId = $appointment_data->id. date('YmdHis');
            $ExpiryTime =  date('YmdHis', strtotime("+1 hours"));
            $TxnDateTime = date('YmdHis', strtotime("+0 hours"));

            $_TxnRefNumber = "T". date('YmdHis');
            $_AmountTmp = 1*100;
            $_AmtSplitArray = explode('.', $_AmountTmp);
            $_FormattedAmount = $_AmtSplitArray[0];

                        @endphp



                </div>
            </div>
            <div class=" col-sm-12 col-md-5 push-md-2 col-lg-5 push-lg-2">
                <div class="dc-preloader-section" v-if="loading" v-cloak>
                    <div class="dc-preloader-holder">
                        <div class="dc-loader"></div>
                    </div>
                </div>
                <div class="card booking-card">
    <div class="card-header">
        <h4 class="card-title">Booking Summary</h4>
    </div>
    <div class="card-body">
        <div class="booking-doc-info">
            <a class="booking-doc-img" href="#"></a>
            <div class="booking-info">
                <h4><a href="#">Dr. Darren Elder</a></h4>
            </div>
           <div class="rating">
                     <i class="fas fa-star filled"></i>
                     <i class="fas fa-star filled"></i>
                    <i class="fas fa-star filled"></i>
                    <i class="fas fa-star filled"></i>
                    <i class="fas fa-star"></i>
                    <span class="d-inline-block average-rating">35</span>
                    </div>
<div class="clinic-details">
        <p class="doc-location"><i class="fas fa-map-marker-alt"></i> Newyork, USA</p>
                </div>

        </div>
        <div class="booking-summary">
            <div class="booking-item-wrap">
                <ul class="booking-date">
                        <li>Date <span>16 Nov 2019</span></li>
                        <li>Time <span>10:00 AM</span></li>
                        </ul>
            </div>
        </div>
        <ul class="booking-fee">
                <li>Consulting Fee <span>$100</span></li>
                <li>Booking Fee <span>$10</span></li>
                <li>Video Call <span>$50</span></li>
                 </ul>
                 <div class="booking-total">
                                                <ul class="booking-total-list">
                                                    <li>
                                                        <span>Total</span>
                                                        <span class="total-cost">$160</span>
                                                    </li>
                                                </ul>
                                            </div>
    </div>
</div>
                
            </div>
        </div>
    </section>
@endsection
