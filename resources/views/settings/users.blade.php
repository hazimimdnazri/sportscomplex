@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<section class="content-header">
    <h1>
        Users
        <small>Settings</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Settings</li>
        <li class="active">Users</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <button type="button" class="btn btn-primary" onClick="showModal()">New User</button>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No. </th>
                                <th class="text-center">Name</th>
                                <th class="text-center">E-Mail</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Verification Status</th>
                                <th class="text-center">User Status</th>
                                <th class="text-center" width="20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $n = 1 @endphp
                            @foreach($users as $u)
                            <tr>
                                <td>{{ $n++ }}</td>
                                <td>{{ $u->name }}</td>
                                <td>{{ $u->email }}</td>
                                <td class="text-center">
                                    <select class="form-control" name="role" id="role" onChange="changeRole(this.value, {{$u->id}})">
                                    @foreach($roles as $r)
                                        <option value="{{ $r->id }}" {{$u->role == $r->id ? 'selected' : ''}}>{{ $r->role }}</option>
                                    @endforeach
                                    </select>
                                </td>
                                <td class="text-center">
                                    <span class="label bg-yellow">{{ $u->u_status->status }}</span>
                                </td>
                                <td class="text-center">
                                    @if($u->flag == 1)
                                        <span class="label bg-green">Active</span>
                                    @else
                                        <span class="label bg-red">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a onClick="editModal({{ $u->id }})" class="btn btn-info">Edit</a>
                                    @if($u->flag == 1)
                                    <a onClick="deleteFx({{ $u->id }})" class="btn btn-danger">Deactivate</a>
                                    @else 
                                    <a onClick="deleteFx({{ $u->id }})" class="btn btn-success">Reactivate</a>
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

<div id="variable"></div>
@endsection

@section('postscript')
<script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script>
    $(() => {
        $('#example1').DataTable()
    })

    showModal = () => {
        $.ajax({
            type:"POST",
            url: "{{ url('settings/ajax/users-modal') }}",
            data: {
                "_token" : "{{ csrf_token() }}",
            }
        }).done(function(response){
            $("#variable").html(response)
            $('#usersModal').modal('show')
        });
    }

    editModal = (id) => {
        $.ajax({
            type:"POST",
            url: "{{ url('settings/ajax/users-modal') }}",
            data: {
                "_token" : "{{ csrf_token() }}",
                "id" : id
            }
        }).done(function(response){
            $("#variable").html(response)
            $('#usersModal').modal('show')
        });
    }

    changeRole = (role, id) => {
        var change = confirm("Change the role of this user?");
        if(change){
            $.ajax({
            type:"POST",
            url: "{{ url('settings/ajax/changerole') }}",
            data: {
                "_token" : "{{ csrf_token() }}",
                "id" : id,
                "role" : role
            }
            }).done(function(response){
                alert(response);
                location.reload();
            }); 
        }
    }

    deleteFx = (id) => {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#47bd9a",
            cancelButtonColor: "#e74c5e",
            confirmButtonText: "Yes, delete it!"
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    type:"POST",
                    url: "{{ url('settings/ajax/users-modal') }}",
                    data: {
                        "_token" : "{{ csrf_token() }}",
                        "id" : id,
                        "action" : "delete"
                    }
                }).done(function(response){
                    if(response == 'success'){
                        Swal.fire("Done!", "User activation has been changed.", "success")
                        .then((result) => {
                            if(result.value){
                                location.reload();
                            }
                        })
                    }
                });
            }
        });
    }
</script>
@endsection