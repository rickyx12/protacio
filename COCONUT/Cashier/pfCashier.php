<?php
include("../../myDatabase2.php");
$itemNo = $_GET['itemNo'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$fromTime_hour = $_GET['fromTime_hour'];
$fromTime_minutes = $_GET['fromTime_minutes'];
$fromTime_seconds = $_GET['fromTime_seconds'];
$toTime_hour = $_GET['toTime_hour'];
$toTime_minutes = $_GET['toTime_minutes'];
$toTime_seconds = $_GET['toTime_seconds'];
$username = $_GET['username'];
$registrationNo = $_GET['registrationNo'];
$shift = $_GET['shift'];

$ro = new database2();
$ro->coconutDesign();

?>

<script type="text/javascript" src="http://<?php echo $ro->getMyUrl(); ?>/jquery1.11.1.js"></script>


<?php

$patno=$ro->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo);
echo strtoupper($ro->selectNow("patientRecord","lastName","patientNo",$patno)).", ".strtoupper($ro->selectNow("patientRecord","firstName","patientNo",$patno));

echo "<br><br>";
$ro->coconutFormStart("get","pfCashier1.php");
$ro->coconutHidden("itemNo",$itemNo);
$ro->coconutHidden("month",$month);
$ro->coconutHidden("day",$day);
$ro->coconutHidden("year",$year);
$ro->coconutHidden("fromTime_hour",$fromTime_hour);
$ro->coconutHidden("fromTime_minutes",$fromTime_minutes);
$ro->coconutHidden("fromTime_seconds",$fromTime_seconds);
$ro->coconutHidden("toTime_hour",$toTime_hour);
$ro->coconutHidden("toTime_minutes",$toTime_minutes);
$ro->coconutHidden("toTime_seconds",$toTime_seconds);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("shift",$shift);
$ro->coconutBoxStart("500","250");
echo "<br>";



if( $ro->selectNow("patientCharges","title","itemNo",$itemNo) == "PROFESSIONAL FEE" || $ro->selectNow("patientCharges","title","itemNo",$itemNo) == "OT" || $ro->selectNow("patientCharges","title","itemNo",$itemNo) == "ST" ) {
echo "<Table border=0>";
echo "<tr>";
echo "<td>Description</td>";
echo "<td>";
$ro->coconutTextBox("description",$ro->selectNow("patientCharges","description","itemNo",$itemNo));
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Price</td>";
echo "<td>";


$price = preg_split ("/\//",$ro->selectNow("patientCharges","sellingPrice","itemNo",$itemNo)); 
echo "<input type=text name='sellingPrice' class='price' id='sellingPrice' value='".$price[0]."' class='shortField' autocomplete='off' style='border: 1px solid #000; color: #000; height: 30px; width: 120px; padding:4px 4px 4px 5px;' ><span id='errmsg_sellingPrice' style='color:red;'></span>";

//echo "<input type=text name='sellingPrice' class='price' id='sellingPrice' value='".$ro->selectNow("patientCharges","sellingPrice","itemNo",$itemNo)."' class='shortField' autocomplete='off' style='border: 1px solid #000; color: #000; height: 30px; width: 120px; padding:4px 4px 4px 5px;' >&nbsp;<span id='errmsg_sellingPrice' style='color:red;'></span>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>QTY</td>";
echo "<td>";
echo "<input type=text name='quantity' class='price' id='quantity' value='".$ro->selectNow("patientCharges","quantity","itemNo",$itemNo)."' class='shortField' autocomplete='off' style='border: 1px solid #000; color: #000; height: 30px; width: 120px; padding:4px 4px 4px 5px;' >&nbsp;<span id='errmsg_qty' style='color:red;'></span>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Total</td>";
echo "<td>";
echo "<input type=text name='total' class='shortField' id='total' value='".$ro->selectNow("patientCharges","total","itemNo",$itemNo)."' class='shortField' autocomplete='off' >&nbsp;<span id='errmsg_total' style='color:red;'>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Hospital</td>";
echo "<td>";
echo "<input type=text name='cashUnpaid' class='cashUnpaid' style='border: 1px solid #000; color: #000; height: 30px; width: 120px; padding:4px 4px 4px 5px;' id='cashUnpaid' value='".$ro->selectNow("patientCharges","cashUnpaid","itemNo",$itemNo)."' class='shortField' autocomplete='off'>&nbsp;<span id='errmsg_cashUnpaid' style='color:red;'>";
echo "</td>";
echo "</tr>";

if($ro->selectNow("patientCharges","title","itemNo",$itemNo) == "PROFESSIONAL FEE") {
  echo "<tr>";
  echo "<td>Doctor</td>";
  echo "<td>";
  echo "<input type=text name='doctorsPF' id='doctorsPF' value='".$ro->selectNow("patientCharges","doctorsPF","itemNo",$itemNo)."' class='shortField' autocomplete='off'><input type='hidden' name='discount' value='0' />";
  $ro->coconutHidden("otShare","");
  echo "</td>";
  echo "</tr>";
}else {
  echo "<tr>";
  echo "<td>PF</td>";
  echo "<td>";
  echo "<input type=text name='otShare' id='doctorsPF' value='".$ro->selectNow("patientCharges","otShare","itemNo",$itemNo)."' class='shortField' autocomplete='off'><input type='hidden' name='discount' value='0' />";
  $ro->coconutHidden("doctorsPF","");
  echo "</td>";
  echo "</tr>";
}


echo "</table>";
}


