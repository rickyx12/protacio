<?
require_once "../authentication.php";
include "../../myDatabase.php";
$ro = new database();

$inventoryCode = $_POST['inventoryCode'];

foreach($inventoryCode as $code) {
	$ro->editNow("inventory","inventoryCode",$code,"status","DELETED_".date("Y-m-d")."_".$ro->selectNow("registeredUser","username","employeeID",$_SESSION['employeeID']));
}

header("Location: non-invoice.php");


?>