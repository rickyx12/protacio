<?php
include("../../myDatabase1.php");
$password = $_POST['password'];
$comment = $_POST['comment'];

$ro = new database1();

if( $ro->selectNow("registeredUser","username","password",$password) != "" ) {
$username = $ro->selectNow("registeredUser","username","password",$password);
header("Location: /COCONUT/Homepage/addComment.php?username=$username&comment=$comment");
}else {
echo "<script type='text/javascript'>
alert('Incorrect Password');
history.back();
</script>";
}




?>
