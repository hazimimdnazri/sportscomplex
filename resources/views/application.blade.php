@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Application
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Application</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">New Application</button>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">No. </th>
                                <th class="text-center">Applicant</th>
                                <th class="text-center">Asset</th>
                                <th class="text-center">Duration</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" width="20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $n = 1 @endphp
                            @foreach($applications as $a)
                            <tr>
                                <td class="text-center">{{ $n++ }}</td>
                                <td>{{ $a->name }}</td>
                                <td class="text-center">{{ $a->a_asset->asset }}</td>
                                <td class="text-center">
                                    {{ date('d/m/Y',strtotime($a->start_date)) }} - {{ date('d/m/Y',strtotime($a->end_date)) }}
                                </td>
                                <td class="text-center">
                                    @if($a->status == 2)
                                        <span class="label label-info">{{ $a->a_status->status }}</span>
                                    @elseif($a->status == 3)
                                        <span class="label label-success">{{ $a->a_status->status }}</span>
                                    @elseif($a->status == 4)
                                        <span class="label label-danger">{{ $a->a_status->status }}</span>
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

<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('application') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Application</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Event <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="event" placeholder="Enter applicant name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="name" placeholder="Enter applicant name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">I.C Number <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="ic" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Address <span class="text-red">*</span></label>
                                <textarea class="form-control" name="address" rows="2" placeholder="Enter your remarks here..."></textarea>
                            </div>
                            <div class="form-group">
                                <label>Asset <span class="text-red">*</span></label>
                                <select name="asset" class="form-control select2" style="width: 100%;">
                                    <option value="">-- Select Asset --</option>
                                    @foreach($assets as $a)
                                        <option value="{{ $a->id }}">{{ $a->asset }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Attachment</label>
                                <input type="file" name="attachment" id="exampleInputFile">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Application Date <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="datenow" value="{{ date('d/m/Y') }}" readOnly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">E-Mail <span class="text-red">*</span></label>
                                <input type="email" class="form-control" name="email" placeholder="Enter applicant email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Zipcode <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="zipcode" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">City <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="city" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Date range <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="reservation">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea class="form-control" name="remark" rows="3" placeholder="Enter your remarks here..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="start_date" id="start_date">
                <input type="hidden" name="end_date" id="end_date">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Submit"/>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('postscript')
<script src="{{ asset('assets/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
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

        $('.select2').select2()

        //Date range picker
        $('#reservation').daterangepicker({
            locale: {
                "format": "DD/MM/YYYY",
            }
        },
        (start, end) => {
            $("#start_date").val(start.format('YYYY-MM-DD'))
            $("#end_date").val(end.format('YYYY-MM-DD'))
        });

        $('#reservation').val('');
    })
</script>
@endsection