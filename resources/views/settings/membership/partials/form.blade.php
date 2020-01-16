<div class="form-group">
    <label for="exampleInputEmail1">Membership <span class="text-red">*</span></label>
    <input type="text" class="form-control" name="membership" required value="{{ $membership->membership }}">
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Discount (%) <span class="text-red">*</span></label>
    <input type="number" class="form-control" name="discount" required value="{{ $membership->discount }}">
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Monthly (RM) <span class="text-red">*</span></label>
    <input type="number" class="form-control text-right" name="monthly" required value="{{ $membership->monthly }}">
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Anually (RM) <span class="text-red">*</span></label>
    <input type="number" class="form-control text-right" name="anually" required value="{{ $membership->anually }}">
</div>