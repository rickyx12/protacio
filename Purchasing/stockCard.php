<?php
include("../myDatabase2.php");
$stockCardNo = $_GET['stockCardNo'];
$inventoryType = $_GET['inventoryType'];
$show = $_GET['show'];

$ro = new database2();

echo "Stock Card#:&nbsp;<b>($stockCardNo)</b><Br>Brand Name:&nbsp;<b>".$ro->selectNow("inventoryStockCard","description","stockCardNo",$stockCardNo)."</b><Br>Generic Name:&nbsp;<b>".$ro->selectNow("inventoryStockCard","genericName","stockCardNo",$stockCardNo)."</b>";
$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/inventory/stockCard.php");
$ro->coconutHidden("stockCardNo",$stockCardNo);
$ro->coconutHidden("inventoryType",$inventoryType);
echo "<select name='show' onchange='this.form.submit()' style='border:1px solid #ff0000; width:140px;'>";
echo "<option value='$show'>$show</option>";
echo "<option value='ER'>ER</option>";
echo "<option value='OR'>OR</option>";
echo "<option value='PHARMACY'>PHARMACY</option>";
echo "<option value='all'>All</option>";
$ro->coconutComboBoxStop();
$ro->coconutFormStop();
echo "<center><br><br>";
$ro->viewStockCard($stockCardNo,$inventoryType,$show);

?>
