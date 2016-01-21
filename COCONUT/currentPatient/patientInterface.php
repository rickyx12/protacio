<?php
include("../../myDatabase.php");
//require_once('../authentication.php');
$username = $_POST['username'];
$module = $_POST['module'];
//$_SESSION['username'] = $username;
$ro = new database();

/*
if ( (!isset($username) && !isset($module)) ) {
header("Location:http://".$ro->getMyUrl()."/LOGINPAGE/module.php ");
}
*/
?>

<html>
<head>
<title>PATIENT PROFILE</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />



<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/flow/rickyCSS1.css" />
<script type="text/javascript" src="http://<?php echo $ro->getMyUrl(); ?>/jquery.js"></script>
<script type="text/javascript" src="http://<?php echo $ro->getMyUrl(); ?>/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/jquery.autocomplete.css" />


<script type='text/javascript'>

	$().ready(function() {
	    $("#patientSearch").autocomplete("searchRegisteredPatient.php", {
	        width: 260,
	        matchContains: true,
	        selectFirst: false
                
	    }).result(function(event, data, formatted) {

$("form[name='searchMe']").submit();
 });
;
	});
        





var patient = 'Search Patient';
function SetMsg (txt,active) {
    if (txt == null) return;
    
 
    if (active) {
        if (txt.value == patient) txt.value = '';                     
    } else {
        if (txt.value == '') txt.value = patient;
    }
}

window.onload=function() { SetMsg(document.getElementById('patientSearch', false)); }


$("#breadcrumbs a").hover(
    function () {
        $(this).addClass("hover").children().addClass("hover");
        $(this).parent().prev().find("span.arrow:first").addClass("pre_hover");
    },
    function () {
        $(this).removeClass("hover").children().removeClass("hover");
        $(this).parent().prev().find("span.arrow:first").removeClass("pre_hover");
    }
);


$(document).ready(function(){
  $("#seeMoreRecords").click(function(){
    $("#panel").slideToggle("slow");
  });
});


</script>


<style type="text/css"> 
#panel,#flip,#adsContainer
{
padding:5px;
text-align:center;
background-color:#FFFFFF;
border:solid 1px #FF0099;
}
#seeMoreRecords {
padding:5px;
text-align:left;
background-color:#FFFFFF;
border-top:solid 1px #FFFFFF;
border-bottom:solid 1px #FF0000;
border-left:solid 1px #FF0000;
border-right:solid 1px #FF0000;
width:575px;
}
#panel
{
padding:5px;
display:none;
border-top:none;
border-bottom:solid 1px #FFFFFF;
border-left:solid 1px #FFFFFF;
border-right:solid 1px #FFFFFF;
width:575px;
}

</style>


</head>
<body>

<ol id="breadcrumbs">
  <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/currentPatient/initializePatient.php" class="odd"><font color=white>Home</font><span class="arrow"></span></a></li>
  <li><a href="http://<?php echo $ro->getMyUrl() ?>/COCONUT/currentPatient/patientInterface_walkIn.php?completeName=&username=<?php echo $username; ?>&module=PATIENT"><font color=white>Patient</font><span class="arrow"></span></a></li>
  <li><a href="http://<?php echo $ro->getMyUrl(); ?>/LOGINPAGE/module.php" class="odd"><font color=yellow>Search Patient</font><span class="arrow"></span></a></li>
<li></li>    
<li>


<?php echo "

<form name='searchMe' method='post' action='patientInterface.php'>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type=text name='patientSearch' id='patientSearch' style='   
	background:#FFFFFF url(http://".$ro->getMyUrl()."/COCONUT/myImages/search.jpeg) no-repeat 4px 4px;
	padding:4px 4px 4px 22px;
	border:1px solid #CCCCCC;
	width:400px;
	height:25px;' class='txtBox'
	onfocus='SetMsg(this, true);'
    	onblur='SetMsg(this,false);'
	value='Search Patient'
>
<input type='hidden' name='username' value='$username'>
<input type='hidden' name='module' value='$module'>
</form>
";


 ?></li>

</ol>

<?php
echo "<br><center><div>";
$ro->coconutTableStart();
$ro->coconutTableRowStart();
$ro->coconutTableHeader("Status");
$ro->coconutTableHeader("Reg#");
$ro->coconutTableHeader("Name");
$ro->coconutTableHeader("Registration Date");
$ro->coconutTableHeader("Type");
$ro->coconutTableHeader("Branch");
$ro->coconutTableRowStop();
$ro->showPatientHistory($_POST['patientSearch'],$_POST['username'],"0","10");
echo "</div>";
echo "</table>";

if( $ro->showPatientHistory_count($_POST['patientSearch'],$_POST['username']) > 10 ) {
echo "
<div id='seeMoreRecords'>
<center><font size=4 color=red>Click to See more Records </font></center>
</div>";

echo "<div id='panel'>";
$ro->coconutTableStart();
echo "
<tr>
<Td><font color='white'>&nbsp;Status&nbsp;</font></tD>
<Td><font color='white'>&nbsp;Reg#&nbsp;</font></tD>
<Td><font color='white'>&nbsp;Name&nbsp;</font></tD>
<Td><font color='white'>&nbsp;&nbsp;&nbsp;&nbsp;Registration Date&nbsp;</font></tD>
<Td><font color='white'>&nbsp;Type&nbsp;</font></tD>
<Td><font color='white'>&nbsp;Branch&nbsp;</font></tD>
</tr>
";
$ro->coconutTableRowStart();
$ro->showPatientHistory($_POST['patientSearch'],$_POST['username'],"11","1000");
$ro->coconutTableRowStop();
echo "</table>";
echo "</div>";

echo "</center>";
}else { }

?>
</body>
</html>
