<?php
include("../myDatabase.php");
$description = $_GET['description'];
$services = $_GET['services'];
$category = $_GET['category'];
$opdprice = $_GET['opdprice'];
$ipdprice = $_GET['ipdprice'];
$privateprice = $_GET['privateprice'];
$specialRates = $_GET['specialRates'];
$username = $_GET['username'];
$subCategory = $_GET['subCategory'];
$ro = new database();

$senior="";

if( $category == "LABORATORY" ) {
$senior = "yes";
}else {
$senior = "no";
}

$ro->addNewCharges($description,$services,$category,$opdprice,$ipdprice,$ipdprice,$ipdprice,$privateprice,$username,$subCategory,$ipdprice,$senior,$specialRates);


?>
