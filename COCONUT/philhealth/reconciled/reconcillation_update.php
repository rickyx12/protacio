<?php
include("../../../myDatabase.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];

$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];
$type = $_GET['type'];
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
xmlhttp.open('GET','reconcillation.php?month=$month&day=$day&year=$year&month1=$month1&day1=$day1&year1=$year1&type=$type',true);
xmlhttp.send();

window.setTimeout(function(){ RefreshTable()},3000);
}

</script>
</head>
<body onload=RefreshTable()>
    <div id=tablediv></div>
</body>
</html>";


?>
