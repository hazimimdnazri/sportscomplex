<div class="modal fade" id="membershipModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content" id="form">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Customer Membership</h4>
            </div>
            <div class="modal-body">
                <form id="membershipData">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div id="errors" style="display:none" class="alert alert-danger alert-dismissable"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Membership Type <span class="text-red">*</span></label>
                                <select onChange="member(this.value)" id="membership" class="form-control" name="membership">
                                    <option value="" selected>-- Membership --</option>
                                    @foreach($memberships as $m)
                                        @if($m->id != 99)
                                        <option value="{{ $m->id }}">{{ $m->membership }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <small><span style="color:gold">Gold</span> = 20% discounted price</small><br>
                                <small><span style="color:silver">Silver</span> = 15% discounted price</small><br>
                                <small><span style="color:brown">Bronze</span> = 10% discounted price</small><br>
                                <small><span style="color:blue">EduCity Students</span> = 20% discounted price</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Payment Cycle <span class="text-red">*</span></label>
                                <select name="cycle" id="cycle" id="" class="form-control">
                                    <option value="">-- Cycle --</option>
                                    <option id="monthly" value="1">Monthly</option>
                                    <option id="anually" value="2">Anually</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="id" value="">
                </form>
                <div class="text-center">
                    <button type="button" onClick="renew()" class="btn btn-success">Renew Membership</button>
                </div>
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <th class="text-center">Membership</th>
                        <th class="text-center">Renewal Date</th>
                        <th class="text-center">Expiry Date</th>
                        <th class="text-center">Action</th>
                    </thead>
                    <tbody>
                    @foreach($membership as $mem)
                        <tr>
                            <td class="text-center">{!! $mem->membershipBadge($mem->membership) !!}</td>
                            <td class="text-center">{{ date('d/m/Y', strtotime($mem->cycle_start)) }}</td>
                            <td class="text-center">{{ date('d/m/Y', strtotime($mem->cycle_end)) }}</td>
                            <td class="text-center">
                                <button class="btn btn-info">Edit</button>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <input type="hidden" name="id" id="id">
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>

$(() => {
    $("#membershipData").validate({
        ignore: [],
        rules: {
            membership: {
                required: true,
            },
            cycle: {
                required: true,
            },
        },
        messages: {
            membership: {
                required: "Membership type is required.",
            },
            cycle: {
                required: "Cycle is required.",
            },
        },
        errorLabelContainer: "#errors", 
        errorElement: "li",
    })
})

renew = () => { 
    if($("#membershipData").valid()){
        var formData = new FormData($('#membershipData')[0]);

        $.ajax({
            url: "{{ url('admin/membership/'.$id) }}",
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        }).done((response) => {
            if(response == 'success'){
                $('#membershipModal').modal('hide')
                Swal.fire(
                    'Success!',
                    'Membership added!',
                    'success'
                ).then((result) => {
                    if(result.value){
                        location.reload()
                    }
                })
            } 
        });
    }
}
</script>