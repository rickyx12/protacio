<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Add Discount</title>
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
<style type='text/css'>
.txtBox {border: 1px solid #000;color: #000;height: 30px;width: 320px;padding:4px 4px 4px 5px;}
.shortField {border: 1px solid #000;color: #000;height: 30px;width: 120px;padding:4px 4px 4px 5px;}
.labelz {font-size:13px;}
.comboBox {border: 1px solid #000;color: #000;height: 30px;width: 320px;padding:4px 4px 4px 5px;}
.comboBoxShort {border: 1px solid #000;color: #000;height: 30px;width: 65px;padding:4px 4px 4px 5px;}
.panz{border: 1px solid #000;color: #000;height: 18px;width: 20px;border-color:white black black black;font-size:18px;text-align:center;}
.panz1{border: 1px solid #000;color: #000;height: 18px;width: 20px;border-color:white black black white;font-size:18px;text-align:center;}
</style>
</head>

<body onload="placeFocus()">
<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$ro = new database();
$ro->getPatientProfile($registrationNo);
echo "
<form method='get' action='addDiscount1.php'>
<center>
<br />
<div style='border:1px solid #000000; width:500px; height:auto; border-color:black black black black;'>
<br />
<table border=0 cellpadding=0 cellspacing=0>
";


if($ro->selectNow("registeredUser","module","username",$username) == "CASHIER" || $ro->selectNow("registeredUser","module","username",$username) == "BILLING" || $ro->selectNow("registeredUser","module","username",$username) == "PHARMACY" ) {
echo "
  <tr>
    <td><font class='labelz'><b>Discount (Cash)</b></font></td>
    <td><input type=text maxlength=10 name='discount' autocomplete='off' value='".$ro->getRegistrationDetails_discount()."' class='shortField'></td>
  </tr>
  <tr>
    <td><font class='labelz'><b>Discount(Company)</b></font></td>
    <td><input type=text maxlength=10 name='companyDiscount' autocomplete=off value='".$ro->selectNow("registrationDetails","companyDiscount","registrationNo",$registrationNo)."' class='shortField'></td>
  </tr>
";
}
else {
echo $ro->coconutHidden("discount","");
echo $ro->coconutHidden("companyDiscount","");
}

echo "
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type=submit value='        Edit        ' style='border:1px solid #000000; background:#3b5998 no-repeat 4px 4px; color:white;'></td>
  </tr>
</table>
<br />
</div>
</center>
<input type='hidden' name='patientNo' value='".$ro->getRegistrationDetails_patientNo()."'>
<input type='hidden' name='registrationNo' value='$registrationNo'>
<input type='hidden' name='username' value='$username'>
</form>
";
?>
</body>
</html>
