<div class="modal fade" id="equiptmentsModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('settings/equiptments') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Equiptment</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Facility <span class="text-red">*</span></label>
                        <select name="facility" class="form-control" style="width: 100%;">
                            <option value="">-- Facility --</option>
                            @foreach($facilities as $f)
                                <option value="{{ $f->id }}" {{ $equiptment->facility == $f->id ? 'selected' : '' }}>{{ $f->facility }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Equiptment <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="equiptment" value="{{ $equiptment->equiptment }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Remarks <span class="text-red">*</span></label>
                        <textarea type="text" class="form-control" name="remark" >{{ $equiptment->remark }}</textarea>
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