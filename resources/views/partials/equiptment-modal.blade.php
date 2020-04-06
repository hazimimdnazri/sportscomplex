<div class="modal fade" id="equiptmentModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="equiptmentForm" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Equiptment</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Equiptments <span class="text-red">*</span></label>
                        <select name="equiptment" class="form-control" style="width: 100%;">
                            <option value="">-- Equiptments --</option>
                            @foreach($equiptments as $e)
                                <option value="{{ $e->id }}" {{ $e->getDisableStatus($e->id) }}>{{ $e->equiptment }} - {{ $e->serial_number }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Rent"/>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $("#equiptmentForm").submit(function(e) {
        e.preventDefault();    
        var formData = new FormData(this);

        $.ajax({
            url: "{{ url('admin/application/'.$id.'/equiptment') }}",
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        }).done((response) => {
            if(response == 'success'){
                $("#equiptmentModal").modal('hide')
                Swal.fire(
                    'Succes!',
                    'Data saved!!',
                    'success'
                ).then((result) => {
                    if(result.value){
                        location.reload();
                    }
                })
            } 
        });
    });
</script>