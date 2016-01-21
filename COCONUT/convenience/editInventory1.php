<?php
include("../../myDatabase2.php");
$inventoryNo = $_POST['inventoryNo'];
$username = $_POST['username'];
$description = $_POST['description'];
$qty = $_POST['qty'];
$ro = new database2();

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
$ro->editNow("convenienceInventory","inventoryNo",$inventoryNo,"description",$description);
$ro->editNow("convenienceInventory","inventoryNo",$inventoryNo,"qty",$qty);

echo "<center><br><br><br>";
echo "<form method='post' action='http://".$ro->getMyUrl()."/COCONUT/convenience/viewInventory.php'>";
$ro->coconutHidden("username",$username);
echo "<input type=submit value='Back to Inventory List' class='button'>";
echo "</form>";


?>
