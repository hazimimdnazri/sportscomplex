<div class="modal fade" id="membershipsModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('admin/settings/membership') }}" method="POST">
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
                        <label>Activities</label>
                        <select id="activityList" class="form-control select2" name="activities[]" multiple="multiple" data-placeholder="Select activities" style="width: 100%;">
                            @foreach($activities as $a)
                            <option value="{{ $a->id }}">{{$a->activity}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sports</label>
                        <select id="facilityList" class="form-control select2" name="facilities[]" multiple="multiple" data-placeholder="Select facilities" style="width: 100%;">
                            @foreach($facilities as $f)
                            <option value="{{ $f->id }}">{{$f->facility}}</option>
                            @endforeach
                        </select>
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

<script>
    $(() => {
        $('.select2').select2()
        $("#activityList").val(<?= $membership->activities ?>).trigger("change")
        $("#facilityList").val(<?= $membership->facilities ?>).trigger("change")
    })
</script>