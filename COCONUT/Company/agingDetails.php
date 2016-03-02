<?php
include "../../myDatabase4.php";
$company = $_GET['company'];
$ro = new database4();
$ro->aging_of_accounts_details($company);

$lastName = $ro->aging_of_accounts_details_lastName();
$firstName = $ro->aging_of_accounts_details_firstName();
$registrationNo = $ro->aging_of_accounts_details_registrationNo();
$dateUnregistered = $ro->aging_of_accounts_details_dateUnregistered();


$countLastName = count($lastName);
$countFirstName = count($firstName);
$countRegistrationNo = count($registrationNo);
$countDateUnregistered = count($dateUnregistered);


$_30days = 0;
$_60days = 0;
$_90days = 0;
$_120days = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Aging of Accounts</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/bootstrap-3.3.6/css/bootstrap.min.css">
  <script src="/bootstrap-3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2><?php echo $company; ?></h2>
  <p>Outpatient</p>            
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Patients</th>
	<th>1-30 Days</th>
	<th>31-60 Days</th>
	<th>61-90 Days</th>
	<th>91+ Days</th>
      </tr>
    </thead>
    <tbody>
<? for($a=0,$b=0,$c=0,$d=0;$a<$countLastName,$b<$countFirstName,$c<$countRegistrationNo,$d<$countDateUnregistered;$a++,$b++,$c++,$d++) { ?> 
<? $companyBalance = ($ro->aging_of_accounts_details_amount($registrationNo[$c]) - $ro->aging_of_accounts_details_payment($registrationNo[$c]));  ?>
<tr>
<? if($companyBalance > 0) { ?>

<td><? echo $lastName[$a].", ".$firstName[$b]; ?><br><? echo $ro->formatDate($dateUnregistered[$d]) ?></td>

<? if($ro->calculateDays($dateUnregistered[$d],date("Y-m-d")) <= 30 ) { ?>
<? $_30days += $companyBalance ?>
<td><? echo number_format($companyBalance,2) ?></td>
<? }else { ?>
<td></td>
<? } ?>

<? if($ro->calculateDays($dateUnregistered[$d],date("Y-m-d")) >= 31 && $ro->calculateDays($dateUnregistered[$d],date("Y-m-d")) <= 60 ) { ?>
<? $_60days += $companyBalance ?>
<td><? echo number_format($companyBalance,2) ?></td>
<? }else { ?>
<td></td>
<? } ?>

<? if($ro->calculateDays($dateUnregistered[$d],date("Y-m-d")) >= 61 && $ro->calculateDays($dateUnregistered[$d],date("Y-m-d")) <= 90 ) { ?>
<? $_90days += $companyBalance ?>
<td><? echo number_format($companyBalance,2) ?></td>
<? }else { ?>
<td></td>
<? } ?>

<? if($ro->calculateDays($dateUnregistered[$d],date("Y-m-d")) >= 91 ) { ?>
<? $_120days += $companyBalance ?>
<td><? echo number_format($companyBalance,2) ?></td>
<? }else { ?>
<td></td>
<? } ?>

</tr>
<? }else { /*wag ipkta ang patient kpg wlang company balance*/ } ?>
<? } ?>
<tr>
<td></td>
<td><? echo number_format($_30days,2); ?></td>
<td><? echo number_format($_60days,2); ?></td>
<td><? echo number_format($_90days,2); ?></td>
<td><? echo number_format($_120days,2); ?></td>



</tr>
    </tbody>
  </table>
</div>

</body>
</html>
