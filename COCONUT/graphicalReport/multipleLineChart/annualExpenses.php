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
	$serie1->addPoint(new Point("Jan $year",$ro->getAnnualExpenses("01",$year) ));
	$serie1->addPoint(new Point("Feb $year",$ro->getAnnualExpenses("02",$year) ));
	$serie1->addPoint(new Point("Mar $year",$ro->getAnnualExpenses("03",$year) ));
	$serie1->addPoint(new Point("Apr $year",$ro->getAnnualExpenses("04",$year) ));
	$serie1->addPoint(new Point("May $year",$ro->getAnnualExpenses("05",$year) ));
	$serie1->addPoint(new Point("Jun $year",$ro->getAnnualExpenses("06",$year) ));
	$serie1->addPoint(new Point("Jul $year",$ro->getAnnualExpenses("07",$year) ));
	$serie1->addPoint(new Point("Aug $year",$ro->getAnnualExpenses("08",$year) ));
	$serie1->addPoint(new Point("Sep $year",$ro->getAnnualExpenses("09",$year) ));
	$serie1->addPoint(new Point("Oct $year",$ro->getAnnualExpenses("10",$year) ));
	$serie1->addPoint(new Point("Nov $year",$ro->getAnnualExpenses("11",$year) ));
	$serie1->addPoint(new Point("Dec $year",$ro->getAnnualExpenses("12",$year) ));
	
		
	$dataSet = new XYSeriesDataSet();
	$dataSet->addSerie("Expenses", $serie1);

	$chart->setDataSet($dataSet);

	$chart->setTitle("Expenses for $year");
	$chart->getPlot()->setGraphCaptionRatio(0.62);
	$chart->render("../../../COCONUT/graphicalReport/chartList/annualExpenses.png");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Libchart line demonstration</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Line chart" src="/COCONUT/graphicalReport/chartList/annualExpenses.png" style="border: 1px solid gray;"/>
</body>
</html>
