<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-header">
            <h4 class="box-title">Facilities</h4>
        </div>
        <div class="box-body">
            <form id="quotationData">
            @csrf
                <table id="asset" class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">No. </th>
                            <th class="text-center">Facility</th>
                            <th class="text-center">Duration</th>
                            <th class="text-center">Price / Min. Hour (RM)</th>
                            <!-- <th class="text-center">Total Price (RM)</th> -->
                            <th class="text-center" width="20%">Price (RM)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                        $n = 1;
                        @endphp
                        @foreach($reservations as $r)
                        <tr>
                            <td class="text-center">{{ $n++ }}</td>
                            <td class="text-center">{{ $r->r_sport->sport }}</td>
                            <td class="text-center">
                                {{ $r->duration }} Hour(s) <br>
                                {{ date('h:i:s a' ,strtotime($r->start_date)) }} - {{ date('h:i:s a' ,strtotime($r->end_date)) }}
                            </td>
                            <td class="text-center">{{ number_format($r->r_sport->price, 2) }}</td>
                            <!-- <td class="text-center">{{ number_format($r->r_sport->price * ($r->duration/$r->r_sport->min_hour), 2) }}  </td> -->
                            <td class="text-center">
                                <input type="text" name="facility[{{ $r->id }}]" class="form-control" value="{{ number_format($r->price, 2) }}">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
            <hr>
            <div class="text-center">
                @if($reservations->count() > 0)
                    <button onClick="reject()" type="button" class="btn btn-danger" data-dismiss="modal">Reject</button>
                    <button onClick="approve()" class="btn btn-primary">Approve</button>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
    $(() => {
        $('#asset').DataTable()
    })
</script>