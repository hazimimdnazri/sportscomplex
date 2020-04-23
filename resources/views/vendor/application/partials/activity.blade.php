<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-header">
            <h4 class="box-title">Activity</h4>
            <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#activityModal">Reserve an Activity</button>
        </div>
        <div class="box-body">
            <table id="activity" class="table table-bordered">
                <thead>
                    <tr>
                        <th width="5%">No. </th>
                        <th class="text-center">Activity</th>
                        <th class="text-center" width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                    $n = 1;
                    $ftotal = 0;
                    $dtotal = 0;
                    @endphp
                    @foreach($reservations as $r)
                    <tr>
                        <td class="text-center">{{ $n++ }}</td>
                        <td class="text-center">{{ $r->r_activity->activity }}</td>
                        <td class="text-center">
                            <button onClick="deleteAsset({{ $r->id }})" class="btn btn-danger" >Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <div class="text-center">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button onClick="toQuotation()" class="btn btn-primary">Submit Reservation</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="activityModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('ajax/application/'.$id.'/activity') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Reserve an Activity</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Activity <span class="text-red">*</span></label>
                        <select name="activity" class="form-control select2" style="width: 100%;">
                            <option value="">-- Activities --</option>
                            @foreach($activities as $a)
                                <option value="{{ $a->id }}">{{ $a->activity }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Quantity <span class="text-red">*</span></label>
                        <select name="quantity" class="form-control" style="width: 100%;">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Remarks </label>
                        <textarea type="text" class="form-control" name="remark" placeholder="Enter asset name"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Save"/>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
    $(function () {
        $('#activity').DataTable()

        $('#datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        })

        $('.select2').select2()
    })
</script>