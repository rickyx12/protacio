<html>
<head>
	<title>Sample CKEditor Site</title>
	<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
</head>
<body>
	<form method="post" action="try1.php">
		
			<textarea id="editor1" name="editor1">&lt;p&gt;Initial value.&lt;/p&gt;</textarea>
			<script type="text/javascript">
			
			CKEDITOR.replace( 'editor1',
	{
		enterMode : CKEDITOR.ENTER_BR,
		skin : 'office2003'
	});
		

			</script>
		</p>
		<p>
			<input type="submit" />
		</p>
	</form>
</body>
</html>
