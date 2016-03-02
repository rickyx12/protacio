<?php
session_start();
include("../myDatabase.php");


$patientNo = $_POST['patientNo'];
$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$patientContact = $_POST['patientContact'];
$month = $_POST['month'];
$day = $_POST['day'];
$birthYear = $_POST['birthYear'];
$gender = $_POST['gender'];
$seniorCitizen = $_POST['seniorCitizen'];
$philHealth = $_POST['philHealth'];
$address = $_POST['Address'];
$diagnosis = $_POST['diagnosis'];
$civilStatus = $_POST['civilStatus'];

$registrationNo = $_POST['registrationNo'];
$bloodpressure = $_POST['bloodpressure'];
$patientTemperature = $_POST['patientTemperature'];
$weight = $_POST['weight'];
$height = $_POST['height'];
$company = $_POST['company'];
$serverTime = $_POST['serverTime'];
$registrationStatus = $_POST['registrationStatus'];
$room = $_POST['room'];
$casetype = $_POST['casetype'];
$attendingDoctor = $_POST['attendingDoctor'];
$admittingDoctor = $_POST['admittingDoctor'];
$religion = $_POST['religion'];
$password = $_POST['password'];

$dateRegistered = $_POST['dateRegistered'];
$diet = $_POST['diet'];

$pulse = $_POST['pulse'];
$respiratory = $_POST['respiratory'];
$from = $_POST['from'];
$manual_patientID = $_POST['manual_patientID'];
$manual_caseno = $_POST['manual_caseno'];
$pxCount = $_POST['pxCount'];
$email = $_POST['email'];

$ro = new database();

$ro->getAuthorizedRegistrar($password);

