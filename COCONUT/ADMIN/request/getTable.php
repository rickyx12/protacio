<?php
include("../../../storedProcedure.php");
require_once('../authentication.php');
$date = $_POST['date'];
$username = $_POST['username'];
$ro = new storedProcedure();
echo "<html>";
echo "<head>";
echo "<script src='http://".$ro->getMyUrl()."/jquery.js'></script>";
echo "<script>";

?>

function playBuzzer(){
        $("body").append("<embed src='/COCONUT/bell.mp3' autostart='true' loop='false' width='2' height='0'></embed>");
}

<?php if( $ro->totalRequest($date) != $ro->selectNow("admin2request_forApproved_total","currentTotal","code","1")  ) { ?>
<?php if( $ro->totalRequest($date) > $ro->selectNow("admin2request_forApproved_total","currentTotal","code","1") ) { ?>
playBuzzer();
<?php }else { } ?>
<?php $ro->editNow("admin2request_forApproved_total","code","1","currentTotal",$ro->totalRequest($date)); ?>
<?php }else{ } ?>

<?php

if( $ro->totalRequest($date) > 0 ) {
echo "   
var title = document.title;
document.title = (title == 'For Approval' ? '(".$ro->totalRequest($date).") New Request' : 'For Approval');";
}else {
echo "document.title = 'Waiting for Request' ";
}
echo "</script>";
echo "</head>";
echo "<body>";
$ro->getTable_admin($date,$username);
echo "</body>";
echo "</html>";
?>
