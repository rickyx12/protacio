<?php
include("../../../myDatabase3.php");
if( isset($_GET['itemNo']) ) {
$itemNo = $_GET['itemNo'];
$countItem = count($itemNo);
}else {
$itemNo = "";
$countItem = "";
}
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database3();

if( isset($_GET['itemNo']) ) {
for( $x=0;$x<$countItem;$x++ ) {
$ro->editNow("room","Description",$ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo[$x]),"status","Vacant");
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"status","Discharged");
}
}else { }

$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"dateUnregistered",date("Y-m-d"));
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"timeUnregistered",$ro->getSynapseTime());
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"mgh",$username);
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"unregisteredBy",$username);
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"mgh_date",date("Y-m-d")."@".$ro->getSynapseTime());
$ro->addDischargeHistory($registrationNo,"Closed",date("H:i:s"),date("Y-m-d"),$username);

echo "<center><br><Br><Br><font color=red>Patient Discharged</font>";

?>
