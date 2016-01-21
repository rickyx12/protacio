<?php
include("../../myDatabase2.php");
$balanceHandler = $_GET['balanceHandler'];
$countBalance = count($balanceHandler);

$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];


$ro = new database2();


for( $x=0;$x<$countBalance;$x++ ) {
// format: registrationNo-balance
$patientBalance = preg_split ("/\-/",$balanceHandler[$x]); 
$ro->editNow("registrationDetails","registrationNo",$patientBalance[0],"balance",$patientBalance[1]);
}

echo "<Br><br>";

$date = $year."-".$month."-".$day;
$date1 = $year1."-".$month1."-".$day1;

echo "<b>Transaction Summary</b>";
echo "<br><b>From</b> ".$date." to ".$date1;


echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }
</style>";


echo "<table border=0 width='100%'>";
echo "<tr>";
echo "<td width='30%'><b>OPD</b></td>";
echo "<td width='10%'>&nbsp;</td>";
echo "<td width='10%'>&nbsp;</td>";
echo "<td width='30%'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>IPD</b></td>";
echo "<td width='10%'>&nbsp;</td>";
echo "<td width='10%'>&nbsp;</td>";

/*******************CREDIT SIDE TOTAL*******************/


$totalClinicRev = (
$ro->transactionSummary_opd_department_debit_paid("PROFESSIONAL FEE","amountPaidFromCreditCard",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_paid("PROFESSIONAL FEE","cashPaid",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("PROFESSIONAL FEE","HMO",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("PROFESSIONAL FEE","COMPANY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_personalBalance("PROFESSIONAL FEE",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_discount("PROFESSIONAL FEE",$date,$date1)
);

$totalOR = (
$ro->transactionSummary_opd_department_debit_paid("OR/DR/ER Fee","amountPaidFromCreditCard",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_paid("OR/DR/ER Fee","cashPaid",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("OR/DR/ER Fee","HMO",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("OR/DR/ER Fee","COMPANY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_personalBalance("OR/DR/ER Fee",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_discount("OR/DR/ER Fee",$date,$date1)
);


$totalERFEE = (
$ro->transactionSummary_opd_department_debit_paid("ER FEE","amountPaidFromCreditCard",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_paid("ER FEE","cashPaid",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("ER FEE","HMO",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("ER FEE","COMPANY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_personalBalance("ER FEE",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_discount("ER FEE",$date,$date1)
);




$totalECG = (
$ro->transactionSummary_opd_department_debit_paid("ECG","amountPaidFromCreditCard",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_paid("ECG","cashPaid",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("ECG","HMO",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("ECG","COMPANY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_personalBalance("ECG",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_discount("ECG",$date,$date1)
);


$totalSPIROMETRY = (
$ro->transactionSummary_opd_department_debit_paid("SPIROMETRY","amountPaidFromCreditCard",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_paid("SPIROMETRY","cashPaid",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("SPIROMETRY","HMO",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("SPIROMETRY","COMPANY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_personalBalance("SPIROMETRY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_discount("SPIROMETRY",$date,$date1)
);


$totalXRAY = (
$ro->transactionSummary_opd_department_debit_paid("XRAY","amountPaidFromCreditCard",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_paid("XRAY","cashPaid",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("XRAY","HMO",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("XRAY","COMPANY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_personalBalance("XRAY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_discount("XRAY",$date,$date1)
);


$totalUTZ = (
$ro->transactionSummary_opd_department_debit_paid("ULTRASOUND","amountPaidFromCreditCard",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_paid("ULTRASOUND","cashPaid",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("ULTRASOUND","HMO",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("ULTRASOUND","COMPANY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_personalBalance("ULTRASOUND",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_discount("ULTRASOUND",$date,$date1)
);


$totalCardiacMonitor = (
$ro->transactionSummary_opd_department_debit_paid("CARDIAC MONITOR","amountPaidFromCreditCard",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_paid("CARDIAC MONITOR","cashPaid",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("CARDIAC MONITOR","HMO",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("CARDIAC MONITOR","COMPANY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_personalBalance("CARDIAC MONITOR",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_discount("CARDIAC MONITOR",$date,$date1)
);


$totalCTSCAN = (
$ro->transactionSummary_opd_department_debit_paid("CTSCAN","amountPaidFromCreditCard",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_paid("CTSCAN","cashPaid",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("CTSCAN","HMO",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("CTSCAN","COMPANY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_personalBalance("ULTRASOUND",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_discount("CTSCAN",$date,$date1)
);


$totalLab = (
$ro->transactionSummary_opd_department_debit_paid("LABORATORY","amountPaidFromCreditCard",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_paid("LABORATORY","cashPaid",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("LABORATORY","HMO",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("LABORATORY","COMPANY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_personalBalance("LABORATORY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_discount("LABORATORY",$date,$date1)
);


$totalMed = (
$ro->transactionSummary_opd_department_debit_paid("MEDICINE","amountPaidFromCreditCard",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_paid("MEDICINE","cashPaid",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("MEDICINE","HMO",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("MEDICINE","COMPANY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_personalBalance("MEDICINE",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_discount("MEDICINE",$date,$date1)
);


$totalSup = (
$ro->transactionSummary_opd_department_debit_paid("SUPPLIES","amountPaidFromCreditCard",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_paid("SUPPLIES","cashPaid",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("SUPPLIES","HMO",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("SUPPLIES","COMPANY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_personalBalance("SUPPLIES",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_discount("SUPPLIES",$date,$date1)
);


$totalPT = (
$ro->transactionSummary_opd_department_debit_paid("REHAB","amountPaidFromCreditCard",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_paid("REHAB","cashPaid",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("REHAB","HMO",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("REHAB","COMPANY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_personalBalance("REHAB",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_discount("REHAB",$date,$date1)
);


/*******************CREDIT SIDE TOTAL*******************/


/******************IPD TOTAL******************/

$deposit = ( $ro->transactionSummary_ipd_department_debit_deposit($date,$date1) );

$ipd_debitTotal = ( 
$ro->transactionSummary_ipd_department_debit("Credit Card",$date,$date1) + 
$ro->transactionSummary_ipd_department_debit("Cash",$date,$date1) + 
$ro->transactionSummary_ipd_department_debit_company("HMO",$date,$date1) + 
$ro->transactionSummary_ipd_department_debit_company("COMPANY",$date,$date1) + 
$ro->transactionSummary_ipd_department_debit_phic($date,$date1) +
$ro->transactionSummary_ipd_department_debit_patientBalance($date,$date1) +
$ro->transactionSummary_ipd_department_debit_discount($date,$date1) +
$deposit
);

$deposit = ( $ro->transactionSummary_ipd_department_debit_deposit($date,$date1) );

$ipd_creditTotal = ( 
$ro->transactionSummary_ipd_department_credit("PROFESSIONAL FEE",$date,$date1) + 
$ro->transactionSummary_ipd_department_credit("OR/DR/ER Fee",$date,$date1) +
$ro->transactionSummary_ipd_department_credit("Room and Board",$date,$date1) +
$ro->transactionSummary_ipd_department_credit("ECG",$date,$date1) +
$ro->transactionSummary_ipd_department_credit("REHAB",$date,$date1) +
$ro->transactionSummary_ipd_department_credit("XRAY",$date,$date1) +
$ro->transactionSummary_ipd_department_credit("ULTRASOUND",$date,$date1) +
$ro->transactionSummary_ipd_department_credit("CTSCAN",$date,$date1) +
$ro->transactionSummary_ipd_department_credit("LABORATORY",$date,$date1) +
$ro->transactionSummary_ipd_department_inventory_credit("MEDICINE",$date,$date1) +
$ro->transactionSummary_ipd_department_inventory_credit("SUPPLIES",$date,$date1) +
$ro->transactionSummary_ipd_department_credit("ER FEE",$date,$date1) +
$ro->transactionSummary_ipd_department_credit("CARDIAC MONITOR",$date,$date1) +
$ro->transactionSummary_ipd_department_credit("MISCELLANEOUS",$date,$date1) +
$deposit
);


/*****************IPD TOTAL*****************/


/**************DEBIT SIDE************************/

echo "</tr>";

$opd_debitSide_creditCardTotal = ( 
$ro->transactionSummary_opd_department_debit_paid("LABORATORY","amountPaidFromCreditCard",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("MEDICINE","amountPaidFromCreditCard",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("SUPPLIES","amountPaidFromCreditCard",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("ULTRASOUND","amountPaidFromCreditCard",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("CTSCAN","amountPaidFromCreditCard",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("OR/DR/ER Fee","amountPaidFromCreditCard",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("ECG","amountPaidFromCreditCard",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("SPIROMETRY","amountPaidFromCreditCard",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("XRAY","amountPaidFromCreditCard",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("REHAB","amountPaidFromCreditCard",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("ER FEE","amountPaidFromCreditCard",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("CARDIAC MONITOR","amountPaidFromCreditCard",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("PROFESSIONAL FEE","amountPaidFromCreditCard",$date,$date1)
);

echo "<tr>";
echo "<td>CREDIT CARD</td>";
echo "<td>&nbsp;".number_format($opd_debitSide_creditCardTotal,2)."</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CREDIT CARD</td>";
echo "<td>&nbsp;".number_format($ro->transactionSummary_ipd_department_debit("Credit Card",$date,$date1),2)."</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";



$opd_debitSide_cashPaidTotal = ( 
$ro->transactionSummary_opd_department_debit_paid("LABORATORY","cashPaid",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_paid("MEDICINE","cashPaid",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("SUPPLIES","cashPaid",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("ULTRASOUND","cashPaid",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("CTSCAN","cashPaid",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("OR/DR/ER Fee","cashPaid",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("ECG","cashPaid",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("SPIROMETRY","cashPaid",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("XRAY","cashPaid",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("REHAB","cashPaid",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("ER FEE","cashPaid",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("CARDIAC MONITOR","cashPaid",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("PROFESSIONAL FEE","cashPaid",$date,$date1)  +
$ro->transactionSummary_opd_department_debit_paid("PROFESSIONAL FEE","doctorsPF",$date,$date1)
);


$ipd_debitSide_cash = ( $ro->transactionSummary_ipd_department_debit("Cash",$date,$date1) + $deposit );

//$ipd_debitSide_cash = ( $ro->transactionSummary_ipd_department_debit_deposit($date,$date1) + $ro->transactionSummary_ipd_department_debit("Cash",$date,$date1));


echo "<tr>";
echo "<td>CASH</td>";
echo "<td>&nbsp;".number_format($opd_debitSide_cashPaidTotal,2)."</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CASH</td>";
echo "<td>&nbsp;".number_format($ipd_debitSide_cash,2)."</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$opd_debitSide_hmoTotal = (
$ro->transactionSummary_opd_department_debit_covered("LABORATORY","HMO",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("MEDICINE","HMO",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("SUPPLIES","HMO",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("ULTRASOUND","HMO",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("CTSCAN","HMO",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("OR/DR/ER Fee","HMO",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("ECG","HMO",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("SPIROMETRY","HMO",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("XRAY","HMO",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("REHAB","HMO",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("ER FEE","HMO",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("CARDIAC MONITOR","HMO",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("PROFESSIONAL FEE","HMO",$date,$date1)

);

echo "<tr>";
echo "<td>A/R HMO</td>";
echo "<td>&nbsp;".number_format($opd_debitSide_hmoTotal,2)."</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A/R HMO</td>";
echo "<td>&nbsp;".number_format($ro->transactionSummary_ipd_department_debit_company("HMO",$date,$date1),2)."</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$opd_debitSide_companyTotal = (
$ro->transactionSummary_opd_department_debit_covered("LABORATORY","COMPANY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("MEDICINE","COMPANY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("SUPPLIES","COMPANY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("ULTRASOUND","COMPANY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("CTSCAN","COMPANY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("OR/DR/ER Fee","COMPANY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("ECG","COMPANY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("SPIROMETRY","COMPANY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("XRAY","COMPANY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("REHAB","COMPANY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("ER FEE","COMPANY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("CARDIAC MONITOR","COMPANY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("PROFESSIONAL FEE","COMPANY",$date,$date1)
);

echo "<tr>";
echo "<td>A/R Company</td>";
echo "<td>&nbsp;".number_format($opd_debitSide_companyTotal,2)."</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A/R Company</td>";
echo "<td>&nbsp;".number_format($ro->transactionSummary_ipd_department_debit_company("COMPANY",$date,$date1),2)."</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$opd_debitSide_personalBalance = (
$ro->transactionSummary_opd_department_debit_personalBalance("LABORATORY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_personalBalance("MEDICINE",$date,$date1) +
$ro->transactionSummary_opd_department_debit_personalBalance("SUPPLIES",$date,$date1) +
$ro->transactionSummary_opd_department_debit_personalBalance("ULTRASOUND",$date,$date1) +
$ro->transactionSummary_opd_department_debit_personalBalance("CTSCAN",$date,$date1) +
$ro->transactionSummary_opd_department_debit_personalBalance("OR/DR/ER Fee",$date,$date1) +
$ro->transactionSummary_opd_department_debit_personalBalance("ECG",$date,$date1) +
$ro->transactionSummary_opd_department_debit_personalBalance("SPIROMETRY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_personalBalance("XRAY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_personalBalance("REHAB",$date,$date1) +
$ro->transactionSummary_opd_department_debit_personalBalance("ER FEE",$date,$date1) +
$ro->transactionSummary_opd_department_debit_personalBalance("CARDIAC MONITOR",$date,$date1) +
$ro->transactionSummary_opd_department_debit_personalBalance("PROFESSIONAL FEE",$date,$date1)
);

echo "<tr>";
echo "<td>A/R-OPD(PERSONAL)</td>";
echo "<td>&nbsp;".number_format($opd_debitSide_personalBalance,2)."</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A/R PhilHealth</td>";
echo "<td>&nbsp;".number_format($ro->transactionSummary_ipd_department_debit_phic($date,$date1),2)."</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$opd_debitSide_discount = (
$ro->transactionSummary_opd_department_debit_discount("LABORATORY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_discount("MEDICINE",$date,$date1) +
$ro->transactionSummary_opd_department_debit_discount("SUPPLIES",$date,$date1) +
$ro->transactionSummary_opd_department_debit_discount("ULTRASOUND",$date,$date1) +
$ro->transactionSummary_opd_department_debit_discount("CTSCAN",$date,$date1) +
$ro->transactionSummary_opd_department_debit_discount("OR/DR/ER Fee",$date,$date1) +
$ro->transactionSummary_opd_department_debit_discount("ECG",$date,$date1) +
$ro->transactionSummary_opd_department_debit_discount("SPIROMETRY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_discount("XRAY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_discount("REHAB",$date,$date1) +
$ro->transactionSummary_opd_department_debit_discount("ER FEE",$date,$date1) +
$ro->transactionSummary_opd_department_debit_discount("CARDIAC MONITOR",$date,$date1) +
$ro->transactionSummary_opd_department_debit_discount("PROFESSIONAL FEE",$date,$date1)
);



$ipd_balance = ( $ro->transactionSummary_ipd_department_debit_patientBalance($date,$date1) );


echo "<tr>";
echo "<td>Revenue Discount</td>";
echo "<td>&nbsp;".number_format($opd_debitSide_discount,2)."</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A/R IN PT(PERSONAL)</td>";
echo "<td>&nbsp;".number_format($ipd_balance,2)."</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";


echo "<tr>";
echo "<td>A/R OPD-PAID</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A/R IN PT-PAID</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";


echo "<tr>";
echo "<td>Clinic Revenue</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($totalClinicRev,2)."</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Clinic Revenue</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($ro->transactionSummary_ipd_department_credit("PROFESSIONAL FEE",$date,$date1),2)."</td>";
echo "</tr>";


echo "<tr>";
echo "<td>Operating Room-OPD</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($totalOR,2)."</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Operating Room</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($ro->transactionSummary_ipd_department_credit("OR/DR/ER Fee",$date,$date1),2)."</td>";
echo "</tr>";


echo "<tr>";
echo "<td>ER Fee</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($totalERFEE,2)."</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Room</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($ro->transactionSummary_ipd_department_credit("Room and Board",$date,$date1),2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>ECG</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($totalECG,2)."</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ECG</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($ro->transactionSummary_ipd_department_credit("ECG",$date,$date1),2)."</td>";
echo "</tr>";


echo "<tr>";
echo "<td>SPYROMETRY</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($totalSPIROMETRY,2)."</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Physical Therapy</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($ro->transactionSummary_ipd_department_credit("REHAB",$date,$date1),2)."</td>";
echo "</tr>";


echo "<tr>";
echo "<td>Radiology</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($totalXRAY,2)."</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X-Ray</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($ro->transactionSummary_ipd_department_credit("XRAY",$date,$date1),2)."</td>";
echo "</tr>";


echo "<tr>";
echo "<td>Ultrasound</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($totalUTZ,2)."</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ultrasound</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($ro->transactionSummary_ipd_department_credit("ULTRASOUND",$date,$date1),2)."</td>";
echo "</tr>";


echo "<tr>";
echo "<td>Cardiac Monitor</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($totalCardiacMonitor,2)."</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CT-Scan</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($ro->transactionSummary_ipd_department_credit("CTSCAN",$date,$date1),2)."</td>";
echo "</tr>";


echo "<tr>";
echo "<td>CT-SCAN</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($totalCTSCAN,2)."</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Laboratory</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($ro->transactionSummary_ipd_department_credit("LABORATORY",$date,$date1),2)."</td>";
echo "</tr>";


echo "<tr>";
echo "<td>Laboratory</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($totalLab,2)."</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Medicine</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($ro->transactionSummary_ipd_department_inventory_credit("MEDICINE",$date,$date1),2)."</td>";
echo "</tr>";


echo "<tr>";
echo "<td>Pharmacy</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($totalMed,2)."</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Supplies and Other</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($ro->transactionSummary_ipd_department_inventory_credit("SUPPLIES",$date,$date1),2)."</td>";
echo "</tr>";


echo "<tr>";
echo "<td>Supplies and Other</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($totalSup,2)."</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ER FEE</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($ro->transactionSummary_ipd_department_credit("ER FEE",$date,$date1),2)."</td>";
echo "</tr>";



echo "<tr>";
echo "<td>Physical Therapy</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($totalPT,2)."</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CARDIAC MONITOR</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($ro->transactionSummary_ipd_department_credit("CARDIAC MONITOR",$date,$date1),2)."</td>";
echo "</tr>";


echo "<tr>";
echo "<td>Derma</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MISCELLANEOUS</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($ro->transactionSummary_ipd_department_credit("MISCELLANEOUS",$date,$date1),2)."</td>";
echo "</tr>";


$totalPayableMD = (
$ro->transactionSummary_opd_department_debit_paid("PROFESSIONAL FEE","doctorsPF",$date,$date1)
);

echo "<tr>";
echo "<td>Accounts Payable-MD</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($totalPayableMD,2)."</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DEPOSIT</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($deposit,2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Revenue Discount</td>";
echo "<td>&nbsp;".number_format($ro->transactionSummary_ipd_department_debit_discount($date,$date1),2)."</td>";
echo "<td align='right'>&nbsp;</td>";
echo "</tr>";


$opd_debitTotal = ( $opd_debitSide_creditCardTotal + $opd_debitSide_cashPaidTotal + $opd_debitSide_hmoTotal + $opd_debitSide_companyTotal + $opd_debitSide_personalBalance + $opd_debitSide_discount );

$opd_creditTotal = ( $totalLab + $totalMed + $totalSup + $totalUTZ + $totalCTSCAN + $totalOR + $totalECG + $totalSPIROMETRY + $totalXRAY + $totalPT + $totalERFEE + $totalCardiacMonitor + $totalClinicRev + $totalPayableMD );


echo "<tr>";
echo "<td>&nbsp;<b>TOTAL</b></td>";
echo "<td>&nbsp;".number_format($opd_debitTotal,2)."</td>";
echo "<td align='right'>".number_format($opd_creditTotal,2)."</td>";
echo "<td>&nbsp;</td>";
//IPD TOTAL
echo "<td>&nbsp;".number_format($ipd_debitTotal,2)."</td>";
echo "<td align='right'>&nbsp;".number_format($ipd_creditTotal,2)."</td>";;
echo "</tr>";


echo "</table>";

?>
