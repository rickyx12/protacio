<?php
include("../../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];

$ro = new database();
?>

<script type="text/javascript">
function printF(printData)
{
	var a = window.open ('',  '',"status=1,scrollbars=1, width=auto,height=auto");
	a.document.write(document.getElementById(printData).innerHTML.replace(/<a\/?[^>]+>/gi, ''));
	a.document.close();
	a.focus();
	a.print();
	a.close();
}
</script>


<center><a href='#' onClick="printF('printData')"  style="text-decoration:none; color:red;"><img src="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myImages/print-icon.png"> PRINT </a></center>

<div id="printData">

<?
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
xmlhttp.open('GET','planPreview.php?registrationNo=$registrationNo',true);
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
</div>
