<?php
include("../../../myDatabase.php");
$batchNo = $_GET['batchNo'];
$username = $_GET['username'];

$ro = new database();

$ro->coconutAjax("1500","http://".$ro->getMyUrl()."/COCONUT/requestition/batchRequest/showCart.php?batchNo=$batchNo&username=$username");

?>
