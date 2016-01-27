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
	$dataSet->addPoint(new Point("IPD FEMALE (". $ro->getGenderDaily($fromMonth,$fromDay,$fromYear,"female","IPD").")", $ro->getGenderDaily($fromMonth,$fromDay,$fromYear,"female","IPD") ));
	$dataSet->addPoint(new Point("IPD MALE (".$ro->getGenderDaily($fromMonth,$fromDay,$fromYear,"male","IPD").")", $ro->getGenderDaily($fromMonth,$fromDay,$fromYear,"male","IPD") ));
	$dataSet->addPoint(new Point("OPD FEMALE (".$ro->getGenderDaily($fromMonth,$fromDay,$fromYear,"female","OPD").")", $ro->getGenderDaily($fromMonth,$fromDay,$fromYear,"female","OPD") ));
	$dataSet->addPoint(new Point("OPD MALE (".$ro->getGenderDaily($fromMonth,$fromDay,$fromYear,"male","OPD").")", $ro->getGenderDaily($fromMonth,$fromDay,$fromYear,"male","OPD") ));
	$chart->setDataSet($dataSet);

	$chart->setTitle("Gender Census $fromMonth $fromDay, $fromYear ");
	$chart->render("../../../COCONUT/graphicalReport/chartList/genderCensus.png");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Pie chart"  src="/COCONUT/graphicalReport/chartList/genderCensus.png" style="border: 1px solid gray;"/>
</body>
</html>
