<?php
include("../CORE/core2.php");
$registrationNo = $_GET['registrationNo'];
$itemNo  = $_GET['itemNo'];
$ro = new core2();

$ro->getPatientProfile($registrationNo);
$ro->getCrossMatchingResult($itemNo,$registrationNo);
echo "<center>";
echo "<B><font size=4>".$ro->getReportInformation("hmoSOA_name")."</font></b>";
echo "<br>";
echo "<B><font size=3>".$ro->getReportInformation("hmoSOA_address")."</font></b>";
echo "</center>";

echo "<br>";
echo "<Br>";
echo "<table width='90%' border=0>";
echo "<tr>";
echo "<tD><font size=4>Registration</font>&nbsp;&nbsp;<b>$itemNo</b></tD>";
echo "<tD><font size=4>Age</font>&nbsp;&nbsp;<b>".$ro->getPatientRecord_age()."</b></tD>";
echo "<tD><font size=4>Date</font>&nbsp;&nbsp;<b>".$ro->getCrossMatchingResult_dateResult()."</b></tD>";
echo "</tr>";
echo "<tr>";
echo "<Td><font size=4>Name</font>&nbsp;&nbsp;<b>".$ro->getPatientRecord_completeName()."</b></tD>";
echo "<Td><font size=4>Sex</font>&nbsp;&nbsp;<b>".$ro->getPatientRecord_gender()."</b></tD>";
echo "</tr>";
echo "</table>";
echo "<br><hr>";

echo "<table border=0>";
echo "<Tr>";
echo "<Td>&nbsp;Donor1&nbsp;</tD>";
echo "<Td>&nbsp;".$ro->getCrossMatchingResult_donor1()."&nbsp;</td>";
echo "</tr>";

echo "<Tr>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;".$ro->getCrossMatchingResult_dateCollected1()."&nbsp;</td>";
echo "</tr>";

echo "<Tr>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;".$ro->getCrossMatchingResult_expiryDate1()."&nbsp;</td>";
echo "</tr>";

echo "<Tr>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;".$ro->getCrossMatchingResult_retyping1()."&nbsp;</td>";
echo "</tr>";


echo "<Tr>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;".$ro->getCrossMatchingResult_crossMatching1()."&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;</tD>";
echo "</tr>";


if( $ro->getCrossMatchingResult_donor2() != "" ) {

echo "<Tr>";
echo "<Td>&nbsp;Donor2&nbsp;</tD>";
echo "<Td>&nbsp;".$ro->getCrossMatchingResult_donor2()."&nbsp;</td>";
echo "</tr>";

echo "<Tr>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;".$ro->getCrossMatchingResult_dateCollected2()."&nbsp;</td>";
echo "</tr>";

echo "<Tr>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;".$ro->getCrossMatchingResult_expiryDate2()."&nbsp;</td>";
echo "</tr>";

echo "<Tr>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;".$ro->getCrossMatchingResult_retyping2()."&nbsp;</td>";
echo "</tr>";


echo "<Tr>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;".$ro->getCrossMatchingResult_crossMatching2()."&nbsp;</td>";
echo "</tr>";

}else { }



echo "<tr>";
echo "<td>&nbsp;</tD>";
echo "</tr>";


if( $ro->getCrossMatchingResult_donor3() != "" ) {

echo "<Tr>";
echo "<Td>&nbsp;Donor3&nbsp;</tD>";
echo "<Td>&nbsp;".$ro->getCrossMatchingResult_donor3()."&nbsp;</td>";
echo "</tr>";

echo "<Tr>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;".$ro->getCrossMatchingResult_dateCollected3()."&nbsp;</td>";
echo "</tr>";

echo "<Tr>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;".$ro->getCrossMatchingResult_expiryDate3()."&nbsp;</td>";
echo "</tr>";

echo "<Tr>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;".$ro->getCrossMatchingResult_retyping3()."&nbsp;</td>";
echo "</tr>";


echo "<Tr>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;".$ro->getCrossMatchingResult_crossMatching3()."&nbsp;</td>";
echo "</tr>";

}else { }



echo "<tr>";
echo "<td>&nbsp;</tD>";
echo "</tr>";


if( $ro->getCrossMatchingResult_donor4() != "" ) {

echo "<Tr>";
echo "<Td>&nbsp;Donor4&nbsp;</tD>";
echo "<Td>&nbsp;".$ro->getCrossMatchingResult_donor4()."&nbsp;</td>";
echo "</tr>";

echo "<Tr>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;".$ro->getCrossMatchingResult_dateCollected4()."&nbsp;</td>";
echo "</tr>";

echo "<Tr>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;".$ro->getCrossMatchingResult_expiryDate4()."&nbsp;</td>";
echo "</tr>";

echo "<Tr>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;".$ro->getCrossMatchingResult_retyping4()."&nbsp;</td>";
echo "</tr>";


echo "<Tr>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;".$ro->getCrossMatchingResult_crossMatching4()."&nbsp;</td>";
echo "</tr>";

}else { }

echo "</table>";

echo "<br><Br><Br><Br>";


echo "<table  border=0>";

echo "<tr>";
echo "<TD><u>".$ro->getCrossMatchingResult_pathologist()."</u><Br><B><Center>Pathologist</center></b></tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;<u>".$ro->selectNow("registeredUser","completeName","username",$ro->getCrossMatchingResult_medtech())."</u><Br><B><Center>Medical Technologist</center></b></tD>";
echo "</tr>";
echo "</table>";




?>
