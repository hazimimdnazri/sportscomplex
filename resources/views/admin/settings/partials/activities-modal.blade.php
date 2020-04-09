<div class="modal fade" id="activitiesModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('admin/settings/activities') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Activity</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Activity <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="activity" value="{{ $activity->activity }}" placeholder="Enter asset name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Public Price (RM) <span class="text-red">*</span></label>
                        <input type="integer" class="form-control" name="public" value="{{ $activity->public }}" placeholder="Enter asset name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Students Price (RM) <span class="text-red">*</span></label>
                        <input type="integer" class="form-control" name="students" value="{{ $activity->students }}" placeholder="Enter asset name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Under 12 Price (RM) <span class="text-red">*</span></label>
                        <input type="integer" class="form-control" name="underage" value="{{ $activity->underage }}" placeholder="Enter asset name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Deposit (RM) <span class="text-red">*</span></label>
                        <input type="integer" class="form-control" name="deposit" value="{{ $activity->deposit }}" placeholder="Enter asset name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Remark <span class="text-red">*</span></label>
                        <textarea type="text" class="form-control" name="remark" placeholder="Enter asset name">{{ $activity->remark }}</textarea>
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