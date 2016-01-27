<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Protacio Hospital</title>
<style type="text/css">
<!--
.style1 {font-family: Arial; font-size: 12; color: #FFFFFF; font-weight: bold; }
.style2 {font-family: Arial; font-size: 11px; color: #000000; font-weight: bold; }
.style3 {font-family: Arial; font-size: 14; color: #000000; font-weight: bold; }
.button01 {
	font-family: Arial;
	font-size: 12px;
	font-weight: bold;
	color: #FFFFFF;
	background-color: #0033FF;
	border: 1px solid #000000;
}
.button02 {
	font-family: Arial;
	font-size: 12px;
	font-weight: bold;
	color: #000000;
	background-color: #FFFFFF;
	border: 1px solid #000000;
}
-->
</style>
<script type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
</head>

<body>
<?php
include("../../myDatabase.php");
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$patientNo=$_GET['patientNo'];
$registrationNo=$_GET['registrationNo'];
$username=$_GET['username'];
$num=$_GET['num'];

echo "
<div align='left'>
<span class='style3'>Saving changes...</span>
";

for($x=1;$x<=$num;$x++){
$typex="type".$x;
$itemNox="itemNo".$x;
$type=$_GET[$typex];
$itemNo=$_GET[$itemNox];


if($type=='cash'){
$asql=mysql_query("SELECT cashUnpaid, company FROM patientCharges WHERE itemNo='$itemNo'");
while($afetch=mysql_fetch_array($asql)){$comp=$afetch['company']; $cashUnpaid=$afetch['cashUnpaid'];}
$b=$comp+$cashUnpaid;
mysql_query("UPDATE patientCharges SET cashUnpaid='$b', company='0' WHERE itemNo='$itemNo'");
}
else if($type=='company'){
$asql=mysql_query("SELECT cashUnpaid, company FROM patientCharges WHERE itemNo='$itemNo'");
while($afetch=mysql_fetch_array($asql)){$comp=$afetch['company']; $cashUnpaid=$afetch['cashUnpaid'];}
$b=$comp+$cashUnpaid;
mysql_query("UPDATE patientCharges SET cashUnpaid='0', company='$b' WHERE itemNo='$itemNo'");
}

}
echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=companymain.php?patientNo=$patientNo&registrationNo=$registrationNo&username=$username'>";
echo "
</div>

";
?>
</body>

</html>
