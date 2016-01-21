<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Collection Report</title>
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
.style1 {font-family: Arial;font-size: 16px;font-weight: bold;color: #000000;}
.style2 {font-family: Arial;font-size: 14px;font-weight: bold;color: #000000;}
.style3 {font-family: Arial;font-size: 13px;font-weight: bold;color: #000000;}
.style4 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;}
.textfield01 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;}
.button01 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;}
tr:hover { background-color:yellow;color:black;}
-->
</style>
</head>

<body onload="placeFocus()">
<?php
include("../../../myDatabase2.php");
$cuz = new database2();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$username=$_GET['username'];
$fy=$_GET['fy'];
$fm=$_GET['fm'];
$fd=$_GET['fd'];
$ty=$_GET['ty'];
$tm=$_GET['tm'];
$td=$_GET['td'];
$fth=$_GET['fth'];
$ftm=$_GET['ftm'];
$fts=$_GET['fts'];
$tth=$_GET['tth'];
$ttm=$_GET['ttm'];
$tts=$_GET['tts'];

$fdate=$fy."-".$fm."-".$fd;
$fdatestr=strtotime($fdate);
$fdatefmt=date("M d, Y",$fdatestr);
$tdate=$ty."-".$tm."-".$td;
$tdatestr=strtotime($tdate);
$tdatefmt=date("M d, Y",$tdatestr);

$ftime=$fth.":".$ftm.":".$fts;
$ttime=$tth.":".$ttm.":".$tts;

echo "
<table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td><img src='../../../COCONUT/myImages/ProtacioHeader.png' height='auto' width='100%' /></td>
  </tr>
  <tr>
    <td height='20'></td>
  </tr>
  <tr>
    <td valign='middle' height='40'><div align='center'><span class='style1'>Collection Report</span><br /><span class='style4'>$fdatefmt - $tdatefmt</span><br /><span class='style4'>$ftime - $ttime</span></div></td>
  </tr>
";

$asubtotCP=0;
$asql=mysql_query("SELECT registrationNo, orNO, datePaid, timePaid FROM patientCharges WHERE (status='PAID' OR status='BALANCE') AND (datePaid BETWEEN '$fdate' AND '$tdate') AND (timePaid BETWEEN '$ftime' AND '$ttime') AND paidVia='Cash' GROUP BY registrationNo ORDER BY datePaid,timePaid");
$acount=mysql_num_rows($asql);

if($acount!=0){
echo "
  <tr>
    <td height='2' bgcolor='#000000'></td>
  </tr>
  <tr>
    <td height='30'><div align='left' class='style2'>Cash Collection</div></td>
  </tr>
  <tr>
    <td height='2' bgcolor='#000000'></td>
  </tr>
  <tr>
    <td bgcolor='#FFFFFF'><div align='center'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
     <tr>
       <td width='25%' height='25'><div align='left' class='style3'>Date-Time Paid</div></td>
       <td width='35%'height='25'><div align='left' class='style3'>Patient</div></td>
       <td width='15%' height='25'><div align='center' class='style3'>OR No.</div></td>
       <td width='10%' height='25'><div align='center' class='style3'>Cashier</div></td>
       <td width='15%' height='25'><div align='right' class='style3'>Amount</div></td>
     </tr>
";

while($afetch=mysql_fetch_array($asql)){
$aregistrationNo=$afetch['registrationNo'];
$adatePaid=$afetch['datePaid'];
$atimePaid=$afetch['timePaid'];

$adatePaidstr=strtotime($adatePaid);
$adatePaidfmt=date("M d, Y",$adatePaidstr);

$btotCP=0;
$bsql=mysql_query("SELECT cashPaid, title, paidBy, doctorsPF FROM patientCharges WHERE (status='PAID' OR status='BALANCE') AND registrationNo='$aregistrationNo' AND paidVia='Cash'");
while($bfetch=mysql_fetch_array($bsql)){
$bcashPaid=$bfetch['cashPaid'];
$btitle=$bfetch['title'];
$bpaidBy=$bfetch['paidBy'];
$bdoctorsPF=$bfetch['doctorsPF'];

if($btitle=='PROFESSIONAL FEE'){$btotCP+=($bcashPaid);}else{$btotCP+=$bcashPaid;}

}

$patno=$cuz->selectNow("registrationDetails","patientNo","registrationNo",$aregistrationNo);
$patient=strtoupper($cuz->selectNow("patientRecord","lastName","patientNo",$patno)).", ".strtoupper($cuz->selectNow("patientRecord","firstName","patientNo",$patno));

echo "
      <tr>
        <td><div align='left' class='style4'>$adatePaidfmt - $atimePaid</div></td>
        <td><div align='left' class='style4'>$patient</div></td>
        <td><div align='center' class='style4'>
";

$cashorsql=mysql_query("SELECT orNO FROM patientCharges WHERE registrationNo='$aregistrationNo' AND (status='PAID' OR status='BALANCE') AND paidVia='Cash' GROUP BY orNO");
$cashorcount=mysql_num_rows($cashorsql);
$cashcounter=0;
while($cashorfetch=mysql_fetch_array($cashorsql)){
$cashorNO=$cashorfetch['orNO'];
$cashcounter++;
if($cashcounter==$cashorcount){echo $cashorNO;}else{echo $cashorNO."; ";}
}

echo "
        </div></td>
        <td><div align='center' class='style4'>$bpaidBy</div></td>
        <td><div align='right' class='style4'>".number_format($btotCP,2,'.',',')."</div></td>
      </tr>
";

$asubtotCP+=$btotCP;
}


echo "
      <tr>
        <td height='2' colspan='4'></td>
        <td bgcolor='#000000'></td>
      </tr>
      <tr>
        <td height='25' colspan='4'><div align='right' class='style3'>Sub Total</div></td>
        <td><div align='right' class='style3'>".number_format($asubtotCP,2,'.',',')."</div></td>
      </tr>
    </table></div></td>
  </tr>
";
}

