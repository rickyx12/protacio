<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Charges Summary</title>
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
.style1 {font-family: Arial;font-size: 16px;color: #000000;font-weight: bold;}
.style2 {font-family: "Times New Roman";font-size: 16px;color: #FF0000;font-weight: bold;}
.style3 {font-family: Arial;font-size: 14px;color: #000000;font-weight: bold;}
.style4 {font-family: Arial;font-size: 12px;color: #000000;font-weight: bold;}
.style5 {font-family: Arial;font-size: 14px;color: #000000;}
.style6 {font-family: Arial;font-size: 14px;color: #0066FF;}
.textfield2 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 30px;}
.button1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px;}
tr:hover { background-color:yellow;color:black;}
-->
</style>
</head>

<body onload="placeFocus()">
<?php
include("../../../../myDatabase.php");
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$show = $_GET['show'];
$chargesCode = $_GET['chargesCode'];
$showdate = $_GET['showdate'];

$asql=mysql_query("SELECT * FROM setdatetime WHERE registrationNo='$registrationNo'");
$acount=mysql_num_rows($asql);

$date=date("Ymd");
$time=date("H:i:s");

if($acount==0){mysql_query("INSERT INTO setdatetime VALUES('$registrationNo', '$date', '$time')");}

$bsql=mysql_query("SELECT setdate, settime FROM setdatetime WHERE registrationNo='$registrationNo'");
while($bfetch=mysql_fetch_array($bsql)){
$setdate=$bfetch['setdate'];
$settime=$bfetch['settime'];
}

$setdatestr=strtotime($setdate);
$settimestr=strtotime($settime);

$setdateY=date("Y",$setdatestr);
$setdateM=date("m",$setdatestr);
$setdateD=date("d",$setdatestr);

$settimeH=date("H",$settimestr);
$settimeM=date("i",$settimestr);
$settimeS=date("s",$settimestr);


echo "
<div align='left' class='style1'>
<br />
Change Statement of Account Discharge Date and Time
<table width='0' border='0' cellspacing='0' cellpadding='0'>
<form name='changedate' method='get' action='manualdatesave.php'>
<input type=hidden name='registrationNo' value='$registrationNo' >
<input type=hidden name='username' value='$username'>
<input type=hidden name='show' value='try'>
<input type='hidden' name='chargesCode' value='off'>
<input type='hidden' name='showdate' value='$showdate'>
  <tr>
    <td>&nbsp;</td>
    <td>
";

if($setdateM=='01'){$fm01="selected='selected'"; $fm02=""; $fm03=""; $fm04=""; $fm05=""; $fm06=""; $fm07=""; $fm08=""; $fm09=""; $fm10=""; $fm11=""; $fm12="";}
else if($setdateM=='02'){$fm01=""; $fm02="selected='selected'"; $fm03=""; $fm04=""; $fm05=""; $fm06=""; $fm07=""; $fm08=""; $fm09=""; $fm10=""; $fm11=""; $fm12="";}
else if($setdateM=='03'){$fm01=""; $fm02=""; $fm03="selected='selected'"; $fm04=""; $fm05=""; $fm06=""; $fm07=""; $fm08=""; $fm09=""; $fm10=""; $fm11=""; $fm12="";}
else if($setdateM=='04'){$fm01=""; $fm02=""; $fm03=""; $fm04="selected='selected'"; $fm05=""; $fm06=""; $fm07=""; $fm08=""; $fm09=""; $fm10=""; $fm11=""; $fm12="";}
else if($setdateM=='05'){$fm01=""; $fm02=""; $fm03=""; $fm04=""; $fm05="selected='selected'"; $fm06=""; $fm07=""; $fm08=""; $fm09=""; $fm10=""; $fm11=""; $fm12="";}
else if($setdateM=='06'){$fm01=""; $fm02=""; $fm03=""; $fm04=""; $fm05=""; $fm06="selected='selected'"; $fm07=""; $fm08=""; $fm09=""; $fm10=""; $fm11=""; $fm12="";}
else if($setdateM=='07'){$fm01=""; $fm02=""; $fm03=""; $fm04=""; $fm05=""; $fm06=""; $fm07="selected='selected'"; $fm08=""; $fm09=""; $fm10=""; $fm11=""; $fm12="";}
else if($setdateM=='08'){$fm01=""; $fm02=""; $fm03=""; $fm04=""; $fm05=""; $fm06=""; $fm07=""; $fm08="selected='selected'"; $fm09=""; $fm10=""; $fm11=""; $fm12="";}
else if($setdateM=='09'){$fm01=""; $fm02=""; $fm03=""; $fm04=""; $fm05=""; $fm06=""; $fm07=""; $fm08=""; $fm09="selected='selected'"; $fm10=""; $fm11=""; $fm12="";}
else if($setdateM=='10'){$fm01=""; $fm02=""; $fm03=""; $fm04=""; $fm05=""; $fm06=""; $fm07=""; $fm08=""; $fm09=""; $fm10="selected='selected'"; $fm11=""; $fm12="";}
else if($setdateM=='11'){$fm01=""; $fm02=""; $fm03=""; $fm04=""; $fm05=""; $fm06=""; $fm07=""; $fm08=""; $fm09=""; $fm10=""; $fm11="selected='selected'"; $fm12="";}
else if($setdateM=='12'){$fm01=""; $fm02=""; $fm03=""; $fm04=""; $fm05=""; $fm06=""; $fm07=""; $fm08=""; $fm09=""; $fm10=""; $fm11=""; $fm12="selected='selected'";}

echo "
      <select name='setdateM' class='textfield2'>
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
      <select name='setdateD' class='textfield2'>
";

for($z=1;$z<=31;$z++){
if($z<10){$y="0".$z;}else{$y=$z;}

if($y==$setdateD){$sfd="selected='selected'";}else{$sfd="";}

echo "
        <option $sfd>$y</option>
";
}

echo "
      </select>
      <select name='setdateY' class='textfield2'>
";

for($a=1930;$a<$setdateY;$a++){
echo"
        <option>$a</option>
";
}

echo"
        <option selected='selected'>$setdateY</option>
";

for($b=($setdateY+1);$b<=($setdateY+5);$b++){
echo"
        <option>$b</option>
";
}

echo "
      </select>-
      <select name='settimeH' class='textfield2'>
";

for($m=0;$m<=23;$m++){
if($m<10){$n="0".$m;}else{$n=$m;}

if($n==$settimeH){$hselect="selected='selected'";}else{$hselect="";}

echo "
        <option $hselect>$n</option>
";
}

echo "
      </select>:
      <select name='settimeM' class='textfield2'>
";

for($o=0;$o<=59;$o++){
if($o<10){$p="0".$o;}else{$p=$o;}

if($p==$settimeM){$mselect="selected='selected'";}else{$mselect="";}

echo "
        <option $mselect>$p</option>
";
}

echo "
      </select>:
      <select name='settimeS' class='textfield2'>
";

for($q=0;$q<=59;$q++){
if($q<10){$r="0".$q;}else{$r=$q;}

if($r==$settimeS){$sselect="selected='selected'";}else{$sselect="";}

echo "
        <option $sselect>$r</option>
";
}

echo "
      </select>
      <input type='submit' name='submit' class='button1' value='Change Date/Time' />
    </td>
  </tr>
</form>
</table>
</div> 
";
?>
</body>
</html>
