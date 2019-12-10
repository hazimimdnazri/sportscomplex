@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<section class="content-header">
    <h1>
        Members
        <small>Settings</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Settings</li>
        <li class="active">Members</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="{{ url('registration') }}"><button type="button" class="btn btn-primary">New Members</button></a>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">ID</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">I.C. Number</th>
                                <th class="text-center">E-Mail</th>
                                <th class="text-center">Membership</th>
                                <th class="text-center" width="20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($members as $m)
                            <tr>
                                <td>{{ $m->id }}</td>
                                <td>{{ $m->name }}</td>
                                <td>{{ $m->ic }}</td>
                                <td>{{ $m->email }}</td>
                                <td class="text-center">
                                    @if($m->membership == 1)
                                        <span class="label bg-yellow">{{ $m->m_membership->membership }}</span>
                                    @elseif($m->membership == 2)
                                        <span class="label bg-red">{{ $m->m_membership->membership }}</span>
                                    @elseif($m->membership == 3)
                                        <span class="label bg-black">{{ $m->m_membership->membership }}</span>
                                    @endif
                                    
                                </td>
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
@endsection

@section('postscript')
<script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
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
    })
</script>
@endsection