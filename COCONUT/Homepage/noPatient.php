<?php
include("../../myDatabase.php");

$ro = new database();

echo "<style type='text/css'>@import url('http://localhost/COCONUT/myCSS/newCSS.css');</style>";

?>

<div id="main">

<div style="border:1px solid #000; height:auto; width:600px; border-color:black black black black; ">
<br><center><font size=3 color=red><?php echo $ro->getReportInformation("hmoSOA_name"); ?></font>
<br>
<font size=2><?php echo $ro->getReportInformation("hmoSOA_address"); ?></font>
<br><br>
</div>
<br><Br>
<font size=4 color=red>There is No Exact Code</font>
</div>

<div id="list1" class="link-list" style="border:1px solid #000; height:528px; border-color:white black white white; ">
<br><br>
<Br><br>
<font size=1>Patient Code</font><br>
<form method="post" action="checker.php">
<input type=text name="code" autocomplete="off" style="border:1px solid #000; width:138px;"><Br>
<input type="submit" value="Proceed" style="background-color:white; border:1px solid #000; font-size:12px; height:20px;">
</form>
<br><br>
<font size=1 color=red>*Patient Code is the code that was given to you by the nurse's or the billing staff.
<br><br>
 *if you dont know you're code or you have a question. Pls Ask to nurse's or the billing for further assistance</font>
</div>


<div id="list2" class="link-list" style="border:1px solid #000; height:528px; border-color:white white white black; ">
<font>left</font>
</div>


