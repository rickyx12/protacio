<?php
include("../../../storedProcedure.php");
require_once('../authentication.php');
$date = $_POST['date'];
$username =$_POST['username'];
$makeDo = $_POST['makeDo'];

$ro = new storedProcedure();
echo "<html>";
echo "<head>";

if($makeDo == "putStatus") {

if(isset($_POST['requestNo']) && isset($_POST['status']) ) {
$requestNo = $_POST['requestNo'];
$status = $_POST['status'];
$ro->editNow("admin2request","requestNo",$requestNo,"status",$status."_".$username);
$ro->editNow("admin2request","requestNo",$requestNo,"status_time",$ro->getSynapseTime());
$ro->editNow("admin2request","requestNo",$requestNo,"status_date",date("Y-m-d"));
$ro->editNow("admin2request","requestNo",$requestNo,"status_encodeIn",getenv("REMOTE_ADDR")."-".php_uname("n"));
}else { }
}

?>



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

<?php
echo "<script src='http://localhost/jquery.js'></script>";
echo "<script type='text/javascript'>";
echo "$(document).ready(function(){ ";
echo "refreshTable();";
echo "});";
echo "function refreshTable(){";
echo  "$('#tableHolder').load('getTable.php',{ 'date':'".$date."','username':'".$username."' }, function(){";
echo  "   setTimeout(refreshTable, 4000);";
echo   "  });";
echo   " }";
echo "</script>";
echo "</head>";
echo " <body>";
?>

<ol id="breadcrumbs">

      
        <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/ADMIN/request/initializeRequest.php"><font color=white>Home</font><span class="arrow"></span></a></li>
        <li><a href="#" class='odd'><font color=yellow>Admin Approval</font><span class="arrow"></span></a></li>

    <li>&nbsp;&nbsp;</li>
</ol>

<?php
$ro->coconutUpperMenuStart();
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/ADMIN/request/requestStatus_date.php?date=".date("Y-m-d")."' target='_blank'>View All Request</a></li>";
$ro->coconutUpperMenuStop();
echo "<br>";
echo "<center>";echo "<div id='tableHolder'></div>";
echo "</center>";
echo "</body>";
echo "</html>";
?>
