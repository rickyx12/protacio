<?php
include("../../../myDatabase.php");
$stockCardNo1 = $_GET['stockCardNo1'];
$stockCardNo2 = $_GET['stockCardNo2'];

$ro = new database();


$ro->editNow("inventory","stockCardNo",$stockCardNo1,"stockCardNo",$stockCardNo2);
$ro->editNow("patientCharges","stockCardNo",$stockCardNo1,"stockCardNo",$stockCardNo2);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/inventory/stockCard/stockCardList.php");

?>
