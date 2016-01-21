



<title>Synapse Hospital System</title>
<?php
include("homeDatabase.php");
session_start();
$ro = new synapse();


unset($_SESSION['username']);
unset($_SESSION['module']);
session_destroy();
//setcookie ("username", "",time()-60); 
//setcookie ("module", "",time()-60); 
 

//$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
//if( stripos($ua,'iPad') !== false  ) {
//header("Location: /COCONUT/android/homepage.php");
//}
//else {
echo "<table id='headz' border=0 bgcolor='#3b5998' width='100%'>
<td>&nbsp;&nbsp;<a href='http://".$ro->getMyUrl()."/COCONUT/Homepage/homepage.php' target='welcome' style='text-decoration:none;'><font size=5 color=white><b>Synapse</b></font></a></td></table>";

$ro->coconutUpperMenuStart();
$ro->coconutUpperMenu_headingStart("Staff Login");
$ro->getSynapseModule();
$ro->coconutUpperMenu_headingStop();
$ro->coconutUpperMenuStop();


//echo "<iframe src='http://".$ro->getMyUrl()."/MainPage.php' width='73%' height='555'  name='welcome' border=1 frameborder=no></iframe>";

echo "<iframe src='http://".$ro->getMyUrl()."/COCONUT/flow/opdTransaction.php' width='80%' height='510'  name='welcome' border=1 frameborder=no></iframe>";

//echo "<iframe src='http://".$ro->getMyUrl()."/COCONUT/Laboratory/testDone/testDone_update.php' width='27%' height='555'  name='welcome' border=1 frameborder=no></iframe>";
//}
echo "<iframe src='http://".$ro->getMyUrl()."/COCONUT/room/listRoom1.php' width='20%' height='510'  name='welcome' border=1 frameborder=no></iframe>";

//echo "<hr><center><font size=1.5>Email me at <b>aizekrysler@gmail.com</b> | Facebook <b>aizekrysler@yahoo.com.ph</b></font>";

//$ro->getSynapseModule();

/*
echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/opdRegistration.php'>
<input type=hidden name='module' value='REGISTRATION'>
<input type=submit value='Registration'>
</form>";

echo "<form method='get' action='loginpage.php'>
<input type=hidden name='module' value='BILLING'>
<input type=submit value='BILLING'>
</form>";

echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/NURSING/nursingPage.php'>
<input type=hidden name='module' value='NURSING'>
<input type=submit value='NURSING SERVICE'>
</form>";

echo "<form method='get' action='loginpage.php'>
<input type=hidden name='module' value='DOCTOR'>
<input type=submit value='DOCTORS LOUNGE'>
</form>";


echo "<form method='get' action='loginpage.php'>
<input type=hidden name='module' value='LABORATORY'>
<input type=submit value='LABORATORY'>
</form>";


echo "<form method='get' action='loginpage.php'>
<input type=hidden name='module' value='RADIOLOGY'>
<input type=submit value='RADIOLOGY'>
</form>";

echo "<form method='get' action='loginpage.php'>
<input type=hidden name='module' value='PHARMACY'>
<input type=submit value='PHARMACY'>
</form>";

echo "<form method='get' action='loginpage.php'>
<input type=hidden name='module' value='CSR'>
<input type=submit value='CSR'>
</form>";


echo "<form method='get' action='loginpage.php'>
<input type=hidden name='module' value='PATIENT'>
<input type=submit value='PATIENT'>
</form>";

echo "<form method='get' action='loginpage.php'>
<input type=hidden name='module' value='CASHIER'>
<input type=submit value='CASHIER'>
</form>";

echo "<form method='get' action='loginpage.php'>
<input type=hidden name='module' value='MAINTENANCE'>
<input type=submit value='MAINTENANCE'>
</form>";


echo "<form method='get' action='loginpage.php'>
<input type=hidden name='module' value='ADMIN'>
<input type=submit value='ADMIN'>
</form>";

*/


?>
