@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@push('backend_stylesheets')
    <link href="{{ asset('css/basictable.css') }}" rel="stylesheet">
@endpush
@section('content')
    <section class="dc-haslayout">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-9 float-right" id="invoice_list">
                <div class="dc-dashboardbox dc-dashboardinvocies">
                    <div class="dc-dashboardboxtitle dc-titlewithsearch">
                        <h3>{{ trans('lang.invoices') }}</h3>
                    </div>
                    <div class="dc-dashboardboxcontent dc-categoriescontentholder dc-categoriesholder" id="printable_area">
      
                        @if (!empty($all_appointments) && $all_appointments->count() > 0)
                        @php $options= ''; @endphp
                            <table class="dc-tablecategories dc-table-responsive">
                                <thead>
                                    <tr>
                                        <th>{{ trans('lang.invoice_id') }}</th>
                                        <th>{{ trans('lang.purchase_date') }}</th>
                                       
                                        <th>{{ trans('lang.amount') }}</th>
                                        <th>{{ trans('lang.status') }}</th>
                                        <th>{{ trans('lang.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($all_appointments as $key => $appointment)
                                     @php
                                            $orders = App\Order::where('user_id',$appointment->patient_id)->with('orderMeta')->get();
                                            /*if (!empty($order->metaValue('appointment'))) {
                                                $options = unserialize($order->metaValue('appointment'));
                                            }*/
                                        @endphp
                                     @foreach($orders as $key2=>$order)


                                            <tr>
                                                <td>{{$order->id}} {{$key}} {{$key2}}</td>
                                                <td>{{{ \Carbon\Carbon::parse($order->appointment_date)->format('M d, Y') }}}</td>
                                                
                                                <td>Rs {{{ !empty($order->metaValue('charges')) ? html_entity_decode(clean($order->metaValue('charges'))) : trans('lang.not_available') }}}</td>
                                                <td> {{{ $order->status }}} </td>
                                                <td>
                                                    <div class="dc-actionbtn">
                                                        @if ($order->status == 'completed')
                                                            <a class="print-window dc-addinfo dc-skillsaddinfo" href="{{ route('showInvoice',['id' => intVal(clean($order->id))]) }}">
                                                                {{ trans('lang.view_invoice') }}
                                                            </a>
                                                        @else
                                                            <a class="print-window dc-addinfo dc-skillsaddinfo disable-eye" href="javascript:;">
                                                                {{ trans('lang.view_invoice') }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                     @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            @if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
                                @include('extend.errors.no-record')
                            @else 
                                @include('errors.no-record')
                            @endif
                        @endif
                        @if ( method_exists($all_appointments,'links') )
                            {{ $all_appointments->links('pagination.custom') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
@stack('backend_scripts')
{{--<script src="{{ asset('js/jquery.basictable.min.js') }}"></script>--}}
<script type="text/javascript">
    jQuery('.dc-table-responsive').basictable({
            breakpoint: 767,
    });
</script>
@endpush