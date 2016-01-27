<?php
include("../../myDatabase1.php");

$ro = new database1();

$ro->getRegistrationNo();
$myFile = $ro->getReportInformation("homeRoot")."/COCONUT/trackingNo/registrationNo.dat";
$fh = fopen($myFile, 'r');
$registrationNo = fread($fh, 100);
fclose($fh);

$ro->getPatientID();
$myFile = $ro->getReportInformation("homeRoot")."/COCONUT/trackingNo/patientID.dat";
$fh = fopen($myFile, 'r');
$patientNo = fread($fh, 100);
fclose($fh);


$ro->coconutDesign();


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


<ol id="breadcrumbs">
    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/LOGINPAGE/module.php"><font color=white>Home</font><span class="arrow"></span></a></li>
    <li><a href="#" class="odd"><font color=white>Registration</font><span class="arrow"></span></a></li>
    <li><a href="#">Verify Patient Record<span class="arrow"></span></a></li>
    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/Registration/specialRegistration/unknownPatient.php" class="odd"><font color=yellow><b>Registration Form</b></font><span class="arrow"></span></a></li>
    <li><a href="#">Verify Registration<span class="arrow"></span></a></li>
   <li><a href="#" class="odd">Patient<span class="arrow"></span></a></li>
    <li>&nbsp;&nbsp;</li>
</ol>


<?
$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/Registration/verifyRegistration.php");
$ro->coconutHidden("patientNo",$patientNo);
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("patientContact","");
$ro->coconutHidden("philHealth","");
$ro->coconutHidden("phicType","");
$ro->coconutHidden("Address","");
$ro->coconutHidden("diagnosis","");
$ro->coconutHidden("civilStatus","");
$ro->coconutHidden("room","OPD");
$ro->coconutHidden("bloodpressure","");
$ro->coconutHidden("patientTemperature","");
$ro->coconutHidden("weight","");
$ro->coconutHidden("height","");
$ro->coconutHidden("company","");
$ro->coconutHidden("serverTime","");
$ro->coconutHidden("registrationStatus","new");
$ro->coconutHidden("casetype","");
$ro->coconutHidden("dateRegistered","");
$ro->coconutHidden("firstname","n/a");
$ro->coconutHidden("middlename","n/a");
$ro->coconutHidden("dateRegistered",date("M_d_Y"));
$ro->coconutHidden("month",date("M"));
$ro->coconutHidden("day",date("d"));
$ro->coconutHidden("birthYear",date("Y"));


echo "<Br><Br><Br><Br><Br>";
$ro->coconutBoxStart("600","140");
echo "<Br>";
echo "<table border=0>";
echo "<tr>";
echo "<Td>".$ro->coconutText("Name")."&nbsp;</tD>";
echo "<td>";
$ro->coconutTextBox("lastname","patient".$patientNo."_".$registrationNo);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>".$ro->coconutText("Gender")."</td>";
echo "<Td>";
$ro->coconutComboBoxStart_long("gender");
echo "<option value='male'>Male</option>";
echo "<option value='female'>Female</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<Td>".$ro->coconutText("Senior")."</tD>";
echo "<Td>";
$ro->coconutComboBoxStart_long("seniorCitizen");
echo "<option value='NO'>No</option>";
echo "<option value='YES'>Yes</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

echo "</table>";
echo "<Br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutHidden("attendingDoctor","");
$ro->coconutHidden("admittingDoctor","");
$ro->coconutHidden("religion","");
$ro->coconutHidden("pulse","");
$ro->coconutHidden("respiratory","");
$ro->coconutHidden("diet","");
$ro->coconutFormStop();

?>
