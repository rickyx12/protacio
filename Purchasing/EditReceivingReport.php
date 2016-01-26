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
.style1 {font-family: Arial;font-size: 14px;color: #000000;font-weight: bold;}
.style2 {font-family: Arial;font-size: 12px;color: #FFFFFF;font-weight: bold;}
.style3 {font-family: Arial;font-size: 14px;color: #FFFFFF;font-weight: bold;}
.textfield1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px; width: 200px;}
.textfield2 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FF0000;background-color: #FFFFFF;border: 1px solid #FF0000;height: 25px;}
.textfield3 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px;}
.button1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px;}
-->
</style>
</head>

<body onload="placeFocus()">
<?php
include("../myDatabase.php");
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$year=date("Y");
$month=date("m");
$day=date("d");

$username=$_GET['username'];
$sino=$_GET['sino'];
$page=$_GET['page'];

$fmonth=$_GET['fmonth'];
$fday=$_GET['fday'];
$fyear=$_GET['fyear'];

$tmonth=$_GET['tmonth'];
$tday=$_GET['tday'];
$tyear=$_GET['tyear'];

$asql=mysql_query("SELECT * FROM salesInvoice WHERE siNo='$sino' AND status='Active'");
while($afetch=mysql_fetch_array($asql)){
$invoiceNo=$afetch['invoiceNo'];
$supplier=$afetch['supplier'];
$terms=$afetch['terms'];
$transactionDate=$afetch['transactionDate'];
$receivedDate=$afetch['recievedDate'];

$transactionDatestr=strtotime($transactionDate);
$tdmonth=date("m",$transactionDatestr);
$tdday=date("d",$transactionDatestr);
$tdyear=date("Y",$transactionDatestr);

$recieivedDatestr=strtotime($receivedDate);
$rdmonth=date("m",$recieivedDatestr);
$rdday=date("d",$recieivedDatestr);
$rdyear=date("Y",$recieivedDatestr);

$bsql=mysql_query("SELECT supplierName FROM supplier WHERE supplierCode='$supplier'");
while($bfetch=mysql_fetch_array($bsql)){$supplierName=$bfetch['supplierName'];}
}

echo "
<br />
<div align='left'><span class='style1'>Fill Up FIelds</span>
  <table width='400' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000' bgcolor='#0066FF'>
    <form id='Create' name='Create' method='get' action='EditReceivingReportSave.php'>
    <tr>
      <td><table width='400' border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td colspan='3' height='30' class='style3'><div align='left'>&nbsp;Edit Purchase Report</div></td>
        </tr>
        <tr>
          <td width='133' class='style2'><div align='left'>&nbsp;Invoice No . </div></td>
          <td width='15' class='style2'><div align='center'>:</div></td>
          <td width='252' class='style2'><div align='left'>
            <input name='invoiceNo' type='text' class='textfield1' placeholder='Invoice Number' value='$invoiceNo' />
          </div></td>
        </tr>
        <tr>
          <td class='style2'><div align='left'>&nbsp;Supplier</div></td>
          <td class='style2'><div align='center'>:</div></td>
          <td class='style2'><div align='left'>
            <select name='supplier' class='textfield1' id='supplier'>
";



$supsql=mysql_query("SELECT supplierCode, supplierName FROM supplier ORDER BY supplierName");
while($supfetch=mysql_fetch_array($supsql)){
$supplierCode=$supfetch['supplierCode'];
$supplierName=$supfetch['supplierName'];

if($supplier==$supplierCode){$supsel="selected='selected'";}else{$supsel="";}

echo "
	    	  <option value='$supplierCode' $supsel>$supplierName</option>
";
}

echo "
      		</select>
          </div></td>
        </tr>
";

if($terms=='30 Days'){$terms1="selected='selected'";$terms2="";$terms3="";$terms4="";$terms5="";$terms6="";$terms7="";}
else if($terms=='60 Days'){$terms1="";$terms2="selected='selected'";$terms3="";$terms4="";$terms5="";$terms6="";$terms7="";}
else if($terms=='90 Days'){$terms1="";$terms2="";$terms3="selected='selected'";$terms4="";$terms5="";$terms6="";$terms7="";}
else if($terms=='PDC 30 Days'){$terms1="";$terms2="";$terms3="";$terms4="selected='selected'";$terms5="";$terms6="";$terms7="";}
else if($terms=='PDC 60 Days'){$terms1="";$terms2="";$terms3="";$terms4="";$terms5="selected='selected'";$terms6="";$terms7="";}
else if($terms=='C.O.D.'){$terms1="";$terms2="";$terms3="";$terms4="";$terms5="";$terms6="selected='selected'";$terms7="";}
else if($terms=='Retail'){$terms1="";$terms2="";$terms3="";$terms4="";$terms5="";$terms6="";$terms7="selected='selected'";}

echo "
        <tr>
          <td class='style2'><div align='left'>&nbsp;Terms</div></td>
          <td class='style2'><div align='center'>:</div></td>
          <td class='style2'><div align='left'>
            <select name='terms' class='textfield1'>
              <option $terms1>30 Days</option>
              <option $terms2>60 Days</option>
              <option $terms3>90 Days</option>
              <option $terms4>PDC 30 Days</option>
              <option $terms5>PDC 60 Days</option>
              <option $terms6>C.O.D.</option>
              <option $terms7>Retail</option>
              <option value='CASH'>Cash</option>
            </select>
          </div></td>
        </tr>
        <tr>
          <td class='style2'><div align='left'>&nbsp;Recieved Date </div></td>
          <td class='style2'><div align='center'>:</div></td>
          <td class='style2'><div align='left'>
            <select name='rdmonth' class='textfield3' id='month'>
