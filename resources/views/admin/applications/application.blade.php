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
        Point of Sale
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Point of Sale</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <button type="button" class="btn btn-primary" onClick="activityModal()">New Walk In</button>
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
                                    @if($a->status == 7)
                                    <button class="btn bg-orange" onClick="checkOut({{ $a->id }})" data-toggle="tooltip" data-placement="top" title="Check Out"><i class="glyphicon glyphicon-log-out"></i></button>
                                    @endif
                                    @if($a->status == 5)
                                    <button class="btn bg-navy" onClick="checkIn({{ $a->id }})" data-toggle="tooltip" data-placement="top" title="Check In"><i class="glyphicon glyphicon-log-in"></i></button>
                                    @endif
                                    @if($a->a_applicant->role == 4)
                                        @if($a->status == 5 || $a->status == 4 || $a->status == 3)
                                            <button class="btn btn-primary" onClick="viewModal({{ $a->id }})" data-toggle="tooltip" data-placement="top" title="View"><i class="glyphicon glyphicon-search"></i></button>
                                        @else
                                            @if($a->status != 3)
                                                <a class="btn btn-primary" href="{{ url('admin/application/'.$a->id) }}" data-toggle="tooltip" data-placement="top" title="Review Application"><i class="glyphicon glyphicon-zoom-in"></i></a>
                                            @endif
                                        @endif
                                    @else
                                        @if($a->status != 1)
                                        <button class="btn btn-primary" onClick="viewModal({{ $a->id }})" data-toggle="tooltip" data-placement="top" title="View"><i class="glyphicon glyphicon-search"></i></button>
                                        @elseif($a->status != 5)
                                        <a href="{{ url('admin/application/'.$a->id) }}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                                        @endif
                                    @endif
                                    <button onClick="deleteApplication({{$a->id}})" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="glyphicon glyphicon-trash"></i></button>
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
<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script>
    $(() => {
        $('#example1').DataTable()
    })

    viewModal = (id) => {
        $.ajax({
            type:"POST",
            url: "{{ url('admin/application/ajax/view-modal') }}",
            data: {
                "_token" : "{{ csrf_token() }}",
                "id" : id
            }
        }).done(function(response){
            $("#variable_1").html(response)
            $('#viewModal').modal('show');
        });
    }

    member = () => {
        $.ajax({
            type:"GET",
            url: "{{ url('api/customer') }}"+"/"+$("#member_id").val()
        }).done(function(response){
            if(response != "error"){
                $("#name").val(response.data.name);
                $("#name").val(response.data.name);
                $("#email").val(response.data.email);
                $("#ic").val(response.data.ic);
                $("#passport").val(response.data.passport);
                $("#type").val(response.data.type).change();
                $("#nationality").val(response.data.nationality).change();
                $("#post_id").val(response.data.id);
                $("#gender").val(response.data.gender).change();
            } else {
                alert("User does not exist!")
            }
        });
    }

    activityModal = () => {
        $.ajax({
            type:"POST",
            url: "{{ url('ajax/activitymodal') }}",
            data: {
                "_token": "{{ csrf_token() }}",
            }
        }).done(function(response){
            $("#variable_1").html(response)
            $('#activityModal').modal('show');
        });
    }

    userType = (value) => {
        if(value == 3 || value == 5){
            $("#students").show()
            $("#staffs").hide()
        } else if(value == 2){
            $("#students").hide()
            $("#staffs").show()
        } else {
            $("#students").hide()
            $("#staffs").hide()
        }
    }

    searchIC = (id) => {
        if(id == 'existing'){
            $("#searchIC").show()
            $("#name, #ic, #email, #type, #nationality").attr('readOnly','readOnly')
            $("#type, #nationality, #gender, option").each(function(i){
                $(this).attr('disabled', 'disabled')
            });
            $("#type").val('')
            $("#nationality").val('')
            $("#ic_block").hide()
            $("#passport_block").hide()
            $("#students").hide()
            $("#staffs").hide()
            
        } else {
            $("#searchIC").hide()
            $("#name, #ic, #email, #type, #nationality").removeAttr('readOnly','readOnly')
            $("#type, #nationality, option").each(function(i){
                $(this).removeAttr('disabled', 'disabled')
            });
            $("#name").val('')
            $("#ic").val('')
            $("#email").val('')
            $("#type").val('')
            $("#nationality").val('')
            $("#ic_block").hide()
            $("#passport_block").hide()
            $("#students").hide()
            $("#staffs").hide()
        }
    }

    selectNationality = (value) => {
        if(value == 1){
            $("#ic_block").show()
            $("#passport_block").hide()
        } else if(value == 2){
            $("#ic_block").hide()
            $("#passport_block").show()
        }
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

    confirmPayment = (id) => {
        Swal.fire({
            title: "Confirm reservation payment?",
            text: "Make sure that proof of payment has been submitted.",
            type: "question",
            showCancelButton: true,
            confirmButtonColor: "#47bd9a",
            cancelButtonColor: "#e74c5e",
            confirmButtonText: "Yes, payment recieved!"
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    type:"POST",
                    url: "{{ url('admin/application/ajax/confirmpayment') }}",
                    data: {
                        "_token" : "{{ csrf_token() }}",
                        "id" : id
                    }
                }).done(function(response){
                    if(response == 'success'){
                        Swal.fire("Confirmed!", "Reservation has been confirmed, waiting for the arrival.", "success")
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

    approve = (id) => {
        Swal.fire({
            title: "Approve this reservation?",
            text: "This will confirm the reservation.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#47bd9a",
            cancelButtonColor: "#e74c5e",
            confirmButtonText: "Yes, approve!"
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    type:"POST",
                    url: "{{ url('admin/application/approve') }}",
                    data: {
                        "_token" : "{{ csrf_token() }}",
                        "id" : id
                    }
                }).done(function(response){
                    if(response == 'success'){
                        Swal.fire("Approved!", "The reservation has been approved.", "success")
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

    checkIn = (id) => {
        Swal.fire({
            title: "Confirm check in?",
            text: "Check in customer.",
            type: "question",
            showCancelButton: true,
            confirmButtonColor: "#47bd9a",
            cancelButtonColor: "#e74c5e",
            confirmButtonText: "Yes, confirm!"
        }).then((result) => {
            if(result.value) {
                Swal.fire({
                    title: 'Checking In',
                    html: 'Please wait for a moment...',
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    }
                })

                $.ajax({
                    type:"POST",
                    url: "{{ url('admin/ajax/checkin') }}",
                    data: {
                        "_token" : "{{ csrf_token() }}",
                        "id" : id
                    }
                }).done(function(response){
                    if(response == 'success'){
                        Swal.fire("Checked In!", "User may proceed to the venue.", "success")
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

    checkOut = (id) => {
        Swal.fire({
            title: "Confirm check out?",
            text: "Check out customer from the facility.",
            type: "question",
            showCancelButton: true,
            confirmButtonColor: "#47bd9a",
            cancelButtonColor: "#e74c5e",
            confirmButtonText: "Yes, confirm!"
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    type:"POST",
                    url: "{{ url('admin/ajax/checkout') }}",
                    data: {
                        "_token" : "{{ csrf_token() }}",
                        "id" : id
                    }
                }).done(function(response){
                    if(response == 'success'){
                        Swal.fire("Checked Out!", "User may leave the venue.", "success")
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