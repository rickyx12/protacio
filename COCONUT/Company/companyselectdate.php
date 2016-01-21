<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Protacio Hospital</title>
<style type="text/css">
<!--
.style1 {
	font-family: Arial;
	font-size: 15px;
	font-weight: bold;
	color: #000000;
	background-color: #FFFFFF;
	border: 1px solid #000000;
}
.style2 {
	font-family: Arial;
	font-size: 15px;
	color: #000000;
	font-weight: bold;
	background-color: #FFFFFF;
	border-top-color: #000000;
	border-right-color: #000000;
	border-bottom-color: #000000;
	border-left-color: #000000;
}
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
$year=date("Y");
$month=date("m");
$day=date("d");
$username=$_GET['username'];

echo "
<div align='center'><br /><br /><br /><br />
  <table width='500' border='1' bordercolor='#000000' cellspacing='0' cellpadding='0'>
    <tr>
      <form id='form1' name='form1' method='get' action='companyframe.php'>
	<input name='username' type='hidden' value='$username' />
	  <td height='100' valign='center' align='center'>
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
        &nbsp;&nbsp;&nbsp;&nbsp;
		<select name='smonth' class='style2'>
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
";


echo "
        <select name='sday' class='style2'>
";

for($y=1;$y<=31;$y++){
if($y<10){$x="0".$y;}
else{$x=$y;}

if($day==$x){
echo "
          <option selected='selected'>$x</option>
";
}
else{
echo "
          <option>$x</option>
";
}
}
echo "
        </select>
        <select name='syear' class='style2'>
";

for($a=1934;$a<$year;$a++){
echo "
          <option>$a</option>
";
}

echo "
          <option selected='selected'>$year</option>
";

for($b=($year+1);$b<$year+11;$b++){
echo "
          <option>$b</option>
";
}

echo "
        </select>&nbsp;&nbsp;&nbsp;<br /><br />
        <input name='Submit' type='submit' class='style1' value='Submit' />
      </td>
	  </form>
    </tr>
  </table>
</div>
";
?>
</body>
</html>
