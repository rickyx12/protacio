<?php
include("../../../myDatabase1.php");
$registrationNo = $_GET['registrationNo'];


$ro = new database1();


$ro->editNow("registrationDetails","registrationNo",$registrationNo,"dateUnregistered",date("M_d_Y"));
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"timeUnregistered",$ro->getSynapseTime());

echo "
<script type='text/javascript'>
alert('Patient is now Discharged');
</script>


";

?>
