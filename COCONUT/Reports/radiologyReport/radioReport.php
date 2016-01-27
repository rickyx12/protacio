<html>
<head>
<?php
include("../../../myDatabase1.php");
$report = $_GET['report'];
$doctor = $_GET['doctor'];
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$description = $_GET['description'];
$radtech = $_GET['radtech'];

$ro = new database1();

$ro->getPatientProfile($registrationNo);

echo "

<style type='text/css'>

#reportx {
	border: 1px solid #000;
	color: #000;
	height:900px;
	width:900px;
	padding:4px 4px 4px 5px;
	font-size:20px;
}

</style>



";

?>

	<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>


</head>
<body>
<?php
echo "<br>";



echo "<center><font size=4><b>Radiology Report</b></font></center>";

$ro->coconutFormStart("get","radioReport_insert.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("itemNo",$itemNo);
$ro->coconutHidden("physician",$doctor);
$ro->coconutHidden("radtech",$radtech);
echo " <div class='shadow' id='shadow'> <div class='output' id='output'> ";
echo "<table border=0 width='100%'>";
echo "<tr>";
echo "<td><b>Last Name:</b>&nbsp;".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()." </td>";
echo "<td>Date:&nbsp;<b>".date("M d, Y")."</b></td>";
echo "</tr>";

echo "<tr>";
echo "<td><b>AGE:&nbsp;</b>".$ro->getPatientRecord_age()."/".$ro->getPatientRecord_gender()."</td>";
echo "<td></td>";
echo "</tr>";

echo "<tr>";
echo "<td><b>PROCEDURE:</b>&nbsp;$description</td>";
echo "<td></td>";
echo "</tr>";

echo "<tr>";
echo "<td></td>";

echo "</tr>";

echo "<tr>";
echo "<td></td>";

echo "</tr>";

echo "</table>";


$text = $ro->selectNow("radioReportList","report","title",$report);
//$breaks = array("<br>","<br/>","<b>","</b>");  
//$text1 = str_ireplace($breaks, "\r\n",$text);  

echo "<textarea id='report' name='radioReport'>"; 
echo $text;
echo"</textarea>";

echo "<br>";
echo "<input type='checkbox' name='approved'><font color=red>Approved</font>";
echo "<bR><br>";
$ro->coconutButton("Proceed");
$ro->coconutFormStop();

echo "</div></div>";

?>

<script type="text/javascript" src="http://<?php echo $ro->getMyUrl(); ?>/jquery.js"></script>
<script type="text/javascript" src="http://<?php echo $ro->getMyUrl(); ?>/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/jquery.autocomplete.css" />
<link href="adico.css" rel="stylesheet" type="text/css">


<script type="text/javascript">

			
			CKEDITOR.replace( 'report',
	{
		enterMode : CKEDITOR.ENTER_BR,
		skin : 'office2003',
		height: '400px'

	});
	


</script>

<Br>


</body>
</html>

