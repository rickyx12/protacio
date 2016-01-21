<?php
include("../../myDatabase.php");
$username = $_GET['usernamez'];
$ro = new database();

?>
<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/flow/rickyCSS1.css" />
<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />


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

echo "<form method='get' action='diagnosticTimer1.php'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<br><center><div style='border:1px solid #000000; width:600px; height:180px; border-color:black black black black;'>";

echo "<br><table border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<td><font class='labelz'>Current Diagnostic Timer is&nbsp;</font></td>";
echo "<td><font class='labelz'><font color=red>";
echo $ro->getDiagnosticTimer();
echo "</font></td>";
echo "</tr>";
echo "</table>";
echo "<br><br>";
echo "<table border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<td><font class='labelz'>New Diagnostic Timer&nbsp;</font></td>";
echo "<td><input type=text name='diagnosticTimer' class='txtBox'></td>";
echo "</tr>";
echo "</table>";
echo "<br><input type=submit value='Proceed' style='border:1px solid #000; background-color:#3b5998; color:white'>";
echo "</div>";
echo "</form>";

?>
