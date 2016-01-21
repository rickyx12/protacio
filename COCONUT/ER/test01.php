
<style type="text/css">
<!--
.style5 {font-family: Arial; font-size: 14px; font-weight: bold; color: #FFFFFF; }
.style7 {
	font-family: Arial;
	font-size: 12px;
	font-weight: bold;
	color: #000000;
}
.buttonwithoutborder {
	font-family: Arial;
	font-size: 12px;
	font-weight: bold;
	color: #000000;
	background-color: #FFFFFF;
	border: 1px solid #FFFFFF;
}
-->
</style>
<?php

mysql_connect("localhost","root","Pr0taci001");
mysql_select_db("Coconut");


$username=$_GET['username'];
$date=$_GET['date'];

echo "
<table border='1' cellpadding='0' cellspacing='0' bordercolor='#000000'>
  <tr>
    <td width='41' bgcolor='#3B5998'><div align='center' class='style5'>No.</div></td>
    <td bgcolor='#3B5998'><div align='center' class='style5'>Patient Name </div></td>
    <td width='50' bgcolor='#3B5998'><div align='center' class='style5'>&nbsp;</div></td>
  </tr>
";

$prsql=mysql_query("SELECT upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,rd.pxCount,rd.registrationNo from patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and rd.dateRegistered = '$date' and rd.finishER = '' order by rd.pxCount asc");

while($prfetch=mysql_fetch_array($prsql)){
$lname=$prfetch['lastName'];
$fname=$prfetch['firstName'];
$pxc=$prfetch['pxCount'];
$rn=$prfetch['registrationNo'];

$name=$lname.", ".$fname;

$address = "http://192.168.0.100/COCONUT/currentPatient/patientInterface1.php";
echo "
  <tr>
    <td bgcolor='#FFFFFF'><div align='center' class='style7'>$pxc</div></td>
    <form action='$address' method='post' name='Name' target='_blank'>
	<td bgcolor='#FFFFFF'><div align='left'>
	
      <input name='Submit' type='submit' class='buttonwithoutborder' value='$name' />
    
	</div></td>
	<input name='username' type='hidden' value='$username' />
	<input name='registrationNo' type='hidden' value='$rn' />
	</form>
    <td bgcolor='#FFFFFF'><div align='center'>
      <input name='Submit2' type='submit' class='buttonwithoutborder' value='OK' />
    </div></td>
  </tr>
";
}

echo "
</table>
";
?>
