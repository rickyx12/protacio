<?php
include("../myDatabase2.php");

$ro = new database2();

echo "<html>";
echo "<head>";
echo "<script src='http://".$ro->getMyUrl()."/jquery.js'></script>";
echo "<script>";

?>

function playBuzzer(){
        $("body").append("<embed src='doorbell.wav' autostart='true' loop='false' width='2' height='0'></embed>");
}

     var aSound = document.createElement('audio');
     aSound.setAttribute('src', 'doorbell.wav');

aSound.play();

<?php

echo "</script>";
echo "<body>";
echo "</body>";
echo "</html>";

?>
