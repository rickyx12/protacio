<?php
include "../../myDatabase2.php";
include "../../myDatabase4.php";
$balanceHandler = $_GET['balanceHandler']; //format: registrationNo-balance
$deposit_cash = $_GET['deposit_cash'];
$deposit_creditCard = $_GET['deposit_creditCard'];

$date1 = $_GET['date1'];
$date2 = $_GET['date2'];

//OPD VARIABLES
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
$opd_cardiacMonitor = $_GET['opd_cardiacMonitor'];
$opd_PF_payable = $_GET['opd_PF_payable'];
$opd_misc = $_GET['opd_misc'];
$opd_OT_payables = $_GET['opd_OT_payables'];
$opd_ST_payables = $_GET['opd_ST_payables'];

$ro2 = new database2();
$ro4 = new database4();
$lab;			$labTotal = 0;
$xray;			$xrayTotal = 0;
$utz;			$utzTotal = 0;
$ctscan;		$ctscanTotal = 0;
$ecg;			$ecgTotal = 0;
$erfee;			$erfeeTotal = 0;
$or;			$orTotal = 0;
$misc;			$miscTotal = 0;
$spirometry;	$spirometryTotal = 0;
$meds;			$medsTotal = 0;
$supp;			$suppTotal = 0;
$pf;			$pfTotal = 0;
$room;			$roomTotal = 0;
$cardiac;		$cardiacTotal = 0;
$pt;			$ptTotal = 0;
$ot;			$otTotal = 0;
$st;			$stTotal = 0;
$others;		$othersTotal = 0;
$hmoExcess;		$hmoExcessTotal = 0;
$total;			$grandTotal=0;

$disc;			$discTotal = 0;
$hmo;			$hmoTotal = 0;
$phic;			$phicTotal = 0;
$unpaid;		$unpaidTotal = 0;
$paid;			$paidTotal = 0;
$bal;			$balTotal = 0;
$cash;			$cashTotal = 0;
$creditCard;	$creditCardTotal = 0;
$excess; 		$excessTotal = 0;
$phicPortion;   $phicPortionTotal = 0;

$customTitle; $customTitleTotal = 0;


?>

<doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="../../jquery-2.1.4.min.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<script src="../../bootstrap-3.3.6/js/bootstrap.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="row">

					<div class="col-md-12">
						<h4><i class="glyphicon glyphicon-ok"></i>  ( Total Charges = ( HMO + PHIC + UNPAID ) )</h4>			
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Reg#</th>
									<th>Lab</th>
									<th>XRAY</th>
									<th>UTZ</th>
									<th>CTSCAN</th>
									<th>ECG</th>
									<th>ER FEE</th>
									<th>OR</th>
									<th>Misc</th>
									<th>SPYRO</th>
									<th>Meds</th>
									<th>Supp</th>
									<th>PF</th>
									<th>Room</th>
									<th>Cardiac</th>
									<th>PT</th>
									<th>OT</th>
									<th>ST</th>
									<th>Others</th>
									<th>HMO Excess</th>
									<th>PHIC Portion</th>
									<th>Custom Title</th>
									<th>Total Charges</th>
									<th>&nbsp;</th>
									<th>&nbsp;</th>
									<th>&nbsp;</th>
									<th>Disc</th>
									<th>HMO</th>
									<th>PHIC</th>
									<th>UNPD</th>
									<th>Cash</th>
									<th>C.Card</th>
									<th>BAL</th>
									<th>Excess</th>
								</tr>
							</thead>
							<tbody>
									<?
									for($x=0;$x<count($balanceHandler);$x++) {
										$balanceHandler1 = preg_split ("/\-/", $balanceHandler[$x]); 
										$registrationNo = $balanceHandler1[0];
									?>
										<tr>
											<td><? echo $registrationNo ?></td>
											<td> <? $lab = $ro4->inpatient_title_total($registrationNo,"total","LABORATORY"); echo $lab; $labTotal += $lab ?> </td>
											<td> <? $xray = $ro4->inpatient_title_total($registrationNo,"total","XRAY"); echo $xray; $xrayTotal += $xray; ?> </td>
											<td> <? $utz = $ro4->inpatient_title_total($registrationNo,"total","ULTRASOUND"); echo $utz; $utzTotal += $utz; ?> </td>
											<td> <? $ctscan = $ro4->inpatient_title_total($registrationNo,"total","CTSCAN"); echo $ctscan; $ctscanTotal += $ctscan; ?> </td>
											<td> <? $ecg = $ro4->inpatient_title_total($registrationNo,"total","ECG"); echo $ecg; $ecgTotal += $ecg; ?> </td>
											<td> <? $erfee = $ro4->inpatient_title_total($registrationNo,"total","ER FEE"); echo $erfee; $erfeeTotal += $erfee; ?> </td>
											<td> <? $or = $ro4->inpatient_title_total($registrationNo,"total","OR/DR/ER Fee"); echo $or; $orTotal += $or ?> </td>
											<td> <? $misc = $ro4->inpatient_title_total($registrationNo,"total","MISCELLANEOUS"); echo $misc; $miscTotal += $misc; ?> </td>
											<td> <? $spirometry = $ro4->inpatient_title_total($registrationNo,"total","SPIROMETRY"); echo $spirometry; $spirometryTotal += $spirometry; ?> </td>
											<td> <? $meds = round($ro4->inpatient_title_total($registrationNo,"total","MEDICINE"),2); echo $meds; $medsTotal += $meds; ?> </td>
											<td> <? $supp = $ro4->inpatient_title_total($registrationNo,"total","SUPPLIES"); echo $supp; $suppTotal += $supp; ?> </td>
											<td> <? $pf = ($ro4->inpatient_title_total($registrationNo,"total","PROFESSIONAL FEE") + $ro2->selectNow("registrationDetails","excessPF","registrationNo",$registrationNo)); echo $pf; $pfTotal += $pf; ?> </td>
											<td> <? $room = ($ro4->inpatient_title_total($registrationNo,"total","Room and Board") + $ro2->selectNow("registrationDetails","excessRoom","registrationNo",$registrationNo)); echo $room; $roomTotal += $room; ?> </td>
											<td> <? $cardiac = $ro4->inpatient_title_total($registrationNo,"total","CARDIAC MONITOR"); echo $cardiac; $cardiacTotal += $cardiac; ?> </td>
											<td> 
												<? $pt = $ro4->inpatient_title_total($registrationNo,"total","PT"); echo $pt; $ptTotal += $pt;  ?> 
											</td>
											<td> <? $ot = $ro4->inpatient_title_total($registrationNo,"total","OT"); echo $ot; $otTotal += $ot; ?> </td>
											<td> <? $st = $ro4->inpatient_title_total($registrationNo,"total","ST"); echo $st; $stTotal += $stTotal; ?> </td>
											<td> <? $others = $ro4->inpatient_title_total($registrationNo,"total","OTHERS"); echo $others; $othersTotal += $others; ?> </td>
											<td> 
												<? 
													$hmoExcess = $ro2->selectNow("registrationDetails","excessMaxBenefits","registrationNo",$registrationNo); 
													echo $hmoExcess; 
													$hmoExcessTotal += $hmoExcess; 
												?> 
											</td>

											<td>
												<?
													$phicPortion = $ro2->selectNow("registrationDetails","PHICportion","registrationNo",$registrationNo); 
													echo $phicPortion; 
													$phicPortionTotal += $phicPortion;
												?>
											</td>

											<td>
												<?
													$customTitle = $ro2->selectNow("registrationDetails","hmoManualExcessValue","registrationNo",$registrationNo);
													echo $customTitle;
													$customTitleTotal += $customTitle;
												?>
											</td>

											<td>
												<?
													 $total = ( $lab + $xray + $utz + $ctscan + $ecg + $erfee + $or + $misc + $spirometry + $meds + $supp + $pf + $room + $cardiac + $pt + $ot + $st + $others + $hmoExcess + $phicPortion + $customTitle ); echo $total; $grandTotal += $total; 
												?>
											</td>

											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>
												<? 
													$disc = round($ro2->selectNow("registrationDetails","discount","registrationNo",$registrationNo),2); echo $disc; $discTotal += $disc; 
												?>
											</td>

											<td>
												<? 
													$hmo = round($ro4->inpatient_paymentMode_total($registrationNo,"company"),2); echo $hmo; $hmoTotal += $hmo; 
												?>
											</td>

											<td>
												<? 
													$phic = round($ro4->inpatient_paymentMode_total($registrationNo,"phic"),2); 
													echo $phic; 
													$phicTotal += $phic;  
												?>
											</td>

											<td>
												<? 
													$unpaid = round($ro4->inpatient_paymentMode_total($registrationNo,"cashUnpaid") + $hmoExcess + $phicPortion + $customTitle + $ro2->selectNow("registrationDetails","excessRoom","registrationNo",$registrationNo) + $ro2->selectNow("registrationDetails","excessPF","registrationNo",$registrationNo),2); 
													echo $unpaid; 
													$unpaidTotal += $unpaid; 
												?>
											</td>


											<td>
												<? 
													$cash = ($ro4->inpatient_payment_total($registrationNo,"CASH")); 
													echo $cash; 
													$cashTotal += $cash; 
												?>
											</td>

											<td>
												<? 
													$creditCard = $ro4->inpatient_payment_total($registrationNo,"Credit Card"); 
													echo $creditCard; 
													$creditCardTotal += $creditCard 
												?>
											</td>

											<td>
												<? $bal = round(( round($unpaid,2) - round($cash + $creditCard + $disc ,2) ),2); echo $bal; 

													if( $bal > 0 ) {
														$balTotal += $bal;
													}else {
														//kpg negative wag n isama sa total kc meron nman syang kabanggang account na excess payment
													}

												 ?>
											 </td>

											<td>
												<? 

													if( $bal < 0 ) {
														$excess = abs($bal); echo $excess; $excessTotal += $excess;
													}else {
														
													}

												?>
											</td>
											<?

												$paymentMode_total = round( $hmo + $phic + $unpaid,2);
												$total1 = round($total,2);
												if( $total1 != $paymentMode_total ) {
											?>
												<td><a href="../patientProfile/SOAoption/newSOA/detailedTotalOnly_update.php?registrationNo=<? echo $registrationNo ?>&username=1212&show=try&chargesCode=off&showdate=1" target="_blank"><i class="glyphicon glyphicon-remove"></i></a></td>
											<?}else {?>
												<td><a href="../patientProfile/SOAoption/newSOA/detailedTotalOnly_update.php?registrationNo=<? echo $registrationNo ?>&username=1212&show=try&chargesCode=off&showdate=1" target="_blank"><i class="glyphicon glyphicon-ok"></i></a></td>
											<? } ?>
										</tr>

									<? } ?>
							</tbody>
							<tbody>
								<td></td>
								<td><? echo $labTotal ?></td>
								<td><? echo $xrayTotal ?></td>
								<td><? echo $utzTotal ?></td>
								<td><? echo $ctscanTotal ?></td>
								<td><? echo $ecgTotal ?></td>
								<td><? echo $erfeeTotal ?></td>
								<td><? echo $orTotal ?></td>
								<td><? echo $miscTotal ?></td>
								<td><? echo $spirometryTotal ?></td>
								<td><? echo $medsTotal ?></td>
								<td><? echo $suppTotal ?></td>
								<td><? echo $pfTotal ?></td>
								<td><? echo $roomTotal ?></td>
								<td><? echo $cardiacTotal ?></td>
								<td><? echo $ptTotal ?></td>
								<td><? echo $otTotal ?></td>
								<td><? echo $stTotal ?></td>
								<td><? echo $othersTotal ?></td>
								<td><? echo $hmoExcessTotal ?></td>
								<td><? echo $phicPortionTotal ?></td>
								<td><? echo $customTitleTotal ?></td>
								<td><? echo $grandTotal ?></td>
								<td></td>
								<td></td>
								<td></td>
								<td><? echo $discTotal ?></td>
								<td><? echo $hmoTotal ?></td>
								<td><? echo $phicTotal ?></td>
								<td><? echo $unpaidTotal ?></td>
								<td><? echo $cashTotal ?></td>
								<td><? echo $creditCardTotal ?></td>
								<td><? echo $balTotal ?></td>
								<td><? echo $excessTotal ?></td>

								<?

								$paymentMode_total1 = round( $hmoTotal + $phicTotal + $unpaidTotal );
								$grandTotal1 = round($grandTotal);

								if( $paymentMode_total1 != $grandTotal1 ) {
								?>
									<td><i class="glyphicon glyphicon-remove"></i></td>
								<? }else { ?>
									<td><i class="glyphicon glyphicon-ok"></i></td>
								<? } ?>

							</tbody>
						</table>
					</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<table class="table table-hover">
						<thead>
							<th>Cash - Deposit</th>
							<th>Credit Card - Deposit</th>
						</thead>
						<tbody>
							<tr>
								<td><? echo $deposit_cash ?></td>
								<td><? echo $deposit_creditCard ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<form method="post" action="transactionSummary2-titles.php">
			<input type="hidden" name="ipd_laboratory" value="<? echo $labTotal ?>">
			<input type="hidden" name="ipd_xray" value="<? echo $xrayTotal ?>">
			<input type="hidden" name="ipd_ultrasound" value="<? echo $utzTotal ?>">
			<input type="hidden" name="ipd_ctscan" value="<? echo $ctscanTotal ?>">
			<input type="hidden" name="ipd_ecg" value="<? echo $ecgTotal ?>">
			<input type="hidden" name="ipd_erfee" value="<? echo $erfeeTotal ?>">
			<input type="hidden" name="ipd_or" value="<? echo $orTotal ?>">
			<input type="hidden" name="ipd_misc" value="<? echo $miscTotal ?>">
			<input type="hidden" name="ipd_spirometry" value="<? echo $spirometryTotal ?>">
			<input type="hidden" name="ipd_medicine" value="<? echo $medsTotal ?>">
			<input type="hidden" name="ipd_supplies" value="<? echo $suppTotal ?>">
			<input type="hidden" name="ipd_pf" value="<? echo $pfTotal ?>">
			<input type="hidden" name="ipd_room" value="<? echo $roomTotal ?>">
			<input type="hidden" name="ipd_cardiacMonitor" value="<? echo $cardiacTotal ?>">
			<input type="hidden" name="ipd_PT" value="<? echo $ptTotal ?>">
			<input type="hidden" name="ipd_OT" value="<? echo $otTotal ?>">
			<input type="hidden" name="ipd_ST" value="<? echo $stTotal ?>">
			<input type="hidden" name="ipd_others" value="<? echo $othersTotal ?>">
			<input type="hidden" name="ipd_hmoExcess" value="<? echo $hmoExcessTotal ?>">
			<input type="hidden" name="ipd_phicPortion" value="<? echo $phicPortionTotal ?>">
			<input type="hidden" name="ipd_customTitle" value="<? echo $customTitleTotal ?>">
			<input type="hidden" name="ipd_discount" value="<? echo $discTotal ?>">
			<input type="hidden" name="ipd_hmo" value="<? echo $hmoTotal ?>">
			<input type="hidden" name="ipd_phic" value="<? echo $phicTotal ?>">
			<input type="hidden" name="ipd_cash" value="<? echo $cashTotal ?>">
			<input type="hidden" name="ipd_creditCard" value="<? echo $creditCardTotal ?>">
			<input type="hidden" name="ipd_balance" value="<? echo $balTotal ?>">
			<input type="hidden" name="ipd_deposit_cash" value="<? echo $deposit_cash ?>">
			<input type="hidden" name="ipd_deposit_creditCard" value="<? echo $deposit_creditCard ?>">
			<input type="hidden" name="ipd_excess" value="<? echo $excessTotal ?>">


			<input type="hidden" name="opdCreditCard" value="<? echo $opdCreditCard ?>">
			<input type="hidden" name="opdCash" value="<? echo $opdCash ?>">
			<input type="hidden" name="opdHMO" value="<? echo $opdHMO ?>">
			<input type="hidden" name="opdPHIC" value="<? echo $opdPHIC ?>">
			<input type="hidden" name="opdUnpaid" value="<? echo $opdUnpaid ?>">
			<input type="hidden" name="opdDiscount" value="<? echo $opdDiscount ?>">
			<input type="hidden" name="opdBalancePaid" value="<? echo $opdBalancePaid ?>">
			<input type="hidden" name="opd_pf_total" value="<? echo $opd_pf_total ?>">
			<input type="hidden" name="opd_ecg" value="<? echo $opd_ecg ?>">
			<input type="hidden" name="opd_xray" value="<? echo $opd_xray ?>">
			<input type="hidden" name="opd_ultrasound" value="<? echo $opd_ultrasound ?>">
			<input type="hidden" name="opd_erFee" value="<? echo $opd_erFee ?>">
			<input type="hidden" name="opd_ctscan" value="<? echo $opd_ctscan ?>">
			<input type="hidden" name="opd_laboratory" value="<? echo $opd_laboratory ?>" >
			<input type="hidden" name="opd_medicine" value="<? echo $opd_medicine ?>">
			<input type="hidden" name="opd_supplies" value="<? echo $opd_supplies ?>">
			<input type="hidden" name="opd_spyrometry" value="<? echo $opd_spyrometry ?>">
			<input type="hidden" name="opd_derma" value="<? echo $opd_derma ?>">
			<input type="hidden" name="opd_others" value="<? echo $opd_others ?>">
			<input type="hidden" name="opd_OR" value="<? echo $opd_OR ?>">
			<input type="hidden" name="opd_PT" value="<? echo $opd_PT ?>">
			<input type="hidden" name="opd_OT" value="<? echo $opd_OT ?>">
			<input type="hidden" name="opd_ST" value="<? echo $opd_ST ?>">
			<input type="hidden" name="opd_OT_payables" value="<? echo $opd_OT_payables ?>">
			<input type="hidden" name="opd_ST_payables" value="<? echo $opd_ST_payables ?>">
			<input type="hidden" name="opd_PF_payable" value="<? echo $opd_PF_payable ?>">
			<input type="hidden" name="opd_cardiacMonitor" value="<? echo $opd_cardiacMonitor ?>">
			<input type="hidden" name="opd_misc" value="<? echo $opd_misc ?>">			

			<input type="hidden" name="date1" value="<? echo $date1 ?>">
			<input type="hidden" name="date2" value="<? echo $date2 ?>">

			<input type="submit">
		</form>

	</body>	
</html>