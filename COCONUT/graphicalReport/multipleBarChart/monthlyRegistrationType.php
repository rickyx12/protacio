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

	$chart = new VerticalBarChart(6000,500);
	$ro = new database1();	

	$serie1 = new XYDataSet();
	$serie1->addPoint(new Point("$month 1, $year",$ro->getGenderDaily($month,"01",$year,"male","OPD")  ));
	$serie1->addPoint(new Point("$month 2, $year",$ro->getGenderDaily($month,"02",$year,"male","OPD")  ));
	$serie1->addPoint(new Point("$month 3, $year",$ro->getGenderDaily($month,"03",$year,"male","OPD")  ));	
	$serie1->addPoint(new Point("$month 4, $year",$ro->getGenderDaily($month,"04",$year,"male","OPD")  ));	
	$serie1->addPoint(new Point("$month 5, $year",$ro->getGenderDaily($month,"05",$year,"male","OPD")  ));	
	$serie1->addPoint(new Point("$month 6, $year",$ro->getGenderDaily($month,"06",$year,"male","OPD")  ));	
	$serie1->addPoint(new Point("$month 7, $year",$ro->getGenderDaily($month,"07",$year,"male","OPD")  ));	
	$serie1->addPoint(new Point("$month 8, $year",$ro->getGenderDaily($month,"08",$year,"male","OPD")  ));	
	$serie1->addPoint(new Point("$month 9, $year",$ro->getGenderDaily($month,"09",$year,"male","OPD")  ));	
	$serie1->addPoint(new Point("$month 10, $year",$ro->getGenderDaily($month,"10",$year,"male","OPD")  ));	
	$serie1->addPoint(new Point("$month 11, $year",$ro->getGenderDaily($month,"11",$year,"male","OPD")  ));	
	$serie1->addPoint(new Point("$month 12, $year",$ro->getGenderDaily($month,"12",$year,"male","OPD")  ));	
	$serie1->addPoint(new Point("$month 13, $year",$ro->getGenderDaily($month,"13",$year,"male","OPD")  ));	
	$serie1->addPoint(new Point("$month 14, $year",$ro->getGenderDaily($month,"14",$year,"male","OPD")  ));	
	$serie1->addPoint(new Point("$month 15, $year",$ro->getGenderDaily($month,"15",$year,"male","OPD")  ));	
	$serie1->addPoint(new Point("$month 16, $year",$ro->getGenderDaily($month,"16",$year,"male","OPD")  ));	
	$serie1->addPoint(new Point("$month 17, $year",$ro->getGenderDaily($month,"17",$year,"male","OPD")  ));	
	$serie1->addPoint(new Point("$month 18, $year",$ro->getGenderDaily($month,"18",$year,"male","OPD")  ));	
	$serie1->addPoint(new Point("$month 19, $year",$ro->getGenderDaily($month,"19",$year,"male","OPD")  ));	
	$serie1->addPoint(new Point("$month 20, $year",$ro->getGenderDaily($month,"20",$year,"male","OPD")  ));	
	$serie1->addPoint(new Point("$month 21, $year",$ro->getGenderDaily($month,"21",$year,"male","OPD")  ));	
	$serie1->addPoint(new Point("$month 22, $year",$ro->getGenderDaily($month,"22",$year,"male","OPD")  ));	
	$serie1->addPoint(new Point("$month 23, $year",$ro->getGenderDaily($month,"23",$year,"male","OPD")  ));	
	$serie1->addPoint(new Point("$month 24, $year",$ro->getGenderDaily($month,"24",$year,"male","OPD")  ));	
	$serie1->addPoint(new Point("$month 25, $year",$ro->getGenderDaily($month,"25",$year,"male","OPD")  ));	
	$serie1->addPoint(new Point("$month 26, $year",$ro->getGenderDaily($month,"26",$year,"male","OPD")  ));	
	$serie1->addPoint(new Point("$month 27, $year",$ro->getGenderDaily($month,"27",$year,"male","OPD")  ));	
	$serie1->addPoint(new Point("$month 28, $year",$ro->getGenderDaily($month,"28",$year,"male","OPD")  ));	
	$serie1->addPoint(new Point("$month 29, $year",$ro->getGenderDaily($month,"29",$year,"male","OPD")  ));	
	$serie1->addPoint(new Point("$month 30, $year",$ro->getGenderDaily($month,"30",$year,"male","OPD")  ));	
	$serie1->addPoint(new Point("$month 31, $year",$ro->getGenderDaily($month,"31",$year,"male","OPD")  ));	

	$serie2 = new XYDataSet();
	$serie2->addPoint(new Point("$month 1, $year",$ro->getGenderDaily($month,"01",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 2, $year",$ro->getGenderDaily($month,"02",$year,"female","OPD")  ));	
	$serie2->addPoint(new Point("$month 3, $year",$ro->getGenderDaily($month,"03",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 4, $year",$ro->getGenderDaily($month,"04",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 5, $year",$ro->getGenderDaily($month,"05",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 6, $year",$ro->getGenderDaily($month,"06",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 7, $year",$ro->getGenderDaily($month,"07",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 8, $year",$ro->getGenderDaily($month,"08",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 9, $year",$ro->getGenderDaily($month,"09",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 10, $year",$ro->getGenderDaily($month,"10",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 11, $year",$ro->getGenderDaily($month,"11",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 12, $year",$ro->getGenderDaily($month,"12",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 13, $year",$ro->getGenderDaily($month,"13",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 14, $year",$ro->getGenderDaily($month,"14",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 15, $year",$ro->getGenderDaily($month,"15",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 16, $year",$ro->getGenderDaily($month,"16",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 17, $year",$ro->getGenderDaily($month,"17",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 18, $year",$ro->getGenderDaily($month,"18",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 19, $year",$ro->getGenderDaily($month,"19",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 20, $year",$ro->getGenderDaily($month,"20",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 21, $year",$ro->getGenderDaily($month,"21",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 22, $year",$ro->getGenderDaily($month,"22",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 23, $year",$ro->getGenderDaily($month,"23",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 24, $year",$ro->getGenderDaily($month,"24",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 25, $year",$ro->getGenderDaily($month,"25",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 26, $year",$ro->getGenderDaily($month,"26",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 27, $year",$ro->getGenderDaily($month,"27",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 28, $year",$ro->getGenderDaily($month,"28",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 29, $year",$ro->getGenderDaily($month,"29",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 30, $year",$ro->getGenderDaily($month,"30",$year,"female","OPD")  ));
	$serie2->addPoint(new Point("$month 31, $year",$ro->getGenderDaily($month,"31",$year,"female","OPD")  ));

	$serie3 = new XYDataSet();
	$serie3->addPoint(new Point("$month 1, $year",$ro->getGenderDaily($month,"01",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 2, $year",$ro->getGenderDaily($month,"02",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 3, $year",$ro->getGenderDaily($month,"03",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 4, $year",$ro->getGenderDaily($month,"04",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 5, $year",$ro->getGenderDaily($month,"05",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 6, $year",$ro->getGenderDaily($month,"06",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 7, $year",$ro->getGenderDaily($month,"07",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 8, $year",$ro->getGenderDaily($month,"08",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 9, $year",$ro->getGenderDaily($month,"09",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 10, $year",$ro->getGenderDaily($month,"10",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 11, $year",$ro->getGenderDaily($month,"11",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 12, $year",$ro->getGenderDaily($month,"12",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 13, $year",$ro->getGenderDaily($month,"13",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 14, $year",$ro->getGenderDaily($month,"14",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 15, $year",$ro->getGenderDaily($month,"15",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 16, $year",$ro->getGenderDaily($month,"16",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 17, $year",$ro->getGenderDaily($month,"17",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 18, $year",$ro->getGenderDaily($month,"18",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 19, $year",$ro->getGenderDaily($month,"19",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 20, $year",$ro->getGenderDaily($month,"20",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 21, $year",$ro->getGenderDaily($month,"21",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 22, $year",$ro->getGenderDaily($month,"22",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 23, $year",$ro->getGenderDaily($month,"23",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 24, $year",$ro->getGenderDaily($month,"24",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 25, $year",$ro->getGenderDaily($month,"25",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 26, $year",$ro->getGenderDaily($month,"26",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 27, $year",$ro->getGenderDaily($month,"27",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 28, $year",$ro->getGenderDaily($month,"28",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 29, $year",$ro->getGenderDaily($month,"29",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 30, $year",$ro->getGenderDaily($month,"30",$year,"male","IPD")  ));
	$serie3->addPoint(new Point("$month 31, $year",$ro->getGenderDaily($month,"31",$year,"male","IPD")  ));

	$serie4 = new XYDataSet();
	$serie4->addPoint(new Point("$month 1, $year",$ro->getGenderDaily($month,"01",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 2, $year",$ro->getGenderDaily($month,"02",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 3, $year",$ro->getGenderDaily($month,"03",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 4, $year",$ro->getGenderDaily($month,"04",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 5, $year",$ro->getGenderDaily($month,"05",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 6, $year",$ro->getGenderDaily($month,"06",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 7, $year",$ro->getGenderDaily($month,"07",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 8, $year",$ro->getGenderDaily($month,"08",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 9, $year",$ro->getGenderDaily($month,"09",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 10, $year",$ro->getGenderDaily($month,"10",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 11, $year",$ro->getGenderDaily($month,"11",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 12, $year",$ro->getGenderDaily($month,"12",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 13, $year",$ro->getGenderDaily($month,"13",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 14, $year",$ro->getGenderDaily($month,"14",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 15, $year",$ro->getGenderDaily($month,"15",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 16, $year",$ro->getGenderDaily($month,"16",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 17, $year",$ro->getGenderDaily($month,"17",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 18, $year",$ro->getGenderDaily($month,"18",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 19, $year",$ro->getGenderDaily($month,"19",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 20, $year",$ro->getGenderDaily($month,"20",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 21, $year",$ro->getGenderDaily($month,"21",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 22, $year",$ro->getGenderDaily($month,"22",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 23, $year",$ro->getGenderDaily($month,"23",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 24, $year",$ro->getGenderDaily($month,"24",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 25, $year",$ro->getGenderDaily($month,"25",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 26, $year",$ro->getGenderDaily($month,"26",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 27, $year",$ro->getGenderDaily($month,"27",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 28, $year",$ro->getGenderDaily($month,"28",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 29, $year",$ro->getGenderDaily($month,"29",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 30, $year",$ro->getGenderDaily($month,"30",$year,"female","IPD")  ));
	$serie4->addPoint(new Point("$month 31, $year",$ro->getGenderDaily($month,"31",$year,"female","IPD")  ));


$opdMale = ( $ro->getGenderDaily($month,"01",$year,"male","OPD") + $ro->getGenderDaily($month,"02",$year,"male","OPD") + $ro->getGenderDaily($month,"03",$year,"male","OPD") + $ro->getGenderDaily($month,"04",$year,"male","OPD") + $ro->getGenderDaily($month,"05",$year,"male","OPD") + $ro->getGenderDaily($month,"06",$year,"male","OPD") + $ro->getGenderDaily($month,"07",$year,"male","OPD") + $ro->getGenderDaily($month,"08",$year,"male","OPD") + $ro->getGenderDaily($month,"09",$year,"male","OPD") + $ro->getGenderDaily($month,"10",$year,"male","OPD") + $ro->getGenderDaily($month,"11",$year,"male","OPD") + $ro->getGenderDaily($month,"12",$year,"male","OPD") + $ro->getGenderDaily($month,"13",$year,"male","OPD") + $ro->getGenderDaily($month,"14",$year,"male","OPD") + $ro->getGenderDaily($month,"15",$year,"male","OPD") + $ro->getGenderDaily($month,"16",$year,"male","OPD") + $ro->getGenderDaily($month,"17",$year,"male","OPD") + $ro->getGenderDaily($month,"18",$year,"male","OPD") + $ro->getGenderDaily($month,"19",$year,"male","OPD") + $ro->getGenderDaily($month,"20",$year,"male","OPD") + $ro->getGenderDaily($month,"21",$year,"male","OPD") + $ro->getGenderDaily($month,"22",$year,"male","OPD") + $ro->getGenderDaily($month,"23",$year,"male","OPD") + $ro->getGenderDaily($month,"24",$year,"male","OPD") + $ro->getGenderDaily($month,"25",$year,"male","OPD") + $ro->getGenderDaily($month,"26",$year,"male","OPD") + $ro->getGenderDaily($month,"27",$year,"male","OPD") + $ro->getGenderDaily($month,"28",$year,"male","OPD") + $ro->getGenderDaily($month,"29",$year,"male","OPD") + $ro->getGenderDaily($month,"30",$year,"male","OPD") + $ro->getGenderDaily($month,"31",$year,"male","OPD") );


$opdFemale = ( $ro->getGenderDaily($month,"01",$year,"female","OPD") + $ro->getGenderDaily($month,"02",$year,"female","OPD") + $ro->getGenderDaily($month,"03",$year,"female","OPD") + $ro->getGenderDaily($month,"04",$year,"female","OPD") + $ro->getGenderDaily($month,"05",$year,"female","OPD") + $ro->getGenderDaily($month,"06",$year,"female","OPD") + $ro->getGenderDaily($month,"07",$year,"female","OPD") + $ro->getGenderDaily($month,"08",$year,"female","OPD") + $ro->getGenderDaily($month,"09",$year,"female","OPD") + $ro->getGenderDaily($month,"10",$year,"female","OPD") + $ro->getGenderDaily($month,"11",$year,"female","OPD") + $ro->getGenderDaily($month,"12",$year,"female","OPD") + $ro->getGenderDaily($month,"13",$year,"female","OPD") + $ro->getGenderDaily($month,"14",$year,"female","OPD") + $ro->getGenderDaily($month,"15",$year,"female","OPD") + $ro->getGenderDaily($month,"16",$year,"female","OPD") + $ro->getGenderDaily($month,"17",$year,"female","OPD") + $ro->getGenderDaily($month,"18",$year,"female","OPD") + $ro->getGenderDaily($month,"19",$year,"female","OPD") + $ro->getGenderDaily($month,"20",$year,"female","OPD") + $ro->getGenderDaily($month,"21",$year,"female","OPD") + $ro->getGenderDaily($month,"22",$year,"female","OPD") + $ro->getGenderDaily($month,"23",$year,"female","OPD") + $ro->getGenderDaily($month,"24",$year,"female","OPD") + $ro->getGenderDaily($month,"25",$year,"female","OPD") + $ro->getGenderDaily($month,"26",$year,"female","OPD") + $ro->getGenderDaily($month,"27",$year,"female","OPD") + $ro->getGenderDaily($month,"28",$year,"female","OPD") + $ro->getGenderDaily($month,"29",$year,"female","OPD") + $ro->getGenderDaily($month,"30",$year,"female","OPD") + $ro->getGenderDaily($month,"31",$year,"female","OPD") );




$ipdMale = ( $ro->getGenderDaily($month,"01",$year,"male","IPD") + $ro->getGenderDaily($month,"02",$year,"male","IPD") + $ro->getGenderDaily($month,"03",$year,"male","IPD") + $ro->getGenderDaily($month,"04",$year,"male","IPD") + $ro->getGenderDaily($month,"05",$year,"male","IPD") + $ro->getGenderDaily($month,"06",$year,"male","IPD") + $ro->getGenderDaily($month,"07",$year,"male","IPD") + $ro->getGenderDaily($month,"08",$year,"male","IPD") + $ro->getGenderDaily($month,"09",$year,"male","IPD") + $ro->getGenderDaily($month,"10",$year,"male","IPD") + $ro->getGenderDaily($month,"11",$year,"male","IPD") + $ro->getGenderDaily($month,"12",$year,"male","IPD") + $ro->getGenderDaily($month,"13",$year,"male","IPD") + $ro->getGenderDaily($month,"14",$year,"male","IPD") + $ro->getGenderDaily($month,"15",$year,"male","IPD") + $ro->getGenderDaily($month,"16",$year,"male","IPD") + $ro->getGenderDaily($month,"17",$year,"male","IPD") + $ro->getGenderDaily($month,"18",$year,"male","IPD") + $ro->getGenderDaily($month,"19",$year,"male","IPD") + $ro->getGenderDaily($month,"20",$year,"male","IPD") + $ro->getGenderDaily($month,"21",$year,"male","IPD") + $ro->getGenderDaily($month,"22",$year,"male","IPD") + $ro->getGenderDaily($month,"23",$year,"male","IPD") + $ro->getGenderDaily($month,"24",$year,"male","IPD") + $ro->getGenderDaily($month,"25",$year,"male","IPD") + $ro->getGenderDaily($month,"26",$year,"male","IPD") + $ro->getGenderDaily($month,"27",$year,"male","IPD") + $ro->getGenderDaily($month,"28",$year,"male","IPD") + $ro->getGenderDaily($month,"29",$year,"male","IPD") + $ro->getGenderDaily($month,"30",$year,"male","IPD") + $ro->getGenderDaily($month,"31",$year,"male","IPD") );



$ipdFemale = ( $ro->getGenderDaily($month,"01",$year,"female","IPD") + $ro->getGenderDaily($month,"02",$year,"female","IPD") + $ro->getGenderDaily($month,"03",$year,"female","IPD") + $ro->getGenderDaily($month,"04",$year,"female","IPD") + $ro->getGenderDaily($month,"05",$year,"female","IPD") + $ro->getGenderDaily($month,"06",$year,"female","IPD") + $ro->getGenderDaily($month,"07",$year,"female","IPD") + $ro->getGenderDaily($month,"08",$year,"female","IPD") + $ro->getGenderDaily($month,"09",$year,"female","IPD") + $ro->getGenderDaily($month,"10",$year,"female","IPD") + $ro->getGenderDaily($month,"11",$year,"female","IPD") + $ro->getGenderDaily($month,"12",$year,"female","IPD") + $ro->getGenderDaily($month,"13",$year,"female","IPD") + $ro->getGenderDaily($month,"14",$year,"female","IPD") + $ro->getGenderDaily($month,"15",$year,"female","IPD") + $ro->getGenderDaily($month,"16",$year,"female","IPD") + $ro->getGenderDaily($month,"17",$year,"female","IPD") + $ro->getGenderDaily($month,"18",$year,"female","IPD") + $ro->getGenderDaily($month,"19",$year,"female","IPD") + $ro->getGenderDaily($month,"20",$year,"female","IPD") + $ro->getGenderDaily($month,"21",$year,"female","IPD") + $ro->getGenderDaily($month,"22",$year,"female","IPD") + $ro->getGenderDaily($month,"23",$year,"female","IPD") + $ro->getGenderDaily($month,"24",$year,"female","IPD") + $ro->getGenderDaily($month,"25",$year,"female","IPD") + $ro->getGenderDaily($month,"26",$year,"female","IPD") + $ro->getGenderDaily($month,"27",$year,"female","IPD") + $ro->getGenderDaily($month,"28",$year,"female","IPD") + $ro->getGenderDaily($month,"29",$year,"female","IPD") + $ro->getGenderDaily($month,"30",$year,"female","IPD") + $ro->getGenderDaily($month,"31",$year,"female","IPD") );



	$dataSet = new XYSeriesDataSet();
	$dataSet->addSerie("OPD Male (".$opdMale.")", $serie1);
	$dataSet->addSerie("OPD Female (".$opdFemale.")", $serie2);
	$dataSet->addSerie("IPD Male (".$ipdMale.") ", $serie3);
	$dataSet->addSerie("IPD Female (".$ipdFemale.")", $serie4);
	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphCaptionRatio(0.65);

	$chart->setTitle("Gender Census for $month $year");
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
