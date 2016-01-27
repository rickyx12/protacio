<?php
include("../../myDatabase.php");
$description = $_GET['description'];
$quantity = $_GET['quantity'];
$requestingDepartment = $_GET['requestingDepartment'];
$requestingBranch = $_GET['requestingBranch'];
$requestingUser = $_GET['requestingUser'];
$timeRequested = $_GET['timeRequested'];
$dateRequested = $_GET['dateRequested'];
$verificationNo = $_GET['verificationNo'];
$username = $_GET['username'];
$inventoryCode = $_GET['inventoryCode'];

$ro = new database();

?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<?php
$currentQTY = $ro->getCurrentQTY($inventoryCode) - $quantity;
echo "<form method='get' action='dispensedRequest1.php'>";
$ro->coconutHidden("inventoryCode",$inventoryCode);
$ro->coconutHidden("verificationNo",$verificationNo);
/*
$ro->coconutHidden("generic",$ro->selectNow("inventory","genericName","inventoryCode",$inventoryCode));
$ro->coconutHidden("unitcost",$ro->selectNow("inventory","unitcost","inventoryCode",$inventoryCode));
$ro->coconutHidden("date",date("Y-m-d"));
$ro->coconutHidden("username",$username);
$ro->coconutHidden("month",date("m"));
$ro->coconutHidden("day",date("d"));
$ro->coconutHidden("year",date("Y"));
$ro->coconutHidden("serverTime",$ro->getSynapseTime());
$ro->coconutHidden("inventoryLocation",$ro->selectNow("inventoryManager","requestingDepartment","verificationNo",$verificationNo));
$ro->coconutHidden("branch","");
$ro->coconutHidden("inventoryType",$ro->selectNow("inventory","inventoryType","inventoryCode",$inventoryCode));
$ro->coconutHidden("transition"," Issued By ".$ro->selectNow("inventoryManager","requestTo_department","verificationNo",$verificationNo)." / Issued Staff $username");
$ro->coconutHidden("remarks","requestitionNo_$verificationNo / from inventoryCode of $inventoryCode");
$ro->coconutHidden("quantity",$quantity);
$ro->coconutHidden("currentQTY",$currentQTY);
$ro->coconutHidden("verificationNo",$verificationNo);
$ro->coconutHidden("inventoryCode",$inventoryCode);


echo "<input type=hidden name='username' value='$username'>";
echo "<input type=hidden name='verificationNo' value='$verificationNo'>";
echo "<input type=hidden name='requestingDepartment' value='$requestingDepartment'>";
echo "<input type=hidden name='requestingBranch' value='$requestingBranch'>";
*/

echo "<br><center><div style='border:1px solid #000000; width:600px; height:250px; border-color:black black black black;'>";
echo "<br>";
echo "<table border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<td>&nbsp;<font class='labelz'>Item Requested</font>&nbsp;</td>";
echo "<td><input type='text' name='description' class='txtBox' value='$description' readonly></td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<font class='labelz'>Request From</font>&nbsp;</td>";
echo "<td><input type='text' name='itemRequested' class='txtBox' value='$requestingDepartment of $requestingBranch' readonly></td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<font class='labelz'>Requesting Staff</font>&nbsp;</td>";
echo "<td><input type='text' name='itemRequested' class='txtBox' value='$requestingUser' readonly></td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<font class='labelz'>Requested Since</font>&nbsp;</td>";
echo "<td><input type='text' name='itemRequested' class='txtBox' value='$dateRequested @ $timeRequested' readonly></td>";
echo "</tr>";


if( $ro->selectNow("inventory","quantity","inventoryCode",$inventoryCode) >= $quantity ) {
echo "<tr>";
echo "<td>&nbsp;<font class='labelz'>Quantity Requested</font>&nbsp;</td>";
echo "<td><input type='text' name='quantityRequested' class='shortField' value='$quantity' readonly></td>";
echo "</tr>";
}else {
echo "<tr>";
echo "<td>&nbsp;<font class='labelz'>Quantity Requested</font>&nbsp;</td>";
echo "<td><input type='text' name='quantityRequested' class='shortField' value='$quantity' readonly><Br><font size=2 color=red>Quantity Requested is Higher than your stock which is ".$ro->selectNow("inventory","quantity","inventoryCode",$inventoryCode)."</font></td>";
echo "</tr>";
}


echo "<tr>";
echo "<td>&nbsp;<font class='labelz'>Quantity Issue</font>&nbsp;</td>";
echo "<td><input type='text' name='quantityIssued' class='shortField' value='$quantity' ></td>";
echo "</tr>";
echo "</table>";
echo "<br><br>";
echo "<input type='submit' value='Proceed'>";
echo "</div>";

echo "</form>";

?>
