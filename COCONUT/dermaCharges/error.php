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
$Price=$_GET['Price'];
$Capital=$_GET['Capital'];


echo "
<div align='left'>
  <table border='1' cellpadding='0' cellspacing='0' bordercolor='#000000'>
    <form id='Add' name='Add' method='get' action='verify.php'>
      <tr>
	
        <td width='auto' height='20' bgcolor='#3B5998'><div align='center' class='style1'>Price</div></td>
        <td width='auto' height='20' bgcolor='#3B5998'><div align='center' class='style1'>Unit Cost</div></td>
        <td width='auto' height='20' bgcolor='#3B5998'><div align='center' class='style1'></div></td>
      </tr>
";


echo "
      <tr>
        <td height='25'><div align='center'>&nbsp;<input name='Price' type='text' class='textfield01' placeholder='Price' value='$Price' />&nbsp;</div></td>
        <td height='25'><div align='center'>&nbsp;<input name='Capital' type='text' class='textfield01' placeholder='Unit Cost' value='$Capital' />&nbsp;</div></td>
        <td height='25'><div align='center'>&nbsp;<input name='Submit' type='submit' class='button01' value='  Add  ' />&nbsp;</div></td>
      </tr>
";


echo "
    <input type='hidden' name='registrationNo' value='$registrationNo' />
    <input type='hidden' name='username' value='$username' />
    <input type='hidden' name='room' value='$room' />
    <input type='hidden' name='batchNo' value='$batchNo' />
    </form>
  </table>
</div>
";
?>
</body>
</html>
