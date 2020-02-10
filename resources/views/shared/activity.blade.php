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
                        <th class="text-center">Activity</th>
                        <th class="text-center">Price Type</th>
                        <th class="text-center">Price / Entry (RM)</th>
                        <th class="text-center">Deposit (RM)</th>
                        <th class="text-center" width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $n = 1 @endphp
                    @foreach($reservations as $r)
                    <tr>
                        <td class="text-center">{{ $n++ }}</td>
                        <td class="text-center">{{ $r->r_activity->activity }}</td>
                        <td class="text-center">
                            @if($r->price_type == 1)
                                Public
                            @elseif($r->price_type == 2)
                                Student
                            @elseif($r->price_type == 3)
                                Under 12
                            @endif
                        </td>
                        <td class="text-center">
                        @if($r->price_type == 1)
                            {{ number_format($r->r_activity->public, 2) }}
                        @elseif($r->price_type == 2)
                            {{ number_format($r->r_activity->students, 2) }}
                        @elseif($r->price_type == 3)
                            {{ number_format($r->r_activity->underage, 2) }}
                        @endif
                        </td>
                        <td class="text-center">{{ number_format($r->r_activity->deposit, 2) }}  </td>
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
                <input onClick="toPayment()" type="button" class="btn btn-primary" value="Submit"/>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="activityModal" data-backdrop="static" data-keyboard="false">
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
                        <select name="activity" class="form-control select2" style="width: 100%;">
                            <option value="">-- Activities --</option>
                            @foreach($activities as $a)
                                <option value="{{ $a->id }}">{{ $a->activity }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Price <span class="text-red">*</span></label>
                        <select name="price" class="form-control select2" style="width: 100%;">
                            <option value="">-- Price --</option>
                            <option value="1">Public</option>
                            <option value="2">Student</option>
                            <option value="3">Under 12</option>
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

<script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
    $(function () {
        $('#example1').DataTable()

        $('#datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        })

        $('.select2').select2()
    })

    toPayment = () => {
        if($("#event").val() == ''){
            alert("Please enter the event name.")
        } else {
            $.ajax({
                type:"POST",
                url: "{{ url('pdo.php') }}",
                data : {
                    "_token": "{{ csrf_token() }}",
                    "id" : "{{ $id }}",
                    "event_name" : $("#event").val()
                }
            }).done(function(response){
                if(response == 'success'){
                    window.location = "{{ url('application/payment/'.$id) }}"
                }
            });
        }
    }
</script>