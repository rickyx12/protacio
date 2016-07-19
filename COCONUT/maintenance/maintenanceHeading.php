<?php
include("../../myDatabase.php");
session_start();
$username = $_SESSION['username'];
$module = $_SESSION['module'];



$ro = new database();

if ( (!isset($username) && !isset($module)) ) {
header("Location:http://".$ro->getMyUrl()."/LOGINPAGE/module.php ");
}

?>

<html>
<head>

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



body.onload=function() { history.go();  }
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
        <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/initializeMaintenance.php"><font color=white>Home</font><span class="arrow"></span></a></li>
        <li><a href="#" class='odd'><font color=yellow><?php echo $module; ?></font><span class="arrow"></span></a></li>

    <li>&nbsp;&nbsp;</li>
</ol>


    <div class="menu">
        <ul>
            <li>
                <a href="#">Add New<span class="arrow"></span></a>
                
                <ul>
    
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/Maintenance/add-charges.php" target="departmentX">Add Charges</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/Maintenance/addDiscountType.php" target="departmentX">Add Discount Type</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchStockCard.php?username=<?php echo $username; ?>" target="departmentX">Add Inventory</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Doctor/addNewDoctor.php?username=<?php echo $username; ?>" target="departmentX">Doctor</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Doctor/addNewDoctorService.php?username=<?php echo $username; ?>" target="departmentX">Doctor Service</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Company/addCompany.php?username=<?php echo $username; ?>" target="departmentX">Company</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/Maintenance/addUser.php?usernamez=<?php echo $username; ?>" target="departmentX">User</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/philhealth/icdCode/addICD.php?username=<?php echo $username; ?>" target="departmentX">ICD Code</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/room/addRoom.php?username=<?php echo $username; ?>" target="departmentX">Room</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/floor/addFloor.php?username=<?php echo $username; ?>" target="departmentX">Floor</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/Maintenance/addSupplier.php?username=<?php echo $username; ?>" target="departmentX">Supplier</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/hospitalPackage/addPackage.php" target="departmentX">Package</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Laboratory/resultList/addResultForm.php" target="departmentX">Laboratory Template</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/availableMedicine/reOrder/reOrder_handler.php?username=<?php echo $username; ?>&inventoryFrom=PHARMACY" target="_blank">Order Form</a></li>



<li><a href="http://<?php echo $ro->getMyUrl(); ?>/mimsy/newEntry.php" target="_blank">Mims</a></li>



                </ul>
            </li>
            <li>
                <a href="#">Master File<span class="arrow"></span></a>
                <ul>
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/masterfile/charges.php?username=<?php echo $username; ?>&title=LABORATORY&show=All" target="departmentX">Laboratory Charges</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/masterfile/charges.php?username=<?php echo $username; ?>&title=ULTRASOUND&show=All" target="departmentX">ULTRASOUND Charges</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/masterfile/charges.php?username=<?php echo $username; ?>&title=XRAY&show=All" target="departmentX">XRAY Charges</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/masterfile/charges.php?username=<?php echo $username; ?>&title=NURSERY&show=All" target="departmentX">Nursery Charges</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/masterfile/charges.php?username=<?php echo $username; ?>&title=NURSING-CHARGES&show=All" target="departmentX">Nursing Charges</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/masterfile/charges.php?username=<?php echo $username; ?>&title=MISCELLANEOUS&show=All" target="departmentX">Miscellaneous Charges</a></li>


<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/masterfile/charges.php?username=<?php echo $username; ?>&title=OR/DR/ER Fee&show=All" target="departmentX">OR/DR/ER/ICU Fee</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/masterfile/charges.php?username=<?php echo $username; ?>&title=CTSCAN&show=All" target="departmentX">CT Scan</a></li>

<?php
//execute rehab or not?
if( $ro->selectNow("reportHeading","information","reportName","rehab") == "Activate" ) {
?>
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/masterfile/charges.php?username=<?php echo $username; ?>&title=REHAB&show=All" target="departmentX">Rehab Charges</a></li>
<?php }else { } ?>

