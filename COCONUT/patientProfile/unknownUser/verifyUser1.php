<?php
include("../../../myDatabase.php");
session_start();
$registrationNo = $_POST['registrationNo'];
$username = $_POST['username'];
$password = $_POST['password'];
$module = $_POST['module'];


$ro = new database();

$ro->login($username,$password,$module);

if($ro->getUserName() == $username && $ro->getUserPassword() == $password && $ro->getUserModule() == $module) {
$_SESSION['username'] = $username;
$_SESSION['registrationNo'] = $registrationNo;
$_SESSION['module'] = $module;
header("Location:/COCONUT/currentPatient/initializeProfile.php?registrationNo=$registrationNo");
/*
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/currentPatient/patientInterface1.php?registrationNo=
$registrationNo&username=$username");
*/
}else {
$ro->getBack("WRONG AUTHENTICATION");
}

?>
