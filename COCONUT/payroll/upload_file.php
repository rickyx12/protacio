<?php
include("../../myDatabase.php");
$employeeID = $_POST['employeeID'];
$ro = new database();
$allowedExts = array("gif", "jpeg", "jpg", "png");
$fType = explode(".", $_FILES["file"]["name"]);
$extension = end($fType);
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 20000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
$ro->editNow("registeredUser","employeeID",$employeeID,"photo","/COCONUT/payroll/photo/".$_FILES["file"]["name"]);
    if (file_exists("/opt/lampp/htdocs/COCONUT/payroll/photo/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "/opt/lampp/htdocs/COCONUT/payroll/photo/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "/COCONUT/payroll/photo/" . $_FILES["file"]["name"];
      }
    }
  }
else
  {
  echo "Invalid file";
  }
?> 
