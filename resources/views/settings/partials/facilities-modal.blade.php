<div class="modal fade" id="facilitiesModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('settings/facilities') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Facility</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Category <span class="text-red">*</span></label>
                        <select name="group" class="form-control" style="width: 100%;">
                            <option value="">-- Facility Group --</option>
                            @foreach($groups as $g)
                                <option value="{{ $g->id }}" {{ $facility->group == $g->id ? 'selected' : '' }}>{{ $g->group }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Facility Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="facility" value="{{ $facility->facility }}" placeholder="Enter asset name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Price (RM) <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="price" value="{{ $facility->price }}" placeholder="Enter asset name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Minimum Hour <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="min_hour" value="{{ $facility->min_hour }}" placeholder="Enter asset name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Remarks </label>
                        <textarea type="text" class="form-control" name="remark" placeholder="Enter asset name">{{ $facility->remark }}</textarea>
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