<?php
include("../../../myDatabase2.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];
$show = $_GET['show'];
$username = $_GET['username'];


$ro = new database2();

echo "<font size=5>CASH COLLECTION</font>";
echo "<br>";
echo "<font size=3>$month $day, $year - $month1 $day1, $year1</font>";

$ro->coconutTableStart();
$ro->coconutTableRowStart();
$ro->coconutTableHeader("&nbsp;");
$ro->coconutTableHeader("Patient");
$ro->coconutTableHeader("LABORATORY");
$ro->coconutTableHeader("RADIOLOGY");
$ro->coconutTableHeader("MEDICINE");
$ro->coconutTableHeader("SUPPLIES");
$ro->coconutTableHeader("BLOODBANK");
$ro->coconutTableHeader("NBS");
$ro->coconutTableHeader("MISCLLANEOUS");
$ro->coconutTableHeader("NURSING CARE");
$ro->coconutTableHeader("ECG");
$ro->coconutTableRowStop();
$ro->coconutTableRowStart();
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("&nbsp;<B>Discharged</b>");
$ro->coconutTableData("&nbsp;<font color=red><b>Charge To Bill</b></font>");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableRowStop();

$ro->cashCollection_name($month,$day,$year,$month1,$day1,$year1,"IPD",$show,$username);


$ro->coconutTableRowStart();
$ro->coconutTableData("&nbsp;<b>TOTAL</b>");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;<b>".number_format($ro->cashCollection_name_laboratory(),2)."</b>");
$ro->coconutTableData("&nbsp;<b>".number_format($ro->cashCollection_name_radiology(),2)."</b>");
$ro->coconutTableData("&nbsp;<b>".number_format($ro->cashCollection_name_medicine(),2)."</b>");
$ro->coconutTableData("&nbsp;<b>".number_format($ro->cashCollection_name_supplies(),2)."</b>");
$ro->coconutTableData("&nbsp;<b>".number_format($ro->cashCollection_name_bloodBank(),2)."</b>");
$ro->coconutTableData("&nbsp;<b>".number_format($ro->cashCollection_name_nbs(),2)."</b>");
$ro->coconutTableData("&nbsp;<b>".number_format($ro->cashCollection_name_misc(),2)."</b>");
$ro->coconutTableData("&nbsp;<b>".number_format($ro->cashCollection_name_nursingCare(),2)."</b>");
$ro->coconutTableData("&nbsp;<b>".number_format($ro->cashCollection_name_ecg(),2)."</b>");
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$ro->coconutTableData("&nbsp;<b>Date Paid</b>");
$ro->coconutTableData("&nbsp;<font color=red><b>BINILI</b></font>");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableRowStop();

$ro->cashCollection_name1($month,$day,$year,$month1,$day1,$year1,"IPD",$show,$username);

$ro->coconutTableRowStart();
$ro->coconutTableData("&nbsp;<b>TOTAL</b>");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;<b>".number_format($ro->cashCollection_name1_laboratory(),2)."</b>");
$ro->coconutTableData("&nbsp;<b>".number_format($ro->cashCollection_name1_radiology(),2)."</b>");
$ro->coconutTableData("&nbsp;<b>".number_format($ro->cashCollection_name1_medicine(),2)."</b>");
$ro->coconutTableData("&nbsp;<b>".number_format($ro->cashCollection_name1_supplies(),2)."</b>");
$ro->coconutTableData("&nbsp;<b>".number_format($ro->cashCollection_name1_bloodBank(),2)."</b>");
$ro->coconutTableData("&nbsp;<b>".number_format($ro->cashCollection_name1_nbs(),2)."</b>");
$ro->coconutTableData("&nbsp;<b>".number_format($ro->cashCollection_name1_misc(),2)."</b>");
$ro->coconutTableData("&nbsp;<b>".number_format($ro->cashCollection_name1_nursingCare(),2)."</b>");
$ro->coconutTableData("&nbsp;<b>".number_format($ro->cashCollection_name1_ecg(),2)."</b>");
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableRowStop();

$grandTotal_laboratory = ( $ro->cashCollection_name_laboratory() + $ro->cashCollection_name1_laboratory() );
$grandTotal_radiology = ( $ro->cashCollection_name_radiology() + $ro->cashCollection_name1_radiology() );
$grandTotal_medicine = ( $ro->cashCollection_name_medicine() + $ro->cashCollection_name1_medicine() );
$grandTotal_supplies = ( $ro->cashCollection_name_supplies() + $ro->cashCollection_name1_supplies() );
$grandTotal_bloodBank = ( $ro->cashCollection_name_bloodBank() + $ro->cashCollection_name1_bloodBank() );
$grandTotal_nbs = ( $ro->cashCollection_name_nbs() + $ro->cashCollection_name1_nbs() );
$grandTotal_misc = ( $ro->cashCollection_name_misc() + $ro->cashCollection_name1_misc() );
$grandTotal_nursingCare = ( $ro->cashCollection_name_nursingCare() + $ro->cashCollection_name1_nursingCare() );
$grandTotal_ecg = ( $ro->cashCollection_name_ecg() + $ro->cashCollection_name1_ecg() );

$ro->coconutTableRowStart();
$ro->coconutTableData("&nbsp;<font size=2><b>GRAND TOTAL</b></font>");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;<b>".number_format($grandTotal_laboratory,2)."</b>");
$ro->coconutTableData("&nbsp;<b>".number_format($grandTotal_radiology,2)."</b>");
$ro->coconutTableData("&nbsp;<b>".number_format($grandTotal_medicine,2)."</b>");
$ro->coconutTableData("&nbsp;<b>".number_format($grandTotal_supplies,2)."</b>");
$ro->coconutTableData("&nbsp;<b>".number_format($grandTotal_bloodBank,2)."</b>");
$ro->coconutTableData("&nbsp;<b>".number_format($grandTotal_nbs,2)."</b>");
$ro->coconutTableData("&nbsp;<b>".number_format($grandTotal_misc,2)."</b>");
$ro->coconutTableData("&nbsp;<b>".number_format($grandTotal_nursingCare,2)."</b>");
$ro->coconutTableData("&nbsp;<b>".number_format($grandTotal_ecg,2)."</b>");
$ro->coconutTableRowStop();


$ro->coconutTableStop();

?>
