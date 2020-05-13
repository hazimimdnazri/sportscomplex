<label for="">Sport</label>
<select id="sport" class="form-control" name="sport" onChange="selectSports(this.value)">
    <option value="">-- Select Sport --</option>
    @foreach($sports as $s)
    <option value="{{$s->id}}">{{$s->sport}}</option>
    @endforeach
</select>