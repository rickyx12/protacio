<?php
include("../../../myDatabase1.php");
$fromMonth = $_GET['fromMonth'];
$fromDay = $_GET['fromDay'];
$fromYear = $_GET['fromYear'];

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
	 * Pie chart demonstration
	 *
	 */

	include "../../../COCONUT/libchart/libchart/classes/libchart.php";

	$chart = new PieChart();
	$ro = new database1();
	$dataSet = new XYDataSet();
	$dataSet->addPoint(new Point("OPD (".number_format($ro->getPxRevenueDaily_opd($fromMonth,$fromDay,$fromYear),2).")",$ro->getPxRevenueDaily_opd($fromMonth,$fromDay,$fromYear) ));
	$dataSet->addPoint(new Point("IPD (".number_format($ro->getPxRevenueDaily_ipd($fromMonth,$fromDay,$fromYear),2).")",$ro->getPxRevenueDaily_ipd($fromMonth,$fromDay,$fromYear) ));
	$chart->setDataSet($dataSet);

	$chart->setTitle("Collection Report For $fromMonth $fromDay, $fromYear");
	$chart->render("../../../COCONUT/graphicalReport/chartList/dailyRevenue.png");




	$chart1 = new PieChart();
	$dataSet1 = new XYDataSet();
	
$dataSet1->addPoint(new Point("LABORATORY (".number_format($ro->getPxRevenueDaily_opd_dept($fromMonth,$fromDay,$fromYear,"LABORATORY"),2).")",$ro->getPxRevenueDaily_opd_dept($fromMonth,$fromDay,$fromYear,"LABORATORY") ));

$dataSet1->addPoint(new Point("RADIOLOGY (".number_format($ro->getPxRevenueDaily_opd_dept($fromMonth,$fromDay,$fromYear,"RADIOLOGY"),2).")",$ro->getPxRevenueDaily_opd_dept($fromMonth,$fromDay,$fromYear,"RADIOLOGY") ));

$dataSet1->addPoint(new Point("MEDICINE (".number_format($ro->getPxRevenueDaily_opd_dept($fromMonth,$fromDay,$fromYear,"MEDICINE"),2).")",$ro->getPxRevenueDaily_opd_dept($fromMonth,$fromDay,$fromYear,"MEDICINE") ));

$dataSet1->addPoint(new Point("SUPPLIES (".number_format($ro->getPxRevenueDaily_opd_dept($fromMonth,$fromDay,$fromYear,"SUPPLIES"),2).")",$ro->getPxRevenueDaily_opd_dept($fromMonth,$fromDay,$fromYear,"SUPPLIES") ));

$dataSet1->addPoint(new Point("NURSING FEE (".number_format($ro->getPxRevenueDaily_opd_dept($fromMonth,$fromDay,$fromYear,"NURSING-CHARGES"),2).")",$ro->getPxRevenueDaily_opd_dept($fromMonth,$fromDay,$fromYear,"NURSING-CHARGES") ));

$dataSet1->addPoint(new Point("MISCELLANEOUS (".number_format($ro->getPxRevenueDaily_opd_dept($fromMonth,$fromDay,$fromYear,"MISCELLANEOUS"),2).")",$ro->getPxRevenueDaily_opd_dept($fromMonth,$fromDay,$fromYear,"MISCELLANEOUS") ));

$dataSet1->addPoint(new Point("PROFESSIONAL FEE (".number_format($ro->getPxRevenueDaily_opd_dept($fromMonth,$fromDay,$fromYear,"PROFESSIONAL FEE"),2).")",$ro->getPxRevenueDaily_opd_dept($fromMonth,$fromDay,$fromYear,"PROFESSIONAL FEE") ));

$total = ( $ro->getPxRevenueDaily_opd_dept($fromMonth,$fromDay,$fromYear,"LABORATORY") + $ro->getPxRevenueDaily_opd_dept($fromMonth,$fromDay,$fromYear,"RADIOLOGY") + $ro->getPxRevenueDaily_opd_dept($fromMonth,$fromDay,$fromYear,"MEDICINE") + $ro->getPxRevenueDaily_opd_dept($fromMonth,$fromDay,$fromYear,"SUPPLIES") + $ro->getPxRevenueDaily_opd_dept($fromMonth,$fromDay,$fromYear,"NURSING-CHARGES") + $ro->getPxRevenueDaily_opd_dept($fromMonth,$fromDay,$fromYear,"MISCELLANEOUS") + $ro->getPxRevenueDaily_opd_dept($fromMonth,$fromDay,$fromYear,"PROFESSIONAL FEE") );


$dataSet1->addPoint(new Point("TOTAL (".number_format($total,2).")",""));



	$chart1->setDataSet($dataSet1);
	$chart1->setTitle("OPD Breakdown Collection Report For $fromMonth $fromDay, $fromYear ");
	$chart1->render("../../../COCONUT/graphicalReport/chartList/dailyRevenue1.png");







?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Pie chart"  src="/COCONUT/graphicalReport/chartList/dailyRevenue.png" style="border: 1px solid gray;"/>

<br><br><br>

<img alt="Pie chart"  src="/COCONUT/graphicalReport/chartList/dailyRevenue1.png" style="border: 1px solid gray;"/>

</body>
</html>
