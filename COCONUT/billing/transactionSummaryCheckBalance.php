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

$ro3->coconutFormStart("get","http://".$ro3->getMyUrl()."/COCONUT/billing/inpatient-total.php");
$ro3->transactionSummaryDischarge($date,$date1);
echo "<Br><br>";

$ro4->inpatient_deposit($date,$date1,"Cash");
$ro4->inpatient_deposit($date,$date1,"Credit Card");
$deposit_cash = 0;
$deposit_creditCard = 0;
?>

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
				<td><? echo $ro4->inpatient_deposit_registrationNo()[$a] ?></td>
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

<br><hr><br>

<?

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
$otDiscount = $ro3->showTherapyAccounts_discount();


$ro3->showTherapyAccounts($date,$date1,"ST");
$stTotal = $ro3->showTherapyAccounts_total();
$stCreditCard = $ro3->showTherapyAccounts_creditCard();
$stCash = $ro3->showTherapyAccounts_cash();
$stHMO = $ro3->showTherapyAccounts_hmo();
$stPHIC = $ro3->showTherapyAccounts_phic();
$stUnpaid = $ro3->showTherapyAccounts_unpaid();
$stShare = $ro3->showTherapyAccounts_pf();
$stDiscount = $ro3->showTherapyAccounts_discount();

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

echo "<br><br><br>";

echo "OPD:&nbsp;".number_format($ro3->showPFaccounts_total() + $ro3->_opd_totalz() + $otTotal + $stTotal,2);
echo "<Br>";
echo "IPD:&nbsp;".number_format($ro3->showAllAccountTitle_ipd_total(),2);
echo "<br>";
echo "<a href='#' id='totalLink' style='text-decoration:none; color:black'>Total:&nbsp;".number_format($ro3->showPFaccounts_total() + $ro3->_opd_totalz() + $otTotal + $stTotal + $ro3->showAllAccountTitle_ipd_total(),2)."</a>";


//for original transaction summary format
$opd_creditCard = ( $ro3->showAllAccountTitle_opd_creditCard() + $ro3->showPFAccounts_creditCard_totalCard() + $otCreditCard + $stCreditCard );
$opd_cash = ( $ro3->showAllAccountTitle_opd_cash() + $ro3->showPFaccounts_cash() + $otCash + $stCash + $ro3->showPFaccounts_pf() + $otShare + $stShare );
$opd_hmo = ( $ro3->showAllAccountTitle_opd_hmo() + $ro3->showPFaccounts_hmo() + $otHMO + $stHMO );
$opd_phic = ( $ro3->showAllAccountTitle_opd_phic() + $ro3->showPFaccounts_phic() + $otPHIC + $stPHIC );
$opd_unpaid = ( $ro3->showAllAccountTitle_opd_unpaid() + $ro3->showPFaccounts_unpaid() + $otUnpaid + $stUnpaid );
$opd_discount = ( $ro3->showAllAccountTitle_opd_discount() + $ro3->showPFaccounts_discount() + $otDiscount + $stDiscount );

$opd_paidBalance = $ro3->showAllAccountTitle_opd_balancePaid();
$opd_PF_total = $ro3->showPFaccounts_total();
$opd_PF_hospitalShare = $ro3->showPFaccounts_cash();
$opd_PF_creditCard = $ro3->showPFaccounts_creditCards();
$opd_PF_payable = $ro3->showPFaccounts_payable();
$opd_ecg = $ro3->showAllAccountTitle_opd_ecg();
$opd_xray = $ro3->showAllAccountTitle_opd_xray();
$opd_ultrasound = $ro3->showAllAccountTitle_opd_ultrasound();
$opd_erFee = $ro3->showAllAccountTitle_opd_erFee();
$opd_ctscan = $ro3->showAllAccountTitle_opd_ctscan();
$opd_laboratory = $ro3->showAllAccountTitle_opd_laboratory();
$opd_medicine = $ro3->showAllAccountTitle_opd_medicine();
$opd_supplies = $ro3->showAllAccountTitle_opd_supplies();
$opd_spyrometry = $ro3->showAllAccountTitle_opd_spyrometry();
$opd_derma = $ro3->showAllAccountTitle_opd_derma();
$opd_others = $ro3->showAllAccountTitle_opd_others();
$opd_OR = $ro3->showAllAccountTitle_opd_OR();
$opd_PT = $ro3->showAllAccountTitle_opd_PT();
$opd_OT = $otTotal;
$opd_ST = $stTotal;
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
	<input type="hidden" name="opd_pf_total" value="<? echo ($opd_PF_total) ?>">
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