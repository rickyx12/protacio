<?php
include("../../../storedProcedure.php");
$description = $_POST['description'];
$qty = $_POST['qty'];
$price = $_POST['price'];
$total = $_POST['total'];
$username = $_POST['username'];
$password = $_POST['password'];

$ro = new storedProcedure();
$ro->requestLog($username,$password);

if($username == "" && $password == "") {
echo "<script type='text/javascript'>";
echo "alert('Authentication Error');";
echo "window.back(-1)";
echo "</script>";
}else {

$username1 = mysql_real_escape_string(strip_tags($username));
$password1 = mysql_real_escape_string(strip_tags($password));
$description1 = mysql_real_escape_string(strip_tags($description));
$qty1 = mysql_real_escape_string(strip_tags($qty));
$price1 = mysql_real_escape_string(strip_tags($price));
$total1 = mysql_real_escape_string(strip_tags($total));

if($username == $ro->requestLog_username() && $password == $ro->requestLog_password()) {
$ro->request2admin($description1,$qty1,$price1,$total1,$username1,getenv("REMOTE_ADDR")."-".php_uname("n"),$ro->getSynapseTime(),date("Y-m-d"));
echo "<script type='text/javascript'>";
echo "alert('Request Delivered!');";
echo "window.location='http://".$ro->getMyUrl()."/LOGINPAGE/module.php'";
echo "</script>";
}else {
echo "<script type='text/javascript'>";
echo "alert('Authentication Error');";
echo "window.back(-1)";
echo "</script>";
}

}

?>
