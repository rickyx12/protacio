<? 
	include_once 'transactionSummary.class.php';
	include_once '../../../myDatabase.php';
	include_once '../../../myDatabase4.php';

	$ts = new transactionSummary();
	$ro = new database();
	$ro4 = new database4();

	$fromDate = $_POST['fromDate'];
	$date = preg_split ("/\-/", $fromDate);
	$fromYear = $date[0];
	$fromMonth = $date[1];
	$fromDay = $date[2];
	$format_fromDay;

	//tanggalin ung zero sa unahan ng mga number na 01 - 09 pra s for loop
	if( $fromDay < 10 ) {
		$format_fromDay = substr($fromDay,1);
	}else {
		$format_fromDay = $fromDay;
	}


	$toDate = $_POST['toDate'];
	$date1 = preg_split ("/\-/", $toDate);
	$toYear = $date1[0];
	$toMonth = $date1[1];
	$toDay = $date1[2];
	$format_toDay;

	//tanggalin ung zero sa unahan ng mga number na 01 - 09 pra s for loop	
	if( $toDay < 10 ) {
		$format_toDay = substr($toDay,1);
	}else {
		$format_toDay = $toDay;
	}

	//dahil nka number ung months sa date kea convert ko into words
	$monthWord = array(
			"01" => "Jan",
			"02" => "Feb",
			"03" => "Mar",
			"04" => "Apr",
			"05" => "May",
			"06" => "Jun",
			"07" => "Jul",
			"08" => "Aug",
			"09" => "Sep",
			"10" => "Oct",
			"11" => "Nov",
			"12" => "Dec"
		);

	//shift
	$morning = 'Morning';
	$noon = 'Noon';
	$afternoon = 'Afternoon';
	$night = 'Night';
	$noShift = '';

	//padivia
	$cash = 'Cash';
	$creditCard = 'Credit Card';

	//debit total
	$cashCardTotal = 0;
	$cashTotal = 0;
	$discountTotal = 0;
	$creditCardTotal = 0;
	$hmoTotal = 0;
	$companyTotal = 0;
	$balanceTotal = 0;
	$philhealthTotal = 0;
	$ipdBillTotal = 0;

	//credit total
	$medicineTotal = 0;
	$suppliesTotal = 0;
	$orTotal = 0;
	$roomTotal = 0;
	$ptTotal = 0;
	$spiroTotal = 0;
	$xrayTotal = 0;
	$ecgTotal = 0;
	$ctscanTotal = 0;
	$utzTotal = 0;
	$pfTotal = 0;
	$laboratoryTotal = 0;
	$miscTotal = 0;
	$othersTotal = 0;
	$erfeeTotal = 0;
	$balancePaidTotal = 0;
	$excessPaymentTotal = 0;

	$addDeposit = 0;
	$lessDeposit = 0;

	$cashDepositTotal = 0;
	$creditCardDepositTotal = 0;

	//companyType
	$hmo = 'HMO';
	$company = 'Company';

