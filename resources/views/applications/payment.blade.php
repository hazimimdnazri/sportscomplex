@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.5.3/dist/sweetalert2.min.css">
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
<section class="invoice">
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-globe"></i> Sports Complex
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
                        <th>Category</th>
                        <th>Duration (Hour)</th>
                        <th>Price/Min. Hour (RM)</th>
                        <th>Subtotal (RM)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>{{ $application->a_asset->asset }}</td>
                        <td>{{ $application->a_asset->a_type->type }}</td>
                        <td>{{ $duration }}</td>
                        <td>{{ number_format($asset->price, 2) }} / {{$asset->min_hour}}</td>
                        <td>{{ number_format(($duration / $asset->min_hour) * $asset->price, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            <p class="lead">Payment Methods:</p>
            <img src="{{ asset('assets/dist/img/credit/visa.png') }}" alt="Visa">
            <img src="{{ asset('assets/dist/img/credit/mastercard.png') }}" alt="Mastercard">
            <img src="{{ asset('assets/dist/img/credit/american-express.png') }}" alt="American Express">
            <img src="{{ asset('assets/dist/img/credit/paypal2.png') }}" alt="Paypal) }}">

            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
            </p>
        </div>
        <div class="col-xs-6">
            <p class="lead">Amount Due 2/22/2014</p>

            <div class="table-responsive">
                <table class="table">
                    <tr>
                    <th style="width:50%">Subtotal:</th>
                    <td>RM {{ number_format(($duration / $asset->min_hour) * $asset->price, 2) }}</td>
                    </tr>
                    <tr>
                    <th>Tax:</th>
                    <td>0%</td>
                    </tr>
                    <tr>
                    <th>Discount (Membership / Special Offer):</th>
                    <td>{{ $customer->c_membership->discount }}%</td>
                    </tr>
                    <tr>
                    <th>Total:</th>
                    <td>RM {{ number_format((($duration / $asset->min_hour)* (100-$customer->c_membership->discount)/100) * $asset->price, 2) }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <form id="submitPayment" action="{{ url('application/payment/'.$application->id) }}" method="POST">
        @csrf
        <input type="hidden" name="total" value="{{ number_format((($duration / $asset->min_hour)* (100-$customer->c_membership->discount)/100) * $asset->price, 2) }}">
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
</section>
@endsection

@section('postscript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.5.3/dist/sweetalert2.all.min.js"></script>
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
                    "total": "{{ number_format((($duration / $asset->min_hour)* (100-$customer->c_membership->discount)/100) * $asset->price, 2) }}"
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