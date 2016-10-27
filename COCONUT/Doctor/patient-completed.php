<?
include "../../myDatabase.php";
include "../../myDatabase4.php";

$date = $_POST['date'];
$registrationNo = $_POST['registrationNo'];
$doctorCode = $_POST['doctorCode'];

$ro = new database();
$ro4 = new database4();

$itemNo = $ro4->get_current_doctor_not_completed($registrationNo,$doctorCode);

$ro->editNow("patientCharges","itemNo",$itemNo,"departmentStatus","Completed");
$ro->editNow("patientCharges","itemNo",$itemNo,"departmentStatus_time",date("H:i:s"));

echo "OK";

?>