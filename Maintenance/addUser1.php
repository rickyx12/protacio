<?php
include("../myDatabase.php");

$username = $_POST['username'];
$usernamez = $_POST['usernamez']; // LOGINUSER
$password = $_POST['password'];
$module = $_POST['module'];
$branch = $_POST['branch'];
$completeName = $_POST['completeName'];


$ro = new database();



$ro->LogIn($username,$password,$module);

if($ro->getUserName()=="" && $ro->getUserPassword()=="" && $ro->getUserModule()=="" ) {
//$ro->addUser($username,$enc->encrypt($password),$module,$branch,$completeName);
$ro->addUser($username,$password,$module,$branch,$completeName);
echo "
<script type='text/javascript'>
alert('".$username." has already an access in $module');
window.location='http://".$ro->getMyUrl()."/Maintenance/addUser.php?usernamez=$usernamez';
</script>
";
}
else {

echo "
<script type='text/javascript'>
alert('Username has already used by the Others');
history.back();
</script>
";
}


?>
