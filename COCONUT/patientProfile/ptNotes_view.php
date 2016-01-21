<?php
include("../../myDatabase.php");
$ptNotesNo = $_GET['ptNotesNo'];

$ro = new database();
?>


<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<?php

echo "
<style type='text/css'>

.txtArea {
	border: 1px solid #000;
	color: #000;
	height: 80px;
	width: 470px;
	padding:4px 4px 4px 5px;
}

</style>
";
echo "<br><center><font size=2></font><center><div style='border:1px solid #000000; width:600px; height:485px; border-color:black black black black;'>";
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td><font size=4 color=red>S</font><font size=3>ubjective</font><br><textarea name='subjective' class='txtArea'>".$ro->selectNow("ptNotes","subjective","ptNotesNo",$ptNotesNo)."</textarea></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font size=4 color=red>O</font><font size=3>bjective</font><br><textarea name='objective' class='txtArea'>".$ro->selectNow("ptNotes","objective","ptNotesNo",$ptNotesNo)."</textarea></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font size=4 color=red>A</font><font size=3>ssessment</font><br><textarea name='assessment' class='txtArea'>".$ro->selectNow("ptNotes","assessment","ptNotesNo",$ptNotesNo)."</textarea></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font size=4 color=red>P</font><font size=3>lan</font><br><textarea name='plan' class='txtArea'>".$ro->selectNow("ptNotes","plan","ptNotesNo",$ptNotesNo)."</textarea></td>";
echo "</tr>";
echo "</table>";
echo "<br>";
echo "</div>";



?>
