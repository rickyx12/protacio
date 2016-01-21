<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Accounting 101</title>
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
.style6 {font-family: Arial;font-size: 14px;color: #0066FF;}
.style7 {font-family: Arial;font-size: 14px;color: #FF0000;}
.style8 {font-family: Arial;font-size: 12px;color: #FFFFFF;font-weight: bold;}
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
.table1Left {border-left: 1px solid #000000;}
.table1Right {border-right: 1px solid #000000;}
.doubleUnderline {text-decoration:underline;border-bottom: 1px solid #000;font-family: Arial;font-size: 14px;color: #000000;}
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
<img src='../../COCONUT/myImages/ProtacioHeader.png' width='100%' height='auto' />
<br />
<br />
<table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td height='30'><div align='left' class='style3'>P.F. Summary IPD</div></td>
  </tr>
  <tr>
    <td height='30'><div align='left' class='style3'>From $fdatefmt To $tdatefmt</div></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='auto' class='tableTopBottom' height='25'><div align='left' class='style4'>Doctor</div></td>
        <td width='auto' class='tableTopBottom'><div align='right' class='style4'>Cash</div></td>
        <td width='auto' class='tableTopBottom'><div align='right' class='style4'>AR-PHIC</div></td>
        <td width='auto' class='tableTopBottom'><div align='right' class='style4'>AR-Company</div></td>
        <td width='auto' class='tableTopBottom'><div align='right' class='style4'>AR-Credit Card&nbsp;</div></td>
        <td width='auto' class='tableTopBottom'><div align='right' class='style4'>Total</div></td>
      </tr>
";

$asql=mysql_query("SELECT pc.description, SUM(pc.cashUnpaid) AS pfcashUP, SUM(pc.cashPaid) AS pfcashP, SUM(pc.phic) AS pfphic, SUM(pc.company) AS pfcompany, rd.dateRegistered FROM patientCharges pc, registrationDetails rd WHERE pc.title='PROFESSIONAL FEE' AND pc.status NOT LIKE 'DELETED_%%%%' AND (rd.dateRegistered BETWEEN '$fdate' AND '$tdate') AND rd.registrationNo=pc.registrationNo GROUP BY pc.description ORDER BY pc.description");
while($afetch=mysql_fetch_array($asql)){
$doctor=$afetch['description'];
$pfcashUP=$afetch['pfcashUP'];
$pfcashP=$afetch['pfcashP'];
$pfphic=$afetch['pfphic'];
$pfcompany=$afetch['pfcompany'];

$pftotal=$pfcashUP+$pfcashP+$pfphic+$pfcompany;
echo "
      <tr>
        <td class='table1Right'><div align='left'><a href='#' style='text-decoration:none; color:#000000;font-family: Arial;font-size: 14px;'>".strtoupper($doctor)."</a></div></td>
        <td class='table1Left'><div align='right' class='style5'>".number_format($pfcashP,2,'.',',')."</div></td>
        <td><div align='right' class='style5'>".number_format($pfphic,2,'.',',')."</div></td>
        <td><div align='right' class='style5'>".number_format($pfcompany,2,'.',',')."</div></td>
        <td class='table1Right'><div align='right' class='style5'>".number_format($pfcashUP,2,'.',',')."&nbsp;</div></td>
        <td class='table1Left'><div align='right' class='style5'>".number_format($pftotal,2,'.',',')."</div></td>
      </tr>
";
}

echo "
      <tr>
        <td width='auto' class='tableTopBottom' height='25'><div align='left' class='style4'>TOTAL</div></td>
        <td width='auto' class='tableTopBottom'><div align='right' class='style4'>Cash</div></td>
        <td width='auto' class='tableTopBottom'><div align='right' class='style4'>AR-PHIC</div></td>
        <td width='auto' class='tableTopBottom'><div align='right' class='style4'>AR-Company</div></td>
        <td width='auto' class='tableTopBottom'><div align='right' class='style4'>AR-Credit Card&nbsp;</div></td>
        <td width='auto' class='tableTopBottom'><div align='right' class='style4'>Total</div></td>
      </tr>
    </table></td>
  </tr>
</table>
</div>
";
?>
</body>
</html>
