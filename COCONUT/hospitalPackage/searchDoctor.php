<?php
include("../../myDatabase.php");
$packageName = $_GET['packageName'];
$packagePrice = $_GET['packagePrice'];
$phicPrice = $_GET['phicPrice'];
$ro = new database();

/*
$ro->getBatchNo();
$myFile = "/opt/lampp/htdocs/COCONUT/trackingNo/batchNo.dat";
$fh = fopen($myFile, 'r');
$batchNo = fread($fh, 100);
fclose($fh);
*/

?>

<script src="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/serverTime/serverTime.js"></script>
<script type='text/javascript'>

function showResult()
{
    
if (document.addCharge.availableCharges.value.length==0)
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
xmlhttp.open("GET","searchDoctor1.php?packageName="+document.addCharge.packageName.value+"&desc="+document.addCharge.availableCharges.value+"&packagePrice="+document.addCharge.packagePrice.value+"&phicPrice="+document.addCharge.phicPrice.value,true);
xmlhttp.send();
}





var charges = 'Search Doctor';
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
echo  "<body>";
echo "<form name='addCharge'>";
echo "&nbsp;<input type=text name='availableCharges' id='charges' style='   
	background:#FFFFFF no-repeat 4px 4px;
	padding:4px 4px 4px 2px;
	border:1px solid #CCCCCC;
	width:400px;
	height:25px;' class='txtBox'
	onfocus='SetMsg(this, true);'
    	onblur='SetMsg(this,false);'
	onkeyup='showResult();' 
	value='Search Doctor'
>";
echo "
<input type=hidden name='packageName' value='$packageName'>
<input type=hidden name='packagePrice' value='$packagePrice'>
<input type=hidden name='phicPrice' value='$phicPrice'>

</form>";

echo "<a href='http://".$ro->getMyUrl()."/COCONUT/hospitalPackage/searchCharges.php?packageName=$packageName&packagePrice=$packagePrice&phicPrice=$phicPrice' style='text-decoration:none;'><font color=red>Services</font></a>";

echo "<a href='http://".$ro->getMyUrl()."/COCONUT/hospitalPackage/searchInventory.php?packageName=$packageName&packagePrice=$packagePrice&phicPrice=$phicPrice' style='text-decoration:none;'><br><font color=red>Medicine / Supplies</font></a>";

echo "<div id='livesearch'></div>";
echo "</body>";
?>
