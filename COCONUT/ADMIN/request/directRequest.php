<?php
include("encrypt.php");


$ro = new Encryption();
$ro->coconutDesign();
echo "<br><br><br>";
$ro->coconutBoxStart("500","200");
echo "<Br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Description</td>";
echo "<td>".$ro->coconutTextBox_return("description","")."</td>";
echo "</tr>";
echo "</table>";
$ro->coconutBoxStop();


?>
