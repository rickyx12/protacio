<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Test Code</title>
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
	font-size: 12px;
	font-weight: bold;
	color: #0033FF;
}
.style5 {
	font-family: Arial;
	font-size: 14px;
	font-weight: bold;
	color: #FF6600;
}
.style6 {
	font-family: Arial;
	font-size: 9px;
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
.button02 {
	font-family: Arial;
	font-size: 12px;
	font-weight: bold;
	color: #FF0000;
	background-color: #FFFFFF;
	border: 1px solid #000000;
}
-->
</style>
</head>

<body>
<?php



$patientNo=$_GET['patientNo'];

echo "
<table width='98%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='50%' height='30' class='style1'><div align='center'>207</div></td>
    <td width='50%' class='style1'><div align='center'>206</div></td>
  </tr>
  <tr>
    <td><div align='center'>
      <table width='600' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000'>
		<tr>
          <td><table width='600' border='0' cellspacing='0' cellpadding='0'>
            <tr>
";

$x=mysql_connect("192.168.1.209","root","hokage");
mysql_select_db('Coconut', $x);
$asql=mysql_query("SELECT lastName, firstName, middleName, Birthdate, Gender, Address, contactNo FROM patientRecord WHERE patientNo='$patientNo'");
while($afetch=mysql_fetch_array($asql)){
$lastName7=$afetch['lastName'];
$firstName7=$afetch['firstName'];
$middleName7=$afetch['middleName'];
$Birthdate7=$afetch['Birthdate'];
$Gender7=$afetch['Gender'];
$Address7=$afetch['Address'];
$contactNo7=$afetch['contactNo'];
}

mysql_close($x);
echo "
              <td><table width='600' border='0' cellspacing='0' cellpadding='0'>
                <tr>
                  <td width='100' height='20' class='style4'><div align='left'>&nbsp;$patientNo</div></td>
                  <td width='500' height='20' class='style4'><div align='left'>&nbsp;$lastName7, $firstName7 $middleName7</div></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td><table width='600' border='0' cellspacing='0' cellpadding='0'>
                <tr>
                  <td width='100' height='20' class='style2'><div align='left'>&nbsp;$Birthdate7</div></td>
                  <td width='100' height='20' class='style2'><div align='left'>$Gender7</div></td>
                  <td width='100' height='20' class='style2'><div align='left'>$contactNo7</div></td>
                  <td width='300' height='20' class='style2'><div align='left'>$Address7</div></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
      </table>
    </div></td>
    <td><div align='center'>
      <table width='600' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000'>
        <tr>
          <td><table width='600' border='0' cellspacing='0' cellpadding='0'>
            <tr>
";

$y=mysql_connect("localhost","root","Pr0taci001");
mysql_select_db('Coconut', $y);
$msql=mysql_query("SELECT lastName, firstName, middleName, Birthdate, Gender, Address, contactNo FROM patientRecord WHERE patientNo='$patientNo'");
while($mfetch=mysql_fetch_array($msql)){
$lastName6=$mfetch['lastName'];
$firstName6=$mfetch['firstName'];
$middleName6=$mfetch['middleName'];
$Birthdate6=$mfetch['Birthdate'];
$Gender6=$mfetch['Gender'];
$Address6=$mfetch['Address'];
$contactNo6=$mfetch['contactNo'];
}
mysql_close($y);
echo "
              <td><table width='600' border='0' cellspacing='0' cellpadding='0'>
                <tr>
                  <td width='100' height='20' class='style4'><div align='left'>&nbsp;$patientNo</div></td>
                  <td width='500' height='20' class='style4'><div align='left'>&nbsp;$lastName6, $firstName6 $middleName6</div></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td><table width='600' border='0' cellspacing='0' cellpadding='0'>
                <tr>
                  <td width='100' height='20' class='style2'><div align='left'>&nbsp;$Birthdate6</div></td>
                  <td width='100' height='20' class='style2'><div align='left'>$Gender6</div></td>
                  <td width='100' height='20' class='style2'><div align='left'>$contactNo6</div></td>
                  <td width='300' height='20' class='style2'><div align='left'>$Address6</div></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td height='40' class='style5'><div align='center'>Patient Transactions </div></td>
    <td class='style5'><div align='center'>Patient Transactions </div></td>
  </tr>
  <tr>
    <td valign='top'><div align='center'>
      <table width='100%' border='0' cellspacing='0' cellpadding='0'>
";

$x=mysql_connect("192.168.1.209","root","hokage");
mysql_select_db('Coconut', $x);
$bsql=mysql_query("SELECT registrationNo, temperature, height, weight, dateRegistered, dateUnregistered, room FROM registrationDetails WHERE patientNo='$patientNo' ORDER BY dateRegistered");
while($bfetch=mysql_fetch_array($bsql)){
$registrationNo7=$bfetch['registrationNo'];
$temperature7=$bfetch['temperature'];
$height7=$bfetch['height'];
$weight7=$bfetch['weight'];
$dateRegistered7=$bfetch['dateRegistered'];
$dateUnregistered7=$bfetch['dateUnregistered'];
$room7=$bfetch['room'];

echo "
	<tr>
          <td bgcolor='#00FF66'><div align='center'>
            <table width='600' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000'>
              <tr>
                <td><table width='600' border='0' cellspacing='0' cellpadding='0'>
                  <tr>
                    <td width='150' class='style2'><div align='left'>&nbsp;Reg. #: $registrationNo7</div></td>
                    <td width='150' class='style2'><div align='left'>$temperature7</div></td>
                    <td width='150' class='style2'><div align='left'>$height7</div></td>
                    <td width='150' class='style2'><div align='left'>$weight7</div></td>
                  </tr>
                  <tr>
                    <td class='style2'><div align='left'>&nbsp;$dateRegistered7</div></td>
                    <td class='style2'><div align='left'>$dateUnregistered7</div></td>
                    <td class='style2'><div align='left'>$room7</div></td>
                    <form id='CopyReg' name='CopyReg' method='get' action='CopyRegDetails.php'>
					<input name='patientNo' type='hidden' value='$patientNo' />
					<input name='registrationNo' type='hidden' value='$registrationNo7' />
		    		<td class='style2'><div align='right'>
                      <input name='Submit' type='submit' class='button01' value='Copy' />
                    </div></td>
		    		</form>
                  </tr>
                </table></td>
              </tr>
            </table>
          </div></td>
        </tr>
        <tr>
          <td height='10'></td>
        </tr>
        <tr>
          <td><div align='center'>
            <table width='600' border='0' cellspacing='0' cellpadding='0'>
              <tr>
                <td bgcolor='#000000'><table width='600' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000'>
                  <tr>
                    <td width='140' bgcolor='#0066FF' class='style3'><div align='center'>Description</div></td>
                    <td width='69' bgcolor='#0066FF' class='style3'><div align='center'>Price</div></td>
                    <td width='35' bgcolor='#0066FF' class='style3'><div align='center'>Qty.</div></td>
                    <td width='100' bgcolor='#0066FF' class='style3'><div align='center'>Gross</div></td>
                    <td width='70' bgcolor='#0066FF' class='style3'><div align='center'>Date</div></td>
                    <td width='115' bgcolor='#0066FF' class='style3'><div align='center'>Status</div></td>
                    <td width='50' bgcolor='#0066FF' class='style3'><div align='center'>Copy</div></td>
                  </tr>
";
//mysql_connect("localhost","root","hokage");
//mysql_select_db('coconut', $x);
$csql=mysql_query("SELECT itemNo, status, description, sellingPrice, quantity, total, dateCharge FROM patientCharges WHERE registrationNo='$registrationNo7' ORDER BY dateCharge, timeCharge");
while($cfetch=mysql_fetch_array($csql)){
$itemNo7=$cfetch['itemNo'];
$status7=$cfetch['status'];
$description7=$cfetch['description'];
$sellingPrice7=$cfetch['sellingPrice'];
$quantity7=$cfetch['quantity'];
$total7=$cfetch['total'];
$dateCharge7=$cfetch['dateCharge'];

echo "
                  <tr>
					<td bgcolor='#FFFFFF' class='style2'><div align='left'>&nbsp;$description7</div></td>
                    <td bgcolor='#FFFFFF' class='style2'><div align='right'>$sellingPrice7</div></td>
                    <td bgcolor='#FFFFFF' class='style2'><div align='center'>$quantity7</div></td>
                    <td bgcolor='#FFFFFF' class='style2'><div align='right'>$total7</div></td>
                    <td bgcolor='#FFFFFF' class='style2'><div align='center'>$dateCharge7</div></td>
                    <td bgcolor='#FFFFFF' class='style6'><div align='center'>$status7</div></td>
                    <form id='Copy' name='Copy' method='get' action='CopyChargesInputRegNo.php'>
                    <input type='hidden' name='patientNo' value='$patientNo' />
                    <input type='hidden' name='itemNo' value='$itemNo7' />
					<td bgcolor='#FFFFFF' class='style2'><div align='center'>
                      <input name='Transfer' type='submit' class='button01' id='Transfer' value='  C  ' />
                    </div></td>
					</form>
                  </tr>
";
}

echo "
                  <tr>
                    <td height='6' bgcolor='#0066FF'></td>
                    <td height='6' bgcolor='#0066FF'></td>
                    <td height='6' bgcolor='#0066FF'></td>
                    <td height='6' bgcolor='#0066FF'></td>
                    <td height='6' bgcolor='#0066FF'></td>
                    <td height='6' bgcolor='#0066FF'></td>
                    <td height='6' bgcolor='#0066FF'></td>
                  </tr>
                </table></td>
              </tr>
            </table>
          </div></td>
        </tr>
		<tr>
          <td height='10'></td>
        </tr>
";
}
mysql_close($x);
echo "
      </table>
    </div></td>
    <td valign='top'><div align='center'>
      <table width='100%' border='0' cellspacing='0' cellpadding='0'>
";

$y=mysql_connect("localhost","root","Pr0taci001");
mysql_select_db('Coconut', $y);
$nsql=mysql_query("SELECT registrationNo, temperature, height, weight, dateRegistered, dateUnregistered, room FROM registrationDetails WHERE patientNo='$patientNo' ORDER BY dateRegistered");
while($nfetch=mysql_fetch_array($nsql)){
$registrationNo6=$nfetch['registrationNo'];
$temperature6=$nfetch['temperature'];
$height6=$nfetch['height'];
$weight6=$nfetch['weight'];
$dateRegistered6=$nfetch['dateRegistered'];
$dateUnregistered6=$nfetch['dateUnregistered'];
$room6=$nfetch['room'];

echo "
        <tr>
          <td bgcolor='#00FF66'><div align='center'>
            <table width='600' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000'>
              <tr>
                <td><table width='600' border='0' cellspacing='0' cellpadding='0'>
                  <tr>
                    <td width='150' class='style2'><div align='left'>&nbsp;Reg. #:$registrationNo6</div></td>
                    <td width='150' class='style2'><div align='left'>$temperature6</div></td>
                    <td width='150' class='style2'><div align='left'>$height6</div></td>
                    <td width='150' class='style2'><div align='left'>$weight6</div></td>
                  </tr>
                  <tr>
                    <td class='style2'><div align='left'>&nbsp;$dateRegistered6</div></td>
                    <td class='style2'><div align='left'>$dateUnregistered6</div></td>
                    <td class='style2'><div align='left'>$room6</div></td>
                    <form id='form2' name='form2' method='get' action=''>
		    <td class='style2'><div align='right'>
                      <input name='Submit' type='submit' class='button02' value='Delete' />
                    </div></td>
		    </form>
                  </tr>
                </table></td>
              </tr>
            </table>
          </div></td>
        </tr>
        <tr>
          <td height='10'></td>
        </tr>
        <tr>
          <td><div align='center'>
            <table width='600' border='0' cellspacing='0' cellpadding='0'>
              <tr>
                <td bgcolor='#000000'><table width='600' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000'>
                  <tr>
                    <td width='140' bgcolor='#0066FF' class='style3'><div align='center'>Description</div></td>
                    <td width='69' bgcolor='#0066FF' class='style3'><div align='center'>Price</div></td>
                    <td width='35' bgcolor='#0066FF' class='style3'><div align='center'>Qty.</div></td>
                    <td width='100' bgcolor='#0066FF' class='style3'><div align='center'>Gross</div></td>
                    <td width='70' bgcolor='#0066FF' class='style3'><div align='center'>Date</div></td>
                    <td width='115' bgcolor='#0066FF' class='style3'><div align='center'>Status</div></td>
                    <td width='50' bgcolor='#0066FF' class='style3'><div align='center'>Del.</div></td>
                  </tr>
";

$osql=mysql_query("SELECT status, description, sellingPrice, quantity, total, dateCharge FROM patientCharges WHERE registrationNo='$registrationNo6' ORDER BY dateCharge, timeCharge");
while($ofetch=mysql_fetch_array($osql)){
$status6=$ofetch['status'];
$description6=$ofetch['description'];
$sellingPrice6=$ofetch['sellingPrice'];
$quantity6=$ofetch['quantity'];
$total6=$ofetch['total'];
$dateCharge6=$ofetch['dateCharge'];

echo "
                  <tr>
		    <td bgcolor='#FFFFFF' class='style2'><div align='left'>&nbsp;$description6</div></td>
                    <td bgcolor='#FFFFFF' class='style2'><div align='right'>$sellingPrice6</div></td>
                    <td bgcolor='#FFFFFF' class='style2'><div align='center'>$quantity6</div></td>
                    <td bgcolor='#FFFFFF' class='style2'><div align='right'>$total6</div></td>
                    <td bgcolor='#FFFFFF' class='style2'><div align='center'>$dateCharge6</div></td>
                    <td bgcolor='#FFFFFF' class='style6'><div align='center'>$status6</div></td>
                    <form id='form1' name='form1' method='get' action=''>
		   <td bgcolor='#FFFFFF' class='style2'><div align='center'>
                      <input name='Transfer' type='submit' class='button02' id='Transfer' value='  X  ' />
                    </div></td>
		    </form>
                  </tr>
";
}


echo "
                  <tr>
                    <td height='6' bgcolor='#0066FF'></td>
                    <td height='6' bgcolor='#0066FF'></td>
                    <td height='6' bgcolor='#0066FF'></td>
                    <td height='6' bgcolor='#0066FF'></td>
                    <td height='6' bgcolor='#0066FF'></td>
                    <td height='6' bgcolor='#0066FF'></td>
                    <td height='6' bgcolor='#0066FF'></td>
                  </tr>
                </table></td>
              </tr>
            </table>
          </div></td>
        </tr>
        <tr>
          <td height='10'></td>
        </tr>
";
}

mysql_close($y);

echo "
      </table>
    </div></td>
  </tr>
</table>
";
?>
</body>
</html>
