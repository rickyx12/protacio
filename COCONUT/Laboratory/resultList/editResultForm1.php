<?php
include("../../../myDatabase1.php");
$templateNo = $_POST['templateNo'];
$title = $_POST['title'];
$formTemplate = $_POST['formTemplate'];

$ro = new database1();

$ro->editNow("labResultList","templateNo",$templateNo,"title",$title);
$ro->editNow("labResultList","templateNo",$templateNo,"template",$formTemplate);

echo "<script type='text/javascript' >";
echo  "window.location='http://".$this->getMyUrl()."/COCONUT/Laboratory/resultList/resultFormMasterfile.php '";
echo "</script>";


?>
