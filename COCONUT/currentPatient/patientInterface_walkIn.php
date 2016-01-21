<?php
include("../../myDatabase.php");
session_start();
$username = $_GET['username'];
$module = $_SESSION['module'];
$_SESSION['username'] = $username;
$ro = new database();

if ( (!isset($username) && !isset($module)) ) {
header("Location:http://".$ro->getMyUrl()."/LOGINPAGE/module.php ");
}

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
	    $("#patientSearch").autocomplete("searchRegisteredPatient_walkIn.php", {
	        width: 260,
	        matchContains: true,
	        selectFirst: false
                
	    }).result(function(event, data, formatted) {

window.location="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/currentPatient/patientInterface_walkIn.php?completeName="+data+"&username=<?php echo $_GET['username']; ?>"; 

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
</script>


</head>
<body>

<ol id="breadcrumbs">
  <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/currentPatient/initializePatient.php" class="odd"><font color=white>Home</font><span class="arrow"></span></a></li>

<li><a href="http://<?php echo $ro->getMyUrl() ?>/COCONUT/currentPatient/patientInterface.php?completeName=&username=<?php echo $username; ?>&module=PATIENT"><font color=white>Walk In</font><span class="arrow"></span></a></li>

  <li><a href="http://<?php echo $ro->getMyUrl(); ?>/LOGINPAGE/module.php" class="odd"><font color=yellow>Search Patient</font><span class="arrow"></span></a></li>
<li></li>    
<li>


<?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type=text name='patientSearch' id='patientSearch' style='   
	background:#FFFFFF url(http://".$ro->getMyUrl()."/COCONUT/myImages/search.jpeg) no-repeat 4px 4px;
	padding:4px 4px 4px 22px;
	border:1px solid #CCCCCC;
	width:400px;
	height:25px;' class='txtBox'
	onfocus='SetMsg(this, true);'
    	onblur='SetMsg(this,false);'
	value='Search Patient'
>";


 ?></li>

</ol>

<?php

$ro->showPatientHistory_walkIn($_GET['completeName'],$_GET['username']);

?>
</body>
</html>
