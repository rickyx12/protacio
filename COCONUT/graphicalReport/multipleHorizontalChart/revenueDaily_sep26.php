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
	$serie1->addPoint(new Point("$month 31",($ro->getPxRevenueDaily_opd($month,"31",$year) / 1000) ));
	$serie1->addPoint(new Point("$month 30",($ro->getPxRevenueDaily_opd($month,"30",$year) / 1000)  ));
	$serie1->addPoint(new Point("$month 29",($ro->getPxRevenueDaily_opd($month,"29",$year) / 1000)  ));
	$serie1->addPoint(new Point("$month 28",($ro->getPxRevenueDaily_opd($month,"28",$year) / 1000)  ));
	$serie1->addPoint(new Point("$month 27",($ro->getPxRevenueDaily_opd($month,"27",$year) / 1000) ));	
	$serie1->addPoint(new Point("$month 26",($ro->getPxRevenueDaily_opd($month,"26",$year) / 1000)  ));	
	$serie1->addPoint(new Point("$month 25",($ro->getPxRevenueDaily_opd($month,"25",$year) / 1000)  ));	
	$serie1->addPoint(new Point("$month 24",($ro->getPxRevenueDaily_opd($month,"24",$year) / 1000)  ));
	$serie1->addPoint(new Point("$month 23",($ro->getPxRevenueDaily_opd($month,"23",$year) / 1000)  ));	
	$serie1->addPoint(new Point("$month 22",($ro->getPxRevenueDaily_opd($month,"22",$year) / 1000)  ));
	$serie1->addPoint(new Point("$month 21",($ro->getPxRevenueDaily_opd($month,"21",$year) / 1000)  ));
	$serie1->addPoint(new Point("$month 20",($ro->getPxRevenueDaily_opd($month,"20",$year) / 1000)  ));
	$serie1->addPoint(new Point("$month 19",($ro->getPxRevenueDaily_opd($month,"19",$year) / 1000)  ));
	$serie1->addPoint(new Point("$month 18",($ro->getPxRevenueDaily_opd($month,"18",$year) / 1000)  ));
	$serie1->addPoint(new Point("$month 17",($ro->getPxRevenueDaily_opd($month,"17",$year) / 1000)  ));
	$serie1->addPoint(new Point("$month 16",($ro->getPxRevenueDaily_opd($month,"16",$year) / 1000)  ));
	$serie1->addPoint(new Point("$month 15",($ro->getPxRevenueDaily_opd($month,"15",$year) / 1000)  ));
	$serie1->addPoint(new Point("$month 14",($ro->getPxRevenueDaily_opd($month,"14",$year) / 1000)  ));
	$serie1->addPoint(new Point("$month 13",($ro->getPxRevenueDaily_opd($month,"13",$year) / 1000)  ));
	$serie1->addPoint(new Point("$month 12",($ro->getPxRevenueDaily_opd($month,"12",$year) / 1000)  ));
	$serie1->addPoint(new Point("$month 11",($ro->getPxRevenueDaily_opd($month,"11",$year) / 1000)  ));
	$serie1->addPoint(new Point("$month 10",($ro->getPxRevenueDaily_opd($month,"10",$year) / 1000)  ));
	$serie1->addPoint(new Point("$month 09",($ro->getPxRevenueDaily_opd($month,"09",$year) / 1000)  ));
	$serie1->addPoint(new Point("$month 08",($ro->getPxRevenueDaily_opd($month,"08",$year) / 1000)  ));
	$serie1->addPoint(new Point("$month 07",($ro->getPxRevenueDaily_opd($month,"07",$year) / 1000)  ));
	$serie1->addPoint(new Point("$month 06",($ro->getPxRevenueDaily_opd($month,"06",$year) / 1000)  ));
	$serie1->addPoint(new Point("$month 05",($ro->getPxRevenueDaily_opd($month,"05",$year) / 1000)  ));
	$serie1->addPoint(new Point("$month 04",($ro->getPxRevenueDaily_opd($month,"04",$year) / 1000)  ));
	$serie1->addPoint(new Point("$month 03",($ro->getPxRevenueDaily_opd($month,"03",$year) / 1000)  ));
	$serie1->addPoint(new Point("$month 02",($ro->getPxRevenueDaily_opd($month,"02",$year) / 1000)  ));
	$serie1->addPoint(new Point("$month 01",($ro->getPxRevenueDaily_opd($month,"01",$year) / 1000)  ));

	$serie2 = new XYDataSet();
	$serie2->addPoint(new Point("$month 31 ",number_format($ro->getPxRevenueDaily_ipd($month,"31",$year) / 1000) ));
	$serie2->addPoint(new Point("$month 30 ",number_format($ro->getPxRevenueDaily_ipd($month,"30",$year) / 1000) ));
	$serie2->addPoint(new Point("$month 29 ",number_format($ro->getPxRevenueDaily_ipd($month,"29",$year) / 1000) ));
	$serie2->addPoint(new Point("$month 28 ",number_format($ro->getPxRevenueDaily_ipd($month,"28",$year) / 1000) ));	
	$serie2->addPoint(new Point("$month 27 ",number_format($ro->getPxRevenueDaily_ipd($month,"27",$year) / 1000) ));	
	$serie2->addPoint(new Point("$month 26 ",number_format($ro->getPxRevenueDaily_ipd($month,"26",$year) / 1000) ));	
	$serie2->addPoint(new Point("$month 25 ",number_format($ro->getPxRevenueDaily_ipd($month,"25",$year) / 1000) ));	
	$serie2->addPoint(new Point("$month 24 ",number_format($ro->getPxRevenueDaily_ipd($month,"24",$year) / 1000) ));	
	$serie2->addPoint(new Point("$month 23 ",($ro->getPxRevenueDaily_ipd($month,"23",$year) / 1000) ));
	$serie2->addPoint(new Point("$month 22 ",($ro->getPxRevenueDaily_ipd($month,"22",$year) / 1000) ));
	$serie2->addPoint(new Point("$month 21 ",($ro->getPxRevenueDaily_ipd($month,"21",$year) / 1000) ));
	$serie2->addPoint(new Point("$month 20 ",($ro->getPxRevenueDaily_ipd($month,"20",$year) / 1000) ));
	$serie2->addPoint(new Point("$month 19 ",($ro->getPxRevenueDaily_ipd($month,"19",$year) / 1000) ));
	$serie2->addPoint(new Point("$month 18 ",($ro->getPxRevenueDaily_ipd($month,"18",$year) / 1000) ));
	$serie2->addPoint(new Point("$month 17 ",($ro->getPxRevenueDaily_ipd($month,"17",$year) / 1000) ));
	$serie2->addPoint(new Point("$month 16 ",($ro->getPxRevenueDaily_ipd($month,"16",$year) / 1000) ));
	$serie2->addPoint(new Point("$month 15 ",($ro->getPxRevenueDaily_ipd($month,"15",$year) / 1000) ));
	$serie2->addPoint(new Point("$month 14 ",($ro->getPxRevenueDaily_ipd($month,"14",$year) / 1000) ));
	$serie2->addPoint(new Point("$month 13 ",($ro->getPxRevenueDaily_ipd($month,"13",$year) / 1000) ));
	$serie2->addPoint(new Point("$month 12 ",($ro->getPxRevenueDaily_ipd($month,"12",$year) / 1000) ));
	$serie2->addPoint(new Point("$month 11 ",($ro->getPxRevenueDaily_ipd($month,"11",$year) / 1000) ));
	$serie2->addPoint(new Point("$month 10 ",($ro->getPxRevenueDaily_ipd($month,"10",$year) / 1000) ));
	$serie2->addPoint(new Point("$month 09 ",($ro->getPxRevenueDaily_ipd($month,"09",$year) / 1000) ));
	$serie2->addPoint(new Point("$month 08 ",($ro->getPxRevenueDaily_ipd($month,"08",$year) / 1000) ));
	$serie2->addPoint(new Point("$month 07 ",($ro->getPxRevenueDaily_ipd($month,"07",$year) / 1000) ));
	$serie2->addPoint(new Point("$month 06 ",($ro->getPxRevenueDaily_ipd($month,"06",$year) / 1000) ));
	$serie2->addPoint(new Point("$month 05 ",($ro->getPxRevenueDaily_ipd($month,"05",$year) / 1000) ));
	$serie2->addPoint(new Point("$month 04 ",($ro->getPxRevenueDaily_ipd($month,"04",$year) / 1000) ));
	$serie2->addPoint(new Point("$month 03 ",($ro->getPxRevenueDaily_ipd($month,"03",$year) / 1000) ));
	$serie2->addPoint(new Point("$month 02 ",($ro->getPxRevenueDaily_ipd($month,"02",$year) / 1000) ));
	$serie2->addPoint(new Point("$month 01 ",($ro->getPxRevenueDaily_ipd($month,"01",$year) / 1000) ));

