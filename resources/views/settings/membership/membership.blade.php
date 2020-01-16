@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
{{-- <section class="content-header">
    <h1>
        Membership
        <small>Settings</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Settings</li>
        <li class="active">Membership</li>
    </ol>
</section> --}}

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">Memberships</h2>
                    <div class="box-tools">
                        <a href="{{ URL::to('settings/membership/add') }}" class="btn btn-primary" {{-- data-toggle="modal" data-target="#modal-default" --}}>New Membership</a>
                    </div>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No. </th>
                                <th class="text-center">Membership</th>
                                <th class="text-center">Discount (%)</th>
                                <th class="text-center">Montly Fee (RM)</th>
                                <th class="text-center">Anually Fee (RM)</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" width="20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $n = 1 @endphp
                        @foreach($memberships as $m)
                            <tr>
                                <td class="text-center">{{ $n++ }}</td>
                                <td class="text-center">{{ $m->membership }}</td>
                                <td class="text-center">{{ $m->discount }}</td>
                                <td class="text-right">{{ number_format($m->monthly, 2) }}</td>
                                <td class="text-right">{{ number_format($m->anually, 2) }}</td>
                                <td class="text-center">{{ $m->status == 1 ? 'Active' : 'Inactive' }}</td>
                                <td class="text-center">
                                    <a class="btn btn-info" href="{{ URL::to('settings/membership/edit') }}/{{ $m->id }}">Edit</a>
                                    <a class="btn btn-danger confirm" value="{{ URL::to('settings/membership/deactivate') }}/{{ $m->id }}">Deactivate</a>
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
<script>
    $(() => {
        $('#example1').DataTable()
    })
</script>
@endsection