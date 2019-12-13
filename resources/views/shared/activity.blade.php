<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-header">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#activityModal">Reserve an Activity</button>
        </div>
        <div class="box-body">
            <table id="example1" class="table table-bordered">
                <thead>
                    <tr>
                        <th width="5%">No. </th>
                        <th class="text-center">Item</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Price / Entry (RM)</th>
                        <th class="text-center">Total Price (RM)</th>
                        <th class="text-center" width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $n = 1 @endphp
                    @foreach($reservations as $r)
                    <tr>
                        <td class="text-center">{{ $n++ }}</td>
                        <td class="text-center">{{ $r->r_asset->asset }}</td>
                        <td class="text-center">{{ $r->duration }}</td>
                        <td class="text-center">{{ number_format($r->r_asset->price, 2) }}</td>
                        <td class="text-center">{{ number_format($r->r_asset->price * $r->duration, 2) }}  </td>
                        <td class="text-center"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <div class="text-center">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-primary" value="Submit"/>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="activityModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('application/'.$id.'/activity') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Reserve an Activity</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Activity <span class="text-red">*</span></label>
                        <select name="asset" class="form-control select2" style="width: 100%;">
                            <option value="">-- Activities --</option>
                            @foreach($activities as $a)
                                <option value="{{ $a->id }}">{{ $application->asset }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Types <span class="text-red">*</span></label>
                        <select name="asset" class="form-control select2" style="width: 100%;">
                            <option value="">-- Type --</option>
                            <option value="1">Public</option>
                            <option value="2">Student</option>
                            <option value="3">Under 12</option>
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

<script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script>
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
        })

        $('#datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        })
    })

    addActivity = () => {
        console.log('activity')
    }
</script>