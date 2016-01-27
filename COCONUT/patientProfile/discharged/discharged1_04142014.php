<?php
include("../../../storedProcedure.php");
$registrationNo = $_GET['registrationNo'];
$protoType = $_GET['protoType'];
$room = $_GET['room'];
$username = $_GET['username'];
$ro = new storedProcedure();


if($protoType == "Discharged") {
$ro->EditNow("room","Description",$room,"Status","Vacant");
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"dateUnregistered",date("Y-m-d"));
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"timeUnregistered",$ro->getSynapseTime());
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"unregisteredBy",$username);

if( $ro->selectNow("registrationDetails","type","registrationNo",$registrationNo) == "OPD" ) {
$ro->lockedAccountItems($registrationNo,date('Y-m-d H:i:s'),$username);
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"mgh","yes_".$username);
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"mgh_date",date("Y-m-d"));
}else { }

}else {
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"dateUnregistered","");
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"timeUnregistered","");
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"room","");

$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"unregisteredBy","");
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"mgh","");
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"mgh_date","");

}
echo "
<script type='text/javascript'>";

if($protoType == "Discharged") {
echo "alert('Patient is now Discharged');";
}else {
echo "alert('Patient is now Active');";
}
echo " window.location='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientProfile_right.php?registrationNo=$registrationNo&username=$username'
</script>

";

?>
