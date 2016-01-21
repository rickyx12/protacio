<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Transaction Summary</title>
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
.arial10black {font-family: Arial;font-size: 10px;color: #000000;}
.arial10blackbold {font-family: Arial;font-size: 10px;font-weight: bold;color: #000000;}
.arial11black {font-family: Arial;font-size: 11px;color: #000000;}
.arial11blackbold {font-family: Arial;font-size: 11px;font-weight: bold;color: #000000;}
.arial12black {font-family: Arial;font-size: 12px;color: #000000;}
.arial12blackbold {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;}
.arial13black {font-family: Arial;font-size: 13px;color: #000000;}
.arial13blackbold {font-family: Arial;font-size: 13px;font-weight: bold;color: #000000;}
.arial14black {font-family: Arial;font-size: 14px;color: #000000;}
.arial14blackbold {font-family: Arial;font-size: 14px;font-weight: bold;color: #000000;}
.arial15black {font-family: Arial;font-size: 15px;color: #000000;}
.arial15blackbold {font-family: Arial;font-size: 15px;font-weight: bold;color: #000000;}
.arial16black {font-family: Arial;font-size: 16px;color: #000000;}
.arial16blackbold {font-family: Arial;font-size: 16px;font-weight: bold;color: #000000;}
.tableBottom {border-bottom: 2px solid #000000;}
.table2Top2Bottom {border-top-width: 2px;border-top-color: #000000;border-top-style: solid;border-bottom-width: 2px;border-bottom-color: #000000;border-bottom-style: solid;}
.table1Bottom1Right {border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;border-right-width: 1px;border-right-color: #000000;border-right-style: solid;}
.table1Bottom {border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;}
.table1Top2Bottom1Right {border-top-width: 1px;border-top-color: #000000;border-top-style: solid;border-bottom-width: 2px;border-bottom-color: #000000;border-bottom-style: solid;border-right-width: 1px;border-right-color: #000000;border-right-style: solid;}
.table1Top2Bottom {border-top-width: 1px;border-top-color: #000000;border-top-style: solid;border-bottom-width: 2px;border-bottom-color: #000000;border-bottom-style: solid;}
tr:hover { background-color:yellow;color:black;}
.button01 {font-family: Arial;font-size: 12px;font-weight: bold;color: #0033FF;background-color: #FFFFFF;border: 1px solid #0033FF;}
.button02 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FF3300;background-color: #FFFFFF;border: 1px solid #FF3300;}
.button03 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FFFFFF;background-color: #0033FF;border: 1px solid #000000;}
.astyle {text-decoration: none;}
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
<br />
<br />
<table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td height='30' bgcolor='#FFFFFF'><div align='left' class='arial16blackbold'>SELECT PATIENT TO BE INCLUDED:</div></td>
  </tr>
  <tr>
    <td height='30'><div align='left' class='arial14blackbold'>From $fdatefmt To $tdatefmt</div></td>
  </tr>
  <tr>
    <td height='20' bgcolor='#FFFFFF'></td>
  </tr>
  <form method='post' name='SelectedPatients' action='BillAccounting.php'>
  <input name='username' type='hidden' value='$username' />
  <input name='fyear' type='hidden' value='$fyear' />
  <input name='fmonth' type='hidden' value='$fmonth' />
  <input name='fday' type='hidden' value='$fday' />
  <input name='tyear' type='hidden' value='$tyear' />
  <input name='tmonth' type='hidden' value='$tmonth' />
  <input name='tday' type='hidden' value='$tday' />
  <tr>
    <td width='100%' bgcolor='#FFFFFF'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
      <tr>

        <td width='47%' bgcolor='#FFFFFF' valign='top'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <td height='25' colspan='3'><div align='center' class='arial14blackbold'>Out-Patient</div></td>
          </tr>
          <tr>
            <td width='50' class='table2Top2Bottom' bgcolor='#FFFFFF'><div align='center' class='arial12blackbold'>Select</div></td>
            <td width='auto' class='table2Top2Bottom' bgcolor='#FFFFFF'><div align='center' class='arial12blackbold'>Patient Name</div></td>
            <td width='150' class='table2Top2Bottom' bgcolor='#FFFFFF'><div align='center' class='arial12blackbold'>Date Registered</div></td>
          </tr>
";

$opdnum=0;
$asql=mysql_query("SELECT registrationNo, dateRegistered FROM registrationDetails WHERE (dateRegistered BETWEEN '$fdate' AND '$tdate') AND type='OPD' ORDER BY dateRegistered");
while($afetch=mysql_fetch_array($asql)){
$registrationNoOPD=$afetch['registrationNo'];
$dateRegistered=$afetch['dateRegistered'];

$opdnum++;

$patientNoOPD=$cuz->selectNow("registrationDetails","patientNo","registrationNo",$registrationNoOPD);
$lastNameOPD=$cuz->selectNow("patientRecord","lastName","patientNo",$patientNoOPD);
$firstNameOPD=$cuz->selectNow("patientRecord","firstName","patientNo",$patientNoOPD);
$middleNameOPD=$cuz->selectNow("patientRecord","middleName","patientNo",$patientNoOPD);

$nameOPD=$lastNameOPD.", ".$firstNameOPD." ".$middleNameOPD;
echo "
          <tr>
            <td width='50' class='table1Bottom1Right'><div align='center' class='arial14black'><input name='rop$opdnum' type='hidden' value='' /><input name='rop$opdnum' type='checkbox' checked='checked' value='$registrationNoOPD' /></div></td>
            <td width='auto' class='table1Bottom1Right'><div align='left' class='arial14black'>&nbsp;".strtoupper($nameOPD)."&nbsp;</div></td>
            <td width='150' class='table1Bottom'><div align='center' class='arial14black'>".date("M d, Y",strtotime($dateRegistered))."</div></td>
          </tr>
";
}

echo "
        </table></td>

        <td width='6%' bgcolor='#FFFFFF'></td>

        <td width='47%' bgcolor='#FFFFFF' valign='top'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <td height='25' colspan='3'><div align='center' class='arial14blackbold'>In-Patient</div></td>
          </tr>
          <tr>
            <td width='50' class='table2Top2Bottom' bgcolor='#FFFFFF'><div align='center' class='arial12blackbold'>Select</div></td>
            <td width='auto' class='table2Top2Bottom' bgcolor='#FFFFFF'><div align='center' class='arial12blackbold'>Patient Name</div></td>
            <td width='150' class='table2Top2Bottom' bgcolor='#FFFFFF'><div align='center' class='arial12blackbold'>Date Discharged</div></td>
          </tr>
";

$ipdnum=0;
$bsql=mysql_query("SELECT registrationNo, dateUnregistered FROM registrationDetails WHERE dateUnregistered NOT LIKE '' AND (dateUnregistered BETWEEN '$fdate' AND '$tdate') AND type='IPD' ORDER BY dateUnregistered");
while($bfetch=mysql_fetch_array($bsql)){
$registrationNoIPD=$bfetch['registrationNo'];
$dateUnregistered=$bfetch['dateUnregistered'];

$ipdnum++;

$patientNoIPD=$cuz->selectNow("registrationDetails","patientNo","registrationNo",$registrationNoIPD);
$lastNameIPD=$cuz->selectNow("patientRecord","lastName","patientNo",$patientNoIPD);
$firstNameIPD=$cuz->selectNow("patientRecord","firstName","patientNo",$patientNoIPD);
$middleNameIPD=$cuz->selectNow("patientRecord","middleName","patientNo",$patientNoIPD);

$nameIPD=$lastNameIPD.", ".$firstNameIPD." ".$middleNameIPD;
echo "
          <tr>
            <td width='50' class='table1Bottom1Right'><div align='center' class='arial14black'><input name='rip$ipdnum' type='hidden' value='' /><input name='rip$ipdnum' type='checkbox' checked='checked' value='$registrationNoIPD' /></div></td>
            <td width='auto' class='table1Bottom1Right'><div align='left' class='arial14black'>&nbsp;".strtoupper($nameIPD)."&nbsp;</div></td>
            <td width='150' class='table1Bottom'><div align='center' class='arial14black'>".date("M d, Y",strtotime($dateUnregistered))."</div></td>
          </tr>
";
}

echo "
        </table></td>

      </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor='#FFFFFF' height='40' valign='bottom'><div align='right'><input name='Submit' type='submit' class='button03' value='Submit &gt;&gt;' /></div></td>
  </tr>
  <input name='opdnum' type='hidden' value='$opdnum' />
  <input name='ipdnum' type='hidden' value='$ipdnum' />
  </form>
</table>
</div>
";
?>
</body>
</html>