?>
<!DOCTYPE html>
<html>
	<head>
	  <meta charset="UTF-8">
	  <title>Transaction Summary</title>
		  <script src='../../../../bower_components/jquery/dist/jquery.min.js'></script>
		  <link rel='stylesheet' href='../../../../bower_components/bootstrap/dist/css/bootstrap.min.css'>	  

		  <script>
		  	
		  	$(document).ready(function() {

				$("#export").click(function() {
					
					var patients = '<table>'+$("#patients").html().replace(/<a\/?[^>]+>/gi, '')+'</table>';
					var summary = '<table>'+$("#summary").html().replace(/<a\/?[^>]+>/gi, '')+'</table>';
					var reportName = 'IPD_Transaction_Summary_[<? echo $monthWord[$fromMonth]."-".$fromYear ?>]';

					$('body').prepend("<form method='post' action='../../../export-to-excel/exporttoexcel.php' style='display:none' id='ReportTableData'><textarea name='tableData'>"+patients+summary+"</textarea><input type='text' name='reportName' value='"+reportName+"'></form>");

					 $('#ReportTableData').submit().remove();
					 return false;	
					 
				});
	 		
		  	});

		  </script>

		  <style>
		  	.box {
		  		width: 230%;
		  		margin:2%;
		  	}		

		  	h5 {
		  		margin: 2%;
		  	}

		  	.white {
		  		padding:0.3%;
		  	}

		  	.yellow {
		  		padding: 0.3%;
		  		background-color: yellow;
		  	}

			tr:hover { 
				background-color:yellow;color:black;
			}

			.date {
				background-color: lightblue;
			}

			.shift {
				text-align: right;
				padding-right: 1%;
			}

			.transactionSummary {
				margin:3%;
				width: 30%;
			}

		  </style>

	</head>
	<body>
		<div>
			<h5><a href="#" id="export"><img src="../../../export-to-excel/excel-icon.png"></a></h5>
			<table class='box' rules='all' id='patients'>
				<thead>
					<tr>
						<th style='background-color: yellow;'>Date</th>
						<th style='background-color: yellow;'>OR#</th>
						<th style='background-color: yellow;'>Last Name</th>
						<th style='background-color: yellow;'>First name</th>
						<th style='background-color: yellow;'>Cash / Card</th>
						<th style='background-color: yellow;'>HMO Name</th>
						<th style='background-color: yellow;'>IPD BILL</th>
						<th style='background-color: yellow;'>Cash</th>
						<th style='background-color: yellow;'>Discount</th>
						<th style='background-color: yellow;'>Credit Card</th>
						<th style='background-color: yellow;'>HMO</th>
						<th style='background-color: yellow;'>Company</th>
						<th style='background-color: yellow;'>Personal</th>
						<th style='background-color: yellow;'>Philhealth</th>
						<th style='background-color: yellow;'>Medicine</th>
						<th style='background-color: yellow;'>Supplies</th>
						<th style='background-color: yellow;'>OR Fee</th>
						<th style='background-color: yellow;'>Room</th>
						<th style='background-color: yellow;'>PT</th>
						<th style='background-color: yellow;'>Spyro</th>
						<th style='background-color: yellow;'>XRAY</th>
						<th style='background-color: yellow;'>ECG</th>
						<th style='background-color: yellow;'>CTSCAN</th>
						<th style='background-color: yellow;'>UTZ</th>
						<th style='background-color: yellow;'>CLINIC REVENUE</th>
						<th style='background-color: yellow;'>Laboratory</th>
						<th style='background-color: yellow;'>Miscellaneous</th>
						<th style='background-color: yellow;'>Others</th>
						<th style='background-color: yellow;'>ER Fee</th>
						<th style='background-color: yellow;'>Deposit</th>
						<th style='background-color: yellow;'>Balance Paid</th>
					</tr>
				</thead>
				<tbody>
					<? for( $dayLoop = $format_fromDay; $dayLoop <= $format_toDay; $dayLoop++ ) { ?>

						<? $ts->get_discharged_inpatients($fromMonth,$dayLoop,$fromYear,$toMonth,$toDay,$toYear) ?>
						<? $ts->list_deposit($fromMonth,$dayLoop,$fromYear) ?>
						<? $ts->list_inpatient_balance_paid($fromMonth,$dayLoop,$fromYear) ?>
						
						<tr>
							<td style='background-color: lightblue;'>
								 <h4>
								 	<? echo $monthWord[$fromMonth].' '.$dayLoop.', '.$fromYear ?>
								 </h4> 
							</td>
							<td style='background-color: lightblue;'><!--OR#--></td>
							<td style="background-color: lightblue;"><!--LAST NAME--></td>
							<td style="background-color: lightblue;"><!--FIRST NAME--></td>
							<td style="background-color: lightblue;"><!--CASH / CARD--></td>
							<td style="background-color: lightblue;"><!--HMO NAME--></td>
							<td style="background-color: lightblue;"><!--IPD BILL--></td>
							<td style="background-color: lightblue;"><!--CASH--></td>
							<td style="background-color: lightblue;"><!--DISCOUNT--></td>
							<td style="background-color: lightblue;"><!--CREDIT CARD--></td>
							<td style="background-color: lightblue;"><!--HMO--></td>
							<td style="background-color: lightblue;"><!--COMPANY--></td>
							<td style="background-color: lightblue;"><!--PERSONAL--></td>
							<td style="background-color: lightblue;"><!--PHILHEALTH--></td>
							<td style="background-color: lightblue;"><!--MEDICINE--></td>
							<td style="background-color: lightblue;"><!--SUPPLIES--></td>
							<td style="background-color: lightblue;"><!--OR FEE--></td>
							<td style="background-color: lightblue;"><!--ROOM--></td>
							<td style="background-color: lightblue;"><!--PT--></td>
							<td style="background-color: lightblue;"><!--SPIRO--></td>
							<td style="background-color: lightblue;"><!--XRAY--></td>
							<td style="background-color: lightblue;"><!--ECG--></td>
							<td style="background-color: lightblue;"><!--CTSCAN--></td>
							<td style="background-color: lightblue;"><!--UTZ--></td>
							<td style="background-color: lightblue;"><!--CLINIC REVENUE--></td>
							<td style="background-color: lightblue;"><!--LABORATORY--></td>
							<td style="background-color: lightblue;"><!--MISCELLANEOUS--></td>
							<td style="background-color: lightblue;"><!--OTHERS--></td>
							<td style="background-color: lightblue;"><!--ER FEE--></td>
							<td style="background-color: lightblue;"><!--DEPOSIT--></td>
							<td style="background-color: lightblue;"><!--BALANCE PAID--></td>
						</tr>


						<!--MORNING HOSPITAL BILL-->
						<tr>
							<td class='shift'><h5>Morning</h5></td>
							<td><!--OR#--></td>
							<td><!--LASTNAME--></td>
							<td><!--FIRSTNAME--></td>
							<td><!--CASH/CARD--></td>
							<td><!--HMO NAME--></td>
							<td><!--IPD BILL--></td>
							<td><!--CASH--></td>
							<td><!--DISCOUNT--></td>
							<td><!--CREDIT CARD--></td>
							<td><!--HMO--></td>
							<td><!--COMPANY--></td>
							<td><!--PERSONAL--></td>
							<td><!--PHILHEALTH--></td>
							<td><!--MEDICINE--></td>
							<td><!--SUPPLIES--></td>
							<td><!--OR FEE--></td>
							<td><!--ROOM--></td>
							<td><!--PT--></td>
							<td><!--SPIRO--></td>
							<td><!--XRAY--></td>
							<td><!--ECG--></td>
							<td><!--CTSCAN--></td>
							<td><!--UTZ--></td>
							<td><!--CLINIC REVENUE--></td>
							<td><!--LABORATORY--></td>
							<td><!--MISCELLANEOUS--></td>
							<td><!--OTHERS--></td>
							<td><!--ER FEE--></td>
							<td><!--DEPOSIT--></td>
							<td><!--BALANCE PAID--></td>
						</tr>
							<? foreach( $ts->get_discharged_inpatients_registrationNo() as $registrationNo ) { ?>								

								<? if( $ts->get_inpatient_shift($registrationNo,$morning) == 'Morning' ) { ?>
									<? 
										//get the shift of last payment of ipd in patientPayment tbl								
										$lastPaymentMorning = $ro4->doubleSelectLast('patientPayment','shift','registrationNo',$registrationNo,'paymentFor','HOSPITAL BILL','paymentNo');

										$orNo = $ro->doubleSelectNow('patientPayment','orNo','registrationNo',$registrationNo,'paymentFor','HOSPITAL BILL');

										//DEBIT
										$cashPayment = $ts->get_inpatient_payment($registrationNo,$cash,$morning);
										$deposit = $ts->get_inpatient_deposit($registrationNo,$cash,$morning);
										$creditCardPayment = $ts->get_inpatient_payment($registrationNo,$creditCard,$morning);
										$depositCr = $ts->get_inpatient_deposit($registrationNo,$creditCard,$morning);
										$discount = $ro->selectNow('registrationDetails','discount','registrationNo',$registrationNo);
										$hmoCover = $ts->get_inpatient_hmo($registrationNo,$hmo,$morning);
										$companyCover = $ts->get_inpatient_hmo($registrationNo,$company,$morning);
										$philhealthCover = $ts->get_inpatient_philhealth($registrationNo);

										$patient_debit_total = (
												$cashPayment +
												$deposit +
												$creditCardPayment +
												$depositCr +
												$discount +
												$hmoCover +
												$companyCover +
												$philhealthCover
											);

										//paymentFor = HOSPITAL BILL
										$hospitalBill = ($cashPayment + $creditCardPayment);

										//paymentFor = DEPOSIT
										$totalDeposit = ( $deposit + $depositCr );		

										//CREDIT
										$medicine = (
											$ro4->inpatient_title_total_inventory($registrationNo,'total','MEDICINE') +
											$ro4->inpatient_paymentMode_total_inventory_takeHomeMeds($registrationNo,"total")
										);
										$supplies = $ro4->inpatient_title_total($registrationNo,'total','SUPPLIES');
										$or = $ro4->inpatient_title_total($registrationNo,'total','OR/DR/ER Fee');
										$room = $ro4->inpatient_title_total($registrationNo,'total','Room and Board');
										$pt = $ro4->inpatient_title_total($registrationNo,'total','PT');
										$spiro = $ro4->inpatient_title_total($registrationNo,'total','SPIROMETRY');
										$xray = $ro4->inpatient_title_total($registrationNo,'total','XRAY');	
										$ecg = $ro4->inpatient_title_total($registrationNo,'total','ECG');
										$ctscan = $ro4->inpatient_title_total($registrationNo,'total','CTSCAN');
										$utz = $ro4->inpatient_title_total($registrationNo,'total','ULTRASOUND');
										$pf = $ro4->inpatient_title_total($registrationNo,'total','PROFESSIONAL FEE');
										$laboratory = $ro4->inpatient_title_total($registrationNo,'total','LABORATORY');
										$misc = $ro4->inpatient_title_total($registrationNo,'total','MISCELLANEOUS');
										$others = $ro4->inpatient_title_total($registrationNo,'total','OTHERS');
										$erfee = $ro4->inpatient_title_total($registrationNo,'total','ER FEE');							

										$total = ( $medicine + $supplies + $or + $room + $pt + $spiro + $xray + $ecg + $ctscan + $utz + $pf +$laboratory + $misc + $others + $erfee );

										$hospitalBillCash = $ts->get_inpatient_payment_for($registrationNo,$cash,$morning);
										$hospitalBillCreditCard = $ts->get_inpatient_payment_for($registrationNo,$creditCard,$morning);

										$balance = ( $total - $patient_debit_total );

									 ?>

									 <? if( $hospitalBillCash == 'HOSPITAL BILL' || $hospitalBillCreditCard == 'HOSPITAL BILL' ) { ?>
										<tr>

											<!--DATE-->
											<td></td>

											<!--OR#-->
											<td class='white'>
												<?
													echo $orNo
												?>
											</td>

											<!--LASTNAME-->
											<td class='white'>
												<?												
													$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
													$lastName = $ro->selectNow('patientRecord','lastName','patientNo',$patientNo);
													echo $lastName;

													if( $balance < 0 ) {
														$excessPaymentTotal += abs($balance);
														$format = number_format(abs($balance));
														echo "<br>";
														echo "<i style='color:red; font-size:12px'>Excess: ".$format."</i>";
													}else { }													
												?>
											</td>

											<!--FIRSTNAME-->
											<td class='white'>
												<?
													$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
													$firstName = $ro->selectNow('patientRecord','firstName','patientNo',$patientNo);
													echo $firstName;
												?>
											</td>

											<!--CASH / CARD-->
											<td class='white'>
												<?										
													$cashCardTotal += ($cashPayment + $creditCardPayment);					
													echo $ro4->number_format($cashPayment + $creditCardPayment);
												?>
											</td>

											<!--HMO/COMPANY NAME-->
											<td class='white'>
												<?
													echo $ro->selectNow('registrationDetails','Company','registrationNo',$registrationNo)
												?>
											</td>

											<!--IPD BILL-->
											<td class='white'>
												<?
													$ipdBillTotal += ( $total - $deposit );
													echo $ro4->number_format( ($total - $deposit) );
												?>
											</td>

											<!--CASH-->
											<td class='white'>
												<?
													$cashTotal += $cashPayment;
													echo $ro4->number_format($cashPayment);
												?>
											</td>

											<!--DISCOUNT-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentMorning == $morning ) {
														
														$discountTotal += $discount;
														echo $ro4->number_format($discount);
													
													}else if( $hospitalBill == '' && $lastPaymentMorning == $morning ) {

														$discountTotal += $discount;
														echo $ro4->number_format($discount);

													}else { }
												?>
											</td>

											<!--CREDIT CARD-->
											<td class='white'>
												<?
													$creditCardTotal += $creditCardPayment;
													echo $ro4->number_format($creditCardPayment);
												?>
											</td>

											<!--HMO-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentMorning == $morning ) {

														$hmoTotal += $hmoCover;
														echo $ro4->number_format($hmoCover);											
													
													}else if( $hospitalBill == '' && $lastPaymentMorning == $morning ) {

														$hmoTotal += $hmoCover;
														echo $ro4->number_format($hmoCover);

													}else { }
												?>
											</td>

											<!--COMPANY-->										
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentMorning == $morning ) {

														$companyTotal += $companyCover;
														echo $ro4->number_format($companyCover);

													}else if( $hospitalBill == '' && $lastPaymentMorning == $morning ) {

														$companyTotal += $companyCover;
														echo $ro4->number_format($companyCover);

													}else { }
												?>
											</td>

											<!--PERSONAL-->
											<td class='white'>
												<?
													if( $balance > 0 ) {
														$balanceTotal += $balance;
													}else { }
													echo $ro4->number_format($balance);
												?>
											</td>

											<!--PHILHEALTH-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentMorning == $morning ) {
													
														$philhealthTotal += $philhealthCover;
														echo $ro4->number_format($philhealthCover);
													
													}else if( $hospitalBill == '' && $lastPaymentMorning == $morning ) {

														$philhealthTotal += $philhealthCover;
														echo $ro4->number_format($philhealthCover);

													}else { }
												?>
											</td>

											<!--MEDICINE-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentMorning == $morning ) { 
														
														$medicineTotal += $medicine;
														echo $ro4->number_format($medicine);
													
													}else if( $hospitalBill == '' && $lastPaymentMorning == $morning ) {

														$medicineTotal += $medicine;
														echo $ro4->number_format($medicine);

													}else { }
												?>
											</td>

											<!--SUPPLIES-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentMorning == $morning ) {
													
														$suppliesTotal += $supplies;
														echo $ro4->number_format($supplies);
													
													}else if( $hospitalBill == '' && $lastPaymentMorning == $morning ) {

														$suppliesTotal += $supplies;
														echo $ro4->number_format($supplies);

													}
													else { }
												?>
											</td>

											<!--OR Fee-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentMorning == $morning ) {

														$orTotal += $or;
														echo $ro4->number_format($or);

													}else if( $hospitalBill == '' && $lastPaymentMorning == $morning ) {

														$orTotal += $or;
														echo $ro4->number_format($or);

													}else { }

												?>
											</td>

											<!--Room-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentMorning == $morning ) {

														$roomTotal += $room;
														echo $ro4->number_format($room);

													}else if( $hospitalBill == '' && $lastPaymentMorning == $morning ) {

														$roomTotal += $room;
														echo $ro4->number_format($room);

													}else { }
												?>
											</td>

											<!--PT-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentMorning == $morning ) {

														$ptTotal += $pt;
														echo $ro4->number_format($pt);

													}else if( $hospitalBill == '' && $lastPaymentMorning == $morning ) {

														$ptTotal += $pt;
														echo $ro4->number_format($pt);

													}else { }
												?>
											</td>

											<!--SPIROMETRY-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentMorning == $morning ) {

														$spiroTotal += $spiro;
														echo $ro4->number_format($spiro);

													}else if( $hospitalBill == '' && $lastPaymentMorning == $morning ) {

														$spiroTotal += $spiro;
														echo $ro4->number_format($spiro);

													}else { }
												?>
											</td>

											<!--XRAY-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentMorning == $morning ) {

														$xrayTotal += $xray;
														echo $ro4->number_format($xray);

													}else if( $hospitalBill == '' && $lastPaymentMorning == $morning ) {

														$xrayTotal += $xray;
														echo $ro4->number_format($xray);

													}else { }
												?>
											</td>

											<!--ECG-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentMorning == $morning ) {

														$ecgTotal += $ecg;
														echo $ro4->number_format($ecg);

													}else if( $hospitalBill == '' && $lastPaymentMorning == $morning ) {

														$ecgTotal += $ecg;
														echo $ro4->number_format($ecg);

													}else { }
												?>
											</td>

											<!--CTSCAN-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentMorning == $morning ) {

														$ctscanTotal += $ctscan;
														echo $ro4->number_format($ctscan);

													}else if( $hospitalBill == '' && $lastPaymentMorning == $morning ) {

														$ctscanTotal += $ctscan;
														echo $ro4->number_format($ctscan);

													}else { }
												?>
											</td>

											<!--UTZ-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentMorning == $morning ) {

														$utzTotal += $utz;
														echo $ro4->number_format($utz);

													}else if( $hospitalBill == '' && $lastPaymentMorning == $morning ) {

														$utzTotal += $utz;
														echo $ro4->number_format($utz);

													}else { }
												?>
											</td>

											<!--CLINIC REVENUE-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentMorning == $morning ) {

														$pfTotal += $pf;
														echo $ro4->number_format($pf);

													}else if( $hospitalBill == '' && $lastPaymentMorning == $morning ) { 

														$pfTotal += $pf;
														echo $ro4->number_format($pf);

													}else { }
												?>
											</td>

											<!--LABORATORY-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentMorning == $morning ) {

														$laboratoryTotal += $laboratory;
														echo $ro4->number_format($laboratory);

													}else if( $hospitalBill == '' && $lastPaymentMorning == $morning ) {

														$laboratoryTotal += $laboratory;
														echo $ro4->number_format($laboratory);

													}else { }
												?>
											</td>

											<!--MISCELLANEOUS-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentMorning == $morning ) {

														$miscTotal += $misc;
														echo $ro4->number_format($misc);

													}else if( $hospitalBill == '' && $lastPaymentMorning == $morning ) {

														$miscTotal += $misc;
														echo $ro4->number_format($misc);

													}else { }
												?>
											</td>

											<!--OTHERS-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentMorning == $morning ) {

														$othersTotal += $others;
														echo $ro4->number_format($others);

													}else if( $hospitalBill == '' && $lastPaymentMorning == $morning ) {

														$othersTotal += $others;
														echo $ro4->number_format($others);

													}else { }
												?>
											</td>

											<!--ER FEE-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentMorning == $morning ) {

														$erfeeTotal += $erfee;
														echo $ro4->number_format($erfee);

													}else if( $hospitalBill == '' && $lastPaymentMorning == $morning ) {

														$erfeeTotal += $erfee;
														echo $ro4->number_format($erfee);

													}else { }
												?>
											</td>

											<!--DEPOSIT-->
											<td class='white'>
												<?
													if( $totalDeposit > 0 ) {
														$lessDeposit += $totalDeposit;
														echo '-'.$ro4->number_format($totalDeposit);
													}else { }
												?>
											</td>

											<!--BALANCE PAID-->
											<td> </td>

										</tr>
									<? }else { } ?>

								<? }else { } ?>

							<? } ?>

							<!--MORNING DEPOSIT-->
							<? foreach( $ts->list_deposit_paymentNo() as $paymentNo ) { ?>
								
								<? if( $ro->selectNow('patientPayment','shift','paymentNo',$paymentNo) == $morning ) { ?>
									<?
										$registrationNo = $ro->selectNow('patientPayment','registrationNo','paymentNo',$paymentNo);
										$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
										$lastName = $ro->selectNow('patientRecord','lastName','patientNo',$patientNo);
										$firstName = $ro->selectNow('patientRecord','firstName','patientNo',$patientNo);
										$orNo = $ro->selectNow('patientPayment','orNo','paymentNo',$paymentNo);

										//DEBIT
										$cashDeposit = $ro->doubleSelectNow('patientPayment','amountPaid','paymentNo',$paymentNo,'paidVia',$cash);
										$creditCardDeposit = $ro->doubleSelectNow('patientPayment','amountPaid','paymentNo',$paymentNo,'paidVia',$creditCard);


									?>
									<tr>
										<td><!--DATE--></td>

										<!--OR#-->
										<td class='white'>
											<?
												echo $orNo
											?>
										</td>

										<!--LASTNAME-->
										<td class='white'>
											<?
												echo $lastName
											?>
										</td>

										<!--FIRSTNAME-->
										<td class='white'>
											<?
												echo $firstName
											?>
										</td>

										<!--CASH / CARD-->
										<td class='white'>
											<?
												echo $ro4->number_format(($cashDeposit + $creditCardDeposit))
											?>
										</td>

										<td><!--HMO NAME--></td>

										<!--IPD BILL-->
										<td class='white'>
											<?
												$ipdBillTotal += ( $cashDeposit + $creditCardDeposit );
												echo $ro4->number_format(($cashDeposit + $creditCardDeposit));
											?>
										</td>

										<!--CASH-->
										<td class='white'>
											<?
												$cashDepositTotal += $cashDeposit;
												$cashTotal += $cashDeposit;
												echo $ro4->number_format($cashDeposit)
											?>
										</td>

										<td><!--DISCOUNT--></td>

										<!--CREDIT CARD-->
										<td class='white'>
											<?
												$creditCardDepositTotal += $creditCardDeposit;
												$creditCardTotal += $creditCardDeposit;
												echo $ro4->number_format($creditCardDeposit)
											?>
										</td>

										<td><!--HMO--></td>
										<td><!--Company--></td>
										<td><!--Personal--></td>
										<td><!--Philhealth--></td>
										<td><!--Medicine--></td>
										<td><!--Supplies--></td>
										<td><!--OR FEE--></td>
										<td><!--ROOM--></td>
										<td><!--PT--></td>
										<td><!--SPIRO--></td>
										<td><!--XRAY--></td>
										<td><!--ECG--></td>
										<td><!--CTSCAN--></td>
										<td><!--UTZ--></td>
										<td><!--CLINIC REVENUE--></td>
										<td><!--LABORATORY--></td>
										<td><!--MISCELLANEOUS--></td>
										<td><!--OTHERS--></td>
										<td><!--ER FEE--></td>
										<td class='white'>
											<?
												$addDeposit += ( $cashDeposit + $creditCardDeposit );
												echo $ro4->number_format($cashDeposit + $creditCardDeposit)
											?>
										</td>
										<td><!--BALANCE PAID--></td>

									</tr>
								<? }else { } ?>
							
							<? } ?>	

							<!--MORNING BALANCE PAID-->
							<? foreach( $ts->list_inpatient_balance_paid_paymentNo() as $paymentNo ) { ?>
								<?
									$registrationNo = $ro->selectNow('patientPayment','registrationNo','paymentNo',$paymentNo);
									$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
									$lastName = $ro->selectNow('patientRecord','lastName','patientNo',$patientNo);
									$firstName = $ro->selectNow('patientRecord','firstName','patientNo',$patientNo);
									$shift = $ro->selectNow('patientPayment','shift','paymentNo',$paymentNo);
									$orNo = $ro->selectNow('patientPayment','orNo','paymentNo',$paymentNo);

									$cashPayment = $ro->doubleSelectNow('patientPayment','amountPaid','paymentNo',$paymentNo,'paidVia',$cash);
									$creditCardPayment = $ro->doubleSelectNow('patientPayment','amountPaid','paymentNo',$paymentNo,'paidVia',$creditCard);

									$totalPaid = ( $cashPayment + $creditCardPayment );

								?>
								<? if( $shift == $morning ) { ?>
									<tr>
										<td><!--DATE--></td>
										<td class='white'>
											<?
												echo $orNo
											?>
										</td>
										<td class='white'>
											<?
												echo $lastName
											?>
										</td>
										<td class='white'>
											<?
												echo $firstName
											?>
										</td>
										<td class='white'>
											<?
												echo $ro4->number_format($totalPaid)
											?>
										</td>
										<td><!--HMO NAME--></td>
										<td class='white'>
											<?
												echo $ro4->number_format($totalPaid)
											?>
										</td>
										<td class='white'>
											<?
												$cashTotal += $cashPayment;
												echo $ro4->number_format($cashPayment)
											?>
										</td>
										<td><!--DISCOUNT--></td>
										<td class='white'>
											<?
												$creditCardTotal += $creditCardPayment;
												echo $ro4->number_format($creditCardPayment)
											?>
										</td>
										<td><!--HMO--></td>
										<td><!--COMPANY--></td>
										<td><!--PERSONAL--></td>
										<td><!--PHILHEALTH--></td>
										<td><!--MEDICINE--></td>
										<td><!--SUPPLIES--></td>
										<td><!--OR FEE--></td>
										<td><!--ROOM--></td>
										<td><!--PT--></td>
										<td><!--SPIRO--></td>
										<td><!--XRAY--></td>
										<td><!--ECG--></td>
										<td><!--CTSCAN--></td>
										<td><!--UTZ--></td>
										<td><!--CLINIC REVENUE--></td>
										<td><!--LABORATORY--></td>
										<td><!--MISCELLANEOUS--></td>
										<td><!--OTHERS--></td>
										<td><!--ER FEE--></td>
										<td><!--DEPOSIT--></td>
										<td class='white'>
											<?
												$balancePaidTotal += $totalPaid;
												echo $ro4->number_format($totalPaid)
											?>
										</td>
									</tr>
								<? }else { } ?>
							<? } ?>													




							<!--NOON HOSPITAL BILL-->
							<tr>
								<td class='shift'><h5>Noon</h5></td>
								<td><!--OR#--></td>
								<td><!--LASTNAME--></td>
								<td><!--FIRSTNAME--></td>
								<td><!--CASH/CARD--></td>
								<td><!--HMO NAME--></td>
								<td><!--IPD BILL--></td>
								<td><!--CASH--></td>
								<td><!--DISCOUNT--></td>
								<td><!--CREDIT CARD--></td>
								<td><!--HMO--></td>
								<td><!--COMPANY--></td>
								<td><!--PERSONAL--></td>
								<td><!--PHILHEALTH--></td>
								<td><!--MEDICINE--></td>
								<td><!--SUPPLIES--></td>
								<td><!--OR FEE--></td>
								<td><!--ROOM--></td>
								<td><!--PT--></td>
								<td><!--SPIRO--></td>
								<td><!--XRAY--></td>
								<td><!--ECG--></td>
								<td><!--CTSCAN--></td>
								<td><!--UTZ--></td>
								<td><!--CLINIC REVENUE--></td>
								<td><!--LABORATORY--></td>
								<td><!--MISCELLANEOUS--></td>
								<td><!--OTHERS--></td>
								<td><!--ER FEE--></td>
								<td><!--DEPOSIT--></td>
								<td><!--BALANCE PAID--></td>
							</tr>							
							<? foreach( $ts->get_discharged_inpatients_registrationNo() as $registrationNo ) { ?>								

								<? if( $ts->get_inpatient_shift($registrationNo,$noon) == 'Noon' ) { ?>

									<? 
										//get the shift of last payment of ipd in patientPayment tbl								
										$lastPaymentNoon = $ro4->doubleSelectLast('patientPayment','shift','registrationNo',$registrationNo,'paymentFor','HOSPITAL BILL','paymentNo');

										$orNo = $ro->doubleSelectNow('patientPayment','orNo','registrationNo',$registrationNo,'paymentFor','HOSPITAL BILL');

										//DEBIT
										$cashPayment = $ts->get_inpatient_payment($registrationNo,$cash,$noon);
										$deposit = $ts->get_inpatient_deposit($registrationNo,$cash,$noon);
										$creditCardPayment = $ts->get_inpatient_payment($registrationNo,$creditCard,$noon);
										$depositCr = $ts->get_inpatient_deposit($registrationNo,$creditCard,$noon);
										$discount = $ro->selectNow('registrationDetails','discount','registrationNo',$registrationNo);
										$hmoCover = $ts->get_inpatient_hmo($registrationNo,$hmo,$noon);
										$companyCover = $ts->get_inpatient_hmo($registrationNo,$company,$noon);
										$philhealthCover = $ts->get_inpatient_philhealth($registrationNo);

										$patient_debit_total = (
												$cashPayment +
												$deposit +
												$creditCardPayment +
												$depositCr +
												$discount +
												$hmoCover +
												$companyCover +
												$philhealthCover
											);

										//paymentFor = HOSPITAL BILL
										$hospitalBill = ($cashPayment + $creditCardPayment);

										//paymentFor = DEPOSIT
										$totalDeposit = ( $deposit + $depositCr );

										//CREDIT
										$medicine = (
											$ro4->inpatient_title_total_inventory($registrationNo,'total','MEDICINE') +
											$ro4->inpatient_paymentMode_total_inventory_takeHomeMeds($registrationNo,"total")
										);
										$supplies = $ro4->inpatient_title_total($registrationNo,'total','SUPPLIES');
										$or = $ro4->inpatient_title_total($registrationNo,'total','OR/DR/ER Fee');
										$room = $ro4->inpatient_title_total($registrationNo,'total','Room and Board');
										$pt = $ro4->inpatient_title_total($registrationNo,'total','PT');
										$spiro = $ro4->inpatient_title_total($registrationNo,'total','SPIROMETRY');
										$xray = $ro4->inpatient_title_total($registrationNo,'total','XRAY');
										$ecg = $ro4->inpatient_title_total($registrationNo,'total','ECG');
										$ctscan = $ro4->inpatient_title_total($registrationNo,'total','CTSCAN');
										$utz = $ro4->inpatient_title_total($registrationNo,'total','ULTRASOUND');
										$pf = $ro4->inpatient_title_total($registrationNo,'total','PROFESSIONAL FEE');
										$laboratory = $ro4->inpatient_title_total($registrationNo,'total','LABORATORY');
										$misc = $ro4->inpatient_title_total($registrationNo,'total','MISCELLANEOUS');
										$others = $ro4->inpatient_title_total($registrationNo,'total','OTHERS');
										$erfee = $ro4->inpatient_title_total($registrationNo,'total','ER FEE');

										$total = ( $medicine + $supplies + $or + $room + $pt + $spiro + $xray + $ecg + $ctscan + $utz + $pf + $laboratory + $misc + $others + $erfee );

										$hospitalBillCash = $ts->get_inpatient_payment_for($registrationNo,$cash,$noon);
										$hospitalBillCreditCard = $ts->get_inpatient_payment_for($registrationNo,$creditCard,$noon);

										$balance = ( $total - $patient_debit_total );

									 ?>

									 <? if( $hospitalBillCash == 'HOSPITAL BILL' || $hospitalBillCreditCard == 'HOSPITAL BILL' )  { ?>
										<tr>
											<!--DATE-->
											<td>
												
											</td>

											<!--OR#-->
											<td class='white'>
												<?
													echo $orNo
												?>
											</td>

											<!--LASTNAME-->
											<td class='white'>
												<?
													$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
													$lastName = $ro->selectNow('patientRecord','lastName','patientNo',$patientNo);
													echo $lastName;

													if( $balance < 0 ) {
														$excessPaymentTotal += abs($balance);
														$format = number_format(abs($balance));
														echo "<br>";
														echo "<i style='color:red; font-size:12px'>Excess: ".$format."</i>";
													}else { }													
												?>
											</td>

											<!--FIRSTNAME-->
											<td class='white'>
												<?
													$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
													$firstName = $ro->selectNow('patientRecord','firstName','patientNo',$patientNo);
													echo $firstName;
												?>
											</td>

											<!--CASH/CARD-->
											<td class='white'>
												<?
													$cashCardTotal += ($cashPayment + $creditCardPayment);					
													echo $ro4->number_format($cashPayment + $creditCardPayment);
												?>											
											</td>

											<!--HMO/Company Name-->
											<td class='white'>
												<?
													echo $ro->selectNow('registrationDetails','Company','registrationNo',$registrationNo)
												?>
											</td>

											<!--IPD BILL-->
											<td class='white'>
												<?
													$ipdBillTotal += ( $total - $deposit );
													echo $ro4->number_format( ($total - $deposit) )
												?>
											</td>
											
											<!--CASH-->
											<td class='white'>
												<?
													$cashTotal += $cashPayment;
													echo $ro4->number_format($cashPayment);
												?>
											</td>

											<!--DISCOUNT-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNoon == $noon ) {

														$discountTotal += $discount;
														echo $ro4->number_format($discount);
													
													}else if( $hospitalBill == '' && $lastPaymentNoon == $noon ) {
													
														$discountTotal += $discount;
														echo $ro4->number_format($discount);
													
													}else { }
												?>											
											</td>

											<!--CREDIT CARD-->
											<td class='white'>
												<?
													$creditCardTotal += $creditCardPayment + $depositCr;
													echo $ro4->number_format($creditCardPayment);
												?>
											</td>

											<!--HMO-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNoon == $noon  ) {

														$hmoTotal += $hmoCover;
														echo $ro4->number_format($hmoCover);
													
													}else if( $hospitalBill == '' && $lastPaymentNoon == $noon ) {

														$hmoTotal += $hmoCover;
														echo $ro4->number_format($hmoCover);													
													
													}else { }
												?>
											</td>	

											<!--COMPANY-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNoon == $noon ) {

														$companyTotal += $companyCover;
														echo $ro4->number_format($companyCover);
													
													}else if( $hospitalBill == '' && $lastPaymentNoon == $noon ) { 

														$companyTotal += $companyCover;
														echo $ro4->number_format($companyCover);

													}else { }
												?>
											</td>

											<!--PERSONAL-->
											<td class='white'>
												<?
													if( $balance > 0 ) {
														$balanceTotal += $balance;
													}else{ }
													echo $ro4->number_format($balance)
												?>
											</td>

											<!--PHILHEALTH-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNoon == $noon ) {

														$philhealthTotal += $philhealthCover;
														echo $ro4->number_format($philhealthCover);
													
													}
													else if( $hospitalBill == '' && $lastPaymentNoon == $noon ) {

														$philhealthTotal += $philhealthCover;
														echo $ro4->number_format($philhealthCover);

													}else { }
												?>
											</td>

											<!--MEDICINE-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNoon == $noon ) {

														$medicineTotal += $medicine;
														echo $ro4->number_format($medicine);
													
													}else if( $hospitalBill == '' && $lastPaymentNoon == $noon ) {
														
														$medicineTotal += $medicine;
														echo $ro4->number_format($medicine);

													}
													else { }
												?>
											</td>

											<!--SUPPLIES-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNoon == $noon ) {

														$suppliesTotal += $supplies;
														echo $ro4->number_format($supplies);
													
													}else if( $hospitalBill == '' && $lastPaymentNoon == $noon ) {

														$suppliesTotal += $supplies;
														echo $ro4->number_format($supplies);

													}else { }
												?>
											</td>

											<!--OR FEE-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNoon == $noon ) {

														$orTotal += $or;
														echo $ro4->number_format($or);

													}else if( $hospitalBill == '' && $lastPaymentNoon == $noon ) {

														$orTotal += $or;
														echo $ro4->number_format($or);

													}else { }
												?>
											</td>

											<!--ROOM-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNoon == $noon ) {

														$roomTotal += $room;
														echo $ro4->number_format($room);

													}else if( $hospitalBill == '' && $lastPaymentNoon == $noon ) {

														$roomTotal += $room;
														echo $ro4->number_format($room);

													}else { }
												?>
											</td>

											<!--PT-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNoon == $noon ) {

														$ptTotal += $pt;
														echo $ro4->number_format($pt);

													}else if( $hospitalBill == '' && $lastPaymentNoon == $noon ) {

														$ptTotal += $pt;
														echo $ro4->number_format($pt);

													}else { }
												?>
											</td>

											<!--SPIRO-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNoon == $noon ) {

														$spiroTotal += $spiro;
														echo $ro4->number_format($spiro);

													}else if( $hospitalBill == '' && $lastPaymentNoon == $noon ) {

														$spiroTotal += $spiro;
														echo $ro4->number_format($spiro);

													}else { }
												?>
											</td>

											<!--XRAY-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNoon == $noon ) {

														$xrayTotal += $xray;
														echo $ro4->number_format($xray);

													}else if( $hospitalBill == '' && $lastPaymentNoon == $noon ) {

														$xrayTotal += $xray;
														echo $ro4->number_format($xray);

													}else { }
												?>
											</td>

											<!--ECG-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNoon == $noon ) {

														$ecgTotal += $ecg;
														echo $ro4->number_format($ecg);

													}else if( $hospitalBill == '' && $lastPaymentNoon == $noon ) {

														$ecgTotal += $ecg;
														echo $ro4->number_format($ecg);

													}else { }
												?>
											</td>

											<!--CTSCAN-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNoon == $noon ) {

														$ctscanTotal += $ctscan;
														echo $ro4->number_format($ctscan);

													}else if( $hospitalBill == '' && $lastPaymentNoon == $noon ) {

														$ctscanTotal += $ctscan;
														echo $ro4->number_format($ctscan);

													}else { }
												?>
											</td>

											<!--UTZ-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNoon == $noon ) {

														$utzTotal += $utz;
														echo $ro4->number_format($utz);

													}else if( $hospitalBill == '' && $lastPaymentNoon == $noon ) {

														$utzTotal += $utz;
														echo $ro4->number_format($utz);

													}else { }
												?>
											</td>

											<!--CLINIC REVENUE-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNoon == $noon ) {

														$pfTotal += $pf;
														echo $ro4->number_format($pf);

													}else if( $hospitalBill == '' && $lastPaymentNoon == $noon ) {

														$pfTotal += $pf;
														echo $ro4->number_format($pf);

													}else{ }
												?>
											</td>

											<!--LABORATORY-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNoon == $noon ) {

														$laboratoryTotal += $laboratory;
														echo $ro4->number_format($laboratory);

													}else if( $hospitalBill == '' && $lastPaymentNoon == $noon ) {

														$laboratoryTotal += $laboratory;
														echo $ro4->number_format($laboratory);

													}else { }
												?>
											</td>

											<!--MISCELLANEOUS-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNoon == $noon ) {

														$miscTotal += $misc;
														echo $ro4->number_format($misc);

													}else if( $hospitalBill == '' && $lastPaymentNoon == $noon ) {

														$miscTotal += $misc;
														echo $ro4->number_format($misc);

													}else { }
												?>
											</td>

											<!--OTHERS-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNoon == $noon ) {

														$othersTotal += $others;
														echo $ro4->number_format($others);

													}else if( $hospitalBill == '' && $lastPaymentNoon == $noon ) {

														$othersTotal += $others;
														echo $ro4->number_format($others);

													}else { }
												?>
											</td>

											<!--ER FEE-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNoon == $noon ) {

														$erfeeTotal += $erfee;
														echo $ro4->number_format($erfee);

													}else if( $hospitalBill == '' && $lastPaymentNoon == $noon ) {

														$erfeeTotal += $erfee;
														echo $ro4->number_format($erfee);

													}else { }
												?>
											</td>

											<!--DEPOSIT-->
											<td class='white'> 
												<?
													if( $totalDeposit > 0 ) {
														$lessDeposit += $totalDeposit;
														echo '-'.$ro4->number_format($totalDeposit);
													}else { }
												?>
											</td> 

											<!--BALANCE PAID-->
											<td> </td>

										</tr>
									<? }else { } ?>

								<? }else { } ?>

							<? } ?>

							<!--NOON DEPOSIT-->
							<? foreach( $ts->list_deposit_paymentNo() as $paymentNo ) { ?>
								
								<? if( $ro->selectNow('patientPayment','shift','paymentNo',$paymentNo) == $noon ) { ?>
									<?
										$registrationNo = $ro->selectNow('patientPayment','registrationNo','paymentNo',$paymentNo);
										$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
										$lastName = $ro->selectNow('patientRecord','lastName','patientNo',$patientNo);
										$firstName = $ro->selectNow('patientRecord','firstName','patientNo',$patientNo);
										$orNo = $ro->selectNow('patientPayment','orNo','paymentNo',$paymentNo);

										//DEBIT
										$cashDeposit = $ro->doubleSelectNow('patientPayment','amountPaid','paymentNo',$paymentNo,'paidVia',$cash);
										$creditCardDeposit = $ro->doubleSelectNow('patientPayment','amountPaid','paymentNo',$paymentNo,'paidVia',$creditCard);


									?>
									<tr>
										<td><!--DATE--></td>

										<!--OR#-->
										<td class='white'>
											<?
												echo $orNo
											?>
										</td>

										<!--LASTNAME-->
										<td class='white'>
											<?
												echo $lastName
											?>
										</td>

										<!--FIRSTNAME-->
										<td class='white'>
											<?
												echo $firstName
											?>
										</td>

										<!--CASH / CARD-->
										<td class='white'>
											<?
												echo $ro4->number_format(($cashDeposit + $creditCardDeposit))
											?>
										</td>

										<td><!--HMO NAME--></td>

										<!--IPD BILL-->
										<td class='white'>
											<?
												$ipdBillTotal += ( $cashDeposit + $creditCardDeposit );
												echo $ro4->number_format(($cashDeposit + $creditCardDeposit));
											?>
										</td>

										<!--CASH-->
										<td class='white'>
											<?
												$cashDepositTotal += $cashDeposit;
												$cashTotal += $cashDeposit;
												echo $ro4->number_format($cashDeposit)
											?>
										</td>

										<td><!--DISCOUNT--></td>

										<!--CREDIT CARD-->
										<td class='white'>
											<?
												$creditCardDepositTotal += $creditCardDeposit;
												$creditCardTotal += $creditCardDeposit;
												echo $ro4->number_format($creditCardDeposit)
											?>
										</td>

										<td><!--HMO--></td>
										<td><!--Company--></td>
										<td><!--Personal--></td>
										<td><!--Philhealth--></td>
										<td><!--Medicine--></td>
										<td><!--Supplies--></td>
										<td><!--OR FEE--></td>
										<td><!--ROOM--></td>
										<td><!--PT--></td>
										<td><!--SPIRO--></td>
										<td><!--XRAY--></td>
										<td><!--ECG--></td>
										<td><!--CTSCAN--></td>
										<td><!--UTZ--></td>
										<td><!--CLINIC REVENUE--></td>
										<td><!--LABORATORY--></td>
										<td><!--MISCELLANEOUS--></td>
										<td><!--OTHERS--></td>
										<td><!--ER FEE--></td>
										<td class='white'>
											<?
												$addDeposit += ( $cashDeposit + $creditCardDeposit );
												echo $ro4->number_format($cashDeposit + $creditCardDeposit)
											?>
										</td>
										<td><!--BALANCE PAID--></td>

									</tr>
								<? }else { } ?>
							
							<? } ?>

							<!--NOON BALANCE PAID-->
							<? foreach( $ts->list_inpatient_balance_paid_paymentNo() as $paymentNo ) { ?>
								<?
									$registrationNo = $ro->selectNow('patientPayment','registrationNo','paymentNo',$paymentNo);
									$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
									$lastName = $ro->selectNow('patientRecord','lastName','patientNo',$patientNo);
									$firstName = $ro->selectNow('patientRecord','firstName','patientNo',$patientNo);
									$shift = $ro->selectNow('patientPayment','shift','paymentNo',$paymentNo);
									$orNo = $ro->selectNow('patientPayment','orNo','paymentNo',$paymentNo);

									$cashPayment = $ro->doubleSelectNow('patientPayment','amountPaid','paymentNo',$paymentNo,'paidVia',$cash);
									$creditCardPayment = $ro->doubleSelectNow('patientPayment','amountPaid','paymentNo',$paymentNo,'paidVia',$creditCard);

									$totalPaid = ( $cashPayment + $creditCardPayment );

								?>
								<? if( $shift == $noon ) { ?>
									<tr>
										<td><!--DATE--></td>
										<td class='white'>
											<?
												echo $orNo
											?>
										</td>
										<td class='white'>
											<?
												echo $lastName
											?>
										</td>
										<td class='white'>
											<?
												echo $firstName
											?>
										</td>
										<td class='white'>
											<?
												echo $ro4->number_format($totalPaid)
											?>
										</td>
										<td><!--HMO NAME--></td>
										<td class='white'>
											<?
												echo $ro4->number_format($totalPaid)
											?>
										</td>
										<td class='white'>
											<?
												$cashTotal += $cashPayment;
												echo $ro4->number_format($cashPayment)
											?>
										</td>
										<td><!--DISCOUNT--></td>
										<td class='white'>
											<?
												$creditCardTotal += $creditCardPayment;
												echo $ro4->number_format($creditCardPayment)
											?>
										</td>
										<td><!--HMO--></td>
										<td><!--COMPANY--></td>
										<td><!--PERSONAL--></td>
										<td><!--PHILHEALTH--></td>
										<td><!--MEDICINE--></td>
										<td><!--SUPPLIES--></td>
										<td><!--OR FEE--></td>
										<td><!--ROOM--></td>
										<td><!--PT--></td>
										<td><!--SPIRO--></td>
										<td><!--XRAY--></td>
										<td><!--ECG--></td>
										<td><!--CTSCAN--></td>
										<td><!--UTZ--></td>
										<td><!--CLINIC REVENUE--></td>
										<td><!--LABORATORY--></td>
										<td><!--MISCELLANEOUS--></td>
										<td><!--OTHERS--></td>
										<td><!--ER FEE--></td>
										<td><!--DEPOSIT--></td>
										<td class='white'>
											<?
												$balancePaidTotal += $totalPaid;
												echo $ro4->number_format($totalPaid)
											?>
										</td>
									</tr>
								<? }else { } ?>
							<? } ?>							




							<!--AFTERNOON HOSPITAL BILL-->
							<tr>
								<td class='shift'><h5>Afternoon</h5></td>
								<td><!--OR#--></td>
								<td><!--LASTNAME--></td>
								<td><!--FIRSTNAME--></td>
								<td><!--CASH/CARD--></td>
								<td><!--HMO NAME--></td>
								<td><!--IPD BILL--></td>
								<td><!--CASH--></td>
								<td><!--DISCOUNT--></td>
								<td><!--CREDIT CARD--></td>
								<td><!--HMO--></td>
								<td><!--COMPANY--></td>
								<td><!--PERSONAL--></td>
								<td><!--PHILHEALTH--></td>
								<td><!--MEDICINE--></td>
								<td><!--SUPPLIES--></td>
								<td><!--OR FEE--></td>
								<td><!--ROOM--></td>
								<td><!--PT--></td>
								<td><!--SPIRO--></td>
								<td><!--XRAY--></td>
								<td><!--ECG--></td>
								<td><!--CTSCAN--></td>
								<td><!--UTZ--></td>
								<td><!--CLINIC REVENUE--></td>
								<td><!--LABORATORY--></td>
								<td><!--MISCELLANEOUS--></td>
								<td><!--OTHERS--></td>
								<td><!--ER FEE--></td>
								<td><!--DEPOSIT--></td>
								<td><!--BALANCE PAID--></td>
							</tr>							
							<? foreach( $ts->get_discharged_inpatients_registrationNo() as $registrationNo ) { ?>								

								<? if( $ts->get_inpatient_shift($registrationNo,$afternoon) == 'Afternoon' ) { ?>
									
									<? 
										//get the shift of last payment of ipd in patientPayment tbl								
										$lastPaymentAfternoon = $ro4->doubleSelectLast('patientPayment','shift','registrationNo',$registrationNo,'paymentFor','HOSPITAL BILL','paymentNo');

										$orNo = $ro->doubleSelectNow('patientPayment','orNo','registrationNo',$registrationNo,'paymentFor','HOSPITAL BILL');

										//DEBIT
										$cashPayment = $ts->get_inpatient_payment($registrationNo,$cash,$afternoon);
										$deposit = $ts->get_inpatient_deposit($registrationNo,$cash,$afternoon);
										$creditCardPayment = $ts->get_inpatient_payment($registrationNo,$creditCard,$afternoon);
										$depositCr = $ts->get_inpatient_deposit($registrationNo,$creditCard,$afternoon);
										$discount = $ro->selectNow('registrationDetails','discount','registrationNo',$registrationNo);
										$hmoCover = $ts->get_inpatient_hmo($registrationNo,$hmo,$afternoon);
										$companyCover = $ts->get_inpatient_hmo($registrationNo,$company,$afternoon);
										$philhealthCover = $ts->get_inpatient_philhealth($registrationNo);

										$patient_debit_total = (
											$cashPayment +
											$deposit +
											$creditCardPayment +
											$depositCr +
											$discount +
											$hmoCover +
											$companyCover +
											$philhealthCover
										);

										//paymentFor = HOSPITAL BILL
										$hospitalBill = ( $cashPayment + $creditCardPayment );

										//paymentFor = DEPOSIT
										$totalDeposit = ( $deposit + $depositCr );

										//CREDIT
										$medicine = (
											$ro4->inpatient_title_total_inventory($registrationNo,'total','MEDICINE') +
											$ro4->inpatient_paymentMode_total_inventory_takeHomeMeds($registrationNo,"total")
										);
										$supplies = $ro4->inpatient_title_total($registrationNo,'total','SUPPLIES');
										$or = $ro4->inpatient_title_total($registrationNo,'total','OR/DR/ER Fee');
										$room = $ro4->inpatient_title_total($registrationNo,'total','Room and Board');
										$pt = $ro4->inpatient_title_total($registrationNo,'total','PT');
										$spiro = $ro4->inpatient_title_total($registrationNo,'total','SPIROMETRY');
										$xray = $ro4->inpatient_title_total($registrationNo,'total','XRAY');		
										$ecg = $ro4->inpatient_title_total($registrationNo,'total','ECG');
										$ctscan = $ro4->inpatient_title_total($registrationNo,'total','CTSCAN');
										$utz = $ro4->inpatient_title_total($registrationNo,'total','ULTRASOUND');
										$pf = $ro4->inpatient_title_total($registrationNo,'total','PROFESSIONAL FEE');
										$laboratory = $ro4->inpatient_title_total($registrationNo,'total','LABORATORY');
										$misc = $ro4->inpatient_title_total($registrationNo,'total','MISCELLANEOUS');
										$others = $ro4->inpatient_title_total($registrationNo,'total','OTHERS');
										$erfee = $ro4->inpatient_title_total($registrationNo,'total','ER FEE');

										$total = ( $medicine + $supplies + $or + $room + $pt + $spiro + $xray + $ecg + $ctscan + $utz + $pf + $laboratory + $misc + $others + $erfee );

										$hospitalBillCash = $ts->get_inpatient_payment_for($registrationNo,$cash,$afternoon);
										$hospitalBillCreditCard = $ts->get_inpatient_payment_for($registrationNo,$creditCard,$afternoon);

										$balance = ( $total - $patient_debit_total );

									 ?>

									 <? if( $hospitalBillCash == 'HOSPITAL BILL' || $hospitalBillCreditCard == 'HOSPITAL BILL' ) { ?>
										<tr>
											<!--DATE-->
											<td>
												
											</td>

											<!--OR#-->
											<td class='white'>
												<?
													echo $orNo
												?>
											</td>
											
											<!--LASTNAME-->
											<td class='white'>
												<?
													$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
													$lastName = $ro->selectNow('patientRecord','lastName','patientNo',$patientNo);
													echo $lastName;

													if( $balance < 0 ) {
														$excessPaymentTotal += abs($balance);
														$format = number_format(abs($balance));
														echo "<br>";
														echo "<i style='color:red; font-size:12px'>Excess: ".$format."</i>";
													}else { }													
												?>
											</td>

											<!--FIRSTNAME-->
											<td class='white'>
												<?
													$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
													$firstName = $ro->selectNow('patientRecord','firstName','patientNo',$patientNo);
													echo $firstName;
												?>
											</td>

											<!--CASH/CARD-->
											<td class='white'>
												<?
													$cashCardTotal += ($cashPayment + $creditCardPayment);					
													echo $ro4->number_format($cashPayment + $creditCardPayment);

												?>											
											</td>

											<!--HMO/COMPANY NAME-->
											<td class='white'>
												<?
													echo $ro->selectNow('registrationDetails','Company','registrationNo',$registrationNo)
												?>
											</td>

											<!--IPD BILL-->
											<td class='white'>
												<?
													$ipdBillTotal += ( $total - $deposit );
													echo $ro4->number_format( ($total - $deposit) )
												?>
											</td>

											<!--CASH-->
											<td class='white'>
												<?
													$cashTotal += $cashPayment;
													echo $ro4->number_format($cashPayment);
												?>
											</td>

											<!--DISCOUNT-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentAfternoon == $afternoon ) {

														$discountTotal += $discount;
														echo $ro4->number_format($discount);
													
													}else if( $hospitalBill == '' && $lastPaymentAfternoon == $afternoon ) {
														
														$discountTotal += $discount;
														echo $ro4->number_format($discount);													
													
													}else { }
												?>											
											</td>

											<!--CREDIT CARD-->
											<td class='white'>
												<?
													$creditCardTotal += $creditCardPayment;
													echo $ro4->number_format($creditCardPayment);
												?>
											</td>

											<!--HMO-->
											<td class='white'>
												<?	
													if( $hospitalBill > 0 && $lastPaymentAfternoon == $afternoon ) {
													
														$hmoTotal += $hmoCover;
														echo $ro4->number_format($hmoCover);
													
													}else if( $hospitalBill == '' && $lastPaymentAfternoon == $afternoon ) {
													
														$hmoTotal += $hmoCover;
														echo $ro4->number_format($hmoCover);
													
													}else { }
												?>
											</td>

											<!--COMPANY-->										
											<td class='white'>
												<?
													//only shows company if the cash payment is HOSPITAL BILL not DEPOSIT.
													if( $hospitalBill > 0 && $lastPaymentAfternoon == $afternoon ) {
													
														$companyTotal += $companyCover;
														echo $ro4->number_format($companyCover);
													
													}else if( $hospitalBill == '' && $lastPaymentAfternoon == $afternoon ) {
													
														$companyTotal += $companyCover;
														echo $ro4->number_format($companyCover);
													
													}else { }	
												?>
											</td>

											<!--PERSONAL-->
											<td class='white'>
												<?
													if( $balance > 0 ) {
														$balanceTotal += $balance;
													}else { }
													echo $ro4->number_format($balance);
												?>
											</td>

											<!--PHILHEALTH-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentAfternoon == $afternoon ) {
													
														$philhealthTotal += $philhealthCover;
														echo $ro4->number_format($philhealthCover);
													
													}else if( $hospitalBill == '' && $lastPaymentAfternoon == $afternoon ) {
													
														$philhealthTotal += $philhealthCover;
														echo $ro4->number_format($philhealthCover);
													
													}else { }
												?>
											</td>

											<!--MEDICINE-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentAfternoon == $afternoon ) {
													
														$medicineTotal += $medicine;
														echo $ro4->number_format($medicine);
													
													}else if( $hospitalBill == '' && $lastPaymentAfternoon == $afternoon ) {
													
														$medicineTotal += $medicine;
														echo $ro4->number_format($medicine);													
													
													}else { }
												?>
											</td>

											<!--SUPPLIES-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentAfternoon == $afternoon ) {
													
														$suppliesTotal += $supplies;
														echo $ro4->number_format($supplies);
													
													}else if( $hospitalBill == '' && $lastPaymentAfternoon == $afternoon ) {
													
														$suppliesTotal += $supplies;
														echo $ro4->number_format($supplies);													
													
													}else { }
												?>
											</td>

											<!--OR FEE-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentAfternoon == $afternoon ) {

														$orTotal += $or;
														echo $ro4->number_format($or);

													}else if( $hospitalBill == '' && $lastPaymentAfternoon == $afternoon ) {

														$orTotal += $or;
														echo $ro4->number_format($or);

													}else { }		
												?>
											</td>

											<!--ROOM-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentAfternoon == $afternoon ) {

														$roomTotal += $room;
														echo $ro4->number_format($room);

													}else if( $hospitalBill == '' && $lastPaymentAfternoon == $afternoon ) {

														$roomTotal += $room;
														echo $ro4->number_format($room);

													}else { }
												?>
											</td>

											<!--PT-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentAfternoon == $afternoon ) {

														$ptTotal += $pt;
														echo $ro4->number_format($pt);

													}else if( $hospitalBill == '' && $lastPaymentAfternoon == $afternoon ) {

														$ptTotal += $pt;
														echo $ro4->number_format($pt);

													}else { }
												?>
											</td>

											<!--SPIRO-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentAfternoon == $afternoon ) {

														$spiroTotal += $spiro;
														echo $ro4->number_format($spiro);

													}else if( $hospitalBill == '' && $lastPaymentAfternoon == $afternoon ) {

														$spiroTotal += $spiro;
														echo $ro4->number_format($spiro);

													}else { }
												?>
											</td>

											<!--XRAY-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentAfternoon == $afternoon ) {

														$xrayTotal += $xray;
														echo $ro4->number_format($xray);

													}else if( $hospitalBill == '' && $lastPaymentAfternoon == $afternoon ) {

														$xrayTotal += $xray;
														echo $ro4->number_format($xray);

													}else { }
												?>
											</td>

											<!--ECG-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentAfternoon == $afternoon ) {

														$ecgTotal += $ecg;
														echo $ro4->number_format($ecg);

													}else if( $hospitalBill == '' && $lastPaymentAfternoon == $afternoon ) {

														$ecgTotal += $ecg;
														echo $ro4->number_format($ecg);

													}else { }
												?>
											</td>

											<!--CTSCAN-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentAfternoon == $afternoon ) {

														$ctscanTotal += $ctscan;
														echo $ro4->number_format($ctscan);

													}else if( $hospitalBill == '' && $lastPaymentAfternoon == $afternoon ) {

														$ctscanTotal += $ctscan;
														echo $ro4->number_format($ctscan);

													}else { }
												?>
											</td>

											<!--UTZ-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentAfternoon == $afternoon ) {

														$utzTotal += $utz;
														echo $ro4->number_format($utz);

													}else if( $hospitalBill == '' && $lastPaymentAfternoon == $afternoon ) {

														$utzTotal += $utz;
														echo $ro4->number_format($utz);

													}else { }
												?>
											</td>

											<!--CLINIC REVENUE-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentAfternoon == $afternoon ) {

														$pfTotal += $pf;
														echo $ro4->number_format($pf);

													}else if( $hospitalBill == '' && $lastPaymentAfternoon == $afternoon ) {

														$pfTotal += $pf;
														echo $ro4->number_format($pf);

													}else { }
												?>
											</td>

											<!--LABORATORY-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentAfternoon == $afternoon ) {

														$laboratoryTotal += $laboratory;
														echo $ro4->number_format($laboratory);

													}else if( $hospitalBill == '' && $lastPaymentAfternoon == $afternoon  ) {

														$laboratoryTotal += $laboratory;
														echo $ro4->number_format($laboratory);

													}else { }
												?>
											</td>

											<!--MISCELLANEOUS-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentAfternoon == $afternoon ) {

														$miscTotal += $misc;
														echo $ro4->number_format($misc);

													}else if( $hospitalBill == '' && $lastPaymentAfternoon == $afternoon ) {

														$miscTotal += $misc;
														echo $ro4->number_format($misc);

													}else { }
												?>
											</td>

											<!--OTHERS-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentAfternoon == $afternoon ) {

														$othersTotal += $others;
														echo $ro4->number_format($others);

													}else if( $hospitalBill == '' && $lastPaymentAfternoon == $afternoon ) {

														$othersTotal += $others;
														echo $ro4->number_format($others);

													}else { }
												?>
											</td>

											<!--ER FEE-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentAfternoon == $afternoon ) {

														$erfeeTotal += $erfee;
														echo $ro4->number_format($erfee);

													}else if( $hospitalBill == '' && $lastPaymentAfternoon == $afternoon ) {

														$erfeeTotal += $erfee;
														echo $ro4->number_format($erfee);

													}else { }
												?>
											</td>

											<!--DEPOSIT-->
											<td class='white'> 
												<?
													if( $totalDeposit > 0 ) {
														$lessDeposit += $totalDeposit;
														echo '-'.$ro4->number_format($totalDeposit);
													}else { }
												?>
											</td>

											<!--BALANCE PAID-->
											<td></td>

										</tr>
									<? }else { } ?>

								<? }else { } ?>

							<? } ?>

							<!--AFTERNOON DEPOSIT-->
							<? foreach( $ts->list_deposit_paymentNo() as $paymentNo ) { ?>
								
								<? if( $ro->selectNow('patientPayment','shift','paymentNo',$paymentNo) == $afternoon ) { ?>
									<?
										$registrationNo = $ro->selectNow('patientPayment','registrationNo','paymentNo',$paymentNo);
										$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
										$lastName = $ro->selectNow('patientRecord','lastName','patientNo',$patientNo);
										$firstName = $ro->selectNow('patientRecord','firstName','patientNo',$patientNo);
										$orNo = $ro->selectNow('patientPayment','orNo','paymentNo',$paymentNo);

										//DEBIT
										$cashDeposit = $ro->doubleSelectNow('patientPayment','amountPaid','paymentNo',$paymentNo,'paidVia',$cash);
										$creditCardDeposit = $ro->doubleSelectNow('patientPayment','amountPaid','paymentNo',$paymentNo,'paidVia',$creditCard);


									?>
									<tr>
										<td><!--DATE--></td>

										<!--OR#-->
										<td class='white'>
											<?
												echo $orNo
											?>
										</td>

										<!--LASTNAME-->
										<td class='white'>
											<?
												echo $lastName
											?>
										</td>

										<!--FIRSTNAME-->
										<td class='white'>
											<?
												echo $firstName
											?>
										</td>

										<!--CASH / CARD-->
										<td class='white'>
											<?
												echo $ro4->number_format(($cashDeposit + $creditCardDeposit))
											?>
										</td>

										<td><!--HMO NAME--></td>

										<!--IPD BILL-->
										<td class='white'>
											<?
												$ipdBillTotal += ( $cashDeposit + $creditCardDeposit );
												echo $ro4->number_format(($cashDeposit + $creditCardDeposit));
											?>
										</td>

										<!--CASH-->
										<td class='white'>
											<?
												$cashDepositTotal += $cashDeposit;
												$cashTotal += $cashDeposit;
												echo $ro4->number_format($cashDeposit)
											?>
										</td>

										<td><!--DISCOUNT--></td>

										<!--CREDIT CARD-->
										<td class='white'>
											<?
												$creditCardDepositTotal += $creditCardDeposit;
												$creditCardTotal += $creditCardDeposit;
												echo $ro4->number_format($creditCardDeposit)
											?>
										</td>

										<td><!--HMO--></td>
										<td><!--Company--></td>
										<td><!--Personal--></td>
										<td><!--Philhealth--></td>
										<td><!--Medicine--></td>
										<td><!--Supplies--></td>
										<td><!--OR FEE--></td>
										<td><!--ROOM--></td>
										<td><!--PT--></td>
										<td><!--SPIRO--></td>
										<td><!--XRAY--></td>
										<td><!--ECG--></td>
										<td><!--CTSCAN--></td>
										<td><!--UTZ--></td>
										<td><!--CLINIC REVENUE--></td>
										<td><!--LABORATORY--></td>
										<td><!--MISCELLANEOUS--></td>
										<td><!--OTHERS--></td>
										<td><!--ER FEE--></td>
										<td class='white'>
											<?
												$addDeposit += ( $cashDeposit + $creditCardDeposit );
												echo $ro4->number_format($cashDeposit + $creditCardDeposit)
											?>
										</td>
										<td><!--BALANCE PAID--></td>

									</tr>
								<? }else { } ?>
							
							<? } ?>							

							<!--AFTERNOON BALANCE PAID-->
							<? foreach( $ts->list_inpatient_balance_paid_paymentNo() as $paymentNo ) { ?>
								<?
									$registrationNo = $ro->selectNow('patientPayment','registrationNo','paymentNo',$paymentNo);
									$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
									$lastName = $ro->selectNow('patientRecord','lastName','patientNo',$patientNo);
									$firstName = $ro->selectNow('patientRecord','firstName','patientNo',$patientNo);
									$shift = $ro->selectNow('patientPayment','shift','paymentNo',$paymentNo);
									$orNo = $ro->selectNow('patientPayment','orNo','paymentNo',$paymentNo);

									$cashPayment = $ro->doubleSelectNow('patientPayment','amountPaid','paymentNo',$paymentNo,'paidVia',$cash);
									$creditCardPayment = $ro->doubleSelectNow('patientPayment','amountPaid','paymentNo',$paymentNo,'paidVia',$creditCard);

									$totalPaid = ( $cashPayment + $creditCardPayment );

								?>
								<? if( $shift == $afternoon ) { ?>
									<tr>
										<td><!--DATE--></td>
										<td class='white'>
											<?
												echo $orNo
											?>
										</td>
										<td class='white'>
											<?
												echo $lastName
											?>
										</td>
										<td class='white'>
											<?
												echo $firstName
											?>
										</td>
										<td class='white'>
											<?
												echo $ro4->number_format($totalPaid)
											?>
										</td>
										<td><!--HMO NAME--></td>
										<td class='white'>
											<?
												echo $ro4->number_format($totalPaid)
											?>
										</td>
										<td class='white'>
											<?
												$cashTotal += $cashPayment;
												echo $ro4->number_format($cashPayment)
											?>
										</td>
										<td><!--DISCOUNT--></td>
										<td class='white'>
											<?
												$creditCardTotal += $creditCardPayment;
												echo $ro4->number_format($creditCardPayment)
											?>
										</td>
										<td><!--HMO--></td>
										<td><!--COMPANY--></td>
										<td><!--PERSONAL--></td>
										<td><!--PHILHEALTH--></td>
										<td><!--MEDICINE--></td>
										<td><!--SUPPLIES--></td>
										<td><!--OR FEE--></td>
										<td><!--ROOM--></td>
										<td><!--PT--></td>
										<td><!--SPIRO--></td>
										<td><!--XRAY--></td>
										<td><!--ECG--></td>
										<td><!--CTSCAN--></td>
										<td><!--UTZ--></td>
										<td><!--CLINIC REVENUE--></td>
										<td><!--LABORATORY--></td>
										<td><!--MISCELLANEOUS--></td>
										<td><!--OTHERS--></td>
										<td><!--ER FEE--></td>
										<td><!--DEPOSIT--></td>
										<td class='white'>
											<?
												$balancePaidTotal += $totalPaid;
												echo $ro4->number_format($totalPaid)
											?>
										</td>
									</tr>
								<? }else { } ?>
							<? } ?>


							<!--NIGHT HOSPITAL BILL-->
							<tr>
								<td class='shift'><h5>Night</h5></td>
								<td><!--OR#--></td>
								<td><!--LASTNAME--></td>
								<td><!--FIRSTNAME--></td>
								<td><!--CASH/CARD--></td>
								<td><!--HMO NAME--></td>
								<td><!--IPD BILL--></td>
								<td><!--CASH--></td>
								<td><!--DISCOUNT--></td>
								<td><!--CREDIT CARD--></td>
								<td><!--HMO--></td>
								<td><!--COMPANY--></td>
								<td><!--PERSONAL--></td>
								<td><!--PHILHEALTH--></td>
								<td><!--MEDICINE--></td>
								<td><!--SUPPLIES--></td>
								<td><!--OR FEE--></td>
								<td><!--ROOM--></td>
								<td><!--PT--></td>
								<td><!--SPIRO--></td>
								<td><!--XRAY--></td>
								<td><!--ECG--></td>
								<td><!--CTSCAN--></td>
								<td><!--UTZ--></td>
								<td><!--CLINIC REVENUE--></td>
								<td><!--LABORATORY--></td>
								<td><!--MISCELLANEOUS--></td>
								<td><!--OTHERS--></td>
								<td><!--ER FEE--></td>
								<td><!--DEPOSIT--></td>
								<td><!--BALANCE PAID--></td>
							</tr>							
							<? foreach( $ts->get_discharged_inpatients_registrationNo() as $registrationNo ) { ?>								

								<? if( $ts->get_inpatient_shift($registrationNo,$night) == 'Night' ) { ?>

									<? 
										//get the shift of last payment of ipd in patientPayment tbl								
										$lastPaymentNight = $ro4->doubleSelectLast('patientPayment','shift','registrationNo',$registrationNo,'paymentFor','HOSPITAL BILL','paymentNo');

										$orNo = $ro->doubleSelectNow('patientPayment','orNo','registrationNo',$registrationNo,'paymentFor','HOSPITAL BILL');										

										//DEBIT
										$cashPayment = $ts->get_inpatient_payment($registrationNo,$cash,$night);
										$deposit = $ts->get_inpatient_deposit($registrationNo,$cash,$night);
										$creditCardPayment = $ts->get_inpatient_payment($registrationNo,$creditCard,$night);
										$depositCr = $ts->get_inpatient_deposit($registrationNo,$creditCard,$night);	
										$discount = $ro->selectNow('registrationDetails','discount','registrationNo',$registrationNo);
										$hmoCover = $ts->get_inpatient_hmo($registrationNo,$hmo,$night);
										$companyCover = $ts->get_inpatient_hmo($registrationNo,$company,$night);
										$philhealthCover = $ts->get_inpatient_philhealth($registrationNo);

										$patient_debit_total = (
												$cashPayment +
												$deposit +
												$creditCardPayment +
												$depositCr +
												$discount +
												$hmoCover +
												$companyCover +
												$philhealthCover
											);

										//paymentFor = HOSPITAL BILL
										$hospitalBill = ($cashPayment + $creditCardPayment);

										//paymentFor = DEPOSIT
										$totalDeposit = ( $deposit + $depositCr );

										//CREDIT
										$medicine = (
											$ro4->inpatient_title_total_inventory($registrationNo,'total','MEDICINE') +
											$ro4->inpatient_paymentMode_total_inventory_takeHomeMeds($registrationNo,"total")
										);
										$supplies = $ro4->inpatient_title_total($registrationNo,'total','SUPPLIES');
										$or = $ro4->inpatient_title_total($registrationNo,'total','OR/DR/ER Fee');
										$room = $ro4->inpatient_title_total($registrationNo,'total','Room and Board');
										$pt = $ro4->inpatient_title_total($registrationNo,'total','PT');
										$spiro = $ro4->inpatient_title_total($registrationNo,'total','SPIROMETRY');
										$xray = $ro4->inpatient_title_total($registrationNo,'total','XRAY');
										$ecg = $ro4->inpatient_title_total($registrationNo,'total','ECG');
										$ctscan = $ro4->inpatient_title_total($registrationNo,'total','CTSCAN');
										$utz = $ro4->inpatient_title_total($registrationNo,'total','ULTRASOUND');
										$pf = $ro4->inpatient_title_total($registrationNo,'total','PROFESSIONAL FEE');
										$laboratory = $ro4->inpatient_title_total($registrationNo,'total','LABORATORY');
										$misc = $ro4->inpatient_title_total($registrationNo,'total','MISCELLANEOUS');
										$others = $ro4->inpatient_title_total($registrationNo,'total','OTHERS');
										$erfee = $ro4->inpatient_title_total($registrationNo,'total','ER FEE');

										$total = ( $medicine + $supplies + $or + $room + $pt + $spiro + $xray + $ecg + $ctscan + $utz + $pf + $laboratory + $misc + $others + $erfee );


										$hospitalBillCash = $ts->get_inpatient_payment_for($registrationNo,$cash,$night);
										$hospitalBillCreditCard = $ts->get_inpatient_payment_for($registrationNo,$creditCard,$night);

										$balance = ( $total - $patient_debit_total );	

									 ?>

									 <? if( $hospitalBillCash == 'HOSPITAL BILL' || $hospitalBillCreditCard == 'HOSPITAL BILL' ) { ?>
										<tr>
											<!--DATE-->
											<td>
												
											</td>

											<!--OR#-->
											<td class='white'>
												<?
													echo $orNo
												?>
											</td>

											<!--LASTNAME-->
											<td class='white'>
												<?
													$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
													$lastName = $ro->selectNow('patientRecord','lastName','patientNo',$patientNo);
													echo $lastName;

													if( $balance < 0 ) {
														$excessPaymentTotal += abs($balance);
														$format = number_format(abs($balance));
														echo "<br>";
														echo "<i style='color:red; font-size:12px'>Excess: ".$format."</i>";
													}else { }

												?>
											</td>

											<!--FIRSTNAME-->
											<td class='white'>
												<?
													$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
													$firstName = $ro->selectNow('patientRecord','firstName','patientNo',$patientNo);
													echo $firstName;
												?>
											</td>

											<!--CASH/CARD-->
											<td class='white'>
												<?
													$cashCardTotal += ($cashPayment + $creditCardPayment);					
													echo $ro4->number_format($cashPayment + $creditCardPayment);
												?>											
											</td>

											<!--HMO/COMPANY NAME-->
											<td class='white'>
												<?
													echo $ro->selectNow('registrationDetails','Company','registrationNo',$registrationNo)
												?>
											</td>

											<!--IPD BILL-->
											<td class='white'>
												<?
													$ipdBillTotal += ( $total - $deposit );
													echo $ro4->number_format( ($total - $deposit) )
												?>
											</td>

											<!--CASH-->
											<td class='white'>
												<?
													$cashTotal += $cashPayment;
													echo $ro4->number_format($cashPayment);
												?>
											</td>

											<!--DISCOUNT-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNight == $night ) {
													
														$discountTotal += $discount;
														echo $ro4->number_format($discount);
													
													}else if( $hospitalBill == '' && $lastPaymentNight == $night ) {

														$discountTotal += $discount;
														echo $ro4->number_format($discount);

													}else { }
												?>											
											</td>

											<!--CREDIT CARD-->
											<td class='white'>
												<?
													$creditCardTotal += $creditCardPayment;
													echo $ro4->number_format($creditCardPayment)
												?>
											</td>

											<!--HMO-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 || $lastPaymentNight == $night ) {
														
														$hmoTotal += $hmoCover;
														echo $ro4->number_format($hmoCover);
													
													}else if( $hospitalBill == '' && $lastPaymentNight == $night ) {

														$hmoTotal += $hmoCover;
														echo $ro4->number_format($hmoCover);												

													}else { }
												?>
											</td>

											<!--COMPANY-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNight == $night ) {

														$companyTotal += $companyCover;
														echo $ro4->number_format($companyCover);

													}else if( $hospitalBill == '' && $lastPaymentNight == $night ) {

														$companyTotal += $companyCover;
														echo $ro4->number_format($companyCover);

													}else {	}
												?>
											</td>

											<!--PERSONAL-->
											<td class='white'>
												<?
													if( $balance > 0 ) {
														$balanceTotal += $balance;
													}else { }
													echo $ro4->number_format($balance);
												?>
											</td>

											<!--PHILHEALTH-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNight == $night ) {

														$philhealthTotal += $philhealthCover;
														echo $ro4->number_format($philhealthCover);
													
													}else if( $hospitalBill == '' && $lastPaymentNight == $night ) {

														$philhealthTotal += $philhealthCover;
														echo $ro4->number_format($philhealthCover);

													}
													else { }
												?>
											</td>

											<!--MEDICINE-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNight == $night ) {

														$medicineTotal += $medicine;
														echo $ro4->number_format($medicine);
													
													}else if( $hospitalBill == '' && $lastPaymentNight == $night ) {

														$medicineTotal += $medicine;
														echo $ro4->number_format($medicine);

													}else { }
												?>
											</td>

											<!--SUPPLIES-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNight == $night ) {

														$suppliesTotal += $supplies;
														echo $ro4->number_format($supplies);
													
													}else if( $hospitalBill == '' && $lastPaymentNight == $night ) {

														$suppliesTotal += $supplies;
														echo $ro4->number_format($supplies);

													}else { }
												?>
											</td>

											<!--OR FEE-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNight == $night ) {

														$orTotal += $or;
														echo $ro4->number_format($or);

													}else if( $hospitalBill == '' && $lastPaymentNight == $night ) {

														$orTotal += $or;
														echo $ro4->number_format($or);

													}else { }
												?>
											</td>

											<!--ROOM-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNight == $night ) {

														$roomTotal += $room;
														echo $ro4->number_format($room);

													}else if( $hospitalBill == '' && $lastPaymentNight == $night ) {

														$roomTotal += $room;
														echo $ro4->number_format($room);

													}else { }
												?>
											</td>

											<!--PT-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNight == $night ) {

														$ptTotal += $pt;
														echo $ro4->number_format($pt);

													}else if( $hospitalBill == '' && $lastPaymentNight == $night ) {

														$ptTotal += $pt;
														echo $ro4->number_format($pt);

													}else { }
												?>
											</td>

											<!--SPIRO-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNight == $night ) {

														$spiroTotal += $spiro;
														echo $ro4->number_format($spiro);

													}else if( $hospitalBill == '' && $lastPaymentNight == $night ) {

														$spiroTotal += $spiro;
														echo $ro4->number_format($spiro);

													}else { }
												?>
											</td>

											<!--XRAY-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNight == $night ) {

														$xrayTotal += $xray;
														echo $ro4->number_format($xray);

													}else if( $hospitalBill == '' && $lastPaymentNight == $night ) {

														$xrayTotal += $xray;
														echo $ro4->number_format($xray);

													}else { }
												?>
											</td>

											<!--ECG-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNight == $night ) {

														$ecgTotal += $ecg;
														echo $ro4->number_format($ecg);

													}else if( $hospitalBill == '' && $lastPaymentNight == $night ) {

														$ecgTotal += $ecg;
														echo $ro4->number_format($ecg);

													}else { }
												?>
											</td>

											<!--CTSCAN-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNight == $night ) {

														$ctscanTotal += $ctscan;
														echo $ro4->number_format($ctscan);

													}else if( $hospitalBill == '' && $lastPaymentNight == $night ) {

														$ctscanTotal += $ctscan;
														echo $ro4->number_format($ctscan);

													}else { }
												?>
											</td>

											<!--UTZ-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNight == $night ) {

														$utzTotal += $utz;
														echo $ro4->number_format($utz);

													}else if( $hospitalBill == '' && $lastPaymentNight == $night ) {

														$utzTotal += $utz;
														echo $ro4->number_format($utz);

													}else { }
												?>
											</td>

											<!--CLINIC REVENUE-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNight == $night ) {

														$pfTotal += $pf;
														echo $ro4->number_format($pf);

													}else if( $hospitalBill == '' && $lastPaymentNight == $night ) {

														$pfTotal += $pf;
														echo $ro4->number_format($pf);

													}else { }
												?>
											</td>

											<!--LABORATORY-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNight == $night ) {

														$laboratoryTotal += $laboratory;
														echo $ro4->number_format($laboratory);

													}else if( $hospitalBill == '' && $lastPaymentNight == $night ) {

														$laboratoryTotal += $laboratory;
														echo $ro4->number_format($laboratory);

													}else { }
												?>
											</td>

											<!--MISCELLANEOUS-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNight == $night ) {

														$miscTotal += $misc;
														echo $ro4->number_format($misc);

													}else if( $hospitalBill == '' && $lastPaymentNight == $night ) {

														$miscTotal += $misc;
														echo $ro4->number_format($misc);

													}else { }
												?>
											</td>

											<!--OTHERS-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNight == $night ) {

														$othersTotal += $others;
														echo $ro4->number_format($others);

													}else if( $hospitalBill == '' && $lastPaymentNight == $night ) {

														$othersTotal += $others;
														echo $ro4->number_format($others);

													}else { }
												?>
											</td>

											<!--ER FEE-->
											<td class='white'>
												<?
													if( $hospitalBill > 0 && $lastPaymentNight == $night ) {

														$erfeeTotal += $erfee;
														echo $ro4->number_format($erfee);

													}else if( $hospitalBill == '' && $lastPaymentNight == $night ) {

														$erfeeTotal += $erfee;
														echo $ro4->number_format($erfee);

													}else { }
												?>
											</td>

											<!--DEPOSIT-->
											<td class='white'>
												<?
													if( $totalDeposit > 0 ) {
														$lessDeposit += $totalDeposit;
														echo '-'.$ro4->number_format($totalDeposit);
													}else { }
												?>
											</td>

											<!--BALANCE PAID-->
											<td></td>

										</tr>
									<? } ?>

								<? }else { } ?>

							<? } ?>


							<!--NIGHT DEPOSIT-->
							<? foreach( $ts->list_deposit_paymentNo() as $paymentNo ) { ?>
								
								<? if( $ro->selectNow('patientPayment','shift','paymentNo',$paymentNo) == $night ) { ?>
									<?
										$registrationNo = $ro->selectNow('patientPayment','registrationNo','paymentNo',$paymentNo);
										$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
										$lastName = $ro->selectNow('patientRecord','lastName','patientNo',$patientNo);
										$firstName = $ro->selectNow('patientRecord','firstName','patientNo',$patientNo);
										$orNo = $ro->selectNow('patientPayment','orNo','paymentNo',$paymentNo);

										//DEBIT
										$cashDeposit = $ro->doubleSelectNow('patientPayment','amountPaid','paymentNo',$paymentNo,'paidVia',$cash);
										$creditCardDeposit = $ro->doubleSelectNow('patientPayment','amountPaid','paymentNo',$paymentNo,'paidVia',$creditCard);


									?>
									<tr>
										<td><!--DATE--></td>

										<!--OR#-->
										<td class='white'>
											<?
												echo $orNo
											?>
										</td>

										<!--LASTNAME-->
										<td class='white'>
											<?
												echo $lastName
											?>
										</td>

										<!--FIRSTNAME-->
										<td class='white'>
											<?
												echo $firstName
											?>
										</td>

										<!--CASH / CARD-->
										<td class='white'>
											<?
												echo $ro4->number_format(($cashDeposit + $creditCardDeposit))
											?>
										</td>

										<td><!--HMO NAME--></td>

										<!--IPD BILL-->
										<td class='white'>
											<?
												$ipdBillTotal += ( $cashDeposit + $creditCardDeposit );
												echo $ro4->number_format(($cashDeposit + $creditCardDeposit));
											?>
										</td>

										<!--CASH-->
										<td class='white'>
											<?
												$cashDepositTotal += $cashDeposit;
												$cashTotal += $cashDeposit;
												echo $ro4->number_format($cashDeposit)
											?>
										</td>

										<td><!--DISCOUNT--></td>

										<!--CREDIT CARD-->
										<td class='white'>
											<?
												$creditCardDepositTotal += $creditCardDeposit;
												$creditCardTotal += $creditCardDeposit;
												echo $ro4->number_format($creditCardDeposit)
											?>
										</td>

										<td><!--HMO--></td>
										<td><!--Company--></td>
										<td><!--Personal--></td>
										<td><!--Philhealth--></td>
										<td><!--Medicine--></td>
										<td><!--Supplies--></td>
										<td><!--OR FEE--></td>
										<td><!--ROOM--></td>
										<td><!--PT--></td>
										<td><!--SPIRO--></td>
										<td><!--XRAY--></td>
										<td><!--ECG--></td>
										<td><!--CTSCAN--></td>
										<td><!--UTZ--></td>
										<td><!--CLINIC REVENUE--></td>
										<td><!--LABORATORY--></td>
										<td><!--MISCELLANEOUS--></td>
										<td><!--OTHERS--></td>
										<td><!--ER FEE--></td>
										<td class='white'>
											<?
												$addDeposit += ( $cashDeposit + $creditCardDeposit );
												echo $ro4->number_format($cashDeposit + $creditCardDeposit)
											?>
										</td>
										<td><!--BALANCE PAID--></td>

									</tr>
								<? }else { } ?>
							
							<? } ?>

							<!--NIGHT BALANCE PAID-->
							<? foreach( $ts->list_inpatient_balance_paid_paymentNo() as $paymentNo ) { ?>
								<?
									$registrationNo = $ro->selectNow('patientPayment','registrationNo','paymentNo',$paymentNo);
									$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
									$lastName = $ro->selectNow('patientRecord','lastName','patientNo',$patientNo);
									$firstName = $ro->selectNow('patientRecord','firstName','patientNo',$patientNo);
									$shift = $ro->selectNow('patientPayment','shift','paymentNo',$paymentNo);
									$orNo = $ro->selectNow('patientPayment','orNo','paymentNo',$paymentNo);

									$cashPayment = $ro->doubleSelectNow('patientPayment','amountPaid','paymentNo',$paymentNo,'paidVia',$cash);
									$creditCardPayment = $ro->doubleSelectNow('patientPayment','amountPaid','paymentNo',$paymentNo,'paidVia',$creditCard);

									$totalPaid = ( $cashPayment + $creditCardPayment );

								?>
								<? if( $shift == $night ) { ?>
									<tr>
										<td><!--DATE--></td>
										<td class='white'>
											<?
												echo $orNo
											?>
										</td>
										<td class='white'>
											<?
												echo $lastName
											?>
										</td>
										<td class='white'>
											<?
												echo $firstName
											?>
										</td>
										<td class='white'>
											<?
												echo $ro4->number_format($totalPaid)
											?>
										</td>
										<td><!--HMO NAME--></td>
										<td class='white'>
											<?
												echo $ro4->number_format($totalPaid)
											?>
										</td>
										<td class='white'>
											<?
												$cashTotal += $cashPayment;
												echo $ro4->number_format($cashPayment)
											?>
										</td>
										<td><!--DISCOUNT--></td>
										<td class='white'>
											<?
												$creditCardTotal += $creditCardPayment;
												echo $ro4->number_format($creditCardPayment)
											?>
										</td>
										<td><!--HMO--></td>
										<td><!--COMPANY--></td>
										<td><!--PERSONAL--></td>
										<td><!--PHILHEALTH--></td>
										<td><!--MEDICINE--></td>
										<td><!--SUPPLIES--></td>
										<td><!--OR FEE--></td>
										<td><!--ROOM--></td>
										<td><!--PT--></td>
										<td><!--SPIRO--></td>
										<td><!--XRAY--></td>
										<td><!--ECG--></td>
										<td><!--CTSCAN--></td>
										<td><!--UTZ--></td>
										<td><!--CLINIC REVENUE--></td>
										<td><!--LABORATORY--></td>
										<td><!--MISCELLANEOUS--></td>
										<td><!--OTHERS--></td>
										<td><!--ER FEE--></td>
										<td><!--DEPOSIT--></td>
										<td class='white'>
											<?
												$balancePaidTotal += $totalPaid;
												echo $ro4->number_format($totalPaid)
											?>
										</td>
									</tr>
								<? }else { } ?>
							<? } ?>							



							<!--NO SHIFT-->
							<tr>
								<td class='shift'><h5>No Shift</h5></td>
								<td><!--OR#--></td>
								<td><!--LASTNAME--></td>
								<td><!--FIRSTNAME--></td>
								<td><!--CASH/CARD--></td>
								<td><!--HMO NAME--></td>
								<td><!--IPD BILL--></td>
								<td><!--CASH--></td>
								<td><!--DISCOUNT--></td>
								<td><!--CREDIT CARD--></td>
								<td><!--HMO--></td>
								<td><!--COMPANY--></td>
								<td><!--PERSONAL--></td>
								<td><!--PHILHEALTH--></td>
								<td><!--MEDICINE--></td>
								<td><!--SUPPLIES--></td>
								<td><!--OR FEE--></td>
								<td><!--ROOM--></td>
								<td><!--PT--></td>
								<td><!--SPIRO--></td>
								<td><!--XRAY--></td>
								<td><!--ECG--></td>
								<td><!--CTSCAN--></td>
								<td><!--UTZ--></td>
								<td><!--CLINIC REVENUE--></td>
								<td><!--LABORATORY--></td>
								<td><!--MISCELLANEOUS--></td>
								<td><!--OTHERS--></td>
								<td><!--ER FEE--></td>
								<td><!--DEPOSIT--></td>
								<td><!--BALANCE PAID--></td>
							</tr>							
							<? foreach( $ts->get_discharged_inpatients_registrationNo() as $registrationNo ) { ?>								
								<?
									/**
									*check for the patient payment where paymentFor = HOSPITAL BILL.
									*if no HOSPITAL BILL payment and only DEPOSIT is existing then considered as noShift. 
									*even the DEPOSIT has a shift considered as noShift because DEPOSIT payment shows in seperated rows.
									*/

									$morningCashPayment = $ts->get_inpatient_payment($registrationNo,$cash,$morning);
									$noonCashPayment = $ts->get_inpatient_payment($registrationNo,$cash,$noon);
									$afternoonCashPayment = $ts->get_inpatient_payment($registrationNo,$cash,$afternoon);
									$nightCashPayment = $ts->get_inpatient_payment($registrationNo,$cash,$night);

									$morningCreditCardPayment = $ts->get_inpatient_payment($registrationNo,$creditCard,$morning);
									$noonCreditCardPayment = $ts->get_inpatient_payment($registrationNo,$creditCard,$noon);
									$afternoonCreditCardPayment = $ts->get_inpatient_payment($registrationNo,$creditCard,$afternoon);
									$nightCreditCardPayment = $ts->get_inpatient_payment($registrationNo,$creditCard,$night);

									$hospitalBillPayment = (
											$morningCashPayment +
											$noonCashPayment +
											$afternoonCashPayment +
											$nightCashPayment +
											$morningCreditCardPayment +
											$noonCreditCardPayment +
											$afternoonCreditCardPayment +
											$nightCreditCardPayment
										);


								?>

								<? if( $hospitalBillPayment < 1 ) { ?>
									<?
										//DEBIT
										$cashPayment = $ts->get_inpatient_payment($registrationNo,$cash,$noShift);
										$deposit = $ts->get_inpatient_deposit($registrationNo,$cash,$noShift);
										$creditCardPayment = $ts->get_inpatient_payment($registrationNo,$creditCard,$noShift);
										$depositCr = $ts->get_inpatient_deposit($registrationNo,$creditCard,$noShift);
										$discount = $ro->selectNow('registrationDetails','discount','registrationNo',$registrationNo);
										$hmoCover = $ts->get_inpatient_hmo($registrationNo,$hmo,$noShift);
										$companyCover = $ts->get_inpatient_hmo($registrationNo,$company,$noShift);
										$philhealthCover = $ts->get_inpatient_philhealth($registrationNo);

										$patient_debit_total = (
												$cashPayment +
												$deposit +
												$creditCardPayment +
												$depositCr +
												$discount +
												$hmoCover +
												$companyCover +
												$philhealthCover
											);

										//paymentFor = HOSPITAL BILL
										$hospitalBill = ( $cashPayment + $creditCardPayment );

										$totalDeposit = ( $deposit + $depositCr );

										//CREDIT
										$medicine = (
											$ro4->inpatient_title_total_inventory($registrationNo,'total','MEDICINE') +
											$ro4->inpatient_paymentMode_total_inventory_takeHomeMeds($registrationNo,"total")
										);
										$supplies = $ro4->inpatient_title_total($registrationNo,'total','SUPPLIES');
										$or = $ro4->inpatient_title_total($registrationNo,'total','OR/DR/ER Fee');
										$room = $ro4->inpatient_title_total($registrationNo,'total','Room and Board');
										$pt = $ro4->inpatient_title_total($registrationNo,'total','PT');
										$spiro = $ro4->inpatient_title_total($registrationNo,'total','SPIROMETRY');
										$xray = $ro4->inpatient_title_total($registrationNo,'total','XRAY');
										$ecg = $ro4->inpatient_title_total($registrationNo,'total','ECG');
										$ctscan = $ro4->inpatient_title_total($registrationNo,'total','CTSCAN');
										$utz = $ro4->inpatient_title_total($registrationNo,'total','ULTRASOUND');
										$pf = $ro4->inpatient_title_total($registrationNo,'total','PROFESSIONAL FEE');
										$laboratory = $ro4->inpatient_title_total($registrationNo,'total','LABORATORY');
										$misc = $ro4->inpatient_title_total($registrationNo,'total','MISCELLANEOUS');
										$others = $ro4->inpatient_title_total($registrationNo,'total','OTHERS');
										$erfee = $ro4->inpatient_title_total($registrationNo,'total','ER FEE');

										$total = ( $medicine + $supplies + $or + $room + $pt + $spiro + $xray + $ecg + $ctscan + $utz + $pf + $laboratory + $misc + $others + $erfee );

										$hospitalBillCash = $ts->get_inpatient_payment_for($registrationNo,$cash,$noShift);
										$hospitalBillCreditCard = $ts->get_inpatient_payment_for($registrationNo,$creditCard,$noShift);

										$balance = ( $total - $patient_debit_total );

									?>

									<tr>
										<!--DATE-->
										<td>
											
										</td>

										<!--OR#-->
										<td class='white'>
											<!--no need for OR# because noShift means there is no paymentFor = HOSPITAL BILL-->
										</td>

										<!--LASTNAME-->
										<td class='white'>
											<?
												$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
												$lastName = $ro->selectNow('patientRecord','lastName','patientNo',$patientNo);
												echo $lastName;

												if( $balance < 0 ) {
													$excessPaymentTotal += abs($balance);
													$format = number_format(abs($balance));
													echo "<br>";
													echo "<i style='color:red; font-size:12px'>Excess: ".$format."</i>";
												}else { }												
											?>
										</td>

										<!--FIRSTNAME-->
										<td class='white'>
											<?
												$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
												$firstName = $ro->selectNow('patientRecord','firstName','patientNo',$patientNo);
												echo $firstName;
											?>
										</td>

										<!--CASH/CARD-->
										<td class='white'>
											<?
												$cashCardTotal += ($cashPayment + $creditCardPayment);			
												echo $ro4->number_format($cashPayment + $creditCardPayment);

											?>											
										</td>

										<!--HMO/COMPANY NAME-->
										<td class='white'>
											<?
												echo $ro->selectNow('registrationDetails','Company','registrationNo',$registrationNo)
											?>
										</td>

										<!--IPD BILL-->
										<td class='white'>
											<?
												$ipdBillTotal += ( $total - $deposit );
												echo $ro4->number_format( ($total - $deposit) )
											?>
										</td>

										<!--CASH-->
										<td class='white'>
											<?
												$cashTotal += $cashPayment;
												echo $ro4->number_format($cashPayment);
											?>
										</td>

										<!--DISCOUNT-->
										<td class='white'>
											<?
												if( $hospitalBillPayment < 1 ) {
													$discountTotal += $discount;
													echo $ro4->number_format($discount);
												}else { }
											?>											
										</td>

										<!--CREDIT CARD-->
										<td class='white'>
											<?
												$creditCardTotal += $creditCardPayment;
												echo $ro4->number_format($creditCardPayment);
											?>
										</td>

										<!--HMO-->
										<td class='white'>
											<?	
												
												if( $hospitalBillPayment < 1 ) {
													$hmoTotal += $hmoCover;
													echo $ro4->number_format($hmoCover);

												}else { }
											?>
										</td>

										<!--COMPANY-->
										<td class='white'>
											<?
												
												if( $hospitalBillPayment < 1 ) {
													$companyTotal += $companyCover;
													echo $ro4->number_format($companyCover);

												}else { }
											?>
										</td>

										<!--PERSONAL-->
										<td class='white'>
											<?
												if( $balance > 0 ) {
													$balanceTotal += $balance;
												}else { }
												echo $ro4->number_format($balance);
											?>
										</td>

										<!--PHILHEALTH-->
										<td class='white'>
											<?
												if( $hospitalBillPayment < 1 ) {
													$philhealthTotal += $philhealthCover;
													echo $ro4->number_format($philhealthCover);
												}else { }
											?>
										</td>

										<!--MEDICINE-->
										<td class='white'>
											<?
												if( $hospitalBillPayment < 1 ) {
													$medicineTotal += $medicine;
													echo $ro4->number_format($medicine);
												}else { }
											?>
										</td>

										<!--SUPPLIES-->
										<td class='white'>
											<?
												if( $hospitalBillPayment < 1 ) {
													$suppliesTotal += $supplies;
													echo $ro4->number_format($supplies);
												}else { }
											?>
										</td>

										<!--OR-->
										<td class='white'>
											<?
												if( $hospitalBillPayment < 1 ) {
													$orTotal += $or;
													echo $ro4->number_format($or);
												}else { }
											?>
										</td>

										<!--Room-->
										<td class='white'>
											<?
												if( $hospitalBillPayment < 1 ) {
													$roomTotal += $room;
													echo $ro4->number_format($room);
												}else { }
											?>
										</td>

										<!--PT-->
										<td class='white'>
											<?
												if( $hospitalBillPayment < 1 ) {
													$ptTotal += $pt;
													echo $ro4->number_format($pt);
												}else { }
											?>
										</td>

										<!--SPIRO-->
										<td class='white'>
											<?
												if( $hospitalBillPayment < 1 ) {
													$spiroTotal += $spiro;
													echo $ro4->number_format($spiro);
												}else { }
											?>
										</td>

										<!--XRAY-->
										<td class='white'>
											<?
												if( $hospitalBillPayment < 1 ) {
													$xrayTotal += $xray;
													echo $ro4->number_format($xray);
												}else { }
											?>
										</td>

										<!--ECG-->
										<td class='white'>
											<?
												if( $hospitalBillPayment < 1 ) {
													$ecgTotal += $ecg;
													echo $ro4->number_format($ecg);
												}else { }
											?>
										</td>

										<!--CTSCAN-->
										<td class='white'>
											<?
												if( $hospitalBillPayment < 1 ) {
													$ctscanTotal += $ctscan;
													echo $ro4->number_format($ctscan);
												}else { }
											?>
										</td>

										<!--UTZ-->
										<td class='white'>
											<?
												if( $hospitalBillPayment < 1 ) {
													$utzTotal += $utz;
													echo $ro4->number_format($utz);
												}else { }
											?>
										</td>

										<!--CLINIC REVENUE-->
										<td class='white'>
											<?
												if( $hospitalBillPayment < 1 ) {
													$pfTotal += $pf;
													echo $ro4->number_format($pf);
												}else { }
											?>
										</td>

										<!--LABORATORY-->
										<td class='white'>
											<?
												if( $hospitalBillPayment < 1 ) {
													$laboratoryTotal += $laboratory;
													echo $ro4->number_format($laboratory);
												}else { }
											?>
										</td>

										<!--MISCELLANEOUS-->
										<td class='white'>
											<?
												if( $hospitalBillPayment < 1 ) {
													$miscTotal += $misc;
													echo $ro4->number_format($misc);
												}else { }
											?>
										</td>

										<!--OTHERS-->
										<td class='white'>
											<?
												if( $hospitalBillPayment < 1 ) {
													$othersTotal += $others;
													echo $ro4->number_format($others);
												}else { }
											?>
										</td>

										<td class='white'>
											<?
												if( $hospitalBillPayment < 1 ) {
													$erfeeTotal += $erfee;
													echo $ro4->number_format($erfee);
												}else { }
											?>
										</td>

										<!--DEPOSIT-->
										<td class='white'>
											<?
												if( $totalDeposit > 0 ) {
													$lessDeposit += $totalDeposit;
													echo '-'.$ro4->number_format($totalDeposit);
												}else { }
											?> 
										</td>

										<!--BALANCE PAID-->
										<td></td>

									</tr>

								<? }else { } ?>

							<? } ?>


							<!--NOSHIFT DEPOSIT-->
							<? foreach( $ts->list_deposit_paymentNo() as $paymentNo ) { ?>
								
								<? if( $ro->selectNow('patientPayment','shift','paymentNo',$paymentNo) == $noShift ) { ?>
									<?
										$registrationNo = $ro->selectNow('patientPayment','registrationNo','paymentNo',$paymentNo);
										$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
										$lastName = $ro->selectNow('patientRecord','lastName','patientNo',$patientNo);
										$firstName = $ro->selectNow('patientRecord','firstName','patientNo',$patientNo);
										$orNo = $ro->selectNow('patientPayment','orNo','paymentNo',$paymentNo);

										//DEBIT
										$cashDeposit = $ro->doubleSelectNow('patientPayment','amountPaid','paymentNo',$paymentNo,'paidVia',$cash);
										$creditCardDeposit = $ro->doubleSelectNow('patientPayment','amountPaid','paymentNo',$paymentNo,'paidVia',$creditCard);


									?>
									<tr>
										<td><!--DATE--></td>

										<!--OR#-->
										<td class='white'>
											<?
												echo $orNo
											?>
										</td>

										<!--LASTNAME-->
										<td class='white'>
											<?
												echo $lastName
											?>
										</td>

										<!--FIRSTNAME-->
										<td class='white'>
											<?
												echo $firstName
											?>
										</td>

										<!--CASH / CARD-->
										<td class='white'>
											<?
												echo $ro4->number_format(($cashDeposit + $creditCardDeposit))
											?>
										</td>

										<td><!--HMO NAME--></td>

										<!--IPD BILL-->
										<td class='white'>
											<?
												$ipdBillTotal += ( $cashDeposit + $creditCardDeposit );
												echo $ro4->number_format(($cashDeposit + $creditCardDeposit));
											?>
										</td>

										<!--CASH-->
										<td class='white'>
											<?
												$cashDepositTotal += $cashDeposit;
												$cashTotal += $cashDeposit;
												echo $ro4->number_format($cashDeposit)
											?>
										</td>

										<td><!--DISCOUNT--></td>

										<!--CREDIT CARD-->
										<td class='white'>
											<?
												$creditCardDepositTotal += $creditCardDeposit;
												$creditCardTotal += $creditCardDeposit;
												echo $ro4->number_format($creditCardDeposit)
											?>
										</td>

										<td><!--HMO--></td>
										<td><!--Company--></td>
										<td><!--Personal--></td>
										<td><!--Philhealth--></td>
										<td><!--Medicine--></td>
										<td><!--Supplies--></td>
										<td><!--OR FEE--></td>
										<td><!--ROOM--></td>
										<td><!--PT--></td>
										<td><!--SPIRO--></td>
										<td><!--XRAY--></td>
										<td><!--ECG--></td>
										<td><!--CTSCAN--></td>
										<td><!--UTZ--></td>
										<td><!--CLINIC REVENUE--></td>
										<td><!--LABORATORY--></td>
										<td><!--MISCELLANEOUS--></td>
										<td><!--OTHERS--></td>
										<td><!--ER FEE--></td>
										<td class='white'>
											<?
												$addDeposit += ( $cashDeposit + $creditCardDeposit );
												echo $ro4->number_format($cashDeposit + $creditCardDeposit)
											?>
										</td>
										<td><!--BALANCE PAID--></td>

									</tr>
								<? }else { } ?>
							
							<? } ?>							


					<? } ?>
				</tbody>
				<tfoot>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td class='white'>
							<?
								echo $ro4->number_format($cashCardTotal)
							?>
						</td>
						<td></td>
						<td class='white'>
							<?
								echo $ro4->number_format($ipdBillTotal)
							?>
						</td>
						<td class='white'>
							<?
								echo $ro4->number_format($cashTotal)
							?>
						</td>
						<td class='white'>
							<?
								echo $ro4->number_format($discountTotal)
							?>
						</td>
						<td class='white'>
							<?
								echo $ro4->number_format($creditCardTotal)
							?>
						</td>
						<td class='white'>
							<?
								echo $ro4->number_format($hmoTotal);
							?>
						</td>
						<td class='white'>
							<?
								echo $ro4->number_format($companyTotal);
							?>
						</td>
						<td class='white'>
							<?
								echo $ro4->number_format($balanceTotal);
							?>
						</td>
						<td class='white'>
							<?
								echo $ro4->number_format($philhealthTotal);
							?>
						</td>
						<td class='white'>
							<?
								echo $ro4->number_format($medicineTotal)
							?>
						</td>
						<td class='white'>
							<?
								echo $ro4->number_format($suppliesTotal)
							?>
						</td>
						<td class='white'>
							<?
								echo $ro4->number_format($orTotal)
							?>
						</td>
						<td class='white'>
							<?
								echo $ro4->number_format($roomTotal)
							?>
						</td>
						<td class='white'>
							<?
								echo $ro4->number_format($ptTotal)
							?>
						</td>
						<td class='white'>
							<?
								echo $ro4->number_format($spiroTotal)
							?>
						</td>						
						<td class='white'>
							<?
								echo $ro4->number_format($xrayTotal)
							?>
						</td>
						<td class='white'>
							<?
								echo $ro4->number_format($ecgTotal)
							?>
						</td>
						<td class='white'>
							<?
								echo $ro4->number_format($ctscanTotal)
							?>
						</td>
						<td class='white'>
							<?
								echo $ro4->number_format($utzTotal);
							?>
						</td>
						<td class='white'>
							<?
								echo $ro4->number_format($pfTotal)
							?>
						</td>
						<td class='white'>
							<?
								echo $ro4->number_format($laboratoryTotal)
							?>
						</td>
						<td class='white'>
							<?
								echo $ro4->number_format($miscTotal)
							?>
						</td>
						<td class='white'>
							<?
								echo $ro4->number_format($othersTotal)
							?>
						</td>
						<td class='white'>
							<?
								echo $ro4->number_format($erfeeTotal)
							?>
						</td>
						<td class='white'>
							<?
								echo ($addDeposit - $lessDeposit) 
							?>
						</td>
						<td class='white'>
							<?
								echo $ro4->number_format($balancePaidTotal)
							?>
						</td>
					</tr>

					<tr>
						<td><!--DATE--></td>
						<td><!--OR#--></td>
						<td><!--LAST NAME--></td>
						<td><!--FIRST NAME--></td>
						<td><!--CASH / CARD--></td>
						<td><!--HMO NAME--></td>
						<td><!--IPD BILL--></td>
						<td><!--CASH--></td>
						<td><!--DISCOUNT--></td>
						<td><!--CREDIT CARD--></td>
						<td><!--HMO--></td>
						<td><!--COMPANY--></td>
						<td><!--PERSONAL--></td>
						<td><!--PHILHEALTH--></td>
						<td><!--MEDICINE--></td>
						<td><!--SUPPLIES--></td>
						<td><!--OR FEE--></td>
						<td><!--ROOM--></td>
						<td><!--PT--></td>
						<td><!--SPIRO--></td>
						<td><!--XRAY--></td>
						<td><!--ECG--></td>
						<td><!--CTSCAN--></td>
						<td><!--UTZ--></td>
						<td><!--CLINIC REVENUE--></td>
						<td><!--LABORATORY--></td>
						<td><!--MISCELLANEOUS--></td>
						<td><!--OTHERS--></td>
						<td><!--ER FEE--></td>
						<td><!--DEPOSIT--></td>
						<td><!--BALANCE PAID--></td>
					</tr>

					<tr>
						<td><!--DATE--></td>
						<td><!--OR#--></td>
						<td><!--LAST NAME--></td>
						<td><!--FIRST NAME--></td>
						<td><!--CASH / CARD--></td>
						<td><!--HMO NAME--></td>
						<td><!--IPD BILL--></td>
						<td><!--CASH--></td>
						<td><!--DISCOUNT--></td>
						<td><!--CREDIT CARD--></td>
						<td><!--HMO--></td>
						<td><!--COMPANY--></td>
						<td><!--PERSONAL--></td>
						<td><!--PHILHEALTH--></td>
						<td><!--MEDICINE--></td>
						<td><!--SUPPLIES--></td>
						<td><!--OR FEE--></td>
						<td><!--ROOM--></td>
						<td><!--PT--></td>
						<td><!--SPIRO--></td>
						<td><!--XRAY--></td>
						<td><!--ECG--></td>
						<td><!--CTSCAN--></td>
						<td><!--UTZ--></td>
						<td><!--CLINIC REVENUE--></td>
						<td><!--LABORATORY--></td>
						<td><!--MISCELLANEOUS--></td>
						<td><!--OTHERS--></td>
						<td><!--ER FEE--></td>
						<td><!--DEPOSIT--></td>
						<td><!--BALANCE PAID--></td>
					</tr>

					<tr>
						<td><!--DATE--></td>
						<td><!--OR#--></td>
						<td><!--LAST NAME--></td>
						<td><!--FIRST NAME--></td>
						<td><!--CASH / CARD--></td>
						<td><!--HMO NAME--></td>
						<td><!--IPD BILL--></td>
						<td><!--CASH--></td>
						<td><!--DISCOUNT--></td>
						<td><!--CREDIT CARD--></td>
						<td><!--HMO--></td>
						<td><!--COMPANY--></td>
						<td><!--PERSONAL--></td>
						<td><!--PHILHEALTH--></td>
						<td><!--MEDICINE--></td>
						<td><!--SUPPLIES--></td>
						<td><!--OR FEE--></td>
						<td><!--ROOM--></td>
						<td><!--PT--></td>
						<td><!--SPIRO--></td>
						<td><!--XRAY--></td>
						<td><!--ECG--></td>
						<td><!--CTSCAN--></td>
						<td><!--UTZ--></td>
						<td><!--CLINIC REVENUE--></td>
						<td><!--LABORATORY--></td>
						<td><!--MISCELLANEOUS--></td>
						<td><!--OTHERS--></td>
						<td><!--ER FEE--></td>
						<td><!--DEPOSIT--></td>
						<td><!--BALANCE PAID--></td>
					</tr>					

					<tr>
						<td><!--DATE--></td>
						<td><!--OR#--></td>
						<td><!--LAST NAME--></td>
						<td><!--FIRST NAME--></td>
						<td><!--CASH / CARD--></td>
						<td><!--HMO NAME--></td>
						<td><!--IPD BILL--></td>
						<td><!--CASH--></td>
						<td><!--DISCOUNT--></td>
						<td><!--CREDIT CARD--></td>
						<td><!--HMO--></td>
						<td><!--COMPANY--></td>
						<td><!--PERSONAL--></td>
						<td><!--PHILHEALTH--></td>
						<td><!--MEDICINE--></td>
						<td><!--SUPPLIES--></td>
						<td><!--OR FEE--></td>
						<td><!--ROOM--></td>
						<td><!--PT--></td>
						<td><!--SPIRO--></td>
						<td><!--XRAY--></td>
						<td><!--ECG--></td>
						<td><!--CTSCAN--></td>
						<td><!--UTZ--></td>
						<td><!--CLINIC REVENUE--></td>
						<td><!--LABORATORY--></td>
						<td><!--MISCELLANEOUS--></td>
						<td><!--OTHERS--></td>
						<td><!--ER FEE--></td>
						<td><!--DEPOSIT--></td>
						<td><!--BALANCE PAID--></td>
					</tr>

				</tfoot>
			</table>
			<br><br><br>

			<table id='summary' class='transactionSummary'>
				<?
					$depositCredit = ( $addDeposit - $lessDeposit );
				?>
				<tr>
					<td>Cash</td>
					<td>
						<?	
							echo $ro4->number_format($cashTotal)
						?>
					</td>
					<td></td>
				</tr>			
			
				<tr>
					<td>Credit Card</td>
					<td>
						<?
							echo $ro4->number_format($creditCardTotal)
						?>
					</td>
					<td></td>
				</tr>

				<tr>
					<td>HMO</td>
					<td>
						<?
							echo $ro4->number_format($hmoTotal)
						?>
					</td>
					<td></td>
				</tr>

				<tr>
					<td>Company</td>
					<td>
						<?
							echo $ro4->number_format($companyTotal)
						?>
					</td>
					<td></td>
				</tr>

				<tr>
					<td>Philhealth</td>
					<td>
						<?
							echo $ro4->number_format($philhealthTotal)
						?>
					</td>
					<td></td>
				</tr>

				<tr>
					<td>Personal</td>
					<td>
						<?
							echo $ro4->number_format($balanceTotal)
						?>
					</td>
					<td></td>
				</tr>

				<tr>
					<td>A/R IPD Paid</td>
					<td></td>
					<td>
						<?
							echo $ro4->number_format($balancePaidTotal)
						?>
					</td>
				</tr>

				<tr>
					<td>Clinic Revenue</td>
					<td></td>
					<td>
						<?
							echo $ro4->number_format($pfTotal)
						?>
					</td>
				</tr>

				<tr>
					<td>O.R</td>
					<td></td>
					<td>
						<?
							echo $ro4->number_format($orTotal)
						?>
					</td>
				</tr>

				<tr>
					<td>Room</td>
					<td></td>
					<td>
						<?
							echo $ro4->number_format($roomTotal)
						?>
					</td>
				</tr>

				<tr>
					<td>ECG</td>
					<td></td>
					<td>
						<?
							echo $ro4->number_format($ecgTotal)
						?>
					</td>
				</tr>

				<tr>
					<td>PT</td>
					<td></td>
					<td>
						<?
							echo $ro4->number_format($ptTotal)
						?>
					</td>
				</tr>

				<tr>
					<td>XRAY</td>
					<td></td>
					<td>
						<?
							echo $ro4->number_format($xrayTotal)
						?>
					</td>
				</tr>

				<tr>
					<td>Spirometry</td>
					<td></td>
					<td>
						<?
							echo $ro4->number_format($spiroTotal)
						?>
					</td>
				</tr>

				<tr>
					<td>Ultrasound</td>
					<td></td>
					<td>
						<?
							echo $ro4->number_format($utzTotal)
						?>
					</td>
				</tr>

				<tr>
					<td>CTSCAN</td>
					<td></td>
					<td>
						<?
							echo $ro4->number_format($ctscanTotal)
						?>
					</td>
				</tr>

				<tr>
					<td>Laboratory</td>
					<td></td>
					<td>
						<?
							echo $ro4->number_format($laboratoryTotal)
						?>
					</td>
				</tr>

				<tr>
					<td>Medicine</td>
					<td></td>
					<td>
						<?
							echo $ro4->number_format($medicineTotal)
						?>
					</td>
				</tr>

				<tr>
					<td>Supplies</td>
					<td></td>
					<td>
						<?
							echo $ro4->number_format($suppliesTotal)
						?>
					</td>
				</tr>

				<tr>
					<td>Miscellaneous</td>
					<td></td>
					<td>
						<?
							echo $ro4->number_format($miscTotal)
						?>
					</td>
				</tr>

				<tr>
					<td>Others</td>
					<td></td>
					<td>
						<?
							echo $ro4->number_format($othersTotal)
						?>
					</td>
				</tr>

				<tr>
					<td>ER FEE</td>
					<td></td>
					<td>
						<?
							echo $ro4->number_format($erfeeTotal)
						?>
					</td>
				</tr>

				<tr>
					<td>Excess Payment</td>
					<td></td>
					<td>
						<?
							echo $ro4->number_format($excessPaymentTotal)
						?>
					</td>
				</tr>

				<tr>
					<td>Deposit</td>
					<td></td>
					<td>
						<?
							echo ( $addDeposit - $lessDeposit ) 
						?>
					</td>
				</tr>

				<tr>
					<td>Discount</td>
					<td>
						<?
							echo $ro4->number_format($discountTotal)
						?>
					</td>
					<td></td>
				</tr>

				<tr>
					<td></td>
					<td>
						<?
							//deposit is included in the $cashTotal and $creditCardTotal
							$debit = ( $cashTotal + $creditCardTotal + $hmoTotal + $companyTotal + $balanceTotal + $philhealthTotal + $discountTotal );
							echo $ro4->number_format($debit);
						?>
					</td>
					<td>
						<?
							$credit = ( $pfTotal + $orTotal + $roomTotal + $ecgTotal + $ptTotal + $xrayTotal + $spiroTotal + $utzTotal + $ctscanTotal + $laboratoryTotal + $medicineTotal + $suppliesTotal + $miscTotal + $othersTotal + $erfeeTotal + $depositCredit + $balancePaidTotal + $excessPaymentTotal  );
							echo $ro4->number_format($credit);
						?>
					</td>

				</tr>

			</table>

		</div>
	</body>
</html>