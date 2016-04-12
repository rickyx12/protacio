<?
include "../../myDatabase4.php";
include "../../myDatabase.php";
$ro = new database4();
$ro1 = new database();
$date = $_GET['date'];




$ro->patient_with_transaction($date,"morning");
$ro->patient_with_transaction_hmo($date,"morning");
$ro->inpatient_payment($date,"morning");
$registrationNo_morning = $ro->patient_with_transaction_registrationNo();
$lastName_morning = $ro->patient_with_transaction_lastName();
$firstName_morning = $ro->patient_with_transaction_firstName();
$patientCompany_morning = $ro->patient_with_transaction_patientCompany();
$pxCount_morning = $ro->patient_with_transaction_pxCount();

$countReg_morning = count($registrationNo_morning);
$countFN_moring = count($firstName_morning);
$countLN_morning = count($lastName_morning);
$countPXComp_morning = count($patientCompany_morning);
$countPX_morning = count($pxCount_morning);

$ipd_lastName_morning = $ro->inpatient_payment_lastName();
$ipd_firstName_morning = $ro->inpatient_payment_firstName();
$paymentFor_morning = $ro->inpatient_payment_paymentFor();
$ipd_registrationNo_morning = $ro->inpatient_payment_registrationNo();
$ipd_paymentNo_morning = $ro->inpatient_payment_paymentno();

$ipdFN_morning = count($ipd_firstName_morning);
$ipdLN_morning = count($ipd_lastName_morning);
$ipdPaymentFor_morning = count($paymentFor_morning);
$ipdRegistrationNo_morning = count($ipd_registrationNo_morning);
$ipdPaymentNo_morning = count($ipd_paymentNo_morning);


$total_morning = 0;
$balance_morning = 0;
$discount_morning = 0;
$card_morning = 0;
$cash_morning = 0;
$creditCard_morning = 0;

$ipd_cash_morning = 0;
$ipd_creditCard_morning = 0;


$ro->patient_with_transaction($date,"noon");
$ro->patient_with_transaction_hmo($date,"noon");
$ro->inpatient_payment($date,"noon");
$registrationNo_noon = $ro->patient_with_transaction_registrationNo();
$lastName_noon = $ro->patient_with_transaction_lastName();
$firstName_noon = $ro->patient_with_transaction_firstName();
$patientCompany_noon = $ro->patient_with_transaction_patientCompany();
$pxCount_noon = $ro->patient_with_transaction_pxCount();

$countReg_noon = count($registrationNo_noon);
$countFN_noon = count($firstName_noon);
$countLN_noon = count($lastName_noon);
$countPXComp_noon = count($patientCompany_noon);
$countPX_noon = count($pxCount_noon);

$ipd_lastName_noon = $ro->inpatient_payment_lastName();
$ipd_firstName_noon = $ro->inpatient_payment_firstName();
$paymentFor_noon = $ro->inpatient_payment_paymentFor();
$ipd_registrationNo_noon = $ro->inpatient_payment_registrationNo();
$ipd_paymentNo_noon = $ro->inpatient_payment_paymentno();

$ipdFN_noon = count($ipd_firstName_noon);
$ipdLN_noon = count($ipd_lastName_noon);
$ipdPaymentFor_noon = count($paymentFor_noon);
$ipdRegistrationNo_noon = count($ipd_registrationNo_noon);
$ipdPaymentNo_noon = count($ipd_paymentNo_noon);


$total_noon = 0;
$discount_noon = 0;
$balance_noon = 0;
$card_noon = 0;
$cash_noon = 0;
$creditCard_noon = 0;

$ipd_cash_noon = 0;
$ipd_creditCard_noon = 0;
$ipd_discount_noon = 0;


$ro->patient_with_transaction($date,"afternoon");
$ro->patient_with_transaction_hmo($date,"afternoon");
$ro->inpatient_payment($date,"afternoon");
$registrationNo_afternoon = $ro->patient_with_transaction_registrationNo();
$lastName_afternoon = $ro->patient_with_transaction_lastName();
$firstName_afternoon = $ro->patient_with_transaction_firstName();
$patientCompany_afternoon = $ro->patient_with_transaction_patientCompany();
$pxCount_afternoon = $ro->patient_with_transaction_pxCount();

$countReg_afternoon = count($registrationNo_afternoon);
$countFN_afternoon = count($firstName_afternoon);
$countLN_afternoon = count($lastName_afternoon);
$countPXComp_afternoon = count($patientCompany_afternoon);
$countPX_afternoon = count($pxCount_afternoon);



