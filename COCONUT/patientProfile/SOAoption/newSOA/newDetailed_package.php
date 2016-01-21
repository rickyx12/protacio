<?php
include("../../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$show = $_GET['show'];

$ro = new database2();
$ro->getPatientProfile($registrationNo);
$ro->soap_setter($registrationNo);
?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<?php

$medicine=0;
$supplies=0;
$laboratory=0;
$radiology=0;
$miscellaneous=0;
$bloodBank=0;
$ecg=0;
$cardiology=0;
$or_dr=0;
$rehab=0;
$oxygen=0;
$nitrous=0;
$dialysis=0;
$nbs=0;
$cardiac=0;
$ventilator=0;
$endoscopy=0;
$pulse_oximeter=0;
$pf=0;
$room=0;
$total=0;

$medicine_phic=0;
$supplies_phic=0;
$laboratory_phic=0;
$radiology_phic=0;
$miscellaneous_phic=0;
$bloodBank_phic=0;
$ecg_phic=0;
$cardiology_phic=0;
$or_dr_phic=0;
$rehab_phic=0;
$oxygen_phic=0;
$nitrous_phic=0;
$dialysis_phic=0;
$nbs_phic=0;
$cardiac_phic=0;
$ventilator_phic=0;
$endoscopy_phic=0;
$pulse_oximeter_phic=0;
$pf_phic=0;
$room_phic=0;
$total_phic=0;

$medicine_company=0;
$supplies_company=0;
$laboratory_company=0;
$radiology_company=0;
$miscellaneous_company=0;
$bloodBank_company=0;
$ecg_company=0;
$cardiology_company=0;
$or_dr_company=0;
$rehab_company=0;
$oxygen_company=0;
$nitrous_company=0;
$dialysis_company=0;
$nbs_company=0;
$cardiac_company=0;
$ventilator_company=0;
$endoscopy_company=0;
$pulse_oximeter_company=0;
$pf_company=0;
$room_company=0;


echo "<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";


echo "<center><img src='http://".$ro->getMyUrl()."/COCONUT/myImages/mendero.png' width='50%' height='25%'></center>";

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
echo  "<th>&nbsp;<font class='heading'><b>Charges</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>Credit</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>Bal</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PHIC</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>HMO</b></font>&nbsp;</th>";
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



/************************PACKAGE***********************************/


echo "<tr>";
echo "<td>&nbsp;<font size=2><b>Package</b></font></td>";
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

$ro->newDetailed_inventory_package($registrationNo,"MEDICINE","=");
$ro->newDetailed_inventory_package($registrationNo,"SUPPLIES","=");


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";


/***********************PACKAGE**********************************/










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

$ro->newDetailed_inventory_package($registrationNo,"MEDICINE","!=");


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_inventory_package_total()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_inventory_package_phic()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_inventory_package_company()."</b></font></td>";
$medicine += $ro->newDetailed_inventory_package_total();
$medicine_phic += $ro->newDetailed_inventory_package_phic();
$medicine_company += $ro->newDetailed_inventory_package_company();
echo "</tr>";
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

$ro->newDetailed_inventory_package($registrationNo,"SUPPLIES","!=");

echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_inventory_package_total()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_inventory_package_phic()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_inventory_package_company()."</b></font></td>";
$supplies += $ro->newDetailed_inventory_package_total();
$supplies_phic += $ro->newDetailed_inventory_package_phic();
$supplies_company += $ro->newDetailed_inventory_package_company();
echo "</tr>";
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

$ro->newDetailed($registrationNo,"LABORATORY");


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_total()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_phic()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_company()."</b></font></td>";
$laboratory += $ro->newDetailed_total();
$laboratory_phic += $ro->newDetailed_phic();
$laboratory_company += $ro->newDetailed_company();
echo "</tr>";
}else { }
/******************LABORATORY**********************/


/*****************RADIOLOGY************************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"RADIOLOGY") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>Radiology</b></font></td>";
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

$ro->newDetailed($registrationNo,"RADIOLOGY");


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_total()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_phic()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_company()."</b></font></td>";
$radiology += $ro->newDetailed_total();
$radiology_phic += $ro->newDetailed_phic();
$radiology_company += $ro->newDetailed_company();
echo "</tr>";
}else { }
/********************RADIOLOGY**********************/


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

