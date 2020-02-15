<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-header">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#facilityModal">Reserve a Facility</button>
            <button type="button" onClick="addEquiptment()" class="btn btn-success" >Rent Equiptments</button>
        </div>
        <div class="box-body">
            <h4 class="title">Facilities</h4>
            <table id="example1" class="table table-bordered">
                <thead>
                    <tr>
                        <th width="5%">No. </th>
                        <th class="text-center">Facility</th>
                        <th class="text-center">Duration</th>
                        <th class="text-center">Price / Min. Hour (RM)</th>
                        <th class="text-center">Total Price (RM)</th>
                        <th class="text-center" width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                    $n = 1;
                    $ftotal = 0;
                    @endphp
                    @foreach($reservations as $r)
                    <tr>
                        <td class="text-center">{{ $n++ }}</td>
                        <td class="text-center">{{ $r->r_sport->sport }}</td>
                        <td class="text-center">
                            {{ $r->duration }} Hour(s) <br>
                            {{ date('h:i:s a' ,strtotime($r->start_date)) }} - {{ date('h:i:s a' ,strtotime($r->end_date)) }}
                        </td>
                        <td class="text-center">{{ number_format($r->r_sport->price, 2) }}</td>
                        <td class="text-center">{{ number_format($r->r_sport->price * ($r->duration/$r->r_sport->min_hour), 2) }}  </td>
                        <td class="text-center">
                            <button onClick="deleteAsset({{ $r->id }})" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    @php $ftotal += number_format($r->r_sport->price * ($r->duration/$r->r_sport->min_hour), 2) @endphp
                    @endforeach
                </tbody>
            </table>
            <br>
            <hr>
            <br>
            <h4 class="title">Equiptments</h4>
            <table id="example1" class="table table-bordered">
                <thead>
                    <tr>
                        <th width="5%">No. </th>
                        <th class="text-center">Equiptment</th>
                        <th class="text-center">Price (RM)</th>
                        <th class="text-center" width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                    $n = 1;
                    $etotal = 0;
                    @endphp
                    @foreach($equiptments as $e)
                    <tr>
                        <td class="text-center">{{ $n++ }}</td>
                        <td class="text-center">{{ $e->r_equiptment->equiptment }}</td>
                        <td class="text-center">{{ number_format($e->r_equiptment->price, 2) }}</td>
                        <td class="text-center">
                            <button onClick="deleteEquiptment({{ $r->id }})" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    @php $etotal += number_format($e->r_equiptment->price, 2) @endphp
                    @endforeach
                </tbody>
            </table>
            <hr>
            <div class="text-center">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button onClick="toPayment()" class="btn btn-primary">Pay</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="facilityModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('application/'.$id.'/facility') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Reserve a Facility</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Venue <span class="text-red">*</span></label>
                                <select name="group" class="form-control select2" onChange="selectVenue(this.value)" style="width: 100%;">
                                    <option value="">-- Venues --</option>
                                    @foreach($venues as $v)
                                        <option value="{{ $v->id }}">{{ $v->venue }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" id="facilities">

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
                            <div class="form-group">
                                <label for="exampleInputEmail1">Remarks </label>
                                <textarea type="text" class="form-control" name="remark" placeholder="Enter asset name"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="cal"></div>
                        </div>
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

@php $total = $ftotal + $etotal @endphp

<div class="modal fade" id="paymentModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="paymentForm" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">POS Payment (Cash)</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Sub Total (RM) </label>
                        <input type="text" class="form-control" name="subtotal" id="subtotal" value="{{ number_format($total, 2) }}" readOnly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Discount ({{$user->r_details->r_membership->discount}}%) </label>
                        <input type="text" class="form-control" name="discount" id="discount" value="{{ $discount = number_format(($user->r_details->r_membership->discount/100) * $total, 2) }}" readOnly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Total Price (RM) </label>
                        <input type="text" class="form-control" name="total" id="total" value="{{ number_format(($total - $discount), 2)  }}" readOnly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Cash Paid (RM) </label>
                        <input type="text" class="form-control" oninput="calcChange(this.value)" value="" name="paid" id="paid">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Change (RM) </label>
                        <input type="text" class="form-control" name="change" id="change" value="0.00">
                    </div>
                </div>
                <input type="hidden" name="type" value="B">
                <input type="hidden" name="event" id="event_name" value="B">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Save"/>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="variable_3"></div>

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
            minuteStep: 30
        })
    })

    selectSports = (value) => {
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
        $("#paymentModal").modal('show')
        $("#event_name").val($("#event").val())
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

    selectVenue = (value) => {
        if(value){
            $.ajax({
                type:"POST",
                url: "{{ url('ajax/sports') }}",
                data : {
                    "_token": "{{ csrf_token() }}",
                    "venue" : value
                }
            }).done(function(response){
                $("#facilities").html(response)
            });
        } else {
            $("#facilities").html('')
        }

        $.ajax({
            type:"POST",
            url: "{{ url('ajax/minicalendar') }}",
            data : {
                "_token": "{{ csrf_token() }}",
                "venue" : value,
                "date"  : "{{ $date }}"
            }
        }).done(function(response){
            $("#cal").html(response)
        });

    }

    calcChange = (value) => {
        var change = value - $("#total").val()
        $("#change").val(change.toFixed(2))
    }

    $("#paymentForm").submit(function(e) {
        e.preventDefault();    
        var formData = new FormData(this);

        $.ajax({
            url: "{{ url('application/payment/'.$id) }}",
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        }).done((response) => {
            if(response == 'success'){
                $("#paymentModal").modal('hide')
                Swal.fire(
                    'Succes!',
                    'Data saved!!',
                    'success'
                ).then((result) => {
                    if(result.value){
                        window.location.replace("{{ url('application') }}");
                    }
                })
            } 
        });
    });
</script>