<div class="modal fade" id="paymentModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content" id="form">
            <form id="paymentData">
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
                                <label for="exampleInputEmail1">Total Price (RM) </label>
                                <input id="price" type="text" class="form-control" value="{{ number_format($price, 2) }}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputFile">Proof of Payment</label>
                                <input type="file" name="receipt" id="proof">

                                <p class="help-block">Please upload your transaction receipt.</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                <input type="hidden" name="post_id" id="post_id">
                <div class="modal-footer">
                    <button type="button" onClick="uploadPayment()" class="btn btn-primary">Submit</button>
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

    uploadPayment = () => {
        var format = ['jpeg', 'png', 'jpg', 'pdf']
        var fileName = $("#proof").val()
        var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);

        if(format.includes(fileExtension)){
            var formData = new FormData($('#paymentData')[0]);

            $.ajax({
                url: "{{ url('customer/applications/'.$application->id.'/payment') }}",
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done((response) => {
                if(response == 'success'){
                    $('#paymentModal').modal('hide')
                    Swal.fire(
                        'Success!',
                        'Proof of payment uploaded!',
                        'success'
                    ).then((result) => {
                        if(result.value){
                            location.reload()
                        }
                    })
                } 
            });
        } else {
            Swal.fire({
                title: 'Error!',
                type: 'error',
                html:
                    'No file or invalid format.<br>' +
                    'Allowed format (pdf, png, jpeg, jpg).'
            })
        }
    }

</script>