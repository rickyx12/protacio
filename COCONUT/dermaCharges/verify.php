<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Made Up Charges</title>
<style type="text/css">
<!--
.style1 {font-family: Arial; font-size: 14px; font-weight: bold; color: #000000; }
.style2 {font-family: Arial; font-size: 14px; font-weight: bold; color: #FF0000; }
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
include("../../myDatabase.php");
$cuz = new database();

$registrationNo=$_GET['registrationNo'];
$username=$_GET['username'];
$room=$_GET['room'];
$batchNo=$_GET['batchNo'];
$Price=$_GET['Price'];
$Capital=$_GET['Capital'];

if(($Price=='')||($Capital=='')){
echo "
<div align='left' class='style2'>
Price and Capital must not be blank! Try again!
</div>
";
echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=error.php?registrationNo=$registrationNo&username=$username&room=$room&batchNo=$batchNo&Price=$Price&Capital=$Capital'>";
}
else{
if((!is_numeric($Price))||(!is_numeric($Capital))){
echo "
<div align='left' class='style2'>Invalid Price or Capital value. Try again!!!</div>
";
echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=error.php?registrationNo=$registrationNo&username=$username&room=$room&batchNo=$batchNo&Price=$Price&Capital=$Capital'>";
}
else{
echo "
<div align='left' class='style1'>
Adding Custom Charge...
</div>
";

$ptime=date("H:i:s");

echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=http://".$cuz->getMyUrl()."/COCONUT/availableCharges/addCharges.php?status=UNPAID&registrationNo=$registrationNo&chargesCode=4101985&description=Derma. Charges&sellingPrice=$Price&discount=0&timeCharge=$ptime&chargeBy=$username&service=Examination&title=DERMA&paidVia=Cash&cashPaid=0.00&batchNo=$batchNo&username=$username&quantity=1&inventoryFrom=none&paycash=no&remarks=$Capital'>";
}
}

?>
</body>
</html>
