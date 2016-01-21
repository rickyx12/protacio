<?php
include("../../convenienceDB.php");
$username = $_GET['username'];
$transactionNo = $_GET['transactionNo'];


$ro = new convenienceDB();

echo "
<frameset cols='90%,150%' framespacing='0' border='1'>
   <frame src='http://".$ro->getMyUrl()."/COCONUT/convenience/searchInventory.php?transactionNo=$transactionNo&username=$username'  scrolling=no frameborder=1 framespacing=1 name='selection' />
   <frame src='http://".$ro->getMyUrl()."/COCONUT/convenience/sales_output_update.php?transactionNo=$transactionNo' name='selection1' />

</frameset>


";


?>
