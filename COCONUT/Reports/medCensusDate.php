<?php
include("../../myDatabase.php");

$ro = new database();

$ro->coconutDesign();
echo "<center><br><br><br><br><BR>";
$ro->coconutBoxStart("500","100");
echo "<br>";
echo "<Table border=0>";
echo "<tr>";
echo "<td>
<font size=2>Date</font>
&nbsp;&nbsp;
<select name='month'>
<option value='".date("M")."'>".date("M")."</option>
<option value='Jan'>Jan</option>
<option value='Feb'>Feb</option>
<option value='Mar'>Mar</option>
<option value='Apr'>Apr</option>
<option value='May'>May</option>
<option value='Jun'>Jun</option>
<option value='Jul'>Jul</option>
<option value='Aug'>Aug</option>
<option value='Sep'>Sep</option>
<option value='Oct'>Oct</option>
<option value='Nov'>Nov</option>
<option value='Dec'>Dec</option>
</select>
</td>";
echo "</tr>";
echo "</table>";
$ro->coconutBoxStop();

?>
