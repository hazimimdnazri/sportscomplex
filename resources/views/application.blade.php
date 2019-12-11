@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/timepicker/bootstrap-timepicker.min.css') }}">
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Asset Reservation</button>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default-2">Activity Reservation</button>
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
                                <td>{{ $a->a_applicant->name }}</td>
                                <td class="text-center">{{ $a->a_asset->asset }}</td>
                                <td class="text-center">
                                    {{ date('g:i:s A (d/m/Y)',strtotime($a->start_date)) }} - {{ date('g:i:s A (d/m/Y)',strtotime($a->end_date)) }}
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
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Membership ID </label>
                                <div class="input-group">
                                    <input id="member_id" type="text" class="form-control" placeholder="Enter applicant name">
                                    <span class="input-group-btn">
                                        <button onClick="member()" class="btn btn-info" type="button">Find</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Event <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="event" placeholder="Enter applicant name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name <span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter applicant name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">I.C Number <span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="ic" name="ic" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Address <span class="text-red">*</span></label>
                                <textarea class="form-control" id="address" name="address" rows="2" placeholder="Enter your remarks here..."></textarea>
                            </div>
                            <div class="form-group">
                                <label>Asset <span class="text-red">*</span></label>
                                <select onChange="waktu(this.value)" name="asset" class="form-control select2" style="width: 100%;">
                                    <option value="">-- Select Asset --</option>
                                    @foreach($assets as $a)
                                        <option value="{{ $a->id }}">{{ $a->asset }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="variable_1">
                                <div class="form-group">
                                    <label>Duration (Hour) <span class="text-red">*</span></label>
                                    <select name="duration" class="form-control" id="duration">
                                        <option value="" selected>-- Duration --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">E-Mail <span class="text-red">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter applicant email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone <span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter applicant email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Zipcode <span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">City <span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>State <span class="text-red">*</span></label>
                                <select name="state" class="select2 form-control" id="state" style="width: 100%;">
                                    <option value="" selected>-- State --</option>
                                    <option value="1" >Johor</option>
                                    <option value="2" >Kedah</option>
                                    <option value="3" >Kelantan</option>
                                    <option value="4" >Melaka</option>
                                    <option value="5" >Negeri Sembilan</option>
                                    <option value="6" >Pahang</option>
                                    <option value="7" >Perak</option>
                                    <option value="8" >Perlis</option>
                                    <option value="9" >Pulau Pinang</option>
                                    <option value="10" >Sabah</option>
                                    <option value="11" >Sarawak</option>
                                    <option value="12" >Selangor</option>
                                    <option value="13" >Terengganu</option>
                                    <option value="14" >W.P. Kuala Lumpur</option>
                                    <option value="15" >W.P. Labuan</option>
                                    <option value="16" >W.P. Putrajaya</option>
                                </select>
                            </div>
                            <!-- <div class="form-group">
                                <label>Date range <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="reservation">
                                </div>
                            </div> -->
                            <div class="form-group">
                                <label>Date <span class="text-red">*</span></label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="date" class="form-control pull-right" id="datepicker">
                                </div>
                            </div>
                            <div class="bootstrap-timepicker">
                                <div class="form-group">
                                    <label>Time <span class="text-red">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                        <input name="time" type="text" class="form-control timepicker">
                                    </div>
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
                <input type="hidden" name="post_id" id="post_id">
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
<script src="{{ asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
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

        $('#datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        })

        $('.timepicker').timepicker({
            showInputs: false,
            defaultTime: 'current',
            minuteStep: 15
        })
        
        $('.timepicker').timepicker('setTime', new Date(new Date().getTime()+6*3600*1000));

        $('#reservation').val('');
    })

    member = () => {
        $.ajax({
            type:"GET",
            url: "{{ url('api/customer') }}"+"/"+$("#member_id").val()
        }).done(function(response){
            if(response.data != ""){
                $("#name").val(response.data.name);
                $("#email").val(response.data.email);
                $("#ic").val(response.data.ic);
                $("#city").val(response.data.city);
                $("#zipcode").val(response.data.zipcode);
                $("#address").val(response.data.address);
                $("#phone").val(response.data.phone);
                $("#state").val(response.data.state).change();
                $("#post_id").val(response.data.id);
                post_id
            } else {
                alert("Pengguna tidak wujud!")
            }
        });
    }

    waktu = (value) => {
        if(value){
            $.ajax({
                type:"POST",
                url: "{{ url('api/asset') }}"+"/"+value
            }).done(function(response){
                $("#variable_1").html(response)
            });
        } else {
            $('#duration').find('option').remove().end().append("<option value=''>-- Duration --</option>")
        }
    }
</script>
@endsection