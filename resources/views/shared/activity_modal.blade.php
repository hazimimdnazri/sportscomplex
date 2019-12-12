<div class="modal fade" id="activityModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="application_form" action="{{ url('application') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Reservation</h4>
                </div>
                <div class="modal-body">
                    <p>Please fill in all the required fields, denoted with <span class="text-red">*</span>.</p>
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="errors" style="display:none" class="alert alert-danger alert-dismissable"></div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Membership ID </label>
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
                                <label for="exampleInputEmail1">Name <span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Applicant name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">I.C Number <span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="ic" name="ic" placeholder="Applicant MyKad / MyKid">
                            </div>
                            <div class="form-group">
                                <label>Address <span class="text-red">*</span></label>
                                <textarea class="form-control" id="address" name="address" rows="2" placeholder="Applicant address"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">City <span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="Applicant city">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">E-Mail <span class="text-red">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Applicant email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone <span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Applicant phone number">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Zipcode <span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Applicant zipcode">
                            </div>
                            <div class="form-group">
                                <label>State <span class="text-red">*</span></label>
                                <select name="state" class="select2 form-control" id="state" style="width: 100%;">
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
</script>