<?php
$array = array(
array("1","one"),
array("2","two"),
array("3","three"),
array("4","four"),
array("5","five")
);
 
$array_values = array_values($array);
 
for($x=0;$x<count($array);$x++){
echo $array_values[$x][0];
echo $array_values[$x][1];
}
 

