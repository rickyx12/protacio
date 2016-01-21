<?php
include("../../myDatabase1.php");
$registrationNo = $_GET['registrationNo'];

$ro = new database1();

$ro->getPatientProfile($registrationNo);

?>


<script type="text/javascript">


function printF(printData)
{
	var a = window.open ('',  '',"status=1,scrollbars=1, width=auto,height=auto");
	a.document.write(document.getElementById(printData).innerHTML.replace(/<a\/?[^>]+>/gi, ''));
	a.document.close();
	a.focus();
	a.print();
	a.close();
}
</script>

<div id='printData'>
<a href="#" onClick="printF('printData');" style="text-decoration:none; color:black;"><?php echo "<center><font size=5>".$ro->getReportInformation("hmoSOA_name")."</font></center>"; ?></a>

<?php

echo " <style type='text/css'>  ";
echo "
.underLine {
border-color:transparent transparent black transparent;
width:400px;
font-size:17px;
}

.headLine {
border-color:transparent transparent black transparent;
width:150px;
font-size:17px;
}

.age {
border-color:transparent transparent black transparent;
width:280px;
font-size:17px;
}


.underLine2 {
border-color:transparent transparent black transparent;
text-align:center;
font-size:17px;
width:212px;
}

.hidez {
border-color:transparent transparent transparent transparent;
text-align:center;
font-size:17px;
width:212px;
}


.underLine3 {
border-color:transparent transparent black transparent;
text-align:center;
font-size:17px;
width:600px;
}


.underLine4 {
border-color:transparent transparent black transparent;
text-align:center;
font-size:13px;
width:200px;
}


";
echo "</style>";

echo "<center>";

echo "<font size=3>".$ro->getReportInformation("hmoSOA_address")."</font>";

echo "<br><Br><Br><br><Br>";

echo "<b><u><font size=5>MEDICAL CERTIFICATE</font></u></b>";

echo "<br><Br><Br>";
echo "</center>";
echo "<table border=0>";

echo "<tr>";
echo "<td width='25%'>&nbsp;</td>";
echo "<td width='10%'><input type='text' class='headLine'  value='".date("M d, Y")."'><br><font size=2>Date</font></td>";
echo "</tr>";


echo "<tr>";
echo "<td width='25%'>&nbsp;</td>";
echo "<td width='10%'><input type='text' class='headLine'  value='".$registrationNo."'><br><font size=2>(Registration Number)</font></td>";
echo "</tr>";

echo "</table>";

echo "<br><Br>";

echo "<center>";
$ro->coconutFormStart("get","medicalCertificate1.php");
echo "<table border=0>";

echo "<tr>";
echo "<td width='45%'>&nbsp;<B><font size=3>TO WHOM IT MAY CONCERN:</font></b></td>";
echo "<td width='40%'>&nbsp;</td>";
echo "</tr>";
echo "</table>";

echo "<br>";

echo "<table border=0>";
echo "<tr>";
echo "<td>THIS IS TO CERTIFY THAT <input type=text class='underLine' value='".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()."'></td>";
echo "</tr>";
echo "</table>";


echo "<table border=0>";
echo "<tr>";
echo "<td><font size=2>AGE</font> <input type=text class='age' value='".$ro->getPatientRecord_age()."    Years Old'> <font size=2>WAS EXAMINED AND TREATED/CONFINED IN </font></td>";
echo "</tr>";
echo "</table>";

echo "<table border=0>";
echo "<tr>";
echo "<td><font size=2>THIS HOSPITAL FROM <input type=text class='underLine2' value='".$ro->getRegistrationDetails_dateRegistered()."'></font>
</td>";
echo "</tr>";
echo "<tr>";
echo "<td><font size=2>WITH THE FOLLOWING FINDINGS AND OR DIAGNOSIS:</font><input type='text' name='d1' class='hidez'></td>";
echo "</tr>";

echo "</table>";
echo "<input type=text name='d3' class='underLine3'>";
echo "<br><Br>";

echo "<table border=0>";
echo "<tr>";
echo "<td><font size=2>THE CERTIFICATION IS ISSUED UPON REQUEST OF</font> <input type=text class='underLine'> </td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size=2>FOR</font> <input type=text class='underLine3'> </td>";
echo "</tr>";

echo "</table>";

echo "<br><br>";

echo "<table border=0>";

echo "<tr>";
echo "<td width='25%'>&nbsp;</td>";
echo "<td width='10%'><input type='text' class='underLine4'  value='".$ro->getAttendingDoc($registrationNo,"Attending")."'><br>&nbsp;&nbsp;<font size=2>ATTENDING PHYSICIAN</font></td>";
echo "</tr>";

echo "</table>";
$ro->coconutHidden("registrationNo",$registrationNo);
//$ro->coconutButton("Printable Version");
$ro->coconutFormStop();
?>
</div>
