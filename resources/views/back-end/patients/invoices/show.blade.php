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


       <div class="invoice-content">
        <div class="container">
    <?php
     if (!empty($order->metaValue('appointment'))) {
                        $options = unserialize($order->metaValue('appointment'));
                       }
    ?>
    <div class="row">
        <div class="col-md-6">
            <div class="invoice-logo">
                 <img src="{{asset('/images/logo.png')}}" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="invoice-detail">
                <p>
                    <strong>Order Id:</strong>
                     {{$order->id }}
                    <br>
                    <strong><strong>Date:</strong></strong>
                     {{$options['appointment_date'] }} <span>{{$options['appointment_time'] }}</span>
                     <br>
                    <strong><strong>Status:</strong></strong>
                    {{$order->status }}
                    <br>
                    <strong><strong>Type:</strong></strong>
                    {{$options['type'] }}
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="invoice-info">
                <strong>Doctor Name</strong>
                @php
                $user_data =   DB::table('users')->where('id',$options['user_id'])->first();
                @endphp
                <p>
                    {{$user_data->first_name}} {{$user_data->last_name}}
                </p>
            </div>
        </div>

         <div class="col-md-6">
            <div class="invoice-info invoice-info-2">
                <strong>Patient Name</strong>
                <p>
                 <?php
                        if($options['patient_name'] == null){
                             echo "Guest User";  

                        }
                        else{
                        echo $options['patient_name'];  
                        }
               ?>
               </p>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
             <div class="invoice-info">
                <strong>Payment Method</strong>
                <p>
                   {{$order->payment_gateway}}
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
                                                            <th class="text-center">Services</th>
                                                            <th class="text-center">Charges</th>
                                                           
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center">{{$options['services']}}</td>
                                                            <td class="text-center">{{$options['charges']}}</td>
                                                          
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
                                            <h4>Comments</h4>
                                            <p>{{$options['comments']}}</p>
                                        </div>
                                    </div>
                                </div>
</div>
</div>
@endsection
