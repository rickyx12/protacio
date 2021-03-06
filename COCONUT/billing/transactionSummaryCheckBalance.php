<?php
include "../../myDatabase3.php";
include "../../myDatabase4.php";

$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];

$ro3 = new database3();
$ro4 = new database4();

$date = $year."-".$month."-".$day;
$date1 = $year1."-".$month1."-".$day1;

echo "<form method='post' action='inpatient-total.php' target='_blank'>";
$ro3->transactionSummaryDischarge($date,$date1);
echo "<Br><br>";

$ro4->inpatient_deposit($date,$date1,"Cash",'no');
$ro4->inpatient_deposit($date,$date1,"Credit Card",'no');
$deposit_cash = 0;
$deposit_creditCard = 0;
?>
DEPOSIT
<table border=1 cellspacing="0">
	<tr>
		<th>Reg#</th>
		<th>Discharge</th>
		<th>Cash</th>
		<th>Credit Card</th>
	</tr>
	<? for( $a = 0, $b = 0 , $c = 0 , $d = 0;$a < count($ro4->inpatient_deposit_registrationNo()) , $b < count($ro4->inpatient_deposit_dateUnregistered()) , $c < count($ro4->inpatient_deposit_amountPaid()) , $d < count($ro4->inpatient_deposit_paidVia()) ; $a++ , $b++ , $c++ , $d++ ) { ?>
		<tr>
			<? if( $ro4->inpatient_deposit_paidVia()[$d] == "Cash" ) { ?>
				<td><? echo $ro4->inpatient_deposit_registrationNo()[$a] ?> - <? echo $ro3->selectNow("patientRecord","lastName","patientNo",$ro3->selectNow("registrationDetails","patientNo","registrationNo",$ro4->inpatient_deposit_registrationNo()[$a])).", ".$ro3->selectNow("patientRecord","firstName","patientNo",$ro3->selectNow("registrationDetails","patientNo","registrationNo",$ro4->inpatient_deposit_registrationNo()[$a])) ?></td>
				<td><? echo $ro4->inpatient_deposit_dateUnregistered()[$b] ?></td>
				<td><? echo $ro4->inpatient_deposit_amountPaid()[$c] ?></td>
				<td>&nbsp;</td>
			<?	$deposit_cash += $ro4->inpatient_deposit_amountPaid()[$c] ?>
			<? }else { ?>
				<td><? echo $ro4->inpatient_deposit_registrationNo()[$a] ?></td>
				<td><? echo $ro4->inpatient_deposit_dateUnregistered()[$b] ?></td>
				<td>&nbsp;</td>
				<td><? echo $ro4->inpatient_deposit_amountPaid()[$c] ?></td>
				<?	$deposit_creditCard += $ro4->inpatient_deposit_amountPaid()[$c] ?>
			<? } ?>
		</tr>
	<? } ?>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;<? echo $deposit_cash ?></td>
			<td>&nbsp;<? echo $deposit_creditCard ?></td>
		</tr>
</table>

<Br>

Balance Paid
<? $ro4->inpatient_balance_paid($date,$date1) ?>
<? $balancePaid_cash = 0 ?>
<? $balancePaid_creditCard = 0 ?>
<table cellspacing="0" border="1">
	<tr>
		<th>Reg#</th>
		<th>Cash</th>
		<th>Cr.Card</th>
		<th>Date</th>
	</tr>
	
	<? if( $ro4->inpatient_balance_paid_paymentNo() != "" ) { ?>
		<? foreach($ro4->inpatient_balance_paid_paymentNo() as $paymentNo) { ?>
			<tr>
				<td><? echo $ro3->selectNow("patientPayment","registrationNo","paymentNo",$paymentNo) ?></td>
				<? if( $ro3->selectNow("patientPayment","paidVia","paymentNo",$paymentNo) == "Cash" ) { ?>
					<td><? echo $ro3->selectNow("patientPayment","amountPaid","paymentNo",$paymentNo) ?></td>
					<td></td>
					<? $balancePaid_cash += $ro3->selectNow("patientPayment","amountPaid","paymentNo",$paymentNo) ?>
				<? }else { ?>
					<td></td>
					<td><? echo $ro3->selectNow("patientPayment","amountPaid","paymentNo",$paymentNo) ?></td>
					<? $balancePaid_creditCard += $ro3->selectNow("patientPayment","amountPaid","paymentNo",$paymentNo) ?>				
				<? } ?>
				<td></td>
			</tr>
		<? } ?>
	<? } ?>

</table>

<br><hr><br>

<?
//for therapy variables
$otTotal;
$otCreditCard;
$otCash;
$otHMO;
$otPHIC;
$otUnpaid;
$otShare;
$otDiscount;

$stTotal;
$stCreditCard;
$stCash;
$stHMO;
$stPHIC;
$stUnpaid;
$stShare;
$stDiscount;

$spedTotal;
$spedCreditCard;
$spedCash;
$spedHMO;
$spedPHIC;
$spedUnpaid;
$spedShare;
$spedDiscount;


$ro3->showAllAccountTitle_opd($date,$date1);

