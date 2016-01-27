<?php
include("../../myDatabase2.php");
$registrationNo = $_POST['registrationNo'];
$excessPF = $_POST['excessPF'];
$excessRoom = $_POST['excessRoom'];
$excessMaxBenefits = $_POST['excessMaxBenefits'];
$PHICportion = $_POST['PHICportion'];
$manual = $_POST['manual'];
$manualValue = $_POST['manualValue'];

$ro = new database2();

$ro->editNow("registrationDetails","registrationNo",$registrationNo,"excessPF",$excessPF);
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"excessRoom",$excessRoom);
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"excessMaxBenefits",$excessMaxBenefits);
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"PHICportion",$PHICportion);
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"hmoManualExcess",$manual);
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"hmoManualExcessValue",$manualValue);



?>
