<?php
include("../myDatabase.php");
require_once('../COCONUT/authentication.php');
$username = $_SESSION['username'];
$module = $_SESSION['module'];
$from = $_SESSION['from'];
$ro = new database();

$branch = "Paranaque";



?>

<html>
<head>

<title><?php echo $module; ?></title>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/flow/rickyCSS1.css" />
        <script type="text/javascript" src="http://<?php echo $ro->getMyUrl() ?>/Registration/menu/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="http://<?php echo $ro->getMyUrl() ?>/Registration/menu/jquery.fixedMenu.js"></script>
        <link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl();?>/Registration/menu/fixedMenu_style1.css" />

<?php

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


";

echo "$(document).ready(function(){ ";
echo "getApproved();";
echo "});";
echo "function getApproved(){";
echo  "$('#totalApproved').load('http://".$ro->getMyUrl()."/COCONUT/Pharmacy/totalRequest.php',{ 'module':'".$module."','username':'".$username."' }, function(){";
echo  "   setTimeout(getApproved, 6000);";
echo   "  });";
echo   " }";
echo "</script>";

echo "
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
        <li><a href="http://<?php echo $ro->getMyUrl(); ?>/Department/initializeDepartment.php?module=<?php echo $_SESSION['module']; ?>"><font color=white>Home</font><span class="arrow"></span></a></li>
        <li><a href="#" class='odd'><font color=yellow><?php echo $_SESSION['module']." (".$branch.")"; ?></font><span class="arrow"></span></a></li>

    <li>&nbsp;&nbsp;</li>
</ol>


    <div class="menu">
        <ul>
            <li>
                <a href="#">Transaction<span class="arrow"></span></a>
                

                <ul>

<?php 
/*
if( $module == "CSR" ) { 

echo ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/CSR/borrowedDate.php?module='.$module.'&username='.$username.'>" target="departmentX" >Borrow Book</a></li>';
}else { }
*/
?>

<?php

