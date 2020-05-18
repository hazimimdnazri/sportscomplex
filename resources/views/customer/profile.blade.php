@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
<link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<section class="content-header">
    <h1>
        {{ $user->name ?? '' }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">{{ $user->name ?? '' }}</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">My Profile</h3>
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
                                        <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{ $user->name ?? '' }}">
                                    </div>
                                    <div class="form-group" id="ic">
                                        <label for="exampleInputEmail1">I.C Number <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="ic" placeholder="Enter IC number" value="{{ $user->r_details->ic ?? '' }}">
                                    </div>
                                    <div class="form-group" style="display:none" id="passport">
                                        <label for="exampleInputEmail1">Passport <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="passport" placeholder="Enter passport number" value="{{ $user->r_details->passport ?? '' }}">
                                    </div>
                                    <div class="form-group" >
                                        <label>Date of Birth <span class="text-red">*</span></label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="dob" class="form-control pull-right" id="datepicker" value="{{ isset($user->r_details->dob) ? date('d-m-Y', strtotime($user->r_details->dob)) : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mobile Phone <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="phone" placeholder="Enter mobile phone number" value="{{ $user->r_details->phone ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">E-Mail <span class="text-red">*</span></label>
                                        <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{ $user->email ?? '' }}" readOnly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Customer Type <span class="text-red">*</span></label>
                                        <select class="form-control" onChange="userType(this.value)" id="type" name="type" disabled>
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
                                        <select name="nationality" class="form-control" id="nationality" onChange="nation(this.value)" disabled>
                                            <option value="" selected>-- Nationality --</option>
                                            <option value="1" >Malaysian</option>
                                            <option value="2" >Foriegner</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Zipcode <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="zipcode" placeholder="Enter zipcode" value="{{ $user->r_details->zipcode ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">City <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="city" placeholder="Enter city" value="{{ $user->r_details->city ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label>State <span class="text-red">*</span></label>
                                        <select name="state" id="state" class="select2 form-control" style="width: 100%;">
                                            @foreach($states as $s)
                                            <option value="{{ $s->id }}">{{ $s->state }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Address <span class="text-red">*</span></label>
                                        <textarea type="text" rows="4" class="form-control" name="address" placeholder="Enter address">{{ $user->r_details->address ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div id="students" style="display:none">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Student ID <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" id="student_id" name="student_id" placeholder="Applicant email" value="{{ $user->r_student->student_id ?? '' }}">
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
                                            <input type="text" class="form-control" id="staff_id" name="staff_id" placeholder="Applicant email" value="{{ $user->r_staff->staff_id ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Company <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" id="company" name="company" placeholder="Applicant email" value="{{ $user->r_staff->company ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <input type="hidden" name="nationality" value="{{ $user->r_details->nationality }}">
                        <input type="hidden" name="type" value="{{ $user->r_details->type }}">
                        <div class="text-center">
                            <button type="button" class="btn btn-warning">Reset</button>
                            <button class="btn btn-primary">Save</button>
                            <button type="button" class="btn bg-navy" data-toggle="modal" data-target="#modal-default">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Change Password</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group div_password">
                            <label>New Password <span class="text-red">*</span></label>
                            <input type="password" id="password_1" class="form-control" placeholder="Enter new password">
                            <span class="help-block error-password"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group div_retype">
                            <label>Confirm Password <span class="text-red">*</span></label>
                            <input type="password" id="password_2" class="form-control" placeholder="Retype new password">
                            <span class="help-block error-retype"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onClick="changePass()" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('postscript')
<script src="{{ asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script>
    $(() => {
        $('.select2').select2()

        @if(isset($user->r_details))
            $("#type").val({{$user->r_details->type}}).change()
            $("#nationality").val({{$user->r_details->nationality}}).change()
            @if(isset($user->r_details->state))
                $("#state").val({{$user->r_details->state}}).change()
            @endif

            @if($user->r_details->type == 3)
                $("#institution").val({{$user->r_student->institution}}).change()
            @endif

        @endif
    })

    changePass = () => {
        if(!($("#password_1").val())){
            $(".div_password").addClass('has-error')
            $(".div_retype").removeClass('has-error')
            $(".error-password").text('Please enter your password')
            $(".error-retype").text('')
        } else {
            if($("#password_1").val() == $("#password_2").val()){
                $.ajax({
                    type:"POST",
                    url: "{{ url('customer/ajax/changepass') }}",
                    data : {
                        "_token": "{{ csrf_token() }}",
                        "password" : $("#password_2").val(),
                    }
                }).done(function(response){
                    if(response == 'success'){
                        Swal.fire(
                            'Success!',
                            'Password has been changed.',
                            'success'
                        ).then((result) => {
                            if(result.value){
                                window.location.replace("{{ url('customer/profile') }}");
                            }
                        })
                    }
                });
            } else {
                $(".div_retype").addClass('has-error')
                $(".error-password").text('')
                $(".div_password").removeClass('has-error')
                $(".error-retype").text('Retype password does not match')
            }
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

    $('#datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        endDate: '-1d',
        startView: 3
    })

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
                title: 'Saving user',
                html: 'Please wait for a moment...',
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                }
            })

            $.ajax({
                url: "{{ url('customer/profile') }}",
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done((response) => {
                if(response == 'success'){
                    Swal.fire(
                        'Success!',
                        'Your profile has been edited.',
                        'success'
                    ).then((result) => {
                        if(result.value){
                            window.location.replace("{{ url('customer/profile') }}");
                        }
                    })
                }
            });
        },
        errorLabelContainer: "#errors", 
        errorElement: "li",
    });
</script>
@endsection