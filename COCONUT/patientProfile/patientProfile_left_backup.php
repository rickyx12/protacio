<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database();

$ro->getBatchNo();
$myFile = $ro->getReportInformation("homeRoot")."/COCONUT/trackingNo/batchNo.dat";
$fh = fopen($myFile, 'r');
$batchNo = fread($fh, 100);
fclose($fh);


echo "

<style type='text/css'>
a 
{ 
text-decoration:none;
color:black;
font-weight:bold;
 }
ul { list-style-type:none; }
display: block;
</style>

";

$ro->getPatientProfile($registrationNo);

if($ro->selectNow("registeredUser","module","username",$ro->getRegistrationDetails_registeredBy()) == "MI") {
echo "<br><hr><font size=2 color=blue>".$ro->getPatientRecord_lastName()." ".$ro->getPatientRecord_firstName()." ".$ro->getPatientRecord_middleName().".</font><hr>";
}else {
echo "<br><hr><font size=2 color=red>".$ro->getPatientRecord_lastName()." ".$ro->getPatientRecord_firstName()." ".$ro->getPatientRecord_middleName()."</font><hr>";
}


echo "<ul>";
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientProfile_right.php?registrationNo=".$ro->getRegistrationDetails_registrationNo()."' target='rightFrame'><font size=2>Information</font></a></li>";


if($ro->getRegistrationDetails_caseType() != "") {
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/phicLimit/show_phicLimit.php?registrationNo=$registrationNo&casetype=".$ro->getRegistrationDetails_caseType()."' target='rightFrame'><font size=2>Credit Limit</font></a></li>";
}else {
echo "";
}


/*
if($ro->getRegistrationDetails_room() != "OPD_OPD") {
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/creditLimit/viewCreditLimit.php?registrationNo=$registrationNo&username=$username' target='rightFrame'><font size=2>Credit Limit</font></a></li>";
}else {
echo "";
}
*/

echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientCharges.php?registrationNo=".$ro->getRegistrationDetails_registrationNo()."&username=$username&show=All&desc=' target='rightFrame'><font size=2>Charges</font></a></li>";
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientChargesTitle.php?registrationNo=$registrationNo&title=PROFESSIONAL FEE&username=$username&show=&desc=' target='rightFrame'><font size=2>Doctor</font></a></li>";
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientChargesTitle.php?registrationNo=$registrationNo&title=LABORATORY&username=$username&show=&desc=' target='rightFrame'><font size=2>Laboratory</font></a></li>";
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientChargesTitle.php?registrationNo=$registrationNo&title=RADIOLOGY&username=$username&show=&desc=' target='rightFrame'><font size=2>Radiology</font></a></li>";
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientChargesTitle.php?registrationNo=$registrationNo&title=MEDICINE&username=$username&show=&desc=' target='rightFrame'><font size=2>Medicine</font></a></li>";
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientChargesTitle.php?registrationNo=$registrationNo&title=SUPPLIES&username=$username&show=&desc=' target='rightFrame'><font size=2>Supplies</font></a></li>";
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientChargesTitle.php?registrationNo=$registrationNo&title=OTHERS&username=$username&show=&desc=' target='rightFrame'><font size=2>Others</font></a></li>";

if($ro->getRegistrationDetails_room() != "OPD_OPD") { // enable room
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientChargesTitle.php?registrationNo=$registrationNo&title=Room And Board&username=$username&show=&desc=' target='rightFrame'><font size=2>Room</font></a></li>";
}else { //disable room
echo "";
}
echo "</ul>";

echo "<ul>";


