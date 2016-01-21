<?php

include("encrypt.php");
$username = $_POST['username'];
$password = $_POST['password'];
$module = $_POST['module'];
$key = $_POST['key'];
$name = $_POST['name'];


$ro = new database();

if($username == "" || $password == "") {
echo "
<script>
alert('Pls compplete the registration');
history.go(-1);
</script>
";
}else {

if( $key == "9k7n3m2l921zdke=~!d9cja#=$58&8!<>edDr8@!2Df~~##4@-[9k8j4m9x7ak0m29szla183jd1zxkaj1j4s5ac971k8jt3]" ) {
$username1 = mysql_real_escape_string(strip_tags($username));
$password1 = mysql_real_escape_string(strip_tags($password));

$encrypt_password = Encryption::encrypt($password1);
$encrypt_password1 = Encryption::ENCRYPT_DECRYPT($encrypt_password);

$ro->addUser($username,$encrypt_password1,$module,"Pagadian",$name);
}else {
header("Location: addUser.php");
}

}

?>
