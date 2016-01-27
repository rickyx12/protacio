<?php
include("../../storedProcedure.php");
$username = $_POST['username'];
$parameterz = preg_split ("/\-/", $username); 
//If directory doesnot exists create it.
$output_dir = "xXxdicomxXx/";
$ro = new storedProcedure();
if(isset($_FILES["myfile"]))
{
	$ret = array();

	$error =$_FILES["myfile"]["error"];
   {
    
    	if(!is_array($_FILES["myfile"]['name'])) //single file
    	{
       	 	$fileName = $_FILES["myfile"]["name"].$_POST['username'];
       	 	move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir. $_FILES["myfile"]["name"]);
		$ro->uploadedFilesInformation($_FILES["myfile"]["name"],"/COCONUT/uploader/".$output_dir.$_FILES["myfile"]["name"],$parameterz[0],$parameterz[2],$parameterz[1]);
       	 	 //echo "<br> Error: ".$_FILES["myfile"]["error"];
       	 	 
	       	 	 $ret[$fileName]= $output_dir.$fileName;
    	}
    	else
    	{
    	    	$fileCount = count($_FILES["myfile"]['name']);
    		  for($i=0; $i < $fileCount; $i++)
    		  {
    		  	$fileName = $_FILES["myfile"]["name"][$i];
	       	 	 $ret[$fileName]= $output_dir.$fileName;
    		    move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$fileName );
		$ro->uploadedFilesInformation($_FILES["myfile"]["name"],"/COCONUT/uploader/".$output_dir.$_FILES["myfile"]["name"],$username,$itemNo,$registrationNo);
    		  }
    	
    	}
    }
    echo json_encode($ret);
 
}

?>
