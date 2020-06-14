<div class="modal fade" id="modal-password">
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