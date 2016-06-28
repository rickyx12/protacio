<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$show = $_GET['show'];
$desc = $_GET['desc'];


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

echo "<Table width='100%' border=1 rules=all cellpadding=0 cellspacing=0>";
echo "<Tr>";
echo "<td id='selected'>";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/paymentTransfer_takeHomeMeds.php?registrationNo=$registrationNo&show=cash2company&desc=cash2company'><Center><font size=2 color=red>Cash</font> > <font size=2 color=blue>Company</font></a></center>";
echo "</td>";


echo "<td id='selected'>";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/paymentTransfer_takeHomeMeds.php?registrationNo=$registrationNo&show=cash2phic&desc=cash2phic'><center><font size=2 color=red>Cash</font> > <font size=2 color=green>P.H.I.C</font></center></a>";
echo "</td>";


echo "<td id='selected'>";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/paymentTransfer_takeHomeMeds.php?registrationNo=$registrationNo&show=company2cash&desc=company2cash'><center><font size=2 color=blue>Company</font> > <font size=2 color=red>Cash</font></center></a>";
echo "</td>";
echo "<td id='selected'>";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/paymentTransfer_takeHomeMeds.php?registrationNo=$registrationNo&show=company2phic&desc=company2phic'><center><font size=2 color=blue>Company</font> > <font size=2 color=green>P.H.I.C</font></center></a>";
echo "</td>";

echo "<td id='selected'>";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/paymentTransfer_takeHomeMeds.php?registrationNo=$registrationNo&show=phic2cash&desc=phic2cash'><center><font size=2 color=darkgreen>P.H.I.C</font> > <font size=2 color=red>Cash</font></center></a>";
echo "</td>";

echo "<td id='selected'>";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/paymentTransfer_takeHomeMeds.php?registrationNo=$registrationNo&show=phic2company&desc=phic2company'><center><font size=2 color=darkgreen>P.H.I.C</font> > <font size=2 color=blue>Company</font></center></a>";
echo "</td>";

echo "<td id='selected'><a href='paymentTransfer.php?registrationNo=$registrationNo&show=$show&desc='><center><font size=2 color=green>Charges</font></center></a></td>";

echo "</tr>";
echo "</table>";
echo "<br>";


if($show == "cash2company") {
echo "<font size=2 color=red>WARNING:</font> <font size=2>The Amount in <b>Balance</b> of All Charges that are Listed Below will be Transferred to <b>Company</b> once you click the</font>&nbsp;<font size=2><b>Transfer Payments</b></font> <font size=2>Button</font>.&nbsp;&nbsp;(<font size=2 color=red>Cash</font> > <font size=2 color=blue>Company</font>)";
}else if($show == "cash2phic") {
echo "<font size=2 color=red>WARNING:</font> <font size=2>The Amount in <b>Balance</b> of All Charges that are Listed Below will be Transferred to <b>PhilHealth</b> once you click the</font>&nbsp;<font size=2><b>Transfer Payments</b></font> <font size=2>Button</font>.&nbsp;&nbsp;(<font size=2 color=red>Cash</font> > <font size=2 color=darkgreen>P.H.I.C</font>)";
}

else if($show == "company2cash") {
echo "<font size=2 color=red>WARNING:</font> <font size=2>The Amount in <b>Company</b> of All Charges that are Listed Below will be Transferred to <b>Balance</b> once you click the</font>&nbsp;<font size=2><b>Transfer Payments</b></font> <font size=2>Button</font>.&nbsp;&nbsp;(<font size=2 color=blue>Company</font> > <font size=2 color=red>Cash</font>)";
}else if($show == "company2phic") {
echo "<font size=2 color=red>WARNING:</font> <font size=2>The Amount in <b>Company</b> of All Charges that are Listed Below will be Transferred to <b>PhilHealth</b> once you click the</font>&nbsp;<font size=2><b>Transfer Payments</b></font> <font size=2>Button</font>.&nbsp;&nbsp;(<font size=2 color=blue>Company</font> > <font size=2 color=darkgreen>P.H.I.C</font>)";
}else if($show == "phic2cash") {
echo "<font size=2 color=red>WARNING:</font> <font size=2>The Amount in <b>PhilHealth</b> of All Charges that are Listed Below will be Transferred to <b>Balance</b> once you click the</font>&nbsp;<font size=2><b>Transfer Payments</b></font> <font size=2>Button</font>.&nbsp;&nbsp;(<font size=2 color=darkgreen>P.H.I.C</font> > <font size=2 color=red>Cash</font>)";
}else if($show == "phic2company") {
echo "<font size=2 color=red>WARNING:</font> <font size=2>The Amount in <b>PhilHealth</b> of All Charges that are Listed Below will be Transferred to <b>Company</b> once you click the</font>&nbsp;<font size=2><b>Transfer Payments</b></font> <font size=2>Button</font>.&nbsp;&nbsp;(<font size=2 color=darkgreen>P.H.I.C</font> > <font size=2 color=blue>Company</font>)";
}




else {
echo "";
}

echo "<table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'><font color=#3b5998>CASH</font></th>";
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
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Branch</font>&nbsp;</th>";
echo "</tr>";

$ro->paymentTransfer($registrationNo,"",$show,$desc,"=");

echo "</table>";
?>
