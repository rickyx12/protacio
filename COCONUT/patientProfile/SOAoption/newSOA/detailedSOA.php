<?php
include("../../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$show = $_GET['show'];

$ro = new database2();
$ro->getPatientProfile($registrationNo);
$ro->soap_setter($registrationNo);
?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<?php

echo "<center><img src='http://".$ro->getMyUrl()."/COCONUT/myImages/mendero.png' width='50%' height='25%'></center>";

echo "<br><center><div style='border:0px solid #000000; width:825px; height:auto; border-color:black black black black;'>";
//echo "<font size=4><b>".$ro->getReportInformation("hmoSOA_name")."</b></font><br>";
//echo "<font size=2>".$ro->getReportInformation("hmoSOA_address")."</font><br>";
//echo "<font size=2>".$ro->getRegistrationDetails_branch()."</font><br>";
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
echo "<tD><font class='labelz'>".$ro->soap_assessmentz()." &nbsp;&nbsp; ".$ro->selectNow("registrationDetails","finalDiagnosis","registrationNo",$registrationNo)."</font></tD>";
echo "</tr>";
echo "</table>";


echo "<Table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo  "<th>&nbsp;<font class='heading'><b>DATE</b></font>&nbsp;</th>";
echo "<th width='30%'>&nbsp;<font class='heading'><b>Particulars</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>QTY</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PRICE</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>DISC</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>TOTAL</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>CASH</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>COMPANY</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PhilHealth</b></font>&nbsp;</th>";
echo "</tr>";
$ro->getPatientChargesForNewSOA($registrationNo,"inventory");
$ro->getPatientChargesForNewSOA($registrationNo,"");
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<b>TOTAL</b></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;".number_format($ro->getPatientChargesForNewSOA_total_total() + $ro->getPatientChargesForNewSOA_inventory_total_total(),2)."</td>";
echo "<td>&nbsp;".number_format($ro->getPatientChargesForNewSOA_total_cashUnpaid() + $ro->getPatientChargesForNewSOA_inventory_total_cashUnpaid(),2)."</td>";
echo "<td>&nbsp;".number_format($ro->getPatientChargesForNewSOA_total_company() + $ro->getPatientChargesForNewSOA_inventory_total_company(),2)."</td>";
echo "<td>&nbsp;".number_format($ro->getPatientChargesForNewSOA_total_phic() + $ro->getPatientChargesForNewSOA_inventory_total_phic(),2)."</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
echo "</div>";

?>
