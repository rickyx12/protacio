<?
include "myDatabase.php";
include "myDatabase4.php";

$ro = new database();
$ro4 = new database4();

$ro4->endingInventory_updater();
?>

<table border=1>
	<tr>
		<th></th>
		<th>Description</th>
	</tr>
		<form method="get" action="test1.php">
		<? foreach( $ro4->endingInventory_updater_endingNo() as $endingNo ) { ?>
			<? $inventoryCode = $ro->selectNow("endingInventory","inventoryCode","endingNo",$endingNo) ?>
			<? if( $ro->selectNow("inventory","inventoryType","inventoryCode",$inventoryCode) == "medicine" ) { ?>
				<tr>
					<? if( $ro->selectNow("endingInventory","unitcost","inventoryCode",$inventoryCode) < 1 ) { ?>
						<td><input type="checkbox" name="endingNo[]" value="<? echo $endingNo ?>" checked></td>
					<? }else {?>
						<td></td>
					<? } ?>
					<td>
						<? 
							echo $ro->selectNow("inventory","description","inventoryCode",$inventoryCode); 
						?>
					</td>
				</tr>
			<? } ?>
		<? } ?>
		<input type="submit">
		</form>
</table>