echo "
  <tr>
    <td height='5'></td>
  </tr>
";

$csubtotCP=0;
$csql=mysql_query("SELECT registrationNo, orNOFromBalance, datePaidFromBalance, timePaidFromBalance FROM patientCharges WHERE (status='PAID' OR status='BALANCE') AND orNOFromBalance NOT LIKE '' AND (datePaidFromBalance BETWEEN '$fdate' AND '$tdate') AND (timePaidFromBalance BETWEEN '$ftime' AND '$ttime') GROUP BY registrationNo ORDER BY datePaid,timePaid");
$ccount=mysql_num_rows($csql);

if($ccount!=0){
echo "
  <tr>
    <td height='2' bgcolor='#000000'></td>
  </tr>
  <tr>
    <td height='30'><div align='left' class='style2'>Collection From Patient's Balance</div></td>
  </tr>
  <tr>
    <td height='2' bgcolor='#000000'></td>
  </tr>
  <tr>
    <td bgcolor='#FFFFFF'><div align='center'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
     <tr>
       <td width='25%' height='25'><div align='left' class='style3'>Date-Time Paid</div></td>
       <td width='35%'height='25'><div align='left' class='style3'>Patient</div></td>
       <td width='15%' height='25'><div align='center' class='style3'>OR No.</div></td>
       <td width='10%' height='25'><div align='center' class='style3'>Cashier</div></td>
       <td width='15%' height='25'><div align='right' class='style3'>Amount</div></td>
     </tr>
";

while($cfetch=mysql_fetch_array($csql)){
$cregistrationNo=$cfetch['registrationNo'];
$cdatePaidFromBalance=$cfetch['datePaidFromBalance'];
$ctimePaidFromBalance=$cfetch['timePaidFromBalance'];

$cdatePaidFromBalancestr=strtotime($cdatePaidFromBalance);
$cdatePaidFromBalancefmt=date("M d, Y",$cdatePaidFromBalancestr);

$dtotCP=0;
$dsql=mysql_query("SELECT cashPaidFromBalance, title, paidBy, doctorsPF FROM patientCharges WHERE (status='PAID' OR status='BALANCE') AND registrationNo='$cregistrationNo'");
while($dfetch=mysql_fetch_array($dsql)){
$dcashPaidFromBalance=$dfetch['cashPaidFromBalance'];
$dtitle=$dfetch['title'];
$dpaidBy=$dfetch['paidBy'];
$ddoctorsPF=$dfetch['doctorsPF'];

if($dtitle=='PROFESSIONAL FEE'){$dtotCP+=($dcashPaidFromBalance);}else{$dtotCP+=$dcashPaidFromBalance;}

}

$dpatno=$cuz->selectNow("registrationDetails","patientNo","registrationNo",$cregistrationNo);
$dpatient=strtoupper($cuz->selectNow("patientRecord","lastName","patientNo",$dpatno)).", ".strtoupper($cuz->selectNow("patientRecord","firstName","patientNo",$dpatno));

echo "
      <tr>
        <td><div align='left' class='style4'>$cdatePaidFromBalancefmt - $ctimePaidFromBalance</div></td>
        <td><div align='left' class='style4'>$dpatient</div></td>
        <td><div align='center' class='style4'>
";

$balorsql=mysql_query("SELECT orNOFromBalance FROM patientCharges WHERE registrationNo='$cregistrationNo' AND (status='PAID' OR status='BALANCE') GROUP BY orNO");
$balorcount=mysql_num_rows($balorsql);
$balcounter=0;
while($balorfetch=mysql_fetch_array($balorsql)){
$balorNO=$balorfetch['orNO'];
$balcounter++;
if($balcounter==$balorcount){echo $balorNO;}else{echo $balorNO."; ";}
}

echo "
        </div></td>
        <td><div align='center' class='style4'>$dpaidBy</div></td>
        <td><div align='right' class='style4'>".number_format($dtotCP,2,'.',',')."</div></td>
      </tr>
";

$csubtotCP+=$dtotCP;
}


echo "
      <tr>
        <td height='2' colspan='4'></td>
        <td bgcolor='#000000'></td>
      </tr>
      <tr>
        <td height='25' colspan='4'><div align='right' class='style3'>Sub Total</div></td>
        <td><div align='right' class='style3'>".number_format($csubtotCP,2,'.',',')."</div></td>
      </tr>
    </table></div></td>
  </tr>
";
}

