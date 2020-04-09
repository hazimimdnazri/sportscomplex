<div class="modal fade" id="facilitiesModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('admin/settings/facilities') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Facility</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Category <span class="text-red">*</span></label>
                        <select name="category" class="form-control" style="width: 100%;">
                            <option value="">-- Venue --</option>
                            @foreach($venues as $v)
                                <option value="{{ $v->id }}" {{ $facility->venue == $v->id ? 'selected' : '' }}>{{ $v->venue }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Facility <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="group" value="{{ $facility->facility }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Remarks <span class="text-red">*</span></label>
                        <textarea type="text" class="form-control" name="remark" >{{ $facility->remark }}</textarea>
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