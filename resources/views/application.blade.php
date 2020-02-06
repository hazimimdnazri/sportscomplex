@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/timepicker/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
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
                                <td>{{ $a->a_applicant->name }}</td>
                                <td class="text-center">{{ $a->date }}</td>
                                <td class="text-center">
                                    @if($a->status == 1)
                                        <span class="label label-default">{{ $a->a_status->status }}</span>
                                    @elseif($a->status == 2)
                                        <span class="label label-info">{{ $a->a_status->status }}</span>
                                    @elseif($a->status == 3)
                                        <span class="label label-success">{{ $a->a_status->status }}</span>
                                    @elseif($a->status == 4)
                                        <span class="label label-danger">{{ $a->a_status->status }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($a->status == 2)
                                    <!-- <a href="{{ url('/application/payment/'.$a->id) }}" class="btn btn-warning">Pay</a> -->
                                    @endif
                                    <a class="btn btn-primary">View</a>
                                    @if($a->status != 3)
                                    <a href="{{ url('application/'.$a->id) }}" class="btn btn-info">Edit</a>
                                    @endif
                                    <a class="btn btn-danger">Delete</a>
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
<script>
    $(() => {
        $('#example1').DataTable()
    })

    assetModal = () => {
        $.ajax({
            type:"POST",
            url: "{{ url('ajax/assetmodal') }}",
            data: {
                "_token": "{{ csrf_token() }}",
            }
        }).done(function(response){
            $("#variable_1").html(response)
            $('#assetModal').modal('show');
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
                $("#type").val(response.data.type).change();
                $("#post_id").val(response.data.id);
            } else {
                alert("Pengguna tidak wujud!")
            }
        });
    }

    waktu = (value) => {
        if(value){
            $.ajax({
                type:"POST",
                url: "{{ url('api/asset') }}"+"/"+value
            }).done(function(response){
                $("#variable_2").html(response)
            });
        } else {
            $('#duration').find('option').remove().end().append("<option value=''>-- Duration --</option>")
        }
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
        if(value == 3){
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
</script>
@endsection