<?php
include("../../myDatabase.php");
$ro = new database();
$username = $_GET['username'];
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<script src="../js/jquery-2.1.4.min.js"></script>
<script src="accesories/jquery.uploadfile.min.js"></script>
<link href="accesories/uploadfile.css" rel="stylesheet">
</head>
<body>

<div id="mulitplefileuploader">Upload</div>

<div id="status"></div>
<script>

$(document).ready(function()
{

var data = {
	username:"<? echo $username ?>",
	registrationNo: "<? echo $registrationNo ?>",
	itemNo: "<? echo $itemNo ?>"
};

var settings = {
	url: "upload.php",
	method: "POST",
	multiple:false,
	dragDrop:false,
	formData:data,
	allowedTypes:"docx",
	maxFileCount:1,
	fileName: "myfile",
	onSuccess:function(files,data,xhr)
	{
		$("#status").html("<font color='green'>Upload is success</font>");
		$(".ajax-file-upload").hide();
		
	},
	onError: function(files,status,errMsg)
	{		
		$("#status").html("<font color='red'>Upload is Failed</font>");
	}
}
$("#mulitplefileuploader").uploadFile(settings);

});
</script>
</body>
