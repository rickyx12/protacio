<?
	include 'transactionSummary.class.php';
	include '../../../myDatabase.php';
	include '../../../myDatabase4.php';

	$fromDate = $_POST['fromDate'];
	$toDate = $_POST['toDate'];

	$ts = new transactionSummary();
	$ro = new database();
	$ro4 = new database4();

	$date = preg_split ("/\-/", $fromDate);
	$year = $date[0];
	$month = $date[1];
	$day = $date[2];
	$format_day;

	//tanggalin ung zero sa unahan ng mga number na 01 - 09 pra s for loop
	if( $day < 10 ) {
		$format_day = substr($day,1);
	}else {
		$format_day = $day;
	}

	$date1 = preg_split ("/\-/", $toDate);
	$year1 = $date1[0];
	$month1 = $date1[1];
	$day1 = $date1[2];
	$format_day1;
	//tanggalin ung zero sa unahan ng mga number na 01 - 09 pra s for loop
	if( $day1 < 10 ) {
		$format_day1 = substr($day1,1);
	}else {
		$format_day1 = $day1;
	}

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

	$morning = "Morning";
	$noon = "Noon";
	$afternoon = "Afternoon";
	$night = "Night";
	$noShift = "";

	$creditCard_per_day = 0;
	$creditCardTotal = 0;

	$cashPaid_per_day = 0;
	$cashPaidTotal = 0;

	$hmo_per_day = 0;
	$hmoTotal = 0;

	$company_per_day = 0;
	$companyTotal = 0;

	$philhealth_per_day = 0;
	$philhealthTotal = 0;

	$unpaid_per_day = 0;
	$unpaidTotal = 0;

	$discount_per_day = 0;
	$discountTotal = 0;

	$balance_per_day = 0;
	$balanceTotal = 0;

	$pf_per_day = 0;
	$pfTotal = 0;

	$laboratory_per_day = 0;
	$laboratoryTotal = 0;

	$xray_per_day = 0;
	$xrayTotal = 0;

	$utz_per_day = 0;
	$utzTotal = 0;

	$ecg_per_day = 0;
	$ecgTotal = 0;

	$ctscan_per_day = 0;
	$ctscanTotal = 0;

	$spirometry_per_day = 0;
	$spirometryTotal = 0;

	$cardiac_per_day = 0;
	$cardiacTotal = 0;

	$medicine_per_day = 0;
	$medicineTotal = 0;

	$supplies_per_day = 0;
	$suppliesTotal = 0;

	$erfee_per_day = 0;
	$erfeeTotal = 0;

	$misc_per_day = 0;
	$miscTotal = 0;

	$ot_per_day = 0;
	$otTotal = 0;

	$st_per_day = 0;
	$stTotal = 0;

	$sped_per_day = 0;
	$spedTotal = 0;

	$pt_per_day = 0;
	$ptTotal = 0;

	$derma_per_day = 0;
	$dermaTotal = 0;

	$others_per_day = 0;
	$othersTotal = 0;

	$or_per_day = 0;
	$orTotal = 0;

	$payable_per_day = 0;
	$payableTotal = 0;


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
				var reportName = 'Transaction_Summary_[<? echo $monthWord[$month]."-".$year ?>]';

				$('body').prepend("<form method='post' action='../../../export-to-excel/exporttoexcel.php' style='display:none' id='ReportTableData'><textarea name='tableData'>"+patients+summary+"</textarea><input type='text' name='reportName' value='"+reportName+"'></form>");

				 $('#ReportTableData').submit().remove();
				 return false;	
				 
			});
 		
	  	});

	  </script>

	  <style>

	  	.date {
	  		background-color: yellow;
	  	}

	  	.grandTotal {
	 		border-top:1px solid black; 
	 		border-bottom:1px solid black; 
	 		border-left:0px; 
	 		border-right:0px; 		
	  	}

	  	.box {
	  		width: 230%;
	  		margin:2%;
	  	}

	  	.yellow {
	  		background-color: yellow;
	  		padding:0.3%;
	  	}

	  	.orange {
	  		background-color: orange;
	  		padding:0.3%;
	  	}

	  	.white {
	  		padding: 0.3%;
	  	}

	  	.lightBlue {
	  		background-color: lightblue;
	  		padding:0.2%;
	  	}

	  	.sped {
	  		background-color:white;
	  	}

	  </style>
	</head>
	<body>
		<div class='box'>
			<div class=''>
				<h5><a href="#" id="export"><img src="../../../export-to-excel/excel-icon.png"></a></h5>
				<table rules=all id='patients'>
					<thead>
						<tr>
							<th>&nbsp;</th>
							<th class='white'>OR#</th>
							<th class='white'>Last Name</th>
							<th class='white'>First Name</th>
							<th class='yellow'>Cash & Card</th>
							<th>HMO</th>
							<th style="background-color: lightblue; padding:0.2%; ">Cash</th>
							<th style="background-color: lightblue; padding:0.2%; ">Credit Card</th>
							<th style="background-color: lightblue; padding:0.2%; ">A/R HMO</th>
							<th style="background-color: lightblue; padding:0.2%; ">A/R Company</th>
							<th style="background-color: lightblue; padding:0.2%; ">PHILHEALTH</th>
							<th style="background-color: lightblue; padding:0.2%; ">A/R PERSONAL</th>
							<th style="background-color: yellow; padding:0.2%; ">Discount</th>
							<th>Laboratory</th>
							<th>&nbsp;XRAY</th>
							<th>&nbsp;ULTRASOUND</th>
							<th>&nbsp;ECG</th>
							<th>&nbsp;CTSCAN</th>
							<th>&nbsp;SPIRO</th>
							<th>&nbsp;CARDIAC</th>
							<th>&nbsp;Medicine</th>
							<th>&nbsp;Supplies</th>
							<th>&nbsp;ER FEE</th>
							<th>&nbsp;MISC</th>
							<th>&nbsp;OT</th>
							<th>&nbsp;ST</th>
							<th>&nbsp;SPED</th>
							<th style="background-color:orange; padding:0.2%; ">&nbsp;PT</th>
							<th style="background-color: lightblue; padding:0.2%; ">&nbsp;DERMA</th>
							<th>&nbsp;OTHERS</th>
							<th>&nbsp;O.R</th>
							<th>A/R OPD PAID</th>
							<th>CLINIC REVENUE</th>
							<th>PF A/P (MD SHARE)</th>
						</tr>
					</thead>
					<tbody>
						<? for( $dayLoop=$format_day;$dayLoop<=$format_day1;$dayLoop++ ) { ?>
								
							<? $ts->get_outpatients($year,$month,$day,$year1,$month1,$day1); ?>
							<tr>
								<td style='background-color: yellow; padding: 0.3%'><h4><? echo $monthWord[$month] ?> <? echo $dayLoop ?>, <? echo $year ?></h4></td>
								<td style='background-color: yellow; padding: 0.3%'><!--OR#--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--LASTNAME--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--FIRSTNAME--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--CASH & CARD--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--HMO--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--CASH--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--CREDIT CARD--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--HMO--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--Company--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--PHILHEALTH--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--PERSNAL A/R--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--DISCOUNT--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--LABORATORY--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--XRAY--></td>	
								<td style='background-color: yellow; padding: 0.3%'><!--UTZ--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--ECG--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--CTSCAN--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--SPIRO--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--CARDIAC--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--MEDICINE--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--SUPPLIES--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--ER FEE--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--MISC--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--OT--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--ST--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--PT--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--SPED--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--DERMA--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--OTHERS--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--O.R--></td>	
								<td style='background-color: yellow; padding: 0.3%'><!--A/R OPD PAID--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--CLINIC REVENUE--></td>
								<td style='background-color: yellow; padding: 0.3%'><!--PF A/P (MD SHARE)--></td>					
							</tr>

							<!--MORNNING-->
							<tr>
								<th style='padding-left:1%'>Morning</th>
								<th><!--OR#--></th>
								<th><!--LASTNAME--></th>
								<th><!--FIRSTNAME--></th>
								<th style='background-color: yellow; padding: 0.3%'><!--CASH & CARD--></th>
								<th><!--HMO--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--CASH--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--CREDIT CARD--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--HMO--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--Company--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--PHILHEALTH--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--PERSONAL A/R--></th>
								<th style="background-color: yellow; padding:0.2%; "><!--DISCOUNT--></th>
								<th><!--LABORATORY--></th>
								<th><!--XRAY--></th>
								<th><!--UTZ--></th>
								<th><!--ECG--></th>
								<th><!--CTSCAN--></th>
								<th><!--SPIRO--></th>
								<th><!--CARDIAC--></th>
								<th><!--MEDICINE--></th>
								<th><!--SUPPLIES--></th>
								<th><!--ER FEE--></th>
								<th><!--MISC--></th>
								<th><!--OT--></th>
								<th><!--ST--></th>
								<th><!--SPED--></th>
								<th style="background-color:orange; padding:0.2%; "><!--PT--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--DERMA--></th>
								<th><!--OTHERS--></th>
								<th><!--O.R--></th>
								<th><!--A/R OPD PAID--></th>
								<th><!--CLINIC REVENUE--></th>
								<th><!--PF A/P (MD SHARE)--></th>
							</tr>

							<? foreach( $ts->get_outpatients_registrationNo() as $registrationNo ) { ?>

								<? if( $ts->get_outpatients_shift($registrationNo,$month,$dayLoop,$year,$morning) == "Morning" ) { ?>
								<tr>

									<?

										//DEBIT
										$cashPaidMorning = $ts->get_outpatients_cash_payment($registrationNo,$morning);
										$creditCardMorning = $ts->get_outpatients_creditCard_payment($registrationNo,$morning);
										$hmoMorning = $ts->get_outpatients_hmo_covered($registrationNo,$morning);
										$companyMorning = $ts->get_outpatients_company_covered($registrationNo,$morning);
										$philhealthMorning = $ts->get_outpatients_philhealth_covered($registrationNo,$morning);
										$unpaidMorning = $ts->get_outpatients_unpaid_total($registrationNo,$morning);
										$discountMorning = $ts->get_outpatients_discount_total($registrationNo,$morning);

										//CREDIT
										$laboratoryMorning = $ts->get_outpatients_title_total($registrationNo,"LABORATORY",$morning);
										$xrayMorning = $ts->get_outpatients_title_total($registrationNo,"XRAY",$morning);
										$utzMorning = $ts->get_outpatients_title_total($registrationNo,"ULTRASOUND",$morning);
										$ecgMorning = $ts->get_outpatients_title_total($registrationNo,"ECG",$morning);
										$ctscanMorning = $ts->get_outpatients_title_total($registrationNo,"CTSCAN",$morning);
										$spirometryMorning = $ts->get_outpatients_title_total($registrationNo,"SPIROMETRY",$morning);
										$cardiacMorning = $ts->get_outpatients_title_total($registrationNo,"CARDIAC MONITOR",$morning);
										$medicineMorning = $ts->get_outpatients_title_total($registrationNo,"MEDICINE",$morning);
										$suppliesMorning = $ts->get_outpatients_title_total($registrationNo,"SUPPLIES",$morning);
										$erfeeMorning = $ts->get_outpatients_title_total($registrationNo,"ER FEE",$morning);
										$miscMorning = $ts->get_outpatients_title_total($registrationNo,"MISCELLANEOUS",$morning);
										$otMorning = $ts->get_outpatients_therapy_total($registrationNo,"OT",$morning);
										$stMorning = $ts->get_outpatients_therapy_total($registrationNo,"ST",$morning);
										$spedMorning = $ts->get_outpatients_therapy_total($registrationNo,"SPED",$morning);
										$ptMorning = $ts->get_outpatients_title_total($registrationNo,"PT",$morning);
										$dermaMorning = $ts->get_outpatients_title_total($registrationNo,"DERMA",$morning);
										$othersMorning = $ts->get_outpatients_title_total($registrationNo,"OTHERS",$morning);
										$orMorning = $ts->get_outpatients_title_total($registrationNo,"OR/DR/ER Fee",$morning);
										$balanceMorning = $ts->get_outpatients_title_total($registrationNo,"BALANCE",$morning);
										$pfMorning = ( 
												$ts->get_outpatients_PF_total($registrationNo,"PROFESSIONAL FEE",$morning) -
												$ts->get_outpatients_PF_payables_total($registrationNo,"PROFESSIONAL FEE",$morning)

											);		
										$payableMorning = (
												$ts->get_outpatients_PF_payables_total($registrationNo,"PROFESSIONAL FEE",$morning) +
												$ts->get_outpatients_therapy_payables_total($registrationNo,$morning) +
												$ts->get_outpatients_therapy_payables_company_total($registrationNo,$morning)
											);																			


									?>

									<td><!----></td>

									<td class='white'>
										<?
											// OR#
											$ts->or_number($registrationNo,$morning,$month,$dayLoop,$year);

											//this is to avoid showing an error when there is no OR# like in HMO/Company
											if( $ts->get_or_number() > 0 ) {

												//for delimiters of OR# just in case there are more than one OR# existing
												$orCount = count($ts->get_or_number());	

												foreach( $ts->get_or_number() as $or ) {
													if( $orCount > 1 ) {
														echo $or.'/ ';
													}else {
														echo $or;
													}
												}

											}
										?>
									</td>

									<td class='white'>
										<?
											//LAST NAME
											$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
											$lastName = $ro->selectNow('patientRecord','lastName','patientNo',$patientNo);
											echo $lastName;
										?>
									</td>

									<td class='white'>
										<?
											//FIRST NAME
											$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
											$firstName = $ro->selectNow('patientRecord','firstName','patientNo',$patientNo);
											echo $firstName;
										?>
									</td>

									<td style='background-color: yellow; padding: 0.3%'>
										<?
											//CASH & CARD
											echo $ro4->number_format($cashPaidMorning + $creditCardMorning);
										?>
									</td>

									<td>
										<?
											//HMO/COMPANY
											echo $ro->selectNow('registrationDetails','Company','registrationNo',$registrationNo)
										?>
									</td>

									<td style="background-color: lightblue; padding:0.2%; ">
										<?
											//CASH 
											echo $ro4->number_format($cashPaidMorning);
											$cashPaid_per_day += $cashPaidMorning;
											$cashPaidTotal += $cashPaidMorning;

										?>
									</td>

									<td style="background-color: lightblue; padding:0.2%; ">
										<?
											//CREDIT CARD 
											echo $ro4->number_format($creditCardMorning);
											$creditCard_per_day += $creditCardMorning;
											$creditCardTotal += $creditCardMorning;

										?>
									</td>

									<td style="background-color: lightblue; padding:0.2%; ">
										<?
											// A/R HMO
											echo $ro4->number_format($hmoMorning);
											$hmo_per_day += $hmoMorning;
											$hmoTotal += $hmoMorning;

										?>
									</td>

									<td style="background-color: lightblue; padding:0.2%; ">
										<?
											// A/R COMPANY
											echo $ro4->number_format($companyMorning);
											$company_per_day += $companyMorning;
											$companyTotal += $companyMorning;

										?>
									</td>

									<td style="background-color: lightblue; padding:0.2%; ">
										<?
											//PHILHEALTH
											echo $ro4->number_format($philhealthMorning);
											$philhealth_per_day += $philhealthMorning;
											$philhealthTotal += $philhealthMorning;

										?>
									</td>

									<td style="background-color: lightblue; padding:0.2%; ">
										<?
											// A/R PERSONAL
											echo $ro4->number_format($unpaidMorning);
											$unpaid_per_day += $unpaidMorning;
											$unpaidTotal += $unpaidMorning;

										?>
									</td>

									<td style='background-color: yellow; padding: 0.3%'>
										<?
											//DISCOUNT
											echo $ro4->number_format($discountMorning);
											$discount_per_day += $discountMorning;
											$discountTotal += $discountMorning;

										?>
									</td>

									<td>
										<?
											//LABORATORY
											echo $ro4->number_format($laboratoryMorning);
											$laboratory_per_day += $laboratoryMorning;
											$laboratoryTotal += $laboratoryMorning;

										?>
									</td>
								
									<td>
										<?
											//XRAY
											echo $ro4->number_format($xrayMorning);
											$xray_per_day += $xrayMorning;
											$xrayTotal += $xrayMorning;

										?>
									</td>

									<td>
										<?
											//ULTRASOUND
											echo $ro4->number_format($utzMorning);
											$utz_per_day += $utzMorning;
											$utzTotal += $utzMorning;

										?>
									</td>

									<td>
										<?
											//ECG
											echo $ro4->number_format($ecgMorning);
											$ecg_per_day += $ecgMorning;
											$ecgTotal += $ecgMorning;

										?>
									</td>

									<td>
										<?
											//CTSCAN
											echo $ro4->number_format($ctscanMorning);
											$ctscan_per_day += $ctscanMorning;
											$ctscanTotal += $ctscanMorning;

										?>
									</td>

									<td>
										<?
											//SPIROMETRY
											echo $ro4->number_format($spirometryMorning);
											$spirometry_per_day += $spirometryMorning;
											$spirometryTotal += $spirometryMorning;

										?>
									</td>

									<td>
										<?
											//CARDIAC
											echo $ro4->number_format($cardiacMorning);
											$cardiac_per_day += $cardiacMorning;
											$cardiacTotal += $cardiacMorning;

										?>
									</td>									

									<td>
										<?
											//MEDICINE
											echo $ro4->number_format($medicineMorning);
											$medicine_per_day += $medicineMorning;
											$medicineTotal += $medicineMorning;

										?>
									</td>

									<td>
										<?
											//SUPPLIES
											echo $ro4->number_format($suppliesMorning);
											$supplies_per_day += $suppliesMorning;
											$suppliesTotal += $suppliesMorning;

										?>
									</td>

									<td>
										<?
											//ERFEE
											echo $ro4->number_format($erfeeMorning);
											$erfee_per_day += $erfeeMorning;
											$erfeeTotal += $erfeeMorning;

										?>
									</td>

									<td>
										<?
											//MISCELLANEOUS
											echo $ro4->number_format($miscMorning);
											$misc_per_day += $miscMorning;
											$miscTotal += $miscMorning;

										?>
									</td>

									<td>
										<?
											//OT
											echo $ro4->number_format($otMorning);
											$ot_per_day += $otMorning;
											$otTotal += $otMorning;

										?>
									</td>

									<td>
										<?
											//ST
											echo $ro4->number_format($stMorning);
											$st_per_day += $stMorning;
											$stTotal += $stMorning;

										?>
									</td>

									<td class='sped'>
										<?
											//SPED
											echo $ro4->number_format($spedMorning);
											$sped_per_day += $spedMorning;
											$spedTotal += $spedMorning;

										?>
									</td>

									<td style="background-color:orange; padding:0.2%; ">
										<?
											//PT
											echo $ro4->number_format($ptMorning);
											$pt_per_day += $ptMorning;
											$ptTotal += $ptMorning;

										?>
									</td>

									<td style="background-color: lightblue; padding:0.2%; ">
										<?
											//DERMA
											echo $ro4->number_format($dermaMorning);
											$derma_per_day += $dermaMorning;
											$dermaTotal += $dermaMorning;

										?>
									</td>

									<td>
										<?
											//OTHERS
											echo $ro4->number_format($othersMorning);
											$others_per_day += $othersMorning;
											$othersTotal += $othersMorning;

										?>
									</td>

									<td>
										<?
											//O.R
											echo $ro4->number_format($orMorning);
											$or_per_day += $orMorning;
											$orTotal += $orMorning;

										?>
									</td>

									<td>
										<?
											// A/R OPD PAID
											echo $ro4->number_format($balanceMorning);
											$balance_per_day += $balanceMorning;
											$balanceTotal += $balanceMorning;

										?>
									</td>

									<td>
										<?
											//CLINIC REVENUE
											echo $ro4->number_format($pfMorning);
											$pf_per_day += $pfMorning;
											$pfTotal += $pfMorning;

										?>
									</td>

									<td>
										<?
											//PF A/P(MD SHARE)
											echo $ro4->number_format($payableMorning);
											$payable_per_day += $payableMorning;
											$payableTotal += $payableMorning;

										?>
									</td>

								</tr>
								<? } ?>
							<? } ?>


							<!--NOON-->
							<tr>
								<th style='padding-left:1%'>Noon</th>
								<th><!--OR#--></th>
								<th><!--LASTNAME--></th>
								<th><!--FIRSTNAME--></th>
								<th style='background-color: yellow; padding: 0.3%'><!--CASH & CARD--></th>
								<th><!--HMO--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--CASH--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--CREDIT CARD--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--HMO--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--Company--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--PHILHEALTH--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--PERSONAL A/R--></th>
								<th style='background-color: yellow; padding: 0.3%'><!--DISCOUNT--></th>
								<th><!--LABORATORY--></th>
								<th><!--XRAY--></th>
								<th><!--UTZ--></th>
								<th><!--ECG--></th>
								<th><!--CTSCAN--></th>
								<th><!--SPIRO--></th>
								<th><!--CARDIAC--></th>
								<th><!--MEDICINE--></th>
								<th><!--SUPPLIES--></th>
								<th><!--ER FEE--></th>
								<th><!--MISC--></th>
								<th><!--OT--></th>
								<th><!--ST--></th>
								<th class='sped'><!--SPED--></th>
								<th style="background-color:orange; padding:0.2%; "><!--PT--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--DERMA--></th>
								<th><!--OTHERS--></th>
								<th><!--O.R--></th>
								<th><!--A/R OPD PAID--></th>
								<th><!--CLINIC REVENUE--></th>								
							</tr>						
							<? foreach( $ts->get_outpatients_registrationNo() as $registrationNo ) { ?>

								<? if( $ts->get_outpatients_shift($registrationNo,$month,$dayLoop,$year,$noon) == "Noon" ) { ?>
								<tr>
									
									<?
										//DEBIT
										$cashPaidNoon = $ts->get_outpatients_cash_payment($registrationNo,$noon);
										$creditCardNoon = $ts->get_outpatients_creditCard_payment($registrationNo,$noon);
										$hmoNoon = $ts->get_outpatients_hmo_covered($registrationNo,$noon);
										$companyNoon = $ts->get_outpatients_company_covered($registrationNo,$noon);
										$philhealthNoon = $ts->get_outpatients_philhealth_covered($registrationNo,$noon);
										$unpaidNoon = $ts->get_outpatients_unpaid_total($registrationNo,$noon);
										$discountNoon = $ts->get_outpatients_discount_total($registrationNo,$noon);


										//CREDIT
										$laboratoryNoon = $ts->get_outpatients_title_total($registrationNo,"LABORATORY",$noon);
										$xrayNoon = $ts->get_outpatients_title_total($registrationNo,"XRAY",$noon);
										$utzNoon = $ts->get_outpatients_title_total($registrationNo,"ULTRASOUND",$noon);
										$ecgNoon = $ts->get_outpatients_title_total($registrationNo,"ECG",$noon);
										$ctscanNoon = $ts->get_outpatients_title_total($registrationNo,"CTSCAN",$noon);
										$spirometryNoon = $ts->get_outpatients_title_total($registrationNo,"SPIROMETRY",$noon);
										$cardiacNoon = $ts->get_outpatients_title_total($registrationNo,"CARDIAC MONITOR",$noon);
										$medicineNoon = $ts->get_outpatients_title_total($registrationNo,"MEDICINE",$noon);
										$suppliesNoon = $ts->get_outpatients_title_total($registrationNo,"SUPPLIES",$noon);
										$erfeeNoon = $ts->get_outpatients_title_total($registrationNo,"ER FEE",$noon);
										$miscNoon = $ts->get_outpatients_title_total($registrationNo,"MISCELLANEOUS",$noon);
										$otNoon = $ts->get_outpatients_therapy_total($registrationNo,"OT",$noon);
										$stNoon = $ts->get_outpatients_therapy_total($registrationNo,"ST",$noon);
										$spedNoon = $ts->get_outpatients_therapy_total($registrationNo,"SPED",$noon);
										$ptNoon = $ts->get_outpatients_title_total($registrationNo,"PT",$noon);
										$dermaNoon = $ts->get_outpatients_title_total($registrationNo,"DERMA",$noon);
										$othersNoon = $ts->get_outpatients_title_total($registrationNo,"OTHERS",$noon);
										$orNoon = $ts->get_outpatients_title_total($registrationNo,"OR/DR/ER Fee",$noon);
										$balanceNoon = $ts->get_outpatients_title_total($registrationNo,"BALANCE",$noon);
										$pfNoon = ( 
													$ts->get_outpatients_PF_total($registrationNo,"PROFESSIONAL FEE",$noon) -
													$ts->get_outpatients_PF_payables_total($registrationNo,"PROFESSIONAL FEE",$noon)
												);	
										$payableNoon = (
												$ts->get_outpatients_PF_payables_total($registrationNo,"PROFESSIONAL FEE",$noon) +
												$ts->get_outpatients_therapy_payables_total($registrationNo,$noon) +
												$ts->get_outpatients_therapy_payables_company_total($registrationNo,$noon)
											);																					

									?>

									<td><!----></td>


									<td class='white'>
										<?
											// OR#
											$ts->or_number($registrationNo,$noon,$month,$dayLoop,$year);

											//this is to avoid showing an error when there is no OR# like in HMO/Company
											if( $ts->get_or_number() > 0 ) {

												//for delimiters of OR# just in case there are more than one OR# existing
												$orCount = count($ts->get_or_number());	

												foreach( $ts->get_or_number() as $or ) {
													if( $orCount > 1 ) {
														echo $or.'/ ';
													}else {
														echo $or;
													}
												}

											}
										?>
									</td>								

									<td class='white'>
										<?
											//LAST NAME
											$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
											$lastName = $ro->selectNow('patientRecord','lastName','patientNo',$patientNo);
											echo $lastName;
										?>
									</td>

									<td class='white'>
										<?
											//FIRST NAME
											$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
											$firstName = $ro->selectNow('patientRecord','firstName','patientNo',$patientNo);
											echo $firstName;
										?>
									</td>

									<td style='background-color: yellow; padding: 0.3%'>
										<?
											//CASH & CARD
											echo $ro4->number_format($cashPaidNoon + $creditCardNoon);
										?>
									</td>

									<td>
										<?
											// HMO/COMPANY
											echo $ro->selectNow('registrationDetails','Company','registrationNo',$registrationNo)
										?>
									</td>

									<td style="background-color: lightblue; padding:0.2%; ">
										<?
											//CASH
											echo $ro4->number_format($cashPaidNoon);
											$cashPaid_per_day += $cashPaidNoon;
											$cashPaidTotal += $cashPaidNoon;

										?>
									</td>

									<td style="background-color: lightblue; padding:0.2%; ">
										<?
											//CREDIT CARD
											echo $ro4->number_format($creditCardNoon);
											$creditCard_per_day += $creditCardNoon;
											$creditCardTotal += $creditCardNoon;

										?>
									</td>

									<td style="background-color: lightblue; padding:0.2%; ">
										<?
											//HMO
											echo $ro4->number_format($hmoNoon);
											$hmo_per_day += $hmoNoon;
											$hmoTotal += $hmoNoon;

										?>
									</td>

									<td style="background-color: lightblue; padding:0.2%; ">
										<?
											//COMPANY
											echo $ro4->number_format($companyNoon);
											$company_per_day += $companyNoon;
											$companyTotal += $companyNoon;

										?>
									</td>

									<td style="background-color: lightblue; padding:0.2%; ">
										<?
											//PHILHEALTH
											echo $ro4->number_format($philhealthNoon);
											$philhealth_per_day += $philhealthNoon;
											$philhealthTotal += $philhealthNoon;

										?>
									</td>

									<td style="background-color: lightblue; padding:0.2%; ">
										<?
											// A/R PERSONAL
											echo $ro4->number_format($unpaidNoon);
											$unpaid_per_day += $unpaidNoon;
											$unpaidTotal += $unpaidNoon;

										?>
									</td>

									<td style='background-color: yellow; padding: 0.3%'>
										<?
											//DISCOUNT
											echo $ro4->number_format($discountNoon);
											$discount_per_day += $discountNoon;
											$discountTotal += $discountNoon;

										?>
									</td>

									<td>
										<?
											//LABORATORY
											echo $ro4->number_format($laboratoryNoon);
											$laboratory_per_day += $laboratoryNoon;
											$laboratoryTotal += $laboratoryNoon;
										?>
									</td>

									<td>
										<?
											//XRAY
											echo $ro4->number_format($xrayNoon);
											$xray_per_day += $xrayNoon;
											$xrayTotal += $xrayNoon;

										?>
									</td>

									<td>
										<?
											//ULTRASOUND
											echo $ro4->number_format($utzNoon);
											$utz_per_day += $utzNoon;
											$utzTotal += $utzNoon;

										?>
									</td>									

									<td>
										<?
											//ECG
											echo $ro4->number_format($ecgNoon);
											$ecg_per_day += $ecgNoon;
											$ecgTotal += $ecgNoon;

										?>
									</td>

									<td>
										<?
											//CTSCAN
											echo $ro4->number_format($ctscanNoon);
											$ctscan_per_day += $ctscanNoon;
											$ctscanTotal += $ctscanNoon;

										?>
									</td>

									<td>
										<?
											//SPIROMETRY
											echo $ro4->number_format($spirometryNoon);
											$spirometry_per_day += $spirometryNoon;
											$spirometryTotal += $spirometryNoon;

										?>
									</td>

									<td>
										<?
											//CARDIAC
											echo $ro4->number_format($cardiacNoon);
											$cardiac_per_day += $cardiacNoon;
											$cardiacTotal += $cardiacNoon;

										?>
									</td>

									<td>
										<?
											//MEDICINE
											echo $ro4->number_format($medicineNoon);
											$medicine_per_day += $medicineNoon;
											$medicineTotal += $medicineNoon;

										?>
									</td>

									<td>
										<?
											//SUPPLIES
											echo $ro4->number_format($suppliesNoon);
											$supplies_per_day += $suppliesNoon;
											$suppliesTotal += $suppliesNoon;

										?>
									</td>

									<td>
										<?
											//ERFEE
											echo $ro4->number_format($erfeeNoon);
											$erfee_per_day += $erfeeNoon;
											$erfeeTotal += $erfeeNoon;

										?>
									</td>

									<td>
										<?
											//MISCELLANEOUS
											echo $ro4->number_format($miscNoon);
											$misc_per_day += $miscNoon;
											$miscTotal += $miscNoon;

										?>
									</td>

									<td>
										<?
											//OT
											echo $ro4->number_format($otNoon);
											$ot_per_day += $otNoon;
											$otTotal += $otNoon;

										?>
									</td>

									<td>
										<?
											//ST
											echo $ro4->number_format($stNoon);
											$st_per_day += $stNoon;
											$stTotal += $stNoon;

										?>
									</td>

									<td class='sped'>
										<?
											//SPED
											echo $ro4->number_format($spedNoon);
											$sped_per_day += $spedNoon;
											$spedTotal += $spedNoon;

										?>
									</td>

									<td style="background-color:orange; padding:0.2%; ">
										<?
											//PT
											echo $ro4->number_format($ptNoon);
											$pt_per_day += $ptNoon;
											$ptTotal += $ptNoon;

										?>
									</td>

									<td style="background-color: lightblue; padding:0.2%; ">
										<?
											//DERMA
											echo $ro4->number_format($dermaNoon);
											$derma_per_day += $dermaNoon;
											$dermaTotal += $dermaNoon;

										?>
									</td>

									<td>
										<?
											//OTHERS
											echo $ro4->number_format($othersNoon);
											$others_per_day += $othersNoon;
											$othersTotal += $othersNoon;

										?>
									</td>

									<td>
										<?
											//O.R
											echo $ro4->number_format($orNoon);
											$or_per_day += $orNoon;
											$orTotal += $orNoon;

										?>
									</td>

									<td>
										<?
											// A/R OPD PAID
											echo $ro4->number_format($balanceNoon);
											$balance_per_day += $balanceNoon;
											$balanceTotal += $balanceNoon;

										?>
									</td>

									<td>
										<?
											//CLINIC REVENUE
											echo $ro4->number_format($pfNoon);
											$pf_per_day += $pfNoon;
											$pfTotal += $pfNoon;

										?>
									</td>

									<td>
										<?
											//PF A/P(MD SHARE)
											echo $ro4->number_format($payableNoon);
											$payable_per_day += $payableNoon;
											$payableTotal += $payableNoon;

										?>
									</td>

								</tr>
								<? } ?>
							<? } ?>


							<!--AFTERNOON-->
							<tr>
								<th style='padding-left:1%'>Afternoon</th>
								<th><!--OR#--></th>
								<th><!--LASTNAME--></th>
								<th><!--FIRSTNAME--></th>
								<th style='background-color: yellow; padding: 0.3%'><!--CASH & CARD--></th>
								<th><!--HMO--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--CASH--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--CREDIT CARD--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--HMO--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--Company--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--PHILHEALTH--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--PERSONAL A/R--></th>
								<th style='background-color: yellow; padding: 0.3%'><!--DISCOUNT--></th>
								<th><!--LABORATORY--></th>
								<th><!--XRAY--></th>
								<th><!--UTZ--></th>
								<th><!--ECG--></th>
								<th><!--CTSCAN--></th>
								<th><!--SPIRO--></th>
								<th><!--CARDIAC--></th>
								<th><!--MEDICINE--></th>
								<th><!--SUPPLIES--></th>
								<th><!--ER FEE--></th>
								<th><!--MISC--></th>
								<th><!--OT--></th>
								<th><!--ST--></th>
								<th class='sped'><!--SPED--></th>
								<th style="background-color:orange; padding:0.2%; "><!--PT--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--DERMA--></th>
								<th><!--OTHERS--></th>
								<th><!--O.R--></th>
								<th><!--A/R OPD PAID--></th>
								<th><!--CLINIC REVENUE--></th>
							</tr>						
							<? foreach( $ts->get_outpatients_registrationNo() as $registrationNo ) { ?>

								<? if( $ts->get_outpatients_shift($registrationNo,$month,$dayLoop,$year,$afternoon) == "Afternoon" ) { ?>
								<tr>

									<?
										//DEBIT
										$cashPaidAfternoon = $ts->get_outpatients_cash_payment($registrationNo,$afternoon);
										$creditCardAfternoon = $ts->get_outpatients_creditCard_payment($registrationNo,$afternoon);
										$hmoAfternoon = $ts->get_outpatients_hmo_covered($registrationNo,$afternoon);
										$companyAfternoon = $ts->get_outpatients_company_covered($registrationNo,$afternoon);
										$philhealthAfternoon = $ts->get_outpatients_philhealth_covered($registrationNo,$afternoon);
										$unpaidAfternoon = $ts->get_outpatients_unpaid_total($registrationNo,$afternoon);
										$discountAfternoon = $ts->get_outpatients_discount_total($registrationNo,$afternoon);

										//CREDIT
										$laboratoryAfternoon = $ts->get_outpatients_title_total($registrationNo,"LABORATORY",$afternoon);
										$xrayAfternoon = $ts->get_outpatients_title_total($registrationNo,"XRAY",$afternoon);
										$utzAfternoon = $ts->get_outpatients_title_total($registrationNo,"ULTRASOUND",$afternoon);
										$ecgAfternoon = $ts->get_outpatients_title_total($registrationNo,"ECG",$afternoon);
										$ctscanAfternoon = $ts->get_outpatients_title_total($registrationNo,"CTSCAN",$afternoon);
										$spirometryAfternoon = $ts->get_outpatients_title_total($registrationNo,"SPIROMETRY",$afternoon);
										$cardiacAfternoon = $ts->get_outpatients_title_total($registrationNo,"CARDIAC MONITOR",$afternoon);
										$medicineAfternoon = $ts->get_outpatients_title_total($registrationNo,"MEDICINE",$afternoon);
										$suppliesAfternoon = $ts->get_outpatients_title_total($registrationNo,"SUPPLIES",$afternoon);
										$erfeeAfternoon = $ts->get_outpatients_title_total($registrationNo,"ER FEE",$afternoon);
										$miscAfternoon = $ts->get_outpatients_title_total($registrationNo,"MISCELLANEOUS",$afternoon);
										$otAfternoon = $ts->get_outpatients_therapy_total($registrationNo,"OT",$afternoon);
										$stAfternoon = $ts->get_outpatients_therapy_total($registrationNo,"ST",$afternoon);
										$spedAfternoon = $ts->get_outpatients_therapy_total($registrationNo,"SPED",$afternoon);
										$ptAfternoon = $ts->get_outpatients_title_total($registrationNo,"PT",$afternoon);
										$dermaAfternoon = $ts->get_outpatients_title_total($registrationNo,"DERMA",$afternoon);
										$othersAfternoon = $ts->get_outpatients_title_total($registrationNo,"OTHERS",$afternoon);
										$orAfternoon = $ts->get_outpatients_title_total($registrationNo,"OR/DR/ER Fee",$afternoon);
										$balanceAfternoon = $ts->get_outpatients_title_total($registrationNo,"BALANCE",$afternoon);
										$pfAfternoon = (
													$ts->get_outpatients_PF_total($registrationNo,"PROFESSIONAL FEE",$afternoon) - 
													$ts->get_outpatients_PF_payables_total($registrationNo,"PROFESSIONAL FEE",$afternoon)
												);										
										$payableAfternoon = (
												$ts->get_outpatients_PF_payables_total($registrationNo,"PROFESSIONAL FEE",$afternoon) +
												$ts->get_outpatients_therapy_payables_total($registrationNo,$afternoon) +
												$ts->get_outpatients_therapy_payables_company_total($registrationNo,$afternoon)
											);										


									?>

									<td><!----></td>


									<td class='white'>
										<?
											// OR#
											$ts->or_number($registrationNo,$afternoon,$month,$dayLoop,$year);

											//this is to avoid showing an error when there is no OR# like in HMO/Company
											if( $ts->get_or_number() > 0 ) {

												//for delimiters of OR# just in case there are more than one OR# existing
												$orCount = count($ts->get_or_number());	

												foreach( $ts->get_or_number() as $or ) {
													if( $orCount > 1 ) {
														echo $or.'/ ';
													}else {
														echo $or;
													}
												}

											}
										?>
									</td>

									<td class='white'>
										<?
											//LASTNAME
											$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
											$lastName = $ro->selectNow('patientRecord','lastName','patientNo',$patientNo);
											echo $lastName;
										?>
									</td>

									<td class='white'>
										<?
											//FIRSTNAME
											$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
											$firstName = $ro->selectNow('patientRecord','firstName','patientNo',$patientNo);
											echo $firstName;
										?>
									</td>

									<td style='background-color: yellow; padding: 0.3%'>
										<?
											// CASH & CARD
											echo $ro4->number_format($cashPaidAfternoon + $creditCardAfternoon);
										?>
									</td>

									<td>
										<?
											// HMO/COMPANY
											echo $ro->selectNow('registrationDetails','Company','registrationNo',$registrationNo)
										?>
									</td>

									<td style="background-color: lightblue; padding:0.2%; ">
										<?
											//CASH
											echo $ro4->number_format($cashPaidAfternoon);
											$cashPaid_per_day += $cashPaidAfternoon;
											$cashPaidTotal += $cashPaidAfternoon;

										?>
									</td>

									<td style="background-color: lightblue; padding:0.2%; ">
										<?
											//CREDIT CARD
											echo $ro4->number_format($creditCardAfternoon);
											$creditCard_per_day += $creditCardAfternoon;
											$creditCardTotal += $creditCardAfternoon;

										?>
									</td>

									<td style="background-color: lightblue; padding:0.2%; ">
										<?
											//HMO
											echo $ro4->number_format($hmoAfternoon);
											$hmo_per_day += $hmoAfternoon;
											$hmoTotal += $hmoAfternoon;

										?>
									</td>

									<td style="background-color: lightblue; padding:0.2%; ">
										<?
											//COMPANY
											echo $ro4->number_format($companyAfternoon);
											$company_per_day += $companyAfternoon;
											$companyTotal += $companyAfternoon;

										?>
									</td>

									<td style="background-color: lightblue; padding:0.2%; ">
										<?
											//PHILHEALTH
											echo $ro4->number_format($philhealthAfternoon);
											$philhealth_per_day += $philhealthAfternoon;
											$philhealthTotal += $philhealthAfternoon;

										?>
									</td>

									<td style="background-color: lightblue; padding:0.2%; ">
										<?
											// A/R PERSONAL
											echo $ro4->number_format($unpaidAfternoon);
											$unpaid_per_day += $unpaidAfternoon;
											$unpaidTotal += $unpaidAfternoon;

										?>
									</td>

									<td style='background-color: yellow; padding: 0.3%'>
										<?
											//DISCOUNT
											echo $ro4->number_format($discountAfternoon);
											$discount_per_day += $discountAfternoon;
											$discountTotal += $discountAfternoon;

										?>
									</td>

									<td>
										<?
											//LABORATORY
											echo $ro4->number_format($laboratoryAfternoon);
											$laboratory_per_day += $laboratoryAfternoon;
											$laboratoryTotal += $laboratoryAfternoon;
										?>
									</td>

									<td>
										<?
											//XRAY
											echo $ro4->number_format($xrayAfternoon);
											$xray_per_day += $xrayAfternoon;
											$xrayTotal += $xrayAfternoon;

										?>
									</td>

									<td>
										<?
											//ULTRASOUND
											echo $ro4->number_format($utzAfternoon);
											$utz_per_day += $utzAfternoon;
											$utzTotal += $utzAfternoon;

										?>
									</td>									

									<td>
										<?
											//ECG
											echo $ro4->number_format($ecgAfternoon);
											$ecg_per_day += $ecgAfternoon;
											$ecgTotal += $ecgAfternoon;

										?>
									</td>

									<td>
										<?
											//CTSCAN
											echo $ro4->number_format($ctscanAfternoon);
											$ctscan_per_day += $ctscanAfternoon;
											$ctscanTotal += $ctscanAfternoon;

										?>
									</td>

									<td>
										<?
											//SPIROMETRY
											echo $ro4->number_format($spirometryAfternoon);
											$spirometry_per_day += $spirometryAfternoon;
											$spirometryTotal += $spirometryAfternoon;

										?>
									</td>

									<td>
										<?
											//CARDIAC
											echo $ro4->number_format($cardiacAfternoon);
											$cardiac_per_day += $cardiacAfternoon;
											$cardiacTotal += $cardiacAfternoon;

										?>
									</td>

									<td>
										<?
											//MEDICINE
											echo $ro4->number_format($medicineAfternoon);
											$medicine_per_day += $medicineAfternoon;
											$medicineTotal += $medicineAfternoon;

										?>
									</td>

									<td>
										<?
											//SUPPLIES
											echo $ro4->number_format($suppliesAfternoon);
											$supplies_per_day += $suppliesAfternoon;
											$suppliesTotal += $suppliesAfternoon;

										?>
									</td>

									<td>
										<?
											//ERFEE
											echo $ro4->number_format($erfeeAfternoon);
											$erfee_per_day += $erfeeAfternoon;
											$erfeeTotal += $erfeeAfternoon;

										?>
									</td>

									<td>
										<?
											//MISCELLANEOUS
											echo $ro4->number_format($miscAfternoon);
											$misc_per_day += $miscAfternoon;
											$miscTotal += $miscAfternoon;

										?>
									</td>

									<td>
										<?
											//OT
											echo $ro4->number_format($otAfternoon);
											$ot_per_day += $otAfternoon;
											$otTotal += $otAfternoon;

										?>
									</td>

									<td>
										<?
											//ST
											echo $ro4->number_format($stAfternoon);
											$st_per_day += $stAfternoon;
											$stTotal += $stAfternoon;

										?>
									</td>

									<td class='sped'>
										<?
											//SPED
											echo $ro4->number_format($spedAfternoon);
											$sped_per_day += $spedAfternoon;
											$spedTotal += $spedAfternoon;

										?>
									</td>

									<td style="background-color:orange; padding:0.2%; ">
										<?
											//PT
											echo $ro4->number_format($ptAfternoon);
											$pt_per_day += $ptAfternoon;
											$ptTotal += $ptAfternoon;

										?>
									</td>

									<td style="background-color: lightblue; padding:0.2%; ">
										<?
											//DERMA
											echo $ro4->number_format($dermaAfternoon);
											$derma_per_day += $dermaAfternoon;
											$dermaTotal += $dermaAfternoon;

										?>
									</td>

									<td>
										<?
											//OTHERS
											echo $ro4->number_format($othersAfternoon);
											$others_per_day += $othersAfternoon;
											$othersTotal += $othersAfternoon;

										?>
									</td>

									<td>
										<?
											//O.R
											echo $ro4->number_format($orAfternoon);
											$or_per_day += $orAfternoon;
											$orTotal += $orAfternoon;

										?>
									</td>

									<td>
										<?
											// A/R OPD PAID
											echo $ro4->number_format($balanceAfternoon);
											$balance_per_day += $balanceAfternoon;
											$balanceTotal += $balanceAfternoon;

										?>
									</td>

									<td>
										<?
											//CLINIC REVENUE
											echo $ro4->number_format($pfAfternoon);
											$pf_per_day += $pfAfternoon;
											$pfTotal += $pfAfternoon;

										?>
									</td>

									<td>
										<?
											// PF A/P(MD SHARE)
											echo $ro4->number_format($payableAfternoon);
											$payable_per_day += $payableAfternoon;
											$payableTotal += $payableAfternoon;

										?>
									</td>

								</tr>
								<? } ?>
							<? } ?>


							<!--NIGHT-->
							<tr>
								<th style='padding-left:1%'>Night</th>
								<th><!--OR#--></th>
								<th><!--LASTNAME--></th>
								<th><!--FIRSTNAME--></th>
								<th style='background-color: yellow; padding: 0.3%'><!--CASH & CARD--></th>
								<th><!--HMO--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--CASH--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--CREDIT CARD--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--HMO--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--Company--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--PHILHEALTH--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--PERSONAL A/R--></th>
								<th style='background-color: yellow; padding: 0.3%'><!--DISCOUNT--></th>
								<th><!--LABORATORY--></th>
								<th><!--XRAY--></th>
								<th><!--UTZ--></th>
								<th><!--ECG--></th>
								<th><!--CTSCAN--></th>
								<th><!--SPIRO--></th>
								<th><!--CARDIAC--></th>
								<th><!--MEDICINE--></th>
								<th><!--SUPPLIES--></th>
								<th><!--ER FEE--></th>
								<th><!--MISC--></th>
								<th><!--OT--></th>
								<th><!--ST--></th>
								<th><!--SPED--></th>
								<th style="background-color:orange; padding:0.2%; "><!--PT--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--DERMA--></th>
								<th><!--OTHERS--></th>
								<th><!--O.R--></th>
								<th><!--A/R OPD PAID--></th>
								<th><!--CLINIC REVENUE--></th>
							</tr>						
							<? foreach( $ts->get_outpatients_registrationNo() as $registrationNo ) { ?>

								<? if( $ts->get_outpatients_shift($registrationNo,$month,$dayLoop,$year,$night) == "Night" ) { ?>
								<tr>

									<?
										//DEBIT
										$cashPaidNight = $ts->get_outpatients_cash_payment($registrationNo,$night);
										$creditCardNight = $ts->get_outpatients_creditCard_payment($registrationNo,$night);
										$hmoNight = $ts->get_outpatients_hmo_covered($registrationNo,$night);
										$companyNight = $ts->get_outpatients_company_covered($registrationNo,$night);
										$philhealthNight = $ts->get_outpatients_philhealth_covered($registrationNo,$night);
										$unpaidNight = $ts->get_outpatients_unpaid_total($registrationNo,$night);
										$discountNight = $ts->get_outpatients_discount_total($registrationNo,$night);


										//CREDIT
										$laboratoryNight = $ts->get_outpatients_title_total($registrationNo,"LABORATORY",$night);
										$xrayNight = $ts->get_outpatients_title_total($registrationNo,"XRAY",$night);
										$utzNight = $ts->get_outpatients_title_total($registrationNo,"ULTRASOUND",$night);
										$ecgNight = $ts->get_outpatients_title_total($registrationNo,"ECG",$night);
										$ctscanNight = $ts->get_outpatients_title_total($registrationNo,"CTSCAN",$night);
										$spirometryNight = $ts->get_outpatients_title_total($registrationNo,"SPIROMETRY",$night);
										$cardiacNight = $ts->get_outpatients_title_total($registrationNo,"CARDIAC MONITOR",$night);
										$medicineNight = $ts->get_outpatients_title_total($registrationNo,"MEDICINE",$night);
										$suppliesNight = $ts->get_outpatients_title_total($registrationNo,"SUPPLIES",$night);
										$erfeeNight = $ts->get_outpatients_title_total($registrationNo,"ER FEE",$night);
										$miscNight = $ts->get_outpatients_title_total($registrationNo,"MISCELLANEOUS",$night);
										$otNight = $ts->get_outpatients_therapy_total($registrationNo,"OT",$night);
										$stNight = $ts->get_outpatients_therapy_total($registrationNo,"ST",$night);
										$spedNight = $ts->get_outpatients_therapy_total($registrationNo,"SPED",$night);
										$ptNight = $ts->get_outpatients_title_total($registrationNo,"PT",$night);
										$dermaNight = $ts->get_outpatients_title_total($registrationNo,"DERMA",$night);
										$othersNight = $ts->get_outpatients_title_total($registrationNo,"OTHERS",$night);
										$orNight = $ts->get_outpatients_title_total($registrationNo,"OR/DR/ER Fee",$night);
										$balanceNight = $ts->get_outpatients_title_total($registrationNo,"BALANCE",$night);
										$pfNight = (
													$ts->get_outpatients_PF_total($registrationNo,"PROFESSIONAL FEE",$night) -
													$ts->get_outpatients_PF_payables_total($registrationNo,"PROFESSIONAL FEE",$night)
												);				
										$payableNight = (
													$ts->get_outpatients_PF_payables_total($registrationNo,"PROFESSIONAL FEE",$night) +
													$ts->get_outpatients_therapy_payables_total($registrationNo,$night) + 
													$ts->get_outpatients_therapy_payables_company_total($registrationNo,$night)
												);																		


									?>

									<td><!----></td>


									<td class='white'>
										<?
											// OR#
											$ts->or_number($registrationNo,$night,$month,$dayLoop,$year);

											//this is to avoid showing an error when there is no OR# like in HMO/Company
											if( $ts->get_or_number() > 0 ) {

												//for delimiters of OR# just in case there are more than one OR# existing
												$orCount = count($ts->get_or_number());	

												foreach( $ts->get_or_number() as $or ) {
													if( $orCount > 1 ) {
														echo $or.'/ ';
													}else {
														echo $or;
													}
												}

											}
										?>
									</td>

									<td class='white'>
										<?
											//LAST NAME
											$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
											$lastName = $ro->selectNow('patientRecord','lastName','patientNo',$patientNo);
											echo $lastName;
										?>
									</td>

									<td class='white'>
										<?
											//FIRST NAME
											$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
											$firstName = $ro->selectNow('patientRecord','firstName','patientNo',$patientNo);
											echo $firstName;
										?>
									</td>

									<td style='background-color: yellow; padding: 0.3%'>
										<?
											//CASH & CARD
											echo $ro4->number_format($cashPaidNight + $creditCardNight);
										?>
									</td>

									<td>
										<?
											// HMO/COMPANY
											echo $ro->selectNow('registrationDetails','Company','registrationNo',$registrationNo)
										?>
									</td>

									<td style="background-color: lightblue; padding:0.2%; ">
										<?
											//CASH
											echo $ro4->number_format($cashPaidNight);
											$cashPaid_per_day += $cashPaidNight;
											$cashPaidTotal += $cashPaidNight;

										?>
									</td>

									<td style="background-color: lightblue; padding:0.2%; ">
										<?
											//CREDIT CARD
											echo $ro4->number_format($creditCardNight);
											$creditCard_per_day += $creditCardNight;
											$creditCardTotal += $creditCardNight;

										?>
									</td>

									<td style="background-color: lightblue; padding:0.2%; ">
										<?
											//HMO
											echo $ro4->number_format($hmoNight);
											$hmo_per_day += $hmoNight;
											$hmoTotal += $hmoNight;

										?>
									</td>

									<td style="background-color: lightblue; padding:0.2%; ">
										<?
											//COMPANY
											echo $ro4->number_format($companyNight);
											$company_per_day += $companyNight;
											$companyTotal += $companyNight;

										?>
									</td>

									<td style="background-color: lightblue; padding:0.2%; ">
										<?
											//PHILHEALTH
											echo $ro4->number_format($philhealthNight);
											$philhealth_per_day += $philhealthNight;
											$philhealthTotal += $philhealthNight;

										?>
									</td>

									<td style="background-color: lightblue; padding:0.2%; ">
										<?
											// A/R PERSONAL
											echo $ro4->number_format($unpaidNight);
											$unpaid_per_day += $unpaidNight;
											$unpaidTotal += $unpaidNight;

										?>
									</td>

									<td style='background-color: yellow; padding: 0.3%'>
										<?
											//DISCOUNT
											echo $ro4->number_format($discountNight);
											$discount_per_day += $discountNight;
											$discountTotal += $discountNight;

										?>
									</td>

									<td>
										<?
											//LABORATORY
											echo $ro4->number_format($laboratoryNight);
											$laboratory_per_day += $laboratoryNight;
											$laboratoryTotal += $laboratoryNight;
										?>
									</td>	

									<td>
										<?
											//XRAY
											echo $ro4->number_format($xrayNight);
											$xray_per_day += $xrayNight;
											$xrayTotal += $xrayNight;

										?>
									</td>

									<td>
										<?
											//ULTRASOUND
											echo $ro4->number_format($utzNight);
											$utz_per_day += $utzNight;
											$utzTotal += $utzNight;

										?>
									</td>

									<td>
										<?
											//ECG
											echo $ro4->number_format($ecgNight);
											$ecg_per_day += $ecgNight;
											$ecgTotal += $ecgNight;

										?>
									</td>

									<td>
										<?
											//CTSCAN
											echo $ro4->number_format($ctscanNight);
											$ctscan_per_day += $ctscanNight;
											$ctscanTotal += $ctscanNight;

										?>
									</td>

									<td>
										<?
											//SPIROMETRY
											echo $ro4->number_format($spirometryNight);
											$spirometry_per_day += $spirometryNight;
											$spirometryTotal += $spirometryNight;

										?>
									</td>

									<td>
										<?
											//CARDIAC
											echo $ro4->number_format($cardiacNight);
											$cardiac_per_day += $cardiacNight;
											$cardiacTotal += $cardiacNight;

										?>
									</td>

									<td>
										<?
											//MEDICINE
											echo $ro4->number_format($medicineNight);
											$medicine_per_day += $medicineNight;
											$medicineTotal += $medicineNight;

										?>
									</td>

									<td>
										<?
											//SUPPLIES
											echo $ro4->number_format($suppliesNight);
											$supplies_per_day += $suppliesNight;
											$suppliesTotal += $suppliesNight;

										?>
									</td>

									<td>
										<?
											//ERFEE
											echo $ro4->number_format($erfeeNight);
											$erfee_per_day += $erfeeNight;
											$erfeeTotal += $erfeeNight;

										?>
									</td>

									<td>
										<?
											//MISCELLANEOUS
											echo $ro4->number_format($miscNight);
											$misc_per_day += $miscNight;
											$miscTotal += $miscNight;

										?>
									</td>

									<td>
										<?
											//OT
											echo $ro4->number_format($otNight);
											$ot_per_day += $otNight;
											$otTotal += $otNight;

										?>
									</td>

									<td>
										<?
											//ST
											echo $ro4->number_format($stNight);
											$st_per_day += $stNight;
											$stTotal += $stNight;

										?>
									</td>

									<td class='sped'>
										<?
											//SPED
											echo $ro4->number_format($spedNight);
											$sped_per_day += $spedNight;
											$spedTotal += $spedNight;

										?>
									</td>

									<td style="background-color:orange; padding:0.2%; ">
										<?
											//PT
											echo $ro4->number_format($ptNight);
											$pt_per_day += $ptNight;
											$ptTotal += $ptNight;

										?>
									</td>

									<td style="background-color: lightblue; padding:0.2%; ">
										<?
											//DERMA
											echo $ro4->number_format($dermaNight);
											$derma_per_day += $dermaNight;
											$dermaTotal += $dermaNight;

										?>
									</td>

									<td>
										<?
											//OTHERS
											echo $ro4->number_format($othersNight);
											$others_per_day += $othersNight;
											$othersTotal += $othersNight;

										?>
									</td>

									<td>
										<?
											//O.R
											echo $ro4->number_format($orNight);
											$or_per_day += $orNight;
											$orTotal += $orNight;

										?>
									</td>

									<td>
										<?
											// A/R OPD PAID
											echo $ro4->number_format($balanceNight);
											$balance_per_day += $balanceNight;
											$balanceTotal += $balanceNight;

										?>
									</td>


									<td>
										<?
											//CLINIC REVENUE
											echo $ro4->number_format($pfNight);
											$pf_per_day += $pfNight;
											$pfTotal += $pfNight;

										?>
									</td>

									<td>
										<?
											// PF A/P(MD SHARE)
											echo $ro4->number_format($payableNight);
											$payable_per_day += $payableNight;
											$payableTotal += $payableNight;

										?>
									</td>

								</tr>
								<? } ?>
							<? } ?>


							<!--WITHOUT SHIFT-->
							<tr>
								<th style='padding-left:1%'>NO SHIFT</th>
								<th><!--OR#--></th>
								<th><!--LASTNAME--></th>
								<th><!--FIRSTNAME--></th>
								<th style='background-color: yellow; padding: 0.3%'><!--CASH & CARD--></th>
								<th><!--HMO--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--CASH PAID--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--CREDIT CARD--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--HMO--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--Company--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--PHILHEALTH--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--PERSONAL A/R--></th>
								<th style='background-color: yellow; padding: 0.3%'><!--DISCOUNT--></th>
								<th><!--LABORATORY--></th>
								<th><!--XRAY--></th>
								<th><!--UTZ--></th>
								<th><!--ECG--></th>
								<th><!--CTSCAN--></th>
								<th><!--SPIRO--></th>
								<th><!--CARDIAC--></th>
								<th><!--MEDICINE--></th>
								<th><!--SUPPLIES--></th>
								<th><!--ER FEE--></th>
								<th><!--MISC--></th>
								<th><!--OT--></th>
								<th><!--ST--></th>
								<th><!--SPED--></th>
								<th style="background-color:orange; padding:0.2%; "><!--PT--></th>
								<th style="background-color: lightblue; padding:0.2%; "><!--DERMA--></th>
								<th><!--OTHERS--></th>
								<th><!--O.R--></th>
								<th><!--A/R OPD PAID--></th>
								<th><!--CLINIC REVENUE--></th>								
							</tr>						
							<? foreach( $ts->get_outpatients_registrationNo() as $registrationNo ) { ?>
								
								<? if( $ts->get_outpatients_shift($registrationNo,$month,$dayLoop,$year,$noShift) == "noShift" ) { ?>
									<? if( $ts->check_total($registrationNo) > 0 ) { ?>
									<tr>
										<?

											//DEBIT
											$hmo_no_shift = $ts->get_outpatients_hmo_covered($registrationNo,$noShift);
											$company_no_shift = $ts->get_outpatients_company_covered($registrationNo,$noShift);
											$philhealth_no_shift = $ts->get_outpatients_philhealth_covered($registrationNo,$noShift);
											$unpaid_no_shift = $ts->get_outpatients_unpaid_total($registrationNo,$noShift);
											$discount_no_shift = $ts->get_outpatients_discount_total($registrationNo,$noShift);

											//CREDIT
											$laboratory_no_shift = $ts->get_outpatients_title_total($registrationNo,"LABORATORY",$noShift);
											$xray_no_shift = $ts->get_outpatients_title_total($registrationNo,"XRAY",$noShift);
											$utz_no_shift = $ts->get_outpatients_title_total($registrationNo,"ULTRASOUND",$noShift);
											$ecg_no_shift = $ts->get_outpatients_title_total($registrationNo,"ECG",$noShift);
											$ctscan_no_shift = $ts->get_outpatients_title_total($registrationNo,"CTSCAN",$noShift);
											$spirometry_no_shift = $ts->get_outpatients_title_total($registrationNo,"SPIROMETRY",$noShift);
											$cardiac_no_shift = $ts->get_outpatients_title_total($registrationNo,"CARDIAC MONITOR",$noShift);
											$medicine_no_shift = $ts->get_outpatients_title_total($registrationNo,"MEDICINE",$noShift);
											$supplies_no_shift = $ts->get_outpatients_title_total($registrationNo,"SUPPLIES",$noShift);
											$erfee_no_shift = $ts->get_outpatients_title_total($registrationNo,"ER FEE",$noShift);
											$misc_no_shift = $ts->get_outpatients_title_total($registrationNo,"MISCELLANEOUS",$noShift);
											$ot_no_shift = $ts->get_outpatients_therapy_total($registrationNo,"OT",$noShift);
											$st_no_shift = $ts->get_outpatients_therapy_total($registrationNo,"ST",$noShift);
											$sped_no_shift = $ts->get_outpatients_therapy_total($registrationNo,"SPED",$noShift);
											$pt_no_shift = $ts->get_outpatients_title_total($registrationNo,"PT",$noShift);
											$derma_no_shift = $ts->get_outpatients_title_total($registrationNo,"DERMA",$noShift);
											$others_no_shift = $ts->get_outpatients_title_total($registrationNo,"OTHERS",$noShift);
											$or_no_shift = $ts->get_outpatients_title_total($registrationNo,"OR/DR/ER Fee",$noShift);
											$balance_no_shift = $ts->get_outpatients_title_total($registrationNo,"BALANCE",$noShift);
											$pf_no_shift = $ts->get_outpatients_PF_total($registrationNo,"PROFESSIONAL FEE",$noShift);
											$payable_no_shift = ($ts->get_outpatients_PF_payables_total($registrationNo,"PROFESSIONAL FEE",$noShift) + $ts->get_outpatients_therapy_payables_total($registrationNo,$noShift));											




										?>

										<td><!----></td>
										

										<td class='white'>
											<?
												// OR#

												$ts->or_number($registrationNo,$noShift,$month,$dayLoop,$year);

												//this is to avoid showing an error when there is no OR# like in HMO/Company
												if( $ts->get_or_number() > 0 ) {

													//for delimiters of OR# just in case there are more than one OR# existing
													$orCount = count($ts->get_or_number());	

													foreach( $ts->get_or_number() as $or ) {
														if( $orCount > 1 ) {
															echo $or.'/ ';
														}else {
															echo $or;
														}
													}

												}
											?>
										</td>

										<td class='white'>
											<?

												//LAST NAME
												$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
												$lastName = $ro->selectNow('patientRecord','lastName','patientNo',$patientNo);
												echo $lastName;
											?>
										</td>

										<td class='white'>
											<?
												//FIRST NAME
												$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
												$firstName = $ro->selectNow('patientRecord','firstName','patientNo',$patientNo);
												echo $firstName;
											?>
										</td>

										<td style='background-color: yellow; padding: 0.3%'><!--CASH & CARD--></td>

										<td>
											<?
												// HMO/COMPANY
												echo $ro->selectNow('registrationDetails','Company','registrationNo',$registrationNo)
											?>
										</td>

										<td style="background-color: lightblue; padding:0.2%; "><!--CASH PAID--></td>

										<td style="background-color: lightblue; padding:0.2%; "><!--CREDIT CARD--></td>

										<td style="background-color: lightblue; padding:0.2%; ">
											<?
												//HMO
												echo $ro4->number_format($hmo_no_shift);
												$hmo_per_day += $hmo_no_shift;
												$hmoTotal += $hmo_no_shift;

											?>
										</td>

										<td style="background-color: lightblue; padding:0.2%; ">
											<?
												//COMPANY
												echo $ro4->number_format($company_no_shift);
												$company_per_day += $company_no_shift;
												$companyTotal += $company_no_shift;

											?>
										</td>

										<td style="background-color: lightblue; padding:0.2%; ">
											<?
												//PHILHEALTH
												echo $ro4->number_format($philhealth_no_shift);
												$philhealth_per_day += $philhealth_no_shift;
												$philhealthTotal += $philhealth_no_shift;

											?>
										</td>

										<td style="background-color: lightblue; padding:0.2%; ">
											<?
												// A/R PERSONAL
												echo $ro4->number_format($unpaid_no_shift);
												$unpaid_per_day += $unpaid_no_shift;
												$unpaidTotal += $unpaid_no_shift;

											?>
										</td>

										<td style='background-color: yellow; padding: 0.3%'>
											<?
												//DISCOUNT
												echo $ro4->number_format($discount_no_shift);
												$discount_per_day += $discount_no_shift;
												$discountTotal += $discount_no_shift;

											?>
										</td>

										<td>
											<?
												//LABORATORY
												echo $ro4->number_format($laboratory_no_shift);
												$laboratory_per_day += $laboratory_no_shift;
												$laboratoryTotal += $laboratory_no_shift;
											?>
										</td>	

										<td>
											<?
												//XRAY
												echo $ro4->number_format($xray_no_shift);
												$xray_per_day += $xray_no_shift;
												$xrayTotal += $xray_no_shift;

											?>
										</td>

										<td>
											<?
												//ULTRASOUND
												echo $ro4->number_format($utz_no_shift);
												$utz_per_day += $utz_no_shift;
												$utzTotal += $utz_no_shift;

											?>
										</td>

										<td>
											<?
												//ECG
												echo $ro4->number_format($ecg_no_shift);
												$ecg_per_day += $ecg_no_shift;
												$ecgTotal += $ecg_no_shift;

											?>
										</td>

										<td>
											<?
												//CTSCAN
												echo $ro4->number_format($ctscan_no_shift);
												$ctscan_per_day += $ctscan_no_shift;
												$ctscanTotal += $ctscan_no_shift;

											?>
										</td>

										<td>
											<?
												//SPIROMETRY
												echo $ro4->number_format($spirometry_no_shift);
												$spirometry_per_day += $spirometry_no_shift;
												$spirometryTotal += $spirometry_no_shift;

											?>
										</td>

										<td>
											<?
												//CARDIAC
												echo $ro4->number_format($cardiac_no_shift);
												$cardiac_per_day += $cardiac_no_shift;
												$cardiacTotal += $cardiac_no_shift;

											?>
										</td>

										<td>
											<?
												//MEDICINE
												echo $ro4->number_format($medicine_no_shift);
												$medicine_per_day += $medicine_no_shift;
												$medicineTotal += $medicine_no_shift;

											?>
										</td>

										<td>
											<?
												//SUPPLIES
												echo $ro4->number_format($supplies_no_shift);
												$supplies_per_day += $supplies_no_shift;
												$suppliesTotal += $supplies_no_shift;

											?>
										</td>

										<td>
											<?
												//ERFEE
												echo $ro4->number_format($erfee_no_shift);
												$erfee_per_day += $erfee_no_shift;
												$erfeeTotal += $erfee_no_shift;

											?>
										</td>

										<td>
											<?
												//MISCELLANEOUS
												echo $ro4->number_format($misc_no_shift);
												$misc_per_day += $misc_no_shift;
												$miscTotal += $misc_no_shift;

											?>
										</td>

										<td>
											<?
												//OT
												echo $ro4->number_format($ot_no_shift);
												$ot_per_day += $ot_no_shift;
												$otTotal += $ot_no_shift;

											?>
										</td>

										<td>
											<?
												//ST
												echo $ro4->number_format($st_no_shift);
												$st_per_day += $st_no_shift;
												$stTotal += $st_no_shift;

											?>
										</td>

										<td class='sped'>
											<?	
												//SPED
												echo $ro4->number_format($sped_no_shift);
												$sped_per_day += $sped_no_shift;
												$spedTotal += $sped_no_shift;

											?>
										</td>

										<td style="background-color:orange; padding:0.2%; ">
											<?
												//PT
												echo $ro4->number_format($pt_no_shift);
												$pt_per_day += $pt_no_shift;
												$ptTotal += $pt_no_shift;

											?>
										</td>

										<td style="background-color: lightblue; padding:0.2%; ">
											<?
												//DERMA
												echo $ro4->number_format($derma_no_shift);
												$derma_per_day += $derma_no_shift;
												$dermaTotal += $derma_no_shift;

											?>
										</td>

										<td>
											<?
												//OTHERS
												echo $ro4->number_format($others_no_shift);
												$others_per_day += $others_no_shift;
												$othersTotal += $others_no_shift;

											?>
										</td>

										<td>
											<?
												// O.R
												echo $ro4->number_format($or_no_shift);
												$or_per_day += $or_no_shift;
												$orTotal += $or_no_shift;

											?>
										</td>

										<td>
											<?
												// A/R OPD PAID
												echo $ro4->number_format($balance_no_shift);
												$balance_per_day += $balance_no_shift;
												$balanceTotal += $balance_no_shift;

											?>
										</td>

										<td>
											<?
												echo $ro4->number_format($pf_no_shift);
												$pf_per_day += $pf_no_shift;
												$pfTotal += $pf_no_shift;

											?>
										</td>

										<td>
											<?
												// PF A/P(MD SHARE)
												echo $ro4->number_format($payable_no_shift);
												$payable_per_day += $payable_no_shift;
												$payableTotal += $payable_no_shift;

											?>
										</td>

									</tr>
									<? } ?>
								<? } ?>

							<? } ?>


							<tr>
								<th class="grandTotal">Total</th>
								<th><!--OR#--></th>
								<th><!--LASTNAME--></th>
								<th><!--FIRSTNAME--></th>
								
								<th class="grandTotal" style='background-color: yellow; padding: 0.3%'>
									<? echo $ro4->number_format($cashPaid_per_day + $creditCard_per_day) ?>
								</th>

								<th><!--HMO--></th>
								<th class="grandTotal lightBlue"><? echo $ro4->number_format($cashPaid_per_day) ?></th>
								<th class="grandTotal lightBlue"><? echo $ro4->number_format($creditCard_per_day) ?></th>
								<th class="grandTotal lightBlue"><? echo $ro4->number_format($hmo_per_day) ?></th>
								<th class="grandTotal lightBlue"><? echo $ro4->number_format($company_per_day) ?></th>
								<th class="grandTotal lightBlue"><? echo $ro4->number_format($philhealth_per_day) ?></th>
								<th class="grandTotal lightBlue"><? echo $ro4->number_format($unpaid_per_day) ?></th>
								
								<th class="grandTotal" style='background-color: yellow; padding: 0.3%'>
									<? echo $ro4->number_format($discount_per_day) ?>
								</th>
								
								<th class="grandTotal"><? echo $ro4->number_format($laboratory_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($xray_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($utz_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($ecg_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($ctscan_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($spirometry_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($cardiac_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($medicine_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($supplies_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($erfee_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($misc_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($ot_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($st_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($sped_per_day) ?></th>
								<th class="grandTotal orange"><? echo $ro4->number_format($pt_per_day) ?></th>
								<th class="grandTotal lightBlue"><? echo $ro4->number_format($derma_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($others_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($or_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($balance_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($pf_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($payable_per_day) ?></th>
							</tr>	


							<? 
								//to reset/remove the last value of the variable from the loop
								$cashPaid_per_day = 0;
								$creditCard_per_day = 0;
								$hmo_per_day = 0;
								$company_per_day = 0;
								$philhealth_per_day = 0;
								$unpaid_per_day = 0;
								$discount_per_day = 0;
								$laboratory_per_day = 0; 
								$xray_per_day = 0;
								$utz_per_day = 0;
								$ecg_per_day = 0;
								$ctscan_per_day = 0;
								$spirometry_per_day = 0;
								$cardiac_per_day = 0;
								$medicine_per_day = 0;
								$supplies_per_day = 0;
								$erfee_per_day = 0;
								$misc_per_day = 0;
								$ot_per_day = 0;
								$st_per_day = 0;
								$sped_per_day = 0;
								$pt_per_day = 0;
								$derma_per_day = 0;
								$others_per_day = 0;
								$or_per_day = 0;
								$balance_per_day = 0;
								$pf_per_day = 0;
								$payable_per_day = 0;

							?>																
						<? } ?>
					</tbody>
					<tfoot>
						<tr>
							<td>GRAND TOTAL</td>
							<td><!--OR#--></td>
							<td><!--LASTNAME--></td>
							<td><!--FIRSTNAME--></td>

							<td style='background-color: yellow; padding: 0.3%'>
								<? echo $ro4->number_format($cashPaidTotal + $creditCardTotal) ?>
							</td>

							<td><!--HMO--></td>
							<td style="background-color: lightblue; padding:0.2%; "><? echo $ro4->number_format($cashPaidTotal) ?></td>
							<td style="background-color: lightblue; padding:0.2%; "><? echo $ro4->number_format($creditCardTotal) ?></td>
							<td style="background-color: lightblue; padding:0.2%; "><? echo $ro4->number_format($hmoTotal) ?></td>
							<td style="background-color: lightblue; padding:0.2%; "><? echo $ro4->number_format($companyTotal) ?></td>
							<td style="background-color: lightblue; padding:0.2%; "><? echo $ro4->number_format($philhealthTotal) ?></td>
							<td style="background-color: lightblue; padding:0.2%; "><? echo $ro4->number_format($unpaidTotal) ?></td>
							<td style='background-color: yellow; padding: 0.3%'>
								<? echo $ro4->number_format($discountTotal) ?>
							</td>
							<td><? echo $ro4->number_format($laboratoryTotal) ?></td>
							<td>&nbsp;<? echo $ro4->number_format($xrayTotal) ?></td>
							<td>&nbsp;<? echo $ro4->number_format($utzTotal) ?></td>
							<td>&nbsp;<? echo $ro4->number_format($ecgTotal) ?></td>
							<td>&nbsp;<? echo $ro4->number_format($ctscanTotal) ?></td>
							<td>&nbsp;<? echo $ro4->number_format($spirometryTotal) ?></td>
							<td>&nbsp;<? echo $ro4->number_format($cardiacTotal) ?></td>
							<td>&nbsp;<? echo $ro4->number_format($medicineTotal) ?></td>
							<td>&nbsp;<? echo $ro4->number_format($suppliesTotal) ?></td>
							<td>&nbsp;<? echo $ro4->number_format($erfeeTotal) ?></td>
							<td>&nbsp;<? echo $ro4->number_format($miscTotal) ?></td>
							<td>&nbsp;<? echo $ro4->number_format($otTotal) ?></td>
							<td>&nbsp;<? echo $ro4->number_format($stTotal) ?></td>
							<td class='sped'>&nbsp;<? echo $ro4->number_format($spedTotal) ?></td>
							<td style="background-color:orange; padding:0.2%; ">&nbsp;<? echo $ro4->number_format($ptTotal) ?></td>
							<td style="background-color: lightblue; padding:0.2%; ">&nbsp;<? echo $ro4->number_format($dermaTotal) ?></td>
							<td>&nbsp;<? echo $ro4->number_format($othersTotal) ?></td>
							<td>&nbsp;<? echo $ro4->number_format($orTotal) ?></td>
							<td>&nbsp;<? echo $ro4->number_format($balanceTotal) ?></td>
							<td>&nbsp;<? echo $ro4->number_format($pfTotal) ?></td>
							<td>&nbsp;<? echo $ro4->number_format($payableTotal) ?></td>
						</tr>						
					</tfoot>
				</table>
					
				<!--table for transaction summary-->
				<br><br><br>	
				<table id='summary' style="width:20%;">

					<tr>
						<td>CREDIT CARD</td>
						<td><? echo $ro4->number_format($creditCardTotal) ?></td>
						<td></td>
					</tr>

					<tr>
						<td>CASH</td>
						<td><? echo $ro4->number_format($cashPaidTotal) ?></td>
						<td></td>
					</tr>

					<tr>
						<td>HMO</td>
						<td><? echo $ro4->number_format($hmoTotal) ?></td>
						<td></td>
					</tr>

					<tr>
						<td>Company</td>
						<td><? echo $ro4->number_format($companyTotal) ?></td>
						<td></td>
					</tr>

					<tr>
						<td>Philhealth</td>
						<td><? echo $ro4->number_format($philhealthTotal) ?></td>
						<td></td>
					</tr>

					<tr>
						<td>A/R Personal</td>
						<td><? echo $ro4->number_format($unpaidTotal) ?></td>
						<td></td>
					</tr>

					<tr>
						<td>Discount</td>
						<td><? echo $ro4->number_format($discountTotal) ?></td>
						<td></td>
					</tr>

					<tr>
						<td>A/R OPD PAID</td>
						<td></td>
						<td><? echo $ro4->number_format($balanceTotal) ?></td>
					</tr>

					<tr>
						<td>CLINIC REVENUE</td>
						<td></td>
						<td><? echo $ro4->number_format($pfTotal) ?></td>
					</tr>

					<tr>
						<td>LABORATORY</td>
						<td></td>
						<td><? echo $ro4->number_format($laboratoryTotal) ?></td>
					</tr>

					<tr>
						<td>XRAY</td>
						<td></td>
						<td><? echo $ro4->number_format($xrayTotal) ?></td>
					</tr>

					<tr>
						<td>ULTRASOUND</td>
						<td></td>
						<td><? echo $ro4->number_format($utzTotal) ?></td>
					</tr>

					<tr>
						<td>ECG</td>
						<td></td>
						<td><? echo $ro4->number_format($ecgTotal) ?></td>
					</tr>

					<tr>
						<td>CTSCAN</td>
						<td></td>
						<td><? echo $ro4->number_format($ctscanTotal) ?></td>
					</tr>

					<tr>
						<td>SPIROMETRY</td>
						<td></td>
						<td><? echo $ro4->number_format($spirometryTotal) ?></td>
					</tr>

					<tr>
						<td>CARDIAC</td>
						<td></td>
						<td><? echo $ro4->number_format($cardiacTotal) ?></td>
					</tr>

					<tr>
						<td>MEDICINE</td>
						<td></td>
						<td><? echo $ro4->number_format($medicineTotal) ?></td>
					</tr>

					<tr>
						<td>SUPPLIES</td>
						<td></td>
						<td><? echo $ro4->number_format($suppliesTotal) ?></td>
					</tr>

					<tr>
						<td>ER FEE</td>
						<td></td>
						<td><? echo $ro4->number_format($erfeeTotal) ?></td>
					</tr>

					<tr>
						<td>MISCELLANEOUS</td>
						<td></td>
						<td><? echo $ro4->number_format($miscTotal) ?></td>
					</tr>

					<tr>
						<td>OT</td>
						<td></td>
						<td><? echo $ro4->number_format($otTotal) ?></td>
					</tr>

					<tr>
						<td>PT</td>
						<td></td>
						<td><? echo $ro4->number_format($ptTotal) ?></td>
					</tr>

					<tr>
						<td>ST</td>
						<td></td>
						<td><? echo $ro4->number_format($stTotal) ?></td>
					</tr>

					<tr>
						<td>SPED</td>
						<td></td>
						<td><? echo $ro4->number_format($spedTotal) ?></td>
					</tr>

					<tr>
						<td>DERMA</td>
						<td></td>
						<td><? echo $ro4->number_format($dermaTotal) ?></td>
					</tr>

					<tr>
						<td>OTHERS</td>
						<td></td>
						<td><? echo $ro4->number_format($othersTotal) ?></td>
					</tr>

					<tr>
						<td>O.R</td>
						<td></td>
						<td><? echo $ro4->number_format($orTotal) ?></td>
					</tr>

					<tr>
						<td>Payable-MD</td>
						<td></td>
						<td><? echo $ro4->number_format($payableTotal) ?></td>
					</tr>

					<tr>
						<td class='grandTotal'>Total</td>
						<td class='grandTotal'>
							<?
								echo $ro4->number_format(
										$creditCardTotal +
										$cashPaidTotal +
										$hmoTotal +
										$companyTotal +
										$philhealthTotal +
										$unpaidTotal +
										$discountTotal
									);
							?>

						</td>
						<td class='grandTotal'>
							<?
								echo $ro4->number_format(
										$balanceTotal +
										$pfTotal +
										$laboratoryTotal +
										$xrayTotal +
										$utzTotal +
										$ecgTotal +
										$ctscanTotal +
										$spirometryTotal +
										$cardiacTotal +
										$medicineTotal +
										$suppliesTotal +
										$erfeeTotal +
										$miscTotal +
										$otTotal +
										$ptTotal +
										$stTotal +
										$spedTotal +
										$dermaTotal +
										$othersTotal +
										$orTotal +
										$payableTotal
									);
							?>
						</td>
					</tr>

				</table>

				<br><br><br>
			</div>
		</div>
	</body>
</html>