else {
echo "<Table border=0>";
echo "<tr>";
echo "<td>Description</td>";
echo "<td>";
$ro->coconutTextBox("description",$ro->selectNow("patientCharges","description","itemNo",$itemNo));
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Price</td>";
echo "<td>";

echo "<input type=text name='sellingPrice' class='price' id='sellingPrice' value='".$ro->selectNow("patientCharges","sellingPrice","itemNo",$itemNo)."' class='shortField' autocomplete='off' style='border: 1px solid #000; color: #000; height: 30px; width: 120px; padding:4px 4px 4px 5px;' ><span id='errmsg_sellingPrice' style='color:red;'></span>";

//echo "<input type=text name='sellingPrice' class='price' id='sellingPrice' value='".$ro->selectNow("patientCharges","sellingPrice","itemNo",$itemNo)."' class='shortField' autocomplete='off' style='border: 1px solid #000; color: #000; height: 30px; width: 120px; padding:4px 4px 4px 5px;' >&nbsp;<span id='errmsg_sellingPrice' style='color:red;'></span>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>QTY</td>";
echo "<td>";
echo "<input type=text name='quantity' class='price' id='quantity' value='".$ro->selectNow("patientCharges","quantity","itemNo",$itemNo)."' class='shortField' autocomplete='off' style='border: 1px solid #000; color: #000; height: 30px; width: 120px; padding:4px 4px 4px 5px;' >&nbsp;<span id='errmsg_qty' style='color:red;'></span>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Total</td>";
echo "<td>";
echo "<input type=text name='total' class='shortField' id='total' value='".$ro->selectNow("patientCharges","total","itemNo",$itemNo)."' class='shortField' autocomplete='off' >&nbsp;<span id='errmsg_total' style='color:red;'>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Hospital</td>";
echo "<td>";
echo "<input type=text name='cashUnpaid' class='cashUnpaid' style='border: 1px solid #000; color: #000; height: 30px; width: 120px; padding:4px 4px 4px 5px;' id='cashUnpaid' value='".$ro->selectNow("patientCharges","cashUnpaid","itemNo",$itemNo)."' class='shortField' autocomplete='off'>&nbsp;<span id='errmsg_cashUnpaid' style='color:red;'>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Discount</td>";
echo "<td>";
echo "<input type=text name='discount' id='doctorsPF' value='".$ro->selectNow("patientCharges","discount","itemNo",$itemNo)."' class='shortField' autocomplete='off'><input type='hidden' name='doctorsPF' value='0' />";
echo "</td>";
echo "</tr>";

echo "</table>";
}

echo "<br>";
$ro->coconutButton("Proceed");

$ro->coconutBoxStop();

$ro->coconutFormStop();

?>

<script>


$(document).ready(function () {
  //called when key is pressed in textbox

  $("#sellingPrice").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg_sellingPrice").html("Numbers Only").show().fadeOut(3000);
               return false;
    }
   });

  $("#quantity").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg_qty").html("Numbers Only").show().fadeOut(3000);
               return false;
    }
   });

  $("#total").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg_total").html("Numbers Only").show().fadeOut(3000);
               return false;
    }
   });

  $("#cashUnpaid").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg_cashUnpaid").html("Numbers Only").show().fadeOut(3000);
               return false;
    }
   });
});

// we used jQuery 'keyup' to trigger the computation as the user type
$('.price').keyup(function () {
 
    // initialize the sum (total price) to zero
    var sum = 0;
     
    // we use jQuery each() to loop through all the textbox with 'price' class
    // and compute the sum for each loop
    $('.price').each(function() {
        sum = Number($("#sellingPrice").val() * $("#quantity").val());
    });

     
    // set the computed value to 'totalPrice' textbox
    $('#total').val(sum);
    $('#cashUnpaid').val(sum);
     
});


$('.cashUnpaid').keyup(function () {
 
var doczPF = ($("#total").val() - $("#cashUnpaid").val());
    
$('#doctorsPF').val(doczPF);
     
});


</script>
