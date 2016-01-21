<?php
include("../../../myDatabase.php");
$doctorName = $_GET['doctorName'];
$specialization1 = $_GET['specialization1'];
$specialization2 = $_GET['specialization2'];
$specialization3 = $_GET['specialization3'];
$specialization4 = $_GET['specialization4'];
$specialization5 = $_GET['specialization5'];
//$accreditationNo = $_GET['accreditationNo'];
$doctorCode = $_GET['doctorCode'];
$usernameDoctor = $_GET['usernameDoctor'];
$password = $_GET['password'];


$acc1 = $_GET['acc1'];
$acc2 = $_GET['acc2'];
$acc3 = $_GET['acc3'];
$acc4 = $_GET['acc4'];
$acc5 = $_GET['acc5'];
$acc6 = $_GET['acc6'];
$acc7 = $_GET['acc7'];
$acc8 = $_GET['acc8'];
$acc9 = $_GET['acc9'];
$acc10 = $_GET['acc10'];
$acc11 = $_GET['acc11'];
$acc12 = $_GET['acc12'];

$contactNo = $_GET['contactNo'];

$accreditationNo = $acc1."".$acc2."".$acc3."".$acc4."-".$acc5."".$acc6."".$acc7."".$acc8."".$acc9."".$acc10."".$acc11."-".$acc12;
$ro = new database();


$ro->editNow("Doctors","doctorCode",$doctorCode,"Name",$doctorName);
$ro->editNow("Doctors","doctorCode",$doctorCode,"Specialization1",$specialization1);
$ro->editNow("Doctors","doctorCode",$doctorCode,"Specialization2",$specialization2);
$ro->editNow("Doctors","doctorCode",$doctorCode,"Specialization3",$specialization3);
$ro->editNow("Doctors","doctorCode",$doctorCode,"Specialization4",$specialization4);
$ro->editNow("Doctors","doctorCode",$doctorCode,"Specialization5",$specialization5);
$ro->editNow("Doctors","doctorCode",$doctorCode,"PhilHealth_AccreditationNo",$accreditationNo);
$ro->editNow("Doctors","doctorCode",$doctorCode,"username",$usernameDoctor);
$ro->editNow("Doctors","doctorCode",$doctorCode,"password",$password);
$ro->editNow("Doctors","doctorCode",$doctorCode,"contact",$contactNo);



?>
