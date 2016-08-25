<?php
include("../../../myDatabase2.php");
$username = $_GET['username'];
$registrationNo = $_GET['registrationNo'];
$chargesCode = $_GET['chargesCode'];
$itemNo = $_GET['itemNo'];
$templateNo = $_GET['templateNo'];

$ro = new database2();

$ro->getPatientProfile($registrationNo);

/*
if(isset($_GET['submit']))
{

$result = $_GET['result'];

addLaboratoryResultInPatient($registrationNo,$itemNo,$chargesCode,$medtech,$date,$result);

}
*/

echo "<script type='text/javascript' src='/ckeditor/ckeditor.js'></script>";
echo "<table border=0 cellspacing=0 cellpadding=1 width='100%' >";
echo "<tr>";
echo "<td>&nbsp;<b>Name:</b>&nbsp;".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()."</td>";
echo "<td>&nbsp;<b>Age/Sex:</b>&nbsp;".$ro->getPatientRecord_Age()."/".$ro->getPatientRecord_gender()."</td>";
echo "<Td>&nbsp;<b>Date:</b>&nbsp;".date("M d, Y")."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<b>D.O.B:</b>&nbsp;".$ro->getPatientRecord_birthDate()."</td>";
echo "<Td>&nbsp;<b>WARD:</b>&nbsp;".$ro->getRegistrationDetails_type()."</td>";
echo "</tr>";

echo "</table>";
echo "</centeR>";
/*
if( $ro->selectNow("availableCharges","reagents","chargesCode",$chargesCode) != "" ) {
$reagentsz = preg_split ("/\-/", $ro->selectNow("availableCharges","reagents","chargesCode",$chargesCode) ); 
$ro->getReagentsWillBeUse($reagentsz[0]);
echo "<Br>";
$ro->getReagentsWillBeUse($reagentsz[1]);
echo "<Br>";
$ro->getReagentsWillBeUse($reagentsz[2]);
echo "<Br>";
$ro->getReagentsWillBeUse($reagentsz[3]);
echo "<Br>";
$ro->getReagentsWillBeUse($reagentsz[4]);
}else { }
*/
$ro->coconutFormStart("POST","addLabToPatient.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("itemNo",$itemNo);
$ro->coconutHidden("chargesCode",$chargesCode);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("date",date("Y-m-d"));


/*
$ro->coconutHidden("reagents1",$reagentsz[0]);
$ro->coconutHidden("reagents2",$reagentsz[1]);
$ro->coconutHidden("reagents3",$reagentsz[2]);
$ro->coconutHidden("reagents4",$reagentsz[3]);
$ro->coconutHidden("reagents5",$reagentsz[4]);
*/

echo "<textarea id='result' name='result'>".$ro->selectNow("labResultList","template","templateNo",$templateNo)."</textarea>";


?>


<script type="text/javascript">
			
			CKEDITOR.replace( 'result',
	{
		enterMode : CKEDITOR.ENTER_BR,
		skin : 'office2003',
		extraPlugins:'autogrow'
	});
		

</script>

<?php
$ro->coconutDesign();
echo "<br>MORPHOLOGY:".$ro->coconutTextBox_return("morphology","");
echo "<Br>";
echo "<br>REMARKS:".$ro->coconutTextBox_return("remarks","");;

$ro->coconutFormStop();
?>
