<?php
include("../../../myDatabase1.php");
$title = $_POST['title'];
$formTemplate = $_POST['formTemplate'];

$ro = new database1();


$ro->addLaboratoryTemplate($title,$formTemplate);



?>
