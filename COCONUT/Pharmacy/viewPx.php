<?php
include("../../myDatabase3.php");
$username = $_GET['username'];
$ro = new database3();

$ro->coconutFormStart("get","viewPx1.php");
$ro->coconutHidden("username",$username);
echo "<input type='text' name='patientCount' value='' autocomplete='off' style='border:1px solid #ff0000; height:5%;'  placeholder='&nbsp;Patient Count' >";
$ro->coconutFormStop();

?>
