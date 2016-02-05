<?php
include("../../../myDatabase.php");
$shift = $_GET['shift'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$ro = new database();



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
xmlhttp.open('GET','http://".$ro->getMyUrl()."/COCONUT/Cashier/cashierReport/dailyCashiersReport.php?month=$month&day=$day&year=$year&shift=$shift',true);
xmlhttp.send();

window.setTimeout(function(){ RefreshTable()},5000);
}

</script>
</head>
<body onload=RefreshTable()>
 <div id=tablediv></div>
</body>
</html>";


?>
