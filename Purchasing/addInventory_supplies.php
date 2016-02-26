<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Add Supplies</title>
<style type="text/css">
<!--
.style1 {font-family: Arial;font-size: 14px;color: #FFFFFF;font-weight: bold;}
.style2 {font-family: Arial;font-size: 12px;color: #FFFFFF;font-weight: bold;}
.textfield1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px;width: 200px;}
.textfield2 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px;}
.button1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px;}
tr:hover { background-color:red;color:black;}
-->
</style>
<script type='text/javascript'>
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
include("../myDatabase.php");
$username=$_GET['username'];
$sino=$_GET['sino'];
$page=$_GET['page'];
$status=$_GET['status'];
$oldStockCardNo=$_GET['stockCardNo'];
$description=$_GET['description'];
$invoiceNo=$_GET['invoiceNo'];

$ro=new database();

mysql_connect($ro->myHost(),$ro->getUser(),$ro->getPass());
mysql_select_db($ro->getDB());

if( $status == "new" ) {
$stockCardNo = $ro->selectNow("trackingNo","value","name","stockCardNo");
/*
$ro->getInventoryStockCardNo();
$myFile = $ro->getReportInformation("homeRoot")."/COCONUT/trackingNo/stockCardNo.dat";
$fh = fopen($myFile, 'r');
$stockCardNo = fread($fh, 100);
fclose($fh);
*/
}else {
$stockCardNo=$oldStockCardNo;
}

$description1 = $_GET['description'];

$day=date("d");
$month=date("m");
$year=date("Y");

echo "
<div align='left'>
  <table width='400' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000' bgcolor='#000000'>
    <tr>
      <form method='post' action='addInventory_insert.php'>
      <td><table width='400' bgcolor='#0066FF' border='0' cellpadding='0' cellspacing='0' bgcolor='#FFFFFF'>
        <tr>
          <td colspan='3' height='30' class='style1'><div align='left'>&nbsp;Add Supplies</div></td>
        </tr>
        <tr>
          <td width='133' class='style2'><div align='left'>&nbsp;Description</div></td>
          <td width='15' class='style2'><div align='center'>:</div></td>
          <td width='252' class='style2'><div align='left'>
";

if( $status == "old" ) {
echo "
            <input type=text class='textfield1' name='description' value='$description' readonly autocomplete='off' />
";
}
else{
echo "
            <input type=text class='textfield1' name='description' value='$description' autocomplete='off'>
";
}


echo "
          </div></td>
        </tr>
        <tr>
          <td width='133' class='style2'><div align='left'>&nbsp;Unit</div></td>
          <td width='15' class='style2'><div align='center'>:</div></td>
          <td width='252' class='style2'><div align='left'>
            <input type=text class='textfield1' name='preparation' autocomplete='off' />
          </div></td>
        </tr>
        <tr>
          <td width='133' class='style2'><div align='left'>&nbsp;Unit Cost</div></td>
          <td width='15' class='style2'><div align='center'>:</div></td>
          <td width='252' class='style2'><div align='left'>
            <input type=text class='textfield1' name='unitcost' autocomplete='off' />
          </div></td>
        </tr>
        <tr>
          <td width='133' class='style2'><div align='left'>&nbsp;Selling Price</div></td>
          <td width='15' class='style2'><div align='center'>:</div></td>
          <td width='252' class='style2'><div align='left'>
            <input type=text class='textfield1' name='pricing' autocomplete='off' />
          </div></td>
        </tr>
        <tr>
          <td width='133' class='style2'><div align='left'>&nbsp;Quantity</div></td>
          <td width='15' class='style2'><div align='center'>:</div></td>
          <td width='252' class='style2'><div align='left'>
            <input type=text class='textfield1' name='quantity' autocomplete='off' />
          </div></td>
        </tr>
        <tr>
          <td width='133' class='style2'><div align='left'>&nbsp;FG Quantity</div></td>
          <td width='15' class='style2'><div align='center'>:</div></td>
          <td width='252' class='style2'><div align='left'>
            <input type=text class='textfield1' name='fgquantity' autocomplete='off' />
          </div></td>
        </tr>
";

