<div class="modal fade" id="assetModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="application_form" action="{{ url('application') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Asset Reservation</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="errors" style="display:none" class="alert alert-danger alert-dismissable"></div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Membership ID </label>
                                <div class="input-group">
                                    <input id="member_id" type="text" class="form-control" placeholder="Member ID (if available)">
                                    <span class="input-group-btn">
                                        <button onClick="member()" class="btn btn-info" type="button">Find</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Event <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="event" placeholder="Event name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name <span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Applicant name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">I.C Number <span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="ic" name="ic" placeholder="Applicant MyKad / MyKid">
                            </div>
                            <div class="form-group">
                                <label>Address <span class="text-red">*</span></label>
                                <textarea class="form-control" id="address" name="address" rows="2" placeholder="Applicant address"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Asset <span class="text-red">*</span></label>
                                <select onChange="waktu(this.value)" name="asset" class="form-control select2" style="width: 100%;">
                                    <option value="">-- Asset --</option>
                                    @foreach($assets as $a)
                                        <option value="{{ $a->id }}">{{ $a->asset }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="variable_2">
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
                                <input type="email" class="form-control" id="email" name="email" placeholder="Applicant email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone <span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Applicant phone number">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Zipcode <span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Applicant zipcode">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">City <span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="Applicant city">
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
                                    <input type="text" name="date" class="form-control pull-right" id="datepicker" placeholder="Reservation date">
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
                                <textarea class="form-control" name="remark" rows="3" placeholder="Enter any remarks here..."></textarea>
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

<script>
    $(() => {
        $('.select2').select2()

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

        $('#reservation').val('');
    })

    $("#application_form").validate({
        ignore: [],
        rules: {
            name: {
                required: true,
            },
            event: {
                required: true,
            },
            ic: {
                required: true,
            },
            address: {
                required: true,
            },
            asset: {
                required: true,
            },
            duration: {
                required: true,
            },
            email: {
                required: true,
            },
            phone: {
                required: true,
            },
            zipcode: {
                required: true,
            },
            city: {
                required: true,
            },
            state: {
                required: true,
            },
            date: {
                required: true,
            },
            time: {
                required: true,
            }
        },
        messages: {
            name: {
                required: "Applicant name is required.",
            },
            event: {
                required: "Event name is required.",
            },
            ic: {
                required: "Applicant I.C number is required.",
            },
            address: {
                required: "Applicant address is required.",
            },
            asset: {
                required: "Asset is required.",
            },
            duration: {
                required: "Reservation duration is required.",
            },
            email: {
                required: "Applicant email is required.",
            },
            phone: {
                required: "Applicant phone number is required.",
            },
            zipcode: {
                required: "Applicant zipcode is required.",
            },
            city: {
                required: "Applicant city is required.",
            },
            state: {
                required: "Applicant state is required.",
            },
            date: {
                required: "Reservation date is required.",
            },
            time: {
                required: "Reservation time is required.",
            },
        },
        errorLabelContainer: "#errors", 
        errorElement: "li",
    });
</script>