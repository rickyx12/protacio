<?php
include("../../../myDatabase1.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$radioReport = $_GET['radioReport'];

$ro = new database1();

$ro->doubleEditNow("radioSavedReport","registrationNo",$registrationNo,"itemNo",$itemNo,"radioReport",$radioReport);


$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Reports/radiologyReport/radioReport_output_doctor.php?registrationNo=$registrationNo&itemNo=$itemNo&description=".$ro->selectNow("patientCharges","description","itemNo",$itemNo));

?>
