<div class="modal fade" id="activityModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="applicationForm" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Reservation ( {{ date('d/m/Y', $date)}} )</h4>
                </div>
                <div class="modal-body">
                    <p>Please fill in all the required fields, denoted with <span class="text-red">*</span>.</p>
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="errors" style="display:none" class="alert alert-danger alert-dismissable"></div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">IC Number </label>
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
                                <label for="exampleInputEmail1">Type <span class="text-red">*</span></label>
                                <select name="type" onChange="userType(this.value)" class="form-control" name="membership">
                                    <option value="" selected>-- Type --</option>
                                    <option value="1" >Public</option>
                                    <option value="2" >Staff</option>
                                    <option value="3" >Students</option>
                                </select>
                            </div>
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
                            <div class="form-group">
                                <label for="exampleInputEmail1">I.C Number <span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="ic" name="ic" placeholder="Applicant MyKad / MyKid">
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
                                    <input type="text" class="form-control" id="institution" name="institution" placeholder="Applicant email">
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
                    <input type="submit" class="btn btn-primary" value="Submit"/>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(() => {
        $('.select2').select2()
    })

    $("#applicationForm").submit(function(e) {
	e.preventDefault();    
	var formData = new FormData(this);

	$.ajax({
		url: "{{ url('application') }}",
		type: 'POST',
		data: formData,
		cache: false,
		contentType: false,
		processData: false
	}).done((response) => {
		console.log(response)
		// if(response == 'success'){
		// 	$("#educationModal").modal('hide')
		// 	Swal.fire(
		// 		'Succes!',
		// 		'Data saved!!',
		// 		'success'
		// 	).then((result) => {
		// 		if(result.value){
		// 			location.reload();
		// 		}
		// 	})
		// } 
	});
});
</script>