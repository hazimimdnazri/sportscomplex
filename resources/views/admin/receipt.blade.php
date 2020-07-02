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
								Jalan Sarjana, EduCity@Iskandar<br>
								79250 Iskandar Puteri, Johor<br>
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
				<td colspan="2" style="width: 45%; text-align: right">
					Price
				</td>
			</tr>
			<tr class="item">
				<td style="text-align: left">
					Membership
				</td>
				<td colspan="2" style="text-align: right">
					RM {{ number_format($transaction->total, 2) }}
				</td>
			</tr>
		</table>
		<table>
			<tr>
				<td style="width: 20%"></td>
				<td><hr></td>
			</tr>
			<tr>
				<td></td>
				<td><b>Sutotal :</b> RM {{ number_format($transaction->subtotal, 2) }}</td>
			</tr>
			<tr>
				<td></td>
				<td><b>Discount :</b> RM {{ number_format($transaction->membership_discount, 2) }}</td>
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