echo "
  <tr>
    <td height='5'></td>
  </tr>
";

$esubtotCP=0;
$esql=mysql_query("SELECT registrationNo, orNO, datePaid, timePaid FROM patientCharges WHERE (status='PAID' OR status='BALANCE') AND (datePaid BETWEEN '$fdate' AND '$tdate') AND (timePaid BETWEEN '$ftime' AND '$ttime') AND paidVia='Credit Card' GROUP BY registrationNo ORDER BY datePaid,timePaid");
$ecount=mysql_num_rows($esql);

if($ecount!=0){
echo "
  <tr>
    <td height='2' bgcolor='#000000'></td>
  </tr>
  <tr>
    <td height='30'><div align='left' class='style2'>Credit Cards</div></td>
  </tr>
  <tr>
    <td height='2' bgcolor='#000000'></td>
  </tr>
  <tr>
    <td bgcolor='#FFFFFF'><div align='center'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
     <tr>
       <td width='25%' height='25'><div align='left' class='style3'>Date-Time Paid</div></td>
       <td width='25%'height='25'><div align='left' class='style3'>Patient</div></td>
       <td width='15%'height='25'><div align='left' class='style3'>Card Type</div></td>
       <td width='10%' height='25'><div align='center' class='style3'>OR No.</div></td>
       <td width='10%' height='25'><div align='center' class='style3'>Cashier</div></td>
       <td width='15%' height='25'><div align='right' class='style3'>Amount</div></td>
     </tr>
";

while($efetch=mysql_fetch_array($esql)){
$eregistrationNo=$efetch['registrationNo'];
$edatePaid=$efetch['datePaid'];
$etimePaid=$efetch['timePaid'];

$edatePaidstr=strtotime($edatePaid);
$edatePaidfmt=date("M d, Y",$edatePaidstr);

$ftotCP=0;
$fsql=mysql_query("SELECT title, paidBy, doctorsPF, cardType, creditCardNo, amountPaidFromCreditCard FROM patientCharges WHERE registrationNo='$eregistrationNo' AND (status='PAID' OR status='BALANCE') AND paidVia='Credit Card'");
while($ffetch=mysql_fetch_array($fsql)){
$famountPaidFromCreditCard=$ffetch['amountPaidFromCreditCard'];
$fcardType=$ffetch['cardType'];
$fcreditCardNo=$ffetch['creditCardNo'];
$ftitle=$ffetch['title'];
$fpaidBy=$ffetch['paidBy'];
$fdoctorsPF=$ffetch['doctorsPF'];

if($ftitle=='PROFESSIONAL FEE'){$ftotCP+=$famountPaidFromCreditCard;}else{$ftotCP+=$famountPaidFromCreditCard;}

}

$fpatno=$cuz->selectNow("registrationDetails","patientNo","registrationNo",$eregistrationNo);
$fpatient=strtoupper($cuz->selectNow("patientRecord","lastName","patientNo",$fpatno)).", ".strtoupper($cuz->selectNow("patientRecord","firstName","patientNo",$fpatno));

echo "
      <tr>
        <td><div align='left' class='style4'>$edatePaidfmt - $etimePaid</div></td>
        <td><div align='left' class='style4'>$fpatient</div></td>
        <td><div align='left' class='style4'>$fcardType: $fcreditCardNo</div></td>
        <td><div align='center' class='style4'>
";

$credorsql=mysql_query("SELECT orNO FROM patientCharges WHERE registrationNo='$eregistrationNo' AND (status='PAID' OR status='BALANCE') AND paidVia='Credit Card' GROUP BY orNO");
$credorcount=mysql_num_rows($credorsql);
$credcounter=0;
while($credorfetch=mysql_fetch_array($credorsql)){
$credorNO=$credorfetch['orNO'];
$credcounter++;
if($credcounter==$credorcount){echo $credorNO;}else{echo $credorNO."; ";}
}

echo "
        </div></td>
        <td><div align='center' class='style4'>$fpaidBy</div></td>
        <td><div align='right' class='style4'>".number_format($ftotCP,2,'.',',')."</div></td>
      </tr>
";

$esubtotCP+=$ftotCP;
}


echo "
      <tr>
        <td height='2' colspan='5'></td>
        <td bgcolor='#000000'></td>
      </tr>
      <tr>
        <td height='25' colspan='5'><div align='right' class='style3'>Sub Total</div></td>
        <td><div align='right' class='style3'>".number_format($esubtotCP,2,'.',',')."</div></td>
      </tr>
    </table></div></td>
  </tr>
";
}