echo "<br>";
echo "<table border=0 width='80%'>";
echo "<tr>";
echo "<th>&nbsp;Outpatient</th>";
echo "<th>&nbsp;Discount</th>";
echo "<th>&nbsp;UNPAID</th>";
echo "<th>&nbsp;HMO</th>";
echo "<th>&nbsp;PHIC</th>";
echo "<th>&nbsp;HOSPITAL</th>";
echo "<th>&nbsp;DOCTOR</th>";
echo "<th>&nbsp;Cr.CARD</th>";
echo "<th>&nbsp;PAYABLES</th>";
echo "<th>&nbsp;TOTAL</th>";
echo "</tr>";

$ro3->showPFaccounts($date,$date1);


$ro3->showTherapyAccounts($date,$date1,"OT");
$otTotal = $ro3->showTherapyAccounts_total();
$otCreditCard = $ro3->showTherapyAccounts_creditCard();
$otCash = $ro3->showTherapyAccounts_cash();
$otHMO = $ro3->showTherapyAccounts_hmo();
$otPHIC = $ro3->showTherapyAccounts_phic();
$otUnpaid = $ro3->showTherapyAccounts_unpaid();
$otShare = $ro3->showTherapyAccounts_pf();
$ot_Payables = $ro3->showTherapyAccounts_payable();
$ot_hmo_Payables = $ro3->showTherapyAccounts_hmo_payable();
$otDiscount = $ro3->showTherapyAccounts_discount();


$ro3->showTherapyAccounts($date,$date1,"ST");
$stTotal = $ro3->showTherapyAccounts_total();
$stCreditCard = $ro3->showTherapyAccounts_creditCard();
$stCash = $ro3->showTherapyAccounts_cash();
$stHMO = $ro3->showTherapyAccounts_hmo();
$stPHIC = $ro3->showTherapyAccounts_phic();
$stUnpaid = $ro3->showTherapyAccounts_unpaid();
$stShare = $ro3->showTherapyAccounts_pf();
$st_Payables = $ro3->showTherapyAccounts_payable();
$st_hmo_Payables = $ro3->showTherapyAccounts_hmo_payable();
$stDiscount = $ro3->showTherapyAccounts_discount();


$ro3->showTherapyAccounts($date,$date1,"SPED");
$spedTotal = $ro3->showTherapyAccounts_total();
$spedCreditCard = $ro3->showTherapyAccounts_creditCard();
$spedCash = $ro3->showTherapyAccounts_cash();
$spedHMO = $ro3->showTherapyAccounts_hmo();
$spedPHIC = $ro3->showTherapyAccounts_phic();
$spedUnpaid = $ro3->showTherapyAccounts_unpaid();
$spedShare = $ro3->showTherapyAccounts_pf();
$sped_Payables = $ro3->showTherapyAccounts_payable();
$sped_hmo_Payables = $ro3->showTherapyAccounts_hmo_payable();
$spedDiscount = $ro3->showTherapyAccounts_discount();

echo "</table>";

?>

<?
echo "<Br>From $date to $date1<bR>";
$ro3->coconutHidden("month",$month);
$ro3->coconutHidden("day",$day);
$ro3->coconutHidden("year",$year);
$ro3->coconutHidden("month1",$month1);
$ro3->coconutHidden("day1",$day1);
$ro3->coconutHidden("year1",$year1);
$ro3->coconutHidden("deposit_cash",$deposit_cash);
$ro3->coconutHidden("deposit_creditCard",$deposit_creditCard);
$ro3->coconutHidden("balancePaid_cash",$balancePaid_cash);
$ro3->coconutHidden("balancePaid_creditCard",$balancePaid_creditCard);

echo "<br><br><br>";

echo "OPD:&nbsp;".number_format($ro3->showPFaccounts_total() + $ro3->_opd_totalz() + $otTotal + $stTotal,2);
echo "<Br>";
echo "IPD:&nbsp;".number_format($ro3->showAllAccountTitle_ipd_total(),2);
echo "<br>";
echo "<a href='#' id='totalLink' style='text-decoration:none; color:black'>Total:&nbsp;".number_format($ro3->showPFaccounts_total() + $ro3->_opd_totalz() + $otTotal + $stTotal + $ro3->showAllAccountTitle_ipd_total(),2)."</a>";


//for original transaction summary format
$opd_creditCard = ( $ro3->showAllAccountTitle_opd_creditCard() + $ro3->showPFAccounts_creditCard_totalCard() + $otCreditCard + $stCreditCard + $spedCreditCard );
$opd_cash = ( $ro3->showAllAccountTitle_opd_cash() + $ro3->showPFaccounts_cash() + $otCash + $stCash + $spedCash );
$opd_hmo = ( $ro3->showAllAccountTitle_opd_hmo() + $ro3->showPFaccounts_hmo() + $otHMO + $stHMO + $spedHMO);
$opd_phic = ( $ro3->showAllAccountTitle_opd_phic() + $ro3->showPFaccounts_phic() + $otPHIC + $stPHIC + $spedPHIC );
$opd_unpaid = ( $ro3->showAllAccountTitle_opd_unpaid() + $ro3->showPFaccounts_unpaid() + $otUnpaid + $stUnpaid + $spedUnpaid );
$opd_discount = ( $ro3->showAllAccountTitle_opd_discount() + $ro3->showPFaccounts_discount() + $otDiscount + $stDiscount + $spedDiscount );


