@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/timepicker/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
<link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ asset('assets/bower_components/fullcalendar/dist/fullcalendar.min.css') }}">
@endsection

@section('content')
<section class="content-header">
    <h1>
        Reservation Details
        <small>Applications</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Applications</li>
        <li class="active">{{$application->id}}</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Application #{{ $application->id }} Details</h3>
                    <p>Please make sure all the information are correct.</p>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Membership / Customer ID </label>
                                <input id="member_id" type="text" class="form-control" value="{{ $application->a_applicant->id }}" placeholder="Member ID (if available)" disabled>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Reservation Item <span class="text-red">*</span></label>
                                <select onChange="itemType(this.value)" name="type" id="type" class="form-control">
                                    <option value="" selected>-- Reservation Type --</option>
                                    <option value="1" >Facility</option>
                                    <option value="2" >Activity</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Date <span class="text-red">*</span></label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="date" value="{{ date('d-m-Y', strtotime($application->date)) }}" class="form-control pull-right" onChange="setDate(this.value)" id="datepicker" placeholder="Reservation date">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Event <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="event" id="event" value="{{ $application->event ?? 'Booking #'.$application->id }}" id="event" placeholder="Event name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Company Registration No. </label>
                                <input type="text" class="form-control" id="ic" name="ic" value="{{ $application->a_applicant->r_vendor->company_registration }}" placeholder="Applicant MyKad / MyKid" disabled>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name </label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $application->a_applicant->name }}" placeholder="Applicant name" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone </label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $application->a_applicant->r_vendor->phone_mobile }}" placeholder="Applicant phone number" disabled>
                            </div>

                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">E-Mail </label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $application->a_applicant->email }}" placeholder="Applicant email" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h4 class="box-title">Equiptments</h4>  
                    <button type="button" onClick="addEquiptment()" class="btn btn-success pull-right" >Rent Equiptments</button>
                </div>
                <div class="box-body">
                    <table id="equiptments" class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">No. </th>
                                <th class="text-center">Equiptment</th>
                                <!-- <th class="text-center">Price (RM)</th> -->
                                <th class="text-center" width="20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                            $n = 1;
                            $etotal = 0;
                            @endphp
                            @foreach($equiptments as $e)
                            <tr>
                                <td class="text-center">{{ $n++ }}</td>
                                <td class="text-center">{{ $e->r_equiptment->equiptment }}</td>
                                <!-- <td class="text-center">{{ number_format($e->r_equiptment->price, 2) }}</td> -->
                                <td class="text-center">
                                    <button onClick="deleteEquiptment({{ $e->id }})" class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            @php $etotal += number_format($e->r_equiptment->price, 2) @endphp
                            @endforeach
                        </tbody>
                        <input type="hidden" id="etotal" value="{{ $etotal }}">
                    </table>
                </div>
            </div>
        </div>
        <div id="variable_1"></div>
    </div>
</section>

<div id="variable_3"></div>
@endsection

@section('postscript')
<script src="{{ asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.1/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar-scheduler/1.9.1/scheduler.min.js"></script>
<script>
    $(() => {
        $('#equiptments').DataTable()

        $('#datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            startDate: new Date()
        })
        @if($application->type)
        $("#type").val({{$application->type}}).change();
        @endif
    })

    itemType = (value) => {
        $.ajax({
            type:"POST",
            url: "{{ url('vendor/ajax/itemtype') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "id" : "{{ $application->id }}",
                "type": value,
                "user" : {{$application->a_applicant->id}}
            }
        }).done(function(response){
            $("#variable_1").html(response)
        });
    }

    toQuotation = () => {
        Swal.fire({
            title: "Submit the reservation for admin approval?",
            text: "You still can alter the reservation later.",
            type: "question",
            showCancelButton: true,
            confirmButtonColor: "#47bd9a",
            cancelButtonColor: "#e74c5e",
            confirmButtonText: "Yes, proceed!"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type:"POST",
                    url: "{{ url('vendor/ajax/submitreservation') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id" : "{{ $application->id }}"
                    }
                }).done(function(response){
                    if(response == 'success'){
                        Swal.fire(
                            'Success!',
                            'Reservation submitted for review!',
                            'success'
                        ).then((result) => {
                            if(result.value){
                                window.location.replace("{{ url('vendor/applications') }}");
                            }
                        })
                    } 
                });
            }
        })
    }

    setDate = (value) => {
        var confirmDate = confirm('Reserve this date? ('+value+')')
        if(confirmDate){
            $.ajax({
                type:"POST",
                url: "{{ url('ajax/setdate') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id" : "{{ $application->id }}",
                    "date": value
                }
            }).done(function(response){
                if(response == 'success'){
                    alert('Date set!')
                    location.reload()
                }
            });
        }
    }

    addEquiptment = (id) => {
        $.ajax({
            type:"POST",
            url: "{{ url('ajax/application/equiptment/add') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "id" : "{{ $application->id }}",
            }
        }).done(function(response){
            $("#variable_3").html(response)
            $('#equiptmentModal').modal('show');
        });
    }

    deleteEquiptment = (id) => {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#47bd9a",
            cancelButtonColor: "#e74c5e",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type:"POST",
                    url: "{{ url('ajax/application/equiptment/delete') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id" : id,
                    }
                }).done(function(response){
                    if(response == 'success'){
                        Swal.fire("Deleted!", "The equiptment has been deleted.", "success")
                        .then((result) => {
                            if(result.value){
                                location.reload();
                            }
                        })
                    }
                });
            }
        })
    }

    deleteItem = (id, type) => {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#47bd9a",
            cancelButtonColor: "#e74c5e",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type:"POST", 
                    url: "{{ url('vendor/ajax/delete-item') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id" : id,
                        "type" : type
                    }
                }).done(function(response){
                    if(response == 'success'){
                        Swal.fire("Deleted!", "The item has been deleted.", "success")
                        .then((result) => {
                            if(result.value){
                                location.reload();
                            }
                        })
                    }
                });
            }
        })
    }
</script>
@endsection