if($module != "BILLING" && $module != "PHARMACY" && $module != "LABORATORY" && $module != "DIETARY" && $module != "CSR" && $module != "ER" ) {

                 echo ' <li><a href="http://'.$ro->getMyUrl().'/Department/selectShift.php?module='.$module.'&username='.$username.'&branch='.$branch.'>" target="departmentX" >Diagnostics</a></li>';
                // echo  ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/currentPatient/patientInterface.php?username='.$username.'&completeName=" target="_blank">Search Patientz</a></li>';

echo  ' <li>
<form method="post" action="/COCONUT/currentPatient/patientInterface.php" target="_blank">
<input type="hidden" name="username" value="'.$username.'">
<input type="hidden" name="module" value="'.$module.'">
<input type="hidden" name="patientSearch" value="">
<input type="submit" value="Search Patient">
</form>
</li>';

echo  ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/currentPatient/patientInterface_walkIn.php?username='.$username.'&completeName=" target="_blank">Search Walk In</a></li>';

echo '<li><a href="http://'.$ro->getMyUrl().'/COCONUT/systemBiller/generatorCharge/generatorShift.php?username='.$username.'" target="departmentX">Generator</a></li>';

if( $module == "RADIOLOGY" ) {

                 echo  ' <li><a href="http://'.$ro->getMyUrl().'/Maintenance/addCharges.php?module=RADIOLOGY&username='.$username.'" target="departmentX">Add Radiology Charges</a></li>';

                 echo  ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/masterfile/charges.php?username='.$username.'&title=RADIOLOGY&show=All" target="departmentX">View Radiology Charges</a></li>';

                 echo  ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/Results/Radiology/addHospital.php?username='.$username.'" target="departmentX">Add Hospital Heading</a></li>';

echo  ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/Results/Radiology/addRadioTemplate.php?username='.$username.'" target="departmentX">Add Report Template</a></li>';

echo  ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/Results/Radiology/radioHeadingMasterfile.php?username='.$username.'" target="departmentX">View Hospital Heading</a></li>';

echo  ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/Results/Radiology/radioReportTemplateMasterfile.php?username='.$username.'" target="departmentX">View Report Template</a></li>';

echo  ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/opdRegistration.php?module=REGISTRATION&from='.$from.'" target="_blank">Registration</a></li>';


}else { }

echo  ' <li><a href="http://'.$ro->getMyUrl().'/Registration/specialRegistration/unknownPatient.php?username='.$username.'&from='.$module.'" target="_blank">Walk-in</a></li>';

echo  ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/accounting/voucher/addVoucher.php?username='.$username.'" target="departmentX">Expenses</a></li>';

echo  ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/Pharmacy/viewPx_handler.php?username='.$username.'" target="departmentX">OPD</a></li>';

}else if( $module == "PHARMACY" ) {

echo ' <li><a href="http://'.$ro->getMyUrl().'/Department/selectShift.php?module='.$module.'&username='.$username.'&branch='.$branch.'>" target="departmentX" >Diagnostics</a></li>';

echo  ' <li>
<form method="post" action="/COCONUT/currentPatient/patientInterface.php" target="_blank">
<input type="hidden" name="username" value="'.$username.'">
<input type="hidden" name="module" value="'.$module.'">
<input type="hidden" name="patientSearch" value="">
<input type="submit" value="Search Patient">
</form>
</li>';

echo '<li><a href="http://'.$ro->getMyUrl().'/Registration/specialRegistration/unknownPatient.php?username='.$username.'&from='.$module.'" target="_blank">Walk-in</a></li>';

echo '<li><a href="http://'.$ro->getMyUrl().'/COCONUT/maintenance/searchInventory.php?username='.$username.'&inventoryType=PHARMACY&branch=All&show=search" target="departmentX" >Search Inventory</a></li>';

echo '<li><a href="http://'.$ro->getMyUrl().'/COCONUT/masterfile/supplier.php?username='.$username.'" target="_blank">Supplier Master List</a></li>';

//echo '<li><a href="http://'.$ro->getMyUrl().'/COCONUT/masterfile/inventory.php?username='.$username.'&inventoryType=medicine&branch=All&show=All" target="_blank">Medicine Master List</a></li>';

echo '<li><a href="http://'.$ro->getMyUrl().'/COCONUT/inventory/medicine-new.php" target="departmentX">Medicine</a></li>';
echo '<li><a href="http://'.$ro->getMyUrl().'/COCONUT/inventory/supplies-new.php" target="departmentX">Supplies</a></li>';
echo '<li><a href="http://'.$ro->getMyUrl().'/COCONUT/inventory/deleted-medicine.php" target="departmentX">Deleted Medicine</a></li>';
echo '<li><a href="http://'.$ro->getMyUrl().'/COCONUT/inventory/deleted-supplies.php" target="departmentX">Deleted Supplies</a></li>';

//echo '<li><a href="http://'.$ro->getMyUrl().'/COCONUT/masterfile/inventory.php?username='.$username.'&inventoryType=supplies&branch=All&show=All" target="_blank">Supplies Master List</a></li>';

//echo '<li><a href="http://'.$ro->getMyUrl().'/Maintenance/addSupplier.php?username='.$username.'" target="_blank">Add Supplier</a></li>';

echo '<li><a href="http://'.$ro->getMyUrl().'/Purchasing/pframe.php?username='.$username.'" target="departmentX">Recieving And P.O.</a></li>';

echo '<li><a href="http://'.$ro->getMyUrl().'/COCONUT/purchasing/addInvoice.php?username='.$username.'" target="departmentX">Add Invoice</a></li>';

echo '<li><a href="http://'.$ro->getMyUrl().'/COCONUT/maintenance/searchStockCard.php?username='.$username.'" target="departmentX">Add Inventory</a></li>';


echo ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/requestition/dateRequest.php?username='.$username.'" target="departmentX" >Requesition Report</a></li>';

echo  ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/opdRegistration.php?module=REGISTRATION&from='.$module.'" target="_blank">Registration</a></li>';

echo  ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/Reports/Census/selectShift_pxList.php?username='.$username.'" target="departmentX">Patient List</a></li>';

echo  ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/Reports/admissionKit.php" target="departmentX">ADM.KIT Report</a></li>';
echo  ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/inventory/ending-inventory-medicine.php" target="departmentX">Ending Inventory</a></li>';


echo  ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/Pharmacy/viewPx_handler.php?username='.$username.'" target="departmentX">OPD</a></li>';

}else if( $module == "LABORATORY" ) {

echo ' <li><a href="http://'.$ro->getMyUrl().'/Department/selectShift.php?module='.$module.'&username='.$username.'&branch='.$branch.'" target="departmentX" >Diagnostics</a></li>';

echo  ' <li>
<form method="post" action="/COCONUT/currentPatient/patientInterface.php" target="_blank">
<input type="hidden" name="username" value="'.$username.'">
<input type="hidden" name="module" value="'.$module.'">
<input type="hidden" name="patientSearch" value="">
<input type="submit" value="Search Patient">
</form>
</li>';

echo ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/masterfile/charges.php?username='.$username.'&title=LABORATORY&show=All" target="departmentX" >View Examination</a></li>';

echo ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/maintenance/searchCharges.php?username='.$username.'&title=LABORATORY&show=search" target="departmentX" >Search Examination</a></li>';

echo ' <li><a href="http://'.$ro->getMyUrl().'/Maintenance/addCharges.php?username='.$username.'&module=LABORATORY" target="departmentX" >Add Examination</a></li>';

echo ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/Laboratory/resultList/addResultForm.php" target="departmentX" >Add Laboratory Template</a></li>';

echo ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/Laboratory/resultList/resultFormMasterfile.php" target="departmentX" >Edit Laboratory Template</a></li>';

echo  ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/opdRegistration.php?module=REGISTRATION&from='.$module.'" target="_blank">Registration</a></li>';

echo  ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/Reports/Census/selectShift_registered.php?username='.$username.'&switch=2" target="_blank">Registration Census</a></li>';

echo ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/Laboratory/addReagents.php?username='.$username.'" target="departmentX" >Add Reagents</a></li>';

echo ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/Laboratory/viewReagents.php?username='.$username.'" target="departmentX" >View Reagents</a></li>';

echo  ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/Pharmacy/viewPx_handler.php?username='.$username.'" target="departmentX">OPD</a></li>';

}else if( $module == "DIETARY" ) {
echo ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/dietary/viewPx_update.php?username='.$username.'" target="departmentX"> Patient List</a></li>';
echo  ' <li>
<form method="post" action="/COCONUT/currentPatient/patientInterface.php" target="_blank">
<input type="hidden" name="username" value="'.$username.'">
<input type="hidden" name="module" value="'.$module.'">
<input type="hidden" name="patientSearch" value="">
<input type="submit" value="Search Patient">
</form>
</li>';

echo ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/dietary/addDiet.php?username='.$username.'" target="departmentX" >Add Diet</a></li>';
echo ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/dietary/viewDiet.php?username='.$username.'" target="departmentX" >View Diet</a></li>';

}else if( $module == "CSR" ) {

echo ' <li><a href="http://'.$ro->getMyUrl().'/Department/selectShift.php?module='.$module.'&username='.$username.'&branch='.$branch.'>" target="departmentX" >Diagnostics</a></li>';

echo ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/maintenance/searchInventory.php?username='.$username.'&inventoryType=CSR&branch=All&show=search" target="departmentX" >Search Inventory</a></li>';

echo ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/inventory/addInventory_supplies.php?username='.$username.'" target="departmentX" >Add Supplies</a></li>';

echo ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/CSR/csrReport.php?username='.$username.'" target="departmentX" >View Dispensed</a></li>';

echo ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/CSR/selectShift_return.php?username='.$username.'" target="departmentX" >View Returned</a></li>';

}else if( $module == "ER" ) {

echo  ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/ER/er_handler.php?username='.$username.'&date='.date("Y-m-d").'" target="departmentX">Transaction</a></li>';

echo  ' <li>
<form method="post" action="/COCONUT/currentPatient/patientInterface.php" target="_blank">
<input type="hidden" name="username" value="'.$username.'">
<input type="hidden" name="module" value="'.$module.'">
<input type="hidden" name="patientSearch" value="">
<input type="submit" value="Search Patient">
</form>
</li>';


echo  ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/Doctor/showDocName.php?username='.$username.'" target="_blank">Doctors Patient</a></li>';

echo  ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/Reports/Census/selectShift_registered.php?username='.$username.'&switch=2" target="_blank">Registration Census</a></li>';

echo  '<li><a href="http://'.$ro->getMyUrl().'/COCONUT/opdRegistration.php?module=REGISTRATION&from=ER" target="_blank">Registration</a></li>';

}else {
echo  ' <li><a href="http://'.$ro->getMyUrl().'/Department/depthandler.php?username='.$username.'&date='.date("Y-m-d").'" target="departmentX">Transaction</a></li>';

echo ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/Company/companyselectdate.php?username='.$username.'" target="departmentX" >OPD w/ Company</a></li>';

$ro->showFloorAsUpperMenu_billing($ro->getUserBranch_username($username,$module),$username);

echo  ' <li>
<form method="post" action="/COCONUT/currentPatient/patientInterface.php" target="_blank">
<input type="hidden" name="username" value="'.$username.'">
<input type="hidden" name="module" value="'.$module.'">
<input type="hidden" name="patientSearch" value="">
<input type="submit" value="Search Patient">
</form>
</li>';

echo ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/inventory/addInventory.php?username='.$username.'" target="departmentX" >Add Medicine</a></li>';

echo ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/inventory/addInventory_supplies.php?username='.$username.'" target="departmentX" >Add Supplies</a></li>';

echo ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/Reports/Census/selectShift_pxList.php?username='.$username.'" target="departmentX" >Patient List</a></li>';

echo ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/Cashier/cashierReport/dailyCashiersReport_date.php?username='.$username.'" target="departmentX" >Daily Cashier Report</a></li>';

}

