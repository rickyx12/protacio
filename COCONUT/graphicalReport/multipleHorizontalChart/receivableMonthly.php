<?php
include("../../../myDatabase1.php");

$month = $_GET['month'];
$year = $_GET['year'];

	/* Libchart - PHP chart library
	 * Copyright (C) 2005-2011 Jean-Marc Trémeaux (jm.tremeaux at gmail.com)
	 * 
	 * This program is free software: you can redistribute it and/or modify
	 * it under the terms of the GNU General Public License as published by
	 * the Free Software Foundation, either version 3 of the License, or
	 * (at your option) any later version.
	 * 
	 * This program is distributed in the hope that it will be useful,
	 * but WITHOUT ANY WARRANTY; without even the implied warranty of
	 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 * GNU General Public License for more details.
	 *
	 * You should have received a copy of the GNU General Public License
	 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
	 * 
	 */
	
	/**
	 * Multiple horizontal bar chart demonstration.
	 *
	 */

	include "../../../COCONUT/libchart/libchart/classes/libchart.php";

	$chart = new revenueBarChart(3500, 2450);
	$ro = new database1();	
	
	$serie1 = new XYDataSet();
	$serie1->addPoint(new Point("$month 31",$ro->getPHICReceivablesMonthly($month,"31",$year) / 1000) );
	$serie1->addPoint(new Point("$month 30",$ro->getPHICReceivablesMonthly($month,"30",$year) / 1000) );
	$serie1->addPoint(new Point("$month 29",$ro->getPHICReceivablesMonthly($month,"29",$year) / 1000) );
	$serie1->addPoint(new Point("$month 28",$ro->getPHICReceivablesMonthly($month,"28",$year) / 1000) );
	$serie1->addPoint(new Point("$month 27",$ro->getPHICReceivablesMonthly($month,"27",$year) / 1000) );
	$serie1->addPoint(new Point("$month 26",$ro->getPHICReceivablesMonthly($month,"26",$year) / 1000) );
	$serie1->addPoint(new Point("$month 25",$ro->getPHICReceivablesMonthly($month,"25",$year) / 1000) );
	$serie1->addPoint(new Point("$month 24",$ro->getPHICReceivablesMonthly($month,"24",$year) / 1000) );
	$serie1->addPoint(new Point("$month 23",$ro->getPHICReceivablesMonthly($month,"23",$year) / 1000) );
	$serie1->addPoint(new Point("$month 22",$ro->getPHICReceivablesMonthly($month,"22",$year) / 1000) );
	$serie1->addPoint(new Point("$month 21",$ro->getPHICReceivablesMonthly($month,"21",$year) / 1000) );
	$serie1->addPoint(new Point("$month 20",$ro->getPHICReceivablesMonthly($month,"20",$year) / 1000) );
	$serie1->addPoint(new Point("$month 19",$ro->getPHICReceivablesMonthly($month,"19",$year) / 1000) );
	$serie1->addPoint(new Point("$month 18",$ro->getPHICReceivablesMonthly($month,"18",$year) / 1000) );
	$serie1->addPoint(new Point("$month 17",$ro->getPHICReceivablesMonthly($month,"17",$year) / 1000) );
	$serie1->addPoint(new Point("$month 16",$ro->getPHICReceivablesMonthly($month,"16",$year) / 1000) );
	$serie1->addPoint(new Point("$month 15",$ro->getPHICReceivablesMonthly($month,"15",$year) / 1000) );
	$serie1->addPoint(new Point("$month 14",$ro->getPHICReceivablesMonthly($month,"14",$year) / 1000) );
	$serie1->addPoint(new Point("$month 13",$ro->getPHICReceivablesMonthly($month,"13",$year) / 1000) );
	$serie1->addPoint(new Point("$month 12",$ro->getPHICReceivablesMonthly($month,"12",$year) / 1000) );
	$serie1->addPoint(new Point("$month 11",$ro->getPHICReceivablesMonthly($month,"11",$year) / 1000) );
	$serie1->addPoint(new Point("$month 10",$ro->getPHICReceivablesMonthly($month,"10",$year) / 1000) );
	$serie1->addPoint(new Point("$month 09",$ro->getPHICReceivablesMonthly($month,"09",$year) / 1000) );
	$serie1->addPoint(new Point("$month 08",$ro->getPHICReceivablesMonthly($month,"08",$year) / 1000) );
	$serie1->addPoint(new Point("$month 07",$ro->getPHICReceivablesMonthly($month,"07",$year) / 1000) );
	$serie1->addPoint(new Point("$month 06",$ro->getPHICReceivablesMonthly($month,"06",$year) / 1000) );
	$serie1->addPoint(new Point("$month 05",$ro->getPHICReceivablesMonthly($month,"05",$year) / 1000) );
	$serie1->addPoint(new Point("$month 04",$ro->getPHICReceivablesMonthly($month,"04",$year) / 1000) );
	$serie1->addPoint(new Point("$month 03",$ro->getPHICReceivablesMonthly($month,"03",$year) / 1000) );
	$serie1->addPoint(new Point("$month 02",$ro->getPHICReceivablesMonthly($month,"02",$year) / 1000) );
	$serie1->addPoint(new Point("$month 01",$ro->getPHICReceivablesMonthly($month,"01",$year) / 1000) );




	$serie2 = new XYDataSet();
	$serie2->addPoint(new Point("$month 31",$ro->getPHICReceivablesMonthly_package($month,"31",$year) / 1000) );
	$serie2->addPoint(new Point("$month 30",$ro->getPHICReceivablesMonthly_package($month,"30",$year) / 1000) );
	$serie2->addPoint(new Point("$month 29",$ro->getPHICReceivablesMonthly_package($month,"29",$year) / 1000) );
	$serie2->addPoint(new Point("$month 28",$ro->getPHICReceivablesMonthly_package($month,"28",$year) / 1000) );
	$serie2->addPoint(new Point("$month 27",$ro->getPHICReceivablesMonthly_package($month,"27",$year) / 1000) );
	$serie2->addPoint(new Point("$month 26",$ro->getPHICReceivablesMonthly_package($month,"26",$year) / 1000) );
	$serie2->addPoint(new Point("$month 25",$ro->getPHICReceivablesMonthly_package($month,"25",$year) / 1000) );
	$serie2->addPoint(new Point("$month 24",$ro->getPHICReceivablesMonthly_package($month,"24",$year) / 1000) );
	$serie2->addPoint(new Point("$month 23",$ro->getPHICReceivablesMonthly_package($month,"23",$year) / 1000) );
	$serie2->addPoint(new Point("$month 22",$ro->getPHICReceivablesMonthly_package($month,"22",$year) / 1000) );
	$serie2->addPoint(new Point("$month 21",$ro->getPHICReceivablesMonthly_package($month,"21",$year) / 1000) );
	$serie2->addPoint(new Point("$month 20",$ro->getPHICReceivablesMonthly_package($month,"20",$year) / 1000) );
	$serie2->addPoint(new Point("$month 19",$ro->getPHICReceivablesMonthly_package($month,"19",$year) / 1000) );
	$serie2->addPoint(new Point("$month 18",$ro->getPHICReceivablesMonthly_package($month,"18",$year) / 1000) );
	$serie2->addPoint(new Point("$month 17",$ro->getPHICReceivablesMonthly_package($month,"17",$year) / 1000) );
	$serie2->addPoint(new Point("$month 16",$ro->getPHICReceivablesMonthly_package($month,"16",$year) / 1000) );
	$serie2->addPoint(new Point("$month 15",$ro->getPHICReceivablesMonthly_package($month,"15",$year) / 1000) );
	$serie2->addPoint(new Point("$month 14",$ro->getPHICReceivablesMonthly_package($month,"14",$year) / 1000) );
	$serie2->addPoint(new Point("$month 13",$ro->getPHICReceivablesMonthly_package($month,"13",$year) / 1000) );
	$serie2->addPoint(new Point("$month 12",$ro->getPHICReceivablesMonthly_package($month,"12",$year) / 1000) );
	$serie2->addPoint(new Point("$month 11",$ro->getPHICReceivablesMonthly_package($month,"11",$year) / 1000) );
	$serie2->addPoint(new Point("$month 10",$ro->getPHICReceivablesMonthly_package($month,"10",$year) / 1000) );
	$serie2->addPoint(new Point("$month 09",$ro->getPHICReceivablesMonthly_package($month,"09",$year) / 1000) );
	$serie2->addPoint(new Point("$month 08",$ro->getPHICReceivablesMonthly_package($month,"08",$year) / 1000) );
	$serie2->addPoint(new Point("$month 07",$ro->getPHICReceivablesMonthly_package($month,"07",$year) / 1000) );
	$serie2->addPoint(new Point("$month 06",$ro->getPHICReceivablesMonthly_package($month,"06",$year) / 1000) );
	$serie2->addPoint(new Point("$month 05",$ro->getPHICReceivablesMonthly_package($month,"05",$year) / 1000) );
	$serie2->addPoint(new Point("$month 04",$ro->getPHICReceivablesMonthly_package($month,"04",$year) / 1000) );
	$serie2->addPoint(new Point("$month 03",$ro->getPHICReceivablesMonthly_package($month,"03",$year) / 1000) );
	$serie2->addPoint(new Point("$month 02",$ro->getPHICReceivablesMonthly_package($month,"02",$year) / 1000) );
	$serie2->addPoint(new Point("$month 01",$ro->getPHICReceivablesMonthly_package($month,"01",$year) / 1000) );





