<?php
include("../myDatabase.php");

$module = $_GET['module'];
$username = $_GET['username'];
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
<font size=4><?php echo $module; ?></font>
<?php
echo "
<style type='text/css'>
.txtBox {
	border: 1px solid #CCC;
	color: #999;
	height: 20px;
	width: 300px;
}

.prices {
	border: 1px solid #CCC;
	color: #000;
	height: 20px;
	width: 70px;

}
</style>

";
/*
echo "<table id='headz' border=0 bgcolor='#3b5998' width='100%'>
<td>&nbsp;&nbsp;<font size=5 color=white><b>Maintenance > $module</b></font></td></table>";
*/

echo "
<form method='get' action='addPackage1.php'>
<Br>
<div style='border:1px solid #000000; width:400px; height:270px; border-color:black black black black;'><br>
&nbsp;<font size=2>Description:</font>&nbsp;<input type=text name='description' class='txtBox'><Br>
<br>
&nbsp;&nbsp;&nbsp;<font size=2>Price</font>&nbsp;<input type=text name='price' class='txtBox'>
<br><font size=2>PF</font>&nbsp;<input type=text name='pf' class='txtBox'>
";

echo "<Br><Br>&nbsp;&nbsp;&nbsp;<input type=submit value='ADD CHARGES >>' style='border:1px solid #000000; background-color:#3b5998; color:white;'>
</form></div>
";


?>
