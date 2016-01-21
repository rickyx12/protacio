<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$medicine = $_GET['medicine'];
$timing = $_GET['timing'];
$instruction = $_GET['instruction'];
$indication = $_GET['indication'];
$qty = $_GET['qty'];


$ro = new database2();

if( $medicine == "" ) {
echo "<script> alert('Pls Include a Medicine'); history.back(-1)</script>";
}else {
$ro->addNewPlan($registrationNo,$medicine,$timing,$instruction,$indication,$qty);
}


?>