$nonPackage = ( $ro->getPHICReceivablesMonthly($month,"01",$year) + $ro->getPHICReceivablesMonthly($month,"02",$year) + $ro->getPHICReceivablesMonthly($month,"03",$year) + $ro->getPHICReceivablesMonthly($month,"04",$year) + $ro->getPHICReceivablesMonthly($month,"05",$year) + $ro->getPHICReceivablesMonthly($month,"06",$year) + $ro->getPHICReceivablesMonthly($month,"07",$year) + $ro->getPHICReceivablesMonthly($month,"08",$year) + $ro->getPHICReceivablesMonthly($month,"09",$year) + $ro->getPHICReceivablesMonthly($month,"10",$year) + $ro->getPHICReceivablesMonthly($month,"11",$year) + $ro->getPHICReceivablesMonthly($month,"12",$year) + $ro->getPHICReceivablesMonthly($month,"13",$year) + $ro->getPHICReceivablesMonthly($month,"14",$year) + $ro->getPHICReceivablesMonthly($month,"15",$year) + $ro->getPHICReceivablesMonthly($month,"16",$year) + $ro->getPHICReceivablesMonthly($month,"17",$year) + $ro->getPHICReceivablesMonthly($month,"18",$year) + $ro->getPHICReceivablesMonthly($month,"19",$year) + $ro->getPHICReceivablesMonthly($month,"20",$year) + $ro->getPHICReceivablesMonthly($month,"21",$year) + $ro->getPHICReceivablesMonthly($month,"22",$year) + $ro->getPHICReceivablesMonthly($month,"23",$year) + $ro->getPHICReceivablesMonthly($month,"24",$year) + $ro->getPHICReceivablesMonthly($month,"25",$year) + $ro->getPHICReceivablesMonthly($month,"26",$year) + $ro->getPHICReceivablesMonthly($month,"27",$year) + $ro->getPHICReceivablesMonthly($month,"28",$year) + $ro->getPHICReceivablesMonthly($month,"29",$year) + $ro->getPHICReceivablesMonthly($month,"30",$year) + $ro->getPHICReceivablesMonthly($month,"31",$year) );


