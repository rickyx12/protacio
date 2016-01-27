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
echo "<Center><br><br><Br>";
$ro->coconutBoxStart("500","200");
echo "<Br>";
echo "<form method='post' action='http://".$ro->getMyUrl()."/COCONUT/convenience/addInventory.php'>";
$ro->coconutHidden("username",$username);
echo "<input type=submit value='Add Inventory' class='button'>";
echo "</form>";


echo "<form method='post' action='http://".$ro->getMyUrl()."/COCONUT/convenience/viewInventory.php'>";
$ro->coconutHidden("username",$username);
echo "<input type=submit value='View Inventory' class='button'>";
echo "</form>";

$ro->coconutBoxStop();




?>
