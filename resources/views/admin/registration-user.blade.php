@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
<link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<section class="content-header">
    <h1>
        User Registration
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User Registration</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Applicant Details</h3>
                    <p>Please fill in all the required fields, denoted with <span class="text-red">*</span>.</p>
                </div>
                <div class="box-body">
                    <form id="userData">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div id="errors" style="display:none" class="alert alert-danger alert-dismissable"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Full Name <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter name">
                                    </div>
                                    <div class="form-group" id="ic">
                                        <label for="exampleInputEmail1">I.C Number <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="ic" placeholder="Enter IC number">
                                    </div>
                                    <div class="form-group" style="display:none" id="passport">
                                        <label for="exampleInputEmail1">Passport <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="passport" placeholder="Enter passport number">
                                    </div>
                                    <div class="form-group">
                                        <label>Date of Birth <span class="text-red">*</span></label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="dob" class="form-control pull-right" id="datepicker">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mobile Phone <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="phone" placeholder="Enter mobile phone number">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">E-Mail <span class="text-red">*</span></label>
                                        <input type="email" class="form-control" name="email" placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Customer Type <span class="text-red">*</span></label>
                                        <select class="form-control" onChange="userType(this.value)" id="type" name="type">
                                            <option value="" selected>-- Type --</option>
                                            @foreach($types as $t)
                                                <option value="{{ $t->id }}">{{ $t->type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nationality <span class="text-red">*</span></label>
                                        <select id="nationality" class="form-control" name="nationality" onChange="nation(this.value)">
                                            <option value="1" >Malaysian</option>
                                            <option value="2" >Foriegner</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Zipcode <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="zipcode" placeholder="Enter zipcode">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">City <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="city" placeholder="Enter city">
                                    </div>
                                    <div class="form-group">
                                        <label>State <span class="text-red">*</span></label>
                                        <select name="state" id="state" class="select2 form-control" style="width: 100%;">
                                            <option value="" selected>-- State --</option>
                                            @foreach($states as $s)
                                            <option value="{{ $s->id }}" >{{ $s->state }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Address <span class="text-red">*</span></label>
                                        <textarea type="text" rows="4" class="form-control" name="address" placeholder="Enter address"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div id="students" style="display:none">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Student ID <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" id="student_id" name="student_id" placeholder="Applicant email">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Institution <span class="text-red">*</span></label>
                                            <select name="institution" id="institution" class="select2 form-control" style="width: 100%;">
                                                <option value="" selected>-- Institution --</option>
                                                @foreach($institutions as $i)
                                                <option value="{{ $i->id }}" >{{ $i->institution }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="staffs" style="display:none">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Staff ID <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" id="staff_id" name="staff_id" placeholder="Applicant email">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Company <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" id="company" name="company" placeholder="Applicant email">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <button type="button" class="btn btn-warning">Reset</button>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('postscript')
<script src="{{ asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.js') }}"></script>
<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script>
    $(() => {
        $('.select2').select2()
    })

    userType = (value) => {
        if(value == 3 || value == 5){
            $("#students").show()
            $("#staffs").hide()
        } else if(value == 2){
            $("#students").hide()
            $("#staffs").show()
        } else {
            $("#students").hide()
            $("#staffs").hide()
        }
    }

    nation = (value) => {
        if(value == 1){
            $("#ic").show();
            $("#passport").hide();
        } else {
            $("#ic").hide();
            $("#passport").show();
        }
    }

    $('#datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        endDate: '-1d',
        startView: 3
    })

    member = (value) => {
        if(value == 99){
            $("#cycle").attr("disabled", "disabled").val("");
        } else {
            $("#cycle").removeAttr("disabled");
            $.ajax({
                type:"POST",
                url: "{{ url('ajax/membershipprice') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "membership" : value
                }
            }).done(function(response){
                document.getElementById("monthly").innerHTML = "Monthly (RM"+response.monthly+")"
                document.getElementById("anually").innerHTML = "Anually (RM"+response.anually+")";
            });
        }
    }

    $("#userData").validate({
        ignore: [],
        rules: {
            name: {
                required: true,
            },
            dob: {
                required: true,
            },
            ic: {
                required: () => {
                    return $('#ic').is(':visible')
                },
            },
            passport: {
                required: () => {
                    return $('#passport').is(':visible')
                },
            },
            address: {
                required: true,
            },
            phone: {
                required: true,
            },
            email: {
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
            type: {
                required: true,
            },
            student_id: {
                required: () => {
                    return $('#students').is(':visible')
                },
            },
            institution: {
                required: () => {
                    return $('#students').is(':visible')
                },
            },
            staff_id: {
                required: () => {
                    return $('#staffs').is(':visible')
                },
            },
            company: {
                required: () => {
                    return $('#staffs').is(':visible')
                },
            }
        },
        messages: {
            name: {
                required: "User name is required.",
            },
            dob: {
                required: "User date of birth is required.",
            },
            ic: {
                required: "User IC number is required.",
            },
            passport: {
                required: "User passport number is required.",
            },
            address: {
                required: "User address is required.",
            },
            phone: {
                required: "User phone is required.",
            },
            email: {
                required: "User email is required.",
            },
            zipcode: {
                required: "User zipcode is required.",
            },
            city: {
                required: "User city is required.",
            },
            state: {
                required: "Select a state.",
            },
            type: {
                required: "User type is required.",
            },
            student_id: {
                required: "Please enter student ID.",
            },
            institution: {
                required: "Please select an institution.",
            },
            staff_id: {
                required: "Please enter staff ID.",
            },
            company: {
                required: "Please enter a company name.",
            },
        },
        submitHandler: function(){
            var formData = new FormData($('#userData')[0]);
            Swal.fire({
                title: 'Registering user',
                html: 'Please wait for a moment...',
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                }
            })

            $.ajax({
                url: "{{ url('admin/registration/user') }}",
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done((response) => {
                if(response == 'success'){
                    Swal.fire(
                        'Success!',
                        'User has been registered. E-mail has been successfully sent.',
                        'success'
                    ).then((result) => {
                        if(result.value){
                            window.location.replace("{{ url('admin/customers') }}");
                        }
                    })
                } else if(response == 'duplicate'){
                    Swal.fire({
                        type: 'error',
                        title: 'Error!',
                        text: 'The e-mail address already exist, please use different e-mail or login to your existing account.'
                    })
                }
            });
        },
        errorLabelContainer: "#errors", 
        errorElement: "li",
    });
</script>
@endsection