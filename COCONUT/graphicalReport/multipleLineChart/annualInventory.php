<?php
include("../../../myDatabase1.php");
$year = $_GET['year'];
$description = $_GET['description'];
$inventoryCode = $_GET['inventoryCode'];

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

	$chart = new LineChart("1200","500");
	$ro = new database1();
	$serie1 = new XYDataSet();
	$serie1->addPoint(new Point("Jan $year",$ro->getAnnualInventory("01",$year,$description,$inventoryCode,"IPD") / 1000 ));
	$serie1->addPoint(new Point("Feb $year",$ro->getAnnualInventory("02",$year,$description,$inventoryCode,"IPD") / 1000 ));
	$serie1->addPoint(new Point("Mar $year",$ro->getAnnualInventory("03",$year,$description,$inventoryCode,"IPD") / 1000 ));
	$serie1->addPoint(new Point("Apr $year",$ro->getAnnualInventory("04",$year,$description,$inventoryCode,"IPD") / 1000 ));
	$serie1->addPoint(new Point("May $year",$ro->getAnnualInventory("05",$year,$description,$inventoryCode,"IPD") / 1000 ));
	$serie1->addPoint(new Point("Jun $year",$ro->getAnnualInventory("06",$year,$description,$inventoryCode,"IPD") / 1000 ));
	$serie1->addPoint(new Point("Jul $year",$ro->getAnnualInventory("07",$year,$description,$inventoryCode,"IPD") / 1000 ));
	$serie1->addPoint(new Point("Aug $year",$ro->getAnnualInventory("08",$year,$description,$inventoryCode,"IPD") / 1000 ));
	$serie1->addPoint(new Point("Sep $year",$ro->getAnnualInventory("09",$year,$description,$inventoryCode,"IPD") / 1000 ));
	$serie1->addPoint(new Point("Oct $year",$ro->getAnnualInventory("10",$year,$description,$inventoryCode,"IPD") / 1000 ));
	$serie1->addPoint(new Point("Nov $year",$ro->getAnnualInventory("11",$year,$description,$inventoryCode,"IPD") / 1000 ));
	$serie1->addPoint(new Point("Dec $year",$ro->getAnnualInventory("12",$year,$description,$inventoryCode,"IPD") / 1000 ));
	
	
	$serie2 = new XYDataSet();
	$serie2->addPoint(new Point("Jan $year",$ro->getAnnualInventory("01",$year,$description,$inventoryCode,"OPD") ));
	$serie2->addPoint(new Point("Feb $year",$ro->getAnnualInventory("02",$year,$description,$inventoryCode,"OPD") ));
	$serie2->addPoint(new Point("Mar $year",$ro->getAnnualInventory("03",$year,$description,$inventoryCode,"OPD") ));
	$serie2->addPoint(new Point("Apr $year",$ro->getAnnualInventory("04",$year,$description,$inventoryCode,"OPD") ));
	$serie2->addPoint(new Point("May $year",$ro->getAnnualInventory("05",$year,$description,$inventoryCode,"OPD") ));
	$serie2->addPoint(new Point("Jun $year",$ro->getAnnualInventory("06",$year,$description,$inventoryCode,"OPD") ));
	$serie2->addPoint(new Point("Jul $year",$ro->getAnnualInventory("07",$year,$description,$inventoryCode,"OPD") ));
	$serie2->addPoint(new Point("Aug $year",$ro->getAnnualInventory("08",$year,$description,$inventoryCode,"OPD") ));
	$serie2->addPoint(new Point("Sep $year",$ro->getAnnualInventory("09",$year,$description,$inventoryCode,"OPD") ));
	$serie2->addPoint(new Point("Oct $year",$ro->getAnnualInventory("10",$year,$description,$inventoryCode,"OPD") ));
	$serie2->addPoint(new Point("Nov $year",$ro->getAnnualInventory("11",$year,$description,$inventoryCode,"OPD") ));
	$serie2->addPoint(new Point("Dec $year",$ro->getAnnualInventory("12",$year,$description,$inventoryCode,"OPD") ));


	
	$dataSet = new XYSeriesDataSet();
	$dataSet->addSerie("IPD", $serie1);
	$dataSet->addSerie("OPD", $serie2);
	$chart->setDataSet($dataSet);

	$chart->setTitle("$description dispensed in $year");
	$chart->getPlot()->setGraphCaptionRatio(0.62);
	$chart->render("../../../COCONUT/graphicalReport/chartList/annualInventory.png");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Discount Given from <?php echo $year; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Line chart" src="/COCONUT/graphicalReport/chartList/annualInventory.png" style="border: 1px solid gray;"/>

<?php echo $ro->getAnnualInventory("Jan",$year,$description,$inventoryCode,"IPD"); ?>
</body>
</html>
