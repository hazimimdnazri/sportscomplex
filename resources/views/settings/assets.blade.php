@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<section class="content-header">
    <h1>
        Assets
        <small>Settings</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Settings</li>
        <li class="active">Assets</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">New Asset</button>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No. </th>
                                <th class="text-center">Asset</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Price (RM)</th>
                                <th class="text-center">Min. Hour</th>
                                <th class="text-center">Remarks</th>
                                <th class="text-center" width="20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $n = 1 @endphp
                        @foreach($assets as $a)
                            <tr>
                                <td class="text-center">{{ $n++ }}</td>
                                <td class="text-center">{{ $a->asset }}</td>
                                <td class="text-center">{{ $a->a_type->type }}</td>
                                <td class="text-center">{{ number_format($a->price, 2) }}</td>
                                <td class="text-center">{{ $a->min_hour }}</td>
                                <td class="text-ceter">{{ $a->remark }}</td>
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
            <form action="{{ url('settings/assets') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Assets</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Asset Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="asset" placeholder="Enter asset name">
                    </div>
                    <div class="form-group">
                        <label>Category <span class="text-red">*</span></label>
                        <select name="category" class="form-control" style="width: 100%;">
                            <option value="">-- Asset Category --</option>
                            @foreach($types as $t)
                                <option value="{{ $t->id }}">{{ $t->type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Price (RM) <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="price" placeholder="Enter asset name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Minimum Hour <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="min_hour" placeholder="Enter asset name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Remarks </label>
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