if($ro->checkCreditLimit($registrationNo) > 0 && $ro->getRegistrationDetails_type() == "IPD") { // kpg IPD check kung may creditLimit ang patient as "PATIENT" kung meron execute the limit....

//setter pra sa allowed credit limit ng ipd
$ro->viewCreditLimit_setter($registrationNo,"PATIENT","cashUnpaid",$username);
//current balance ng patient
$current = $ro->getCurrentCredit($registrationNo,$ro->viewCreditLimit_setter_limitTo(),$ro->viewCreditLimit_setter_limitVia()) - $ro->getCurrentPaid($registrationNo,$ro->viewCreditLimit_setter_limitTo(),$ro->viewCreditLimit_setter_limitVia());


if($current <= $ro->viewCreditLimit_setter_amountLimit()) { //enable charges
//echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/availableCharges/searchCharges.php?registrationNo=".$ro->getRegistrationDetails_registrationNo()."&username=$username&room=".$ro->getRegistrationDetails_room()."&batchNo=$batchNo' target='rightFrame'><font size=2>Add Charges</font></a></li>";
//echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/Doctor/searchDoctor.php?registrationNo=".$ro->getRegistrationDetails_registrationNo()."&username=$username&room=".$ro->getRegistrationDetails_room()."&batchNo=$batchNo' target='rightFrame'><font size=2>Add Doctor</font></a></li>";
//echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/availableMedicine/searchMedicine.php?registrationNo=".$ro->getRegistrationDetails_registrationNo()."&username=$username&inventoryFrom=PHARMACY&room=".$ro->getRegistrationDetails_room()."&batchNo=$batchNo' target='rightFrame'><font size=2>Add Medicine</font></a></li>";
//echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/availableSupplies/searchSupplies.php?registrationNo=".$ro->getRegistrationDetails_registrationNo()."&username=$username&inventoryFrom=CSR&batchNo=$batchNo' target='rightFrame'><font size=2>Add Supplies</font></a></li>";
//echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/ECART/cartHandler.php?registrationNo=".$ro->getRegistrationDetails_registrationNo()."&username=$username&room=".$ro->getRegistrationDetails_room()."&batchNo=$batchNo' target='rightFrame'><font size=2>Charges Cart</font></a></li>";
}else { //disable charges
echo "<li><a href='#'><font size=1 color=red>Limit Exceeded</font> <img src='http://".$ro->getMyUrl()."/COCONUT/myImages/locked1.jpeg'></a></li>";
}
}else { //kung wLang creditLimit as "PATIENT" don't execute the creditLimit otherwise tuLuy Lng ang charging
//echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/availableCharges/searchCharges.php?registrationNo=".$ro->getRegistrationDetails_registrationNo()."&username=$username&room=".$ro->getRegistrationDetails_room()."&batchNo=$batchNo' target='rightFrame'><font size=2>Add Charges</font></a></li>";
//echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/Doctor/searchDoctor.php?registrationNo=".$ro->getRegistrationDetails_registrationNo()."&username=$username&room=".$ro->getRegistrationDetails_room()."&batchNo=$batchNo' target='rightFrame'><font size=2>Add Doctor</font></a></li>";
//echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/availableMedicine/searchMedicine.php?registrationNo=".$ro->getRegistrationDetails_registrationNo()."&username=$username&inventoryFrom=PHARMACY&room=".$ro->getRegistrationDetails_room()."&batchNo=$batchNo' target='rightFrame'><font size=2>Add Medicine</font></a></li>";
//echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/availableSupplies/searchSupplies.php?registrationNo=".$ro->getRegistrationDetails_registrationNo()."&username=$username&inventoryFrom=CSR&batchNo=$batchNo' target='rightFrame'><font size=2>Add Supplies</font></a></li>";
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/ECART/cartHandler.php?registrationNo=".$ro->getRegistrationDetails_registrationNo()."&username=$username&room=".$ro->getRegistrationDetails_room()."&batchNo=$batchNo' target='rightFrame'><font size=2>Charges Cart</font></a></li>";
}


echo "</ul>";

echo "<ul>";
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/soaOption.php?registrationNo=$registrationNo&username=$username' target='rightFrame'><font size=2>S.O.A</font></a></li>";
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/Doctor/doctorModule/soapListed.php?registrationNo=$registrationNo&username=$username' target='rightFrame'><font size=2>S.O.A.P</font></a></li>";
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/Results/clinicalChemistry/view_labTest_done.php?registrationNo=$registrationNo' target='rightFrame'><font size=2>Lab Results</font></a></li>";
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/Results/Radiology/radioResult_list.php?registrationNo=$registrationNo&username=$username' target='rightFrame'><font size=2>Radio Results</font></a></li>";
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientNotes/viewNote.php?noteType=Comments&username=$username&registrationNo=".$ro->getRegistrationDetails_registrationNo()."' target='rightFrame'><font size=2>Comments</font></a></li>";
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/oldRecord/showRecord.php?patientNo=".$ro->getRegistrationDetails_patientNo()."&username=$username' target='rightFrame'><font size=2>Record's</font></a></li>";


echo "</ul>";


?>
