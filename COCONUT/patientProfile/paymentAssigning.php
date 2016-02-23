<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$desc = $_GET['desc'];
$type = $_GET['type'];

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

#selected:hover {
background-color:yellow; color:black;
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

echo "<Table width='70%' border=1 rules=all cellpadding=0 cellspacing=0>";
echo "<Tr>";
echo "<td id='selected'>";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/paymentAssigning.php?registrationNo=$registrationNo&username=$username&desc=cash&type=$type'><Center><font size=2>Check All</font> <font size=2 color=red>Cash</font></a></center>";
echo "</td>";
echo "<td id='selected'>";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/paymentAssigning.php?registrationNo=$registrationNo&username=$username&desc=hmo&type=$type'><center><font size=2>Check All</font> <font size=2 color=red>Company</font></center></a>";
echo "</td>";
echo "<td id='selected'>";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/paymentAssigning.php?registrationNo=$registrationNo&username=$username&desc=phic&type=$type'><center><font size=2>Check All</font> <font size=2 color=red>P.H.I.C</font></center></a>";
echo "</td>";

echo "<td id='selected'>";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/paymentAssigning_category.php?registrationNo=$registrationNo&username=$username&desc=$desc'><center><font size=2 color='blue'>Select Category</font></center></a>";
echo "</td>";

echo "</tr>";
echo "</table>";
echo "<br>";
echo "<table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>CASH</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>COMPANY</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>PHIC</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Description</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Price</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>QTY</font>&nbsp;</th>";
//echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Disc</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Total</font>&nbsp;</th>";
//echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Time</font>&nbsp;</th>";
//echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Date</font>&nbsp;</th>";
//echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>User</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Service</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Status</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Payment</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Discount</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Balance</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Company</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>PhilHealth</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Paid</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Branch</font>&nbsp;</th>";
echo "</tr>";

$ro->paymentAssigning($registrationNo,$desc,$username,$type);

echo "</table>";

echo "<Br><br>";

?>
