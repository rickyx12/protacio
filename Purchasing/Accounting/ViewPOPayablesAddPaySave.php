<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Create Purchase Report</title>
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
.style1 {font-family: Arial;font-size: 14px;color: #FFFFFF;font-weight: bold;}
.style2 {font-family: Arial;font-size: 12px;color: #FFFFFF;font-weight: bold;}
.style3 {font-family: Arial;font-size: 14px;color: #000000;font-weight: bold;}
.textfield1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px; width: 200px;}
.textfield2 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px;}
.button1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px;}
-->
</style>
</head>

<body onload="placeFocus()">
<?php
include("../../myDatabase3.php");
$cuz = new database3();

($GLOBALS["___mysqli_ston"] = mysqli_connect($cuz->myHost(), $cuz->getUser(), $cuz->getPass()));
((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . $cuz->getDB()));

$year=date("Y");
$month=date("m");
$day=date("d");

$username=$_GET['username'];
$voucherNo=$_GET['voucherNo'];
$orNo=$_GET['orNo'];
$checkedNo=$_GET['checkedNo'];
$paymentMode=$_GET['paymentMode'];
$description=$_GET['description'];
$bank=$_GET['bank'];
$payee=$_GET['payee'];
$damonth=$_GET['damonth'];
$daday=$_GET['daday'];
$dayear=$_GET['dayear'];
$accountTitle=$_GET['accountTitle'];
$supplier=$_GET['supplier'];
$ax=$_GET['ax'];

$dadate=$dayear."-".$damonth."-".$daday;

echo "
<br />
<div align='left'><span class='style3'>Saving...</span></div>
";

for($x=1;$x<=$ax;$x++){
$var1="invoiceNo".$x;
$var2="amount".$x;
$var3="vat".$x;
$var4="wtax".$x;

$invoiceNo=$_GET[$var1];
$amount=$_GET[$var2];
$vat=$_GET[$var3];
$wtax=$_GET[$var4];


//mysql_query("INSERT INTO `Coconut`.`vouchers` (`voucherNo`, `checkedNo`, `paymentMode`, `description`, `amount`, `payee`, `date`, `time`, `accountTitle`, `user`, `bank`, `invoiceNo`, `vat`, `wtax`, `orNo`) VALUES ('$voucherNo', '$checkedNo', '$paymentMode', '$description', '$amount', '$payee', '$dadate', '".date("H:i:s")."', '$accountTitle', '$username', '$bank', '$invoiceNo', '$vat', '$wtax', '$orNo')");


echo "invoice - ".$invoiceNo;
echo "amount - ".$amount;
echo "wtax - ".$wtax;
//$cuz->addToPurchaseJournal($invoiceNo,"xxACCOUNTS PAYABLE",round($amount,2),"",$cuz->selectNow("salesInvoice","siNo","invoiceNo",$invoiceNo),date("Ymd"));

//$cuz->addToPurchaseJournal($invoiceNo,"xxWITHHOLDING TAX - EXPANDED PAYABLE","",round($wtax,2),$cuz->selectNow("salesInvoice","siNo","invoiceNo",$invoiceNo),date("Ymd"));

}
//echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=ViewPOPayables.php?username=$username&supplier=$supplier'>";
?>
</body>
</html>
