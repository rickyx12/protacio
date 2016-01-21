<?php
include("../../myDatabase.php");
$username = $_GET['username'];
$serviceName = $_GET['serviceName'];
$specialization = $_GET['specialization'];
$cashAmount = $_GET['cashAmount'];
$companyRate = $_GET['companyRate'];
$doctorShare = $_GET['doctorShare'];
$discount = $_GET['discount'];
$phic = $_GET['phic'];


$ro = new database();



$ro->addNewDoctorService($serviceName,$specialization,$cashAmount,$companyRate,$doctorShare,$discount,$username,$phic);

?>
