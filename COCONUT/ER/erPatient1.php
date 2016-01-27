<?php
include("../../myDatabase.php");
$username = $_GET['username'];
$date = $_GET['date'];
$ro = new database();

echo "<html>";
echo "<head>";
echo "<script src='http://".$ro->getMyUrl()."/jquery.js'></script>";
echo "<script type='text/javascript'>";
echo "$(document).ready(function(){ ";
echo "refreshTable();";
echo "});";
echo "function refreshTable(){";
echo  "$('#tableHolder').load('http://".$ro->getMyUrl()."/COCONUT/ER/erPatient.php?username=$username', function(){";
echo  " setTimeout(refreshTable, 6000);";
echo   "  });";
echo   " }";
echo "</script>";
echo "</head>";
echo " <body>";
echo "<div id='tableHolder'></div>";
echo "</body>";
echo "</html>";

?>
