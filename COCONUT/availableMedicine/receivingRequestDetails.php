<?php
include("../../myDatabase.php");
$description = $_GET['description'];
$requestedQTY = $_GET['requestedQTY'];
$issuedQTY = $_GET['issuedQTY'];
$requestTo_department = $_GET['requestTo_department'];
$requestTo_branch = $_GET['requestTo_branch'];
$issuedBy = $_GET['issuedBy'];
$requestingUser = $_GET['requestingUser'];
$requestingDepartment = $_GET['requestingDepartment'];
$requestingBranch = $_GET['requestingBranch'];
$timeRequested = $_GET['timeRequested'];
$dateRequested = $_GET['dateRequested'];
$dateIssued = $_GET['dateIssued'];
$timeIssued = $_GET['timeIssued'];
$verificationNo = $_GET['verificationNo'];
$inventoryCode = $_GET['inventoryCode'];
$username = $_GET['username'];

$ro = new database();

?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />


<?php

$timezone = "Asia/Manila";
date_default_timezone_set ($timezone);
$currentQTY = $ro->getCurrentQTY($inventoryCode) - $issuedQTY;
$expiration = preg_split ("/\_/",$ro->selectNow("inventory","expiration","inventoryCode",$inventoryCode)); 

echo "<form method='get' action='receivingRequestDetails1.php' >";
echo "<input type=hidden name='currentQTY' value='$currentQTY'>";
echo "<input type=hidden name='verificationNo' value='$verificationNo'>";
echo "<input type=hidden name='inventoryCode' value='$inventoryCode'>";

echo "<input type=hidden name='unitcost' value='".$ro->selectNow("inventory","unitcost","inventoryCode",$inventoryCode)."'>"; //$_GET['unitcost']

echo "<input type=hidden name='generic' value='".$ro->selectNow("inventory","genericName","inventoryCode",$inventoryCode)."'>"; //$_GET['generic']

echo "<input type=hidden name='date' value='".date("M_d_Y")."'>"; //$_GET['date']

echo "<input type=hidden name='username' value='$username'>"; // $_GET['addedBy']

echo "<input type=hidden name='month' value='".$expiration[0]."'>"; // $_GET['month']

echo "<input type=hidden name='day' value='".$expiration[1]."'>"; // $_GET['day']

echo "<input type=hidden name='year' value='".$expiration[2]."'>"; // $_GET['year']

echo "<input type=hidden name='serverTime' value='".date("H:i:s")."'>"; // $_GET['serverTime']

echo "<input type=hidden name='inventoryLocation' value='$requestingDepartment'>"; // $_GET['inventoryLocation']

echo "<input type=hidden name='branch' value='$requestingBranch'>"; // $_GET['branch']

echo "<input type=hidden name='inventoryType' value='".$ro->selectNow("inventory","inventoryType","inventoryCode",$inventoryCode)."'>"; // $_GET['inventoryType']

echo "<input type=hidden name='transition' value='Issued By $requestTo_department of $requestTo_branch / Issued Staff: $issuedBy'>"; // $_GET['transition']

echo "<input type=hidden name='remarks' value='requesitionNo_$verificationNo / from inventoryCode of $inventoryCode'>"; // $_GET['remarks']

echo "<br><center><div style='border:1px solid #000000; width:600px; height:280px; border-color:black black black black;'>";
echo "<br>";
echo "<table border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<td>&nbsp;<font class='labelz'>Description</font>&nbsp;</td>";
echo "<td><input type=text name='description' class='txtBox' value='$description' readonly></td>";
echo "</tr>";


echo "<tr>";
echo "<td>&nbsp;<font class='labelz'>Reqeusted QTY</font>&nbsp;</td>";
echo "<td><input type=text class='shortField' value='$requestedQTY' readonly></td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<font class='labelz'>Issued QTY</font>&nbsp;</td>";
echo "<td><input type=text name='quantity' class='shortField' value='$issuedQTY' readonly></td>"; //$_GET['quantity']
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<font class='labelz'>Reqeusted Since</font>&nbsp;</td>";
echo "<td><input type=text name='requestedBy' class='txtBox' value='$dateRequested @ $timeRequested' readonly></td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<font class='labelz'>Reqeusted By</font>&nbsp;</td>";
echo "<td><input type=text class='txtBox' value='$requestingDepartment of $requestingBranch by $requestingUser' readonly></td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<font class='labelz'>Issued Since</font>&nbsp;</td>";
echo "<td><input type=text name='issuedBy' class='txtBox' value='$dateIssued @ $timeIssued' readonly></td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<font class='labelz'>Issued By</font>&nbsp;</td>";
echo "<td><input type=text class='txtBox' value='$requestTo_department of $requestTo_branch by $issuedBy' readonly></td>";
echo "</tr>";

echo "</table>";
echo "<br><br>";
echo "<input type=submit value='Receive'>";
echo "</div>";
echo "</form>";
?>