<?php
//execute dialysis or not?
if( $ro->selectNow("reportHeading","information","reportName","dialysis") == "Activate" ) {
?>
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/masterfile/charges.php?username=<?php echo $username; ?>&title=DIALYSIS&show=All" target="departmentX">Dialysis Charges</a></li>
<?php }else { } ?>


<?php
//execute nbs or not?
if( $ro->selectNow("reportHeading","information","reportName","nbs") == "Activate" ) {
?>
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/masterfile/charges.php?username=<?php echo $username; ?>&title=NBS&show=All" target="departmentX">NBS Charges</a></li>
<?php }else { } ?>


<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/masterfile/charges.php?username=<?php echo $username; ?>&title=OTHERS&show=All" target="departmentX">Other's</a></li>

                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/masterfile/inventory.php?username=<?php echo $username; ?>&inventoryType=medicine&branch=All&show=All" target='departmentX'>Medicine</a></li>
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/masterfile/inventory.php?username=<?php echo $username; ?>&inventoryType=supplies&branch=All&show=All" target='departmentX'>Supplies</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/masterfile/inventory.php?username=<?php echo $username; ?>&inventoryType=PHARMACY&branch=All&show=All" target='departmentX'>Pharmacy</a></li>
                   
 <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/masterfile/inventory.php?username=<?php echo $username; ?>&inventoryType=CSR&branch=All&show=All" target='departmentX'>CSR</a></li>

 <li><a href="http://<?php echo $ro->getMyUrl(); ?>/Maintenance/listDiscountType.php" target='departmentX'>Discount Type</a></li>

                <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/masterfile/doctor.php?username=<?php echo $username; ?>&show=All" target='departmentX'>Doctor</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/masterfile/doctorService.php?username=<?php echo $username; ?>&show=All" target='departmentX'>Doctor Service</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/masterfile/company.php?username=<?php echo $username; ?>&show=All" target='departmentX'>Company</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/masterfile/user.php?username=<?php echo $username; ?>&show=All&desc=" target='departmentX'>User</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/masterfile/icdCode.php?username=<?php echo $username; ?>&desc=&show=All&protoType=maintenance&registrationNo=" target='departmentX'>ICD Code</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/diagnosticTimer/diagnosticTimer.php?usernamez=<?php echo $username; ?>" target="departmentX">Diagnostic Timer</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/masterfile/percentage.php?username=<?php echo $username; ?>" target='departmentX'>Percentage</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/masterfile/viewRoom.php?username=<?php echo $username; ?>&desc=&show=All" target='departmentX'>Room</a></li>
                  
 <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/masterfile/floor.php?username=<?php echo $username; ?>&desc=&show=All" target='departmentX'>Floor</a></li>
 
 <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/availableMedicine/expiredMed.php?username=<?php echo $username; ?>" target='departmentX'>Expiration</a></li>

 <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Misc/misc.php?username=<?php echo $username; ?>" target='departmentX'>System Settings</a></li>

 <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/masterfile/supplier.php?username=<?php echo $username; ?>" target='departmentX'>Supplier</a></li>

 <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/casetype/showCasetype.php?username=<?php echo $username; ?>" target='departmentX'>Case Type</a></li>

 <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/hospitalPackage/masterfile/packageMasterfile.php?username=<?php echo $username; ?>" target='departmentX'>Package</a></li>

 <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/deptReorder.php?username=<?php echo $username; ?>" target='departmentX'>Re-Order List</a></li>


<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Laboratory/resultList/resultFormMasterfile.php" target='departmentX'>Laboratory Template</a></li>

                   <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/masterfile/patientRecord.php?username=<?php echo $username; ?>&desc=&show=All" target='departmentX'>Patient Record</a></li>

