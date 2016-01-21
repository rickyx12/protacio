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
        <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/ADMIN/initializeAdmin.php"><font color=white>Home</font><span class="arrow"></span></a></li>
        <li><a href="#" class='odd'><font color=yellow><?php echo $_SESSION['module']; ?></font><span class="arrow"></span></a></li>

    <li>&nbsp;&nbsp;</li>
</ol>


    <div class="menu">
        <ul>
            <li>
                <a href="#">Inventory<span class="arrow"></span></a>
                
                <ul>
		<?php $ro->getAdminBranchMeds($username); ?>
		<?php $ro->getAdminBranchSupplies($username); ?>
                </ul>
            </li>
            <li>
                <a href="#">Financial<span class="arrow"></span></a>
                <ul>
<?php //admin_reportRange.php?module=&username=&reportName=Laboratory ?>

                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Reports/billing/selectType.php?module=<?php echo $module; ?>&username=<?php echo $username; ?>&reportName=Laboratory" target="departmentX">Cash (Paid)</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Reports/hmoSOA_type.php?username=<?php echo $username; ?>&reportName=Remittance" target="departmentX">Company (Receivable)</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Reports/companySummary/selectCutoff.php?username=<?php echo $username; ?>&reportName=Remittance" target="departmentX">Company Summary (Receivable)</a></li>
                  
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/philhealth/phicReceivables/dateCovered.php?username=<?php echo $username; ?>" target="departmentX">PhilHealth (Receivable)</a></li

  <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Reports/doctorReport/selectType.php?username=<?php echo $username; ?>" target="departmentX">Doctor's PF</a></li>



                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Reports/doctorReport/selectShiftBranch.php?username=<?php echo $username; ?>" target="departmentX">Doctor's PF Summary</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/philhealth/transmitalShift.php?username=<?php echo $username; ?>&module=<?php echo $module; ?>" target="departmentX">PhilHealth Transmital</a></li>
                            <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/philhealth/transmittedShift.php?username=<?php echo $username; ?>&module=<?php echo $module; ?>" target="departmentX">PhilHealth Transmitted</a></li>  

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/ADMIN/voidPayment_shift.php?username=<?php echo $username; ?>&module=<?php echo $module; ?>" target="departmentX">Void Payments</a></li>

 </ul>
           </li>    



            <li>
                <a href="#">Census<span class="arrow"></span></a>
                
                <ul>
		<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Reports/Census/selectShift.php?username=<?php echo $username; ?>&switch=1" target="departmentX">Departamental Patient Census</a></li>
		<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Reports/Census/selectShift.php?username=<?php echo $username; ?>&switch=2" target="departmentX">Departamental Examination Census</a></li>
		<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Reports/Census/selectShift_registered.php?username=<?php echo $username; ?>&switch=2" target="departmentX">Registration Census</a></li>


                </ul>
            </li>


 <li>
                <a href="#">Search<span class="arrow"></span></a>
                <ul>
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchCharges.php?username=<?php echo $username; ?>&title=LABORATORY&show=search" target="departmentX">Laboratory Charges</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchCharges.php?username=<?php echo $username; ?>&title=RADIOLOGY&show=search" target="departmentX">Radiology Charges</a></li>


                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchInventory.php?username=<?php echo $username; ?>&inventoryType=medicine&branch=All&show=search" target='departmentX'>Medicine</a></li>
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchInventory.php?username=<?php echo $username; ?>&inventoryType=supplies&branch=All&show=search" target='departmentX'>Supplies</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchInventory.php?username=<?php echo $username; ?>&inventoryType=PHARMACY&branch=All&show=search" target='departmentX'>Pharmacy</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchInventory.php?username=<?php echo $username; ?>&inventoryType=CSR&branch=All&show=search" target='departmentX'>CSR</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchDoctor.php?username=<?php echo $username; ?>&show=search" target='departmentX'>Doctor</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchDoctorService.php?username=<?php echo $username; ?>&show=search" target='departmentX'>Doctor Service</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchService.php?username=<?php echo $username; ?>&show=search" target='departmentX'>Charges Service</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchCompany.php?username=<?php echo $username; ?>&show=search" target='departmentX'>Company</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchUser.php?username=<?php echo $username; ?>&show=search" target='departmentX'>User</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchBranch.php?username=<?php echo $username; ?>&show=search" target='departmentX'>Branch</a></li>

</ul>
</li>   


            <li>
                <a href="#">Admitted Patient<span class="arrow"></span></a>
                
                <ul>
