<?php
include "../../myDatabase4.php";
$ro = new database4();
$ro->aging_of_accounts();
$company = $ro->aging_of_accounts_companyName();
$counts = count($company);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Aging of Accounts</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://localhost/bootstrap-3.3.6/css/bootstrap.min.css">
  <script src="/bootstrap-3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Aging of Accounts</h2>
  <p>Outpatient</p>            
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Company</th>
	<th>1-30 Days</th>
	<th>31-60 Days</th>
	<th>61-90 Days</th>
	<th>91+ Days</th>
      </tr>
    </thead>
    <tbody>
<?php for($x=0;$x<$counts;$x++) { ?> 
<? $ro->aging_of_accounts_amount($company[$x]) ?>
<? $_30days = $ro->aging_of_accounts_amount_30days(); ?>
<? $_60days = $ro->aging_of_accounts_amount_60days(); ?>
<? $_90days = $ro->aging_of_accounts_amount_90days(); ?>
<? $_120days = $ro->aging_of_accounts_amount_120days(); ?>
      <tr>
<td><?php echo $company[$x]; ?></td>
<td><? echo number_format($_30days,2); ?></td>
<td><? echo number_format($_60days,2); ?></td>
<td><? echo number_format($_90days,2); ?></td>
<td><? echo number_format($_120days,2); ?></td>
      </tr>
<?php } ?>
    </tbody>
  </table>
</div>

</body>
</html>

