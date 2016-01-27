<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$patientDisp = $_GET['patientDisp'];
$from = $_GET['from'];
$count = count($patientDisp);

$ro = new database2();

for( $x=0;$x<$count;$x++ ) {
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"patientDisposition",$patientDisp[$x]);
}



( $from == "cf2" ) ? $ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/philhealth/revisedSep2013/cf2.php?registrationNo=$registrationNo") : $ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/philhealth/clinicalCoverSheet.php?registrationNo=$registrationNo")

?>
