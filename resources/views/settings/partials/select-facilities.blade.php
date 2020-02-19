<div class="form-group">
    <label>Facilities</label>
    <select id="facilityList" class="form-control select2" name="facilities[]" multiple="multiple" data-placeholder="Select Facilities" style="width: 100%;">
        @foreach($facilities as $f)
        <option value="{{ $f->id }}">{{$f->facility}}</option>
        @endforeach
    </select>
</div>


<script>
    $(() => {
        $('.select2').select2()
        $("#facilityList").val(<?= $selectedFac->facility ?>).trigger("change")
    })
</script>