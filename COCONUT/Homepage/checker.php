<?php
include("../../myDatabase.php");
$code = $_POST['code'];

$ro = new database();

$codeEntered = preg_split ("/\_/", $code); 

$ro->checkCode($codeEntered[0],$codeEntered[1]);



?>