$totalOPD = ( $ro->getPxRevenueDaily_opd($month,"01",$year) + $ro->getPxRevenueDaily_opd($month,"02",$year) + $ro->getPxRevenueDaily_opd($month,"03",$year) + $ro->getPxRevenueDaily_opd($month,"04",$year) + $ro->getPxRevenueDaily_opd($month,"05",$year) + $ro->getPxRevenueDaily_opd($month,"06",$year) + $ro->getPxRevenueDaily_opd($month,"07",$year) + $ro->getPxRevenueDaily_opd($month,"08",$year) + $ro->getPxRevenueDaily_opd($month,"09",$year) + $ro->getPxRevenueDaily_opd($month,"10",$year) + $ro->getPxRevenueDaily_opd($month,"11",$year) + $ro->getPxRevenueDaily_opd($month,"12",$year) + $ro->getPxRevenueDaily_opd($month,"13",$year) + $ro->getPxRevenueDaily_opd($month,"14",$year) + $ro->getPxRevenueDaily_opd($month,"15",$year) + $ro->getPxRevenueDaily_opd($month,"16",$year) + $ro->getPxRevenueDaily_opd($month,"17",$year) + $ro->getPxRevenueDaily_opd($month,"18",$year) + $ro->getPxRevenueDaily_opd($month,"19",$year) + $ro->getPxRevenueDaily_opd($month,"20",$year) + $ro->getPxRevenueDaily_opd($month,"21",$year) + $ro->getPxRevenueDaily_opd($month,"22",$year) + $ro->getPxRevenueDaily_opd($month,"23",$year) + $ro->getPxRevenueDaily_opd($month,"24",$year) + $ro->getPxRevenueDaily_opd($month,"25",$year) + $ro->getPxRevenueDaily_opd($month,"26",$year) + $ro->getPxRevenueDaily_opd($month,"27",$year) + $ro->getPxRevenueDaily_opd($month,"28",$year) + $ro->getPxRevenueDaily_opd($month,"29",$year) + $ro->getPxRevenueDaily_opd($month,"30",$year) + $ro->getPxRevenueDaily_opd($month,"31",$year) );

