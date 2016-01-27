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

	$chart = new LineChart("1500","500");
	$ro = new database1();
	$serie1 = new XYDataSet();
	$serie1->addPoint(new Point("Jan $year",$ro->getAnnualSenior("01",$year,"IPD") ));
	$serie1->addPoint(new Point("Feb $year",$ro->getAnnualSenior("02",$year,"IPD") ));
	$serie1->addPoint(new Point("Mar $year",$ro->getAnnualSenior("03",$year,"IPD") ));
	$serie1->addPoint(new Point("Apr $year",$ro->getAnnualSenior("04",$year,"IPD") ));
	$serie1->addPoint(new Point("May $year",$ro->getAnnualSenior("05",$year,"IPD") ));
	$serie1->addPoint(new Point("Jun $year",$ro->getAnnualSenior("06",$year,"IPD") ));
	$serie1->addPoint(new Point("Jul $year",$ro->getAnnualSenior("07",$year,"IPD") ));
	$serie1->addPoint(new Point("Aug $year",$ro->getAnnualSenior("08",$year,"IPD") ));
	$serie1->addPoint(new Point("Sep $year",$ro->getAnnualSenior("09",$year,"IPD") ));
	$serie1->addPoint(new Point("Oct $year",$ro->getAnnualSenior("10",$year,"IPD") ));
	$serie1->addPoint(new Point("Nov $year",$ro->getAnnualSenior("11",$year,"IPD") ));
	$serie1->addPoint(new Point("Dec $year",$ro->getAnnualSenior("12",$year,"IPD") ));
	
	
	$serie2 = new XYDataSet();
	$serie2->addPoint(new Point("Jan $year",$ro->getAnnualSenior("01",$year,"OPD") ));
	$serie2->addPoint(new Point("Feb $year",$ro->getAnnualSenior("02",$year,"OPD") ));
	$serie2->addPoint(new Point("Mar $year",$ro->getAnnualSenior("03",$year,"OPD") ));
	$serie2->addPoint(new Point("Apr $year",$ro->getAnnualSenior("04",$year,"OPD") ));
	$serie2->addPoint(new Point("May $year",$ro->getAnnualSenior("05",$year,"OPD") ));
	$serie2->addPoint(new Point("Jun $year",$ro->getAnnualSenior("06",$year,"OPD") ));
	$serie2->addPoint(new Point("Jul $year",$ro->getAnnualSenior("07",$year,"OPD") ));
	$serie2->addPoint(new Point("Aug $year",$ro->getAnnualSenior("08",$year,"OPD") ));
	$serie2->addPoint(new Point("Sep $year",$ro->getAnnualSenior("09",$year,"OPD") ));
	$serie2->addPoint(new Point("Oct $year",$ro->getAnnualSenior("10",$year,"OPD") ));
	$serie2->addPoint(new Point("Nov $year",$ro->getAnnualSenior("11",$year,"OPD") ));
	$serie2->addPoint(new Point("Dec $year",$ro->getAnnualSenior("12",$year,"OPD") ));


	
	$dataSet = new XYSeriesDataSet();
	$dataSet->addSerie("IPD", $serie1);
	$dataSet->addSerie("OPD", $serie2);
	$chart->setDataSet($dataSet);

	$chart->setTitle("Senior Census for $year");
	$chart->getPlot()->setGraphCaptionRatio(0.62);
	$chart->render("../../../COCONUT/graphicalReport/chartList/annualSenior.png");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Senior Census for <?php echo $year; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Line chart" src="/COCONUT/graphicalReport/chartList/annualSenior.png" style="border: 1px solid gray;"/>
</body>
</html>
