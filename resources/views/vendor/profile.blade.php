@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
<link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<section class="content-header">
    <h1>
        My Profile
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Settings</li>
        <li class="active">My Profile</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Details</h3>
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
                                        <input type="text" class="form-control" name="name" value="{{ $user->name ?? '' }}" placeholder="Enter name">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Mobile Phone <span class="text-red">*</span></label>
                                                <input type="text" class="form-control" name="phone_mobile" value="{{ $user->r_vendor->phone_mobile ?? '' }}" placeholder="Enter mobile phone number">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Office Phone <span class="text-red">*</span></label>
                                                <input type="text" class="form-control" name="phone_office" value="{{ $user->r_vendor->phone_office ?? '' }}" placeholder="Enter mobile phone number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">E-Mail <span class="text-red">*</span></label>
                                        <input type="email" class="form-control" name="email" value="{{ $user->email ?? '' }}" placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Address <span class="text-red">*</span></label>
                                        <textarea type="text" rows="4" class="form-control" name="address" placeholder="Enter address">{{ $user->r_vendor->address ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nationality <span class="text-red">*</span></label>
                                        <select id="nationality" class="form-control" name="nationality">
                                            <option value="" selected>-- Nationality --</option>
                                            <option value="1" >Malaysian</option>
                                            <option value="2" >Foriegner</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Company Registration No. <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="company_reg" value="{{ $user->r_vendor->company_registration ?? '' }}" placeholder="Enter company registration number">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Zipcode <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="zipcode" value="{{ $user->r_vendor->zipcode ?? '' }}" placeholder="Enter zipcode">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">City <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="city" value="{{ $user->r_vendor->city ?? '' }}" placeholder="Enter city">
                                    </div>
                                    <div class="form-group">
                                        <label>State <span class="text-red">*</span></label>
                                        <select name="state" id="state" class="select2 form-control" style="width: 100%;">
                                            <option value="">-- State --</option>
                                            @foreach($states as $s)
                                            <option value="{{ $s->id }}">{{ $s->state }}</option>
                                            @endforeach
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
                                                    <input type="text" class="form-control" name="pic_name[]" value="{{ $user->r_pic[0]->name ?? '' }}" placeholder="Enter full name">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phone Number <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" name="pic_phone[]" value="{{ $user->r_pic[0]->phone_mobile ?? '' }}" placeholder="Enter phone number">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">E-Mail Address <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" name="pic_email[]" value="{{ $user->r_pic[0]->email ?? '' }}" placeholder="Enter email address">
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
                                                    <input type="text" class="form-control" name="pic_name[]" value="{{ $user->r_pic[1]->name ?? '' }}" placeholder="Enter full name">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phone Number <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" name="pic_phone[]" value="{{ $user->r_pic[1]->phone_mobile ?? '' }}" placeholder="Enter phone number">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">E-Mail Address <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" name="pic_email[]" value="{{ $user->r_pic[1]->email ?? '' }}" placeholder="Enter email address">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-danger">Cancel</button>
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
<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script>
    $(() => {
        $('.select2').select2()
        $("#nationality").val({{$user->r_vendor->nationality}}).change()
        $("#state").val({{$user->r_vendor->state}}).change()
    })

    $('#datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        endDate: '-1d',
        startView: 3
    })

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
            if(response == 'success'){
                $("#familyModal").modal('hide')
                Swal.fire(
                    'Success!',
                    'Vendor has been registered!',
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