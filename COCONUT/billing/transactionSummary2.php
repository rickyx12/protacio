<script src='../../jquery-2.1.4.min.js'></script>
<script>
	$(document).ready(function(){ 
		$("#formatBtn").hide();
		$("#totalLink").click(function() {
			$("#formatBtn").show();
		});
	});
</script>

<?php
include("../../myDatabase3.php");

$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];

$ro = new database3();

$date = $year."-".$month."-".$day;
$date1 = $year1."-".$month1."-".$day1;
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

echo $date;
echo "<Br>".$date1;
echo "<br><br>";
$ro->showAllAccountTitle_ipd($date,$date1);
echo "<br><br>";
$ro->ipdPaymentsz($date,$date1);
echo "<hr>";

$ro->showAllAccountTitle_opd($date,$date1);
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
$ro->showPFaccounts($date,$date1);

$ro->showTherapyAccounts($date,$date1,"OT");
$otTotal = $ro->showTherapyAccounts_total();
$otCreditCard = $ro->showTherapyAccounts_creditCard();
$otCash = $ro->showTherapyAccounts_cash();
$otHMO = $ro->showTherapyAccounts_hmo();
$otPHIC = $ro->showTherapyAccounts_phic();
$otUnpaid = $ro->showTherapyAccounts_unpaid();
$otShare = $ro->showTherapyAccounts_pf();
$otDiscount = $ro->showTherapyAccounts_discount();


$ro->showTherapyAccounts($date,$date1,"ST");
$stTotal = $ro->showTherapyAccounts_total();
$stCreditCard = $ro->showTherapyAccounts_creditCard();
$stCash = $ro->showTherapyAccounts_cash();
$stHMO = $ro->showTherapyAccounts_hmo();
$stPHIC = $ro->showTherapyAccounts_phic();
$stUnpaid = $ro->showTherapyAccounts_unpaid();
$stShare = $ro->showTherapyAccounts_pf();
$stDiscount = $ro->showTherapyAccounts_discount();

echo "</table>";
echo "<br><br><br>";

echo "OPD:&nbsp;".number_format($ro->showPFaccounts_total() + $ro->_opd_totalz() + $otTotal + $stTotal,2);
echo "<Br>";
echo "IPD:&nbsp;".number_format($ro->showAllAccountTitle_ipd_total(),2);
echo "<br>";
echo "<a href='#' id='totalLink' style='text-decoration:none; color:black'>Total:&nbsp;".number_format($ro->showPFaccounts_total() + $ro->_opd_totalz() + $otTotal + $stTotal + $ro->showAllAccountTitle_ipd_total(),2)."</a>";


//for original transaction summary format
$opd_creditCard = ( $ro->showAllAccountTitle_opd_creditCard() + $ro->showPFAccounts_creditCard_totalCard() + $otCreditCard + $stCreditCard );
$opd_cash = ( $ro->showAllAccountTitle_opd_cash() + $ro->showPFaccounts_cash() + $otCash + $stCash + $ro->showPFaccounts_pf() + $otShare + $stShare );
$opd_hmo = ( $ro->showAllAccountTitle_opd_hmo() + $ro->showPFaccounts_hmo() + $otHMO + $stHMO );
$opd_phic = ( $ro->showAllAccountTitle_opd_phic() + $ro->showPFaccounts_phic() + $otPHIC + $stPHIC );
$opd_unpaid = ( $ro->showAllAccountTitle_opd_unpaid() + $ro->showPFaccounts_unpaid() + $otUnpaid + $stUnpaid );
$opd_discount = ( $ro->showAllAccountTitle_opd_discount() + $ro->showPFaccounts_discount() + $otDiscount + $stDiscount );

$opd_paidBalance = $ro->showAllAccountTitle_opd_balancePaid();
$opd_PF_total = $ro->showPFaccounts_total();
$opd_PF_hospitalShare = $ro->showPFaccounts_cash();
$opd_PF_creditCard = $ro->showPFaccounts_creditCards();
$opd_PF_payable = $ro->showPFaccounts_payable();
$opd_ecg = $ro->showAllAccountTitle_opd_ecg();
$opd_xray = $ro->showAllAccountTitle_opd_xray();
$opd_ultrasound = $ro->showAllAccountTitle_opd_ultrasound();
$opd_erFee = $ro->showAllAccountTitle_opd_erFee();
$opd_ctscan = $ro->showAllAccountTitle_opd_ctscan();
$opd_laboratory = $ro->showAllAccountTitle_opd_laboratory();
$opd_medicine = $ro->showAllAccountTitle_opd_medicine();
$opd_supplies = $ro->showAllAccountTitle_opd_supplies();
$opd_spyrometry = $ro->showAllAccountTitle_opd_spyrometry();
$opd_derma = $ro->showAllAccountTitle_opd_derma();
$opd_others = $ro->showAllAccountTitle_opd_others();
$opd_OR = $ro->showAllAccountTitle_opd_OR();
$opd_PT = $ro->showAllAccountTitle_opd_PT();
$opd_OT = $otTotal;
$opd_ST = $stTotal;
$opd_cardiacMonitor = $ro->showAllAccountTitle_opd_cardiacMonitor();
$opd_misc = $ro->showAllAccountTitle_opd_misc();

?>

<form method="post" action="transactionSummary2-titles.php" target="_blank">
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
	<input id="formatBtn" type="submit">
</form>
