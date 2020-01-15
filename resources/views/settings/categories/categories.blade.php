@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
{{-- <section class="content-header">
    <h1>
        Asset Categories
        <small>Settings</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Settings</li>
        <li class="active">Asset Categories</li>
    </ol>
</section> --}}

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Asset Categories</h2>
                    <div class="box-tools">
                        <a href="{{ URL::to('settings/categories/add') }}" type="button" class="btn btn-primary" {{-- data-toggle="modal" data-target="#modal-default" --}}>New Asset Category</a>
                    </div>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No. </th>
                                <th class="text-center">Asset Category</th>
                                {{-- <th class="text-center">Remarks</th> --}}
                                <th class="text-center">Status</th>
                                <th class="text-center" width="20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $n = 1 @endphp
                        @foreach($categories as $a)
                            <tr>
                                <td class="text-center">{{ $n++ }}</td>
                                <td>{{ $a->type }}</td>
                                {{-- <td>{{ $a->remark ?? '-'}}</td> --}}
                                <td class="text-center">{{ $a->status == 1 ? 'Active' : 'Inactive' }}</td>
                                <td class="text-center">
                                    <a class="btn btn-info" href="{{ URL::to('settings/categories/edit') }}/{{ $a->id }}">Edit</a>
                                    <a class="btn btn-danger confirm" value="{{ URL::to('settings/categories/deactivate') }}/{{ $a->id }}">Deactivate</a>
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