<?php
include("../myDatabase.php");
$remitted = $_GET['departmentStatus'];
$username = $_GET['username'];
$quantity = $_GET['quantity'];
$batchNo = $_GET['batchNo'];
$dispensed = $_GET['dispensed'];
$countz = count($remitted);
$qty = count($quantity);
$disp = count($dispensed);


$ro = new database();

$ro->getDispensedNo();
$myFile = $ro->getReportInformation("homeRoot")."/COCONUT/trackingNo/dispensedNo.dat";
$fh = fopen($myFile, 'r');
$dispensedNo = fread($fh, 100);
fclose($fh);


$timezone = "Asia/Manila";
date_default_timezone_set ($timezone);


for($i=0,$g=0;$i<$countz,$g<$qty;$i++,$g++) {//FOR LOOP
if($ro->checkInventory($remitted[$i]) == "PHARMACY" || $ro->checkInventory($remitted[$i]) == "CSR") {

if($ro->getChargesStatus($remitted[$i]) != "Return") {

if( $ro->selectNow("patientCharges","dispensedNo","itemNo",$remitted[$i]) == "" ) {
$ro->remitNow($remitted[$i],"dispensedBy_".$username);
$ro->editNow("patientCharges","itemNo",$remitted[$i],"departmentStatus_time",date("H:i:s"));
$ro->editNow("patientCharges","itemNo",$remitted[$i],"dispenseFlag","dispense");
$ro->editNow("patientCharges","itemNo",$remitted[$i],"dispenseQTY",$quantity[$g]);
//MAGBBWAS SA QUANTITY NG CURRENT INVENTORY 

$ro->changeQTY($ro->getChargesCode($remitted[$i]),  $ro->getCurrentQTY( $ro->getChargesCode($remitted[$i])) - $quantity[$g]  );

/*
if( $ro->selectNow("inventory","quantity","inventoryCode",$ro->getChargesCode($remitted[$i]) ) < 1 ) {
$ro->insertInventoryZero( $ro->selectNow("patientCharges","chargesCode","itemNo",$remitted[$i]) ,$ro->selectNow("patientCharges","description","itemNo",$remitted[$i]),$ro->getSynapseTime(),date("Y-m-d"),$username,$ro->selectNow("patientCharges","registrationNo","itemNo",$remitted[$i]),$remitted[$i]);
}else { }
*/
}else {
//echo "<font color=red>the meds/Supplies is allready dispensed</font><Br><br><Br>";
}


//echo $ro->getChargesCode($remitted[$i])."_".$remitted[$i];
//echo $quantity;
}




else {


$ro->changeQTY($ro->getChargesCode($remitted[$i]),($ro->getCurrentQTY($ro->getChargesCode($remitted[$i])) + $quantity[$g]) );
$deptStatus = preg_split ("/\_/", $ro->getDepartmentStatus($remitted[$i])); 

if($ro->getPatientChargesQTY($remitted[$i]) == $deptStatus[0] ) {
//$ro->deletePatientCharges($deptStatus[1],$remitted[$i]); // DELETE CHARGES IF ALL WILL RETRUN
$ro->editNow("patientCharges","itemNo",$remitted[$i],"status","DELETED_".$username); //instead n delete tLGa i-tag nLang as Deleted so i can track who deleted the meds/sup.
$ro->editNow("patientCharges","itemNo",$remitted[$i],"departmentStatus","dispensedBy_".$username);//pra mwLa sa pharmacy ung name ng px
}else if($ro->getPatientChargesQTY($remitted[$i]) != $deptStatus[0]) {
$ro->editNow("patientCharges","itemNo",$remitted[$i],"quantity",$ro->getPatientChargesQTY($remitted[$i]) - $deptStatus[0]); //change qty
$ro->editNow("patientCharges","itemNo",$remitted[$i],"total",($ro->selectNow("patientCharges","sellingPrice","itemNo",$remitted[$i]) * $ro->selectNow("patientCharges","quantity","itemNo",$remitted[$i]) )); // change total
$ro->editNow("patientCharges","itemNo",$remitted[$i],"status","PAID");
$ro->editNow("patientCharges","itemNo",$remitted[$i],"departmentStatus","dispensedBy_".$username);
$ro->editNow("patientCharges","itemNo",$remitted[$i],"departmentStatus_time",date("H:i:s"));
}else { }


}

$registrationNo = $ro->selectNow("patientCharges","registrationNo","itemNo",$remitted[$i]); //kunin ang registrationNo via itemNo
$batchNo1 = $batchNo;
}







else {//ELSE
$ro->editNow("patientCharges","itemNo",$remitted[$i],"departmentStatus","remittedBy_".$username);
$ro->editNow("patientCharges","itemNo",$remitted[$i],"departmentStatus_time",date("H:i:s"));
$registrationNo = $ro->selectNow("patientCharges","registrationNo","itemNo",$remitted[$i]); //kunin ang registrationNo via itemNo
$batchNo1 = $batchNo;
}//ELSE
//header("Location: http://".$ro->getMyUrl()."/Department/dispensed.php?registrationNo=$registrationNo&dispensed=$disp[$x]");
}//FOR LOOP

