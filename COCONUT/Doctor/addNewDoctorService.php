<?php
include("../../myDatabase.php");
$username = $_GET['username'];
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

echo "<form method='get' action='addNewDoctorService1.php'>";
echo "<input type=hidden name='discount' value=''>";
echo "<input type=hidden name='username' value='$username'>";
echo "<br><center><div style='border:1px solid #000000; width:600px; height:280px; border-color:black black black black;'>";
echo "<br><Br><table border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<td><font class='labelz'>Service&nbsp;</font></td>";
echo "<td><input type=text name='serviceName' class='txtBox'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Specialization&nbsp;</font></td>";
echo "<td>";
echo "<select name='specialization' class='comboBox'>";
$ro->showAllSpecialization();
echo "</select>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Cash Rate&nbsp;</font></td>";
echo "<td><input type=text name='cashAmount' class='shortField'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Company Rate&nbsp;</font></td>";
echo "
<td>
<select name='companyRate' class='comboBoxShort'>
<option value='rate1'>rate1</option>
<option value='rate2'>rate2</option>
<option value='rate3'>rate3</option>
<option value='rate4'>rate4</option>
<option value='rate5'>rate5</option>
</select>
</td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>PF Sharing&nbsp;</font></td>";
echo "<td><input type=text name='doctorShare' class='shortField'>&nbsp;<font size=2>Ex:</font>&nbsp;&nbsp;<font size=2 color=red>.60 = 60%</font></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Discount&nbsp;</font></td>";
echo "<td><input type=text name='discount' class='shortField'>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<Td><font class='labelz'>PhilHealth</font></tD>";
echo "<TD>";
$ro->coconutComboBoxStart_short("phic");
echo "<option value='yes'>yes</option>";
echo "<option value='no'>no</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";
echo "<tr><Td>&nbsp;</tD></tR>";
echo "<tr>";
echo "<td>&nbsp;</td><td><input type=submit value='Proceed' style='border:1px solid #000; background-color:#3b5998; color:white' ></td>";
echo "</tr>";
echo "</table>";
echo "</div>";
echo "</form>";


?>
