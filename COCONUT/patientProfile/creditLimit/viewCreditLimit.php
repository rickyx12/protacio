<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$registrationNo = $_GET['registrationNo'];
$ro = new database();

?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />


<?php

echo "

<style type='text/css'>
tr:hover{ background-color:yellow; color:black; }

</style>

";


if($ro->checkCreditLimit($registrationNo) > 0) { //kpg may creditLimit n as PATIENT disable button
echo "";
}else { // kung wLa p creditLimit as PATIENT enable button
echo "<form method='get' action='addCreditLimit.php'>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<input type=submit value='Add PATIENT Credit Limit' style='border:1px solid #000; background-color:#3b5998; color:white'>";
echo "</form";
}

$ro->viewCreditLimit($registrationNo,"PATIENT",$username); //credit Limit as "PATIENT"

echo "<br><br>";

$ro->viewCreditLimit($registrationNo,"RICKY",$username); // credit Limit as "NOT PATIENT"
echo "<br>";
echo "<form method='get' action='addCreditLimit.php'>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<input type=submit value='Add Credit Limit' style='border:1px solid #000; background-color:#3b5998; color:white'>";
echo "</form>";
?>
