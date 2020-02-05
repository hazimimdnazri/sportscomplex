<form id="applicationForm" method="POST">
    @csrf
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">New Reservation ( {{ date('d/m/Y', $date) }} - {{ App\LFacilityGroup::find($group)->group }} )</h4>
    </div>
    <div class="modal-body" id="body">
        <p>Please fill in all the required fields, denoted with <span class="text-red">*</span>.</p>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Facility <span class="text-red">*</span></label>
                    <select name="type" class="form-control" onChange="changeDuration(this.value)" name="facility">
                        <option value="" selected>-- Facility --</option>
                        @foreach($facilities as $f)
                        <option value="{{ $f->id }}" >{{$f->facility}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Start Time <span class="text-red">*</span></label>
                    <input type="text" class="form-control" id="start_time" value="{{ date('H:i A', $date)}}" readOnly>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group" id="duration">
                    <label for="exampleInputEmail1">Duration <span class="text-red">*</span></label>
                    <select name="type" class="form-control" name="membership">
                        <option value="" selected>-- Duration --</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">End Time <span class="text-red">*</span></label>
                    <input type="text" class="form-control" id="end_time" readOnly>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="post_id" id="post_id">
    <input type="hidden" name="start_date" value="{{ $date }}" id="start_date">
    <input type="hidden" name="end_date" value="" id="end_date">
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Submit"/>
    </div>
</form>