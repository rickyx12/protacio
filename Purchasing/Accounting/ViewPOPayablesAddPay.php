<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Create Purchase Report</title>
<style type="text/css">
<!--
.style1 {font-family: Arial; font-size: 14px; color: #FFFFFF; font-weight: bold; }
.style2 {font-family: Arial; font-size: 12px; color: #FFFFFF; font-weight: bold; }
.style3 {font-family: Arial; font-size: 11px; color: #FF0000; font-weight: bold; }
.style4 {font-family: Arial; font-size: 14px; color: #FF0000; font-weight: bold; }
.textfield1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px;width: 200px;}
.textfield2 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 30px;}
.button1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px;}
-->
</style>
<script type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_changeProp(objName,x,theProp,theValue) { //v6.0
  var obj = MM_findObj(objName);
  if (obj && (theProp.indexOf("style.")==-1 || obj.style)){
    if (theValue == true || theValue == false)
      eval("obj."+theProp+"="+theValue);
    else eval("obj."+theProp+"='"+theValue+"'");
  }
}

function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}

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

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$username=$_GET['username'];
$supplier=$_GET['supplier'];
$ax=$_GET['x'];

$day=date("d");
$month=date("m");
$year=date("Y");

echo "
<br />
<div align='left'>
  <table width='300' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000' bgcolor='#0066FF'>
    <form id='View' name='Create' method='get' action='ViewPOPayablesAddPaySave.php'>
    <tr>
      <td><table width='450' border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td colspan='3' height='30'><div class='style1' align='left'>&nbsp;Add PO Payment</div></td>
        </tr>
        <tr>
          <td width='150'><div class='style2' align='left'>&nbsp;Voucher No.</div></td>
          <td width='15'><div class='style2' align='center'>:</div></td>
          <td width='285'><div class='style2' align='left'>
            <input type='text' name='voucherNo' class='textfield1' value='' />
          </div></td>
        </tr>
        <tr>
          <td><div class='style2' align='left'>&nbsp;OR No.</div></td>
          <td><div class='style2' align='center'>:</div></td>
          <td><div class='style2' align='left'>
            <input type='text' name='orNo' class='textfield1' value='' />
          </div></td>
        </tr>
        <input type='hidden' name='username' value='$username' />
";

$totalvat=0;
$totalwtax=0;
$amount=0;
$bx=0;
for($x=1;$x<=$ax;$x++){
$var="siNo".$x;
$siNo=$_GET[$var];

$xsql=mysql_query("SELECT supplierName, vatable FROM supplier WHERE supplierCode='$supplier'");
while($xfetch=mysql_fetch_array($xsql)){$supplierName=$xfetch['supplierName'];$vatable=$xfetch['vatable'];}

if($siNo!=''){
$bx++;
$asql=mysql_query("SELECT invoiceNo FROM salesInvoice WHERE siNo='$siNo'");
while($afetch=mysql_fetch_array($asql)){$invoiceNo=$afetch['invoiceNo'];}
echo "
    <input type='hidden' name='invoiceNo$bx' value='$invoiceNo' />
";

$bsql=mysql_query("SELECT SUM(unitPrice*(quantity)) AS totalAmount FROM salesInvoiceItems WHERE siNo='$siNo' AND status='Active'");
while($bfetch=mysql_fetch_array($bsql)){$totalAmount=$bfetch['totalAmount'];}

$lessvat=($totalAmount/1.12);
$vat=$totalAmount-$lessvat;
$wtax=$lessvat*0.01;
$finalamount=$lessvat-$wtax;

echo "
    <input type='hidden' name='vat$bx' value='$vat' />
    <input type='hidden' name='wtax$bx' value='$wtax' />
    <input type='hidden' name='amount$bx' value='$finalamount' />
";

$totalvat+=$vat;
$totalwtax+=$wtax;
$amount+=$finalamount;

}
}


echo "
    <input type='hidden' name='ax' value='$bx' />
    <input type='hidden' name='supplier' value='$supplier' />
";

$truevat=$totalvat-$totalwtax;

