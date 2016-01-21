<?php
include("../../myDatabase.php");
$ro = new database();
?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />
<form method="get" action="hmoSOA1.php">
<br><br><center>
<div style='border:1px solid #000000; width:500px; height:162px; border-color:black black black black;'>
<br><table border=0 cellpadding=0 cellspacing=0>
<tr>
<td><font class='labelz'>Company</font></td>
<td>&nbsp;<select name='company' class='comboBox'>
<?php $ro->getAllCompany(); ?>
</select>&nbsp;</td>
</tr>

<tr>
<td><font class='labelz'>From Date:</font></td>
<td>&nbsp;<select name='fromMonth' class='comboBoxShort'>
<option value="01">Jan</option>
<option value="02">Feb</option>
<option value="03">Mar</option>
<option value="04">Apr</option>
<option value="05">May</option>
<option value="06">Jun</option>
<option value="07">Jul</option>
<option value="08">Aug</option>
<option value="09">Sep</option>
<option value="10">Oct</option>
<option value="11">Nov</option>
<option value="12">Dec</option>
</select> - 
<select name="fromDay" class="comboBoxShort">
<?php 

for($x=1;$x<32;$x++) {
if($x<10) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
 ?>
</select> - 
<input type="text" class="shortField" name="fromYear" value="<?php echo date('Y') ?>">
&nbsp;</td>
</tr>

<tr>
<td><font class='labelz'>To Date:</font></td>
<td>&nbsp;<select name='toMonth' class='comboBoxShort'>
<option value="01">Jan</option>
<option value="02">Feb</option>
<option value="03">Mar</option>
<option value="04">Apr</option>
<option value="05">May</option>
<option value="06">Jun</option>
<option value="07">Jul</option>
<option value="08">Aug</option>
<option value="09">Sep</option>
<option value="10">Oct</option>
<option value="11">Nov</option>
<option value="12">Dec</option>
</select> - 
<select name="toDay" class="comboBoxShort">
<?php 

for($x=1;$x<32;$x++) {
if($x<10) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
 ?>
</select> - 
<input type="text" class="shortField" name="toYear" value="<?php echo date('Y') ?>">
&nbsp;</td>
</tr>
<tr>
<td><font class="labelz">Branch</font></td>
<td><select name="branch" class="comboBox">
<option value="All">All</option>
<?php $ro->showOption("branch","branch"); ?>
</select></td>
</tr>
</table><br><br>
<?php $ro->coconutButton("Proceed"); ?>
</form>
</div>
