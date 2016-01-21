<?php
include("../myDatabase.php");
$patientNo = $_GET['patientNo'];
$lastname = $_GET['lastname'];
$firstname = $_GET['firstname'];
$middlename = $_GET['middlename'];
$patientContact = $_GET['patientContact'];
$month = $_GET['month'];
$day = $_GET['day'];
$birthYear = $_GET['birthYear'];
$gender = $_GET['gender'];
$seniorCitizen = $_GET['seniorCitizen'];
$philHealth = $_GET['philHealth'];
$address = $_GET['Address'];
$diagnosis = $_GET['diagnosis'];

$registrationNo = $_GET['registrationNo'];
$bloodpressure = $_GET['bloodpressure'];
$patientTemperature = $_GET['patientTemperature'];
$weight = $_GET['weight'];
$height = $_GET['height'];
$company = $_GET['company'];
$serverTime = $_GET['serverTime'];



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

if($middlename == "") {
echo "<script type='text/javascript'>";
echo "alert('Pls Enter a Middle name');";
echo "history.back();";
echo "</script>";

}

if($birthYear == "Year") {
echo "<script type='text/javascript'>";
echo "alert('Pls Enter a Birth Year');";
echo "history.back();";
echo "</script>";

}

$ro =  new database();
$completeName = $lastname." ".$firstname." ".$middlename;
$x=0;
$year = date("Y");
$x = (int)$year;
$birthDate = $month."_".$day."_".$birthYear;

$ro->addNewPatientRecord($patientNo,$lastname,$firstname,$middlename,$completeName,($x - $birthYear),$patientContact,$birthDate,$gender,$seniorCitizen,$address,$philHealth);


$ro->addNewRegistration($patientNo,$registrationNo,$bloodpressure,$patientTemperature,$height,$weight,$company,$diagnosis,date("M_d_Y"),$serverTime);

?>
