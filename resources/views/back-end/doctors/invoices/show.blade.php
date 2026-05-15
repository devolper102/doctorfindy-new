@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@push('stylesheets')
    <link href="{{ asset('css/print.css') }}" rel="stylesheet" media="print" type="text/css">
    <style>
    
.invoice-content{width: 100%;
display: inline-block;
background-color: #fff;
border: 1px solid #f0f0f0;
    border-radius: 4px;
padding:28px 17px;}
.invoice-detail p{
    text-align: right;
    color: #757575;
     font-size: 0.9375rem; 
    font-family: "Poppins",sans-serif;
    font-weight: 500;
}
.invoice-detail strong{
    color: #272b41;
}
.invoice-logo, .invoice-info{margin-bottom: 30px;}

.invoice-info strong{
    font-size: 18px;
    color: #272b41;
    margin-bottom: 8px;
    display: inline-block;
    font-family: "Poppins",sans-serif;
}
.invoice-info p{
    color: #757575;
    font-size: 0.9375rem;
    font-family: "Poppins",sans-serif;
    font-weight: 500;
}
.invoice-info-2{text-align: right;}
.invoice-table thead tr th{
    text-align: left;
    padding: 10px 20px;
    line-height: inherit;
}
.invoice-table tbody tr td{
    color: #757575;
    font-weight: 500;
    text-align: left;
    padding: 10px 20px;
    line-height: inherit;
}
.invoice-table-two tbody tr th{
    border: 0; 
    line-height: inherit;
text-align: left;}
.invoice-table-two tbody tr td{border: 0;
line-height: inherit;}
.invoice-table-two tbody tr td span{
    color: #757575;
    font-weight: 500;
}
.invoice-table-two tbody tr{border-bottom: 1px solid #eee;}
.invoice-table-two tbody tr:nth-child(3){border-bottom: 0;}
.other-info p{font-family: "Poppins",sans-serif;
    font-size: 0.9375rem;
    color: #757575;
width: 86%;
    margin: 0;
    display: inline-block;}

.other-info h4{font-size: 1.125rem;}





</style>

@endpush
@section('content')
    <div class="dc-haslayout">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="invoice_list">
                <div class="dc-transactionhold">
                    <div class="dc-borderheading dc-borderheadingvtwo">
                        <h3>{{{trans('lang.transaction_detl')}}}</h3>
                        <a class="print-window" href="javascript:void(0);" @click="print()">
                            <i class="fa fa-print"></i>
                            {{{trans('lang.print')}}}
                        </a>
                    </div>
                    <div class="dc-transactioncontent" id="printable_area">
                        <ul class="dc-transactiondetails">
                            <li>
                                <span><em>{{{ trans('lang.pay_rec') }}}</em> {{{ trans('lang.from') }}} {{{ $order->metaValue('payer_name') }}}</span>
                                <span class="dc-grossamount">{{{ trans('lang.gross_amnt') }}}</span>
                            </li>
                            <li>
                                <span>
                                    {{{ Carbon\Carbon::parse($order->created_at)->diffForHumans()}}} on {{{Carbon\Carbon::parse($order->created_at)->format('l \\a\\t H:i:s')}}}
                                </span>
                                <span class="dc-transactionid">
                                    {{{trans('lang.transaction_id')}}}:&nbsp;{{ $order->metaValue('transaction_id') }}
                                </span>
                                @if (!empty($order->metaValue('customer_id')))
                                    <span class="dc-transactionid">
                                        {{{trans('lang.customer_id')}}}:&nbsp;{{ $order->metaValue('customer_id') }}
                                    </span>
                                @endif
                                <span class="dc-grossamount dc-grossamountusd">{{{ $symbol }}}{{ $options['cost'] }}&nbsp;{{{ $currency_code }}}</span>
                            </li>
                            <li>
                                <span>{{{trans('lang.pay_status')}}}&nbsp;&colon;</span>
                                @if (!empty($order->status))
                                    <span class="dc-paymentstatus">{{{ $order->status }}}</span>
                                @endif
                            </li>
                        </ul>
                        <table class="table dc-carttable">
                            <thead>
                                <tr>
                                    <th>{{{trans('lang.product_name')}}}</th>
                                    <th>{{{trans('lang.product_qty')}}}</th>
                                    <th>{{{trans('lang.product_price')}}}</th>
                                    <th>{{{trans('lang.product_subtotal')}}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td data-title="Product Name">
                                        <em>{{{ $options['title'] }}}</em>
                                    </td>
                                    <td data-title="Unit Price">{{{ $options['cost'] }}}</td>
                                    <td data-title="Total">{{ $symbol }}{{{ $options['cost'] }}}&nbsp;{{ $currency_code }}</td>
                                    <td data-title="Total">{{ $symbol }}{{{ $options['cost'] }}}&nbsp;{{ $currency_code }}</td>
                                </tr>
                                <tr>
                                    <td data-title="Product Name"></td>
                                    <td data-title="Unit Price"></td>
                                    <td data-title="Unit Price">{{{trans('lang.purchase_total')}}}</td>
                                    <td data-title="Total">{{ $symbol }}{{{ $options['cost'] }}}&nbsp;{{ $currency_code }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table dc-carttable dc-carttablevtwo">
                            <thead>
                                <tr>
                                    <th>{{{trans('lang.pay_detl')}}}</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td data-title="Product Name">
                                        <em>{{{trans('lang.purchase_total')}}}</em>
                                        <span>{{ $symbol }}{{{ $options['cost'] }}}&nbsp;{{ $currency_code }}</span>
                                    </td>
                                    <td data-title="Unit Price"></td>
                                    <td data-title="Total"></td>
                                    <td data-title="Total"></td>
                                </tr>
                                <tr>
                                    <td data-title="Product Name">
                                        <em>{{{trans('lang.sales_tax')}}}</em>
                                        <span>{{ $symbol }}{{{ $order->metaValue('sales_tax') }}} {{ $currency_code }}</span>
                                    </td>
                                    <td data-title="Unit Price"></td>
                                    <td data-title="Total"></td>
                                    <td data-title="Total"></td>
                                </tr>
                                <tr>
                                    <td data-title="Product Name">
                                        <em>{{{trans('lang.shiping_amnt')}}}</em>
                                        <span>{{ $symbol }}{{{ $order->metaValue('shipping_amount') }}} {{ $currency_code }}</span>
                                    </td>
                                    <td data-title="Unit Price"></td>
                                    <td data-title="Total"></td>
                                    <td data-title="Total"></td>
                                </tr>
                                <tr>
                                    <td data-title="Product Name">
                                        <em>{{{trans('lang.handling_amnt')}}}</em>
                                        <span>{{ $symbol }}{{{ $order->metaValue('handling_amount') }}} {{ $currency_code }}</span>
                                    </td>
                                    <td data-title="Unit Price"></td>
                                    <td data-title="Total"></td>
                                    <td data-title="Total"></td>
                                </tr>
                                <tr>
                                    <td data-title="Product Name">
                                        <em>{{{trans('lang.insurance_amnt')}}}</em>
                                        <span>{{ $symbol }}{{{ $order->metaValue('handling_amount') }}} {{ $currency_code }}</span>
                                    </td>
                                    <td data-title="Unit Price"></td>
                                    <td data-title="Total"></td>
                                    <td data-title="Total"></td>
                                </tr>
                                <tr>
                                    <td data-title="Product Name">
                                        <em>{{{trans('lang.net_amnt')}}}</em>
                                        <span>{{ $symbol }}{{{ $options['cost'] }}} {{ $currency_code }}</span>
                                    </td>
                                    <td data-title="Unit Price"></td>
                                    <td data-title="Total"></td>
                                    <td data-title="Total"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="dc-createtransactionhold dc-createtransactionholdvtwo">
                            <div class="dc-createtransactionheading">
                                <span></span>
                            </div>
                            <div class="dc-refundscontent">
                                <ul class="dc-refundsdetails">
                                    <li>
                                        <strong>{{{trans('lang.invoice_id')}}}</strong>
                                        <div class="dc-rightarea"><span>{{{ $order->metaValue('invoice_id') }}}</span></div>
                                    </li>
                                    <li>
                                        <strong>{{{trans('lang.paid_by')}}}</strong>
                                        <div class="dc-rightarea">
                                            <span>{{{ $order->metaValue('payer_name') }}}</span>
                                            <span>{{{trans('lang.pay_sender_note')}}} <em>{{{ $order->status }}}</em> </span>
                                            <span>{{{ $order->metaValue('payer_email') }}}</span>
                                        </div>
                                    </li>
                                    @if ($order->payment_gateway == "paypal")
                                        <li>
                                            <strong><span>{{{trans('lang.need_help')}}}</span></strong>
                                            <span class="dc-refundsinfo">{{{trans('lang.paypal_note')}}}</span>
                                        </li>
                                        <li><span class="dc-refundsinfo">{{{ trans('lang.paypal_warning_note') }}}</span></li>
                                    @endif
                                    <li>
                                        <strong>{{{trans('lang.memo')}}}</strong>
                                        <div class="dc-rightarea"><span>{{{ $options['title'] }}}</span></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
   <div class="invoice-content">

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="invoice-logo">
                 <img src="{{asset('/images/logo (1).png')}}" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="invoice-detail">
                <p>
                    <strong>Order:</strong>
                     #00124 
                    <br>
                    <strong><strong>Issued:</strong></strong>
                     20/07/2019
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="invoice-info">
                <strong>Invoice From</strong>
                <p>Dr. Darren Elder 
                    <br>
                806  Twin Willow Lane, Old Forge,
                <br>
                Newyork, USA
                </p>
            </div>
        </div>
         <div class="col-md-6">
            <div class="invoice-info invoice-info-2">
                <strong>Invoice To</strong>
                <p>
                    Walter Roberson 
                    <br>
               299 Star Trek Drive, Panama City,
                <br>
                Florida, 32405, USA
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
             <div class="invoice-info">
                <strong>Payment Method</strong>
                <p>
                    Debit Card 
                    <br>
               XXXXXXXXXXXX-2541
                <br>
                HDFC Bank
                </p>
            </div>
        </div>
    </div>
    <div class="invoice-item invoice-table-wrap">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="invoice-table table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Description</th>
                                                            <th class="text-center">Quantity</th>
                                                            <th class="text-center">VAT</th>
                                                            <th class="text-right">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>General Consultation</td>
                                                            <td class="text-center">1</td>
                                                            <td class="text-center">$0</td>
                                                            <td class="text-right">$100</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Video Call Booking</td>
                                                            <td class="text-center">1</td>
                                                            <td class="text-center">$0</td>
                                                            <td class="text-right">$250</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-4 ml-auto">
                                            <div class="table-responsive">
                                                <table class="invoice-table-two table">
                                                    <tbody>
                                                    <tr>
                                                        <th>Subtotal:</th>
                                                        <td><span>$350</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Discount:</th>
                                                        <td><span>-10%</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Amount:</th>
                                                        <td><span>$315</span></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="other-info">
                                            <h4>Other information</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sed dictum ligula, cursus blandit risus. Maecenas eget metus non tellus dignissim aliquam ut a ex. Maecenas sed vehicula dui, ac suscipit lacus. Sed finibus leo vitae lorem interdum, eu scelerisque tellus fermentum. Curabitur sit amet lacinia lorem. Nullam finibus pellentesque libero.</p>
                                        </div>
                                    </div>
                                </div>
</div>
</div>

@endsection
