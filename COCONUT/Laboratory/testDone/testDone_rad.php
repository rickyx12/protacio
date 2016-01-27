<?php
include("../../../myDatabase2.php");

$ro = new database2();

echo "
<style type='text/css'>
<!--
body {
	background-image: url(../../../../Resources/BGLogo.png);
}
.style1 {
	font-family: Arial;
	font-size: 12px;
	color: #0033FF;
	font-weight: bold;
}
.style2 {
	font-family: Arial;
	font-size: 12px;
	color: #FF0000;
	font-weight: bold;
}
.style3 {
	font-family: Arial;
	font-size: 20px;
	color: #000000;
	font-weight: bold;
	font-style: italic;
}
.style4 {
	font-family: Arial;
	font-size: 14px;
	color: #000000;
	font-weight: bold;
}
.style5 {
	font-family: Arial;
	font-size: 20px;
	color: #000000;
	font-weight: bold;
	font-style: italic;
}
-->
</style>
";

echo "|&nbsp;<a href='testDone.php' style='text-decoration:none;'><span class='style2'>All Results</span></a>&nbsp;|&nbsp;<a href='testDone_lab.php' style='text-decoration:none;'><span class='style2'>Laboratory</span></a>";
echo "&nbsp;|&nbsp;";
echo "<a href='testDone_rad.php' style='text-decoration:none;'><span class='style1'>Radiology</span></a>&nbsp;|&nbsp;";
echo "<a href='searchResult.php?search=' style='text-decoration:none;'><span class='style2'>Search Result</span></a>&nbsp;|&nbsp;";
//echo "<a href='#'><span class='style2'>Set Alert</span></a>&nbsp;|";
echo "<br>";
echo "<table border=1 cellspacing=0 rules=all class=style4>";
echo "<tr>";
echo "<Th>Patient</th>";
echo "<Th>Result</th>";
echo "<th>Realesed</th>";
echo "</tr>";
$ro->listRadioResult(date("m"),date("d"),date("Y"));
echo "</table>";


?>
