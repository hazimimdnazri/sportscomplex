<div class="modal fade" id="membershipsModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('settings/membership') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Membership</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Membership <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="membership" value="{{ $membership->membership }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Discount (%) <span class="text-red">*</span></label>
                        <input type="integer" class="form-control" name="discount" value="{{ $membership->discount }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Monthly Price <span class="text-red">*</span></label>
                        <input type="integer" class="form-control" name="monthly" value="{{ $membership->monthly }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Anually Price <span class="text-red">*</span></label>
                        <input type="integer" class="form-control" name="anually" value="{{ $membership->anually }}">
                    </div>
                </div>
                <input type="hidden" name="id" value="{{ $id }}">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Save"/>
                </div>
            </form>
        </div>
    </div>
</div>