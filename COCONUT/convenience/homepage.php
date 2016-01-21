<?php
include("../../convenienceDB.php");
$username = $_GET['username'];
$ro = new convenienceDB();

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


<?
echo "<br><br><br><CenteR>";
echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/convenience/inventory.php'>";
$ro->coconutHidden("username",$username);
echo "<input type=submit value='Inventory' class='button'>";
echo "</form>";

echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/convenience/transactionHome.php'>";
$ro->coconutHidden("username",$username);
echo "<input type=submit value='Transact' class='button1'>";
echo "</form>";

echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/convenience/reportShift.php'>";
$ro->coconutHidden("username",$username);
echo "<input type=submit value='Collection Report' class='button'>";
echo "</form>";

echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/convenience/inventoryAddedRep.php'>";
$ro->coconutHidden("username",$username);
echo "<input type=submit value='Inventory Added Report' class='button1'>";
echo "</form>";

?>
