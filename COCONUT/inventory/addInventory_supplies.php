<?php
include("../../myDatabase.php");
$username = $_GET['username'];
$status = $_GET['status'];
$oldStockCardNo = $_GET['stockCardNo'];
$description = $_GET['description'];

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

if( $status == "new" ) {
	$stockCardNo = $ro->selectNow("trackingNo","value","name","stockCardNo");
	$newStockCardNo = ( $stockCardNo + 1 );
	$ro->editNow("trackingNo","name","stockCardNo","value",$newStockCardNo);
/*	
$ro->getInventoryStockCardNo();
$myFile = $ro->getReportInformation("homeRoot")."/COCONUT/trackingNo/stockCardNo.dat";
$fh = fopen($myFile, 'r');
$stockCardNo = fread($fh, 100);
fclose($fh);
*/
}else {
$stockCardNo=$oldStockCardNo;
}


$description1 = $_GET['description'];

echo "<body onload='DisplayTime();'>";
echo "<form method='post' action='addInventory_insert.php'>";
echo "<input type='hidden' name='description1' value='$description1' />";
echo "<input type='hidden' name='genericName1' value='' />";
echo "<br><center><div style='border:1px solid #000000; width:500px; height:530px; border-color:black black black black;'>";
echo "<br><table border=0 cellpadding=0 cellspacing=0>";
echo "<input type=hidden name='inventoryType' value='supplies'>";
echo "<input type=hidden name='generic' value=''>";
echo "<input type=hidden name='month' value=''>";
echo "<input type=hidden name='day' value=''>";
echo "<input type=hidden name='year' value=''>";
echo "<input type=hidden name='additional' value=''>";
echo "<input type=hidden name='pricing' value=''>";
echo "<input type=hidden name='year' value=''>";
echo "<input type=hidden name='addedBy' value='$username'>";
echo "<tr>";
echo "<td><div class='style1'>Description&nbsp;</div></td>";
if( $status == "old" ) {
echo "<td><input type=text class='txtBox' name='description' value='$description' readonly autocomplete='off'></td>";
}else {
echo "<td><input type=text class='txtBox' name='description' value='$description' autocomplete='off'></td>";
}
echo "</tr>";

echo "<tr>";
echo "<td><div class='style1'>Unit Cost&nbsp;</div></td>";
echo "<td><input type=text class='shortField' name='unitcost' autocomplete='off'></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font class='style1'>Unit of Measure&nbsp;</font></td>";
echo "<td>";
$ro->coconutTextBox("unitOfMeasure","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td><div class='style1'>Selling Price&nbsp;</div></td>";
echo "<td><input type=text class='shortField' name='pricing' autocomplete='off'></td>";
echo "</tr>";

echo "<tr>";
echo "<td><div class='style1'>Quantity&nbsp;</div></td>";
echo "<td><input type=text class='shortField' name='quantity' autocomplete='off'></td>";
echo "</tr>";


echo "<tr>";
echo "<td><font class='labelz'>B.I QTY&nbsp;</font></td>";
echo "<td><input type=text class='shortField' name='biQTY' value='$biQTY' readonly autocomplete='off'>&nbsp;&nbsp;<a href='/COCONUT/inventory/bi.php?stockCardNo=$stockCardNo&username=$username&status=$status&genericName=&description=$description' style='text-decoration:none;'><font size=2 color=red>[Add B.I]</font></a></td>";
echo "</tr>";


echo "<tr>";
echo "<td><font class='labelz'>B.I inventoryCode&nbsp;</font></td>";
echo "<td><input type=text class='shortField' name='biInventoryCode' value='$biInventoryCode' readonly autocomplete='off'>&nbsp;&nbsp;</td>";
echo "</tr>";



echo "<tr>";
echo "<td><div class='style1'>Beginning Balance&nbsp;</div></td>";
echo "<td><input type=text class='shortField' name='beginningBalance' autocomplete='off'></td>";
echo "</tr>";

echo "<tr>";
echo "<td><div class='style1'>Expiration&nbsp;</div></td>";
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

echo "&nbsp;<select name='dayExpired' style='border:1px solid #000; width:60px; height:30px; padding:4px 4px 4px 5px; '>";
for($x=1;$x<=31;$x++) {
if($x < 9) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
echo "</select>";
echo "&nbsp;<input type=text name='yearExpired' value='".date("Y")."' class='bdayField' autocomplete='off'>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td><div class='style1'>Date Added&nbsp;</div></td>";
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

echo "&nbsp;<select name='dayAdded' style='border:1px solid #000; width:60px; height:30px; padding:4px 4px 4px 5px; '>";
echo "<option value='".date("d")."'>".date("d")."</option>";
for($x=1;$x<=31;$x++) {
if($x < 9) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
echo "</select>";
echo "&nbsp;<input type=text name='yearAdded' value='".date("Y")."' class='bdayField' autocomplete='off'>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td><div class='style1'>Location&nbsp;</div></td>";
echo "<td>";
echo "<select class='comboBox' name='inventoryLocation'>";
echo "<option value='PHARMACY'>PHARMACY</option>";
$ro->showInventoryLocation();
echo "</select>";
echo "</td>";
echo "</tr>";


$ro->coconutHidden("branch","");
$ro->coconutHidden("transition","");
$ro->coconutHidden("phic","");

echo "<tr>
<td><div class='style1'>Critical Level</div></td>
<td><input type=text name='criticalLevel' class='txtBox' autocomplete='off'></td>
</tr>";

echo "<tr>
<td><div class='style1'>Remarks</div></td>
<td><input type=text name='remarks' class='txtBox' autocomplete='off'></td>
</tr>";

echo "<tr>
<td><div class='style1'>Supplier</div></td>
<td><select name='supplier' class='txtBox'>"; 
echo "<option value=''></option>";
$ro->showOption("supplier","supplierName");
echo "</select></td>
</tr>";


echo "<tr>
<td><div class='style1'>Auto Dispense</div></td>
<td><select name='autoDispense' class='txtBox'>"; 
echo "<option value='no'>no</option>";
echo "<option value='yes'>yes</option>";
echo "</select></td>
</tr>";


echo "
<tr>
<td><div class='style1'>Classification</div></td>
<td>
<select name='classification' class='txtBox'>
<option value='inventory'>Invnetory</option>
<option value='noInventory'>No Invnetory</option>
</select>
</td>
</tr>
";


echo "</table>";
echo "<p id='curTime'>";
echo "</div>";
echo "<input type='submit' value='Proceed'>";
echo "<input type='hidden' name='preparation' value=''>";
echo "<input type='hidden' name='phicPrice' value=''>";
$ro->coconutHidden("stockCardNo",$stockCardNo);
$ro->coconutHidden("status",$status);
$ro->coconutHidden("ipdPrice","");
$ro->coconutHidden("opdPrice","");
echo "<input type='hidden' name='companyPrice' value=''>";
echo "</form>";
echo "</body>";

?>
