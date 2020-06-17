<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/receipt.css') }}">
	<title>EduCity Sports Complex | Receipt</title>
</head>

<body>
	<div class="invoice-box">
        <center><img src="{{getcwd()}}/assets/images/logo.jpg"></center>
		<table cellpadding="0" cellspacing="0">
			<tr class="top">
				<td colspan="3">
					<table width="100%">
						<tr>
							<td style="text-align: center;">
								EduCity Sports Complex<br><br>
								EduCity, 81550 Nusajaya, Johor<br>
								educity@mail.com<br>
								+607-5095776
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr class="heading">
				<td>
					Info
				</td>
				<td colspan="2">
					Detail
				</td>
			</tr>
			<tr class="">
				<td>
					Transaction #
				</td>
				<td colspan="2">
					{{ $transaction->id }}
				</td>
			</tr>
			<tr class="">
				<td>
					Date
				</td>
				<td colspan="2">
					{{ date('d/m/Y') }}
				</td>
			</tr>
			<tr class="">
				<td>
					Time
				</td>
				<td colspan="2">
					{{ date('H:i:s') }}
				</td>
			</tr>
			<tr class="details">
				<td>
					Cashier
				</td>
				<td colspan="2">
					{{ Auth::user()->name }}
				</td>
			</tr>
			<tr class="heading">
				<td style="width: 45%; text-align: left">
					Item
				</td>
				@if(isset($facility))
				<td style="width: 10%; text-align: center">
					Duration (Hours)
				</td>
				@elseif(isset($activity))
				<td style="width: 10%; text-align: center">
					Quantity
				</td>
				@endif
				<td style="width: 45%; text-align: right">
					Price
				</td>
			</tr>
			@foreach($facility as $f)
			<tr class="item">
				<td style="text-align: left">
					{{ $f->r_sport->sport }}
				</td>
				<td style="text-align: center">
					{{ $f->duration }}
				</td>
				<td style="text-align: right">
					RM {{ number_format($f->price, 2) }}
				</td>
			</tr>
			@endforeach
		</table>
		<table>
			<tr>
				<td style="width: 40%"></td>
				<td><hr></td>
			</tr>
			<tr>
				<td></td>
				<td><b>Total :</b> RM {{ number_format($transaction->total, 2) }}</td>
			</tr>
			<tr>
				<td></td>
				<td><b>Paid :</b> RM {{ number_format($transaction->paid, 2) }}</td>
			</tr>
			<tr>
				<td></td>
				<td><b>Change :</b> RM {{ number_format($transaction->trans_changes, 2) }}</td>
			</tr>
			<tr>
				<td></td>
				<td><hr></td>
			</tr>
		</table>
		<div id="legalcopy">
			<p>Please keep this receipt as a proof of payment, you may now proceed to the designated area.</p>
		</div>
	</div>
</body>

</html>