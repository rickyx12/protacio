<?php
include("../../../myDatabase2.php");
$stockCardNo = $_GET['stockCardNo'];
$date = $_GET['date'];
$date1 = $_GET['date1'];

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
$ro->_3monthsPurchasesDetails($stockCardNo,$date,$date1);


?>
