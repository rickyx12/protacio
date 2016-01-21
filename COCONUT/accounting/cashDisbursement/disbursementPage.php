<?php
include("../../../myDatabase2.php");
$username = $_GET['username'];

$ro = new database2();
$ro->coconutDesign();

?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<style type="text/css">
a { text-decoration:none; color:red; }

.button{
	border: 1px solid #fff;
	color: #000;
	height: 28px;
	width: 381px;
	border-color:blue blue blue blue;
	font-size:15px;
	text-align:center;
	background-color:white;
}


.button1{
	border: 1px solid #fff;
	color: #000;
	height: 28px;
	width: 381px;
	border-color:red red red red;
	font-size:15px;
	text-align:center;
	background-color:white;
}

.button:hover {
background-color:yellow;
color:black;
}

.button1:hover {
background-color:yellow;
color:black;
}


</style>


<?php

echo "<center><br><br><br><br>";
echo "<form method='post' action='/COCONUT/accounting/cashDisbursement/transactionNo.php'>";
$ro->coconutHidden("username",$username);
echo "<input type=submit value='Add Disbursement Entry' class='button'>";
echo "</form>";

echo "<form method='post' action='/COCONUT/accounting/cashDisbursement/searchDisbursementEntry.php'>";
$ro->coconutHidden("username",$username);
echo "<input type=submit value='Edit/Delete Disbursement Entry' class='button'>";
echo "</form>";

echo "<form method='get' action='/COCONUT/accounting/cashDisbursement/disbursementReports.php'>";
$ro->coconutHidden("username",$username);
echo "<input type=submit value='View Disbursement Report' class='button'>";
echo "</form>";

?>
