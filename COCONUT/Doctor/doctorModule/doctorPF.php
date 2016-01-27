<?php
include("../../../myDatabase3.php");
$doctorName = $_GET['doctorName'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];


$ro = new database3();

$date = $year."-".$month."-".$day;
$date1 = $year1."-".$month1."-".$day1;

echo "<center><font size=5><b>".$ro->getReportInformation("hmoSOA_name")."</b></font>
<br> <font size=4><b>PF LISTING</b></font>
<br><font size=2><b>(Discharged $month $day, $year - $month1 $day1, $year1 )</b></font>

</centeR>";
echo "<br><br>";
$ro->individual_doc_PF($doctorName,$month,$day,$year,$month1,$day1,$year1);
echo "<br><br>";

$ro->doctorPatient($doctorName,$date,$date1,"OPD");

?>