if($month=='01'){$em01="selected='selected'"; $em02=""; $em03=""; $em04=""; $em05=""; $em06=""; $em07=""; $em08=""; $em09=""; $em10=""; $em11=""; $em12="";}
else if($month=='02'){$em01=""; $em02="selected='selected'"; $em03=""; $em04=""; $em05=""; $em06=""; $em07=""; $em08=""; $em09=""; $em10=""; $em11=""; $em12="";}
else if($month=='03'){$em01=""; $em02=""; $em03="selected='selected'"; $em04=""; $em05=""; $em06=""; $em07=""; $em08=""; $em09=""; $em10=""; $em11=""; $em12="";}
else if($month=='04'){$em01=""; $em02=""; $em03=""; $em04="selected='selected'"; $em05=""; $em06=""; $em07=""; $em08=""; $em09=""; $em10=""; $em11=""; $em12="";}
else if($month=='05'){$em01=""; $em02=""; $em03=""; $em04=""; $em05="selected='selected'"; $em06=""; $em07=""; $em08=""; $em09=""; $em10=""; $em11=""; $em12="";}
else if($month=='06'){$em01=""; $em02=""; $em03=""; $em04=""; $em05=""; $em06="selected='selected'"; $em07=""; $em08=""; $em09=""; $em10=""; $em11=""; $em12="";}
else if($month=='07'){$em01=""; $em02=""; $em03=""; $em04=""; $em05=""; $em06=""; $em07="selected='selected'"; $em08=""; $em09=""; $em10=""; $em11=""; $em12="";}
else if($month=='08'){$em01=""; $em02=""; $em03=""; $em04=""; $em05=""; $em06=""; $em07=""; $em08="selected='selected'"; $em09=""; $em10=""; $em11=""; $em12="";}
else if($month=='09'){$em01=""; $em02=""; $em03=""; $em04=""; $em05=""; $em06=""; $em07=""; $em08=""; $em09="selected='selected'"; $em10=""; $em11=""; $em12="";}
else if($month=='10'){$em01=""; $em02=""; $em03=""; $em04=""; $em05=""; $em06=""; $em07=""; $em08=""; $em09=""; $em10="selected='selected'"; $em11=""; $em12="";}
else if($month=='11'){$em01=""; $em02=""; $em03=""; $em04=""; $em05=""; $em06=""; $em07=""; $em08=""; $em09=""; $em10=""; $em11="selected='selected'"; $em12="";}
else if($month=='12'){$em01=""; $em02=""; $em03=""; $em04=""; $em05=""; $em06=""; $em07=""; $em08=""; $em09=""; $em10=""; $em11=""; $em12="selected='selected'";}

echo "
        <tr>
          <td width='133' class='style2'><div align='left'>&nbsp;Expiration</div></td>
          <td width='15' class='style2'><div align='center'>:</div></td>
          <td width='252' class='style2'><div align='left'>
            <select name='month' class='textfield2'>
              <option value='01' $em01>Jan</option>
              <option value='02' $em02>Feb</option>
              <option value='03' $em03>Mar</option>
              <option value='04' $em04>Apr</option>
              <option value='05' $em05>May</option>
              <option value='06' $em06>Jun</option>
              <option value='07' $em07>Jul</option>
              <option value='08' $em08>Aug</option>
              <option value='09' $em09>Sep</option>
              <option value='10' $em10>Oct</option>
              <option value='11' $em11>Nov</option>
              <option value='12' $em12>Dec</option>
            </select>
            <select name='day' class='textfield2'>
";

for($z=1;$z<=31;$z++){
if($z<10){$y="0".$z;}else{$y=$z;}

if($y==$day){$sde="selected='selected'";}else{$sde="";}
echo "
              <option $sde>$y</option>
";
}

echo "
            </select>
            <select name='year' class='textfield2'>
";

for($a=($year-5);$a<$year;$a++){
echo "
              <option>$a</option>
";
}

echo "
              <option selected='selected'>$year</option>
";

for($b=($year+1);$b<=($year+40);$b++){
echo "
              <option>$b</option>
";
}

echo "
            </select>
          </div></td>
        </tr>
";