</ul>
</li>           
     

 <li>
                <a href="#">Search<span class="arrow"></span></a>
                <ul>
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchCharges.php?username=<?php echo $username; ?>&title=LABORATORY&show=search" target="departmentX">Laboratory Charges</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchCharges.php?username=<?php echo $username; ?>&title=ULTRASOUND&show=search" target="departmentX">ULTRASOUND Charges</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchCharges.php?username=<?php echo $username; ?>&title=XRAY&show=search" target="departmentX">XRAY Charges</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchCharges.php?username=<?php echo $username; ?>&title=NURSING-CHARGES&show=search" target="departmentX">Nursing Charges</a></li>


<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchCharges.php?username=<?php echo $username; ?>&title=MISCELLANEOUS&show=search" target="departmentX">Miscellaneous</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchCharges.php?username=<?php echo $username; ?>&title=OR/DR/ER Fee&show=search" target="departmentX">OR/DR/ER/ICU Fee</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchCharges.php?username=<?php echo $username; ?>&title=CTSCAN&show=search" target="departmentX">CT Scan</a></li>

<?php
//execute rehab or not??
if( $ro->selectNow("reportHeading","information","reportName","rehab") == "Activate" ) {
?>
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchCharges.php?username=<?php echo $username; ?>&title=REHAB&show=search" target="departmentX">Rehab Charges</a></li>
<?php }else { } ?>


<?php
//execute dialysis or not??
if( $ro->selectNow("reportHeading","information","reportName","dialysis") == "Activate" ) {
?>
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchCharges.php?username=<?php echo $username; ?>&title=DIALYSIS&show=search" target="departmentX">Dialysis Charges</a></li>
<?php }else { } ?>


<?php
//execute nbs or not??
if( $ro->selectNow("reportHeading","information","reportName","nbs") == "Activate" ) {
?>
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchCharges.php?username=<?php echo $username; ?>&title=NBS&show=search" target="departmentX">NBS Charges</a></li>
<?php }else { } ?>




<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchCharges.php?username=<?php echo $username; ?>&title=OTHERS&show=search" target="departmentX">Other's</a></li>

                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchInventory.php?username=<?php echo $username; ?>&inventoryType=medicine&branch=All&show=search" target='departmentX'>Medicine</a></li>
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchInventory.php?username=<?php echo $username; ?>&inventoryType=supplies&branch=All&show=search" target='departmentX'>Supplies</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchInventory.php?username=<?php echo $username; ?>&inventoryType=PHARMACY&branch=All&show=search" target='departmentX'>Pharmacy</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchInventory.php?username=<?php echo $username; ?>&inventoryType=CSR&branch=All&show=search" target='departmentX'>CSR</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchDoctor.php?username=<?php echo $username; ?>&show=search" target='departmentX'>Doctor</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchDoctorService.php?username=<?php echo $username; ?>&show=search" target='departmentX'>Doctor Service</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchCompany.php?username=<?php echo $username; ?>&show=search" target='departmentX'>Company</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchUser.php?username=<?php echo $username; ?>&show=search" target='departmentX'>User</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchICDcode.php?username=<?php echo $username; ?>&show=search&protoType=maintenance&registrationNo=" target='departmentX'>ICD Code</a></li>

                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchRoom.php?username=<?php echo $username; ?>&show=search" target='departmentX'>Room</a></li>

                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchFloor.php?username=<?php echo $username; ?>&show=search" target='departmentX'>Floor</a></li>

                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/currentPatient/manualSearch.php?username=<?php echo $username; ?>&show=search" target='departmentX'>Patient Manual Search</a></li>


                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/maintenance/searchPatientRecord.php?username=<?php echo $username; ?>&show=search" target='departmentX'>Patient Record</a></li>


</ul>
</li>      
    
    
   <li>
       <a href="../../Maintenance/dbBackupButton.html" target="departmentX">
            <font color=red>
                Create Database Backup
            </font>
        </a>
   </li>








    </div>



<iframe src="http://<?php echo $ro->getMyUrl(); ?>/Department/departmentPage.php?" style="border:0px; width:100%; height:100%;"  name="departmentX" border=1 frameborder=no></iframe>

</body>
</html>
