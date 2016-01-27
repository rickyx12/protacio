<?php
include("../../myDatabase1.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];


$ro = new database1();

$totalPx = ( $ro->getTotalPx($month,$day,$year,$month1,$day1,$year1,"OPD") + $ro->getTotalPx($month,$day,$year,$month1,$day1,$year1,"IPD") );

$opd1 = ( $ro->getTotalPx($month,$day,$year,$month1,$day1,$year1,"OPD") / $totalPx );
$ipd1 = ( $ro->getTotalPx($month,$day,$year,$month1,$day1,$year1,"IPD") / $totalPx );


$opd2 = ( $opd1 * 360 );
$ipd2 = ( $ipd1 * 360 );

$myImage = ImageCreate(250,200);

$white = ImageColorAllocate ($myImage, 255, 255, 255);
$red  = ImageColorAllocate ($myImage, 255, 0, 0);
$green = ImageColorAllocate ($myImage, 0, 255, 0);
$blue = ImageColorAllocate ($myImage, 0, 0, 255);
$lt_red = ImageColorAllocate($myImage, 255, 150, 150);
$lt_green = ImageColorAllocate($myImage, 150, 255, 150);
$lt_blue = ImageColorAllocate($myImage, 150, 150, 255);

for ($i = 120;$i > 100;$i--) {
    ImageFilledArc ($myImage, 100, $i, 200, 120, 0, $opd2, $lt_red, IMG_ARC_PIE);
    ImageFilledArc ($myImage, 100, $i, 200, 120, $ipd2, 360, $lt_blue, IMG_ARC_PIE);
  //  ImageFilledArc ($myImage, 100, $i, 200, 150, 180, 360, $lt_blue, IMG_ARC_PIE);
}

ImageFilledArc($myImage, 100, 100, 200, 120, 0, $opd2, $red, IMG_ARC_PIE);
ImageFilledArc($myImage, 100, 100, 200, 120, $ipd2, 360 , $blue, IMG_ARC_PIE);
//ImageFilledArc($myImage, 100, 100, 200, 150, 180, 360 , $blue, IMG_ARC_PIE);

header ("Content-type: image/png");
ImagePNG($myImage);

ImageDestroy($myImage);

?>
