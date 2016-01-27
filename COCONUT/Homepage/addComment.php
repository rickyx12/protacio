<?php
include("../../myDatabase.php");
$comment = $_GET['comment'];
$username = $_GET['username'];
$ro = new database();




if($comment != "") {
$ro->addNewNote("","guest",$username,$comment,date("M d, Y"),$ro->getSynapseTime());
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Homepage/homepage.php");
}else {
echo "
<script type='text/javascript'>
alert('Pls put a message');
history.back();
</script>

";
}


?>
