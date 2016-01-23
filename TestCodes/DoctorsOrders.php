<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Doctor's Orders Summary</title>
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

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<style type="text/css">
<!--
.style1 {font-family: Arial;font-size: 16px;color: #000000;font-weight: bold;}
.style2 {font-family: "Times New Roman";font-size: 16px;color: #FF0000;font-weight: bold;}
.style3 {font-family: Arial;font-size: 14px;color: #000000;font-weight: bold;}
.style4 {font-family: Arial;font-size: 12px;color: #000000;font-weight: bold;}
.style5 {font-family: Arial;font-size: 14px;color: #000000;}
.tableBottom {border-bottom: 2px solid #000000;}
.tableTop {border-top: 2px solid #000000;}
.tableTopBottom {border-top: 2px solid #000000;border-bottom: 2px solid #000000;}
.tableBottomSides {border-bottom: 2px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;}
.tableBottomLeftSides {border-bottom: 2px solid #000000;border-left: 2px solid #000000;border-right: 1px solid #000000;}
.tableBottomRightSides {border-bottom: 2px solid #000000;border-left: 1px solid #000000;border-right: 2px solid #000000;}
.tableTopSides {border-top: 2px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;}
.tableTopLeftSides {border-top: 2px solid #000000;border-left: 2px solid #000000;border-right: 1px solid #000000;}
.tableTopRightSides {border-top: 2px solid #000000;border-left: 1px solid #000000;border-right: 2px solid #000000;}
.tableTopBottomSides {border-top: 2px solid #000000;border-bottom: 2px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;}
.tableTopBottomLeftSides {border-top: 2px solid #000000;border-bottom: 2px solid #000000;border-left: 2px solid #000000;border-right: 1px solid #000000;}
.tableTopBottomRightSides {border-top: 2px solid #000000;border-bottom: 2px solid #000000;border-left: 1px solid #000000;border-right: 2px solid #000000;}
.tableSides {border-left: 1px solid #000000;border-right: 1px solid #000000;}
.tableSidesLeft {border-left: 2px solid #000000;border-right: 1px solid #000000;}
.tableSidesRight {border-left: 1px solid #000000;border-right: 2px solid #000000;}

-->
</style>
</head>

<body onload="placeFocus()">
<?php
include("../myDatabase.php");
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$username=$_GET['username'];

$fmonth=$_GET['fmonth'];
$fday=$_GET['fday'];
$fyear=$_GET['fyear'];
$tmonth=$_GET['tmonth'];
$tday=$_GET['tday'];
$tyear=$_GET['tyear'];

$fdate=$fyear."-".$fmonth."-".$fday;
$fdatestr=strtotime($fdate);
$fdatefmt=date("M d, Y",$fdatestr);
$tdate=$tyear."-".$tmonth."-".$tday;
$tdatestr=strtotime($tdate);
$tdatefmt=date("M d, Y",$tdatestr);

echo "
<div align='center'>
<table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td class='tableTopBottom'><div align='left' class='style3'>Doctor's Request Summary<br />$fdatefmt-$tdatefmt</div></td>
  </tr>
  <tr>
    <td height='10'></td>
  </tr>
  <tr><table width='100%' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td class='tableTop' colspan='6'></td>
    </tr>
";

$asql=mysql_query("SELECT chargesCode, description FROM patientCharges WHERE status NOT LIKE 'DELETED_%%%%' AND title='PROFESSIONAL FEE' AND (dateCharge BETWEEN '$fdate' AND '$tdate') GROUP BY description ORDER BY description");
while($afetch=mysql_fetch_array($asql)){
$chargesCode=$afetch['chargesCode'];
$description=$afetch['description'];

echo "
    <tr>
      <td colspan='5'><div align='left' class='style3'>$description</div></td>
    </tr>
    <tr>
      <td width='auto'><div align='center' class='style4'>Title</div></td>
      <td width='auto'><div align='center' class='style4'>Cash</div></td>
      <td width='auto'><div align='center' class='style4'>PHIC</div></td>
      <td width='auto'><div align='center' class='style4'>HMO/Company</div></td>
      <td width='auto'><div align='center' class='style4'>Total</div></td>
    </tr>
    <tr>
      <td width='auto'><div align='center' class='style5'>Title</div></td>
      <td width='auto'><div align='center' class='style5'>Cash</div></td>
      <td width='auto'><div align='center' class='style5'>PHIC</div></td>
      <td width='auto'><div align='center' class='style5'>HMO/Company</div></td>
      <td width='auto'><div align='center' class='style5'>Total</div></td>
    </tr>
    <tr>
      <td class='tableTop' colspan='6'><div align='center' class='style3'></div></td>
    </tr>
";
}

echo "
  </table></tr>
</table>
</div>
";
?>
</body>
</html>
