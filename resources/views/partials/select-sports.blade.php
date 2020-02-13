<label for="">Sport</label>
<select class="form-control" name="sport" name="facility" onChange="selectSports(this.value)">
    <option value="">-- Select Sport --</option>
    @foreach($sports as $s)
    <option value="{{$s->id}}">{{$s->sport}}</option>
    @endforeach
</select>