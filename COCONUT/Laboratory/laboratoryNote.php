<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['username'];

$ro = new database2();

?>

<form>
<textarea rows="6" cols="80" style="border:1px solid #000;" name="comment"></textarea>
</form>
