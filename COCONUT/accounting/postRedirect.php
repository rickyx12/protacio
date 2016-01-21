<?php
    if (isset($_GET['username']))

{

echo "<body>";
echo "<form method='post' id='us' action='chartOfAccounts.php'>";
echo "<input type='hidden' name='username' value=''>";
echo "</form>";
echo "</body>";

?>
<script type="text/javascript">
document.getElementById('us').submit(); // SUBMIT FORM
</script>
<?php 
}
else
{
  // leave the page alone
}



?>
