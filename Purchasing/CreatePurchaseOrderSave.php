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

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$username=$_GET['username'];
$terms=$_GET['terms'];
$supplier=$_GET['supplier'];
$transM=$_GET['transM'];
$transD=$_GET['transD'];
$transY=$_GET['transY'];
$bx=$_GET['bx'];

$transDate=$transY.$transM.$transD;

$dateadded=date("YmdHis");
$rcvDate=date("Ymd");

if($supplier=="-Select Supplier-"){
echo "
<div align='left' class='style2'>Please select a supplier. Try again!!!</div>
";
echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=ReOrderList.php?username=$username&show=Medicine&sort=1'>";
}
else{
if($terms=="-Select Terms-"){
echo "
<div align='left' class='style2'>Please select a supplier. Try again!!!</div>
";
echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=ReOrderList.php?username=$username&show=Medicine&sort=1'>";
}
else{
echo "
<div align='left' class='style1'>Saving...</div>
";
$pdate=date("Ymd");
$cdatesql=mysql_query("SELECT counterdate FROM counters WHERE counterdate='$pdate'");
$cdatecount=mysql_num_rows($cdatesql);
if($cdatecount==0){mysql_query("UPDATE counters SET counterdate='$pdate', counter03='0', counter04='0'");}
$c3sql=mysql_query("SELECT counter03 FROM counters");
while($c3fetch=mysql_fetch_array($c3sql)){$c3=$c3fetch['counter03'];}
if($c3<10){$poNo=$pdate."000".$c3;}
else if(($c3<100)&&($c3>9)){$poNo=$pdate."00".$c3;}
else if(($c3<1000)&&($c3>99)){$poNo=$pdate."0".$c3;}
else{$poNo=$pdate.$c3;}

mysql_query("INSERT INTO `Coconut`.`purchaseOrderForm` (`poNo`, `supplier`, `terms`, `transactionDate`, `deliveryDate`, `dateAdded`, `status`, `logInUser`) VALUES ('$poNo', '$supplier', '$terms', '$transDate', '$rcvDate', '$dateadded', 'Active', '$username')");

for($x=1;$x<=$bx;$x++){
$var1="stockCardNo".$x;
$var2="quantity".$x;
$var3="unit".$x;
$var4="unitPrice".$x;

$stockCardNo=$_GET[$var1];
$quantity=$_GET[$var2];
$unit=$_GET[$var3];
$unitPrice=$_GET[$var4];

if(!is_numeric($unitPrice)){$trueunitPrice=0;}else{$trueunitPrice=$unitPrice;}

$descsql=mysql_query("SELECT description FROM inventoryStockCard WHERE stockCardNo='$stockCardNo'");
while($descfetch=mysql_fetch_array($descsql)){$description=$descfetch['description'];}

$c4sql=mysql_query("SELECT counter04 FROM counters");
while($c4fetch=mysql_fetch_array($c4sql)){$c4=$c4fetch['counter04'];}
if($c4<10){$poItemNo=$pdate."000".$c4;}
else if(($c4<100)&&($c4>9)){$poItemNo=$pdate."00".$c4;}
else if(($c4<1000)&&($c4>99)){$poItemNo=$pdate."0".$c4;}
else{$poItemNo=$pdate.$c4;}

mysql_query("INSERT INTO `Coconut`.`purchaseOrderItems` (`poItemNo`, `poNo`, `stockCardNo`, `description`, `quantity`, `unit`, `unitPrice`, `dateAdded`, `status`, `logInUser`) VALUES ('$poItemNo', '$poNo', '$stockCardNo', '$description', '$quantity', '$unit', '$trueunitPrice', '$dateadded', 'Active', '$username')");

$poItemNoplus=$c4+1;

mysql_query("UPDATE counters SET counter04='$poItemNoplus'");

}

$poNoplus=$c3+1;

mysql_query("UPDATE counters SET counter03='$poNoplus'");
echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=CreatedPurchaseOrder.php?username=$username&poNo=$poNo'>";
}
}
?>
</body>
</html>
