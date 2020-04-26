@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/timepicker/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
<link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Reservation Application
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Reservation Application</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <button type="button" class="btn btn-primary" onClick="newReservation()">New Reservation</button>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">No. </th>
                                <th class="text-center">Applicant</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Reservation Date</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" width="20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $n = 1 @endphp
                            @foreach($applications as $a)
                            <tr>
                                <td class="text-center">{{ $n++ }}</td>
                                <td class="text-center">{{ $a->a_applicant->name }}</td>
                                <td class="text-center">
                                    @if($a->type == 1)
                                        Facility Reservation
                                    @else
                                        Activity
                                    @endif
                                </td>
                                <td class="text-center">{{ date('d/m/Y', strtotime($a->date)) }}</td>
                                <td class="text-center">
                                    {!! $a->getStatus($a->status) !!}
                                </td>
                                <td class="text-center">
                                    @if($a->status == 4 && !isset($a->r_payment->file))
                                    <button class="btn btn-warning" onClick="paymentModal({{ $a->id }})" data-toggle="tooltip" data-placement="top" title="Upload Payment"><i class="glyphicon glyphicon-upload"></i></button>
                                    @endif
                                    @if($a->status != 1)
                                    <button class="btn btn-primary" onClick="viewAdminApproval({{ $a->id }})" data-toggle="tooltip" data-placement="top" title="View"><i class="glyphicon glyphicon-search"></i></button>
                                    @elseif($a->status != 5)
                                    <a href="{{ url('customer/applications/'.$a->id) }}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                                    @endif
                                    @if($a->status == 1 || $a->status == 2 || $a->status == 3)
                                    <button onClick="deleteApplication({{$a->id}})" class="btn btn-danger" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Delete"><i class="glyphicon glyphicon-trash"></i></button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="variable_1"></div>
@endsection

@section('postscript')
<script src="{{ asset('assets/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.js') }}"></script>
<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script>
    $(() => {
        $('#example1').DataTable()
    })

    viewAdminApproval = (id) => {
        $.ajax({
            type:"POST",
            url: "{{ url('vendor/ajax/modal-adminApproval') }}",
            data: {
                "_token" : "{{ csrf_token() }}",
                "id" : id
            }
        }).done(function(response){
            $("#variable_1").html(response)
            $('#viewModal').modal('show');
        });
    }

    newReservation = () => {
        Swal.fire({
            title: "Apply for new reservation?",
            text: "New application will be created as draft, you can delete it later.",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#47bd9a",
            cancelButtonColor: "#e74c5e",
            confirmButtonText: "Yes, apply!"
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    type:"POST",
                    url: "{{ url('customer/applications/new') }}",
                    data: {
                        "_token" : "{{ csrf_token() }}"
                    }
                }).done(function(response){
                    if(response.status == 'success'){
                        window.location.replace("{{ url('customer/applications') }}/"+response.data);
                    }
                });
            }
        });
    }

    paymentModal = (id) => {
        $.ajax({
            type:"POST",
            url: "{{ url('vendor/ajax/modal-payment') }}",
            data: {
                "_token" : "{{ csrf_token() }}",
                "id" : id
            }
        }).done(function(response){
            $("#variable_1").html(response)
            $('#paymentModal').modal('show');
        });
    }

    deleteApplication = (id) => {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#47bd9a",
            cancelButtonColor: "#e74c5e",
            confirmButtonText: "Yes, delete it!"
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    type:"POST",
                    url: "{{ url('admin/application/ajax/view-modal') }}",
                    data: {
                        "_token" : "{{ csrf_token() }}",
                        "id" : id,
                        "action" : "delete"
                    }
                }).done(function(response){
                    if(response == 'success'){
                        Swal.fire("Deleted!", "Application has been deleted.", "success")
                        .then((result) => {
                            if(result.value){
                                location.reload();
                            }
                        })
                    }
                });
            }
        });
    }
</script>
@endsection