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
.style2 {font-family: Arial;font-size: 12px;color: #FFFFFF;font-weight: bold;}
.style3 {font-family: Arial;font-size: 14px;color: #0066FF;font-weight: bold;}
.style4 {font-family: Arial;font-size: 14px;color: #FFFFFF;font-weight: bold;}
.style5 {font-family: Arial;font-size: 12px;color: #FF0000;font-weight: bold;}
.style6 {font-family: Arial;font-size: 10px;color: #FFFFFF;font-weight: bold;}
.textfield1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;}
.textfield2 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px;}
.button1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px;}
.button2 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FFFFFF;background-color: #0066FF;border: 1px solid #000000;}
.button3 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FFFFFF;background-color: #FF9900;border: 1px solid #000000;}
.button4 {font-family: Arial;font-size: 12px;font-weight: bold;color: #999999;background-color: #FFFFFF;border: 1px solid #999999;}
.button5 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FF0000;background-color: #FFFFFF;border: 1px solid #FF0000;}
tr:hover { background-color:red;color:black;}
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
$ax=$_GET['ax'];

$year=date("Y");
$month=date("m");
$day=date("d");

echo "
<div align='left'>
<table width='600' border='1' cellpadding='0' cellspacing='0'>
  <form name='SelectSupplier' method='get' action='CreatePurchaseOrderSave.php'>
  <tr>
    <td bgcolor='#0066FF'><table width='600' border='0' cellpadiing='0' cellspacing'0'>
      <tr>
        <td height='25' colspan='3'><div class='style4' align='left'>&nbsp;Create Purchase Order</div></td>
      </tr>
      <tr>
        <td width='100'><div class='style2' align='left'>&nbsp;Supplier</div></td>
        <td width='15'><div class='style2' align='center'>:</div></td>
        <td width='485'><div class='style2' align='left'>
          <select name='supplier' class='textfield2'>
            <option selected='selected'>-Select Supplier-</optino>
";

$asql=mysql_query("SELECT supplierCode, supplierName FROM supplier WHERE status='Active' ORDER BY supplierName");
while($afetch=mysql_fetch_array($asql)){
echo "
            <option value='".$afetch['supplierCode']."-".$afetch['supplierName']."'>".$afetch['supplierName']."</optino>
";
}

echo "
          </select>
        </div></td>
      </tr>
      <tr>
        <td><div class='style2' align='left'>&nbsp;Term</div></td>
        <td><div class='style2' align='center'>:</div></td>
        <td><div class='style2' align='left'>
          <select name='terms' class='textfield2'>
            <option selected='selected'>-Select Terms-</option>
            <option>30 Days</option>
            <option>60 Days</option>
            <option>90 Days</option>
            <option>PDC 30 Days</option>
            <option>PDC 60 Days</option>
            <option>C.O.D.</option>
          </select>
        </div></td>
      </tr>
      <tr>
        <td><div class='style2' align='left'>&nbsp;Selected Items</div></td>
        <td><div class='style2' align='center'>:</div></td>
        <td><div class='style2' align='left'>
          <table width='485' border='0' cellpading='0' cellspacing='0'>
";

$bx=0;
for($x=1;$x<=$ax;$x++){
$var="stockCardNo".$x;
$stockCardNo=$_GET[$var];


if($stockCardNo==''){
}
else{
$bx++;
$bsql=mysql_query("SELECT description FROM inventoryStockCard WHERE stockCardNo='$stockCardNo'");
while($bfetch=mysql_fetch_array($bsql)){$description=$bfetch['description'];}
echo "
            <tr>
              <td width='200'><div align='left' class='style6'><input type='hidden' name='stockCardNo$bx' value='' /><input type='checkbox' name='stockCardNo$bx' class='textfield1' value='$stockCardNo' checked />$description</div></td>
              <td width='100'><div align='center' class='style6'><input type='text' name='unit$bx' size='10' class='textfield1' placeholder='Unit: Ex. Pcs.' value='' /></div></td>
              <td width='100'><div align='center' class='style6'><input type='text' name='unitPrice$bx' size='10' class='textfield1' placeholder='Unit Price' value='' /></div></td>
              <td width='85'><div align='center' class='style6'>Qty.<input type='text' name='quantity$bx' size='4' class='textfield1' value='0' /></div></td>
            </tr>
";
}
}

echo "
          </table>
        </div></td>
      </tr>
";

if($month=='01'){$tds01="selected='selected'";$tds02="";$tds03="";$tds04="";$tds05="";$tds06="";$tds07="";$tds08="";$tds09="";$tds10="";$tds11="";$tds12="";}
else if($month=='02'){$tds01="";$tds02="selected='selected'";$tds03="";$tds04="";$tds05="";$tds06="";$tds07="";$tds08="";$tds09="";$tds10="";$tds11="";$tds12="";}
else if($month=='03'){$tds01="";$tds02="";$tds03="selected='selected'";$tds04="";$tds05="";$tds06="";$tds07="";$tds08="";$tds09="";$tds10="";$tds11="";$tds12="";}
else if($month=='04'){$tds01="";$tds02="";$tds03="";$tds04="selected='selected'";$tds05="";$tds06="";$tds07="";$tds08="";$tds09="";$tds10="";$tds11="";$tds12="";}
else if($month=='05'){$tds01="";$tds02="";$tds03="";$tds04="";$tds05="selected='selected'";$tds06="";$tds07="";$tds08="";$tds09="";$tds10="";$tds11="";$tds12="";}
else if($month=='06'){$tds01="";$tds02="";$tds03="";$tds04="";$tds05="";$tds06="selected='selected'";$tds07="";$tds08="";$tds09="";$tds10="";$tds11="";$tds12="";}
else if($month=='07'){$tds01="";$tds02="";$tds03="";$tds04="";$tds05="";$tds06="";$tds07="selected='selected'";$tds08="";$tds09="";$tds10="";$tds11="";$tds12="";}
else if($month=='08'){$tds01="";$tds02="";$tds03="";$tds04="";$tds05="";$tds06="";$tds07="";$tds08="selected='selected'";$tds09="";$tds10="";$tds11="";$tds12="";}
else if($month=='09'){$tds01="";$tds02="";$tds03="";$tds04="";$tds05="";$tds06="";$tds07="";$tds08="";$tds09="selected='selected'";$tds10="";$tds11="";$tds12="";}
else if($month=='10'){$tds01="";$tds02="";$tds03="";$tds04="";$tds05="";$tds06="";$tds07="";$tds08="";$tds09="";$tds10="selected='selected'";$tds11="";$tds12="";}
else if($month=='11'){$tds01="";$tds02="";$tds03="";$tds04="";$tds05="";$tds06="";$tds07="";$tds08="";$tds09="";$tds10="";$tds11="selected='selected'";$tds12="";}
else if($month=='12'){$tds01="";$tds02="";$tds03="";$tds04="";$tds05="";$tds06="";$tds07="";$tds08="";$tds09="";$tds10="";$tds11="";$tds12="selected='selected'";}

echo "
      <tr>
        <td><div class='style2' align='left'>&nbsp;Trans. Date</div></td>
        <td><div class='style2' align='center'>:</div></td>
        <td><div class='style2' align='left'>
          <select name='transM' class='textfield2'>
            <option value='01' $tds01>Jan</option>
            <option value='02' $tds02>Feb</option>
            <option value='03' $tds03>Mar</option>
            <option value='04' $tds04>Apr</option>
            <option value='05' $tds05>May</option>
            <option value='06' $tds06>Jun</option>
            <option value='07' $tds07>Jul</option>
            <option value='08' $tds08>Aug</option>
            <option value='09' $tds09>Sep</option>
            <option value='10' $tds10>Oct</option>
            <option value='11' $tds11>Nov</option>
            <option value='12' $tds12>Dec</option>
          </select>
          <select name='transD' class='textfield2'>
";

for($a=1;$a<=31;$a++){
if($a<10){$b="0".$a;}else{$b=$a;}
if($day==$b){$tranDs="selected='selected'";}else{$tranDs="";}

echo "
            <option $tranDs>$b</option>
";
}

echo "
          </select>
          <select name='transY' class='textfield2'>
";

for($c=2000;$c<$year;$c++){
echo "
            <option>$c</option>
";
}

echo "
            <option selected='selected'>$year</option>
";

for($d=($year+1);$d<=($year+10);$d++){
echo "
            <option>$d</option>
";
}

echo "
          </select>
        </div></td>
      </tr>
      <tr>
        <td height='25' colspan='3'><div class='style4' align='right'><input type='submit' name='Submit' class='button1' value='Save &gt;&gt;' />&nbsp;</div></td>
      </tr>
    </table></td>
  </tr>
  <input type='hidden' name='username' value='$username' />
  <input type='hidden' name='bx' value='$bx' />
  </form>
</table>
</div>
";
?>
</body>
</html>
