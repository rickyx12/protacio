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
.style1 {font-family: Arial;font-size: 12px;color: #FFFFFF;font-weight: bold;}
.style2 {font-family: Arial;font-size: 12px;color: #000000;font-weight: bold;}
.style3 {font-family: Arial;font-size: 12px;color: #0066FF;font-weight: bold;}
.style4 {font-family: Arial;font-size: 12px;color: #FFFFFF;font-weight: bold;}
.style5 {font-family: Arial;font-size: 14px;color: #FF0000;font-weight: bold;}
.style6 {font-family: Arial;font-size: 14px;color: #FFFFFF;font-weight: bold;}
.textfield1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;}
.button1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px;}
.button2 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FFFFFF;background-color: #0066FF;border: 1px solid #000000;height: 25px;}
.button3 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FFFFFF;background-color: #FF9900;border: 1px solid #000000;}
.button4 {font-family: Arial;font-size: 12px;font-weight: bold;color: #999999;background-color: #FFFFFF;border: 1px solid #999999;}
.button5 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FF0000;background-color: #FFFFFF;border: 1px solid #FF0000;height: 25px;}
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
$poNo=$_GET['poNo'];
$show=$_GET['show'];
$sort=$_GET['sort'];

if($show=='Medicine'){$buttonmed='button2';$buttonsup='button1';$amed='style3';$asup='style4';}else if($show=='Supplies'){$buttonmed='button1';$buttonsup='button2';$amed='style4';$asup='style3';}
if($sort=='1'){$sortme='description';}else if($sort=='2'){$sortme='quantity,description';}

//Count Medicine
$zsql=mysql_query("SELECT stockCardNo, SUM(quantity) AS totalqty FROM inventory WHERE quantity<='50' AND inventoryType='medicine' AND status NOT LIKE 'DELETED_%%%%' GROUP BY stockcardNo ORDER BY $sortme,description");
$zx=0;
while($zfetch=mysql_fetch_array($zsql)){
$zstockCardNo=$zfetch['stockCardNo'];
$ztotalqty=$zfetch['totalqty'];
$ysql=mysql_query("SELECT * FROM inventory WHERE stockCardNo='$zstockCardNo' AND inventoryType='medicine' AND status NOT LIKE 'DELETED_%%%%' ORDER BY criticalLevel");
while($yfetch=mysql_fetch_array($ysql)){$ycriticalLevel=$yfetch['criticalLevel'];}
if($ycriticalLevel==''){$trueycriticalLevel='0';}else{$trueycriticalLevel=$ycriticalLevel;}
if($ztotalqty<=$trueycriticalLevel){
$zx++;
}
else{
}
}
//End Count Medicine

//Count Supplies
$xsql=mysql_query("SELECT stockCardNo, SUM(quantity) AS totalqty FROM inventory WHERE quantity<='50' AND inventoryType='supplies' AND status NOT LIKE 'DELETED_%%%%' GROUP BY stockcardNo ORDER BY $sortme,description");
$xx=0;
while($xfetch=mysql_fetch_array($xsql)){
$xstockCardNo=$xfetch['stockCardNo'];
$xtotalqty=$xfetch['totalqty'];
$wsql=mysql_query("SELECT * FROM inventory WHERE stockCardNo='$xstockCardNo' AND inventoryType='supplies' AND status NOT LIKE 'DELETED_%%%%' ORDER BY criticalLevel");
while($wfetch=mysql_fetch_array($wsql)){$wcriticalLevel=$wfetch['criticalLevel'];}
if($wcriticalLevel==''){$truewcriticalLevel='0';}else{$truewcriticalLevel=$wcriticalLevel;}
if($xtotalqty<=$truewcriticalLevel){
$xx++;
}
else{
}
}
//End Count Supplies

echo "
<br />
<div align='lef'>
<table width='700' border='0' cellspacing='0' cellpadding='0'>
<form name='Submit' method='get' action='AddPurchaseItemQty.php'>
  <tr>
    <td width='60%' bgcolor='#FFFFFF'><div align='left'>
      <table border='0' cellspacing='0' cellpadding='0'>
        <tr>
          <td><a href='AddPurchaseItem.php?username=$username&poNo=$poNo&show=Medicine&sort=$sort' class='$amed'><input type='button' name='Me' class='$buttonmed' value='     Medicine  ($zx)    ' /></a></td>
          <td><a href='AddPurchaseItem.php?username=$username&poNo=$poNo&show=Supplies&sort=$sort' class='$asup'><input type='button' name='Me' class='$buttonsup' value='     Supplies ($xx)     ' /></a></td>
        </tr>
      </table>
    </div></td>
    <td width='40%' bgcolor='#FFFFFF'><div align='right'>
      <input type='submit' name='ReOrder' class='button1' value='Add Selected Items To Re-Oredr List &gt;&gt;' />
    </div></td>
  </tr>
";

if($show=='Medicine'){
echo "
  <tr>
    <td bgcolor='#FFFFFF' colspan='2'><table width='700' border='1' bordercolor='#000000' cellspacing='0' cellpadding='0'>
      <tr>
        <td bgcolor='#0066FF' width='225' height='20'><div align='center' class='style1'>Brand Name</div></td>
        <td bgcolor='#0066FF' width='225'><div align='center' class='style1'>Generic Name</div></td>
        <td bgcolor='#0066FF' width='70'><div align='center' class='style1'>Qty. Left</div></td>
        <td bgcolor='#0066FF' width='130'><div align='center' class='style1'>Set Critical Level</div></td>
        <td bgcolor='#0066FF' width='50'><div align='center' class='style1'>Select</div></td>
      </tr>
";

$asql=mysql_query("SELECT inventoryCode, stockCardNo, description, genericName, SUM(quantity) AS totalqty FROM inventory WHERE quantity<='50' AND inventoryType='medicine' AND status NOT LIKE 'DELETED_%%%%' GROUP BY stockcardNo ORDER BY $sortme");
$ax=0;
while($afetch=mysql_fetch_array($asql)){
$astockCardNo=$afetch['stockCardNo'];
$adescription=$afetch['description'];
$agenericName=$afetch['genericName'];
$atotalqty=$afetch['totalqty'];

$bsql=mysql_query("SELECT * FROM inventory WHERE stockCardNo='$astockCardNo' AND inventoryType='medicine' AND status NOT LIKE 'DELETED_%%%%' ORDER BY criticalLevel");
while($bfetch=mysql_fetch_array($bsql)){$bcriticalLevel=$bfetch['criticalLevel'];}
if($bcriticalLevel==''){$truebcriticalLevel='0';}else{$truebcriticalLevel=$bcriticalLevel;}
if($atotalqty<=$truebcriticalLevel){
$ax++;

echo "
      <tr>
        <td><div align='left' class='style2'>&nbsp;$adescription</div></td>
        <td><div align='left' class='style2'>&nbsp;$agenericName</div></td>
        <td><div align='left' class='style2'>&nbsp;$atotalqty</div></td>
        <td><div align='left' class='style2'>&nbsp;$bcriticalLevel</div></td>
        <td><div align='center' class='style2'><input type='hidden' name='stockCardNo$ax' value='' /><input type='checkbox' class='textfield1' name='stockCardNo$ax' value='$astockCardNo' /></div></td>
      </tr>
";
}
else{
}
}
echo "
      <tr>
        <td height='6' bgcolor='#0066FF'></td>
        <td height='6' bgcolor='#0066FF'></td>
        <td height='6' bgcolor='#0066FF'></td>
        <td height='6' bgcolor='#0066FF'></td>
        <td height='6' bgcolor='#0066FF'></td>
      </tr>
    </table></td>
  <input type='hidden' name='ax' value='$ax' />
  <input type='hidden' name='username' value='$username' />
  </tr>
";
}
else if($show=='Supplies'){
echo "
  <tr>
    <td bgcolor='#FFFFFF' colspan='2'><table width='700' border='1' bordercolor='#000000' cellspacing='0' cellpadding='0'>
      <tr>
        <td bgcolor='#0066FF' width='225' height='20'><div align='center' class='style1'>Brand Name</div></td>
        <td bgcolor='#0066FF' width='225'><div align='center' class='style1'>Generic Name</div></td>
        <td bgcolor='#0066FF' width='70'><div align='center' class='style1'>Qty. Left</div></td>
        <td bgcolor='#0066FF' width='130'><div align='center' class='style1'>Set Critical Level</div></td>
        <td bgcolor='#0066FF' width='50'><div align='center' class='style1'>Select</div></td>
      </tr>
";

$asql=mysql_query("SELECT inventoryCode, stockCardNo, description, genericName, SUM(quantity) AS totalqty FROM inventory WHERE quantity<='50' AND inventoryType='supplies' AND status NOT LIKE 'DELETED_%%%%' GROUP BY stockcardNo ORDER BY $sortme,description");
$ax=0;
while($afetch=mysql_fetch_array($asql)){
$astockCardNo=$afetch['stockCardNo'];
$adescription=$afetch['description'];
$agenericName=$afetch['genericName'];
$atotalqty=$afetch['totalqty'];

$bsql=mysql_query("SELECT * FROM inventory WHERE stockCardNo='$astockCardNo' AND inventoryType='supplies' AND status NOT LIKE 'DELETED_%%%%' ORDER BY criticalLevel");
while($bfetch=mysql_fetch_array($bsql)){$bcriticalLevel=$bfetch['criticalLevel'];}
if($bcriticalLevel==''){$truebcriticalLevel='0';}else{$truebcriticalLevel=$bcriticalLevel;}
if($atotalqty<=$truebcriticalLevel){
$ax++;

echo "
      <tr>
        <td><div align='left' class='style2'>&nbsp;$adescription</div></td>
        <td><div align='left' class='style2'>&nbsp;$agenericName</div></td>
        <td><div align='left' class='style2'>&nbsp;$atotalqty</div></td>
        <td><div align='left' class='style2'>&nbsp;$bcriticalLevel</div></td>
        <td><div align='center' class='style2'><input type='hidden' name='stockCardNo$ax' value='' /><input type='checkbox' class='textfield1' name='stockCardNo$ax' value='$astockCardNo' /></div></td>
      </tr>
";
}
else{
}
}
echo "
      <tr>
        <td height='6' bgcolor='#0066FF'></td>
        <td height='6' bgcolor='#0066FF'></td>
        <td height='6' bgcolor='#0066FF'></td>
        <td height='6' bgcolor='#0066FF'></td>
        <td height='6' bgcolor='#0066FF'></td>
      </tr>
    </table></td>
  </tr>
";
}

echo "
<input type='hidden' name='ax' value='$ax' />
<input type='hidden' name='username' value='$username' />
<input type='hidden' name='poNo' value='$poNo' />
</form>
</table>
</div>
";
?>
</body>
</html>
