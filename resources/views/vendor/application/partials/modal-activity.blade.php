<div class="modal fade" id="viewModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content" id="form">
            <form action="{{ url('application') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Application #{{$application->id}}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Applicant Name </label>
                                <input id="member_id" type="text" class="form-control" value="{{ $application->a_applicant->name }}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">E-Mail </label>
                                <input id="member_id" type="text" class="form-control" value="{{ $application->a_applicant->email }}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Reservation Date </label>
                                <input id="member_id" type="text" class="form-control" value="{{ date('d/m/Y', strtotime($application->date)) }}" disabled>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h4 class="modal-title">Activities & Equiptments</h4>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                                <th width="5%" class="text-center bg-gray">#</th>
                                <th class="text-center bg-gray">Activity</th>
                                <th class="text-center bg-gray">Type</th>
                                <th class="text-center bg-gray">Quantity</th>
                                <th class="text-center bg-gray">Price (RM)</th>
                            </thead>
                            <tbody>
                                @php $n = 1 @endphp
                                @foreach($activities as $a)
                                <tr>
                                    <td class="text-center">{{ $n++ }}</td>
                                    <td class="text-center">{{$a->r_activity->activity}}</td>
                                    <td class="text-center">
                                        {{ $a->getPriceType($a->price_type) }}
                                    </td>
                                    <td class="text-center">
                                        {{ $a->getCount($a->application_id, $a->activity_id) }}
                                    </td>
                                    @if($application->status == 3 || $application->status == 4 ||  $application->status == 5)
                                    <td class="text-center">{{ number_format($a->price * $a->getCount($a->application_id, $a->activity_id), 2) }}</td>
                                    @else
                                    <td class="text-center">TBA</td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                                <th width="5%" class="text-center bg-gray">#</th>
                                <th class="text-center bg-gray">Equiptment</th>
                                <th class="text-center bg-gray">Serial Number / ID</th>
                                <th class="text-center bg-gray">Status</th>
                            </thead>
                            <tbody>
                                @php $n = 1 @endphp
                                @if(count($equiptments) > 1)
                                    @foreach($equiptments as $e)
                                    <tr>
                                        <td class="text-center">{{$n++}}</td>
                                        <td class="text-center">{{ $e->r_equiptment ->equiptment}}</td>
                                        <td class="text-center">{{ $e->r_equiptment->serial_number }}</td>
                                        <td class="text-center">
                                            @if($e->status == 1)
                                                <span class="label label-warning">Draf</span>
                                            @elseif($e->status == 2)
                                                <span class="label label-primary">Dalam Sewaan</span>
                                            @elseif($e->status == 3)
                                                <span class="label label-success">Selesai Dipulangkan</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="4">No equiptment</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <input type="hidden" name="post_id" id="post_id">
                <div class="modal-footer">
                    @if($application->status == 3)
                    <button type="button" onClick="approve()" class="btn btn-primary">Accept</button>
                    <button type="button" onClick="reject()" class="btn btn-danger">Cancel</button>
                    @endif
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(() => {
        $('.select2').select2()
    })

    approve = () => {
        Swal.fire({
            title: "Accept this quotation?",
            text: "This will confirm the reservation.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#47bd9a",
            cancelButtonColor: "#e74c5e",
            confirmButtonText: "Yes, approve!"
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    type:"POST",
                    url: "{{ url('vendor/ajax/acceptreservation') }}",
                    data: {
                        "_token" : "{{ csrf_token() }}",
                        "id" : "{{ $application->id }}"
                    }
                }).done(function(response){
                    if(response == 'success'){
                        Swal.fire("Accepted!", "The quotation has been approved, please proceed to the payment.", "success")
                        .then((result) => {
                            if(result.value){
                                location.reload();
                            }
                        })
                    }
                });
            }
        });
    }

    reject = () => {
        Swal.fire({
            title: "Cancel this reservation?",
            text: "This will cancel the reservation.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#47bd9a",
            cancelButtonColor: "#e74c5e",
            confirmButtonText: "Yes, cancel."
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    type:"POST",
                    url: "{{ url('vendor/applications/cancel') }}",
                    data: {
                        "_token" : "{{ csrf_token() }}",
                        "id" : "{{ $application->id }}",
                        "remark": "Quotation rejected by vendor."
                    }
                }).done(function(response){
                    if(response == 'success'){
                        Swal.fire("Rejected!", "The reservation has been cancelled.", "success")
                        .then((result) => {
                            if(result.value){
                                location.reload();
                            }
                        })
                    }
                });
            }
        });
    }
</script>