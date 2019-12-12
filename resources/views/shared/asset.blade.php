<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-header">
            <button onClick="detailsModal()" type="button" class="btn btn-info">Reserve a Facility</button>
        </div>
        <div class="box-body">
            <table id="example1" class="table table-bordered">
                <thead>
                    <tr>
                        <th width="5%">No. </th>
                        <th class="text-center">Item</th>
                        <th class="text-center">Duration (Hour)</th>
                        <th class="text-center">Price / Hour (RM)</th>
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
</script>