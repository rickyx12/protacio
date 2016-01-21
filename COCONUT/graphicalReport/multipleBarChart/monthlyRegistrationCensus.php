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

	$chart = new VerticalBarChart(4000,500);
	$ro = new database1();	

	$serie1 = new XYDataSet();
	$serie1->addPoint(new Point("$month 1, $year", $ro->getPxCensusMonth($month,"01",$year,"OPD")  ));
	$serie1->addPoint(new Point("$month 2, $year ",$ro->getPxCensusMonth($month,"02",$year,"OPD")  ));
	$serie1->addPoint(new Point("$month 3, $year ",$ro->getPxCensusMonth($month,"03",$year,"OPD")  ));
	$serie1->addPoint(new Point("$month 4, $year ",$ro->getPxCensusMonth($month,"04",$year,"OPD")  ));
	$serie1->addPoint(new Point("$month 5, $year ",$ro->getPxCensusMonth($month,"05",$year,"OPD")  ));
	$serie1->addPoint(new Point("$month 6, $year ",$ro->getPxCensusMonth($month,"06",$year,"OPD")  ));
	$serie1->addPoint(new Point("$month 7, $year ",$ro->getPxCensusMonth($month,"07",$year,"OPD")  ));
	$serie1->addPoint(new Point("$month 8, $year ",$ro->getPxCensusMonth($month,"08",$year,"OPD")  ));
	$serie1->addPoint(new Point("$month 9, $year ",$ro->getPxCensusMonth($month,"09",$year,"OPD")  ));
	$serie1->addPoint(new Point("$month 10, $year ",$ro->getPxCensusMonth($month,"10",$year,"OPD")  ));
	$serie1->addPoint(new Point("$month 11, $year ",$ro->getPxCensusMonth($month,"11",$year,"OPD") ));
	$serie1->addPoint(new Point("$month 12, $year ",$ro->getPxCensusMonth($month,"12",$year,"OPD") ));
	$serie1->addPoint(new Point("$month 13, $year ",$ro->getPxCensusMonth($month,"13",$year,"OPD")  ));
	$serie1->addPoint(new Point("$month 14, $year ",$ro->getPxCensusMonth($month,"14",$year,"OPD") ));
	$serie1->addPoint(new Point("$month 15, $year ",$ro->getPxCensusMonth($month,"15",$year,"OPD") ));
	$serie1->addPoint(new Point("$month 16, $year ",$ro->getPxCensusMonth($month,"16",$year,"OPD") ));
	$serie1->addPoint(new Point("$month 17, $year ",$ro->getPxCensusMonth($month,"17",$year,"OPD") ));
	$serie1->addPoint(new Point("$month 18, $year ",$ro->getPxCensusMonth($month,"18",$year,"OPD")  ));
	$serie1->addPoint(new Point("$month 19, $year ",$ro->getPxCensusMonth($month,"19",$year,"OPD") ));
	$serie1->addPoint(new Point("$month 20, $year ",$ro->getPxCensusMonth($month,"20",$year,"OPD") ));
	$serie1->addPoint(new Point("$month 21, $year ",$ro->getPxCensusMonth($month,"21",$year,"OPD")  ));
	$serie1->addPoint(new Point("$month 22, $year ",$ro->getPxCensusMonth($month,"22",$year,"OPD") ));
	$serie1->addPoint(new Point("$month 23, $year ",$ro->getPxCensusMonth($month,"23",$year,"OPD")  ));
	$serie1->addPoint(new Point("$month 24, $year ",$ro->getPxCensusMonth($month,"24",$year,"OPD") ));
	$serie1->addPoint(new Point("$month 25, $year ",$ro->getPxCensusMonth($month,"25",$year,"OPD") ));
	$serie1->addPoint(new Point("$month 26, $year ",$ro->getPxCensusMonth($month,"26",$year,"OPD") ));
	$serie1->addPoint(new Point("$month 27, $year ",$ro->getPxCensusMonth($month,"27",$year,"OPD") ));
	$serie1->addPoint(new Point("$month 28, $year ",$ro->getPxCensusMonth($month,"28",$year,"OPD")  ));
	$serie1->addPoint(new Point("$month 29, $year ",$ro->getPxCensusMonth($month,"29",$year,"OPD") ));
	$serie1->addPoint(new Point("$month 30, $year ",$ro->getPxCensusMonth($month,"30",$year,"OPD") ));
	$serie1->addPoint(new Point("$month 31, $year ",$ro->getPxCensusMonth($month,"31",$year,"OPD") ));
	
	$serie2 = new XYDataSet();
	$serie2->addPoint(new Point("$month 1, $year", $ro->getPxCensusMonth($month,"01",$year,"IPD")  ));
	$serie2->addPoint(new Point("$month 2, $year", $ro->getPxCensusMonth($month,"02",$year,"IPD")  ));
	$serie2->addPoint(new Point("$month 3, $year ",$ro->getPxCensusMonth($month,"03",$year,"IPD")  ));
	$serie2->addPoint(new Point("$month 4, $year ",$ro->getPxCensusMonth($month,"04",$year,"IPD")  ));
	$serie2->addPoint(new Point("$month 5, $year", $ro->getPxCensusMonth($month,"05",$year,"IPD")  ));
	$serie2->addPoint(new Point("$month 6, $year", $ro->getPxCensusMonth($month,"06",$year,"IPD")  ));
	$serie2->addPoint(new Point("$month 7, $year", $ro->getPxCensusMonth($month,"07",$year,"IPD")  ));	
	$serie2->addPoint(new Point("$month 8, $year", $ro->getPxCensusMonth($month,"08",$year,"IPD") ));	
	$serie2->addPoint(new Point("$month 9, $year", $ro->getPxCensusMonth($month,"09",$year,"IPD") ));	
	$serie2->addPoint(new Point("$month 10, $year", $ro->getPxCensusMonth($month,"10",$year,"IPD")  ));	
	$serie2->addPoint(new Point("$month 11, $year", $ro->getPxCensusMonth($month,"11",$year,"IPD") ));	
	$serie2->addPoint(new Point("$month 12, $year", $ro->getPxCensusMonth($month,"12",$year,"IPD") ));	
	$serie2->addPoint(new Point("$month 13, $year", $ro->getPxCensusMonth($month,"13",$year,"IPD") ));	
	$serie2->addPoint(new Point("$month 14, $year", $ro->getPxCensusMonth($month,"14",$year,"IPD") ));	
	$serie2->addPoint(new Point("$month 15, $year", $ro->getPxCensusMonth($month,"15",$year,"IPD") ));	
	$serie2->addPoint(new Point("$month 16, $year", $ro->getPxCensusMonth($month,"16",$year,"IPD") ));	
	$serie2->addPoint(new Point("$month 17, $year", $ro->getPxCensusMonth($month,"17",$year,"IPD") ));	
	$serie2->addPoint(new Point("$month 18, $year", $ro->getPxCensusMonth($month,"18",$year,"IPD") ));	
	$serie2->addPoint(new Point("$month 19, $year", $ro->getPxCensusMonth($month,"19",$year,"IPD") ));	
	$serie2->addPoint(new Point("$month 20, $year", $ro->getPxCensusMonth($month,"20",$year,"IPD") ));	
	$serie2->addPoint(new Point("$month 21, $year", $ro->getPxCensusMonth($month,"21",$year,"IPD") ));	
	$serie2->addPoint(new Point("$month 22, $year", $ro->getPxCensusMonth($month,"22",$year,"IPD") ));	
	$serie2->addPoint(new Point("$month 23, $year", $ro->getPxCensusMonth($month,"23",$year,"IPD") ));	
	$serie2->addPoint(new Point("$month 24, $year", $ro->getPxCensusMonth($month,"24",$year,"IPD") ));	
	$serie2->addPoint(new Point("$month 25, $year", $ro->getPxCensusMonth($month,"25",$year,"IPD") ));	
	$serie2->addPoint(new Point("$month 26, $year", $ro->getPxCensusMonth($month,"26",$year,"IPD") ));	
	$serie2->addPoint(new Point("$month 27, $year", $ro->getPxCensusMonth($month,"27",$year,"IPD") ));	
	$serie2->addPoint(new Point("$month 28, $year", $ro->getPxCensusMonth($month,"28",$year,"IPD") ));	
	$serie2->addPoint(new Point("$month 29, $year", $ro->getPxCensusMonth($month,"29",$year,"IPD") ));	
	$serie2->addPoint(new Point("$month 30, $year", $ro->getPxCensusMonth($month,"30",$year,"IPD") ));	
	$serie2->addPoint(new Point("$month 31, $year", $ro->getPxCensusMonth($month,"31",$year,"IPD") ));	

