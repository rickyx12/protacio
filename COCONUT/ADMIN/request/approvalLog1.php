<?php
//include("../../../LOGINPAGE/homeDatabase.php");
include("encrypt.php");
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
$module = $_POST['module'];


$ro = new Encryption();

//echo $username."<br>";
//echo $password."<br>";
//echo $module."<br>";


$ro->LogIn($username,$password,$module);

if($ro->getUserName() == $username && $ro->getUserPassword() == $password && $ro->getUserModule() == $module ) {
session_regenerate_id();
$_SESSION['employeeID'] = $ro->getUserEmployeeID();
$_SESSION['username'] = $username;
$_SESSION['module'] = $module;
session_write_close();
header("Location:/COCONUT/ADMIN/request/initializeRequest.php?username=$username");
}else {
echo "
<script>
alert('Authentication Error');
history.go(-1);
</script>
";
}

?>
