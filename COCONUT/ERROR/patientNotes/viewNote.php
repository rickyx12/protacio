<?php
include("../../myDatabase.php");
$noteType = $_GET['noteType'];
$userName = $_GET['username'];
$registrationNo = $_GET['registrationNo'];


$ro = new database();
$ro->coconutDesign();
echo "<Center><Br><br>";
$ro->coconutFormStart("post","addNote.php?noteType=$noteType&username=$userName&registrationNo=$registrationNo");
$ro->coconutButton("Add Comments");
$ro->coconutFormStop();

$ro->showNotes($registrationNo,$noteType);

?>


