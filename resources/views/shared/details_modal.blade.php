<div class="modal fade" id="detailsModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="application_form" action="{{ url('application/'.$id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Item</h4>
                </div>
                <div class="modal-body">
                    <p>Please fill in all the required fields, denoted with <span class="text-red">*</span>.</p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Item Type <span class="text-red">*</span></label>
                                <select onChange="itemType(this.value)" name="type" class="form-control">
                                    <option value="" selected>-- Item --</option>
                                    <option value="1" >Facility</option>
                                    <option value="2" >Activity</option>
                                </select>
                            </div>
                            <div id="facility" style="display:none">
                                <div class="form-group">
                                    <label>Facilities <span class="text-red">*</span></label>
                                    <select onChange="waktu(this.value)" name="asset" class="form-control select2" style="width: 100%;">
                                        <option value="">-- Asset --</option>
                                        @foreach($assets as $a)
                                            <option value="{{ $a->id }}">{{ $a->asset }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="variable_2">
                                    <div class="form-group">
                                        <label>Duration (Hour) <span class="text-red">*</span></label>
                                        <select name="duration" class="form-control" id="duration">
                                            <option value="" selected>-- Duration --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="activity" style="display:none">
                                <div class="col-md-12">
                                    Activity
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Submit"/>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    itemType = (value) => {
        if(value == 1){
            $("#facility").show()
            $("#activity").hide()
        } else {
            $("#facility").hide()
            $("#activity").show()
        }
    }

    waktu = (value) => {
        if(value){
            $.ajax({
                type:"POST",
                url: "{{ url('api/asset') }}"+"/"+value
            }).done(function(response){
                $("#variable_2").html(response)
            });
        } else {
            $('#duration').find('option').remove().end().append("<option value=''>-- Duration --</option>")
        }
    }
</script>