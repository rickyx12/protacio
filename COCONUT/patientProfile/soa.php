<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$show = $_GET['show'];

$ro = new database();
$ro->getPatientProfile($registrationNo);
$ro->soap_setter($registrationNo);
?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<?php
echo "<br><center><div style='border:0px solid #000000; width:825px; height:auto; border-color:black black black black;'>";
echo "<font size=4><b>".$ro->getReportInformation("hmoSOA_name")."</b></font><br>";
echo "<font size=2>".$ro->getReportInformation("hmoSOA_address")."</font><br>";
echo "<font size=2>".$ro->getRegistrationDetails_branch()."</font><br>";
echo "<br><br>";
echo "<table border=0>";
echo "<tr>";
echo "<td><font class='labelz'><b>Name:</b></font></td><td><font size=2>".$ro->getPatientRecord_completeName()."</font></td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
echo "<Td><font class='labelz'><b>Registration#:</b></font></td>";
echo "<td><font size=2>".$ro->getRegistrationDetails_registrationNo()."</td>";
echo "</tr>";
echo "<tr>";
echo "<Td><font class='labelz'><B>Age:</b></td>";
echo "<Td><font size=2>".$ro->getPatientRecord_age()." yrs Old</font></td>";
echo "<Td>&nbsp;</td>";
echo "<td><font class='labelz'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Senior:</b></font></td>";
echo "<td><font size=2>".$ro->getPatientRecord_senior()."</font></td>";
echo "</tr>";
echo "<tr>";
echo "<Td><font class='labelz'><b>Company:</b></font></td>";
echo "<td><font size=2>".$ro->getRegistrationDetails_company()."</font></tD>";
echo "<td><font class='labelz'>Diagnosis:</font></td>";
echo "<tD><font class='labelz'>".$ro->soap_assessmentz()."</font></tD>";
echo "</tr>";
if($ro->getRegistrationDetails_type() == "IPD") {
$ro->chargesForSOA_ipd($registrationNo,$show,"","");
}else {
$ro->chargesForSOA($registrationNo,$show,"","");
}

echo "</table>";
echo "<br>";
echo "</div>";

?>