echo "
        <tr>
          <td width='100'><div class='style2' align='left'>&nbsp;Check No.</div></td>
          <td width='15'><div class='style2' align='center'>:</div></td>
          <td width='185'><div class='style2' align='left'>
            <input type='text' name='checkedNo' class='textfield1' value='' />
          </div></td>
        </tr>
        <tr>
          <td width='100'><div class='style2' align='left'>&nbsp;Payment Mode</div></td>
          <td width='15'><div class='style2' align='center'>:</div></td>
          <td width='185'><div class='style2' align='left'>
            <select name='paymentMode' class='textfield1'>
              <option>-Select Payment Mode-</option>
              <option>Cash</option>
              <option>Check</option>
            </select>
          </div></td>
        </tr>
        <tr>
          <td width='100'><div class='style2' align='left'>&nbsp;Description</div></td>
          <td width='15'><div class='style2' align='center'>:</div></td>
          <td width='185'><div class='style2' align='left'>
            <input type='text' name='description' class='textfield1' value='' />
          </div></td>
        </tr>
        <tr>
          <td width='100'><div class='style2' align='left'>&nbsp;Bank</div></td>
          <td width='15'><div class='style2' align='center'>:</div></td>
          <td width='185'><div class='style2' align='left'>
            <input type='text' name='bank' class='textfield1' value='' />
          </div></td>
        </tr>
";

if($vatable=='yes'){
$amountlesswtax=$amount+$totalvat;
$trueamount=$amount;
$truetotalwtax=$totalwtax;
}
else if($vatable=='no'){
$amountlesswtax=$amount+$totalvat+$totalwtax;
$trueamount=$amount+$totalwtax;
$truetotalwtax=0;
}

echo "
        <tr>
          <td width='100'><div class='style2' align='left'>&nbsp;Amount</div></td>
          <td width='15'><div class='style2' align='center'>:</div></td>
          <td width='185'><div class='style2' align='left'>
            <input type='text' name='amountplusvat' class='textfield1' value='".number_format(round($amountlesswtax,2),2)."' />
            <input type='hidden' name='vat' value='$totalvat' />
            <input type='hidden' name='amount' value='$trueamount' />
          </div></td>
        </tr>
        <tr>
          <td width='100'><div class='style2' align='left'>&nbsp;W/ Tax</div></td>
          <td width='15'><div class='style2' align='center'>:</div></td>
          <td width='185'><div class='style2' align='left'>
            <input type='text' name='wtax' class='textfield1' value='".number_format(round($truetotalwtax,2),2)."' />
          </div></td>
        </tr>
        <tr>
          <td width='100'><div class='style2' align='left'>&nbsp;Payee</div></td>
          <td width='15'><div class='style2' align='center'>:</div></td>
          <td width='185'><div class='style2' align='left'>
            <input type='text' name='payee' class='textfield1' value='$supplierName' />
          </div></td>
        </tr>
        <tr>
          <td><div class='style2' align='left'>&nbsp;Date Added</div></td>
          <td><div class='style2' align='center'>:</div></td>
          <td><div class='style2' align='left'>
";

