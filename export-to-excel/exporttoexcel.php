<?php  

if( !isset($_POST['reportName']) ) {
	echo "Pls provide report name";
}else {

	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	/*
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");
	*/
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header("Content-Disposition: attachment;filename='".$_POST['reportName'].".xls'");
	header("Content-Transfer-Encoding: binary ");

	echo strip_tags($_POST['tableData'],'<table><th><tr><td>');  
}

?>