echo "
  <tr>
    <td height='5'></td>
  </tr>
";

$gsubtotAP=0;
$gsql=mysql_query("SELECT registrationNo, amountPaid, datePaid, timePaid, orNo FROM patientPayment WHERE (datePaid BETWEEN '$fdate' AND '$tdate') AND (timePaid BETWEEN '$ftime' AND '$ttime') GROUP BY orNo,registrationNo ORDER BY datePaid,timePaid");
$gcount=mysql_num_rows($gsql);

if($gcount!=0){
echo "
  <tr>
    <td height='2' bgcolor='#000000'></td>
  </tr>
  <tr>
    <td height='30'><div align='left' class='style2'>Deposits/Payments</div></td>
  </tr>
  <tr>
    <td height='2' bgcolor='#000000'></td>
  </tr>
  <tr>
    <td bgcolor='#FFFFFF'><div align='center'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
     <tr>
       <td width='25%' height='25'><div align='left' class='style3'>Date-Time Paid</div></td>
       <td width='25%'height='25'><div align='left' class='style3'>Patient</div></td>
       <td width='15%'height='25'><div align='left' class='style3'>Payment For</div></td>
       <td width='10%' height='25'><div align='center' class='style3'>OR No.</div></td>
       <td width='10%' height='25'><div align='center' class='style3'>Cashier</div></td>
       <td width='15%' height='25'><div align='right' class='style3'>Amount</div></td>
     </tr>
";

while($gfetch=mysql_fetch_array($gsql)){
$gorNO=$gfetch['orNo'];
$gregistrationNo=$gfetch['registrationNo'];
$gdatePaid=$gfetch['datePaid'];
$gtimePaid=$gfetch['timePaid'];

$gdatePaidstr=strtotime($gdatePaid);
$gdatePaidfmt=date("M d, Y",$gdatePaidstr);

$htotAP=0;
$hsql=mysql_query("SELECT amountPaid, paidBy, paymentFor, paidVia, creditCardNo FROM patientPayment WHERE registrationNo='$gregistrationNo' AND orNO='$gorNO'");
while($hfetch=mysql_fetch_array($hsql)){
$hamountPaid=$hfetch['amountPaid'];
$hpaymentFor=$hfetch['paymentFor'];
$hpaidBy=$hfetch['paidBy'];
$hpaidVia=$hfetch['paidVia'];
$hcreditCardNo=$hfetch['creditCardNo'];

$htotAP+=$hamountPaid;
}

$hpatno=$cuz->selectNow("registrationDetails","patientNo","registrationNo",$gregistrationNo);
$hpatient=strtoupper($cuz->selectNow("patientRecord","lastName","patientNo",$hpatno)).", ".strtoupper($cuz->selectNow("patientRecord","firstName","patientNo",$hpatno));

echo "
      <tr>
        <td><div align='left' class='style4'>$gdatePaidfmt - $gtimePaid</div></td>
        <td><div align='left' class='style4'>$hpatient</div></td>
        <td><div align='left' class='style4'>$hpaymentFor</div></td>
        <td><div align='center' class='style4'>$gorNO</div></td>
        <td><div align='center' class='style4'>$hpaidBy</div></td>
        <td><div align='right' class='style4'>".number_format($htotAP,2,'.',',')."</div></td>
      </tr>
";

$gsubtotAP+=$htotAP;
}


echo "
      <tr>
        <td height='2' colspan='5'></td>
        <td bgcolor='#000000'></td>
      </tr>
      <tr>
        <td height='25' colspan='5'><div align='right' class='style3'>Sub Total</div></td>
        <td><div align='right' class='style3'>".number_format($gsubtotAP,2,'.',',')."</div></td>
      </tr>
    </table></div></td>
  </tr>
";
}

$grandtotal=$asubtotCP+$csubtotCP+$esubtotCP+$gsubtotAP;

echo "
  <tr>
    <td height='2' bgcolor='#000000'></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='85%' height='30'><div align='right' class='style2'>Grand Total</div></td>
        <td width='15%'><div align='right' class='style2'>".number_format($grandtotal,2,'.',',')."</div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height='2' bgcolor='#000000'></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
";
?>
</body>
</html>
