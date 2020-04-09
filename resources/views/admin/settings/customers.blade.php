@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
<section class="content-header">
    <h1>
        Customers
        <small>Settings</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Settings</li>
        <li class="active">Customers</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="{{ url('admin/registration') }}"><button type="button" class="btn btn-primary">New Members</button></a>
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
                        @foreach($customers as $c)
                            <tr>
                                <td class="text-center">{{ $c->id }}</td>
                                <td class="text-center">{{ $c->name }}</td>
                                <td class="text-center">{{ $c->ic }}</td>
                                <td class="text-center">{{ $c->email }}</td>
                                <td class="text-center">
                                    @if($c->membership == 1)
                                        <span class="label bg-yellow">{{ $c->c_membership->membership }}</span>
                                    @elseif($c->membership == 2)
                                        <span class="label bg-red">{{ $c->c_membership->membership }}</span>
                                    @elseif($c->membership == 3)
                                        <span class="label label-info">{{ $c->c_membership->membership }}</span>
                                    @else
                                        <span class="label bg-black">Non Member</span>
                                    @endif
                                    
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-primary">View</a>
                                    <a onClick="edit({{ $c->id }})" class="btn btn-info">Edit</a>
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
<script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
    $(() => {
        $('#example1').DataTable()
    })

    edit = (id) => {
        $.ajax({
            type:"POST",
            url: "{{ url('admin/ajax/editcustomer') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id
            }
        }).done(function(response){
            $("#variable_1").html(response)
            $('#user-modal').modal('show');
        });
    }
</script>
@endsection