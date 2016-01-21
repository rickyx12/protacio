<?php
include("../../../myDatabase.php");

$serviceNo = $_GET['serviceNo'];
$serviceName = $_GET['serviceName'];
$specialization = $_GET['specialization'];
$cashAmount = $_GET['cashAmount'];
$companyRate = $_GET['companyRate'];
$doctorShare = $_GET['doctorShare'];
$discount = $_GET['discount'];
$phic = $_GET['phic'];


$ro = new database();

$ro->editNow("DoctorService","serviceNo",$serviceNo,"serviceName",$serviceName);
$ro->editNow("DoctorService","serviceNo",$serviceNo,"specialization",$specialization);
$ro->editNow("DoctorService","serviceNo",$serviceNo,"cashAmount",$cashAmount);
$ro->editNow("DoctorService","serviceNo",$serviceNo,"companyRate",$companyRate);
$ro->editNow("DoctorService","serviceNo",$serviceNo,"doctorShare",$doctorShare);
$ro->editNow("DoctorService","serviceNo",$serviceNo,"discount",$discount);
$ro->editNow("DoctorService","serviceNo",$serviceNo,"phic",$phic);



?>
