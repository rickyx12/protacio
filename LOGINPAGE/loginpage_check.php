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

if($module == 'MAINTENANCE' || $module == 'REGISTRATION' || $module == 'PATIENT' || $module == 'CASHIER' || $module == 'ADMIN' || $module == 'DOCTOR' || $module=='PHILHEALTH' || $module == 'HMO' || $module == 'PAYROLL' || $module == 'RECORDS' || $module == 'SUPERVISOR') { //IF 1

if($logCheck->getUserName() == $username && $logCheck->getUserPassword() == $password) { //IF 2

if( $module == "MAINTENANCE" && ($logCheck->getUserModule() == "MAINTENANCE" || $logCheck->getUserModule() == "ADMIN") ) { //IF (MAINTENANCE)

$_SESSION['username'] = $username;
$_SESSION['module'] = $module;
header("Location:/COCONUT/maintenance/initializeMaintenance.php");
/*
echo "
<script type=text/javascript>
window.location='http://".$logCheck->getMyUrl()."/COCONUT/maintenance/maintenanceHeading.php?username=$username&module=Maintenance'
</script>";
*/
}//IF (MAINTENANCE)

else if( $module == "PATIENT" && ($logCheck->getUserModule() == "PATIENT" || $logCheck->getUserModule() == "ADMIN") ) { //IF (PATIENT)
session_regenerate_id();
$_SESSION['employeeID'] = $logCheck->getUserEmployeeID();
$_SESSION['username'] = $username;
$_SESSION['module'] = $module;
session_write_close();
header("Location:/COCONUT/currentPatient/initializePatient.php?username=$username");

/*
echo "
<script type=text/javascript>
window.location='http://".$logCheck->getMyUrl()."/COCONUT/currentPatient/patientInterface.php?username=$username&completeName='
</script>";
*/
} //IF (PATIENT)


else if( $module == "PHILHEALTH" && ($logCheck->getUserModule() == "PHILHEALTH" || $logCheck->getUserModule() == "ADMIN") ) { //IF (PHILHEALTH)

$_SESSION['username'] = $username;
$_SESSION['module'] = $module;
header("Location:/COCONUT/currentPatient/initializePatient.php?username=$username");

/*
echo "
<script type=text/javascript>
window.location='http://".$logCheck->getMyUrl()."/COCONUT/currentPatient/patientInterface.php?username=$username&completeName='
</script>";
*/
} //IF (PHILHEALTH)


else if( $module == "SUPERVISOR" && ($logCheck->getUserModule() == "SUPERVISOR" || $logCheck->getUserModule() == "ADMIN") ) { //IF (PHILHEALTH)

$_SESSION['username'] = $username;
$_SESSION['module'] = $module;
header("Location:/COCONUT/currentPatient/initializePatient.php?username=$username");

/*
echo "
<script type=text/javascript>
window.location='http://".$logCheck->getMyUrl()."/COCONUT/currentPatient/patientInterface.php?username=$username&completeName='
</script>";
*/
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

/*
echo "
<script type=text/javascript>
window.location='http://".$logCheck->getMyUrl()."/COCONUT/currentPatient/patientInterface.php?username=$username&completeName='
</script>";
*/
} //IF (HMO)



else if( $module == "CASHIER" && ($logCheck->getUserModule() == "CASHIER" || $logCheck->getUserModule() == "ADMIN") ) { //IF (CASHIER)

session_regenerate_id();
$_SESSION['employeeID'] = $logCheck->getUserEmployeeID();
$_SESSION['username'] = $username;
$_SESSION['module'] = $module;
session_write_close();
header("Location:/COCONUT/Cashier/initializeCashier.php");
/*
echo "
<script type=text/javascript>
window.location='http://".$logCheck->getMyUrl()."/COCONUT/Cashier/cashierMainpage.php?username=$username&module=$module'
</script>";
*/
} //IF (CASHIER)


else if($module == "ADMIN") { //IF (ADMIN)
session_regenerate_id();
$_SESSION['employeeID'] = $logCheck->getUserEmployeeID();
$_SESSION['username'] = $username;
$_SESSION['module'] = $module;
session_write_close();
header("Location:/COCONUT/ADMIN/initializeAdmin.php");
exit();
/*
echo "
<script type=text/javascript>
window.location='http://".$logCheck->getMyUrl()."/COCONUT/ADMIN/adminHeading.php?username=$username&module=$module'
</script>";
*/

} //IF (ADMIN)


else if($module == "PAYROLL") { //IF (ADMIN)

$_SESSION['username'] = $username;
$_SESSION['module'] = $module;
header("Location:/COCONUT/payroll/initializePayroll.php");
/*
echo "
<script type=text/javascript>
window.location='http://".$logCheck->getMyUrl()."/COCONUT/ADMIN/adminHeading.php?username=$username&module=$module'
</script>";
*/

} //IF (ADMIN)


else if($module == "DOCTOR") { //IF (DOCTOR)
session_regenerate_id();
$_SESSION['employeeID'] = $logCheck->getUserEmployeeID();
$_SESSION['username'] = $username;
$_SESSION['module'] = $module;
session_write_close();
header("Location:/COCONUT/Doctor/initializeDoctor.php");

/*
echo "
<script type=text/javascript>
window.location='http://".$logCheck->getMyUrl()."/COCONUT/Doctor/doctorModule/doctorInterface.php?username=$username&module=$module'
</script>";
*/

} //IF (DOCTOR)


}/* IF 2 */ 
else { //ELSE 1

echo "<script type='text/javascript'>";
echo "alert('Authentication Error');";
echo "window.back(-1)";
echo "</script>";

/*
echo "<table id='headz' border=0 bgcolor='#3b5998' width='100%'>
<td>&nbsp;&nbsp;<font size=5 color=white><b>$module</b></font></td></table>";
echo "<br><br><Br>";

echo "<center><div style='border:1px solid #ff0000; width:400px; height:50px;	'>";
echo "<br><center><font size=2 color=red>Authentication Error</font></center>";
echo "</div></center>";
*/

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

/*
echo "
<script type=text/javascript>
window.location='http://".$logCheck->getMyUrl()."/Department/departmentHeading.php?module=$module&username=$username'
</script>
";
*/
}else {

echo "<script type='text/javascript'>";
echo "alert('Authentication Error');";
echo "window.back(-1)";
echo "</script>";

/*
echo "<table id='headz' border=0 bgcolor='#3b5998' width='100%'>
<td>&nbsp;&nbsp;<font size=5 color=white><b>$module</b></font></td></table>";
echo "<br><br><Br>";

echo "<center><div style='border:1px solid #ff0000; width:400px; height:50px;	'>";
echo "<br><center><font size=2 color=red>Authentication Error</font></center>";
echo "</div></center>";
*/

}
 }//END OF ELSE


?>
