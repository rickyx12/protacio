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
$description=$_GET['description'];
$quantity=$_GET['quantity'];
$sellingPrice=$_GET['sellingPrice'];
$title=$_GET['title'];

$trimdesc=trim($description);

if($title=='-Select Type-'){
echo "
<div align='left' class='style2'>
Select cahrge type! Try again!
</div>
";
echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=error.php?registrationNo=$registrationNo&username=$username&room=$room&batchNo=$batchNo&description=$description&quantity=$quantity&sellingPrice=$sellingPrice&title=$title'>";
}
else{
if(($description=='')||($quantity=='')||($sellingPrice=='')){
echo "
<div align='left' class='style2'>
Description, Quantity and Selling Price must not be blank! Try again!
</div>
";
echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=error.php?registrationNo=$registrationNo&username=$username&room=$room&batchNo=$batchNo&description=$description&quantity=$quantity&sellingPrice=$sellingPrice&title=$title'>";
}
else{
if($trimdesc==''){
echo "
<div align='left' class='style2'>
Invalid Description! Try again!
</div>
";
echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=error.php?registrationNo=$registrationNo&username=$username&room=$room&batchNo=$batchNo&description=$description&quantity=$quantity&sellingPrice=$sellingPrice&title=$title'>";
}
else{
if((!is_numeric($quantity))||(!is_numeric($sellingPrice))){
echo "
<div align='left' class='style2'>
Invalid Quantity or Selling Price value! Try again!
</div>
";
echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=error.php?registrationNo=$registrationNo&username=$username&room=$room&batchNo=$batchNo&description=$description&quantity=$quantity&sellingPrice=$sellingPrice&title=$title'>";
}
else{
echo "
<div align='left' class='style1'>
Adding Custom Charge...
</div>
";

$ptime=date("H:i:s");

echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=http://".$cuz->getMyUrl()."/COCONUT/availableCharges/addCharges.php?status=UNPAID&registrationNo=$registrationNo&chargesCode=99&description=$description&sellingPrice=$sellingPrice&discount=0&timeCharge=$ptime&chargeBy=$username&service=Examination&title=$title&paidVia=Cash&cashPaid=0.00&batchNo=$batchNo&username=$username&quantity=$quantity&inventoryFrom=none&paycash=no'>";
}
}
}
}
?>
</body>
</html>