$ro->newDetailed($registrationNo,"MISCELLANEOUS");


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_total()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_phic()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_company()."</b></font></td>";
$miscellaneous += $ro->newDetailed_total();
$miscellaneous_phic += $ro->newDetailed_phic();
$miscellaneous_company += $ro->newDetailed_company();
echo "</tr>";
}else { }

/***************MISCELLANEOUS*********************/

/*************BLOODBANK*********************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"BLOODBANK") > 0 ) {

echo "<tr>";
echo "<td>&nbsp;<font size=2><b>Blood Bank</b></font></td>";
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

$ro->newDetailed($registrationNo,"BLOODBANK");


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_total()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_phic()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_company()."</b></font></td>";
$bloodBank += $ro->newDetailed_total();
$bloodBank_phic += $ro->newDetailed_phic();
$bloodBank_company += $ro->newDetailed_company();
echo "</tr>";

}else { }

/*************BLOODBANK*********************/




/****************ECG************************/

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

$ro->newDetailed($registrationNo,"ECG");


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_total()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_phic()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_company()."</b></font></td>";
$ecg += $ro->newDetailed_total();
$ecg_phic += $ro->newDetailed_phic();
$ecg_company += $ro->newDetailed_company();
echo "</tr>";
}else { }

/***************ECG************************/




/*****************CARDIOLOGY****************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"CARDIOLOGY") > 0 ) {

echo "<tr>";
echo "<td>&nbsp;<font size=2><b>Cardiology</b></font></td>";
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

$ro->newDetailed($registrationNo,"CARDIOLOGY");


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_total()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_phic()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_company()."</b></font></td>";
$cardiology += $ro->newDetailed_total();
$cardiology_phic += $ro->newDetailed_phic();
$cardiology_company += $ro->newDetailed_company();
echo "</tr>";

}else { }

/*******************CARDIOLOGY**************************/



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

$ro->newDetailed($registrationNo,"OR/DR/ER FEE");


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_total()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_phic()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_company()."</b></font></td>";
$or_dr += $ro->newDetailed_total();
$or_dr_phic += $ro->newDetailed_phic();
$or_dr_company += $ro->newDetailed_company();
echo "</tr>";
}else { }

/*******************OR/DR/ER FEE************************/



/*******************REHAB**********************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"REHAB") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>Rehab</b></font></td>";
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

$ro->newDetailed($registrationNo,"REHAB");


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_total()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_phic()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_company()."</b></font></td>";
$rehab += $ro->newDetailed_total();
$rehab_phic += $ro->newDetailed_phic();
$rehab_company += $ro->newDetailed_company();
echo "</tr>";
}else { }

/**********************REHAB****************************/


/***********************OXYGEN*************************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"OXYGEN") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>Oxygen</b></font></td>";
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

$ro->newDetailed($registrationNo,"OXYGEN");


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_total()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_phic()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_company()."</b></font></td>";
$oxygen += $ro->newDetailed_total();
$oxygen_phic += $ro->newDetailed_phic();
$oxygen_company += $ro->newDetailed_company();
echo "</tr>";
}else { }

/**********************OXYGEN*****************************/



/***********************NITROUS***********************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"NITROUS") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>NITROUS</b></font></td>";
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

$ro->newDetailed($registrationNo,"NITROUS");


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_total()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_phic()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_company()."</b></font></td>";
$nitrous += $ro->newDetailed_total();
$nitrous_phic += $ro->newDetailed_phic();
$nitrous_company += $ro->newDetailed_company();
echo "</tr>";
}else { }

/*****************NITROUS************************/



/******************DIALYSIS********************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"DIALYSIS") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>Dialysis</b></font></td>";
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

$ro->newDetailed($registrationNo,"DIALYSIS");

echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_total()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_phic()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_company()."</b></font></td>";
$dialysis += $ro->newDetailed_total();
$dialysis_phic += $ro->newDetailed_phic();
$dialysis_company += $ro->newDetailed_company();
echo "</tr>";
}else { }

/*******************DIALYSIS************************/


/******************NBS***********************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"NBS") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>NBS</b></font></td>";
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

$ro->newDetailed($registrationNo,"NBS");


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_total()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_phic()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_company()."</b></font></td>";
$nbs += $ro->newDetailed_total();
$nbs_phic += $ro->newDetailed_phic();
$nbs_company += $ro->newDetailed_company();
echo "</tr>";
}else { }
/**************NBS**************************/



