@extends('layouts.main')

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
                                <label for="exampleInputEmail1">Date of Birth <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="dob" placeholder="Enter applicant name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">E-Mail <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="email" placeholder="Enter applicant name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address <span class="text-red">*</span></label>
                                <textarea type="text" col="3" class="form-control" name="address" placeholder="Enter applicant name"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nationality <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="nationality" placeholder="Enter applicant name">
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
                                <label for="exampleInputEmail1">State <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="state" placeholder="Enter applicant name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Membership Type <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="membership" placeholder="Enter applicant name">
                                <small><span style="color:gold">Gold</span> = 20% discounted price</small><br>
                                <small><span style="color:silver">Silver</span> = 15% discounted price</small><br>
                                <small><span style="color:brown">Bronze</span> = 10% discounted price</small>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <button class="btn btn-warning">Reset</button>
                        <button class="btn btn-primary">Register</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection