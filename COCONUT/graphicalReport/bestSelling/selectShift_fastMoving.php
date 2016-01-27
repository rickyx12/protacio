<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$title = $_GET['title'];
$ro = new database();

?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<?php
 
echo "<form method='get' action='showFastMovingItems.php'>";
echo "<input type=hidden name='username' value='$username'>";
$ro->coconutHidden("title",$title);
echo "<br><br><Br><br><center><div style='border:1px solid #000000; width:500px; height:100px; border-color:black black black black;'>";

echo "<br><table border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<td><font class='labelz'> Date&nbsp;</font></td>";
echo "<td>
<select name='month' class='comboBoxShort'>  
<option value='01'>Jan</option>
<option value='02'>Feb</option>
<option value='03'>Mar</option>
<option value='04'>Apr</option>
<option value='05'>May</option>
<option value='06'>Jun</option>
<option value='07'>Jul</option>
<option value='08'>Aug</option>
<option value='09'>Sep</option>
<option value='10'>Oct</option>
<option value='11'>Nov</option>
<option value='12'>Dec</option>
</select>";
echo "&nbsp;<input type=text name='year' class='shortField' value='".date("Y")."'>";
echo "</td>";
echo "</tr>";

echo "<Tr>";
echo "<tD>Type&nbsp;</tD>";
echo "<td>";
$ro->coconutComboBoxStart_long("type");
echo "<option value='All'>All</option>";
echo "<option value='OPD'>OPD</option>";
echo "<option value='IPD'>IPD</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

echo "</table>";
echo "<br><input type=submit value='Proceed' style='border:1px solid #000; background-color:#3b5998; color:white;' >";
echo "</div>";

echo "</form>";

?>
