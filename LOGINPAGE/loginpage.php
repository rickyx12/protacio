<?php
include("homeDatabase.php");
$module = $_GET['module'];
$from = $_GET['from'];
$ro = new synapse();

?>

<?php
/*
<script type="text/javascript">

    var userAgent = navigator.userAgent.toLowerCase();

    // Figure out what browser is being used.
    var Browser = {
        Version: (userAgent.match(/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/) || [])[1],
        Chrome: /chrome/.test(userAgent),
        Safari: /webkit/.test(userAgent),
        Opera: /opera/.test(userAgent),
        IE: /msie/.test(userAgent) && !/opera/.test(userAgent),
        Mozilla: /mozilla/.test(userAgent) && !/(compatible|webkit)/.test(userAgent),
        Check: function() { alert(userAgent); }
    };

    if (!Browser.Mozilla) { //redirect kung ndi firefox ang gamit
	alert("Pls use FIREFOX/SAFARI only to access this website");
        window.location="http://192.168.1.207/LOGINPAGE/module.php"; 
    }


</script>
*/

?>

<title>PLEASE LOG IN</title>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/flow/rickyCSS1.css" />

<script type='text/javascript'>
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

<ol id="breadcrumbs">
        <li><a href="http://<?php echo $ro->getMyUrl(); ?>/LOGINPAGE/module.php"><font color=white>Home</font><span class="arrow"></span></a></li>
        <li><a href="#" class='odd'><font color=yellow><?php echo strip_tags($_GET['module']); ?></font><span class="arrow"></span></a></li>

    <li>&nbsp;&nbsp;</li>
</ol>

<?

echo "
<script type='text/javascript'>
var username = 'USERNAME';
function SetMsg (txt,active) {
    if (txt == null) return;
    
 
    if (active) {
        if (txt.value == username) txt.value = '';                     
    } else {
        if (txt.value == '') txt.value = username;
    }
}

window.onload=function() { SetMsg(document.getElementById('login', false)); }

var password = 'PASSWORD';
function SetMsg1 (txt,active) {
    if (txt == null) return;
    
 
    if (active) {
        if (txt.value == password) txt.value = '';                     
    } else {
        if (txt.value == '') txt.value = password;
    }
}

window.onload=function() { SetMsg1(document.getElementById('login1', false)); }

</script>


<style type='text/css'>
.txtBox {
	border: 1px solid #CCC;
	color: #999;
	height: 50px;
	width: 350px;
}
</style>

";
$ro->coconutUpperMenuStart();
$ro->coconutUpperMenuStop();
echo "<br><br><br>";

echo "<center><div style='border:1px solid #3b5998; width:400px; height:150px;	'>";
echo "<br><form method='post' action='loginpage_check.php'>
<input type=hidden name='module' value='$_GET[module]'>
<input type=hidden name='from' value='$_GET[from]'>
<input type=text name='username' autocomplete='off' id='login' style='   
	background:#FFFFFF no-repeat 4px 4px;
	padding:4px 4px 4px 2px;
	border:1px solid #CCCCCC;
	width:200px;
	height:25px;' class='txtBox'
	onfocus='SetMsg(this, true);'
    	onblur='SetMsg(this,false);'
	value='USERNAME'
><br><br>
<input type=password id='login' name='password' style='   
	background:#FFFFFF no-repeat 4px 4px;
	padding:4px 4px 4px 2px;
	border:1px solid #CCCCCC;
	width:200px;
	height:25px;' class='txtBox'
 	onfocus='SetMsg1(this, true);'
    	onblur='SetMsg1(this, false);'
	value='PASSWORD'
><br><br>
<input type=submit value='LOG IN' style='border:1px solid #000000; background:#3b5998 no-repeat 4px 4px; color:white;'>
</form>";
echo "</div>";
echo "<Br><br>";
/*
if( $module == "ADMIN" ) {
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/ADMIN/request/requestForm.php' style='text-decoration:none;'><font color=red>Request To Admin</font></a>&nbsp;&nbsp;".$ro->coconutImages_return("arrowAdmin.png")."&nbsp;&nbsp;<a href='http://".$ro->getMyUrl()."/COCONUT/ADMIN/request/approvalLog.php' style='text-decoration:none;'><font color=blue>for Approval</font></a> ";
}else { }
*/
echo "</center>";
?>