$ipd_lastName_afternoon = $ro->inpatient_payment_lastName();
$ipd_firstName_afternoon = $ro->inpatient_payment_firstName();
$paymentFor_afternoon = $ro->inpatient_payment_paymentFor();
$ipd_registrationNo_afternoon = $ro->inpatient_payment_registrationNo();
$ipd_paymentNo_afternoon = $ro->inpatient_payment_paymentno();


/*
$ipd_lastName_afternoon = $ro->inpatient_payment_lastName();
$ipd_firstName_afternoon = $ro->inpatient_payment_firstName();
$paymentFor_afternoon = $ro->inpatient_payment_paymentFor();
$ipd_registrationNo_afternoon = $ro->inpatient_payment_registrationNo();
$ipd_paymentNo_afternoon = "5";
*/


$ipdFN_afternoon = count($ipd_firstName_afternoon);
$ipdLN_afternoon = count($ipd_lastName_afternoon);
$ipdPaymentFor_afternoon = count($paymentFor_afternoon);
$ipdRegistrationNo_afternoon = count($ipd_registrationNo_afternoon);
$ipdPaymentNo_afternoon = count($ipd_paymentNo_afternoon);

$total_afternoon = 0;
$discount_afternoon = 0;
$balance_afternoon = 0;
$card_afternoon = 0;
$cash_afternoon = 0;
$creditCard_afternoon = 0;

$ipd_cash_afternoon = 0;
$ipd_creditCard_afternoon = 0;
$ipd_discount_afternoon = 0;


$ro->patient_with_transaction($date,"night");
$ro->patient_with_transaction_hmo($date,"night");
$ro->inpatient_payment($date,"night");
$registrationNo_night = $ro->patient_with_transaction_registrationNo();
$lastName_night = $ro->patient_with_transaction_lastName();
$firstName_night = $ro->patient_with_transaction_firstName();
$patientCompany_night = $ro->patient_with_transaction_patientCompany();
$pxCount_night = $ro->patient_with_transaction_pxCount();

$countReg_night = count($registrationNo_night);
$countFN_night = count($firstName_night);
$countLN_night = count($lastName_night);
$countPXComp_night = count($patientCompany_night);
$countPX_night = count($pxCount_night);

$ipd_lastName_night = $ro->inpatient_payment_lastName();
$ipd_firstName_night = $ro->inpatient_payment_firstName();
$paymentFor_night = $ro->inpatient_payment_paymentFor();
$ipd_registrationNo_night = $ro->inpatient_payment_registrationNo();
$ipd_paymentNo_night = $ro->inpatient_payment_paymentno();

$ipdFN_night = count($ipd_firstName_night);
$ipdLN_night = count($ipd_lastName_night);
$ipdPaymentFor_night = count($paymentFor_night);
$ipdRegistrationNo_night = count($ipd_registrationNo_night);
$ipdPaymentNo_night = count($ipd_paymentNo_night);

$total_night = 0;
$discount_night = 0;
$balance_night = 0;
$card_night = 0;
$cash_night = 0;
$creditCard_night = 0;


$total = 0;
$balance = 0;
$card = 0;
$cash = 0;
$creditCard = 0;

$ipd_cash_night = 0;
$ipd_creditCard_night = 0;
$ipd_discount_night = 0;

