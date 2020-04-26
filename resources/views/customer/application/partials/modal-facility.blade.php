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
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Proof of Payment</label>
                                @if(isset($application->r_payment->file))
                                <p><a target="_blank" href="{{ url('uploads/payments/'.$application->r_payment->file) }}"><button type="button" class="btn bg-navy">View Payment</button></a></p>
                                @else
                                <p><span class="label bg-navy">Payment still pending</span></p>
                                @endif
                            </div>
                        </div>
                        @if($application->status == 6)
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Remark </label>
                                <textarea type="text" class="form-control" disabled>This application was rejected due to: {{ $application->remark }}</textarea>
                            </div>
                        </div>
                        @endif
                    </div>
                    <hr>
                    <h4 class="modal-title">Facilities & Equiptments</h4>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                                <th width="5%" class="text-center bg-gray">#</th>
                                <th class="text-center bg-gray">Venue</th>
                                <th class="text-center bg-gray">Sport</th>
                                <th class="text-center bg-gray">Facility</th>
                                <th class="text-center bg-gray">Duration</th>
                                <th class="text-center bg-gray">Price (RM)</th>
                            </thead>
                            <tbody>
                                @php $n = 1 @endphp
                                @foreach($facilities as $f)
                                <tr>
                                    <td class="text-center">{{ $n++ }}</td>
                                    <td class="text-center">{{ $f->r_sport->r_venue->venue }}</td>
                                    <td class="text-center">{{ $f->r_sport->sport }}</td>
                                    <td class="text-center">
                                        @php $facility = json_decode($f->r_sport->facility) @endphp
                                        @for($i = 0; $i < count($facility); $i++)
                                            {{ App\LFacility::find($facility[$i])->facility }}<br>
                                        @endfor
                                    </td>
                                    <td class="text-center">{{ date('h:i A', strtotime($f->start_date)) }} - {{ date('h:i A', strtotime($f->end_date)) }}</td>
                                    <td class="text-center">{{ number_format($f->price, 2) }}</td>
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
                                <th class="text-center bg-gray">Price (RM)</th>
                                <th class="text-center bg-gray">Status</th>
                            </thead>
                            <tbody>
                                @php $n = 1 @endphp
                                @if(count($equiptments) > 0)
                                    @foreach($equiptments as $e)
                                    <tr>
                                        <td class="text-center">{{ $n++ }}</td>
                                        <td class="text-center">{{ $e->r_equiptment ->equiptment}}</td>
                                        <td class="text-center">{{ $e->r_equiptment->serial_number }}</td>
                                        <td class="text-center">{{ $e->price }}</td>
                                        <td class="text-center">
                                            @if($e->status == 1)
                                                <span class="label label-warning">Draft</span>
                                            @elseif($e->status == 2)
                                                <span class="label label-primary">In Usage</span>
                                            @elseif($e->status == 3)
                                                <span class="label label-success">Returned</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="5">No equiptment</td>
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