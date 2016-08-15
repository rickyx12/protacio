<?php
include("../../myDatabase3.php");

$datez = $_POST['datez'];
$datez1 = $_POST['datez1'];

$ro = new database3();

echo $ro->formatDate($datez)."<br>".$ro->formatDate($datez1);

$ro->expenses_dashboard($datez,$datez1);

?>
