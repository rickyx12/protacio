<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$ro = new database();


?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />
<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS1.css" />


<?php

echo "<form method='get' action='addICD1.php'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<Br>";
echo "<br><center><div style='border:1px solid #000000; width:600px; height:auto; border-color:black black black black;'>";
echo "<br>";

echo "<Table border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<Td><font class='labelz'>ICD Code&nbsp;&nbsp;	</font></tD>";
echo "<td><input type=text name='icdCode' class='txtBox'></td>";
echo "</tr>";

echo "<tr>";
echo "<Td><font class='labelz'>RVS Code&nbsp;&nbsp;	</font></tD>";
echo "<td><input type=text name='rvsCode' class='txtBox'></td>";
echo "</tr>";

echo "<tr>";
echo "<Td><font class='labelz' name='diagnosis'>Diagnosis&nbsp;&nbsp;	</font></tD>";
echo "<td><textArea name='diagnosis' class='txtAreaBig'></textArea></td>";
echo "</tr>";

echo "<tr>";
echo "<Td><font class='labelz' name='group'>Group&nbsp;&nbsp;	</font></tD>";
echo "<td><textArea name='group' class='txtAreaBig'></textArea></td>";
echo "</tr>";

echo "<tr>";
echo "<Td><font class='labelz'>Case Rate&nbsp;&nbsp;	</font></tD>";
echo "<td><input type=text name='caseRate' class='txtBox'></td>";
echo "</tr>";

echo "<tr>";
echo "<Td><font class='labelz'>PF&nbsp;&nbsp;	</font></tD>";
echo "<td><input type=text name='pf' class='txtBox'></td>";
echo "</tr>";

echo "<tr>";
echo "<Td><font class='labelz'>Hospital&nbsp;&nbsp;	</font></tD>";
echo "<td><input type=text name='hospital' class='txtBox'></td>";
echo "</tr>";

echo "</table>";
echo "<Br>";
echo "<input type=submit value='Proceed'>";
echo "<div>";
echo "</form>";

?>
