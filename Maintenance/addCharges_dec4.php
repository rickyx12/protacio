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
	border: 1px solid #000;
	color: #000;
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
<form method='get' action='addCharges1.php'>
<Br>
<div style='border:1px solid #000000; width:400px; height:270px; border-color:black black black black;'><br>
&nbsp;<font size=2>Description:</font>&nbsp;<input type=text name='description' class='txtBox'><Br><br>
&nbsp;&nbsp;&nbsp;&nbsp;<font size=2>Price:</font>&nbsp;<input type=text name='opdprice' class='txtBox'>
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=2>Service:</font>&nbsp;
<select name='services' style='border:1px solid #000000; width:200px; height:20px;  ' >";
echo "<option>Examination</option>";
echo "<option>Package</option>";
echo "</select>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=2>Type:</font>&nbsp;
<select name='subCategory' style='border:1px solid #000000; width:200px; height:20px;  ' >";
echo "<option value=''></option>";
echo "<option value='hematology'>Hematology</option>";
echo "<option value='clinchem'>Clinical Chemistry</option>";
echo "<option value='urinalysis'>Urinalysis</option>";
echo "<option value='serology'>Serology</option>";
echo "<option value='fecalysis'>Fecalysis</option>";
echo "</select>
<br><br>
<br>
<input type=hidden name='category' value='$module'>
<input type=hidden name='username' value='$username'>
<Br><Br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=submit value='ADD CHARGES >>' style='border:1px solid #000000; background-color:#3b5998; color:white;'>
</form>

</div>
";


?>
