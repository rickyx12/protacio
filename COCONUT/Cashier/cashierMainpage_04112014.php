<?php
include("../../myDatabase.php");
require_once('../authentication.php');
//session_start();
$username = $_SESSION['username'];
$module = $_SESSION['module'];
$ro = new database();


if ( (!isset($username) && !isset($module)) ) {
header("Location:/LOGINPAGE/module.php ");
die();
}


?>
<title>CASHIER</title>

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

";



echo "$(document).ready(function(){ ";
echo "getApproved();";
echo "});";
echo "function getApproved(){";
echo  "$('#totalApproved').load('http://".$ro->getMyUrl()."/COCONUT/ADMIN/request/totalApproved.php',{ 'date':'".date("Y-m-d")."','username':'".$username."' }, function(){";
echo  "   setTimeout(getApproved, 6000);";
echo   "  });";
echo   " }";
echo "</script>";

?>


<ol id="breadcrumbs">
        <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Cashier/initializeCashier.php"><font color=white>Home</font><span class="arrow"></span></a></li>
        <li><a href="#" class='odd'><font color=yellow>Cashier</font><span class="arrow"></span></a></li>

    <li>&nbsp;&nbsp;</li>
</ol>
 <div class="menu">
        <ul>
            <li>
                <a href="#">Transaction<span class="arrow"></span></a>
                
                <ul>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Cashier/cashierShift.php?module=<?php echo $module; ?>&username=<?php echo $username; ?>" target="departmentX" >Diagnostics</a></li>

                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/accounting/voucher/addVoucher.php?username=<?php echo $username; ?>" target="departmentX">Expenses</a></li>


                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/Payments/manualPayment.php?username=<?php echo $username; ?>" target="departmentX">Manual Payments</a></li>

<li>
<form method="post" action="/COCONUT/currentPatient/patientInterface.php" target="_blank">
<input type="hidden" name="module" value="<?php echo $module; ?>">
<input type="hidden" name="patientSearch" value="">
<input type="hidden" name="username" value="<?php echo $username; ?>">
<input type="submit" value="Search Patient">
</form>
</li>


<?

//$ro->coconutUpperMenu_headingMenu_target("http://".$ro->getMyUrl()."/Department/redirectSearch.php?username=$username&completeName=&module=$module","Search Patient","_blank");




/*
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/unknownUser/verifyUser.php?username=&registrationNo=" target="_blank">Search Patient</a></li>
*/
?>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/Registration/specialRegistration/unknownPatient.php?username=<?php echo $username ?>" target="_blank">Unknown Patient</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/systemBiller/generatorCharge/generatorShift.php?username=<?php echo $username ?>" target="departmentX">Generator</a></li>

                  
                </ul>
            </li>
            <li>
                <a href="#">Reports<span class="arrow"></span></a>
                <ul>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Cashier/cashierReport/reportShift.php?module=<?php echo $module; ?>&username=<?php echo $username; ?>&reportName=Collection&status=PAID" target="departmentX">Collection</a></li>


<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Cashier/cashCollection/cashCollection_output_date.php?username=<?php echo $username; ?>" target="_blank">Cash Collection</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Reports/hmoSOA_type.php?username=<?php echo $username; ?>&reportName=Remittance" target="departmentX">Company (Receivable)</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Cashier/cashierReport/summarizeReportShift.php?module=<?php echo $module; ?>&username=<?php echo $username; ?>&reportName=Summarize Collection&status=PAID" target="departmentX">Summarize Collection</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Doctor/doctorModule/doctorPF_shift.php?username=<?php echo $username; ?>&module=<?php echo $module; ?>" target="departmentX">IPD Individual Doctor's PF</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Doctor/doctorModule/doctorPF_shift_opd.php?username=<?php echo $username; ?>&module=<?php echo $module; ?>&username=<?php echo $username; ?>" target="departmentX">OPD Doctor's PF</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Cashier/showVoucher_date.php?username=<?php echo $username; ?>&module=<?php echo $module; ?>&username=<?php echo $username; ?>" target="departmentX">Expenses</a></li>


<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Reports/doctorReport/shift_ipd.php?username=<?php echo $username; ?>&module=<?php echo $module; ?>&username=<?php echo $username; ?>" target="departmentX">IPD Doctors PF</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/ADMIN/discharged_cutoff.php?username=<?php echo $username; ?>&module=<?php echo $module; ?>&username=<?php echo $username; ?>" target="departmentX">Discharged Report</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Reports/cashReport_date.php?username=<?php echo $username; ?>" target="_blank">Chart of Accounts</a></li>

                  
                </ul>
            </li>        





            <li>
                <a href="#">Approved <span id='totalApproved'></span></a>
                
                <ul>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/ADMIN/request/viewApprovedRequest.php?date=<?php echo date('Y-m-d'); ?>&username=<?php echo $username; ?>" target="departmentX" >View Approved Request</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/ADMIN/request/requestStatus_date.php?date=<?php echo date('Y-m-d'); ?>&username=<?php echo $username; ?>" target="departmentX" >View All Request</a></li>
 </ul>
</li>

</ul>
</div>


<iframe src="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Cashier/cashierPage.php?" style="border:0px; width:100%; height:100%; style="overflow-x:hidden; " name="departmentX" border=1 frameborder=no></iframe>
