<?php
include("../../myDatabase3.php");
$registrationNo = $_GET['registrationNo'];
$count = count($registrationNo);

$ro = new database3();

for($x=0;$x<$count;$x++) {
echo $registrationNo[$x];
$ro->updateDermaPx($registrationNo[$x]);
}

?>
