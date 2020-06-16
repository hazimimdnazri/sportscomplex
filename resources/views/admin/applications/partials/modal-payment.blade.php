<div class="modal fade" id="paymentModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="paymentForm" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">POS Payment (Cash)</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Sub Total (RM) </label>
                        <input type="text" class="form-control" name="subtotal" id="subtotal" value="{{ number_format($total, 2, '.', '') }}" readOnly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Deposit (RM) </label>
                        <input type="text" class="form-control" name="deposit" id="deposit_pay" value="{{ number_format($deposit, 2, '.', '') }}" readOnly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Discount ({{$discount}}%) </label>
                        <input type="text" class="form-control" name="discount" id="discount" value="{{$discount = number_format(($discount/100) * $total, 2, '.', '')}}" readOnly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Total Price (RM) </label>
                        <input type="text" class="form-control" name="total" id="total" value="{{ number_format($total - $discount + $deposit, 2, '.', '') }}" readOnly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Cash Paid (RM) </label>
                        <input type="text" class="form-control" oninput="calcChange(this.value)" value="" name="paid" id="paid">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Change (RM) </label>
                        <input type="text" class="form-control" name="change" id="change" value="0.00">
                    </div>
                </div>
                <input type="hidden" name="event" id="event_name" value="">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="payButton" onClick="pay()" class="btn btn-primary" disabled>Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(() => {
        $('#event_name').val($("#event").val())
    })

    pay = () => {
        var formData = new FormData($('#paymentForm')[0]);

        $.ajax({
            url: "{{ url('admin/application/payment/'.$id) }}",
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        }).done((response) => {
            if(response == 'success'){
                $("#paymentModal").modal('hide')
                receiptWindow = window.open("{{ url('admin/application/receipt/'.$id) }}", "receiptWindow", "toolbar=no,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
                Swal.fire({
                    title: 'Payment Processing',
                    html: 
                        '<table class="table table-bordered mt-0">' +
                        '<tr>' + 
                        '<td><b>Total</b></td><td>:</td><td>RM'+$("#total").val()+'</td><br>' +
                        '</tr>' +
                        '<tr>' +
                        '<td><b>Paid</b></td><td>:</td><td>RM'+$("#paid").val()+'</td><br>' +
                        '</tr>' +
                        '<tr>' +
                        '<td><b>Change</b></td><td>:</td><td>RM'+$("#change").val()+'</td><br>' +
                        '</tr>' +
                        '</table>',
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    }
                })

                var statusInterval = setInterval(statusChecker,3000);

                function statusChecker(){
                    $.ajax({
                        type:"POST",
                        url: "{{ url('admin/application/status/'.$id) }}",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        }
                    }).done(function(response){
                        if(response == 'success'){
                            clearInterval(statusInterval);
                            Swal.fire("Success!", "Payment confirmed.", "success")
                            .then((result) => {
                                if(result.value){
                                    window.location.replace("{{ url('admin/application') }}");
                                }
                            })
                        }
                    });
                }
            } 
        });
    };
</script>