<div class="modal fade" id="passwordModal">
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

<script>
    changePass = () => {
        if(!($("#password_1").val())){
            $(".div_password").addClass('has-error')
            $(".div_retype").removeClass('has-error')
            $(".error-password").text('Please enter your password')
            $(".error-retype").text('')
        } else {
            if(alphanumeric($("#password_1").val())){
                if($("#password_1").val() == $("#password_2").val()){
                    $.ajax({
                        type:"POST",
                        url: "{{ url('admin/settings/ajax/changepass') }}",
                        data : {
                            "_token": "{{ csrf_token() }}",
                            "password" : $("#password_2").val(),
                            "id" : "{{ $id }}"
                        }
                    }).done(function(response){
                        if(response == 'success'){
                            Swal.fire(
                                'Success!',
                                'Password has been changed.',
                                'success'
                            ).then((result) => {
                                if(result.value){
                                    window.location.replace("{{ url('admin/settings/users') }}");
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
    }

    alphanumeric = (password) => {
        var cond = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{7,15}$/;
        if(password.match(cond)){
            return true;
        } else {
            $(".div_password").addClass('has-error')
            $(".div_retype").removeClass('has-error')
            $(".error-password").text('The password must be at least 8 characters long, containing one uppercase letter, one lowercase letter, one number, and one special character.')
            $(".error-retype").text('')
            return false;
        }            
    }
</script>