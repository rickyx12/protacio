<?php
include("../../../myDatabase.php");
$casetype = $_GET['casetype'];
$registrationNo = $_GET['registrationNo'];

$ro = new database();

echo "<center><br><br>";
//$ro->getPHIClimit($casetype);
$ro->getPHIClimit_setter($casetype);
$ro->getPatientProfile($registrationNo);


$ro->coconutTableStart();
$ro->coconutTableRowStart();
$ro->coconutTableHeader("PHIC Medicine");
//$ro->coconutTableHeader("PHIC Supplies Only");
$ro->coconutTableHeader("PHIC Supplies");
//$ro->coconutTableHeader("PHIC Room");
$ro->coconutTableHeader("PHIC PF");
$ro->coconutTableHeader("HMO");
$ro->coconutTableHeader("Cash");
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$ro->coconutTableData("&nbsp;".number_format($ro->getPHIClimit_medicine(),2));
//$ro->coconutTableData("&nbsp;".$ro->getPHIClimit_suppliesOnly());
$ro->coconutTableData("&nbsp;".$ro->getPHIClimit_supplies());
//$ro->coconutTableData("&nbsp;".$ro->getPHIClimit_room());
$ro->coconutTableData("&nbsp;".$ro->getPHIClimit_pf());
$ro->coconutTableData("&nbsp;".$ro->getRegistrationDetails_limitHMO());
$ro->coconutTableData("&nbsp;".$ro->getRegistrationDetails_limitCASH());
$ro->coconutTableRowStop();
$ro->coconutTableStop();

echo "<hr>";
echo "<font size=3 color=red>Your Current Total</font>";
$ro->coconutTableStart();
$ro->coconutTableRowStart();
$ro->coconutTableHeader("PHIC Medicine");
//$ro->coconutTableHeader("PHIC Supplies Only");
//$ro->coconutTableHeader("PHIC Room");
$ro->coconutTableHeader("PHIC Supplies");
$ro->coconutTableHeader("PHIC PF");
$ro->coconutTableHeader("HMO");
$ro->coconutTableHeader("Cash");
$ro->coconutTableRowStop();
$ro->coconutTableRowStart();

if($ro->getPHIClimit_medicine() <= $ro->getCurrentPHIC_check($registrationNo,"MEDICINE")) {
$ro->coconutTableData(number_format($ro->getCurrentPHIC_check($registrationNo,"MEDICINE"),2)." - <font color=red>(".( number_format($ro->getCurrentPHIC_check($registrationNo,"MEDICINE") - $ro->getPHIClimit_medicine(),2) ).")</font>");
}else {
$ro->coconutTableData($ro->getCurrentPHIC_check($registrationNo,"MEDICINE"));
}

/*
//SUPPLIES ONLY
$ro->coconutTableData("&nbsp;".$ro->getTotal("phic","SUPPLIES",$registrationNo). "- <font color=red>(".( number_format($ro->getTotal("phic","SUPPLIES",$registrationNo) - $ro->getPHIClimit_suppliesOnly(),2) ).")</font>"  );
*/

//SUPPLIES ETC.
if($ro->getPHIClimit_supplies() <= $ro->getCurrentPHIC_check($registrationNo,"SUPPLIES")) {
$ro->coconutTableData($ro->getCurrentPHIC_check($registrationNo,"SUPPLIES")." - <font color=red>(".($ro->getCurrentPHIC_check($registrationNo,"SUPPLIES") - $ro->getPHIClimit_supplies() ).")</font>");
}else {
$ro->coconutTableData($ro->getCurrentPHIC_check($registrationNo,"SUPPLIES"));
}


/*
if($ro->getPHIClimit_room() <= $ro->getCurrentPHIC_check($registrationNo,"Room And Board")) {
$ro->coconutTableData($ro->getCurrentPHIC_check($registrationNo,"Room And Board")." - <font color=red>".($ro->getCurrentPHIC_check($registrationNo,"Room And Board") - $ro->getPHIClimit_room() )."</font>");
}else {
$ro->coconutTableData($ro->getCurrentPHIC_check($registrationNo,"Room And Board"));
}
*/

if($ro->getPHIClimit_pf() <= $ro->getCurrentPHIC_check($registrationNo,"PROFESSIONAL FEE")) {
$ro->coconutTableData($ro->getCurrentPHIC_check($registrationNo,"PROFESSIONAL FEE")."- <font color=red>(".($ro->getCurrentPHIC_check($registrationNo,"PROFESSIONAL FEE") - $ro->getPHIClimit_pf() ).")</font>");
}else {
$ro->coconutTableData($ro->getCurrentPHIC_check($registrationNo,"PROFESSIONAL FEE"));
}



if($ro->getTotal("company","",$registrationNo) > $ro->getRegistrationDetails_limitHMO() ) {
$ro->coconutTableData("".$ro->getTotal("company","",$registrationNo)." - <font color='red'>".($ro->getTotal("company","",$registrationNo) - $ro->getRegistrationDetails_limitHMO())."</font>");
}else {
$ro->coconutTableData($ro->getTotal("company","",$registrationNo));
}
$ro->coconutTableData($ro->getTotal("cashUnpaid","",$registrationNo));

