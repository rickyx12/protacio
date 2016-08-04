<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Collection Report</title>
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
.style1 {font-family: Arial;font-size: 16px;font-weight: bold;color: #000000;}
.style2 {font-family: Arial;font-size: 14px;font-weight: bold;color: #000000;}
.style3 {font-family: Arial;font-size: 13px;font-weight: bold;color: #000000;}
.style4 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;}
.textfield01 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px;}
.button01 {font-family: Arial;font-size: 14px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px;}
-->
</style>
</head>

<body onload="placeFocus()">
<?php
include("../../../myDatabase2.php");
$cuz = new database2();

$username=$_GET['username'];

($GLOBALS["___mysqli_ston"] = mysqli_connect($cuz->myHost(), $cuz->getUser(), $cuz->getPass()));
((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . $cuz->getDB()));

$year=date("Y");
$month=date("m");
$day=date("d");

echo "
<div align='center'><table width='550' border='1' cellspacing='0' cellpadding='0' bordercolor='#000000'>
  <tr><form name='Submit' method='get' action='CollectionReport.php'>
    <td><table width='550' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td colspan='3' height='30'></td>
      </tr>
      <tr>
        <td width='30'></td>
        <td width='490'><table width='490' border='0' cellspacing='0' cellpadding='0'>
          <tr>
            <td width='100'><div align='left' class='style4'>Select Date</div></td>
            <td width='390'><div align='left' class='style4'>
              From&nbsp;
              <select name='fm' class='textfield01'>
";

if($month=='01'){$fms01="selected='selected'";$fms02="";$fms03="";$fms04="";$fms05="";$fms06="";$fms07="";$fms08="";$fms09="";$fms10="";$fms11="";$fms12="";}
else if($month=='02'){$fms01="";$fms02="selected='selected'";$fms03="";$fms04="";$fms05="";$fms06="";$fms07="";$fms08="";$fms09="";$fms10="";$fms11="";$fms12="";}
else if($month=='03'){$fms01="";$fms02="";$fms03="selected='selected'";$fms04="";$fms05="";$fms06="";$fms07="";$fms08="";$fms09="";$fms10="";$fms11="";$fms12="";}
else if($month=='04'){$fms01="";$fms02="";$fms03="";$fms04="selected='selected'";$fms05="";$fms06="";$fms07="";$fms08="";$fms09="";$fms10="";$fms11="";$fms12="";}
else if($month=='05'){$fms01="";$fms02="";$fms03="";$fms04="";$fms05="selected='selected'";$fms06="";$fms07="";$fms08="";$fms09="";$fms10="";$fms11="";$fms12="";}
else if($month=='06'){$fms01="";$fms02="";$fms03="";$fms04="";$fms05="";$fms06="selected='selected'";$fms07="";$fms08="";$fms09="";$fms10="";$fms11="";$fms12="";}
else if($month=='07'){$fms01="";$fms02="";$fms03="";$fms04="";$fms05="";$fms06="";$fms07="selected='selected'";$fms08="";$fms09="";$fms10="";$fms11="";$fms12="";}
else if($month=='08'){$fms01="";$fms02="";$fms03="";$fms04="";$fms05="";$fms06="";$fms07="";$fms08="selected='selected'";$fms09="";$fms10="";$fms11="";$fms12="";}
else if($month=='09'){$fms01="";$fms02="";$fms03="";$fms04="";$fms05="";$fms06="";$fms07="";$fms08="";$fms09="selected='selected'";$fms10="";$fms11="";$fms12="";}
else if($month=='10'){$fms01="";$fms02="";$fms03="";$fms04="";$fms05="";$fms06="";$fms07="";$fms08="";$fms09="";$fms10="selected='selected'";$fms11="";$fms12="";}
else if($month=='11'){$fms01="";$fms02="";$fms03="";$fms04="";$fms05="";$fms06="";$fms07="";$fms08="";$fms09="";$fms10="";$fms11="selected='selected'";$fms12="";}
else if($month=='12'){$fms01="";$fms02="";$fms03="";$fms04="";$fms05="";$fms06="";$fms07="";$fms08="";$fms09="";$fms10="";$fms11="";$fms12="selected='selected'";}


echo "
                <option value='01' $fms01>Jan</option>
                <option value='02' $fms02>Feb</option>
                <option value='03' $fms03>Mar</option>
                <option value='04' $fms04>Apr</option>
                <option value='05' $fms05>May</option>
                <option value='06' $fms06>Jun</option>
                <option value='07' $fms07>Jul</option>
                <option value='08' $fms08>Aug</option>
                <option value='09' $fms09>Sep</option>
                <option value='10' $fms10>Oct</option>
                <option value='11' $fms11>Nov</option>
                <option value='12' $fms12>Dec</option>
              </select>
              <select name='fd' class='textfield01'>
";

for($a=1;$a<=31;$a++){
if($a<10){$b="0".$a;}else{$b=$a;}
if($b==$day){$fds="selected='selected'";}else{$fds="";}

echo "
                <option $fds>$b</option>
";
}

echo "
              </select>
              <select name='fy' class='textfield01'>
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
              &nbsp;To&nbsp; 
              <select name='tm' class='textfield01'>
";

if($month=='01'){$tms01="selected='selected'";$tms02="";$tms03="";$tms04="";$tms05="";$tms06="";$tms07="";$tms08="";$tms09="";$tms10="";$tms11="";$tms12="";}
else if($month=='02'){$tms01="";$tms02="selected='selected'";$tms03="";$tms04="";$tms05="";$tms06="";$tms07="";$tms08="";$tms09="";$tms10="";$tms11="";$tms12="";}
else if($month=='03'){$tms01="";$tms02="";$tms03="selected='selected'";$tms04="";$tms05="";$tms06="";$tms07="";$tms08="";$tms09="";$tms10="";$tms11="";$tms12="";}
else if($month=='04'){$tms01="";$tms02="";$tms03="";$tms04="selected='selected'";$tms05="";$tms06="";$tms07="";$tms08="";$tms09="";$tms10="";$tms11="";$tms12="";}
else if($month=='05'){$tms01="";$tms02="";$tms03="";$tms04="";$tms05="selected='selected'";$tms06="";$tms07="";$tms08="";$tms09="";$tms10="";$tms11="";$tms12="";}
else if($month=='06'){$tms01="";$tms02="";$tms03="";$tms04="";$tms05="";$tms06="selected='selected'";$tms07="";$tms08="";$tms09="";$tms10="";$tms11="";$tms12="";}
else if($month=='07'){$tms01="";$tms02="";$tms03="";$tms04="";$tms05="";$tms06="";$tms07="selected='selected'";$tms08="";$tms09="";$tms10="";$tms11="";$tms12="";}
else if($month=='08'){$tms01="";$tms02="";$tms03="";$tms04="";$tms05="";$tms06="";$tms07="";$tms08="selected='selected'";$tms09="";$tms10="";$tms11="";$tms12="";}
else if($month=='09'){$tms01="";$tms02="";$tms03="";$tms04="";$tms05="";$tms06="";$tms07="";$tms08="";$tms09="selected='selected'";$tms10="";$tms11="";$tms12="";}
else if($month=='10'){$tms01="";$tms02="";$tms03="";$tms04="";$tms05="";$tms06="";$tms07="";$tms08="";$tms09="";$tms10="selected='selected'";$tms11="";$tms12="";}
else if($month=='11'){$tms01="";$tms02="";$tms03="";$tms04="";$tms05="";$tms06="";$tms07="";$tms08="";$tms09="";$tms10="";$tms11="selected='selected'";$tms12="";}
else if($month=='12'){$tms01="";$tms02="";$tms03="";$tms04="";$tms05="";$tms06="";$tms07="";$tms08="";$tms09="";$tms10="";$tms11="";$tms12="selected='selected'";}

echo "
                <option value='01' $tms01>Jan</option>
                <option value='02' $tms02>Feb</option>
                <option value='03' $tms03>Mar</option>
                <option value='04' $tms04>Apr</option>
                <option value='05' $tms05>May</option>
                <option value='06' $tms06>Jun</option>
                <option value='07' $tms07>Jul</option>
                <option value='08' $tms08>Aug</option>
                <option value='09' $tms09>Sep</option>
                <option value='10' $tms10>Oct</option>
                <option value='11' $tms11>Nov</option>
                <option value='12' $tms12>Dec</option>
              </select>
              <select name='td' class='textfield01'>
";

for($z=1;$z<=31;$z++){
if($z<10){$y="0".$z;}else{$y=$z;}
if($y==$day){$tds="selected='selected'";}else{$tds="";}

echo "
                <option $tds>$y</option>
";
}

echo "
              </select>
              <select name='ty' class='textfield01'>
";

for($x=1930;$x<$year;$x++){
echo "
                <option>$x</option>
";
}

echo "
                <option selected='selected'>$year</option>
";

for($w=($year+1);$w<=($year+10);$w++){
echo "
                <option>$w</option>
";
}

echo "
              </select>
            </td>
          </tr>
          <tr>
            <td width='100'><div align='left' class='style4'>Select Time</div></td>
            <td width='390'><div align='left' class='style4'>
              From&nbsp;
              <select name='fth' class='textfield01'>
";

for($e=0;$e<=23;$e++){
if($e<10){$f="0".$e;}else{$f=$e;}
if($f=='00'){$fhs="selected='selected'";}else{$fhs="";}
echo "
                <option $fhs>$f</option>
";
}

echo "
              </select>
              &nbsp;:&nbsp;
              <select name='ftm' class='textfield01'>
";

for($g=0;$g<=59;$g++){
if($g<10){$h="0".$g;}else{$h=$g;}
if($h=='00'){$fms="selected='selected'";}else{$fms="";}
echo "
                <option $fms>$h</option>
";
}

echo "
              </select>
              &nbsp;:&nbsp;
              <select name='fts' class='textfield01'>
";

for($i=0;$i<=59;$i++){
if($i<10){$j="0".$i;}else{$j=$i;}
if($j=='00'){$fss="selected='selected'";}else{$fss="";}
echo "
                <option $fss>$j</option>
";
}

echo "
              </select>
              &nbsp;To&nbsp;
              <select name='tth' class='textfield01'>
";

for($k=0;$k<=23;$k++){
if($k<10){$l="0".$k;}else{$l=$k;}
if($l=='23'){$ths="selected='selected'";}else{$ths="";}
echo "
                <option $ths>$l</option>
";
}

echo "
              </select>
              &nbsp;:&nbsp;
              <select name='ttm' class='textfield01'>
";

for($m=0;$m<=59;$m++){
if($m<10){$n="0".$m;}else{$n=$m;}
if($n=='59'){$tms="selected='selected'";}else{$tms="";}
echo "
                <option $tms>$n</option>
";
}

echo "
              </select>
              &nbsp;:&nbsp;
              <select name='tts' class='textfield01'>
";

for($o=0;$o<=59;$o++){
if($o<10){$p="0".$o;}else{$p=$o;}
if($o=='59'){$tss="selected='selected'";}else{$tss="";}
echo "
                <option $tss>$o</option>
";
}

echo "
              </select>
            </td>
          </tr>
          <tr>
            <td height='45' colspan='2'><div align='center'><input type='submit' name='Submit' class='button01' value='Submit' /></div></td>
          </tr>
        </table></td>
        <td width='30'></td>
      </tr>
      <tr>
        <td colspan='3' height='30'></td>
      </tr>
    </table></td>
  <input type='hidden' name='username' value='$username' />
  </form></t>
</table></div>
";

?>
</body>
</html>
