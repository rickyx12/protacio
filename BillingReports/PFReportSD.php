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
//-->
</script>
</head>

<body>
<?php
include("../myDatabase.php");
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$username=$_GET['username'];

$day=date("d");
$month=date("m");
$year=date("Y");

echo "
<br />
<div align='left'>
  <table width='300' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000' bgcolor='#0066FF'>
    <form id='View' name='Create' method='get' action='PFReport.php'>
    <input type='hidden' name='username' value='$username' />
    <tr>
      <td><table width='300' border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td colspan='3' height='30'><div class='style1' align='left'>&nbsp;Select Date</div></td>
        </tr>
        <tr>
          <td width='auto'><div class='style2' align='left'>&nbsp;Date From</div></td>
          <td width='auto'><div class='style2' align='center'>:</div></td>
          <td width='auto'><div class='style2' align='left'>
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
            <select name='fmonth' class='textfield2'>
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
            <select name='fday' class='textfield2'>
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
            <select name='fyear' class='textfield2'>
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
          <td><div class='style2' align='left'>&nbsp;Date To</div></td>
          <td><div class='style2' align='center'>:</div></td>
          <td><div class='style2' align='left'>
            <select name='tmonth' class='textfield2'>
";

if($month=='01'){$tm01="selected='selected'"; $tm02=""; $tm03=""; $tm04=""; $tm05=""; $tm06=""; $tm07=""; $tm08=""; $tm09=""; $tm10=""; $tm11=""; $tm12="";}
else if($month=='02'){$tm01=""; $tm02="selected='selected'"; $tm03=""; $tm04=""; $tm05=""; $tm06=""; $tm07=""; $tm08=""; $tm09=""; $tm10=""; $tm11=""; $tm12="";}
else if($month=='03'){$tm01=""; $tm02=""; $tm03="selected='selected'"; $tm04=""; $tm05=""; $tm06=""; $tm07=""; $tm08=""; $tm09=""; $tm10=""; $tm11=""; $tm12="";}
else if($month=='04'){$tm01=""; $tm02=""; $tm03=""; $tm04="selected='selected'"; $tm05=""; $tm06=""; $tm07=""; $tm08=""; $tm09=""; $tm10=""; $tm11=""; $tm12="";}
else if($month=='05'){$tm01=""; $tm02=""; $tm03=""; $tm04=""; $tm05="selected='selected'"; $tm06=""; $tm07=""; $tm08=""; $tm09=""; $tm10=""; $tm11=""; $tm12="";}
else if($month=='06'){$tm01=""; $tm02=""; $tm03=""; $tm04=""; $tm05=""; $tm06="selected='selected'"; $tm07=""; $tm08=""; $tm09=""; $tm10=""; $tm11=""; $tm12="";}
else if($month=='07'){$tm01=""; $tm02=""; $tm03=""; $tm04=""; $tm05=""; $tm06=""; $tm07="selected='selected'"; $tm08=""; $tm09=""; $tm10=""; $tm11=""; $tm12="";}
else if($month=='08'){$tm01=""; $tm02=""; $tm03=""; $tm04=""; $tm05=""; $tm06=""; $tm07=""; $tm08="selected='selected'"; $tm09=""; $tm10=""; $tm11=""; $tm12="";}
else if($month=='09'){$tm01=""; $tm02=""; $tm03=""; $tm04=""; $tm05=""; $tm06=""; $tm07=""; $tm08=""; $tm09="selected='selected'"; $tm10=""; $tm11=""; $tm12="";}
else if($month=='10'){$tm01=""; $tm02=""; $tm03=""; $tm04=""; $tm05=""; $tm06=""; $tm07=""; $tm08=""; $tm09=""; $tm10="selected='selected'"; $tm11=""; $tm12="";}
else if($month=='11'){$tm01=""; $tm02=""; $tm03=""; $tm04=""; $tm05=""; $tm06=""; $tm07=""; $tm08=""; $tm09=""; $tm10=""; $tm11="selected='selected'"; $tm12="";}
else if($month=='12'){$tm01=""; $tm02=""; $tm03=""; $tm04=""; $tm05=""; $tm06=""; $tm07=""; $tm08=""; $tm09=""; $tm10=""; $tm11=""; $tm12="selected='selected'";}

echo "
              <option value='01' $tm01>Jan</option>
              <option value='02' $tm02>Feb</option>
              <option value='03' $tm03>Mar</option>
              <option value='04' $tm04>Apr</option>
              <option value='05' $tm05>May</option>
              <option value='06' $tm06>Jun</option>
              <option value='07' $tm07>Jul</option>
              <option value='08' $tm08>Aug</option>
              <option value='09' $tm09>Sep</option>
              <option value='10' $tm10>Oct</option>
              <option value='11' $tm11>Nov</option>
              <option value='12' $tm12>Dec</option>
            </select>
            <select name='tday' class='textfield2'>
";

for($x=1;$x<=31;$x++){
if($x<10){$w="0".$x;}else{$w=$x;}

if($w==$day){$std="selected='selected'";}else{$std="";}

echo "
              <option $std>$w</option>
";
}

echo "
            </select>
            <select name='tyear' class='textfield2'>
";

for($c=1930;$c<$year;$c++){
echo"
              <option>$c</option>
";
}

echo"
              <option selected='selected'>$year</option>
";

for($d=($year+1);$d<=($year+5);$d++){
echo"
              <option>$d</option>
";
}

echo "
            </select>
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

?>
</body>
</html>
