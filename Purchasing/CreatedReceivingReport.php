<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Purchased Items</title>
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
.style2 {font-family: Arial;font-size: 12px;color: #000000;font-weight: bold;}
.style3 {font-family: Arial;font-size: 14px;color: #0066FF;font-weight: bold;}
.style4 {font-family: Arial;font-size: 12px;color: #FFFFFF;font-weight: bold;}
.style5 {font-family: Arial;font-size: 12px;color: #FF0000;font-weight: bold;}
.textfield1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;}
.button1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;}
.button2 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FFFFFF;background-color: #0066FF;border: 1px solid #000000;}
.button3 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FFFFFF;background-color: #FF9900;border: 1px solid #000000;}
.button4 {font-family: Arial;font-size: 12px;font-weight: bold;color: #999999;background-color: #FFFFFF;border: 1px solid #999999;}
.button5 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FF0000;background-color: #FFFFFF;border: 1px solid #FF0000;}
.button6 {font-family: Arial;font-size: 12px;font-weight: bold;color: #0066FF;background-color: #FFFFFF;border: 1px solid #0066FF;}
.button7 {font-family: Arial;font-size: 12px;font-weight: bold;color: #D3D3D3;background-color: #FFFFFF;border: 1px solid #D3D3D3;}
tr:hover { background-color:yellow;color:black;}
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
$sino=$_GET['sino'];
$page=$_GET['page'];

$asql=mysql_query("SELECT invoiceNo, supplier, terms, transactionDate, recievedDate FROM salesInvoice WHERE siNo='$sino'");
while($afetch=mysql_fetch_array($asql)){
$invoiceNo=$afetch['invoiceNo'];
$supplier=$afetch['supplier'];
$terms=$afetch['terms'];
$transactionDate=$afetch['transactionDate'];
$recievedDate=$afetch['recievedDate'];
}

$bsql=mysql_query("SELECT supplierName, contactNo, Address FROM supplier WHERE supplierCode='$supplier'");
while($bfetch=mysql_fetch_array($bsql)){$supplierName=$bfetch['supplierName']; $Address=$bfetch['Address'];}

$pagesql=mysql_query("SELECT refNo, description, unit, unitPrice, quantity FROM salesInvoiceItems WHERE siNo='$sino' ORDER BY refNo");
$pagecount=mysql_num_rows($pagesql);

echo "
<div align='left'>
<br />
<span class='style1'>Received Items</span>
<br />
  <table width='700' border='0' cellspacing='0' cellpadding='0'>
    <tr>
      <td><table width='700' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000'>
        <tr>
          <td width='444' valign='top'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
            <tr>
              <td height='40' valign='middle'><div align='left' class='style1'>&nbsp;$supplierName</div></td>
            </tr>
            <tr>
              <td height='40' valign='middle'><div align='left' class='style2'>&nbsp;$Address</div></td>
            </tr>
            <tr>
              <td height='20' valign='middle'><div align='left' class='style2'>
                <table border='0' cellspacing='0' cellpadding='0'>
                  <tr>
                    <td>&nbsp;</td>
                    <form id='View' name='view' method='get' action='EditReceivingReportTwo.php'>
                    <input type='hidden' name='username' value='$username' />
                    <input type='hidden' name='sino' value='$sino' />
                    <input type='hidden' name='invoiceNo' value='$invoiceNo' />
                    <input type='hidden' name='supplierName' value='$supplierName' />
                    <input type='hidden' name='page' value='0' />
                    <td><input type='submit' name='Edit' class='button6' value='   Edit   ' /></td>
                    </form>
";

if($pagecount==0){
echo "
                    <form id='View' name='view' method='get' action='DeleteReceivingReportTwo.php'>
                    <input type='hidden' name='username' value='$username' />
                    <input type='hidden' name='sino' value='$sino' />
                    <input type='hidden' name='invoiceNo' value='$invoiceNo' />
                    <input type='hidden' name='supplierName' value='$supplierName' />
                    <input type='hidden' name='page' value='0' />
                    <td><input type='submit' name='Edit' class='button5' value='Delete' /></td>
                    </form>
";
}
else{
echo "
                    <td><input type='submit' name='Edit' class='button7' value='Delete' /></td>
";
}

echo "
                  </tr>
                </table>
              </div></td>
            </tr>
          </table></td>
";

$zsql=mysql_query("SELECT SUM(quantity*unitPrice) AS total FROM salesInvoiceItems WHERE siNo='$sino' ORDER BY refNo");
while($zfetch=mysql_fetch_array($zsql)){$total=$zfetch['total'];}

$totalfmt=number_format($total,2,'.',',');

echo "
          <td width='250'><div align='center'>
            <table width='100%' border='0' cellspacing='0' cellpadding='0'>
              <tr>
                <td width='40%' height='20'><div align='left' class='style1'>&nbsp;Invoice No.</div></td>
                <td width='10' height='20'><div align='center' class='style1'>:</div></td>
                <td width='50%' height='20'><div align='right' class='style3'>$invoiceNo&nbsp;</div></td>
              </tr>
              <tr>
                <td width='40%' height='20'><div align='left' class='style1'>&nbsp;Terms</div></td>
                <td width='10' height='20'><div align='center' class='style1'>:</div></td>
                <td width='50%' height='20'><div align='right' class='style3'>$terms&nbsp;</div></td>
              </tr>
              <tr>
                <td width='40%' height='30'><div align='left' class='style1'>&nbsp;Total</div></td>
                <td width='10' height='30'><div align='center' class='style1'>:</div></td>
                <td width='50%' height='30'><div align='right' class='style3'>$totalfmt&nbsp;</div></td>
              </tr>
";

$msql=mysql_query("SELECT SUM(amount+vat+wtax) AS totamount FROM vouchers WHERE invoiceNo='$invoiceNo'");
while($mfetch=mysql_fetch_array($msql)){$amount=$mfetch['totamount'];}

$amountfmt=number_format($amount,2,'.',',');

echo "
              <tr>
                <td width='40%' height='30'><div align='left' class='style1'>&nbsp;Paid to Supplier</div></td>
                <td width='10' height='30'><div align='center' class='style1'>:</div></td>
                <td width='50%' height='30'><div align='right' class='style3'>$amountfmt&nbsp;</div></td>
              </tr>
            </table>
          </div></td>
";


echo "
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height='10'></td>
    </tr>
    <tr>
      <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
";



echo "
        <tr>
          <td align='left'><table border='0' cellspacing='0' cellpadding='0'>
            <tr>
	      <form id='AddItems' name='AddItems' method='get' action='searchStockCard.php'>
	      <input type='hidden' name='username' value='$username' />
	      <input type='hidden' name='sino' value='$sino' />
              <input type='hidden' name='invoiceNo' value='$invoiceNo' />
	      <input type='hidden' name='page' value='$page' />
	      <td width='50%'><div align='left'>
                <input name='AddItems' type='submit' class='button2' id='AddItems' value='Add Purchased Items' />
	      </div></td>
	      </form>
            </tr>
          </table></td>
          <td width='50%'><div align='right'>
            <input name='Submit' type='button' class='button3' onclick=MM_openBrWindow('PurchaseReport.php?sino=$sino','','toolbar=yes,location=yes,status=yes,scrollbars=yes,width=1000,height=700') value='View Purchased Report' />
          </div></td>
        </tr>
";


echo "
      </table></td>
    </tr>
";

$num=10;

if($pagecount<=$num){$pagenum=1;$totalpage=1;$prevpage=0;$nxtpage=0;}
else if($pagecount>$num){
$var1=$pagecount/$num;$var1fmt=number_format($var1,0,'.',',');
if($var1fmt>=$var1){$var2=$var1fmt-1;}
else{$var2=$var1fmt;}
if($var1==$var2){$totalpage=$var2;}
else{$totalpage=$var2+1;}
$pagenum=($page+$num)/$num;$pagelimit=$var2*$num;
if($page=='0'){$prevpage=0;$nxtpage=$page+$num;}
else if(($page!='0')&&($page!=$pagelimit)){$prevpage=$page-$num;$nxtpage=$page+$num;}
else if($page==$pagelimit){$prevpage=$page-$num;$nxtpage=$page;}
}

echo "
    <tr>
      <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
        <tr>
          <td width='50%'><div align='left' class='style2'>Page: $pagenum/$totalpage</div></td>
          <td width='50%'><div align='right'>
            <table border='0' cellspacing='0' cellpadding='0'>
";

if($pagecount<=$num){
echo "
              <tr>
		<td>
                  <input name='Prev' type='submit' class='button4' id='Prev' value='  &lt;  ' />
                </td>
                <td>
		  <input name='Nxt' type='submit' class='button4' id='Nxt' value='  &gt;  ' />
		</td>
              </tr>
";
}
else if($pagecount>$num){
if($page=='0'){
echo "
              <tr>
		<td>
                  <input name='Prev' type='submit' class='button4' id='Prev' value='  &lt;  ' />
                </td>
                <form id='Nxt' name='Nxt' method='get' action='AddPurchasedItems.php'>
                <input name='username' type='hidden' value='$username' />
                <input name='sino' type='hidden' value='$sino' />
                <input name='page' type='hidden' value='$nxtpage' />
                <td>
		  <input name='Nxt' type='submit' class='button1' id='Nxt' value='  &gt;  ' />
		</td>
		</form>
              </tr>
";
}
else if(($page!=0)&&($nxtpage!=$page)){
echo "
              <tr>
                <form id='Prev' name='Prev' method='get' action='AddPurchasedItems.php'>
                <input name='username' type='hidden' value='$username' />
                <input name='sino' type='hidden' value='$sino' />
                <input name='page' type='hidden' value='$prevpage' />
		<td>
                  <input name='Prev' type='submit' class='button1' id='Prev' value='  &lt;  ' />
                </td>
		</form>
                <form id='Nxt' name='Nxt' method='get' action='AddPurchasedItems.php'>
                <input name='username' type='hidden' value='$username' />
                <input name='sino' type='hidden' value='$sino' />
                <input name='page' type='hidden' value='$nxtpage' />
                <td>
		  <input name='Nxt' type='submit' class='button1' id='Nxt' value='  &gt;  ' />
		</td>
		</form>
              </tr>
";
}
else if($nxtpage==$page){
echo "
              <tr>
                <form id='Prev' name='Prev' method='get' action='AddPurchasedItems.php'>
                <input name='username' type='hidden' value='$username' />
                <input name='sino' type='hidden' value='$sino' />
                <input name='page' type='hidden' value='$prevpage' />
		<td>
                  <input name='Prev' type='submit' class='button1' id='Prev' value='  &lt;  ' />
                </td>
		</form>
                <td>
		  <input name='Nxt' type='submit' class='button4' id='Nxt' value='  &gt;  ' />
		</td>
              </tr>
";
}
}

echo "
            </table>
          </div></td>
        </tr>
        <tr>
          <td colspan='2' bgcolor='#000000'><table width='100%' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000'>
            <tr>
              <td width='8%' bgcolor='#0066FF' class='style4'><div align='center'>Qty.</div></td>
              <td width='8%' bgcolor='#0066FF' class='style4'><div align='center'>FG Qty.</div></td>
              <td width='12%' bgcolor='#0066FF' class='style4'><div align='center'>Unit</div></td>
              <td width='28%' bgcolor='#0066FF' class='style4'><div align='center'>Description</div></td>
              <td width='14%' bgcolor='#0066FF' class='style4'><div align='center'>Unit Price </div></td>
              <td width='14%' bgcolor='#0066FF' class='style4'><div align='center'>Amount</div></td>
              <td width='8%' bgcolor='#0066FF' class='style4'><div align='center'>Edit</div></td>
              <td width='8%' bgcolor='#0066FF' class='style5'><div align='center'>Del.</div></td>
            </tr>
";

$asql=mysql_query("SELECT inventoryCode,refNo, description, unit, unitPrice, quantity, fgquantity FROM salesInvoiceItems WHERE siNo='$sino' ORDER BY refNo LIMIT $page,$num");
while($afetch=mysql_fetch_array($asql)){
$refNo=$afetch['refNo'];
$description=$afetch['description'];
$unit=$afetch['unit'];
$unitPrice=$afetch['unitPrice'];
$quantity=$afetch['quantity'];
$fgquantity=$afetch['fgquantity'];
$inventoryCode=$afetch['inventoryCode'];

$unitPricefmt=number_format($unitPrice,2,'.',',');

$amount=$quantity*$unitPrice;
$amountfmt=number_format($amount,2,'.',',');

echo "
            <tr bgcolor='#FFFFFF'>
              <td class='style2'><div align='center'>$quantity</div></td>
              <td class='style2'><div align='center'>$fgquantity</div></td>
              <td class='style2'><div align='center'>$unit</div></td>
              <td class='style2'><div align='left'>&nbsp;$description</div></td>
              <td class='style2'><div align='right'>$unitPricefmt&nbsp;</div></td>
              <td class='style2'><div align='right'>$amountfmt&nbsp;</div></td>
              <form id='Edit' name='Edit' method='get' action='editPurchasing.php'>
              <input type='hidden' name='username' value='$username' />
              <input type='hidden' name='sino' value='$sino' />
              <input type='hidden' name='page' value='$page' />
              <input type='hidden' name='refNo' value='$refNo' />
              <input type='hidden' name='inventoryCode' value='$inventoryCode' />
              <td class='style2'><div align='center'>
                <input type='submit' name='Edit' class='button1' value='  E  ' />
              </div></td>
              </form>
              <form id='Delete' name='Delete' method='get' action='AddPurchasedItemsDIConf.php'>
              <input type='hidden' name='username' value='$username' />
              <input type='hidden' name='sino' value='$sino' />
              <input type='hidden' name='page' value='$page' />
              <input type='hidden' name='refNo' value='$refNo' />
              <td class='style2'><div align='center'>
                <input type='submit' name='Delete' class='button5' value='  X  ' />
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
              <td height='6' bgcolor='#0066FF'></td>
            </tr>
          </table></td>
          </tr>
      </table></td>
    </tr>
  </table>
</div>
";
?>
</body>
</html>
