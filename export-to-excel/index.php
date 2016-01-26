<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Export to Excel using jQuery and PHP</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<style type="text/css">
body, td, th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #333;
	background-color: #FFF;
	margin: 0px;
}
.table {
	background-color:#D4D4D4;
}
.table th {
	background-color:#069;
	color:#FFF;
}
.table td {
	background-color:#F8F8F8;
}
#mainframe {
	padding:20px;
	margin-top:10px;
	margin-left:auto;
	margin-right:auto;
	width:600px;
	border:1px solid #eee;
}
#frame1, #frame0 {
	background-color: #F7F7F7;
	margin: 30px auto auto;
	padding: 10px;
	width: 750px;
	border:1px solid #EEE;
}
</style>
<script type="text/javascript">
$(function(){	   


	$("#exportToExcel").click(function() {									   
		var data='<table>'+$("#ReportTable").html().replace(/<a\/?[^>]+>/gi, '')+'</table>';
		$('body').prepend("<form method='post' action='exporttoexcel.php' style='display:none' id='ReportTableData'><input type='text' name='tableData' value='"+data+"' ></form>");
		 $('#ReportTableData').submit().remove();
		 return false;
	});

});
</script>
</head>
<body>
<div id="frame0">
  <h1>Export to Excel using jQuery and PHP</h1>
  <p>More tutorials <a href="http://www.w3schools.in/">http://www.w3schools.in/</a></p>
</div>
<div id="frame1"> <a href="#" id="exportToExcel"><img src="excel-icon.png"></a>
  <table width="600" border="0" cellpadding="4" cellspacing="1" class="table" id="ReportTable">
    <tr>
      <th>Websites</th>
      <th>Owner</th>
      <th>Contact Email</th>
    </tr>
    <tr>
      <td><a href="http://www.connectsin.com">www.connectsin.com</a></td>
      <td><strong>Gautam Kumar</strong></td>
      <td>connectsin@gmail.com</td>
    </tr>
    <tr>
      <td>www.w3schools.in</td>
      <td>Gautam Kumar</td>
      <td>contact@w3schools.in</td>
    </tr>
    <tr>
      <td><a href="http://www.myelesson.org">www.myelesson.org</a></td>
      <td>Mr. Joher</td>
      <td>contact@myelesson.org</td>
    </tr>
  </table>
</div>
</body>
</html>