<?php
include("../../../myDatabase.php");
include("../../../LOGINPAGE/homeDatabase.php");
$description = $_POST['description'];
$qty = $_POST['qty'];
$price = $_POST['price'];
$total = $_POST['total'];

$ro = new database();
$ro->coconutDesign();

if($description == '' || $qty == '' || $price == '' || $total == '' ) {
echo "<script>";
echo "alert('Please Complete the information needed by the request form');";
echo "window.back(-1);";
echo "</script>";
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

<ol id="breadcrumbs">

      
        <li><a href="http://<?php echo $ro->getMyUrl(); ?>/LOGINPAGE/module.php"><font color=white>Home</font><span class="arrow"></span></a></li>
        <li><a href="http://<?php echo $ro->getMyUrl(); ?>/LOGINPAGE/loginpage.php?module=ADMIN" class='odd'>Admin</font><span class="arrow"></span></a></li>
        <li><a href="#" onclick="history.back(-1); return false;"><font color=white>Request To Admin</font><span class="arrow"></span></a></li>
<li><a href="#" class='odd'><font color=yellow>Verify User</font><span class="arrow"></span></a></li>

    <li>&nbsp;&nbsp;</li>
</ol>

<?php
$ro->coconutUpperMenuStart();
$ro->coconutUpperMenuStop();
$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/ADMIN/request/requestForm1.php");
echo "<br><br>";
$ro->coconutBoxStart("500","150");
echo "<br>";
echo "<Table>";
echo "<tr>";
echo "<td>Username</td>";
echo "<Td>";
$ro->coconutTextBox("username","");
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Password</td>";
echo "<Td>".$ro->coconutPasswordBox_return("password","")."</tD>";
echo "</tr>";
echo "</table>";
echo "<Br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutHidden("description",$description);
$ro->coconutHidden("qty",$qty);
$ro->coconutHidden("price",$price);
$ro->coconutHidden("total",$total);
$ro->coconutFormStop();
echo "<Br><br>";
$ro->coconutTableStart();
$ro->coconutTableRowStart();
$ro->coconutTableHeader("Description");
$ro->coconutTableHeader("QTY");
$ro->coconutTableHeader("Price");
$ro->coconutTableHeader("Total");
$ro->coconutTableRowStop();
$ro->coconutTableRowStart();
$ro->coconutTableData($description);
$ro->coconutTableData($qty);
$ro->coconutTableData($price);
$ro->coconutTableData(number_format($total));
$ro->coconutTableRowStop();
$ro->coconutTableStop();

?>
