<?

$opdCreditCard = $_POST['opdCreditCard'];
$opdCash = $_POST['opdCash'];
$opdHMO = $_POST['opdHMO'];
$opdPHIC = $_POST['opdPHIC'];
$opdUnpaid = $_POST['opdUnpaid'];
$opdDiscount = $_POST['opdDiscount'];
$opdBalancePaid = $_POST['opdBalancePaid'];
$opd_pf_total = $_POST['opd_pf_total'];
$opd_ecg = $_POST['opd_ecg'];
$opd_xray = $_POST['opd_xray'];
$opd_ultrasound = $_POST['opd_ultrasound'];
$opd_erFee = $_POST['opd_erFee'];
$opd_ctscan = $_POST['opd_ctscan'];
$opd_laboratory = $_POST['opd_laboratory'];
$opd_medicine = $_POST['opd_medicine'];
$opd_supplies = $_POST['opd_supplies'];
$opd_spyrometry = $_POST['opd_spyrometry'];
$opd_derma = $_POST['opd_derma'];
$opd_others = $_POST['opd_others'];
$opd_OR = $_POST['opd_OR'];
$opd_PT = $_POST['opd_PT'];
$opd_OT = $_POST['opd_OT'];
$opd_ST = $_POST['opd_ST'];
$opd_cardiacMonitor = $_POST['opd_cardiacMonitor'];
$opd_PF_payable = $_POST['opd_PF_payable'];
$opd_misc = $_POST['opd_misc'];

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../../jquery-2.1.4.min.js"></script>
	<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
	<script src="../../bootstrap-3.3.6/js/bootstrap.js"></script>
