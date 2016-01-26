<?php
include("../myDatabase.php");
$patientNo = $_GET['patientNo'];
$from = $_GET['from'];
$ro = new database();

$ro->editNow("patientRecord","patientNo",$patientNo,"statusz","DELETED_".date("Y-m-d"));

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/opdRegistration.php?module=REGISTRATION&from=$from");

?>
