<?

	include "../../myDatabase.php";

	$fileNo = $_POST['fileNo'];

	$ro = new database();

	$file = "../../".$ro->selectNow("uploadedFiles","fileUrl","fileNo",$fileNo);
	unlink($file);
	$ro->deleteNow("uploadedFiles","fileNo",$fileNo);

?>