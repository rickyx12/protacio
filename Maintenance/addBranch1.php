<?php
include("../myDatabase.php");
$username = $_POST['username'];
$ro = new database();


if($ro->checkBranch($_POST['branch'])==$_POST['branch']) {
echo "<script type='text/javascript'>
alert('Sorry,The Branch $_POST[branch] was already exist');
history.back();
</script>";
}else {
$ro->addBranch($_POST['branch']);

echo "
<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/Maintenance/addBranch.php?usernamez=$username';
</script>

";
}
?>
