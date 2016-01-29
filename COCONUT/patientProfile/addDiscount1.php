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
$registrationNo=$_GET['registrationNo'];
$username=$_GET['username'];
$discount=$_GET['discount'];
$companyDiscount=$_GET['companyDiscount'];
$discountType = $_GET['discountType'];

$ro = new database();

$ro->editNow("registrationDetails","registrationNo",$registrationNo,"discount",$discount);
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"companyDiscount",$companyDiscount);
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"discountType",$discountType);

echo "
<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientProfile_handler.php?registrationNo=$registrationNo&username=$username';
</script>
";

?>
</body>
</html>
