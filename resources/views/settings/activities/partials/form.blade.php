 <div class="form-group">
    <label for="exampleInputEmail1">Activity <span class="text-red">*</span></label>
    <input type="text" class="form-control" name="activity" required value="{{ $activity->activity }}">
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Public Price (RM) <span class="text-red">*</span></label>
    <input type="number" class="form-control" name="public" required value="{{ $activity->public }}">
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Students Price (RM) <span class="text-red">*</span></label>
    <input type="number" class="form-control" name="students" required value="{{ $activity->students }}">
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Under 12 Price (RM) <span class="text-red">*</span></label>
    <input type="number" class="form-control" name="underage" required value="{{ $activity->underage }}">
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Deposit (RM) <span class="text-red">*</span></label>
    <input type="number" class="form-control" name="deposit" required value="{{ $activity->deposit }}">
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Remark</label>
    <textarea type="text" class="form-control" name="remark">{{ $activity->remark }}</textarea>
</div>