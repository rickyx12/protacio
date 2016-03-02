<? include "../../myDatabase4.php"; ?>
<? $ro = new database4(); ?>
<? $ro->companyList(); ?>
<? $company = $ro->companyList_company(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Aging of Accounts</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="/bootstrap-3.3.6/js/bootstrap.min.js"></script>
  <script src="/bootstrap-3.3.6/js/jquery-2.2.1.min.js"></script>
  <script src="/bootstrap-3.3.6/js/bootstrap.js"></script>
  <link rel="stylesheet" href="/bootstrap-3.3.6/css/bootstrap.min.css">
  
<style type="text/css">
.panel {
height: 150px;
width:500px;
}
</style>
  
</head>
<body>


<br><br><br><center>
<div class="container">
<div class="panel panel-info">
<div class="panel-heading">Aging of Accounts</div>
<div class="panel-body">
<br>
<div class="btn-group">
  <button type="button" class="btn btn-info btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Select Company <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
  <li><a href="aging.php">All Company</a></li>
  <? for($x=0;$x<count($company);$x++) { ?>
    <li><a href="agingDetails.php?company=<? echo $company[$x] ?>"><? echo $company[$x] ?></a></li>   
   <? } ?>
  </ul>
</div>
</div>
</div>
</div>
</div>

</body>
</html>

