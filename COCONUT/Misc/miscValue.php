<?php
include("../../myDatabase.php");
$function = $_GET['function'];
$description = $_GET['description'];
$value = $_GET['value'];
$id = $_GET['id'];
$username = $_GET['username'];


$ro = new database();

$ro->coconutDesign();
echo "<br><br>";
$ro->coconutBoxStart("600","180");
echo "<Br>";
$ro->coconutFormStart("get","editMisc.php");
$ro->coconutHidden("id",$id);
$ro->coconutHidden("username",$username);
echo "<table border=0>";
echo "<tr>";
echo "<td>".$ro->coconutText("Function")."</td>";
echo "<td><input type='text' name='function' value='$function' class='txtBox' readonly></td>";
echo "</tr>";
echo "<tr>";
echo "<td>".$ro->coconutText("Description")."</td>";
echo "<td><textarea class='txtArea' name='description'>$description</textarea></td>";
echo "</tr>";
echo "<tr>";
echo "<td>".$ro->coconutText("Value")."</td>";
if($function == "anotherPrice") {
echo "<Td>";
$ro->coconutComboBoxStart_short("val");
echo "<option value='$value'>$value</option>";
echo "<option value='IPD'>IPD</option>";
echo "<option value='OPD'>OPD</option>";
$ro->coconutComboBoxStop();
echo "</td>";
}else {
echo "<td><input type='text' name='val' value='$value' class='txtBox'></td>";
}
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutFormStop();
$ro->coconutBoxStop();

?>
