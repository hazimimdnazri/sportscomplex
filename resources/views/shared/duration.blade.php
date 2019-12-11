<div class="form-group">
    <label>Duration (Hour) <span class="text-red">*</span></label>
    <select name="duration" class="form-control" id="duration">
        <option value="" selected>-- Duration --</option>
        @for($i=$asset->min_hour; $i <= 10; $i=$i+$asset->min_hour)
            <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    </select>
</div>