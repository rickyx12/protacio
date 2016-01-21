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
.style3 {font-family: Arial;font-size: 14px;color: #000000;}
.style4 {font-family: Arial;font-size: 12px;color: #FFFFFF;font-weight: bold;}
.style5 {font-family: Arial;font-size: 12px;color: #FF0000;font-weight: bold;}
.textfield1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px;width: 100px;}
.button1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;}
.button2 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FFFFFF;background-color: #0066FF;border: 1px solid #000000;height: 25px;}
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
include("../../myDatabase.php");
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$registrationNo=$_GET['registrationNo'];
$username=$_GET['username'];
$checked=$_GET['checked'];
$show=$_GET['show'];
$ax=$_GET['ax'];

$year=date("Y");
$month=date("m");
$day=date("d");

if($month=='01'){$cm01="selected='selected'"; $cm02=""; $cm03=""; $cm04=""; $cm05=""; $cm06=""; $cm07=""; $cm08=""; $cm09=""; $cm10=""; $cm11=""; $cm12="";}
else if($month=='02'){$cm01=""; $cm02="selected='selected'"; $cm03=""; $cm04=""; $cm05=""; $cm06=""; $cm07=""; $cm08=""; $cm09=""; $cm10=""; $cm11=""; $cm12="";}
else if($month=='03'){$cm01=""; $cm02=""; $cm03="selected='selected'"; $cm04=""; $cm05=""; $cm06=""; $cm07=""; $cm08=""; $cm09=""; $cm10=""; $cm11=""; $cm12="";}
else if($month=='04'){$cm01=""; $cm02=""; $cm03=""; $cm04="selected='selected'"; $cm05=""; $cm06=""; $cm07=""; $cm08=""; $cm09=""; $cm10=""; $cm11=""; $cm12="";}
else if($month=='05'){$cm01=""; $cm02=""; $cm03=""; $cm04=""; $cm05="selected='selected'"; $cm06=""; $cm07=""; $cm08=""; $cm09=""; $cm10=""; $cm11=""; $cm12="";}
else if($month=='06'){$cm01=""; $cm02=""; $cm03=""; $cm04=""; $cm05=""; $cm06="selected='selected'"; $cm07=""; $cm08=""; $cm09=""; $cm10=""; $cm11=""; $cm12="";}
else if($month=='07'){$cm01=""; $cm02=""; $cm03=""; $cm04=""; $cm05=""; $cm06=""; $cm07="selected='selected'"; $cm08=""; $cm09=""; $cm10=""; $cm11=""; $cm12="";}
else if($month=='08'){$cm01=""; $cm02=""; $cm03=""; $cm04=""; $cm05=""; $cm06=""; $cm07=""; $cm08="selected='selected'"; $cm09=""; $cm10=""; $cm11=""; $cm12="";}
else if($month=='09'){$cm01=""; $cm02=""; $cm03=""; $cm04=""; $cm05=""; $cm06=""; $cm07=""; $cm08=""; $cm09="selected='selected'"; $cm10=""; $cm11=""; $cm12="";}
else if($month=='10'){$cm01=""; $cm02=""; $cm03=""; $cm04=""; $cm05=""; $cm06=""; $cm07=""; $cm08=""; $cm09=""; $cm10="selected='selected'"; $cm11=""; $cm12="";}
else if($month=='11'){$cm01=""; $cm02=""; $cm03=""; $cm04=""; $cm05=""; $cm06=""; $cm07=""; $cm08=""; $cm09=""; $cm10=""; $cm11="selected='selected'"; $cm12="";}
else if($month=='12'){$cm01=""; $cm02=""; $cm03=""; $cm04=""; $cm05=""; $cm06=""; $cm07=""; $cm08=""; $cm09=""; $cm10=""; $cm11=""; $cm12="selected='selected'";}

echo "
<div align='left'>
<br />
<table border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td colspan='4'><div align='left' class='style1'>Change Date To:</div></td>
  </tr>
  <tr>
    <form name='Submit' method='get' action='ChangeChargesDateSave.php'>
    <td>
      <select name='cmonth' class='textfield1'>
        <option value='01' $cm01>Jan</option>
        <option value='02' $cm02>Feb</option>
        <option value='03' $cm03>Mar</option>
        <option value='04' $cm04>Apr</option>
        <option value='05' $cm05>May</option>
        <option value='06' $cm06>Jun</option>
        <option value='07' $cm07>Jul</option>
        <option value='08' $cm08>Aug</option>
        <option value='09' $cm09>Sep</option>
        <option value='10' $cm10>Oct</option>
        <option value='11' $cm11>Nov</option>
        <option value='12' $cm12>Dec</option>
      </select>
    </td>
    <td>
      <select name='cday' class='textfield1'>
";

for($a=1;$a<=31;$a++){
if($a<10){$b="0".$a;}else{$b=$a;}
if($b==$day){$cd="selected='selected'";}else{$cd="";}

echo "
        <option $cd>$b</option>
";
}

echo "
      </select>
    </td>
    <td>
      <select name='cyear' class='textfield1'>
";

for($c=1930;$c<$year;$c++){
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
    </td>
    <input type='hidden' name='registrationNo' value='$registrationNo' />
    <input type='hidden' name='username' value='$username' />
    <input type='hidden' name='show' value='$show' />
    <input type='hidden' name='checked' value='$checked' />
";

$axx=0;
for($x=1;$x<=$ax;$x++){
$var="itemNo".$x;
$itemNo=$_GET[$var];

if($itemNo!=""){
$axx++;
echo "
    <input type='hidden' name='itemNo$axx' value='$itemNo' />
";
}
else{
}
}

echo "
    <input type='hidden' name='ax' value='$axx' />
    <td><input type='submit' name='submit' class='button2' value='Submit' /></td>
    </form>
  </tr>
</table>
</div>
";
?>
</body>
</html>
