@extends('layouts.main')

@section('prescript')
<link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<section class="content-header">
    <h1>
        Payment
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Application</li>
        <li class="active">Payment</li>
    </ol>
</section>
<br>
<section class="content">
    <div class="box box-warning">
        <div class="box-body" style="padding:3%">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        EduCity Sports Complex
                        <small class="pull-right">Date: {{ date('m/d/Y') }}</small>
                    </h2>
                </div>
            </div>
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    From
                    <address>
                        <strong>EduCity Sports Complex Management</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        Phone: (804) 123-5432<br>
                        Email: info@almasaeedstudio.com
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    To
                    <address>
                        <strong>{{ $customer->name }}</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        Phone: {{ $customer->phone }}<br>
                        Email: {{ $customer->email }}
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    <b>Invoice #007612</b><br>
                    <br>
                    <b>Order ID:</b> 4F3S8J<br>
                    <b>Payment Due:</b> 2/22/2014<br>
                    <b>Account:</b> 968-34567
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Asset</th>
                                <th>Price Type</th>
                                <th>Price Per Entry (RM)</th>
                                <th>Deposit (RM)</th>
                                <th>Subtotal (RM)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                                $n = 1;
                                $total = 0;
                            @endphp
                            
                            @foreach($reservations as $r)
                            <tr>
                                <td>{{ $n++ }}</td>
                                <td>{{ $r->r_activity->activity }}</td>
                                <td>
                                    @if($r->price_type == 1)
                                        Public
                                    @elseif($r->price_type == 2)
                                        Student
                                    @elseif($r->price_type == 3)
                                        Under 12
                                    @endif
                                </td>
                                <td>
                                    @if($r->price_type == 1)
                                        {{ $price = number_format($r->r_activity->public, 2) }}
                                    @elseif($r->price_type == 2)
                                        {{ $price = number_format($r->r_activity->students, 2) }}
                                    @elseif($r->price_type == 3)
                                        {{ $price = number_format($r->r_activity->underage, 2) }}
                                    @endif
                                </td>
                                <td>{{ number_format($r->r_activity->deposit, 2) }}</td>
                                <td>{{ $subtotal = number_format($price + $r->r_activity->deposit, 2) }}</td>
                                @php $total += $subtotal @endphp
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6">
                    <p class="lead">Generated QR Code:</p>
                    <p>Please scan the following code at the enterance.</p>
                    <p class=" text-center" style="margin-top: 10px;">
                     {!! QrCode::size(150)->generate('123') !!}
                    </p>
                </div>
                <div class="col-xs-6">
                    <p class="lead">Amount Due 2/22/2014</p>

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                            <th style="width:50%">Subtotal: </th>
                            <td>RM {{ number_format($total, 2) }}</td>
                            </tr>
                            <tr>
                            <th>Tax: </th>
                            <td>0%</td>
                            </tr>
                            <tr>
                            <th>Discount (Membership / Special Offer): </th>
                            <td>0%</td>
                            </tr>
                            <tr>
                            <th>Total: </th>
                            <td>RM {{ number_format($total, 2) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <form id="submitPayment" action="{{ url('application/payment/'.$application->id) }}" method="POST">
                @csrf
                <input type="hidden" name="total" value="">
            </form>
            <div class="row no-print">
                <div class="col-xs-12">
                    <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                    <button onClick="submitPayment()" type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
                    </button>
                    <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                    <i class="fa fa-download"></i> Generate PDF
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('postscript')
<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script>
    submitPayment = () => {
        var confirmPayment = confirm('Sure to submit payment?')
        if(confirmPayment){
            $.ajax({
                type:"POST",
                url: "{{ url('ajax/submitpayment') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": "{{ $application->id }}",
                    "total": "{{ number_format($total, 2) }}"
                }
            }).done(function(response){
                if(response == "success"){
                    Swal.fire(
                        'Success!',
                        'Payment has been made!',
                        'success'
                    ).then((result) => {
                        if(result.value){
                            window.location = "{{ url('application') }}";
                        }
                    })
                }
            });
        } else {
            Swal.fire(
                'Cancelled',
                'Payment has been cancelled!',
                'warning'
            ).then((result) => {
                if(result.value){
                    window.location = "{{ url('application') }}";
                }
            })
        }
    }
</script>
@endsection