$totalIPD = ( $ro->getPxRevenueDaily_ipd($month,"01",$year) + $ro->getPxRevenueDaily_ipd($month,"02",$year) + $ro->getPxRevenueDaily_ipd($month,"03",$year) + $ro->getPxRevenueDaily_ipd($month,"04",$year) + $ro->getPxRevenueDaily_ipd($month,"05",$year) + $ro->getPxRevenueDaily_ipd($month,"06",$year) + $ro->getPxRevenueDaily_ipd($month,"07",$year) + $ro->getPxRevenueDaily_ipd($month,"08",$year) + $ro->getPxRevenueDaily_ipd($month,"09",$year) + $ro->getPxRevenueDaily_ipd($month,"10",$year) + $ro->getPxRevenueDaily_ipd($month,"11",$year) + $ro->getPxRevenueDaily_ipd($month,"12",$year) + $ro->getPxRevenueDaily_ipd($month,"13",$year) + $ro->getPxRevenueDaily_ipd($month,"14",$year) + $ro->getPxRevenueDaily_ipd($month,"15",$year) + $ro->getPxRevenueDaily_ipd($month,"16",$year) + $ro->getPxRevenueDaily_ipd($month,"17",$year) + $ro->getPxRevenueDaily_ipd($month,"18",$year) + $ro->getPxRevenueDaily_ipd($month,"19",$year) + $ro->getPxRevenueDaily_ipd($month,"20",$year) + $ro->getPxRevenueDaily_ipd($month,"21",$year) + $ro->getPxRevenueDaily_ipd($month,"22",$year) + $ro->getPxRevenueDaily_ipd($month,"23",$year) + $ro->getPxRevenueDaily_ipd($month,"24",$year) + $ro->getPxRevenueDaily_ipd($month,"25",$year) + $ro->getPxRevenueDaily_ipd($month,"26",$year) + $ro->getPxRevenueDaily_ipd($month,"27",$year) + $ro->getPxRevenueDaily_ipd($month,"28",$year) + $ro->getPxRevenueDaily_ipd($month,"29",$year) + $ro->getPxRevenueDaily_ipd($month,"30",$year) + $ro->getPxRevenueDaily_ipd($month,"31",$year) );


	$dataSet = new XYSeriesDataSet();
	$dataSet->addSerie("OPD - ".number_format($totalOPD,2)."", $serie1);
	$dataSet->addSerie("IPD - ".number_format($totalIPD,2)."", $serie2);
	$chart->setDataSet($dataSet);

	$chart->setTitle("Revenue for $month $year");
	$chart->render("../../../COCONUT/graphicalReport/chartList/monthlyRev.png");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Libchart line demonstration</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Line chart" src="/COCONUT/graphicalReport/chartList/monthlyRev.png" style="border: 1px solid gray;"/>
</body>
</html>
