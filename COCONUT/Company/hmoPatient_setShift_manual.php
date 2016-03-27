<?php
include "../../myDatabase4.php";
$registrationNo = $_POST["registrationNo"];

$registrationNoCount = count($registrationNo);
$ro = new database4();
/*
echo $registrationNo;
echo "<br>";
echo $shift;
*/

if(!isset($_POST["shift"])) {
echo "<script>
alert('Pls Select a shift');
history.back();
</script>";
}else {
foreach($registrationNo as $x) {
$shift = $_POST["shift"];
$ro->get_hmo_charges_setShift($x,$shift);
header("Location: hmoPatient.php");
}
}
//$ro->get_hmo_charges_setShift($registrationNo,$shift);


?>