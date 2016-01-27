<?php
include("../../myDatabase2.php");

$username = $_POST['username'];
$referenceNo = $_POST['referenceNo'];
$description = $_POST['description'];
$qty = $_POST['qty'];
$dateIn = $_POST['dateIn'];
$permanentReference_selection = $_POST['permanentReference_selection'];
$permanentReference_input = $_POST['permanentReference_input'];


$ro = new database2();

if( $permanentReference_input != "" && $permanentReference_selection != "" ) {

echo "<script> alert('Pls input only one in the permanent'); history.back(-1); </script>";

}else {
if( $permanentReference_selection != "" ) {
$ro->addReagents($referenceNo,$description,$qty,$dateIn,$username,$permanentReference_selection);
}else {
$ro->addReagents($referenceNo,$description,$qty,$dateIn,$username,$permanentReference_input);
}
}

?>