<?php   $ro->showFloorAsUpperMenu_admin($username,$module);          ?>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/MGH/date_MGH.php?username=<?php echo $username; ?>" target="departmentX">May-Go-Home</a></li> 

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/ADMIN/discharged_cutoff.php?username=<?php echo $username; ?>&module=<?php echo $module; ?>" target="departmentX">Discharged Patient</a></li>    
  
        </ul>
	</li>


 <li>
                <a href="#">Accounting<span class="arrow"></span></a>
                
                <ul>
		<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/accounting/voucher/addVoucher.php?username=<?php echo $username; ?>" target="departmentX">Add Voucher</a></li>
		<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/accounting/cashDisbursement/disbursementShift.php?username=<?php echo $username; ?>" target="departmentX">Cash Disbursement</a></li>
		<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/accounting/trialBalance/selectTrialBalance.php" target="departmentX">Trial Balance</a></li>

                </ul>
            </li>


 <li>
                <a href="#">Chart<span class="arrow"></span></a>
                
                <ul>
 <li><a href="#" target="departmentX"><font color=red>Financial</font></a></li> 

 <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/pieChart/selectShift_revenue.php?username=<?php echo $username; ?>&module=<?php echo $module; ?>" target="departmentX">Daily Collection Chart</a></li>     

 <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/multipleHorizontalChart/selectShift_revenue.php?username=<?php echo $username; ?>&module=<?php echo $module; ?>" target="departmentX">Monthly Collection Chart</a></li> 

 <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/multipleLineChart/selectShift_revenue.php?username=<?php echo $username; ?>&module=<?php echo $module; ?>" target="departmentX">Annual Collection Chart</a></li> 

 <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/multipleBarChart/selectShift_expenses.php?username=<?php echo $username; ?>&module=<?php echo $module; ?>" target="departmentX">Monthly Expenses Chart</a></li> 

 <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/multipleLineChart/selectShift_expenses.php?username=<?php echo $username; ?>&module=<?php echo $module; ?>" target="departmentX">Annual Expenses Chart</a></li> 

 <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/multipleHorizontalChart/selectShift_receivables.php?username=<?php echo $username; ?>&module=<?php echo $module; ?>" target="departmentX">Monthly PhilHealth Receivables Chart</a></li> 

 <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/multipleLineChart/selectShift_phicReceivables.php?username=<?php echo $username; ?>&module=<?php echo $module; ?>" target="departmentX">Annual PhilHealth Receivables Chart</a></li> 


 <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/multipleHorizontalChart/selectShift_discount.php?username=<?php echo $username; ?>&module=<?php echo $module; ?>" target="departmentX">Monthly Discount Chart</a></li> 

 <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/multipleLineChart/selectShift_discount.php?username=<?php echo $username; ?>&module=<?php echo $module; ?>" target="departmentX">Annual Discount Chart</a></li> 

		<li><a href="#" target="departmentX"><font color=red>Census</font></a></li>

		<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/selectShift.php?username=<?php echo $username; ?>&switch=2" target="departmentX">Registration Census Daily Chart</a></li>

		<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/multipleBarChart/selectShift.php?username=<?php echo $username; ?>&switch=2" target="departmentX">Registration Census Monthly Chart</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/multipleLineChart/selectShift.php?username=<?php echo $username; ?>&switch=2" target="departmentX">Registration Census Annual Chart</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/pieChart/selectShift_genderCensus.php?username=<?php echo $username; ?>&switch=2" target="departmentX">Gender Census Daily Chart</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/multipleBarChart/selectShift_monthlyRegistrationType.php?username=<?php echo $username; ?>&switch=2" target="departmentX">Gender Census Monthly Chart</a></li>
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/multipleLineChart/selectShift_genderCensus.php?username=<?php echo $username; ?>&switch=2" target="departmentX">Gender Census Annual Chart</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/multipleBarChart/selectShift_senior.php?username=<?php echo $username; ?>&switch=2" target="departmentX">Senior Census Monthly Chart</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/multipleLineChart/selectShift_senior.php?username=<?php echo $username; ?>&switch=2" target="departmentX">Senior Census Annual Chart</a></li>

 <li><a href="#" target="departmentX"><font color=red>OPD Top 20 Highest Sale's</font></a></li> 

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/bestSelling/selectShift.php?username=<?php echo $username; ?>&title=MEDICINE" target="departmentX">Medicine</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/bestSelling/selectShift.php?username=<?php echo $username; ?>&title=SUPPLIES" target="departmentX">Supplies</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/bestSelling/selectShift.php?username=<?php echo $username; ?>&title=LABORATORY" target="departmentX">Laboratory</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/bestSelling/selectShift.php?username=<?php echo $username; ?>&title=RADIOLOGY" target="departmentX">Radiology</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/bestSelling/selectShift.php?username=<?php echo $username; ?>&title=PROFESSIONAL FEE" target="departmentX">Doctor</a></li>

 <li><a href="#" target="departmentX"><font color=red>IPD Top 20 Highest Sale's</font></a></li> 

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/bestSelling/selectShift_ipd.php?username=<?php echo $username; ?>&title=MEDICINE" target="departmentX">Medicine</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/bestSelling/selectShift_ipd.php?username=<?php echo $username; ?>&title=SUPPLIES" target="departmentX">Supplies</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/bestSelling/selectShift_ipd.php?username=<?php echo $username; ?>&title=LABORATORY" target="departmentX">Laboratory</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/bestSelling/selectShift_ipd.php?username=<?php echo $username; ?>&title=RADIOLOGY" target="departmentX">Radiology</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/bestSelling/selectShift_ipd.php?username=<?php echo $username; ?>&title=PROFESSIONAL FEE" target="departmentX">Doctor</a></li>

 <li><a href="#" target="departmentX"><font color=red>Fast Moving Items</font></a></li> 

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/bestSelling/selectShift_fastMoving.php?username=<?php echo $username; ?>&title=MEDICINE" target="departmentX">Medicine</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/graphicalReport/bestSelling/selectShift_fastMoving.php?username=<?php echo $username; ?>&title=SUPPLIES" target="departmentX">Supplies</a></li>

                </ul>
            </li>





    </div>



<iframe src="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/ADMIN/requestDelete_update.php?username=<?php echo $username; ?>" width="991" height="540"  name="departmentX" border=1 frameborder=no></iframe>

</body>
</html>
