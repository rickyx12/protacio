<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$branchID = $_GET['branchID'];
$branch = $_GET['branch'];
$show = $_GET['show'];
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

echo "<br><center><div style='border:1px solid #000000; width:500px; height:140px; border-color:black black black black;'>";
echo "<form method='post' action='editBranch1.php'>";
echo "<input type=hidden name='branchID' value='$branchID'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<input type=hidden name='show' value='$show'>";
echo "<Br><br>
<table border=0 cellspacing=0 cellpadding=0>
<tr>
<td><font class='labez'>Branch</font>&nbsp;</td>
<td><input type=text name='branch' class='txtBox'value='$branch'></td>
</tr>
</table>";
echo "<br><input type=submit value='Proceed' style='border:1px solid #000; background-color:#3b5998; color:white'>";
echo "</div>";
echo "</form>";


?>
