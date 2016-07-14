<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {
	font-family: Arial;
	font-size: 14px;
	color: #000000;
	font-weight: bold;
}
.textfield1 {
	font-family: Arial;
	font-size: 12px;
	font-weight: bold;
	color: #000000;
	background-color: #FFFFFF;
	border: 1px solid #000000;
}
.button1 {
	font-family: Arial;
	font-size: 12px;
	font-weight: bold;
	color: #000000;
	background-color: #FFFFFF;
	border: 1px solid #000000;
}
-->
</style>
</head>

<body>
<?php
include("../myDatabase.php");
$cuz = new database();

($GLOBALS["___mysqli_ston"] = mysqli_connect($cuz->myHost(), $cuz->getUser(), $cuz->getPass()));
((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . $cuz->getDB()));

$year=date("Y");
$month=date("m");
$day=date("d");

echo "
<div align='left'><span class='style1'>Create Purchasing Report</span>
<br /><br />
  <table border='0' cellspacing='0' cellpadding='0'>
    <tr>
	<form id='save' name='save' method='get' action='SaveReport.php'>
      <td>
	  <select name='supplier' class='textfield1' id='supplier'>
	    <option selected='selected'>-Select Supplier-</option>
";

$supsql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT supplierCode, supplierName FROM supplier ORDER supplierName");
while($supfetch=mysqli_fetch_array($supsql)){
$supplierCode=$supfetch['supplierCode'];
$supplierName=$supfetch['supplierName'];
echo "

	    <option value='$supplierCode'>$supplierName</option>
";
}

echo "
      </select>
	  </td>
	  <td width='5'></td>
      <td>
	  <select name='month' class='textfield1' id='month'>
";

if($month=='01'){$m01="selected='selected'"; $m02=""; $m03=""; $m04=""; $m05=""; $m06=""; $m07=""; $m08=""; $m09=""; $m10=""; $m11=""; $m12="";}
else if($month=='02'){$m01=""; $m02="selected='selected'"; $m03=""; $m04=""; $m05=""; $m06=""; $m07=""; $m08=""; $m09=""; $m10=""; $m11=""; $m12="";}
else if($month=='03'){$m01=""; $m02=""; $m03="selected='selected'"; $m04=""; $m05=""; $m06=""; $m07=""; $m08=""; $m09=""; $m10=""; $m11=""; $m12="";}
else if($month=='04'){$m01=""; $m02=""; $m03=""; $m04="selected='selected'"; $m05=""; $m06=""; $m07=""; $m08=""; $m09=""; $m10=""; $m11=""; $m12="";}
else if($month=='05'){$m01=""; $m02=""; $m03=""; $m04=""; $m05="selected='selected'"; $m06=""; $m07=""; $m08=""; $m09=""; $m10=""; $m11=""; $m12="";}
else if($month=='06'){$m01=""; $m02=""; $m03=""; $m04=""; $m05=""; $m06="selected='selected'"; $m07=""; $m08=""; $m09=""; $m10=""; $m11=""; $m12="";}
else if($month=='07'){$m01=""; $m02=""; $m03=""; $m04=""; $m05=""; $m06=""; $m07="selected='selected'"; $m08=""; $m09=""; $m10=""; $m11=""; $m12="";}
else if($month=='08'){$m01=""; $m02=""; $m03=""; $m04=""; $m05=""; $m06=""; $m07=""; $m08="selected='selected'"; $m09=""; $m10=""; $m11=""; $m12="";}
else if($month=='09'){$m01=""; $m02=""; $m03=""; $m04=""; $m05=""; $m06=""; $m07=""; $m08=""; $m09="selected='selected'"; $m10=""; $m11=""; $m12="";}
else if($month=='10'){$m01=""; $m02=""; $m03=""; $m04=""; $m05=""; $m06=""; $m07=""; $m08=""; $m09=""; $m10="selected='selected'"; $m11=""; $m12="";}
else if($month=='11'){$m01=""; $m02=""; $m03=""; $m04=""; $m05=""; $m06=""; $m07=""; $m08=""; $m09=""; $m10=""; $m11="selected='selected'"; $m12="";}
else if($month=='12'){$m01=""; $m02=""; $m03=""; $m04=""; $m05=""; $m06=""; $m07=""; $m08=""; $m09=""; $m10=""; $m11=""; $m12="selected='selected'";}

echo "
	    <option value='01' $m01>Jan</option>
	    <option value='02' $m02>Feb</option>
	    <option value='03' $m03>Mar</option>
	    <option value='04' $m04>Apr</option>
	    <option value='05' $m05>May</option>
	    <option value='06' $m06>Jun</option>
	    <option value='07' $m07>Jul</option>
	    <option value='08' $m08>Aug</option>
	    <option value='09' $m09>Sep</option>
	    <option value='10' $m10>Oct</option>
	    <option value='11' $m11>Nov</option>
	    <option value='12' $m12>Dec</option>
";


echo "
      </select>
      <select name='day' class='textfield1' id='day'>
";

for($z=1;$z<=31;$z++){
if($z<10){$y="0".$z;}else{$y=$z;}

if($day==$y){$sd="selected='selected'";}else{$sd="";}

echo "
        <option $sd>$y</option>
";
}

echo "
      </select>
      <select name='year' class='textfield1' id='year'>
";

for($a=1930;$a<$year;$a++){
echo "
        <option>$a</option>
";
}

echo "
        <option selected='selected'>$year</option>
";

for($b=($year+1);$b<=($year+10);$b++){
echo "
        <option>$b</option>
";
}

echo "  
      </select>
	  </td>
	  <td width='5'></td>
      <td>
	  <input name='Submit' type='submit' class='button1' value='Submit' />
	  </td>
    </form>
	</tr>
  </table>
</div>
";
?>
</body>
</html>
