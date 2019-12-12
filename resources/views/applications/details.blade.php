@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/timepicker/bootstrap-timepicker.min.css') }}">
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
                                    <input type="text" name="date" class="form-control pull-right" id="datepicker" placeholder="Reservation date">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Event <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="event" placeholder="Event name">
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
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <button onClick="detailsModal()" type="button" class="btn btn-info">Add Item</button>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">No. </th>
                                <th class="text-center">Item</th>
                                <th class="text-center">Duration (Hour)</th>
                                <th class="text-center">Price / Hour (RM)</th>
                                <th class="text-center">Total Price (RM)</th>
                                <th class="text-center" width="20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $n = 1 @endphp
                            @foreach($reservations as $r)
                            <tr>
                                <td class="text-center">{{ $n++ }}</td>
                                <td class="text-center">{{ $r->r_asset->asset }}</td>
                                <td class="text-center">{{ $r->duration }}</td>
                                <td class="text-center">{{ number_format($r->r_asset->price, 2) }}</td>
                                <td class="text-center">{{ number_format($r->r_asset->price * $r->duration, 2) }}  </td>
                                <td class="text-center"></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <div class="text-center">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary" value="Submit"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="variable_1"></div>
@endsection

@section('postscript')
<script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script>
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
        })

        $('#datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        })
    })

    detailsModal = () => {
        $.ajax({
            type:"POST",
            url: "{{ url('ajax/detailsmodal') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "id" : "{{ $application->id }}"
            }
        }).done(function(response){
            $("#variable_1").html(response)
            $('#detailsModal').modal('show');
        });
    }
</script>
@endsection