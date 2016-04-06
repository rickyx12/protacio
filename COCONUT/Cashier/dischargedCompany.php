<?php
include "../../myDatabase3.php";
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$shift = $_GET['shift'];
$username = $_GET['username'];
$monthDischarged = $_GET['monthDischarged'];
$dayDischarged = $_GET['dayDischarged'];
$yearDischarged = $_GET['yearDischarged'];
$dateDischarged = $yearDischarged."-".$monthDischarged."-".$dayDischarged;

$ro = new database3();

//echo $registrationNo."<br>";
//echo $shift."<br>";
//echo $dateDischarged."<br>";
for($x=0;$x<count($itemNo);$x++) {
//echo $itemNo[$x]."<br>";
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"reportShift",$shift);
}

$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"dateUnregistered",$dateDischarged);
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"timeUnregistered",$ro->getSynapseTime());
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"mgh",$username);
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"unregisteredBy",$username);
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"mgh_date",$dateDischarged."@".$ro->getSynapseTime());
$ro->addDischargeHistory($registrationNo,"Closed",date("H:i:s"),$dateDischarged,$username);

echo "<center><br><Br><Br><font color=red>Patient Discharged</font>";


?>