<?php
include("../../myDatabase1.php");
$registrationNo = $_GET['registrationNo'];
$ro = new database1();

$ro->getPatientProfile($registrationNo);


echo "<center><b><font size=5>".$ro->getReportInformation("hmoSOA_name")."</font></b></center>";
echo "<center><font size=3>".$ro->getReportInformation("hmoSOA_address")."</font></center>";
echo "<center><font size=2>Tel No. (062) 2143237</font></center>";
echo "<br>";
echo "<center>CONSENT FOR ADMISSION</center>";
echo "<br><br><br>";
echo "<Table border=0 width='100%'>";
echo "<tr>";
echo "<td width='70%'></td>";
echo "<td width='85%'>Date:&nbsp;".date("M d, Y")."</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I&nbsp;&nbsp;, _________________________________________________ hereby voluntarily and willingly authorized <br> &nbsp; Dr. <b><u>__".$ro->getAttendingDoc($registrationNo,"ATTENDING")."__</u></b>&nbsp; to treat and to admit __<b><u>".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()."</u></b>__ <br>&nbsp; at PAGADIAN CITY MEDICAL CENTER.";

echo "<br><br>";

echo "<Table border=0 width='100%'>";
echo "<tr>";
echo "<td width='70%'></td>";
echo "<td width='85%'>_________________________________________<br><font size=2>Signature Over Printed Name</font></td>";
echo "</tr>";

echo "<tr>";
echo "<td width='70%'></td>";
echo "<td width='85%'></td>";
echo "</tr>";

echo "<tr>";
echo "<td width='70%'></td>";
echo "<td width='85%'></td>";
echo "</tr>";

echo "<tr>";
echo "<td width='70%'></td>";
echo "<td width='85%'></td>";
echo "</tr>";

echo "<tr>";
echo "<td width='70%'></td>";
echo "<td width='85%'>_________________________________________<br><font size=2>Relationship</font></td>";
echo "</tr>";


echo "</table>";



////////////////////////////////
echo "<br><hr>";
echo "<center><b><font size=5>".$ro->getReportInformation("hmoSOA_name")."</font></b></center>";
echo "<center><font size=3>".$ro->getReportInformation("hmoSOA_address")."</font></center>";
echo "<center><font size=2>Tel No. (062) 2143237</font></center>";


echo "<center><b>INFORMED CONSENT FOR SURGERY,ANESTHESIA <br> OR OTHER PROCEDURES</b></center>";

echo "<table width='100%' border='0' >";
echo "<Tr>";
echo "<td>&nbsp;</td>";
echo "<td width='30%'>Date:&nbsp;".date("M d, Y")."</td>";
echo "</tr>";
echo "</table>";

echo "<br>";
echo "TO WHOM IT MAY CONCERN";
echo "<br><br>";
echo "&nbsp;&nbsp;&nbsp; I, __________________________________________________________ , _____________ years old<br><br>";
echo "married/single/widowed, hereby consent to the performance upon<br><br>____________________________________________________________________<br><Br>";
echo "who is my ___________________________, the procedure/operation/anesthesia hereunder <br><Br> 
stated after these have been fully explained to me by the doctors concerned including the risks involved and their alternative procedures:";

echo "<br><br>";

echo "<table border=0>";
echo "<Tr>";
echo "<th>&nbsp;Procedures/operation/anesthesia&nbsp;</th>";
echo "<Th>&nbsp;Explained by:&nbsp;</th>";
echo "</tr>";
echo "<tr>";
echo "<Td>_________________________________</td>";
echo "<Td>_________________________________</td>";
echo "</tr>";

echo "<tr>";
echo "<Td>_________________________________</td>";
echo "<Td>_________________________________</td>";
echo "</tr>";

echo "<tr>";
echo "<Td>_________________________________</td>";
echo "<Td>_________________________________</td>";
echo "</tr>";

echo "<tr>";
echo "<Td>_________________________________</td>";
echo "<Td>_________________________________</td>";
echo "</tr>";

echo "<tr>";
echo "<Td>_________________________________</td>";
echo "<Td>_________________________________</td>";
echo "</tr>";

echo "</table>";

echo "<br><br>";


echo "<Table border=0 width='100%'>";
echo "<tr>";
echo "<td width='70%'></td>";
echo "<td width='85%'>_________________________________________<br><font size=2>Signature Over Printed Name</font></td>";
echo "</tr>";

echo "<tr>";
echo "<td width='70%'></td>";
echo "<td width='85%'></td>";
echo "</tr>";

echo "<tr>";
echo "<td width='70%'></td>";
echo "<td width='85%'></td>";
echo "</tr>";

echo "<tr>";
echo "<td width='70%'></td>";
echo "<td width='85%'></td>";
echo "</tr>";

echo "<tr>";
echo "<td width='70%'></td>";
echo "<td width='85%'>_________________________________________<br><font size=2>Relationship</font></td>";
echo "</tr>";


echo "</table>";

echo "<br>";
echo "IN THE PRESENCE OF:";
echo "<table width='100%' border=0>";
echo "<tr>";
echo "<td>__________________________________<Br>Witness</td>";
echo "<td width='35%'>__________________________________<br>Address</td>";
echo "<tr>";
echo "</table>";



?>
