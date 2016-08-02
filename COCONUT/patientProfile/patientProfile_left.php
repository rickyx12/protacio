<?php
include("../../myDatabase2.php");
//require_once('../authentication.php');
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

if( isset($_GET['from']) ) {
$from = $_GET['from'];
}else {
$from = "";
}

$ro = new database2();

/*
$ro->getBatchNo();
$myFile = $ro->getReportInformation("homeRoot")."/COCONUT/trackingNo/batchNo.dat";
$fh = fopen($myFile, 'r');
$batchNo = fread($fh, 100);
fclose($fh);
*/

$batchNo = $ro->selectNow("trackingNo","value","name","batchNo");

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
echo "<br><hr>

<font size=2 color=red>".htmlentities($ro->getPatientRecord_lastName())." ".htmlentities($ro->getPatientRecord_firstName())." ".htmlentities($ro->getPatientRecord_middleName())."</font>

<hr>";
}


echo "<ul>";
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientProfile_right.php?registrationNo=".$ro->getRegistrationDetails_registrationNo()."&username=$username' target='rightFrame'><font size=2>Information</font></a></li>";


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

echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientChargesTitle.php?registrationNo=$registrationNo&title=ULTRASOUND&username=$username&show=&desc=' target='rightFrame'><font size=2>Ultrasound</font></a></li>";

echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientChargesTitle.php?registrationNo=$registrationNo&title=XRAY&username=$username&show=&desc=' target='rightFrame'><font size=2>XRAY</font></a></li>";

echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientChargesTitle.php?registrationNo=$registrationNo&title=MEDICINE&username=$username&show=&desc=' target='rightFrame'><font size=2>Medicine</font></a></li>";

echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientChargesTitle.php?registrationNo=$registrationNo&title=SUPPLIES&username=$username&show=&desc=' target='rightFrame'><font size=2>Supplies</font></a></li>";




//check if rehab is activated 
if( $ro->selectNow("reportHeading","information","reportName","rehab") == "Activate" ) {
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientChargesTitle.php?registrationNo=$registrationNo&title=REHAB&username=$username&show=&desc=' target='rightFrame'><font size=2>Rehab</font></a></li>";
}else { }

//echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientChargesTitle.php?registrationNo=$registrationNo&title=OTHERS&username=$username&show=&desc=' target='rightFrame'><font size=2>Others</font></a></li>";

if($ro->getRegistrationDetails_room() != "OPD_OPD") { // enable room
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientChargesTitle.php?registrationNo=$registrationNo&title=Room And Board&username=$username&show=&desc=' target='rightFrame'><font size=2>Room</font></a></li>";
}else { //disable room
echo "";
}

if($ro->selectNow("registrationDetails","type","registrationNo",$registrationNo)=='OPD') {
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientChargesTitle.php?registrationNo=$registrationNo&title=DERMA&username=$username&show=&desc=' target='rightFrame'><font size=2>Derma</font></a></li>";
}

echo "</ul>";

echo "<ul>";


if( $ro->getRegistrationDetails_dateUnregistered() == "" ) {

if( $from == "PHARMACY" ) {
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/ECART/cartHandler.php?registrationNo=".$ro->getRegistrationDetails_registrationNo()."&username=$username&room=".$ro->getRegistrationDetails_room()."&batchNo=$batchNo' target='rightFrame'><font size=2>Charges Cart</font></a></li>";
}else {
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/ECART/cartHandler.php?registrationNo=".$ro->getRegistrationDetails_registrationNo()."&username=$username&room=".$ro->getRegistrationDetails_room()."&batchNo=$batchNo' target='rightFrame'><font size=2>Charges Cart</font></a></li>";

}

}else {
echo "";
}



echo "</ul>";
echo "<ul>";
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/soaOption.php?registrationNo=$registrationNo&username=$username' target='rightFrame'><font size=2>S.O.A</font></a></li>";

$rdtype=$ro->selectNow("registrationDetails","type","registrationNo",$registrationNo);
if($rdtype=='OPD'){
echo "<li><a href='http://".$ro->getMyUrl()."/BillingReports/OPDSOA.php?registrationNo=$registrationNo&username=$username' target='_blank'><font size=2>OPD Summary</font></a></li>";
}

echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/Doctor/doctorModule/soapListed.php?registrationNo=$registrationNo&username=$username' target='rightFrame'><font size=2>S.O.A.P</font></a></li>";

echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/editVitalSign.php?registrationNo=$registrationNo&username=$username' target='rightFrame'><font size=2 color=blue>Vital Sign</font></a></li>";

echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/ptNotes_list.php?registrationNo=$registrationNo&username=$username' target='rightFrame'><font size=2>PT Notes</font></a></li>";

//echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/uploader/viewImages.php?registrationNo=$registrationNo&username=$username' target='rightFrame'><font size=2>Dicom</font></a></li>";

//echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/Results/Radiology/radioResult_list.php?registrationNo=$registrationNo&username=$username' target='rightFrame'><font size=2>Radio Results</font></a></li>";

//echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientNotes/viewNote.php?noteType=Comments&username=$username&registrationNo=".$ro->getRegistrationDetails_registrationNo()."' target='rightFrame'><font size=2>Comments</font></a></li>";

echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/paidItems.php?status=UNPAID&username=$username&registrationNo=".$ro->getRegistrationDetails_registrationNo()."' target='rightFrame'><font size=2>Unpaid</font></a></li>";

echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/paidItems.php?status=PAID&username=$username&registrationNo=".$ro->getRegistrationDetails_registrationNo()."' target='rightFrame'><font size=2>Paid</font></a></li>";

echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/html/checkCharges.php?registrationNo=".$ro->getRegistrationDetails_registrationNo()."' target='rightFrame'><font size=2>Check Charges</font></a></li>";

echo "<li><a href='http://".$ro->getMyUrl()."/BillingReports/BillingChargesSummary.php?username=$username&registrationNo=".$ro->getRegistrationDetails_registrationNo()."' target='rightFrame'><font size=2>Charges Summary</font></a></li>";

echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/oldRecord/showRecord.php?patientNo=".$ro->getRegistrationDetails_patientNo()."&username=$username' target='rightFrame'><font size=2>Record's</font></a></li>";

if( $ro->selectNow("registeredUser","module","username",$username) == "LABORATORY" ) {
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/Laboratory/resultList/listOfLab.php?username=$username&registrationNo=".$ro->getRegistrationDetails_registrationNo()."' target='rightFrame'><font size=2>Lab Result</font></a></li>";
}else { }

echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientOR.php?registrationNo=".$ro->getRegistrationDetails_registrationNo()."' target='rightFrame'><font size=2>OR#</font></a></li>";

echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/ECART/cartHandler_custom.php?registrationNo=".$ro->getRegistrationDetails_registrationNo()."&username=$username&room=".$ro->getRegistrationDetails_room()."&batchNo=$batchNo' target='rightFrame'><font size=2>test</font></a></li>";

echo "</ul>";


?>
