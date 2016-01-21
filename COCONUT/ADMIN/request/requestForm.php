<?php
include("../../../myDatabase.php");

$ro = new database();
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

      
  <li><a href="http://<?php echo $ro->getMyUrl(); ?>/LOGINPAGE/module.php" class='odd'><font>Home</font><span class="arrow"></span></a></li>
        <li><a href="http://<?php echo $ro->getMyUrl(); ?>/LOGINPAGE/loginpage.php?module=ADMIN"><font color=white>Admin</font><span class="arrow"></span></a></li>
  <li><a href="#" class='odd'><font color=yellow>Request to Admin</font><span class="arrow"></span></a></li>
    <li>&nbsp;&nbsp;</li>
</ol>

<?php
$ro->coconutUpperMenuStart();
$ro->coconutUpperMenuStop();
echo "<br><br>";
$ro->coconutFormStart("post","requestForm_login.php");
$ro->coconutBoxStart("500","210");

echo "<script src='http://".$ro->getMyUrl()."/jquery.js'></script>";

echo "

<script>
    $(document).ready(function () {
        $('#price,#qty').keyup(function () {
            ComputeCosts();
        }
);
    });

    function ComputeCosts() {
        var qty1 = Number($('#qty').val());
        var price1 = Number($('#price').val());
        var totalz = price1 * qty1;
        $('#total').val(totalz);
    }
</script>

";

echo "<Br>";
echo "<table border=0>";
echo "<tr>";
echo "<Td>".$ro->coconutText("Description")."</td>";
echo "<td>";
$ro->coconutTextBox("description","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<Td>".$ro->coconutText("QTY")."</td>";
echo "<td>";
$ro->coconutTextBox_short("qty","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<Td>".$ro->coconutText("Price")."</td>";
echo "<td>";
$ro->coconutTextBox_short("price","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<Td>".$ro->coconutText("Total")."</td>";
echo "<td>";
$ro->coconutTextBox_short("total","");
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutHidden("user","r1cky");
$ro->coconutFormStop();

?>
