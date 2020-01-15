<div class="form-group">
    <label>Asset Name <span class="text-red">*</span></label>
    <input type="text" class="form-control" name="asset" placeholder="Enter asset name" required value="{{ $asset->asset }}">
</div>
<div class="form-group">
    <label>Category <span class="text-red">*</span></label>
    <select name="category" class="form-control" required>
        <option value="">-- Asset Category --</option>
        @foreach($types as $t)
            <option value="{{ $t->id }}" {{ $asset->type == $t->id ? 'selected' : '' }}>{{ $t->type }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label>Price (RM) <span class="text-red">*</span></label>
    <input type="text" class="form-control" name="price" placeholder="Enter asset name" required value="{{ $asset->price }}">
</div>
<div class="form-group">
    <label>Minimum Hour <span class="text-red">*</span></label>
    <input type="text" class="form-control" name="min_hour" placeholder="Enter asset name" required value="{{ $asset->min_hour }}">
</div>
<div class="form-group">
    <label>Remarks </label>
    <textarea type="text" class="form-control" name="remark" placeholder="Enter asset name">{{ $asset->remark }}</textarea>
</div>