$ipd_cash = 0;
$ipd_creditCard = 0;



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Daily Transaction</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../..//bootstrap-3.3.6/css/bootstrap.min.css">
  <script src="/bootstrap-3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Daily Transaction</h2>
  <p><? echo $ro->formatDate($date); ?></p>            
  <table class="table table-hover">
    	<thead>
      		<tr>
      			<th></th>
        		<th>Patient</th>
        		<th></th>
        		<th>Total</th>
            <th>Discount</th>
        		<th>Balance</th>
        		<th>HMO</th>
        		<th>Cash</th>
        		<th>Cr.Card</th>
      		</tr>
    	</thead>
    	<tbody> 
            <tr> 
              <td>&nbsp;</td>
              <td><b>Morning</b></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>

            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;<b>Outpatient</b></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>

            <!--morning-->
    		<? for($a=0,$b=0,$c=0,$d=0,$e=0;$a<$countFN_moring,$b<$countLN_morning,$c<$countReg_morning,$d<$countPXComp_morning,$e<$countPX_morning;$a++,$b++,$c++,$d++,$e++) { ?>
    				<tr>
    						<? $total_morning += $ro->patient_with_transaction_total($registrationNo_morning[$c]) ?>
    						<? $balance_morning += $ro->patient_with_transaction_balance($registrationNo_morning[$c]) ?>
                <? $discount_morning += $ro->patient_with_transaction_discount($registrationNo_morning[$c]) ?>
    						<? $card_morning += $ro->patient_with_transaction_company($registrationNo_morning[$c]) ?>
    						<? $cash_morning += $ro->patient_with_transaction_cash($registrationNo_morning[$c]) ?>
    						<? $creditCard_morning += $ro->patient_with_transaction_creditCard($registrationNo_morning[$c]) ?>

    					<td><? //echo $pxCount[$e]; ?></td>
    					<td><? echo $lastName_morning[$b].", ".$firstName_morning[$a] ?></td>
    					<td><? echo $patientCompany_morning[$d] ?></td>
    					<td><? echo number_format($ro->patient_with_transaction_total($registrationNo_morning[$c]),2) ?></td>
              <td><? echo number_format($ro->patient_with_transaction_discount($registrationNo_morning[$c])) ?></td>
    					<td><? echo number_format($ro->patient_with_transaction_balance($registrationNo_morning[$c]),2) ?></td>
    					<td><? echo number_format($ro->patient_with_transaction_company($registrationNo_morning[$c]),2) ?></td>
    					<td><? echo number_format($ro->patient_with_transaction_cash($registrationNo_morning[$c]),2) ?></td>
    					<td><? echo number_format($ro->patient_with_transaction_creditCard($registrationNo_morning[$c]),2) ?></td>
    				</tr>	
    		<?  } ?>

          <!---HMO PATIENT-->

        <?  if($ro->patient_with_transaction_hmo_registrationNo() != "") { ?>

          <?php foreach($ro->patient_with_transaction_hmo_registrationNo() as $registrationNo) { ?>
            <tr>
                <? $total_morning += $ro->patient_with_transaction_total($registrationNo) ?>
                <? $discount_morning += $ro->patient_with_transaction_discount($registrationNo) ?>
                <? $balance_morning += $ro->patient_with_transaction_balance($registrationNo) ?>
                <? $card_morning += $ro->patient_with_transaction_company($registrationNo) ?>
                <? $cash_morning += $ro->patient_with_transaction_cash($registrationNo) ?>
                <? $creditCard_morning += $ro->patient_with_transaction_creditCard($registrationNo) ?>
                <td>&nbsp;</td>
                <td>&nbsp;<?php echo $ro1->selectNow("patientRecord","lastName","patientNo",$ro1->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo)) ?>, <?php echo $ro1->selectNow("patientRecord","firstName","patientNo",$ro1->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo)) ?></td>
                <td>&nbsp;<? echo $ro1->selectNow("registrationDetails","Company","registrationNo",$registrationNo) ?></td>
                <td>&nbsp;<? echo number_format($ro->patient_with_transaction_total($registrationNo),2) ?></td>
                <td>&nbsp;<? echo number_format($ro->patient_with_transaction_discount($registrationNo),2) ?></td>
                <td>&nbsp;<? echo number_format($ro->patient_with_transaction_balance($registrationNo),2) ?></td>
                <td>&nbsp;<? echo number_format($ro->patient_with_transaction_company($registrationNo),2) ?></td>
                <td>&nbsp;<? echo number_format($ro->patient_with_transaction_cash($registrationNo),2) ?></td>
                <td>&nbsp;<? echo number_format($ro->patient_with_transaction_creditCard($registrationNo),2) ?></td>
            </tr>
          <?php } ?>
          <? }else { } ?>

          <tr>
            <td></td>
            <td><font color=red>Morning Outpatient Total</font></td>
            <td></td>
            <td><? echo number_format($total_morning,2) ?></td>
            <td><? echo number_format($discount_morning,2) ?></td>
            <td><? echo number_format($balance_morning,2) ?></td>
            <td><? echo number_format($card_morning,2) ?></td>
            <td><? echo number_format($cash_morning,2) ?></td>
            <td><? echo number_format($creditCard_morning,2) ?></td>
          </tr>

            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;<b>Inpatient</b></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>


            <? for($a=0,$b=0,$c=0,$d=0,$e=0;$a<$ipdFN_morning,$b<$ipdLN_morning,$c<$ipdPaymentFor_morning,$d<$ipdRegistrationNo_morning,$e<$ipdPaymentNo_morning;$a++,$b++,$c++,$d++,$e++) { ?>
              <tr>
                  <? $ipd_cash_morning += $ro->inpatient_payment_paid($ipd_registrationNo_morning[$d],$ipd_paymentNo_morning[$e],"Cash") ?>
                  <? $ipd_creditCard_morning += $ro->inpatient_payment_paid($ipd_registrationNo_morning[$d],$ipd_paymentNo_morning[$e],"Credit Card"); ?>
                <td></td>
                <td><? echo $ipd_lastName_morning[$b] ?>, <? echo $ipd_firstName_morning[$a] ?></td>
                <td><? echo $paymentFor_morning[$c] ?></td>
                <td><? //echo number_format($ro->patient_with_transaction_total($ipd_registrationNo[$d]),2) ?></td>
                <td>&nbsp;</td>
                <td></td>
                <td><? //echo number_format($ro->patient_with_transaction_company($ipd_registrationNo[$d]),2) ?></td>
                <td><? echo number_format($ro->inpatient_payment_paid($ipd_registrationNo_morning[$d],$ipd_paymentNo_morning[$e],"Cash"),2) ?></td>
                <td><? echo number_format($ro->inpatient_payment_paid($ipd_registrationNo_morning[$d],$ipd_paymentNo_morning[$e],"Credit Card"),2) ?></td>
              </tr> 
            <? } ?>
          </tbody>
          <tbody>
            <tr>
              <td></td>
              <td><font color=red>Morning Inpatient Total</font></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td><? echo number_format($ipd_cash_morning,2) ?></td>
              <td><? echo number_format($ipd_creditCard_morning,2); ?></td>
            </tr>

            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>

          <!--NOON-->
            <tr> 
              <td>&nbsp;</td>
              <td><b>Noon</b></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>

            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;<b>Outpatient</b></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>

            <!--noon-->
        <? for($a=0,$b=0,$c=0,$d=0,$e=0;$a<$countFN_noon,$b<$countLN_noon,$c<$countReg_noon,$d<$countPXComp_noon,$e<$countPX_noon;$a++,$b++,$c++,$d++,$e++) { ?>
            <tr>
                <? $total_noon += $ro->patient_with_transaction_total($registrationNo_noon[$c]) ?>
                <? $discount_noon += $ro->patient_with_transaction_discount($registrationNo_noon[$c]) ?>
                <? $balance_noon += $ro->patient_with_transaction_balance($registrationNo_noon[$c]) ?>
                <? $card_noon += $ro->patient_with_transaction_company($registrationNo_noon[$c]) ?>
                <? $cash_noon += $ro->patient_with_transaction_cash($registrationNo_noon[$c]) ?>
                <? $creditCard_noon += $ro->patient_with_transaction_creditCard($registrationNo_noon[$c]) ?>

              <td><? //echo $pxCount[$e]; ?></td>
              <td><? echo $lastName_noon[$b].", ".$firstName_noon[$a] ?></td>
              <td><? echo $patientCompany_noon[$d] ?></td>
              <td><? echo number_format($ro->patient_with_transaction_total($registrationNo_noon[$c]),2) ?></td>
              <td><? echo number_format($ro->patient_with_transaction_discount($registrationNo_noon[$c]),2) ?></td>
              <td><? echo number_format($ro->patient_with_transaction_balance($registrationNo_noon[$c]),2) ?></td>
              <td><? echo number_format($ro->patient_with_transaction_company($registrationNo_noon[$c]),2) ?></td>
              <td><? echo number_format($ro->patient_with_transaction_cash($registrationNo_noon[$c]),2) ?></td>
              <td><? echo number_format($ro->patient_with_transaction_creditCard($registrationNo_noon[$c]),2) ?></td>
            </tr> 
        <?  } ?>


          <? if($ro->patient_with_transaction_hmo_registrationNo() != "") { ?>
          <!---HMO PATIENT-->
          <?php foreach($ro->patient_with_transaction_hmo_registrationNo() as $registrationNo) { ?>
            <tr>
                <? $total_noon += $ro->patient_with_transaction_total($registrationNo) ?>
                <? $discount_noon += $ro->patient_with_transaction_discount($registrationNo) ?>
                <? $balance_noon += $ro->patient_with_transaction_balance($registrationNo) ?>
                <? $card_noon += $ro->patient_with_transaction_company($registrationNo) ?>
                <? $cash_noon += $ro->patient_with_transaction_cash($registrationNo) ?>
                <? $creditCard_noon += $ro->patient_with_transaction_creditCard($registrationNo) ?>
                <td>&nbsp;</td>
                <td>&nbsp;<?php echo $ro1->selectNow("patientRecord","lastName","patientNo",$ro1->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo)) ?>, <?php echo $ro1->selectNow("patientRecord","firstName","patientNo",$ro1->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo)) ?></td>
                <td>&nbsp;<? echo $ro1->selectNow("registrationDetails","Company","registrationNo",$registrationNo) ?></td>
                <td>&nbsp;<? echo number_format($ro->patient_with_transaction_total($registrationNo),2) ?></td>
                <td>&nbsp;<? echo number_format($ro->patient_with_transaction_discount($registrationNo),2) ?></td>
                <td>&nbsp;<? echo number_format($ro->patient_with_transaction_balance($registrationNo),2) ?></td>
                <td>&nbsp;<? echo number_format($ro->patient_with_transaction_company($registrationNo),2) ?></td>
                <td>&nbsp;<? echo number_format($ro->patient_with_transaction_cash($registrationNo),2) ?></td>
                <td>&nbsp;<? echo number_format($ro->patient_with_transaction_creditCard($registrationNo),2) ?></td>
            </tr>
          <?php } ?>
          <? }else { } ?>
          <tr>
            <td></td>
            <td><font color=red>Noon Outpatient Total</font></td>
            <td></td>
            <td><? echo number_format($total_noon,2) ?></td>
            <td><? echo number_format($discount_noon,2) ?></td>
            <td><? echo number_format($balance_noon,2) ?></td>
            <td><? echo number_format($card_noon,2) ?></td>
            <td><? echo number_format($cash_noon,2) ?></td>
            <td><? echo number_format($creditCard_noon,2) ?></td>
          </tr>


            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;<b>Inpatient</b></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>


            <? for($a=0,$b=0,$c=0,$d=0,$e=0;$a<$ipdFN_noon,$b<$ipdLN_noon,$c<$ipdPaymentFor_noon,$d<$ipdRegistrationNo_noon,$e<$ipdPaymentNo_noon;$a++,$b++,$c++,$d++,$e++) { ?>
              <tr>
                  <? $ipd_cash_noon += $ro->inpatient_payment_paid($ipd_registrationNo_noon[$d],$ipd_paymentNo_noon[$e],"Cash") ?>
                  <? $ipd_creditCard_noon += $ro->inpatient_payment_paid($ipd_registrationNo_noon[$d],$ipd_paymentNo_noon[$e],"Credit Card"); ?>
                  <? $ipd_discount_noon += $ro1->selectNow("registrationDetails","discount","registrationNo",$ipd_registrationNo_noon[$d]) ?>

                <td></td>
                <td><? echo $ipd_lastName_noon[$b] ?>, <? echo $ipd_firstName_noon[$a] ?></td>
                <td><? echo $paymentFor_noon[$c] ?></td>
                <td><? //echo number_format($ro->patient_with_transaction_total($ipd_registrationNo[$d]),2) ?></td>
                <td>&nbsp;</td>
                <td></td>
                <td><? //echo number_format($ro->patient_with_transaction_company($ipd_registrationNo[$d]),2) ?></td>
                <td><? echo number_format($ro->inpatient_payment_paid($ipd_registrationNo_noon[$d],$ipd_paymentNo_noon[$e],"Cash"),2) ?></td>
                <td><? echo number_format($ro->inpatient_payment_paid($ipd_registrationNo_noon[$d],$ipd_paymentNo_noon[$e],"Credit Card"),2) ?></td>
              </tr> 
            <? } ?>
          </tbody>
          <tbody>
            <tr>
              <td></td>
              <td><font color=red>Noon Inpatient Total</font></td>
              <td></td>
              <td></td>
              <td>&nbsp;</td>
              <td></td>
              <td></td>
              <td><? echo number_format($ipd_cash_noon,2) ?></td>
              <td><? echo number_format($ipd_creditCard_noon,2); ?></td>
            </tr>

            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>


            <tr> 
              <td>&nbsp;</td>
              <td><b>Afternoon</b></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>

            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;<b>Outpatient</b></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>

            <!--afternoon-->
        <? for($a=0,$b=0,$c=0,$d=0,$e=0;$a<$countFN_afternoon,$b<$countLN_afternoon,$c<$countReg_afternoon,$d<$countPXComp_afternoon,$e<$countPX_afternoon;$a++,$b++,$c++,$d++,$e++) { ?>
            <tr>
                <? $total_afternoon += $ro->patient_with_transaction_total($registrationNo_afternoon[$c]) ?>
                <? $discount_afternoon += $ro->patient_with_transaction_discount($registrationNo_afternoon[$c]) ?>
                <? $balance_afternoon += $ro->patient_with_transaction_balance($registrationNo_afternoon[$c]) ?>
                <? $card_afternoon += $ro->patient_with_transaction_company($registrationNo_afternoon[$c]) ?>
                <? $cash_afternoon += $ro->patient_with_transaction_cash($registrationNo_afternoon[$c]) ?>
                <? $creditCard_afternoon += $ro->patient_with_transaction_creditCard($registrationNo_afternoon[$c]) ?>


              <td><? //echo $pxCount[$e]; ?></td>
              <td><? echo $lastName_afternoon[$b].", ".$firstName_afternoon[$a] ?></td>
              <td><? echo $patientCompany_afternoon[$d] ?></td>
              <td><? echo number_format($ro->patient_with_transaction_total($registrationNo_afternoon[$c]),2) ?></td>
              <td><? echo number_format($ro->patient_with_transaction_discount($registrationNo_afternoon[$c]),2) ?></td>
              <td><? echo number_format($ro->patient_with_transaction_balance($registrationNo_afternoon[$c]),2) ?></td>
              <td><? echo number_format($ro->patient_with_transaction_company($registrationNo_afternoon[$c]),2) ?></td>
              <td><? echo number_format($ro->patient_with_transaction_cash($registrationNo_afternoon[$c]),2) ?></td>
              <td><? echo number_format($ro->patient_with_transaction_creditCard($registrationNo_afternoon[$c]),2) ?></td>
            </tr> 
        <?  } ?>

          <? if($ro->patient_with_transaction_hmo_registrationNo() != "") { ?>
          <!---HMO PATIENT-->
          <?php foreach($ro->patient_with_transaction_hmo_registrationNo() as $registrationNo) { ?>
            <tr>
                <? $total_afternoon += $ro->patient_with_transaction_total($registrationNo) ?>
                <? $discount_afternoon += $ro->patient_with_transaction_discount($registrationNo) ?>
                <? $balance_afternoon += $ro->patient_with_transaction_balance($registrationNo) ?>
                <? $card_afternoon += $ro->patient_with_transaction_company($registrationNo) ?>
                <? $cash_afternoon += $ro->patient_with_transaction_cash($registrationNo) ?>
                <? $creditCard_afternoon += $ro->patient_with_transaction_creditCard($registrationNo) ?>
                <td>&nbsp;</td>
                <td>&nbsp;<?php echo $ro1->selectNow("patientRecord","lastName","patientNo",$ro1->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo)) ?>, <?php echo $ro1->selectNow("patientRecord","firstName","patientNo",$ro1->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo)) ?></td>
                <td>&nbsp;<? echo $ro1->selectNow("registrationDetails","Company","registrationNo",$registrationNo) ?></td>
                <td>&nbsp;<? echo number_format($ro->patient_with_transaction_total($registrationNo),2) ?></td>
                <td>&nbsp;<? echo number_format($ro->patient_with_transaction_discount($registrationNo),2) ?></td>
                <td>&nbsp;<? echo number_format($ro->patient_with_transaction_balance($registrationNo),2) ?></td>
                <td>&nbsp;<? echo number_format($ro->patient_with_transaction_company($registrationNo),2) ?></td>
                <td>&nbsp;<? echo number_format($ro->patient_with_transaction_cash($registrationNo),2) ?></td>
                <td>&nbsp;<? echo number_format($ro->patient_with_transaction_creditCard($registrationNo),2) ?></td>
            </tr>
          <?php } ?>
          <? }else{ } ?>
          <tr>
            <td></td>
            <td><font color=red>Afternoon Outpatient Total</font></td>
            <td>&nbsp;</td>
            <td><? echo number_format($total_afternoon,2) ?></td>
            <td><? echo number_format($discount_afternoon,2) ?></td>
            <td><? echo number_format($balance_afternoon,2) ?></td>
            <td><? echo number_format($card_afternoon,2) ?></td>
            <td><? echo number_format($cash_afternoon,2) ?></td>
            <td><? echo number_format($creditCard_afternoon,2) ?></td>
          </tr>


            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;<b>Inpatient</b></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>


          <? for($a=0,$b=0,$c=0,$d=0,$e=0;$a<$ipdFN_afternoon,$b<$ipdLN_afternoon,$c<$ipdPaymentFor_afternoon,$d<$ipdRegistrationNo_afternoon,$e<$ipdPaymentNo_afternoon;$a++,$b++,$c++,$d++,$e++) { ?>
              <tr>
                  <? $ipd_cash_afternoon += $ro->inpatient_payment_paid($ipd_registrationNo_afternoon[$d],$ipd_paymentNo_afternoon[$e],"Cash") ?>
                  <? $ipd_creditCard_afternoon += $ro->inpatient_payment_paid($ipd_registrationNo_afternoon[$d],$ipd_paymentNo_afternoon[$e],"Credit Card"); ?>
                  <? $ipd_discount_afternoon += $ro1->selectNow("registrationDetails","discount","registrationNo",$ipd_registrationNo_afternoon[$d]) ?>

                <td></td>
                <td><? echo $ipd_lastName_afternoon[$b] ?>, <? echo $ipd_firstName_afternoon[$a] ?></td>
                <td><? echo $paymentFor_afternoon[$c] ?></td>
                <td><? //echo number_format($ro->patient_with_transaction_total($ipd_registrationNo[$d]),2) ?></td>
                <td>&nbsp;</td>
                <td></td>
                <td><? //echo number_format($ro->patient_with_transaction_company($ipd_registrationNo[$d]),2) ?></td>
                <td><? echo number_format($ro->inpatient_payment_paid($ipd_registrationNo_afternoon[$d],$ipd_paymentNo_afternoon[$e],"Cash"),2) ?></td>
                <td><? echo number_format($ro->inpatient_payment_paid($ipd_registrationNo_afternoon[$d],$ipd_paymentNo_afternoon[$e],"Credit Card"),2) ?></td>
              </tr> 
            <? } ?>
          </tbody>
          <tbody>
            <tr>
              <td></td>
              <td><font color=red>Afternoon Inpatient Total</font></td>
              <td></td>
              <td></td>
              <td>&nbsp;</td>
              <td></td>
              <td></td>
              <td><? echo number_format($ipd_cash_afternoon,2) ?></td>
              <td><? echo number_format($ipd_creditCard_afternoon,2); ?></td>
            </tr>

            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>

          <!--Night-->
            <tr> 
              <td>&nbsp;</td>
              <td><b>Night</b></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>

            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;<b>Outpatient</b></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>

            <!--Night-->
        <? for($a=0,$b=0,$c=0,$d=0,$e=0;$a<$countFN_night,$b<$countLN_night,$c<$countReg_night,$d<$countPXComp_night,$e<$countPX_night;$a++,$b++,$c++,$d++,$e++) { ?>
            <tr>
                <? $total_night += $ro->patient_with_transaction_total($registrationNo_night[$c]) ?>
                <? $discount_night += $ro->patient_with_transaction_discount($registrationNo_night[$c]) ?>
                <? $balance_night += $ro->patient_with_transaction_balance($registrationNo_night[$c]) ?>
                <? $card_night += $ro->patient_with_transaction_company($registrationNo_night[$c]) ?>
                <? $cash_night += $ro->patient_with_transaction_cash($registrationNo_night[$c]) ?>
                <? $creditCard_night += $ro->patient_with_transaction_creditCard($registrationNo_night[$c]) ?>


              <td><? //echo $pxCount[$e]; ?></td>
              <td><? echo $lastName_night[$b].", ".$firstName_night[$a] ?></td>
              <td><? echo $patientCompany_night[$d] ?></td>
              <td><? echo number_format($ro->patient_with_transaction_total($registrationNo_night[$c]),2) ?></td>
              <td><? echo number_format($ro->patient_with_transaction_discount($registrationNo_night[$c]),2) ?></td>
              <td><? echo number_format($ro->patient_with_transaction_balance($registrationNo_night[$c]),2) ?></td>
              <td><? echo number_format($ro->patient_with_transaction_company($registrationNo_night[$c]),2) ?></td>
              <td><? echo number_format($ro->patient_with_transaction_cash($registrationNo_night[$c]),2) ?></td>
              <td><? echo number_format($ro->patient_with_transaction_creditCard($registrationNo_night[$c]),2) ?></td>
            </tr> 
        <?  } ?>

          <? if($ro->patient_with_transaction_hmo_registrationNo() != "") { ?>
          <!---HMO PATIENT-->
          <?php foreach($ro->patient_with_transaction_hmo_registrationNo() as $registrationNo) { ?>
            <tr>
                <? $total_night += $ro->patient_with_transaction_total($registrationNo) ?>
                <? $discount_night += $ro->patient_with_transaction_discount($registrationNo) ?>
                <? $balance_night += $ro->patient_with_transaction_balance($registrationNo) ?>
                <? $card_night += $ro->patient_with_transaction_company($registrationNo) ?>
                <? $cash_night += $ro->patient_with_transaction_cash($registrationNo) ?>
                <? $creditCard_night += $ro->patient_with_transaction_creditCard($registrationNo) ?>
                <td>&nbsp;</td>
                <td>&nbsp;<?php echo $ro1->selectNow("patientRecord","lastName","patientNo",$ro1->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo)) ?>, <?php echo $ro1->selectNow("patientRecord","firstName","patientNo",$ro1->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo)) ?></td>
                <td>&nbsp;<? echo $ro1->selectNow("registrationDetails","Company","registrationNo",$registrationNo) ?></td>
                <td>&nbsp;<? echo number_format($ro->patient_with_transaction_total($registrationNo),2) ?></td>
                <td>&nbsp;<? echo number_format($ro->patient_with_transaction_discount($registrationNo),2) ?></td>
                <td>&nbsp;<? echo number_format($ro->patient_with_transaction_balance($registrationNo),2) ?></td>
                <td>&nbsp;<? echo number_format($ro->patient_with_transaction_company($registrationNo),2) ?></td>
                <td>&nbsp;<? echo number_format($ro->patient_with_transaction_cash($registrationNo),2) ?></td>
                <td>&nbsp;<? echo number_format($ro->patient_with_transaction_creditCard($registrationNo),2) ?></td>
            </tr>
          <?php } ?>
          <? }else { } ?>

          <tr>
            <td></td>
            <td><font color=red>Night Outpatient Total</font></td>
            <td></td>
            <td><? echo number_format($total_night,2) ?></td>
            <td><? ($discount_night > 0) ? $x = number_format($discount_night,2) : $x = "0.00"; echo $x; ?></td>
            <td><? echo number_format($balance_night,2) ?></td>
            <td><? echo number_format($card_night,2) ?></td>
            <td><? echo number_format($cash_night,2) ?></td>
            <td><? echo number_format($creditCard_night,2) ?></td>
          </tr>

            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;<b>Inpatient</b></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>


          <? for($a=0,$b=0,$c=0,$d=0,$e=0;$a<$ipdFN_night,$b<$ipdLN_night,$c<$ipdPaymentFor_night,$d<$ipdRegistrationNo_night,$e<$ipdPaymentNo_night;$a++,$b++,$c++,$d++,$e++) { ?>
              <tr>
                  <? $ipd_cash_night += $ro->inpatient_payment_paid($ipd_registrationNo_night[$d],$ipd_paymentNo_night[$e],"Cash") ?>
                  <? $ipd_creditCard_night += $ro->inpatient_payment_paid($ipd_registrationNo_night[$d],$ipd_paymentNo_night[$e],"Credit Card"); ?>
                  <? $ipd_discount_night += $ro1->selectNow("registrationDetails","discount","registrationNo",$ipd_registrationNo_night[$d]) ?>

                <td></td>
                <td><? echo $ipd_lastName_night[$b] ?>, <? echo $ipd_firstName_night[$a] ?></td>
                <td><? echo $paymentFor_night[$c] ?></td>
                <td><? //echo number_format($ro->patient_with_transaction_total($ipd_registrationNo[$d]),2) ?></td>
                <td>&nbsp;</td>
                <td></td>
                <td><? //echo number_format($ro->patient_with_transaction_company($ipd_registrationNo[$d]),2) ?></td>
                <td><? echo number_format($ro->inpatient_payment_paid($ipd_registrationNo_night[$d],$ipd_paymentNo_night[$e],"Cash"),2) ?></td>
                <td><? echo number_format($ro->inpatient_payment_paid($ipd_registrationNo_night[$d],$ipd_paymentNo_night[$e],"Credit Card"),2) ?></td>
              </tr> 
            <? } ?>
          </tbody>
          <tbody>
            <tr>
              <td></td>
              <td><font color=red>Night Inpatient Total</font></td>
              <td></td>
              <td></td>
              <td>&nbsp;</td>
              <td></td>
              <td></td>
              <td><? echo number_format($ipd_cash_night,2) ?></td>
              <td><? echo number_format($ipd_creditCard_night,2); ?></td>
            </tr>
      	</tbody>

        <tbody>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </tbody>

        <tbody>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </tbody>

      	<tbody>
      		<tr>
      			<td></td>
      			<td><b>Outpatient Grand Total</b></td>
      			<td></td>
      			<td><? echo number_format(($total_morning + $total_noon + $total_afternoon + $total_night),2) ?></td>
            <td><? echo number_format(($discount_morning + $discount_noon + $discount_afternoon + $discount_night),2) ?></td>
            <td><? echo number_format(($balance_morning + $balance_noon + $balance_afternoon + $balance_night),2) ?></td>
            <td><? echo number_format(($card_morning + $card_noon + $card_afternoon + $card_night),2) ?></td>
            <td><? echo number_format(($cash_morning + $cash_noon + $cash_afternoon + $cash_night),2) ?></td>
            <td><? echo number_format(($creditCard_morning + $creditCard_noon + $creditCard_afternoon + $creditCard_night),2) ?></td>
            <td>&nbsp;</td>
      		</tr>
      	</tbody>
	      	<tbody>	
		      	<!---TOTAL---->
      		</tbody>
      		<tbody>
            <td>&nbsp;</td>
            <td><b>Inpatient Grand Total</b></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;<? echo number_format(($ipd_cash_morning + $ipd_cash_noon + $ipd_cash_afternoon + $ipd_cash_night),2) ?></td>
            <td>&nbsp;<? echo number_format(($ipd_creditCard_morning + $ipd_creditCard_noon + $ipd_creditCard_afternoon + $ipd_creditCard_night),2) ?></td>
      		</tbody>
  </table>
</div>

</body>
</html>


