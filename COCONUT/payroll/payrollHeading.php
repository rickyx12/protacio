<?php
include("../../myDatabase.php");
session_start();
$username = $_SESSION['username'];
$module = $_SESSION['module'];

$ro = new database();

/*
if ( (!isset($username) && !isset($module)) ) {
header("Location:http://".$ro->getMyUrl()."/LOGINPAGE/module.php ");
}
*/
?>

<html>
<head>
<title>Payroll</title>
<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/flow/rickyCSS1.css" />
        <script type="text/javascript" src="http://<?php echo $ro->getMyUrl() ?>/Registration/menu/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="http://<?php echo $ro->getMyUrl() ?>/Registration/menu/jquery.fixedMenu.js"></script>
        <link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl();?>/Registration/menu/fixedMenu_style1.css" />

<?php
//hmoSOA.php

echo "
<script type='text/javascript'>

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


var username = 'Search Patient';
function SetMsg(txt,active) {
    if (txt == null) return;
    
    if (active) {
        if (txt.value == username) txt.value = '';                     
    } else {
        if (txt.value == '') txt.value = username;
    }
}

window.onload=function() { SetMsg(document.getElementById('searchPatient', false)); }
</script>

<style type='text/css'>
.txtBox {
	border: 1px solid #CCC;
	color: #999;
	height: 50px;
	width: 350px;
}
</style>

";

?>
</head>
<body>
<ol id="breadcrumbs">
        <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/payroll/initializePayroll.php"><font color=white>Home</font><span class="arrow"></span></a></li>
        <li><a href="#" class='odd'><font color=yellow><?php echo $_SESSION['module']; ?></font><span class="arrow"></span></a></li>

    <li>&nbsp;&nbsp;</li>
</ol>


    <div class="menu">
        <ul>

            <li>
                <a href="#">Contribution Table<span class="arrow"></span></a>
                <ul>
<?php //admin_reportRange.php?module=&username=&reportName=Laboratory ?>

                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/payroll/sssTable.php?username=<?php echo $username; ?>" target="departmentX">SSS Contribution</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/payroll/phicTable.php?username=<?php echo $username; ?>" target="departmentX">PhilHealth Contribution</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/payroll/pagibigTable.php?username=<?php echo $username; ?>" target="departmentX">Pag-Ibig Contribution</a></li>


<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/payroll/withholdingTaxTable.php?module=<?php echo $module; ?>&username=<?php echo $username; ?>" target="departmentX">Withholding Tax</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/payroll/payrollData.php?username=<?php echo $username; ?>" target="departmentX">Employee List</a></li>
                

 </ul>
           </li>    





            <li>
                <a href="#">Reports<span class="arrow"></span></a>
                <ul>
<?php //admin_reportRange.php?module=&username=&reportName=Laboratory ?>

<li><a href="/COCONUT/payroll/sssReport/rangeMonthlyReport.php" target="departmentX">SSS Employer Share Monthly</a></li>

<li><a href="/COCONUT/payroll/phicReport/rangeMonthlyReport.php" target="departmentX">PhilHealth Employer Share Monthly</a></li>

<li><a href="/COCONUT/payroll/pagibigReport/rangeMonthlyReport.php" target="departmentX">Pag-Ibig Employer Share Monthly</a></li>


<li><a href="#" target="departmentX">Withholding Tax Monthly</a></li>

<li><a href="/COCONUT/payroll/payrollRangeMonthlyReport.php" target="departmentX">Payroll Monthly</a></li>
                

 </ul>
           </li>    







    </div>



<iframe src="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/payroll/payrollData.php?username=<?php echo $username; ?>" width="1300" height="540"  name="departmentX" border=1 frameborder=no></iframe>

</body>
</html>
