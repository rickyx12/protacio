<?php
include("../../myDatabase.php");
$ro = new database();
$username = $_GET['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/uploader/accesories/uploadfile.css" rel="stylesheet">
<script src="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/uploader/accesories/jquery.min.js"></script>
<script src="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/uploader/accesories/jquery.uploadfile.min.js"></script>
</head>
<body>

<div id="mulitplefileuploader">Upload</div>

<div id="status"></div>
<script>

$(document).ready(function()
{

var settings = {
	url: "upload.php",
	method: "POST",
	formData: {"username":"<?php echo $username; ?>"},
	allowedTypes:"docx",
	fileName: "myfile",
	multiple: true,
	onSuccess:function(files,data,xhr)
	{
		$("#status").html("<font color='green'>Upload is success</font>");
		
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
