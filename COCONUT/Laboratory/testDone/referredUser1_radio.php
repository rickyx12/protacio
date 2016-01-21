<?php
include("../../../myDatabase2.php");
$username = $_POST['username'];
$password = $_POST['password'];
$radioSavedNo = $_POST['radioSavedNo'];

$ro = new database2();

$user = $ro->selectNow("registeredUser","username","password",$password);

if( $username == $user ) {
$ro->editNow("radioSavedReport","radioSavedNo",$radioSavedNo,"refer",$user);
$ro->editNow("radioSavedReport","radioSavedNo",$radioSavedNo,"referTime",$ro->getSynapseTime());
echo "<font color=red>Referrred</font> <Br>Press F5 to refresh ";
}else {
echo "
<script type='text/javascript'>
alert('Incorrect Password');
history.back();
</script>

";
}

?>
