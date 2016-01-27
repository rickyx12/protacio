<?php
include("../../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$show = $_GET['show'];

$ro = new database2();
$ro->getPatientProfile($registrationNo);
//$ro->soap_setter($registrationNo);
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

$medicine=0;
$supplies=0;
$laboratory=0;
$radiology=0;
$ultrasound=0;
$ctscan=0;
$xray=0;
$miscellaneous=0;
$ecg=0;
$or_dr=0;
$pt=0;
$ot=0;
$st=0;
$endoscopy=0;
$pf=0;
$erFee=0;
$others=0;
$cardiacMonitor=0;
$total=0;



$medicine_pd=0;
$supplies_pd=0;
$laboratory_pd=0;
$radiology_pd=0;
$ultrasound_pd=0;
$ctscan_pd=0;
$xray_pd=0;
$miscellaneous_pd=0;
$ecg_pd=0;
$or_dr_pd=0;
$pt_pd=0;
$ot_pd=0;
$st_pd=0;
$endoscopy_pd=0;
$pf_pd=0;
$erFee_pd=0;
$others_pd=0;
$cardiacMonitor_pd=0;
$total_pd=0;


$medicine_disc=0;
$supplies_disc=0;
$laboratory_disc=0;
$radiology_disc=0;
$ultrasound_disc=0;
$ctscan_disc=0;
$xray_disc=0;
$miscellaneous_disc=0;
$ecg_disc=0;
$or_dr_disc=0;
$pt_disc=0;
$ot_disc=0;
$st_disc=0;
$endoscopy_disc=0;
$pf_disc=0;
$erFee_disc=0;
$others_disc=0;
$cardiacMonitor_disc=0;
$total_disc=0;


$medicine_unpaid=0;
$supplies_unpaid=0;
$laboratory_unpaid=0;
$radiology_unpaid=0;
$ultrasound_unpaid=0;
$ctscan_unpaid=0;
$xray_unpaid=0;
$miscellaneous_unpaid=0;
$ecg_unpaid=0;
$or_dr_unpaid=0;
$pt_unpaid=0;
$ot_unpaid=0;
$st_unpaid=0;
$endoscopy_unpaid=0;
$pf_unpaid=0;
$erFee_unpaid=0;
$others_unpaid=0;
$cardiacMonitor_unpaid=0;
$total_unpaid=0;

$medicine_phic=0;
$supplies_phic=0;
$laboratory_phic=0;
$radiology_phic=0;
$ultrasound_phic=0;
$ctscan_phic=0;
$xray_phic=0;
$miscellaneous_phic=0;
$ecg_phic=0;
$or_dr_phic=0;
$pt_phic=0;
$ot_phic=0;
$st_phic=0;
$endoscopy_phic=0;
$pf_phic=0;
$erFee_phic=0;
$others_phic=0;
$cardiacMonitor_phic=0;
$total_phic=0;



$medicine_hmo=0;
$supplies_hmo=0;
$laboratory_hmo=0;
$radiology_hmo=0;
$ultrasound_hmo=0;
$ctscan_hmo=0;
$xray_hmo=0;
$miscellaneous_hmo=0;
$ecg_hmo=0;
$or_dr_hmo=0;
$pt_hmo=0;
$ot_hmo=0;
$st_hmo=0;
$endoscopy_hmo=0;
$pf_hmo=0;
$erFee_hmo=0;
$others_hmo=0;
$cardiacMonitor_hmo=0;
$total_hmo=0;



echo "<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";


echo "<img src='ProtacioHeader.png' width='100%' height='10%'></center>";

echo "<br><center><div style='border:0px solid #000000; width:825px; height:auto; border-color:black black black black;'>";
//echo "<font size=4><b>".$ro->getReportInformation("hmoSOA_name")."</b></font><br>";
//echo "<font size=2>".$ro->getReportInformation("hmoSOA_address")."</font><br>";
//echo "<font size=2>".$ro->getRegistrationDetails_branch()."</font><br>";
echo "<table border=0>";
echo "<tr>";
echo "<td><font class='labelz'><b>Name:</b></font></td><td><font size=2>".$ro->getPatientRecord_completeName()."</font></td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
echo "<Td><font class='labelz'><b>Registration#:</b></font></td>";
echo "<td><font size=2>".$ro->getRegistrationDetails_registrationNo()."</td>";
echo "</tr>";
echo "<tr>";
echo "<Td><font class='labelz'><B>Age:</b></td>";
echo "<Td><font size=2>".$ro->getPatientRecord_age()." yrs Old</font></td>";
echo "<Td>&nbsp;</td>";
echo "<td><font class='labelz'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Senior:</b></font></td>";
echo "<td><font size=2>".$ro->getPatientRecord_senior()."</font></td>";
echo "</tr>";
echo "<tr>";
echo "<Td><font class='labelz'><b>Company:</b></font></td>";
echo "<td><font size=2>".$ro->getRegistrationDetails_company()."</font></tD>";
echo "<td><font class='labelz'>Diagnosis:</font></td>";
echo "<tD><font class='labelz'>".$ro->soap_assessmentz()." &nbsp;&nbsp; ".$ro->selectNow("registrationDetails","finalDiagnosis","registrationNo",$registrationNo)."</font></tD>";
echo "</tr>";
echo "</table>";
echo "<hr>";

echo "<Table border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo  "<th>&nbsp;<font class='heading'><b>DATE</b></font>&nbsp;</th>";
//echo  "<th>&nbsp;<font class='heading'><b>Ref#</b></font>&nbsp;</th>";
echo "<th width='30%'>&nbsp;<font class='heading'><b>Particulars</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>QTY</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>Price</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>Total</b></font>&nbsp;</th>";
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

if( $ro->checkIfTitleExist_newDetailed_opd($registrationNo,"MEDICINE") > 0 ) {
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

$ro->newDetailed_inventory($registrationNo,"MEDICINE");


echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
$medicine += $ro->newDetailed_inventory_total();
$medicine_pd += $ro->newDetailed_inventory_pd();
$medicine_disc += $ro->newDetailed_inventory_disc();
$medicine_unpaid += $ro->newDetailed_inventory_unpaid();
$medicine_phic += $ro->newDetailed_inventory_phic();
$medicine_hmo += $ro->newDetailed_inventory_hmo();
echo "<td><font size=2><b>".number_format($medicine,2)."</b></font></td>";
echo "</tr>";
}else { }
/********************MEDICINE************************/


/*********************SUPPLIES*********************/
if( $ro->checkIfTitleExist_newDetailed_opd($registrationNo,"SUPPLIES") > 0 ) {
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

$ro->newDetailed_inventory($registrationNo,"SUPPLIES");

echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
$supplies += $ro->newDetailed_inventory_total();
$supplies_pd += $ro->newDetailed_inventory_pd();
$supplies_disc += $ro->newDetailed_inventory_disc();
$supplies_unpaid += $ro->newDetailed_inventory_unpaid();
$supplies_phic += $ro->newDetailed_inventory_phic();
$supplies_hmo += $ro->newDetailed_inventory_hmo();
echo "<td><font size=2><b>".number_format($supplies,2)."</b></font></td>";
echo "</tr>";
}else { }
/************************SUPPLIES****************************/


/*****************LABORATORY*********************/

if( $ro->checkIfTitleExist_newDetailed_opd($registrationNo,"LABORATORY") > 0 ) {
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

$ro->newDetailed($registrationNo,"LABORATORY");


echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
$laboratory += $ro->newDetailed_total();
$laboratory_pd += $ro->newDetailed_pd();
$laboratory_disc += $ro->newDetailed_disc();
$laboratory_unpaid += $ro->newDetailed_unpaid();
$laboratory_phic += $ro->newDetailed_phic();
$laboratory_hmo += $ro->newDetailed_hmo();
echo "<td><font size=2><b>".number_format($laboratory,2)."</b></font></td>";
echo "</tr>";
}else { }
/******************LABORATORY**********************/


/*****************ULTRASOUND************************/

if( $ro->checkIfTitleExist_newDetailed_opd($registrationNo,"ULTRASOUND") > 0 ) {
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

$ro->newDetailed($registrationNo,"ULTRASOUND");


echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
$ultrasound += $ro->newDetailed_total();
$ultrasound_pd += $ro->newDetailed_pd();
$ultrasound_disc += $ro->newDetailed_disc();
$ultrasound_unpaid += $ro->newDetailed_unpaid();
$ultrasound_phic += $ro->newDetailed_phic();
$ultrasound_hmo += $ro->newDetailed_hmo();
echo "<td><font size=2><b>".number_format($ultrasound,2)."</b></font></td>";
echo "</tr>";
}else { }
/********************ULTRASOUND**********************/




/*****************CTSCAN************************/

if( $ro->checkIfTitleExist_newDetailed_opd($registrationNo,"CTSCAN") > 0 ) {
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

$ro->newDetailed($registrationNo,"CTSCAN");


echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
$ctscan += $ro->newDetailed_total();
$ctscan_pd += $ro->newDetailed_pd();
$ctscan_disc += $ro->newDetailed_disc();
$ctscan_unpaid += $ro->newDetailed_unpaid();
$ctscan_phic += $ro->newDetailed_phic();
$ctscan_hmo += $ro->newDetailed_hmo();
echo "<td><font size=2><b>".number_format($ctscan,2)."</b></font></td>";
echo "</tr>";
}else { }
/********************CTSCAN**********************/





/*****************XRAY************************/

if( $ro->checkIfTitleExist_newDetailed_opd($registrationNo,"XRAY") > 0 ) {
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

$ro->newDetailed($registrationNo,"XRAY");


echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
$xray += $ro->newDetailed_total();
$xray_pd += $ro->newDetailed_pd();
$xray_disc += $ro->newDetailed_disc();
$xray_unpaid += $ro->newDetailed_unpaid();
$xray_phic += $ro->newDetailed_phic();
$xray_hmo += $ro->newDetailed_hmo();
echo "<td><font size=2><b>".number_format($xray,2)."</b></font></td>";
echo "</tr>";
}else { }
/********************XRAY**********************/



/******************MISCELLANEOUS*********************/

if( $ro->checkIfTitleExist_newDetailed_opd($registrationNo,"MISCELLANEOUS") > 0 ) {
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

$ro->newDetailed($registrationNo,"MISCELLANEOUS");


echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
$miscellaneous += $ro->newDetailed_total();
$miscellaneous_pd += $ro->newDetailed_pd();
$miscellaneous_disc += $ro->newDetailed_disc();
$miscellaneous_unpaid += $ro->newDetailed_unpaid();
$miscellaneous_phic += $ro->newDetailed_phic();
$miscellaneous_hmo += $ro->newDetailed_hmo();
echo "<td><font size=2><b>".number_format($miscellaneous,2)."</b></font></td>";
echo "</tr>";
}else { }

/***************MISCELLANEOUS*********************/



/****************ECG************************/

if( $ro->checkIfTitleExist_newDetailed_opd($registrationNo,"ECG") > 0 ) {
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

$ro->newDetailed($registrationNo,"ECG");


echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
$ecg += $ro->newDetailed_total();
$ecg_pd += $ro->newDetailed_pd();
$ecg_disc += $ro->newDetailed_disc();
$ecg_unpaid += $ro->newDetailed_unpaid();
$ecg_phic += $ro->newDetailed_phic();
$ecg_hmo += $ro->newDetailed_hmo();
echo "<td><font size=2><b>".number_format($ecg,2)."</b></font></td>";
echo "</tr>";
}else { }

/***************ECG************************/


/*******************OR/DR/ER FEE************************/

if( $ro->checkIfTitleExist_newDetailed_opd($registrationNo,"OR/DR/ER Fee") > 0 ) {
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

$ro->newDetailed($registrationNo,"OR/DR/ER FEE");


echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
$or_dr += $ro->newDetailed_total();
$or_dr_pd += $ro->newDetailed_pd();
$or_dr_disc += $ro->newDetailed_disc();
$or_dr_unpaid += $ro->newDetailed_unpaid();
$or_dr_phic += $ro->newDetailed_phic();
$or_dr_hmo += $ro->newDetailed_hmo();
echo "<td><font size=2><b>".number_format($or_dr,2)."</b></font></td>";

echo "</tr>";
}else { }

/*******************OR/DR/ER FEE************************/



/*******************OT**********************/

if( $ro->checkIfTitleExist_newDetailed_opd($registrationNo,"OT") > 0 ) {
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

$ro->newDetailed($registrationNo,"OT");


echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
$ot += $ro->newDetailed_total();
$ot_pd += $ro->newDetailed_pd();
$ot_disc += $ro->newDetailed_disc();
$ot_unpaid += $ro->newDetailed_unpaid();
$ot_phic += $ro->newDetailed_phic();
$ot_hmo += $ro->newDetailed_hmo();
echo "<td><font size=2><b>".number_format($ot,2)."</b></font></td>";

echo "</tr>";
}else { }

/**********************OT****************************/



/*******************PT**********************/

if( $ro->checkIfTitleExist_newDetailed_opd($registrationNo,"PT") > 0 ) {
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

$ro->newDetailed($registrationNo,"PT");


echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
$pt += $ro->newDetailed_total();
$pt_pd += $ro->newDetailed_pd();
$pt_disc += $ro->newDetailed_disc();
$pt_unpaid += $ro->newDetailed_unpaid();
$pt_phic += $ro->newDetailed_phic();
$pt_hmo += $ro->newDetailed_hmo();
echo "<td><font size=2><b>".number_format($pt,2)."</b></font></td>";

echo "</tr>";
}else { }

/**********************PT****************************/


/*******************ST**********************/

if( $ro->checkIfTitleExist_newDetailed_opd($registrationNo,"ST") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>ST</b></font></td>";
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

$ro->newDetailed($registrationNo,"ST");


echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
$st += $ro->newDetailed_total();
$st_pd += $ro->newDetailed_pd();
$st_disc += $ro->newDetailed_disc();
$st_unpaid += $ro->newDetailed_unpaid();
$st_phic += $ro->newDetailed_phic();
$st_hmo += $ro->newDetailed_hmo();
echo "<td><font size=2><b>".number_format($st,2)."</b></font></td>";

echo "</tr>";
}else { }

/**********************ST****************************/



/********************ENDOSCOPY*******************/

if( $ro->checkIfTitleExist_newDetailed_opd($registrationNo,"ENDOSCOPY") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>Endoscopy</b></font></td>";
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

$ro->newDetailed($registrationNo,"ENDOSCOPY");


echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
$endoscopy += $ro->newDetailed_total();
$endoscopy_pd += $ro->newDetailed_pd();
$endoscopy_disc += $ro->newDetailed_disc();
$endoscopy_unpaid += $ro->newDetailed_unpaid();
$endoscopy_phic += $ro->newDetailed_phic();
$endoscopy_hmo += $ro->newDetailed_hmo();
echo "<td><font size=2><b>".number_format($endoscopy,2)."</b></font></td>";

echo "</tr>";
}else { }
/****************ENDOSCOPY***********************/



/****************PF**********************/

if( $ro->checkIfTitleExist_newDetailed_opd($registrationNo,"PROFESSIONAL FEE") > 0 ) {
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

$ro->newDetailed($registrationNo,"PROFESSIONAL FEE");


echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
$pf += $ro->newDetailed_total();
$pf_pd += $ro->newDetailed_pd();
$pf_disc += $ro->newDetailed_disc();
$pf_unpaid += $ro->newDetailed_unpaid();
$pf_phic += $ro->newDetailed_phic();
$pf_hmo += $ro->newDetailed_hmo();
echo "<td><font size=2><b>".number_format($pf,2)."</b></font></td>";
echo "</tr>";
}else { }

/***********************PF***********************/

/*******************ER FEE********************/

if( $ro->checkIfTitleExist_newDetailed_opd($registrationNo,"ER FEE") ) {
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

$ro->newDetailed($registrationNo,"ER FEE");


echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
$erFee += $ro->newDetailed_total();
$erFee_pd += $ro->newDetailed_pd();
$erFee_disc += $ro->newDetailed_disc();
$erFee_unpaid += $ro->newDetailed_unpaid();
$erFee_phic += $ro->newDetailed_phic();
$erFee_hmo += $ro->newDetailed_hmo();
echo "<td><font size=2><b>".number_format($erFee,2)."</b></font></td>";
echo "</tr>";
}else { }
/***************ER FEE*********************/

/*******************CARDIAC MONITOR********************/

if( $ro->checkIfTitleExist_newDetailed_opd($registrationNo,"CARDIAC MONITOR") ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>CARDIAC MONITOR</b></font></td>";
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

$ro->newDetailed($registrationNo,"CARDIAC MONITOR");


echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
$cardiacMonitor += $ro->newDetailed_total();
$cardiacMonitor_pd += $ro->newDetailed_pd();
$cardiacMonitor_disc += $ro->newDetailed_disc();
$cardiacMonitor_unpaid += $ro->newDetailed_unpaid();
$cardiacMonitor_phic += $ro->newDetailed_phic();
$cardiacMonitor_hmo += $ro->newDetailed_hmo();
echo "<td><font size=2><b>".number_format($cardiacMonitor,2)."</b></font></td>";
echo "</tr>";
}else { }
/***************CARDIAC MONITOR*********************/

/*******************OTHERS********************/

if( $ro->checkIfTitleExist_newDetailed_opd($registrationNo,"OTHERS") ) {
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

$ro->newDetailed($registrationNo,"OTHERS");


echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
$others += $ro->newDetailed_total();
$others_pd += $ro->newDetailed_pd();
$others_disc += $ro->newDetailed_disc();
$others_unpaid += $ro->newDetailed_unpaid();
$others_phic += $ro->newDetailed_phic();
$others_hmo += $ro->newDetailed_hmo();
echo "<td><font size=2><b>".number_format($others,2)."</b></font></td>";
echo "</tr>";
}else { }
/***************OTHERS*********************/



$total = ( $medicine + $supplies + $laboratory + $ultrasound + $ctscan + $xray + $miscellaneous + $ecg + $or_dr + $pt + $ot + $st + $endoscopy + $pf + $erFee + $cardiacMonitor + $others );

$total_pd = ( $medicine_pd + $supplies_pd + $laboratory_pd + $ultrasound_pd + $ctscan_pd + $xray_pd + $miscellaneous_pd + $ecg_pd + $or_dr_pd + $pt_pd + $ot_pd + $st_pd + $endoscopy_pd + $pf_pd + $erFee_pd + $cardiacMonitor_pd + $others_pd );


$total_phic = ( $medicine_phic + $supplies_phic + $laboratory_phic + $ultrasound_phic + $ctscan_phic + $xray_phic + $miscellaneous_phic + $ecg_phic + $or_dr_phic + $pt_phic + $ot_phic + $st_phic + $endoscopy_phic + $pf_phic + $erFee_phic + $cardiacMonitor_phic + $others_phic );

$total_hmo = ( $medicine_hmo + $supplies_hmo + $laboratory_hmo + $ultrasound_hmo + $ctscan_hmo + $xray_hmo + $miscellaneous_hmo + $ecg_hmo + $or_dr_hmo + $pt_hmo + $ot_hmo + $st_hmo + $endoscopy_hmo + $pf_hmo + $erFee_hmo + $cardiacMonitor_hmo + $others_hmo );

$total_disc = ( $medicine_disc + $supplies_disc + $laboratory_disc + $ultrasound_disc + $ctscan_disc + $xray_disc + $miscellaneous_disc + $ecg_disc + $or_dr_disc + $pt_disc + $st_disc + $ot_disc + $endoscopy_disc + $pf_disc + $erFee_disc + $cardiacMonitor_disc + $others_disc );

$total_unpaid = ( $medicine_unpaid + $supplies_unpaid + $laboratory_unpaid + $ultrasound_unpaid + $ctscan_unpaid + $xray_unpaid + $miscellaneous_unpaid + $ecg_unpaid + $or_dr_unpaid + $pt_unpaid + $ot_unpaid + $st_unpaid + $endoscopy_unpaid + $pf_unpaid + $erFee_unpaid + $cardiacMonitor_unpaid + $others_unpaid );

echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>TOTAL</b></font></td>";
echo "<td><font size=1>=====></font></td>";
echo "<td><font size=2><b>".number_format($total,2)."</b></font></td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>HMO</b></font></td>";
echo "<td><font size=1>=====></font></td>";
echo "<td><font size=2><b>".number_format($total_hmo,2)."</b></font></td>";
echo "</tr>";


echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Philhealth</b></font></td>";
echo "<td><font size=1>=====></font></td>";
echo "<td><font size=2><b>".number_format($total_phic,2)."</b></font></td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Payment</b></font></td>";
echo "<td><font size=1>=====></font></td>";
echo "<td><font size=2><b>".number_format($total_pd,2)."</b></font></td>";
echo "</tr>";


echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Discount</b></font></td>";
echo "<td><font size=1>=====></font></td>";
echo "<td><font size=2><b>".number_format($total_disc,2)."</b></font></td>";
echo "</tr>";


echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>BALANCE</b></font></td>";
echo "<td><font size=1>=====></font></td>";
echo "<td><font size=2><b>".number_format($total_unpaid,2)."</b></font></td>";
echo "</tr>";


echo "</table>";
echo "<br>";
echo "</div>";
?>
</div>
