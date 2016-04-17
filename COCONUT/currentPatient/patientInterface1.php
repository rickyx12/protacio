<?php
include("../../myDatabase.php");
//require_once('../authentication.php');
$username = $_POST['username'];
$registrationNo = $_POST['registrationNo'];

if( isset($_POST['from']) ) {
$from = $_POST['from'];
}else {
$from = "";
}

$ro = new database();

$ro->getPatientProfile($_POST['registrationNo']);

/*
if ( (!isset($_SESSION['username']) || !isset($_SESSION['registrationNo'])) ) {
header("Location:/COCONUT/patientProfile/unknownUser/verifyUser.php?registrationNo=$_GET[registrationNo] ");
die();
}
*/

if($_POST['username'] == "" ) {
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


function detectBrowserSize() {
    var myWidth = 0, myHeight = 0;
    if (typeof (window.innerWidth) == 'number') {
        //Non-IE
        myWidth = window.innerWidth;
        myHeight = window.innerHeight;
    } else if (document.documentElement && (document.documentElement.clientWidth ||   document.documentElement.clientHeight)) {
        //IE 6+ in 'standards compliant mode'
        myWidth = document.documentElement.clientWidth;
        myHeight = document.documentElement.clientHeight;
    } else if (document.body && (document.body.clientWidth || document.body.clientHeight)) {
        //IE 4 compatible
        myWidth = document.body.clientWidth;
        myHeight = document.body.clientHeight;
    }
    return myWidth;
}



        $('document').ready(function(){
            $('.menu').fixedMenu();

        });



	$().ready(function() {
	    $("#patientSearch").autocomplete("searchRegisteredPatient.php", {
	        width: 260,
	        matchContains: true,
	        selectFirst: false
                
	    }).result(function(event, data, formatted) {

$("form[name='searchMe']").submit();

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

<body style="height:100%; padding:0px;">
<ol id="breadcrumbs">
  <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/currentPatient/initializePatient.php" class="odd"><font color=white>Home</font><span class="arrow"></span></a></li>
  <li><a href="#"><font color=white>Patient</font><span class="arrow"></span></a></li>
  <li><a href="#" class="odd"><font color=yellow>Search Patient</font><span class="arrow"></span></a></li>
<li></li>    
<li>


<?php echo "
<form name='searchMe' method='post' action='patientInterface.php' STYLE='margin: 0px; padding: 0px;'>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type=text name='patientSearch' id='patientSearch' style='   
	background:#FFFFFF url(http://".$ro->getMyUrl()."/COCONUT/myImages/search.jpeg) no-repeat 4px 4px;
	padding:4px 4px 4px 22px;
	border:1px solid #CCCCCC;
	width:400px;
	height:25px;' class='txtBox'
	onfocus='SetMsg(this, true);'
    	onblur='SetMsg(this,false);'
	value='Search Patient'
>
<input type='hidden' name='username' value='$username'>
<input type='hidden' name='module' value=''>
</form>
"; ?></li>

</ol>


 <div class="menu">
        
<?php //if( $ro->selectNow("registrationDetails","mgh","registrationNo",$registrationNo) == "" ) { ?>
<ul>
            <li>
              
<?php // if( $ro->selectNow("registeredUser","module","username",$username) == "PATIENT" ) { ?>

<?php // }else { ?>
  <a href="#">Information<span class="arrow"></span></a>
<?php // } ?>               
                <ul>

<?php if( $ro->selectNow("registrationDetails","mgh","registrationNo",$registrationNo) == "" ) { ?>

                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/editInformation.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX">Registration Details</a></li>
       
<?php }else { } ?>

             <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/editVitalSign.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX">Vital Sign</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl() ?>/COCONUT/patientProfile/editInitialDiagnosis.php?registrationNo=<?php echo $registrationNo ?>&username=<?php echo $username; ?>" target="patientX">Diagnosis</a></li>

<?php
/* CASE RECORD FOR OPD CHECK-UP
<li><a href="http://<?php echo $ro->getMyUrl() ?>/COCONUT/Reports/clincase.php?registrationNo=<?php echo $registrationNo ?>" target="patientX">Case Record</a></li>
*/
?>

<?php if( $ro->selectNow("registrationDetails","mgh","registrationNo",$registrationNo) == "" ) { ?>

<li><a href="http://<?php echo $ro->getMyUrl() ?>/COCONUT/patientProfile/roomList.php?registrationNo=<?php echo $registrationNo ?>&username=<?php echo $username; ?>" target="patientX">Room's</a></li>

<?php }else { } ?>

<li><a href="http://<?php echo $ro->getMyUrl() ?>/COCONUT/patientProfile/ChangeSenior.php?registrationNo=<?php echo $registrationNo ?>&username=<?php echo $username; ?>" target="patientX">Change to Senior</a></li>

<?php if( $ro->selectNow("registrationDetails","mgh","registrationNo",$registrationNo) == "" ) { ?>

<li><a href="http://<?php echo $ro->getMyUrl() ?>/COCONUT/patientProfile/MGH/setMGH.php?registrationNo=<?php echo $registrationNo ?>&username=<?php echo $username; ?>" target="patientX">Locked Account</a></li>  

<?php }else { ?>

<?php } ?>



<?php if( $ro->selectNow("registrationDetails","mgh","registrationNo",$registrationNo) == "" ) { ?>
<li><a href="http://<?php echo $ro->getMyUrl() ?>/COCONUT/hospitalPackage/onPatient/showPackage_onPatient.php?registrationNo=<?php echo $registrationNo ?>&username=<?php echo $username; ?>" target="patientX">Hospital Package's</a></li>      


<li><a href="http://<?php echo $ro->getMyUrl() ?>/COCONUT/patientProfile/discount/discount.php?registrationNo=<?php echo $registrationNo ?>&username=<?php echo $username; ?>" target="patientX">Discount</a></li>

<?php } else { } ?>

<li><a href="../../BillingReports/TemporaryBillwPF.php?registrationNo=<?php echo $registrationNo ?>&username=<?php echo $username; ?>" target="patientX">Teporary Bill w/ PF</a></li>

<li><a href="../../BillingReports/TemporaryBillwoPF.php?registrationNo=<?php echo $registrationNo ?>&username=<?php echo $username; ?>" target="patientX">Teporary Bill w/o PF</a></li>



<?php if( $ro->selectNow("registrationDetails","mgh","registrationNo",$registrationNo) == "" ) { ?>
<li><a href="http://<?php echo $ro->getMyUrl() ?>/COCONUT/patientProfile/returnMeds/returnMeds.php?registrationNo=<?php echo $registrationNo ?>&username=<?php echo $username; ?>" target="patientX">Return Meds</a></li>
<?php }else { } ?>



<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/patientProfile_handler.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX">Back To Profile</a></li>
               
</ul>
</li>







            <li>
              
  <a href="#">Payment's<span class="arrow"></span></a>


                <ul>


<?php if( $ro->selectNow("registrationDetails","mgh","registrationNo",$registrationNo) == "" ) { ?>

                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/paymentAssigning.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>&type=All&desc=" target="patientX">Payment Assigning</a></li>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/paymentTransfer.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>&show=All&desc=" target="patientX">Payment Transfering</a></li> 


<?php //if($ro->getRegistrationDetails_type() == "OPD" ) {  ?>
                    <!---
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/voidPayment/showPaid.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX">Void Payment Itemized</a></li> 
                    -->

                    <? if($ro->selectNow("registeredUser","position","username",$username) == "encoder") { ?>
                            <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/voidPayment/showPaid.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX">Void Payment Itemized (<font color=red>old</font>)</a></li> 
                    <? }else { } ?>

                     <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/voidPayment/void-opd-new.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX">Void Payment Itemized</a></li>                    

<?php //} else { ?>
                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/Payments/viewPayment.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX">Void Payment</a></li>
<?php //} ?>

<?php }else { } ?>


                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/Payments/addPayment.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX">Add Deposit/Hospital Bill/Downpayment</a></li>  

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/reporting.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX">Reporting</a></li> 

<?php if( $ro->selectNow("registrationDetails","mgh","registrationNo",$registrationNo) == "" ) { ?>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/individualPayment/showMeds.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>&checkz=no&batchNo=" target="patientX">Individual Payment</a></li>

                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/Payments/viewPayment.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX">View Payment</a></li> 
 
     
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/addDiscount.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX">Discount</a></li>

<li><a href="http://<?php echo $ro->getMyUrl() ?>/COCONUT/patientProfile/manual-discount.php?registrationNo=<?php echo $registrationNo ?>&username=<?php echo $username; ?>" target="patientX">Discount test</a></li>
    
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/rBanny/approximate.php?registrationNo=<?php echo $registrationNo; ?>&caserate=" target="patientX">R-Banny</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/rBanny/itemException.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX">R-Banny Exclude</a></li> 

<?php 

if( $ro->selectNow("registrationDetails","Company","registrationNo",$registrationNo) != "" ) { ?>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/excess.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX">Excess</a></li> 

<?php
}else { }

?>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/updatePrice.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX">Update Price to <?php echo $ro->selectNow("registrationDetails","type","registrationNo",$registrationNo); ?></a></li> 


<?php }else { } ?>

</ul>
</li>





  <li>
<?php
//if( $ro->selectNow("registeredUser","module","username",$username) == "PATIENT" ) {

//}else {
echo  "<a href='#'>PhilHealth<span class='arrow'></span></a>";
//}

?>
 <ul>


<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/philhealth/revisedSep2013/cf2.php?registrationNo=<?php echo $registrationNo; ?>" target="patientX">CF2</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/philhealth/revisedSep2013/cf2back.php?registrationNo=<?php echo $registrationNo; ?>" target="patientX">CF2 Back</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/viewICD.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX">View ICD Code</a></li>

                    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/philhealth/transmitalShift.php?username=<?php echo $username; ?>" target="_blank">PhilHealth Transmital</a></li>
                            <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/philhealth/transmittedShift.php?username=<?php echo $username; ?>" target="_blank">PhilHealth Transmitted</a></li>  



<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/philhealth/transmitalShift_reconcile.php?username=<?php echo $username; ?>" target="_blank">PhilHealth Reconcile</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/philhealth/reconciled/reconciled_shift.php" target="_blank">PhilHealth Reconciled</a></li>


<?php if( $ro->selectNow("registrationDetails","verified","registrationNo",$registrationNo) == "" ) { ?>
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/philhealth/verified.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX"><font color=red></font> Verified </a></li> 
<?php }else { ?>
<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/philhealth/unverified.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX"><font color=red></font> Unverified </a></li> 
<?php } ?>



</li>
</ul>

<li>
<?php if( $ro->selectNow("registrationDetails","company1","registrationNo",$registrationNo) != "" ) { ?>
<a href='#'><?php echo $ro->selectNow("registrationDetails","company1","registrationNo",$registrationNo) ?><span class='arrow'></span></a>
<?php }else { } ?>

<ul>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/additionalCompany/transfertoAdditionalCompany.php?registrationNo=<?php echo $registrationNo; ?>&mode=&category=" target="patientX">View Patient Charges</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/additionalCompany/transfertoAdditionalCompany.php?registrationNo=<?php echo $registrationNo; ?>&mode=cash2company1&category=" target="patientX"><font color=red>From Cash to <?php echo $ro->selectNow("registrationDetails","company1","registrationNo",$registrationNo); ?></font></a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/additionalCompany/transfertoAdditionalCompany.php?registrationNo=<?php echo $registrationNo; ?>&mode=company1_to_cash&category=" target="patientX"><font color=red>From <?php echo $ro->selectNow("registrationDetails","company1","registrationNo",$registrationNo); ?> to Cash</font></a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/additionalCompany/transfertoAdditionalCompany.php?registrationNo=<?php echo $registrationNo; ?>&mode=company2company1&category=" target="patientX"><font color='blue'>From Company to <?php echo $ro->selectNow("registrationDetails","company1","registrationNo",$registrationNo); ?></font></a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/additionalCompany/transfertoAdditionalCompany.php?registrationNo=<?php echo $registrationNo; ?>&mode=company1_to_company&category" target="patientX"><font color='blue'>From <?php echo $ro->selectNow("registrationDetails","company1","registrationNo",$registrationNo); ?> to Company</font></a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/additionalCompany/transfertoAdditionalCompany.php?registrationNo=<?php echo $registrationNo; ?>&mode=phic2company1&category=" target="patientX"><font color='brown'>From PHIC to <?php echo $ro->selectNow("registrationDetails","company1","registrationNo",$registrationNo); ?></font></a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/additionalCompany/transfertoAdditionalCompany.php?registrationNo=<?php echo $registrationNo; ?>&mode=company1_to_phic&category=" target="patientX"><font color='brown'>From <?php echo $ro->selectNow("registrationDetails","company1","registrationNo",$registrationNo); ?> to PHIC</font></a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/additionalCompany/summary_company1.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>" target="patientX">Summary S.O.A</a></li>

<li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/additionalCompany/newDetailed_company1.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>&show=" target="patientX">Detailed S.O.A</a></li>

</ul>

</ul>
</li>
<?php //} else { 
//$tagInformation = preg_split ("/\_/", $ro->selectNow("registrationDetails","mgh","registrationNo",$registrationNo) ); 

//echo "<a href='#'><font color=red>This Patient was tagged as MGH (May-Go-Home) by ".$tagInformation[1]." in ".$ro->selectNow("registrationDetails","mgh_date","registrationNo",$registrationNo)."</font><span class='#'></span></a>"; 
//}
?>



<?php

if( $ro->selectNow("registrationDetails","mgh","registrationNo",$registrationNo) != "" ) {
echo "&nbsp;&nbsp;<font color=red>LOCKED @ ".$ro->selectNow("registrationDetails","mgh_date","registrationNo",$registrationNo)."</font>";

if( $ro->selectNow("registeredUser","module","username",$username) == "BILLING" || $ro->selectNow("registeredUser","module","username",$username) == "CASHIER" || $ro->selectNow("registeredUser","module","username",$username) == "PHARMACY" || $ro->selectNow("registeredUser","module","username",$username) == "ER" || $ro->selectNow("registeredUser","module","username",$username) == "ADMIN" ) { // check user kung allowed mag unlock

if( $ro->selectNow("registrationDetails","type","registrationNo",$registrationNo) == "OPD" ) {
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/MGH/directUnlock.php?registrationNo=$registrationNo&username=$username'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=blue><< Unlock >></font></a>";
}else { 

if( $ro->selectNow("registeredUser","unlockz","username",$username) == "allow" ) {
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/MGH/directUnlock.php?registrationNo=$registrationNo&username=$username'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=blue><< Unlock >></font></a>";
}else { 
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color='blue'>Hi $username you're not allowed to unlock or edit some information for this patient.</font>";
}

}

}else {

}

}else {


if( $ro->selectNow("registeredUser","module","username",$username) == "SUPERVISOR" ) { // check user kung allowed mag unlock
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/currentPatient/locked/showLocked.php?registrationNo=$registrationNo&username=$username' target='patientX'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=blue><< Override Limit >></font></a>";
}else {

}




}

?>


</div>


<iframe src="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/patientProfile/patientProfile_handler.php?registrationNo=<?php echo $registrationNo; ?>&username=<?php echo $username; ?>&from=<?php echo $from; ?>" name="patientX" style="border:0px; width:100%; height:100%;" style="border:hidden;  "></iframe>

</body>
