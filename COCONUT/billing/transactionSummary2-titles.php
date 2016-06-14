<?
include "../../myDatabase4.php";

$ro4 = new database4();

$opdCreditCard = $_GET['opdCreditCard'];
$opdCash = $_GET['opdCash'];
$opdHMO = $_GET['opdHMO'];
$opdPHIC = $_GET['opdPHIC'];
$opdUnpaid = $_GET['opdUnpaid'];
$opdDiscount = $_GET['opdDiscount'];
$opdBalancePaid = $_GET['opdBalancePaid'];
$opd_pf_total = $_GET['opd_pf_total'];
$opd_ecg = $_GET['opd_ecg'];
$opd_xray = $_GET['opd_xray'];
$opd_ultrasound = $_GET['opd_ultrasound'];
$opd_erFee = $_GET['opd_erFee'];
$opd_ctscan = $_GET['opd_ctscan'];
$opd_laboratory = $_GET['opd_laboratory'];
$opd_medicine = $_GET['opd_medicine'];
$opd_supplies = $_GET['opd_supplies'];
$opd_spyrometry = $_GET['opd_spyrometry'];
$opd_derma = $_GET['opd_derma'];
$opd_others = $_GET['opd_others'];
$opd_OR = $_GET['opd_OR'];
$opd_PT = $_GET['opd_PT'];
$opd_OT = $_GET['opd_OT'];
$opd_ST = $_GET['opd_ST'];
$opd_OT_payables = $_GET['opd_OT_payables'];
$opd_ST_payables = $_GET['opd_ST_payables'];
$opd_cardiacMonitor = $_GET['opd_cardiacMonitor'];
$opd_PF_payable = $_GET['opd_PF_payable'];
$opd_misc = $_GET['opd_misc'];


$ipd_laboratory = $_GET['ipd_laboratory'];
$ipd_xray = $_GET['ipd_xray'];
$ipd_ultrasound = $_GET['ipd_ultrasound'];
$ipd_ctscan = $_GET['ipd_ctscan'];
$ipd_ecg = $_GET['ipd_ecg'];
$ipd_erfee = $_GET['ipd_erfee'];
$ipd_or = $_GET['ipd_or'];
$ipd_misc = $_GET['ipd_misc'];
$ipd_spirometry = $_GET['ipd_spirometry'];
$ipd_medicine = $_GET['ipd_medicine'];
$ipd_supplies = $_GET['ipd_supplies'];
$ipd_pf = $_GET['ipd_pf'];
$ipd_room = $_GET['ipd_room'];
$ipd_cardiacMonitor = $_GET['ipd_cardiacMonitor'];
$ipd_PT = $_GET['ipd_PT'];
$ipd_OT = $_GET['ipd_OT'];
$ipd_ST = $_GET['ipd_ST'];
$ipd_others = $_GET['ipd_others'];

$ipd_deposit_cash = $_GET['ipd_deposit_cash'];
$ipd_deposit_creditCard = $_GET['ipd_deposit_creditCard'];
$ipd_deposit_total = ( $ipd_deposit_cash + $ipd_deposit_creditCard );
$ipd_balancePaid_cash = $_GET['ipd_balancePaid_cash'];
$ipd_balancePaid_creditCard = $_GET['ipd_balancePaid_creditCard'];
$ipd_balancePaid_total = ( $ipd_balancePaid_cash + $ipd_balancePaid_creditCard );
$ipd_discount = $_GET['ipd_discount'];
$ipd_hmo = $_GET['ipd_hmo'];
$ipd_phic = $_GET['ipd_phic'];
$ipd_cash = ($_GET['ipd_cash'] + $ipd_deposit_cash);
$ipd_grandCash = ($_GET['ipd_grandCash'] + $ipd_deposit_cash + $ipd_balancePaid_cash);
$ipd_creditCard = ($_GET['ipd_creditCard'] + $ipd_deposit_creditCard + $ipd_balancePaid_creditCard);
$ipd_balance = $_GET['ipd_balance'];
$ipd_refund = $_GET['ipd_refund'];
$ipd_excess = $_GET['ipd_excess'];

$date1 = $_GET['date1'];
$date2 = $_GET['date2'];

$ipd_balance1 = 0;
($ipd_balance < 0) ? $ipd_balance1 = 0 : $ipd_balance1 = $ipd_balance; 

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

	<style>
		@media print {
		  a[href]:after {
		    content: "";
		  }
		}		
	</style>