//selectNow($table,$cols,$identifier,$identifierData)

//header("Location: http://".$ro->getMyUrl()."/Department/dispensed.php?registrationNo=$registrationNo&dispensed=$dispensed");


$ro->getPatientProfile($registrationNo);
////selectNow($table,$cols,$identifier,$identifierData)
if( $ro->selectNow("registeredUser","module","username",$username) == "PHARMACY" ) {
?>

<script type="text/javascript">
function printF(printData)
{
	var a = window.open ('',  '',"status=1,scrollbars=1, width=600,height=650");
	a.document.write(document.getElementById(printData).innerHTML.replace(/<a\/?[^>]+>/gi, ''));
	a.document.close();
	a.focus();
	a.print();
	a.close();
}
</script>
<a href='#' onClick="printF('printData')" style="text-decoration:none;"><?php echo $ro->coconutImages("printer.jpeg") ?> <font color=red>Print</font></a><Br><Br>
<?
echo "<div id='printData'>";
echo "Reg#:&nbsp;".$registrationNo."&nbsp;&nbsp;&nbsp;&nbsp;Batch#:&nbsp;".$dispensedNo;
echo "<br>";
echo "Name:&nbsp;".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName();
echo "<br>";
echo "PHIC:".$ro->getPatientRecord_phic()." + ".$ro->getRegistrationDetails_company();
echo "<br>";
echo "Date".date("M d, Y")." @ ".$ro->getSynapseTime();
echo "<Br>";
echo "Room:".$ro->getRegistrationDetails_room();
echo "<br>";
echo "Pharmacy:".$username;
echo "<br>";
echo "Doctor:".$ro->getAttendingDoc($registrationNo,"Attending");
echo "<table border=1 cellpadding=1 cellspacing=1>";
echo "<tr>";
echo "<th>Particulars</th>";
echo "<th>QTY</th>";
echo "</tr>";

for( $x=0,$z=0;$x<$disp,$z<$countz;$x++,$z++ ) {


if( $ro->selectNow("patientCharges","dispensedNo","itemNo",$remitted[$z]) == "" ) {
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"itemNo",$remitted[$z],"dispensedNo",$dispensedNo);
}else { }
echo "<Tr>";
$dispense = preg_split ("/\_/", $dispensed[$x]); 
if( $ro->selectNow("patientCharges","status","itemNo",$remitted[$z]) == "PAID" ) {
echo "<tD><b>(Pd)</b>&nbsp;".$dispense[1]."&nbsp;</td>";
}else {
echo "<tD>&nbsp;".$dispense[1]."&nbsp;</td>";
}
echo "<tD>&nbsp;".$dispense[2]."&nbsp;</td>";
echo "</tr>";
echo "</div>";
//echo $dispensed[$x];



}


}//ENDS NG PHARMACY

else {
echo "<b>Name:</b>&nbsp;".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName();
echo "<br>";
echo "<b>Age/Sex:</b>&nbsp;".$ro->getPatientRecord_age()."/".$ro->getPatientRecord_gender();
echo "<Br>";
echo "<b>D.O.B:</b>&nbsp;".$ro->getPatientRecord_Birthdate();
echo "<br>";
echo "<b>WARD:</b>&nbsp;".$ro->getRegistrationDetails_room();
echo "<br>";
echo "<b>Physician:</b>&nbsp;".$ro->getAttendingDoc($registrationNo,"Attending");
echo "<br>";
echo "<b>Diagnosis:</b>&nbsp;".$ro->getRegistrationDetails_IxDx();

echo "<Br><Br>";

for( $x=0,$z=0;$x<$disp,$z<$countz;$x++,$z++ ) {

$dispense = preg_split ("/\_/", $dispensed[$x]); 
echo $dispense[1]."<br>";
//echo $dispensed[$x];
//echo "<Br><Br><br><br><br><Br>&nbsp;<a href='http://".$ro->getMyUrl()."/COCONUT/Laboratory/unremit.php?itemNo=$rmt&username=$username'>Unremit</a>";
}


}


/*
for( $x=0;$x<$disp;$x++ ) {
echo "<Tr>";
$dispense = preg_split ("/\_/", $dispensed[$x]); 
echo "<tD>&nbsp;".$dispense[1]."&nbsp;</td>";
echo "<tD>&nbsp;".$dispense[2]."&nbsp;</td>";
echo "</tr>";

//echo $dispensed[$x];
}
*/


echo "</table>";


//echo "<script type='text/javascript'>";

//echo "</script>";

?>
