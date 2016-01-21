<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$caserate = $_GET['caserate'];
$ro = new database2();
$ro->coconutDesign();


echo "<Br><Br><br>";

$caseRate_amount = $ro->selectNow("rBanny_caserate","amount","caseNo",$caserate);//amount ng selected caserate
$hospitalBill = ( $ro->getTotal("total","Room And Board",$registrationNo) + $ro->getTotal("total","MEDICINE",$registrationNo) + $ro->getTotal("total","SUPPLIES",$registrationNo) + $ro->getTotal("total","LABORATORY",$registrationNo) + $ro->getTotal("total","RADIOLOGY",$registrationNo) + $ro->getTotal("total","NURSING-CHARGES",$registrationNo) + $ro->getTotal("total","MISCELLANEOUS",$registrationNo) + $ro->getTotal("total","OR/DR/ER Fee",$registrationNo) + $ro->getTotal("total","OXYGEN",$registrationNo) );
$pf = $ro->getTotal("phic","PROFESSIONAL FEE",$registrationNo);
$targetAmount = ($caseRate_amount - ($caseRate_amount *0.30) );


echo "<Center>";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/rBanny/approximate_noReset.php?registrationNo=$registrationNo&caserate=$caserate' style='text-decoration:none;'><font color='blue' size=5><i>[R-Banny]</i></font></a>";
$ro->coconutBoxStart("500","130");
echo "<br><font color=red size=4>Caserate</font>:&nbsp;".$ro->selectNow("rBanny_caserate","caserate","caseNo",$caserate)."&nbsp;[".number_format($caseRate_amount,2)."]";
echo "<br>";
echo "<font color=red size=4>Hospital Bill:&nbsp;</font>".number_format($hospitalBill,2);
echo "<Br>";
echo "<font color=red size=4>Professional Fee:&nbsp;</font>".number_format($pf,2);
echo "<Br>";
$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/rBanny/analyzingData.php");
//$cazeRate = $ro->selectNow("availableICD","hospital","icdCode",$ro->selectNow("patientICD","icdCode","registrationNo",$registrationNo));

if( $ro->selectNow("availableICD","icdCode","icdCode",$ro->selectNow("registrationDetails","casetype","registrationNo",$registrationNo)) != "" ) {
echo "<i><font color=blue size=4>Target Amount:&nbsp;</font></i><br>".$ro->coconutTextBox_return("targetAmount",$ro->selectNow("availableICD","hospital","icdCode",$ro->selectNow("registrationDetails","casetype","registrationNo",$registrationNo)));
}else {
echo "<i><font color=blue size=4>Target Amount:&nbsp;</font></i><br>".$ro->coconutTextBox_return("targetAmount",$ro->selectNow("availableICD","hospital","rvsCode",$ro->selectNow("registrationDetails","casetype","registrationNo",$registrationNo)));
}


echo "<br><Br>";


//$ro->coconutHidden("targetAmount",$targetAmount);
$ro->coconutHidden("cash", $ro->getTotal("cashUnpaid","",$registrationNo) );
$ro->coconutHidden("registrationNo",$registrationNo);
if( $hospitalBill > $targetAmount ) {
$ro->coconutButton("Proceed");
}else {
//echo "<Br><font size=4 color=red>R-Banny Cannot analyze you're data because Target Amount is Higher [".number_format($targetAmount,2)."] than the Patient's Bill [".number_format($hospitalBill,2)."] </font>";
}
$ro->coconutFormStop();
$ro->coconutBoxStop();

?>
