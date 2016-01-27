<?php
include("../myDatabase.php");
$username = $_GET['username'];

$ro = new database();
?>

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

<ol id="breadcrumbs">
    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/LOGINPAGE/module.php"><font color=white>Home</font><span class="arrow"></span></a></li>
    <li><a href="#" class='odd'><font color=yellow>Maintenance</font><span class="arrow"></span></a></li>
    <li>&nbsp;&nbsp;</li>
</ol>

<?php

echo "<br><br>";
echo "<br><div style='border:1px solid #000000; background-color:#3b5998; border-color:black black white black; width:400px; height:20px;'>";
echo "&nbsp;<font size=4 color=white><b>Departamental Charges Entry</b></font></div>

<div style='border:1px solid #000000; width:400px; height:180px; border-color:white black black black;'><br>
<form method='get' action='addCharges.php'>
<input type=hidden name='module' value='LABORATORY'>
<input type=hidden name='username' value='$username'>
&nbsp;<input type=submit value='Add Laboratory Charges' style='background-color:#3b5998; color:white'>
</form>
<form method='get' action='addCharges.php'>
<input type=hidden name='module' value='RADIOLOGY'>
<input type=hidden name='username' value='$username'>
&nbsp;<input type=submit value='Add Radiology Charges' style='background-color:#3b5998; color:white'>
</form>
</div>
";


echo "<br><Br>";
echo "<br><div style='border:1px solid #000000; background-color:#3b5998; border-color:black black white black; width:400px; height:20px;'>";
echo "&nbsp;<font size=4 color=white><b>Inventory</b></font></div>
<div style='border:1px solid #000000; width:400px; height:90px; border-color:white black black black;'>
<br><form method='get' action='http://".$ro->getMyUrl()."/COCONUT/inventory/addInventory.php'>
&nbsp;<input type=submit value='Add Medicine' style='background-color:#3b5998; color:white'>
<input type=hidden name='username' value='$username'>
</form>
<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/inventory/addInventory_supplies.php'>
&nbsp;<input type=submit value='Add Supplies' style='background-color:#3b5998; color:white'>
<input type=hidden name='username' value='$username'>
</form>
</div>
";


echo "<br><Br>";
echo "<br><div style='border:1px solid #000000; background-color:#3b5998; border-color:black black white black; width:400px; height:20px;'>";
echo "&nbsp;<font size=4 color=white><b>Doctor's</b></font></div>
<div style='border:1px solid #000000; width:400px; height:125px; border-color:white black black black;'>
<br><form method='get' action='http://".$ro->getMyUrl()."/COCONUT/Doctor/addNewDoctor.php'>
&nbsp;<input type=submit value='Add Doctor' style='background-color:#3b5998; color:white'>
<input type=hidden name='username' value='$username'>
</form>
<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/Doctor/addNewDoctorService.php'>
&nbsp;<input type=submit value='Add Doctor Service' style='background-color:#3b5998; color:white'>
<input type=hidden name='username' value='$username'>
</form>
</div>
";



echo "<br><Br>";
echo "<br><div style='border:1px solid #000000; background-color:#3b5998; border-color:black black white black; width:400px; height:20px;'>";
echo "&nbsp;<font size=4 color=white><b>Others</b></font></div>
<div style='border:1px solid #000000; width:400px; height:165px; border-color:white black black black;'>
<br><form method='get' action='addService.php'>
<input type=hidden name='username' value='$username'>
&nbsp;<input type=submit value='Add Service' style='background-color:#3b5998; color:white'>
</form>
<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/Company/addCompany.php'>
<input type=hidden name='username' value='$username'>
&nbsp;<input type=submit value='Add Company' style='background-color:#3b5998; color:white'>
</form>

<form method='get' action='http://".$ro->getMyUrl()."/Maintenance/addUser.php'>
<input type=hidden name='usernamez' value='$username'>
&nbsp;<input type=submit value='Add User' style='background-color:#3b5998; color:white'>
</form>

<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/diagnosticTimer/diagnosticTimer.php'>
<input type=hidden name='usernamez' value='$username'>
&nbsp;<input type=submit value='Diagnostic Timer' style='background-color:#3b5998; color:white'>
</form>

<form method='get' action='http://".$ro->getMyUrl()."/Maintenance/addBranch.php'>
<input type=hidden name='usernamez' value='$username'>
&nbsp;<input type=submit value='Add Branch' style='background-color:#3b5998; color:white'>
</form>

</div>
";


?>








