<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Purchase Order</title>
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

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<style type="text/css">
<!--
.style1 {font-family: Arial;font-size: 14px;color: #000000;font-weight: bold;}
.style2 {font-family: Arial;font-size: 14px;color: #FF0000;font-weight: bold;}
-->
</style>
</head>

<body onload="placeFocus()">
<?php
include("../myDatabase.php");
$cuz = new database();

($GLOBALS["___mysqli_ston"] = mysqli_connect($cuz->myHost(), $cuz->getUser(), $cuz->getPass()));
((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . $cuz->getDB()));

$username=$_GET['username'];
$poNo=$_GET['poNo'];
$poItemNo=$_GET['poItemNo'];
$quantity=$_GET['quantity'];
$unit=$_GET['unit'];
$unitPrice=$_GET['unitPrice'];

$dateadded=date("YmdHis");

echo "
<div align='left' class='style1'>Saving...</div>
";

if(!is_numeric($unitPrice)){$trueunitPrice=0;}else{$trueunitPrice=$unitPrice;}

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE purchaseOrderItems SET quantity='$quantity', unit='$unit', unitPrice='$trueunitPrice' WHERE poItemNo='$poItemNo'");

echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=CreatedPurchaseOrder.php?username=$username&poNo=$poNo'>";
?>
</body>
</html>
