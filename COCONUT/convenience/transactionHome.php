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


$ro->transactNo();
$myFile = $ro->getReportInformation("homeRoot")."/COCONUT/convenience/transactionNo.dat";
$fh = fopen($myFile, 'r');
$transactionNo = fread($fh, 100);
fclose($fh);

echo "<br><br><br><CenteR>";
echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/convenience/transaction_handler.php'>";
$ro->coconutHidden("username",$username);
$ro->coconutHidden("transactionNo",$transactionNo);
echo "<input type=submit value='New Transaction' class='button'>";
echo "</form>";


?>
