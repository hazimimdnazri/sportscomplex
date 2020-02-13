<div class="form-group">
    <label>Facilities</label>
    <select class="form-control select2" name="facilities[]" multiple="multiple" data-placeholder="Select Facilities" style="width: 100%;">
        @foreach($facilities as $f)
        <option value="{{ $f->id }}">{{$f->facility}}</option>
        @endforeach
    </select>
</div>


<script>
    $(() => {
        $('.select2').select2()
    })
</script>