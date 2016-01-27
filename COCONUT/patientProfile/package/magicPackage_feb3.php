<?php
include("../../../myDatabase1.php");
$registrationNo = $_GET['registrationNo'];


$ro = new database1();

//echo $registrationNo;
$ro->getPatientProfile($registrationNo);

$totalPHIC = ( $ro->getTotal("phic","MEDICINE",$registrationNo) + $ro->getTotal("phic","SUPPLIES",$registrationNo) + $ro->getTotal("phic","LABORATORY",$registrationNo) + $ro->getTotal("phic","RADIOLOGY",$registrationNo) + $ro->getTotal("phic","ECG",$registrationNo) + $ro->getTotal("phic","NURSING-CHARGES",$registrationNo) + $ro->getTotal("phic","MISCELLANEOUS",$registrationNo) + $ro->getTotal("phic","OTHERS",$registrationNo) + $ro->getTotal("phic","OR/DR/ER FEE",$registrationNo) + $ro->getTotal("phic","Room And Board",$registrationNo) + $ro->getTotal("phic","PROFESSIONAL FEE",$registrationNo) );

$ro->coconutTableStart();
$ro->coconutTableRowStart();
$ro->coconutTableHeader("Category");
$ro->coconutTableHeader("PhilHealth");
$ro->coconutTableRowStop();
$ro->coconutTableRowStart();
$ro->coconutTableData("MEDICINE");
$ro->coconutTableData(number_format($ro->getTotal("phic","MEDICINE",$registrationNo),2));
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("SUPPLIES");
$ro->coconutTableData(number_format($ro->getTotal("phic","SUPPLIES",$registrationNo),2));
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("LABORATORY");
$ro->coconutTableData(number_format($ro->getTotal("phic","LABORATORY",$registrationNo),2));
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("RADIOLOGY");
$ro->coconutTableData(number_format($ro->getTotal("phic","RADIOLOGY",$registrationNo),2));
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("ECG");
$ro->coconutTableData(number_format($ro->getTotal("phic","ECG",$registrationNo),2));
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("NURSING CHARGES");
$ro->coconutTableData(number_format($ro->getTotal("phic","NURSING-CHARGES",$registrationNo),2));
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("MISCELLANEOUS");
$ro->coconutTableData(number_format($ro->getTotal("phic","MISCELLANEOUS",$registrationNo),2));
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("OTHERS");
$ro->coconutTableData(number_format($ro->getTotal("phic","OTHERS",$registrationNo),2));
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("OR/DR/ER FEE");
$ro->coconutTableData(number_format($ro->getTotal("phic","OR/DR/ER FEE",$registrationNo),2));
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("Room's");
$ro->coconutTableData(number_format($ro->getTotal("phic","Room And Board",$registrationNo),2));
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("PROFESSIONAL FEE");
$ro->coconutTableData(number_format($ro->getTotal("phic","PROFESSIONAL FEE",$registrationNo),2));
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("<b>TOTAL PHILHEALTH</b>");
$ro->coconutTableData("<font color=red><b>".number_format($totalPHIC,2)."</b></font>");
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("<b>PHILHEALTH PACKAGE</b>");
$ro->coconutTableData("<b>".number_format($ro->selectNow("package","price","description",$ro->getRegistrationDetails_package()),2)."</b>");
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("<b>SHORT</b>");
$ro->coconutTableData("<font color=red><b>".number_format($ro->selectNow("package","price","description",$ro->getRegistrationDetails_package()) - $totalPHIC,2)."</b></font>");
$ro->coconutTableRowStop();

$ro->coconutTableStop();

echo "<br><Br>";

$shortPHIC = ( $ro->selectNow("package","price","description",$ro->getRegistrationDetails_package()) - $totalPHIC );

$ro->coconutFormStart("get","magicPackage1.php");
$ro->coconutHidden("short",$shortPHIC);
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutButton("Apply Short Package");
$ro->coconutFormStop();

/*
echo "MEDICINE:&nbsp;".number_format($ro->getTotal("phic","MEDICINE",$registrationNo),2);
echo "<br>";
echo "SUPPLIES:&nbsp;".number_format($ro->getTotal("phic","SUPPLIES",$registrationNo),2);
echo "<br>";
echo "LABORATORY:&nbsp;".number_format($ro->getTotal("phic","LABORATORY",$registrationNo),2);
echo "<br>";
echo "RADIOLOGY:&nbsp;".number_format($ro->getTotal("phic","RADIOLOGY",$registrationNo),2);
echo "<br>";
echo "ECG:&nbsp;".number_format($ro->getTotal("phic","ECG",$registrationNo),2);
echo "<br>";
echo "NURSING:&nbsp;".number_format($ro->getTotal("phic","NURSING-CHARGES",$registrationNo),2);
echo "<br>";
echo "MISCELLANEOUS:&nbsp;".number_format($ro->getTotal("phic","MISCELLANEOUS",$registrationNo),2);
echo "<br>";
echo "OTHERS:&nbsp;".number_format($ro->getTotal("phic","OTHERS",$registrationNo),2);
echo "<br>";
echo "OR/DR/ER FEE:&nbsp;".number_format($ro->getTotal("phic","OR/DR/ER FEE",$registrationNo),2);
echo "<br>";
echo "Room:&nbsp;".number_format($ro->getTotal("phic","Room And Board",$registrationNo),2);
echo "<br>";
echo "PROFESSIONAL FEE:&nbsp;".number_format($ro->getTotal("phic","PROFESSIONAL FEE",$registrationNo),2);
*/
?>
