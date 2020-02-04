@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<section class="content-header">
    <h1>
        Activities
        <small>Settings</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Settings</li>
        <li class="active">Activities</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <button type="button" class="btn btn-primary" id="grade" onClick="showModal()">New Activity</button>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No. </th>
                                <th class="text-center">Activity</th>
                                <th class="text-center">Public Price (RM)</th>
                                <th class="text-center">Students Price (RM)</th>
                                <th class="text-center">Under 12 Price (RM)</th>
                                <th class="text-center">Deposit (RM)</th>
                                <th class="text-center">Remark</th>
                                <th class="text-center" width="20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $n = 1 @endphp
                        @foreach($activities as $a)
                            <tr>
                                <td class="text-center">{{ $n++ }}</td>
                                <td class="text-center">{{ $a->activity }}</td>
                                <td class="text-center">{{ number_format($a->public, 2) }}</td>
                                <td class="text-center">{{ number_format($a->students, 2) }}</td>
                                <td class="text-center">{{ number_format($a->underage, 2) }}</td>
                                <td class="text-center">{{ number_format($a->deposit, 2) }}</td>
                                <td class="text-center">{{ $a->remark }}</td>
                                <td class="text-center">
                                    <a onClick="editModal({{ $a->id }})" class="btn btn-info">Edit</a>
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

<div id="variable"></div>
@endsection

@section('postscript')
<script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script>
    $(() => {
        $('#example1').DataTable()
    })

    showModal = () => {
        $.ajax({
            type:"POST",
            url: "{{ url('settings/ajax/activities-modal') }}",
            data: {
                "_token" : "{{ csrf_token() }}",
            }
        }).done(function(response){
            $("#variable").html(response)
            $('#activitiesModal').modal('show')
        });
    }

    editModal = (id) => {
        $.ajax({
            type:"POST",
            url: "{{ url('settings/ajax/activities-modal') }}",
            data: {
                "_token" : "{{ csrf_token() }}",
                "id" : id
            }
        }).done(function(response){
            $("#variable").html(response)
            $('#activitiesModal').modal('show')
        });
    }
</script>
@endsection