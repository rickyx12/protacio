<?php
include("homeDatabase.php");
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
$module = $_POST['module'];
$from = $_POST['from'];

$logCheck = new synapse();

$logCheck->LogIn($username,$password,$module);

?>


<?php

if($module == 'MAINTENANCE' || $module == 'REGISTRATION' || $module == 'PATIENT' || $module == 'CASHIER' || $module == 'ADMIN' || $module == 'DOCTOR' || $module=='PHILHEALTH' || $module == 'HMO' || $module == 'PAYROLL' || $module == 'RECORDS' || $module == 'SUPERVISOR' || $module == "PURCHASING" || $module == "E.R" || $module == "NURSING" || $module == "OR" ) { //IF 1

if($logCheck->getUserName() == $username && $logCheck->getUserPassword() == $password) { //IF 2

if( $module == "MAINTENANCE" && ($logCheck->getUserModule() == "MAINTENANCE" || $logCheck->getUserModule() == "ADMIN") ) { //IF (MAINTENANCE)

	$_SESSION['username'] = $username;
	$_SESSION['module'] = $module;
	header("Location:/COCONUT/maintenance/initializeMaintenance.php");

}//IF (MAINTENANCE)

else if( $module == "PATIENT" && ($logCheck->getUserModule() == "PATIENT" || $logCheck->getUserModule() == "ADMIN") ) { //IF (PATIENT)
	session_regenerate_id();
	$_SESSION['employeeID'] = $logCheck->getUserEmployeeID();
	$_SESSION['username'] = $username;
	$_SESSION['module'] = $module;
	session_write_close();
	header("Location:/COCONUT/currentPatient/initializePatient.php?username=$username");

} //IF (PATIENT)

else if( $logCheck->getUserModule() == "PURCHASING" ) {
	$_SESSION['employeeID'] = $logCheck->getUserEmployeeID();
	header("Location: /COCONUT/purchasing/purchasingMainpage.php");
}

else if( $logCheck->getUserModule() == "E.R" ) {
	$_SESSION['employeeID'] = $logCheck->getUserEmployeeID();
	header("Location: /COCONUT/ER/erMainpage.php");
}

else if( $logCheck->getUserModule() == "NURSING" ) {
	$_SESSION['employeeID'] = $logCheck->getUserEmployeeID();
	header("Location: /COCONUT/NURSING/nursingMainpage.php");
}

else if( $logCheck->getUserModule() == "OR" ) {
	$_SESSION['employeeID'] = $logCheck->getUserEmployeeID();
	header("Location: /COCONUT/OR/orMainpage.php");
}

else if( $module == "PHILHEALTH" && ($logCheck->getUserModule() == "PHILHEALTH" || $logCheck->getUserModule() == "ADMIN") ) { //IF (PHILHEALTH)

	$_SESSION['username'] = $username;
	$_SESSION['module'] = $module;
	header("Location:/COCONUT/currentPatient/initializePatient.php?username=$username");

} //IF (PHILHEALTH)


else if( $module == "SUPERVISOR" && ($logCheck->getUserModule() == "SUPERVISOR" || $logCheck->getUserModule() == "ADMIN") ) { //IF (PHILHEALTH)

	$_SESSION['username'] = $username;
	$_SESSION['module'] = $module;
	header("Location:/COCONUT/currentPatient/initializePatient.php?username=$username");

} //IF (PHILHEALTH)


else if( $module == "RECORDS") { //IF (RECORDS)
	session_regenerate_id();
	$_SESSION['employeeID'] = $logCheck->getUserEmployeeID();
	$_SESSION['username'] = $username;
	$_SESSION['module'] = $module;
	session_write_close();
	header("Location:/COCONUT/currentPatient/initializePatient.php?username=$username");

} //IF (RECORDS)



else if( $module == "HMO" ) { //IF (HMO)

	$_SESSION['username'] = $username;
	$_SESSION['module'] = $module;
	header("Location:/COCONUT/currentPatient/initializePatient.php?username=$username");

} //IF (HMO)



else if( $module == "CASHIER" && ($logCheck->getUserModule() == "CASHIER" || $logCheck->getUserModule() == "ADMIN") ) { //IF (CASHIER)

	session_regenerate_id();
	$_SESSION['employeeID'] = $logCheck->getUserEmployeeID();
	$_SESSION['username'] = $username;
	$_SESSION['module'] = $module;
	session_write_close();
	header("Location:/COCONUT/Cashier/initializeCashier.php");

} //IF (CASHIER)


else if($module == "ADMIN") { //IF (ADMIN)
session_regenerate_id();
$_SESSION['employeeID'] = $logCheck->getUserEmployeeID();
$_SESSION['username'] = $username;
$_SESSION['module'] = $module;
session_write_close();
header("Location:/COCONUT/ADMIN/initializeAdmin.php");
exit();


} //IF (ADMIN)


else if($module == "PAYROLL") { //IF (ADMIN)

	$_SESSION['username'] = $username;
	$_SESSION['module'] = $module;
	header("Location:/COCONUT/payroll/initializePayroll.php");


} //IF (ADMIN)


	else if($module == "DOCTOR") { //IF (DOCTOR)
	session_regenerate_id();
	$_SESSION['employeeID'] = $logCheck->getUserEmployeeID();
	$_SESSION['username'] = $username;
	$_SESSION['module'] = $module;
	session_write_close();
	header("Location:/COCONUT/Doctor/initializeDoctor.php");

} //IF (DOCTOR)


}/* IF 2 */ 
else { //ELSE 1

	echo "<script type='text/javascript'>";
	echo "alert('Authentication Error');";
	echo "window.back(-1)";
	echo "</script>";

} // ELSE 1

} /* IF 1 */

else { // ELSE

if($logCheck->getUserName() == $username && $logCheck->getUserPassword() == $password && ($logCheck->getUserModule() == $module || $logCheck->getUserModule() == "ADMIN" ) ) {
	session_regenerate_id();
	$_SESSION['employeeID'] = $logCheck->getUserEmployeeID();
	$_SESSION['username'] = $username;
	$_SESSION['module'] = $module;
	$_SESSION['from'] = $from;
	session_write_close();
	header("Location:/Department/initializeDepartment.php");

}else {

	echo "<script type='text/javascript'>";
	echo "alert('Authentication Error');";
	echo "window.back(-1)";
	echo "</script>";

}
 }//END OF ELSE


?>
