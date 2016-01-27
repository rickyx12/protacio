<?php
include("../../systemBiller.php");
$registrationNo = $_GET['registrationNo'];
$title = $_GET['title'];

$systemBiller = new systemBiller();
$systemBiller->coconutDesign();
//echo $systemBiller->systemBiller_getTotal($title,$registrationNo);

$systemBiller->coconutBoxStart("500","300");
echo "<Br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Title&nbsp;</tD>";
echo "<Td>";
$systemBiller->coconutTextBox_readonly("title",$title);
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<td>Total&nbsp;</tD>";
echo "<Td>";
$systemBiller->coconutTextBox_readonly("total",$systemBiller->systemBiller_getTotal($title,$registrationNo));
echo "</td>";
echo "</tr>";

echo "</table>";
echo "<Br><hr>";

$systemBiller->coconutBoxStop();


?>
