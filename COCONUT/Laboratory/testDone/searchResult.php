<?php
include("../../../myDatabase2.php");
$search = $_GET['search'];
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
	font-size: 14px;
	color: #000000;
	font-weight: bold;
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
echo "<a href='testDone_rad.php' style='text-decoration:none;'><span class='style2'>Radiology</span></a>&nbsp;|&nbsp;";
echo "<a href='#' style='text-decoration:none;'><span class='style1'>Search Result</span></a>&nbsp;|&nbsp;";
//echo "<a href='#'><span class='style2'>Set Alert</sapn></a>&nbsp;|";
echo "<br>";
echo "<br>";
$ro->coconutFormStart("get","searchResult.php");
echo "<span class='style3'>Patient Name:&nbsp;</span>";
echo "<input type=text name='search' autocomplete='off' value='' style=' border:1px solid #000; height:25px; '>";
echo "<br><br>";

echo "<table border=1 cellspacing=0 rules=all class=style4>";
echo "<tr>";
echo "<Th>Patient</th>";
echo "<Th>Result</th>";
echo "<th>Realesed</th>";
echo "</tr>";
if( $search == "" ) {

}else {
$ro->listLaboratory_done_search("Mar","06",date("Y"),$search);
$ro->searchRadioResult("Mar","06",date("Y"),$search);
}
echo "</table>";
$ro->coconutFormStop();


?>
