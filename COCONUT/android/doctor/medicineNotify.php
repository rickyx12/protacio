<?php
include("../../../myDatabase2.php");
$status = $_GET['status'];
$registrationNo = $_GET['registrationNo'];
$chargesCode = $_GET['chargesCode'];
$description = $_GET['description'];
$sellingPrice = $_GET['sellingPrice'];
$discount = $_GET['discount'];
$timeCharge = $_GET['timeCharge'];
$room = $_GET['room'];


$chargeBy = $_GET['chargeBy'];
$service = $_GET['service'];
$title = $_GET['title'];
$paidVia = $_GET['paidVia'];
$cashPaid = $_GET['cashPaid'];
$batchNo = $_GET['batchNo'];
$username = $_GET['username'];
$inventoryFrom = $_GET['inventoryFrom'];

$ro = new database2();
?>

<script src="http://<?php echo $ro->getMyUrl(); ?>/jquery.js"></script>
<script type="text/javascript">
    $(function () {
$('#quantity1').keyup(function () {
         $('#quantityz').val($(this).val());
         $('#quantityz1').val($(this).val());
     });


$('#timing').keyup(function () {
         $('#timing1').val($(this).val());
         $('#timing1_1').val($(this).val());
     });

$('#instruction').keyup(function () {
         $('#instruction1').val($(this).val());
         $('#instruction1_1').val($(this).val());
     });

$('#indication').keyup(function () {
         $('#indication1').val($(this).val());
         $('#indication1_1').val($(this).val());
     });

});
</script>
<?php
echo "<div style='background:#47a3da; margin:10px; height:270px; width:450px; border-radius:15px; '>";
echo "<br>";
echo "<table border=0>";

echo "<tr>";
echo "<td>&nbsp;<font color='white' size=4><b>Medicine</b></font></td>";
echo "<tD>&nbsp;<input type='text' style='border-radius:10px; border:0px; padding:1px; font-size:15px; height:30px; width:300px; ' name='medicine' value='$description'></tD>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<font color='white' size=4><b>QTY</b></font></td>";
echo "<tD>&nbsp;<input type='text' autocomplete='off' id='quantity1' style='border-radius:10px; border:0px; padding:2px; font-size:15px; height:30px; width:100px; ' name='qty' value='1'></tD>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<font color='white' size=4><b>Timing</b></font></td>";
echo "<tD>&nbsp;<input type='text' id='timing' style='border-radius:10px; border:0px; font-size:15px; height:30px; width:300px; ' name='timing' value=''></tD>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<font color='white' size=3><b>Instruction</b></font></td>";
echo "<tD>&nbsp;<input type='text' id='instruction' style='border-radius:10px; border:0px; font-size:15px; height:30px; width:300px; ' name='instruction' value=''></tD>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<font color='white' size=3><b>Indication</b></font></td>";
echo "<tD>&nbsp;<input type='text' id='indication' style='border-radius:10px; border:0px; font-size:15px; height:30px; width:300px; ' name='indication' value=''></tD>";
echo "</tr>";

echo "</table>";
echo "</div>";

echo "<br>";
echo "<table border=0 width='400px;'>";
echo "<tr>";
echo "<td>";
$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/android/mobileECART/addCharges.php");
$ro->coconutHidden("status",$status);
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("chargesCode",$chargesCode);
$ro->coconutHidden("description",$description);
$ro->coconutHidden("sellingPrice",$sellingPrice);
$ro->coconutHidden("timeCharge",$timeCharge);
$ro->coconutHidden("chargeBy",$chargeBy);
$ro->coconutHidden("service",$service);
$ro->coconutHidden("title",$title);
$ro->coconutHidden("paidVia",$paidVia);
$ro->coconutHidden("cashPaid",$cashPaid);
$ro->coconutHidden("batchNo",$batchNo);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("discount",$discount);
$ro->coconutHidden("inventoryFrom",$inventoryFrom);
$ro->coconutHidden("room",$room);
echo "<input type='hidden' id='quantityz' name='quantity' value='1'>";
echo "<input type='hidden' name='timing1' id='timing1' value=''>";
echo "<input type='hidden' name='instruction1' id='instruction1' value=''>";
echo "<input type='hidden' name='indication1' id='indication1' value=''>";
$ro->coconutHidden("decision","no");
echo "<input type='submit' style='background:#47a3da; border:0px; color:white; border-radius:15px; font-weight:bold; height:50px;' value='Prescription Only'>";
$ro->coconutFormStop();
echo "</td>";

echo "<td align='right'>";
$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/android/mobileECART/addCharges.php");
$ro->coconutHidden("status",$status);
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("chargesCode",$chargesCode);
$ro->coconutHidden("description",$description);
$ro->coconutHidden("sellingPrice",$sellingPrice);
$ro->coconutHidden("timeCharge",$timeCharge);
$ro->coconutHidden("chargeBy",$chargeBy);
$ro->coconutHidden("service",$service);
$ro->coconutHidden("title",$title);
$ro->coconutHidden("paidVia",$paidVia);
$ro->coconutHidden("cashPaid",$cashPaid);
$ro->coconutHidden("batchNo",$batchNo);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("discount",$discount);
$ro->coconutHidden("inventoryFrom",$inventoryFrom);
$ro->coconutHidden("room",$room);
echo "<input type='hidden' id='quantityz1' name='quantity' value='1'>";
echo "<input type='hidden' name='timing1' id='timing1_1' value=''>";
echo "<input type='hidden' name='instruction1' id='instruction1_1' value=''>";
echo "<input type='hidden' name='indication1' id='indication1_1' value=''>";
$ro->coconutHidden("decision","yes");
echo "<input type='submit' style='background:#47a3da; border:0px; color:white; border-radius:15px; font-weight:bold; height:50px;' value='Prescription and Charge'>";
$ro->coconutFormStop();
echo "</td>";

echo "</tr>";
echo "</table>";


?>
