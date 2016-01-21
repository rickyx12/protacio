<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />


<?php
include("../../myDatabase.php");
session_start();
$username = $_GET['username'];
$registrationNo = $_GET['registrationNo'];
$registrationNo = $_SESSION['registrationNo'];
//$module = $_SESSION['module'];
$_SESSION['username'] = $username;
//$_SESSION['registrationNo'] = $registrationNo;
$ro = new database();

$ro->getPatientProfile($_GET['registrationNo']);

if ( (!isset($_SESSION['username']) || !isset($_SESSION['registrationNo'])) ) {
header("Location:/COCONUT/patientProfile/unknownUser/verifyUser.php?registrationNo=$_GET[registrationNo] ");
die();
}


if($_GET['username'] == "" ) {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/unknownUser/verifyUser.php?registrationNo=$registrationNo");
}

?>
<title><?php

$ro->getPatientProfile($registrationNo);

echo $ro->getPatientRecord_lastName().",&nbsp;".$ro->getPatientRecord_firstName();

?></title>
<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/flow/rickyCSS1.css" />
<script type="text/javascript" src="http://<?php echo $ro->getMyUrl(); ?>/jquery.js"></script>
<script type="text/javascript" src="http://<?php echo $ro->getMyUrl(); ?>/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/jquery.autocomplete.css" />


<script type="text/javascript" src="http://<?php echo $ro->getMyUrl(); ?>/Registration/menu/jquery.fixedMenu.js"></script>
<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/Registration/menu/fixedMenu_style1.css" />


	

<script type="text/javascript">


        $('document').ready(function(){
            $('.menu').fixedMenu();

        });



	$().ready(function() {
	    $("#patientSearch").autocomplete("searchRegisteredPatient_walkIn.php", {
	        width: 260,
	        matchContains: true,
	        selectFirst: false
                
	    }).result(function(event, data, formatted) {

window.location="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/currentPatient/patientInterface_walkIn.php?module=&completeName="+data+"&username=<?php echo $username; ?>"; 

 });
;
	});



var patient = 'Search Patient';
function SetMsg (txt,active) {
    if (txt == null) return;
    
 
    if (active) {
        if (txt.value == patient) txt.value = '';                     
    } else {
        if (txt.value == '') txt.value = patient;
    }
}

window.onload=function() { SetMsg(document.getElementById('patientSearch', false)); }


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

<ol id="breadcrumbs">
  <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/currentPatient/initializePatient.php" class="odd"><font color=white>Home</font><span class="arrow"></span></a></li>
  <li><a href="#"><font color=white>Patient</font><span class="arrow"></span></a></li>
  <li><a href="http://<?php echo $ro->getMyUrl(); ?>/LOGINPAGE/module.php" class="odd"><font color=yellow>Search Patient</font><span class="arrow"></span></a></li>
<li></li>    
<li>


<?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type=text id='patientSearch' style='   
	background:#FFFFFF url(http://".$ro->getMyUrl()."/COCONUT/myImages/search.jpeg) no-repeat 4px 4px;
	padding:4px 4px 4px 22px;
	border:1px solid #CCCCCC;
	width:400px;
	height:25px;' class='txtBox'
	onfocus='SetMsg(this, true);'
    	onblur='SetMsg(this,false);'
	value='Search Patient'
>"; ?></li>

</ol>

 <div class="menu">
        
<?php //if( $ro->selectNow("registrationDetails","mgh","registrationNo",$registrationNo) == "" ) { ?>
<ul>
            <li>
              
<?php // if( $ro->selectNow("registrationDetails","mgh","registrationNo",$registrationNo) != "" ) { ?>

<?php // }else { ?>
  <a href="#">Information<span class="arrow"></span></a>
<?php // } ?>               
                <ul>

                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/editInformation.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX">Registration Details</a></li>
       


             <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/editVitalSign.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX">Vital Sign</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl() ?>/COCONUT/patientProfile/editInitialDiagnosis.php?registrationNo=<?php echo $registrationNo ?>&username=<?php echo $username; ?>" target="patientX">Diagnosis</a></li>

<?php

if( $ro->getRegistrationDetails_type() == "IPD" ) {

?>
<li><a href="http://<?php echo $ro->getMyUrl() ?>/COCONUT/Reports/admissionSlip.php?registrationNo=<?php echo $registrationNo ?>" target="patientX">Admission Slip w/ Data sheet</a></li>

<li><a href="http://<?php echo $ro->getMyUrl() ?>/COCONUT/Reports/admissionConsent.php?registrationNo=<?php echo $registrationNo ?>" target="patientX">Admission Consent</a></li>
 
<?php }else { ?>
<li><a href="http://<?php echo $ro->getMyUrl() ?>/COCONUT/ERROR/forIPD.php?registrationNo=<?php echo $registrationNo ?>" target="patientX">Admission Slip</a></li>
<?php } ?>
<?php
/* CASE RECORD FOR OPD CHECK-UP
<li><a href="http://<?php echo $ro->getMyUrl() ?>/COCONUT/Reports/clincase.php?registrationNo=<?php echo $registrationNo ?>" target="patientX">Case Record</a></li>
*/
?>

<li><a href="http://<?php echo $ro->getMyUrl() ?>/COCONUT/patientProfile/promisorryNote/noteChecker.php?registrationNo=<?php echo $registrationNo ?>&username=<?php echo $username; ?>" target="patientX">Promisorry Note</a></li>

<li><a href="http://<?php echo $ro->getMyUrl() ?>/COCONUT/patientProfile/roomList.php?registrationNo=<?php echo $registrationNo ?>&username=<?php echo $username; ?>" target="patientX">Room's</a></li>


<?php if( $ro->selectNow("registrationDetails","mgh","registrationNo",$registrationNo) == "" ) { ?>

<li><a href="http://<?php echo $ro->getMyUrl() ?>/COCONUT/patientProfile/MGH/setMGH.php?registrationNo=<?php echo $registrationNo ?>&username=<?php echo $username; ?>" target="patientX">Locked Account</a></li>  

<?php }else { ?>

<?php } ?>


<li><a href="http://<?php echo $ro->getMyUrl() ?>/COCONUT/patientProfile/medicalCertificate.php?registrationNo=<?php echo $registrationNo ?>" target="patientX">Medical Certificate</a></li>

<li><a href="http://<?php echo $ro->getMyUrl() ?>/COCONUT/patientProfile/certConfinement.php?registrationNo=<?php echo $registrationNo ?>" target="patientX">Certficate of Confinement</a></li>


<li><a href="http://<?php echo $ro->getMyUrl() ?>/COCONUT/hospitalPackage/onPatient/showPackage_onPatient.php?registrationNo=<?php echo $registrationNo ?>&username=<?php echo $username; ?>" target="patientX">Hospital Package's</a></li>      

<li><a href="http://<?php echo $ro->getMyUrl() ?>/COCONUT/patientProfile/discount/discount.php?registrationNo=<?php echo $registrationNo ?>&username=<?php echo $username; ?>" target="patientX">Discount</a></li>  

<li><a href="http://<?php echo $ro->getMyUrl() ?>/COCONUT/patientProfile/returnMeds/returnMeds.php?registrationNo=<?php echo $registrationNo ?>&username=<?php echo $username; ?>" target="patientX">Return Meds</a></li>       

 <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/patientProfile_handler.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX">Back To Profile</a></li>
               
		  <li><a href="#" onclick="javascript:window.close()" >Close Profile</a></li>



</ul>
</li>







            <li>
              
<?php if( $ro->selectNow("registeredUser","module","username",$username) == "PHILHEALTH" || $ro->selectNow("registeredUser","module","username",$username) == "HMO" || $ro->selectNow("registeredUser","module","username",$username) == "PHARMACY" || $ro->selectNow("registeredUser","module","username",$username) == "CASHIER" || $ro->selectNow("registeredUser","module","username",$username) == "BILLING" ) { ?>


<?php if( $ro->selectNow("registrationDetails","mgh","registrationNo",$registrationNo) != "" ) { ?>

<?php }else { ?>
  <a href="#">Payment's<span class="arrow"></span></a>
<?php } ?>   

               

<?php }else { ?>


<?php } ?>


                <ul>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/paymentAssigning.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>&type=All&desc=" target="patientX">Payment Assigning</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/paymentTransfer.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>&show=All&desc=" target="patientX">Payment Transfering</a></li> 

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/updatePrice/showInventory.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>&type=PhilHealth&status=no" target="patientX">Update Price for PHIC</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/updatePrice/showInventory.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>&type=Company/HMO&status=no" target="patientX">Update Price for Company/HMO</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/updatePrice/showInventory.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>&type=CASH&status=no" target="patientX">Update Price for Cash</a></li>


<?php //if($ro->getRegistrationDetails_type() == "OPD" ) {  ?>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/voidPayment/showPaid.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX">Void Payment Itemized</a></li> 

