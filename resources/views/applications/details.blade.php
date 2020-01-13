@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/timepicker/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.5.3/dist/sweetalert2.min.css">
@endsection

@section('content')
<section class="content-header">
    <h1>
        Reservation Details
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Reservation</li>
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
                        <div id="errors" style="display:none" class="alert alert-danger alert-dismissable"></div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Membership / Customer ID </label>
                                <input id="member_id" type="text" class="form-control" value="{{ $application->a_applicant->id }}" placeholder="Member ID (if available)" disabled>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Reservation Item <span class="text-red">*</span></label>
                                <select onChange="itemType(this.value)" name="type" class="form-control">
                                    <option value="" selected>-- Item --</option>
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
                                <input type="text" class="form-control" name="event" value="{{ $application->event }}" id="event" placeholder="Event name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">I.C Number </label>
                                <input type="text" class="form-control" id="ic" name="ic" value="{{ $application->a_applicant->ic }}" placeholder="Applicant MyKad / MyKid" disabled>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name </label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $application->a_applicant->name }}" placeholder="Applicant name" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone </label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $application->a_applicant->phone }}" placeholder="Applicant phone number" disabled>
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
        <div id="variable_1"></div>
    </div>
</section>

<div id="variable_2"></div>
@endsection

@section('postscript')
<script src="{{ asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.5.3/dist/sweetalert2.all.min.js"></script>
<script>
    $(() => {
        $('#datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            startDate: new Date()
        })
    })

    itemType = (value) => {
        $.ajax({
            type:"POST",
            url: "{{ url('ajax/itemtype') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "id" : "{{ $application->id }}",
                "type": value
            }
        }).done(function(response){
            $("#variable_1").html(response)
        });
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
                }
            });
        }
    }

    deleteAsset = (id) => {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
        })
    }
</script>
@endsection