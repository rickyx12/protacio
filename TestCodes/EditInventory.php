<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Inventory Edit</title>
</head>

<body>
<?php
mysql_connect("localhost","root","Pr0taci001");
mysql_select_db("Coconut");

$asql=mysql_query("SELECT inventoryCode, description, Added, ipdPrice, opdPrice FROM inventory WHERE inventoryType='medicine' ORDER BY inventoryCode");
while($afetch=mysql_fetch_array($asql)){
$inventoryCode=$afetch['inventoryCode'];
$description=$afetch['description'];
$Added=$afetch['Added'];
$ipdPrice=$afetch['ipdPrice'];
$opdPrice=$afetch['opdPrice'];

$Addedsplit=preg_split("#_#", $Added);

if(($ipdPrice!=$Addedsplit[1])||($opdPrice!=$Addedsplit[1])){
mysql_query("UPDATE inventory SET ipdPrice='$Addedsplit[1]', opdPrice='$Addedsplit[1]' WHERE inventoryCode='$inventoryCode'");
}

echo $description." | ".$Added." | ".$Addedsplit[1]." | ".$ipdPrice."-".$opdPrice."<br />";

}
?>
</body>
</html>
