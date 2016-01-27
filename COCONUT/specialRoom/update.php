<?php
include("../../myDatabase.php");
$type = $_GET['type'];
$branch = $_GET['branch'];

$ro = new database();

$ro->coconutAjax("2000","http://".$ro->getMyUrl()."/COCONUT/specialRoom/specialRoom1.php?type=$type&branch=$branch");

?>
