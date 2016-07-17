<?php
include("../../myDatabase2.php");
$manual_patientNo=$_GET['manual_patientNo'];
$manual_registrationNo=$_GET['manual_registrationNo'];
$pxCount=$_GET['pxCount'];
$patientNo = $_GET['patientNo'];
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$gender = $_GET['gender'];
$lastname = $_GET['lastname'];
$firstname = $_GET['firstname'];
$middlename = $_GET['middlename'];
$age = $_GET['age'];
$civilStatus = $_GET['civilStatus'];
//$birthdate = $_GET['birthdate'];

$bdayMonth = $_GET['bdayMonth'];
$bdayDay = $_GET['bdayDay'];
$bdayYear = $_GET['bdayYear'];
//$birthdate = $bdayMonth."_".$bdayDay."_".$bdayYear;
$birthdate = $bdayYear."-".$bdayMonth."-".$bdayDay;
$mothersName = $_GET['mothersName'];
$fathersName = $_GET['fathersName'];
$contactNo = $_GET['contactNo'];
$senior = $_GET['senior'];
$PhilHealth = $_GET['PhilHealth'];
$diet = $_GET['diet'];
$company = $_GET['company'];
$typeCase = $_GET['typeCase'];
$timeRegistered = $_GET['timeRegistered'];
$dateRegistered = $_GET['dateRegistered'];
$branchRegistered = $_GET['branchRegistered'];
$address = $_GET['address'];
$type = $_GET['type'];
$room = $_GET['room'];
$timeUnregistered = $_GET['timeUnregistered'];
$dateUnregistered = $_GET['dateUnregistered'];
$casetype = $_GET['casetype'];
$cashLimit = $_GET['cashLimit'];
$hmoLimit = $_GET['hmoLimit'];
$incrementalCost = $_GET['incrementalCost'];
$package = $_GET['package'];
$pinNo = $_GET['pinNo'];
$seniorNo = $_GET['seniorNo'];


if( isset($_GET['CashLIMIT']) ) {
$CashLIMIT = $_GET['CashLIMIT'];
}else { }

$ro = new database2();

$ro->getPatientProfile($registrationNo);


//if($ro->selectNow("registeredUser","module","username",$username) == "CASHIER" && $discount > $ro->getReportInformation("cashierDisc") ) {
//$ro->getBack("Sorry,You put a discount that is higher to your allowable discount which is".$ro->getReportInformation("cashierDisc"));
//}else {
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"incrementalCost",$incrementalCost);
//}

$ro->editCompleteName($patientNo,$lastname." ".$firstname." ".$middlename);
$ro->editLastName($patientNo,$lastname);
$ro->editFirstName($patientNo,$firstname);
$ro->editMiddleName($patientNo,$middlename);
$ro->editAge($patientNo,$age);
$ro->editCivilStatus($patientNo,$civilStatus);
$ro->editBirthDate($patientNo,$birthdate);
$ro->editContactNo($patientNo,$contactNo);
$ro->editSenior($patientNo,$senior);
$ro->editPHIC($patientNo,$PhilHealth);
//$ro->editCompany($patientNo,$company);
//$ro->editTimeRegistered($patientNo,$timeRegistered);
//$ro->editDateRegistered($patientNo,$dateRegistered);
$ro->editAddress($patientNo,$address);

$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"pxCount",$pxCount);
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"Company",$company);
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"manual_registrationNo",$manual_registrationNo);
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"manual_patientNo",$manual_patientNo);
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"dateRegistered",$dateRegistered);
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"timeRegistered",$timeRegistered);
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"branch",$branchRegistered);
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"type",$type);
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"PIN",$pinNo);
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"dateUnregistered",$dateUnregistered);
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"timeUnregistered",$timeUnregistered);
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"casetype",$casetype);
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"LimitCASH",$cashLimit);
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"LimitHMO",$hmoLimit);
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"package",$package);
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"privateORhouse_case",$typeCase);
$ro->editNow("patientRecord","patientNo",$patientNo,"manual_patientNo",$manual_patientNo);
$hmoType = $ro->selectNow("Company","type","companyName",$company);
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"companyType",$hmoType);
if( isset($_GET['CashLIMIT']) ) {
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"LimitCASH",$CashLIMIT);
}else { }
$ro->EditNow("patientRecord","patientNo",$patientNo,"gender",$gender);
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"diet",$diet);
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"seniorID",$seniorNo);
$ro->EditNow("patientRecord","patientNo",$ro->getRegistrationDetails_patientNo(),"mothersName",$mothersName);
$ro->EditNow("patientRecord","patientNo",$ro->getRegistrationDetails_patientNo(),"fathersName",$fathersName);




if($type == "OPD") { // kung opd ang type
$ro->EditNow("room","Description",$room,"status","Vacant"); // gwen vacant ang room bago pa mag update as opd
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"room","OPD_OPD"); //set room as opd
//$ro->deleteRoom($registrationNo);
$ro->removeRoom($registrationNo,$username);
}else if($type == "ER") {
$ro->EditNow("room","Description",$room,"status","Vacant"); // gwen vacant ang room bago pa mag update as opd
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"room","ER_ER"); //set room as er
//$ro->deleteRoom($registrationNo);
$ro->removeRoom($registrationNo,$username);
}else if($type == "OR/DR") {
$ro->EditNow("room","Description",$room,"status","Vacant"); // gwen vacant ang room bago pa mag update as opd
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"room","OR/DR_OR/DR"); //set room as or/dr
//$ro->deleteRoom($registrationNo);
$ro->removeRoom($registrationNo,$username);
}else {

/*
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"room",$room);


if($room != $ro->getRegistrationDetails_room()) {

if($ro->getRegistrationDetails_room() == "OPD_OPD" || $ro->getRegistrationDetails_room() == "ER_ER" || $ro->getRegistrationDetails_room() == "OR/DR_OR/DR") {
echo ""; //STAND BY... wLang ggWen
}else {
//ADD CHARGES AS ROOM


$timezone = "Asia/Manila";
date_default_timezone_set ($timezone);

$ro->deleteNow("patientCharges","title","Room And Board"); // delete original room ... incase nag transfer ng ibang room
$ro->getRoom($room); // source of data pra sa room... pra makuha ung rate ng room from the masterfile


$ro->addCharges_cash("UNPAID",$registrationNo,$room,$room,$ro->room_rate(),0,$ro->room_rate(),$ro->room_rate(),0,0,date("H:i:s"),date("M_d_Y"),$username,"Confinement","Room And Board","Cash",0,"",1,"",$branchRegistered,""); //add room 
$ro->EditNow("room","Description",$room,"status","Occupied"); // gwen occupied ang room 
*/



}





echo "
<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientProfile_handler.php?registrationNo=$registrationNo&username=$username';
</script>

";





//RELOAD PAGE PRA MWLA UNG PhilHealth Menu sa may patient profile
/*
echo "
<script type='text/javascript'>
window.parent.location.reload();
</script>";
*/

?>
