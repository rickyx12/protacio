<?php
include("../myDatabase.php");

$ro = new database();

?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/flow/rickyCSS1.css" />

<script type='text/javascript'>
$("#breadcrumbs a").hover(
    function () {
        $(this).addClass("hover").children().addClass("hover");
        $(this).parent().prev().find("span.arrow:first").addClass("pre_hover");
    },
    function () {
        $(this).removeClass("hover").children().removeClass("hover");
        $(this).parent().prev().find("span.arrow:first").removeClass("pre_hover");
    }
);
</script>

<ol id="breadcrumbs">
    <li><a href="#"><font color=white>Maintenance</font><span class="arrow"></span></a></li>
    <li><a href="#" class='odd'><font color=white>Inventory</font><span class="arrow"></span></a></li>
    

    <li><a href="" >&nbsp;&nbsp;</a></li>
</ol>
