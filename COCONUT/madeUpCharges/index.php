<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Made Up Charges</title>
<style type="text/css">
<!--
.style1 {font-family: Arial; font-size: 12px; font-weight: bold; color: #FFFFFF; }
.button01 {font-family: Arial; font-size: 12px;	font-weight: bold; color: #FF0000; background-color: #FFFFFF; border: 1px solid #000000; }
.textfield01 {font-family: Arial; font-size: 12px; font-weight: bold; color: #000000; background-color: #FFFFFF; border: 1px solid #000000; }
-->
</style>
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
</head>

<body onload="placeFocus()">
<?php
$registrationNo=$_GET['registrationNo'];
$username=$_GET['username'];
$room=$_GET['room'];
$batchNo=$_GET['batchNo'];

echo "
<div align='left'>
  <table width='600' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000'>
    <form id='Add' name='Add' method='get' action='verify.php'>
      <tr>
        <td width='212' height='20' bgcolor='#3B5998'><div align='center' class='style1'>Description</div></td>
        <td width='70' height='20' bgcolor='#3B5998'><div align='center' class='style1'>Qty.</div></td>
        <td width='70' height='20' bgcolor='#3B5998'><div align='center' class='style1'>Price</div></td>
        <td width='171' height='20' bgcolor='#3B5998'><div align='center' class='style1'>Ttype</div></td>
        <td width='65' height='20' bgcolor='#3B5998'><div align='center' class='style1'>Add</div></td>
      </tr>
      <tr>
        <td height='34'><div align='center'>
            <input name='description' type='text' class='textfield01' />
        </div></td>
        <td><div align='center'>
            <input name='quantity' type='text' class='textfield01' size='7' value='1' />
        </div></td>
        <td><div align='center'>
            <input name='sellingPrice' type='text' class='textfield01' size='7' />
        </div></td>
        <td><div align='center'>
            <select name='title' class='textfield01'>
";


echo "
              <option selected='selected'>-Select Type-</option>
              <option value='MISCELLANEOUS'>Miscellaneous</option>
              <option value='LABORATORY'>Laboratory</option>
              <option value='XRAY'>X-Ray</option>
              <option value='ULTRASOUND'>Ultrasound</option>
              <option value='PROFESSIONAL FEE'>Professional Fee</option>
              <option value='CTSCAN'>CT SCAN</option>
              <option value='REHAB'>Physical Theraphy</option>
              <option value='SUPPLIES'>Supplies</option>
              <option value='MEDICINE'>Medicine</option>
";


echo "
            </select>
        </div></td>
        <td><div align='center'>
	  <input type='hidden' name='registrationNo' value='$registrationNo' />
	  <input type='hidden' name='username' value='$username' />
	  <input type='hidden' name='room' value='$room' />
	  <input type='hidden' name='batchNo' value='$batchNo' />
          <input name='Submit' type='submit' class='button01' value='Add' />
        </div></td>
      </tr>
    </form>
  </table>
</div>
";
?>
</body>
</html>
