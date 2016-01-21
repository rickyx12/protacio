<?php
include("../../myDatabase1.php");
$patientNo = $_GET['patientNo'];
$ro = new database1();
$ro->coconutDesign();

$ro->setPatientRecord($patientNo);

$ro->getRegistrationNo();
$myFile = $ro->getReportInformation("homeRoot")."/COCONUT/trackingNo/registrationNo.dat";
$fh = fopen($myFile, 'r');
$registrationNo = fread($fh, 100);
fclose($fh);

/*
$ro->getPatientID();
$myFile = $ro->getReportInformation("homeRoot")."/COCONUT/trackingNo/patientID.dat";
$fh = fopen($myFile, 'r');
$patientNo = fread($fh, 100);
fclose($fh);
*/
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
    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/Registration/newRecord.php" class="odd"><font color=yellow><b>Registration Form</b></font><span class="arrow"></span></a></li>
    <li><a href="#">Verify Registration<span class="arrow"></span></a></li>
   <li><a href="#" class="odd">Patient<span class="arrow"></span></a></li>
    <li>&nbsp;&nbsp;</li>
</ol>

<?php
echo "<Br><Br>";
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
$ro->coconutBoxStart("500","250");
echo "<Br>";
echo "<Table border=0>";

echo "<tr>";
echo "<Td>".$ro->coconutText("Last Name")."</tD>";
echo "<Td>";
$ro->coconutTextBox("lastname",$ro->getLastName_patientRecord());
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<Td>".$ro->coconutText("First Name")."</tD>";
echo "<Td>";
$ro->coconutTextBox("firstname",$ro->getFirstName_patientRecord());
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<Td>".$ro->coconutText("Middle Name")."</tD>";
echo "<Td>";
$ro->coconutTextBox("middlename",$ro->getMiddleName_patientRecord());
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<Td>".$ro->coconutText("Gender")."</tD>";
echo "<Td>";
$ro->coconutComboBoxStart_long("gender");
echo "<option value='".$ro->getGender_patientRecord()."'>".$ro->getGender_patientRecord()."</option>";
echo "<option value='male'>Male</option>";
echo "<option value='female'>Female</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

$bday = preg_split ("/\_/", $ro->getBirthDate_patientRecord()); 

echo "<tr>";
echo "<Td>".$ro->coconutText("Birthdate")."</tD>";
echo "<Td>";
$ro->coconutComboBoxStart_short("month");
echo "<option value='".$bday[0]."'>".$bday[0]."</option>";
echo "<option value='Jan'>Jan</option>";
echo "<option value='Feb'>Feb</option>";
echo "<option value='Mar'>Mar</option>";
echo "<option value='Apr'>Apr</option>";
echo "<option value='May'>May</option>";
echo "<option value='Jun'>Jun</option>";
echo "<option value='Jul'>Jul</option>";
echo "<option value='Aug'>Aug</option>";
echo "<option value='Sep'>Sep</option>";
echo "<option value='Oct'>Oct</option>";
echo "<option value='Nov'>Nov</option>";
echo "<option value='Dec'>Dec</option>";
$ro->coconutComboBoxStop();
echo " - ";
$ro->coconutComboBoxStart_short("day");
echo "<option value='".$bday[1]."'>".$bday[1]."</option>";
for($x=1;$x<32;$x++) {
if($x<10) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
$ro->coconutComboBoxStop();
echo " - ";
$ro->coconutTextBox_short("birthYear",$bday[2]);
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<Td>".$ro->coconutText("Senior")."</tD>";
echo "<Td>";
$ro->coconutComboBoxStart_short("seniorCitizen");
echo "<option value='".$ro->getSenior_patientRecord()."'>".$ro->getSenior_patientRecord()."</option>";
echo "<option value='NO'>No</option>";
echo "<option value='YES'>Yes</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<Br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
