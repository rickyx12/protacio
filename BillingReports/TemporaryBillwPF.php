<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Temporary Bill With PF</title>
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

function printF(printData)
{
	var a = window.open ('',  '',"status=1,scrollbars=1, width=auto,height=auto");
	a.document.write(document.getElementById(printData).innerHTML.replace(/<a\/?[^>]+>/gi, ''));
	a.document.close();
	a.focus();
	a.print();
	a.close();
}
//-->
</script>
<style type="text/css">
<!--
.style1 {font-family: Arial;font-size: 14px;color: #000000;font-weight: bold;}
.style2 {font-family: "Times New Roman";font-size: 16px;color: #FF0000;font-weight: bold;}
.style3 {font-family: Arial;font-size: 12px;color: #000000;font-weight: bold;}
.style4 {font-family: Arial;font-size: 14px;color: #000000;}
.style5 {font-family: Arial;font-size: 12px;color: #000000;}
.style6 {font-family: Arial;font-size: 11px;color: #000000;font-weight: bold;}
.tableBottom {border-bottom: 2px solid #000000;}
.doubleUnderline {text-decoration:underline;border-bottom: 1px solid #000;font-family: Arial;font-size: 14px;color: #000000;}
-->
</style>
</head>

<body onload="placeFocus()">
<?php
include("../myDatabase.php");
$cuz = new database();

($GLOBALS["___mysqli_ston"] = mysqli_connect($cuz->myHost(), $cuz->getUser(), $cuz->getPass()));
((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . $cuz->getDB()));

$username=$_GET['username'];
$registrationNo=$_GET['registrationNo'];

echo "
<a href='#' onClick=printF('printData') style='font-family: Arial; text-decoration:none; color:black;'>PRINT</a>
<br />
<br />
<div align='center' id='printData'>
<style type='text/css'>
<!--
.style1 {font-family: Arial;font-size: 18px;color: #000000;font-weight: bold;}
.style2 {font-family: 'Times New Roman';font-size: 16px;color: #FF0000;font-weight: bold;}
.style3 {font-family: Arial;font-size: 17px;color: #000000;font-weight: bold;}
.style4 {font-family: Arial;font-size: 18px;color: #000000;}
.style5 {font-family: Arial;font-size: 14px;color: #000000;}
.style6 {font-family: Arial;font-size: 15px;color: #000000;font-weight: bold;}
.tableBottom {border-bottom: 2px solid #000000;}
.doubleUnderline {text-decoration:underline;border-bottom: 1px solid #000;font-family: Arial;font-size: 14px;color: #000000;}
-->
</style>
<table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td><div align='left' class='style1'>TEMPORARY BILL WITH P.F.</div></td>
  </tr>
  <tr>
    <td height='50'></td>
  </tr>
  <tr>
    <td><div align='center'><span class='style1'>PROTACIO HOSPITAL</span><br /><span class='style3'>ACCOUNTING DEPARTMENT</span></div></td>
  </tr>
  <tr>
    <td height='30'></td>
  </tr>
";

$patientNo=$cuz->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo);
$dateRegistered=$cuz->selectNow("registrationDetails","dateRegistered","registrationNo",$registrationNo);
$lastName=$cuz->selectNow("patientRecord","lastName","patientNo",$patientNo);
$firstName=$cuz->selectNow("patientRecord","firstName","patientNo",$patientNo);
$middleName=$cuz->selectNow("patientRecord","middleName","patientNo",$patientNo);



$dateRegisteredstr=strtotime($dateRegistered);
$dateRegisteredfmt=date("M d, Y", $dateRegisteredstr);

$asql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT description FROM patientCharges WHERE title='Room And Board' AND registrationNo='$registrationNo' AND status NOT LIKE 'DELETED_%%%%' ORDER BY dateCharge, timeCharge");
while($afetch=mysqli_fetch_array($asql)){$room=$afetch['description'];}

$romsplit=preg_split('[_]',$room);

echo "
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='12%'><b>Patient Name:</b>&nbsp;</td>
        <td colspan='3' style='border-bottom: 2px solid #000000;'><div align='left' style='font-family: Arial;font-size: 14px;color: #000000;'>&nbsp;<font size=4>".strtoupper($lastName).",&nbsp;&nbsp;&nbsp;".strtoupper($firstName)."&nbsp;&nbsp;&nbsp;".strtoupper($middleName)."</font></div></td>
      </tr>
      <tr>
        <td width='100'><font size=3><b>Date Addmitted:</b></font>&nbsp</td>
        <td width='60%' style='border-bottom: 2px solid #000000;'><div align='left' style='font-family: Arial;font-size: 14px;color: #000000;'>&nbsp;<font size=4>$dateRegisteredfmt</font></div></td>
        <td width='10%' align='right'>&nbsp;<font size=3><b>Room No.:</b></font>&nbsp;</td>
        <td width='40%' style='border-bottom: 2px solid #000000;'><div align='left' style='font-family: Arial;font-size: 14px;color: #000000;'>&nbsp;".$romsplit[0]."</div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height='20'></td>
  </tr>
";
$cu=0;
$bsql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT itemNo, cashUnpaid, departmentStatus, title FROM patientCharges WHERE registrationNo='$registrationNo' AND status NOT LIKE 'DELETED_%%%%' AND title NOT LIKE 'PROFESSIONAL FEE'");
while($bfetch=mysqli_fetch_array($bsql)){
$itemNo=$bfetch['itemNo'];
$title=$bfetch['title'];
$cashUnpaid=$bfetch['cashUnpaid'];

if(($title=='MEDICINE')||($title=='SUPPLIES')){
$findifdispsql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT departmentStatus FROM patientCharges WHERE itemNo='$itemNo' AND departmentStatus LIKE 'dispensedBy_%%%%'");
$findifdispcount=mysqli_num_rows($findifdispsql);
if($findifdispcount==0){
}
else{
$cu+=$cashUnpaid;
}

}
else{
$cu+=$cashUnpaid;
}

}

$csql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT SUM(cashUnpaid) AS pf FROM patientCharges WHERE registrationNo='$registrationNo' AND status NOT LIKE 'DELETED_%%%%' AND title='PROFESSIONAL FEE'");
while($cfetch=mysqli_fetch_array($csql)){$pf=$cfetch['pf'];}

$dsql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT SUM(amountPaid) AS dp FROM patientPayment WHERE registrationNo='$registrationNo'");
while($dfetch=mysqli_fetch_array($dsql)){$dp=$dfetch['dp'];}

$dsql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT ");

$temptot=($cu+$pf)-$dp;

$totalHB=$temptot;
$totalHBfmt=number_format($totalHB,2,'.',',');
$totalDeposit=$dp;
$totalDepositfmt=number_format($totalDeposit,2,'.',',');
$totalPF=$pf;
$totalPFfmt=number_format($totalPF,2,'.',',');

$logusername=$cuz->selectNow("registeredUser","completeName","username",$username);

echo "
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td><div align='justify'>
          <span class='style4'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Our records show that your outstanding bill as of ".date('M d, Y')." ".date('h:i:s A')." is </span><span class='doubleUnderline'>&nbsp;&nbsp;<font size=4>$totalHBfmt Pesos</font>&nbsp;&nbsp;</span><span class='style4'>. Your deposit of </span><span class='doubleUnderline'>&nbsp;&nbsp;<font size=4>$totalDepositfmt Pesos</font>&nbsp;&nbsp;</span><span class='style4'> is already deducted. </span><span class='style4'>The Doctor's Professional Fees are already included.<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<Br>Please make your deposit at the Cashier.</span>
        </div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height='60'></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='70%'></td>
        <td width='30%' class='tableBottom'><div align='center' class='style4'>".strtoupper($logusername)."</div></td>
      </tr>
      <tr>
        <td></td>
        <td><div align='center' class='style5'>Billing Officer</div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height='10'></td>
  </tr>
  <tr>
    <td><div align='left' class='style6'>DISCLAIMER: The estimation is based on approximation, which may vary on a case to case basis.</div></td>
  </tr>
</table>
</div> 
";
?>
</body>
</html>