?>


                </ul>
            </li>
            <li>
                <a href="#">Reports<span class="arrow"></span></a>
                <ul>


<?php if( $module == "PHARMACY" ) { ?>

<li><a href="../BillingReports/BillAccountingSD.php?username=<?php echo $username; ?>" target="_blank">Transaction Summary</a></li>


<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/inventory/movement-medicine.php" target="departmentX">Movement Medicine</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/inventory/movement-supplies.php" target="departmentX">Movement Supplies</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/MGH/date_MGH.php?username=<?php echo $username; ?>" target="departmentX">Unlock</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchInventory.php?username=<?php echo $username; ?>&inventoryType=PHARMACY&branch=All&show=search" target="_blank">Search Item</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Pharmacy/selectShift.php?username=<?php echo $username; ?>" target="departmentX">Receiving</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/inventory/stockCard/sortStockCard.php" target="departmentX">Merge Stock Card</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/accounting/purchaseJournalDate.php" target="departmentX">Purchase Journal</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/availableMedicine/expiredMed.php?username=<?php echo $username; ?>.php?username=<?php echo $username; ?>" target="departmentX">Expiration</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Cashier/cashierReport/dailyCashiersReport_date.php?username=<?php echo $username; ?>.php?username=<?php echo $username; ?>" target="departmentX">Daily Cashiers Report</a></li>

<?php }else if( $module == "LABORATORY" ) { ?>
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Reports/Census/selectShift.php?username=<?php echo $username; ?>&switch=2" target="departmentX">Summary Laboratory Census</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Laboratory/labCensus/selectDoctor.php?title=LABORATORY" target="departmentX">Laboratory Census w/ Doctor</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Laboratory/labCensus/dateLab.php" target="departmentX">Lab Charges</a></li>

<?php }else if( $module == "RADIOLOGY" ) { ?>
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Laboratory/labCensus/selectDoctor.php?title=RADIOLOGY" target="departmentX">Radiology Census w/ Doctor</a></li>
<? } else { } ?>