$ro->coconutTableRowStop();
$ro->coconutTableStop();

echo "<br><br>";

echo "<table border=0>";
echo "<td>";
$ro->coconutFormStart("get","limitMagic.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("casetype",$casetype);
$ro->coconutHidden("phicMed_excess", $ro->getTotal("phic","MEDICINE",$registrationNo) - $ro->getPHIClimit_medicine() );

$total = $ro->getCurrentPHIC_check($registrationNo,"SUPPLIES") ;

$ro->coconutHidden("phicSup_excess", $ro->getCurrentPHIC_check($registrationNo,"SUPPLIES") - $ro->getPHIClimit_supplies() );

//$ro->coconutTextBox("phicMed_allowedLimit",$ro->getCurrentPHIC_check($registrationNo,"MEDICINE"));
//$ro->coconutTextBox("phicMed_excess",$ro->getCurrentPHIC_check($registrationNo,"MEDICINE") - $ro->getPHIClimit_medicine());
//$ro->coconutButton("Generate");
$ro->coconutFormStop();
echo "</td>";


echo "<tr>";

echo "<td>";

$ro->coconutFormStart("get","phicFuller_getReady.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("casetype",$casetype);
$ro->coconutHidden("case","ordinaryCase");
$ro->coconutHidden("type","medicine");
$ro->coconutHidden("cash", $ro->getTotal("cashUnpaid","",$registrationNo) );
//$ro->coconutTextBox("phicMed_allowedLimit",$ro->getCurrentPHIC_check($registrationNo,"MEDICINE"));
//$ro->coconutTextBox("phicMed_excess",$ro->getCurrentPHIC_check($registrationNo,"MEDICINE") - $ro->getPHIClimit_medicine());
$ro->coconutButton("Ordinary Case (MEDICINE)");
$ro->coconutFormStop();

echo "</td>";



echo "<td>";

$ro->coconutFormStart("get","phicFuller_getReady.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("casetype",$casetype);
$ro->coconutHidden("case","caseRate");
$ro->coconutHidden("type","medicine");
$ro->coconutHidden("cash", $ro->getTotal("cashUnpaid","",$registrationNo) );
//$ro->coconutTextBox("phicMed_allowedLimit",$ro->getCurrentPHIC_check($registrationNo,"MEDICINE"));
//$ro->coconutTextBox("phicMed_excess",$ro->getCurrentPHIC_check($registrationNo,"MEDICINE") - $ro->getPHIClimit_medicine());
$ro->coconutButton("Case Rate (MEDICINE)");
$ro->coconutFormStop();

echo "</td>";

echo "</tr>";


echo "<tr>";

echo "<td>";

$ro->coconutFormStart("get","phicFuller_getReady.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("casetype",$casetype);
$ro->coconutHidden("case","ordinaryCase");
$ro->coconutHidden("type","supplies");
$ro->coconutHidden("cash", $ro->getTotal("cashUnpaid","",$registrationNo) );
//$ro->coconutTextBox("phicMed_allowedLimit",$ro->getCurrentPHIC_check($registrationNo,"MEDICINE"));
//$ro->coconutTextBox("phicMed_excess",$ro->getCurrentPHIC_check($registrationNo,"MEDICINE") - $ro->getPHIClimit_medicine());
$ro->coconutButton("Ordinary Case (SUPPLIES)");
$ro->coconutFormStop();

echo "</td>";



echo "<td>";

$ro->coconutFormStart("get","phicFuller_getReady.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("casetype",$casetype);
$ro->coconutHidden("case","caseRate");
$ro->coconutHidden("type","supplies");
$ro->coconutHidden("cash", $ro->getTotal("cashUnpaid","",$registrationNo) );
//$ro->coconutTextBox("phicMed_allowedLimit",$ro->getCurrentPHIC_check($registrationNo,"MEDICINE"));
//$ro->coconutTextBox("phicMed_excess",$ro->getCurrentPHIC_check($registrationNo,"MEDICINE") - $ro->getPHIClimit_medicine());
$ro->coconutButton("Case Rate (SUPPLIES)");
$ro->coconutFormStop();

echo "</td>";

echo "</tr>";



echo "<tr>";

echo "<td>";

$ro->coconutFormStart("get","phicFuller_getReady.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("casetype",$casetype);
$ro->coconutHidden("case","caseRate");
$ro->coconutHidden("type","pf");
$ro->coconutHidden("cash", $ro->getTotal("cashUnpaid","",$registrationNo) );
//$ro->coconutTextBox("phicMed_allowedLimit",$ro->getCurrentPHIC_check($registrationNo,"MEDICINE"));
//$ro->coconutTextBox("phicMed_excess",$ro->getCurrentPHIC_check($registrationNo,"MEDICINE") - $ro->getPHIClimit_medicine());
$ro->coconutButton("PF");
$ro->coconutFormStop();

echo "</td>";



echo "</tr>";




echo "</table>";

echo "<br><br>Ordinary Case - Only Covered ";
echo "<br><a href='http://".$ro->getMyUrl()."/COCONUT/rBanny/selectCase.php?registrationNo=$registrationNo'>Case Type - All, even not covered</a>";


?>
