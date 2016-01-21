<?php
include("../../../storedProcedure.php");
$date = $_GET['date'];
$ro = new storedProcedure();
$ro->coconutDesign();

echo "<script src='http://".$ro->getMyUrl()."/COCONUT/js/jquery-1.9.1.js'></script>";
echo "<script src='http://".$ro->getMyUrl()."/COCONUT/js/jquery-ui.js'></script>";
echo "<link rel='stylesheet' type='text/css' href='http://".$ro->getMyUrl()."/COCONUT/myCSS/jquery-ui.css' />";

echo "<script>";
echo "$(function() {
$('#date').datepicker({ 'dateFormat':'yy-mm-dd' });
});
";
echo "</script>";

echo "<br><Br><br><br><br>";
$ro->coconutFormStart("post","requestStatus.php");
$ro->coconutBoxStart("500","100");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<Td>Date</td>";
echo "<Td>";
$ro->coconutTextBox("date",$date);
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