if($month=='01'){$fm01="selected='selected'"; $fm02=""; $fm03=""; $fm04=""; $fm05=""; $fm06=""; $fm07=""; $fm08=""; $fm09=""; $fm10=""; $fm11=""; $fm12="";}
else if($month=='02'){$fm01=""; $fm02="selected='selected'"; $fm03=""; $fm04=""; $fm05=""; $fm06=""; $fm07=""; $fm08=""; $fm09=""; $fm10=""; $fm11=""; $fm12="";}
else if($month=='03'){$fm01=""; $fm02=""; $fm03="selected='selected'"; $fm04=""; $fm05=""; $fm06=""; $fm07=""; $fm08=""; $fm09=""; $fm10=""; $fm11=""; $fm12="";}
else if($month=='04'){$fm01=""; $fm02=""; $fm03=""; $fm04="selected='selected'"; $fm05=""; $fm06=""; $fm07=""; $fm08=""; $fm09=""; $fm10=""; $fm11=""; $fm12="";}
else if($month=='05'){$fm01=""; $fm02=""; $fm03=""; $fm04=""; $fm05="selected='selected'"; $fm06=""; $fm07=""; $fm08=""; $fm09=""; $fm10=""; $fm11=""; $fm12="";}
else if($month=='06'){$fm01=""; $fm02=""; $fm03=""; $fm04=""; $fm05=""; $fm06="selected='selected'"; $fm07=""; $fm08=""; $fm09=""; $fm10=""; $fm11=""; $fm12="";}
else if($month=='07'){$fm01=""; $fm02=""; $fm03=""; $fm04=""; $fm05=""; $fm06=""; $fm07="selected='selected'"; $fm08=""; $fm09=""; $fm10=""; $fm11=""; $fm12="";}
else if($month=='08'){$fm01=""; $fm02=""; $fm03=""; $fm04=""; $fm05=""; $fm06=""; $fm07=""; $fm08="selected='selected'"; $fm09=""; $fm10=""; $fm11=""; $fm12="";}
else if($month=='09'){$fm01=""; $fm02=""; $fm03=""; $fm04=""; $fm05=""; $fm06=""; $fm07=""; $fm08=""; $fm09="selected='selected'"; $fm10=""; $fm11=""; $fm12="";}
else if($month=='10'){$fm01=""; $fm02=""; $fm03=""; $fm04=""; $fm05=""; $fm06=""; $fm07=""; $fm08=""; $fm09=""; $fm10="selected='selected'"; $fm11=""; $fm12="";}
else if($month=='11'){$fm01=""; $fm02=""; $fm03=""; $fm04=""; $fm05=""; $fm06=""; $fm07=""; $fm08=""; $fm09=""; $fm10=""; $fm11="selected='selected'"; $fm12="";}
else if($month=='12'){$fm01=""; $fm02=""; $fm03=""; $fm04=""; $fm05=""; $fm06=""; $fm07=""; $fm08=""; $fm09=""; $fm10=""; $fm11=""; $fm12="selected='selected'";}

echo "
            <select name='damonth' class='textfield2'>
              <option value='01' $fm01>Jan</option>
              <option value='02' $fm02>Feb</option>
              <option value='03' $fm03>Mar</option>
              <option value='04' $fm04>Apr</option>
              <option value='05' $fm05>May</option>
              <option value='06' $fm06>Jun</option>
              <option value='07' $fm07>Jul</option>
              <option value='08' $fm08>Aug</option>
              <option value='09' $fm09>Sep</option>
              <option value='10' $fm10>Oct</option>
              <option value='11' $fm11>Nov</option>
              <option value='12' $fm12>Dec</option>
            </select>
            <select name='daday' class='textfield2'>
";

for($z=1;$z<=31;$z++){
if($z<10){$y="0".$z;}else{$y=$z;}

if($y==$day){$sfd="selected='selected'";}else{$sfd="";}

echo "
              <option $sfd>$y</option>
";
}

echo "
            </select>
            <select name='dayear' class='textfield2'>
";

for($a=1930;$a<$year;$a++){
echo"
              <option>$a</option>
";
}

echo"
              <option selected='selected'>$year</option>
";

for($b=($year+1);$b<=($year+5);$b++){
echo"
              <option>$b</option>
";
}

echo "
            </select>
          </div></td>
        </tr>
        <tr>
          <td width='100'><div class='style2' align='left'>&nbsp;Account Title</div></td>
          <td width='15'><div class='style2' align='center'>:</div></td>
          <td width='185'><div class='style2' align='left'>
            <input type='text' name='accountTitle' class='textfield1' value='' />
          </div></td>
        </tr>
";



echo "
        <tr>
          <td colspan='3' height='30'><div class='style1' align='right'>
            <input type='submit' name='Proceed' class='button1' Value='Proceed &gt;&gt;' />&nbsp;
          </div></td>
        </tr>
      </table></td>      
    </tr>
    </form>
  </table>
</div>
";
if($amount==0){
echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=ViewPOPayables.php?username=$username&supplier=$supplier'>";
}

?>
</body>
</html>
