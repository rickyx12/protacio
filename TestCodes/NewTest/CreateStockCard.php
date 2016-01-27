<html>
<head>
<title>Create Stock Card</title>
</head>
<body>
<?php
include("../../myDatabase.php");
$ro = new database();
mysql_connect("localhost","root","Pr0taci001");
mysql_select_db("Coconut");

$date=date("Y-m-d");

$num=1;
$asql=mysql_query("SELECT * FROM inventory WHERE stockCardNo=''");
while($afetch=mysql_fetch_array($asql)){
$inventoryCode=$afetch['inventoryCode'];
$description=$afetch['description'];
$genericName=$afetch['genericName'];
$inventoryType=$afetch['inventoryType'];

$ro->getInventoryStockCardNo();
$myFile = $ro->getReportInformation("homeRoot")."/COCONUT/trackingNo/stockCardNo.dat";
$fh = fopen($myFile, 'r');
$stockCardNo = fread($fh, 100);
fclose($fh);

mysql_query("INSERT INTO inventoryStockCard VALUES('$stockCardNo','$description','$genericName','$date','protacio','$inventoryType')");

mysql_query("UPDATE inventory SET stockCardNo='$stockCardNo' WHERE inventoryCode='$inventoryCode'");

$num++;
echo "$num |  | $description | $genericName | $date | protacio | $inventoryType<br>";

}
?>
</body>
