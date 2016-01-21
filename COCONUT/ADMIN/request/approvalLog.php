<?php
include("../../../storedProcedure.php");
$ro = new storedProcedure();
$ro->coconutDesign();
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

<ol id="breadcrumbs">

      
        <li><a href="http://<?php echo $ro->getMyUrl(); ?>/LOGINPAGE/module.php"><font color=white>Home</font><span class="arrow"></span></a></li>
        <li><a href="#" class='odd'><font color=yellow>Admin Approval</font><span class="arrow"></span></a></li>


    <li>&nbsp;&nbsp;</li>
</ol>

<?php
$ro->coconutUpperMenuStart();
$ro->coconutUpperMenuStop();
echo "<Br><bR><Br>";
$ro->coconutFormStart("post","approvalLog1.php");
$ro->coconutBoxStart("500","150");
echo "<br>";
echo "<table border=0>";
echo "<Tr>";
echo "<Td>Username</td>";
echo "<td>";
$ro->coconutTextBox("username","");
echo "</tD>";
echo "</tr>";

echo "<Tr>";
echo "<Td>Password</td>";
echo "<td>".$ro->coconutPasswordBox_return("password","")."</tD>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutHidden("module","APPROVAL");
$ro->coconutFormStop();
?>
