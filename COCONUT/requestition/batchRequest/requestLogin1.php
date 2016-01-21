<?php
include("../../../myDatabase2.php");
$username = $_POST['username'];
$password = $_POST['password'];

$ro = new database2();
$ro->coconutDesign();
$user = $ro->selectNow("registeredUser","username","password",$password);

if( $username == "" && $password == "" ) {
$ro->getBack("Authentication Error");
}else {

if( $username == $user ) {
//header("Location: /COCONUT/requestition/batchRequest/getRequestNo.php?username=$username");
echo "<Br><Br><BR><Br>";
$ro->coconutBoxStart("500","100");
echo "<Br>";
echo "<table border=0>";
echo "<Tr>";
echo "<Td><a style='text-decoration:none;' href='http://".$ro->getMyUrl()."/COCONUT/requestition/batchRequest/getRequestNo.php?username=$username'><font color=blue>Request</font></a></tD>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
echo "<Td><a style='text-decoration:none;' href='http://".$ro->getMyUrl()."/COCONUT/requestition/receiveRequest.php?username=$username'><font color=red>Receive</font></a></tD>";
echo "</tr>";
echo "</table>";
$ro->coconutBoxStop();

}else {
echo "<script type='text/javascript'>
alert('Incorrect Password');
history.back();
</script>";

}
}

?>
