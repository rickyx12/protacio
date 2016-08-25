<?php
include("../../../myDatabase2.php");
$registrationNo = $_POST['registrationNo'];
$itemNo = $_POST['itemNo'];
$chargesCode = $_POST['chargesCode'];
$username = $_POST['username'];
$date = $_POST['date'];
$result = $_POST['result'];
$remarks = $_POST['remarks'];
$morphology = $_POST['morphology'];

/*
$reagents1 = $_POST['reagents1'];
$reagents2 = $_POST['reagents2'];
$reagents3 = $_POST['reagents3'];
$reagents4 = $_POST['reagents4'];
$reagents5 = $_POST['reagents5'];
*/
//$reagents = $reagents1."-".$reagents2."-".$reagents3."-".$reagents4."-".$reagents5;

$ro = new database2();
FUNCTION ENCRYPT_DECRYPT($Str_Message) {
    $Len_Str_Message=STRLEN($Str_Message);
    $Str_Encrypted_Message="";
    FOR ($Position = 0;$Position<$Len_Str_Message;$Position++){
        // long code of the function to explain the algoritm
        //this function can be tailored by the programmer modifyng the formula
        //to calculate the key to use for every character in the string.
        $Key_To_Use = (($Len_Str_Message+$Position)*230); // (+5 or *3 or ^2)

        //after that we need a module division because can´t be greater than 255
        //$Key_To_Use = (255+$Key_To_Use) % 255;
	$Key_To_Use = (168+$Key_To_Use) % 168;

        $Byte_To_Be_Encrypted = SUBSTR($Str_Message, $Position, 1);
        $Ascii_Num_Byte_To_Encrypt = ORD($Byte_To_Be_Encrypted);
        $Xored_Byte = $Ascii_Num_Byte_To_Encrypt ^ $Key_To_Use;  //xor operation
        $Encrypted_Byte = CHR($Xored_Byte);
        $Str_Encrypted_Message .= $Encrypted_Byte;
       
        //short code of  the function once explained
        //$str_encrypted_message .= chr((ord(substr($str_message, $position, 1))) ^ ((255+(($len_str_message+$position)+1)) % 255));
    }
    RETURN $Str_Encrypted_Message;
}

$patientNo = $ro->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo);
$lastName = $ro->selectNow("patientRecord","lastName","patientNo",$patientNo);
$firstName = $ro->selectNow("patientRecord","firstName","patientNo",$patientNo);
$patientName = $lastName.", ".$firstName;

$ro->addLaboratoryResultChecker($registrationNo,$itemNo);
$ro->addLaboratoryResultInPatient($registrationNo,$itemNo,$chargesCode,$username,$date,ENCRYPT_DECRYPT($result),$ro->getSynapseTime(),$remarks,$morphology,$patientName);
//$ro->useReagents($itemNo,$registrationNo,$reagents1,date("Y-m-d"));
//$ro->useReagents($itemNo,$registrationNo,$reagents2,date("Y-m-d"));
//$ro->useReagents($itemNo,$registrationNo,$reagents3,date("Y-m-d"));
//$ro->useReagents($itemNo,$registrationNo,$reagents4,date("Y-m-d"));
//$ro->useReagents($itemNo,$registrationNo,$reagents5,date("Y-m-d"));


$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Laboratory/resultList/resultForm_output.php?registrationNo=$registrationNo&itemNo=$itemNo");

?>
