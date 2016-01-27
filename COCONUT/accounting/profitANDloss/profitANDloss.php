<?php
include("../../../myDatabase1.php");
include "../../../COCONUT/libchart/libchart/classes/libchart.php";
$month = $_GET['month'];
$year = $_GET['year'];
$ro = new database1();
$chart = new PieChart();

echo "<br>";
echo "<center><font size=5>".$ro->getReportInformation("hmoSOA_name")."</font></center>";
echo "<center><font size=3>".$ro->getReportInformation("hmoSOA_address")."</font></center>";

echo "<br><br>";

echo "<center><font size=6>Profit and Loss</font></center>";
echo "<center><font size=3>( $month $year )</font></center>";

echo "<center><br>";
echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$totalIncome=0;
$totalExpenses=0;

$ro->coconutTableStart();
$ro->coconutTableRowStart();
$ro->coconutTableHeader("Date");
$ro->coconutTableHeader("IPD");
$ro->coconutTableHeader("OPD");
$ro->coconutTableHeader("Income");
$ro->coconutTableHeader("Expenses");
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$firstDay = ($ro->getPxRevenueDaily_ipd($month,"01",$year) + $ro->getPxRevenueDaily_opd($month,"01",$year));
$ro->coconutTableData("&nbsp;$month 1, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"01",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"01",$year),2) );
$ro->coconutTableData( number_format($firstDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"01",$year) * 1000,2) );
$totalIncome += $firstDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"01",$year);
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$secondDay = ($ro->getPxRevenueDaily_ipd($month,"02",$year) + $ro->getPxRevenueDaily_opd($month,"02",$year));
$ro->coconutTableData("&nbsp;$month 2, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"02",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"02",$year),2) );
$ro->coconutTableData( number_format($secondDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"02",$year) * 1000,2) );
$totalIncome += $secondDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"02",$year);
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$thirdDay = ($ro->getPxRevenueDaily_ipd($month,"03",$year) + $ro->getPxRevenueDaily_opd($month,"03",$year));
$ro->coconutTableData("&nbsp;$month 3, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"03",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"03",$year),2) );
$ro->coconutTableData( number_format($thirdDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"03",$year) * 1000,2) );
$totalIncome += $thirdDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"03",$year);
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$fourthDay = ($ro->getPxRevenueDaily_ipd($month,"04",$year) + $ro->getPxRevenueDaily_opd($month,"04",$year));
$ro->coconutTableData("&nbsp;$month 4, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"04",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"04",$year),2) );
$ro->coconutTableData( number_format($fourthDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"04",$year) * 1000,2) );
$totalIncome += $fourthDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"04",$year);
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$fifthDay = ($ro->getPxRevenueDaily_ipd($month,"05",$year) + $ro->getPxRevenueDaily_opd($month,"05",$year));
$ro->coconutTableData("&nbsp;$month 5, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"05",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"05",$year),2) );
$ro->coconutTableData( number_format($fifthDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"05",$year) * 1000,2) );
$totalIncome += $fifthDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"05",$year);
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$sixthDay = ($ro->getPxRevenueDaily_ipd($month,"06",$year) + $ro->getPxRevenueDaily_opd($month,"06",$year));
$ro->coconutTableData("&nbsp;$month 6, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"06",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"06",$year),2) );
$ro->coconutTableData( number_format($sixthDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"06",$year) * 1000,2) );
$totalIncome += $sixthDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"06",$year);
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$seventhDay = ($ro->getPxRevenueDaily_ipd($month,"07",$year) + $ro->getPxRevenueDaily_opd($month,"07",$year));
$ro->coconutTableData("&nbsp;$month 7, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"07",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"07",$year),2) );
$ro->coconutTableData( number_format($seventhDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"07",$year) * 1000,2) );
$totalIncome += $seventhDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"07",$year);
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$eightDay = ($ro->getPxRevenueDaily_ipd($month,"08",$year) + $ro->getPxRevenueDaily_opd($month,"08",$year));
$ro->coconutTableData("&nbsp;$month 8, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"08",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"08",$year),2) );
$ro->coconutTableData( number_format($eightDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"08",$year) * 1000,2) );
$totalIncome += $eightDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"08",$year);
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$ninethDay = ($ro->getPxRevenueDaily_ipd($month,"09",$year) + $ro->getPxRevenueDaily_opd($month,"09",$year));
$ro->coconutTableData("&nbsp;$month 9, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"09",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"09",$year),2) );
$ro->coconutTableData( number_format($ninethDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"09",$year) * 1000,2) );
$totalIncome += $ninethDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"09",$year);
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$tenDay = ($ro->getPxRevenueDaily_ipd($month,"10",$year) + $ro->getPxRevenueDaily_opd($month,"10",$year));
$ro->coconutTableData("&nbsp;$month 10, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"10",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"10",$year),2) );
$ro->coconutTableData( number_format($tenDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"10",$year) * 1000,2) );
$totalIncome += $tenDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"10",$year);
$ro->coconutTableRowStop();



