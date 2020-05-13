<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-header">
            <h4 class="box-title">Facilities</h4>
            <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#facilityModal">Reserve a Facility</button>
        </div>
        <div class="box-body">
            <table id="asset" class="table table-bordered">
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
                    @foreach($facilities as $f)
                    <tr>
                        <td class="text-center">{{ $n++ }}</td>
                        <td class="text-center">{{ $f->r_sport->sport }}</td>
                        <td class="text-center">
                            {{ $f->duration }} Hour(s) <br>
                            {{ date('h:i:s a' ,strtotime($f->start_date)) }} - {{ date('h:i:s a' ,strtotime($f->end_date)) }}
                        </td>
                        <td class="text-center">{{ number_format($f->r_sport->price, 2) }}</td>
                        <td class="text-center">{{ number_format($f->price, 2) }}  </td>
                        <td class="text-center">
                            <button onClick="deleteItem({{ $f->id }}, 1)" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    @php $ftotal += number_format($f->r_sport->price * ($f->duration/$f->r_sport->min_hour), 2) @endphp
                    @endforeach
                </tbody>
            </table>
            <hr>
            <input type="hidden" id="ftotal" value="{{ $ftotal }}">
            <div class="text-center">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                @if($application->a_applicant->role == 1 || $application->a_applicant->role == 2)
                <button onClick="toSubmit()" class="btn btn-primary">Submit</button>
                @else
                <button onClick="toPayment()" class="btn btn-primary">Pay</button>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="facilityModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="facilityData" action="{{ url('ajax/application/'.$id.'/facility') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Reserve a Facility</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="errors" style="display:none" class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            </div>
                            <div class="form-group">
                                <label>Venue <span class="text-red">*</span></label>
                                <select name="venue" class="form-control select2" onChange="selectVenue(this.value)" style="width: 100%;">
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

@php $total = $ftotal @endphp

<script src="{{ asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
    $(() => {
        $('#asset').DataTable()

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

    $("#facilityData").validate({
        ignore: [],
        rules: {
            venue: {
                required: true
            },
            sport: {
                required: () => {
                    return $('#sport').is(':visible')
                },
            },
            duration: {
                required: true
            },
        },
        messages: {
            venue: {
                required: "Select a venue.",
            },
            sport: {
                required: "Select a sport.",
            },
            duration: {
                required: "Select a duration.",
            },
        },
        errorLabelContainer: "#errors", 
        errorElement: "li",
    });
</script>