/********************CARDIAC***********************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"CARDIAC") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>Cardiac</b></font></td>";
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

$ro->newDetailed($registrationNo,"CARDIAC");


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_total()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_phic()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_company()."</b></font></td>";
$cardiac += $ro->newDetailed_total();
$cardiac_phic += $ro->newDetailed_phic();
$cardiac_company += $ro->newDetailed_company();
echo "</tr>";
}else { }

/**********************CARDIAC**********************/

/********************VENTILATOR********************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"VENTILATOR") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>Ventilator</b></font></td>";
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

$ro->newDetailed($registrationNo,"VENTILATOR");


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_total()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_phic()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_company()."</b></font></td>";
$ventilator += $ro->newDetailed_total();
$ventilator_phic += $ro->newDetailed_phic();
$ventilator_company += $ro->newDetailed_company();
echo "</tr>";
}else { }
/****************VENTILATOR***********************/









/********************ENDOSCOPY********************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"ENDOSCOPY") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>ENDOSCOPY</b></font></td>";
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
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_total()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_phic()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_company()."</b></font></td>";
$endoscopy += $ro->newDetailed_total();
$endoscopy_phic += $ro->newDetailed_phic();
$endoscopy_company += $ro->newDetailed_company();
echo "</tr>";
}else { }
/****************VENTILATOR***********************/





/******************PULSE_OXIMETER*******************/

if( $ro->checkIfTitleExist_newDetailed($registrationNo,"PULSE_OXIMETER") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>Pulse Oximeter</b></font></td>";
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

$ro->newDetailed($registrationNo,"PULSE_OXIMETER");


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_total()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_phic()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_company()."</b></font></td>";
$pulse_oximeter += $ro->newDetailed_total();
$pulse_oximeter_phic += $ro->newDetailed_phic();
$pulse_oximeter_company += $ro->newDetailed_company();
echo "</tr>";
}else { }

/********************PULSE_OXIMETER**********************/


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

$ro->newDetailed($registrationNo,"PROFESSIONAL FEE");


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_total()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_phic()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_company()."</b></font></td>";
$pf += $ro->newDetailed_total();
$pf_phic += $ro->newDetailed_phic();
$pf_company += $ro->newDetailed_company();
echo "</tr>";
}else { }

/***********************PF***********************/

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

$ro->newDetailed($registrationNo,"Room and Board");


echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>Sub Total</b></font></td>";
echo "<td><font size=1>=====></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_total()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_phic()."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".$ro->newDetailed_company()."</b></font></td>";
$room += $ro->newDetailed_total();
$room_phic += $ro->newDetailed_phic();
$room_company += $ro->newDetailed_company();
echo "</tr>";
}else { }
/***************ROOM*********************/

$total = ( $medicine + $supplies + $laboratory + $radiology + $miscellaneous + $bloodBank + $ecg + $cardiology + $or_dr + $rehab + $oxygen + $nitrous + $dialysis + $nbs + $cardiac + $ventilator + $endoscopy + $pulse_oximeter + $pf + $room );

$phic = ( $medicine_phic + $supplies_phic + $laboratory_phic + $radiology_phic + $miscellaneous_phic + $bloodBank_phic + $ecg_phic + $cardiology_phic + $or_dr_phic + $rehab_phic + $oxygen_phic + $nitrous_phic + $dialysis_phic + $nbs_phic + $cardiac_phic + $ventilator_phic + $endoscopy_phic + $pulse_oximeter_phic + $pf_phic + $room_phic );

$company = ( $medicine_company + $supplies_company + $laboratory_company + $radiology_company + $miscellaneous_company + $bloodBank_company + $ecg_company + $cardiology_company + $or_dr_company + $rehab_company + $oxygen_company + $nitrous_company + $dialysis_company + $nbs_company + $cardiac_company + $ventilator_company + $endoscopy_company + $pulse_oximeter_company + $pf_company + $room_company );

echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2><b>TOTAL</b></font></td>";
echo "<td><font size=1>=====></font></td>";
echo "<td>&nbsp;<font size=2><b>".number_format($total,2)."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".number_format($phic,2)."</b></font></td>";
echo "<td>&nbsp;<font size=2><b>".number_format($company,2)."</b></font></td>";
echo "</tr>";

echo "</table>";
echo "<br>";
echo "</div>";
