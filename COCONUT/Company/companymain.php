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
	font-size: 14px;
	font-weight: bold;
	color: #3B5998;
	background-color: #FFFFFF;
	border: 1px solid #3B5998;
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

($GLOBALS["___mysqli_ston"] = mysqli_connect($cuz->myHost(), $cuz->getUser(), $cuz->getPass()));
((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . $cuz->getDB()));

$patientNo=$_GET['patientNo'];
$registrationNo=$_GET['registrationNo'];
$username=$_GET['username'];

echo "
<div align='left'>
";

if($patientNo!=""){
$bsql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT lastName, firstName FROM patientRecord WHERE patientNo='$patientNo'");
while($bfetch=mysqli_fetch_array($bsql)){
$lastName=$bfetch['lastName'];
$firstName=$bfetch['firstName'];
}

$asql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT Company FROM registrationDetails WHERE patientNo='$patientNo' AND registrationNo='$registrationNo'");
while($afetch=mysqli_fetch_array($asql)){
$Company=$afetch['Company'];
}

$lastNamefmt=strtoupper($lastName);
$firstNamefmt=strtoupper($firstName);

echo "
<span class='style3'>$lastNamefmt, $firstNamefmt - $Company</span>
<br /><br />
";
}

echo "
  <table width='100%' border='0' cellspacing='0' cellpadding='0'>
	<form id='form1' name='form1' target='mainFrame' method='get' action='updatecharges.php'>
	<input name='patientNo' type='hidden' value='$patientNo' />
	<input name='registrationNo' type='hidden' value='$registrationNo' />
	<input name='username' type='hidden' value='$username' />
      <tr>
        <td><div align='left'>
          <input name='Proceed' type='submit' class='button01' value='Proceed' />
        </div></td>
      </tr>
	  <tr>
        <td><div align='left'>
            <table width='98%' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000'>
              <tr>
                <td width='6%' bgcolor='#3B5998' class='style1'><div align='center'>Cash</div></td>
                <td width='12%' bgcolor='#3B5998' class='style1'><div align='center'>HMO/Company</div></td>
                <td width='43%' bgcolor='#3B5998' class='style1'><div align='center'>Description</div></td>
                <td width='10%' bgcolor='#3B5998' class='style1'><div align='center'>Total</div></td>
                <td width='9%' bgcolor='#3B5998' class='style1'><div align='center'>Quantity</div></td>
                <td width='10%' bgcolor='#3B5998' class='style1'><div align='center'>Cash</div></td>
                <td width='10%' bgcolor='#3B5998' class='style1'><div align='center'>Company</div></td>
              </tr>
";

if($registrationNo!=''){
$num=0;
$asql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT itemNo, status, description, quantity, total, cashUnpaid, company FROM patientCharges WHERE status='UNPAID' AND registrationNo='$registrationNo'");
while($afetch=mysqli_fetch_array($asql)){
$itemNo=$afetch['itemNo'];
$status=$afetch['status'];
$description=$afetch['description'];
$total=$afetch['total'];
$company=$afetch['company'];
$cashUnpaid=$afetch['cashUnpaid'];
$quantity=$afetch['quantity'];

$num++;

$totalfmt=number_format($total,2,'.',',');
$companyfmt=number_format($company,2,'.',',');
$cashUnpaidfmt=number_format($cashUnpaid,2,'.',',');

echo "
              <tr>
                <td height='20' class='style2'><div align='center'>
                  <input type='hidden' name='type$num' value='' />
				  <input type='radio' class='pd' name='type$num' value='cash' />
                </div></td>
                <td height='20' class='style2'><div align='center'>
				  <input type='radio' class='pd' name='type$num' value='company' />
                </div></td>
                <td height='20' class='style2'><div align='left'>&nbsp;$description</div></td>
		<td height='20' class='style2'><div align='right'>$totalfmt&nbsp;</div></td>
                <td height='20' class='style2'><div align='center'>$quantity</div></td>
                <td height='20' class='style2'><div align='right'>$cashUnpaidfmt&nbsp;</div></td>
                <td height='20' class='style2'><div align='right'>$companyfmt&nbsp;<input type='hidden' name='itemNo$num' value='$itemNo' /></div></td>
              </tr>
";
}
echo "<input name='num' type='hidden' value='$num' />";
}
echo "
            </table>
        </div></td>
      </tr>
	</form>
  </table>
</div>
";
?>
</body>

</html>
