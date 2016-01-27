<?php
include("../../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$protoType = $_GET['protoType'];
$room = $_GET['room'];
$username = $_GET['username'];

$ro = new database();

?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<?php

echo "<br><br><br><Br><br>";

if ($ro->selectNow("registeredUser","module","username",$username) == "BILLING" || $ro->selectNow("registeredUser","module","username",$username) == "PHARMACY" || $ro->selectNow("registeredUser","module","username",$username) == "CASHIER" || $ro->selectNow("registeredUser","module","username",$username) == "ER" || $ro->selectNow("registeredUser","module","username",$username) == "PHILHEALTH" ) {


echo "<form method='get' action='discharged1.php'>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='protoType' value='$protoType'>";
echo "<input type=hidden name='room' value='$room'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<center><div style='border:1px solid #ff0000; width:400px; height:100px;	'>";

if($protoType == "Discharged") {
echo "<br><font size=2 color=red>Are you sure you want to Discharge this Patient </font>";
}else {
echo "<br><font size=2 color=red>Are you sure you want to Undischarge this Patient </font>";
}

echo "<br><Br><input type=submit value='Yes' style='border:1px solid #ff0000; background-color:transparent;'>";
echo "</div>";
echo "</form>";


}else {
echo "<font color=red>Only Billing Can Discharge =)</font>";
}
?>
