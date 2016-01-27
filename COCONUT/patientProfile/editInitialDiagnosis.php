<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database();

$ro->getPatientProfile($registrationNo);
?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />
<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS1.css" />

<?


echo "
<style type='text/css'>
.initialDiagnosis {
	border: 1px solid #000;
	color: #000;
	height:120px;
	width: 390px;
	padding:4px 4px 4px 2px;
}
</style>
";

echo "<form method='get' action='editInitialDiagnosis1.php'>";

echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<center><br><div style='border:1px solid #000000; width:500px; height:350px; border-color:black black black black;'>";

echo "<Br><font size=2>Chief Complaint</font><br>";
echo "<textarea name='initialDiagnosis' class='initialDiagnosis'>".$ro->getRegistrationDetails_initialDiagnosis()."</textarea>";
echo "<br>";


echo "<Br><font size=2>Initial Diagnosis</font><br>";
echo "<textarea name='IxDx' class='initialDiagnosis'>".$ro->getRegistrationDetails_IxDx()."</textarea>";
echo "<br>";

//echo "<Br><font size=2>Final Diagnosis</font><br>";
//echo "<textarea name='finalDiagnosis' class='initialDiagnosis'>".$ro->getRegistrationDetails_finalDiagnosis()."</textarea>";

echo "<br><br><input type=submit value='edit' style='border:1px solid #000000; background:#3b5998 no-repeat 4px 4px; color:white;'>";

echo "</div>";

echo "</form>";


echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/philhealth/icdCode/addICD1.php'>";
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
echo "<Td><font class='labelz' name='diagnosis'>Diagnosis&nbsp;&nbsp;	</font></tD>";
echo "<td><textArea name='diagnosis' class='txtAreaBig'></textArea></td>";
echo "</tr>";
echo "</table>";
echo "<Br>";
echo "<input type=submit value='Proceed'>";
echo "<div>";
echo "</form>";


?>
