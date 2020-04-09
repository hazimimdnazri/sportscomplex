@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
<link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<section class="content-header">
    <h1>
        Vendor Registration
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Vendor Registration</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Vendor Details</h3>
                    <p>Please fill in all the required fields, denoted with <span class="text-red">*</span>.</p>
                </div>
                <div class="box-body">
                    <form id="vendorData">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div id="errors" style="display:none" class="alert alert-danger alert-dismissable"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Company Name <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter name">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Mobile Phone <span class="text-red">*</span></label>
                                                <input type="text" class="form-control" name="phone_mobile" placeholder="Enter mobile phone number">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Office Phone <span class="text-red">*</span></label>
                                                <input type="text" class="form-control" name="phone_office" placeholder="Enter mobile phone number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">E-Mail <span class="text-red">*</span></label>
                                        <input type="email" class="form-control" name="email" placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Address <span class="text-red">*</span></label>
                                        <textarea type="text" rows="4" class="form-control" name="address" placeholder="Enter address"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nationality <span class="text-red">*</span></label>
                                        <select name="nationality" class="form-control" name="nationality">
                                            <option value="" selected>-- Nationality --</option>
                                            <option value="1" >Malaysian</option>
                                            <option value="2" >Foriegner</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Company Registration No. <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="company_reg" placeholder="Enter company registration number">
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
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h4 class="box-title">Person In Charge (Event)</h4>
                        <br>
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tr>
                                    <td colspan="2">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Full Name <span class="text-red">*</span></label>
                                                    <input type="text" class="form-control" name="pic_name[]" placeholder="Enter full name">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phone Number <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" name="pic_phone[]" placeholder="Enter phone number">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">E-Mail Address <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" name="pic_email[]" placeholder="Enter email address">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <br>
                        <h4 class="box-title">Person In Charge (Finance)</h4>
                        <br>
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tr>
                                    <td colspan="2">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Full Name <span class="text-red">*</span></label>
                                                    <input type="text" class="form-control" name="pic_name[]" placeholder="Enter full name">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phone Number <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" name="pic_phone[]" placeholder="Enter phone number">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">E-Mail Address <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" name="pic_email[]" placeholder="Enter email address">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-warning">Reset</button>
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

    $("#vendorData").submit(function(e) {
        e.preventDefault();    
        var formData = new FormData(this);

        $.ajax({
            url: "{{ url('admin/registration/vendor') }}",
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        }).done((response) => {
            console.log(response)
            if(response == 'success'){
                $("#familyModal").modal('hide')
                Swal.fire(
                    'Succes!',
                    'Evaluation submitted!',
                    'success'
                ).then((result) => {
                    if(result.value){
                        window.location.replace("{{ url('admin/settings/users') }}");
                    }
                })
            }
        });
    });
</script>
@endsection