$totalOPD = ( $ro->getPxCensusMonth($month,"01",$year,"OPD") + $ro->getPxCensusMonth($month,"02",$year,"OPD") + $ro->getPxCensusMonth($month,"03",$year,"OPD") + $ro->getPxCensusMonth($month,"04",$year,"OPD") + $ro->getPxCensusMonth($month,"05",$year,"OPD") + $ro->getPxCensusMonth($month,"06",$year,"OPD") + $ro->getPxCensusMonth($month,"07",$year,"OPD") + $ro->getPxCensusMonth($month,"08",$year,"OPD") + $ro->getPxCensusMonth($month,"09",$year,"OPD") + $ro->getPxCensusMonth($month,"10",$year,"OPD") + $ro->getPxCensusMonth($month,"11",$year,"OPD") + $ro->getPxCensusMonth($month,"12",$year,"OPD") + $ro->getPxCensusMonth($month,"13",$year,"OPD") + $ro->getPxCensusMonth($month,"14",$year,"OPD") + $ro->getPxCensusMonth($month,"15",$year,"OPD") + $ro->getPxCensusMonth($month,"16",$year,"OPD") + $ro->getPxCensusMonth($month,"17",$year,"OPD") + $ro->getPxCensusMonth($month,"18",$year,"OPD") + $ro->getPxCensusMonth($month,"19",$year,"OPD") + $ro->getPxCensusMonth($month,"20",$year,"OPD") + $ro->getPxCensusMonth($month,"21",$year,"OPD") + $ro->getPxCensusMonth($month,"22",$year,"OPD") + $ro->getPxCensusMonth($month,"23",$year,"OPD") + $ro->getPxCensusMonth($month,"24",$year,"OPD") + $ro->getPxCensusMonth($month,"25",$year,"OPD") + $ro->getPxCensusMonth($month,"26",$year,"OPD") + $ro->getPxCensusMonth($month,"27",$year,"OPD") + $ro->getPxCensusMonth($month,"28",$year,"OPD") + $ro->getPxCensusMonth($month,"29",$year,"OPD") + $ro->getPxCensusMonth($month,"30",$year,"OPD") + $ro->getPxCensusMonth($month,"31",$year,"OPD") );