</head>
<body>
	<div class="container">
		<div class="row">
			<h3>Transaction Summary</h3>
			<Br>
			<h5><? echo $ro4->formatDate($date1)." - ".$ro4->formatDate($date2) ?></h5>
			<div class="col-xs-5">
				<h4>Outpatient</h4>
				<table class="table table-hover ">
					<thead>
						<tr>
							<th>Account Title</th>
							<th>Debit</th>
							<th>Credit</th>
						</tr>
					</thead>
					<tbody>

						<? if( $opdCreditCard > 0 ) { ?>
							<tr>
								<td><a href="transactionSummary_creditCard.php?date1=<? echo $date1 ?>&date2=<? echo $date2 ?>" style="color:black" target="_blank">Credit Card</a></td>
								<td><? ($opdCreditCard > 0) ? $x = number_format($opdCreditCard,2) : $x = ""; echo $x ?></td>
								<td></td>
							</tr>
						<? } ?>


						<? if( $opdCash > 0 ) { ?>
							<tr>
								<td><a href="transactionSummary_cash.php?date1=<? echo $date1 ?>&date2=<? echo $date2 ?>" style="color:black" target="_blank">Cash</td>
								<td><? ($opdCash > 0) ? $x = number_format($opdCash,2) : $x = ""; echo $x ?></td>
								<td></td>
							</tr>
						<? } ?>

						<? if( $opdHMO > 0 ) { ?>
							<tr>
								<td><a href="transactionSummary_hmo.php?date1=<? echo $date1 ?>&date2=<? echo $date2 ?>" style="color:black" target="_blank">A/R HMO</a></td>
								<td><? ( $opdHMO > 0 ) ? $x = number_format($opdHMO,2) : $x = ""; echo $x; ?></td>
								<td></td>
							</tr>
						<? } ?>

						<? if( $opdPHIC > 0 ) { ?>
							<tr>
								<td><a href="transactionSummary_phic.php?date1=<? echo $date1 ?>&date2=<? echo $date2 ?>" style="color:black" target="_blank">A/R PHILHEALTH</a></td>
								<td><? ( $opdPHIC > 0 ) ? $x = number_format($opdPHIC,2) : $x = ""; echo $x ?></td>
								<td></td>
							</tr>
						<? } ?>

						<? if( $opdUnpaid > 0 ) { ?>
							<tr>
								<td><a href="transactionSummary_personalBalance.php?date1=<? echo $date1 ?>&date2=<? echo $date2 ?>" style="color:black" target="_blank">A/R-OPD (Personal)</a></td>
								<td><? ($opdUnpaid > 0) ? $x = number_format($opdUnpaid,2) : $x = ""; echo $x; ?></td>
								<td></td>
							</tr>
						<? } ?>

						<? if( $opdDiscount > 0 ) { ?>
							<tr>
								<td><a href="transactionSummary_disc.php?date1=<? echo $date1 ?>&date2=<? echo $date2 ?>" style="color:black" target="_blank">Discount</a></td>
								<td><? ($opdDiscount > 0) ? $x = number_format($opdDiscount,2) : $x = ""; echo $x; ?></td>
								<td></td>
							</tr>
						<? } ?>

						<? if( $opdBalancePaid > 0 ) { ?>
							<tr>
								<td>A/R-OPD (Paid)</td>
								<td></td>
								<td><? ( $opdBalancePaid > 0 ) ? $x = number_format($opdBalancePaid,2) : $x = ""; echo $x ?></td>
							</tr>
						<? } ?>


						<? if( $opd_pf_total > 0 ) { ?>
							<tr>
								<td>Clinic Revenue</td>
								<td></td>
								<td><? ($opd_pf_total > 0) ? $x = number_format($opd_pf_total,2) : $x = ""; echo $x ?></td>
							</tr>
						<? } ?>


						<? if( $opd_OR > 0 ) { ?>
							<tr>
								<td>OR</td>
								<td></td>
								<td><? ( $opd_OR > 0 ) ? $x = number_format($opd_OR,2) : $x = ""; echo $x ?></td>
							</tr>
						<? } ?>


						<? if( $opd_erFee > 0 ) { ?>
							<tr>
								<td>ER FEE</td>
								<td></td>
								<td><? ( $opd_erFee > 0 ) ? $x = number_format($opd_erFee,2) : $x = ""; echo $x ?></td>
							</tr>
						<? } ?>


						<? if( $opd_ecg > 0 ) { ?>
							<tr>
								<td>ECG</td>
								<td></td>
								<td><? ( $opd_ecg > 0 ) ? $x = number_format($opd_ecg,2) : $x = ""; echo $x ?></td>
							</tr>
						<? } ?>


						<? if( $opd_spyrometry > 0 ) { ?>
							<tr>
								<td>SPYROMETRY</td>
								<td></td>
								<td><? ( $opd_spyrometry > 0 ) ? $x = number_format($opd_spyrometry,2) : $x = ""; echo $x ?></td>
							</tr>
						<? } ?>


						<? if( $opd_xray > 0 ) { ?>
							<tr>
								<td>XRAY</td>
								<td></td>
								<td><? ( $opd_xray > 0 ) ? $x = number_format($opd_xray,2) : $x = ""; echo $x ?></td>
							</tr>
						<? } ?>


						<? if( $opd_ultrasound > 0 ) { ?>
							<tr>
								<td>Ultrasound</td>
								<td></td>
								<td><? ( $opd_ultrasound > 0 ) ? $x = number_format($opd_ultrasound,2) : $x = ""; echo $x ?></td>
							</tr>
						<? } ?>


						<? if( $opd_ctscan > 0 ) { ?>
							<tr>
								<td>CTSCAN</td>
								<td></td>
								<td><? ( $opd_ctscan > 0 ) ? $x = number_format($opd_ctscan,2) : $x = ""; echo $x ?></td>
							</tr>
						<? } ?>


						<? if( $opd_laboratory > 0 ) { ?>
							<tr>
								<td>Laboratory</td>
								<td></td>
								<td><? ( $opd_laboratory > 0 ) ? $x = number_format($opd_laboratory,2) : $x = ""; echo $x ?></td>
							</tr>
						<? } ?>


						<? if(  $opd_medicine > 0) { ?>
							<tr>
								<td>Medicine</td>
								<td></td>
								<td><? ( $opd_medicine > 0 ) ? $x = number_format($opd_medicine,2) : $x = ""; echo $x ?></td>
							</tr>
						<? } ?>


						<? if( $opd_supplies > 0 ) { ?>
							<tr>
								<td>Supplies</td>
								<td></td>
								<td><? ( $opd_supplies > 0 ) ? $x = number_format($opd_supplies,2) : $x = ""; echo $x ?></td>
							</tr>
						<? } ?>


						<? if( $opd_misc > 0 ) { ?>
							<tr>
								<td>Miscellaneous</td>
								<td></td>
								<td><? ( $opd_misc > 0 ) ? $x = number_format($opd_misc,2) : $x = ""; echo $x ?></td>
							</tr>
						<? } ?>


						<? if( $opd_derma > 0 ) { ?>
							<tr>
								<td>Derma</td>
								<td></td>
								<td><? ( $opd_derma > 0 ) ? $x = number_format($opd_derma,2) : $x = ""; echo $x ?></td>
							</tr>
						<? } ?>


						<? if( $opd_others > 0 ) { ?>
							<tr>
								<td>OTHERS</td>
								<td></td>
								<td><? ( $opd_others > 0 ) ? $x = number_format($opd_others,2) : $x = ""; echo $x ?></td>
							</tr>
						<? } ?>


						<? if( $opd_PT > 0 ) { ?>
						<tr>
							<td>PT</td>
							<td></td>
							<td><? ( $opd_PT > 0 ) ? $x = number_format($opd_PT,2) : $x = ""; echo $x ?></td>
						</tr>
						<? } ?>


						<? if( ( $opd_OT - $opd_OT_payables ) > 0 ) { ?>
							<tr>
								<td>OT</td>
								<td></td>
								<td>
									<? 
										$otTotal = ( $opd_OT - $opd_OT_payables );
										( $otTotal > 0 ) ? $x = number_format($otTotal,2) : $x = ""; echo $x 

									?>
								</td>
							</tr>
						<? }else { $otTotal = 0; } ?>



						<? if( ( $opd_ST - $opd_ST_payables ) > 0 ) { ?>
							<tr>
								<td>ST</td>
								<td></td>
								<td>
									<? 
										$stTotal = ( $opd_ST - $opd_ST_payables );
										( $stTotal > 0 ) ? $x = number_format(($stTotal),2) : $x = ""; echo $x 
									?>
								</td>
							</tr>
						<? }else { $stTotal = 0; } ?>


						<? if( $opd_cardiacMonitor > 0 ) { ?>
							<tr>
								<td>Cardiac Monitor</td>
								<td></td>
								<td><? ( $opd_cardiacMonitor > 0 ) ? $x = number_format($opd_cardiacMonitor,2) : $x = ""; echo $x ?></td>
							</tr>
						<? } ?>


						<? if( ( $opd_PF_payable + $opd_OT_payables + $opd_ST_payables ) > 0 ) { ?>
							<tr>
								<td>Payable-MD</td>
								<td></td>
								<td>
									<? 
										$payableTotal = ( $opd_PF_payable + $opd_OT_payables + $opd_ST_payables );
										($payableTotal > 0) ? $x = number_format($payableTotal,2) : $x = ""; echo $x 
									?>
								</td>
							</tr>
						<? }else { $payableTotal = 0; } ?>

						<tr>
							<td></td>
							<td>
								<? 
									$opdDebit = ( $opdCreditCard + $opdCash + $opdHMO + $opdPHIC + $opdUnpaid + $opdDiscount + $opd_PF_payable);
									echo number_format($opdDebit,2); 
								?>
							</td>
							<td>
								<? 

									$opdCredit = ( $opdBalancePaid + $opd_pf_total + $opd_OR + $opd_erFee + $opd_ecg + $opd_spyrometry + $opd_xray + $opd_ultrasound + $opd_ctscan + $opd_laboratory + $opd_medicine + $opd_supplies + $opd_misc + $opd_derma + $opd_cardiacMonitor + $opd_others + $opd_PT + $otTotal + $stTotal  + $payableTotal );
									echo number_format($opdCredit,2); 
								?>
							</td>
						</tr>

					</tbody>
				</table>
			</div>

			<div class="col-xs-2">
				
			</div>

			<div class="col-xs-5">
				<h4>Inpatient</h4>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Account Title</th>
							<th>Debit</th>
							<th>Credit</th>
						</tr>
					</thead>
					<tbody>

						<? if( $ipd_creditCard > 0 ) { ?>
							<tr>
								<td><a href="transactionSummary_ipdPayments.php?date1=<? echo $date1 ?>&date2=<? echo $date2 ?>&payment=Credit Card" style="color:black" target="_blank">Credit Card</a></td>
								<td><? ($ipd_creditCard > 0) ? $x = number_format($ipd_creditCard,2) : $x = ""; echo $x; ?></td>
								<td></td>
							</tr>
						<? } ?>


						<? if( $ipd_cash > 0 ) { ?>
							<tr>
								<td><a href="transactionSummary_ipdPayments.php?date1=<? echo $date1 ?>&date2=<? echo $date2 ?>&payment=Cash" style="color:black" target="_blank">Cash</a></td>
								<td><? ($ipd_grandCash > 0) ? $x = number_format($ipd_grandCash,2) : $x = ""; echo $x; ?></td>
								<td></td>
							</tr>
						<? } ?>


						<? if( $ipd_hmo > 0 ) { ?>
							<tr>
								<td><a href="transactionSummary_ipdHMO.php?date1=<? echo $date1 ?>&date2=<? echo $date2 ?>" style="color:black" target="_blank">A/R HMO</a></td>
								<td><? ( $ipd_hmo > 0 ) ? $x = number_format($ipd_hmo,2) : $x = ""; echo $x; ?></td>
								<td></td>
							</tr>
						<? } ?>


						<? if( $ipd_phic > 0 ) { ?>
							<tr>
								<td><a href="transactionSummary_ipdPHIC.php?date1=<? echo $date1 ?>&date2=<? echo $date2 ?>" style="color:black" target="_blank">A/R PHILHEALTH</a></td>
								<td><? ( $ipd_phic > 0 ) ? $x = number_format($ipd_phic,2) : $x = ""; echo $x; ?></td>
								<td></td>
							</tr>
						<? } ?>

						<? if( $ipd_balance > 0 ) { ?>
							<tr>
								<td><a href="transactionSummary_ipdBalance.php?date1=<? echo $date1 ?>&date2=<? echo $date2 ?>" style="color:black" target="_blank">A/R-IPD(Personal)</a></td>
								<td><? ($ipd_balance > 0) ? $x = number_format($ipd_balance,2) : $x = ""; echo $x; ?></td>
								<td></td>
							</tr>
						<? } ?>


						<? if( $ipd_discount > 0 ) { ?>
						<tr>
							<td><a href="transactionSummary_ipdDiscount.php?date1=<? echo $date1 ?>&date2=<? echo $date2 ?>" style="color:black" target="_blank">Discount</a></td>
							<td><? ( $ipd_discount > 0 ) ? $x = number_format($ipd_discount,2) : $x = ""; echo $x; ?></td>
							<td></td>
						</tr>
						<? } ?>
						
						<? if( $ipd_refund > 0 ) { ?>
							<tr>
								<td><a href="transactionSummary_ipdRefund.php?date1=<? echo $date1 ?>&date2=<? echo $date2 ?>" style="color:black" target="_blank">Refund</a></td>
								<td><? ( $ipd_refund > 0 ) ? $x = number_format($ipd_refund,2) : $x = ""; echo $x; ?></td>
								<td></td>
							</tr>
						<? } ?>
						
						<? if( $ipd_balancePaid_total > 0 ) { ?>
							<tr>
								<td>A/R-OPD (Paid)</td>
								<td></td>
								<td><? ( $ipd_balancePaid_total > 0 ) ? $x = number_format($ipd_balancePaid_total,2) : $x = ""; echo $x ?></td>
							</tr>
						<? } ?>						

						<? if( $ipd_pf > 0 ) { ?>
							<tr>
								<td>Clinic Revenue</td>
								<td></td>
								<td><? ($ipd_pf > 0) ? $x = number_format($ipd_pf,2) : $x = ""; echo $x; ?></td>
							</tr>
						<? } ?>



						<? if( $ipd_or > 0 ) { ?>
							<tr>
								<td>OR</td>
								<td></td>
								<td><? ($ipd_or > 0) ? $x = number_format($ipd_or,2) : $x = ""; echo $x; ?></td>
							</tr>
						<? } ?>

						<? if( $ipd_misc > 0 ) { ?>
							<tr>
								<td>Miscellaneous</td>
								<td></td>
								<td><? ($ipd_misc > 0) ? $x = number_format($ipd_misc,2) : $x = ""; echo $x; ?></td>
							</tr>
						<? } ?>


						<? if( $ipd_erfee > 0 ) { ?>
						<tr>
							<td>ER Fee</td>
							<td></td>
							<td><? ($ipd_erfee > 0) ? $x = number_format($ipd_erfee,2) : $x = ""; echo $x; ?></td>
						</tr>
						<? } ?>


						<? if( $ipd_room > 0 ) { ?>
							<tr>
								<td>Room</td>
								<Td></Td>
								<td><? ($ipd_room > 0) ? $x = number_format($ipd_room,2) : $x = ""; echo $x; ?></td>
							</tr>
						<? } ?>


						<? if( $ipd_ecg > 0 ) { ?>
							<tr>
								<td>ECG</td>
								<td></td>
								<td><? ($ipd_ecg > 0) ? $x = number_format($ipd_ecg,2) : $x = ""; echo $x; ?></td>
							</tr>
						<? } ?>


						<? if( $ipd_PT > 0 ) { ?>
							<tr>
								<td>PT</td>
								<td></td>
								<td><? ($ipd_PT > 0) ? $x = number_format($ipd_PT,2) : $x = ""; echo $x; ?></td>
							</tr>
						<? } ?>


						<? if( $ipd_OT > 0 ) { ?>
							<tr>
								<td>OT</td>
								<td></td>
								<td><? ($ipd_OT > 0) ? $x = number_format($ipd_OT,2) : $x = ""; echo $x; ?></td>
							</tr>
						<? } ?>


						<? if( $ipd_ST > 0 ) { ?>
							<tr>
								<td>ST</td>
								<td></td>
								<td><? ($ipd_ST > 0) ? $x = number_format($ipd_ST,2) : $x = ""; echo $x; ?></td>
							</tr>
						<? } ?>


						<? if( $ipd_xray > 0 ) { ?>
							<tr>
								<td>XRAY</td>
								<td></td>
								<td><? ($ipd_xray > 0) ? $x = number_format($ipd_xray,2) : $x = ""; echo $x; ?></td>
							</tr>
						<? } ?>


						<? if( $ipd_ultrasound > 0 ) { ?>
							<tr>
								<td>ULTRASOUND</td>
								<td></td>
								<td><? ($ipd_ultrasound > 0) ? $x = number_format($ipd_ultrasound,2) : $x = ""; echo $x; ?></td>
							</tr>
						<? } ?>


						<? if( $ipd_ctscan > 0 ) { ?>
							<tr>
								<td>CTSCAN</td>
								<td></td>
								<td><? ($ipd_ctscan > 0) ? $x = number_format($ipd_ctscan,2) : $x = ""; echo $x; ?></td>
							</tr>
						<? } ?>


						<? if( $ipd_laboratory > 0 ) { ?>
							<tr>
								<td>Laboratory</td>
								<td></td>
								<td><? ($ipd_laboratory > 0) ? $x = number_format($ipd_laboratory,2) : $x =""; echo $x ?></td>
							</tr>
						<? } ?>


						<? if( $ipd_medicine > 0 ) { ?>
							<tr>
								<td>Medicine</td>
								<td></td>
								<td><? ($ipd_medicine > 0) ? $x = number_format($ipd_medicine,2) : $x = ""; echo $x; ?></td>
							</tr>
						<? } ?>


						<? if( $ipd_supplies > 0 ) { ?>
							<tr>
								<td>Supplies</td>
								<td></td>
								<td><? ($ipd_supplies > 0) ? $x = number_format($ipd_supplies,2) : $x = ""; echo $x; ?></td>
							</tr>
						<? } ?>


						<? if( $ipd_spirometry > 0 ) { ?>
							<tr>
								<td>SPYROMETRY</td>
								<td></td>
								<td><? ($ipd_spirometry > 0) ? $x = number_format($ipd_spirometry,2) : $x = ""; echo $x; ?></td>
							</tr>
						<? } ?>


						<? if( $ipd_cardiacMonitor > 0 ) { ?>
							<tr>
								<td>Cardiac Monitor</td>
								<td></td>
								<td><? ($ipd_cardiacMonitor > 0) ? $x = number_format($ipd_cardiacMonitor,2) : $x = ""; echo $x ?></td>
							</tr>
						<? } ?>


						<? if( $ipd_others > 0 ) { ?>
							<tr>
								<td>Others</td>
								<td></td>
								<td><? ($ipd_others > 0) ? $x = number_format($ipd_others,2) : $x = ""; echo $x; ?></td>
							</tr>
						<? } ?>


						<? if( $ipd_refund > 0 ) { ?>
							<tr>
								<td>Cash</td>
								<td></td>
								<td><? ( $ipd_refund > 0 ) ? $x = number_format($ipd_refund,2) : $x = ""; echo $x; ?></td>
							</tr>
						<? } ?>


						<? if( $ipd_excess > 0 ) { ?>
							<tr>
								<td>Excess Payment</td>
								<td></td>
								<td><? ($ipd_excess > 0) ? $x = number_format($ipd_excess,2) : $x = ""; echo $x; ?></td>
							</tr>
						<? } ?>


						<? if( $ipd_deposit_total > 0 ) { ?>
							<tr>
								<td>Deposit</td>
								<td></td>
								<td><? ($ipd_deposit_total > 0) ? $x = number_format($ipd_deposit_total,2) : $x = ""; echo $x; ?></td>
							</tr>
						<? } ?>

						<tr>
							<td></td>
							<!--
							<td><? echo number_format(( $ipd_cash + $ipd_creditCard + $ipd_hmo + $ipd_phic + $ipd_balance + $ipd_discount ),2); ?></td>
							-->
							<td>
								<? 
									$ipdDebit = ( $ipd_grandCash + $ipd_creditCard + $ipd_hmo + $ipd_phic + $ipd_balance1 + $ipd_discount + $ipd_refund);
									echo number_format($ipdDebit,2);
								?>
							</td>
							<td>
								<? 
									$ipdCredit = ( $ipd_pf + $ipd_or + $ipd_misc + $ipd_erfee + $ipd_room + $ipd_ecg + $ipd_PT + $ipd_OT + $ipd_ST + $ipd_xray + $ipd_ultrasound + $ipd_ctscan + $ipd_laboratory + $ipd_medicine + $ipd_supplies + $ipd_spirometry + $ipd_cardiacMonitor + $ipd_others + $ipd_excess + $ipd_deposit_total + $ipd_refund + $ipd_balancePaid_total ); 
									echo number_format($ipdCredit,2);
								?>
							</td>
						</tr>

					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-5">
				<h5>OPD:&nbsp;<? echo number_format($opdDebit,2) ?></h5>
				<h5>IPD:&nbsp;<? echo number_format($ipdDebit,2) ?></h5>
				<h5>Total:&nbsp;<? echo number_format($opdDebit + $ipdDebit,2) ?></h5>
			</div>
		</div>
	</div>
</body>
</html>