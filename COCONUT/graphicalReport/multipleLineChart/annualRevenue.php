<?php
include("../../../myDatabase1.php");
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
	 * Multiple line chart demonstration.
	 *
	 */

	include "../../../COCONUT/libchart/libchart/classes/libchart.php";

	$chart = new revenueLineChart("1500","500");
	$ro = new database1();
	$serie1 = new XYDataSet();
	$serie1->addPoint(new Point("Jan $year",$ro->getAnnualRevenue_opd("01",$year) ));
	$serie1->addPoint(new Point("Feb $year",$ro->getAnnualRevenue_opd("02",$year) ));
	$serie1->addPoint(new Point("Mar $year",$ro->getAnnualRevenue_opd("03",$year) ));
	$serie1->addPoint(new Point("Apr $year",$ro->getAnnualRevenue_opd("04",$year) ));
	$serie1->addPoint(new Point("May $year",$ro->getAnnualRevenue_opd("05",$year) ));
	$serie1->addPoint(new Point("Jun $year",$ro->getAnnualRevenue_opd("06",$year) ));
	$serie1->addPoint(new Point("Jul $year",$ro->getAnnualRevenue_opd("07",$year) ));
	$serie1->addPoint(new Point("Aug $year",$ro->getAnnualRevenue_opd("08",$year) ));
	$serie1->addPoint(new Point("Sep $year",$ro->getAnnualRevenue_opd("09",$year) ));
	$serie1->addPoint(new Point("Oct $year",$ro->getAnnualRevenue_opd("10",$year) ));
	$serie1->addPoint(new Point("Nov $year",$ro->getAnnualRevenue_opd("11",$year) ));
	$serie1->addPoint(new Point("Dec $year",$ro->getAnnualRevenue_opd("12",$year) ));
	
	$serie2 = new XYDataSet();
	$serie2->addPoint(new Point("Jan $year",$ro->getAnnualRevenue_ipd("01",$year) ));
	$serie2->addPoint(new Point("Feb $year",$ro->getAnnualRevenue_ipd("02",$year)  ));
	$serie2->addPoint(new Point("Mar $year",$ro->getAnnualRevenue_ipd("03",$year) ));
	$serie2->addPoint(new Point("Apr $year",$ro->getAnnualRevenue_ipd("04",$year) ));
	$serie2->addPoint(new Point("May $year",$ro->getAnnualRevenue_ipd("05",$year) ));
	$serie2->addPoint(new Point("Jun $year",$ro->getAnnualRevenue_ipd("06",$year) ));
	$serie2->addPoint(new Point("Jul $year",$ro->getAnnualRevenue_ipd("07",$year) ));
	$serie2->addPoint(new Point("Aug $year",$ro->getAnnualRevenue_ipd("08",$year) ));
	$serie2->addPoint(new Point("Sep $year",$ro->getAnnualRevenue_ipd("09",$year) ));
	$serie2->addPoint(new Point("Oct $year",$ro->getAnnualRevenue_ipd("10",$year) ));
	$serie2->addPoint(new Point("Nov $year",$ro->getAnnualRevenue_ipd("11",$year) ));
	$serie2->addPoint(new Point("Dec $year",$ro->getAnnualRevenue_ipd("12",$year) ));
	
	
	$dataSet = new XYSeriesDataSet();
	$dataSet->addSerie("OPD", $serie1);
	$dataSet->addSerie("IPD", $serie2);

	$chart->setDataSet($dataSet);

	$chart->setTitle("Collection for $year");
	$chart->getPlot()->setGraphCaptionRatio(0.62);
	$chart->render("../../../COCONUT/graphicalReport/chartList/monthlyRegistrationBreakdown.png");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Libchart line demonstration</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Line chart" src="/COCONUT/graphicalReport/chartList/monthlyRegistrationBreakdown.png" style="border: 1px solid gray;"/>
</body>
</html>
