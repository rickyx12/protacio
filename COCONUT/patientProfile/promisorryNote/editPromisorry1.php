<?php
include("../../../myDatabase1.php");
$registrationNo = $_POST['registrationNo'];
$username = $_POST['username'];
$month = $_POST['month'];
$day = $_POST['day'];
$year = $_POST['year'];
$month_due = $_POST['month_due'];
$day_due = $_POST['day_due'];
$year_due = $_POST['year_due'];
$promisorryNote = $_POST['promisorryNote'];
$balance = $_POST['balance'];

$ro = new database1();

$startDate = $month."_".$day."_".$year;
$dueDate = $month_due."_".$day_due."_".$year_due;


$ro->editNow("promisorryNote","registrationNo",$registrationNo,"startDate",$startDate);
$ro->editNow("promisorryNote","registrationNo",$registrationNo,"dueDate",$dueDate);
$ro->editNow("promisorryNote","registrationNo",$registrationNo,"amount",$balance);
$ro->editNow("promisorryNote","registrationNo",$registrationNo,"note",$promisorryNote);
$ro->editNow("promisorryNote","registrationNo",$registrationNo,"postedBy",$username);

header("Location: /COCONUT/patientProfile/patientProfile_handler.php?registrationNo=$registrationNo&username=$username");


?>