if($month=='01'){$dm01="selected='selected'"; $dm02=""; $dm03=""; $dm04=""; $dm05=""; $dm06=""; $dm07=""; $dm08=""; $dm09=""; $dm10=""; $dm11=""; $dm12="";}
else if($month=='02'){$dm01=""; $dm02="selected='selected'"; $dm03=""; $dm04=""; $dm05=""; $dm06=""; $dm07=""; $dm08=""; $dm09=""; $dm10=""; $dm11=""; $dm12="";}
else if($month=='03'){$dm01=""; $dm02=""; $dm03="selected='selected'"; $dm04=""; $dm05=""; $dm06=""; $dm07=""; $dm08=""; $dm09=""; $dm10=""; $dm11=""; $dm12="";}
else if($month=='04'){$dm01=""; $dm02=""; $dm03=""; $dm04="selected='selected'"; $dm05=""; $dm06=""; $dm07=""; $dm08=""; $dm09=""; $dm10=""; $dm11=""; $dm12="";}
else if($month=='05'){$dm01=""; $dm02=""; $dm03=""; $dm04=""; $dm05="selected='selected'"; $dm06=""; $dm07=""; $dm08=""; $dm09=""; $dm10=""; $dm11=""; $dm12="";}
else if($month=='06'){$dm01=""; $dm02=""; $dm03=""; $dm04=""; $dm05=""; $dm06="selected='selected'"; $dm07=""; $dm08=""; $dm09=""; $dm10=""; $dm11=""; $dm12="";}
else if($month=='07'){$dm01=""; $dm02=""; $dm03=""; $dm04=""; $dm05=""; $dm06=""; $dm07="selected='selected'"; $dm08=""; $dm09=""; $dm10=""; $dm11=""; $dm12="";}
else if($month=='08'){$dm01=""; $dm02=""; $dm03=""; $dm04=""; $dm05=""; $dm06=""; $dm07=""; $dm08="selected='selected'"; $dm09=""; $dm10=""; $dm11=""; $dm12="";}
else if($month=='09'){$dm01=""; $dm02=""; $dm03=""; $dm04=""; $dm05=""; $dm06=""; $dm07=""; $dm08=""; $dm09="selected='selected'"; $dm10=""; $dm11=""; $dm12="";}
else if($month=='10'){$dm01=""; $dm02=""; $dm03=""; $dm04=""; $dm05=""; $dm06=""; $dm07=""; $dm08=""; $dm09=""; $dm10="selected='selected'"; $dm11=""; $dm12="";}
else if($month=='11'){$dm01=""; $dm02=""; $dm03=""; $dm04=""; $dm05=""; $dm06=""; $dm07=""; $dm08=""; $dm09=""; $dm10=""; $dm11="selected='selected'"; $dm12="";}
else if($month=='12'){$dm01=""; $dm02=""; $dm03=""; $dm04=""; $dm05=""; $dm06=""; $dm07=""; $dm08=""; $dm09=""; $dm10=""; $dm11=""; $dm12="selected='selected'";}

echo "
        <tr>
          <td width='133' class='style2'><div align='left'>&nbsp;Date Added</div></td>
          <td width='15' class='style2'><div align='center'>:</div></td>
          <td width='252' class='style2'><div align='left'>
            <select name='datem' class='textfield2'>
              <option value='01' $dm01>Jan</option>
              <option value='02' $dm02>Feb</option>
              <option value='03' $dm03>Mar</option>
              <option value='04' $dm04>Apr</option>
              <option value='05' $dm05>May</option>
              <option value='06' $dm06>Jun</option>
              <option value='07' $dm07>Jul</option>
              <option value='08' $dm08>Aug</option>
              <option value='09' $dm09>Sep</option>
              <option value='10' $dm10>Oct</option>
              <option value='11' $dm11>Nov</option>
              <option value='12' $dm12>Dec</option>
            </select>
            <select name='dated' class='textfield2'>
";

for($x=1;$x<=31;$x++){
if($x<10){$w="0".$x;}else{$w=$x;}

if($w==$day){$sdd="selected='selected'";}else{$sdd="";}
echo "
              <option $sdd>$w</option>
";
}

echo "
            </select>
            <select name='datey' class='textfield2'>
";

