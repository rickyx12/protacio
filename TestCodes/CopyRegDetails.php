<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Test Codes</title>
<script type="text/JavaScript">
<!--
function placeFocus() {
if (document.forms.length > 0) {
var field = document.forms[0];
for (i = 0; i < field.length; i++) {
if ((field.elements[i].type == "text") || (field.elements[i].type == "textarea") || (field.elements[i].type.toString().charAt(0) == "s")) {
document.forms[0].elements[i].focus();
break;
         }
      }
   }
}

//-->
</script>
<style type="text/css">
<!--
.style1 {
	font-family: Arial;
	font-size: 14px;
	font-weight: bold;
	color: #000000;
}
.style2 {
	font-family: Arial;
	font-size: 12px;
	font-weight: bold;
	color: #000000;
}
.style3 {
	font-family: Arial;
	font-size: 12px;
	font-weight: bold;
	color: #FFFFFF;
}
.textfield01 {
	font-family: Arial;
	font-size: 12px;
	font-weight: bold;
	color: #000000;
	background-color: #FFFFFF;
	border: 1px solid #000000;
}
.button01 {
	font-family: Arial;
	font-size: 12px;
	font-weight: bold;
	color: #000000;
	background-color: #FFFFFF;
	border: 1px solid #000000;
}
-->
</style>
</head>

<body onload="placeFocus()">
<?php
include("../myDatabase.php");
$ro = new database();


$patientNo=$_GET['patientNo'];
$registrationNo=$_GET['registrationNo'];

echo "<div align='left' class='style1'>Copyying Registration Details... </div>";

$x=mysql_connect("192.168.1.209","root","hokage");
mysql_select_db('Coconut', $x);
$asql=mysql_query("SELECT * FROM registrationDetails WHERE registrationNo='$registrationNo'");
while($afetch=mysql_fetch_array($asql)){
$bloodPressure=$afetch['bloodPressure'];
$temperature=$afetch['temperature'];
$height=$afetch['height'];
$weight=$afetch['weight'];
$Company=$afetch['Company'];
$initialDiagnosis=$afetch['initialDiagnosis'];
$IxDx=$afetch['IxDx'];
$finalDiagnosis=$afetch['finalDiagnosis'];
$dateRegistered=$afetch['dateRegistered'];
$dateUnregistered=$afetch['dateUnregistered'];
$timeRegistered=$afetch['timeRegistered'];
$timeUnregistered=$afetch['timeUnregistered'];
$branch=$afetch['branch'];
$type=$afetch['type'];
$casetype=$afetch['casetype'];
$package=$afetch['package'];
$room=$afetch['room'];
$PIN=$afetch['PIN'];
$registeredBy=$afetch['registeredBy'];
$LimitHMO=$afetch['LimitHMO'];
$LimitCASH=$afetch['LimitCASH'];
$discount=$afetch['discount'];
$bill=$afetch['bill'];
$mgh=$afetch['mgh'];
$mgh_date=$afetch['mgh_date'];
$balance=$afetch['balance'];
$verified=$afetch['verified'];
$certified=$afetch['certified'];
$control_dateRegistered=$afetch['control_dateRegistered'];
$control_dateUnregistered=$afetch['control_dateUnregistered'];
$advised=$afetch['advised'];
$followUp=$afetch['followUp'];
$diet=$afetch['diet'];
$religion=$afetch['religion'];
$pulseRate=$afetch['pulseRate'];
$respiratoryRate=$afetch['respiratoryRate'];
$unregisteredBy=$afetch['unregisteredBy'];
$phicMember=$afetch['phicMember'];
$seniorID=$afetch['seniorID'];
$registeredFrom=$afetch['registeredFrom'];
$company1=$afetch['company1'];
$company2=$afetch['company2'];
$prePackage=$afetch['prePackage'];
$privateORhouse_case=$afetch['privateORhouse_case'];
$companyDiscount=$afetch['companyDiscount'];
$isPackageCash=$afetch['isPackageCash'];
$patientDisposition=$afetch['patientDisposition'];
}
mysql_close($x);

$y=mysql_connect("localhost","root","Pr0taci001");
mysql_select_db('Coconut', $y);

$ro->getRegistrationNo();
$myFile = $ro->getReportInformation("homeRoot")."/COCONUT/trackingNo/registrationNo.dat";
$fh = fopen($myFile, 'r');
$registrationNo = fread($fh, 100);
fclose($fh);

mysql_query("INSERT INTO registrationDetails VALUES('$patientNo', '$registrationNo', '', '', '$bloodPressure', '$temperature', '$height', '$weight', '$Company', '$initialDiagnosis', '$IxDx', '$finalDiagnosis', '$dateRegistered', '$dateUnregistered', '$timeRegistered', '$timeUnregistered', '$branch', '$type', '$casetype', '$package', '$room', '$PIN', '$registeredBy', '$LimitHMO', '$LimitCASH', '$discount', '$bill', '$mgh', '$mgh_date', '$balance', '$verified', '$certified', '$control_dateRegistered', '$control_dateUnregistered', '$advised', '$followUp', '$diet', '$religion', '$pulseRate', '$respiratoryRate', '$unregisteredBy', '$phicMember', '$seniorID', '$registeredFrom', '$company1', '$company2', '$prePackage', '$privateORhouse_case', '$companyDiscount', '$isPackageCash', '$patientDisposition', '', '')");
mysql_close($y);

echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=PatientSelected.php?patientNo=$patientNo'>";

?>
</body>
</html>
