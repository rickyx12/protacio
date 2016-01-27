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
	font-size: 12px;
	font-weight: bold;
	color: #000000;
}
.style2 {
	font-family: Arial;
	font-size: 14px;
	font-weight: bold;
	color: #000000;
}
.style3 {
	font-family: Arial;
	font-size: 12px;
	color: #000000;
}
.style4 {
	font-family: Arial;
	font-size: 13px;
	font-weight: bold;
	color: #000000;
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
include("../myDatabase2.php");
$ro = new database2();

mysql_connect($ro->myHost(),$ro->getUser(),$ro->getPass());
mysql_select_db($ro->getDB());

$status=$_GET['status'];
$reportName=$_GET['reportName'];
$module=$_GET['module'];
$month=$_GET['month'];
$day=$_GET['day'];
$year=$_GET['year'];
$fromTime_hour=$_GET['fromTime_hour'];
$fromTime_minutes=$_GET['fromTime_minutes'];
$fromTime_seconds=$_GET['fromTime_seconds'];
$toTime_hour=$_GET['toTime_hour'];
$toTime_minutes=$_GET['toTime_minutes'];
$toTime_seconds=$_GET['toTime_seconds'];
$username=$_GET['username'];
$cutoff=$_GET['cutoff'];
$shift=$_GET['shift'];

echo "
<div align='left'>
<span class='style2'>Colection Report</span>
<br />
<span class='style1'>$date</span>
<br />
<span class='style1'>$timerange</span>
<br />
<br />
<form id='form1' name='form1' method='post' action=''>
  <table width='100%' border='0' cellspacing='0' cellpadding='0'>
    <tr>
      <td><div align='left'>
        <select name='select' class='textfield01'>
          <option value='1' selected='selected'>Shift 1</option>
          <option value='2'>Shift 2</option>
          <option value='3'>Shift 3</option>
        </select>
      </div></td>
    </tr>
    <tr>
      <td><table width='900' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000'>
        <tr>
          <td width='125' height='30' class='style1'><div align='center'>Name</div></td>
		  <td width='130' class='style1'><div align='center'>Description</div></td>
          <td width='60' class='style1'><div align='center'>Price</div></td>
          <td width='60' class='style1'><div align='center'>Total</div></td>
          <td width='70' class='style1'><div align='center'>Paid</div></td>
          <td width='98' class='style1'><div align='center'>Post By </div></td>
          <td width='80' class='style1'><div align='center'>Hospital Bill</div></td>
          <td width='100' class='style1'><div align='center'>Professional Fee</div></td>
          <td width='80' class='style1'><div align='center'>Balance</div></td>
          <td width='25' class='style1'><div align='center'>S1</div></td>
		  <td width='25' class='style1'><div align='center'>S2</div></td>
		  <td width='25' class='style1'><div align='center'>S3</div></td>
        </tr>
";

$dateSelected = $year."-".$month."-".$day;
$fromTimez = $fromTime_hour.":".$fromTime_minutes.":".$fromTime_seconds;
$toTimez = $toTime_hour.":".$toTime_minutes.":".$toTime_seconds;

if( $ro->selectNow("registeredUser","module","username",$username) == "ADMIN" ) {
$result = mysql_query("SELECT rd.registrationNo,pp.paidVia,upper(pr.completeName) as completeName,pp.paymentFor,pp.paidBy,pp.datePaid,pp.amountPaid,pp.pf,pp.admitting,pp.receiptType,pp.paymentNo FROM patientPayment pp,patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and pp.registrationNo = rd.registrationNo and rd.registrationNo = pc.registrationNo and pp.datePaid = '$dateSelected' and (pp.timePaid between '$fromTimez' and '$toTimez') and paymentFor not in ('REFUND') group by paymentNo order by completeName asc ");
}
else {
$result = mysql_query("SELECT rd.registrationNo,pp.paidVia,upper(pr.completeName) as completeName,pp.paymentFor,pp.paidBy,pp.datePaid,pp.amountPaid,pp.pf,pp.admitting,pp.receiptType,pp.paymentNo FROM patientPayment pp,patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and pp.registrationNo = rd.registrationNo and rd.registrationNo = pc.registrationNo and pp.datePaid = '$dateSelected' and (pp.timePaid between '$fromTimez' and '$toTimez') and paymentFor not in ('REFUND') and pp.paidBy='$username' group by paymentNo order by completeName asc ");
}

while($row = mysql_fetch_array($result)){
$ro->partial+=$row['amountPaid'];
$ro->getPartialReport_hb += $row['amountPaid'];
$ro->getPartialReport_pf += $row['pf'];
$ro->getPartialReport_admitting += $row['admitting'];

if( $row['receiptType'] == "medicine" ){
$ro->getPartialReport_medicine += $row['amountPaid'];
}
else if( $row['receiptType'] == "hospital" ){
$ro->getPartialReport_hospital += $row['amountPaid'];
}

echo "
        <tr>
          <td height='30' class='style3'><div align='left'>&nbsp;".$row['completeName']."</div></td>
		  <td class='style3'><div align='left'>&nbsp;".$row['paymentFor']."</div></td>
          <td class='style3'><div align='right'>".number_format(($row['amountPaid'] + $row['pf']) + $row['admitting'],2)."</div></td>
          <td class='style3'><div align='right'>".number_format(($row['amountPaid'] + $row['pf']) + $row['admitting'],2)."&nbsp;</div></td>
          <td class='style3'><div align='right'>".(($row['amountPaid']+$row['pf'])+$row['admitting'])." - (".$row['paidVia']."&nbsp;</div></td>
          <td class='style3'><div align='center'>".$row['paidBy']."</div></td>
          <td class='style3'><div align='right'>".number_format($row['amountPaid'],2)."&nbsp;</div></td>
          <td class='style3'><div align='right'>".number_format($row['pf'],2)."&nbsp;</div></td>
          <td class='style3'><div align='right'></div></td>
          <td class='style3'><div align='center'>
            <input name='ipd$z' type='hidden' value='N' />
			<input name='checkbox' type='radio' class='textfield01' value='Y' />
          </div></td>
		  <td class='style3'><div align='center'>
            <input name='ipd$z' type='hidden' value='N' />
			<input name='checkbox' type='radio' class='textfield01' value='Y' />
          </div></td>
		  <td class='style3'><div align='center'>
            <input name='ipd$z' type='hidden' value='N' />
			<input name='checkbox' type='radio' class='textfield01' value='Y' />
          </div></td>
        </tr>
";
}
/*<input name="" type="radio" value="" checked />*/

echo "
        <tr>
          <td height='30' colspan='4' class='style4'><div align='left'>Total IPD</div></td>
		  <td class='style4'><div align='right'></div></td>
          <td class='style4'><div align='center'></div></td>
          <td class='style4'><div align='right'></div></td>
          <td class='style4'><div align='right'></div></td>
          <td colspan='4' class='style4'><div align='center'></div></td>
        </tr>




		<tr>
          <td height='30' class='style3'><div align='left'>&nbsp;$name</div></td>
		  <td class='style3'><div align='left'>&nbsp;$description</div></td>
          <td class='style3'><div align='right'>$price&nbsp;</div></td>
          <td class='style3'><div align='right'>$total&nbsp;</div></td>
          <td class='style3'><div align='right'>$paid&nbsp;</div></td>
          <td class='style3'><div align='center'>$user</div></td>
          <td class='style3'><div align='right'>$hospbill&nbsp;</div></td>
          <td class='style3'><div align='right'>$pf&nbsp;</div></td>
          <td class='style3'><div align='right'>$balance&nbsp;</div></td>
          <td class='style3'><div align='center'>
            <input name='opd$y' type='hidden' value='N' />
			<input name='checkbox' type='radio' class='textfield01' value='Y' />
          </div></td>
		  <td class='style3'><div align='center'>
            <input name='opd$y' type='hidden' value='N' />
			<input name='checkbox' type='radio' class='textfield01' value='Y' />
          </div></td>
		  <td class='style3'><div align='center'>
            <input name='opd$y' type='hidden' value='N' />
			<input name='checkbox' type='radio' class='textfield01' value='Y' />
          </div></td>
        </tr>




        <tr>
          <td height='30' colspan='4' class='style4'><div align='left'>Total OPD</div></td>
		  <td class='style4'><div align='right'></div></td>
          <td class='style4'><div align='center'></div></td>
          <td class='style4'><div align='right'></div></td>
          <td class='style4'><div align='right'></div></td>
          <td colspan='4' class='style4'><div align='center'></div></td>
        </tr>



		<tr>
          <td height='30' class='style3'><div align='left'>&nbsp;$name</div></td>
		  <td class='style3'><div align='left'>&nbsp;$description</div></td>
          <td class='style3'><div align='right'>$price&nbsp;</div></td>
          <td class='style3'><div align='right'>$total&nbsp;</div></td>
          <td class='style3'><div align='right'>$paid&nbsp;</div></td>
          <td class='style3'><div align='center'>$user</div></td>
          <td class='style3'><div align='right'>$hospbill&nbsp;</div></td>
          <td class='style3'><div align='right'>$pf&nbsp;</div></td>
          <td class='style3'><div align='right'>$balance&nbsp;</div></td>
          <td class='style3'><div align='center'>
            <input name='oi$x' type='hidden' value='N' />
			<input name='checkbox' type='radio' class='textfield01' value='Y' />
          </div></td>
		  <td class='style3'><div align='center'>
            <input name='oi$x' type='hidden' value='N' />
			<input name='checkbox' type='radio' class='textfield01' value='Y' />
          </div></td>
		  <td class='style3'><div align='center'>
            <input name='oi$x' type='hidden' value='N' />
			<input name='checkbox' type='radio' class='textfield01' value='Y' />
          </div></td>
        </tr>




        <tr>
          <td height='30' colspan='4' class='style4'><div align='left'>Total Other Income</div></td>
		  <td class='style4'><div align='right'></div></td>
          <td class='style4'><div align='center'></div></td>
          <td class='style4'><div align='right'></div></td>
          <td class='style4'><div align='right'></div></td>
          <td colspan='4' class='style4'><div align='center'></div></td>
        </tr>




		<tr>
          <td height='30' colspan='4' class='style4'><div align='left'>SUB TOTAL</div></td>
		  <td class='style4'><div align='right'></div></td>
          <td class='style4'><div align='center'></div></td>
          <td class='style4'><div align='right'></div></td>
          <td class='style4'><div align='right'></div></td>
          <td colspan='4' class='style4'><div align='center'></div></td>
        </tr>



		<tr>
          <td height='35' colspan='12' class='style4'><div align='left'>EXPENSES</div></td>
        </tr>

		<tr>
          <td height='30' class='style3'><div align='left'>&nbsp;$name</div></td>
		  <td class='style3'><div align='left'>&nbsp;$description</div></td>
          <td class='style3'><div align='right'>$price&nbsp;</div></td>
          <td class='style3'><div align='right'>$total&nbsp;</div></td>
          <td class='style3'><div align='right'>$paid&nbsp;</div></td>
          <td class='style3'><div align='center'>$user</div></td>
          <td class='style3'><div align='right'>$hospbill&nbsp;</div></td>
          <td class='style3'><div align='right'>$pf&nbsp;</div></td>
          <td class='style3'><div align='right'>$balance&nbsp;</div></td>
          <td class='style3'><div align='center'>
            <input name='exp$w' type='hidden' value='N' />
			<input name='checkbox' type='radio' class='textfield01' value='Y' />
          </div></td>
		  <td class='style3'><div align='center'>
            <input name='exp$w' type='hidden' value='N' />
			<input name='checkbox' type='radio' class='textfield01' value='Y' />
          </div></td>
		  <td class='style3'><div align='center'>
            <input name='exp$w' type='hidden' value='N' />
			<input name='checkbox' type='radio' class='textfield01' value='Y' />
          </div></td>
        </tr>




        <tr>
          <td height='30' colspan='4' class='style4'><div align='left'>Total Expenses </div></td>
		  <td class='style4'><div align='right'></div></td>
          <td class='style4'><div align='center'></div></td>
          <td class='style4'><div align='right'></div></td>
          <td class='style4'><div align='right'></div></td>
          <td colspan='4' class='style4'><div align='center'></div></td>
        </tr>




		<tr>
          <td height='35' colspan='4' class='style4'><div align='left'>GRAND TOTAL</div></td>
		  <td class='style4'><div align='right'></div></td>
          <td class='style4'><div align='center'></div></td>
          <td class='style4'><div align='right'></div></td>
          <td class='style4'><div align='right'></div></td>
          <td colspan='4' class='style4'><div align='center'></div></td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>
</div>
";
?>
</body>
</html>
