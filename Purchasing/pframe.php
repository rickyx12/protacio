<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Protacio Hospital</title>
</head>
<?php

$username=$_GET['username'];

echo "
<frameset rows='*' cols='300,*' framespacing='0' frameborder='no' border='0'>
  <frame src='pleft.php?username=$username' name='leftFrame' noresize='noresize' id='leftFrame' title='leftFrame' />
  <frame src='pmain.php' name='mainFrame' id='mainFrame' title='hmomain' />
</frameset>
<noframes>
<?php
";
?>
<body>
</body>
</noframes></html>