";

if($rdmonth=='01'){$rm01="selected='selected'"; $rm02=""; $rm03=""; $rm04=""; $rm05=""; $rm06=""; $rm07=""; $rm08=""; $rm09=""; $rm10=""; $rm11=""; $rm12="";}
else if($rdmonth=='02'){$rm01=""; $rm02="selected='selected'"; $rm03=""; $rm04=""; $rm05=""; $rm06=""; $rm07=""; $rm08=""; $rm09=""; $rm10=""; $rm11=""; $rm12="";}
else if($rdmonth=='03'){$rm01=""; $rm02=""; $rm03="selected='selected'"; $rm04=""; $rm05=""; $rm06=""; $rm07=""; $rm08=""; $rm09=""; $rm10=""; $rm11=""; $rm12="";}
else if($rdmonth=='04'){$rm01=""; $rm02=""; $rm03=""; $rm04="selected='selected'"; $rm05=""; $rm06=""; $rm07=""; $rm08=""; $rm09=""; $rm10=""; $rm11=""; $rm12="";}
else if($rdmonth=='05'){$rm01=""; $rm02=""; $rm03=""; $rm04=""; $rm05="selected='selected'"; $rm06=""; $rm07=""; $rm08=""; $rm09=""; $rm10=""; $rm11=""; $rm12="";}
else if($rdmonth=='06'){$rm01=""; $rm02=""; $rm03=""; $rm04=""; $rm05=""; $rm06="selected='selected'"; $rm07=""; $rm08=""; $rm09=""; $rm10=""; $rm11=""; $rm12="";}
else if($rdmonth=='07'){$rm01=""; $rm02=""; $rm03=""; $rm04=""; $rm05=""; $rm06=""; $rm07="selected='selected'"; $rm08=""; $rm09=""; $rm10=""; $rm11=""; $rm12="";}
else if($rdmonth=='08'){$rm01=""; $rm02=""; $rm03=""; $rm04=""; $rm05=""; $rm06=""; $rm07=""; $rm08="selected='selected'"; $rm09=""; $rm10=""; $rm11=""; $rm12="";}
else if($rdmonth=='09'){$rm01=""; $rm02=""; $rm03=""; $rm04=""; $rm05=""; $rm06=""; $rm07=""; $rm08=""; $rm09="selected='selected'"; $rm10=""; $rm11=""; $rm12="";}
else if($rdmonth=='10'){$rm01=""; $rm02=""; $rm03=""; $rm04=""; $rm05=""; $rm06=""; $rm07=""; $rm08=""; $rm09=""; $rm10="selected='selected'"; $rm11=""; $rm12="";}
else if($rdmonth=='11'){$rm01=""; $rm02=""; $rm03=""; $rm04=""; $rm05=""; $rm06=""; $rm07=""; $rm08=""; $rm09=""; $rm10=""; $rm11="selected='selected'"; $rm12="";}
else if($rdmonth=='12'){$rm01=""; $rm02=""; $rm03=""; $rm04=""; $rm05=""; $rm06=""; $rm07=""; $rm08=""; $rm09=""; $rm10=""; $rm11=""; $rm12="selected='selected'";}

echo "
	    	  <option value='01' $rm01>Jan</option>
	    	  <option value='02' $rm02>Feb</option>
	    	  <option value='03' $rm03>Mar</option>
	    	  <option value='04' $rm04>Apr</option>
	    	  <option value='05' $rm05>May</option>
	    	  <option value='06' $rm06>Jun</option>
	    	  <option value='07' $rm07>Jul</option>
	    	  <option value='08' $rm08>Aug</option>
	    	  <option value='09' $rm09>Sep</option>
	    	  <option value='10' $rm10>Oct</option>
	    	  <option value='11' $rm11>Nov</option>
	    	  <option value='12' $rm12>Dec</option>
";


echo "
      		</select>
      		<select name='rdday' class='textfield3' id='day'>
";

for($x=1;$x<=31;$x++){
if($x<10){$w="0".$x;}else{$w=$x;}

if($rdday==$w){$rsd="selected='selected'";}else{$rsd="";}

echo "
        	  <option $rsd>$w</option>
";
}

echo "
      		</select>
      		<select name='rdyear' class='textfield3' id='year'>
";

for($c=1930;$c<$rdyear;$c++){
echo "
        	  <option>$c</option>
";
}

echo "
        	  <option selected='selected'>$rdyear</option>
";

for($d=($rdyear+1);$d<=($rdyear+10);$d++){
echo "
        	  <option>$d</option>
";
}

echo "
      		</select>
          </div></td>
        </tr>
        <tr>
          <td colspan='3' height='30'><div align='right'>
            <input name='Submit' type='submit' class='button1' value='Continue &gt;&gt;' />&nbsp;
          </div></td>
        </tr>
      </table></td>
    </tr>
    <input type='hidden' name='username' value='$username' />
    <input type='hidden' name='sino' value='$sino' />
    <input type='hidden' name='fyear' value='$fyear' />
    <input type='hidden' name='fmonth' value='$fmonth' />
    <input type='hidden' name='fday' value='$fday' />
    <input type='hidden' name='tyear' value='$tyear' />
    <input type='hidden' name='tmonth' value='$tmonth' />
    <input type='hidden' name='tday' value='$tday' />
    <input type='hidden' name='page' value='$page' />
  </form>
  </table>
</div>
";
?>
</body>
</html>
