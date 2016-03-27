<?php
include "../../myDatabase4.php";
$registrationNo = $_POST["registrationNo"];
$shift = $_POST["shift"];

$ro = new database4();
/*
echo $registrationNo;
echo "<br>";
echo $shift;
*/
$ro->get_hmo_charges_setShift($registrationNo,$shift);

?>