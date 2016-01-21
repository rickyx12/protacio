<?php
include("../../myDatabase2.php");
$registrationNo = $_POST['registrationNo'];
$hospitalBill = $_POST['hospitalBill'];
$professionalFee = $_POST['professionalFee'];
$case = $_POST['case'];

$ro = new database2();

$ro->addPhilhealthDeduction($registrationNo,$hospitalBill,$professionalFee,$case);



?>
