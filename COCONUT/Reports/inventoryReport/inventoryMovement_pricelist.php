<?php
include("../../../myDatabase2.php");
$stockCardNo = $_GET['stockCardNo'];
$inventoryType = $_GET['inventoryType'];
$ro = new database2();

echo "
<script type='text/javascript'>
function goBack() {
    window.history.back()
}
</script>

";

echo "<br>";
echo "<input type='submit' onclick='goBack()' value='<< Back' style='border:1px solid #ff0000; width:10%; color:red;'>";
echo "<br>";

if( $inventoryType == "medicine" ) {
$ro->itemPriceList_medicine($stockCardNo);
}else {
$ro->itemPriceList_supplies($stockCardNo);
}

?>
