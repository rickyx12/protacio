<?php
include("../../myDatabase.php");
$module = $_GET['module'];
$username = $_GET['username'];
$branch = $_GET['branch'];
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
xmlhttp.open('GET','admitted.php?module=$module&username=$username&branch=$branch',true);
xmlhttp.send();

window.setTimeout(function(){ RefreshTable()},5500);
}

</script>
</head>
<body onload=RefreshTable()>
    <div id=tablediv></div>
</body>
</html>";


?>
