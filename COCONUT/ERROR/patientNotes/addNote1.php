<?php
include("../../myDatabase.php");
$registrationNo = $_POST['registrationNo'];
$noteType = $_POST['noteType'];
$noteBy = $_POST['noteBy'];
$noteMessage = $_POST['noteMessage'];

$ro = new database();

$ro->addNewNote($registrationNo,$noteType,$noteBy,$noteMessage,date("M_d_Y"),$ro->getSynapseTime());


?>
