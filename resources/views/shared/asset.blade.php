
<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-header">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#facilityModal">Reserve a Facility</button>
        </div>
        <div class="box-body">
            <table id="example1" class="table table-bordered">
                <thead>
                    <tr>
                        <th width="5%">No. </th>
                        <th class="text-center">Item</th>
                        <th class="text-center">Duration</th>
                        <th class="text-center">Price / Min. Hour (RM)</th>
                        <th class="text-center">Total Price (RM)</th>
                        <th class="text-center" width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $n = 1 @endphp
                    @foreach($reservations as $r)
                    <tr>
                        <td class="text-center">{{ $n++ }}</td>
                        <td class="text-center">{{ $r->r_asset->asset }}</td>
                        <td class="text-center">
                            @if( (strtotime($r->end_date) - strtotime($r->start_date)) / (60*60*24) > 0)
                            {{(strtotime($r->end_date) - strtotime($r->start_date)) / (60*60*24)}} day(s) <br>
                            {{ date('d/m/Y' ,strtotime($r->start_date)) }} - {{ date('d/m/Y' ,strtotime($r->end_date)) }}
                            @else
                            {{ $r->duration }} Hour(s) <br>
                            {{ date('h:i:s a' ,strtotime($r->start_date)) }} - {{ date('h:i:s a' ,strtotime($r->end_date)) }}
                            @endif
                        </td>
                        <td class="text-center">{{ number_format($r->r_asset->price, 2) }}</td>
                        <td class="text-center">{{ number_format($r->r_asset->price * ($r->duration/$r->r_asset->min_hour), 2) }}  </td>
                        <td class="text-center">
                            <button onClick="deleteAsset({{ $r->id }})" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <div class="text-center">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button onClick="toPayment()" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="facilityModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('application/'.$id.'/facility') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Reserve a Facility</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Facilities <span class="text-red">*</span></label>
                        <select onChange="waktu(this.value)" name="asset" class="form-control select2" style="width: 100%;">
                            <option value="">-- Asset --</option>
                            @foreach($assets as $a)
                                <option value="{{ $a->id }}">{{ $a->asset }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Reservation Type</label>
                        <select class="form-control" name="reservation_type" name="reservation_type" onChange="dayHour(this.value)">
                            <option value="1" selected>Single Day</option>
                            <option value="2">Multiple Days</option>
                        </select>

                    </div>
                    <div class="bootstrap-timepicker" id="start_time">
                        <div class="form-group">
                            <label>Start Time:</label>
                            <div class="input-group">
                                <input name="start_time" type="text" class="form-control timepicker">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="hourly">
                        <div id="variable_2">
                            <div class="form-group">
                                <label>Duration (Hour) <span class="text-red">*</span></label>
                                <select name="duration" class="form-control" id="duration">
                                    <option value="" selected>-- Duration --</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="daily" style="display:none">
                        <div class="form-group">
                            <label>Date range:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="reservation">
                                <input name="start_date" type="hidden" id="start_date">
                                <input name="end_date" type="hidden" id="end_date">
                            </div>
                        </div>
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

<script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
    $(() => {
        $('#example1').DataTable()

        $('#datepicker').datepicker({
            firstDay: 1,
            format: 'dd-mm-yyyy',
            autoclose: true,
            beforeShowDay: $.datepicker.noWeekends
        })
        
        $('.select2').select2()

        $('.timepicker').timepicker({
            showInputs: false,
            defaultTime: 'current'
        })

        $('#reservation').daterangepicker({
            minDate: new Date(),
            locale: {
                "format": "DD/MM/YYYY",
            },
        },(start, end) => {
            $("#start_date").val(start.format('YYYY-MM-DD'))
            $("#end_date").val(end.format('YYYY-MM-DD'))
        });

        $('.input-daterange-datepicker-1').val('');
    })

    waktu = (value) => {
        if(value){
            $.ajax({
                type:"POST",
                url: "{{ url('api/asset') }}"+"/"+value
            }).done(function(response){
                $("#variable_2").html(response)
            });
        } else {
            $('#duration').find('option').remove().end().append("<option value=''>-- Duration --</option>")
        }
    }

    toPayment = () => {
        if($("#event").val() == ''){
            alert("Please enter the event name.")
        } else {
            $.ajax({
                type:"POST",
                url: "{{ url('ajax/confirmreservation') }}",
                data : {
                    "_token": "{{ csrf_token() }}",
                    "id" : "{{ $id }}",
                    "event_name" : $("#event").val()
                }
            }).done(function(response){
                if(response == 'success'){
                    window.location = "{{ url('application/payment/'.$id) }}"
                }
            });
        }
    }

    dayHour = (value) => {
        if(value == 1){
            $("#hourly").show();
            $("#daily").hide();
            $("#start_time").show();
        } else {
            $("#hourly").hide();
            $("#daily").show();
            $("#start_time").hide();
        }
    }
</script>