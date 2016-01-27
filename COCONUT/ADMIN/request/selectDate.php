<?php 
include("../../../myDatabase.php");
require_once('../../authentication.php');
$username = $_POST['username'];
$ro = new database();
$ro->coconutDesign();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<script src="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/js/jquery-1.9.1.js"></script>
<script src="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/js/jquery-ui.js"></script>


<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/flow/rickyCSS1.css" />
<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/Registration/menu/fixedMenu_style1.css" />
<script>


$(function() {
$("#date").datepicker({ "dateFormat":"yy-mm-dd" });
});


</script>
</head>
<body>

<ol id="breadcrumbs">
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/ADMIN/request/initializeRequest.php"><font color=white>Home</font><span class="arrow"></span></a></li>
<li><a href="#" class='odd'><font color=yellow>Admin Approval</font><span class="arrow"></span></a></li>
<li>&nbsp;&nbsp;</li>
</ol>
<?php 
echo '<div class="menu"><ul>';
$ro->coconutUpperMenuStop();
?>
<br><br><br><br><Br>

<?php $ro->coconutBoxStart("500","100"); ?>
<?php $ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/ADMIN/request/table.php"); ?>
<center>
<p>Date:&nbsp;<?php $ro->coconutTextBox("date",date("Y-m-d")); ?></p>
</center>
<?php $ro->coconutButton("Proceed"); ?>
<?php $ro->coconutHidden("username",$username); ?>
<?php $ro->coconutHidden("makeDo",""); ?>
<?php $ro->coconutFormStop(); ?>
<?php $ro->coconutBoxStop(); ?>
</body>
</html>
