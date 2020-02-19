@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
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
                    <a href="{{ url('registration') }}" class="btn btn-primary" >New User</a>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No. </th>
                                <th class="text-center">Name</th>
                                <th class="text-center">IC / Passport</th>
                                <th class="text-center">E-Mail</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Membership</th>
                                <th class="text-center">Expiry</th>
                                <th class="text-center" width="20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $n = 1 @endphp
                            @foreach($customers as $c)
                            <tr>
                                <td class="text-center">{{ $n++ }}</td>
                                <td class="text-center">{{ $c->name }}</td>
                                <td class="text-center">{{ $c->r_details->ic ?? $c->r_details->passport}}</td>
                                <td class="text-center">{{ $c->email }}</td>
                                <td class="text-center">
                                    <span class="label bg-red">{{ $c->u_status->status }}</span>
                                </td>
                                <td class="text-center">{!! $c->getMembership($c->id) !!}</td>
                                <td class="text-center">{!! $c->getMembershipDuration($c->id) !!}</td>
                                <td class="text-center">
                                    <a href="{{ url('customer/'.$c->id.'/edit') }}" class="btn btn-info">Edit</a>
                                    <a onClick="deleteCustomer({{$c->id}})" class="btn btn-danger">Delete</a>
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
<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script>
    $(() => {
        $('#example1').DataTable()
    })

    deleteCustomer = (id) => {
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
                    url: "{{ url('ajax/deletecustomer') }}",
                    data: {
                        "_token" : "{{ csrf_token() }}",
                        "id" : id
                    }
                }).done(function(response){
                    if(response == 'success'){
                        Swal.fire("Deleted!", "Your file has been deleted.", "success")
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