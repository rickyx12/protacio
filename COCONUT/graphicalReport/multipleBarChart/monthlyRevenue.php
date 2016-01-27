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

	$chart = new VerticalBarChart(8000,600);
	$ro = new database1();	

	$serie1 = new XYDataSet();
	$serie1->addPoint(new Point("$month 1, $year",  number_format($ro->getPxRevenueDaily_opd($month,"01",$year),2)  ));
	$serie1->addPoint(new Point("$month 2, $year ", number_format($ro->getPxRevenueDaily_opd($month,"02",$year),2)  ));
	$serie1->addPoint(new Point("$month 3, $year ", number_format($ro->getPxRevenueDaily_opd($month,"03",$year),2)  ));
	$serie1->addPoint(new Point("$month 4, $year ", number_format($ro->getPxRevenueDaily_opd($month,"04",$year),2)  ));
	$serie1->addPoint(new Point("$month 5, $year ", number_format($ro->getPxRevenueDaily_opd($month,"05",$year),2)  ));
	$serie1->addPoint(new Point("$month 6, $year ", number_format($ro->getPxRevenueDaily_opd($month,"06",$year),2)  ));
	$serie1->addPoint(new Point("$month 7, $year ", number_format($ro->getPxRevenueDaily_opd($month,"07",$year),2)  ));
	$serie1->addPoint(new Point("$month 8, $year ", number_format($ro->getPxRevenueDaily_opd($month,"08",$year),2)  ));
	$serie1->addPoint(new Point("$month 9, $year ", number_format($ro->getPxRevenueDaily_opd($month,"09",$year),2)  ));
	$serie1->addPoint(new Point("$month 10, $year ",number_format($ro->getPxRevenueDaily_opd($month,"10",$year),2)  ));
	$serie1->addPoint(new Point("$month 11, $year ",number_format($ro->getPxRevenueDaily_opd($month,"11",$year),2) ));
	$serie1->addPoint(new Point("$month 12, $year ",number_format($ro->getPxRevenueDaily_opd($month,"12",$year),2) ));
	$serie1->addPoint(new Point("$month 13, $year ",number_format($ro->getPxRevenueDaily_opd($month,"13",$year),2)  ));
	$serie1->addPoint(new Point("$month 14, $year ",number_format($ro->getPxRevenueDaily_opd($month,"14",$year),2) ));
	$serie1->addPoint(new Point("$month 15, $year ",number_format($ro->getPxRevenueDaily_opd($month,"15",$year),2) ));
	$serie1->addPoint(new Point("$month 16, $year ",number_format($ro->getPxRevenueDaily_opd($month,"16",$year),2) ));
	$serie1->addPoint(new Point("$month 17, $year ",number_format($ro->getPxRevenueDaily_opd($month,"17",$year),2) ));
	$serie1->addPoint(new Point("$month 18, $year ",number_format($ro->getPxRevenueDaily_opd($month,"18",$year),2)  ));
	$serie1->addPoint(new Point("$month 19, $year ",number_format($ro->getPxRevenueDaily_opd($month,"19",$year),2) ));
	$serie1->addPoint(new Point("$month 20, $year ",number_format($ro->getPxRevenueDaily_opd($month,"20",$year),2) ));
	$serie1->addPoint(new Point("$month 21, $year ",number_format($ro->getPxRevenueDaily_opd($month,"21",$year),2)  ));
	$serie1->addPoint(new Point("$month 22, $year ",number_format($ro->getPxRevenueDaily_opd($month,"22",$year),2) ));
	$serie1->addPoint(new Point("$month 23, $year ",number_format($ro->getPxRevenueDaily_opd($month,"23",$year),2)  ));
	$serie1->addPoint(new Point("$month 24, $year ",number_format($ro->getPxRevenueDaily_opd($month,"24",$year),2) ));
	$serie1->addPoint(new Point("$month 25, $year ",number_format($ro->getPxRevenueDaily_opd($month,"25",$year),2) ));
	$serie1->addPoint(new Point("$month 26, $year ",number_format($ro->getPxRevenueDaily_opd($month,"26",$year),2) ));
	$serie1->addPoint(new Point("$month 27, $year ",number_format($ro->getPxRevenueDaily_opd($month,"27",$year),2) ));
	$serie1->addPoint(new Point("$month 28, $year ",number_format($ro->getPxRevenueDaily_opd($month,"28",$year),2)  ));
	$serie1->addPoint(new Point("$month 29, $year ",number_format($ro->getPxRevenueDaily_opd($month,"29",$year),2) ));
	$serie1->addPoint(new Point("$month 30, $year ",number_format($ro->getPxRevenueDaily_opd($month,"30",$year),2) ));
	$serie1->addPoint(new Point("$month 31, $year ",number_format($ro->getPxRevenueDaily_opd($month,"31",$year),2) ));
	
	$serie2 = new XYDataSet();
	$serie2->addPoint(new Point("$month 1, $year", number_format($ro->getPxRevenueDaily_ipd($month,"01",$year),2)  ));
	$serie2->addPoint(new Point("$month 2, $year", number_format($ro->getPxRevenueDaily_ipd($month,"02",$year),2)  ));
	$serie2->addPoint(new Point("$month 3, $year ",number_format($ro->getPxRevenueDaily_ipd($month,"03",$year),2)  ));
	$serie2->addPoint(new Point("$month 4, $year ",number_format($ro->getPxRevenueDaily_ipd($month,"04",$year),2)  ));
	$serie2->addPoint(new Point("$month 5, $year", number_format($ro->getPxRevenueDaily_ipd($month,"05",$year),2)  ));
	$serie2->addPoint(new Point("$month 6, $year", number_format($ro->getPxRevenueDaily_ipd($month,"06",$year),2)  ));
	$serie2->addPoint(new Point("$month 7, $year", number_format($ro->getPxRevenueDaily_ipd($month,"07",$year),2)  ));	
	$serie2->addPoint(new Point("$month 8, $year", number_format($ro->getPxRevenueDaily_ipd($month,"08",$year),2) ));	
	$serie2->addPoint(new Point("$month 9, $year", number_format($ro->getPxRevenueDaily_ipd($month,"09",$year),2) ));	
	$serie2->addPoint(new Point("$month 10, $year",number_format($ro->getPxRevenueDaily_ipd($month,"10",$year),2)  ));	
	$serie2->addPoint(new Point("$month 11, $year",number_format($ro->getPxRevenueDaily_ipd($month,"11",$year),2) ));	
	$serie2->addPoint(new Point("$month 12, $year",number_format($ro->getPxRevenueDaily_ipd($month,"12",$year),2) ));	
	$serie2->addPoint(new Point("$month 13, $year",number_format($ro->getPxRevenueDaily_ipd($month,"13",$year),2) ));	
	$serie2->addPoint(new Point("$month 14, $year",number_format($ro->getPxRevenueDaily_ipd($month,"14",$year),2) ));	
	$serie2->addPoint(new Point("$month 15, $year",number_format($ro->getPxRevenueDaily_ipd($month,"15",$year),2) ));	
	$serie2->addPoint(new Point("$month 16, $year",number_format($ro->getPxRevenueDaily_ipd($month,"16",$year),2) ));	
	$serie2->addPoint(new Point("$month 17, $year",number_format($ro->getPxRevenueDaily_ipd($month,"17",$year),2) ));	
	$serie2->addPoint(new Point("$month 18, $year",number_format($ro->getPxRevenueDaily_ipd($month,"18",$year),2) ));	
	$serie2->addPoint(new Point("$month 19, $year",number_format($ro->getPxRevenueDaily_ipd($month,"19",$year),2) ));
	$serie2->addPoint(new Point("$month 20, $year",number_format($ro->getPxRevenueDaily_ipd($month,"20",$year),2) ));		
	$serie2->addPoint(new Point("$month 21, $year",number_format($ro->getPxRevenueDaily_ipd($month,"21",$year),2) ));	
	$serie2->addPoint(new Point("$month 22, $year",number_format($ro->getPxRevenueDaily_ipd($month,"22",$year),2) ));	
	$serie2->addPoint(new Point("$month 23, $year",number_format($ro->getPxRevenueDaily_ipd($month,"23",$year),2) ));	
	$serie2->addPoint(new Point("$month 24, $year",number_format($ro->getPxRevenueDaily_ipd($month,"24",$year),2) ));	
	$serie2->addPoint(new Point("$month 25, $year",number_format($ro->getPxRevenueDaily_ipd($month,"25",$year),2) ));	
	$serie2->addPoint(new Point("$month 26, $year",number_format($ro->getPxRevenueDaily_ipd($month,"26",$year),2) ));	
	$serie2->addPoint(new Point("$month 27, $year",number_format($ro->getPxRevenueDaily_ipd($month,"27",$year),2) ));	
	$serie2->addPoint(new Point("$month 28, $year",number_format($ro->getPxRevenueDaily_ipd($month,"28",$year),2) ));	
	$serie2->addPoint(new Point("$month 29, $year",number_format($ro->getPxRevenueDaily_ipd($month,"29",$year),2) ));	
	$serie2->addPoint(new Point("$month 30, $year",number_format($ro->getPxRevenueDaily_ipd($month,"30",$year),2) ));	
	$serie2->addPoint(new Point("$month 31, $year",number_format($ro->getPxRevenueDaily_ipd($month,"31",$year),2) ));	

	$dataSet = new XYSeriesDataSet();
	$dataSet->addSerie("OPD", $serie1);
	$dataSet->addSerie("IPD", $serie2);
	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphCaptionRatio(0.35);

	$chart->setTitle("Registration Census for $month $year");
	$chart->render("../../../COCONUT/graphicalReport/chartList/monthlyRegistration.png");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Registration Census for <?php echo $month; echo $year ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Line chart" src="/COCONUT/graphicalReport/chartList/monthlyRegistration.png" style="border: 1px solid gray;"/>
</body>
</html>
