<?php

include("../../myDatabase3.php");

$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];

$ro = new database3();

$date = $year.$month.$day;
$date1 = $year1.$month1.$day1;



$datez_m = substr($date,0,4);
$datez_d = substr($date,4,2);
$datez_y = substr($date,6,4);


$datez_m1 = substr($date1,0,4);
$datez_d1 = substr($date1,4,2);
$datez_y1 = substr($date1,6,4);

$date_format = $datez_m."-".$datez_d."-".$datez_y;
$date1_format = $datez_m1."-".$datez_d1."-".$datez_y1;

echo $date_format."<Br>";
echo $date1_format."<Br>";
?>
<script src="../js/jquery-2.1.4.min.js"></script>
<script>
	$(document).ready(function(){

		var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);

		if( isChrome == true ) {
			$("#export").click(function(){
				var data='<table>'+$("#purchaseJournal").html().replace(/<a\/?[^>]+>/gi, '')+'</table>';
				var reportName = '<? echo "Purchase Journal [".$ro->formatDate($date_format)." to ".$ro->formatDate($date1_format)."]" ?>';	

				$('body').prepend("<form method='post' action='../../export-to-excel/exporttoexcel.php' style='display:none' id='ReportTableData'><input type='text' name='tableData' value='"+data+"' ><input type='text' name='reportName' value='"+reportName+"'></form>");
				$('#ReportTableData').submit().remove();
				return false;	
			
			});
		}else {
			$("#export").hide();
		}	

	});
</script>
<?php
echo "<a href='#' id='export'><img src='../../export-to-excel/excel-icon.png'></a>";
$ro->accounting_purchaseJournal($date,$date1);


?>
