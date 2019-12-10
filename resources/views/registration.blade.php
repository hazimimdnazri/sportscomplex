@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
<section class="content-header">
    <h1>
        Membership Registration
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Membership Registration</li>
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
                    <form action="{{ url('registration') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Full Name <span class="text-red">*</span></label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter applicant name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">I.C Number <span class="text-red">*</span></label>
                                    <input type="text" class="form-control" name="ic" placeholder="Enter applicant name">
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
                                    <input type="text" class="form-control" name="phone" placeholder="Enter applicant name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">E-Mail <span class="text-red">*</span></label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter applicant name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address <span class="text-red">*</span></label>
                                    <textarea type="text" rows="4" class="form-control" name="address" placeholder="Enter applicant name"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nationality <span class="text-red">*</span></label>
                                    <select name="nationality" class="form-control" name="membership">
                                        <option value="" selected>-- Nationality --</option>
                                        <option value="1" >Malaysian</option>
                                        <option value="2" >Foriegner</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Zipcode <span class="text-red">*</span></label>
                                    <input type="text" class="form-control" name="zipcode" placeholder="Enter applicant name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">City <span class="text-red">*</span></label>
                                    <input type="text" class="form-control" name="city" placeholder="Enter applicant name">
                                </div>
                                <div class="form-group">
                                    <label>State <span class="text-red">*</span></label>
                                    <select name="state" class="select2 form-control" style="width: 100%;">
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
                                    <select onChange="member(this.value)" class="form-control" name="membership">
                                        <option value="" selected>-- Membership --</option>
                                        @foreach($memberships as $m)
                                        <option value="{{ $m->id }}">{{ $m->membership }}</option>
                                        @endforeach
                                    </select>
                                    <small><span style="color:gold">Gold</span> = 20% discounted price</small><br>
                                    <small><span style="color:silver">Silver</span> = 15% discounted price</small><br>
                                    <small><span style="color:brown">Bronze</span> = 10% discounted price</small>
                                </div>
                                <div class="form-group">
                                    <label>Payment Cycle <span class="text-red">*</span></label>
                                    <select name="cycle" id="" class="form-control">
                                        <option value="">-- Cycle --</option>
                                        <option id="monthly" value="1">Monthly</option>
                                        <option id="anually" value="2">Anually</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <button class="btn btn-warning">Reset</button>
                            <button class="btn btn-primary">Register</button>
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
<script>
    $(document).ready(
        () => {
            $('.select2').select2()
        }
    )

    //Date picker
    $('#datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    })

    member = (value) => {
        $.ajax({
            type:"POST",
            url: "{{ url('membershipprice') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "membership" : value
            }
        }).done(function(response){
            document.getElementById("monthly").innerHTML = "Monthly (RM"+response.monthly+")"
            document.getElementById("anually").innerHTML = "Anually (RM"+response.anually+")";
        });
       
    }
</script>
@endsection