@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
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
                    <h3 class="box-title">Applicant Details</h3>
                    <p>Please fill in all the required fields, denoted with <span class="text-red">*</span>.</p>
                </div>
                <div class="box-body">
                    <form id="application_form" action="{{ url('customer/'.$user->id.'/edit') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div id="errors" style="display:none" class="alert alert-danger alert-dismissable"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Full Name <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{ $user->name ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">I.C Number <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="ic" placeholder="Enter IC number" value="{{ $user->r_details->ic ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Date of Birth <span class="text-red">*</span></label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="dob" class="form-control pull-right" id="datepicker" value="{{ isset($user->r_details->dob) ? date('m-d-Y', strtotime($user->r_details->dob)) : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mobile Phone <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="phone" placeholder="Enter mobile phone number" value="{{ $user->r_details->phone ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">E-Mail <span class="text-red">*</span></label>
                                        <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{ $user->email ?? '' }}">
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
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Address <span class="text-red">*</span></label>
                                        <textarea type="text" rows="4" class="form-control" name="address" placeholder="Enter address">{{ $user->r_details->address ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nationality <span class="text-red">*</span></label>
                                        <select name="nationality" class="form-control" id="nationality" name="nationality">
                                            <option value="" selected>-- Nationality --</option>
                                            <option value="1" >Malaysian</option>
                                            <option value="2" >Foriegner</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Passport <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="passport" placeholder="Enter passport number" value="{{ $user->r_details->passport ?? '' }}">
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
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Membership Type <span class="text-red">*</span></label>
                                        <select onChange="member(this.value)" id="membership" class="form-control" name="membership">
                                            <option value="" selected>-- Membership --</option>
                                            @foreach($memberships as $m)
                                                @if($m->id !=99)
                                                <option value="{{ $m->id }}">{{ $m->membership }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <small><span style="color:gold">Gold</span> = 20% discounted price</small><br>
                                        <small><span style="color:silver">Silver</span> = 15% discounted price</small><br>
                                        <small><span style="color:brown">Bronze</span> = 10% discounted price</small><br>
                                        <small><span style="color:blue">EduCity Students</span> = 20% discounted price</small>

                                    </div>
                                    <div class="form-group">
                                        <label>Payment Cycle <span class="text-red">*</span></label>
                                        <select name="cycle" id="cycle" id="" class="form-control">
                                            <option value="">-- Cycle --</option>
                                            <option id="monthly" value="1">Monthly</option>
                                            <option id="anually" value="2">Anually</option>
                                        </select>
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
                        <div class="text-center">
                            <button type="button" class="btn btn-warning">Reset</button>
                            <button class="btn btn-primary">Save</button>
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
<script>
    $(() => {
        $('.select2').select2()

        @if(isset($user->r_details))
            $("#type").val({{$user->r_details->type}}).change()
            $("#nationality").val({{$user->r_details->nationality}}).change()
            $("#state").val({{$user->r_details->state}}).change()

            @if($user->getMembershipID($user->id))
                $("#membership").val({{$user->getMembershipID($user->id)}}).change()
            @endif

            @if($user->getMembershipCycle($user->id))
                $("#cycle").val({{$user->getMembershipCycle($user->id)}}).change()
            @endif

            @if($user->r_details->type == 3)
                $("#institution").val({{$user->r_student->institution}}).change()
            @endif

        @endif
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

    $('#datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        endDate: '-1d',
        startView: 3
    })

    member = (value) => {
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

    $("#application_form").validate({
        ignore: [],
        rules: {
            name: {
                required: true,
            },
            dob: {
                required: true,
            },
            ic: {
                required: true,
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
            membership: {
                required: true,
            },
            cycle: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Applicant name is required.",
            },
            dob: {
                required: "Applicant date of birth is required.",
            },
            ic: {
                required: "Applicant IC is required.",
            },
            address: {
                required: "Applicant address is required.",
            },
            phone: {
                required: "Applicant phone is required.",
            },
            email: {
                required: "Applicant email is required.",
            },
            zipcode: {
                required: "Applicant zipcode is required.",
            },
            city: {
                required: "Applicant city is required.",
            },
            state: {
                required: "Select applicant state.",
            },
            membership: {
                required: "Select applicant membership.",
            },
            cycle: {
                required: "Select applicant payment cycle.",
            },
        },
        errorLabelContainer: "#errors", 
        errorElement: "li",
    });
</script>
@endsection