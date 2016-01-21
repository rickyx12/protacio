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
	$serie1->addPoint(new Point("Jan $year",$ro->getAnnualDiscount_ipd("Jan",$year) ));
	$serie1->addPoint(new Point("Feb $year",$ro->getAnnualDiscount_ipd("Feb",$year) ));
	$serie1->addPoint(new Point("Mar $year",$ro->getAnnualDiscount_ipd("Mar",$year) ));
	$serie1->addPoint(new Point("Apr $year",$ro->getAnnualDiscount_ipd("Apr",$year) ));
	$serie1->addPoint(new Point("May $year",$ro->getAnnualDiscount_ipd("May",$year) ));
	$serie1->addPoint(new Point("Jun $year",$ro->getAnnualDiscount_ipd("Jun",$year) ));
	$serie1->addPoint(new Point("Jul $year",$ro->getAnnualDiscount_ipd("Jul",$year) ));
	$serie1->addPoint(new Point("Aug $year",$ro->getAnnualDiscount_ipd("Aug",$year) ));
	$serie1->addPoint(new Point("Sep $year",$ro->getAnnualDiscount_ipd("Sep",$year) ));
	$serie1->addPoint(new Point("Oct $year",$ro->getAnnualDiscount_ipd("Oct",$year) ));
	$serie1->addPoint(new Point("Nov $year",$ro->getAnnualDiscount_ipd("Nov",$year) ));
	$serie1->addPoint(new Point("Dec $year",$ro->getAnnualDiscount_ipd("Dec",$year) ));
	
	
	$serie2 = new XYDataSet();
	$serie2->addPoint(new Point("Jan $year",$ro->getAnnualDiscount_opd("Jan",$year) ));
	$serie2->addPoint(new Point("Feb $year",$ro->getAnnualDiscount_opd("Feb",$year) ));
	$serie2->addPoint(new Point("Mar $year",$ro->getAnnualDiscount_opd("Mar",$year) ));
	$serie2->addPoint(new Point("Apr $year",$ro->getAnnualDiscount_opd("Apr",$year) ));
	$serie2->addPoint(new Point("May $year",$ro->getAnnualDiscount_opd("May",$year) ));
	$serie2->addPoint(new Point("Jun $year",$ro->getAnnualDiscount_opd("Jun",$year) ));
	$serie2->addPoint(new Point("Jul $year",$ro->getAnnualDiscount_opd("Jul",$year) ));
	$serie2->addPoint(new Point("Aug $year",$ro->getAnnualDiscount_opd("Aug",$year) ));
	$serie2->addPoint(new Point("Sep $year",$ro->getAnnualDiscount_opd("Sep",$year) ));
	$serie2->addPoint(new Point("Oct $year",$ro->getAnnualDiscount_opd("Oct",$year) ));
	$serie2->addPoint(new Point("Nov $year",$ro->getAnnualDiscount_opd("Nov",$year) ));
	$serie2->addPoint(new Point("Dec $year",$ro->getAnnualDiscount_opd("Dec",$year) ));


	
	$dataSet = new XYSeriesDataSet();
	$dataSet->addSerie("IPD", $serie1);
	$dataSet->addSerie("OPD", $serie2);
	$chart->setDataSet($dataSet);

	$chart->setTitle("Discount Given from $year");
	$chart->getPlot()->setGraphCaptionRatio(0.62);
	$chart->render("../../../COCONUT/graphicalReport/chartList/annualDiscount.png");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Discount Given from <?php echo $year; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Line chart" src="/COCONUT/graphicalReport/chartList/annualDiscount.png" style="border: 1px solid gray;"/>
</body>
</html>
