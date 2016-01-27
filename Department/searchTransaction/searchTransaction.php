<?php
include("../../myDatabase.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$fromTime_hour = $_GET['fromTime_hour'];
$fromTime_minutes = $_GET['fromTime_minutes'];
$fromTime_seconds = $_GET['fromTime_seconds'];
$toTime_hour = $_GET['toTime_hour'];
$toTime_minutes = $_GET['toTime_minutes'];
$toTime_seconds = $_GET['toTime_seconds'];
$username = $_GET['username'];



$ro = new database();

/*
$ro->getBatchNo();
$myFile = "/opt/lampp/htdocs/COCONUT/trackingNo/batchNo.dat";
$fh = fopen($myFile, 'r');
$batchNo = fread($fh, 100);
fclose($fh);
*/

?>

<script type='text/javascript'>

function showResult()
{
    
if (document.transaction.patientName.value.length==0)
  {
  document.getElementById("livesearch").innerHTML="";
  document.getElementById("livesearch").style.border="0px";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
    document.getElementById("livesearch").style.border="0px solid #A5ACB2";
    }
  }
xmlhttp.open("GET","searchTransaction1.php?patientName="+document.transaction.patientName.value+"&month="+document.transaction.month.value+"&day="+document.transaction.day.value+"&year="+document.transaction.year.value+"&fromTime_hour="+document.transaction.fromTime_hour.value+"&fromTime_minutes="+document.transaction.fromTime_minutes.value+"&fromTime_seconds="+document.transaction.fromTime_seconds.value+"&toTime_hour="+document.transaction.toTime_hour.value+"&toTime_minutes="+document.transaction.toTime_minutes.value+"&toTime_seconds="+document.transaction.toTime_seconds.value+"&username="+document.transaction.username.value,true);
xmlhttp.send();
}





var patientName = 'Search Patient';
function SetMsg (txt,active) {
    if (txt == null) return;
    
 
    if (active) {
        if (txt.value == patientName) txt.value = '';                     
    } else {
        if (txt.value == '') txt.value = patientName;
    }
}

window.onload=function() { SetMsg(document.getElementById('patientName', false)); }

</script>


<?php
echo  "<body>";
echo "<a href='/Department/patientList_updates.php?month=$month&day=$day&year=$year&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&username=$username&module=PHARMACY&branch=Pagadian' style='text-decoration:none;'><font size=2 color=red>Show All Patient</font></a>";
echo "<form name='transaction'>";
echo "&nbsp;<input type=text name='patientName' id='patientName' style='   
	background:#FFFFFF no-repeat 4px 4px;
	padding:4px 4px 4px 2px;
	border:1px solid #CCCCCC;
	width:150px;
	height:25px;' class='txtBox'
	onfocus='SetMsg(this, true);'
    	onblur='SetMsg(this,false);'
	onkeyup='showResult();' 
	value='Search Patient'
>";

echo "<input type=hidden name='month' value='$month'>";
echo "<input type=hidden name='day' value='$day'>";
echo "<input type=hidden name='year' value='$year'>";
echo "<input type=hidden name='fromTime_hour' value='$fromTime_hour'>";
echo "<input type=hidden name='fromTime_minutes' value='$fromTime_minutes'>";
echo "<input type=hidden name='fromTime_seconds' value='$fromTime_seconds'>";
echo "<input type=hidden name='toTime_hour' value='$toTime_hour'>";
echo "<input type=hidden name='toTime_minutes' value='$toTime_minutes'>";
echo "<input type=hidden name='toTime_seconds' value='$toTime_seconds'>";
echo "<input type=hidden name='username' value='$username'>";
echo "</form>";
echo "<div id='livesearch'></div>";
echo "</body>";
?>
