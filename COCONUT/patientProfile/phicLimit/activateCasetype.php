<?php
include("../../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$casetype = $_GET['casetype'];

$ro = new database();
$ro->getPHIClimit_setter($casetype);
$ro->getPatientProfile($registrationNo);



echo "PHIC Consumed&nbsp;".number_format($ro->getTotal("phic","MEDICINE",$registrationNo),2); // kunin ang phic n meds
echo "<Br>";
echo "PHIC Limit&nbsp;".$ro->getPHIClimit_medicine(); //allowed Limit ng PHIC pra sa meds
echo "<Br>";

$kunin_ang_sobra = $ro->getTotal("phic","MEDICINE",$registrationNo) - $ro->getPHIClimit_medicine();
$binawas_ang_sobra = $ro->getHighestCharges("MEDICINE","phic",$registrationNo) - $kunin_ang_sobra ;



if( $ro->getTotal("phic","MEDICINE",$registrationNo) > $ro->getPHIClimit_medicine() && ($ro->getPatientRecord_phic() == "YES" || $ro->getPatientRecord_phic() == "yes" ) ) { //ckech kung mas mataas ang credit kaysa sa allowed limit

echo "<br>Sobra&nbsp;".number_format($kunin_ang_sobra,2);
echo "<br>Total:&nbsp;".($ro->getTotal("phic","MEDICINE",$registrationNo) - $kunin_ang_sobra);
echo "<br>Total:&nbsp;".$binawas_ang_sobra;


//bbwasan ang charges n may pnka mataas na selling price.. ang ibbwas ay ang sobra sa allowed limit ng PHIC meds
$ro->editNow("patientCharges","itemNo",$ro->getHighestCharges_itemNo("MEDICINE","phic",$registrationNo),"phic",$binawas_ang_sobra);




if($ro->getRegistrationDetails_company() != "" ) { //ito ung LLipat ang bayad sa hmo

if($ro->getRegistrationDetails_limitHMO() > $ro->getTotal("company","",$registrationNo)) {
echo "hello";
}else {
$ro->editNow("patientCharges","itemNo",$ro->getHighestCharges_itemNo("MEDICINE","phic",$registrationNo),"company",$kunin_ang_sobra);
}

}


/*
else if($ro->getRegistrationDetails_senior() == 'YES' || $ro->getRegistrationDetails_senior() == 'yes') { //pra sa senior disc

$seniorDisc = $ro->getTotal("cashUnpaid","",$registrationNo) * $ro->percentage("senior");
$totalDisc =  $ro->getTotal("cashUnpaid","",$registrationNo) - $seniorDisc;

$ro->editNow("patientCharges","registrationNo",)

}
*/
else  if($ro->getRegistrationDetails_company() == "") { //kung walang hmo sa cash n iLLgay 
$ro->editNow("patientCharges","itemNo",$ro->getHighestCharges_itemNo("MEDICINE","phic",$registrationNo),"cashUnpaid",$kunin_ang_sobra);
}else {

}



}else if($ro->getRegistrationDetails_company() != "" && $ro->getTotal("phic","MEDICINE",$registrationNo) >= $ro->getPHIClimit_medicine()  ) {


//ung bnwas.. idadagdag sa allowed limit ng hmo
$ro->editNow("patientCharges","itemNo",$ro->getHighestCharges_itemNo("MEDICINE","phic",$registrationNo),"company",$kunin_ang_sobra);




}else {

//iLLgay sa cash ung sobra
$ro->editNow("patientCharges","itemNo",$ro->getHighestCharges_itemNo("MEDICINE","phic",$registrationNo),"phic",$binawas_ang_sobra);

//iLLgay sa cash ung sobra
$ro->editNow("patientCharges","itemNo",$ro->getHighestCharges_itemNo("MEDICINE","phic",$registrationNo),"cashUnpaid",$kunin_ang_sobra);
}





echo $ro->getTotal("phic","SUPPLIES",$registrationNo); // kunin ang phic n supplies
echo "<Br>";


?>
