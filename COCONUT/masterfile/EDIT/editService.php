<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$service = $_GET['service'];
$category = $_GET['category'];
$serviceNo = $_GET['serviceNo'];
$show = $_GET['show'];
$desc = $_GET['desc'];
$ro = new database();

?>


<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/flow/rickyCSS1.css" />
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
echo "
<style type='text/css'>
.txtBox {
	border: 1px solid #CCC;
	color: #999;
	height: 20px;
	width: 300px;
}

.comboBox {
	border: 1px solid #000;
	color: #000;
	height: 20px;
	width: 200px;
}

</style>
";

/*
echo "<table id='headz' border=0 bgcolor='#3b5998' width='100%'>
<td>&nbsp;&nbsp;<font size=5 color=white><b>Maintenance > Service Entry</b></font></td></table>";
*/
echo "<br>";
echo "<form method='get' action='editService1.php'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<input type=hidden name='serviceNo' value='$serviceNo'>";
echo "<input type=hidden name='show' value='$show'>";
echo "<input type=hidden name='desc' value='$desc'>";
echo "<div style='border:1px solid #000000; width:420px; height:150px; border-color:black black black black;'>";
echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;<font size=4>Service:</font>&nbsp;<input type=text name='service' class='txtBox' value='$service'><br>";
echo "&nbsp;<font size=4>Category:</font>&nbsp;<select name='category' class='comboBox'>";
echo "<option value='$category'>$category</option>";
$ro->getCategory();
echo "</select>";
echo "<br><br><br>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=submit value='Add Service >>' style='border:1px solid #000; background-color:#3b5998; color:white'>";
echo "</div>";
echo "</form>";
?>
