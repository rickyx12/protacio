<?php
include("../../../myDatabase1.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$physician = $_GET['physician'];
$radioReport = $_GET['radioReport'];
$radtech = $_GET['radtech'];

$ro = new database1();

if( isset($_GET['approved']) ) {
$ro->radioReportInsert($registrationNo,$itemNo,date("Y-m-d"),$physician,$radioReport,"Mendero Medical Center","Consolacion,Cebu",$ro->getSynapseTime(),"yes",date("Y-m-d"),$ro->getSynapseTime(),$physician,$radtech);
}else {
$ro->radioReportInsert($registrationNo,$itemNo,date("Y-m-d"),$physician,$radioReport,"Mendero Medical Center","Consolacion,Cebu",$ro->getSynapseTime(),"","","","",$radtech);
}

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Reports/radiologyReport/radioReport_output.php?itemNo=$itemNo&registrationNo=$registrationNo&description=".$ro->selectNow("patientCharges","description","itemNo",$itemNo)."");

?>
