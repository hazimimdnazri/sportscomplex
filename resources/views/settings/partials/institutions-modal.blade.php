<div class="modal fade" id="institutionsModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('admin/settings/institutions') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Institution</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Institution <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="institution" value="{{ $institutions->institution }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Remarks <span class="text-red">*</span></label>
                        <textarea type="text" class="form-control" name="remark" >{{ $institutions->remark }}</textarea>
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