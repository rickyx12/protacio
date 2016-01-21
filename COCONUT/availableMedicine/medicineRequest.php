<?php
include("../../myDatabase.php");
$branch = $_GET['branch'];
$inventoryType = $_GET['inventoryType'];
$username = $_GET['username'];
$requestingDepartment = $_GET['requestingDepartment'];
$requestNo = $_GET['requestNo'];

$ro = new database();
?>


<script type='text/javascript'>

function showResult()
{
    
if (document.medicineSearch.searchMedicine.value.length==0)
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
xmlhttp.open("GET","medicineRequest1.php?requestingDepartment="+document.medicineSearch.requestingDepartment.value+"&inventoryType="+document.medicineSearch.inventoryType.value+"&branch="+document.medicineSearch.branch.value+"&username="+document.medicineSearch.username.value+"&description="+document.medicineSearch.searchMedicine.value+"&requestNo="+document.medicineSearch.requestNo.value+"&inventoryLocation="+document.medicineSearch.inventoryLocation.value,true);
xmlhttp.send();
}



var record = 'Search <?php echo $inventoryType." in ". $branch ?>';
function SetMsg (txt,active) {
    if (txt == null) return;
    
 
    if (active) {
        if (txt.value == record) txt.value = '';                     
    } else {
        if (txt.value == '') txt.value = record;
    }
}

window.onload=function() { SetMsg1(document.getElementById('searchMedicine', false)); }

</script>



<style type='text/css'>
.txtBox {
	border: 1px solid #CCC;
	color: #999;
	height: 50px;
	width: 350px;
}
</style>


<?php
echo "<form name='medicineSearch'>";
echo "&nbsp;<input type=text name='medicine' id='searchMedicine' style='   
	background:#FFFFFF no-repeat 4px 4px;
	padding:4px 4px 4px 2px;
	border:1px solid #CCCCCC;
	width:400px;
	height:25px;' class='txtBox'
	onfocus='SetMsg(this, true);'
    	onblur='SetMsg(this,false);'
	value='Search $inventoryType in $branch'
 	onkeyup='showResult();' 
>";
echo "<br> Request To <select name='inventoryLocation' style='border:1px solid #000;' > <option value='PHARMACY' >PHARMACY</option> <option value='CSR' >CSR</option>  </select>";
echo "<input type=hidden name='username' value='$username'>";
echo "<input type=hidden name='branch' value='$branch'>";
echo "<input type=hidden name='inventoryType' value='$inventoryType'>";
echo "<input type=hidden name='requestingDepartment' value='$requestingDepartment'>";
echo "<input type=hidden name='requestNo' value='$requestNo'>";
echo "</form>";
echo "<div id='livesearch'></div>";
?>
