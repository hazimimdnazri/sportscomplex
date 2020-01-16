@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
{{-- <section class="content-header">
    <h1>
        Users
        <small>Settings</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Settings</li>
        <li class="active">Users</li>
    </ol>
</section> --}}

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Staffs</h2>
                    <div class="box-tools">
                        <a href="{{ URL::to('settings/users/add') }}" class="btn btn-primary" {{-- data-toggle="modal" data-target="#user-modal" --}}>New Staff</a>
                    </div>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No. </th>
                                <th class="text-center">Name</th>
                                <th class="text-center">E-Mail</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" width="20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $n = 1 @endphp
                            @foreach($users as $u)
                            <tr>
                                <td class="text-center">{{ $n++ }}</td>
                                <td>{{ $u->name }}</td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->role == 1 ? 'Staff' : 'Admin' }}</td>
                                <td class="text-center">
                                    <span class="label bg-yellow">{{ $u->status == 1 ? 'Active' : 'Inactive'}}</span>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-info" href="{{ URL::to('settings/users/edit') }}/{{ $u->id }}">Edit</a>
                                    @if($u->status == 1)
                                    <a class="btn btn-danger confirm" value="{{ URL::to('settings/users/deactivate') }}/{{ $u->id }}">Deactivate</a>
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