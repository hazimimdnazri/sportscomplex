@extends('layouts.main')

@section('content')
{{-- <section class="content-header">
    <h1>
        Customers
        <small>Settings</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Settings</li>
        <li class="active">Customers</li>
    </ol>
</section> --}}

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Members</h2>
                    <div class="box-tools">
                        <a href="{{ url('settings/customers/add') }}"><button type="button" class="btn btn-primary">New Member</button></a>
                    </div>
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
                                    <a href="{{ URL::to('settings/customers/edit') }}/{{ $c->id }}" class="btn btn-info">Edit</a>
                                    {{-- @if($c->status == 1)
                                        <a class="btn btn-danger confirm" value="{{ URL::to('settings/customers/deactivate') }}/{{ $c->id }}">Deactivate</a>
                                    @endif --}}
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
<script>
    $(() => {
        $('#example1').DataTable()
    })

    edit = (id) => {
        $.ajax({
            type:"POST",
            url: "{{ url('ajax/editcustomer') }}",
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