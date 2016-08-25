<?php
include "../../myDatabase.php";
include "../../myDatabase4.php";

$username = $_POST['username'];
$registrationNo = $_POST['registrationNo'];
$itemNo = $_POST['itemNo'];

$parameterz = preg_split ("/\-/", $username); 
//If directory doesnot exists create it.
$output_dir = "../radiology/radioReport/";

$ro = new database();
$ro4 = new database4();

$patientNo = $ro->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo);
$lastName =  $ro->selectNow("patientRecord","lastName","patientNo",$patientNo);
$firstName = $ro->selectNow("patientRecord","firstName","patientNo",$patientNo);
$patientName = $lastName.", ".$firstName;

if(isset($_FILES["myfile"]))
{
	$ret = array();

	$error =$_FILES["myfile"]["error"];
   {
    
    	if(!is_array($_FILES["myfile"]['name'])) //single file
    	{
       	 	$fileName = $_FILES["myfile"]["name"];
          $ext = pathinfo($fileName, PATHINFO_EXTENSION);
          $newFileName = $patientName."_".$registrationNo."_".$itemNo.".".$ext;
       	 	move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$newFileName);
          
          //new file name format: patientName_registrationNo_itemNo
		      $ro4->uploadedFilesInformation($newFileName,"COCONUT/radiology/radioReport/".$newFileName,$username,$itemNo,$registrationNo,$patientName);
       	 	 //echo "<br> Error: ".$_FILES["myfile"]["error"];
       	 	 
	       	 	 $ret[$fileName]= $output_dir.$fileName;
    	}
    	else
    	{
          /*
    	    	$fileCount = count($_FILES["myfile"]['name']);
    		  for($i=0; $i < $fileCount; $i++)
    		  {
    		  	$fileName = $_FILES["myfile"]["name"][$i];
	       	 	 $ret[$fileName]= $output_dir.$fileName;
    		    move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$fileName );
		        $ro->uploadedFilesInformation($_FILES["myfile"]["name"],"COCONUT/radiology/radioReport/".$_FILES["myfile"]["name"],$username,$itemNo,$registrationNo);
    		  }
          */
    	   echo "Single File Only";
    	}
    }
    echo json_encode($ret);
 
}

?>