$ro->coconutTableRowStart();
$elevenDay = ($ro->getPxRevenueDaily_ipd($month,"11",$year) + $ro->getPxRevenueDaily_opd($month,"11",$year));
$ro->coconutTableData("&nbsp;$month 11, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"11",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"11",$year),2) );
$ro->coconutTableData( number_format($elevenDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"11",$year) * 1000,2) );
$totalIncome += $elevenDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"11",$year);
$ro->coconutTableRowStop();



$ro->coconutTableRowStart();
$twelveDay = ($ro->getPxRevenueDaily_ipd($month,"12",$year) + $ro->getPxRevenueDaily_opd($month,"12",$year));
$ro->coconutTableData("&nbsp;$month 12, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"12",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"12",$year),2) );
$ro->coconutTableData( number_format($twelveDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"12",$year) * 1000,2) );
$totalIncome += $twelveDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"12",$year);
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$thirteenDay = ($ro->getPxRevenueDaily_ipd($month,"13",$year) + $ro->getPxRevenueDaily_opd($month,"13",$year));
$ro->coconutTableData("&nbsp;$month 13, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"13",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"13",$year),2) );
$ro->coconutTableData( number_format($thirteenDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"13",$year) * 1000,2) );
$totalIncome += $thirteenDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"13",$year);
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$fourteenDay = ($ro->getPxRevenueDaily_ipd($month,"14",$year) + $ro->getPxRevenueDaily_opd($month,"14",$year));
$ro->coconutTableData("&nbsp;$month 14, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"14",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"14",$year),2) );
$ro->coconutTableData( number_format($fourteenDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"14",$year) * 1000,2) );
$totalIncome += $fourteenDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"14",$year);
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$fifteenDay = ($ro->getPxRevenueDaily_ipd($month,"15",$year) + $ro->getPxRevenueDaily_opd($month,"15",$year));
$ro->coconutTableData("&nbsp;$month 15, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"15",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"15",$year),2) );
$ro->coconutTableData( number_format($fifteenDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"15",$year) * 1000,2) );
$totalIncome += $fifteenDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"15",$year);
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$sixteenDay = ($ro->getPxRevenueDaily_ipd($month,"16",$year) + $ro->getPxRevenueDaily_opd($month,"16",$year));
$ro->coconutTableData("&nbsp;$month 16, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"16",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"16",$year),2) );
$ro->coconutTableData( number_format($sixteenDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"16",$year) * 1000,2) );
$totalIncome += $sixteenDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"16",$year);
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$seventeenDay = ($ro->getPxRevenueDaily_ipd($month,"17",$year) + $ro->getPxRevenueDaily_opd($month,"17",$year));
$ro->coconutTableData("&nbsp;$month 17, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"17",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"17",$year),2) );
$ro->coconutTableData( number_format($seventeenDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"17",$year) * 1000,2) );
$totalIncome += $seventeenDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"17",$year);
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$eighteenDay = ($ro->getPxRevenueDaily_ipd($month,"18",$year) + $ro->getPxRevenueDaily_opd($month,"18",$year));
$ro->coconutTableData("&nbsp;$month 18, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"18",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"18",$year),2) );
$ro->coconutTableData( number_format($eighteenDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"18",$year) * 1000,2) );
$totalIncome += $eighteenDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"18",$year);
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$nineteenDay = ($ro->getPxRevenueDaily_ipd($month,"19",$year) + $ro->getPxRevenueDaily_opd($month,"19",$year));
$ro->coconutTableData("&nbsp;$month 19, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"19",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"19",$year),2) );
$ro->coconutTableData( number_format($nineteenDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"19",$year) * 1000,2) );
$totalIncome += $nineteenDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"19",$year);
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$twentyDay = ($ro->getPxRevenueDaily_ipd($month,"20",$year) + $ro->getPxRevenueDaily_opd($month,"20",$year));
$ro->coconutTableData("&nbsp;$month 20, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"20",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"20",$year),2) );
$ro->coconutTableData( number_format($twentyDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"20",$year) * 1000,2) );
$totalIncome += $twentyDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"20",$year);
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$twentyOneDay = ($ro->getPxRevenueDaily_ipd($month,"21",$year) + $ro->getPxRevenueDaily_opd($month,"21",$year));
$ro->coconutTableData("&nbsp;$month 21, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"21",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"21",$year),2) );
$ro->coconutTableData( number_format($twentyOneDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"21",$year) * 1000,2) );
$totalIncome += $twentyOneDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"21",$year);
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$twentyTwoDay = ($ro->getPxRevenueDaily_ipd($month,"22",$year) + $ro->getPxRevenueDaily_opd($month,"22",$year));
$ro->coconutTableData("&nbsp;$month 22, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"22",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"22",$year),2) );
$ro->coconutTableData( number_format($twentyTwoDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"22",$year) * 1000,2) );
$totalIncome += $twentyTwoDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"22",$year);
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$twentyThreeDay = ($ro->getPxRevenueDaily_ipd($month,"23",$year) + $ro->getPxRevenueDaily_opd($month,"23",$year));
$ro->coconutTableData("&nbsp;$month 23, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"23",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"23",$year),2) );
$ro->coconutTableData( number_format($twentyThreeDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"23",$year) * 1000,2) );
$totalIncome += $twentyThreeDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"23",$year);
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$twentyFourDay = ($ro->getPxRevenueDaily_ipd($month,"24",$year) + $ro->getPxRevenueDaily_opd($month,"24",$year));
$ro->coconutTableData("&nbsp;$month 24, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"24",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"24",$year),2) );
$ro->coconutTableData( number_format($twentyFourDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"24",$year) * 1000,2) );
$totalIncome += $twentyFourDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"24",$year);
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$twentyFiveDay = ($ro->getPxRevenueDaily_ipd($month,"25",$year) + $ro->getPxRevenueDaily_opd($month,"25",$year));
$ro->coconutTableData("&nbsp;$month 25, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"25",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"25",$year),2) );
$ro->coconutTableData( number_format($twentyFiveDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"25",$year) * 1000,2) );
$totalIncome += $twentyFiveDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"25",$year);
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$twentySixDay = ($ro->getPxRevenueDaily_ipd($month,"26",$year) + $ro->getPxRevenueDaily_opd($month,"26",$year));
$ro->coconutTableData("&nbsp;$month 26, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"26",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"26",$year),2) );
$ro->coconutTableData( number_format($twentySixDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"26",$year) * 1000,2) );
$totalIncome += $twentySixDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"26",$year);
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$twentySevenDay = ($ro->getPxRevenueDaily_ipd($month,"27",$year) + $ro->getPxRevenueDaily_opd($month,"27",$year));
$ro->coconutTableData("&nbsp;$month 27, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"27",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"27",$year),2) );
$ro->coconutTableData( number_format($twentySevenDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"27",$year) * 1000,2) );
$totalIncome += $twentySevenDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"27",$year);
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$twentyEightDay = ($ro->getPxRevenueDaily_ipd($month,"28",$year) + $ro->getPxRevenueDaily_opd($month,"28",$year));
$ro->coconutTableData("&nbsp;$month 28, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"28",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"28",$year),2) );
$ro->coconutTableData( number_format($twentyEightDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"28",$year) * 1000,2) );
$totalIncome += $twentyEightDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"28",$year);
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$twentyNineDay = ($ro->getPxRevenueDaily_ipd($month,"29",$year) + $ro->getPxRevenueDaily_opd($month,"29",$year));
$ro->coconutTableData("&nbsp;$month 29, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"29",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"29",$year),2) );
$ro->coconutTableData( number_format($twentyNineDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"29",$year) * 1000,2) );
$totalIncome += $twentyNineDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"29",$year);
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$thirtyDay = ($ro->getPxRevenueDaily_ipd($month,"30",$year) + $ro->getPxRevenueDaily_opd($month,"30",$year));
$ro->coconutTableData("&nbsp;$month 30, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"30",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"30",$year),2) );
$ro->coconutTableData( number_format($thirtyDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"30",$year) * 1000,2) );
$totalIncome += $thirtyDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"30",$year);
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$thirtyOneDay = ($ro->getPxRevenueDaily_ipd($month,"31",$year) + $ro->getPxRevenueDaily_opd($month,"31",$year));
$ro->coconutTableData("&nbsp;$month 31, $year&nbsp;");
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_ipd($month,"31",$year),2));
$ro->coconutTableData( number_format($ro->getPxRevenueDaily_opd($month,"31",$year),2) );
$ro->coconutTableData( number_format($thirtyOneDay,2) );
$ro->coconutTableData( number_format($ro->getMonthlyExpenses($month,"31",$year) * 1000,2) );
$totalIncome += $thirtyOneDay;
$totalExpenses += $ro->getMonthlyExpenses($month,"31",$year);
$ro->coconutTableRowStop();



$ro->coconutTableRowStart();
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;".number_format($totalIncome,2));
$ro->coconutTableData("&nbsp;".number_format($totalExpenses*1000,2));
$ro->coconutTableRowStop();


$ro->coconutTableStop();
$totExp = ($totalExpenses*1000);
$dataSet = new XYDataSet();
$dataSet->addPoint(new Point("Income (".number_format($totalIncome,2).")", $totalIncome));
$dataSet->addPoint(new Point("Expenses (".number_format($totExp,2).")",$totExp));
$chart->setDataSet($dataSet);
$chart->setTitle("Income vs Expense");
$chart->render("../../../COCONUT/graphicalReport/chartList/profitLoss.png");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>

<img alt="Pie chart"  src="/COCONUT/graphicalReport/chartList/profitLoss.png" style="border: 0px solid gray;"/>

</body>
</html>