<?php if($module != "BILLING" ) { ?>

                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Reports/departmentSelectShift_sales.php?module=<?php echo $module; ?>&username=<?php echo $username; ?>&reportName=Sales" target="departmentX">Sales</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Reports/departmentSelectShift_remittance.php?module=<?php echo $module; ?>&username=<?php echo $username; ?>&reportName=Remittance" target="departmentX">Remittance</a></li>


<?php } else {  ?>

 <li><a href="http://<?php echo $ro->getMyUrl(); ?>/BillingReports/BillAccountingSD.php?username=<?php echo $username; ?>" target="departmentX">Transaction Summary</a></li>
 <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Reports/Census/selectShift_registered.php?&username=<?php echo $username; ?>&switch=2" target="_blank">Registration Census</a></li>
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Reports/hmoSOA_type.php" target="_blank">HMO SOA</a></li>
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/flow/dischargedDate.php?username=<?php echo $username; ?>" target="departmentX">Discharged</a></li>
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Reports/doctorReport/selectShift_ADMIN.php?username=x" target="departmentX">OPD PF (Summary)</a></li>
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Reports/Census/selectShift.php?username=x&switch=x" target="departmentX">Statistics of Procedure</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Company/selectCompany.php" target="departmentX">Aging of Accounts</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/accounting/cashDisbursement/disbursementPage.php?username=<?php echo $username; ?>" target="departmentX">Disbursement</a></li>

                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Reports/billing/selectShift.php?username=<?php echo $username; ?>&branch=<?php echo $ro->getUserBranch_username($username,$module) ?>" target="departmentX">Discharged</a></li>


<?php  echo  ' <li><a href="http://'.$ro->getMyUrl().'/COCONUT/patientProfile/MGH/date_MGH.php?username='.$username.'" target="departmentX">Unlock</a></li>';  ?>


<?php } ?>

                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/masterfile/inventory.php?username=<?php echo $username; ?>&inventoryType=<?php echo $module; ?>&branch=All&show=All" target="departmentX">Inventory</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Reports/inventoryReport/selectShift.php?module=<?php echo $module; ?>&username=<?php echo $username; ?>&reportName=Current Usages&branch=<?php echo $ro->getUserBranch_username($username,$module);  ?>" target="departmentX" >Usages</a></li>

 <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/deptReorder.php?username=<?php echo $username; ?>" target='departmentX'>Re-Order List</a></li>

 <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Cashier/cashierReport/dailyCashiersReport_date.php?username=<?php echo $username; ?>" target='departmentX'>Daily Cashiers Report</a></li>

                </ul>
            </li>    



<?php

if($module == "PHARMACY" || $module == "CSR" ) {
echo "<li>";
echo "<a href='#'>Request<span id='totalApproved'><span class='arrow'></span></a>";
echo "<ul>";
echo $ro->getCSRBranch("departmentX",$username,$module,$ro->getUserBranch_username($username,$module));
echo "</li>";
echo "</ul>";
}else {
echo "";
}

?>


</ul>
</div>



<iframe src="http://<?php echo $ro->getMyUrl(); ?>/Department/departmentPage.php?" style="border:0px; width:100%; height:100%;" name="departmentX" border=1 frameborder=no></iframe>

</body>
</html>
