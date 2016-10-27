<?php
include("../../../myDatabase2.php");
$docCode = $_GET['doctorCode'];
$username = $_GET['username'];
$ro = new database2();

/*
echo "<script src='http://".$ro->getMyUrl()."/jquery.js'></script>";
echo "<script type='text/javascript'>";
echo "$(document).ready(function(){ ";
echo "refreshTable();";
echo "});";
echo "function refreshTable(){";
echo  "$('#tableHolder').load('viewPatient.php',{ 'doctorCode':'".$docCode."'}, function(){";
echo  "   setTimeout(refreshTable, 4000);";
echo   "  });";
echo   " }";
echo "</script>";
echo "</head>";
echo " <body>";
echo "<div id='tableHolder'></div>";
echo "</body>";
*/



echo " 
 <html>
<head>
<script type='text/javascript'>
function RefreshTable()
{
if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
}
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById('tablediv').innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open('GET','viewPatient.php?doctorCode=$docCode&username=$username',true);
xmlhttp.send();

window.setTimeout(function(){ RefreshTable()},6000);
}

</script>
</head>
<body onload=RefreshTable()>
    <div id=tablediv></div>
</body>
</html>";




?>
