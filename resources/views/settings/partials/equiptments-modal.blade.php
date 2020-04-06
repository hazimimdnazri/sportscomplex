<div class="modal fade" id="equiptmentsModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('admin/settings/equiptments') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Equiptment</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Equiptment <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="equiptment" value="{{ $equiptment->equiptment }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Serial Number / ID <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="serial_number" value="{{ $equiptment->serial_number }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Price <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="price" value="{{ number_format($equiptment->price, 2) }}">
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