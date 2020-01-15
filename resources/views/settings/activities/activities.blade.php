@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
{{-- <section class="content-header">
    <h1>
        Activities
        <small>Settings</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Settings</li>
        <li class="active">Activities</li>
    </ol>
</section> --}}

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Activities</h2>
                    <div class="box-tools">
                        <a href="{{ URL::to('settings/activities/add') }}" class="btn btn-primary" {{-- data-toggle="modal" data-target="#modal-default" --}}>New Activity</a>
                    </div>
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
                                <th class="text-center">Created By</th>
                                <th class="text-center">Created Date</th>
                                <th class="text-center">Remark</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" width="20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $n = 1 @endphp
                        @foreach($activities as $a)
                            <tr>
                                <td class="text-center">{{ $n++ }}</td>
                                <td class="text-center">{{ $a->activity }}</td>
                                <td class="text-right">{{ number_format($a->public, 2) }}</td>
                                <td class="text-right">{{ number_format($a->students, 2) }}</td>
                                <td class="text-right">{{ number_format($a->underage, 2) }}</td>
                                <td class="text-right">{{ number_format($a->deposit, 2) }}</td>
                                <td class="text-center">{{ $a->user->name ?? '-' }}</td>
                                <td class="text-center">{{ date('d/m/Y',strtotime($a->created_at)) }}</td>
                                <td class="text-center">{{ $a->remark }}</td>
                                <td class="text-center">{{ $a->status == 1 ? 'Active' : 'Inactive'}}</td>
                                <td class="text-center">
                                    <a class="btn btn-info" href="{{ URL::to('settings/activities/edit') }}/{{ $a->id }}">Edit</a>
                                    @if($a->status == 1)
                                        <a class="btn btn-danger confirm" value="{{ URL::to('settings/activities/deactivate') }}/{{ $a->id }}">Deactivate</a>
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