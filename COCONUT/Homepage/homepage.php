<?php
include("../../myDatabase.php");
session_start();
$ro = new database();
unset($_SESSION['registrationNo']);
//echo "<style type='text/css'>@import url('http://localhost/COCONUT/myCSS/newCSS.css');</style>";

?>


<div id="main" style="border:1px solid #000; height:auto; width:620px; border-color:white black white black; 
        margin-left:10.2em;
        margin-right:17.2em;
        padding-left:1em;
        padding-right:1em;

">
<div style="border:1px solid #000; height:auto; width:600px; border-color:black black black black; ">
<br><center><font size=3 color=red><?php echo $ro->getReportInformation("hmoSOA_name"); ?></font>
<br>
<font size=2><?php echo $ro->getReportInformation("hmoSOA_address"); ?></font>
<br><br>
</div>
<br>
<font size=2>
<font color=red><b>Question:</b></font>&nbsp;Lahat ba ng medicine dapat i-encode sa system?
<br>
<font color=blue><b>Answer:</b></font>&nbsp;Hindi Lahat, yung available lang sa pharmacy ang dapat i-encode
<br><br>
<font color=red><b>Question:</b></font>&nbsp;Paano ko malalaman kung available sa pharmacy ang medicine/supplies?
<br>
<font color=blue><b>Answer:</b></font>&nbsp;kung available makikita mo yun sa search pero kung wala hindi mo makikita sa search.
<br><br>
<font color=red><b>Question:</b></font>&nbsp;Magbibigay pa ba ako ng reseta?
<br>
<font color=blue><b>Answer:</b></font>&nbsp;Oo, kapag hindi available sa pharmacy yung medicine/supplies pero kung available naman i-encode na lang sa system at wag kana magbigay ng reseta.
<br><br>
<font color=red><b>Question:</b></font>&nbsp;Pwede ba ako mag encode ng medicine/supplies kahit mamaya pa kukunin ng watcher ang medicine/supplies?
<br>
<font color=blue><b>Answer:</b></font>&nbsp;Hindi pwede, magtataka ang pharmacy bakit may request pero wala pang kumukuha ng medicine/supplies.
<br><Br>
<font color=red><b>Question:</b></font>&nbsp;Paano ko malalaman kung wala nga talaga sa pharmacy yung medicine/supplies dahil hindi ko ma-search na tingin ko meron naman?
<br>
<font color=blue><b>Answer:</b></font>&nbsp;Tumawag sa pharmacy at i-confirm kung wala nga ba talaga yung medicine/supplies na hinahanap mo.
<br><br>
<font color=red><b>Question:</b></font>&nbsp;paano ko malalaman kung ano ang i-click kapag nag cha-charge kasi tatlo ang nakalagay doon Cash,PhilHealth,Company?
<br>
<font color=blue><b>Answer:</b></font>&nbsp;i-click mo yung "PhilHealth" ang system na bahala mag assign kung ipapacover sa philhealth.., kahit hindi PhilHealth ang patient.
<br><br>
<font color=red><b>Question:</b></font>&nbsp;Paano kung hindi available sa pharmacy/supplies?
<br>
<font color=blue><b>Answer:</b></font>&nbsp;Gumawa at magbigay ka ng reseta para bilhin nila sa labas.
<br><br>
<font color=red><b>Question:</b></font>&nbsp;Bakit ayaw magbigay ng medicine ang pharmacy kahit may reseta na?
<br>
<font color=blue><b>Answer:</b></font>&nbsp;Kailangan po i encode sa sytem ang medicine/supplies bago ma irelease sa pharmacy para siguradong masama sa billing ng pasyente.
<Br><br>
<font color=red><b>Question:</b></font>&nbsp;Kapag repeat examination (Q4,Q6,etc.) isang beses lang ba i-charge?
<Br>
<font color=blue><b>Answer:</b></font>&nbsp;Hindi, Dapat i-charge according to schedule.
<br>
Example:<br>
Q4 <br>
<b>1st test (12 noon) 1st charge</b> <Br>
<b>2nd test (6 PM)  2nd charge</b> <br>
<B>3rd test (12 Midnight) 3rd charge</b> <br>
<b>4th test (6 AM) 4th charge</b> <br>
kasi every charge 1 result form pag na done na ang test mawawala na sa interface ng laboratory....
<br><br>
<font color=red><b>Question:</b></font>&nbsp;Di na magbibigay ng Lab result print out ang laboratory?
<br>
<font color=blue><b>Answer:</b></font>&nbsp;Magbibigay pa po, pwede lang po ma view agad ang result sa station kahit hindi pa na deliver ang hard copy pag test done na

</font>
<br><br><centeR>
<?php //$ro->coconutImages("backup.jpg") ?>
</center>
<br><br>
<form method="post" action="passwordComment.php">

<textarea rows="6" cols="80" style="border:1px solid #000;" name="comment"></textarea>
<br><br>
<?php echo "<center>"; $ro->coconutButton("Send Comment"); ?>
</form>

<?php $ro->getGuestComment(); //ippkta Lhat ng comment from d guest ?>

</div>

<div id="list1" class="link-list" style="border:0px solid #000; height:auto; border-color:white black white white; 
        width:10.2em;
        position:fixed;
        top:0;
        font-size:80%;
        padding-left:1%;
        padding-right:1%;
        margin-left:0;
        margin-right:15;
	left:0;
 ">


<?php

echo "<iframe src='http://".$ro->getMyUrl()."/COCONUT/room/listRoom1.php' width='170' height='555'  name='welcome' border=1 frameborder=no></iframe>";

?>

</div>


<div id="list2" class="link-list" style="border:0px solid #000; height:528px; border-color:white white white black;         width:10.2em;
        position:fixed;
        top:0;
        font-size:80%;
        padding-left:1%;
        padding-right:1%;
        margin-left:0;
        margin-right:15;
	right:0; ">

</div>



