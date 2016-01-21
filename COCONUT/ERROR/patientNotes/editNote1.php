<?php
include("../../myDatabase.php");
$registrationNo = $_POST['registrationNo'];
$noteNo = $_POST['noteNo'];
$noteMessage = $_POST['noteMessage'];
$noteType = $_POST['noteType'];

$ro = new database();

$ro->editNow("patientNotes","noteNo",$noteNo,"noteMessage",$noteMessage);
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientNotes/viewNote.php?noteType=$noteType&username=&registrationNo=$registrationNo");
?>
