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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">New Activity</button>
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
                                    <a class="btn btn-primary">View</a>
                                    <a class="btn btn-info">Edit</a>
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

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('settings/activities') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Activity</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Activity <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="activity" placeholder="Enter asset name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Public Price (RM) <span class="text-red">*</span></label>
                        <input type="integer" class="form-control" name="public" placeholder="Enter asset name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Students Price (RM) <span class="text-red">*</span></label>
                        <input type="integer" class="form-control" name="students" placeholder="Enter asset name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Under 12 Price (RM) <span class="text-red">*</span></label>
                        <input type="integer" class="form-control" name="underage" placeholder="Enter asset name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Deposit (RM) <span class="text-red">*</span></label>
                        <input type="integer" class="form-control" name="deposit" placeholder="Enter asset name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Remark <span class="text-red">*</span></label>
                        <textarea type="text" class="form-control" name="remark" placeholder="Enter asset name"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Save"/>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('postscript')
<script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script>
    $(() => {
        $('#example1').DataTable()
    })
</script>
@endsection