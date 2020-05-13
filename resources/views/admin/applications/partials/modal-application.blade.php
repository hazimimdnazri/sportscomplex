<div class="modal fade" id="activityModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="form">
            <form id="applicationForm" action="{{ url('admin/application') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Reservation</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12" style="margin-bottom: 10px">
                            <button type="button" id="new" onClick="searchIC(this.id)" class="btn btn-success">New Customer</button>
                            <button type="button" id="existing" onClick="searchIC(this.id)" class="btn btn-info">Existing Customer</button>
                        </div>
                    </div>
                    <p>Please fill in all the required fields, denoted with <span class="text-red">*</span>.</p>
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="errors" style="display:none" class="alert alert-danger alert-dismissable"></div>
                            <div class="form-group" id="searchIC" style="display:none">
                                <label for="exampleInputEmail1">IC Number / Passport </label>
                                <div class="input-group">
                                    <input id="member_id" type="text" class="form-control" placeholder="Enter IC / Passport">
                                    <span class="input-group-btn">
                                        <button onClick="member()" class="btn btn-info" type="button">Find</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Type <span class="text-red">*</span></label>
                                <select name="type" onChange="userType(this.value)" id="type" class="form-control">
                                    <option value="" selected>-- Type --</option>
                                    @foreach($types as $t)
                                    <option value="{{ $t->id }}" >{{ $t->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name <span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Applicant name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">E-Mail <span class="text-red">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Applicant email">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nationality <span class="text-red">*</span></label>
                                <select name="nationality" onChange="selectNationality(this.value)" id="nationality" class="form-control">
                                    <option value="" selected>-- Nationality --</option>
                                    <option value="1" >Malaysian</option>
                                    <option value="2" >Foreigner</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6"  id="ic_block" style="display:none">
                            <div class="form-group">
                                <label for="exampleInputEmail1">I.C Number <span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="ic" name="ic" placeholder="Applicant IC">
                            </div>
                        </div>
                        <div class="col-lg-6" id="passport_block" style="display:none">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Passport <span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="passport" name="passport" placeholder="Applicant passport">
                            </div>
                        </div>
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
                <input type="hidden" name="post_id" id="post_id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(() => {
        $('.select2').select2()
    })

    $("#applicationForm").validate({
        ignore: [],
        rules: {
            type: {
                required: true
            },
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            nationality: {
                required: true
            },
            ic: {
                required: () => {
                    return $('#searchIC').is(':visible')
                },
            },
            ic: {
                required: () => {
                    return $('#ic_block').is(':visible')
                },
            },
            passport: {
                required: () => {
                    return $('#passport_block').is(':visible')
                },
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
            type: {
                required: "Type is required.",
            },
            name: {
                required: "Name is required.",
            },
            email: {
                required: "E-Mail is required.",
                email: "Please enter a valid e-mail address."
            },
            nationality: {
                required: "Nationality is required.",
            },
            ic: {
                required: "Please enter an IC / Passport number.",
            },
            passport: {
                required: "Please enter a passport number.",
            },
            student_id: {
                required: "Please enter studnent ID.",
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
        errorLabelContainer: "#errors", 
        errorElement: "li",
    });

</script>