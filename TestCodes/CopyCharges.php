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
.style4 {
	font-family: Arial;
	font-size: 14px;
	font-weight: bold;
	color: #FF0000;
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
$patientNo=$_GET['patientNo'];
$registrationNo=$_GET['registrationNo'];
$itemNo=$_GET['itemNo'];


$y=mysql_connect("localhost","root","Pr0taci001");
mysql_select_db('Coconut', $y);
$bsql=mysql_query("SELECT * FROM registrationDetails WHERE patientNo='$patientNo' AND registrationNo='$registrationNo'");
$bcount=mysql_num_rows($bsql);
mysql_close($y);

if($bcount==0){
echo "<div align='left' class='style4'>Invalid Registration No.. Try again!!!</div>";
echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=PatientSelected.php?patientNo=$patientNo'>";
}
else{
echo "<div align='left' class='style1'>Copyying Registration Details... </div>";

$x=mysql_connect("192.168.1.209","root","hokage");
mysql_select_db('Coconut', $x);
$asql=mysql_query("SELECT * FROM patientCharges WHERE itemNo='$itemNo'");
while($afetch=mysql_fetch_array($asql)){
$status=$afetch['status'];
$chargesCode=$afetch['chargesCode'];
$description=$afetch['description'];
$sellingPrice=$afetch['sellingPrice'];
$quantity=$afetch['quantity'];
$discount=$afetch['discount'];
$total=$afetch['total'];
$cashUnpaid=$afetch['cashUnpaid'];
$phic=$afetch['phic'];
$company=$afetch['company'];
$timeCharge=$afetch['timeCharge'];
$dateCharge=$afetch['dateCharge'];
$chargeBy=$afetch['chargeBy'];
$service=$afetch['service'];
$title=$afetch['title'];
$paidVia=$afetch['paidVia'];
$cashPaid=$afetch['cashPaid'];
$orNO=$afetch['orNO'];
$batchNo=$afetch['batchNo'];
$inventoryFrom=$afetch['inventoryFrom'];
$departmentStatus=$afetch['departmentStatus'];
$departmentStatus_time=$afetch['departmentStatus_time'];
$datePaid=$afetch['datePaid'];
$timePaid=$afetch['timePaid'];
$paidBy=$afetch['paidBy'];
$branch=$afetch['branch'];
$hmoPrice=$afetch['hmoPrice'];
$dispensedNo=$afetch['dispensedNo'];
$control_dateCharge=$afetch['control_dateCharge'];
$control_datePaid=$afetch['control_datePaid'];
$remarks=$afetch['remarks'];
$timing=$afetch['timing'];
$instruction=$afetch['instruction'];
$indication=$afetch['indication'];
$dateReturn=$afetch['dateReturn'];
$receiptType=$afetch['receiptType'];
$pxName=$afetch['pxName'];
$type=$afetch['type'];
$company1=$afetch['company1'];
$company2=$afetch['company2'];
$cashPaidFromBalance=$afetch['cashPaidFromBalance'];
$datePaidFromBalance=$afetch['datePaidFromBalance'];
$timePaidFromBalance=$afetch['timePaidFromBalance'];
$paidByFromBalance=$afetch['paidByFromBalance'];
$orNOFromBalance=$afetch['orNOFromBalance'];
$reportShift=$afetch['reportShift'];
$reportShiftFromBalance=$afetch['reportShiftFromBalance'];
$doctorsPF=$afetch['doctorsPF'];
}
mysql_close($x);

$y=mysql_connect("localhost","root","Pr0taci001");
mysql_select_db('Coconut', $y);

mysql_query("INSERT INTO `Coconut`.`patientCharges` (`itemNo`, `status`, `registrationNo`, `chargesCode`, `description`, `sellingPrice`, `quantity`, `discount`, `total`, `cashUnpaid`, `phic`, `company`, `timeCharge`, `dateCharge`, `chargeBy`, `service`, `title`, `paidVia`, `cashPaid`, `orNO`, `batchNo`, `inventoryFrom`, `departmentStatus`, `departmentStatus_time`, `datePaid`, `timePaid`, `paidBy`, `branch`, `hmoPrice`, `dispensedNo`, `control_dateCharge`, `control_datePaid`, `remarks`, `timing`, `instruction`, `indication`, `dateReturn`, `receiptType`, `pxName`, `type`, `company1`, `company2`, `cashPaidFromBalance`, `datePaidFromBalance`, `timePaidFromBalance`, `paidByFromBalance`, `orNOFromBalance`, `reportShift`, `reportShiftFromBalance`, `doctorsPF`) VALUES (NULL, '$status', '$registrationNo', '$chargesCode', '$description', '$sellingPrice', '$quantity', '$discount', '$total', '$cashUnpaid', '$phic', '$company', '$timeCharge', '$dateCharge', '$chargeBy', '$service', '$title', '$paidVia', '$cashPaid', '$orNO', '$batchNo', '$inventoryFrom', '$departmentStatus', '$departmentStatus_time', '$datePaid', '$timePaid', '$paidBy', '$branch', '$hmoPrice', '$dispensedNo', '$control_dateCharge', '$control_datePaid', '$remarks', '$timing', '$instruction', '$indication', '$dateReturn', '$receiptType', '$pxName', '$type', '$company1', '$company2', '$cashPaidFromBalance', '$datePaidFromBalance', '$timePaidFromBalance', '$paidByFromBalance', '$orNOFromBalance', '$reportShift', '$reportShiftFromBalance', '$doctorsPF')");


mysql_close($y);

echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=PatientSelected.php?patientNo=$patientNo'>";
}
?>
</body>
</html>
