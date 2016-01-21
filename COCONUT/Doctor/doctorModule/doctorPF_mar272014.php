<?php
include("../../../myDatabase.php");
$doctorName = $_GET['doctorName'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];





$ro = new database();

echo "<center><font size=5><b>".$ro->getReportInformation("hmoSOA_name")."</b></font>
<br> <font size=4><b>PF LISTING</b></font>
<br><font size=4><b>( $month $day, $year )</b></font>

</centeR>";
echo "<br><br>";
$ro->individual_doc_PF($doctorName,$month,$day,$year);


echo "<Br><br><br>";

?>
