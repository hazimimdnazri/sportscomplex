<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>EduCity Sports Complex | Receipt</title>
        <link rel="stylesheet" href="{{ asset('css/receipt.css') }}">
        <link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body onload="window.print();">
        <div id="invoice-POS">
            <center id="top">
                <div class="logo"></div>
                <div class="info"> 
                    <h2>EduCity Sports Complex</h2>
                </div>
            </center>
        
            <div id="mid">
                <div class="info">
                    <h2>Contact Info</h2>
                    <p> 
                        Address : EduCity, 81550 Nusajaya, Johor</br>
                        Email   : educity@mail.com</br>
                        Phone   : +607-5095776</br>
                    </p>
                </div>
            </div>
        
            <div id="bot">
                <div id="table">
                    <table>
                        <tr class="tabletitle">
                            <td class="item"><h2>Item</h2></td>
                            @if(isset($activity))
                            <td class="Hours"><h2>Qty</h2></td>
                            @elseif(isset($facility))
                            <td class="Hours"><h2>Duration</h2></td>
                            @endif
                            <td class="Rate"><h2>Sub Total</h2></td>
                        </tr>
                        @foreach($facility as $f)
                        <tr class="service">
                            <td class="tableitem"><p class="itemtext">{{ $f->r_sport->sport }}</p></td>
                            <td class="tableitem"><p class="itemtext">{{ $f->duration }} Hours</p></td>
                            <td class="tableitem"><p class="itemtext">RM {{ number_format($f->price, 2) }}</p></td>
                        </tr>
                        @endforeach

                        <tr class="tabletitle">
                            <td></td>
                            <td class="Rate"><h2>Total</h2></td>
                            <td class="payment"><h2>RM {{ number_format($transaction->total,2) }}</h2></td>
                        </tr>
                        <tr class="tabletitle">
                            <td></td>
                            <td class="Rate"><h2>Paid</h2></td>
                            <td class="payment"><h2>RM {{ number_format($transaction->paid,2) }}</h2></td>
                        </tr>
                        <tr class="tabletitle">
                            <td></td>
                            <td class="Rate"><h2>Change</h2></td>
                            <td class="payment"><h2>RM {{ number_format($transaction->trans_changes,2) }}</h2></td>
                        </tr>
                    </table>
                </div>

                <div id="legalcopy">
                    <p class="legal"><strong>Thank you for your business!</strong>  Please keep this receipt as proof of payment, you may now proceed to the designated area.</p>
                </div>
            </div>
        </div>
    </body>
</html>

<script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script>
window.onafterprint = function(){
    $.ajax({
        type:"POST",
        url: "{{ url('admin/application/receipt/'.$id) }}",
        data: {
            "_token": "{{ csrf_token() }}"
        }
    }).done(function(response){
        if(response == 'success'){
            Swal.fire("Success!", "Receipt printed", "success")
            .then((result) => {
                if(result.value){
                    window.close();
                }
            })
        }
    });
}
</script>
