<?php
include("../../myDatabase3.php");

$date = $_POST['date'];
$date1 = $_POST['date1'];

$ro = new database3();

echo "From <b>".$ro->formatDate($date)."</b> to <b>".$ro->formatDate($date1)."</b>";

$ro->paidInpatient($date,$date1,"ricky");

?>
