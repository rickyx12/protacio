<?php
include("../../myDatabase2.php");
$month = $_GET['month'];
$year = $_GET['year'];

$ro = new database2();
$ro->coconutDesign();

$date=$year."-".$month."-01";
$date1=$year."-".$month."-31";

$monthWord;

if( $month == "01" ) {
$monthWord = "January";
}else if( $month == "02" ) {
$monthWord = "February";
}else if( $month == "03" ) {
$monthWord = "March";
}else if( $month == "04" ) {
$monthWord = "April";
}else if( $month == "05" ) {
$monthWord = "May";
}else if( $month == "06" ) {
$monthWord = "June";
}else if( $month == "07" ) {
$monthWord = "July";
}else if( $month == "08" ) {
$monthWord = "August";
}else if( $month == "09" ) {
$monthWord = "September";
}else if( $month == "10" ) {
$monthWord = "October";
}else if( $month == "11" ) {
$monthWord = "November";
}else if( $month == "12" ) {
$monthWord = "December";
}else { }


echo "Trial Balance";
echo "<br>";
echo $monthWord." ".$year;

/*****************  OPD  ************************/


/*********** debit side *********************/
$opdCreditCard = (
$ro->transactionSummary_opd_department_debit_paid("LABORATORY","amountPaidFromCreditCard",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("MEDICINE","amountPaidFromCreditCard",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("SUPPLIES","amountPaidFromCreditCard",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("PROFESSIONAL FEE","amountPaidFromCreditCard",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("OR/DR/ER Fee","amountPaidFromCreditCard",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("ER FEE","amountPaidFromCreditCard",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("ECG","amountPaidFromCreditCard",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("SPIROMETRY","amountPaidFromCreditCard",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("XRAY","amountPaidFromCreditCard",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("ULTRASOUND","amountPaidFromCreditCard",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("CARDIAC MONITOR","amountPaidFromCreditCard",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("CTSCAN","amountPaidFromCreditCard",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("REHAB","amountPaidFromCreditCard",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("DERMATOLOGY","amountPaidFromCreditCard",$date,$date1)
);


$opdCash = (
$ro->transactionSummary_opd_department_debit_paid("LABORATORY","cashPaid",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("MEDICINE","cashPaid",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("SUPPLIES","cashPaid",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("PROFESSIONAL FEE","cashPaid",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("PROFESSIONAL FEE","doctorsPF",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("OR/DR/ER Fee","cashPaid",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("ER FEE","cashPaid",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("ECG","cashPaid",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("SPIROMETRY","cashPaid",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("XRAY","cashPaid",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("ULTRASOUND","cashPaid",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("CARDIAC MONITOR","cashPaid",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("CTSCAN","cashPaid",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("REHAB","cashPaid",$date,$date1) +
$ro->transactionSummary_opd_department_debit_paid("DERMATOLOGY","cashPaid",$date,$date1) 
);

$opdHMO = (
$ro->transactionSummary_opd_department_debit_covered("LABORATORY","HMO",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("MEDICINE","HMO",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("SUPPLIES","HMO",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("PROFESSIONAL FEE","HMO",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("OR/DR/ER Fee","HMO",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("ER FEE","HMO",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("ECG","HMO",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("SPIROMETRY","HMO",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("XRAY","HMO",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("ULTRASOUND","HMO",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("CARDIAC MONITOR","HMO",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("CTSCAN","HMO",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("REHAB","HMO",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("DERMATOLOGY","HMO",$date,$date1)
);

$opdCompany = (
$ro->transactionSummary_opd_department_debit_covered("LABORATORY","COMPANY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("MEDICINE","COMPANY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("SUPPLIES","COMPANY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("PROFESSIONAL FEE","COMPANY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("OR/DR/ER Fee","COMPANY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("ER FEE","COMPANY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("ECG","COMPANY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("SPIROMETRY","COMPANY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("XRAY","COMPANY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("ULTRASOUND","COMPANY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("CARDIAC MONITOR","COMPANY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("CTSCAN","COMPANY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("REHAB","COMPANY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_covered("DERMATOLOGY","COMPANY",$date,$date1)
);

$opdPersonalBalance = (
$ro->transactionSummary_opd_department_debit_personalBalance("LABORATORY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_personalBalance("MEDICINE",$date,$date1) +
$ro->transactionSummary_opd_department_debit_personalBalance("SUPPLIES",$date,$date1) +
$ro->transactionSummary_opd_department_debit_personalBalance("PROFESSIONAL FEE",$date,$date1) +
$ro->transactionSummary_opd_department_debit_personalBalance("OR/DR/ER Fee",$date,$date1) +
$ro->transactionSummary_opd_department_debit_personalBalance("ER FEE",$date,$date1) +
$ro->transactionSummary_opd_department_debit_personalBalance("ECG",$date,$date1) +
$ro->transactionSummary_opd_department_debit_personalBalance("SPIROMETRY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_personalBalance("XRAY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_personalBalance("ULTRASOUND",$date,$date1) +
$ro->transactionSummary_opd_department_debit_personalBalance("CARDIAC MONITOR",$date,$date1) +
$ro->transactionSummary_opd_department_debit_personalBalance("CTSCAN",$date,$date1) +
$ro->transactionSummary_opd_department_debit_personalBalance("REHAB",$date,$date1) +
$ro->transactionSummary_opd_department_debit_personalBalance("DERMATOLOGY",$date,$date1)
);

$opdDiscount  = (
$ro->transactionSummary_opd_department_debit_discount("LABORATORY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_discount("MEDICINE",$date,$date1) +
$ro->transactionSummary_opd_department_debit_discount("SUPPLIES",$date,$date1) +
$ro->transactionSummary_opd_department_debit_discount("PROFESSIONAL FEE",$date,$date1) +
$ro->transactionSummary_opd_department_debit_discount("OR/DR/ER Fee",$date,$date1) +
$ro->transactionSummary_opd_department_debit_discount("ER FEE",$date,$date1) +
$ro->transactionSummary_opd_department_debit_discount("ECG",$date,$date1) +
$ro->transactionSummary_opd_department_debit_discount("SPIROMETRY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_discount("XRAY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_discount("ULTRASOUND",$date,$date1) +
$ro->transactionSummary_opd_department_debit_discount("CARDIAC MONITOR",$date,$date1) +
$ro->transactionSummary_opd_department_debit_discount("CTSCAN",$date,$date1) +
$ro->transactionSummary_opd_department_debit_discount("REHAB",$date,$date1) +
$ro->transactionSummary_opd_department_debit_discount("DERMATOLOGY",$date,$date1)
);

/**********************debit side*********************************/



/*************************credit side***************************/

$opdPaidBalance = $ro->transactionSummary_paidBalance("OPD",$date,$date1);

$opdDoctor = (
$ro->transactionSummary_opd_department_debit_paid("PROFESSIONAL FEE","amountPaidFromCreditCard",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_paid("PROFESSIONAL FEE","cashPaid",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("PROFESSIONAL FEE","HMO",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("PROFESSIONAL FEE","COMPANY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_personalBalance("PROFESSIONAL FEE",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_discount("PROFESSIONAL FEE",$date,$date1)
);


$opdOR = (
$ro->transactionSummary_opd_department_debit_paid("OR/DR/ER Fee","amountPaidFromCreditCard",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_paid("OR/DR/ER Fee","cashPaid",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("OR/DR/ER Fee","HMO",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("OR/DR/ER Fee","COMPANY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_personalBalance("OR/DR/ER Fee",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_discount("OR/DR/ER Fee",$date,$date1)
);


$opdERFEE = (
$ro->transactionSummary_opd_department_debit_paid("ER FEE","amountPaidFromCreditCard",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_paid("ER FEE","cashPaid",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("ER FEE","HMO",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("ER FEE","COMPANY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_personalBalance("ER FEE",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_discount("ER FEE",$date,$date1)
);


$opdECG = (
$ro->transactionSummary_opd_department_debit_paid("ECG","amountPaidFromCreditCard",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_paid("ECG","cashPaid",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("ECG","HMO",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("ECG","COMPANY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_personalBalance("ECG",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_discount("ECG",$date,$date1)
);


$opdSpirometry = (
$ro->transactionSummary_opd_department_debit_paid("SPIROMETRY","amountPaidFromCreditCard",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_paid("SPIROMETRY","cashPaid",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("SPIROMETRY","HMO",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("SPIROMETRY","COMPANY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_personalBalance("SPIROMETRY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_discount("SPIROMETRY",$date,$date1)
);


$opdXray = (
$ro->transactionSummary_opd_department_debit_paid("XRAY","amountPaidFromCreditCard",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_paid("XRAY","cashPaid",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("XRAY","HMO",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("XRAY","COMPANY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_personalBalance("XRAY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_discount("XRAY",$date,$date1)
);


$opdUltrasound = (
$ro->transactionSummary_opd_department_debit_paid("ULTRASOUND","amountPaidFromCreditCard",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_paid("ULTRASOUND","cashPaid",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("ULTRASOUND","HMO",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("ULTRASOUND","COMPANY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_personalBalance("ULTRASOUND",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_discount("ULTRASOUND",$date,$date1)
);


$opdCardiacMonitor = (
$ro->transactionSummary_opd_department_debit_paid("CARDIAC MONITOR","amountPaidFromCreditCard",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_paid("CARDIAC MONITOR","cashPaid",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("CARDIAC MONITOR","HMO",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("CARDIAC MONITOR","COMPANY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_personalBalance("CARDIAC MONITOR",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_discount("CARDIAC MONITOR",$date,$date1)
);

$opdCTSCAN = (
$ro->transactionSummary_opd_department_debit_paid("CTSCAN","amountPaidFromCreditCard",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_paid("CTSCAN","cashPaid",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("CTSCAN","HMO",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("CTSCAN","COMPANY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_personalBalance("ULTRASOUND",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_discount("CTSCAN",$date,$date1)
);




$opdLaboratory = (
$ro->transactionSummary_opd_department_debit_paid("LABORATORY","amountPaidFromCreditCard",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_paid("LABORATORY","cashPaid",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("LABORATORY","HMO",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("LABORATORY","COMPANY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_personalBalance("LABORATORY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_discount("LABORATORY",$date,$date1)
);


$opdMedicine = (
$ro->transactionSummary_opd_department_debit_paid("MEDICINE","amountPaidFromCreditCard",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_paid("MEDICINE","cashPaid",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("MEDICINE","HMO",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("MEDICINE","COMPANY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_personalBalance("MEDICINE",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_discount("MEDICINE",$date,$date1)
);

$opdSupplies = (
$ro->transactionSummary_opd_department_debit_paid("SUPPLIES","amountPaidFromCreditCard",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_paid("SUPPLIES","cashPaid",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("SUPPLIES","HMO",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("SUPPLIES","COMPANY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_personalBalance("SUPPLIES",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_discount("SUPPLIES",$date,$date1)
);


$opdPT = (
$ro->transactionSummary_opd_department_debit_paid("REHAB","amountPaidFromCreditCard",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_paid("REHAB","cashPaid",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("REHAB","HMO",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("REHAB","COMPANY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_personalBalance("REHAB",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_discount("REHAB",$date,$date1)
);

$opdDerma = (
$ro->transactionSummary_opd_department_debit_paid("DERMATOLOGY","amountPaidFromCreditCard",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_paid("DERMATOLOGY","cashPaid",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("DERMATOLOGY","HMO",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_covered("DERMATOLOGY","COMPANY",$date,$date1) +
$ro->transactionSummary_opd_department_debit_personalBalance("DERMATOLOGY",$date,$date1) + 
$ro->transactionSummary_opd_department_debit_discount("DERMATOLOGY",$date,$date1)
);

$opdPayableMD = ( $ro->transactionSummary_opd_department_debit_paid("PROFESSIONAL FEE","doctorsPF",$date,$date1) );

/************************credit side*****************************/


/*****************  OPD  ************************/


/***************************************************************************/

/*************** IPD *****************************/


/************* debit side *********************/

$deposit = ( $ro->transactionSummary_ipd_department_debit_deposit($date,$date1) );

$ipdCreditCard = (
$ro->transactionSummary_ipd_department_debit("Credit Card",$date,$date1) +
$ro->transactionSummary_paidBalance_paymentMode("IPD","Credit Card",$date,$date1)
);

$ipdCash = (
$ro->transactionSummary_ipd_department_debit("Cash",$date,$date1) +
$ro->transactionSummary_paidBalance_paymentMode("IPD","Cash",$date,$date1) +
$deposit
);

$ipdHMO = (
$ro->transactionSummary_ipd_department_debit_company("HMO",$date,$date1)
);

$ipdCompany = (
$ro->transactionSummary_ipd_department_debit_company("COMPANY",$date,$date1)
);

$ipdPhilHealth = (
$ro->transactionSummary_ipd_department_debit_phic($date,$date1)
);

$ipdPersonalBalance = (
$ro->transactionSummary_ipd_department_debit_patientBalance($date,$date1)
);

$ipdPaidBalance = (
$ro->transactionSummary_paidBalance("IPD",$date,$date1)
);

$ipdDoctor = (
$ro->transactionSummary_ipd_department_credit("PROFESSIONAL FEE",$date,$date1)
);

$ipdOR = (
$ro->transactionSummary_ipd_department_credit("OR/DR/ER Fee",$date,$date1)
);

$ipdRoom = (
$ro->transactionSummary_ipd_department_credit("Room and Board",$date,$date1)
);

$ipdECG = (
$ro->transactionSummary_ipd_department_credit("ECG",$date,$date1)
);

$ipdPT = (
$ro->transactionSummary_ipd_department_credit("REHAB",$date,$date1)
);

$ipdXRAY = (
$ro->transactionSummary_ipd_department_credit("XRAY",$date,$date1)
);

$ipdUltrasound = (
$ro->transactionSummary_ipd_department_credit("ULTRASOUND",$date,$date1)
);

$ipdCtScan = (
$ro->transactionSummary_ipd_department_credit("CTSCAN",$date,$date1)
);

$ipdLaboratory = (
$ro->transactionSummary_ipd_department_credit("LABORATORY",$date,$date1)
);

$ipdMedicine = (
$ro->transactionSummary_ipd_department_inventory_credit("MEDICINE",$date,$date1)
);

$ipdSupplies = (
$ro->transactionSummary_ipd_department_inventory_credit("SUPPLIES",$date,$date1)
);

$ipdERFEE = (
$ro->transactionSummary_ipd_department_credit("ER FEE",$date,$date1)
);

$ipdCardiacMonitor = (
$ro->transactionSummary_ipd_department_credit("CARDIAC MONITOR",$date,$date1)
);

$ipdMisc = (
$ro->transactionSummary_ipd_department_credit("MISCELLANEOUS",$date,$date1)
);

$ipdDiscount = (
$ro->transactionSummary_ipd_department_debit_discount($date,$date1)
);

/************ debit side **********************/


/*************** IPD *****************************/



/*****************TOTAL DR/CR*********************/

$totalDR = (
$opdCreditCard +
$opdCash +
$opdHMO +
$opdCompany +
$opdPersonalBalance +
$opdDiscount +

$ipdCreditCard +
$ipdCash +
$ipdHMO +
$ipdCompany +
$ipdPhilHealth +
$ipdPersonalBalance +
$ipdDiscount
);

$totalCR = (
$opdPaidBalance +
$opdDoctor +
$opdOR +
$opdERFEE +
$opdECG +
$opdSpirometry +
$opdXray +
$opdUltrasound +
$opdCardiacMonitor +
$opdCTSCAN +
$opdLaboratory +
$opdMedicine +
$opdSupplies +
$opdPT +
$opdDerma +
$opdPayableMD +

$ipdPaidBalance +
$ipdDoctor +
$ipdOR +
$ipdRoom +
$ipdECG +
$ipdPT +
$ipdXRAY +
$ipdUltrasound +
$ipdCtScan +
$ipdLaboratory +
$ipdMedicine +
$ipdSupplies +
$ipdERFEE +
$ipdCardiacMonitor +
$ipdMisc +
$deposit
);

/*****************TOTAL DR/CR*********************/


echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }
</style>";


echo "<Br><Br>";
echo "<table border=0 width='70%'>";
echo "<tr class='table_header'>";
echo "<th>Narration</th>";
echo "<th>Debit</th>";
echo "<th>Credit</th>";
echo "</tr>";

echo "</tr>";
echo "<Td>OPD CREDIT CARD</td>";
echo "<td>".number_format($opdCreditCard,2)."</td>";
echo "<td></td>";
echo "</tr>";

echo "</tr>";
echo "<Td>OPD CASH</td>";
echo "<td>".number_format($opdCash,2)."</td>";
echo "<td></td>";
echo "</tr>";

echo "</tr>";
echo "<Td>OPD A/R-HMO</td>";
echo "<td>".number_format($opdHMO,2)."</td>";
echo "<td></td>";
echo "</tr>";

echo "</tr>";
echo "<Td>OPD A/R-COMPANY</td>";
echo "<td>".number_format($opdCompany,2)."</td>";
echo "<td></td>";
echo "</tr>";

echo "</tr>";
echo "<Td>OPD A/R-OPD(PERSONAL)</td>";
echo "<td>".number_format($opdPersonalBalance,2)."</td>";
echo "<td></td>";
echo "</tr>";

echo "</tr>";
echo "<Td>OPD Revenue Discount</td>";
echo "<td>".number_format($opdDiscount,2)."</td>";
echo "<td></td>";
echo "</tr>";

echo "<tr>";
echo "<td>OPD A/R PAID</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($opdPaidBalance,2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>OPD CLINIC REVENUE</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($opdDoctor,2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>OPD OPERATING ROOM</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($opdOR,2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>OPD ER FEE</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($opdERFEE,2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>OPD ECG</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($opdECG,2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>OPD SPYROMETRY</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($opdSpirometry,2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>OPD RADIOLOGY</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($opdXray,2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>OPD ULTRASOUND</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($opdUltrasound,2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>OPD CARDIAC MONITOR</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($opdCardiacMonitor,2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>OPD CTSCAN</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($opdCTSCAN,2)."</td>";
echo "</tr>";


echo "<tr>";
echo "<td>OPD LABORATORY</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($opdLaboratory,2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>OPD PHARMACY</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($opdMedicine,2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>OPD SUPPLIES & OTHERS</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($opdSupplies,2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>OPD PHYSICAL THERAPY</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($opdPT,2)."</td>";
echo "</tr>";


echo "<tr>";
echo "<td>OPD DERMA</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($opdDerma,2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>OPD ACCOUNTS PAYABLE-MD</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($opdPayableMD,2)."</td>";
echo "</tr>";


echo "<tr>";
echo "<td>IPD CREDIT CARD</td>";
echo "<td>".number_format($ipdCreditCard,2)."</td>";
echo "<td align='right'></td>";
echo "</tr>";

echo "<tr>";
echo "<td>IPD CASH</td>";
echo "<td>".number_format($ipdCash,2)."</td>";
echo "<td align='right'></td>";
echo "</tr>";

echo "<tr>";
echo "<td>IPD A/R HMO</td>";
echo "<td>".number_format($ipdHMO,2)."</td>";
echo "<td align='right'></td>";
echo "</tr>";

echo "<tr>";
echo "<td>IPD A/R COMPANY</td>";
echo "<td>".number_format($ipdCompany,2)."</td>";
echo "<td align='right'></td>";
echo "</tr>";

echo "<tr>";
echo "<td>IPD A/R PHILHEALTH</td>";
echo "<td>".number_format($ipdPhilHealth,2)."</td>";
echo "<td align='right'></td>";
echo "</tr>";

echo "<tr>";
echo "<td>IPD A/R IN PT(PERSONAL)</td>";
echo "<td>".number_format($ipdPersonalBalance,2)."</td>";
echo "<td align='right'></td>";
echo "</tr>";

echo "<tr>";
echo "<td>IPD A/R IN PT-PAID</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($ipdPaidBalance,2)."</td>";
echo "</tr>";


echo "<tr>";
echo "<td>IPD CLINIC REVENUE</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($ipdDoctor,2)."</td>";
echo "</tr>";


echo "<tr>";
echo "<td>IPD OPERATING ROOM</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($ipdOR,2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>IPD ROOM</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($ipdRoom,2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>IPD ECG</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($ipdECG,2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>IPD Physical Therapy</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($ipdPT,2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>IPD XRAY</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($ipdXRAY,2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>IPD ULTRASOUND</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($ipdUltrasound,2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>IPD CT-SCAN</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($ipdCtScan,2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>IPD LABORATORY</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($ipdLaboratory,2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>IPD MEDICINE</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($ipdMedicine,2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>IPD SUPPLIES & OTHERS</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($ipdSupplies,2)."</td>";
echo "</tr>";


echo "<tr>";
echo "<td>IPD ER FEE</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($ipdERFEE,2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>IPD CARDIAC MONITOR</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($ipdCardiacMonitor,2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>IPD MISCELLANEOUS</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($ipdMisc,2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>IPD DEPOSIT</td>";
echo "<td></td>";
echo "<td align='right'>".number_format($deposit,2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>IPD REVENUE DISCOUNT</td>";
echo "<td>".number_format($ipdDiscount,2)."</td>";
echo "<td align='right'></td>";
echo "</tr>";


echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td align='left'><b>".number_format($totalDR,2)."</b></td>";
echo "<td align='right'><b>".number_format($totalCR,2)."</b></td>";
echo "</tr>";


$ro->coconutTableStop();

?>
