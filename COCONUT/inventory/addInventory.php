<?php
include("../../myDatabase.php");
$username = $_GET['username'];
$status = $_GET['status'];
$oldStockCardNo = $_GET['stockCardNo'];
$description = $_GET['description'];
$genericName = $_GET['genericName'];

if(isset($_GET['biQTY'])) {
$biQTY = $_GET['biQTY'];
}else {
$biQTY = "";
}

if( isset($_GET['biInventoryCode']) ) {
$biInventoryCode = $_GET['biInventoryCode'];
}else {
$biInventoryCode = "";
}


$ro = new database();
?>


<script src="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/serverTime/serverTime.js"></script>
<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/flow/rickyCSS1.css" />



<style type='text/css'>
.txtBox {
	border: 1px solid #000;
	color: #000;
	height: 30px;
	width: 320px;
	padding:4px 4px 4px 5px;
}

.shortField {
	border: 1px solid #000;
	color: #000;
	height: 30px;
	width: 120px;
	padding:4px 4px 4px 5px;
}


.bdayField {
	border: 1px solid #000;
	color: #000;
	height: 30px;
	width: 90px;
	padding:4px 4px 4px 5px;
}

.comboBox {
	border: 1px solid #000;
	color: #000;
	height: 30px;
	width: 300px;
	padding:4px 4px 4px 5px;
}

.comboBoxShort {
	border: 1px solid #000;
	color: #000;
	height: 30px;
	width: 65px;
	padding:4px 4px 4px 5px;
}


.comboBoxDay {
	border: 1px solid #000;
	color: #000;
	height: 30px;
	width: 45px;
	padding:4px 4px 4px 5px;
}


.labelz {
color:#000;
font-size=10px;
}
</style>

<script type='text/javascript'>
$("#breadcrumbs a").hover(
    function () {
        $(this).addClass("hover").children().addClass("hover");
        $(this).parent().prev().find("span.arrow:first").addClass("pre_hover");
    },
    function () {
        $(this).removeClass("hover").children().removeClass("hover");
        $(this).parent().prev().find("span.arrow:first").removeClass("pre_hover");
    }
);
</script>






<?php

$description1 = $_GET['description'];
$genericName1 = $_GET['genericName'];

if( $status == "new" ) {
$ro->getInventoryStockCardNo();
$myFile = $ro->getReportInformation("homeRoot")."/COCONUT/trackingNo/stockCardNo.dat";
$fh = fopen($myFile, 'r');
$stockCardNo = fread($fh, 100);
fclose($fh);
}else {
$stockCardNo=$oldStockCardNo;
}



