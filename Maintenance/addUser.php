<?php
include("../myDatabase.php");
$username = $_GET['usernamez'];
$ro = new database();

?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/flow/rickyCSS1.css" />

<style type='text/css'>
.labelz {
font-size:13px;
}

.txtBox {
	border: 1px solid #000;
	color: #000;
	height: 30px;
	width: 320px;
	padding:4px 4px 4px 5px;
}

.comboBox {
	border: 1px solid #000;
	color: #000;
	height: 30px;
	width: 320px;
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

echo "<br><center><div style='border:1px solid #000000; width:500px; height:215px; border-color:black black black black;'>";
echo "<form method='post' action='addUser1.php'>";
echo "<input type=hidden name='usernamez' value='$username'>";
echo "<Br><br>
<table border=0 cellspacing=0 cellpadding=0>
<tr>
<td><font class='labez'>Username</font>&nbsp;</td>
<td><input type=text name='username' class='txtBox'></td>
</tr>

<tr>
<td><font class='labez'>Password</font>&nbsp;</td>
<td><input class='txtBox' type='password' name='password'></td>
</tr>
<tr>
<td><font class='labez'>Module</font>&nbsp;</td>
<td>
<select name='module' class='comboBox'>
<option value=''></option>
<option value='BILLING'>BILLING</option>
<option value='CASHIER'>CASHIER</option>
<option value='LABORATORY'>LABORATORY</option>
<option value='ULTRASOUND'>ULTRASOUND</option>
<option value='XRAY'>XRAY</option>
<option value='MAINTENANCE'>MAINTENANCE</option>
<option value='REGISTRATION'>REGISTRATION</option>
<option value='PATIENT'>PATIENT</option>
<option value='PHILHEALTH'>PHILHEALTH</option>
<option value='PHARMACY'>PHARMACY</option>
<option value='ADMIN'>ADMIN</option>
<option value='ER'>ER</option>
<option value='REHAB'>REHAB</option>
";

if( $ro->selectNow("reportHeading","information","reportName","rehab") == "Activate" ) {
echo "<option value='REHAB'>REHAB</option>";
}else { }

echo "</select></td>
</tr>
<tr>
<td>Branch</td>
<td><select name='branch' class='comboBox'>
";
$ro->getBranch();
echo "</select></td>
</tr>

<tr>
<Td>Name:&nbsp;</tD>
<td><input class='txtBox' type='text' name='completeName'></td>
</tr>

</table>";
echo "<br><input type=submit value='Register' style='border:1px solid #000; background-color:#3b5998; color:white'>";
echo "</div>";
echo "</form>";


?>
