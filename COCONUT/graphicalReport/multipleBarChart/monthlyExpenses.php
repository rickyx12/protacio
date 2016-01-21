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

	$chart = new revenueBarChart(4000,1500);
	$ro = new database1();	

	$serie1 = new XYDataSet();
	$serie1->addPoint(new Point("$month 31", number_format($ro->getMonthlyExpenses($month,"31",$year),2)  ));
	$serie1->addPoint(new Point("$month 30", number_format($ro->getMonthlyExpenses($month,"30",$year),2)  ));
	$serie1->addPoint(new Point("$month 29", number_format($ro->getMonthlyExpenses($month,"29",$year),2)  ));
	$serie1->addPoint(new Point("$month 28", number_format($ro->getMonthlyExpenses($month,"28",$year),2)  ));
	$serie1->addPoint(new Point("$month 27", number_format($ro->getMonthlyExpenses($month,"27",$year),2)  ));
	$serie1->addPoint(new Point("$month 26", number_format($ro->getMonthlyExpenses($month,"26",$year),2)  ));
	$serie1->addPoint(new Point("$month 25", number_format($ro->getMonthlyExpenses($month,"25",$year),2)  ));
	$serie1->addPoint(new Point("$month 24", number_format($ro->getMonthlyExpenses($month,"24",$year),2)  ));
	$serie1->addPoint(new Point("$month 23", number_format($ro->getMonthlyExpenses($month,"23",$year),2)  ));
	$serie1->addPoint(new Point("$month 22",number_format($ro->getMonthlyExpenses($month,"22",$year),2)  ));
	$serie1->addPoint(new Point("$month 21",number_format($ro->getMonthlyExpenses($month,"21",$year),2) ));
	$serie1->addPoint(new Point("$month 20",number_format($ro->getMonthlyExpenses($month,"20",$year),2) ));
	$serie1->addPoint(new Point("$month 19",number_format($ro->getMonthlyExpenses($month,"19",$year),2)  ));
	$serie1->addPoint(new Point("$month 18",number_format($ro->getMonthlyExpenses($month,"18",$year),2) ));
	$serie1->addPoint(new Point("$month 17",number_format($ro->getMonthlyExpenses($month,"17",$year),2) ));
	$serie1->addPoint(new Point("$month 16",number_format($ro->getMonthlyExpenses($month,"16",$year),2) ));
	$serie1->addPoint(new Point("$month 15",number_format($ro->getMonthlyExpenses($month,"15",$year),2) ));
	$serie1->addPoint(new Point("$month 14",number_format($ro->getMonthlyExpenses($month,"14",$year),2)  ));
	$serie1->addPoint(new Point("$month 13",number_format($ro->getMonthlyExpenses($month,"13",$year),2) ));
	$serie1->addPoint(new Point("$month 12",number_format($ro->getMonthlyExpenses($month,"12",$year),2) ));
	$serie1->addPoint(new Point("$month 11",number_format($ro->getMonthlyExpenses($month,"11",$year),2)  ));
	$serie1->addPoint(new Point("$month 10",number_format($ro->getMonthlyExpenses($month,"10",$year),2) ));
	$serie1->addPoint(new Point("$month 09",number_format($ro->getMonthlyExpenses($month,"09",$year),2)  ));
	$serie1->addPoint(new Point("$month 08",number_format($ro->getMonthlyExpenses($month,"08",$year),2) ));
	$serie1->addPoint(new Point("$month 07",number_format($ro->getMonthlyExpenses($month,"07",$year),2) ));
	$serie1->addPoint(new Point("$month 06",number_format($ro->getMonthlyExpenses($month,"06",$year),2) ));
	$serie1->addPoint(new Point("$month 05",number_format($ro->getMonthlyExpenses($month,"05",$year),2) ));
	$serie1->addPoint(new Point("$month 04",number_format($ro->getMonthlyExpenses($month,"04",$year),2)  ));
	$serie1->addPoint(new Point("$month 03",number_format($ro->getMonthlyExpenses($month,"03",$year),2) ));
	$serie1->addPoint(new Point("$month 02",number_format($ro->getMonthlyExpenses($month,"02",$year),2) ));
	$serie1->addPoint(new Point("$month 01",number_format($ro->getMonthlyExpenses($month,"01",$year),2) ));
	

$totalExpenses = ( $ro->getMonthlyExpenses($month,"01",$year)*1000 + $ro->getMonthlyExpenses($month,"02",$year)*1000 + $ro->getMonthlyExpenses($month,"03",$year)*1000 + $ro->getMonthlyExpenses($month,"04",$year)*1000 + $ro->getMonthlyExpenses($month,"05",$year)*1000 + $ro->getMonthlyExpenses($month,"06",$year)*1000 + $ro->getMonthlyExpenses($month,"07",$year)*1000 + $ro->getMonthlyExpenses($month,"08",$year)*1000 + $ro->getMonthlyExpenses($month,"09",$year)*1000 + $ro->getMonthlyExpenses($month,"10",$year)*1000 + $ro->getMonthlyExpenses($month,"11",$year)*1000 + $ro->getMonthlyExpenses($month,"12",$year)*1000 + $ro->getMonthlyExpenses($month,"13",$year)*1000 + $ro->getMonthlyExpenses($month,"14",$year)*1000 + $ro->getMonthlyExpenses($month,"15",$year)*1000 + $ro->getMonthlyExpenses($month,"16",$year)*1000 + $ro->getMonthlyExpenses($month,"17",$year)*1000 + $ro->getMonthlyExpenses($month,"18",$year)*1000 + $ro->getMonthlyExpenses($month,"19",$year)*1000 + $ro->getMonthlyExpenses($month,"20",$year)*1000 + $ro->getMonthlyExpenses($month,"21",$year)*1000 + $ro->getMonthlyExpenses($month,"22",$year)*1000 + $ro->getMonthlyExpenses($month,"23",$year)*1000 + $ro->getMonthlyExpenses($month,"24",$year)*1000 + $ro->getMonthlyExpenses($month,"25",$year)*1000 + $ro->getMonthlyExpenses($month,"26",$year)*1000 + $ro->getMonthlyExpenses($month,"27",$year)*1000 + $ro->getMonthlyExpenses($month,"28",$year)*1000 + $ro->getMonthlyExpenses($month,"29",$year)*1000 + $ro->getMonthlyExpenses($month,"30",$year)*1000 + $ro->getMonthlyExpenses($month,"31",$year)*1000 );

	$dataSet = new XYSeriesDataSet();
	$dataSet->addSerie("Expenses (".number_format($totalExpenses,2).")", $serie1);
	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphCaptionRatio(0.35);

	$chart->setTitle("Expenses for $month $year");
	$chart->render("../../../COCONUT/graphicalReport/chartList/monthlyExpenses.png");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Registration Census for <?php echo $month; echo $year ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Line chart" src="/COCONUT/graphicalReport/chartList/monthlyExpenses.png" style="border: 1px solid gray;"/>
</body>
</html>
