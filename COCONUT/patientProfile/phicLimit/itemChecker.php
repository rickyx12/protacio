<?php
include("../../../myDatabase.php");

$ro = new database();

$itemNoz = $_GET['itemNoz'];
$casetype = $_GET['casetype'];
$totalItem = count($itemNoz);

$ro->getPHIClimit_setter($casetype);
$ro->checkCase($registrationNo);

for($x=0;$x<$totalItem;$x++) {

//$ro->selectNow("patientCharges","itemNo");

}


?>
