<?php
include("../../../myDatabase1.php");
$month = $_POST['month'];
$year = $_POST['year'];
$description = $_POST['description'];

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


$serie1->addPoint(new Point("$month 31", number_format($ro->getBestSellingChart_ipd($month,"31",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 30", number_format($ro->getBestSellingChart_ipd($month,"30",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 29", number_format($ro->getBestSellingChart_ipd($month,"29",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 28", number_format($ro->getBestSellingChart_ipd($month,"28",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 27", number_format($ro->getBestSellingChart_ipd($month,"27",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 26", number_format($ro->getBestSellingChart_ipd($month,"26",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 25", number_format($ro->getBestSellingChart_ipd($month,"25",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 24", number_format($ro->getBestSellingChart_ipd($month,"24",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 23", number_format($ro->getBestSellingChart_ipd($month,"23",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 22", number_format($ro->getBestSellingChart_ipd($month,"22",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 21", number_format($ro->getBestSellingChart_ipd($month,"21",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 20", number_format($ro->getBestSellingChart_ipd($month,"20",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 19", number_format($ro->getBestSellingChart_ipd($month,"19",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 18", number_format($ro->getBestSellingChart_ipd($month,"18",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 17", number_format($ro->getBestSellingChart_ipd($month,"17",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 16", number_format($ro->getBestSellingChart_ipd($month,"16",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 15", number_format($ro->getBestSellingChart_ipd($month,"15",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 14", number_format($ro->getBestSellingChart_ipd($month,"14",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 13", number_format($ro->getBestSellingChart_ipd($month,"13",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 12", number_format($ro->getBestSellingChart_ipd($month,"12",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 11", number_format($ro->getBestSellingChart_ipd($month,"11",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 10", number_format($ro->getBestSellingChart_ipd($month,"10",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 9", number_format($ro->getBestSellingChart_ipd($month,"09",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 8", number_format($ro->getBestSellingChart_ipd($month,"08",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 7", number_format($ro->getBestSellingChart_ipd($month,"07",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 6", number_format($ro->getBestSellingChart_ipd($month,"06",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 5", number_format($ro->getBestSellingChart_ipd($month,"05",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 4", number_format($ro->getBestSellingChart_ipd($month,"04",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 3", number_format($ro->getBestSellingChart_ipd($month,"03",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 2", number_format($ro->getBestSellingChart_ipd($month,"02",$year,$description) / 1000,2)));
$serie1->addPoint(new Point("$month 1", number_format($ro->getBestSellingChart_ipd($month,"01",$year,$description) / 1000,2)));
 
	$dataSet = new XYSeriesDataSet();
	$dataSet->addSerie("$description ", $serie1);
	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphCaptionRatio(0.35);

	$chart->setTitle("$description for $month $year");
	$chart->render("../../../COCONUT/graphicalReport/chartList/sellingDetails_ipd.png");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Sales of <?php echo $description ?> for <?php echo $month; echo $year ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />

</head>
<body>
	<img alt="Line chart" src="/COCONUT/graphicalReport/chartList/sellingDetails_ipd.png" style="border: 1px solid gray;"/>
</body>
</html>
