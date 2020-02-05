<label for="">Facilities</label>
<select class="form-control" name="facility" name="facility" onChange="selectFacility(this.value)">
    <option value="">-- Select Facility --</option>
    @foreach($facilities as $f)
    <option value="{{$f->id}}">{{$f->facility}}</option>
    @endforeach
</select>