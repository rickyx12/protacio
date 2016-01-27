<?php
include("../../payrollDatabase.php");
$username = $_GET['username'];

$ro = new payroll();


echo "

<frameset cols='45%,210%' framespacing='0' border='1'>
   <frame src='http://".$ro->getMyUrl()."/COCONUT/payroll/listEmployee.php?username=$username'  scrolling=yes frameborder=1 framespacing=1 name='selection' />
   <frame src='#'  scrolling=yes frameborder=1 framespacing=1 name='rightFrame' />

</frameset>


";

?>



