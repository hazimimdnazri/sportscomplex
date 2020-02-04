@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<section class="content-header">
    <h1>
        Facility Categories
        <small>Settings</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Settings</li>
        <li class="active">Facility Categories</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <button type="button" class="btn btn-primary" id="grade" onClick="showModal()">New Facility</button>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No. </th>
                                <th class="text-center">Facility Category</th>
                                <th class="text-center">Remarks</th>
                                <th class="text-center" width="20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $n = 1 @endphp
                        @foreach($assets as $a)
                            <tr>
                                <td>{{ $n++ }}</td>
                                <td>{{ $a->type }}</td>
                                <td>{{ $a->remark }}</td>
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
            url: "{{ url('settings/ajax/categories-modal') }}",
            data: {
                "_token" : "{{ csrf_token() }}",
            }
        }).done(function(response){
            $("#variable").html(response)
            $('#categoriesModal').modal('show')
        });
    }

    editModal = (id) => {
        $.ajax({
            type:"POST",
            url: "{{ url('settings/ajax/categories-modal') }}",
            data: {
                "_token" : "{{ csrf_token() }}",
                "id" : id
            }
        }).done(function(response){
            $("#variable").html(response)
            $('#categoriesModal').modal('show')
        });
    }
</script>
@endsection