<?php //} else { ?>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/Payments/viewPayment.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX">Void Payment</a></li>
<?php //} ?>




                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/Payments/addPayment.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX">Add Payment</a></li>  

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/individualPayment/showMeds.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX">Individual Payment</a></li>

                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/Payments/viewPayment.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX">View Payment</a></li> 
 
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/casetype/addCasetype.php" target="patientX">Case Type</a></li>      

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/manualCharges.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX">Not Allowed Meds</a></li>
      
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/casetype/editCasetype.php?casetype=0000Random&medicine=0&supplies=0&room=0&pf=0&suppliesOnly=0&username=<?php echo $username; ?>" target="patientX">System Biller</a></li>
    
</ul>
</li>





  <li>
<?php

//if($ro->getPatientRecord_phic() == "YES" && $ro->selectNow("registeredUser","module","username",$username) == "PHILHEALTH" ) {
echo  "<a href='#'>PhilHealth<span class='arrow'></span></a>";
//}else {
///echo "";
//}
?>
 <ul>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/philhealth/cf2.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX"><font color=red></font> Claim Form 2 (Front)</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/philhealth/cf2_newPackage.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX"><font color=red></font> Claim Form 2 (Front Package)</a></li>


<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/philhealth/cf2_back.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX"><font color=red></font> Claim Form 2 (Back)</a></li>


<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/philhealth/cf2_blank.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="_blank"><font color=blue>Blank</font> Claim Form 2 (Front)</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/philhealth/cf2_back_blank.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="_blank"><font color=blue>Blank</font> Claim Form 2 (Back)</a></li>


<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/philhealth/cf2_hdu.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="_blank"><font color=red>HDU</font> Claim Form 2 (Front)</a></li>
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/philhealth/cf2_back_hdu.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="_blank"><font color=red>HDU</font> Claim Form 2 (Back)</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/philhealth/cf2_back_blancia.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="_blank"><font color=green>Blancia</font> Claim Form 2 (Back)</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/philhealth/fullCharges.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX">Full Charges (WAIVER)</a></li>


<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/viewICD.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX">View ICD Code</a></li>

                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/philhealth/transmitalShift.php?username=<?php echo $username; ?>&module=<?php echo $module; ?>" target="departmentX">PhilHealth Transmital</a></li>
                            <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/philhealth/transmittedShift.php?username=<?php echo $username; ?>&module=<?php echo $module; ?>" target="departmentX">PhilHealth Transmitted</a></li>  



<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/philhealth/transmitalShift_reconcile.php?username=<?php echo $username; ?>&module=<?php echo $module; ?>" target="departmentX">PhilHealth Reconcile</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/philhealth/reconciled/reconciled_shift.php" target="departmentX">PhilHealth Reconciled</a></li>


<?php if( $ro->selectNow("registrationDetails","verified","registrationNo",$registrationNo) == "" ) { ?>
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/philhealth/verified.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX"><font color=red></font> Verified </a></li> 
<?php }else { ?>
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/philhealth/unverified.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX"><font color=red></font> Unverified </a></li> 
<?php } ?>

</li>
</ul>




<?php //} else { 
//$tagInformation = preg_split ("/\_/", $ro->selectNow("registrationDetails","mgh","registrationNo",$registrationNo) ); 

//echo "<a href='#'><font color=red>This Patient was tagged as MGH (May-Go-Home) by ".$tagInformation[1]." in ".$ro->selectNow("registrationDetails","mgh_date","registrationNo",$registrationNo)."</font><span class='#'></span></a>"; 
//}
?>



<?php

if( $ro->selectNow("registrationDetails","mgh","registrationNo",$registrationNo) != "" ) {
echo "&nbsp;&nbsp;<font color=red>LOCKED @ ".$ro->selectNow("registrationDetails","mgh_date","registrationNo",$registrationNo)."</font>";

if( $ro->selectNow("registeredUser","module","username",$username) == "BILLING" || $ro->selectNow("registeredUser","module","username",$username) == "CASHIER" || $ro->selectNow("registeredUser","module","username",$username) == "PHARMACY" ) { // check user kung allowed mag unlock
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/MGH/directUnlock.php?registrationNo=$registrationNo&username=$username'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=blue><< Unlock >></font></a>";
}else {

}

}else {

	}

?>

</ul>

</div>

<iframe src="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/patientProfile_handler.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" name="patientX" width="1015" height="530" style="border:hidden;  "></iframe>
