@extends('layouts.main')

@section('prescript')
<link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<section class="content-header">
    <h1>
        Quotation
        <small>Applications</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Applications</li>
        <li class="active">Quotation</li>
    </ol>
</section>
<br>
<section class="invoice">
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
            From :
            <address>
                <strong>EduCity Sports Complex Management</strong><br>
                EduCity<br>
                81550, Nusajaya,<br>
                Johor.<br>
                Phone: +607-5095776<br>
                Email: admin@educity.com
            </address>
        </div>
        <div class="col-sm-4 invoice-col">
            To :
            <address>
                <strong>{{ $customer->name }}</strong><br>
                {{ $customer->r_vendor->address }}<br>
                {{ $customer->r_vendor->zipcode }}, {{ $customer->r_vendor->city }}<br>
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
    
    <h4>Facilities</h4>
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Venue</th>
                        <th>Sport</th>
                        <th>Duration (Hour)</th>
                        <th>Price/Min. Hour (RM)</th>
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
                        <td>{{ $r->r_sport->r_venue->venue }}</td>
                        <td>{{$r->r_sport->sport}}</td>
                        <td>{{ $r->duration }}</td>
                        <td>{{ number_format($r->r_sport->price, 2) }} / {{$r->r_sport->min_hour}}</td>
                        <td>{{ number_format(($r->duration / $r->r_sport->min_hour) * $r->r_sport->price, 2) }}</td>
                    </tr>
                    @php $total += ($r->duration / $r->r_sport->min_hour) * $r->r_sport->price @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <br>

    <h4>Equiptments</h4>
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Equiptment</th>
                        <th>Serial Number</th>
                        <th>Price</th>
                        <th>Subtotal (RM)</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $n = 1;
                    @endphp
                    
                    @foreach($equiptments as $e)
                    <tr>
                        <td>{{ $n++ }}</td>
                        <td>{{ $e->r_equiptment->equiptment }}</td>
                        <td>{{ $e->r_equiptment->serial_number}}</td>
                        <td>{{ number_format($e->r_equiptment->price ,2) }}</td>
                        <td>{{ number_format($e->r_equiptment->price ,2) }}</td>
                    </tr>
                    @php $total += $e->r_equiptment->price @endphp
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
            <p class="lead">Amount Due {{ date('d/m/Y') }}</p>

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
                    <td>{{ $customer->getMembershipID($customer->id) ?? '0' }}%</td>
                    </tr>
                    <tr>
                    <th>Total: </th>
                    <td>RM {{ number_format($total * ((100 - ($customer->getMembershipID($customer->id) ?? '0'))/100), 2)}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="row no-print">
        <div class="col-xs-12">
            <a href="#" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
            <button onClick="submit()" type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
            </button>
            <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
            </button>
        </div>
    </div>
</section>
@endsection

@section('postscript')
<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script>
    submit = () => {
        Swal.fire({
            title: "Submit this reservation for review?",
            text: "Your reservation and payment will be reviewed by the admin.",
            type: "question",
            showCancelButton: true,
            confirmButtonColor: "#47bd9a",
            cancelButtonColor: "#e74c5e",
            confirmButtonText: "Yes, proceed!"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type:"POST",
                    url: "{{ url('vendor/applications/'.$application->id.'/quotation') }}",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    }
                }).done(function(response){
                    if(response == 'success'){
                        Swal.fire("Submitted!", "Your reservation has been locked and submitted!", "success")
                        .then((result) => {
                            if(result.value){
                                window.location.replace("{{ url('vendor/applications') }}");
                            }
                        })
                    }
                });
            }
        })
    }
</script>
@endsection