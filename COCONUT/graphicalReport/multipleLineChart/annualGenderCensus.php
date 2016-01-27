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
	$serie1->addPoint(new Point("Jan $year", $ro->getGenderAnnual("01",$year,"male","OPD") ));
	$serie1->addPoint(new Point("Feb $year", $ro->getGenderAnnual("02",$year,"male","OPD") ));
	$serie1->addPoint(new Point("Mar $year", $ro->getGenderAnnual("03",$year,"male","OPD") ));	
	$serie1->addPoint(new Point("Apr $year", $ro->getGenderAnnual("04",$year,"male","OPD") ));	
	$serie1->addPoint(new Point("May $year", $ro->getGenderAnnual("05",$year,"male","OPD") ));	
	$serie1->addPoint(new Point("Jun $year", $ro->getGenderAnnual("06",$year,"male","OPD") ));	
	$serie1->addPoint(new Point("Jul $year", $ro->getGenderAnnual("07",$year,"male","OPD") ));	
	$serie1->addPoint(new Point("Aug $year", $ro->getGenderAnnual("08",$year,"male","OPD") ));	
	$serie1->addPoint(new Point("Sep $year", $ro->getGenderAnnual("09",$year,"male","OPD") ));	
	$serie1->addPoint(new Point("Oct $year", $ro->getGenderAnnual("10",$year,"male","OPD") ));	
	$serie1->addPoint(new Point("Nov $year", $ro->getGenderAnnual("11",$year,"male","OPD") ));	
	$serie1->addPoint(new Point("Dec $year", $ro->getGenderAnnual("12",$year,"male","OPD") ));	

	$serie2 = new XYDataSet();
	$serie2->addPoint(new Point("Jan $year",$ro->getGenderAnnual("01",$year,"female","OPD") ));
	$serie2->addPoint(new Point("Feb $year",$ro->getGenderAnnual("02",$year,"female","OPD") ));
	$serie2->addPoint(new Point("Mar $year",$ro->getGenderAnnual("03",$year,"female","OPD") ));
	$serie2->addPoint(new Point("Apr $year",$ro->getGenderAnnual("04",$year,"female","OPD") ));
	$serie2->addPoint(new Point("May $year",$ro->getGenderAnnual("05",$year,"female","OPD") ));
	$serie2->addPoint(new Point("Jun $year",$ro->getGenderAnnual("06",$year,"female","OPD") ));
	$serie2->addPoint(new Point("Jul $year",$ro->getGenderAnnual("07",$year,"female","OPD") ));
	$serie2->addPoint(new Point("Aug $year",$ro->getGenderAnnual("08",$year,"female","OPD") ));
	$serie2->addPoint(new Point("Sep $year",$ro->getGenderAnnual("09",$year,"female","OPD") ));
	$serie2->addPoint(new Point("Oct $year",$ro->getGenderAnnual("10",$year,"female","OPD") ));
	$serie2->addPoint(new Point("Nov $year",$ro->getGenderAnnual("11",$year,"female","OPD") ));
	$serie2->addPoint(new Point("Dec $year",$ro->getGenderAnnual("12",$year,"female","OPD") ));

	$serie3 = new XYDataSet();
	$serie3->addPoint(new Point("Jan $year",$ro->getGenderAnnual("01",$year,"male","IPD") ));
	$serie3->addPoint(new Point("Feb $year",$ro->getGenderAnnual("02",$year,"male","IPD") ));
	$serie3->addPoint(new Point("Mar $year",$ro->getGenderAnnual("03",$year,"male","IPD") ));
	$serie3->addPoint(new Point("Apr $year",$ro->getGenderAnnual("04",$year,"male","IPD") ));
	$serie3->addPoint(new Point("May $year",$ro->getGenderAnnual("05",$year,"male","IPD") ));
	$serie3->addPoint(new Point("Jun $year",$ro->getGenderAnnual("06",$year,"male","IPD") ));
	$serie3->addPoint(new Point("Jul $year",$ro->getGenderAnnual("07",$year,"male","IPD") ));
	$serie3->addPoint(new Point("Aug $year",$ro->getGenderAnnual("08",$year,"male","IPD") ));
	$serie3->addPoint(new Point("Sep $year",$ro->getGenderAnnual("09",$year,"male","IPD") ));
	$serie3->addPoint(new Point("Oct $year",$ro->getGenderAnnual("10",$year,"male","IPD") ));
	$serie3->addPoint(new Point("Nov $year",$ro->getGenderAnnual("11",$year,"male","IPD") ));
	$serie3->addPoint(new Point("Dec $year",$ro->getGenderAnnual("12",$year,"male","IPD") ));

	$serie4 = new XYDataSet();
	$serie4->addPoint(new Point("Jan $year",$ro->getGenderAnnual("01",$year,"female","IPD") ));	
	$serie4->addPoint(new Point("Feb $year",$ro->getGenderAnnual("02",$year,"female","IPD") ));	
	$serie4->addPoint(new Point("Mar $year",$ro->getGenderAnnual("03",$year,"female","IPD") ));	
	$serie4->addPoint(new Point("Apr $year",$ro->getGenderAnnual("04",$year,"female","IPD") ));	
	$serie4->addPoint(new Point("May $year",$ro->getGenderAnnual("05",$year,"female","IPD") ));	
	$serie4->addPoint(new Point("Jun $year",$ro->getGenderAnnual("06",$year,"female","IPD") ));	
	$serie4->addPoint(new Point("Jul $year",$ro->getGenderAnnual("07",$year,"female","IPD") ));	
	$serie4->addPoint(new Point("Aug $year",$ro->getGenderAnnual("08",$year,"female","IPD") ));	
	$serie4->addPoint(new Point("Sep $year",$ro->getGenderAnnual("09",$year,"female","IPD") ));	
	$serie4->addPoint(new Point("Oct $year",$ro->getGenderAnnual("10",$year,"female","IPD") ));	
	$serie4->addPoint(new Point("Nov $year",$ro->getGenderAnnual("11",$year,"female","IPD") ));	
	$serie4->addPoint(new Point("Dec $year",$ro->getGenderAnnual("12",$year,"female","IPD") ));	

	$dataSet = new XYSeriesDataSet();
	$dataSet->addSerie("OPD Male", $serie1);
	$dataSet->addSerie("OPD Female", $serie2);
	$dataSet->addSerie("IPD Male", $serie3);
	$dataSet->addSerie("IPD Female", $serie4);

	$chart->setDataSet($dataSet);

	$chart->setTitle("Gender Census for $year");
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
