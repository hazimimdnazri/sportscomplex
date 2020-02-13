<div class="modal fade" id="sportsModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('settings/sports') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Sport</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Venue <span class="text-red">*</span></label>
                        <select name="group" class="form-control" onChange="selectVenue(this.value)" style="width: 100%;">
                            <option value="">-- Venue --</option>
                            @foreach($venues as $v)
                                <option value="{{ $v->id }}">{{ $v->venue }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="variable_2">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Sport <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="facility" value="{{ $sport->sport }}" placeholder="Enter asset name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Price (RM) <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="price" value="{{ $sport->price }}" placeholder="Enter asset name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Minimum Hour <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="min_hour" value="{{ $sport->min_hour }}" placeholder="Enter asset name">
                    </div>
                    <!-- <div class="form-group">
                        <label for="exampleInputEmail1">Legend Colour <span class="text-red">*</span></label>
                        <div class="input-group color-picker">
                            <input type="text" name="colour" value="" class="form-control color-picker">
                            <div class="input-group-addon">
                                <i></i>
                            </div>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Remarks </label>
                        <textarea type="text" class="form-control" name="remark" placeholder="Enter asset name">{{ $sport->remark }}</textarea>
                    </div>
                </div>
                <input type="hidden" name="id" value="{{ $id }}">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Save"/>
                </div>
            </form>
        </div>
    </div>
</div>