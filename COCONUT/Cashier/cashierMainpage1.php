<?php
include("../../myDatabase.php");
session_start();
$username = $_SESSION['username'];
$module = $_SESSION['module'];
$ro = new database();


if ( (!isset($username) && !isset($module)) ) {
header("Location:/LOGINPAGE/module.php ");
die();
}


?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/flow/rickyCSS1.css" />
        <script type="text/javascript" src="http://<?php echo $ro->getMyUrl() ?>/Registration/menu/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="http://<?php echo $ro->getMyUrl() ?>/Registration/menu/jquery.fixedMenu.js"></script>
        <link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl();?>/Registration/menu/fixedMenu_style1.css" />

<?php

echo "<script type='text/javascript'>

        $('document').ready(function(){
            $('.menu').fixedMenu();

        });


$('#breadcrumbs a').hover(
    function () {
        $(this).addClass('hover').children().addClass('hover');
        $(this).parent().prev().find('span.arrow:first').addClass('pre_hover');
    },
    function () {
        $(this).removeClass('hover').children().removeClass('hover');
        $(this).parent().prev().find('span.arrow:first').removeClass('pre_hover');
    }
);
</script>
";

?>


<ol id="breadcrumbs">
        <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Cashier/mySession.php"><font color=white>Home</font><span class="arrow"></span></a></li>
        <li><a href="#" class='odd'><font color=yellow>Cashier</font><span class="arrow"></span></a></li>

    <li>&nbsp;&nbsp;</li>
</ol>
 <div class="menu">
        <ul>
            <li>
                <a href="#">Transaction<span class="arrow"></span></a>
                
                <ul>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Cashier/cashierShift.php?module=<?php echo $module; ?>&username=<?php echo $username; ?>" target="departmentX" >Diagnostics</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Cashier/searchBalance.php?username=<?php echo $username; ?>" target="departmentX">Balance</a></li>

                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Cashier/mySession.php" target="_self">Log out</a></li>

                    <li><a href="#"></a></li>
                </ul>
            </li>
            <li>
                <a href="#">Reports<span class="arrow"></span></a>
                <ul>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Cashier/cashierReport/reportShift.php?module=<?php echo $module; ?>&username=<?php echo $username; ?>&reportName=Collection&status=PAID" target="departmentX">Collection</a></li>
                  
                </ul>
            </li>           
        </ul>
    </div>


<iframe src="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Cashier/logout.php?" width="991" height="540" style="overflow-x:hidden; " name="departmentX" border=1 frameborder=no></iframe>
