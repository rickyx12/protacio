<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Protacio Hospital</title>
<style type="text/css">
<!--
.style1 {font-family: Arial; font-size: 12; color: #FFFFFF; font-weight: bold; }
.style2 {font-family: Arial; font-size: 11px; color: #000000; font-weight: bold; }
.style3 {font-family: Arial; font-size: 11px; color: #FF0000; font-weight: bold; }

-->
</style>
<script type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_changeProp(objName,x,theProp,theValue) { //v6.0
  var obj = MM_findObj(objName);
  if (obj && (theProp.indexOf("style.")==-1 || obj.style)){
    if (theValue == true || theValue == false)
      eval("obj."+theProp+"="+theValue);
    else eval("obj."+theProp+"='"+theValue+"'");
  }
}

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

($GLOBALS["___mysqli_ston"] = mysqli_connect($cuz->myHost(), $cuz->getUser(), $cuz->getPass()));
((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . $cuz->getDB()));

$syear=$_GET['syear'];
$smonth=$_GET['smonth'];
$sday=$_GET['sday'];
$username=$_GET['username'];

$sdate=$syear."-".$smonth."-".$sday;

echo "
<div align='center'>
  <table width='95%' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000'>
    <tr>
      <td width='56%' bgcolor='#3B5998'><div align='center' class='style1'>Patien Name</div></td>
      <td width='34%' bgcolor='#3B5998'><div align='center' class='style1'>Amount</div></td>
    </tr>
";

$num=0;
$asql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT registrationDetails.registrationNo, registrationDetails.patientNo, registrationDetails.Company, registrationDetails.dateUnregistered, registrationDetails.pxCount, registrationDetails.type, patientRecord.lastName, patientRecord.firstName FROM  registrationDetails, patientRecord WHERE patientRecord.patientNo=registrationDetails.patientNo AND registrationDetails.dateRegistered='$sdate' AND registrationDetails.Company NOT LIKE '' AND registrationDetails.dateUnregistered='' AND registrationDetails.type='OPD' ORDER BY patientRecord.lastName");
while($afetch=mysqli_fetch_array($asql)){
$registrationNo=$afetch['registrationNo'];
$patientNo=$afetch['patientNo'];
$Company=$afetch['Company'];
$dateUnregistered=$afetch['dateUnregistered'];
$pxCount=$afetch['pxCount'];

$lastName=$afetch['lastName'];
$firstName=$afetch['firstName'];

$csql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT SUM(total) AS totalcharges FROM patientCharges WHERE registrationNo='$registrationNo' AND status='UNPAID'");
while($cfetch=mysqli_fetch_array($csql)){
$totalcharges=$cfetch['totalcharges'];
}

$totalchargesfmt=number_format($totalcharges,2,'.',',');
$lastNamefmt=strtoupper($lastName);
$firstNamefmt=strtoupper($firstName);

$num++;

echo "
    <tr>
      <td height='20'><div align='left' id='r1$num' onclick=MM_goToURL('parent.frames[\'mainFrame\']','companymain.php?patientNo=$patientNo&registrationNo=$registrationNo&username=$username');return document.MM_returnValue><span id='p$num' class='style2' onmouseover=MM_changeProp('p$num','','style.color','#FF0000','DIV') onmouseout=MM_changeProp('p$num','','style.color','#000000','DIV') document.MM_returnValue>&nbsp;$lastNamefmt, $firstNamefmt</span><br />&nbsp;<span class='style3'>($Company)</span></div></td>
      <td><div align='right' class='style2' id='r2'>$totalchargesfmt&nbsp;</div></td>
    </tr>
";
}

echo "
  </table>
</div>
";
?>
</body>
</html>
