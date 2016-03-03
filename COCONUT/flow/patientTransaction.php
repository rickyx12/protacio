<?
include "../../myDatabase4.php";
$ro = new database4();
$date = $_GET['date'];
$ro->patient_with_transaction($date);
$ro->inpatient_payment($date);
$registrationNo = $ro->patient_with_transaction_registrationNo();
$lastName = $ro->patient_with_transaction_lastName();
$firstName = $ro->patient_with_transaction_firstName();
$patientCompany = $ro->patient_with_transaction_patientCompany();
$pxCount = $ro->patient_with_transaction_pxCount();

$ipd_lastName = $ro->inpatient_payment_lastName();
$ipd_firstName = $ro->inpatient_payment_firstName();
$paymentFor = $ro->inpatient_payment_paymentFor();
$ipd_registrationNo = $ro->inpatient_payment_registrationNo();
$ipd_paymentNo = $ro->inpatient_payment_paymentno();

$countReg = count($registrationNo);
$countFN = count($firstName);
$countLN = count($lastName);
$countPXComp = count($patientCompany);
$countPX = count($pxCount);

$ipdFN = count($ipd_firstName);
$ipdLN = count($ipd_lastName);
$ipdPaymentFor = count($paymentFor);
$ipdRegistrationNo = count($ipd_registrationNo);
$ipdPaymentNo = count($ipd_paymentNo);

$total = 0;
$balance = 0;
$card = 0;
$cash = 0;
$creditCard = 0;

$ipd_cash = 0;
$ipd_creditCard = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Daily Transaction</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://localhost/bootstrap-3.3.6/css/bootstrap.min.css">
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
        		<th>Balance</th>
        		<th>HMO</th>
        		<th>Cash</th>
        		<th>Cr.Card</th>
      		</tr>
    	</thead>
    	<tbody>
    		
    		<? for($a=0,$b=0,$c=0,$d=0,$e=0;$a<$countFN,$b<$countLN,$c<$countReg,$d<$countPXComp,$e<$countPX;$a++,$b++,$c++,$d++,$e++) { ?>
    				<tr>
    						<? $total += $ro->patient_with_transaction_total($registrationNo[$c]) ?>
    						<? $balance += $ro->patient_with_transaction_balance($registrationNo[$c]) ?>
    						<? $card += $ro->patient_with_transaction_company($registrationNo[$c]) ?>
    						<? $cash += $ro->patient_with_transaction_cash($registrationNo[$c]) ?>
    						<? $creditCard += $ro->patient_with_transaction_creditCard($registrationNo[$c]) ?>

    					<td><? //echo $pxCount[$e]; ?></td>
    					<td><? echo $lastName[$b].", ".$firstName[$a] ?></td>
    					<td><? echo $patientCompany[$d] ?></td>
    					<td><? echo number_format($ro->patient_with_transaction_total($registrationNo[$c]),2) ?></td>
    					<td><? echo number_format($ro->patient_with_transaction_balance($registrationNo[$c]),2) ?></td>
    					<td><? echo number_format($ro->patient_with_transaction_company($registrationNo[$c]),2) ?></td>
    					<td><? echo number_format($ro->patient_with_transaction_cash($registrationNo[$c]),2) ?></td>
    					<td><? echo number_format($ro->patient_with_transaction_creditCard($registrationNo[$c]),2) ?></td>
    				</tr>	
    		<?  } ?>
      	
      	</tbody>
      	<tbody>
      		<tr>
      			<td></td>
      			<td>Total</td>
      			<td></td>
      			<td><? echo number_format($total,2) ?></td>
      			<td><? echo number_format($balance,2) ?></td>
      			<td><? echo number_format($card,2) ?></td>
      			<td><? echo number_format($cash,2) ?></td>
      			<td><? echo number_format($creditCard,2) ?></td>
      		</tr>
      	</tbody>
	      	<tbody>	
		      	<? for($a=0,$b=0,$c=0,$d=0,$e=0;$a<$ipdFN,$b<$ipdLN,$c<$ipdPaymentFor,$d<$ipdRegistrationNo,$e<$ipdPaymentNo;$a++,$b++,$c++,$d++,$e++) { ?>
		      		<tr>
		      				<? $ipd_cash += $ro->inpatient_payment_paid($ipd_registrationNo[$d],"Cash") ?>
		      				<? $ipd_creditCard += $ro->inpatient_payment_paid($ipd_registrationNo[$d],"Credit Card"); ?>
		      			<td></td>
      					<td><? echo $ipd_lastName[$b] ?>, <? echo $ipd_firstName[$a] ?></td>
      					<td><? echo $paymentFor[$c] ?></td>
      					<td><? //echo number_format($ro->patient_with_transaction_total($ipd_registrationNo[$d]),2) ?></td>
      					<td></td>
      					<td><? //echo number_format($ro->patient_with_transaction_company($ipd_registrationNo[$d]),2) ?></td>
      					<td><? echo number_format($ro->inpatient_payment_paid($ipd_registrationNo[$d],$ipd_paymentNo[$e],"Cash"),2) ?></td>
      					<td><? echo number_format($ro->inpatient_payment_paid($ipd_registrationNo[$d],$ipd_paymentNo[$e],"Credit Card"),2) ?></td>
      				</tr>	
		      	<? } ?>
      		</tbody>
      		<tbody>
      			<tr>
      				<td></td>
      				<td>Total</td>
      				<td></td>
      				<td></td>
      				<td></td>
      				<td></td>
      				<td><? echo number_format($ipd_cash,2) ?></td>
      				<td><? echo number_format($ipd_creditCard,2); ?></td>
      			</tr>
      		</tbody>
      		<tbody>
      			<tr>
      				<td></td>
      				<td>Grand Total</td>
      				<td></td>
      				<td></td>
      				<td></td>
      				<td></td>
      				<td> <? echo number_format($cash + $ipd_cash,2) ?></td>
      				<td><? echo number_format($creditCard + $ipd_creditCard,2) ?></td>
      			</tr>
      		</tbody>
  </table>
</div>

</body>
</html>


