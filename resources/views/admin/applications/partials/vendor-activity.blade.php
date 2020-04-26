<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-header">
            <h4 class="box-title">Activity</h4>
        </div>
        <div class="box-body">
            <form id="quotationData">
                @csrf
                <table id="activity" class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">No. </th>
                            <th class="text-center">Activity</th>
                            <th class="text-center">Number</th>
                            <th width="5%" class="text-center">Price (RM)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                        $n = 1;
                        @endphp
                        @foreach($reservations as $r)
                        <tr>
                            <td class="text-center">{{ $n++ }}</td>
                            <td class="text-center">{{ $r->r_activity->activity }}</td>
                            <td class="text-center">
                                {{ $r->getCount($r->application_id, $r->activity_id) }}
                            </td>
                            <td class="text-center">
                                    <input type="text" name="activity[{{ $r->activity_id }}]" class="form-control" value="{{ number_format($r->sum, 2) }}">
                                </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
            <hr>
            <div class="text-center">
                <button onClick="reject()" type="button" class="btn btn-danger" data-dismiss="modal">Reject</button>
                <button onClick="approve()" class="btn btn-primary">Approve</button>
            </div>
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