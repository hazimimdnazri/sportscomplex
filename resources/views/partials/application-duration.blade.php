<label for="exampleInputEmail1">Duration <span class="text-red">*</span></label>
<select class="form-control" name="duration" onChange="changeTime(this.value)">
    <option value="" selected>-- Duration --</option>
    @for($i = $facility->min_hour; $i <= $facility->min_hour * 5; $i=$i+$facility->min_hour)
    <option value="{{$i}}">{{$i}}</option>
    @endfor
</select>