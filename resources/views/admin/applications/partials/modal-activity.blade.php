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
                        @if($application->a_applicant->r_details)
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">User Type</label>
                                <select name="type" id="type" class="form-control">
                                    @foreach($types as $t)
                                    <option value="{{ $t->id }}" {{ $application->a_applicant->r_details->type == $t->id ? 'selected' : 'disabled' }}>{{ $t->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif
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
                                <th class="text-center bg-gray">Access Card ID</th>
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
                                    <td class="text-center"></td>
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

</script>