if($ro->getUserRegistrar() == "REGISTRATION" || $ro->getUserRegistrar() == "PHARMACY" || $ro->getUserRegistrar() == "CASHIER" || $ro->getUserRegistrar() == "LABORATORY" || $ro->getUserRegistrar() == "ER" || $ro->getUserRegistrar() == "RADIOLOGY" ) { //IF 1

if($lastname == "") {
echo "<script type='text/javascript'>";
echo "alert('Pls Enter a Last name');";
echo "history.back();";
echo "</script>";

}

if($firstname == "") {
echo "<script type='text/javascript'>";
echo "alert('Pls Enter a First name');";
echo "history.back();";
echo "</script>";

}
/*
if($middlename == "") {
echo "<script type='text/javascript'>";
echo "alert('Pls Enter a Middle name');";
echo "history.back();";
echo "</script>";

}
*/
if($birthYear == "Year") {
echo "<script type='text/javascript'>";
echo "alert('Pls Enter a Birth Year');";
echo "history.back();";
echo "</script>";

}

if($company == "Select Company") {
$company = "";
}

$completeName = $lastname." ".$firstname." ".$middlename;
$x=0;
$year = date("Y");
$x = (int)$year;
$birthDate = $birthYear."-".$month."-".$day;


try {
$incrementRegNo = ($ro->selectNow("trackingNo","value","name","registrationNo") + 1);
$incrementPatNo = ($ro->selectNow("trackingNo","value","name","patientNo") + 1);
$ro->editNow("trackingNo","name","registrationNo","value",$incrementRegNo);
$ro->editNow("trackingNo","name","patientNo","value",$incrementPatNo);

if($registrationStatus == "new") { // Registration Status [new]

$ro->addNewPatientRecord($patientNo,$manual_patientID,$lastname,$firstname,$middlename,$completeName,$ro->calculate_age($birthDate),$patientContact,$birthDate,$gender,$seniorCitizen,$address,$philHealth,$civilStatus,$religion,$email);

if($room == "OPD") {
$ro->addNewRegistration($patientNo,$registrationNo,$manual_patientID,$manual_caseno,$bloodpressure,$patientTemperature,$height,$weight,$company,$diagnosis,$dateRegistered,$serverTime,$ro->getUserBranch($password),"OPD","OPD_OPD",$ro->getUserRegistered(),$casetype,"2000",date("Y-m-d"),$diet,$pulse,$respiratory,$from,$pxCount);
}else if( $room == "walkin" ) {
$ro->addNewRegistration($patientNo,$registrationNo,$manual_patientID,$manual_caseno,$bloodpressure,$patientTemperature,$height,$weight,$company,$diagnosis,$dateRegistered,$serverTime,$ro->getUserBranch($password),"walkin","walkin_walkin",$ro->getUserRegistered(),$casetype,"2000",date("Y-m-d"),$diet,$pulse,$respiratory,$from,$pxCount);
}else {
$ro->addNewRegistration($patientNo,$registrationNo,$manual_patientID,$manual_caseno,$bloodpressure,$patientTemperature,$height,$weight,$company,$diagnosis,$dateRegistered,$serverTime,$ro->getUserBranch($password),"IPD",$room,$ro->getUserRegistered(),$casetype,"2000",date("Y-m-d"),$diet,$pulse,$respiratory,$from,$pxCount);

$timezone = "Asia/Manila";
date_default_timezone_set ($timezone);

//ADD ROOM
$ro->EditNow("room","Description",$room,"status","Occupied");//GWEN OCCUPIED ANG STATUS NG ROOM
$ro->getRoom($room); 
$ro->addCharges_cash("UNPAID",$registrationNo,$room,$room,$ro->room_rate(),0,$ro->room_rate(),$ro->room_rate(),0,0,$serverTime,$dateRegistered,$ro->getUserRegistered(),"Confinement","Room And Board","Cash",0,"",1,"",$ro->getUserBranch($password),"");

}

} // Registration Status [new]
else {  // Registration Status [old]

$ro->editNow("patientRecord","patientNo",$patientNo,"Age",$ro->calculate_age($birthDate));
$ro->editNow("patientRecord","patientNo",$patientNo,"email",$email);

if($room == "OPD") {
$ro->addNewRegistration($patientNo,$registrationNo,$manual_patientID,$manual_caseno,$bloodpressure,$patientTemperature,$height,$weight,$company,$diagnosis,$dateRegistered,$serverTime,$ro->getUserBranch($password),"OPD","OPD_OPD",$ro->getUserRegistered(),$casetype,"2000",date("Y-m-d"),$diet,$pulse,$respiratory,$from,$pxCount);
}else if($room == "walkin") {
$ro->addNewRegistration($patientNo,$registrationNo,$manual_patientID,$manual_caseno,$bloodpressure,$patientTemperature,$height,$weight,$company,$diagnosis,$dateRegistered,$serverTime,$ro->getUserBranch($password),"walkin","walkin_walkin",$ro->getUserRegistered(),$casetype,"2000",date("Y-m-d"),$diet,$pulse,$respiratory,$from,$pxCount);
}else {
$ro->addNewRegistration($patientNo,$registrationNo,$manual_patientID,$manual_caseno,$bloodpressure,$patientTemperature,$height,$weight,$company,$diagnosis,$dateRegistered,$serverTime,$ro->getUserBranch($password),"IPD",$room,$ro->getUserRegistered(),$casetype,"2000",date("Y-m-d"),$diet,$pulse,$respiratory,$from,$pxCount);

$timezone = "Asia/Manila";
date_default_timezone_set ($timezone);

//ADD ROOM
$ro->EditNow("room","Description",$room,"status","Occupied");//GWEN OCCUPIED ANG STATUS NG ROOM
$ro->getRoom($room); 
$ro->addCharges_cash("UNPAID",$registrationNo,$room,$room,$ro->room_rate(),0,$ro->room_rate(),$ro->room_rate(),0,0,$serverTime,$dateRegistered,$ro->getUserRegistered(),"Confinement","Room And Board","Cash",0,"",1,"",$ro->getUserBranch($password),"");

//ADD ATTENDING AND ADMITTING DOCTOR


}

$ro->editNow("patientRecord","patientNo",$patientNo,"lastName",$lastname);
$ro->editNow("patientRecord","patientNo",$patientNo,"firstName",$firstname);
$ro->editNow("patientRecord","patientNo",$patientNo,"middleName",$middlename);
$ro->editNow("patientRecord","patientNo",$patientNo,"contactNo",$patientContact);
$ro->editNow("patientRecord","patientNo",$patientNo,"Birthdate",$birthDate);
$ro->editNow("patientRecord","patientNo",$patientNo,"Gender",$gender);
$ro->editNow("patientRecord","patientNo",$patientNo,"Senior",$seniorCitizen);
$ro->editNow("patientRecord","patientNo",$patientNo,"Address",$address);
$ro->editNow("patientRecord","patientNo",$patientNo,"PHIC",$philHealth);
$ro->editNow("patientRecord","patientNo",$patientNo,"civilStatus",$civilStatus);
$ro->editNow("patientRecord","patientNo",$patientNo,"phicType",$phicType);
$ro->editNow("patientRecord","patientNo",$patientNo,"completeName",$completeName);
} // Registration Status [old]


session_regenerate_id();
$_SESSION['employeeID'] = $ro->getUserRegistrarEmployeeID();
$_SESSION['username'] = $ro->getUserRegistered(); 
$_SESSION['registrationNo'] = $registrationNo;
session_write_close();
header("Location: /Registration/patient.php?registrationNo=$registrationNo&username=".$ro->getUserRegistered()."");
/*
echo "
<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/Registration/patient.php?registrationNo=$registrationNo&username=".$ro->getUserRegistered()."';
</script>
";
*/
}catch(Exception $e) {
echo "
<script type='text/javascript'>
window.back();
</script>

";
}



} //IF 1
else { //ELSE 1
echo "
<script type='text/javascript'>
alert('WRONG AUTHENTICATION');
history.back();
</script>

";
} //ELSE 1




?>
