<div class="modal fade" id="groupsModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('settings/groups') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Facility Group</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Category <span class="text-red">*</span></label>
                        <select name="category" class="form-control" style="width: 100%;">
                            <option value="">-- Facility Category --</option>
                            @foreach($types as $t)
                                <option value="{{ $t->id }}" {{ $group->type == $t->id ? 'selected' : '' }}>{{ $t->type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Facility Group <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="group" value="{{ $group->group }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Remarks <span class="text-red">*</span></label>
                        <textarea type="text" class="form-control" name="remark" >{{ $group->remark }}</textarea>
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