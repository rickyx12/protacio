<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$username = $_GET['username'];
$ro = new database2();

$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/android/doctor/mobileSOAP1.php");
$ro->coconutHidden("itemNo",$itemNo);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("registrationNo",$registrationNo);
echo "<div style='background:#47a3da; margin:0 0 0 10px; height:550px; width:500px; border-radius:15px;'>";
echo "<Center>";
echo "<br>";
echo "&nbsp;<b><i><font color='white'>Subjective</font></i></b>";
echo "<br>";
echo "<textarea name='subjective' rows='5' cols='54'>".$ro->selectNow("SOAP","subjective","itemNo",$itemNo)."</textarea>";

echo "<br>";
echo "&nbsp;<b><i><font color='white'>Objective</font></i></b>";
echo "<br>";
echo "<textarea name='objective' rows='5' cols='54'>".nl2br($ro->selectNow("SOAP","objective","itemNo",$itemNo))."</textarea>";

echo "<br>";
echo "&nbsp;<b><i><font color='white'>Assessment</font></i></b>";
echo "<br>";
echo "<textarea name='assessment' rows='5' cols='54'>".nl2br($ro->selectNow("SOAP","assessment","itemNo",$itemNo))."</textarea>";

echo "<br>";
echo "&nbsp;<b><i><font color='white'>Plan</font></i></b>";
echo "<br>";
echo "<textarea name='plan' rows='5' cols='54'>".nl2br($ro->selectNow("SOAP","plan","itemNo",$itemNo))."</textarea>";


echo "<Br><br>";
echo "<input type='submit' style='borde:1px round #000;' value='Proceed'>";


/*
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("itemNo",$itemNo);
echo "<input type='submit' style='background:#47a3da; color:white; border:0px; font-size:19px; font-weight:bold;' value='Add Charges'>";
$ro->coconutFormStop();
if( $ro->selectNow("doctorsPlan","registrationNo","registrationNo",$registrationNo) != "" ) {

echo "<div style='width:395px; margin:0 0 0 5px; height:auto; font-size:12px; border:1px solid #000; background:#FFF;' readonly>
".$ro->doctorsMedicinePlan_SOAP_returns($registrationNo)."
".$ro->showAdvisedIn_SOAP_returns($registrationNo)."
,
".$ro->showAdvisedFromCharges($registrationNo)."
</div>";

}else {
echo "<div style='width:395px; margin:0 0 0 5px; height:auto; font-size:12px; border:1px solid #000; background:#FFF;' readonly>
".$ro->showAdvisedIn_SOAP_returns($registrationNo)."
,
".$ro->showAdvisedFromCharges($registrationNo)."
</div>";
}
*/
echo "</div>";

?>