for($c=($year-20);$c<$year;$c++){
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
          <td width='133' class='style2'><div align='left'>&nbsp;Location</div></td>
          <td width='15' class='style2'><div align='center'>:</div></td>
          <td width='252' class='style2'><div align='left'>
            <select class='textfield1' name='inventoryLocation'>
";

$zsql=mysql_query("SELECT inventoryLocation FROM inventoryLocation ORDER BY inventoryLocation");
while($zfetch=mysql_fetch_array($zsql)){
$inventoryLocation=$zfetch['inventoryLocation'];
if($inventoryLocation=="PHARMACY"){$opsel="selected='selected'";}else{$opsel="";}
echo "
              <option $opsel>$inventoryLocation</option>
";
}

echo "
            </select>
          </div></td>
        </tr>
        <tr>
          <td width='133' class='style2'><div align='left'>&nbsp;PhilHealth</div></td>
          <td width='15' class='style2'><div align='center'>:</div></td>
          <td width='252' class='style2'><div align='left'>
            <select name='phic' class='textfield1'>
              <option value='no'>No</option>
              <option value='yes'>Yes</option>
            </select>
          </div></td>
        </tr>
        <tr>
          <td width='133' class='style2'><div align='left'>&nbsp;Critical Level</div></td>
          <td width='15' class='style2'><div align='center'>:</div></td>
          <td width='252' class='style2'><div align='left'>
            <input type=text name='criticalLevel' class='textfield1' />
          </div></td>
        </tr>
        <tr>
          <td width='133' class='style2'><div align='left'>&nbsp;Remarks</div></td>
          <td width='15' class='style2'><div align='center'>:</div></td>
          <td width='252' class='style2'><div align='left'>
            <input type=text name='remarks' class='textfield1' />
          </div></td>
        </tr>
        <tr>
          <td width='133' class='style2'><div align='left'>&nbsp;Supplier</div></td>
          <td width='15' class='style2'><div align='center'>:</div></td>
          <td width='252' class='style2'><div align='left'>
            <select name='supplier' class='textfield1'>
";

$supsql=mysql_query("SELECT supplierCode, supplierName FROM supplier ORDER BY supplierName");
while($supfetch=mysql_fetch_array($supsql)){
$supplierCode=$supfetch['supplierCode'];
$supplierName=$supfetch['supplierName'];

$asql=mysql_query("SELECT * FROM salesInvoice WHERE siNo='$sino' AND supplier='$supplierCode'");
$acount=mysql_num_rows($asql);

if($acount==0){$ss="";}else{$ss="selected='selected'";}

echo "
              <option $ss>$supplierName</option>
";
}


echo "
            </select>
          </div></td>
        </tr>
        <tr>
          <td width='133' class='style2'><div align='left'>&nbsp;Auto Dispense</div></td>
          <td width='15' class='style2'><div align='center'>:</div></td>
          <td width='252' class='style2'><div align='left'>
            <select name='autoDispense' class='textfield1'>
              <option value='no'>No</option>
              <option value='yes'>Yes</option>
            </select>
          </div></td>
        </tr>
        <tr>
          <td width='133' class='style2'><div align='left'>&nbsp;Classification</div></td>
          <td width='15' class='style2'><div align='center'>:</div></td>
          <td width='252' class='style2'><div align='left'>
            <select name='classification' class='textfield1'>
              <option value='inventory'>Invnetory</option>
              <option value='noInventory'>No Invnetory</option>
            </select>
          </div></td>
        </tr>
        <tr>
          <td colspan='3' height='30'><div align='right'>
            <input name='Submit' type='submit' class='button1' value='Proceed &gt;&gt;' />&nbsp;
          </div></td>
        </tr>
      </table></td>
      <input type='hidden' name='description1' value='$description1' />
      <input type='hidden' name='genericName1' value='' />
      <input type=hidden name='inventoryType' value='supplies'>
      <input type=hidden name='generic' value=''>
      <input type=hidden name='month' value=''>
      <input type=hidden name='day' value=''>
      <input type=hidden name='year' value=''>
      <input type=hidden name='additional' value=''>
      <input type=hidden name='year' value=''>
      <input type=hidden name='addedBy' value='$username'>
      <input type=hidden name='sino' value='$sino'>
      <input type=hidden name='page' value='$page'>
      <input type=hidden name='branch' value=''>
      <input type=hidden name='transition' value=''>
      <input type='hidden' name='phicPrice' value=''>
      <input type='hidden' name='companyPrice' value=''>
      <input type='hidden' name='ipdPrice' value='0'>
      <input type='hidden' name='opdPrice' value='0'>
      <input type='hidden' name='invoiceNo' value='$invoiceNo'>
";

$ro->coconutHidden("stockCardNo",$stockCardNo);
$ro->coconutHidden("status",$status);

echo "
      </form>
    </tr>
  </table>
</div>
";
?>
</body>
</html>
