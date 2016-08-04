<?php
include("../../../myDatabase.php");
$module = $_GET['module'];
$username = $_GET['username'];
$reportName = $_GET['reportName'];
$status = $_GET['status'];
$ro = new database();

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

.button2{
	border: 1px solid #fff;
	color: #000;
	height: 28px;
	width: 381px;
	border-color:green green green green;
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

.button2:hover {
background-color:green;
color:black;
}


</style>


<?php


echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br><center><div style='border:1px solid #000000; width:495px; height:auto; border-color:black black black black;'>";
echo "<br>";


echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/Cashier/cashierReport/reportShift.php' target='_blank'>";
$ro->coconutHidden("module",$module);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("reportName",$reportName);
$ro->coconutHidden("status",$status);
echo "<input type=submit value='Daily Collection Report' class='button'>";
echo "</form>";


echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/Cashier/cashierReport/dailyCashiersReport_date.php'>";
echo "<input type=submit value='Daily Cashiers Report' class='button'>";
echo "</form>";


echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/Cashier/cashierReport/CollectionReportSD.php' target='_blank'>";
$ro->coconutHidden("username",$username);
echo "<input type=submit value='Collection Report' class='button2'>";
echo "</form>";

echo "<Br>";
echo "</div>";

?>
