<?php
include("../../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$show = $_GET['show'];
$chargesCode = $_GET['chargesCode'];
$showdate = $_GET['showdate'];

$ro = new database2();
$ro->getPatientProfile($registrationNo);
$ro->soap_setter($registrationNo);
?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<script type="text/javascript">
function printF(printData)
{
	var a = window.open ('',  '',"status=1,scrollbars=1, width=auto,height=auto");
	a.document.write(document.getElementById(printData).innerHTML.replace(/<a\/?[^>]+>/gi, ''));
	a.document.close();
	a.focus();
	a.print();
	a.close();
}
</script>
<a href="#" onClick="printF('printData')" style="text-decoration:none; color:black;">PRINT</a>
<div id='printData'>

<?php


$medicineTotal=0;
$suppliesTotal=0;
$laboratoryTotal=0;
$ultrasoundTotal=0;
$xrayTotal=0;
$ecgTotal=0;
$miscellaneousTotal=0;
$orTotal=0;
$erFeeTotal=0;
$cardiacTotal=0;
$roomTotal=0;
$pfTotal=0;
$ctscanTotal=0;
$spirometryTotal=0;
$rehabTotal=0;
$dermaTotal=0;
$ptTotal=0;
$otTotal=0;
$othersTotal=0;

$medicineCompany=0;
$suppliesCompany=0;
$laboratoryCompany=0;
$ultrasoundCompany=0;
$xrayCompany=0;
$ecgCompany=0;
$miscellaneousCompany=0;
$orCompany=0;
$erFeeCompany=0;
$cardiacCompany=0;
$roomCompany=0;
$pfCompany=0;
$ctscanCompany=0;
$spirometryCompany=0;
$rehabCompany=0;
$dermaCompany=0;
$ptCompany=0;
$otCompany=0;
$othersCompany=0;

$medicineCash=0;
$suppliesCash=0;
$laboratoryCash=0;
$ultrasoundCash=0;
$xrayCash=0;
$ecgCash=0;
$miscellaneousCash=0;
$orCash=0;
$erFeeCash=0;
$cardiacCash=0;
$roomCash=0;
$pfCash=0;
$ctscanCash=0;
$spirometryCash=0;
$rehabCash=0;
$dermaCash=0;
$ptCash=0;
$otCash=0;
$othersCash=0;


echo "<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}
.doubleUnderline {
    text-decoration:underline;
    border-bottom: 2px solid #000;
    border-top: 2px solid #000;
    font-size: 16px;
}

.button1 {font-family: Arial;font-size: 10px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #FFFFFF;}
</style>";


$admdate=$ro->selectNow("registrationDetails","dateRegistered","registrationNo",$registrationNo);
$admtime=$ro->selectNow("registrationDetails","timeRegistered","registrationNo",$registrationNo);
$admdatestr=strtotime($admdate);
$admdatefmt=date("M d, Y",$admdatestr);
$manualPatientNo=$ro->selectNow("registrationDetails","manual_patientNo","registrationNo",$registrationNo);
echo "<center><img src='ProtacioHeader.png' height='10%' width='100%' /></center>";

echo "<br><center><div style='border:0px solid #000000; width:auto; height:auto; border-color:black black black black;'>";
//echo "<font size=4><b>".$ro->getReportInformation("hmoSOA_name")."</b></font><br>";
//echo "<font size=2>".$ro->getReportInformation("hmoSOA_address")."</font><br>";
//echo "<font size=2>".$ro->getRegistrationDetails_branch()."</font><br>";
echo "<table width='100%' border=0>";
echo "<tr>";
echo "<td><font class='labelz'><b>Name:</b></font></td><td><font size=2>".$ro->getPatientRecord_completeName()."</font></td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
echo "<Td><font class='labelz'><b>Patient ID#:</b></font></td>";
echo "<td><font size=2>".$manualPatientNo."</td>";
echo "</tr>";
echo "<tr>";
echo "<Td><font class='labelz'><B>Age:</b></td>";
echo "<Td><font size=2>".$ro->getPatientRecord_age()."</font></td>";
echo "<Td>&nbsp;</td>";
echo "<td><font class='labelz'><b>Senior:</b></font></td>";
echo "<td><font size=2>".$ro->getPatientRecord_senior()."</font></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'><b>Date of Addmission:</b></font></td><td><font size=2>".$admdatefmt." - ".$admtime."&nbsp;&nbsp;&nbsp;</font></td>";
echo "<Td>&nbsp;</td>";
$disdate=$ro->selectNow("registrationDetails","dateUnregistered","registrationNo",$registrationNo);
$disdatestr=strtotime($disdate);
$disdatefmt=date("M d, Y");

if($showdate==1){
if($disdate==''){
echo "<td><font class='labelz'><b>Discharged Date:</b></font></td><td><a href='manualdate.php?registrationNo=$registrationNo&username=$username&show=$show&chargesCode=$chargesCode&showdate=$showdate'><font size=2 color=black>".date("M d, Y")."</font></a></td>";
}else{
echo "<td><font class='labelz'><b>Discharge Date:</b></font></td><td><a href='manualdate.php?registrationNo=$registrationNo&username=$username&show=$show&chargesCode=$chargesCode&showdate=$showdate'><font size=2 color=black>".$ro->formatDate($disdate)."</font></a></td>";
}
}
else if($showdate==2){
$setdate=$ro->selectNow("setdatetime","setdate","registrationNo",$registrationNo);
$setdatestr=strtotime($setdate);
$setdatefmt=date("M d, Y",$setdatestr);

echo "<td><font class='labelz'><b>Discharge Date:</b></font></td><td><a href='manualdate.php?registrationNo=$registrationNo&username=$username&show=$show&chargesCode=$chargesCode&showdate=$showdate'><font size=2 color=black>".$setdatefmt."</font></a></td>";
}
else{
echo "<td><font class='labelz'><b>Discharge Date:</b></font></td><td><a href='manualdate.php?registrationNo=$registrationNo&username=$username&show=$show&chargesCode=$chargesCode&showdate=$showdate'><font size=2 color=black>".date("M d, Y")."</font></a></td>";
}

echo "</tr>";
echo "</table>";


/*
echo "<table width='100%' border=0>";
echo "<tr>";
echo "<td><div align='left'>";
echo "<table border=0>";
echo "<tr>";
echo "<td><font class='labelz'><b>Date of Addmission:</b></font></td><td><font size=2>".$admdate." ".$admtime."&nbsp;&nbsp;&nbsp;</font></td>";
echo "</tr>";
echo "</table>";
echo "</div></td>";
echo "<td><div align='right'>";
echo "<table border=0>";
echo "<tr>";
echo "<td><font class='labelz'><b>Discharge Date:</b></font></td><td><font size=2>".date("M-d-Y")."</font></td>";
echo "</tr>";
echo "</table>";
echo "</div></td>";
echo "</tr>";
echo "</table>";
*/


echo "<table width='100%' border=0>";
echo "<tr>";
echo "<Td><font class='labelz'><b>Company:</b></font></td>";
echo "<td><font size=2>".$ro->getRegistrationDetails_company()."</font></tD>";
echo "<td><font class='labelz'><b>Diagnosis:</font></font></td>";
echo "<tD><font class='labelz'>".$ro->soap_assessmentz()." &nbsp;&nbsp; ".$ro->selectNow("registrationDetails","finalDiagnosis","registrationNo",$registrationNo)."</font></tD>";
echo "</tr>";
echo "</table>";
echo "<hr>";

echo "".$ro->checkAllReturns_notification($registrationNo)."<br>".$ro->checkForDispense_notification($registrationNo);

echo "<Table WIDTH='100%' border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo  "<th align='left'>&nbsp;<font class='heading'><b>DATE</b></font>&nbsp;</th>";
//echo  "<th>&nbsp;<font class='heading'><b>Ref#</b></font>&nbsp;</th>";
echo "<th align='left' width='30%'>&nbsp;<font class='heading'><b>Particulars</b></font>&nbsp;</th>";
echo "<th align='left'>&nbsp;<font class='heading'><b>QTY</b></font>&nbsp;</th>";
echo "<th align='left'>&nbsp;<font class='heading'><b>Price</b></font>&nbsp;</th>";
echo "<th align='left'>&nbsp;<font class='heading'><b>Total</b></font>&nbsp;</th>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

/*********************MEDICINE*********************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"MEDICINE") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>Medicine</b></font></td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$ro->detailedTotalOnly_inventory($registrationNo,"MEDICINE",$chargesCode,$username,$show,$showdate);


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>".number_format(trim($ro->detailedTotalOnly_inventory_totalCharges()),2)."</b></font></td>";
echo "</tr>";
$medicineTotal += $ro->detailedTotalOnly_inventory_totalCharges();
$medicineCompany += $ro->detailedTotalOnly_inventory_company();
$medicineCash += $ro->detailedTotalOnly_inventory_cash();
}else { }
/********************MEDICINE************************/


/*********************SUPPLIES*********************/
if( $ro->checkIfTitleExist_newDetailed($registrationNo,"SUPPLIES") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>Supplies</b></font></td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$ro->detailedTotalOnly_inventory($registrationNo,"SUPPLIES",$chargesCode,$username,$show,$showdate);
$ro->detailedTotalOnly($registrationNo,"CARDIAC MONITOR",$chargesCode,$username,$show,$showdate);

echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>".number_format(trim( ($ro->detailedTotalOnly_inventory_totalCharges() + $ro->detailedTotalOnly_total())),2)."</b></font></td>";
echo "</tr>";
$suppliesTotal += $ro->detailedTotalOnly_inventory_totalCharges();
$suppliesCompany += $ro->detailedTotalOnly_inventory_company();
$suppliesCash += $ro->detailedTotalOnly_inventory_cash();
$cardiacTotal += $ro->detailedTotalOnly_total();
$cardiacCompany += $ro->detailedTotalOnly_company();
$cardiacCash += $ro->detailedTotalOnly_cash();
}else { }
/************************SUPPLIES****************************/


/*****************LABORATORY*********************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"LABORATORY") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>Laboratory</b></font></td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$ro->detailedTotalOnly($registrationNo,"LABORATORY",$chargesCode,$username,$show,$showdate);


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>".number_format(trim($ro->detailedTotalOnly_total()),2)."</b></font></td>";
echo "</tr>";
$laboratoryTotal += $ro->detailedTotalOnly_total();
$laboratoryCompany += $ro->detailedTotalOnly_company();
$laboratoryCash += $ro->detailedTotalOnly_cash();
}else { }
/******************LABORATORY**********************/


/*****************ULTRASOUND************************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"ULTRASOUND") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>ULTRASOUND</b></font></td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$ro->detailedTotalOnly($registrationNo,"ULTRASOUND",$chargesCode,$username,$show,$showdate);


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>".number_format(trim($ro->detailedTotalOnly_total()),2)."</b></font></td>";
echo "</tr>";
$ultrasoundTotal += $ro->detailedTotalOnly_total();
$ultrasoundCompany += $ro->detailedTotalOnly_company();
$ultrasoundCash += $ro->detailedTotalOnly_cash();
}else { }
/********************ULTRASOUND**********************/


/*****************XRAY************************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"XRAY") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>XRAY</b></font></td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$ro->detailedTotalOnly($registrationNo,"XRAY",$chargesCode,$username,$show,$showdate);


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>".number_format(trim($ro->detailedTotalOnly_total()),2)."</b></font></td>";
echo "</tr>";
$xrayTotal += $ro->detailedTotalOnly_total();
$xrayCompany += $ro->detailedTotalOnly_company();
$xrayCash += $ro->detailedTotalOnly_cash();
}else { }



/*****************ECG************************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"ECG") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>ECG</b></font></td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$ro->detailedTotalOnly($registrationNo,"ECG",$chargesCode,$username,$show,$showdate);


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>".number_format(trim($ro->detailedTotalOnly_total()),2)."</b></font></td>";
echo "</tr>";
$ecgTotal += $ro->detailedTotalOnly_total();
$ecgCompany += $ro->detailedTotalOnly_company();
$ecgCash += $ro->detailedTotalOnly_cash();
}else { }


/*****************CTSCAN************************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"CTSCAN") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>CTSCAN</b></font></td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$ro->detailedTotalOnly($registrationNo,"CTSCAN",$chargesCode,$username,$show,$showdate);


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>".number_format(trim($ro->detailedTotalOnly_total()),2)."</b></font></td>";
echo "</tr>";
$ctscanTotal += $ro->detailedTotalOnly_total();
$ctscanCompany += $ro->detailedTotalOnly_company();
$ctscanCash += $ro->detailedTotalOnly_cash();
}else { }


/********************ULTRASOUND**********************/



/******************MISCELLANEOUS*********************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"MISCELLANEOUS") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>Miscellaneous</b></font></td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$ro->detailedTotalOnly($registrationNo,"MISCELLANEOUS",$chargesCode,$username,$show,$showdate);


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>".number_format(trim($ro->detailedTotalOnly_total()),2)."</b></font></td>";
echo "</tr>";
$miscellaneousTotal += $ro->detailedTotalOnly_total();
$miscellaneousCompany += $ro->detailedTotalOnly_company();
$miscellaneousCash += $ro->detailedTotalOnly_cash();
}else { }

/***************MISCELLANEOUS*********************/


/*******************OR/DR/ER FEE************************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"OR/DR/ER Fee") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>OR/DR/ER Fee</b></font></td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$ro->detailedTotalOnly($registrationNo,"OR/DR/ER FEE",$chargesCode,$username,$show,$showdate);


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>".number_format(trim($ro->detailedTotalOnly_total()),2)."</b></font></td>";
echo "</tr>";
$orTotal += $ro->detailedTotalOnly_total();
$orCompany += $ro->detailedTotalOnly_company();
$orCash += $ro->detailedTotalOnly_cash();
}else { }

/*******************OR/DR/ER FEE************************/



/*******************ER FEE************************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"ER FEE") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>ER FEE</b></font></td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$ro->detailedTotalOnly($registrationNo,"ER FEE",$chargesCode,$username,$show,$showdate);


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>".number_format(trim($ro->detailedTotalOnly_total()),2)."</b></font></td>";
echo "</tr>";
$erFeeTotal += $ro->detailedTotalOnly_total();
$erFeeCompany += $ro->detailedTotalOnly_company();
$erFeeCash += $ro->detailedTotalOnly_cash();
}else { }


/*******************ER FEE************************/


/*******************OR/DR/ER FEE************************/


/*******************SPIROMETRY************************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"SPIROMETRY") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>SPIROMETRY</b></font></td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$ro->detailedTotalOnly($registrationNo,"SPIROMETRY",$chargesCode,$username,$show,$showdate);


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>".number_format(trim($ro->detailedTotalOnly_total()),2)."</b></font></td>";
echo "</tr>";
$spirometryTotal += $ro->detailedTotalOnly_total();
$spirometryCompany += $ro->detailedTotalOnly_company();
$spirometryCash += $ro->detailedTotalOnly_cash();
}else { }

/*******************SPIROMETRY************************/


/*******************REHAB************************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"REHAB") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>Physical Theraphy</b></font></td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$ro->detailedTotalOnly($registrationNo,"REHAB",$chargesCode,$username,$show,$showdate);


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>".number_format(trim($ro->detailedTotalOnly_total()),2)."</b></font></td>";
echo "</tr>";
$rehabTotal += $ro->detailedTotalOnly_total();
$rehabCompany += $ro->detailedTotalOnly_company();
$rehabCash += $ro->detailedTotalOnly_cash();
}else { }

/*******************REHAB************************/



/*******************DERMA************************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"DERMA") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>Derma Charges</b></font></td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$ro->detailedTotalOnly($registrationNo,"DERMA",$chargesCode,$username,$show,$showdate);


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>".number_format($ro->detailedTotalOnly_total(),2)."</b></font></td>";
echo "</tr>";
$dermaTotal += $ro->detailedTotalOnly_total();
$dermaCompany += $ro->detailedTotalOnly_company();
$dermaCash += $ro->detailedTotalOnly_cash();
}else { }

/*******************DERMA************************/



/*******************PT************************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"PT") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>PT</b></font></td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$ro->detailedTotalOnly($registrationNo,"PT",$chargesCode,$username,$show,$showdate);


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>".number_format($ro->detailedTotalOnly_total(),2)."</b></font></td>";
echo "</tr>";
$ptTotal += $ro->detailedTotalOnly_total();
$ptCompany += $ro->detailedTotalOnly_company();
$ptCash += $ro->detailedTotalOnly_cash();
}else { }

/*******************PT************************/



/*******************OT************************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"OT") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>OT</b></font></td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$ro->detailedTotalOnly($registrationNo,"OT",$chargesCode,$username,$show,$showdate);


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>".number_format($ro->detailedTotalOnly_total(),2)."</b></font></td>";
echo "</tr>";
$otTotal += $ro->detailedTotalOnly_total();
$otCompany += $ro->detailedTotalOnly_company();
$otCash += $ro->detailedTotalOnly_cash();
}else { }

/*******************OT************************/




/*******************OTHERS************************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"OTHERS") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>OTHERS</b></font></td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$ro->detailedTotalOnly($registrationNo,"OTHERS",$chargesCode,$username,$show,$showdate);


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>".number_format($ro->detailedTotalOnly_total(),2)."</b></font></td>";
echo "</tr>";
$othersTotal += $ro->detailedTotalOnly_total();
$othersCompany += $ro->detailedTotalOnly_company();
$othersCash += $ro->detailedTotalOnly_cash();
}else { }

/*******************OTHERS************************/




/*******************ROOM********************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"Room and Board") ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>Room</b></font></td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$ro->detailedTotalOnly($registrationNo,"Room and Board",$chargesCode,$username,$show,$showdate);


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>".number_format(trim($ro->detailedTotalOnly_total()),2)."</b></font></td>";
echo "</tr>";
$roomTotal += $ro->detailedTotalOnly_total();
$roomCompany += $ro->detailedTotalOnly_company();
$roomCash += $ro->detailedTotalOnly_cash();
}else { }
/***************ROOM*********************/

$HBtotal = ( $medicineTotal + $suppliesTotal + $laboratoryTotal + $ultrasoundTotal + $xrayTotal + $miscellaneousTotal + $orTotal + $roomTotal + $ctscanTotal + $spirometryTotal + $rehabTotal + $ecgTotal + $cardiacTotal + $erFeeTotal + $dermaTotal + $ptTotal + $otTotal + $othersTotal );

echo "<tr>";
echo "<td colspan=2><font size=2><b>TOTAL HOSPITAL BILL</b></font></td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td></td>";
echo "<td></td>";
echo "<td>&nbsp;<font size=2><b>".number_format(trim($HBtotal),2)."</b></font></td>";
echo "</tr>";

echo "<tr>";
echo "<td></td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "</tr>";

/****************PF**********************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"PROFESSIONAL FEE") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>Professional Fee</b></font></td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$ro->detailedTotalOnly($registrationNo,"PROFESSIONAL FEE",$chargesCode,$username,$show,$showdate);



echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>".number_format(trim($ro->detailedTotalOnly_total()),2)."</b></font></td>";
echo "</tr>";
$pfTotal += $ro->detailedTotalOnly_total();
$pfCompany += $ro->detailedTotalOnly_company();
$pfCash += $ro->detailedTotalOnly_cash();
}else { }

/***********************PF***********************/




$total = ( $medicineTotal + $suppliesTotal + $laboratoryTotal + $ultrasoundTotal + $xrayTotal + $miscellaneousTotal + $orTotal + $roomTotal + $pfTotal + $ctscanTotal + $rehabTotal + $ecgTotal + $spirometryTotal + $erFeeTotal + $cardiacTotal + $dermaTotal + $ptTotal + $otTotal + $othersTotal);


$companyTotal = ( $medicineCompany + $suppliesCompany + $laboratoryCompany + $ultrasoundCompany + $xrayCompany + $miscellaneousCompany + $orCompany + $erFeeCompany + $roomCompany + $pfCompany + $ctscanCompany + $rehabCompany + $ecgCompany + $spirometryCompany + $cardiacCompany + $dermaCompany + $ptCompany + $otCompany + $othersCompany );

$cashTotal = ( $medicineCash + $suppliesCash + $laboratoryCash + $ultrasoundCash + $xrayCash + $miscellaneousCash + $orCash  + $roomCash + $pfCash + $ctscanCash + $rehabCash + $ecgCash + $spirometryCash + $erFeeCash + $cardiacCash + $dermaCash + $ptCash + $otCash + $othersCash );

/*echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td></td>";
echo "<td></td>";
echo "<td>&nbsp;<font size=2><b>".number_format($total,2)."</b></font></td>";
echo "</tr>";*/

$gtWithoutPHIC = ( $HBtotal );

echo "<tr>";
echo "<td>&nbsp;<font size=2><b>GT w/o PHIC</b></font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;".number_format(trim($gtWithoutPHIC + $pfTotal),2)."</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";


echo "<tr>";
echo "<td>&nbsp;<font size=2><b>PhilHealth</b></font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2><b>1st Case</b></font></td>";
echo "<td>&nbsp;<font size=2><b>2nd Case</b></font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";


$firstCase_hospitalBill = number_format(trim($ro->getTotal_No_pf("phic","",$registrationNo)),2);

$firstCase_professionalFee = number_format($ro->getTotal("phic","PROFESSIONAL FEE",$registrationNo),2);

$totalCaseRate = ($ro->getTotal_No_pf("phic","",$registrationNo) + $ro->getTotal("phic","PROFESSIONAL FEE",$registrationNo));

echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2><b>Hospital Bill</b></font></td>";
echo "<td>&nbsp;<font size=2>".$firstCase_hospitalBill."</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";


echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2><b>Professional Fee</b></font></td>";
echo "<td>&nbsp;<font size=2>".$firstCase_professionalFee."</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".number_format(trim($totalCaseRate),2)."</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";



echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2><b>".number_format(trim($total - $totalCaseRate),2)."</b></font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";


echo "<tr>";
echo "<td>&nbsp;<font size=2><b>DEPOSIT</b></font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$ro->detailedTotalOnly_deposit($registrationNo);

echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".number_format($ro->detailedTotalOnly_deposit_total(),2)."</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";



//take home meds
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>TAKE HOME MEDS</b></font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$ro->getTakeHomeMeds($registrationNo);

//take home meds
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";


$discount = ( $ro->selectNow("registrationDetails","discount","registrationNo",$registrationNo) );
$incrementalCost = $ro->selectNow("registrationDetails","incrementalCost","registrationNo",$registrationNo);
$excessPF = $ro->selectNow("registrationDetails","excessPF","registrationNo",$registrationNo);
$excessRoom = $ro->selectNow("registrationDetails","excessRoom","registrationNo",$registrationNo);
$PHICportion=$ro->selectNow("registrationDetails","PHICportion","registrationNo",$registrationNo);
$excessMaxBenefits = $ro->selectNow("registrationDetails","excessMaxBenefits","registrationNo",$registrationNo);
$hmoManualExcess = $ro->selectNow("registrationDetails","hmoManualExcess","registrationNo",$registrationNo);
$hmoManualExcessValue = $ro->selectNow("registrationDetails","hmoManualExcessValue","registrationNo",$registrationNo);

$excessTotal = ($excessPF + $excessRoom + $excessMaxBenefits + $hmoManualExcessValue);

if( $ro->selectNow("registrationDetails","Company","registrationNo",$registrationNo) == "" ) {
$outStandingBill = (( ($total - $totalCaseRate) - $ro->detailedTotalOnly_deposit_total()) + $ro->getTakeHomeMeds_total());
}else {
$outStandingBill = (( ($total - $totalCaseRate) ) + $ro->getTakeHomeMeds_total() );
}

//$outStandingBill = (($cashTotal - $ro->detailedTotalOnly_deposit_total()) + $ro->getTakeHomeMeds_total());

$outStandingBill_company = (($companyTotal)-($excessMaxBenefits+$excessPF+$excessRoom+$PHICportion+$hmoManualExcessValue));

echo "<tr>";
echo "<td>&nbsp;<font size=2><b>".$ro->selectNow("registrationDetails","discountType","registrationNo",$registrationNo)."</b></font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".$discount."</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";


echo "<tr>";
echo "<td>&nbsp;<font size=2><b>OUTSTANDING BILL</b></font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2 class='doubleUnderline'><b>&nbsp;&nbsp;&nbsp;".number_format(trim($outStandingBill - $discount),2)."</b></font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
if($chargesCode=='on'){
echo "<td><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/SOAoption/newSOA/detailedTotalOnly_update.php?registrationNo=$registrationNo&username=$username&show=try&chargesCode=off'><input type='button' name='Change' class='button1' value='+' /></a></td>";
}
else if($chargesCode=='off'){
echo "<td><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/SOAoption/newSOA/detailedTotalOnly_update.php?registrationNo=$registrationNo&username=$username&show=try&chargesCode=on'><input type='submit' name='Change' class='button1' value='-' /></a></td>";
}
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

if($chargesCode=='on'){
}
else if($chargesCode=='off'){

if( $ro->selectNow("registrationDetails","Company","registrationNo",$registrationNo) != "" ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>".$ro->selectNow("registrationDetails","Company","registrationNo",$registrationNo)."</b></font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2><b>".number_format(abs((($outStandingBill_company - $discount)) - $incrementalCost),2)."</b></font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";



echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";


echo "<tr>";
echo "<td>&nbsp;<font size=2><b>Patient To Pay</b></font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";




$ro->detailedTotalOnly_patientToPay($registrationNo);


if( $incrementalCost != "" ) {
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>Incremental Cost</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".number_format(trim($incrementalCost),2)."</font></td>";
echo "<td>&nbsp;<font size=2>".number_format(trim($incrementalCost),2)."</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
}else { }


if( $excessPF != "" ) {
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>Excess in PF</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".number_format($excessPF,2)."</font></td>";
echo "<td>&nbsp;<font size=2>".number_format($excessPF,2)."</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
}else { }

if( $excessRoom != "" ) {
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>Excess in Room and Board</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".number_format($excessRoom,2)."</font></td>";
echo "<td>&nbsp;<font size=2>".number_format($excessRoom,2)."</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
}else { }


if( $excessMaxBenefits != "" ) {

echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>Excess in Maximum Benefits</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".number_format($excessMaxBenefits,2)."</font></td>";
echo "<td>&nbsp;<font size=2>".number_format($excessMaxBenefits,2)."</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

}else { }


if( $PHICportion != "" ) {

echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>PhilHealth</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".number_format($PHICportion,2)."</font></td>";
echo "<td>&nbsp;<font size=2>".number_format($PHICportion,2)."</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

}else { }

if( $hmoManualExcess != "" ) {

echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".$hmoManualExcess."</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".number_format($hmoManualExcessValue,2)."</font></td>";
echo "<td>&nbsp;<font size=2>".number_format($hmoManualExcessValue,2)."</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

}else { }

echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2><b>".number_format(trim(($ro->detailedTotalOnly_patientToPay_total() - $ro->detailedTotalOnly_deposit_total() + $incrementalCost + ($excessMaxBenefits+$excessPF+$excessRoom+$PHICportion+$hmoManualExcessValue))),2)."</b></font></td>";

//echo $ro->detailedTotalOnly_patientToPay_total();
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";


}else { }
}
echo "</table>";
echo "<br>";
echo "<br>";
//echo "<font size=2>Payment's</font>";
//$ro->getPaymentHistory_showUp($registrationNo);

$logusername=$ro->selectNow("registeredUser","completeName","username",$username);
echo "<br>

<Br>



<table width='100%' celspacing='0' cellpadding='0' border='0'>
  <tr>
    <td valign='top' width='50%'><div align='left'><table celspacing='0' cellpadding='0' border='0'>
      <tr>
        <td><div align='center'><u><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$logusername."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></u></div></td>
      </tr>
      <tr>
        <td><div align='center'><font size='2'><b>Billing Officer</b></font></div></td>
      </tr>
    </table></div></td>
    <td valign='top' width='50%'><div align='right'><table celspacing='0' cellpadding='0' border='0'>
      <tr>
        <td align='right'><font size='2'><b>Patient Representative</b></font></td>
        <td align='left'><font size='2'><b>&nbsp;&nbsp;:&nbsp;&nbsp;</b></font></td>
        <td align='left'><font size='2'><b><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></b></font></td>
      </tr>
      <tr>
        <td align='right'><font size='2'><b>Relation to Patient</b></font></td>
        <td align='left'><font size='2'><b>&nbsp;&nbsp;:&nbsp;&nbsp;</b></font></td>
        <td align='left'><font size='2'><b><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></b></font></td>
      </tr>
      <tr>
        <td align='right'><font size='2'><b>Contact No.</b></font></td>
        <td align='left'><font size='2'><b>&nbsp;&nbsp;:&nbsp;&nbsp;</b></font></td>
        <td align='left'><font size='2'><b><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></b></font></td>
      </tr>
    </table></div></td>
  </tr>
</table>


<Br>
";

if($showdate==1){
//echo "<font size=2>".date("M d, Y")."@".date("H:i:s")."</font>";
}
else if($showdate==2){
$setdate=$ro->selectNow("setdatetime","setdate","registrationNo",$registrationNo);
$setdatestr=strtotime($setdate);
$setdatefmt=date("M d, Y",$setdatestr);
$settime=$ro->selectNow("setdatetime","settime","registrationNo",$registrationNo);

//echo "<font size=2>".$setdatefmt."@".$settime."</font>";
}

echo "<br>";
$ro->coconutBoxStop();
echo "</div>";