$totalIPD = ( $ro->getPxCensusMonth($month,"01",$year,"IPD") + $ro->getPxCensusMonth($month,"02",$year,"IPD") + $ro->getPxCensusMonth($month,"03",$year,"IPD") + $ro->getPxCensusMonth($month,"04",$year,"IPD") + $ro->getPxCensusMonth($month,"05",$year,"IPD") + $ro->getPxCensusMonth($month,"06",$year,"IPD") + $ro->getPxCensusMonth($month,"07",$year,"IPD") + $ro->getPxCensusMonth($month,"08",$year,"IPD") + $ro->getPxCensusMonth($month,"09",$year,"IPD") + $ro->getPxCensusMonth($month,"10",$year,"IPD") + $ro->getPxCensusMonth($month,"11",$year,"IPD") + $ro->getPxCensusMonth($month,"12",$year,"IPD") + $ro->getPxCensusMonth($month,"13",$year,"IPD") + $ro->getPxCensusMonth($month,"14",$year,"IPD") + $ro->getPxCensusMonth($month,"15",$year,"IPD") + $ro->getPxCensusMonth($month,"16",$year,"IPD") + $ro->getPxCensusMonth($month,"17",$year,"IPD") + $ro->getPxCensusMonth($month,"18",$year,"IPD") + $ro->getPxCensusMonth($month,"19",$year,"IPD") + $ro->getPxCensusMonth($month,"20",$year,"IPD") + $ro->getPxCensusMonth($month,"21",$year,"IPD") + $ro->getPxCensusMonth($month,"22",$year,"IPD") + $ro->getPxCensusMonth($month,"23",$year,"IPD") + $ro->getPxCensusMonth($month,"24",$year,"IPD") + $ro->getPxCensusMonth($month,"25",$year,"IPD") + $ro->getPxCensusMonth($month,"26",$year,"IPD") + $ro->getPxCensusMonth($month,"27",$year,"IPD") + $ro->getPxCensusMonth($month,"28",$year,"IPD") + $ro->getPxCensusMonth($month,"29",$year,"IPD") + $ro->getPxCensusMonth($month,"30",$year,"IPD") + $ro->getPxCensusMonth($month,"31",$year,"IPD") );



	$dataSet = new XYSeriesDataSet();
	$dataSet->addSerie("OPD (".$totalOPD.")", $serie1);
	$dataSet->addSerie("IPD (".$totalIPD.")", $serie2);
	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphCaptionRatio(0.65);

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
