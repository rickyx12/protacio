<?php
include("../../myDatabase.php");
//require_once('../authentication.php');
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$show = $_GET['show'];
$desc =  $_GET['desc'];

$ro = new database();

echo "
<style type='text/css'>
.head {
font-size:13px;
}

.find {
	border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 370px;
	border-color:black black black black;
	background:#FFFFFF url(http://".$ro->getMyUrl()."/COCONUT/myImages/search.jpeg) no-repeat 4px 4px;
	padding:4px 4px 4px 22px;
}


.button {
	border: 1px solid #000;
	color: #fff;
	height: 23px;
	width: 70px;
	border-color:black black black black;
	text-align:center;
	background-color:#3b5998;
}

</style>

";

echo "<script type='text/javascript'>

var charges = 'Find Charges';
function SetMsg (txt,active) {
    if (txt == null) return;
    
 
    if (active) {
        if (txt.value == charges) txt.value = '';                     
    } else {
        if (txt.value == '') txt.value = charges;
    }
}

</script>";


echo "<form method='get' action='patientCharges.php' >";
echo "<input type=text name='desc'	
	onfocus='SetMsg(this, true);'
    	onblur='SetMsg(this,false);' 
	value='Find Charges'
	autocomplete='off'	
	class='find'>&nbsp;";
echo "<input type=hidden name='show' value='search'>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<form>";
echo "<br><br>&nbsp;";
echo "<table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";

echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'></font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Description</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Price</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>QTY</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Disc</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Total</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Time</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Date</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>User</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Service</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Status</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Payment</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Balance</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Company</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>PhilHealth</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Paid</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Category</font>&nbsp;</th>";
echo "</tr>";

$ro->getPatientCharges($registrationNo,$username,$show,$desc);

echo "</table>";
?>
