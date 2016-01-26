<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Test Codes</title>
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
.style1 {
	font-family: Arial;
	font-size: 14px;
	font-weight: bold;
	color: #000000;
}
.style2 {
	font-family: Arial;
	font-size: 14px;
	font-weight: bold;
	color: #000000;
}
.textfield01 {
	font-family: Arial;
	font-size: 12px;
	font-weight: bold;
	color: #000000;
	background-color: #FFFFFF;
	border: 1px solid #000000;
}
.button01 {
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

<body onload="placeFocus()">
<?php
mysql_connect("localhost","root","Pr0taci001");
mysql_select_db("Coconut");



echo "
<div align='left'>
";

$asql=mysql_query("SELECT inventoryCode, Added FROM inventory WHERE inventoryType='medicine'");
while($afetch=mysql_fetch_array($asql)){
$inventoryCode=$afetch['inventoryCode'];
$Added=$afetch['Added'];

$AddedSplit=preg_split ("/\_/", $Added);

mysql_query("UPDATE inventory SET ipdPrice='$AddedSplit[1]', opdPrice='$AddedSplit[1]' WHERE inventoryCode='$inventoryCode'");

$bsql=mysql_query("SELECT ipdPrice, opdPrice FROM inventory WHERE inventoryCode='$inventoryCode'");
while($bfetch=mysql_fetch_array($bsql)){$ipdPrice=$bfetch['ipdPrice']; $opdPrice=$bfetch['opdPrice'];}
echo "
<span class='style1'>".$inventoryCode." | ".$Added." - ".$AddedSplit[1]." - ".$ipdPrice." | ".$opdPrice."</span>

<br />
";
}

echo "
</div>
";
?>
</body>
</html>
