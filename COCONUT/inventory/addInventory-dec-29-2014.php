<?php
include("../../myDatabase.php");
$username = $_GET['username'];
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

echo "<body onload='DisplayTime();'>";
echo "<form method='post' action='addInventory_insert.php'>";
echo "<br><center><div style='border:1px solid #000000; width:500px; height:460px; border-color:black black black black;'>";
echo "<br><table border=0 cellpadding=0 cellspacing=0>";
echo "<input type=hidden name='inventoryType' value='medicine'>";
echo "<input type=hidden name='addedBy' value='$username'>";
echo "<tr>";
echo "<td><font class='labelz'>Description&nbsp;</font></td>";
echo "<td><input type=text class='txtBox' name='description' autocomplete='off'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Generic&nbsp;</font></td>";
echo "<td><input type=text class='txtBox' name='generic' autocomplete='off'></td>";
echo "</tr>";
echo "<tr>";
echo "<tr>";
echo "<td><font class='labelz'>Preparation&nbsp;</font></td>";
echo "<td>";
$ro->coconutTextBox("preparation","");
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
echo "<td><font class='labelz'>Expiration&nbsp;</font></td>";
echo "<td>";
echo "
<select name='month' class='comboBoxShort'>
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

echo "&nbsp;<select name='day' width='10'>";
for($x=1;$x<=31;$x++) {
if($x < 9) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
echo "</select>";
echo "&nbsp;<input type=text name='year' class='bdayField' value='".date("Y")."' autocomplete='off'>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Date&nbsp;</font></td>";
echo "<td><input type=text class='shortField' name='date' value=".date("Y-m-d")."></></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Location&nbsp;</font></td>";
echo "<td>";
echo "<select class='comboBox' name='inventoryLocation'>";
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
<td><font class='labelz'>PhilHealth</font></td>
<td><select name='phic' class='txtBox'>";
echo "<option value='no'>No</option>"; 
echo "<option value='yes'>Yes</option>";
echo "</select></td>
</tr>";

echo "<tr>
<td>";
echo "<select name='pricing' style='width=20%; border: 1px solid #000; color: #000;' >";
echo "<option value='sellingPrice'>sellingPrice</option>";
$ro->coconutComboBoxStop();
echo "</td>
<td><input type=text name='additional' class='txtBox'></td>
</tr>";

echo "<tr>
<td><font class='labelz'>Remarks</font></td>
<td><input type=text name='remarks' class='txtBox'></td>
</tr>";

echo "<tr>
<td><font size='2.5'>Critical Level</font></td>
<td><input type=text name='criticalLevel' class='txtBox'></td>
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


echo "</table>";
echo "<p id='curTime'>";
echo "</div>";
echo "<Br><Br>";
echo "<input type='submit' value='Proceed'>";
$ro->coconutHidden("phicPrice","");
$ro->coconutHidden("companyPrice","");
echo "<input type='hidden' name='classification' value=''>";
echo "</form>";
echo "</body>";

?>
