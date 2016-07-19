<?
include "../myDatabase4.php";
$description = $_POST['description'];
$category = $_POST['category'];
$opdPrice = $_POST['opdPrice'];
$ipdPrice = $_POST['ipdPrice'];
$hmoPrice = $_POST['hmoPrice'];
$specialRates = $_POST['specialRates'];
$discountable = $_POST['discountable'];

$ro4 = new database4();

echo $description;
echo "<br>";
echo $category;
echo "<br>";
echo $opdPrice;
echo "<Br>";
echo $ipdPrice;
echo "<br>";
echo $hmoPrice;
echo "<br>";
echo $specialRates;
echo "<br>";
echo $discountable;

$data = array(

		"Description" => $description,
		"Service" => "Examination",
		"Category" => $category,
		"OPD" => $opdPrice,
		"WARD" => $ipdPrice,
		"SOLOWARD" => $ipdPrice,
		"SEMIPRIVATE" => $ipdPrice,
		"PRIVATE" => $ipdPrice,
		"HMO" => $hmoPrice,
		"ipd_hmo" => $hmoPrice,
		"specialRates" => $specialRates,
		"senior" => $discountable
	);

$ro4->insertNow("availableCharges",$data);

?>