$opd_paidBalance = $ro3->showAllAccountTitle_opd_balancePaid();
$opd_PF_total = $ro3->showPFaccounts_total();
$opd_PF_hospitalShare = (( $ro3->showPFaccounts_unpaid() + $ro3->showPFaccounts_cash() + $ro3->showPFaccounts_creditCards() + $ro3->showPFaccounts_phic() + $ro3->showPFaccounts_hmo() + $ro3->showPFaccounts_discount() ) - $ro3->showPFaccounts_payable() );
$opd_PF_creditCard = $ro3->showPFaccounts_creditCards();
$opd_PF_payable = $ro3->showPFaccounts_payable();
$opd_ecg = $ro3->showAllAccountTitle_opd_ecg();
$opd_xray = $ro3->showAllAccountTitle_opd_xray();
$opd_ultrasound = $ro3->showAllAccountTitle_opd_ultrasound();
$opd_erFee = $ro3->showAllAccountTitle_opd_erFee();
$opd_nursery = $ro3->showAllAccountTitle_opd_nursery();
$opd_rehab = $ro3->showAllAccountTitle_opd_rehab();
$opd_ctscan = $ro3->showAllAccountTitle_opd_ctscan();
$opd_laboratory = $ro3->showAllAccountTitle_opd_laboratory();
$opd_medicine = $ro3->showAllAccountTitle_opd_medicine();
$opd_supplies = $ro3->showAllAccountTitle_opd_supplies();
$opd_spyrometry = $ro3->showAllAccountTitle_opd_spyrometry();
$opd_derma = $ro3->showAllAccountTitle_opd_derma();
$opd_others = $ro3->showAllAccountTitle_opd_others();
$opd_OR = $ro3->showAllAccountTitle_opd_OR();
$opd_PT = ($ro3->showAllAccountTitle_opd_PT());
$opd_OT = ( $otCreditCard + $otCash + $otHMO + $otPHIC + $otUnpaid + $otDiscount );
$opd_ST = ( $stCreditCard + $stCash + $stHMO + $stPHIC + $stUnpaid + $stDiscount );
$opd_SPED = ( $spedCreditCard + $spedCash + $spedHMO + $spedPHIC + $spedUnpaid + $spedDiscount );
$opd_cardiacMonitor = $ro3->showAllAccountTitle_opd_cardiacMonitor();
$opd_misc = $ro3->showAllAccountTitle_opd_misc();

?>

	<input type="hidden" name="opdCreditCard" value="<? echo $opd_creditCard ?>">
	<input type="hidden" name="opdCash" value="<? echo $opd_cash ?>">
	<input type="hidden" name="opdHMO" value="<? echo $opd_hmo ?>">
	<input type="hidden" name="opdPHIC" value="<? echo $opd_phic ?>">
	<input type="hidden" name="opdUnpaid" value="<? echo $opd_unpaid ?>">
	<input type="hidden" name="opdDiscount" value="<? echo $opd_discount ?>">
	<input type="hidden" name="opdBalancePaid" value="<? echo $opd_paidBalance ?>">
	<input type="hidden" name="opd_pf_total" value="<? echo ($opd_PF_hospitalShare) ?>">
	<input type="hidden" name="opd_ecg" value="<? echo $opd_ecg ?>">
	<input type="hidden" name="opd_xray" value="<? echo $opd_xray ?>">
	<input type="hidden" name="opd_ultrasound" value="<? echo $opd_ultrasound ?>">
	<input type="hidden" name="opd_erFee" value="<? echo $opd_erFee ?>">
	<input type="hidden" name="opd_nursery" value="<? echo $opd_nursery ?>">
	<input type="hidden" name="opd_rehab" value="<? echo $opd_rehab ?>">
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
	<input type="hidden" name="opd_SPED" value="<? echo $opd_SPED ?>">
	<input type="hidden" name="opd_OT_payables" value="<? echo ($ot_hmo_Payables + $ot_Payables) ?>">
	<input type="hidden" name="opd_ST_payables" value="<? echo ($st_hmo_Payables + $st_Payables) ?>">
	<input type="hidden" name="opd_SPED_payables" value="<? echo ($sped_hmo_Payables + $sped_Payables) ?>">
	<input type="hidden" name="opd_PF_payable" value="<? echo $opd_PF_payable ?>">
	<input type="hidden" name="opd_cardiacMonitor" value="<? echo $opd_cardiacMonitor ?>">
	<input type="hidden" name="opd_misc" value="<? echo $opd_misc ?>">

	<input type="hidden" name="date1" value="<? echo $date ?>">
	<input type="hidden" name="date2" value="<? echo $date1 ?>">
	<br>
	
<?
$ro3->coconutButton("Proceed");
$ro3->coconutFormStop();
?>