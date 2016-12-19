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

	$pt_per_day = 0;
	$ptTotal = 0;

	$st_per_day = 0;
	$stTotal = 0;

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
	  <link rel='stylesheet' href='../../../../bower_components/bootstrap/dist/css/bootstrap.min.css'>

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
	  		width: 200%;
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
	  		padding:0.3%;
	  	}

	  </style>
	</head>
	<body>
		<div class='box'>
			<div class=''>
				<h2></h2>
				<table rules=all>
					<thead>
						<tr>
							<th>&nbsp;</th>
							<th class='white'>OR#</th>
							<th class='white'>Last Name</th>
							<th class='white'>First Name</th>
							<th class='yellow'>Cash & Card</th>
							<th>HMO</th>
							<th class='lightBlue'>Cash</th>
							<th class='lightBlue'>Credit Card</th>
							<th class='lightBlue'>A/R HMO</th>
							<th class='lightBlue'>A/R Company</th>
							<th class='lightBlue'>A/R PERSONAL</th>
							<th class='yellow'>Discount</th>
							<th>Laboratory</th>
							<th>&nbsp;XRAY</th>
							<th>&nbsp;ULTRASOUND</th>
							<th>&nbsp;ECG</th>
							<th>&nbsp;CTSCAN</th>
							<th>&nbsp;SPIRO</th>
							<th>&nbsp;Medicine</th>
							<th>&nbsp;Supplies</th>
							<th>&nbsp;ER FEE</th>
							<th>&nbsp;MISC</th>
							<th>&nbsp;OT</th>
							<th class='orange'>&nbsp;PT</th>
							<th>&nbsp;ST</th>
							<th class='lightBlue'>&nbsp;DERMA</th>
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
								<td class='date'><h4><? echo $monthWord[$month] ?> <? echo $dayLoop ?>, <? echo $year ?></h4></td>
								<td class='date'><!--OR#--></td>
								<td class='date'><!--LASTNAME--></td>
								<td class='date'><!--FIRSTNAME--></td>
								<td class='date'><!--CASH & CARD--></td>
								<td class='date'><!--HMO--></td>
								<td class='date'><!--CASH--></td>
								<td class='date'><!--CREDIT CARD--></td>
								<td class='date'><!--HMO--></td>
								<td class='date'><!--Company--></td>
								<td class='date'><!--PERSNAL A/R--></td>
								<td class='date'><!--DISCOUNT--></td>
								<td class='date'><!--LABORATORY--></td>
								<td class='date'><!--XRAY--></td>	
								<td class='date'><!--UTZ--></td>
								<td class='date'><!--ECG--></td>
								<td class='date'><!--CTSCAN--></td>
								<td class='date'><!--SPIRO--></td>
								<td class='date'><!--MEDICINE--></td>
								<td class='date'><!--SUPPLIES--></td>
								<td class='date'><!--ER FEE--></td>
								<td class='date'><!--MISC--></td>
								<td class='date'><!--OT--></td>
								<td class='date'><!--PT--></td>
								<td class='date'><!--ST--></td>
								<td class='date'><!--DERMA--></td>
								<td class='date'><!--OTHERS--></td>
								<td class='date'><!--O.R--></td>	
								<td class='date'><!--A/R OPD PAID--></td>
								<td class='date'><!--CLINIC REVENUE--></td>
								<td class='date'><!--PF A/P (MD SHARE)--></td>					
							</tr>

							<!--MORNNING-->
							<tr>
								<th style='padding-left:1%'>Morning</th>
								<th><!--OR#--></th>
								<th><!--LASTNAME--></th>
								<th><!--FIRSTNAME--></th>
								<th class='yellow'><!--CASH & CARD--></th>
								<th><!--HMO--></th>
								<th class='lightBlue'><!--CASH--></th>
								<th class='lightBlue'><!--CREDIT CARD--></th>
								<th class='lightBlue'><!--HMO--></th>
								<th class='lightBlue'><!--Company--></th>
								<th class='lightBlue'><!--PERSONAL A/R--></th>
								<th class='yellow'><!--DISCOUNT--></th>
								<th><!--LABORATORY--></th>
								<th><!--XRAY--></th>
								<th><!--UTZ--></th>
								<th><!--ECG--></th>
								<th><!--CTSCAN--></th>
								<th><!--SPIRO--></th>
								<th><!--MEDICINE--></th>
								<th><!--SUPPLIES--></th>
								<th><!--ER FEE--></th>
								<th><!--MISC--></th>
								<th><!--OT--></th>
								<th class='orange'><!--PT--></th>
								<th><!--ST--></th>
								<th class='lightBlue'><!--DERMA--></th>
								<th><!--OTHERS--></th>
								<th><!--O.R--></th>
								<th><!--A/R OPD PAID--></th>
								<th><!--CLINIC REVENUE--></th>
								<th><!--PF A/P (MD SHARE)--></th>
							</tr>

							<? foreach( $ts->get_outpatients_registrationNo() as $registrationNo ) { ?>

								<? if( $ts->get_outpatients_shift($registrationNo,$month,$dayLoop,$year) == "Morning" ) { ?>
								<tr>

									<td><!----></td>

									<td class='white'>
										<?
											echo $ts->get_OR_number($registrationNo,$morning,$month,$dayLoop,$year);
										?>
									</td>

									<td class='white'>
										<?
											$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
											$lastName = $ro->selectNow('patientRecord','lastName','patientNo',$patientNo);
											echo $lastName;
										?>
									</td>

									<td class='white'>
										<?
											$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
											$firstName = $ro->selectNow('patientRecord','firstName','patientNo',$patientNo);
											echo $firstName;
										?>
									</td>

									<td class='yellow'>
										<?
											$cashPaidMorning = $ts->get_outpatients_cash_payment($registrationNo,$morning);
											$creditCardMorning = $ts->get_outpatients_creditCard_payment($registrationNo,$morning);
											echo $ro4->number_format($cashPaidMorning + $creditCardMorning);
										?>
									</td>

									<td>
										<?
											echo $ro->selectNow('registrationDetails','Company','registrationNo',$registrationNo)
										?>
									</td>

									<td class='lightBlue'>
										<?
											$cashPaidMorning = $ts->get_outpatients_cash_payment($registrationNo,$morning);
											echo $ro4->number_format($cashPaidMorning);
											$cashPaid_per_day += $cashPaidMorning;
											$cashPaidTotal += $cashPaidMorning;

										?>
									</td>

									<td class='lightBlue'>
										<?
											$creditCardMorning = $ts->get_outpatients_creditCard_payment($registrationNo,$morning);
											echo $ro4->number_format($creditCardMorning);
											$creditCard_per_day += $creditCardMorning;
											$creditCardTotal += $creditCardMorning;

										?>
									</td>

									<td class='lightBlue'>
										<?
											$hmoMorning = $ts->get_outpatients_hmo_covered($registrationNo,$morning);
											echo $ro4->number_format($hmoMorning);
											$hmo_per_day += $hmoMorning;
											$hmoTotal += $hmoMorning;

										?>
									</td>

									<td class='lightBlue'>
										<?
											$companyMorning = $ts->get_outpatients_company_covered($registrationNo,$morning);
											echo $ro4->number_format($companyMorning);
											$company_per_day += $companyMorning;
											$companyTotal += $companyMorning;

										?>
									</td>

									<td class='lightBlue'>
										<?
											$unpaidMorning = $ts->get_outpatients_unpaid_total($registrationNo,$morning);
											echo $ro4->number_format($unpaidMorning);
											$unpaid_per_day += $unpaidMorning;
											$unpaidTotal += $unpaidMorning;

										?>
									</td>

									<td class='yellow'>
										<?
											$discountMorning = $ts->get_outpatients_discount_total($registrationNo,$morning);
											echo $ro4->number_format($discountMorning);
											$discount_per_day += $discountMorning;
											$discountTotal += $discountMorning;

										?>
									</td>

									<td>
										<?
											$laboratoryMorning = $ts->get_outpatients_title_total($registrationNo,"LABORATORY",$morning);
											echo $ro4->number_format($laboratoryMorning);
											$laboratory_per_day += $laboratoryMorning;
											$laboratoryTotal += $laboratoryMorning;

										?>
									</td>
								
									<td>
										<?
											$xrayMorning = $ts->get_outpatients_title_total($registrationNo,"XRAY",$morning);
											echo $ro4->number_format($xrayMorning);
											$xray_per_day += $xrayMorning;
											$xrayTotal += $xrayMorning;

										?>
									</td>

									<td>
										<?
											$utzMorning = $ts->get_outpatients_title_total($registrationNo,"ULTRASOUND",$morning);
											echo $ro4->number_format($utzMorning);
											$utz_per_day += $utzMorning;
											$utzTotal += $utzMorning;

										?>
									</td>

									<td>
										<?
											$ecgMorning = $ts->get_outpatients_title_total($registrationNo,"ECG",$morning);
											echo $ro4->number_format($ecgMorning);
											$ecg_per_day += $ecgMorning;
											$ecgTotal += $ecgMorning;

										?>
									</td>

									<td>
										<?
											$ctscanMorning = $ts->get_outpatients_title_total($registrationNo,"CTSCAN",$morning);
											echo $ro4->number_format($ctscanMorning);
											$ctscan_per_day += $ctscanMorning;
											$ctscanTotal += $ctscanMorning;

										?>
									</td>

									<td>
										<?
											$spirometryMorning = $ts->get_outpatients_title_total($registrationNo,"SPIROMETRY",$morning);
											echo $ro4->number_format($spirometryMorning);
											$spirometry_per_day += $spirometryMorning;
											$spirometryTotal += $spirometryMorning;

										?>
									</td>

									<td>
										<?
											$medicineMorning = $ts->get_outpatients_title_total($registrationNo,"MEDICINE",$morning);
											echo $ro4->number_format($medicineMorning);
											$medicine_per_day += $medicineMorning;
											$medicineTotal += $medicineMorning;

										?>
									</td>

									<td>
										<?
											$suppliesMorning = $ts->get_outpatients_title_total($registrationNo,"SUPPLIES",$morning);
											echo $ro4->number_format($suppliesMorning);
											$supplies_per_day += $suppliesMorning;
											$suppliesTotal += $suppliesMorning;

										?>
									</td>

									<td>
										<?
											$erfeeMorning = $ts->get_outpatients_title_total($registrationNo,"ER FEE",$morning);
											echo $ro4->number_format($erfeeMorning);
											$erfee_per_day += $erfeeMorning;
											$erfeeTotal += $erfeeMorning;

										?>
									</td>

									<td>
										<?
											$miscMorning = $ts->get_outpatients_title_total($registrationNo,"MISCELLANEOUS",$morning);
											echo $ro4->number_format($miscMorning);
											$misc_per_day += $miscMorning;
											$miscTotal += $miscMorning;

										?>
									</td>

									<td>
										<?
											$otMorning = $ts->get_outpatients_therapy_total($registrationNo,"OT",$morning);
											echo $ro4->number_format($otMorning);
											$ot_per_day += $otMorning;
											$otTotal += $otMorning;

										?>
									</td>

									<td class='orange'>
										<?
											$ptMorning = $ts->get_outpatients_title_total($registrationNo,"PT",$morning);
											echo $ro4->number_format($ptMorning);
											$pt_per_day += $ptMorning;
											$ptTotal += $ptMorning;

										?>
									</td>

									<td>
										<?
											$stMorning = $ts->get_outpatients_therapy_total($registrationNo,"ST",$morning);
											echo $ro4->number_format($stMorning);
											$st_per_day += $stMorning;
											$stTotal += $stMorning;

										?>
									</td>

									<td class='lightBlue'>
										<?
											$dermaMorning = $ts->get_outpatients_title_total($registrationNo,"DERMA",$morning);
											echo $ro4->number_format($dermaMorning);
											$derma_per_day += $dermaMorning;
											$dermaTotal += $dermaMorning;

										?>
									</td>

									<td>
										<?
											$othersMorning = $ts->get_outpatients_title_total($registrationNo,"OTHERS",$morning);
											echo $ro4->number_format($othersMorning);
											$others_per_day += $othersMorning;
											$othersTotal += $othersMorning;

										?>
									</td>

									<td>
										<?
											$orMorning = $ts->get_outpatients_title_total($registrationNo,"OR/DR/ER Fee",$morning);
											echo $ro4->number_format($orMorning);
											$or_per_day += $orMorning;
											$orTotal += $orMorning;

										?>
									</td>

									<td>
										<?
											$balanceMorning = $ts->get_outpatients_title_total($registrationNo,"BALANCE",$morning);
											echo $ro4->number_format($balanceMorning);
											$balance_per_day += $balanceMorning;
											$balanceTotal += $balanceMorning;

										?>
									</td>

									<td>
										<?
											$pfMorning = ( 
													$ts->get_outpatients_PF_total($registrationNo,"PROFESSIONAL FEE",$morning) -
													$ts->get_outpatients_PF_payables_total($registrationNo,"PROFESSIONAL FEE",$morning)

												);
											echo $ro4->number_format($pfMorning);
											$pf_per_day += $pfMorning;
											$pfTotal += $pfMorning;

										?>
									</td>

									<td>
										<?
											$payableMorning = (
													$ts->get_outpatients_PF_payables_total($registrationNo,"PROFESSIONAL FEE",$morning) +
													$ts->get_outpatients_therapy_payables_total($registrationNo,$morning) 
												);
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
								<th class='yellow'><!--CASH & CARD--></th>
								<th><!--HMO--></th>
								<th class='lightBlue'><!--CASH--></th>
								<th class='lightBlue'><!--CREDIT CARD--></th>
								<th class='lightBlue'><!--HMO--></th>
								<th class='lightBlue'><!--Company--></th>
								<th class='lightBlue'><!--PERSONAL A/R--></th>
								<th class='yellow'><!--DISCOUNT--></th>
								<th><!--LABORATORY--></th>
								<th><!--XRAY--></th>
								<th><!--UTZ--></th>
								<th><!--ECG--></th>
								<th><!--CTSCAN--></th>
								<th><!--SPIRO--></th>
								<th><!--MEDICINE--></th>
								<th><!--SUPPLIES--></th>
								<th><!--ER FEE--></th>
								<th><!--MISC--></th>
								<th><!--OT--></th>
								<th class='orange'><!--PT--></th>
								<th><!--ST--></th>
								<th class='lightBlue'><!--DERMA--></th>
								<th><!--OTHERS--></th>
								<th><!--O.R--></th>
								<th><!--A/R OPD PAID--></th>
								<th><!--CLINIC REVENUE--></th>								
							</tr>						
							<? foreach( $ts->get_outpatients_registrationNo() as $registrationNo ) { ?>

								<? if( $ts->get_outpatients_shift($registrationNo,$month,$dayLoop,$year) == "Noon" ) { ?>
								<tr>
									
									<td><!----></td>

									<td class='white'>
										<?
											echo $ts->get_OR_number($registrationNo,$noon,$month,$dayLoop,$year);
										?>
									</td>									

									<td class='white'>
										<?
											$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
											$lastName = $ro->selectNow('patientRecord','lastName','patientNo',$patientNo);
											echo $lastName;
										?>
									</td>

									<td class='white'>
										<?
											$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
											$firstName = $ro->selectNow('patientRecord','firstName','patientNo',$patientNo);
											echo $firstName;
										?>
									</td>

									<td class='yellow'>
										<?
											$cashPaidNoon = $ts->get_outpatients_cash_payment($registrationNo,$noon);
											$creditCardNoon = $ts->get_outpatients_creditCard_payment($registrationNo,$noon);
											echo $ro4->number_format($cashPaidNoon + $creditCardNoon);
										?>
									</td>

									<td>
										<?
											echo $ro->selectNow('registrationDetails','Company','registrationNo',$registrationNo)
										?>
									</td>

									<td class='lightBlue'>
										<?
											$cashPaidNoon = $ts->get_outpatients_cash_payment($registrationNo,$noon);
											echo $ro4->number_format($cashPaidNoon);
											$cashPaid_per_day += $cashPaidNoon;
											$cashPaidTotal += $cashPaidNoon;

										?>
									</td>

									<td class='lightBlue'>
										<?
											$creditCardNoon = $ts->get_outpatients_creditCard_payment($registrationNo,$noon);
											echo $ro4->number_format($creditCardNoon);
											$creditCard_per_day += $creditCardNoon;
											$creditCardTotal += $creditCardNoon;

										?>
									</td>

									<td class='lightBlue'>
										<?
											$hmoNoon = $ts->get_outpatients_hmo_covered($registrationNo,$noon);
											echo $ro4->number_format($hmoNoon);
											$hmo_per_day += $hmoNoon;
											$hmoTotal += $hmoNoon;

										?>
									</td>

									<td class='lightBlue'>
										<?
											$companyNoon = $ts->get_outpatients_company_covered($registrationNo,$noon);
											echo $ro4->number_format($companyNoon);
											$company_per_day += $companyNoon;
											$companyTotal += $companyNoon;

										?>
									</td>

									<td class='lightBlue'>
										<?
											$unpaidNoon = $ts->get_outpatients_unpaid_total($registrationNo,$noon);
											echo $ro4->number_format($unpaidNoon);
											$unpaid_per_day += $unpaidNoon;
											$unpaidTotal += $unpaidNoon;

										?>
									</td>

									<td class='yellow'>
										<?
											$discountNoon = $ts->get_outpatients_discount_total($registrationNo,$noon);
											echo $ro4->number_format($discountNoon);
											$discount_per_day += $discountNoon;
											$discountTotal += $discountNoon;

										?>
									</td>

									<td>
										<?
											$laboratoryNoon = $ts->get_outpatients_title_total($registrationNo,"LABORATORY",$noon);
											echo $ro4->number_format($laboratoryNoon);
											$laboratory_per_day += $laboratoryNoon;
											$laboratoryTotal += $laboratoryNoon;
										?>
									</td>

									<td>
										<?
											$xrayNoon = $ts->get_outpatients_title_total($registrationNo,"XRAY",$noon);
											echo $ro4->number_format($xrayNoon);
											$xray_per_day += $xrayNoon;
											$xrayTotal += $xrayNoon;

										?>
									</td>

									<td>
										<?
											$utzNoon = $ts->get_outpatients_title_total($registrationNo,"ULTRASOUND",$noon);
											echo $ro4->number_format($utzNoon);
											$utz_per_day += $utzNoon;
											$utzTotal += $utzNoon;

										?>
									</td>									

									<td>
										<?
											$ecgNoon = $ts->get_outpatients_title_total($registrationNo,"ECG",$noon);
											echo $ro4->number_format($ecgNoon);
											$ecg_per_day += $ecgNoon;
											$ecgTotal += $ecgNoon;

										?>
									</td>

									<td>
										<?
											$ctscanNoon = $ts->get_outpatients_title_total($registrationNo,"CTSCAN",$noon);
											echo $ro4->number_format($ctscanNoon);
											$ctscan_per_day += $ctscanNoon;
											$ctscanTotal += $ctscanNoon;

										?>
									</td>

									<td>
										<?
											$spirometryNoon = $ts->get_outpatients_title_total($registrationNo,"SPIROMETRY",$noon);
											echo $ro4->number_format($spirometryNoon);
											$spirometry_per_day += $spirometryNoon;
											$spirometryTotal += $spirometryNoon;

										?>
									</td>

									<td>
										<?
											$medicineNoon = $ts->get_outpatients_title_total($registrationNo,"MEDICINE",$noon);
											echo $ro4->number_format($medicineNoon);
											$medicine_per_day += $medicineNoon;
											$medicineTotal += $medicineNoon;

										?>
									</td>

									<td>
										<?
											$suppliesNoon = $ts->get_outpatients_title_total($registrationNo,"SUPPLIES",$noon);
											echo $ro4->number_format($suppliesNoon);
											$supplies_per_day += $suppliesNoon;
											$suppliesTotal += $suppliesNoon;

										?>
									</td>

									<td>
										<?
											$erfeeNoon = $ts->get_outpatients_title_total($registrationNo,"ER FEE",$noon);
											echo $ro4->number_format($erfeeNoon);
											$erfee_per_day += $erfeeNoon;
											$erfeeTotal += $erfeeNoon;

										?>
									</td>

									<td>
										<?
											$miscNoon = $ts->get_outpatients_title_total($registrationNo,"MISCELLANEOUS",$noon);
											echo $ro4->number_format($miscNoon);
											$misc_per_day += $miscNoon;
											$miscTotal += $miscNoon;

										?>
									</td>

									<td>
										<?
											$otNoon = $ts->get_outpatients_therapy_total($registrationNo,"OT",$noon);
											echo $ro4->number_format($otNoon);
											$ot_per_day += $otNoon;
											$otTotal += $otNoon;

										?>
									</td>

									<td class='orange'>
										<?
											$ptNoon = $ts->get_outpatients_title_total($registrationNo,"PT",$noon);
											echo $ro4->number_format($ptNoon);
											$pt_per_day += $ptNoon;
											$ptTotal += $ptNoon;

										?>
									</td>

									<td>
										<?
											$stNoon = $ts->get_outpatients_therapy_total($registrationNo,"ST",$noon);
											echo $ro4->number_format($stNoon);
											$st_per_day += $stNoon;
											$stTotal += $stNoon;

										?>
									</td>

									<td class='lightBlue'>
										<?
											$dermaNoon = $ts->get_outpatients_title_total($registrationNo,"DERMA",$noon);
											echo $ro4->number_format($dermaNoon);
											$derma_per_day += $dermaNoon;
											$dermaTotal += $dermaNoon;

										?>
									</td>

									<td>
										<?
											$othersNoon = $ts->get_outpatients_title_total($registrationNo,"OTHERS",$noon);
											echo $ro4->number_format($othersNoon);
											$others_per_day += $othersNoon;
											$othersTotal += $othersNoon;

										?>
									</td>

									<td>
										<?
											$orNoon = $ts->get_outpatients_title_total($registrationNo,"OR/DR/ER Fee",$noon);
											echo $ro4->number_format($orNoon);
											$or_per_day += $orNoon;
											$orTotal += $orNoon;

										?>
									</td>

									<td>
										<?
											$balanceNoon = $ts->get_outpatients_title_total($registrationNo,"BALANCE",$noon);
											echo $ro4->number_format($balanceNoon);
											$balance_per_day += $balanceNoon;
											$balanceTotal += $balanceNoon;

										?>
									</td>

									<td>
										<?
											$pfNoon = ( 
														$ts->get_outpatients_PF_total($registrationNo,"PROFESSIONAL FEE",$noon) -
														$ts->get_outpatients_PF_payables_total($registrationNo,"PROFESSIONAL FEE",$noon)
													);
											echo $ro4->number_format($pfNoon);
											$pf_per_day += $pfNoon;
											$pfTotal += $pfNoon;

										?>
									</td>

									<td>
										<?
											$payableNoon = (
													$ts->get_outpatients_PF_payables_total($registrationNo,"PROFESSIONAL FEE",$noon) +
													$ts->get_outpatients_therapy_payables_total($registrationNo,$noon)
												);
											echo $ro4->number_format($payableNoon);
											$payable_per_day += $payableNoon;
											$payableTotal += $payableNoon;

										?>
									</td>

									<td>
										<?
											$credit = (
													$laboratoryTotal +
													$xrayTotal +
													$utzTotal +
													$ecgTotal +
													$ctscanTotal +
													$spirometryTotal +
													$medicineTotal +
													$suppliesTotal +
													$erfeeTotal +
													$miscTotal +
													$otTotal +
													$ptTotal +
													$stTotal +
													$dermaTotal +
													$othersTotal +
													$orTotal +
													$balanceTotal +
													$pfTotal
												);
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
								<th class='yellow'><!--CASH & CARD--></th>
								<th><!--HMO--></th>
								<th class='lightBlue'><!--CASH--></th>
								<th class='lightBlue'><!--CREDIT CARD--></th>
								<th class='lightBlue'><!--HMO--></th>
								<th class='lightBlue'><!--Company--></th>
								<th class='lightBlue'><!--PERSONAL A/R--></th>
								<th class='yellow'><!--DISCOUNT--></th>
								<th><!--LABORATORY--></th>
								<th><!--XRAY--></th>
								<th><!--UTZ--></th>
								<th><!--ECG--></th>
								<th><!--CTSCAN--></th>
								<th><!--SPIRO--></th>
								<th><!--MEDICINE--></th>
								<th><!--SUPPLIES--></th>
								<th><!--ER FEE--></th>
								<th><!--MISC--></th>
								<th><!--OT--></th>
								<th class='orange'><!--PT--></th>
								<th><!--ST--></th>
								<th class='lightBlue'><!--DERMA--></th>
								<th><!--OTHERS--></th>
								<th><!--O.R--></th>
								<th><!--A/R OPD PAID--></th>
								<th><!--CLINIC REVENUE--></th>
							</tr>						
							<? foreach( $ts->get_outpatients_registrationNo() as $registrationNo ) { ?>

								<? if( $ts->get_outpatients_shift($registrationNo,$month,$dayLoop,$year) == "Afternoon" ) { ?>
								<tr>

									<td><!----></td>

									<td class='white'>
										<?
											echo $ts->get_OR_number($registrationNo,$afternoon,$month,$dayLoop,$year);
										?>
									</td>

									<td class='white'>
										<?
											$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
											$lastName = $ro->selectNow('patientRecord','lastName','patientNo',$patientNo);
											echo $lastName;
										?>
									</td>

									<td class='white'>
										<?
											$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
											$firstName = $ro->selectNow('patientRecord','firstName','patientNo',$patientNo);
											echo $firstName;
										?>
									</td>

									<td class='yellow'>
										<?
											$cashPaidAfternoon = $ts->get_outpatients_cash_payment($registrationNo,$afternoon);
											$creditCardAfternoon = $ts->get_outpatients_creditCard_payment($registrationNo,$afternoon);
											echo $ro4->number_format($cashPaidAfternoon + $creditCardAfternoon);
										?>
									</td>

									<td>
										<?
											echo $ro->selectNow('registrationDetails','Company','registrationNo',$registrationNo)
										?>
									</td>

									<td class='lightBlue'>
										<?
											$cashPaidAfternoon = $ts->get_outpatients_cash_payment($registrationNo,$afternoon);
											echo $ro4->number_format($cashPaidAfternoon);
											$cashPaid_per_day += $cashPaidAfternoon;
											$cashPaidTotal += $cashPaidAfternoon;

										?>
									</td>

									<td class='lightBlue'>
										<?
											$creditCardAfternoon = $ts->get_outpatients_creditCard_payment($registrationNo,$afternoon);
											echo $ro4->number_format($creditCardAfternoon);
											$creditCard_per_day += $creditCardAfternoon;
											$creditCardTotal += $creditCardAfternoon;

										?>
									</td>

									<td class='lightBlue'>
										<?
											$hmoAfternoon = $ts->get_outpatients_hmo_covered($registrationNo,$afternoon);
											echo $ro4->number_format($hmoAfternoon);
											$hmo_per_day += $hmoAfternoon;
											$hmoTotal += $hmoAfternoon;

										?>
									</td>

									<td class='lightBlue'>
										<?
											$companyAfternoon = $ts->get_outpatients_company_covered($registrationNo,$afternoon);
											echo $ro4->number_format($companyAfternoon);
											$company_per_day += $companyAfternoon;
											$companyTotal += $companyAfternoon;

										?>
									</td>

									<td class='lightBlue'>
										<?
											$unpaidAfternoon = $ts->get_outpatients_unpaid_total($registrationNo,$afternoon);
											echo $ro4->number_format($unpaidAfternoon);
											$unpaid_per_day += $unpaidAfternoon;
											$unpaidTotal += $unpaidAfternoon;

										?>
									</td>

									<td class='yellow'>
										<?
											$discountAfternoon = $ts->get_outpatients_discount_total($registrationNo,$afternoon);
											echo $ro4->number_format($discountAfternoon);
											$discount_per_day += $discountAfternoon;
											$discountTotal += $discountAfternoon;

										?>
									</td>

									<td>
										<?
											$laboratoryAfternoon = $ts->get_outpatients_title_total($registrationNo,"LABORATORY",$afternoon);
											echo $ro4->number_format($laboratoryAfternoon);
											$laboratory_per_day += $laboratoryAfternoon;
											$laboratoryTotal += $laboratoryAfternoon;
										?>
									</td>

									<td>
										<?
											$xrayAfternoon = $ts->get_outpatients_title_total($registrationNo,"XRAY",$afternoon);
											echo $ro4->number_format($xrayAfternoon);
											$xray_per_day += $xrayAfternoon;
											$xrayTotal += $xrayAfternoon;

										?>
									</td>

									<td>
										<?
											$utzAfternoon = $ts->get_outpatients_title_total($registrationNo,"ULTRASOUND",$afternoon);
											echo $ro4->number_format($utzAfternoon);
											$utz_per_day += $utzAfternoon;
											$utzTotal += $utzAfternoon;

										?>
									</td>									

									<td>
										<?
											$ecgAfternoon = $ts->get_outpatients_title_total($registrationNo,"ECG",$afternoon);
											echo $ro4->number_format($ecgAfternoon);
											$ecg_per_day += $ecgAfternoon;
											$ecgTotal += $ecgAfternoon;

										?>
									</td>

									<td>
										<?
											$ctscanAfternoon = $ts->get_outpatients_title_total($registrationNo,"CTSCAN",$afternoon);
											echo $ro4->number_format($ctscanAfternoon);
											$ctscan_per_day += $ctscanAfternoon;
											$ctscanTotal += $ctscanAfternoon;

										?>
									</td>

									<td>
										<?
											$spirometryAfternoon = $ts->get_outpatients_title_total($registrationNo,"SPIROMETRY",$afternoon);
											echo $ro4->number_format($spirometryAfternoon);
											$spirometry_per_day += $spirometryAfternoon;
											$spirometryTotal += $spirometryAfternoon;

										?>
									</td>

									<td>
										<?
											$medicineAfternoon = $ts->get_outpatients_title_total($registrationNo,"MEDICINE",$afternoon);
											echo $ro4->number_format($medicineAfternoon);
											$medicine_per_day += $medicineAfternoon;
											$medicineTotal += $medicineAfternoon;

										?>
									</td>

									<td>
										<?
											$suppliesAfternoon = $ts->get_outpatients_title_total($registrationNo,"SUPPLIES",$afternoon);
											echo $ro4->number_format($suppliesAfternoon);
											$supplies_per_day += $suppliesAfternoon;
											$suppliesTotal += $suppliesAfternoon;

										?>
									</td>

									<td>
										<?
											$erfeeAfternoon = $ts->get_outpatients_title_total($registrationNo,"ER FEE",$afternoon);
											echo $ro4->number_format($erfeeAfternoon);
											$erfee_per_day += $erfeeAfternoon;
											$erfeeTotal += $erfeeAfternoon;

										?>
									</td>

									<td>
										<?
											$miscAfternoon = $ts->get_outpatients_title_total($registrationNo,"MISCELLANEOUS",$afternoon);
											echo $ro4->number_format($miscAfternoon);
											$misc_per_day += $miscAfternoon;
											$miscTotal += $miscAfternoon;

										?>
									</td>

									<td>
										<?
											$otAfternoon = $ts->get_outpatients_therapy_total($registrationNo,"OT",$afternoon);
											echo $ro4->number_format($otAfternoon);
											$ot_per_day += $otAfternoon;
											$otTotal += $otAfternoon;

										?>
									</td>

									<td class='orange'>
										<?
											$ptAfternoon = $ts->get_outpatients_title_total($registrationNo,"PT",$afternoon);
											echo $ro4->number_format($ptAfternoon);
											$pt_per_day += $ptAfternoon;
											$ptTotal += $ptAfternoon;

										?>
									</td>

									<td>
										<?
											$stAfternoon = $ts->get_outpatients_therapy_total($registrationNo,"ST",$afternoon);
											echo $ro4->number_format($stAfternoon);
											$st_per_day += $stAfternoon;
											$stTotal += $stAfternoon;

										?>
									</td>

									<td class='lightBlue'>
										<?
											$dermaAfternoon = $ts->get_outpatients_title_total($registrationNo,"DERMA",$afternoon);
											echo $ro4->number_format($dermaAfternoon);
											$derma_per_day += $dermaAfternoon;
											$dermaTotal += $dermaAfternoon;

										?>
									</td>

									<td>
										<?
											$othersAfternoon = $ts->get_outpatients_title_total($registrationNo,"OTHERS",$afternoon);
											echo $ro4->number_format($othersAfternoon);
											$others_per_day += $othersAfternoon;
											$othersTotal += $othersAfternoon;

										?>
									</td>

									<td>
										<?
											$orAfternoon = $ts->get_outpatients_title_total($registrationNo,"OR/DR/ER Fee",$afternoon);
											echo $ro4->number_format($orAfternoon);
											$or_per_day += $orAfternoon;
											$orTotal += $orAfternoon;

										?>
									</td>

									<td>
										<?
											$balanceAfternoon = $ts->get_outpatients_title_total($registrationNo,"BALANCE",$afternoon);
											echo $ro4->number_format($balanceAfternoon);
											$balance_per_day += $balanceAfternoon;
											$balanceTotal += $balanceAfternoon;

										?>
									</td>

									<td>
										<?
											$pfAfternoon = (
														$ts->get_outpatients_PF_total($registrationNo,"PROFESSIONAL FEE",$afternoon) - 
														$ts->get_outpatients_PF_payables_total($registrationNo,"PROFESSIONAL FEE",$afternoon)
													);
											echo $ro4->number_format($pfAfternoon);
											$pf_per_day += $pfAfternoon;
											$pfTotal += $pfAfternoon;

										?>
									</td>

									<td>
										<?
											$payableAfternoon = (
													$ts->get_outpatients_PF_payables_total($registrationNo,"PROFESSIONAL FEE",$afternoon) +
													$ts->get_outpatients_therapy_payables_total($registrationNo,$afternoon)
												);
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
								<th class='yellow'><!--CASH & CARD--></th>
								<th><!--HMO--></th>
								<th class='lightBlue'><!--CASH--></th>
								<th class='lightBlue'><!--CREDIT CARD--></th>
								<th class='lightBlue'><!--HMO--></th>
								<th class='lightBlue'><!--Company--></th>
								<th class='lightBlue'><!--PERSONAL A/R--></th>
								<th class='yellow'><!--DISCOUNT--></th>
								<th><!--LABORATORY--></th>
								<th><!--XRAY--></th>
								<th><!--UTZ--></th>
								<th><!--ECG--></th>
								<th><!--CTSCAN--></th>
								<th><!--SPIRO--></th>
								<th><!--MEDICINE--></th>
								<th><!--SUPPLIES--></th>
								<th><!--ER FEE--></th>
								<th><!--MISC--></th>
								<th><!--OT--></th>
								<th class='orange'><!--PT--></th>
								<th><!--ST--></th>
								<th class='lightBlue'><!--DERMA--></th>
								<th><!--OTHERS--></th>
								<th><!--O.R--></th>
								<th><!--A/R OPD PAID--></th>
								<th><!--CLINIC REVENUE--></th>
							</tr>						
							<? foreach( $ts->get_outpatients_registrationNo() as $registrationNo ) { ?>

								<? if( $ts->get_outpatients_shift($registrationNo,$month,$dayLoop,$year) == "Night" ) { ?>
								<tr>

									<td><!----></td>

									<td class='white'>
										<?
											echo $ts->get_OR_number($registrationNo,$night,$month,$dayLoop,$year);
										?>
									</td>

									<td class='white'>
										<?
											$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
											$lastName = $ro->selectNow('patientRecord','lastName','patientNo',$patientNo);
											echo $lastName;
										?>
									</td>

									<td class='white'>
										<?
											$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
											$firstName = $ro->selectNow('patientRecord','firstName','patientNo',$patientNo);
											echo $firstName;
										?>
									</td>

									<td class='yellow'>
										<?
											$cashPaidNight = $ts->get_outpatients_cash_payment($registrationNo,$night);
											$creditCardNight = $ts->get_outpatients_creditCard_payment($registrationNo,$night);
											echo $ro4->number_format($cashPaidNight + $creditCardNight);
										?>
									</td>

									<td>
										<?
											echo $ro->selectNow('registrationDetails','Company','registrationNo',$registrationNo)
										?>
									</td>

									<td class='lightBlue'>
										<?
											$cashPaidNight = $ts->get_outpatients_cash_payment($registrationNo,$night);
											echo $ro4->number_format($cashPaidNight);
											$cashPaid_per_day += $cashPaidNight;
											$cashPaidTotal += $cashPaidNight;

										?>
									</td>

									<td class='lightBlue'>
										<?
											$creditCardNight = $ts->get_outpatients_creditCard_payment($registrationNo,$night);
											echo $ro4->number_format($creditCardNight);
											$creditCard_per_day += $creditCardNight;
											$creditCardTotal += $creditCardNight;

										?>
									</td>

									<td class='lightBlue'>
										<?
											$hmoNight = $ts->get_outpatients_hmo_covered($registrationNo,$night);
											echo $ro4->number_format($hmoNight);
											$hmo_per_day += $hmoNight;
											$hmoTotal += $hmoNight;

										?>
									</td>

									<td class='lightBlue'>
										<?
											$companyNight = $ts->get_outpatients_company_covered($registrationNo,$night);
											echo $ro4->number_format($companyNight);
											$company_per_day += $companyNight;
											$companyTotal += $companyNight;

										?>
									</td>

									<td class='lightBlue'>
										<?
											$unpaidNight = $ts->get_outpatients_unpaid_total($registrationNo,$night);
											echo $ro4->number_format($unpaidNight);
											$unpaid_per_day += $unpaidNight;
											$unpaidTotal += $unpaidNight;

										?>
									</td>

									<td class='yellow'>
										<?
											$discountNight = $ts->get_outpatients_discount_total($registrationNo,$night);
											echo $ro4->number_format($discountNight);
											$discount_per_day += $discountNight;
											$discountTotal += $discountNight;

										?>
									</td>

									<td>
										<?
											$laboratoryNight = $ts->get_outpatients_title_total($registrationNo,"LABORATORY",$night);
											echo $ro4->number_format($laboratoryNight);
											$laboratory_per_day += $laboratoryNight;
											$laboratoryTotal += $laboratoryNight;
										?>
									</td>	

									<td>
										<?
											$xrayNight = $ts->get_outpatients_title_total($registrationNo,"XRAY",$night);
											echo $ro4->number_format($xrayNight);
											$xray_per_day += $xrayNight;
											$xrayTotal += $xrayNight;

										?>
									</td>

									<td>
										<?
											$utzNight = $ts->get_outpatients_title_total($registrationNo,"ULTRASOUND",$night);
											echo $ro4->number_format($utzNight);
											$utz_per_day += $utzNight;
											$utzTotal += $utzNight;

										?>
									</td>

									<td>
										<?
											$ecgNight = $ts->get_outpatients_title_total($registrationNo,"ECG",$night);
											echo $ro4->number_format($ecgNight);
											$ecg_per_day += $ecgNight;
											$ecgTotal += $ecgNight;

										?>
									</td>

									<td>
										<?
											$ctscanNight = $ts->get_outpatients_title_total($registrationNo,"CTSCAN",$night);
											echo $ro4->number_format($ctscanNight);
											$ctscan_per_day += $ctscanNight;
											$ctscanTotal += $ctscanNight;

										?>
									</td>

									<td>
										<?
											$spirometryNight = $ts->get_outpatients_title_total($registrationNo,"SPIROMETRY",$night);
											echo $ro4->number_format($spirometryNight);
											$spirometry_per_day += $spirometryNight;
											$spirometryTotal += $spirometryNight;

										?>
									</td>

									<td>
										<?
											$medicineNight = $ts->get_outpatients_title_total($registrationNo,"MEDICINE",$night);
											echo $ro4->number_format($medicineNight);
											$medicine_per_day += $medicineNight;
											$medicineTotal += $medicineNight;

										?>
									</td>

									<td>
										<?
											$suppliesNight = $ts->get_outpatients_title_total($registrationNo,"SUPPLIES",$night);
											echo $ro4->number_format($suppliesNight);
											$supplies_per_day += $suppliesNight;
											$suppliesTotal += $suppliesNight;

										?>
									</td>

									<td>
										<?
											$erfeeNight = $ts->get_outpatients_title_total($registrationNo,"ER FEE",$night);
											echo $ro4->number_format($erfeeNight);
											$erfee_per_day += $erfeeNight;
											$erfeeTotal += $erfeeNight;

										?>
									</td>

									<td>
										<?
											$miscNight = $ts->get_outpatients_title_total($registrationNo,"MISCELLANEOUS",$night);
											echo $ro4->number_format($miscNight);
											$misc_per_day += $miscNight;
											$miscTotal += $miscNight;

										?>
									</td>

									<td>
										<?
											$otNight = $ts->get_outpatients_therapy_total($registrationNo,"OT",$night);
											echo $ro4->number_format($otNight);
											$ot_per_day += $otNight;
											$otTotal += $otNight;

										?>
									</td>

									<td class='orange'>
										<?
											$ptNight = $ts->get_outpatients_title_total($registrationNo,"PT",$night);
											echo $ro4->number_format($ptNight);
											$pt_per_day += $ptNight;
											$ptTotal += $ptNight;

										?>
									</td>

									<td>
										<?
											$stNight = $ts->get_outpatients_therapy_total($registrationNo,"ST",$night);
											echo $ro4->number_format($stNight);
											$st_per_day += $stNight;
											$stTotal += $stNight;

										?>
									</td>

									<td class='lightBlue'>
										<?
											$dermaNight = $ts->get_outpatients_title_total($registrationNo,"DERMA",$night);
											echo $ro4->number_format($dermaNight);
											$derma_per_day += $dermaNight;
											$dermaTotal += $dermaNight;

										?>
									</td>

									<td>
										<?
											$othersNight = $ts->get_outpatients_title_total($registrationNo,"OTHERS",$night);
											echo $ro4->number_format($othersNight);
											$others_per_day += $othersNight;
											$othersTotal += $othersNight;

										?>
									</td>

									<td>
										<?
											$orNight = $ts->get_outpatients_title_total($registrationNo,"OR/DR/ER Fee",$night);
											echo $ro4->number_format($orNight);
											$or_per_day += $orNight;
											$orTotal += $orNight;

										?>
									</td>

									<td>
										<?
											$balanceNight = $ts->get_outpatients_title_total($registrationNo,"BALANCE",$night);
											echo $ro4->number_format($balanceNight);
											$balance_per_day += $balanceNight;
											$balanceTotal += $balanceNight;

										?>
									</td>


									<td>
										<?
											$pfNight = (
														$ts->get_outpatients_PF_total($registrationNo,"PROFESSIONAL FEE",$night) -
														$ts->get_outpatients_PF_payables_total($registrationNo,"PROFESSIONAL FEE",$night)
													);
											echo $ro4->number_format($pfNight);
											$pf_per_day += $pfNight;
											$pfTotal += $pfNight;

										?>
									</td>

									<td>
										<?
											$payableNight = (
														$ts->get_outpatients_PF_payables_total($registrationNo,"PROFESSIONAL FEE",$night) +
														$ts->get_outpatients_therapy_payables_total($registrationNo,$night)
													);
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
								<th class='yellow'><!--CASH & CARD--></th>
								<th><!--HMO--></th>
								<th class='lightBlue'><!--CASH PAID--></th>
								<th class='lightBlue'><!--CREDIT CARD--></th>
								<th class='lightBlue'><!--HMO--></th>
								<th class='lightBlue'><!--Company--></th>
								<th class='lightBlue'><!--PERSONAL A/R--></th>
								<th class='yellow'><!--DISCOUNT--></th>
								<th><!--LABORATORY--></th>
								<th><!--XRAY--></th>
								<th><!--UTZ--></th>
								<th><!--ECG--></th>
								<th><!--CTSCAN--></th>
								<th><!--SPIRO--></th>
								<th><!--MEDICINE--></th>
								<th><!--SUPPLIES--></th>
								<th><!--ER FEE--></th>
								<th><!--MISC--></th>
								<th><!--OT--></th>
								<th class='orange'><!--PT--></th>
								<th><!--ST--></th>
								<th class='lightBlue'><!--DERMA--></th>
								<th><!--OTHERS--></th>
								<th><!--O.R--></th>
								<th><!--A/R OPD PAID--></th>
								<th><!--CLINIC REVENUE--></th>								
							</tr>						
							<? foreach( $ts->get_outpatients_registrationNo() as $registrationNo ) { ?>
							
								<? if( $ts->check_total($registrationNo) > 0 ) { ?>
									<tr>

										<td><!----></td>
										
										<td class='white'>
											<?
												echo $ts->get_OR_number($registrationNo,$noShift,$month,$dayLoop,$year);
											?>
										</td>

										<td class='white'>
											<?
												$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
												$lastName = $ro->selectNow('patientRecord','lastName','patientNo',$patientNo);
												echo $lastName;
											?>
										</td>

										<td class='white'>
											<?
												$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
												$firstName = $ro->selectNow('patientRecord','firstName','patientNo',$patientNo);
												echo $firstName;
											?>
										</td>

										<td class='yellow'><!--CASH & CARD--></td>

										<td>
											<?
												echo $ro->selectNow('registrationDetails','Company','registrationNo',$registrationNo)
											?>
										</td>

										<td class='lightBlue'><!--CASH PAID--></td>

										<td class='lightBlue'><!--CREDIT CARD--></td>

										<td class='lightBlue'>
											<?
												$hmo_no_shift = $ts->get_outpatients_hmo_covered($registrationNo,$noShift);
												echo $ro4->number_format($hmo_no_shift);
												$hmo_per_day += $hmo_no_shift;
												$hmoTotal += $hmo_no_shift;

											?>
										</td>

										<td class='lightBlue'>
											<?
												$company_no_shift = $ts->get_outpatients_company_covered($registrationNo,$noShift);
												echo $ro4->number_format($company_no_shift);
												$company_per_day += $company_no_shift;
												$companyTotal += $company_no_shift;

											?>
										</td>

										<td class='lightBlue'>
											<?
												$unpaid_no_shift = $ts->get_outpatients_unpaid_total($registrationNo,$noShift);
												echo $ro4->number_format($unpaid_no_shift);
												$unpaid_per_day += $unpaid_no_shift;
												$unpaidTotal += $unpaid_no_shift;

											?>
										</td>

										<td class='yellow'>
											<?
												$discount_no_shift = $ts->get_outpatients_discount_total($registrationNo,$noShift);
												echo $ro4->number_format($discount_no_shift);
												$discount_per_day += $discount_no_shift;
												$discountTotal += $discount_no_shift;

											?>
										</td>

										<td>
											<?
												$laboratory_no_shift = $ts->get_outpatients_title_total($registrationNo,"LABORATORY",$noShift);
												echo $ro4->number_format($laboratory_no_shift);
												$laboratory_per_day += $laboratory_no_shift;
												$laboratoryTotal += $laboratory_no_shift;
											?>
										</td>	

										<td>
											<?
												$xray_no_shift = $ts->get_outpatients_title_total($registrationNo,"XRAY",$noShift);
												echo $ro4->number_format($xray_no_shift);
												$xray_per_day += $xray_no_shift;
												$xrayTotal += $xray_no_shift;

											?>
										</td>

										<td>
											<?
												$utz_no_shift = $ts->get_outpatients_title_total($registrationNo,"ULTRASOUND",$noShift);
												echo $ro4->number_format($utz_no_shift);
												$utz_per_day += $utz_no_shift;
												$utzTotal += $utz_no_shift;

											?>
										</td>

										<td>
											<?
												$ecg_no_shift = $ts->get_outpatients_title_total($registrationNo,"ECG",$noShift);
												echo $ro4->number_format($ecg_no_shift);
												$ecg_per_day += $ecg_no_shift;
												$ecgTotal += $ecg_no_shift;

											?>
										</td>

										<td>
											<?
												$ctscan_no_shift = $ts->get_outpatients_title_total($registrationNo,"CTSCAN",$noShift);
												echo $ro4->number_format($ctscan_no_shift);
												$ctscan_per_day += $ctscan_no_shift;
												$ctscanTotal += $ctscan_no_shift;

											?>
										</td>

										<td>
											<?
												$spirometry_no_shift = $ts->get_outpatients_title_total($registrationNo,"SPIROMETRY",$noShift);
												echo $ro4->number_format($spirometry_no_shift);
												$spirometry_per_day += $spirometry_no_shift;
												$spirometryTotal += $spirometry_no_shift;

											?>
										</td>

										<td>
											<?
												$medicine_no_shift = $ts->get_outpatients_title_total($registrationNo,"MEDICINE",$noShift);
												echo $ro4->number_format($medicine_no_shift);
												$medicine_per_day += $medicine_no_shift;
												$medicineTotal += $medicine_no_shift;

											?>
										</td>

										<td>
											<?
												$supplies_no_shift = $ts->get_outpatients_title_total($registrationNo,"SUPPLIES",$noShift);
												echo $ro4->number_format($supplies_no_shift);
												$supplies_per_day += $supplies_no_shift;
												$suppliesTotal += $supplies_no_shift;

											?>
										</td>

										<td>
											<?
												$erfee_no_shift = $ts->get_outpatients_title_total($registrationNo,"ER FEE",$noShift);
												echo $ro4->number_format($erfee_no_shift);
												$erfee_per_day += $erfee_no_shift;
												$erfeeTotal += $erfee_no_shift;

											?>
										</td>

										<td>
											<?
												$misc_no_shift = $ts->get_outpatients_title_total($registrationNo,"MISCELLANEOUS",$noShift);
												echo $ro4->number_format($misc_no_shift);
												$misc_per_day += $misc_no_shift;
												$miscTotal += $misc_no_shift;

											?>
										</td>

										<td>
											<?
												$ot_no_shift = $ts->get_outpatients_therapy_total($registrationNo,"OT",$noShift);
												echo $ro4->number_format($ot_no_shift);
												$ot_per_day += $ot_no_shift;
												$otTotal += $ot_no_shift;

											?>
										</td>

										<td class='orange'>
											<?
												$pt_no_shift = $ts->get_outpatients_title_total($registrationNo,"PT",$noShift);
												echo $ro4->number_format($pt_no_shift);
												$pt_per_day += $pt_no_shift;
												$ptTotal += $pt_no_shift;

											?>
										</td>

										<td>
											<?
												$st_no_shift = $ts->get_outpatients_therapy_total($registrationNo,"ST",$noShift);
												echo $ro4->number_format($st_no_shift);
												$st_per_day += $st_no_shift;
												$stTotal += $st_no_shift;

											?>
										</td>

										<td class='lightBlue'>
											<?
												$derma_no_shift = $ts->get_outpatients_title_total($registrationNo,"DERMA",$noShift);
												echo $ro4->number_format($derma_no_shift);
												$derma_per_day += $derma_no_shift;
												$dermaTotal += $derma_no_shift;

											?>
										</td>

										<td>
											<?
												$others_no_shift = $ts->get_outpatients_title_total($registrationNo,"OTHERS",$noShift);
												echo $ro4->number_format($others_no_shift);
												$others_per_day += $others_no_shift;
												$othersTotal += $others_no_shift;

											?>
										</td>

										<td>
											<?
												$or_no_shift = $ts->get_outpatients_title_total($registrationNo,"OR/DR/ER Fee",$noShift);
												echo $ro4->number_format($or_no_shift);
												$or_per_day += $or_no_shift;
												$orTotal += $or_no_shift;

											?>
										</td>

										<td>
											<?
												$balance_no_shift = $ts->get_outpatients_title_total($registrationNo,"BALANCE",$noShift);
												echo $ro4->number_format($balance_no_shift);
												$balance_per_day += $balance_no_shift;
												$balanceTotal += $balance_no_shift;

											?>
										</td>

										<td>
											<?
												$pf_no_shift = $ts->get_outpatients_PF_total($registrationNo,"PROFESSIONAL FEE",$noShift);
												echo $ro4->number_format($pf_no_shift);
												$pf_per_day += $pf_no_shift;
												$pfTotal += $pf_no_shift;

											?>
										</td>

										<td>
											<?
												$payable_no_shift = $ts->get_outpatients_PF_payables_total($registrationNo,"PROFESSIONAL FEE",$noShift);
												echo $ro4->number_format($payable_no_shift);
												$payable_per_day += $payable_no_shift;
												$payableTotal += $payable_no_shift;

											?>
										</td>

									</tr>
								<? } ?>
								
							<? } ?>


							<tr>
								<th class="grandTotal">Total</th>
								<th><!--OR#--></th>
								<th><!--LASTNAME--></th>
								<th><!--FIRSTNAME--></th>
								<th class="grandTotal yellow"><? echo $ro4->number_format($cashPaid_per_day + $creditCard_per_day) ?></th>
								<th><!--HMO--></th>
								<th class="grandTotal lightBlue"><? echo $ro4->number_format($cashPaid_per_day) ?></th>
								<th class="grandTotal lightBlue"><? echo $ro4->number_format($creditCard_per_day) ?></th>
								<th class="grandTotal lightBlue"><? echo $ro4->number_format($hmo_per_day) ?></th>
								<th class="grandTotal lightBlue"><? echo $ro4->number_format($company_per_day) ?></th>
								<th class="grandTotal lightBlue"><? echo $ro4->number_format($unpaid_per_day) ?></th>
								<th class="grandTotal yellow"><? echo $ro4->number_format($discount_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($laboratory_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($xray_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($utz_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($ecg_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($ctscan_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($spirometry_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($medicine_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($supplies_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($erfee_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($misc_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($ot_per_day) ?></th>
								<th class="grandTotal orange"><? echo $ro4->number_format($pt_per_day) ?></th>
								<th class="grandTotal"><? echo $ro4->number_format($st_per_day) ?></th>
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
								$unpaid_per_day = 0;
								$discount_per_day = 0;
								$laboratory_per_day = 0; 
								$xray_per_day = 0;
								$utz_per_day = 0;
								$ecg_per_day = 0;
								$ctscan_per_day = 0;
								$spirometry_per_day = 0;
								$medicine_per_day = 0;
								$supplies_per_day = 0;
								$erfee_per_day = 0;
								$misc_per_day = 0;
								$ot_per_day = 0;
								$pt_per_day = 0;
								$st_per_day = 0;
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
							<td class='yellow'><? echo $ro4->number_format($cashPaidTotal + $creditCardTotal) ?></td>
							<td><!--HMO--></td>
							<td class='lightBlue'><? echo $ro4->number_format($cashPaidTotal) ?></td>
							<td class='lightBlue'><? echo $ro4->number_format($creditCardTotal) ?></td>
							<td class='lightBlue'><? echo $ro4->number_format($hmoTotal) ?></td>
							<td class='lightBlue'><? echo $ro4->number_format($companyTotal) ?></td>
							<td class='lightBlue'><? echo $ro4->number_format($unpaidTotal) ?></td>
							<td class='yellow'><? echo $ro4->number_format($discountTotal) ?></td>
							<td><? echo $ro4->number_format($laboratoryTotal) ?></td>
							<td>&nbsp;<? echo $ro4->number_format($xrayTotal) ?></td>
							<td>&nbsp;<? echo $ro4->number_format($utzTotal) ?></td>
							<td>&nbsp;<? echo $ro4->number_format($ecgTotal) ?></td>
							<td>&nbsp;<? echo $ro4->number_format($ctscanTotal) ?></td>
							<td>&nbsp;<? echo $ro4->number_format($spirometryTotal) ?></td>
							<td>&nbsp;<? echo $ro4->number_format($medicineTotal) ?></td>
							<td>&nbsp;<? echo $ro4->number_format($suppliesTotal) ?></td>
							<td>&nbsp;<? echo $ro4->number_format($erfeeTotal) ?></td>
							<td>&nbsp;<? echo $ro4->number_format($miscTotal) ?></td>
							<td>&nbsp;<? echo $ro4->number_format($otTotal) ?></td>
							<td class='orange'>&nbsp;<? echo $ro4->number_format($ptTotal) ?></td>
							<td>&nbsp;<? echo $ro4->number_format($stTotal) ?></td>
							<td class='lightBlue'>&nbsp;<? echo $ro4->number_format($dermaTotal) ?></td>
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
				<table style="width:20%;">

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
										$medicineTotal +
										$suppliesTotal +
										$erfeeTotal +
										$miscTotal +
										$otTotal +
										$ptTotal +
										$stTotal +
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


