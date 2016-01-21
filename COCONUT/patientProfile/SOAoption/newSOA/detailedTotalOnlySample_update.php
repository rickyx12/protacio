<?php
include("../../../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$show = $_GET['show'];
$chargesCode = $_GET['chargesCode'];
$showdate = $_GET['showdate'];
$ro = new database();
echo "<html>";
echo "<head>";
echo "<script src='http://".$ro->getMyUrl()."/jquery.js'></script>";
echo "<script type='text/javascript'>";
echo "$(document).ready(function(){ ";
echo "refreshTable();";
echo "});";
echo "function refreshTable(){";
echo  "$('#tableHolder').load('detailedTotalOnlySample.php?registrationNo=$registrationNo&username=$username&show=$show&chargesCode=$chargesCode&showdate=$showdate', function(){";
echo  " setTimeout(refreshTable, 5000);";
echo   "  });";
echo   " }";
echo "</script>";
echo "</head>";
echo " <body>";
echo "<div id='tableHolder'></div>";
echo "</body>";
echo "</html>";
?>
