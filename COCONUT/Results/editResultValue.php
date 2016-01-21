<?php
include("../../myDatabase.php");
$description = $_GET['description'];
$pathologist = $_GET['pathologist'];
$medTech = $_GET['medTech'];
$receivedMonth = $_GET['receivedMonth'];
$receivedDay = $_GET['receivedDay'];
$receivedYear = $_GET['receivedYear'];
$releasedMonth = $_GET['releasedMonth'];
$releasedDay = $_GET['releasedDay'];
$releasedYear = $_GET['releasedYear'];
$branch = $_GET['branch'];
$labNoz = $_GET['labNoz'];
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$ro = new database();

$ro->getValueForEdit($labNoz);

?>