$package = ( $ro->getPHICReceivablesMonthly_package($month,"01",$year) + $ro->getPHICReceivablesMonthly_package($month,"02",$year) + $ro->getPHICReceivablesMonthly_package($month,"03",$year) + $ro->getPHICReceivablesMonthly_package($month,"04",$year) + $ro->getPHICReceivablesMonthly_package($month,"05",$year) + $ro->getPHICReceivablesMonthly_package($month,"06",$year) + $ro->getPHICReceivablesMonthly_package($month,"07",$year) + $ro->getPHICReceivablesMonthly_package($month,"08",$year) + $ro->getPHICReceivablesMonthly_package($month,"09",$year) + $ro->getPHICReceivablesMonthly_package($month,"10",$year) + $ro->getPHICReceivablesMonthly_package($month,"11",$year) + $ro->getPHICReceivablesMonthly_package($month,"12",$year) + $ro->getPHICReceivablesMonthly_package($month,"13",$year) + $ro->getPHICReceivablesMonthly_package($month,"14",$year) + $ro->getPHICReceivablesMonthly_package($month,"15",$year) + $ro->getPHICReceivablesMonthly_package($month,"16",$year) + $ro->getPHICReceivablesMonthly_package($month,"17",$year) + $ro->getPHICReceivablesMonthly_package($month,"18",$year) + $ro->getPHICReceivablesMonthly_package($month,"19",$year) + $ro->getPHICReceivablesMonthly_package($month,"20",$year) + $ro->getPHICReceivablesMonthly_package($month,"21",$year) + $ro->getPHICReceivablesMonthly_package($month,"22",$year) + $ro->getPHICReceivablesMonthly_package($month,"23",$year) + $ro->getPHICReceivablesMonthly_package($month,"24",$year) + $ro->getPHICReceivablesMonthly_package($month,"25",$year) + $ro->getPHICReceivablesMonthly_package($month,"26",$year) + $ro->getPHICReceivablesMonthly_package($month,"27",$year) + $ro->getPHICReceivablesMonthly_package($month,"28",$year) + $ro->getPHICReceivablesMonthly_package($month,"29",$year) + $ro->getPHICReceivablesMonthly_package($month,"30",$year) + $ro->getPHICReceivablesMonthly_package($month,"31",$year) );



	$dataSet = new XYSeriesDataSet();
	$dataSet->addSerie("PhilHealth Non-Package (".number_format($nonPackage,2).")", $serie1);
	$dataSet->addSerie("PhilHealth Package (".number_format($package,2).")", $serie2);
	$chart->setDataSet($dataSet);

	$chart->setTitle("PhilHealth Receivables for $month $year");
	$chart->render("../../../COCONUT/graphicalReport/chartList/phicReceivables.png");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Libchart line demonstration</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Line chart" src="/COCONUT/graphicalReport/chartList/phicReceivables.png" style="border: 1px solid gray;"/>
</body>
</html>
