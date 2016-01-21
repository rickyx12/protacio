<?php
include("../../../myDatabase.php");
$itemNo = $_GET['itemNo'];
$registrationNo = $_GET['registrationNo'];
$show = $_GET['show'];
$username = $_GET['username'];
$countz = count($itemNo);


$ro = new database();
$ro->getPatientProfile($registrationNo);
?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<?php



echo "<br><center><div style='border:1px solid #000000; width:825px; height:auto; border-color:black black black black;'>";
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
echo "<td><font size=2>".$ro->getRegistrationDetails_branch()."</font></tD>";
echo "</tr>";



echo "</table>";
echo "<br>";

echo "<Table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo "<th width='30%'>&nbsp;<font class='heading'><b>Particulars</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>QTY</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PRICE</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>DATE</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>DISC</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>TOTAL</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PAID</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>COMPANY</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PhilHealth</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>UNPAID</b></font>&nbsp;</th>";
if($ro->getRegistrationDetails_type() == "IPD") {
echo "";
}else {
//echo  "<th>&nbsp;<font class='heading'><b>UNPAID</b></font>&nbsp;</th>";
}
echo "</tr>";
for($x=0;$x<$countz;$x++) {
$ro->chargesForSOA_showSelected($registrationNo,$itemNo[$x]);
}
echo "<tr>";
echo "<Td><center><font class='heading'><b>TOTAL</b></font></center></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format(($ro->soa_sellingPrice() + $ro->soa_pfCash()),2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($ro->soa_discount(),2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($ro->soa_total(),2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($ro->soa_paid(),2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($ro->soa_company(),2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($ro->soa_phic(),2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($ro->soa_cashUnpaid(),2)."</b></font>&nbsp;</td>";
echo "</table>";
echo "<Br>";
if($ro->getRegistrationDetails_type() == "IPD") {
$ro->viewPayment_soa($registrationNo,$ro->soa_cashUnpaid());
}else{
echo "<br>__________________________<br><font size=2>Cashier / Billing</font><br>";
}

echo "</div>";

?>