echo "<body onload='DisplayTime();'>";
echo "<form method='post' action='addInventory_insert.php'>";
echo "<input type='hidden' name='description1' value='$description1' />";
echo "<input type='hidden' name='genericName1' value='$genericName1' />";
echo "<input type='hidden' name='classification' value='' />";
echo "<br><center><div style='border:1px solid #000000; width:500px; height:650px; border-color:black black black black;'>";
echo "<br><table border=0 cellpadding=0 cellspacing=0>";
echo "<input type=hidden name='inventoryType' value='medicine'>";
echo "<input type=hidden name='addedBy' value='$username'>";
echo "<tr>";
echo "<td><font class='labelz'>Description&nbsp;</font></td>";
if( $status == "old" ) {
echo "<td><input type=text class='txtBox' name='description' value='$description' readonly autocomplete='off'></td>";
}else {
echo "<td><input type=text class='txtBox' name='description' value='$description' autocomplete='off'></td>";
}
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Generic&nbsp;</font></td>";
echo "<td><input type=text class='txtBox' name='generic' value='$genericName' autocomplete='off'></td>";
echo "</tr>";
echo "<tr>";
echo "<tr>";
echo "<td><font class='labelz'>Preparation&nbsp;</font></td>";
echo "<td>";
$ro->coconutTextBox("preparation","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td><font class='labelz'>Unit of Measure&nbsp;</font></td>";
echo "<td>";
$ro->coconutTextBox("unitOfMeasure","");
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<td><font class='labelz'>Unit Cost&nbsp;</font></td>";
echo "<td><input type=text class='shortField' name='unitcost' autocomplete='off'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Quantity&nbsp;</font></td>";
echo "<td><input type=text class='shortField' name='quantity' autocomplete='off'></td>";
echo "</tr>";



echo "<tr>";
echo "<td><font class='labelz'>B.I QTY&nbsp;</font></td>";
echo "<td><input type=text class='shortField' name='biQTY' value='$biQTY' readonly autocomplete='off'>&nbsp;&nbsp;<a href='/COCONUT/inventory/bi.php?stockCardNo=$stockCardNo&username=$username&status=$status&genericName=$genericName&description=$description' style='text-decoration:none;'><font size=2 color=red>[Add B.I]</font></a></td>";
echo "</tr>";


echo "<tr>";
echo "<td><font class='labelz'>B.I inventoryCode&nbsp;</font></td>";
echo "<td><input type=text class='shortField' name='biInventoryCode' value='$biInventoryCode' readonly autocomplete='off'>&nbsp;&nbsp;</td>";
echo "</tr>";




echo "<tr>";
echo "<td><font class='labelz'>Beginning Bal&nbsp;</font></td>";
echo "<td><input type=text class='shortField' name='beginningBalance' autocomplete='off'></td>";
echo "</tr>";


echo "<tr>";
echo "<td><font class='labelz'>Expiration&nbsp;</font></td>";
echo "<td>";
echo "
<select name='monthExpired' class='comboBoxShort'>
<option value='01'>Jan</option>
<option value='02'>Feb</option>
<option value='03'>Mar</option>
<option value='04'>Apr</option>
<option value='05'>May</option>
<option value='06'>Jun</option>
<option value='07'>Jul</option>
<option value='08'>Aug</option>
<option value='09'>Sep</option>
<option value='10'>Oct</option>
<option value='11'>Nov</option>
<option value='12'>Dec</option>
</select>";

echo "&nbsp;<select name='dayExpired' class='comboBoxShort' width='10'>";
for($x=1;$x<=31;$x++) {
if($x < 9) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
echo "</select>";
echo "&nbsp;<input type=text name='yearExpired' class='bdayField' value='".date("Y")."' autocomplete='off'>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Date Added&nbsp;</font></td>";
echo "<td>";
echo "
<select name='monthAdded' class='comboBoxShort'>
<option value='".date("m")."'>".date("M")."</option>
<option value='01'>Jan</option>
<option value='02'>Feb</option>
<option value='03'>Mar</option>
<option value='04'>Apr</option>
<option value='05'>May</option>
<option value='06'>Jun</option>
<option value='07'>Jul</option>
<option value='08'>Aug</option>
<option value='09'>Sep</option>
<option value='10'>Oct</option>
<option value='11'>Nov</option>
<option value='12'>Dec</option>
</select>";

echo "&nbsp;<select name='dayAdded' class='comboBoxShort' width='10'>";
echo "<option value='".date("d")."'>".date("d")."</option>";
for($x=1;$x<=31;$x++) {
if($x < 9) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
echo "</select>";
echo "&nbsp;<input type=text name='yearAdded' class='bdayField' value='".date("Y")."' autocomplete='off'>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Location&nbsp;</font></td>";
echo "<td>";
echo "<select class='comboBox' name='inventoryLocation'>";
echo "<option value='PHARMACY'>PHARMACY</option>";
$ro->showInventoryLocation();
echo "</select>";
echo "</td>";
echo "</tr>";

/*
echo "<tr>
<td><font class='labelz'>Branch</font></td>
<td><select name='branch' class='txtBox'>"; 
$ro->showOption("branch","branch");
echo "</select></td>
</tr>";
*/
$ro->coconutHidden("branch","");
/*
echo "<tr>
<td><font class='labelz'>Transition</font></td>
<td><select name='transition' class='txtBox'>"; 
$ro->showOption("inventoryTransition","transition");
echo "</select></td>
</tr>";
*/
$ro->coconutHidden("transition","");


echo "<tr>
<td><font class='labelz'>Medicine Type</font></td>
<td><select name='medicineType' class='txtBox'>";
echo "<option value=''></option>"; 
echo "<option value='ORAL'>ORAL</option>";
echo "<option value='AMPULE'>AMPULE</option>";
echo "<option value='IV FLUID'>IV FLUID</option>";
echo "</select></td>
</tr>";



echo "<tr>
<td>IPD Price</td>
<td><input type=text name='ipdPrice' autocomplete='off' class='shortField'></td>
</tr>";

echo "<tr>
<td>OPD Price</td>
<td><input type=text name='opdPrice' autocomplete='off' class='shortField'></td>
</tr>";

echo "<tr>
<td><font class='labelz'>Remarks</font></td>
<td><input type=text name='remarks' autocomplete='off' class='txtBox'></td>
</tr>";


echo "<tr>
<td><font size='2.5'>Critical Level</font></td>
<td><input type=text name='criticalLevel' autocomplete='off' class='txtBox'></td>
</tr>";

echo "<tr>
<td><font class='labelz'>Auto Dispense</font></td>
<td><select name='autoDispense' class='txtBox'>"; 
echo "<option value='no'>no</option>";
echo "<option value='yes'>yes</option>";
echo "</select></td>
</tr>";


echo "<tr>
<td><font class='labelz'>Supplier</font></td>
<td><select name='supplier' class='txtBox'>"; 
echo "<option value=''></option>";
$ro->showOption("supplier","supplierName");
echo "</select></td>
</tr>";

echo "<tr>
<td><font class='labelz'>Invoice#</font></td>
<td><input type=text name='invoiceNo' autocomplete='off' class='txtBox'></td>
</tr>";

echo "<tr>
<td><font class='labelz'><font color=red>Locked</font></font></td>
<td><select name='lock' class='txtBox'>";
echo "<option value='no'>No</option>"; 
echo "<option value='yes'>Yes</option>";
echo "</select></td>
</tr>";


echo "</table>";
echo "<p id='curTime'>";
echo "</div>";
echo "<Br><Br>";
echo "<input type='submit' value='Proceed'>";
$ro->coconutHidden("pricing","");
$ro->coconutHidden("additional","");
$ro->coconutHidden("phicPrice","");
$ro->coconutHidden("phic","");
$ro->coconutHidden("companyPrice","");
$ro->coconutHidden("stockCardNo",$stockCardNo);
$ro->coconutHidden("status",$status);
echo "</form>";
echo "</body>";

?>
