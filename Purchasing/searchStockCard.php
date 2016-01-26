<?php
include("../myDatabase.php");
$username=$_GET['username'];
$sino=$_GET['sino'];
$page=$_GET['page'];
$invoiceNo=$_GET['invoiceNo'];

$ro=new database();

?>

<script src="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/serverTime/serverTime.js"></script>
<script type='text/javascript'>

function showResult()
{
    
if (document.addCharge.description.value.length==0)
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
xmlhttp.open("GET","searchAvailableStockCard.php?username="+document.addCharge.username.value+"&description="+document.addCharge.description.value+"&sino="+document.addCharge.sino.value+"&invoiceNo="+document.addCharge.invoiceNo.value+"&page="+document.addCharge.page.value,true);
xmlhttp.send();
}

var charges = 'Search';
function SetMsg (txt,active) {
    if (txt == null) return;
    
 
    if (active) {
        if (txt.value == charges) txt.value = '';                     
    } else {
        if (txt.value == '') txt.value = charges;
    }
}

window.onload=function() { SetMsg(document.getElementById('charges', false)); }

</script>


<?php

echo  "<body onload='DisplayTime();'>";
echo "<form name='addCharge'>";
echo "&nbsp;<input type=text name='description' placeholder='Search Supplies/Medicine' autocomplete='off' id='charges' style='   
	background:#FFFFFF no-repeat 4px 4px;
	padding:4px 4px 4px 2px;
	border:1px solid #000000;
	width:400px;
	height:25px;' class='txtBox'
	onfocus='SetMsg(this, true);'
    	onblur='SetMsg(this,false);'
	onkeyup='showResult();' 
	value=''
>";
echo "<p id='curTime'></p>";
echo "<input type=hidden name='username' value='$username'>";
echo "<input type=hidden name='sino' value='$sino'>";
echo "<input type=hidden name='page' value='$page'>";
echo "<input type=hidden name='invoiceNo' value='$invoiceNo'>";
echo "</form>";
echo "<div id='livesearch'></div>";
echo "</body>";
?>