</head>
<body>
	<div class="container">
		<h3>Transaction Summary</h3>
		<div class="col-md-5">
			<table class="table table-hover ">
				<thead>
					<tr>
						<th>Account Title</th>
						<th>Debit</th>
						<th>Credit</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Credit Card</td>
						<td><? ($opdCreditCard > 0) ? $x = number_format($opdCreditCard,2) : $x = ""; echo $x ?></td>
						<td></td>
					</tr>

					<tr>
						<td>Cash</td>
						<td><? ($opdCash > 0) ? $x = number_format($opdCash,2) : $x = ""; echo $x ?></td>
						<td></td>
					</tr>

					<tr>
						<td>A/R HMO</td>
						<td><? ( $opdHMO > 0 ) ? $x = number_format($opdHMO,2) : $x = ""; echo $x; ?></td>
						<td></td>
					</tr>

					<tr>
						<td>A/R PHILHEALTH</td>
						<td><? ( $opdPHIC > 0 ) ? $x = number_format($opdPHIC,2) : $x = ""; echo $x ?></td>
						<td></td>
					</tr>

					<tr>
						<td>A/R-OPD (Personal)</td>
						<td><? ($opdUnpaid > 0) ? $x = number_format($opdUnpaid,2) : $x = ""; echo $x; ?></td>
						<td></td>
					</tr>


					<tr>
						<td>Discount</td>
						<td><? ($opdDiscount > 0) ? $x = number_format($opdDiscount,2) : $x = ""; echo $x; ?></td>
						<td></td>
					</tr>

					<tr>
						<td>A/R-OPD (Paid)</td>
						<td></td>
						<td><? ( $opdBalancePaid > 0 ) ? $x = number_format($opdBalancePaid,2) : $x = ""; echo $x ?></td>
					</tr>

					<tr>
						<td>Clinic Revenue</td>
						<td></td>
						<td><? ($opd_pf_total > 0) ? $x = number_format($opd_pf_total,2) : $x = ""; echo $x ?></td>
					</tr>

					<tr>
						<td>OR</td>
						<td></td>
						<td><? ( $opd_OR > 0 ) ? $x = number_format($opd_OR,2) : $x = ""; echo $x ?></td>
					</tr>

					<tr>
						<td>ER FEE</td>
						<td></td>
						<td><? ( $opd_erFee > 0 ) ? $x = number_format($opd_erFee,2) : $x = ""; echo $x ?></td>
					</tr>

					<tr>
						<td>ECG</td>
						<td></td>
						<td><? ( $opd_ecg > 0 ) ? $x = number_format($opd_ecg,2) : $x = ""; echo $x ?></td>
					</tr>

					<tr>
						<td>SPYROMETRY</td>
						<td></td>
						<td><? ( $opd_spyrometry > 0 ) ? $x = number_format($opd_spyrometry,2) : $x = ""; echo $x ?></td>
					</tr>

					<tr>
						<td>XRAY</td>
						<td></td>
						<td><? ( $opd_xray > 0 ) ? $x = number_format($opd_xray,2) : $x = ""; echo $x ?></td>
					</tr>

					<tr>
						<td>Ultrasound</td>
						<td></td>
						<td><? ( $opd_ultrasound > 0 ) ? $x = number_format($opd_ultrasound,2) : $x = ""; echo $x ?></td>
					</tr>

					<tr>
						<td>CTSCAN</td>
						<td></td>
						<td><? ( $opd_ctscan > 0 ) ? $x = number_format($opd_ctscan,2) : $x = ""; echo $x ?></td>
					</tr>

					<tr>
						<td>Laboratory</td>
						<td></td>
						<td><? ( $opd_laboratory > 0 ) ? $x = number_format($opd_laboratory,2) : $x = ""; echo $x ?></td>
					</tr>

					<tr>
						<td>Medicine</td>
						<td></td>
						<td><? ( $opd_medicine > 0 ) ? $x = number_format($opd_medicine,2) : $x = ""; echo $x ?></td>
					</tr>

					<tr>
						<td>Supplies</td>
						<td></td>
						<td><? ( $opd_supplies > 0 ) ? $x = number_format($opd_supplies,2) : $x = ""; echo $x ?></td>
					</tr>

					<tr>
						<td>Miscellaneous</td>
						<td></td>
						<td><? ( $opd_misc > 0 ) ? $x = number_format($opd_misc,2) : $x = ""; echo $x ?></td>
					</tr>

					<tr>
						<td>Derma</td>
						<td></td>
						<td><? ( $opd_derma > 0 ) ? $x = number_format($opd_derma,2) : $x = ""; echo $x ?></td>
					</tr>

					<tr>
						<td>OTHERS</td>
						<td></td>
						<td><? ( $opd_others > 0 ) ? $x = number_format($opd_others,2) : $x = ""; echo $x ?></td>
					</tr>

					<tr>
						<td>PT</td>
						<td></td>
						<td><? ( $opd_PT > 0 ) ? $x = number_format($opd_PT,2) : $x = ""; echo $x ?></td>
					</tr>

					<tr>
						<td>OT</td>
						<td></td>
						<td><? ( $opd_OT > 0 ) ? $x = number_format($opd_OT,2) : $x = ""; echo $x ?></td>
					</tr>

					<tr>
						<td>ST</td>
						<td></td>
						<td><? ( $opd_ST > 0 ) ? $x = number_format($opd_ST,2) : $x = ""; echo $x ?></td>
					</tr>

					<tr>
						<td>Cardiac Monitor</td>
						<td></td>
						<td><? ( $opd_cardiacMonitor > 0 ) ? $x = number_format($opd_cardiacMonitor,2) : $x = ""; echo $x ?></td>
					</tr>

					<tr>
						<td>Payable-MD</td>
						<td></td>
						<td><? ($opd_PF_payable > 0) ? $x = number_format($opd_PF_payable,2) : $x = ""; echo $x ?></td>
					</tr>

					<tr>
						<td></td>
						<td><? echo number_format(( $opdCreditCard + $opdCash + $opdHMO + $opdPHIC + $opdUnpaid + $opdDiscount + $opd_PF_payable ),2) ?></td>
						<td><? echo number_format(( $opdBalancePaid + $opd_pf_total + $opd_OR + $opd_erFee + $opd_ecg + $opd_spyrometry + $opd_xray + $opd_ultrasound + $opd_ctscan + $opd_laboratory + $opd_medicine + $opd_supplies + $opd_misc + $opd_derma + $opd_others + $opd_PT + $opd_OT + $opd_ST + $opd_cardiacMonitor + $opd_PF_payable ),2) ?></td>
					</tr>

				</tbody>
			</table>
		</div>
	</div>
</body>
</html>