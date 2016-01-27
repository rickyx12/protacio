<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$description = $_GET['description'];
$quantity = $_GET['quantity'];
$username = $_GET['username'];
$show = $_GET['show'];
$desc = $_GET['desc'];
$reason = $_GET['reason'];
$staff_username = $_GET['staff_username'];
$staff_password = $_GET['staff_password'];

$ro = new database();

$ro->deletePass($staff_username,$staff_password);

if($ro->deletePass_username() == $staff_username && $ro->deletePass_password() == $staff_password  ) {
$ro->requestDeletion($itemNo,$registrationNo,$description,$quantity,$username,$show,$desc,$reason,$staff_username);
}else {
$ro->getBack("Authentication Error");
}


?>
