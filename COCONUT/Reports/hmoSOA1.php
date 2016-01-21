<?php
include("../../myDatabase.php");
$company = $_GET['company'];
$fromMonth = $_GET['fromMonth'];
$fromDay = $_GET['fromDay'];
$fromYear = $_GET['fromYear'];
$toMonth = $_GET['toMonth'];
$toDay = $_GET['toDay'];
$toYear = $_GET['toYear'];
$branch = $_GET['branch'];
$ro = new database();

echo "<img src='http://".$ro->getMyUrl()."/COCONUT/myImages/ProtacioHeader.png' width='100%' height='150px'>";

echo "<br><br><br>";

echo "<table border=0 width='50%'>";
echo "<tr>";
echo "<td><b>TO:</b>&nbsp;<font color='blue'><b>$company</b></font></td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
echo "<tr>";
echo "<td><b>FR:</b>&nbsp;<b>PROTACIO HOSPITAL</b></td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
echo "<tr>";
echo "<td><b>ATTN:&nbsp;ACCOUNTING DEPARTMENT</b></td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->getHmoSOA("OPD",$company,$fromMonth,$fromDay,$fromYear,$toMonth,$toDay,$toYear,"USERNAME",$branch);

echo "<table width='100%'>";
echo "<tr>";
echo "<td ALIGN='RIGHT'>CERTIFIED TRUE AND CORRECT<BR><br><br><br><br>ANA MARIE DAVID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<BR>ACCOUNTING STAFF&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
echo "</tr>";
echo "</table>";
?>
