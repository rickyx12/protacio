<?php


class database  {


///database credentials
public $host;
public $username;
public $password;
public $database;

public function __construct() {
  $this->host = $_SERVER['DB_HOST'];
  $this->username = $_SERVER['DB_USER'];
  $this->password = $_SERVER['DB_PASS'];
  $this->database = $_SERVER['DB_DB'];
}

public function myHost(){
return $this->host;
}

public function getUser(){
return $this->username;
}

public function getPass(){
return $this->password;
}

public function getDB(){
return $this->database;
}

public function getMyUrl() {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT ipaddress FROM ipaddress ");

while($row = mysqli_fetch_array($result))
  {
return $row['ipaddress'];
  }

}


function ENCRYPT_DECRYPT($Str_Message) {
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

public function getSynapseModule() {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM module where status = 'on' order by name asc ");

while($row = mysqli_fetch_array($result))
  {
if($row['name'] == "REGISTRATION") {
echo "<li><a href='http://".$this->getMyUrl()."/COCONUT/opdRegistration.php?module=$row[name]'>".$row['name']."</a></li>";
}else if($row['name'] == "NURSING") {
echo "<li><a href='http://".$this->getMyUrl()."/COCONUT/NURSING/nursingPage.php?module=$row[name]'>".$row['name']."</a></li>";
}else if($row['name'] == "REQUESTITION" ) {
echo "<li><a href='http://".$this->getMyUrl()."/COCONUT/requestition/batchRequest/requestLogin.php?module=$row[name]'>".$row['name']."</a></li>";
}else {
echo "<li><a href='http://".$this->getMyUrl()."/LOGINPAGE/loginpage.php?module=$row[name]'>".$row['name']."</a></li>";
}

 }

}




public $UserName,$UserPassword,$UserModule;

public function getUserName() {
return $this->UserName;
}
public function getUserPassword() {
return $this->UserPassword;
}
public function getUserModule() {
return $this->UserModule;
}


public function LogIn($username,$password,$module) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($module == "DOCTOR") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT username,password,module FROM Doctors where username = '$username' and password='$password' and module = '$module' ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT username,password,module FROM registeredUser where username = '$username' and password='$password' and module = '$module' ");
}

while($row = mysqli_fetch_array($result))
  {
$this->UserName = $row['username'];
$this->UserPassword = $row['password'];
$this->UserModule = $row['module'];

  }

}


public $deletePass_username;
public $deletePass_password;

public function deletePass_username() {
return $this->deletePass_username;
}
public function deletePass_password() {
return $this->deletePass_password;
}

public function deletePass($username,$password) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT username,password FROM registeredUser where username = '$username' and password='$password' ");


while($row = mysqli_fetch_array($result))
  {
$this->deletePass_username = $row['username'];
$this->deletePass_password = $row['password'];

  }

}

/****ggwa ng div ***/
public function coconutBoxStart($width,$height) {
echo "<center><br><div style='border:1px solid #000000; width:".$width."; height:".$height.";'>";
}

public function coconutBoxStart_red($width,$height) {
echo "<center><br><div style='border:1px solid #ff0000; width:".$width."; height:".$height.";'>";
}


public function coconutBoxStop() {
echo "</div>";
}
/********end ng div**********/



/*********ggwa ng form**********/
public function coconutFormStart($method,$action) {
echo "<form method='$method' action='$action'>";
}

public function coconutFormStop() {
echo "</form>";
}

public function coconutButton($value) {
echo "<input type=submit value='".$value."' style='border:1px solid #000; background-color:#3b5998; color:white'>";
}
/**********stop form*********/


/***********ggwacoconutComboBox ng comboBox****************/
public function coconutComboBoxStart_long($name) {
echo "<select name='$name' class='comboBox'>";
}
public function coconutComboBoxStart_short($name) {
echo "<select name='$name' class='comboBoxShort'>";
}
public function coconutComboBoxStop() {
echo "</select>";
}
/**************end ng comboBox******************/


public function coconutDesign() {
echo '<link rel="stylesheet" type="text/css" href="http://'.$this->getMyUrl().'/COCONUT/myCSS/coconutCSS.css" />';
}



/************ggwa ng breadcrumb**2 modules away**********************/
public function coconutHeading($module,$home) {
echo '<link rel="stylesheet" type="text/css" href="http://'.$this->getMyUrl().'/COCONUT/flow/rickyCSS1.css" />';
echo '
<script type="text/javascript">
$("#breadcrumbs a").hover(
    function () {
        $(this).addClass("hover").children().addClass("hover");
        $(this).parent().prev().find("span.arrow:first").addClass("pre_hover");
    },
    function () {
        $(this).removeClass("hover").children().removeClass("hover");
        $(this).parent().prev().find("span.arrow:first").removeClass("pre_hover");
    }
);
</script>

';
echo '
<ol id="breadcrumbs">
        <li><a href="http://'.$this->getMyUrl().'/'.$home.'"><font color=white>Home</font><span class="arrow"></span></a></li>
        <li><a href="#" class="odd"><font color=yellow>'.$module.'</font><span class="arrow"></span></a></li>

    <li>&nbsp;&nbsp;</li>
</ol>
';
}
/*******************end ng breadcrumb******************************/


/*******************start ng upper menu****************************************/
public function coconutUpperMenuStart() {

echo '<script type="text/javascript" src="http://'.$this->getMyUrl().'/Registration/menu/jquery-1.4.2.min.js"></script>';
echo '<script type="text/javascript" src="http://'.$this->getMyUrl().'/Registration/menu/jquery.fixedMenu.js"></script>';
echo '<link rel="stylesheet" type="text/css" href="http://'.$this->getMyUrl().'/Registration/menu/fixedMenu_style1.css" />';

echo '<script type="text/javascript">

        $("document").ready(function(){
            $(".menu").fixedMenu();

        });
</script>';
echo '<div class="menu"><ul>';
}


public function coconutUpperMenuStop() {
echo "</ul></div>";
}

public function coconutUpperMenu_headingStart($x) {
echo "<li>
<a href='#'>$x<span class='arrow'></span></a>
<ul>";
}

public function coconutUpperMenu_headingStop() {
echo "</ul></li>";
}

public function coconutUpperMenu_headingMenu($page_na_pupuntahan,$label) {
echo '<li><a href='.$page_na_pupuntahan.'>'.$label.'</a></li>';
}

public function coconutUpperMenu_headingMenu_target($page_na_pupuntahan,$label,$target) {
echo '<li><a href='.$page_na_pupuntahan.' target='.$target.'>'.$label.'</a></li>';
}

public function coconutUpperMenu_headingMenu_return($page_na_pupuntahan,$label) {
return '<li><a href='.$page_na_pupuntahan.'>'.$label.'</a></li>';
}
/**************end ng upper menu*****************************************/


public function coconutHidden($name,$value) {
echo "<input type=hidden name='$name' value='$value'>";
}
public function coconutTextBox($name,$value) {
echo "<input type=text name='$name' id='$name' value='$value' class='txtBox' autocomplete='off'>";
}

public function coconutTextBox_short($name,$value) {
echo "<input type=text name='$name' id='$name' value='$value' class='shortField' autocomplete='off'>";
}
public function coconutTextBox_short_readonly($name,$value) {
echo "<input type=text name='$name' id='$name' value='$value' class='shortField' readonly autocomplete='off'>";
}
public function coconutTextBox_readonly($name,$value) {
echo "<input type=text name='$name' value='$value' readonly class='txtBox'>";
}

public function coconutTextBox_return($name,$value) {
return "<input type=text name='$name' value='$value' class='txtBox' autocomplete='off'>";
}

public function coconutPasswordBox_return($name,$value) {
return "<input type=password name='$name' value='$value' class='txtBox'>";
}


public function coconutText($value) {
return "<font class='labelz'>$value</font>";
}
public function gotoPage($page) {
echo "<script type='text/javascript'>
window.location='$page';
</script>";
}

public function getBack($text) {
echo "<script type='text/javascript'>
alert('$text');
history.back(-1);
</script>";
}
public function coconutAjax($updateTime,$updatingPage) {

echo " 
 <html>
<head>
<script type='text/javascript'>
function RefreshTable()
{
if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
}
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById('tablediv').innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open('GET','$updatingPage',true);
xmlhttp.send();

window.setTimeout(function(){ RefreshTable()},".$updateTime.");
}

</script>
</head>
<body onload=RefreshTable()>
    <div id=tablediv></div>
</body>
</html>";

}


public function coconutFrame($page,$width,$height) {
echo '<iframe src="'.$page.'" width="'.$width.'" height="'.$height.'" name="departmentX" border=1 frameborder=no></iframe>';
}

public function coconutFrame_target($page,$width,$height,$target) {
echo '<iframe src="'.$page.'" width="'.$width.'" height="'.$height.'" name="'.$target.'" border=1 frameborder=no></iframe>';
}

public function coconutImages($image) {
echo "<img src='http://".$this->getMyUrl()."/COCONUT/myImages/$image'>";
}

public function coconutImages_return($image) {
return "<img src='http://".$this->getMyUrl()."/COCONUT/myImages/$image'>";
}

/***************ggwa ng table*********************/
public function coconutTableStart() {
echo "<Table border=1 cellpadding=0 rules=all cellspacing=0>";
}
public function coconutTableStop() {
echo "</table>";
}
public function coconutTableRowStart() {
echo "<tr>";
}
public function coconutTableRowStop() {
echo "</tr>";
}
public function coconutTableHeader($value) {
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>".$value."</font>&nbsp;</th>";
}
public function coconutTableData($value) {
echo "<Td>&nbsp;$value&nbsp;</tD>";
}
/**************end ng table*********************************/


/********************SEARCH onProgess****************************************/
public function coconutSearchPatient($username,$search) {
echo '<script type="text/javascript" src="http://'.$this->getMyUrl().'/jquery.js"></script>';
echo '<script type="text/javascript" src="http://'.$this->getMyUrl().'/jquery.autocomplete.js"></script>';
echo '<link rel="stylesheet" type="text/css" href="http://'.$this->getMyUrl().'/jquery.autocomplete.css" />';

echo "<script type='text/javascript'>";
echo '
	$().ready(function() {
	    $("#patientSearch").autocomplete("'.$search.'", {
	        width: 260,
	        matchContains: true,
	        selectFirst: false
                
	    }).result(function(event, data, formatted) {

window.location="http://'.$this->getMyUrl().'/COCONUT/currentPatient/patientInterface.php?completeName="+data+"&username='.$username.' "; 

 });
;
	});

';

echo "
var patient = 'Search Patient';
function SetMsg (txt,active) {
    if (txt == null) return;
    
 
    if (active) {
        if (txt.value == patient) txt.value = '';                     
    } else {
        if (txt.value == '') txt.value = patient;
    }
}

window.onload=function() { SetMsg(document.getElementById('patientSearch', false)); }

";
echo "</script>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type=text id='patientSearch' style='   
	background:#FFFFFF url(http://".$this->getMyUrl()."/COCONUT/myImages/search.jpeg) no-repeat 4px 4px;
	padding:4px 4px 4px 22px;
	border:1px solid #CCCCCC;
	width:400px;
	height:25px;' class='txtBox'
	onfocus='SetMsg(this, true);'
    	onblur='SetMsg(this,false);'
	value='Search Patient'
>";


}
/********************************************************/
public function getDoctorName($username,$module) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT Name FROM Doctors where username = '$username' and module = '$module' ");


while($row = mysqli_fetch_array($result))
  {
return $row['Name'];

  }

}



public function categoryService($category) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT Service FROM Services where Category = '$category' order by Service asc ");

while($row = mysqli_fetch_array($result))
  {
echo "<option value='".$row['Service']."'>".$row['Service']."</option>";
  }

}


public function getReportOfUser($module) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT username FROM registeredUser where module='$module' order by username asc ");

while($row = mysqli_fetch_array($result))
  {
echo "<option value='".$row['username']."'>".$row['username']."</option>";
  }

}



//OPTION FOR BRANCH
public function getBranch() {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT branch FROM branch order by branch asc ");

while($row = mysqli_fetch_array($result))
  {
echo "<option value='".$row['branch']."'>".$row['branch']."</option>";
  }

}


public function getCategory() {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT Category FROM Category order by Category asc ");

while($row = mysqli_fetch_array($result))
  {
echo "<option value='".$row['Category']."'>".$row['Category']."</option>";
  }

}


public function addNewCharges($description,$examination,$category,$opd,$ward,$soloward,$semiprivate,$private,$username,$subCategory,$hmo,$senior,$specialRates) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO availableCharges (Description,Service,Category,OPD,WARD,SOLOWARD,SEMIPRIVATE,PRIVATE,subCategory,HMO,senior,specialRates,ipd_hmo)
VALUES
('$description','$examination','$category','$opd','$ward','$soloward','$semiprivate','$private','$subCategory','$hmo','$senior','$specialRates','$ward')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

echo "<script type='text/javascript' >";
echo "alert('$description was Successfully Added to the List of Charges in $category');";
echo  "window.location='http://".$this->getMyUrl()."/Maintenance/addCharges.php?module=$category&username=$username '";
echo "</script>";



((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


public function requestNow($inventoryCode,$stockCardNo,$description,$quantity,$requestTo_department,$requestTo_branch,$requestingDepartment,$requestingBranch,$requestingUser,$dateRequested,$timeRequested,$status,$batchNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO inventoryManager (inventoryCode,stockCardNo,description,quantity,requestTo_department,requestTo_branch,requestingDepartment,requestingBranch,requestingUser,dateRequested,timeRequested,status,batchNo)
VALUES
('$inventoryCode','$stockCardNo','$description','$quantity','$requestTo_department','$requestTo_branch','$requestingDepartment','$requestingBranch','$requestingUser','$dateRequested','$timeRequested','$status','$batchNo')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

$this->gotoPage("http://".$this->getMyUrl()."/COCONUT/availableMedicine/medicineRequest.php?branch=$requestTo_branch&inventoryType=".$this->selectNow("inventory","inventoryType","inventoryCode",$inventoryCode)."&username=$requestingUser&requestingDepartment=$requestingDepartment&requestNo=$batchNo");

}


public function addNewService($service,$category,$username) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO Services (Service,Category)
VALUES
('$service','$category')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

echo "<script type='text/javascript' >";
echo "alert('$service was Successfully Added to the List of Service in $category');";
echo  "window.location='http://".$this->getMyUrl()."/Maintenance/addService.php?username=$username'";
echo "</script>";
((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}





public function addNewPatientRecord($patientNo,$manual_patientID,$lastName,$firstName,$middleName,$completeName,$age,$patientContact,$birthDate,$gender,$senior,$address,$phic,$civilStatus,$religion,$email) {

  $con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
  if (!$con) {
    die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

  ((bool)mysqli_query( $con, "USE " . $this->database));

  $sql="INSERT INTO patientRecord (patientNo,manual_patientNo,lastName,firstName,middleName,completeName,Birthdate,Age,Gender,Senior,Address,contactNo,PHIC,religion,civilStatus,email)
  VALUES
  ('$patientNo','$manual_patientID','$lastName','$firstName','$middleName','$completeName','$birthDate','$age','$gender','$senior','$address','$patientContact','$phic','$religion','$civilStatus','$email')";

  if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }
  /*
  echo "<script type='text/javascript' >";
  echo "alert('$service was Successfully Added to the List of Service in $category');";
  echo  "window.location='http://".$this->getMyUrl()."/Maintenance/addService.php '";
  echo "</script>";
  */
  ((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);
}


//ITO UNG MAG IINSERT SA DATABASE FOR EVERY REGISTRATION EVENT OCCUR
public function addNewRegistration($patientNo,$registrationNo,$manual_patientID,$manual_caseno,$bloodPressure,$temperature,$height,$weight,$company,$initialDiagnosis,$dateRegistered,$timeRegistered,$branch,$type,$room,$username,$casetype,$limit,$control_dateRegistered,$diet,$pulse,$respiratory,$from,$pxCount) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO registrationDetails (patientNo,registrationNo,manual_patientNo,manual_registrationNo,bloodPressure,temperature,height,weight,Company,initialDiagnosis,dateRegistered,timeRegistered,branch,type,room,PIN,registeredBy,privateORhouse_case,LimitCASH,control_dateRegistered,diet,pulseRate,respiratoryRate,registeredFrom,pxCount)
VALUES
('$patientNo','$registrationNo','$manual_patientID','$manual_caseno','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $bloodPressure) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $temperature) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $height) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $weight) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','$company','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $initialDiagnosis) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','$dateRegistered','$timeRegistered','$branch','$type','$room','00-000000000-0','$username','$casetype','$limit','$control_dateRegistered','$diet','$pulse','$respiratory','$from','$pxCount')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }
/*
echo "<script type='text/javascript' >";
echo "alert('$service was Successfully Added to the List of Service in $category');";
echo  "window.location='http://".$this->getMyUrl()."/Maintenance/addService.php '";
echo "</script>";
*/
((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);


}


public function addCompany($companyName,$address,$rate1,$rate2,$rate3,$rate4) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO Company (companyName,companyAddress,rate1,rate2,rate3,rate4)
VALUES
('$companyName','$address','$rate1','$rate2','$rate3','$rate4')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }
/*
echo "<script type='text/javascript' >";
echo "alert('$service was Successfully Added to the List of Service in $category');";
echo  "window.location='http://".$this->getMyUrl()."/Maintenance/addService.php '";
echo "</script>";
*/
((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);


}



public function addICD($icdCode,$rvsCode,$diagnosis,$group,$caserate,$pf,$hospital,$username) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO availableICD (icdCode,rvsCode,diagnosis,groupz,caserate,pf,hospital)
VALUES
('$icdCode','$rvsCode','$diagnosis','$group','$caserate','$pf','$hospital')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

echo "<script type='text/javascript' >";
echo "alert('$icdCode was Successfully Added to the List of ICD Code wtih a Diagnosis of $diagnosis');";
echo  "window.location='http://".$this->getMyUrl()."/COCONUT/philhealth/icdCode/addICD.php?username=$username ';";
echo "</script>";

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);


}


public function addICD2patient($icdCode,$rvsCode,$diagnosis,$username,$registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO patientICD (registrationNo,icdCode,rvsCode,diagnosis)
VALUES
('$registrationNo','$icdCode','$rvsCode','$diagnosis')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

echo "<script type='text/javascript' >";
echo "alert('$icdCode was Successfully Added to the Patient ');";
echo  "window.location='http://".$this->getMyUrl()."/COCONUT/maintenance/searchICDcode.php?username=$username&registrationNo=$registrationNo&protoType=patient&show=search ';";
echo "</script>";

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);


}


public function showAllSpecialization() {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT Specialization FROM DoctorSpecialization order by Specialization asc ");

while($row = mysqli_fetch_array($result))
  {
echo "<option value='".$row['Specialization']."'>".$row['Specialization']."</option>";
  }

}


public function getServices($Category) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT Service FROM Services WHERE Category = '$Category' order by Service asc ");

while($row = mysqli_fetch_array($result))
  {
echo "<option value='".$row['Service']."'>".$row['Service']."</option>";
  }

}


public function getDoctorServices() {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT serviceName FROM DoctorService group by serviceName order by serviceName asc ");

while($row = mysqli_fetch_array($result))
  {
echo "<option value='".$row['serviceName']."'>".$row['serviceName']."</option>";
  }

}



public function getAllCompany() {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT companyName FROM Company order by companyName asc ");

while($row = mysqli_fetch_array($result))
  {
echo "<option value='".$row['companyName']."'>".$row['companyName']."</option>";
  }

}


//ITO UNG MGGING UNIQUE ID NG EVERY PATIENT RECORD
public function getPatientID() {
$myFile = $this->getReportInformation("homeRoot")."/COCONUT/trackingNo/patientID.dat";
$fh = fopen($myFile, 'r');
$theData = fread($fh, 1000);
fclose($fh);

    

$myFile = $this->getReportInformation("homeRoot")."/COCONUT/trackingNo/patientID.dat";
$fh = fopen($myFile, 'w') or die("can't open file"); 
fwrite($fh, $theData+1);
fclose($fh);
}


//ITO UNG MGGING REGISTRATION NUMBER NG OPD PRA SA PAG TRACKING IT SERVE AS UNIQUE IN EVERY REGISTRATION
public function getRegistrationNo() {
$myFile = $this->getReportInformation("homeRoot")."/COCONUT/trackingNo/registrationNo.dat";
$fh = fopen($myFile, 'r');
$theData = fread($fh, 1000);
fclose($fh);

    

$myFile = $this->getReportInformation("homeRoot")."/COCONUT/trackingNo/registrationNo.dat";
$fh = fopen($myFile, 'w') or die("can't open file"); 
fwrite($fh, $theData+1);
fclose($fh);
}




public function getDispensedNo() {
$myFile = $this->getReportInformation("homeRoot")."/COCONUT/trackingNo/dispensedNo.dat";
$fh = fopen($myFile, 'r');
$theData = fread($fh, 1000);
fclose($fh);

    

$myFile = $this->getReportInformation("homeRoot")."/COCONUT/trackingNo/dispensedNo.dat";
$fh = fopen($myFile, 'w') or die("can't open file"); 
fwrite($fh, $theData+1);
fclose($fh);
}


public function getRequestNo() {
$myFile = $this->getReportInformation("homeRoot")."/COCONUT/trackingNo/requestNo.dat";
$fh = fopen($myFile, 'r');
$theData = fread($fh, 1000);
fclose($fh);

    

$myFile = $this->getReportInformation("homeRoot")."/COCONUT/trackingNo/requestNo.dat";
$fh = fopen($myFile, 'w') or die("can't open file"); 
fwrite($fh, $theData+1);
fclose($fh);
}

public function getTrackingLabNo() {
$myFile = $this->getReportInformation("homeRoot")."/COCONUT/trackingNo/labNo.dat";
$fh = fopen($myFile, 'r');
$theData = fread($fh, 1000);
fclose($fh);

    

$myFile = $this->getReportInformation("homeRoot")."/COCONUT/trackingNo/labNo.dat";
$fh = fopen($myFile, 'w') or die("can't open file"); 
fwrite($fh, $theData+1);
fclose($fh);
}


public function getBatchNo() {
$myFile = $this->getReportInformation("homeRoot")."/COCONUT/trackingNo/batchNo.dat";
$fh = fopen($myFile, 'r');
$theData = fread($fh, 1000);
fclose($fh);

    

$myFile = $this->getReportInformation("homeRoot")."/COCONUT/trackingNo/batchNo.dat";
$fh = fopen($myFile, 'w') or die("can't open file"); 
fwrite($fh, $theData+1);
fclose($fh);
}


public function getInventoryStockCardNo() {
$myFile = $this->getReportInformation("homeRoot")."/COCONUT/trackingNo/stockCardNo.dat";
$fh = fopen($myFile, 'r');
$theData = fread($fh, 1000);
fclose($fh);

    

$myFile = $this->getReportInformation("homeRoot")."/COCONUT/trackingNo/stockCardNo.dat";
$fh = fopen($myFile, 'w') or die("can't open file"); 
fwrite($fh, $theData+1);
fclose($fh);
}


public function getDisbursementNo() {
$myFile = $this->getReportInformation("homeRoot")."/COCONUT/trackingNo/disbursementNo.dat";
$fh = fopen($myFile, 'r');
$theData = fread($fh, 1000);
fclose($fh);

    

$myFile = $this->getReportInformation("homeRoot")."/COCONUT/trackingNo/disbursementNo.dat";
$fh = fopen($myFile, 'w') or die("can't open file"); 
fwrite($fh, $theData+1);
fclose($fh);
}


public function getVouchersNo() {
$myFile = $this->getReportInformation("homeRoot")."/COCONUT/trackingNo/voucherNo.dat";
$fh = fopen($myFile, 'r');
$theData = fread($fh, 1000);
fclose($fh);

    

$myFile = $this->getReportInformation("homeRoot")."/COCONUT/trackingNo/voucherNo.dat";
$fh = fopen($myFile, 'w') or die("can't open file"); 
fwrite($fh, $theData+1);
fclose($fh);
}





private $userRegistrar;
private $userRegistered;
private $userEmployeeID;


public function getUserRegistrar() {
return $this->userRegistrar;
}

public function getUserRegistered() {
return $this->userRegistered;
}

public function getUserRegistrarEmployeeID() {
return $this->userEmployeeID;
}

public function getAuthorizedRegistrar($password) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT employeeID,username,module FROM registeredUser where password='$password' ");

while($row = mysqli_fetch_array($result))
  {
$this->userRegistrar = $row['module'];
$this->userRegistered = $row['username'];
$this->userEmployeeID = $row['employeeID'];
  }

}


public function setVerificationNo($verificationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO verificationCode (verificationNo)
VALUES
('$verificationNo')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }
/*
echo "<script type='text/javascript' >";
echo "alert('$service was Successfully Added to the List of Service in $category');";
echo  "window.location='http://".$this->getMyUrl()."/Maintenance/addService.php '";
echo "</script>";
*/
((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


public $registrationDetails_patientNo;
public $registrationDetails_registrationNo;
public $registrationDetails_bloodPressure;
public $registrationDetails_temperature;
public $registrationDetails_height;
public $registrationDetails_weight;
public $registrationDetails_company;
public $registrationDetails_initialDiagnosis;
public $registrationDetails_finalDiagnosis;
public $registrationDetails_dateRegistered;
public $registrationDetails_dateUnregistered;
public $registrationDetails_timeRegistered;
public $registrationDetails_timeUnregistered;
public $registrationDetails_branch;
public $registrationDetails_type;
public $registrationDetails_room;
public $registrationDetails_PIN;
public $registrationDetails_registeredBy;
public $registrationDetails_caseType;
public $registratiobDetails_limitHMO;
public $registrationDetails_limitCASH;
public $registrationDetails_discount;
public $registrationDetails_IxDx;
public $registrationDetails_package;
public $registrationDetails_pulse;
public $registrationDetails_respiratory;


public $patientRecord_completeName;
public $patientRecord_lastName;
public $patientRecord_firstName;
public $patientRecord_middleName;
public $patientRecord_Birthdate;
public $patientRecord_age;
public $patientRecord_gender;
public $patientRecord_senior;
public $patientRecord_address;
public $patientRecord_contactNo;
public $patientRecord_phic;
public $patientRecord_phicType;
public $patientRecord_civilStatus;


public function getRegistrationDetails_patientNo() {
return $this->registrationDetails_patientNo;
}
public function getRegistrationDetails_registrationNo() {
return $this->registrationDetails_registrationNo;
}
public function getRegistrationDetails_bloodPressure() {
return $this->registrationDetails_bloodPressure;
}
public function getRegistrationDetails_temperature() {
return $this->registrationDetails_temperature;
}
public function getRegistrationDetails_height() {
return $this->registrationDetails_height;
}
public function getRegistrationDetails_weight() {
return $this->registrationDetails_weight;
}
public function getRegistrationDetails_company() {
return $this->registrationDetails_company;
}
public function getRegistrationDetails_initialDiagnosis() {
return $this->registrationDetails_initialDiagnosis;
}
public function getRegistrationDetails_finalDiagnosis() {
return $this->registrationDetails_finalDiagnosis;
}
public function getRegistrationDetails_dateRegistered() {
return $this->registrationDetails_dateRegistered;
}
public function getRegistrationDetails_timeRegistered() {
return $this->registrationDetails_timeRegistered;
}

public function getRegistrationDetails_dateUnregistered() {
return $this->registrationDetails_dateUnregistered;
}

public function getRegistrationDetails_timeUnregistered() {
return $this->registrationDetails_timeUnregistered;
}

public function getRegistrationDetails_branch() {
return $this->registrationDetails_branch;
}

public function getRegistrationDetails_type() {
return $this->registrationDetails_type;
}

public function getRegistrationDetails_room() {
return $this->registrationDetails_room;
}

public function getRegistrationDetails_PIN() {
return $this->registrationDetails_PIN;
}

public function getRegistrationDetails_registeredBy() {
return $this->registrationDetails_registeredBy;
}

public function getRegistrationDetails_caseType() {
return $this->registrationDetails_caseType;
}

public function getRegistrationDetails_limitHMO() {
return $this->registrationDetails_limitHMO;
}

public function getRegistrationDetails_limitCASH() {
return $this->registrationDetails_limitCASH;
}

public function getRegistrationDetails_discount() {
return $this->registrationDetails_discount;
}

public function getRegistrationDetails_IxDx() {
return $this->registrationDetails_IxDx;
}

public function getRegistrationDetails_package() {
return $this->registrationDetails_package;
}

public function getRegistrationDetails_pulse() {
return $this->registrationDetails_pulse;
}

public function getRegistrationDetails_respiratory() {
return $this->registrationDetails_respiratory;
}


public function getPatientRecord_completeName() {
return $this->patientRecord_completeName;
}

public function getPatientRecord_lastName() {
return $this->patientRecord_lastName;
}

public function getPatientRecord_firstName() {
return $this->patientRecord_firstName;
}

public function getPatientRecord_middleName() {
return $this->patientRecord_middleName;
}

public function getPatientRecord_Birthdate() {
return $this->patientRecord_Birthdate;
}
public function getPatientRecord_age() {
return $this->patientRecord_age;
}
public function getPatientRecord_gender() {
return $this->patientRecord_gender;
}
public function getPatientRecord_senior() {
return $this->patientRecord_senior;
}
public function getPatientRecord_address() {
return $this->patientRecord_address;
}
public function getPatientRecord_contactNo() {
return $this->patientRecord_contactNo;
}
public function getPatientRecord_phic() {
return $this->patientRecord_phic;
}
public function getPatientRecord_phicType() {
return $this->patientRecord_phicType;
}
public function getPatientRecord_civilStatus() {
return $this->patientRecord_civilStatus;
}



public function getPatientProfile($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pr.religion,rd.package,rd.IxDx,rd.discount,rd.registeredBy,rd.PIN,rd.dateUnregistered,rd.timeUnregistered,upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,upper(pr.middleName) as middleName,rd.patientNo,rd.registrationNo,rd.bloodPressure,rd.temperature,rd.height,rd.weight,rd.Company,rd.initialDiagnosis,rd.finalDiagnosis,rd.dateRegistered,rd.timeRegistered,upper(pr.completeName) as completeName,pr.Birthdate,pr.Age,pr.Gender,upper(pr.senior) as senior,pr.Address,pr.contactNo,upper(pr.PHIC) as PHIC,pr.civilStatus,rd.branch,rd.room,rd.type,rd.casetype,rd.LimitCASH,rd.LimitHMO,rd.pulseRate,rd.respiratoryRate FROM registrationDetails rd,patientRecord pr where rd.patientNo = pr.patientNo and rd.registrationNo='$registrationNo' ");

while($row = mysqli_fetch_array($result))
  {
$this->registrationDetails_patientNo = $row['patientNo'];
$this->registrationDetails_registrationNo = $row['registrationNo'];
$this->registrationDetails_bloodPressure = $row['bloodPressure'];
$this->registrationDetails_temperature = $row['temperature'];
$this->registrationDetails_height = $row['height'];
$this->registrationDetails_weight = $row['weight'];
$this->registrationDetails_company = $row['Company'];
$this->registrationDetails_initialDiagnosis = $row['initialDiagnosis'];
$this->registrationDetails_finalDiagnosis = $row['finalDiagnosis'];
$this->registrationDetails_dateRegistered = $row['dateRegistered'];
$this->registrationDetails_timeRegistered = $row['timeRegistered'];
$this->registrationDetails_dateUnregistered = $row['dateUnregistered'];
$this->registrationDetails_timeUnregistered = $row['timeUnregistered'];
$this->registrationDetails_branch = $row['branch'];
$this->registrationDetails_type = $row['type'];
$this->registrationDetails_room = $row['room'];
$this->registrationDetails_PIN = $row['PIN'];
$this->registrationDetails_registeredBy = $row['registeredBy'];
$this->registrationDetails_caseType = $row['casetype'];
$this->registrationDetails_limitHMO = $row['LimitHMO'];
$this->registrationDetails_limitCASH = $row['LimitCASH'];
$this->registrationDetails_discount = $row['discount'];
$this->registrationDetails_IxDx = $row['IxDx'];
$this->registrationDetails_package = $row['package'];
$this->registrationDetails_pulse = $row['pulseRate'];
$this->registrationDetails_respiratory = $row['respiratoryRate'];

$this->patientRecord_completeName = $row['completeName'];
$this->patientRecord_lastName = $row['lastName'];
$this->patientRecord_firstName = $row['firstName'];
$this->patientRecord_middleName = $row['middleName'];
$this->patientRecord_Birthdate = $row['Birthdate'];
$this->patientRecord_age = $row['Age'];
$this->patientRecord_gender = $row['Gender'];
$this->patientRecord_senior = $row['senior'];
$this->patientRecord_address = $row['Address'];
$this->patientRecord_contactNo = $row['contactNo'];
$this->patientRecord_phic = $row['PHIC'];
$this->patientRecord_civilStatus = $row['civilStatus'];
$this->patientRecord_phicType = $row['religion'];

  }


}



public function getAvailableCharges($charges,$registrationNo,$batchNo,$serverTime,$username,$room) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$this->getPatientProfile($registrationNo);

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

/*
$room = preg_split ("/\_/", $room); 
if($room[1] == "ER" || $room[1] == "OR/DR" || $room[1] == "SUITE") {
$room[1] = $this->getReportInformation("anotherPrice");
}
*/

$this->getPatientProfile($registrationNo);
if( $this->getRegistrationDetails_type() == "IPD" ) {
  if( $this->getRegistrationDetails_company() != "" ) {
  	if($this->getRegistrationDetails_company() == "INTELLICARE" || $this->getRegistrationDetails_company() == "AVEGA Managed Care, Inc.") {
  		$room1 = "specialRates";
  	}else {
  		$room1 = "HMO";
  	}
  }else {
    $room1 = $this->selectNow("room","type","Description",$this->selectNow("registrationDetails","room","registrationNo",$registrationNo));
  }

}else {

  if( $this->getRegistrationDetails_company() != "" ) {
    if( $this->getRegistrationDetails_company() == "INTELLICARE" || $this->getRegistrationDetails_company() == "AVEGA Managed Care, Inc." ) {
     $room1 = "specialRates";
    }else if( $this->selectNow("Company","type","companyName",$this->getRegistrationDetails_company()) == "company" ) {
      $room1 = "OPD";
    }else {
      $room1 = "HMO";
    }
  }else {
   $room1 = "OPD";
  }

}
if( $charges == "all" || $charges == "All" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT Category,chargesCode,upper(Description) as Description,(".$room1.") as sellingPrice,Service,Category FROM availableCharges where 1=1 order by description asc ");
}else if( $charges == "laboratory" || $charges == "lab"  ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT Category,chargesCode,upper(Description) as Description,(".$room1.") as sellingPrice,Service,Category FROM availableCharges where 1=1 and Category = 'LABORATORY' order by description asc ");
}else if( $charges == "radiology" || $charges == "xray"  ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT Category,chargesCode,upper(Description) as Description,(".$room1.") as sellingPrice,Service,Category FROM availableCharges where 1=1 and Category = 'XRAY' order by description asc ");
}else if( $charges == "radiology" || $charges == "utz"  ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT Category,chargesCode,upper(Description) as Description,(".$room1.") as sellingPrice,Service,Category FROM availableCharges where 1=1 and Category = 'ULTRASOUND' order by description asc ");
}
else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT Category,chargesCode,upper(Description) as Description,(".$room1.") as sellingPrice,Service,Category FROM availableCharges where Description like '".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $charges) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."%%%%%%%' ");
}

echo "&nbsp;  <table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo  "<th bgcolor='#3b5998'>&nbsp;<font color=white><b>Description</b></font>&nbsp;</th>";
echo  "<th bgcolor='#3b5998'>&nbsp;<font color=white><b>Price</font></b>&nbsp;</th>";
echo  "<th bgcolor='#3b5998'>&nbsp;<font color=white><b>Paid Via</font></b>&nbsp;</th>";
echo "</tr>";

while($row = mysqli_fetch_array($result))
  {
$this->getPatientProfile($registrationNo);
echo "<tr>";
echo "<td>&nbsp;".$row['Description']."&nbsp;</td>";

//pra sa mga charges n wlang special rates
if($row['sellingPrice'] > 0) {
$sellingPrice = $row['sellingPrice'];
}else{
if($this->getRegistrationDetails_company() != "") { //kpg ung charges wlang special rate pero may hmo ilabas ung ipd price as default price
$sellingPrice = $this->selectNow("availableCharges","WARD","chargesCode",$row['chargesCode']);
}else {
  //kpg wlang hmo ilabas ung OPD price
$sellingPrice = $this->selectNow("availableCharges","OPD","chargesCode",$row['chargesCode']);
}
}

echo "<td>&nbsp;<a href='#'>".number_format(trim($sellingPrice),2)."</a>&nbsp;</td>";

echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/balanceAmount.php?status=UNPAID&registrationNo=$registrationNo&chargesCode=$row[chargesCode]&description=$row[Description]&sellingPrice=$sellingPrice&discount=0&timeCharge=$serverTime&chargeBy=$username&service=$row[Service]&title=$row[Category]&paidVia=Cash&cashPaid=0.00&batchNo=$batchNo&username=$username&quantity=1&inventoryFrom=none&paycash=no&remarks=&stockCardNo='><font color=blue>Add</font></a>&nbsp;";


if($this->selectNow("registeredUser","module","username",$username) == "PHARMACY" || $this->selectNow("registeredUser","module","username",$username) == "BILLING" || $this->selectNow("registeredUser","module","username",$username) == "CASHIER") {

$this->getPatientProfile($registrationNo);

echo "|&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/availableCharges/addCharges.php?status=UNPAID&registrationNo=$registrationNo&chargesCode=$row[chargesCode]&description=$row[Description]&sellingPrice=$row[sellingPrice]&discount=0&timeCharge=$serverTime&chargeBy=$username&service=Examination&title=$row[Category]&paidVia=Cash&cashPaid=0.00&batchNo=$batchNo&username=$username&quantity=1&inventoryFrom=none&room=OPD_OPD&paycash=yes&remarks='><font color=red>Pay Cash</font></a>&nbsp;";


echo "|&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/availableCharges/chargesWithDate_redirect.php?status=UNPAID&registrationNo=$registrationNo&chargesCode=$row[chargesCode]&description=$row[Description]&sellingPrice=$sellingPrice&discount=0&timeCharge=$serverTime&chargeBy=$username&service=$row[Service]&title=$row[Category]&paidVia=Cash&cashPaid=0.00&batchNo=$batchNo&username=$username&quantity=1&inventoryFrom=none&paycash=no&remarks=&url=/COCONUT/availableCharges/addCharges_date1.php&stockCardNo='><font size=2 color=brown>Add w/ Date</font></a>&nbsp;";

}else {
echo "";
}
/*
$discount =$row['sellingPrice'] * $this->percentage("senior");
if($this->getPatientRecord_senior() == "YES") {
echo "|&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/availableCharges/addCharges.php?status=UNPAID&registrationNo=$registrationNo&chargesCode=$row[chargesCode]&description=$row[Description]&sellingPrice=$row[sellingPrice]&discount=$discount&timeCharge=$serverTime&chargeBy=$username&service=Examination&title=$row[Category]&paidVia=Cash&cashPaid=0.00&batchNo=$batchNo&username=$username&quantity=1&inventoryFrom=none&room=".$room[0]."_".$room[1]."'><font color=darkgreen>Senior Disc</font></a>&nbsp;";
}else {
echo "";
}
*/

echo "</td>";
echo "</tr>";



  
}

}





public function getAvailableDoctor($name,$registrationNo,$batchNo,$serverTime,$username) {



echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT doctorCode,Name FROM Doctors where Name like '$name%%%%%' group by Name ");

echo "&nbsp;  <table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo  "<th bgcolor='#3b5998'>&nbsp;<font color=white><b>Doctor</b></font>&nbsp;</th>";
echo  "<th bgcolor='#3b5998'>&nbsp;</th>";
echo "</tr>";

while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;".$row['Name']."&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Doctor/selectService.php?status=UNPAID&registrationNo=$registrationNo&chargesCode=$row[doctorCode]&description=$row[Name]&sellingPrice=&timeCharge=$serverTime&chargeBy=$username&title=PROFESSIONAL FEE&paidVia=Cash&cashPaid=0.00&batchNo=$batchNo&username=$username&quantity=1&inventoryFrom=none&discount=0&room=&remarks=&paycash=no&url=/COCONUT/availableCharges/addCharges.php'><font color=blue>Add</font></a>&nbsp;";

echo "|&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Doctor/selectService.php?status=UNPAID&registrationNo=$registrationNo&chargesCode=$row[doctorCode]&description=$row[Name]&sellingPrice=&timeCharge=$serverTime&chargeBy=$username&title=PROFESSIONAL FEE&paidVia=Cash&cashPaid=0.00&batchNo=$batchNo&username=$username&quantity=1&inventoryFrom=none&discount=0&room=&remarks=&paycash=no&url=/COCONUT/availableCharges/addCharges_date.php'><font color=brown size=2>Add w/ Date</font></a>&nbsp;";

$this->getPatientProfile($registrationNo);
/*
if($this->getRegistrationDetails_company() != "") {
echo "|&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Doctor/selectService.php?status=APPROVED&registrationNo=$registrationNo&chargesCode=$row[doctorCode]&description=$row[Name]&sellingPrice=&timeCharge=$serverTime&chargeBy=$username&title=PROFESSIONAL FEE&paidVia=Company&cashPaid=0.00&batchNo=$batchNo&username=$username&quantity=1&inventoryFrom=none&discount=0&room='><font color=red>Company</font></a>&nbsp;";
}else {
echo "";
}


if($this->getPatientRecord_senior() == "YES") {
echo "|&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Doctor/selectService.php?status=UNPAID&registrationNo=$registrationNo&chargesCode=$row[doctorCode]&description=$row[Name]&sellingPrice=&timeCharge=$serverTime&chargeBy=$username&title=PROFESSIONAL FEE&paidVia=Cash&cashPaid=0.00&batchNo=$batchNo&username=$username&quantity=1&inventoryFrom=none&discount=Senior&room='><font color=darkgreen>Senior Disc</font></a>&nbsp;";
}else {
echo "";
}
*/
echo "<td></td>";  
}

}




public function deletePatientCharges($registrationNo,$itemNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM patientCharges WHERE registrationNo='$registrationNo' and itemNo='$itemNo'");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}

public function deletePatientCharges_batch($registrationNo,$batchNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM patientCharges WHERE registrationNo='$registrationNo' and batchNo='$batchNo'");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function deleteNow($table,$identifier,$data) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM $table WHERE $identifier='$data' ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}

public function deleteRoom($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM patientCharges WHERE title ='Room And Board' and registrationNo='$registrationNo' ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function transactionPatient($registrationNo,$itemNo,$chargesCode,$name,$amount,$time,$date,$username,$status) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "INSERT INTO transactionPatient (registrationNo,itemNo,chargesCode,patientName,amount,time,date,chargeBy,status) VALUES ('$registrationNo','$itemNo','$chargesCode','$name','$amount','$time','$date','$username','$status');";
 

if ( $sql->query($query) ) {
    echo "A new entry has been added with the `id`";
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();

}



public function addCharges_cash_noInventory($status,$registrationNo,$chargesCode,$description,$sellingPrice,$discount,$total,$cashUnpaid,$phic,$company,$timeCharge,$dateCharge,$chargeBy,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$branch,$room) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO patientCharges (status,registrationNo,chargesCode,description,sellingPrice,discount,total,cashUnpaid,phic,company,timeCharge,dateCharge,chargeBy,
service,title,paidVia,cashPaid,batchNo,quantity,inventoryFrom,branch,control_dateCharge,control_datePaid,departmentStatus)
VALUES
('$status','$registrationNo','$chargesCode','$description','$sellingPrice','$discount','$total','$cashUnpaid','$phic','$company',
'$timeCharge','$dateCharge','$chargeBy','$service','".strip_tags($title)."','$paidVia','$cashPaid','$batchNo','$quantity','$inventoryFrom','$branch','".date("Y-m-d")."','','dispensedBy_".$chargeBy."')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }


if($title == "LABORATORY" || $title == "ULTRASOUND" || $title == "XRAY") { 

echo "
<script type='text/javascript'>
window.location='http://".$this->getMyUrl()."/COCONUT/availableCharges/searchCharges.php?registrationNo=$registrationNo&username=$chargeBy&batchNo=$batchNo';
</script>";


}else if($title == "MEDICINE") {
//$this->getPatientProfile($registrationNo);
//$this->transactionPatient($registrationNo,$chargesCode,$this->getPatientRecord_lastName().", ".$this->getPatientRecord_firstName(),$cashUnpaid,$this->getSynapseTime(),date("M_d_Y"),$chargeBy,"");

echo "
<script type='text/javascript'>
window.location='http://".$this->getMyUrl()."/COCONUT/availableMedicine/searchMedicine.php?registrationNo=$registrationNo&username=$chargeBy&inventoryFrom=$inventoryFrom&room=$room&batchNo=$batchNo';
</script>";

}else if($title == "SUPPLIES") {

echo "
<script type='text/javascript'>
window.location='http://".$this->getMyUrl()."/COCONUT/availableSupplies/searchSupplies.php?registrationNo=$registrationNo&username=$chargeBy&inventoryFrom=$inventoryFrom&room=$room&batchNo=$batchNo';
</script>";

}

else if($title == "PROFESSIONAL FEE") {
echo "
<script type='text/javascript'>
window.location='http://".$this->getMyUrl()."/COCONUT/Doctor/searchDoctor.php?registrationNo=$registrationNo&username=$chargeBy&room=$room&batchNo=$batchNo';
</script>";
}

else {
echo "";
}
((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}




//Start Add Syringe For Injectables
public function addCharges_cash_injectables($status,$registrationNo,$chargesCode,$description,$sellingPrice,$discount,$total,$cashUnpaid,$phic,$company,$timeCharge,$dateCharge,$chargeBy,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$branch,$room,$remarks,$docSpecialization) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($remarks=='VAT'){$vatable=((($sellingPrice*$quantity)/1.12)*0.12);}else{$vatable='';}

$sql="INSERT INTO patientCharges (status,registrationNo,chargesCode,description,sellingPrice,discount,total,cashUnpaid,phic,company,timeCharge,dateCharge,chargeBy,
service,title,paidVia,cashPaid,batchNo,quantity,inventoryFrom,branch,control_dateCharge,control_datePaid,remarks,doctorSpecialization,vat)
VALUES
('$status','$registrationNo','$chargesCode','$description','$sellingPrice','$discount','$total','$cashUnpaid','$phic','$company',
'$timeCharge','$dateCharge','$chargeBy','$service','".strip_tags($title)."','$paidVia','$cashPaid','$batchNo','$quantity','$inventoryFrom','$branch','".date("Y-m-d")."','','$remarks','$docSpecialization','$vatable')";

if (!mysqli_query($con, $sql)){die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));}

echo "
<script type='text/javascript'>
window.location='http://".$this->getMyUrl()."/COCONUT/availableCharges/searchCharges.php?registrationNo=$registrationNo&username=$chargeBy&batchNo=$batchNo';
</script>";

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}
//End Add Syringe For Injectables





public function addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$discount,$total,$cashUnpaid,$phic,$company,$timeCharge,$dateCharge,$chargeBy,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$branch,$room,$remarks,$docSpecialization,$Capital,$stockCardNo,$dispenseFlag,$dispenseQTY) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($remarks=='VAT'){$vatable=((($sellingPrice*$quantity)/1.12)*0.12);}else{$vatable='';}

$sql="INSERT INTO patientCharges (status,registrationNo,chargesCode,description,sellingPrice,discount,total,cashUnpaid,phic,company,timeCharge,dateCharge,chargeBy,
service,title,paidVia,cashPaid,batchNo,quantity,inventoryFrom,branch,control_dateCharge,control_datePaid,remarks,doctorSpecialization,vat,dermaCapital,stockCardNo,dispenseFlag,dispenseQTY)
VALUES
('$status','$registrationNo','$chargesCode','$description','$sellingPrice','$discount','$total','$cashUnpaid','$phic','$company',
'$timeCharge','$dateCharge','$chargeBy','$service','".strip_tags($title)."','$paidVia','$cashPaid','$batchNo','$quantity','$inventoryFrom','$branch','".date("Y-m-d")."','','$remarks','$docSpecialization','$vatable','$Capital','$stockCardNo','$dispenseFlag','$dispenseQTY')";


/*
if($title=="LABORATORY"){
$patientNo=$this->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo);
$lastName=$this->selectNow("patientRecord","lastName","patientNo",$patientNo);
$firstName=$this->selectNow("patientRecord","firstName","patientNo",$patientNo);
$middleName=$this->selectNow("patientRecord","middleName","patientNo",$patientNo);
$Birthdate=$this->selectNow("patientRecord","Birthdate","patientNo",$patientNo);
$gender=$this->selectNow("patientRecord","gender","patientNo",$patientNo);

$birthDatefmt=date("m/d/Y", strtotime($Birthdate));
$birthDate = explode("/", $birthDatefmt);
$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y")-$birthDate[2])-1):(date("Y")-$birthDate[2]));

$sql2=mysql_query("SELECT itemNo FROM patientCharges ORDER BY itemNo");
while($sql2fetch=mysql_fetch_array($sql2)){$num=$sql2fetch['itemNo'];}
$itemNo=$num+1;

$pdate=date("YmdHis");
$text="$patientNo|$lastName $firstName $middleName|$age|$gender|".date("Ymd",strtotime($Birthdate))."|$itemNo|$chargesCode|$description|";
$myfile=fopen("../../GeneratedTextFiles/$itemNo.txt","w") or die("Unable to open file!");
fwrite($myfile,$text);
fclose($myfile);

chmod("../../GeneratedTextFiles/$itemNo.txt",0777);
}
*/
if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }


if($title == "LABORATORY" || $title == "ULTRASOUND" || $title == "XRAY" || $title == "RADIOLOGY") { 


echo "
<script type='text/javascript'>
window.location='http://".$this->getMyUrl()."/COCONUT/availableCharges/searchCharges.php?registrationNo=$registrationNo&username=$chargeBy&batchNo=$batchNo';
</script>";


}else if($title == "MEDICINE") {
//$this->getPatientProfile($registrationNo);
//$this->transactionPatient($registrationNo,$chargesCode,$this->getPatientRecord_lastName().", ".$this->getPatientRecord_firstName(),$cashUnpaid,$this->getSynapseTime(),date("M_d_Y"),$chargeBy,"");


echo "
<script type='text/javascript'>
window.location='http://".$this->getMyUrl()."/COCONUT/availableMedicine/searchMedicine.php?registrationNo=$registrationNo&username=$chargeBy&inventoryFrom=$inventoryFrom&room=$room&batchNo=$batchNo';
</script>";



}else if($title == "SUPPLIES") {

echo "
<script type='text/javascript'>
window.location='http://".$this->getMyUrl()."/COCONUT/availableSupplies/searchSupplies.php?registrationNo=$registrationNo&username=$chargeBy&inventoryFrom=$inventoryFrom&room=$room&batchNo=$batchNo';
</script>";

}

else if($title == "PROFESSIONAL FEE") {
echo "
<script type='text/javascript'>
window.location='http://".$this->getMyUrl()."/COCONUT/Doctor/searchDoctor.php?registrationNo=$registrationNo&username=$chargeBy&room=$room&batchNo=$batchNo';
</script>";
}else if($title == "DERMA") {

echo "
<script type='text/javascript'>
window.location='http://".$this->getMyUrl()."/COCONUT/dermaCharges/?registrationNo=$registrationNo&username=$chargeBy&inventoryFrom=$inventoryFrom&room=$room&batchNo=$batchNo';
</script>";

}

else {
echo "";
}
((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}




public function addCharges_return($stockCardNo,$status,$registrationNo,$chargesCode,$description,$sellingPrice,$discount,$total,$cashUnpaid,$phic,$company,$timeCharge,$dateCharge,$chargeBy,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$branch,$remarks,$dispensedBy,$itemNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO patientCharges (stockCardNo,status,registrationNo,chargesCode,description,sellingPrice,discount,total,cashUnpaid,phic,company,timeCharge,dateCharge,chargeBy,
service,title,paidVia,cashPaid,batchNo,quantity,inventoryFrom,branch,control_dateCharge,control_datePaid,departmentStatus,remarks,returnFlag,from_itemNo)
VALUES
('$stockCardNo','$status','$registrationNo','$chargesCode','$description','$sellingPrice','$discount','$total','$cashUnpaid','$phic','$company',
'$timeCharge','$dateCharge','$chargeBy','$service','".strip_tags($title)."','$paidVia','$cashPaid','$batchNo','$quantity','$inventoryFrom','$branch','".date("Y-m-d")."','','$dispensedBy','$remarks','return','$itemNo')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


/*
//USING MySQLi
public function addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$discount,$total,$cashUnpaid,$phic,$company,$timeCharge,$dateCharge,$chargeBy,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$branch,$room) {


$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
$query = "INSERT INTO patientCharges (itemNo,status,registrationNo,chargesCode,description,sellingPrice,discount,total,cashUnpaid,phic,company,timeCharge,dateCharge,chargeBy,
service,title,paidVia,cashPaid,batchNo,quantity,inventoryFrom,branch,control_dateCharge,control_datePaid) VALUES (NULL,'$status','$registrationNo','$chargesCode','$description','$sellingPrice','$discount','$total','$cashUnpaid','$phic','$company',
'$timeCharge','$dateCharge','$chargeBy','$service','$title','$paidVia','$cashPaid','$batchNo','$quantity','$inventoryFrom','$branch','".date("Y-m-d")."','');";
 
/*
if ( $sql->query($query) ) {
    echo "A new entry has been added with the `id` of {$sql->insert_id}.";
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 */

/*


if($title == "LABORATORY" || $title == "RADIOLOGY") { 

echo "
<script type='text/javascript'>
window.location='http://".$this->getMyUrl()."/COCONUT/availableCharges/searchCharges.php?registrationNo=$registrationNo&username=$chargeBy&room=$room&batchNo=$batchNo';
</script>";


}else if($title == "MEDICINE") {
$this->getPatientProfile($registrationNo);
$this->transactionPatient($registrationNo,$sql->insert_id,$chargesCode,$this->getPatientRecord_lastName().", ".$this->getPatientRecord_firstName(),$cashUnpaid,$this->getSynapseTime(),date("M_d_Y"),$chargeBy,"");

echo "
<script type='text/javascript'>
window.location='http://".$this->getMyUrl()."/COCONUT/availableMedicine/searchMedicine.php?registrationNo=$registrationNo&username=$chargeBy&inventoryFrom=$inventoryFrom&room=$room&batchNo=$batchNo';
</script>";

}else if($title == "SUPPLIES") {
$this->getPatientProfile($registrationNo);
$this->transactionPatient($registrationNo,$sql->insert_id,$chargesCode,$this->getPatientRecord_lastName().", ".$this->getPatientRecord_firstName(),$cashUnpaid,$this->getSynapseTime(),date("M_d_Y"),$chargeBy,"");


echo "
<script type='text/javascript'>
window.location='http://".$this->getMyUrl()."/COCONUT/availableSupplies/searchSupplies.php?registrationNo=$registrationNo&username=$chargeBy&inventoryFrom=$inventoryFrom&room=$room&batchNo=$batchNo';
</script>";

}

else if($title == "PROFESSIONAL FEE") {
echo "
<script type='text/javascript'>
window.location='http://".$this->getMyUrl()."/COCONUT/Doctor/searchDoctor.php?registrationNo=$registrationNo&username=$chargeBy&room=$room&batchNo=$batchNo';
</script>";
}

else {
echo "";
}
$sql->close();
}
*/

public function addCharges_cash_registration($status,$registrationNo,$chargesCode,$description,$sellingPrice,$discount,$total,$cashUnpaid,$phic,$company,$timeCharge,$dateCharge,$chargeBy,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$branch,$room) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO patientCharges (status,registrationNo,chargesCode,description,sellingPrice,discount,total,cashUnpaid,phic,company,timeCharge,dateCharge,chargeBy,
service,title,paidVia,cashPaid,batchNo,quantity,inventoryFrom,branch,control_dateCharge,control_datePaid)
VALUES
('$status','$registrationNo','$chargesCode','$description','$sellingPrice','$discount','$total','$cashUnpaid','$phic','$company',
'$timeCharge','$dateCharge','$chargeBy','$service','$title','$paidVia','$cashPaid','$batchNo','$quantity','$inventoryFrom','$branch','".date("Y-m-d")."','')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }
((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}




//End Add Syringe for Injectable-Auto Dispense
public function addCharges_cash_autoDispense_injectables($status,$registrationNo,$chargesCode,$description,$sellingPrice,$discount,$total,$cashUnpaid,$phic,$company,$timeCharge,$dateCharge,$chargeBy,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$branch,$room,$deptStatus,$deptStatus_time,$status2,$qty2,$registrationNo2,$chargesCode2,$description2,$sellingPrice2,$month2,$day2,$year2,$timeCharge2,$chargeBy2,$service2,$title2,$paidVia2,$cashPaid2,$batchNo2,$username2,$discount2,$inventoryFrom2,$room2,$paycash2,$remarks2) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO patientCharges (status,registrationNo,chargesCode,description,sellingPrice,discount,total,cashUnpaid,phic,company,timeCharge,dateCharge,chargeBy,
service,title,paidVia,cashPaid,batchNo,quantity,inventoryFrom,branch,departmentStatus,departmentStatus_time,control_dateCharge)
VALUES
('$status','$registrationNo','$chargesCode','$description','$sellingPrice','$discount','$total','$cashUnpaid','$phic','$company',
'$timeCharge','$dateCharge','$chargeBy','$service','$title','$paidVia','$cashPaid','$batchNo','$quantity','$inventoryFrom','$branch','$deptStatus','$deptStatus_time','".date("Y-m-d")."')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }


echo "
<script type='text/javascript'>
window.location='http://".$this->getMyUrl()."/COCONUT/availableMedicine/addCharges_cash.php?status=$status2&quantity=$qty2&registrationNo=$registrationNo2&chargesCode=$chargesCode2&description=$description2&sellingPrice=$sellingPrice2&month=$month2&day=$day2&year=$year2&timeCharge=$timeCharge2&chargeBy=$chargeBy2&service=$service2&title=$title2&paidVia=$paidVia2&cashPaid=$cashPaid2&batchNo=$batchNo2&username=$username2&discount=$discount2&inventoryFrom=$inventoryFrom2&room=$room2&paycash=$paycash2&remarks=$remarks2';
</script>";

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}
//End Add Syringe for Injectable-Auto Dispense





public function addCharges_cash_autoDispense($status,$registrationNo,$chargesCode,$description,$sellingPrice,$discount,$total,$cashUnpaid,$phic,$company,$timeCharge,$dateCharge,$chargeBy,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$branch,$room,$deptStatus,$deptStatus_time,$stockCardNo,$dispenseFlag,$dispenseQTY) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO patientCharges (status,registrationNo,chargesCode,description,sellingPrice,discount,total,cashUnpaid,phic,company,timeCharge,dateCharge,chargeBy,
service,title,paidVia,cashPaid,batchNo,quantity,inventoryFrom,branch,departmentStatus,departmentStatus_time,control_dateCharge,stockCardNo,dispenseFlag,dispenseQTY)
VALUES
('$status','$registrationNo','$chargesCode','$description','$sellingPrice','$discount','$total','$cashUnpaid','$phic','$company',
'$timeCharge','$dateCharge','$chargeBy','$service','$title','$paidVia','$cashPaid','$batchNo','$quantity','$inventoryFrom','$branch','$deptStatus','$deptStatus_time','".date("Y-m-d")."','$stockCardNo','$dispenseFlag','$dispenseQTY')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }


if($title == "LABORATORY" || $title == "RADIOLOGY") { 
echo "
<script type='text/javascript'>
window.location='http://".$this->getMyUrl()."/COCONUT/availableCharges/searchCharges.php?registrationNo=$registrationNo&username=$chargeBy&room=$room&batchNo=$batchNo';
</script>";
}else if($title == "MEDICINE") {


echo "
<script type='text/javascript'>
window.location='http://".$this->getMyUrl()."/COCONUT/availableMedicine/searchMedicine.php?registrationNo=$registrationNo&username=$chargeBy&inventoryFrom=$inventoryFrom&room=$room&batchNo=$batchNo';
</script>";

}else if($title == "SUPPLIES") {

echo "
<script type='text/javascript'>
window.location='http://".$this->getMyUrl()."/COCONUT/availableSupplies/searchSupplies.php?registrationNo=$registrationNo&username=$chargeBy&inventoryFrom=$inventoryFrom&room=$room&batchNo=$batchNo';
</script>";

}

else if($title == "PROFESSIONAL FEE") {
echo "
<script type='text/javascript'>
window.location='http://".$this->getMyUrl()."/COCONUT/Doctor/searchDoctor.php?registrationNo=$registrationNo&username=$chargeBy&room=$room&batchNo=$batchNo';
</script>";
}

else {
echo "";
}
((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function addCharges_magicPackage($status,$registrationNo,$chargesCode,$description,$sellingPrice,$discount,$total,$cashUnpaid,$phic,$company,$timeCharge,$dateCharge,$chargeBy,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$branch,$room) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO patientCharges (status,registrationNo,chargesCode,description,sellingPrice,discount,total,cashUnpaid,phic,company,timeCharge,dateCharge,chargeBy,
service,title,paidVia,cashPaid,batchNo,quantity,inventoryFrom,branch,control_dateCharge)
VALUES
('$status','$registrationNo','$chargesCode','$description','$sellingPrice','$discount','$total','$cashUnpaid','$phic','$company',
'$timeCharge','$dateCharge','$chargeBy','$service','$title','$paidVia','$cashPaid','$batchNo','$quantity','$inventoryFrom','$branch','".date("Y-m-d")."')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

echo "<font color=red size=5>Operation Completed..!!!!</font>";

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public $patientChargez_cashUnpaid;
public $patientChargez_company;
public $patientChargez_phic;
public $patientChargez_disc;
public $patientChargez_total;
public $patientChargez_paid;


public function getPatientCharges($registrationNo,$username,$show,$desc) {

$this->getPatientProfile($registrationNo);

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

.data {
font-size:12px;
}
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($show == "All") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientCharges where registrationNo = '$registrationNo' and status in ('UNPAID','Return','Discharged') order by dateCharge,timeCharge asc ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientCharges where registrationNo = '$registrationNo' and status in ('UNPAID','Return','Discharged') and description like '$desc%%%%%%' order by description asc ");
}


while($row = mysqli_fetch_array($result))
  {
//$this->getMyResults($this->getResult_labNo($row['itemNo']),$username);
//$price = preg_split ("/\//", $row['sellingPrice']); 
$deptStatus = preg_split ("/\_/", $row['departmentStatus']); 
echo "<tr>";

/*********STRPOS*************/
if (strpos($row['sellingPrice'],'/') !== false) {
$price = preg_split ("/\//", $row['sellingPrice']); 
}else { 
$price[0] = $row['sellingPrice'];
$price[1] = "0.00";
} 
/***************************/

$this->patientChargez_cashUnpaid+=$row['cashUnpaid'];
$this->patientChargez_company+=$row['company'];
$this->patientChargez_phic+=$row['phic'];
$this->patientChargez_disc+=$row['discount'];
$this->patientChargez_total+=$row['total'];
$this->patientChargez_paid+=$row['cashPaid'];

$myDesc = $this->getPatientRecord_lastName().", ".$this->getPatientRecord_firstName()." - ".$row['description'];
if( $row['title'] == "Room And Board" ) {
echo "<Td>&nbsp;<img src='http://".$this->getMyUrl()."/COCONUT/myImages/locked1.jpeg' />&nbsp;</tD>";
}else if( $row['batchNo'] == "package" ) {
echo "<Td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/verifyDelete_pass.php?registrationNo=$registrationNo&itemNo=$row[itemNo]&description=$myDesc&quantity=$row[quantity]&username=$username&show=$show&desc=$desc'><font size=2 color=red>Px</font></a>&nbsp;</tD>";
}else if( $this->selectNow("registrationDetails","dateUnregistered","registrationNo",$row['registrationNo']) != "") {
//echo "<Td>&nbsp;<font size=2 color=red>MGH</font>&nbsp;</tD>";
echo "<Td>&nbsp;<img src='http://".$this->getMyUrl()."/COCONUT/myImages/locked1.jpeg' />&nbsp;</tD>";
}else if( $row['status'] == "Return" ) {
echo "<Td>&nbsp;<img src='http://".$this->getMyUrl()."/COCONUT/myImages/locked1.jpeg' />&nbsp;</tD>";
}else {
//$myDesc = $this->getPatientRecord_lastName().", ".$this->getPatientRecord_firstName()." - ".$row['description'];
echo "<td><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/verifyDelete_pass_checkAllow.php?registrationNo=$registrationNo&itemNo=$row[itemNo]&description=$myDesc&quantity=$row[quantity]&username=$username&show=$show&desc=$desc'>
<img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg' />
</a></td>";
}


if($deptStatus[0] == "dispensedBy") {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&show=$show&desc=$desc'>".$row['description']." &nbsp;(<font size=1 color=red>Dispensed @ $row[departmentStatus_time] by $deptStatus[1] </font>)</a></font>&nbsp;</td>";
}else if($this->checkIfLabResultExist($row['itemNo']) > 0 && $row['title'] == "LABORATORY" ) {

if($this->checkIfLabResultExist($row['itemNo']) > 0) {

echo "<td>&nbsp;<font class='data'><a href='#'>".$row['description']."</a><br>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Laboratory/resultList/resultForm_output.php?registrationNo=$row[registrationNo]&itemNo=$row[itemNo]'>(<font color=red size=1>Test Done</font>)</font></a>&nbsp;</td>";


}else {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/Laboratory/resultList/resultList.php?registrationNo=$row[registrationNo]&username=$username&chargesCode=$row[chargesCode]&itemNo=$row[itemNo]'>".$row['description']."</a></font>&nbsp;</td>";
}

}else if($this->checkIfRadResultExist($row['itemNo']) > 0 && ($row['title'] == "ULTRASOUND" || $row['title'] == "XRAY" || $row['title'] == "CTSCAN")  ) {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&show=$show&desc=$desc'>".$row['description']."</a><br>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/uploader/radioResult.php?itemNo=$row[itemNo]&registrationNo=$row[registrationNo]&username=$username&description=$row[description]'>(<font color=red size=1>Test Done</font>)</font></a>&nbsp;</td>";
}else if($this->checkIfSoapExist($row['itemNo']) > 0 && $row['title'] == "PROFESSIONAL FEE" ) {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&show=$show&desc=$desc'>".$row['description']."</a><br>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Doctor/doctorModule/soapView.php?itemNo=$row[itemNo]&registrationNo=$row[registrationNo]&username=$username'>(<font color=red size=1>S.O.A.P</font>)</font></a>&nbsp;</td>";
}else if( $row['title'] == "OT" ) {
  echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&show=$show&desc=$desc'>".$row['description']."</a></font>&nbsp;</td>";
}else  {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&show=$show&desc=$desc'>".$row['description']."</a></font>&nbsp;</td>";
}


if($row['title']=="PROFESSIONAL FEE") {
echo "<td><font class='data'>".number_format($price[0],2)."</font>/<font class='data'>".$price[1]."</font>&nbsp;</td>";
}
else {
echo "<td><font class='data'>".number_format($row['sellingPrice'],2)."</font>&nbsp;</td>";
}

echo "<td>&nbsp;<font class='data'>".$row['quantity']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['discount']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".number_format($row['total'],2)."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['timeCharge']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['dateCharge']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['chargeBy']."</font>&nbsp;</td>";

if($row['inventoryFrom'] != "none") {
echo "<td>&nbsp;<font class='data'>".$row['service']."</font><br><font class='data'>".$row['inventoryFrom']."</font>&nbsp;</td>";
}else if($row['inventoryFrom'] == "") {
echo "<td>&nbsp;<font class='data'>".$row['service']."</font>&nbsp;</td>";
}else if($row['title'] == "LABORATORY") {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Results/addResults.php?description=$row[description]&registrationNo=$registrationNo&itemNo=$row[itemNo]&branch=$row[branch]'><font class='data'>".$row['service']."</font></a>&nbsp;</td>";
}else if($row['title'] == "RADIOLOGY") {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Reports/radiologyReport/radioReportSettings.php?description=$row[description]&registrationNo=$registrationNo&itemNo=$row[itemNo]&branch=$row[branch]'><font class='data'>".$row['service']."</font></a>&nbsp;</td>";
}else if($row['title'] == "PROFESSIONAL FEE") {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Doctor/doctorModule/soap.php?registrationNo=$registrationNo&itemNo=$row[itemNo]&username=$username'><font class='data'>".$row['service']."</font></a>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font class='data'>".$row['service']."</font>&nbsp;</td>";
}
echo "<td>&nbsp;<font class='data'>".$row['status']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data' color=blue>".$row['paidVia']."</font>&nbsp;</td>";
echo "<td>&nbsp;<center><font class='data'>".number_format($row['cashUnpaid'],2)."</font></centeR>&nbsp;</td>";
echo "<td>&nbsp;<center><font class='data'>".number_format($row['company'],2)."</font></center>&nbsp;</td>";
echo "<td>&nbsp;<center><font class='data'>".number_format($row['phic'],2)."</font></center>&nbsp;</td>";
echo "<td>&nbsp;<a href='paidOptions.php?registrationNo=$registrationNo&itemNo=$row[itemNo]'><font class='data'>".$row['cashPaid']."</font></a>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['title']."</font>&nbsp;</td>";
echo "</tr>";
  }


//row after looping d2 ippkta ung total ng "balance","Company","hmo"
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td><center><b>TOTAL</b></center></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";

if( $this->selectNow("registeredUser","module","username",$username) == "PHILHEALTH" || $this->selectNow("registeredUser","module","username",$username) == "HMO" || $this->selectNow("registeredUser","module","username",$username) == "PHARMACY" || $this->selectNow("registeredUser","module","username",$username) == "CASHIER" || $this->selectNow("registeredUser","module","username",$username) == "BILLING" ) {
echo "<td><center><font class='data' color=red>".number_format($this->patientChargez_disc,2)."</center></td>";
echo "<td><center><font class='data' color=red>".number_format($this->patientChargez_total,2)."</center></td>";
}else {
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
}

echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";

if( $this->selectNow("registeredUser","module","username",$username) == "PHILHEALTH" || $this->selectNow("registeredUser","module","username",$username) == "HMO" || $this->selectNow("registeredUser","module","username",$username) == "PHARMACY" || $this->selectNow("registeredUser","module","username",$username) == "CASHIER" || $this->selectNow("registeredUser","module","username",$username) == "BILLING" ) {

echo "<td><center><font class='data' color=red>".number_format($this->patientChargez_cashUnpaid,2)."</center></td>";
echo "<td><center><font class='data' color=red>".number_format($this->patientChargez_company,2)."</center></td>";
echo "<td><center><font class='data' color=red>".number_format($this->patientChargez_phic,2)."</center></td>";
echo "<td><center><font class='data' color=red>".number_format($this->patientChargez_paid,2)."</center></td>";
}else {
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";

}

echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";


}




public function getSubCategory($chargesCode) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT subCategory FROM availableCharges where chargesCode = '$chargesCode' ");

while($row = mysqli_fetch_array($result))
  {
return $row['subCategory'];
  }

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}






public $dependsTitle_cashUnpaid;
public $dependsTitle_company;
public $dependsTitle_phic;
public $dependsTitle_paid;
public $dependsTitle_disc;
public $dependsTitle_total;

public function getPatientChargesDependsOnTitle($registrationNo,$title,$username,$show,$desc) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

.data {
font-size:12px;
}
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientCharges where registrationNo = '$registrationNo' and title='$title' and (status = 'UNPAID' or status = 'Discharged' or status = 'Return') order by dateCharge,timeCharge asc ");

while($row = mysqli_fetch_array($result))
  {
//$this->getMyResults($this->getResult_labNo($row['itemNo']),$username);
//$price = preg_split ("/\//", $row['sellingPrice']); 
$deptStatus = preg_split ("/\_/", $row['departmentStatus']); 
//$labTest = preg_split ("/\_/", $row['Category']); 

/*********STRPOS*************/
if (strpos($row['sellingPrice'],'/') !== false) {
$price = preg_split ("/\//", $row['sellingPrice']); 
}else { 
$price[0] = $row['sellingPrice'];
$price[1] = "0.00";
} 
/***************************/

echo "<tr>";

$this->dependsTitle_cashUnpaid += $row['cashUnpaid'];
$this->dependsTitle_company += $row['company'];
$this->dependsTitle_phic += $row['phic'];
$this->dependsTitle_total += $row['total'];
$this->dependsTitle_disc += $row['discount'];
$this->dependsTitle_paid += $row['cashPaid'];


if( $title == "Room And Board" ) {
//echo "<Td>&nbsp;<img src='http://".$this->getMyUrl()."/COCONUT/myImages/locked1.jpeg' />&nbsp;</tD>";
echo "<Td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/discharged/deleteRoom.php?registrationNo=$registrationNo&itemNo=$row[itemNo]&chargesCode=$row[chargesCode]&username=$username'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/locked1.jpeg' />&nbsp;</a></tD>";
}else if( $row['batchNo'] == "package" ) {
echo "<Td>&nbsp;<font size=2 color=red>Px</font>&nbsp;</tD>";
}else if( $this->selectNow("registrationDetails","mgh","registrationNo",$row['registrationNo']) ) {
//echo "<Td>&nbsp;<font size=2 color=red>MGH</font>&nbsp;</tD>";
echo "<Td>&nbsp;<img src='http://".$this->getMyUrl()."/COCONUT/myImages/locked1.jpeg' />&nbsp;</tD>";
}
else if( $this->selectNow("forDeletion","itemNo","itemNo",$row['itemNo']) > 0 ) {
echo "<Td>&nbsp;<img src='http://".$this->getMyUrl()."/COCONUT/myImages/locked1.jpeg' />&nbsp;</tD>";
}else if( $row['status'] == "Return" ) {
echo "<Td>&nbsp;<img src='http://".$this->getMyUrl()."/COCONUT/myImages/locked1.jpeg' />&nbsp;</tD>";
}
else{
echo "<td><center><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/verifyDelete_redirect_checkAllow.php?registrationNo=$registrationNo&itemNo=$row[itemNo]&description=$row[description]&quantity=$row[quantity]&username=$username&show=$show&desc=$desc'>
<img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg' />
</a></center></td>";
}


if($deptStatus[0] == "dispensedBy") {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&show=$show&desc=$desc'>".$row['description']." &nbsp;<font size=1 color=red>(Dispensed)</font></a></font>&nbsp;</td>";
}else if( $row['status'] == "Return" ) {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&show=$show&desc=$desc'>".$row['description']." &nbsp;<font size=1 color=red>(Return)</font></a></font>&nbsp;</td>";
}else if($this->checkIfLabResultExist($row['itemNo']) > 0 && $row['title'] == "LABORATORY" ) {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&show=$show&desc=$desc'>".$row['description']."</a><br>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Laboratory/resultList/resultForm_output.php?registrationNo=$registrationNo&itemNo=$row[itemNo]'>(<font color=red size=1>Test Done</font>)</font></a>&nbsp;</td>";
}else if($row['title'] == "ULTRASOUND" || $row['title'] == "XRAY") {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&show=$show&desc=$desc'>".$row['description']."";


if( $this->checkIfRadResultExist($row['itemNo']) > 0 ) {
echo "<br><a href='http://".$this->getMyUrl()."/COCONUT/Reports/radiologyReport/radioReport_output.php?itemNo=$row[itemNo]&registrationNo=$registrationNo&description=$row[description]' target='_blank'><font size=1 color=red>&nbsp;Result Available</font></a>&nbsp;";
}else { 
echo "<br><a href='http://".$this->getMyUrl()."/COCONUT/Reports/radiologyReport/radioReportSettings.php?description=$row[description]&registrationNo=$registrationNo&itemNo=$row[itemNo]&branch=Paranaque' target='_self'><font size=1 color=blue>&nbsp;[Add Result]</font></a>&nbsp;";
}

if( $this->checkDicom($row['itemNo']) > 0 ) {
echo "<br><a href='http://".$this->getMyUrl()."".$this->selectNow("uploadedFiles","fileUrl","itemNo",$row['itemNo'])."' target='_blank'><font size=1 color=red>&nbsp;Image Available</font></a>&nbsp;";
}else {
echo "<br><a href='http://".$this->getMyUrl()."/COCONUT/uploader/multiplefileupload.php?username=".$username."-".$this->selectNow("patientCharges","registrationNo","itemNo",$row['itemNo'])."-".$row['itemNo']."' target='_self'><font size=1 color=blue>&nbsp;[Upload Image]</font></a>&nbsp;";
}

echo "</td>";
}else if($this->checkIfSoapExist($row['itemNo']) > 0 && $row['title'] == "PROFESSIONAL FEE" ) {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&show=$show&desc=$desc'>".$row['description']."</a><br>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Doctor/doctorModule/soapView.php?itemNo=$row[itemNo]&registrationNo=$row[registrationNo]&username=$username'>(<font color=red size=1>S.O.A.P</font>)</font></a>&nbsp;</td>";
}
//else if( $this->selectNow("registrationDetails","mgh","registrationNo",$row['registrationNo']) != "") {
//echo "<td>&nbsp;<font class='data'><a href='#'>".$row['description']."</a></font>&nbsp;</td>";
//}
else  {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&show=$show&desc=$desc'>".$row['description']."</a></font>&nbsp;</td>";
}


if($row['title']=="PROFESSIONAL FEE") {
echo "<td><font class='data'>".number_format($price[0],2)."</font>/<font class='data'>".$price[1]."</font>&nbsp;</td>";
}else {
echo "<td><font class='data'>".number_format($row['sellingPrice'],2)."</font>&nbsp;</td>";
}

echo "<td>&nbsp;<font class='data'>".$row['quantity']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['discount']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".number_format($row['total'],2)."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['timeCharge']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['dateCharge']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['chargeBy']."</font>&nbsp;</td>";

if($row['inventoryFrom'] != "none") {
if( $row['remarks'] == "takeHomeMeds" ) {
echo "<td>&nbsp;<font class='data'>".$row['service']."</font><br><font class='data'>".$row['inventoryFrom']."<br>Take Home</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font class='data'>".$row['service']."</font><br><font class='data'>".$row['inventoryFrom']."</font>&nbsp;</td>";
}
}else if($row['inventoryFrom'] == "") {
echo "<td>&nbsp;<font class='data'>".$row['service']."</font>&nbsp;</td>";
}else if($row['title'] == "LABORATORY") {

if( $this->checkIfLabResultExist($row['itemNo']) > 0 ) {
echo "<td>&nbsp;<a href='#'><font class='data'>".$row['service']."</font></a>&nbsp;</td>";
}else {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Laboratory/resultList/resultList.php?itemNo=$row[itemNo]&registrationNo=$row[registrationNo]&chargesCode=$row[chargesCode]&username=$username'><font class='data'>".$row['service']."</font></a>&nbsp;</td>";
}


}else if($row['title'] == "RADIOLOGY") {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Reports/radiologyReport/radioReportSettings.php?description=$row[description]&registrationNo=$registrationNo&itemNo=$row[itemNo]&branch=$row[branch]'><font class='data'>".$row['service']."</font></a>&nbsp;</td>";
}else if($row['title'] == "PROFESSIONAL FEE") {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Doctor/doctorModule/soap.php?registrationNo=$registrationNo&itemNo=$row[itemNo]&username=$username'><font class='data'>".$row['service']."</font></a><br><font size=2 color=red>".$this->selectNow("Doctors","contact","doctorCode",$row['chargesCode'])."</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font class='data'>".$row['service']."</font>&nbsp;</td>";
}

if($row['status']=="PAID" ) {
echo "<td>&nbsp;<font class='data' color=blue>".$row['status']."</font>&nbsp;</td>";
}
else if($row['status']=="BALANCE" || $row['status']=="APPROVED") {
echo "<td>&nbsp;<font class='data' color=red>".$row['status']."</font>&nbsp;</td>";
}
else {
echo "<td>&nbsp;<font class='data'>".$row['status']."</font>&nbsp;</td>";
}
if($row['paidVia']=="Company") {
echo "<td>&nbsp;<font class='data' color=red>".$row['paidVia']."</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font class='data' color=blue>".$row['paidVia']."</font>&nbsp;</td>";
}
echo "<td>&nbsp;<center><font class='data'>".number_format($row['cashUnpaid'],2)."</font></center>&nbsp;</td>";
echo "<td>&nbsp;<center><font class='data'>".number_format($row['company'],2)."</font></center>&nbsp;</td>";
echo "<td>&nbsp;<center><font class='data'>".number_format($row['phic'],2)."</font></center>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['cashPaid']."</font>&nbsp;</td>";
echo "</tr>";
  }


//row after looping d2 ippkta ung total ng "balance","Company","hmo"
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td><center><b>TOTAL</b></center></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><center><font class='data' color=red>".number_format($this->dependsTitle_disc,2)."</center></td>";
echo "<td><center><font class='data' color=red>".number_format($this->dependsTitle_total,2)."</center></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><center><font class='data' color=red>".number_format($this->dependsTitle_cashUnpaid,2)."</center></td>";
echo "<td><center><font class='data' color=red>".number_format($this->dependsTitle_company,2)."</center></td>";
echo "<td><center><font class='data' color=red>".number_format($this->dependsTitle_phic,2)."</center></td>";
echo "<td><center><font class='data' color=red>".number_format($this->dependsTitle_paid,2)."</center></td>";

echo "</tr>";




}




public function getGeneric($chargesCode) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT genericName,description from inventory where inventoryCode = '$chargesCode'  ");

while($row = mysqli_fetch_array($result))
  {
return $row['description']." - ".$row['genericName'];
  }

}




public $chargesStatus; //identifier pra sa status ng charges
public $cashUnpaid_check;
public $patientType;
public $dateUnregistered;
public $pxLastName;


public function getPatientChargesByTitle($registrationNo,$title,$month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,$module,$nod) {

$selectedDate = $year."-".$month."-".$day;
$fromTimez = $fromTime_hour.":".$fromTime_minutes.":".$fromTime_seconds;
$toTimez = $toTime_hour.":".$toTime_minutes.":".$toTime_seconds;

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

.data {
font-size:13px;
}
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


if($module == "PHARMACY" || $module=="CSR") {

if( $nod == "" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.*,rd.type,rd.dateUnregistered FROM patientCharges pc,registrationDetails rd where rd.registrationNo = '$registrationNo' and rd.registrationNo = pc.registrationNo and pc.inventoryFrom='$title' and pc.dateCharge='$selectedDate' and (pc.timeCharge between '$fromTimez' and '$toTimez') and pc.departmentStatus not like 'dispensedBy%%%%%' and pc.status not like 'DELETED_%%%%%%%' and (pc.title = 'MEDICINE' or pc.title = 'SUPPLIES') order by pc.description asc ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.*,rd.type,rd.dateUnregistered FROM patientCharges pc,registrationDetails rd where rd.registrationNo = '$registrationNo' and rd.registrationNo = pc.registrationNo and pc.inventoryFrom='$title' and pc.dateCharge='$selectedDate' and pc.paidVia ='Cash' and (pc.timeCharge between '$fromTimez' and '$toTimez') and pc.departmentStatus not like 'dispensedBy%%%%%' and pc.status not like 'DELETED_%%%%%%%' and pc.chargeBy = '$nod'  order by pc.description asc ");
}



}else if( $module =="LABORATORY" || $module == "BLOODBANK" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.*,rd.* FROM patientCharges pc,registrationDetails rd where rd.registrationNo = '$registrationNo' and rd.registrationNo = pc.registrationNo and (pc.title='LABORATORY' or pc.title = 'BLOODBANK') and pc.dateCharge='$selectedDate' and (pc.timeCharge between '$fromTimez' and '$toTimez') and pc.departmentStatus not like 'remittedBy%%%%%' and pc.status not like 'DELETED_%%%%%' group by pc.itemNo order by pc.description asc ");
}else if($module =="RADIOLOGY") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.*,rd.* FROM patientCharges pc,registrationDetails rd where rd.registrationNo = '$registrationNo' and rd.registrationNo = pc.registrationNo and (pc.title='ULTRASOUND' or pc.title = 'XRAY') and pc.dateCharge='$selectedDate' and (pc.timeCharge between '$fromTimez' and '$toTimez') and pc.departmentStatus not like 'remittedBy%%%%%' and pc.status not like 'DELETED_%%%%%' group by pc.itemNo order by pc.description asc ");
}

else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.*,rd.* FROM patientCharges pc,registrationDetails rd where rd.registrationNo = '$registrationNo' and rd.registrationNo = pc.registrationNo and pc.title='$title' and pc.dateCharge='$selectedDate' and (pc.timeCharge between '$fromTimez' and '$toTimez') and pc.departmentStatus not like 'remittedBy%%%%%' and status not like 'DELETED_%%%%%%%' group by pc.itemNo order by pc.description asc ");
}


echo "<form method='get' action='http://".$this->getMyUrl()."/Department/updateDepartmentStatus.php'>";
echo "<input type=hidden name='username' value='$username'>";

while($row = mysqli_fetch_array($result))
  {
echo "<input type=hidden name='batchNo' value='".$row['batchNo']."'>";
$deptStatus = preg_split ("/\_/", $row['departmentStatus']); 
$this->getInventoryFrom($row['itemNo']);
$this->chargesStatus = $row['status'];
$this->patientType = $row['type'];
$this->cashUnpaid_check = $row['cashUnpaid'];
$this->dateUnregistered = $row['dateUnregistered'];
$this->pxLastName = $this->selectNow("patientRecord","lastName","patientNo",$this->selectNow("registrationDetails","patientNo","registrationNo",$row['registrationNo']));



echo "<tr>";


if( $module == "PHARMACY" ) {
if( $row['status'] == "UNPAID" ) {
//echo "<td><a href='http://".$this->getMyUrl()."/COCONUT/Pharmacy/individualPaid.php?registrationNo=$registrationNo&itemNo=$row[itemNo]&username=$username&module=$module&month=$month&day=$day&year=$year&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds'>&nbsp;<font color=red size=4>Paid</font></a>|<a href='/COCONUT/patientProfile/ECART/cartHandler.php?batchNo=$row[batchNo]&username=$username&registrationNo=$registrationNo&room='><font size=4 color='blue'>Replace</font></a></td>";
echo "<td><a href='/COCONUT/patientProfile/ECART/cartHandler.php?batchNo=$row[batchNo]&username=$username&registrationNo=$registrationNo&room='><font size=4 color='blue'>Replace</font></a></td>";
}else {
echo "<td>&nbsp;</td>";
}

}else {

}



//////  check kung may available QTY pba sa inventory [QTY CHECKER]
if( $module == "PHARMACY" ) {

if( $this->getCurrentQTY($row['chargesCode']) >= $row['quantity'] ) {
if( $row['status'] == "Return") {
//echo "<td><input type=checkbox name='quantity[]' value='".$deptStatus[0]."'  ></td>";
//echo "<td><input type=checkbox name='dispensed[]' value='yes_".$row['description']."_".$row['quantity']."' '></td>";
echo "<Td></td>";
echo "<Td></td>";
}
else {
echo "<td><input type=checkbox name='quantity[]' value='".$row['quantity']."' checked='true' '></td>";
echo "<td><input type=checkbox name='dispensed[]' value='yes_".$row['description']."_".$row['quantity']."' checked='true' '></td>";
}



if( $row['status'] == "Return") {
//echo "<td><input type=checkbox name='departmentStatus[]' value='$row[itemNo]' ></td>";
echo "<Td></tD>";
$this->coconutHidden("paid","");
}else {
echo "<td><input type=checkbox name='departmentStatus[]' value='$row[itemNo]' checked></td>";
}
}else {
if( $row['status'] == "Return") {
//echo "<td><input type=checkbox name='departmentStatus[]' value='$row[itemNo]' ></td>";
//echo "<td><input type=checkbox name='quantity[]' value='".$deptStatus[0]."'  ></td>";
//echo "<td><input type=checkbox name='dispensed[]' value='yes_".$row['description']."_".$row['quantity']."' '></td>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
$this->coconutHidden("paid","");
}else {
echo "<td><font size=1>CANNOT</font> </td>";
echo "<td> <font size=1>REACH THE REQUESTED QTY</font></td>";
echo "<td><a href='/COCONUT/patientProfile/ECART/cartHandler.php?batchNo=$row[batchNo]&username=$username&registrationNo=$registrationNo&room='>DELETE TTHIS</a></td>";
}
}

}else {

//if( $this->getCurrentQTY($row['chargesCode']) > 0 && $module == "PHARMACY" ) {
if( $row['status'] == "Return") {
//echo "<td><input type=checkbox name='quantity[]' value='".$deptStatus[0]."'  ></td>";
//echo "<td><input type=checkbox name='dispensed[]' value='yes_".$row['description']."_".$row['quantity']."' '></td>";
echo "<Td></td>";
echo "<Td></td>";
}
else {
echo "<td><input type=checkbox name='quantity[]' value='".$row['quantity']."' checked='true' '></td>";
echo "<td><input type=checkbox name='dispensed[]' value='yes_".$row['description']."_".$row['quantity']."' checked='true' '></td>";
}



if( $row['status'] == "Return") {
//echo "<td><input type=checkbox name='departmentStatus[]' value='$row[itemNo]' ></td>";
echo "<Td></td>";
$this->coconutHidden("paid","");
}else {
echo "<td><input type=checkbox name='departmentStatus[]' value='$row[itemNo]' checked></td>";
}
//}else {
//echo "<td> NOT </td>";
//echo "<td>AVAILABLE</td>";
//echo "<td>DELETE TTHIS</td>";
//}

}
/////////END OF QTY CHECKER




/*
echo "<td><center><a href='http://".$this->getMyUrl()."/COCONUT/Cashier/verifyDelete.php?registrationNo=$registrationNo&itemNo=$row[itemNo]&description=$row[description]&quantity=$row[quantity]'>
<img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg' />
</a></center></td>";
*/


if($row['title'] == "LABORATORY" || $row['title'] == "BLOODBANK") {

if($this->checkIfLabResultExist($row['itemNo']) > 0) {

echo "<td>&nbsp;<font class='data'><a href='#'>".$row['description']."</a><br>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Laboratory/resultList/resultForm_output.php?registrationNo=$row[registrationNo]&itemNo=$row[itemNo]'>(<font color=red size=1>Test Done</font>)</font></a>&nbsp;</td>";


}else {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/Laboratory/formChecker.php?registrationNo=$row[registrationNo]&username=$username&chargesCode=$row[chargesCode]&itemNo=$row[itemNo]&subCategory=".$this->selectNow("availableCharges","subCategory","chargesCode",$row['chargesCode'])."' target='_blank'>".$row['description']." - <font color=red size=2>".$row['remarks']."</font></a></font>&nbsp;</td>";
}

}else if( $row['title'] == "XRAY" || $row['title'] == "ULTRASOUND" ) {

echo "<td>&nbsp;<font class='data'><a href='#'>".$row['description']."</a>";

if( $this->checkIfRadResultExist($row['itemNo']) > 0 ) {
echo "<br><a href='http://".$this->getMyUrl()."/COCONUT/Reports/radiologyReport/radioReport_output.php?itemNo=$row[itemNo]&registrationNo=$registrationNo&description=$row[description]' target='_blank'><font size=1 color=red>&nbsp;Result Available</font></a>&nbsp;";
}else { 
echo "<br><a href='http://".$this->getMyUrl()."/COCONUT/Reports/radiologyReport/radioReportSettings.php?description=$row[description]&registrationNo=$registrationNo&itemNo=$row[itemNo]&branch=Paranaque' target='_self'><font size=1 color=blue>&nbsp;[Add Result]</font></a>&nbsp;";
}
if( $this->checkDicom($row['itemNo']) > 0 ) {
echo "<br><a href='http://".$this->getMyUrl()."".$this->selectNow("uploadedFiles","fileUrl","itemNo",$row['itemNo'])."' target='_blank'><font size=1 color=red>&nbsp;Image Available</font></a>&nbsp;";
}else {
echo "<br><a href='http://".$this->getMyUrl()."/COCONUT/uploader/multiplefileupload.php?username=".$username."-".$this->selectNow("patientCharges","registrationNo","itemNo",$row['itemNo'])."-".$row['itemNo']."' target='_self'><font size=1 color=blue>&nbsp;[Upload Image]</font></a>&nbsp;";
}
echo "</td>";



}else {

if($row['title'] == "MEDICINE" || $row['title'] == "SUPPLIES" ) {
echo "<td>&nbsp;<font size=2><b>Inventory Code</b>:</font><font color=red size=2>$row[chargesCode]</font><br><font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/availableMedicine/returnNow.php?itemNo=$row[itemNo]&username=$username'> ".$this->getGeneric($row['chargesCode'])."</a><br>&nbsp;<font size=1 color=red></font></font>&nbsp;</td>";
}else {

echo "<td>&nbsp;<font class='data'><a href='#'>".$row['description']."</a></font>&nbsp;</td>";

}

}

echo "<td><font class='data'>".number_format($row['sellingPrice'],2)."</font>&nbsp;</td>";
if($row['status'] == "Return") {
echo "<td>&nbsp;<font class='data'>".$deptStatus[0]."</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font class='data'>".$row['quantity']."</font>&nbsp;</td>";
}

echo "<td>&nbsp;<font class='data'>".$row['discount']."</font>&nbsp;</td>";
if( $row['cashUnpaid'] > 0 ) {
echo "<td>&nbsp;<font class='data' color=red>".number_format($row['cashUnpaid'],2)."</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font class='data'>".number_format($row['cashUnpaid'],2)."</font>&nbsp;</td>";
}
echo "<td>&nbsp;<font class='data'>".$row['timeCharge']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['dateCharge']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['chargeBy']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['status']."</font>&nbsp;</td>";
if($row['paidVia']=="Company") {
echo "<td>&nbsp;<font class='data' color=red>".$row['paidVia']."</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font class='data' color=blue>".$row['paidVia']."</font>&nbsp;</td>";
}
echo "</tr>";
  }
if($this->getDepartmentInventory() =="PHARMACY" || $this->getDepartmentInventory() =="CSR") {
if($this->chargesStatus != "Return" ) {
echo "<input type=submit value='Dispense' style='border:1px solid #000; background-color:#3b5998; color:white'>";
}else if($this->chargesStatus == "Return" ) {
echo "<input type=submit value='Return' style='border:1px solid #000; background-color:#3b5998; color:white'>";
}else {
echo "<font size=2 color=red>You can only Dispense a medicine/supplies when it is PAID</font>";
}

}else {
//if($this->chargesStatus == "PAID" || $this->patientType == "IPD" || $this->patientType == "ER" || $this->patientType == "OR/DR") {
echo "<input type=submit value='Remit' style='border:1px solid #000; background-color:#3b5998; color:white'>";
//}else {
//echo "<font size=2 color=red>You can only Remit a charges when it is PAID</font>";
//}
}
echo "</form>";

}


public function getSynapseTime() {
$timezone = "Asia/Manila";
date_default_timezone_set ($timezone);
return date("H:i:s");
}

//Cashier List Company
public function getPatientChargesUnpaidCompany($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,$registrationNo,$shift) {


$selectedDate = $year."-".$month."-".$day;
$fromTimez = $fromTime_hour.":".$fromTime_minutes.":".$fromTime_seconds;
$toTimez = $toTime_hour.":".$toTime_minutes.":".$toTime_seconds;

$timezone = "Asia/Manila";
date_default_timezone_set ($timezone);

$this->getPatientProfile($registrationNo);

$disc = $this->getUnpaidPatientAmount($registrationNo) * $this->getRegistrationDetails_discount();

$grandTotal = $this->getUnpaidPatientAmount($registrationNo) - $disc;

echo "
<script src='http://".$this->getMyUrl()."/COCONUT/serverTime/serverTime.js'></script>
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

.data {
font-size:13px;
}

.shortField {
	border: 1px solid #000;
	color: #000;
	height: 30px;
	width: 120px;
	padding:4px 4px 4px 5px;
}

.labelz {
color:#000;
font-size:14px;
}
</style>";


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$patno=$this->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo);
echo strtoupper($this->selectNow("patientRecord","lastName","patientNo",$patno)).", ".strtoupper($this->selectNow("patientRecord","firstName","patientNo",$patno));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientCharges where registrationNo = '$registrationNo' and (status = 'UNPAID' or status = 'BALANCE') group by itemNo order by description asc ");

echo "<body onload='DisplayTime();'>";
echo "<form method='get' action='dischargedCompany.php'>";
$this->coconutHidden("registrationNo",$registrationNo);
//$this->coconutHidden("shift",$shift);


echo "Date ";
$this->coconutComboBoxStart_short("monthDischarged");
echo "<option value='".date("m")."'>".date("M")."</option>";
echo "<option value='01'>Jan</option>";
echo "<option value='02'>Feb</option>";
echo "<option value='03'>Mar</option>";
echo "<option value='04'>Apr</option>";
echo "<option value='05'>May</option>";
echo "<option value='06'>Jun</option>";
echo "<option value='07'>Jul</option>";
echo "<option value='08'>Aug</option>";
echo "<option value='09'>Sep</option>";
echo "<option value='10'>Oct</option>";
echo "<option value='11'>Nov</option>";
echo "<option value='12'>Dec</option>";
$this->coconutComboBoxStop();
echo "-";
$this->coconutComboBoxStart_short("dayDischarged");
echo "<option value='".date("d")."'>".date("d")."</option>";
for($x=1;$x<32;$x++) {
if($x < 10) {
echo "<option value='0$x'>$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
$this->coconutComboBoxStop();
echo "-";
$this->coconutTextBox_short("yearDischarged",date("Y"));
echo "<br>";
echo "Shift ";
$this->coconutComboBoxStart_long("shift");
echo "<option value='$shift'>$shift</option>";
echo "<option>Morning</option>";
echo "<option>Noon</option>";
echo "<option>Afternoon</option>";
echo "<option>Night</option>";
$this->coconutComboBoxStop();


echo "<input type=hidden name='username' value='$username'>";
echo "<input type=hidden name='serverTime' value='".date("H:i:s")."'>";
echo "<Br><br>";
$this->coconutButton("Discharged");
echo "<br><br>";
echo "<table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'></font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'></font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Description</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Price</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>QTY</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Disc</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Total</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Time</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Date</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>User</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Charged to Company</font>&nbsp;</th>";
echo "</tr>";



while($row = mysqli_fetch_array($result))
  {

$price = preg_split ("/\//", $row['sellingPrice']); 

echo "<tr>";
echo "<td><input type='checkbox' name='itemNo[]' value='$row[itemNo]' checked></td>";
echo "<td><center><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/verifyDelete.php?registrationNo=$registrationNo&itemNo=$row[itemNo]&description=$row[description]&quantity=$row[quantity]&username=$username&show=&desc='>
<img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg' />
</a></center></td>";
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/Cashier/editChargesCashier.php?itemNo=$row[itemNo]&month=$month&day=$day&year=$year&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&username=$username&registrationNo=$registrationNo&shift=$shift'>".$row['description']."</a></font>&nbsp;</td>";

if($row['title'] == "PROFESSIONAL FEE") {
echo "<td><font class='data'>".number_format($price[0],2)."</font>/<font class='data'>".$price[1]."</font>&nbsp;</td>";
}else {
echo "<td><font class='data'>".number_format($row['sellingPrice'],2)."</font>&nbsp;</td>";
}

echo "<td>&nbsp;<font class='data'>".$row['quantity']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".number_format($row['discount'],2)."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".number_format($row['total'],2)."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['timeCharge']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['dateCharge']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['chargeBy']."</font>&nbsp;</td>";
echo "<td align='center'>&nbsp;<font class='data' color=red>".$row['company']."</font>&nbsp;</td>";
echo "<input type=hidden name='chargeStatus' value='".$row['status']."'>";
echo "</tr>";
}
echo "</table>";
echo "</form>";
echo "</body>";




}
//End Cashier List Company

//check kung dispensed nba lahat ng inventory charges ng patient
public function check_dispensed_all($registrationNo) {
  $connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
  $result = mysqli_query($connection, "SELECT itemNo FROM patientCharges WHERE departmentStatus not like 'dispensedBy%' and registrationNo = '$registrationNo' and title in ('MEDICINE','SUPPLIES') and status not like 'DELETED%' ") or die("Query fail: " . mysqli_error()); 
  while($row = mysqli_fetch_array($result)) {
    return $row['itemNo'];
  }
}



public function getPatientChargesUnpaid($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,$registrationNo,$shift,$statusType,$reportDate) {


$selectedDate = $year."-".$month."-".$day;
$fromTimez = $fromTime_hour.":".$fromTime_minutes.":".$fromTime_seconds;
$toTimez = $toTime_hour.":".$toTime_minutes.":".$toTime_seconds;

$timezone = "Asia/Manila";
date_default_timezone_set ($timezone);

$this->getPatientProfile($registrationNo);

$disc = $this->getUnpaidPatientAmount($registrationNo) * $this->getRegistrationDetails_discount();

$grandTotal = $this->getUnpaidPatientAmount($registrationNo) - $disc;

echo "
<script src='http://".$this->getMyUrl()."/COCONUT/serverTime/serverTime.js'></script>
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

.data {
font-size:13px;
}

.shortField {
	border: 1px solid #000;
	color: #000;
	height: 30px;
	width: 120px;
	padding:4px 4px 4px 5px;
}

.labelz {
color:#000;
font-size:14px;
}
</style>";


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$patno=$this->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo);
echo strtoupper($this->selectNow("patientRecord","lastName","patientNo",$patno)).", ".strtoupper($this->selectNow("patientRecord","firstName","patientNo",$patno));



$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT *,sum(discount) as disc FROM patientCharges where registrationNo = '$registrationNo' and status = '$statusType' and cashUnpaid > 0 group by itemNo order by description asc ");



echo "<body onload='DisplayTime();'>";
echo "<form method='get' action='paymentManager.php'>";
$this->coconutHidden("registrationNo",$registrationNo);
$this->coconutHidden("shift",$shift);
$this->coconutHidden("creditCardNo","");
$this->coconutHidden("cardType","");
$this->coconutHidden("paidVia","Cash");
$this->coconutHidden("reportDate",$reportDate);
echo "<div style='border:1px solid #000000; width:550px; height:90px; border-color:black black black black;'>";
echo "<br>&nbsp;&nbsp;";
echo "<font>Payment</font>";
echo "&nbsp;&nbsp;<input type=text name='totalPaid' autocomplete='off' class='shortField' value='".($grandTotal)."'> &nbsp;&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Cashier/creditCardPayment.php?month=$month&day=$day&year=$year&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&username=$username&registrationNo=$registrationNo&shift=$shift&reportDate=$reportDate'><font size=2 color=red>[Credit Card]</font></a>&nbsp;&nbsp;&nbsp;&nbsp;";


if($this->getTotal("discount","",$registrationNo) < 1) {
echo "<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/discount/discount.php?registrationNo=$registrationNo&username=$username' style='text-decoration:none;'><font size=2 color=blue>[Add Discount]</font></a><Br>";
}else {
echo "<font size=2>Discount:&nbsp;".$this->getTotal("discount","",$registrationNo)."</font><Br>";
}

$this->coconutHidden("paymentType","Cash");
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font>OR#</font><input type=text autocomplete='off' name='orNO' class='shortField'>";

echo "&nbsp;&nbsp;<Font color=red size=2>Date Paid</font>&nbsp;";
$this->coconutDesign();
$this->coconutComboBoxStart_short("month");
echo "<option value='".date("m")."'>".date("M")."</option>";
echo "<option value='01'>Jan</option>";
echo "<option value='02'>Feb</option>";
echo "<option value='03'>Mar</option>";
echo "<option value='04'>Apr</option>";
echo "<option value='05'>May</option>";
echo "<option value='06'>Jun</option>";
echo "<option value='07'>Jul</option>";
echo "<option value='08'>Aug</option>";
echo "<option value='09'>Sep</option>";
echo "<option value='10'>Oct</option>";
echo "<option value='11'>Nov</option>";
echo "<option value='12'>Dec</option>";
$this->coconutComboBoxStop();
echo "-";
$this->coconutComboBoxStart_short("day");
echo "<option value='".date("d")."'>".date("d")."</option>";
for( $x=1;$x<32;$x++ ) {

if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}

}
$this->coconutComboBoxStop();
echo "-";
$this->coconutTextBox_short("year",date("Y"));


if( $this->check_dispensed_all($registrationNo) != "" ) {
echo "<br><br>[<font color=red>Medicine/Supplies need to be dispense first before payment</font>]";
}else {
echo "<br>&nbsp;&nbsp;&nbsp;<input type=submit value='Paid' style='border:1px solid #000; background-color:#3b5998; color:white'>";
}
echo "<br></div><br><br>";
echo "<input type=hidden name='username' value='$username'>";
echo "<input type=hidden name='serverTime' value='".date("H:i:s")."'>";


echo "<table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'></font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'></font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Description</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Price</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>QTY</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Disc</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Total</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Time</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Date</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>User</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Payment</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'></font>&nbsp;</th>";
echo "</tr>";



while($row = mysqli_fetch_array($result))
  {

$price = preg_split ("/\//", $row['sellingPrice']); 

echo "<tr>";
echo "<td><input type=checkbox name='cashierPaid[]' value='$row[itemNo]' checked></td>";
echo "<td><center><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/verifyDelete.php?registrationNo=$registrationNo&itemNo=$row[itemNo]&description=$row[description]&quantity=$row[quantity]&username=$username&show=&desc='>
<img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg' />
</a></center></td>";

if( $row['vat'] == "" ) {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/Cashier/pfCashier.php?itemNo=$row[itemNo]&month=$month&day=$day&year=$year&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&username=$username&registrationNo=$registrationNo&shift=$shift'>".$row['description']."</a></font>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/Cashier/pfCashier.php?itemNo=$row[itemNo]&month=$month&day=$day&year=$year&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&username=$username&registrationNo=$registrationNo&shift=$shift'>".$row['description']."</a></font><br><font size=2 color=red>w/ VAT</font>&nbsp;</td>";
}


if($row['title'] == "PROFESSIONAL FEE") {
echo "<td><font class='data'>".number_format($price[0],2)."</font>/<font class='data'>".$price[1]."</font>&nbsp;</td>";
}else {
echo "<td><font class='data'>".number_format($row['sellingPrice'],2)."</font>&nbsp;</td>";
}

echo "<td>&nbsp;<font class='data'>".$row['quantity']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".number_format($row['discount'],2)."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".number_format($row['total'],2)."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['timeCharge']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['dateCharge']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['chargeBy']."</font>&nbsp;</td>";
if($row['vat']!=''){
echo "<td>&nbsp;<font class='data' color=red>".$row['cashUnpaid']." (</font><font class='data' color=red>".number_format($row['vat'],2)."</font><font class='data'>)</font>&nbsp;</td>";
}
else{
echo "<td>&nbsp;<font class='data' color=red>".$row['cashUnpaid']."</font>&nbsp;</td>";
}

if( $row['title'] == "MEDICINE" ) {

if( $row['vat'] == "" ) {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Cashier/vatControl.php?itemNo=$row[itemNo]&registrationNo=$registrationNo&vat=addVat&username=$username&month=$month&day=$day&year=$year&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&shift=$shift&sellingPrice=".$row['sellingPrice']."&quantity=".$row['quantity']."'><font class='data' color=red>[add VAT]</font></a>&nbsp;</td>";
}else {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Cashier/vatControl.php?itemNo=$row[itemNo]&registrationNo=$registrationNo&vat=removeVat&username=$username&month=$month&day=$day&year=$year&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&shift=$shift&sellingPrice=".$row['sellingPrice']."&quantity=".$row['quantity']."'><font class='data' color=blue>[remove VAT]</font></a>&nbsp;</td>";
}

}else {
echo "<td>&nbsp;</td>";
}

echo "<input type=hidden name='chargeStatus' value='".$row['status']."'>";
echo "</tr>";
}
echo "</table>";
echo "</form>";
echo "</body>";




}




public function getPatientChargesUnpaid_creditCard($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,$registrationNo,$shift) {


$selectedDate = $year."-".$month."-".$day;
$fromTimez = $fromTime_hour.":".$fromTime_minutes.":".$fromTime_seconds;
$toTimez = $toTime_hour.":".$toTime_minutes.":".$toTime_seconds;

$timezone = "Asia/Manila";
date_default_timezone_set ($timezone);

$this->getPatientProfile($registrationNo);

$disc = $this->getUnpaidPatientAmount($registrationNo) * $this->getRegistrationDetails_discount();

$grandTotal = $this->getUnpaidPatientAmount_creditCard($registrationNo) - $disc;

echo "
<script src='http://".$this->getMyUrl()."/COCONUT/serverTime/serverTime.js'></script>
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

.data {
font-size:13px;
}

.shortField {
	border: 1px solid #000;
	color: #000;
	height: 30px;
	width: 120px;
	padding:4px 4px 4px 5px;
}

.labelz {
color:#000;
font-size:14px;
}
</style>";


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientCharges where registrationNo = '$registrationNo' and (status = 'UNPAID' or status = 'BALANCE') and cashUnpaid > 0 group by itemNo order by description asc ");

echo "<body onload='DisplayTime();'>";
echo "<form method='get' action='paymentManager.php'>";
$this->coconutHidden("registrationNo",$registrationNo);
$this->coconutHidden("shift",$shift);
$this->coconutHidden("paidVia","Credit Card");
echo "<div style='border:1px solid #000000; width:750px; height:90px; border-color:black black black black;'>";
echo "<br>&nbsp;&nbsp;";
echo "<font>Payment</font>";
echo "&nbsp;&nbsp;<input type=text name='totalPaid' autocomplete='off' class='shortField' value='".($grandTotal)."'> &nbsp;<font size=2>Credit Card#</font>&nbsp;<input type='text' style='border:1px solid #000000; width:150px;' name='creditCardNo' value=''>&nbsp;&nbsp;&nbsp;<font size=2>Card Type</font>&nbsp;<select name='cardType' style='border:1px solid #000; width:120px;'><option>VISA</option></select>&nbsp;
 <br>";

$this->coconutHidden("paymentType","Cash");
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font>OR#</font><input type=text autocomplete='off' name='orNO' class='shortField'>";

echo "&nbsp;&nbsp;<Font color=red size=2>Date Paid</font>&nbsp;";
$this->coconutDesign();
$this->coconutComboBoxStart_short("month");
echo "<option value='".date("m")."'>".date("M")."</option>";
echo "<option value='01'>Jan</option>";
echo "<option value='02'>Feb</option>";
echo "<option value='03'>Mar</option>";
echo "<option value='04'>Apr</option>";
echo "<option value='05'>May</option>";
echo "<option value='06'>Jun</option>";
echo "<option value='07'>Jul</option>";
echo "<option value='08'>Aug</option>";
echo "<option value='09'>Sep</option>";
echo "<option value='10'>Oct</option>";
echo "<option value='11'>Nov</option>";
echo "<option value='12'>Dec</option>";
$this->coconutComboBoxStop();
echo "-";
$this->coconutComboBoxStart_short("day");
echo "<option value='".date("d")."'>".date("d")."</option>";
for( $x=1;$x<32;$x++ ) {

if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}

}
$this->coconutComboBoxStop();
echo "-";
$this->coconutTextBox_short("year",date("Y"));


echo "<br>&nbsp;&nbsp;&nbsp;<input type=submit value='Paid' style='border:1px solid #000; background-color:#3b5998; color:white'>";
echo "<br></div><br><br>";
echo "<input type=hidden name='username' value='$username'>";
echo "<input type=hidden name='serverTime' value='".date("H:i:s")."'>";


echo "<table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'></font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'></font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Description</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Price</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>QTY</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Disc</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Total</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Time</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Date</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>User</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Payment</font>&nbsp;</th>";
echo "</tr>";



while($row = mysqli_fetch_array($result))
  {

$price = preg_split ("/\//", $row['sellingPrice']); 

echo "<tr>";
echo "<td><input type=checkbox name='cashierPaid[]' value='$row[itemNo]' checked></td>";
echo "<td><center><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/verifyDelete.php?registrationNo=$registrationNo&itemNo=$row[itemNo]&description=$row[description]'>
<img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg' />
</a></center></td>";
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/Cashier/pfCashier.php?itemNo=$row[itemNo]&month=$month&day=$day&year=$year&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&username=$username&registrationNo=$registrationNo&shift=$shift'>".$row['description']."</a></font>&nbsp;</td>";

if($row['title'] == "PROFESSIONAL FEE") {
echo "<td><font class='data'>".number_format($price[0],2)."</font>/<font class='data'>".$price[1]."</font>&nbsp;</td>";
}else {
echo "<td><font class='data'>".number_format($row['sellingPrice'],2)."</font>&nbsp;</td>";
}

echo "<td>&nbsp;<font class='data'>".$row['quantity']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".number_format($row['discount'],2)."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".number_format($row['total'],2)."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['timeCharge']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['dateCharge']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['chargeBy']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data' color=red>".$row['cashUnpaid']."</font>&nbsp;</td>";
echo "<input type=hidden name='chargeStatus' value='".$row['status']."'>";
echo "</tr>";
}
echo "</table>";
echo "</form>";
echo "</body>";




}




public function getPatientCharges_balance_total($registrationNo) {
  $connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
  $result = mysqli_query($connection, "SELECT sum(cashUnpaid) as unpaid FROM patientCharges where registrationNo = '$registrationNo' and cashUnpaid > 0 and paidVia ='Cash' and status not like 'DELETED%%%%'") or die("Query fail: " . mysqli_error()); 

  while($row = mysqli_fetch_array($result)) {
    ($row['unpaid'] > 0) ? $x = $row['unpaid'] : $x = 0;
    return $x;
  }
}


public function getPatientCharges_balance($registrationNo,$username) {

$timezone = "Asia/Manila";
date_default_timezone_set ($timezone);

echo "
<script src='http://".$this->getMyUrl()."/COCONUT/serverTime/serverTime.js'></script>
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

.data {
font-size:13px;
}

.shortField {
	border: 1px solid #000;
	color: #000;
	height: 30px;
	width: 120px;
	padding:4px 4px 4px 5px;
}

.labelz {
color:#000;
font-size:14px;
}
</style>";


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }


((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientCharges where registrationNo = '$registrationNo' and cashUnpaid > 0 and paidVia ='Cash' and status not like 'DELETED%%%%%%' group by itemNo order by description asc ");

echo "<body onload='DisplayTime();'>";
echo "<form method='get' action='paymentManager.php'>";
echo "<div style='border:1px solid #000000; width:1000px; height:160px; border-color:black black black black;'>";
echo "<br>&nbsp;&nbsp;<font class='labelz'>Cash:</font>&nbsp;&nbsp;<input type=text name='totalPaid' class='shortField' value='".$this->getPatientCharges_balance_total($registrationNo)."'><br>";
echo "&nbsp;&nbsp;&nbsp;<font class='labelz' color='red'>OR#:</font>&nbsp;<input type='text' class='shortField' name='orNO' autocomplete='off' value=''><br>";
echo "&nbsp;&nbsp;&nbsp;<font class='labelz'>Date Paid</font>:&nbsp;";
$this->coconutComboBoxStart_short("month");
echo "<option value='01'>Jan</option>";
echo "<option value='02'>Feb</option>";
echo "<option value='03'>Mar</option>";
echo "<option value='04'>Apr</option>";
echo "<option value='05'>May</option>";
echo "<option value='06'>Jun</option>";
echo "<option value='07'>Jul</option>";
echo "<option value='08'>Aug</option>";
echo "<option value='09'>Sep</option>";
echo "<option value='10'>Oct</option>";
echo "<option value='11'>Nov</option>";
echo "<option value='12'>Dec</option>";
$this->coconutComboBoxStop();
echo "-";
$this->coconutComboBoxStart_short("day");
$x=32;
for($a=1;$a<$x;$a++) {
if($a < 10) {
echo "<option value='0$a'>0$a</option>";
}else {
echo "<option value='$a'>$a</option>";
}
}
$this->coconutComboBoxStop();
echo "-";
$this->coconutTextBox_short("year",date("Y"));
echo "<br>";
echo "&nbsp;&nbsp;Shift:&nbsp;";
$this->coconutComboBoxStart_long("shift");
echo "<option>Morning</option>";
echo "<option>Noon</option>";
echo "<option>Afternoon</option>";
echo "<option>Night</option>";
$this->coconutComboBoxStop();
echo "<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=submit value='Payment' style='border:1px solid #000; background-color:#3b5998; color:white'>";
echo "<br></div><br><br>";
$this->coconutHidden("username",$username);
$this->coconutHidden("registrationNo",$registrationNo);
$this->coconutHidden("paymentType","Cash");
$this->coconutHidden("serverTime",date("H:i:s"));
$this->coconutHidden("chargeStatus","");
$this->coconutHidden("cardType","");
$this->coconutHidden("creditCardNo","");
$this->coconutHidden("paidVia","Cash");
$this->coconutHidden("chargeStatus","UNPAID");
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td><input type=checkbox name='cashierPaid[]' value='$row[itemNo]' checked></td>";
echo "<td><center><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/verifyDelete.php?registrationNo=$registrationNo&itemNo=$row[itemNo]&description=$row[description]&quantity=$row[quantity]'>
<img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg' />
</a></center></td>";
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]'>".$row['description']."</a></font>&nbsp;</td>";
echo "<td><font class='data'>".number_format($row['sellingPrice'],2)."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['quantity']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".number_format($row['discount'],2)."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".number_format($row['total'],2)."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['timePaid']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['datePaid']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['paidBy']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['status']."</font>&nbsp;</td>";
if($row['paidVia']=="Company") {
echo "<td>&nbsp;<font class='data' color=red>".$row['paidVia']."</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font class='data' color=blue>".$row['paidVia']."</font>&nbsp;</td>";
}
echo "<td>&nbsp;<font class='data'>".$row['cashPaid']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['cashUnpaid']."</font>&nbsp;</td>";
echo "</tr>";
  }

echo "</form>";
echo "</body>";


}







public $patientRecordz_lastName;
public $patientRecordz_firstName;
public $patientRecordz_middleName;
public $patientRecordz_contactNo;
public $patientRecordz_birthDate;
public $patientRecordz_Gender;
public $patientRecordz_Senior;
public $patientRecordz_PHIC;
public $patientRecordz_civilStatus;
public $patientRecordz_address;
public $patientRecordz_phicType;


public function getLastName_patientRecord() {
return $this->patientRecordz_lastName;
}
public function getFirstName_patientRecord() {
return $this->patientRecordz_firstName;
}
public function getMiddleName_patientRecord() {
return $this->patientRecordz_middleName;
}
public function getContactNo_patientRecord() {
return $this->patientRecordz_contactNo;
}
public function getBirthDate_patientRecord() {
return $this->patientRecordz_birthDate;
}
public function getGender_patientRecord() {
return $this->patientRecordz_Gender;
}
public function getSenior_patientRecord() {
return $this->patientRecordz_Senior;
}
public function getPHIC_patientRecord() {
return $this->patientRecordz_PHIC;
}
public function getCivilStatus_patientRecord() {
return $this->patientRecordz_civilStatus;
}
public function getAddress_patientRecord() {
return $this->patientRecordz_address;
}
public function getPHICtype_patientRecord() {
return $this->patientRecordz_phicType;
}


public function setPatientRecord($patientNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientRecord where patientNo='$patientNo' ");

while($row = mysqli_fetch_array($result))
  {
$this->patientRecordz_lastName = $row['lastName'];
$this->patientRecordz_firstName = $row['firstName'];
$this->patientRecordz_middleName = $row['middleName'];
$this->patientRecordz_contactNo = $row['contactNo'];
$this->patientRecordz_birthDate = $row['Birthdate'];
$this->patientRecordz_Gender = $row['Gender'];
$this->patientRecordz_Senior = $row['Senior'];
$this->patientRecordz_PHIC = $row['PHIC'];
$this->patientRecordz_civilStatus = $row['civilStatus'];
$this->patientRecordz_address = $row['Address'];
$this->patientRecordz_phicType = $row['religion'];
  }

}




public function verifyRecord($name,$from) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover{ background-color:yellow; color:black; }
</style>
";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pr.patientNo,(pr.completeName) as completeName,pr.Birthdate,pr.Gender,pr.lastName,pr.firstName,pr.middleName,pr.contactNo,pr.Birthdate,pr.manual_patientNo FROM patientRecord pr where (pr.completeName like '$name%%%%%%%' or pr.manual_patientNo = '$name') and statusz not like 'DELETED%%%%%%%%' group by pr.patientNo order by pr.lastName,pr.firstName,pr.middleName asc ");

echo "<br>&nbsp;  <table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo  "<th bgcolor='#3b5998'>&nbsp;<font color=white>PIN#</font>&nbsp;</th>";
echo  "<th bgcolor='#3b5998'>&nbsp;<font color=white>Patient's Name</font>&nbsp;</th>";
echo  "<th bgcolor='#3b5998'>&nbsp;<font color=white>BirthDate</font>&nbsp;</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;<a href='/Registration/deleteRecord.php?patientNo=$row[patientNo]&from=$from' style='text-decoration:none;'>".$row['manual_patientNo']."&nbsp;</td>";
echo "<td>&nbsp;<a href='/Registration/checkingStop.php?patientNo=$row[patientNo]&date=".date("y-m-d")."&from=$from'>".$row['completeName']."</a>&nbsp;</td>";
echo "<td>&nbsp;".$row['Birthdate']."&nbsp;</td>";
echo "</tr>";
  }
echo "</table>";

}




public function verifyBaby($name,$motherRegistrationNo) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover{ background-color:yellow; color:black; }
</style>
";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT rd.registrationNo,rd.registeredBy,rd.dateRegistered,pr.patientNo,(pr.completeName) as completeName,pr.Birthdate,pr.Gender,pr.lastName,pr.firstName,pr.middleName,pr.contactNo,pr.Birthdate,pr.Gender,pr.Senior,pr.PHIC,pr.civilStatus,pr.Address,pr.religion FROM patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and pr.completeName like '$name%%%%%%%' group by pr.patientNo ");

echo "<br>&nbsp;  <table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo  "<th bgcolor='#3b5998'>&nbsp;<font color=white>Patient's Name</font>&nbsp;</th>";
echo  "<th bgcolor='#3b5998'>&nbsp;<font color=white>BirthDate</font>&nbsp;</th>";
echo  "<th bgcolor='#3b5998'>&nbsp;<font color=white>Gender</font>&nbsp;</th>";
echo  "<th bgcolor='#3b5998'>&nbsp;<font color=white>Register</font>&nbsp;</th>";
echo  "<th bgcolor='#3b5998'>&nbsp;<font color=white>Register By</font>&nbsp;</th>";
echo  "<th bgcolor='#3b5998'>&nbsp;<font color=white></font>&nbsp;</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;".$row['completeName']."</td>";
echo "<td>&nbsp;".$row['Birthdate']."&nbsp;</td>";
echo "<td>&nbsp;".$row['Gender']."&nbsp;</td>";
echo "<td>&nbsp;".$row['dateRegistered']."&nbsp;</td>";
echo "<td>&nbsp;".$row['registeredBy']."&nbsp;</td>";
echo "<td>&nbsp;<a href='/COCONUT/patientProfile/nbs/addBaby.php?motherRegistrationNo=$motherRegistrationNo&babyRegistrationNo=$row[registrationNo]'><font color=blue>Add</font></a>&nbsp;</td>";
echo "</tr>";
  }
echo "</table>";

}





public function verifyRecord_shortRegister($name) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover{ background-color:yellow; color:black; }
</style>
";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pr.patientNo,(pr.completeName) as completeName,pr.Birthdate,pr.Gender,pr.lastName,pr.firstName,pr.middleName,pr.contactNo,pr.Birthdate,pr.Gender,pr.Senior,pr.PHIC,pr.civilStatus,pr.Address,pr.phicType FROM patientRecord pr where pr.completeName like '$name%%%%%%%' and statusz not like 'DELETED%%%%%%' group by pr.patientNo ");

echo "<br>&nbsp;  <table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo  "<th bgcolor='#3b5998'>&nbsp;<font color=white>Patient's Name</font>&nbsp;</th>";
echo  "<th bgcolor='#3b5998'>&nbsp;<font color=white>BirthDate</font>&nbsp;</th>";
echo  "<th bgcolor='#3b5998'>&nbsp;<font color=white>Gender</font>&nbsp;</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;<a href='/Registration/specialRegistration/shortRegistration_again.php?patientNo=$row[patientNo]'>".$row['completeName']."</a>&nbsp;</td>";
echo "<td>&nbsp;".$row['Birthdate']."&nbsp;</td>";
echo "<td>&nbsp;".$row['Gender']."&nbsp;</td>";
echo "</tr>";
  }
echo "</table>";

}




public function showInventoryLocation() {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT inventoryLocation FROM inventoryLocation order by orderzz asc ");

while($row = mysqli_fetch_array($result))
  {
echo "<option value='".$row['inventoryLocation']."'>".$row['inventoryLocation']."</option>";
  }

}




//UNIVERSAL OPTION PRA SA COMOBOX
public function showOption($table,$cols) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT ($cols) cols FROM $table order by cols asc ");

while($row = mysqli_fetch_array($result))
  {
echo "<option value='".$row['cols']."'>".$row['cols']."</option>";
  }

}

public function showOption_with_value($table,$cols,$value) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT ($cols) cols,($value) as value FROM $table order by cols asc ");

while($row = mysqli_fetch_array($result))
  {
echo "<option value='".$row['value']."'>".$row['cols']."</option>";
  }

}


public function showOption_group($table,$cols) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT ($cols) cols FROM $table group by cols order by cols asc ");

while($row = mysqli_fetch_array($result))
  {
echo "<option value='".$row['cols']."'>".$row['cols']."</option>";
  }

}



public function showOption_radio() {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT category,title FROM radioReportList order by category asc ");

while($row = mysqli_fetch_array($result))
  {
echo "<option value='".$row['title']."'>".$row['category']." - ".$row['title']."</option>";
  }

}

public function showOptionRoom($table,$cols,$cols1) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT ($cols) cols,($cols1) as cols1 FROM $table WHERE status = 'Vacant' order by cols asc ");

while($row = mysqli_fetch_array($result))
  {
echo "<option value='".$row['cols']."'>".$row['cols']." - ".$row['cols1']."</option>";
  }

}


//UNIVERSAL OPTION PRA SA COMOBOX NA MEI KXAMANG WHERE CLAUSE
public function showOption_where($table,$cols,$identifier,$identifierData) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT ($cols) cols FROM $table WHERE $identifier = '$identifierData' order by cols asc ");

while($row = mysqli_fetch_array($result))
  {
echo "<option value='".$row['cols']."'>".$row['cols']."</option>";
  }

}


//UNIVERSAL OPTION PRA SA COMOBOX NA MEI KXAMANG WHERE CLAUSE
public function showOption_doubleWhere($table,$cols,$identifier,$identifierData,$identifier1,$identifierData1) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT ($cols) cols FROM $table WHERE $identifier = '$identifierData' and $identifier1 = '$identifierData1' order by cols asc ");

while($row = mysqli_fetch_array($result))
  {
echo "<option value='".$row['cols']."'>".$row['cols']."</option>";
  }

}


//UNIVERSAL OPTION PRA SA COMOBOX NA MEI KXAMANG WHERE CLAUSE
public function showOption_doubleWhere_group($table,$cols,$identifier,$identifierData,$identifier1,$identifierData1,$group) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT ($cols) cols FROM $table WHERE $identifier = '$identifierData' and $identifier1 = '$identifierData1' order by cols asc ");

while($row = mysqli_fetch_array($result))
  {
echo "<option value='".$row['cols']."'>".$row['cols']."</option>";
  }

}


public function who_occupied_d_room($roomNo) {


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT registrationNo,room from registrationDetails WHERE room like '$roomNo%%%' and dateUnregistered = ''  ");

while($row = mysqli_fetch_array($result))
  {
return $row['registrationNo'];
  }


}



public function getPatient_in_the_room($room) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pr.lastName,pr.firstName,rd.dateRegistered,rd.registrationNo from patientRecord pr,registrationDetails rd WHERE rd.room = '$room' and rd.dateUnregistered = '' and pr.patientNo = rd.patientNo and rd.dateRegistered not like 'DELETED%%%%%%%%' ");


while($row = mysqli_fetch_array($result))
  {
return "&nbsp;<font size=1 color=black>$row[registrationNo]-".$row['lastName'].", ".$row['firstName']." </font>";
  }

}



public function showVacantRoom($branch) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT Description FROM room order by Description asc ");

while($row = mysqli_fetch_array($result))
  {
    $patient = $this->getPatient_in_the_room($row['Description']);
    if($patient == "") {
    echo "<option value='".$row['Description']."'>".$row['Description']."</option>";
  }else {
    echo "<option value='".$row['Description']."' style='color:red;' disabled>".$row['Description']." - ".$patient."</option>";
  }
  }

}

public function showExam() {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT Description,chargesCode FROM availableCharges order by Description asc ");

while($row = mysqli_fetch_array($result))
  {
echo "<option value='".$row['chargesCode']."'>".$row['Description']."</option>";
  }

}


public function showCivilStatus() {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT civilStatus FROM civilStatus order by civilStatus asc ");

while($row = mysqli_fetch_array($result))
  {
echo "<option value='".$row['civilStatus']."'>".$row['civilStatus']."</option>";
  }

}




public function addInventoryStockCard($stockCardNo,$description,$genericName,$encodedDetails,$encodedBy,$inventoryType) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into inventoryStockCard(stockCardNo,description,genericName,encodedDetails,encodedBy,inventoryType) values('$stockCardNo','$description','$genericName','$encodedDetails','$encodedBy','$inventoryType')";


 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
//$this->gotoPage("http://".$this->getMyUrl()."/COCONUT/android/doctor/mobileAddCharges_medicine.php?registrationNo=$registrationNo&batchNo=$batchNo&room=$room&username=$username");
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}

/* close our connection */
$sql->close();
}


//For Purchasing-Mark
public function addNewMedicinepurch($stockCardNo,$description,$generic,$unitcost,$quantity,$expiration,$addedBy,$dateAdded,$timeAdded,$inventoryLocation,$inventoryType,$branch,$transition,$remarks,$preparation,$phic,$added,$criticalLevel,$supplier,$begCapital,$begQTY,$suppliesUNITCOST,$autoDispense,$status,$classification,$description1,$genericName1,$ipdPrice,$opdPrice,$username,$sino,$page,$invoiceNo,$freegoods,$trueunitcost,$encodedQTY) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO inventory (stockCardNo,description,genericName,unitcost,quantity,expiration,addedBy,dateAdded,timeAdded,inventoryLocation,inventoryType,branch,transition,remarks,preparation,phic,Added,criticalLevel,supplier,beginningCapital,beginningQTY,suppliesUNITCOST,autoDispense,classification,ipdPrice,opdPrice,invoiceNo,fgQuantity,encodedQTY)
VALUES
('$stockCardNo','$description','$generic','$unitcost','$quantity','$expiration','$addedBy','$dateAdded','$timeAdded','$inventoryLocation','$inventoryType','$branch','$transition','$remarks','$preparation','$phic','$added','$criticalLevel','$supplier','$begCapital','$begQTY','$suppliesUNITCOST','$autoDispense','$classification','$ipdPrice','$opdPrice','$invoiceNo','$freegoods','$encodedQTY')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

$pdate=date("Ymd");
$cdatesql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT counterdate FROM counters WHERE counterdate='$pdate'");
$cdatecount=mysqli_num_rows($cdatesql);

if($cdatecount==0){
mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE counters SET counterdate='$pdate', counter02='0'");
}

$c02sql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT counter02 FROM counters");
while($c02fetch=mysqli_fetch_array($c02sql)){$c02=$c02fetch['counter02'];}

if($c02<10){$refNo=$pdate."000".$c02;}
else if(($c02<100)&&($c02>9)){$refNo=$pdate."00".$c02;}
else if(($c02<1000)&&($c02>99)){$refNo=$pdate."0".$c02;}
else {$refNo=$pdate.$c02;}

$c02plus=$c02+1;

$dateEncoded=date("YmdHi");

$asql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT inventoryCode FROM inventory ORDER BY CAST(inventoryCode AS UNSIGNED), inventoryCode");
while($afetch=mysqli_fetch_array($asql)){$inventoryCode=$afetch['inventoryCode'];}

$qty=$quantity-$freegoods;

if($inventoryType=='medicine'){
mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO salesInvoiceItems VALUES('$refNo', '$sino', '$inventoryCode', '$description', '$preparation', '$trueunitcost', '$qty', '$freegoods', '$inventoryType', 'Active', '$username', '$dateEncoded')");
}
else{
mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO salesInvoiceItems VALUES('$refNo', '$sino', '$inventoryCode', '$description', '$preparation', '$trueunitcost', '$qty', '$freegoods', '$inventoryType', 'Active', '$username', '$dateEncoded')");
}

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE counters SET counter02='$c02plus'");

echo "<script type='text/javascript' >";
echo "alert('$description was Successfully Added to the List of $inventoryType');";

if( $inventoryType == "medicine" ) {
echo  "window.location='http://".$this->getMyUrl()."/Purchasing/CreatedReceivingReport.php?username=$username&sino=$sino&page=0'";
}else {
echo  "window.location='http://".$this->getMyUrl()."/Purchasing/CreatedReceivingReport.php?username=$username&sino=$sino&page=0'";
}

echo "</script>";

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}
//End For Purchasing-Mark

public function addNewMedicine($stockCardNo,$description,$generic,$unitcost,$quantity,$expiration,$addedBy,$dateAdded,$timeAdded,$inventoryLocation,$inventoryType,$branch,$transition,$remarks,$preparation,$phic,$added,$criticalLevel,$supplier,$begCapital,$begQTY,$suppliesUNITCOST,$autoDispense,$status,$classification,$description1,$genericName1,$ipdPrice,$opdPrice,$unitOfMeasure,$biQTY,$biInventoryCode,$encodedQTY,$invoiceNo,$lock) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO inventory (stockCardNo,description,genericName,unitcost,quantity,expiration,addedBy,dateAdded,timeAdded,inventoryLocation,inventoryType,branch,transition,remarks,preparation,phic,Added,criticalLevel,supplier,beginningCapital,beginningQTY,suppliesUNITCOST,autoDispense,classification,ipdPrice,opdPrice,unitOfMeasure,lastEnd_QTY,lastEnd_inventoryCode,encodedQTY,invoiceNo,locked)
VALUES
('$stockCardNo','$description','$generic','$unitcost','$quantity','$expiration','$addedBy','$dateAdded','$timeAdded','$inventoryLocation','$inventoryType','$branch','$transition','$remarks','$preparation','$phic','$added','$criticalLevel','$supplier','$begCapital','$begQTY','$suppliesUNITCOST','$autoDispense','$classification','$ipdPrice','$opdPrice','$unitOfMeasure','$biQTY','$biInventoryCode','$encodedQTY','$invoiceNo','$lock')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

echo "<script type='text/javascript' >";
echo "alert('$description was Successfully Added to the List of $inventoryType');";

if( $inventoryType == "medicine" ) {
echo  "window.location='http://".$this->getMyUrl()."/COCONUT/inventory/addInventory.php?username=$addedBy&status=$status&stockCardNo=$stockCardNo&description=$description1&genericName=$genericName1'";
}else {
echo  "window.location='http://".$this->getMyUrl()."/COCONUT/inventory/addInventory_supplies.php?username=$addedBy&status=$status&stockCardNo=$stockCardNo&description=$description1&genericName=$genericName1'";
}

echo "</script>";

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}





//pra sa receiving of request
public function addNewMedicine1($stockCardNo,$description,$generic,$preparation,$unitcost,$quantity,$expiration,$addedBy,$dateAdded,$timeAdded,$inventoryLocation,$inventoryType,$branch,$transition,$remarks,$price,$inventoryCode) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if( $inventoryType == "medicine" ) {
$sql="INSERT INTO inventory (stockCardNo,description,genericName,preparation,unitcost,quantity,expiration,addedBy,dateAdded,timeAdded,inventoryLocation,inventoryType,branch,transition,remarks,Added,autoDispense,from_inventoryCode,beginningQTY)
VALUES
('$stockCardNo','$description','$generic','$preparation','$unitcost','$quantity','$expiration','$addedBy','$dateAdded','$timeAdded','$inventoryLocation','$inventoryType','$branch','$transition','$remarks','$price','yes','$inventoryCode','$quantity')";
}else {
$sql="INSERT INTO inventory (stockCardNo,description,genericName,suppliesUNITCOST,quantity,expiration,addedBy,dateAdded,timeAdded,inventoryLocation,inventoryType,branch,transition,remarks,unitcost,autoDispense,from_inventoryCode,beginningQTY)
VALUES
('$stockCardNo','$description','$generic','$unitcost','$quantity','$expiration','$addedBy','$dateAdded','$timeAdded','$inventoryLocation','$inventoryType','$branch','$transition','$remarks','$price','yes','$inventoryCode','$quantity')";
}


if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }


echo "
<script type='text/javascript'>
alert('$description Received');
window.location='http://".$this->getMyUrl()."/COCONUT/availableMedicine/receivingRequest.php?module=$inventoryLocation&username=$addedBy&branch=$branch'
</script>

";

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



//ITO UNG KKUHA NG PERCENTAGE PRA SA SENIOR DISC,MEDICINE

public function percentage($percentageType) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT percentageAmount FROM percentage WHERE percentageType = '$percentageType' ");

while($row = mysqli_fetch_array($result))
  {
return $row['percentageAmount'];
  }

}



public function total_request($inventoryCode,$title) {
  $connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
  $result = mysqli_query($connection, "SELECT sum(quantity) as qty FROM patientCharges WHERE chargesCode = '$inventoryCode' and title = '$title' and status not like 'DELETED%' and departmentStatus not like 'dispensedBy%'  ") or die("Query fail: " . mysqli_error()); 

  while($row = mysqli_fetch_array($result)) {
    ($row['qty'] > 0) ? $x = $row['qty'] : $x = 0;
    return $x;
  }
}


public $med_sp;

public function getAvailableMedicine($searchBy,$searchDesc,$registrationNo,$batchNo,$serverTime,$username,$searchFrom,$branch,$room) {


echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}
.style4 {
font-size:15px;
}
</style>
";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT i.stockCardNo,i.phic,i.preparation,i.inventoryCode,i.description,i.genericName,((i.unitcost * ".$this->percentage("medicine").") + i.unitcost) as sellingPrice,i.quantity,i.unitcost,i.Added,i.ipdPrice,i.opdPrice,i.locked FROM inventoryStockCard isc,inventory i WHERE isc.stockCardNo = i.stockCardNo and (i.description like '%%%%%%$searchDesc%%%%%%%' or i.genericName like '%$searchDesc%' ) and i.inventoryType = 'medicine' and i.inventoryLocation = '$searchFrom' and i.status not like 'DELETED_%%%%%' and isc.status not like 'DELETED%' and i.quantity > 0 order by i.".$searchBy." asc ");

echo "<table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>Generic</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>Description</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>Prep</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>Price</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>QTY</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>&nbsp;</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>&nbsp;</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>&nbsp;</font>&nbsp;</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {

$inventoryCode = $row['inventoryCode'];
$sellingPrice = $row['sellingPrice'];
$description = $row['description'];
$genericName = $row['genericName'];
$preparation = $row['preparation'];
$opdPrice = $row['opdPrice'];
$ipdPrice = $row['ipdPrice'];
$quantity = $row['quantity'];

echo "<tr>";
$senior = $sellingPrice * $this->percentage("senior");
$priceOption = preg_split ("/\_/", $row['Added']); 

if( $this->selectNow("registrationDetails","type","registrationNo",$registrationNo) == "OPD" ) {
$this->med_sp = $row['opdPrice'];
}else {
$this->med_sp = $row['ipdPrice'];
}

echo "<td class='style4'>&nbsp;".$genericName."</a>&nbsp;</td>";
echo "<td class='style4'>&nbsp;".$description."</a>&nbsp;</td>";
echo "<td class='style4'>&nbsp;".$preparation."&nbsp;</td>";
$this->getPatientProfile($registrationNo);
echo "<td class='style4'>&nbsp;".number_format($this->med_sp,2)."&nbsp;</td>";
echo "<td class='style4'>&nbsp;".$quantity."&nbsp;</td>";



if( $row['locked'] == "yes" ) {
echo "<td align='center'>".$this->coconutImages_return("locked1.jpeg")."</td>";
echo "<td align='center'>".$this->coconutImages_return("locked1.jpeg")."</td>";
echo "<td align='center'>".$this->coconutImages_return("locked1.jpeg")."</td>";
echo "<td align='center'>".$this->coconutImages_return("locked1.jpeg")."</td>";
}else {

echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/availableMedicine/cashQTY.php?status=UNPAID&registrationNo=$registrationNo&chargesCode=$inventoryCode&description=$description&sellingPrice=".$this->med_sp."&timeCharge=$serverTime&chargeBy=$username&service=Medication&title=MEDICINE&paidVia=Cash&cashPaid=0&batchNo=$batchNo&username=$username&inventoryFrom=$searchFrom&discount=0&room=$room&paycash=no&remarks=&stockCardNo=$row[stockCardNo]'><font color=blue size='3'>[Add]</font></a>&nbsp;";
echo "</td>";



if( $this->selectNow("registrationDetails","type","registrationNo",$registrationNo) == "OPD" ) {
//if($acount>0){
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/availableMedicine/cashQTY.php?status=UNPAID&registrationNo=$registrationNo&chargesCode=$inventoryCode&description=$description&sellingPrice=".$this->med_sp."&timeCharge=$serverTime&chargeBy=$username&service=Medication&title=MEDICINE&paidVia=Cash&cashPaid=0&batchNo=$batchNo&username=$username&inventoryFrom=$searchFrom&discount=0&room=$room&paycash=no&remarks=VAT&stockCardNo=$row[stockCardNo]'><font color=green size='3'>[VAT]</font></a>&nbsp;";
echo "</td>";
//}
}else {

}

echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/availableMedicine/cashQTY_date.php?status=UNPAID&registrationNo=$registrationNo&chargesCode=$inventoryCode&description=$description&sellingPrice=".$this->med_sp."&timeCharge=$serverTime&chargeBy=$username&service=Medication&title=MEDICINE&paidVia=Cash&cashPaid=0&batchNo=$batchNo&username=$username&inventoryFrom=$searchFrom&discount=0&room=$room&paycash=no&remarks=&stockCardNo=$row[stockCardNo]'><font color=brown size='2'>[Add w/ Date]</font></a>&nbsp;";
echo "</td>";


if( $this->selectNow("registrationDetails","type","registrationNo",$registrationNo) == "IPD" ) {

if( $this->selectNow("registeredUser","module","username",$username) == "CASHIER" || $this->selectNow("registeredUser","module","username",$username) == "BILLING" || $this->selectNow("registeredUser","module","username",$username) == "PHARMACY" ) {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/availableMedicine/cashQTY.php?status=UNPAID&registrationNo=$registrationNo&chargesCode=$inventoryCode&description=$description&sellingPrice=".$this->med_sp."&timeCharge=$serverTime&chargeBy=$username&service=Medication&title=MEDICINE&paidVia=Cash&cashPaid=0&batchNo=$batchNo&username=$username&inventoryFrom=$searchFrom&discount=0&room=$room&paycash=no&remarks=takeHomeMeds&stockCardNo=$row[stockCardNo]'><font color=red size='1'>[Take Home Meds]</font></a></td>";
}else { }
}else { }

}

echo "</tr>";


}
echo "</table>";

}




public $sup_sp;



public function getAvailableSupplies($searchBy,$searchDesc,$registrationNo,$batchNo,$serverTime,$username,$searchFrom,$branch) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}
</style>
";


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT inventoryCode,stockCardNo,description,unitcost,quantity,classification,classification FROM inventory WHERE $searchBy like '%%%%%%%%$searchDesc%%%%%%%' and inventoryType = 'supplies' and inventoryLocation = '$searchFrom' and quantity > 0 and status not like 'DELETED_%%%%%%' group by description order by $searchBy asc ");

echo "<table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>Description</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>Price</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>QTY</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>&nbsp;</font>&nbsp;</th>";
if( $this->selectNow("registeredUser","module","username",$username) == "PHARMACY" || $this->selectNow("registeredUser","module","username",$username) == "CASHIER" ) {
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>&nbsp;</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>&nbsp;</font>&nbsp;</th>";
}
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>&nbsp;</font>&nbsp;</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
$senior = $row['unitcost'] * $this->percentage("senior");
echo "<td>&nbsp;<a href='#'>".$row['description']."</a>&nbsp;</td>";

echo "<td>&nbsp;".($row['unitcost'])."&nbsp;</td>";
$this->sup_sp = ($row['unitcost']);



echo "<td>&nbsp;".$row['quantity']."&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/availableMedicine/quantity.php?status=UNPAID&registrationNo=$registrationNo&chargesCode=$row[inventoryCode]&description=$row[description]&sellingPrice=".$this->sup_sp."&timeCharge=$serverTime&chargeBy=$username&service=Others&title=SUPPLIES&paidVia=Cash&cashPaid=0&batchNo=$batchNo&username=$username&inventoryFrom=$searchFrom&discount=0&room=&paycash=no&remarks=&classification=$row[classification]&stockCardNo=$row[stockCardNo]'><font color=blue>[Add]</font></a>&nbsp;</td>";

if( $this->selectNow("registeredUser","module","username",$username) == "PHARMACY" || $this->selectNow("registeredUser","module","username",$username) == "CASHIER" ) {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/availableSupplies/phicQTY.php?status=UNPAID&registrationNo=$registrationNo&chargesCode=$row[inventoryCode]&description=$row[description]&sellingPrice=$row[unitcost]&timeCharge=$serverTime&chargeBy=$username&service=Medication&title=SUPPLIES&paidVia=Cash&cashPaid=0&batchNo=$batchNo&username=$username&inventoryFrom=$searchFrom&discount=0&room=".$this->getRegistrationDetails_room()."&remarks=VAT&paycash=yes'><font color=green>[VAT]</font></a>&nbsp;</td>";

echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/availableSupplies/phicQTY.php?status=UNPAID&registrationNo=$registrationNo&chargesCode=$row[inventoryCode]&description=$row[description]&sellingPrice=$row[unitcost]&timeCharge=$serverTime&chargeBy=$username&service=Medication&title=SUPPLIES&paidVia=Cash&cashPaid=0&batchNo=$batchNo&username=$username&inventoryFrom=$searchFrom&discount=0&room=".$this->getRegistrationDetails_room()."&remarks=&paycash=yes'><font color=red size=2>Pay Cash</font></a>&nbsp;</td>";
}else { /*do nothing*/  }
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/availableMedicine/quantity_date.php?status=UNPAID&registrationNo=$registrationNo&chargesCode=$row[inventoryCode]&description=$row[description]&sellingPrice=".$this->sup_sp."&timeCharge=$serverTime&chargeBy=$username&service=Others&title=SUPPLIES&paidVia=Cash&cashPaid=0&batchNo=$batchNo&username=$username&inventoryFrom=$searchFrom&discount=0&room=&paycash=no&remarks=&classification=$row[classification]&stockCardNo=$row[stockCardNo]'><font color=brown size=2>[Add w/ Date]</font></a>&nbsp;";
echo "</tr>";
}
echo "</table>";
}




public $patientCharges_itemNo;
public $patientCharges_status;
public $patientCharges_registrationNo;
public $patientCharges_chargesCode;
public $patientCharges_description;
public $patientCharges_sellingPrice;
public $patientCharges_quantity;
public $patientCharges_discount;
public $patientCharges_total;
public $patientCharges_cashUnpaid;
public $patientCharges_phic;
public $patientCharges_company;
public $patientCharges_timeCharge;
public $patientCharges_dateCharge;
public $patientCharges_chargeBy;
public $patientCharges_service;
public $patientCharges_title;
public $patientCharges_paidVia;
public $patientCharges_cashPaid;
public $patientCharges_batchNo;
public $patientCharges_inventoryFrom;
public $patientCharges_cashCovered;
public $patientCharges_companyCovered;
public $patientCharges_phicCovered;
public $patientCharges_branch;
public $patientCharges_remarks;


//IF PAID
public $patientCharges_datePaid;
public $patientCharges_timePaid;
public $patientCharges_paidBy;

public function patientCharges_ItemNo() {
return $this->patientCharges_itemNo;
}
public function patientCharges_status() {
return $this->patientCharges_status;
}
public function patientCharges_registrationNo() {
return $this->patientCharges_registrationNo;
}
public function patientCharges_chargesCode() {
return $this->patientCharges_chargesCode;
}
public function patientCharges_Description() {
return $this->patientCharges_description;
}
public function patientCharges_sellingPrice() {
return $this->patientCharges_sellingPrice;
}
public function patientCharges_quantity() {
return $this->patientCharges_quantity;
}
public function patientCharges_discount() {
return $this->patientCharges_discount;
}
public function patientCharges_total() {
return $this->patientCharges_total;
}
public function patientCharges_cashUnpaid() {
return $this->patientCharges_cashUnpaid;
}
public function patientCharges_phic() {
return $this->patientCharges_phic;
}
public function patientCharges_company() {
return $this->patientCharges_company;
}
public function patientCharges_timeCharge() {
return $this->patientCharges_timeCharge;
}
public function patientCharges_dateCharge() {
return $this->patientCharges_dateCharge;
}
public function patientCharges_chargeBy() {
return $this->patientCharges_chargeBy;
}
public function patientCharges_service() {
return $this->patientCharges_service;
}
public function patientCharges_title() {
return $this->patientCharges_title;
}
public function patientCharges_paidVia() {
return $this->patientCharges_paidVia;
}
public function patientCharges_cashPaid() {
return $this->patientCharges_cashPaid;
}
public function patientCharges_batchNo() {
return $this->patientCharges_batchNo;
}
public function patientCharges_inventoryFrom() {
return $this->patientCharges_inventoryFrom;
}

public function patientCharges_companyCovered() {
return $this->patientCharges_companyCovered;
}

public function patientCharges_phicCovered() {
return $this->patientCharges_phicCovered;
}

public function patientCharges_branch() {
return $this->patientCharges_branch;
}

public function patientCharges_datePaid() {
return $this->patientCharges_datePaid;
}

public function patientCharges_timePaid() {
return $this->patientCharges_timePaid;
}

public function patientCharges_paidBy() {
return $this->patientCharges_paidBy;
}

public function patientCharges_remarks() {
return $this->patientCharges_remarks;
}



public function getPatientChargesToEdit($itemNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientCharges WHERE itemNo = '$itemNo' ");

while($row = mysqli_fetch_array($result))
  {
$this->patientCharges_itemNo = $row['itemNo'];
$this->patientCharges_status = $row['status'];
$this->patientCharges_registrationNo = $row['registrationNo'];
$this->patientCharges_chargesCode = $row['chargesCode'];
$this->patientCharges_description = $row['description'];
$this->patientCharges_sellingPrice = $row['sellingPrice'];
$this->patientCharges_quantity = $row['quantity'];
$this->patientCharges_discount = $row['discount'];
$this->patientCharges_total = $row['total'];
$this->patientCharges_cashUnpaid = $row['cashUnpaid'];
$this->patientCharges_phic = $row['phic'];
$this->patientCharges_company = $row['company'];
$this->patientCharges_timeCharge = $row['timeCharge'];
$this->patientCharges_dateCharge = $row['dateCharge'];
$this->patientCharges_chargeBy = $row['chargeBy'];
$this->patientCharges_service = $row['service'];
$this->patientCharges_title = $row['title'];
$this->patientCharges_paidVia = $row['paidVia'];
$this->patientCharges_cashPaid = $row['cashPaid'];
$this->patientCharges_batchNo = $row['batchNo'];
$this->patientCharges_inventoryFrom = $row['inventoryFrom'];
$this->patientCharges_companyCovered = $row['company'];
$this->patientCharges_phicCovered = $row['phic'];
$this->patientCharges_branch = $row['branch'];
$this->patientCharges_datePaid = $row['datePaid'];
$this->patientCharges_timePaid = $row['timePaid'];
$this->patientCharges_paidBy = $row['paidBy'];
$this->patientCharges_remarks = $row['remarks'];

  }


}



public function editCharges($itemNo,$columns,$newData) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE patientCharges SET $columns = '$newData'
WHERE itemNo = '$itemNo' ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function editNow($table,$identifier,$identifierData,$columns,$newData) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE $table SET $columns = '$newData'
WHERE $identifier = '$identifierData' ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function doubleEditNow($table,$identifier,$identifierData,$identifier1,$identifierData1,$columns,$newData) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE $table SET $columns = '$newData'
WHERE $identifier = '$identifierData' and $identifier1 = '$identifierData1' ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function phicFuller($table,$identifier,$identifierData,$identifier1,$identifierData1,$columns,$newData) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE $table SET $columns = '$newData'
WHERE $identifier = '$identifierData' and $identifier1 = '$identifierData1' ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}

public function addUser($username,$password,$module,$branch,$completeName) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO registeredUser (username,password,module,branch,completeName)
VALUES
('$username','$password','$module','$branch','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $completeName) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

echo "<script type='text/javascript' >";
echo  "window.location='http://".$this->getMyUrl()."/Maintenance/addUser.php?username=$addedBy '";
echo "</script>";

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


public function editCompleteName($patientNo,$newData) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE patientRecord SET completeName = '$newData'
WHERE patientNo = '$patientNo' ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


public function editLastName($patientNo,$newData) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE patientRecord SET lastName = '$newData'
WHERE patientNo = '$patientNo' ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


public function editFirstName($patientNo,$newData) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE patientRecord SET firstName = '$newData'
WHERE patientNo = '$patientNo' ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function editMiddleName($patientNo,$newData) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE patientRecord SET middleName = '$newData'
WHERE patientNo = '$patientNo' ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function editAge($patientNo,$newData) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE patientRecord SET age = '$newData'
WHERE patientNo = '$patientNo' ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function editCivilStatus($patientNo,$newData) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE patientRecord SET civilStatus = '$newData'
WHERE patientNo = '$patientNo' ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function editBirthDate($patientNo,$newData) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE patientRecord SET Birthdate = '$newData'
WHERE patientNo = '$patientNo' ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


public function editContactNo($patientNo,$newData) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE patientRecord SET contactNo = '$newData'
WHERE patientNo = '$patientNo' ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


public function editSenior($patientNo,$newData) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE patientRecord SET Senior = '$newData'
WHERE patientNo = '$patientNo' ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


public function editPHIC($patientNo,$newData) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE patientRecord SET PHIC = '$newData'
WHERE patientNo = '$patientNo' ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function editCompany($patientNo,$newData) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE registrationDetails SET Company = '$newData'
WHERE patientNo = '$patientNo' ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


public function editTimeRegistered($patientNo,$newData) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE registrationDetails SET timeRegistered = '$newData'
WHERE patientNo = '$patientNo' ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


public function editDateRegistered($patientNo,$newData) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE registrationDetails SET dateRegistered = '$newData'
WHERE patientNo = '$patientNo' ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function editAddress($patientNo,$newData) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE patientRecord SET Address = '$newData'
WHERE patientNo = '$patientNo' ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


public function editHeight($registrationNo,$newData) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE registrationDetails SET height = '$newData'
WHERE registrationNo = '$registrationNo' ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function editWeight($registrationNo,$newData) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE registrationDetails SET weight = '$newData'
WHERE registrationNo = '$registrationNo' ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function editBloodPressure($registrationNo,$newData) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE registrationDetails SET bloodPressure = '$newData'
WHERE registrationNo = '$registrationNo' ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function editTemperature($registrationNo,$newData) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE registrationDetails SET temperature = '$newData'
WHERE registrationNo = '$registrationNo' ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function editInitialDiagnosis($registrationNo,$newData) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE registrationDetails SET initialDiagnosis = '$newData'
WHERE registrationNo = '$registrationNo' ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}

public function showPatient($completeName) {

$mysqli = new mysqli($this->host,$this->username,$this->password,$this->database);

if(mysqli_connect_errno()) {
echo "Connection Failed: " . mysqli_connect_errno();
exit();
}

$stmt = $mysqli->prepare("SELECT rd.registrationNo,rd.dateRegistered,upper(pr.completeName) as completeName FROM patientRecord pr,registrationDetails rd WHERE pr.patientNo = rd.patientNo and (pr.completeName like concat(?,'%%%') or rd.registrationNo = ?) and pr.firstName != 'N/A' group by completeName  ");
//print_r( $mysqli->error );
$stmt->bind_param("ss", $completeName,$completeName);
$stmt->execute();

$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
echo $row['completeName']."\n";
}

/* Close connection */
$mysqli -> close();

}

public function showPatient_walkIn($completeName) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT rd.registrationNo,pr.lastName,rd.dateRegistered,upper(pr.completeName) as completeName FROM patientRecord pr,registrationDetails rd WHERE pr.patientNo = rd.patientNo and pr.lastName like '$completeName%%%%%' and pr.firstName = 'N/A' and pr.middleName = 'N/A' group by completeName ");

while($row = mysqli_fetch_array($result))
  {
echo $row['lastName']."\n";
  }

}

private function formatDate($date) {
  $date1 = preg_split ("/\-/", $date); 
  $month = [
      '01'=>'Jan',
      '02'=>'Feb',
      '03'=>'Mar',
      '04'=>'Apr',
      '05'=>'May',
      '06'=>'Jun',
      '07'=>'Jul',
      '08'=>'Aug',
      '09'=>'Sep',
      '10'=>'Oct',
      '11'=>'Nov',
      '12'=>'Dec'];
  return $month[$date1[1]]." ".$date1[2].", ".$date1[0];
}

public function showPatientHistory($completeName,$username,$start,$end) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
.myData { font-size:13px; }
.myHeader { font-size:18px; }


#namez {
    background:none!important;
     border:none; 
     padding:0!important;
     color:black;
     font-size:17px;
     font-size:17px;
     
}

</style>";


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT rd.dateUnregistered,rd.patientNo,pr.completeName,rd.registrationNo,rd.dateRegistered,rd.dateUnregistered,rd.branch,rd.type FROM patientRecord pr,registrationDetails rd WHERE pr.patientNo = rd.patientNo and rd.dateRegistered NOT LIKE '%DELETED%' and pr.completeName = '$completeName' order by rd.control_dateRegistered desc limit $start,$end ");


while($row = mysqli_fetch_array($result))
  {
echo "<tr>";

if( $row['dateUnregistered'] == "" ) {
echo "<td class='myData'><center><font color='blue'>Active</center></td>";
}else {
echo "<td class='myData'>&nbsp;<font color=red>Discharged</font>&nbsp;</td>";
}
echo "<td class='myData'><center>".$row['registrationNo']."</center></td>";

//echo "<td class='myData'>&nbsp;<a href='http://".$this->getMyUrl()."/Department/redirect.php?username=$username&registrationNo=$row[registrationNo]'>".$row['completeName']."</a>&nbsp;</td>";jquery autocomple with form in php

echo "<td><form method='post' action='patientInterface1.php' ><input id='namez' type='submit' value='".$row['completeName']."'>
<input type='hidden' name='registrationNo' value='".$row['registrationNo']."'><input type='hidden' name='username' value='".$username."'></form></td>";

echo "<td class='myData'>&nbsp;".$this->formatDate($row['dateRegistered'])."&nbsp;</td>";

if( $row['dateUnregistered'] != "" ) {
  echo "<td class='myData'>&nbsp;".$this->formatDate($row['dateUnregistered'])."&nbsp;</td>";
}else {
  echo "<td>&nbsp;</td>";
}
echo "<td class='myData'><center>".$row['type']."</center></td>";
echo "</tr>";
  }
((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);
}



public function showPatientHistory_count($completeName,$username) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT rd.dateUnregistered,rd.patientNo,pr.completeName,rd.registrationNo,rd.dateRegistered,rd.branch,rd.type FROM patientRecord pr,registrationDetails rd WHERE pr.patientNo = rd.patientNo and pr.completeName = '$completeName' order by rd.control_dateRegistered desc ");

return mysqli_num_rows($result);

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);
}




public function showPatientHistory_walkIn($completeName,$username) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
.myData { font-size:17px; }
.myHeader { font-size:18px; }
</style>";


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pr.lastName,rd.dateUnregistered,rd.patientNo,pr.completeName,rd.registrationNo,rd.dateRegistered,rd.branch,rd.type FROM patientRecord pr,registrationDetails rd WHERE pr.patientNo = rd.patientNo and pr.lastName = '$completeName' order by rd.dateUnregistered,rd.registrationNo asc  ");

echo "<br><center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Status");
$this->coconutTableHeader("Reg#");
$this->coconutTableHeader("Name");
$this->coconutTableHeader("Registration Date");
$this->coconutTableHeader("Type");
$this->coconutTableHeader("Branch");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";

if( $row['dateUnregistered'] == "" ) {
echo "<td class='myData'><center><font color='blue'>Active</center></td>";
}else {
echo "<td class='myData'>&nbsp;<font color=red>Discharged</font>&nbsp;</td>";
}
echo "<td class='myData'><center>".$row['registrationNo']."</center></td>";
echo "<td class='myData'>&nbsp;<a href='http://".$this->getMyUrl()."/Department/redirect_walkIn.php?username=$username&registrationNo=$row[registrationNo]'>".$row['lastName']."</a>&nbsp;</td>";
echo "<td class='myData'><center>".$row['dateRegistered']."</center></td>";
echo "<td class='myData'><center>".$row['type']."</center></td>";
echo "<td class='myData'><center>".$row['branch']."</center></td>";
echo "</tr>";
  }
$this->coconutTableStop();

}



public function addNewDoctorService($serviceName,$specialization,$cashAmount,$companyRate,$doctorShare,$discount,$username,$phic) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO DoctorService (serviceName,specialization,cashAmount,companyRate,doctorShare,discount,phic)
VALUES
('$serviceName','$specialization','$cashAmount','$companyRate','$doctorShare','$discount','$phic')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

echo "<script type='text/javascript' >";
echo "alert('$serviceName was Successfully Added to the List of Doctor Service with a Specialization of $specialization');";
echo  "window.location='http://".$this->getMyUrl()."/COCONUT/Doctor/addNewDoctorService.php?username=$username '";
echo "</script>";


((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}




public function addNewDoctor($doctorName,$specialization1,$specialization2,$specialization3,$specialization4,$specialization5,$accreditationNo,$username,$usernameDoctor,$password,$module,$contactNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO Doctors (Name,Specialization1,Specialization2,Specialization3,Specialization4,Specialization5,PhilHealth_AccreditationNo,username,password,module,contact)
VALUES
('$doctorName','$specialization1','$specialization2','$specialization3','$specialization4','$specialization5','$accreditationNo','$usernameDoctor','$password','$module','$contactNo')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

echo "<script type='text/javascript' >";
echo "alert('$doctorName was Successfully Added to the List of Doctor');";
echo  "window.location='http://".$this->getMyUrl()."/COCONUT/Doctor/addNewDoctor.php?username=$username '";
echo "</script>";


((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function addNewRoom($description,$type,$rate,$branch,$floor) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO room (Description,type,rate,branch,floor,status)
VALUES
('$description','$type','$rate','$branch','$floor','Vacant')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

echo "<script type='text/javascript' >";
echo "alert('$description was Successfully Added to the List of Room with a rate of $rate');";
echo  "window.location='http://".$this->getMyUrl()."/COCONUT/Doctor/addNewDoctorService.php?username=$username '";
echo "</script>";


((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


public function addNewCredit($registrationNo,$limitTo,$limitVia,$amountLimit,$username) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO patientCreditLimit (registrationNo,limitTo,limitVia,amountLimit,username)
VALUES
('$registrationNo','$limitTo','$limitVia','$amountLimit','$username')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

echo "<script type='text/javascript' >";
echo  "window.location='http://".$this->getMyUrl()."/COCONUT/patientProfile/creditLimit/viewCreditLimit.php?username=$username&registrationNo=$registrationNo '";
echo "</script>";

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function addPayment($registrationNo,$amountPaid,$datePaid,$timePaid,$paidBy,$paymentFor,$orNo,$paidVia) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO patientPayment (registrationNo,amountPaid,datePaid,timePaid,paidBy,paymentFor,orNo,paidVia)
VALUES
('$registrationNo','$amountPaid','$datePaid','$timePaid','$paidBy','$paymentFor','$orNo','$paidVia')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

/*
echo "
<script type='text/javascript'>
<!--

	var answer = confirm('Payment Accepted!, Would you like to Discharge the Patient Now?')
	if (answer){
		alert('Pls Wait While I Process the Discharging of Patient.')
		window.location = 'http://".$this->getMyUrl()."/COCONUT/patientProfile/Payments/dischargedPatient.php?registrationNo=$registrationNo';
	}
	else{
		alert('The Patient is still Active')
	}

//-->
</script>
";
*/

/*
echo "<script type='text/javascript' >";
echo  "window.location='http://".$this->getMyUrl()."/COCONUT/patientProfile/patientProfile_handler.php?username=$paidBy&registrationNo=$registrationNo '";
echo "</script>";
*/
((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public $cashAmount;
public $companyRate;
public $doctorShare;
public $serviceDiscount;

public function cashAmount() {
return $this->cashAmount;
}
public function doctorShare() {
return $this->doctorShare;
}
public function serviceDiscount() {
return $this->serviceDiscount;
}
public function companyRate() {
return $this->companyRate;
}

public function doctorServiceRate($specialization,$service) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM DoctorService WHERE serviceName = '$service' and specialization='$specialization' ");

while($row = mysqli_fetch_array($result))
  {
$this->cashAmount = $row['cashAmount'];
$this->companyRate = $row['companyRate'];
$this->doctorShare = $row['doctorShare'];
$this->serviceDiscount = $row['discount'];

  }

}

public $specialization1;
public $specialization2;
public $specialization3;
public $specialization4;
public $specialization5;

public function specialization1() {
return $this->specialization1;
}
public function specialization2() {
return $this->specialization2;
}
public function specialization3() {
return $this->specialization3;
}
public function specialization4() {
return $this->specialization4;
}
public function specialization5() {
return $this->specialization5;
}

public function getDoctorSpecialization($doctorCode) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT Specialization1,Specialization2,Specialization3,Specialization4,Specialization5 FROM Doctors WHERE doctorCode = '$doctorCode' ");

while($row = mysqli_fetch_array($result))
  {
$this->specialization1 = $row['Specialization1'];
$this->specialization2 = $row['Specialization2'];
$this->specialization3 = $row['Specialization3'];
$this->specialization4 = $row['Specialization4'];
$this->specialization5 = $row['Specialization5'];
  }

}



//ITO UNG KKUHA NG RATE NG COMPANY KPAG NAG CHARGE NG DOCTOR AT ANG PATIENT AY MAY COMPANY
public function getCompanyRate($companyName,$rate) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT ($rate) as rate FROM Company WHERE companyName = '$companyName' ");

while($row = mysqli_fetch_array($result))
  {
return $row['rate'];
  }

}

public function getReportInformation($reportName) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT information FROM reportHeading WHERE reportName = '$reportName' ");

while($row = mysqli_fetch_array($result))
  {
return $row['information'];
  }

}


public function getDiagnosticTimer() {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT time FROM diagnosticTimer ");

while($row = mysqli_fetch_array($result))
  {
return $row['time'];
  }

}



//ITO UNG KKUHA NG PATIENT SA MGA DEPARTMENT KPG NDI P NREMIT
public function getTransactionPatient($m,$d,$y,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$module,$username,$branch) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a { text-decoration:none; color:black; }
</style>";

$fromTimez = $fromTime_hour.":".$fromTime_minutes.":".$fromTime_seconds;
$toTimez = $toTime_hour.":".$toTime_minutes.":".$toTime_seconds;

$dateSelected = $y."-".$m."-".$d;

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($module=="PHARMACY" || $module =="CSR") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT rd.pxCount,rd.room,rd.type,rd.registrationNo,upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,sum(pc.cashUnpaid) as grandTotal,pc.chargeBy FROM patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.dateCharge = '$dateSelected' and (pc.timeCharge between '$fromTimez' and '$toTimez') and pc.inventoryFrom='$module' and (pc.title='MEDICINE' or pc.title='SUPPLIES') and pc.departmentStatus not like 'dispensedBy%%%%' and (pc.status not like 'DELETED_%%%%%%') group by rd.registrationNo order by pr.lastName asc ");

}else if( $module == "LABORATORY" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT rd.pxCount,rd.room,rd.type,rd.registrationNo,upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,sum(pc.total) as grandTotal,pc.chargeBy FROM patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.dateCharge = '$dateSelected' and (pc.timeCharge between '$fromTimez' and '$toTimez') and (pc.title='$module' or pc.title='BLOODBANK') and pc.departmentStatus not like 'remittedBy%%%%' and (pc.status not like 'DELETED_%%%%%%') group by rd.registrationNo order by pc.itemNo desc ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT rd.pxCount,rd.room,pc.description,pc.itemNo,rd.type,rd.registrationNo,upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,sum(pc.total) as grandTotal,pc.chargeBy FROM patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.dateCharge = '$dateSelected' and (pc.timeCharge between '$fromTimez' and '$toTimez') and pc.title='$module' and pc.departmentStatus not like 'remittedBy%%%%' and (pc.status not like 'DELETED_%%%%%%' and pc.status = 'UNPAID') group by rd.registrationNo order by pr.lastName asc ");
}


while($row = mysqli_fetch_array($result))
  {

echo "<tr>";
echo "<td>&nbsp;".$row['pxCount']."</td>";
if($row['type'] == "IPD") {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/Department/patientDepartmentProfile.php?registrationNo=$row[registrationNo]&module=$module&month=$m&day=$d&year=$y&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&username=$username&module=$module&nod=' target='patientCharges'><font size='2' color=red>".$row['lastName']." ".$row['firstName']."</font><br><font size=1 color=blue>(".$row['room'].")</font></a>&nbsp;</td>";
}else {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/Department/patientDepartmentProfile.php?registrationNo=$row[registrationNo]&module=$module&month=$m&day=$d&year=$y&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&username=$username&module=$module&nod=' target='patientCharges'><font size='2' color='blue'>".$row['lastName']." ".$row['firstName']."</font></a>&nbsp;</td>";
}


if($row['grandTotal'] > 0) {

if( $module == "RADIOLOGY" ) {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Reports/radiologyReport/radioReportSettings.php?description=$row[description]&itemNo=$row[itemNo]&registrationNo=$row[registrationNo]&branch=Consolacion' target='patientCharges'>".number_format($row['grandTotal'],2)."</a>&nbsp;</td>";
}else {
echo "<td>&nbsp;".number_format($row['grandTotal'],2)."&nbsp;</td>";
}
}else {
echo "<td>&nbsp;</td>";
}
echo "</tr>";

}

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);
}



public function getReturnMedicine($m,$d,$y,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$module,$username,$branch) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a { text-decoration:none; color:black; }
</style>";

$fromTimez = $fromTime_hour.":".$fromTime_minutes.":".$fromTime_seconds;
$toTimez = $toTime_hour.":".$toTime_minutes.":".$toTime_seconds;

$dateSelected = $y."-".$m."-".$d;

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT rd.room,rd.type,rd.registrationNo,upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,sum(pc.cashUnpaid) as grandTotal,pc.chargeBy FROM patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.dateReturn = '$dateSelected' and (pc.timeCharge between '$fromTimez' and '$toTimez') and pc.inventoryFrom='$module' and pc.departmentStatus not like 'dispensedBy%%%%' and pc.status not like 'DELETED_%%%%%%' group by rd.registrationNo order by pr.lastName asc ");

while($row = mysqli_fetch_array($result))
  {

echo "<tr>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/Department/patientDepartmentProfile.php?registrationNo=$row[registrationNo]&module=$module&month=$m&day=$d&year=$y&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&username=$username&module=$module&nod=' target='patientCharges'><font size='2'>".$row['lastName']." ".$row['firstName']."</font></a><br><font size=1 color=red>[RETURN]</font>&nbsp;</td>";
if($row['grandTotal'] > 0) {
echo "<td>&nbsp;".number_format($row['grandTotal'],2)."&nbsp;</td>";
}else {
echo "";
}
echo "</tr>";

}

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}




//ITO UNG MAG UUPDATE SA COLUMN NA "departmentStatus" SA TABLE NA "patientCharges"
public function remitNow($itemNo,$status) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE patientCharges SET departmentStatus = '$status'
WHERE itemNo = '$itemNo' ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}

//ITO UNG MAG MAG-UUPDATE NG TIMER SA MGA DIAGNOSTIC
public function updateDiagnosticTimer($timer) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE diagnosticTimer SET time = '$timer'
 ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


public $sales_total;
public $sales_unpaid;
public $sales_phic;
public $sales_company;
public $sales_paid;

public function getSalesTotal() {
return $this->sales_total;
}
public function getSalesUnpaid() {
return $this->sales_unpaid;
}
public function getSalesPHIC() {
return $this->sales_phic;
}
public function getSalesCompany() {
return $this->sales_company;
}
public function getSalesPaid() {
return $this->sales_paid;
}

//SALES REPORT NG BAWAT DEPARTMENT
public function getSalesReport($month,$day,$year,$month1,$day1,$year1,$username,$module,$type) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a { text-decoration:none; color:black; }
</style>";

$dateSelected = $year."-".$month."-".$day;
$dateSelected1 = $year1."-".$month1."-".$day1;


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT upper(pr.completeName) as completeName,pc.description,pc.sellingPrice,pc.quantity,pc.discount,pc.total,pc.cashUnpaid,pc.cashPaid,pc.chargeBy,pc.phic,pc.company,rd.Company,rd.dateUnregistered FROM patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (pc.dateCharge between '$dateSelected' and '$dateSelected1') and rd.type='$type' and title='$module' and pc.status not like 'DELETED_%%%%%' group by pc.itemNo order by completeName asc ");


echo "<table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;Name&nbsp;</th>";
echo "<th>&nbsp;Description&nbsp;</th>";
echo "<th>&nbsp;Price&nbsp;</th>";
echo "<th>&nbsp;QTY&nbsp;</th>";
echo "<th>&nbsp;Disc&nbsp;</th>";
echo "<th>&nbsp;Total&nbsp;</th>";
echo "<th>&nbsp;Unpaid&nbsp;</th>";
echo "<th>&nbsp;PHIC&nbsp;</th>";
echo "<th>&nbsp;Company&nbsp;</th>";
echo "<th>&nbsp;Paid&nbsp;</th>";
echo "<th>&nbsp;Charge By&nbsp;</th>";
echo "</tr>";
$this->sales_total=0;
$this->sales_unpaid=0;
$this->sales_paid=0;
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;".$row['completeName']."&nbsp;</td>";
echo "<td>&nbsp;".$row['description']."&nbsp;</td>";
echo "<td>&nbsp;".number_format($row['sellingPrice'],2)."&nbsp;</td>";
echo "<td>&nbsp;".number_format($row['quantity'],2)."&nbsp;</td>";
echo "<td>&nbsp;".number_format($row['discount'],2)."&nbsp;</td>";
echo "<td>&nbsp;".number_format($row['total'],2)."&nbsp;</td>";


if( $type == "OPD" ) { //OPD
if( $row['cashUnpaid'] > 0 ) {
echo "<td>&nbsp;<font color=red>".number_format($row['cashUnpaid'],2)."</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;".number_format($row['cashUnpaid'],2)."&nbsp;</td>";
}
}else { //IPD kpg discharged na gwen 0 ung cashUnpaid column

if( $row['dateUnregistered'] != "" ) {
echo "<td>&nbsp;0.00&nbsp;</td>";
}else {
echo "<td>&nbsp;".number_format($row['cashUnpaid'],2)."&nbsp;</td>";
}

}

echo "<td>&nbsp;".number_format($row['phic'],2)."&nbsp;</td>";
if( $row['company'] > 0 ) {
echo "<td>&nbsp;".number_format($row['company'],2)."<br><font size=2>".$row['Company']."</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;".number_format($row['company'],2)."&nbsp;</td>";
}



if( $type == "OPD" ) {//OPD
echo "<td>&nbsp;".number_format($row['cashPaid'],2)."&nbsp;</td>";
}else { //IPD
if( $row['dateUnregistered'] != "" && $row['cashUnpaid'] > 0 ) {
echo "<td>&nbsp;".number_format($row['cashUnpaid'],2)."<br><font size=2>&nbsp;Bill</font>&nbsp;</td>";
}else if( $row['cashPaid'] > 0 ) {
echo "<td>&nbsp;".number_format($row['cashPaid'],2)."<br><font size=2>Cash</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;0.00&nbsp;</td>";
}
}


echo "<td>&nbsp;".$row['chargeBy']."&nbsp;</td>";
$this->sales_total+=$row['total'];
$this->sales_phic+=$row['phic'];
$this->sales_company+=$row['company'];

//cashPaid
if( $type == "OPD" ) {
$this->sales_paid+=$row['cashPaid'];
}else {

if( $row['dateUnregistered'] != "" && $row['cashUnpaid'] > 0 ) {
$this->sales_paid += $row['cashUnpaid'];
}else if( $row['cashPaid'] > 0 ) {
$this->sales_paid += $row['cashPaid'];
}else {
//do nothing
}

}


//cashUnpaid
if( $type == "OPD" ) {
$this->sales_unpaid+=$row['cashUnpaid'];
}else {

if( $row['dateUnregistered'] != "" ) {
//do nothing
}else {
$this->sales_unpaid+=$row['cashUnpaid'];
}

}


echo "</tr>";
  }
echo "</table>";
echo "<br>Total Unpaid:&nbsp;".number_format($this->sales_unpaid,2);
echo "<br>Total PhilHealth:&nbsp;".number_format($this->sales_phic,2);
echo "<br>Total Company:&nbsp;".number_format($this->sales_company,2);
echo "<br>Total Paid&nbsp;".number_format($this->sales_paid,2);
echo "<br>Total Sales:&nbsp;".number_format($this->sales_total,2);
}




//REMITTANCE REPORT NG BAWAT DEPARTMENT
public function getRemittanceReport($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,$module) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a { text-decoration:none; color:black; }
</style>";

$dateSelected = $year."-".$month."-".$day;
$fromTimez = $fromTime_hour.":".$fromTime_minutes.":".$fromTime_seconds;
$toTimez = $toTime_hour.":".$toTime_minutes.":".$toTime_seconds;


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($module == "PHARMACY" || $module == "CSR") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT upper(pr.completeName) as completeName,pc.description,pc.sellingPrice,pc.quantity,pc.discount,pc.total,pc.cashUnpaid,pc.cashPaid,pc.chargeBy FROM patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.dateCharge = '$dateSelected' and (pc.departmentStatus_time between '$fromTimez' and '$toTimez') and inventoryFrom='$module' and departmentStatus='dispensedBy_$username' group by pc.itemNo order by completeName asc ");
}else if( $module == "RADIOLOGY" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT upper(pr.completeName) as completeName,pc.description,pc.sellingPrice,pc.quantity,pc.discount,pc.total,pc.cashUnpaid,pc.cashPaid,pc.chargeBy FROM patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.dateCharge = '$dateSelected' and (pc.departmentStatus_time between '$fromTimez' and '$toTimez') and (title='ULTRASOUND' or title='XRAY') and departmentStatus='remittedBy_$username' group by pc.itemNo order by completeName asc ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT upper(pr.completeName) as completeName,pc.description,pc.sellingPrice,pc.quantity,pc.discount,pc.total,pc.cashUnpaid,pc.cashPaid,pc.chargeBy FROM patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.dateCharge = '$dateSelected' and (pc.departmentStatus_time between '$fromTimez' and '$toTimez') and title='$module' and departmentStatus='remittedBy_$username' group by pc.itemNo order by completeName asc ");
}


echo "<table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;Name&nbsp;</th>";
echo "<th>&nbsp;Description&nbsp;</th>";
echo "<th>&nbsp;Price&nbsp;</th>";
echo "<th>&nbsp;QTY&nbsp;</th>";
echo "<th>&nbsp;Disc&nbsp;</th>";
echo "<th>&nbsp;Total&nbsp;</th>";
echo "<th>&nbsp;Unpaid&nbsp;</th>";
echo "<th>&nbsp;Paid&nbsp;</th>";
echo "<th>&nbsp;Charge By&nbsp;</th>";
echo "</tr>";
$this->sales_total=0;
$this->sales_unpaid=0;
$this->sales_paid=0;
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;".$row['completeName']."&nbsp;</td>";
echo "<td>&nbsp;".$row['description']."&nbsp;</td>";
echo "<td>&nbsp;".number_format($row['sellingPrice'],2)."&nbsp;</td>";
echo "<td>&nbsp;".number_format($row['quantity'],2)."&nbsp;</td>";
echo "<td>&nbsp;".number_format($row['discount'],2)."&nbsp;</td>";
echo "<td>&nbsp;".number_format($row['total'],2)."&nbsp;</td>";
echo "<td>&nbsp;".number_format($row['cashUnpaid'],2)."&nbsp;</td>";
echo "<td>&nbsp;".number_format($row['cashPaid'],2)."&nbsp;</td>";
echo "<td>&nbsp;".$row['chargeBy']."&nbsp;</td>";
$this->sales_total+=$row['total'];
$this->sales_paid+=$row['cashPaid'];
$this->sales_unpaid+=$row['cashUnpaid'];
echo "</tr>";
  }
echo "</table>";
echo "<br>Total Sales:&nbsp;".$this->sales_total;
echo "<br>Total Unpaid:&nbsp;".$this->sales_unpaid;
echo "<br>Total Paid&nbsp;".$this->sales_paid;

}


public $collection_salesTotal;
public $collection_salesUnpaid;
public $collection_salesPaid;
public $collection_cash;
public $collection_creditCard;
public $collection_medicine;
public $collection_hospital;

public function collection_salesTotal() {
return $this->collection_salesTotal;
}

public function collection_salesUnpaid() {
return $this->collection_salesUnpaid;
}

public function collection_salesPaid() {
return $this->collection_salesPaid;
}

public function collection_cash() {
return $this->collection_cash;
}

public function collection_creditCard() {
return $this->collection_creditCard;
}

public function collection_medicine() {
return $this->collection_medicine;
}

public function collection_hospital() {
return $this->collection_hospital;
}


//COLLLECTION REPORT CASHIER
public function getCashierReport($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,$status,$shift) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a { text-decoration:none; color:black; }
</style>";

$dateSelected = $year."-".$month."-".$day;
$fromTimez = $fromTime_hour.":".$fromTime_minutes.":".$fromTime_seconds;
$toTimez = $toTime_hour.":".$toTime_minutes.":".$toTime_seconds;


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


if( $this->selectNow("registeredUser","module","username",$username) == "ADMIN" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT upper(pr.completeName) as completeName,pc.description,pc.sellingPrice,pc.datePaid,pc.quantity,pc.title,pc.orNO,pc.discount,pc.doctorsPF,pc.amountPaidFromCreditCard,pc.total,pc.cashUnpaid,pc.cashPaid,pc.paidBy,pc.paidVia,pc.cashPaidFromBalance,pc.datePaid,pc.orNOFromBalance,pc.itemNo FROM patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (pc.datePaid = '$dateSelected' or pc.datePaidFromBalance = '$dateSelected') and (pc.reportShift = '$shift' or pc.reportShiftFromBalance = '$shift') and (pc.status='PAID' or pc.status = 'BALANCE') group by pc.itemNo order by pr.completeName asc ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT upper(pr.completeName) as completeName,pc.description,pc.sellingPrice,pc.datePaid,pc.quantity,pc.title,pc.orNO,pc.discount,pc.doctorsPF,pc.amountPaidFromCreditCard,pc.total,pc.cashUnpaid,pc.cashPaid,pc.paidBy,pc.paidVia,pc.cashPaidFromBalance,pc.datePaid,pc.orNOFromBalance,pc.itemNo FROM patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (pc.datePaid = '$dateSelected') and (pc.reportShift = '$shift' or pc.reportShiftFromBalance = '$shift') and pc.paidBy = '$username' and pc.cashPaid > 0 group by pc.itemNo order by pr.completeName asc ");
}

$this->collection_salesTotal=0;
$this->collection_salesUnpaid=0;
$this->collection_salesPaid=0;
while($row = mysqli_fetch_array($result))
  {

$price = preg_split ("/\//", $row['sellingPrice']); 

echo "<tr>";
echo "<td><input type='checkbox' name='shift[]' value='patientCharges_".$row['itemNo']."' checked></td>";
echo "<td>&nbsp;<font size=2>".$row['completeName']."</font>&nbsp;</td>";

if( $row['datePaid'] == $dateSelected ) {
echo "<td>&nbsp;<font size=2>".$row['description']."</font>&nbsp;<br><font size=2 color=red>OR#:".$row['orNO']."</font></td>";
}else {
echo "<td>&nbsp;<font size=2>".$row['description']."</font>&nbsp;<br><font size=2 color=red>OR#:".$row['orNOFromBalance']."</font></td>";
}
echo "<td>&nbsp;<font size=2>".$price[0]."</font>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".number_format($row['total'],2)."</font>&nbsp;</td>";


if( $row['paidVia'] == "Cash" ) {
if( $row['datePaid'] == $dateSelected ) {
echo "<td>&nbsp;<font size=2>".number_format($row['cashPaid'],2)." - (".$row['paidVia'].")</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font size=2>".number_format($row['cashPaidFromBalance'],2)." - (".$row['paidVia'].")</font>&nbsp;</td>";
}
}else {
echo "<td>&nbsp;<font size=2>".number_format($row['amountPaidFromCreditCard'],2)." - (".$row['paidVia'].")</font>&nbsp;</td>";
}


echo "<td>&nbsp;<font size=2>".$row['paidBy']."</font>&nbsp;</td>";


if( $row['paidVia'] == "Cash" ) {
if( $row['datePaid'] == $dateSelected ) {
echo "<td>&nbsp;<font size=2>".number_format($row['cashPaid'],2)." - (".$row['paidVia'].")</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font size=2>".number_format($row['cashPaidFromBalance'],2)." - (".$row['paidVia'].")</font>&nbsp;</td>";
}
}else {
echo "<td>&nbsp;<font size=2>".number_format($row['amountPaidFromCreditCard'],2)." - (".$row['paidVia'].")</font>&nbsp;</td>";
}

$this->collection_salesTotal+=$row['total'];
$this->collection_salesUnpaid+=$row['cashUnpaid'];
$this->collection_salesPaid+=$row['cashPaid'];

if($row['paidVia'] == "Cash") {
$this->collection_cash += $row['cashPaid'];
}else {
$this->collection_creditCard += $row['cashPaid'];
}


echo "<td>&nbsp;<font size=2>".$row['doctorsPF']."</font></td>";
echo "<td>&nbsp;<font size=2>".$this->selectNow("patientCharges","cashUnpaid","itemNo",$row['itemNo'])."</font></td>";


}



}




public $balance_salesTotal;
public $balance_salesUnpaid;
public $balance_salesPaid;
public $balance_cash;

public function balance_salesTotal() {
return $this->balance_salesTotal;
}

public function balance_salesUnpaid() {
return $this->balance_salesUnpaid;
}

public function balance_salesPaid() {
return $this->balance_salesPaid;
}


//BALANCE N BNYRAN NA
public function getCashierReportBalance($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,$status,$shift) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a { text-decoration:none; color:black; }
</style>";

$dateSelected = $year."-".$month."-".$day;
$fromTimez = $fromTime_hour.":".$fromTime_minutes.":".$fromTime_seconds;
$toTimez = $toTime_hour.":".$toTime_minutes.":".$toTime_seconds;


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


if( $this->selectNow("registeredUser","module","username",$username) == "ADMIN" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT upper(pr.completeName) as completeName,pc.description,pc.sellingPrice,pc.datePaid,pc.quantity,pc.title,pc.orNOFromBalance,pc.discount,pc.total,pc.cashUnpaid,pc.cashPaidFromBalance,pc.paidBy,pc.paidVia,pc.cashPaidFromBalance,pc.datePaid,pc.orNOFromBalance,pc.itemNo FROM patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (pc.datePaid = '$dateSelected' or pc.datePaidFromBalance = '$dateSelected') and (pc.reportShift = '$shift' or pc.reportShiftFromBalance = '$shift') and (pc.status='PAID' or pc.status = 'BALANCE') group by pc.itemNo order by pc.title,completeName asc ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT upper(pr.completeName) as completeName,pc.description,pc.sellingPrice,pc.datePaid,pc.quantity,pc.title,pc.orNOFromBalance,pc.discount,pc.total,pc.cashUnpaid,pc.cashPaid,pc.paidBy,pc.paidVia,pc.cashPaidFromBalance,pc.datePaid,pc.orNOFromBalance,pc.itemNo FROM patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (pc.datePaidFromBalance = '$dateSelected') and (pc.reportShift = '$shift' or pc.reportShiftFromBalance = '$shift') and pc.paidBy = '$username' and (pc.status='PAID' or pc.status = 'BALANCE') group by pc.itemNo order by pc.title,completeName asc ");
}

$this->balance_salesTotal=0;
$this->balance_salesUnpaid=0;
$this->balance_salesPaid=0;
while($row = mysqli_fetch_array($result))
  {

$price = preg_split ("/\//", $row['sellingPrice']); 

echo "<tr>";
echo "<td><input type='checkbox' name='shift[]' value='patientCharges_".$row['itemNo']."' checked></td>";
echo "<td>&nbsp;<font size=2>".$row['completeName']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".$row['description']."</font>&nbsp;<br><font size=2 color=red>OR#:".$row['orNOFromBalance']."</font></td>";
echo "<td>&nbsp;<font size=2>".$price[0]."</font>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".number_format($row['total'],2)."</font>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".number_format($row['cashPaidFromBalance'],2)." - (".$row['paidVia'].")</font>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".$row['paidBy']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".number_format($row['cashPaidFromBalance'],2)." - (".$row['paidVia'].")</font>&nbsp;</td>";

$this->balance_salesTotal+=$row['total'];
$this->balance_salesUnpaid+=$row['cashUnpaid'];
$this->balance_salesPaid+=$row['cashPaidFromBalance'];

if($row['paidVia'] == "Cash") {
$this->balance_cash += $row['cashPaidFromBalance'];
}else {
$this->collection_creditCard += $row['cashPaidFromBalance'];
}


echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".$this->selectNow("patientCharges","cashUnpaid","itemNo",$row['itemNo'])."</font></td>";


}

}



public function hospitalBill_pf($registrationNo,$title) { //mga patient n bill pru may bbyran p rin sa cashier 

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if( $title == "PROFESSIONAL FEE" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(cashUnpaid) as total from patientCharges where registrationNo = '$registrationNo' and title = 'PROFESSIONAL FEE' and status = 'UNPAID' ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(cashUnpaid) as total from patientCharges where registrationNo = '$registrationNo' and title IN ('LABORATORY','RADIOLOGY','MEDICINE','SUPPLIES','REHAB','NBS','ECG','Room And Board','MISCELLANEOUS','OR/DR/ER Fee','OXYGEN','NURSING-CHARGES','CARDIAC','OVERTIME','BLOODBANK','GENERATOR_CHARGE') and status = 'UNPAID' ");
}

while($row = mysqli_fetch_array($result))
  {
return $row['total'];
}


}

public $partial;
public $getPartialReport_hb;
public $getPartialReport_pf;
public $getPartialReport_admitting;

public $getPartialReport_hospital;
public $getPartialReport_medicine;

public function partial() {
return $this->partial;
}
public function getPartialReport_hb() {
return $this->getPartialReport_hb;
}
public function getPartialReport_pf() {
return $this->getPartialReport_pf;
}
public function getPartialReport_admitting() {
return $this->getPartialReport_admitting;
}
public function getPartialReport_hospital() {
return $this->getPartialReport_hospital;
}
public function getPartialReport_medicine() {
return $this->getPartialReport_medicine;
}



public function getPartialReport($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,$status,$cutoff,$shift) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a { text-decoration:none; color:black; }
</style>";

$dateSelected = $year."-".$month."-".$day;
$fromTimez = $fromTime_hour.":".$fromTime_minutes.":".$fromTime_seconds;
$toTimez = $toTime_hour.":".$toTime_minutes.":".$toTime_seconds;


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


if( $cutoff == "yes" ) {

if( $this->selectNow("registeredUser","module","username",$username) == "ADMIN" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT rd.registrationNo,pp.paidVia,upper(pr.completeName) as completeName,pp.paymentFor,pp.paidBy,pp.datePaid,pp.amountPaid,pp.pf,pp.admitting,pp.receiptType FROM patientPayment pp,patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and pp.registrationNo = rd.registrationNo and rd.registrationNo = pc.registrationNo and pp.datePaid = '$dateSelected' and (pp.timePaid between '$fromTimez' and '$toTimez') and pp.paymentFor != 'REFUND' and pp.shift='$shift' group by paymentNo order by completeName asc ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT rd.registrationNo,pp.paidVia,upper(pr.completeName) as completeName,pp.paymentFor,pp.paidBy,pp.datePaid,pp.amountPaid,pp.pf,pp.admitting,pp.receiptType FROM patientPayment pp,patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and pp.registrationNo = rd.registrationNo and rd.registrationNo = pc.registrationNo and pp.datePaid = '$dateSelected' and (pp.timePaid between '$fromTimez' and '$toTimez') and pp.paidBy='$username' and pp.paymentFor != 'REFUND' and pp.paidBy = '$username' and pp.shift='$shift' group by paymentNo order by completeName asc ");
}



}else {
if( $this->selectNow("registeredUser","module","username",$username) == "ADMIN" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT rd.registrationNo,pp.paidVia,upper(pr.completeName) as completeName,pp.paymentFor,pp.paidBy,pp.datePaid,pp.amountPaid,pp.pf,pp.admitting,pp.receiptType,pp.paymentNo FROM patientPayment pp,patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and pp.registrationNo = rd.registrationNo and rd.registrationNo = pc.registrationNo and pp.datePaid = '$dateSelected' and (pp.timePaid between '$fromTimez' and '$toTimez') and paymentFor not in ('REFUND') and pp.shift='$shift' group by paymentNo order by completeName asc ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT rd.registrationNo,pp.paidVia,upper(pr.completeName) as completeName,pp.paymentFor,pp.paidBy,pp.datePaid,pp.amountPaid,pp.pf,pp.admitting,pp.receiptType,pp.paymentNo FROM patientPayment pp,patientRecord pr,registrationDetails rd WHERE pr.patientNo = rd.patientNo and pp.registrationNo = rd.registrationNo and pp.datePaid = '$dateSelected' and (pp.timePaid between '$fromTimez' and '$toTimez') and pp.paymentFor not in ('REFUND') and pp.shift='$shift' and pp.paidBy='$username' group by paymentNo order by completeName asc ");
}

}

//$this->collection_salesTotal=0;
//$this->collection_salesUnpaid=0;
//$this->collection_salesPaid=0;
while($row = mysqli_fetch_array($result))
  {
$this->partial+=$row['amountPaid'];
$this->getPartialReport_hb += $row['amountPaid'];
$this->getPartialReport_pf += $row['pf'];
$this->getPartialReport_admitting += $row['admitting'];
//$price = preg_split ("/\//", $row['sellingPrice']); 

if( $row['receiptType'] == "medicine" ) {
$this->getPartialReport_medicine += $row['amountPaid'];
}else if( $row['receiptType'] == "hospital" ) {
$this->getPartialReport_hospital += $row['amountPaid'];
}else { }

echo "<tr>";
echo "<td><input type='checkbox' name='shift[]' value='patientPayment_".$row['paymentNo']."' checked></td>";
echo "<td>&nbsp;<font color=red>".$row['completeName']."</font>&nbsp;</td>";
echo "<td>&nbsp;".$row['paymentFor']."&nbsp;</td>";
echo "<td>&nbsp;".number_format(($row['amountPaid'] + $row['pf']) + $row['admitting'],2)."&nbsp;</td>";

//echo "<td>&nbsp;".number_format("1",2)."&nbsp;</td>";// header [QTY]
//echo "<td>&nbsp;".number_format("0",2)."&nbsp;</td>";// header [DISC]

echo "<td>&nbsp;".number_format(($row['amountPaid'] + $row['pf']) + $row['admitting'],2)."&nbsp;</td>";

//echo "<td>&nbsp;".number_format("0",2)."&nbsp;</td>"; //header [Balance]

echo "<td>&nbsp;".(($row['amountPaid']+$row['pf'])+$row['admitting'])." - (".$row['paidVia'].")&nbsp;</td>";
echo "<td>&nbsp;".$row['paidBy']."&nbsp;</td>";
echo "<tD>&nbsp;".number_format($row['amountPaid'],2)."&nbsp;</tD>";
echo "<tD>&nbsp;".number_format($row['pf'],2)."&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
//$this->collection_salesTotal+=$row['total'];
//$this->collection_salesUnpaid+=$row['cashUnpaid'];
//$this->collection_salesPaid+=$row['cashPaid'];
/*
if($row['paidVia'] == "Cash") {
$this->collection_cash += $row['cashPaid'];
}else {
$this->collection_creditCard += $row['cashPaid'];
}
*/
echo "</tr>";
  }


					
}

public $othersPartial;

public function othersPartial() {
return $this->othersPartial;
}

public function getOthersPartialReport($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,$status) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a { text-decoration:none; color:black; }
</style>";

$dateSelected = $year."-".$month."-".$day;


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


if( $this->selectNow("registeredUser","module","username",$username) == "ADMIN" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientPayment pp WHERE pp.datePaid = '$dateSelected' and registrationNo like 'manual_%%%%%%' group by paymentNo order by registrationNo asc ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientPayment pp WHERE pp.datePaid = '$dateSelected' and pp.paidBy='$username' and registrationNo like 'manual_%%%%%%' group by paymentNo order by registrationNo asc ");
}



//$this->collection_salesTotal=0;
//$this->collection_salesUnpaid=0;
//$this->collection_salesPaid=0;
while($row = mysqli_fetch_array($result))
  {
$this->othersPartial+=$row['amountPaid'];
$px = preg_split ("/\_/", $row['registrationNo']); 

echo "<tr>";
echo "<tD>&nbsp;</tD>";
echo "<td>&nbsp;<font color=red>".$px[1]."</font>&nbsp;</td>";
echo "<td>&nbsp;".$row['paymentFor']."&nbsp;</td>";
echo "<td>&nbsp;".$row['amountPaid']."&nbsp;</td>";
echo "<tD>&nbsp;</tD>";
echo "<td>&nbsp;".number_format($row['amountPaid'],2)."&nbsp;</td>";
echo "<td>&nbsp;".$row['paidBy']."&nbsp;</td>";
echo "<td>&nbsp;".number_format($row['amountPaid'],2)."&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
//$this->collection_salesTotal+=$row['total'];
//$this->collection_salesUnpaid+=$row['cashUnpaid'];
//$this->collection_salesPaid+=$row['cashPaid'];
/*
if($row['paidVia'] == "Cash") {
$this->collection_cash += $row['cashPaid'];
}else {
$this->collection_creditCard += $row['cashPaid'];
}
*/
echo "</tr>";
  }
echo "<tr>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;<B>TOTAL</b></tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;<B>".number_format($this->othersPartial,2)."</b></tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;<B>".number_format($this->othersPartial,2)."</b></tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "</tr>";
echo "<tr>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "</tr>";

}






//KKUHAIN UNG MGA PATIENT CHARGES N ANG STATUS AY UNPAID at UNDER SA COMPANY
public function getUnpaidPatientCompany($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,$branch,$type,$shift) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a { text-decoration:none; color:black; }
.Unpaid {
font-size:12px;
}
</style>";

$dateSelected = $year."-".$month."-".$day;
$fromTimez = $fromTime_hour.":".$fromTime_minutes.":".$fromTime_seconds;
$toTimez = $toTime_hour.":".$toTime_minutes.":".$toTime_seconds;


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT rd.registeredBy,rd.type,rd.registrationNo,upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,sum(pc.company) as total FROM patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.dateUnregistered = '' and pc.company > 0 and (rd.dateRegistered = '$dateSelected') and (pc.status = 'UNPAID' or pc.status = 'BALANCE') and rd.type='$type' group by rd.registrationNo order by pr.lastName asc   ");

echo "<br /><br />";
echo "$type w/ HMO/Company";

echo "<table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<th><font class='Unpaid'>Name</font></th>";
if( $type == "OPD" ) {
echo "<th><font class='Unpaid'>Amount</font></th>";
}else { }
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
$this->getPaymentHistory_showUp_returnPaid_setter($row['registrationNo']);
$this->getPatientProfile($row['registrationNo']);
$disc = $row['total'] * $this->getRegistrationDetails_discount();
$grandTotal = $row['total'] - $disc;

if($row['type'] == "IPD") {

if($this->selectNow("registeredUser","module","username",$this->getRegistrationDetails_registeredBy()) == "MI") {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Cashier/patientUnpaidChargesCompany.php?month=$month&day=$day&year=$year&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&username=$username&registrationNo=$row[registrationNo]' target='patientCharges'><font class='Unpaid' color=blue>".$row['lastName'].", ".$row['firstName']."</font></a>&nbsp;</td>";
}else {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Cashier/patientUnpaidChargesCompany.php?month=$month&day=$day&year=$year&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&username=$username&registrationNo=$row[registrationNo]&shift=$shift' target='patientCharges'><font class='Unpaid' color=red>".$row['lastName'].", ".$row['firstName']."</font></a>&nbsp;</td>";
}

} else {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Cashier/patientUnpaidChargesCompany.php?month=$month&day=$day&year=$year&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&username=$username&registrationNo=$row[registrationNo]&shift=$shift' target='patientCharges'><font class='Unpaid'>".$row['lastName'].", ".$row['firstName']."</font></a>&nbsp;</td>";
}

if( $type == "OPD" ) {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/unknownUser/verifyUser.php?registrationNo=$row[registrationNo]' target='_blank'><font class='Unpaid'>".number_format( ( ( $grandTotal )   ) ,2)."</font></a>&nbsp;</td>";
echo "</tr>";
}else { } 

 }
echo "</table>";

}
//END COMPANY PATIENT CASHIER LIST




//KKUHAIN UNG MGA PATIENT CHARGES N ANG STATUS AY UNPAID
public function getUnpaidPatient($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,$branch,$type,$shift) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a { text-decoration:none; color:black; }
.Unpaid {
font-size:12px;
}
</style>";

$dateSelected = $year."-".$month."-".$day;
$fromTimez = $fromTime_hour.":".$fromTime_minutes.":".$fromTime_seconds;
$toTimez = $toTime_hour.":".$toTime_minutes.":".$toTime_seconds;


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if( $type == "OPD" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT rd.registeredBy,rd.type,rd.registrationNo,upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,sum(pc.cashUnpaid) as total FROM patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.dateUnregistered = '' and pc.cashUnpaid > 0 and (rd.dateRegistered = '$dateSelected') and pc.status = 'UNPAID' and rd.type in ('OPD','walkin') group by rd.registrationNo order by pr.lastName asc   ");

}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT rd.registeredBy,rd.type,rd.registrationNo,upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,sum(pc.cashUnpaid) as total FROM patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.dateUnregistered = '' and pc.cashUnpaid > 0 and (rd.dateRegistered = '$dateSelected') and pc.status = 'UNPAID' and rd.type='$type' group by rd.registrationNo order by pr.lastName asc   ");
}

echo "<table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<th><font class='Unpaid'>Name</font></th>";
if( $type == "OPD" ) {
echo "<th><font class='Unpaid'>Amount</font></th>";
}else { }
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
$this->getPatientProfile($row['registrationNo']);
$disc = $row['total'] * $this->getRegistrationDetails_discount();
$grandTotal = $row['total'] - $disc;

if($row['type'] == "IPD") {

if($this->selectNow("registeredUser","module","username",$this->getRegistrationDetails_registeredBy()) == "MI") {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Cashier/patientUnpaidCharges.php?month=$month&day=$day&year=$year&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&username=$username&registrationNo=$row[registrationNo]' target='patientCharges'><font class='Unpaid' color=blue>".$row['lastName'].", ".$row['firstName']."</font></a>&nbsp;</td>";
}else {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Cashier/patientUnpaidCharges.php?month=$month&day=$day&year=$year&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&username=$username&registrationNo=$row[registrationNo]&shift=$shift' target='patientCharges'><font class='Unpaid' color=red>".$row['lastName'].", ".$row['firstName']."</font></a>&nbsp;</td>";
}

} else {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Cashier/patientUnpaidCharges.php?month=$month&day=$day&year=$year&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&username=$username&registrationNo=$row[registrationNo]&shift=$shift' target='patientCharges'><font class='Unpaid'>".$row['lastName'].", ".$row['firstName']."</font></a>&nbsp;</td>";
}

if( $type == "OPD" ) {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/unknownUser/verifyUser.php?registrationNo=$row[registrationNo]' target='_blank'><font class='Unpaid'>".number_format( ( ( $grandTotal )   ) ,2)."</font></a>&nbsp;</td>";
echo "</tr>";
}else { } 

 }
echo "</table>";

}


//KKUHAIN UNG TOTAL UNPAID AMOUNT NG PATIENT
public function getUnpaidPatientAmount($registrationNo) {



$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pc.cashUnpaid) as total FROM patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and cashUnpaid > 0 and (status = 'UNPAID' or status = 'BALANCE') and rd.registrationNo='$registrationNo' group by rd.registrationNo order by pr.lastName asc  ");


while($row = mysqli_fetch_array($result))
  {
return $row['total'];
  }
echo "</table>";

}


//KKUHAIN UNG TOTAL UNPAID AMOUNT NG PATIENT for creditCard
public function getUnpaidPatientAmount_creditCard($registrationNo) {



$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pc.cashUnpaid) as cash,sum(pc.doctorsPF) as docPF,sum(pc.doctorsPF_payable) as payable,sum(pc.otShare) as otShare FROM patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and cashUnpaid > 0 and (status = 'UNPAID' or status = 'BALANCE') and rd.registrationNo='$registrationNo' group by rd.registrationNo order by pr.lastName asc  ");


while($row = mysqli_fetch_array($result))
  {
return ($row['cash'] + $row['docPF'] + $row['otShare'] + $row['payable']);
  }
echo "</table>";

}



public function paymentManager($itemNo,$status,$paidBy,$amountPaid,$datePaid,$timePaid,$cashUnpaid) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE patientCharges SET status = '$status',paidBy='$paidBy',cashPaid='$amountPaid',datePaid='$datePaid',timePaid='$timePaid',cashUnpaid='$cashUnpaid' WHERE itemNo = '$itemNo'
 ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}

public function paymentManager_creditCard($itemNo,$status,$paidBy,$amountPaid,$datePaid,$timePaid,$cashUnpaid) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE patientCharges SET status = '$status',paidBy='$paidBy',amountPaidFromCreditCard='$amountPaid',datePaid='$datePaid',timePaid='$timePaid',cashUnpaid='$cashUnpaid' WHERE itemNo = '$itemNo'
 ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}

public function paymentManager_creditCard_PF($itemNo,$status,$paidBy,$amountPaid,$datePaid,$timePaid,$cashUnpaid,$pf) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE patientCharges SET status = '$status',paidBy='$paidBy',amountPaidFromCreditCard='$amountPaid',doctorsPF_payable='$pf',datePaid='$datePaid',timePaid='$timePaid',cashUnpaid='$cashUnpaid' WHERE itemNo = '$itemNo'
 ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}

//KKUNIN UNG TOTAL NG BAWAT CHARGES NG PATIENT 
public function getItemNo_total($itemNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT cashUnpaid from patientCharges where itemNo = '$itemNo'  ");


while($row = mysqli_fetch_array($result))
  {
return $row['cashUnpaid'];
  }

}


//CHECK WHERE INVENTORY WILL GET THE MEDS OR SUPPLIES
public function checkInventory($itemNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT inventoryFrom from patientCharges where itemNo = '$itemNo' ");


while($row = mysqli_fetch_array($result))
  {
return $row['inventoryFrom'];
  }

}



public function getTotalBalance($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(cashUnpaid) as total from patientCharges where registrationNo = '$registrationNo' and status='BALANCE' ");


while($row = mysqli_fetch_array($result))
  {
return $row['total'];
  }

}



public function searchBalance($completeName,$username) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a { text-decoration:none; color:black; }
.Unpaid {
font-size:13px;
}
</style>";


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pr.lastName,pr.firstName,rd.registrationNo,rd.registrationNo,rd.dateUnregistered,sum(pc.cashUnpaid) as bal from patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pr.completeName like '$completeName%%%%%%%' and pc.status not like 'DELETED%%%%%%%' and pc.cashUnpaid > 0 group by rd.registrationNo ");

echo "<table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<Th>Reg#</th>";
echo "<th>&nbsp;Patient&nbsp;</th>";
echo "<Th>Date</th>";
echo "<Th>BALANCE</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;".$row['registrationNo']."</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Cashier/balanceProfile.php?registrationNo=$row[registrationNo]&username=$username'>".$row['lastName']." ".$row['firstName']."</a>&nbsp;</td>";
echo "<td>&nbsp;".$row['dateUnregistered']."</td>";
echo "<td>&nbsp;".$row['bal']."</td>";
echo "</tr>";
  }
echo "</table>";

}


public function payBalance($itemNo,$datePaid,$timePaid,$paidBy,$amountPaid) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO patientBalance (itemNo,datePaid,timePaid,paidBy,amountPaid)
VALUES
('$itemNo','$datePaid','$timePaid','$paidBy','$amountPaid')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

/*
echo "<script type='text/javascript' >";
echo "alert('$doctorName was Successfully Added to the List of Doctor');";
echo  "window.location='http://".$this->getMyUrl()."/COCONUT/Doctor/addNewDoctor.php?username=$username '";
echo "</script>";
*/

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


public function addBranch($branch) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO branch (branch)
VALUES
('$branch')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

/*
echo "<script type='text/javascript' >";
echo "alert('$doctorName was Successfully Added to the List of Doctor');";
echo  "window.location='http://".$this->getMyUrl()."/COCONUT/Doctor/addNewDoctor.php?username=$username '";
echo "</script>";
*/

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function updateStatus($itemNo,$status) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE patientCharges SET status = '$status' WHERE itemNo='$itemNo'
 ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}




public function getDispensePatient($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,$inventoryFrom) {

$dateSelected = $month."_".$day."_".$year;
$fromTimez = $fromTime_hour.":".$fromTime_minutes.":".$fromTime_seconds;
$toTimez = $toTime_hour.":".$toTime_minutes.":".$toTime_seconds;

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT upper(pc.lastName) as lastName,upper(pr.firstName) as firstName from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.registrationNo and rd.registrationNo=pc.registrationNo and pc.inventoryFrom='inventoryFrom' and pc.dateCharge = '$dateSelected' and (pc.timeCharge between '$fromTimez' and '$toTimez') group by rd.registrationNo order by lastName asc  ");

echo "<table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<td>&nbsp;Name&nbsp;</td>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;".$row['lastName']." ".$row['firstName']."&nbsp;</td>";
echo "</tr>";
  }
echo "</table>";

}



public function getChargesCode($itemNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT chargesCode from patientCharges  where itemNo = '$itemNo'   ");

while($row = mysqli_fetch_array($result))
  {
return $row['chargesCode'];
  }


}


public function getCurrentQTY($inventoryCode) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT quantity from inventory  where inventoryCode = '$inventoryCode'   ");

while($row = mysqli_fetch_array($result))
  {
return $row['quantity'];
  }

}


//UNIVERSAL SELECT
public function selectNow($table,$cols,$identifier,$identifierData) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT ($cols) as cols from $table  where $identifier = '".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $identifierData) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."'  ");

while($row = mysqli_fetch_array($result))
  {
return $row['cols'];
  }

}


public function selectNowLast($table,$cols,$identifier,$identifierData) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT ($cols) as cols from $table  where $identifier = '".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $identifierData) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."' order by requestNo desc limit 1  ");

while($row = mysqli_fetch_array($result))
  {
return $row['cols'];
  }

}


public function doubleSelectNow($table,$cols,$identifier,$identifierData,$identifier1,$identifierData1) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT ($cols) as cols from $table  where $identifier = '$identifierData' and $identifier1 = '$identifierData1' ");

while($row = mysqli_fetch_array($result))
  {
return $row['cols'];
  }

}



public function doubleSelectNow_notDeleted($table,$cols,$identifier,$identifierData,$identifier1,$identifierData1) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT ($cols) as cols from $table  where $identifier = '$identifierData' and $identifier1 = '$identifierData1' and status not like 'DELETED_%%%%%%%' ");

while($row = mysqli_fetch_array($result))
  {
return $row['cols'];
  }

}






////////////////////////

public function getQTY_room($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT quantity from patientCharges where registrationNo = '$registrationNo' and title = 'Room And Board'  ");

while($row = mysqli_fetch_array($result))
  {
return $row['quantity'];
  }

}



public function getPatientDoc($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT description,total,company,company1,phic,cashPaid,cashUnpaid,registrationNo from patientCharges where registrationNo = '$registrationNo' and title = 'PROFESSIONAL FEE' and status = 'UNPAID'  ");


while($row = mysqli_fetch_array($result))
  {
echo "<tr>";

echo "<td>&nbsp;<font size=2>".$row['description']."</font></tD>";
echo "<td>&nbsp;<font size=2>".$row['total']."</font></tD>";
echo "<td>&nbsp;<font size=2>".$row['phic']."</font></tD>";
echo "<td>&nbsp;<font size=2>".$row['company']."</font></tD>";
echo "<td>&nbsp;<font size=2>".$row['cashUnpaid']."</font></tD>";


echo "</tr>";  
}


}


public function getPatientDoc_company1($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT description,total,company,company1,phic,cashPaid,cashUnpaid,registrationNo from patientCharges where registrationNo = '$registrationNo' and title = 'PROFESSIONAL FEE' and status = 'UNPAID'  ");


while($row = mysqli_fetch_array($result))
  {
echo "<tr>";

echo "<td>&nbsp;<font size=2>".$row['description']."</font></tD>";
echo "<td>&nbsp;<font size=2>".$row['total']."</font></tD>";
echo "<td>&nbsp;<font size=2>".$row['phic']."</font></tD>";
echo "<td>&nbsp;<font size=2>".$row['company']."</font></tD>";
echo "<td>&nbsp;<font size=2>".$row['company1']."</font></tD>";
echo "<td>&nbsp;<font size=2>".$row['cashUnpaid']."</font></tD>";


echo "</tr>";  
}


}



//ito ung function na maglalabas ng lahat ng mysql result kahit nka return/variable
public function getPatientDoc_soa2pdf($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT description,total,company,phic,cashPaid,cashUnpaid from patientCharges where registrationNo = '$registrationNo' and title = 'PROFESSIONAL FEE'  ");


while($row = mysqli_fetch_array($result))
  {

$result_array[] = "<tr>
<td>".$row['description']."</td>
<td>".$row['total']."</td>
<td>".$row['phic']."</td>
<td>".$row['company']."</td>
<td>".$row['cashUnpaid']."</td>
</tr>";

}

return implode(",",$result_array);

}



public $getPatient_total;
public $getPatient_company;
public $getPatient_company1;
public $getPatient_phic;
public $getPatient_cashPaid;
public $getPatient_cashUnpaid;

public function getPatient_total() {
return $this->getPatient_total;
}
public function getPatient_company() {
return $this->getPatient_company;
}
public function getPatient_company1() {
return $this->getPatient_company1;
}
public function getPatient_phic() {
return $this->getPatient_phic;
}
public function getPatient_cashPaid() {
return $this->getPatient_cashPaid;
}
public function getPatient_cashUnpaid() {
return $this->getPatient_cashUnpaid;
}





public function getPatientDoc_setter($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT description,total,company,phic,cashPaid,cashUnpaid,company1 from patientCharges where registrationNo = '$registrationNo' and title = 'PROFESSIONAL FEE' and status = 'UNPAID' ");


while($row = mysqli_fetch_array($result))
  {

$this->getPatient_total += $row['total'];
$this->getPatient_company += $row['company'];
$this->getPatient_company1 += $row['company1'];
$this->getPatient_phic += $row['phic'];
$this->getPatient_cashPaid += $row['cashPaid'];
$this->getPatient_cashUnpaid += $row['cashUnpaid'];

}


}






public function getRoomPHIC_total($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(total) as total from patientCharges where registrationNo = '$registrationNo' and title = 'Room And Board' and status in ('UNPAID','Discharged')  ");


while($row = mysqli_fetch_array($result))
  {
return $row['total'];

}


}




public function getRoomPHIC_cover($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(phic) as phic from patientCharges where registrationNo = '$registrationNo' and title = 'Room And Board'  ");


while($row = mysqli_fetch_array($result))
  {
return $row['phic'];

}


}





//SINGLE 
public function getTitle($itemNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT title from patientCharges  where itemNo = '$itemNo'   ");

while($row = mysqli_fetch_array($result))
  {
return $row['title'];
  }

}

public $department_title;

//CALLEE
public function getDepartmentInventory() {
return $this->department_title;
}

//MULTIPLE ITO ANG CALLER
public function getInventoryFrom($itemNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT inventoryFrom from patientCharges  where itemNo = '$itemNo'   ");

while($row = mysqli_fetch_array($result))
  {
$this->department_title = $row['inventoryFrom'];
  }

}



public function changeQTY($chargesCode,$newQTY) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE inventory SET quantity = '$newQTY' WHERE inventoryCode='$chargesCode'
 ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function changeTotal($itemNo,$newTotal) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE patientCharges SET total = '$newTotal' WHERE itemNo='$itemNo'
 ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


public function  checkBalance($patientNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pc.cashUnpaid) as cashUnpaid from patientCharges pc,patientRecord pr,registrationDetails rd  where rd.patientNo='$patientNo' and rd.registrationNo = pc.registrationNo and pc.status = 'BALANCE' group by pc.status   ");

while($row = mysqli_fetch_array($result))
  {
return $row['cashUnpaid'];
  }

}


//BASED ON PASSWORD
public function getUserBranch($password) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT branch from registeredUser where password='$password'  ");

while($row = mysqli_fetch_array($result))
  {
return $row['branch'];
  }

}


//BASED ON USERNAME AND MODULE
public function getUserBranch_username($username,$module) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT branch from registeredUser where username='$username' and module = '$module'  ");

while($row = mysqli_fetch_array($result))
  {
return $row['branch'];
  }

}

public function getUserBranch_dept($username,$module) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT branch from registeredUser where username='$username' and module='$module'  ");

while($row = mysqli_fetch_array($result))
  {
return $row['branch'];
  }

}


public function checkBranch($branch) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT branch from branch where branch='$branch'  ");

while($row = mysqli_fetch_array($result))
  {
return $row['branch'];
  }

}



//PRA LUMABAS LHAT NG BRANCH N NKA DROPDOWN MENU SA ADMIN (MEDICINE)
public function getAdminBranchMeds($username) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT branch from branch order by branch asc  ");

while($row = mysqli_fetch_array($result))
  {
echo "<li><a href='http://".$this->getMyUrl()."/COCONUT/ADMIN/inventoryBranch.php?username=$username&branch=$row[branch]&inventoryType=medicine&show=All' target='departmentX'>Medicine in ".$row['branch']."</a></li>";
  }

}


//PRA LUMABAS LHAT NG BRANCH N NKA DROPDOWN MENU SA ADMIN (SUPPLIES)
public function getAdminBranchSupplies($username) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT branch from branch order by branch asc  ");

while($row = mysqli_fetch_array($result))
  {
echo "<li><a href='http://".$this->getMyUrl()."/COCONUT/ADMIN/inventoryBranch.php?username=$username&branch=$row[branch]&inventoryType=supplies&show=All' target='departmentX'>Supplies in ".$row['branch']."</a></li>";
  }

}

//PRA LUMABAS LHAT NG BRANCH N NKA DROPDOWN MENU SA MAINTENANCE
public function getMaintenanceBranch($username,$target,$inventoryType) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT branch from branch order by branch asc  ");

while($row = mysqli_fetch_array($result))
  {

if($inventoryType == "CSR" || $inventoryType == "PHARMACY") {
echo "<li><a href='http://".$this->getMyUrl()."/COCONUT/masterfile/inventory.php?username=$username&branch=$row[branch]&inventoryType=$inventoryType&show=All' target='$target'>Stocklist of $inventoryType in ".$row['branch']."</a></li>";
}else {
echo "<li><a href='http://".$this->getMyUrl()."/COCONUT/masterfile/inventory.php?username=$username&branch=$row[branch]&inventoryType=$inventoryType&show=All' target='$target'>List of $inventoryType in ".$row['branch']."</a></li>";
}
  }

}


//PRA LUMABAS LHAT NG BRANCH N NKA DROPDOWN MENU SA ADMIN
public function getDepartmentBranch($target,$inventoryType,$username,$requestingDepartment) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT branch from branch order by branch asc  ");

while($row = mysqli_fetch_array($result))
  {
echo "<li><a href='http://".$this->getMyUrl()."/COCONUT/availableMedicine/medicineRequest.php?branch=$row[branch]&inventoryType=$inventoryType&username=$username&requestingDepartment=$requestingDepartment' target='$target'>Request $inventoryType to the CSR of ".$row['branch']."</a></li>";
  }

}




//RECEIVE REQUESTITION
public function receiveRequest($target,$inventoryType,$username,$requestingDepartment) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT branch from branch order by branch asc  ");

while($row = mysqli_fetch_array($result))
  {
echo "<li><a href='http://".$this->getMyUrl()."/COCONUT/availableMedicine/medicineRequest.php?branch=$row[branch]&inventoryType=$inventoryType&username=$username&requestingDepartment=$requestingDepartment' target='$target'>Request $inventoryType to the CSR of ".$row['branch']."</a></li>";
  }

}


//KKUNIN LHAT NG NAG REQUEST SA DEPARTMENT AT BRANCH N CSR
public function getCSRBranch($target,$username,$myDepartment,$myBranch) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT requestingBranch,requestingDepartment,requestTo_department,requestTo_branch,requestingUser from inventoryManager WHERE requestTo_department='$myDepartment' and status='requesting' group by requestingUser ");

if(mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_array($result))
  {
echo "<li><a href='http://".$this->getMyUrl()."/COCONUT/availableMedicine/showRequestList.php?username=$username&requestingDepartment=$row[requestingDepartment]&requestTo_department=$myDepartment&checkz=yes&requestingUser=$row[requestingUser]' target='$target'>From ".$row['requestingDepartment']." of $row[requestingUser]</a></li>";

  }
}else {
echo "<li><a href='http://".$this->getMyUrl()."/COCONUT/availableMedicine/medicineRequest.php?username=$username' target='$target'>You Have no Request</a></li>";
}

}



public $allRequest;

public function allRequest() {
return $this->allRequest;
}

//BBLANGIN LHAT NG REQUEST AS IN SUMMARY
public function getTotalRequest($target,$username,$myDepartment) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT requestingBranch,requestingDepartment,requestTo_department,requestTo_branch from inventoryManager WHERE requestTo_department='$myDepartment' and status = 'requesting' group by requestingUser  ");

while($row = mysqli_fetch_array($result))
  {
$this->allRequest+=$this->getRequest($row['requestTo_department'],$row['requestTo_branch'],$row['requestingDepartment'],$row['requestingBranch']);

  }

}



//PRA SA REPORT NG ALL BRANCHES LLBAS ANG MGA BRANCH AS TABLE HEADER SA REPORT
public function getHeaderBranch() {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT branch from branch order by branch asc  ");

while($row = mysqli_fetch_array($result))
  {
echo "<th>&nbsp;".$row['branch']."&nbsp;</th>";
  }

}


//KKUNIN ANG DEPARTMENT STATUS
public function getDepartmentStatus($itemNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from patientCharges where itemNo = '$itemNo'  ");

while($row = mysqli_fetch_array($result))
  {
return $row['departmentStatus'];
  }

}



//KKUNIN ANG STATUS
public function getChargesStatus($itemNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from patientCharges where itemNo = '$itemNo'  ");

while($row = mysqli_fetch_array($result))
  {
return $row['status'];
  }

}


//KKUNIN ANG STATUS
public function getChargesStatusDept($itemNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT departmentStatus from patientCharges where itemNo = '$itemNo' and departmentStatus like 'dispensedBy%%%%'  ");

while($row = mysqli_fetch_array($result))
  {
return $row['departmentStatus'];
  }

}

//KKUNIN ANG QTY NG CHARGES
public function getPatientChargesQTY($itemNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from patientCharges where itemNo = '$itemNo'  ");

while($row = mysqli_fetch_array($result))
  {
return $row['quantity'];
  }

}



//KKUHAIN ANG TOTAL NG BWAT MODULE/DEPT
public function getTotalEachBranch_module($type,$branch,$module,$m,$d,$y,$m1,$d1,$y1) {

$fromDate = $y."-".$m."-".$d;
$toDate = $y1."-".$m1."-".$d1;

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($module == "PHARMACY" || $module == "CSR") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pc.cashPaid) as cashPaid from patientCharges pc,registrationDetails rd where pc.registrationNo = rd.registrationNo and (pc.status = 'PAID' or pc.status='Approved') and rd.type='$type' and pc.branch = '$branch' and pc.inventoryFrom = '$module' and (pc.datePaid between '$fromDate' and '$toDate')  ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pc.cashPaid) as cashPaid from patientCharges pc,registrationDetails rd where pc.registrationNo = rd.registrationNo and (pc.status = 'PAID') and pc.branch = '$branch' and pc.title = '$module' and (pc.datePaid between '$fromDate' and '$toDate')   ");
}
while($row = mysqli_fetch_array($result))
  {
return $row['cashPaid'];
  }

}



public function getTotalEachBranch_module_balance($type,$branch,$module,$m,$d,$y,$m1,$d1,$y1) {

$fromDate = $m."_".$d."_".$y;
$toDate = $m1."_".$d1."_".$y1;

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($module == "PHARMACY" || $module == "CSR") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pb.amountPaid) as amountPaid from patientCharges pc,registrationDetails rd,patientBalance pb where pb.itemNo = pc.itemNo and pc.registrationNo = rd.registrationNo and (pc.status = 'PAID' or pc.status='Approved')  and pc.branch = '$branch' and rd.type='$type' and pc.inventoryFrom = '$module' and (pc.datePaid between '$fromDate' and '$toDate')  ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pb.amountPaid) as amountPaid from patientCharges pc,registrationDetails rd,patientBalance pb where pb.itemNo = pc.itemNo and pc.registrationNo = rd.registrationNo and (pc.status = 'PAID' or pc.status='Approved')  and pc.branch = '$branch' and rd.type='$type' and pc.title = '$module' and (pc.datePaid between '$fromDate' and '$toDate')   ");
}
while($row = mysqli_fetch_array($result))
  {
return $row['amountPaid'];
  }

}





public function getTotalEachBranch_All($branch,$title,$m,$d,$y,$m1,$d1,$y1) {

$fromDate = $m."_".$d."_".$y;
$toDate = $m1."_".$d1."_".$y1;

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

//if($module == "PHARMACY" || $module == "CSR") {
//$result = mysql_query("SELECT sum(pc.cashPaid) as cashPaid from patientCharges pc,registrationDetails rd where pc.registrationNo = rd.registrationNo and (pc.status = 'PAID' or pc.status='Approved')  and pc.branch = '$branch' and (pc.datePaid between '$fromDate' and '$toDate')  ");
//}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pc.cashPaid) as cashPaid from patientCharges pc,registrationDetails rd where pc.registrationNo = rd.registrationNo and (pc.status = 'PAID')  and pc.branch = '$branch' and (pc.datePaid between '$fromDate' and '$toDate') and pc.title = '$title'  ");
//}
while($row = mysqli_fetch_array($result))
  {
return $row['cashPaid'];
  }

}


public function getPaidBalance_allBranch($branch,$module,$m,$d,$y,$m1,$d1,$y1) {

$fromDate = $m."_".$d."_".$y;
$toDate = $m1."_".$d1."_".$y1;

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pb.amountPaid) as amountPaid from patientCharges pc,registrationDetails rd,patientBalance pb where pc.registrationNo = rd.registrationNo and pc.itemNo = pb.itemNo and (pc.status = 'PAID' )  and pc.branch = '$branch' and (pc.datePaid between '$fromDate' and '$toDate')   ");

while($row = mysqli_fetch_array($result))
  {
return $row['amountPaid'];
  }


}





public $accttitle_total;

//ITO UNG MGGING ROW SA REPORT N ANG LAMAN IS UNG TOTAL NG BWAT DEPT
public function reportRowBranch($type,$module,$m,$d,$y,$m1,$d1,$y1) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT branch from branch order by branch asc  ");

$this->accttitle_total=0;
while($row = mysqli_fetch_array($result))
  {
echo "<td>&nbsp;".number_format($this->getTotalEachBranch_module($type,$row['branch'],$module,$m,$d,$y,$m1,$d1,$y1) + $this->getTotalEachBranch_module_balance($type,$row['branch'],$module,$m,$d,$y,$m1,$d1,$y1),2)."&nbsp;</td>";
//COMPUTE TOTAL
$this->accttitle_total+=$this->getTotalEachBranch_module($type,$row['branch'],$module,$m,$d,$y,$m1,$d1,$y1);
  }
echo "<Td>&nbsp;<b>".number_format($this->accttitle_total,2)."</b>&nbsp;</td>";
}


//KKUHAIN ANG TOTAL NG BWAT BRANCH
public function getRowTotal($module,$m,$d,$y,$m1,$d1,$y1) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT branch from branch order by branch asc  ");

while($row = mysqli_fetch_array($result))
  {
echo "<td>&nbsp;".number_format($this->getTotalEachBranch_All($row['branch'],$module,$m,$d,$y,$m1,$d1,$y1) + $this->getPaidBalance_allBranch($row['branch'],$module,$m,$d,$y,$m1,$d1,$y1),2)."&nbsp;</td>";
  }

}


public function getMasterListCharges($show,$desc,$title,$username) {

echo "<style type='text/css'>
tr:hover { background-color:yellow; color:black; }
.data{
font-size:14px;
}
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


if($show == "All") { // iLLbas Lhat ng charges
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from availableCharges where Category = '$title' order by Description asc  ");
}else { // iLLbas kung anu Lng ung cnsearch
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from availableCharges where Category = '$title' and description like '$desc%%%%%%%' order by Description asc  ");
}
echo "<center><table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
$this->coconutTableHeader("Code");
$this->coconutTableHeader("Description");
$this->coconutTableHeader("Category");
$this->coconutTableHeader("Type");
$this->coconutTableHeader("OPD Price");
$this->coconutTableHeader("IPD Price");
$this->coconutTableHeader("IPD (Private) Price");
$this->coconutTableHeader("Special Rates");
$this->coconutTableHeader("");
$this->coconutTableHeader("");
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;<font class='data'>".$row['chargesCode']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['Description']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['Category']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['subCategory']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['OPD']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['WARD']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['PRIVATE']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['specialRates']."</font>&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/EDIT/editCharges.php?chargesCode=$row[chargesCode]&description=$row[Description]&service=$row[Service]&category=$row[Category]&opd=$row[OPD]&ward=$row[WARD]&soloward=$row[SOLOWARD]&semiprivate=$row[SEMIPRIVATE]&private=$row[PRIVATE]&module=$title&username=$username&hmo=$row[HMO]&unitCost=$row[unitCost]&specialRates=$row[specialRates]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/DELETE/deleteCharges.php?username=$username&chargesCode=$row[chargesCode]&description=$row[Description]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>&nbsp;</td>";
echo "</tr>";
  }
echo "</tr>";

}



public function getMasterListICDcode($show,$desc,$protoType,$registrationNo,$username) {

echo "<style type='text/css'>
tr:hover { background-color:yellow; color:black; }
.data{
font-size:14px;
}
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


if($show == "All") { // iLLbas Lhat ng charges
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from availableICD order by icdCode asc  ");
}else { // iLLbas kung anu Lng ung cnsearch
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from availableICD where (diagnosis like '%%%%%%%%$desc%%%%%%%%%' or icdCode like '$desc%%%%%%' or rvsCode like '$desc%%%%%%%%') order by icdCode asc  ");
}
echo "<center><table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
$this->coconutTableHeader("ICD Code");
$this->coconutTableHeader("RVS Code");
$this->coconutTableHeader("Diagnosis");
$this->coconutTableHeader("Group");
$this->coconutTableHeader("Caserate");
$this->coconutTableHeader("PF");
$this->coconutTableHeader("Hospital");
$this->coconutTableHeader("");
$this->coconutTableHeader("");
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;<font class='data'>".$row['icdCode']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['rvsCode']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['diagnosis']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['groupz']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".number_format($row['caserate'],2)."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".number_format($row['pf'],2)."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".number_format($row['hospital'],2)."</font>&nbsp;</td>";
if($protoType == "maintenance") {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/EDIT/editICD.php?username=$username&icdCode=$row[icdCode]&diagnosis=$row[diagnosis]&icdTrackNo=$row[icdTrackNo]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>&nbsp;</td>";


echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/DELETE/deleteICD.php?icdTrackNo=$row[icdTrackNo]&icdCode=$row[icdCode]&diagnosis=$row[diagnosis]&username=$username&show=$show'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>&nbsp;</td>";

}else {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/addPatientICD.php?registrationNo=$registrationNo&icdCode=$row[icdCode]&rvsCode=$row[rvsCode]&diagnosis=$row[diagnosis]&username=$username'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/check.jpeg'></a>&nbsp;</td>";
}  
echo "</tr>";
}
echo "</tr>";

}


//For Purchasing-Mark
public function getMasterListStockCardPurch($description,$username,$sino,$page,$invoiceNo) {

echo "
<style type='text/css'>
<!--
tr:hover { background-color:yellow;color:red;}
.style1 {font-family: Arial;font-size: 14px;color: #000000;font-weight: bold;}
.style2 {font-family: Arial;font-size: 12px;color: #000000;font-weight: bold;}
.style3 {font-family: Arial;font-size: 12px;color: #0066FF;font-weight: bold;}
.style4 {font-family: Arial;font-size: 12px;color: #FFFFFF;font-weight: bold;}
.style5 {font-family: Arial;font-size: 12px;color: #FF0000;font-weight: bold;}
.style6 {font-family: Arial;font-size: 16px;color: #FF0000;font-weight: bold;}
.style7 {font-family: Arial;font-size: 16px;color: #0066FF;font-weight: bold;}
-->
</style>
";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT stockCardNo,description,genericName,encodedDetails,encodedBy,inventoryType from inventoryStockCard where (description like '$description%' or genericName like '$description%') and status not like 'DELETED%%%%%%%' ") or die("Query fail: " . mysqli_error()); 


echo "
<table width='80%' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000'>
  <tr>
    <td width='8%' height='25' bgcolor='#0066FF' class='style4'><div align='center'>Stock Card No.</div></td>
    <td width='22%' height='25' bgcolor='#0066FF' class='style4'><div align='center'>Description</div></td>
    <td width='18%' height='25' bgcolor='#0066FF' class='style4'><div align='center'>Generic</div></td>
    <td width='10%' height='25' bgcolor='#0066FF' class='style4'><div align='center'>Type</div></td>
    <td width='10%' height='25' bgcolor='#0066FF' class='style4'><div align='center'>Encoded</div></td>
    <td width='12%' height='25' bgcolor='#0066FF' class='style4'><div align='center'>User</div></td>
    <td width='5%' height='25' bgcolor='#0066FF' class='style4'><div align='center'>Add</div></td>
    <td width='5%' height='25' bgcolor='#0066FF' class='style4'><div align='center'>View</div></td>
  </tr>
";

while($row = mysqli_fetch_array($result)){
echo "
  <tr>
    <td class='style2'><div align='left'>&nbsp;".$row['stockCardNo']."</div></td>
    <td class='style2'><div align='left'>&nbsp;".$row['description']."</div></td>
    <td class='style2'><div align='left'>&nbsp;".$row['genericName']."</div></td>
    <td class='style2'><div align='center'>&nbsp;".$row['inventoryType']."</div></td>
    <td class='style2'><div align='center'>&nbsp;".$row['encodedDetails']."</div></td>
    <td class='style2'><div align='left'>&nbsp;".$row['encodedBy']."</div></td>
";

if( $row['inventoryType'] == "medicine" ) {
echo "
    <td class='style3'><div align='center'><a href='addInventory.php?username=$username&sino=$sino&page=$page&invoiceNo=$invoiceNo&status=old&stockCardNo=$row[stockCardNo]&description=$row[description]&genericName=$row[genericName]' class='style3'>Add</a></div></td>
";
}
else {
echo "
    <td class='style3'><div align='center'><a href='addInventory_supplies.php?username=$username&sino=$sino&page=$page&invoiceNo=$invoiceNo&status=old&stockCardNo=$row[stockCardNo]&description=$row[description]' class='style3'>Add</a></div></td>
";
}
echo "
    <td class='style3'><div align='center'><a href='stockCard.php?stockCardNo=$row[stockCardNo]&inventoryType=$row[inventoryType]&show=all' class='style3'>View</a></div></td>
  </tr>
";
}

echo "
  <tr>
    <td height='6' bgcolor='#0066FF'></td>
    <td height='6' bgcolor='#0066FF'></td>
    <td height='6' bgcolor='#0066FF'></td>
    <td height='6' bgcolor='#0066FF'></td>
    <td height='6' bgcolor='#0066FF'></td>
    <td height='6' bgcolor='#0066FF'></td>
    <td height='6' bgcolor='#0066FF'></td>
    <td height='6' bgcolor='#0066FF'></td>
  </tr>
</table>
";

echo "
<br><br>
<a href='addInventory.php?username=$username&sino=$sino&page=$page&invoiceNo=$invoiceNo&status=new&stockCardNo=&description=&genericName=' class='style6'>New Medicine & Stock Card</a>
<br><br>
<a href='addInventory_supplies.php?username=$username&sino=$sino&page=$page&invoiceNo=$invoiceNo&status=new&stockCardNo=&description=' class='style7'>New Supplies & Stock Card</a>";

}
//End For Purchasing-Mark^


public function getMasterListStockCard($description,$username) {


echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT stockCardNo,description,genericName,encodedDetails,encodedBy,inventoryType from inventoryStockCard where (description like '$description%' or genericName like '$description%' or stockCardNo = '$description') and status not like 'DELETED%' ") or die("Query fail: " . mysqli_error()); 

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Stock Card#");
$this->coconutTableHeader("Description");
$this->coconutTableHeader("Generic");
$this->coconutTableHeader("Type");
$this->coconutTableHeader("Encoded");
$this->coconutTableHeader("User");
$this->coconutTableHeader("");
$this->coconutTableHeader("");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;".$row['stockCardNo']);
$this->coconutTableData("&nbsp;".$row['description']);
$this->coconutTableData("&nbsp;".$row['genericName']);
$this->coconutTableData("&nbsp;".$row['inventoryType']);
$this->coconutTableData("&nbsp;".$row['encodedDetails']);
$this->coconutTableData("&nbsp;".$row['encodedBy']);
if( $row['inventoryType'] == "medicine" ) {
//$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/inventory/addInventory.php?username=$username&status=old&stockCardNo=$row[stockCardNo]&description=$row[description]&genericName=$row[genericName]' style='color:red; text-decoration:none;'>Add</a>");

$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/inventory/addMedicine.php?username=$username&status=old&stockCardNo=$row[stockCardNo]&description=$row[description]&genericName=$row[genericName]' style='color:red; text-decoration:none;'>Add</a>");

}else {
//$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/inventory/addInventory_supplies.php?username=$username&status=old&stockCardNo=$row[stockCardNo]&description=$row[description]' style='color:red; text-decoration:none;'>Add</a>");

$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/inventory/addSupplies.php?username=$username&status=old&stockCardNo=$row[stockCardNo]&description=$row[description]' style='color:red; text-decoration:none;'>Add</a>");

}
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/inventory/stockCard.php?stockCardNo=$row[stockCardNo]&inventoryType=$row[inventoryType]&show=all' style='color:blue; text-decoration:none;'>View</a>");
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/inventory/addEndingInventory_manual.php?stockCardNo=$row[stockCardNo]' style='text-decoration:none; color:black;'>Ending</a>");
$this->coconutTableRowStop();
}
$this->coconutTableStop();

//echo "<br><br><a href='http://".$this->getMyUrl()."/COCONUT/inventory/addInventory.php?username=$username&status=new&stockCardNo=&description=&genericName=' style='color:red; text-decoration:none;'>New Medicine & Stock Card</a><br><br><a href='http://".$this->getMyUrl()."/COCONUT/inventory/addInventory_supplies.php?username=$username&status=new&stockCardNo=&description=' style='color:blue; text-decoration:none;'>New Supplies & Stock Card</a>";

echo "<br><br><a href='http://".$this->getMyUrl()."/COCONUT/inventory/addNewMedicine.php?username=$username' style='color:red; text-decoration:none;'>New Medicine & Stock Card</a><br><br><a href='http://".$this->getMyUrl()."/COCONUT/inventory/addNewSupplies.php?username=$username' style='color:blue; text-decoration:none;'>New Supplies & Stock Card</a>";

}



public function getMasterListInventory($show,$desc,$inventoryType,$username,$branch) {


echo "
<style type='text/css'>
.data{
font-size:12px;
}

tr:hover{ background-color:yellow; color:black; }

</style>

";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


if($show == "All") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT i.* from inventory i,inventoryStockCard isc where i.stockCardNo = isc.stockCardNo and (i.inventoryType = '$inventoryType' or i.inventoryLocation='$inventoryType') and i.branch='$branch' and i.status not like 'DELETED%%%%%%' and isc.status not like 'DELETED%' and i.quantity > 0 order by i.description asc  ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT i.* from inventory i,inventoryStockCard isc where i.stockCardNo = isc.stockCardNo and (i.description like '$desc%' or i.genericName like '$desc%') and (i.inventoryType = '$inventoryType' or i.inventoryLocation='$inventoryType') and i.status not like 'DELETED%%%%%%%%' and isc.status not like 'DELETED%' and i.branch='$branch' and i.quantity > 0 order by i.description asc  ");
}


echo "<center><table border=1 cellpadding=0 cellspacing=0 width='100%'>";
echo "<tr>";
echo "<th>&nbsp;</th>";
echo "<th>&nbsp;</th>";
//echo "<th>&nbsp;</th>";
echo "<th>&nbsp;</th>";
echo "<th>&nbsp;</th>";
echo "<th>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Inv#</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Stck#</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Description</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Generic</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Quantity</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Unitcost</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>OPD PRICE</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>IPD PRICE</font>&nbsp;</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";

echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/DELETE/verifyDeleteInventory.php?inventoryCode=$row[inventoryCode]&username=$username&description=$row[description]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>&nbsp;</td>";


if( $row['inventoryType'] == "medicine" ) {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/EDIT/editInventory.php?inventoryCode=$row[inventoryCode]&stockCardNo=$row[stockCardNo]&description=$row[description]&genericName=$row[genericName]&unitcost=$row[unitcost]&quantity=$row[quantity]&expiration=$row[expiration]&addedBy=$row[addedBy]&dateAdded=$row[dateAdded]&timeAdded=$row[timeAdded]&inventoryLocation=$row[inventoryLocation]&inventoryType=$row[inventoryType]&branch=$row[branch]&username=$username&transition=$row[transition]&remarks=$row[remarks]&preparation=$row[preparation]&phic=$row[phic]&pricing=$row[Added]&criticalLevel=$row[criticalLevel]&supplier=$row[supplier]&phicPrice=$row[phicPrice]&companyPrice=$row[companyPrice]&autoDispense=$row[autoDispense]&invoiceNo=$row[invoiceNo]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>&nbsp;</td>";

}else {

echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/EDIT/editInventory_supplies.php?username=$username&description=$row[description]&suppliesUNITCOST=$row[suppliesUNITCOST]&sellingPrice=$row[unitcost]&quantity=$row[quantity]&expiration=$row[expiration]&dateAdded=$row[dateAdded]&inventoryLocation=$row[inventoryLocation]&transition=$row[transition]&phic=$row[phic]&criticalLevel=$row[criticalLevel]&remarks=$row[remarks]&supplier=$row[supplier]&inventoryCode=$row[inventoryCode]&stockCardNo=$row[stockCardNo]&invoiceNo=$row[invoiceNo]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>&nbsp;</td>";
}


//echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/inventory/monthlyChart_front.php?description=$row[description]&chargesCode=$row[inventoryCode]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/bar.jpeg'></a>&nbsp;</td>";

//echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/inventory/annualChart_front.php?description=$row[description]&inventoryCode=$row[inventoryCode]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/line.png'></a>&nbsp;</td>";


echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Pharmacy/monitoring/monitoringHead.php?inventoryCode=$row[inventoryCode]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/eye.jpeg'></a>&nbsp;</td>";

if( $row['stockCardNo'] != "" ) {
echo "<td><a href='http://".$this->getMyUrl()."/COCONUT/inventory/stockCard.php?stockCardNo=$row[stockCardNo]&inventoryType=$row[inventoryType]&show=all' style='font-size:13px; text-decoration:none; color:red;'>Stock Card</a></td>";
}else {
echo "<td>&nbsp;</td>";
}


echo "<td>&nbsp;<a href='/COCONUT/inventory/transferInventory.php?stockCardNo=$row[stockCardNo]&description=$row[description]&generic=$row[genericName]&unitcost=$row[unitcost]&quantity=$row[quantity]&expiration=$row[expiration]&addedBy=$row[addedBy]&inventoryType=$row[inventoryType]&branch=$row[branch]&transition=$row[transition]&remarks=$row[remarks]&preparation=$row[preparation]&phic=$row[phic]&added=$row[Added]&criticalLevel=$row[criticalLevel]&supplier=$row[supplier]&suppliesUNITCOST=$row[suppliesUNITCOST]&autoDispense=$row[autoDispense]&status=$row[status]&classification=$row[classification]&ipdPrice=$row[ipdPrice]&opdPrice=$row[opdPrice]&unitOfMeasure=$row[unitOfMeasure]&inventoryCode=$row[inventoryCode]' style='text-decoration:none;'><font size=2>Transfer</font></a></td>";


echo "<td>&nbsp;<font class='data'>".$row['inventoryCode']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'><a href='/COCONUT/inventory/salesCost.php?stockCardNo=$row[stockCardNo]' style='text-decoration:none; color:black;'>".$row['stockCardNo']."</a></font>&nbsp;</td>";

if($this->selectNow("editedInventory","editNo","inventoryCode",$row['inventoryCode']) != "" ) {
echo "<td>&nbsp;<a href='/COCONUT/inventory/viewDispensing_date.php?inventoryCode=$row[inventoryCode]&description=$row[description]' style='text-decoration:none; color:black;' target='_blank'><font class='data'>".$row['description']."</font></a><Br><a href='http://".$this->getMyUrl()."/COCONUT/inventory/editHistory.php?inventoryCode=$row[inventoryCode]' style='text-decoration:none; color:red; font-size:11px;'>&nbsp;View Edit History</a>&nbsp;</td>";
}else {
echo "<td>&nbsp;<a href='/COCONUT/inventory/viewDispensing_date.php?inventoryCode=$row[inventoryCode]&description=$row[description]' style='text-decoration:none; color:black;' target='_blank'><font class='data'>".$row['description']."</font></a>&nbsp;</td>";
}
echo "<td>&nbsp;<font class='data'>".$row['genericName']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".number_format($row['quantity'],2)."</font></td>";

if( $row['inventoryType'] == "medicine" ) {
echo "<td>&nbsp;<font class='data'>".number_format($row['unitcost'],2)."</font></td>";
echo "<td>&nbsp;<font class='data'>".number_format($row['opdPrice'],2)."</font></td>";
echo "<td>&nbsp;<font class='data'>".number_format($row['ipdPrice'],2)."</font></td>";
}else {
echo "<td>&nbsp;<font class='data'>".number_format($row['suppliesUNITCOST'],2)."</font></td>";
echo "<td>&nbsp;<font class='data'>".number_format($row['unitcost'],2)."</font></td>";
echo "<td>&nbsp;<font class='data'>".number_format($row['unitcost'],2)."</font></td>";
}
echo "</tr>";
  }
echo "</table>";


}



public function getMasterListDoctor($show,$desc,$username) {

echo "
<style type='text/css'>
.data{
font-size:11.5px;
}

tr:hover{ background-color:yellow; color:black; }

</style>

";


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($show == "All") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from Doctors order by Name asc  ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from Doctors WHERE Name like '$desc%%%%%%' order by Name asc  ");
}

echo "<center><table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;<font class='data'>Doctor Code</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Name</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Specialization1</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Specialization2</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Specialization3</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Specialization4</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Specialization5</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>PHIC Accreditation No</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Contact</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>User Name</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Password</font>&nbsp;</th>";
echo "<th></th>";
echo "<th></th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;<font class='data'>".$row['doctorCode']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['Name']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['Specialization1']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['Specialization2']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['Specialization3']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['Specialization4']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['Specialization5']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['PhilHealth_AccreditationNo']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['contact']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['username']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['password']."</font>&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/EDIT/editDoctor.php?doctorCode=$row[doctorCode]&name=$row[Name]&specialization1=$row[Specialization1]&specialization2=$row[Specialization2]&specialization3=$row[Specialization3]&specialization4=$row[Specialization4]&specialization5=$row[Specialization5]&PHIC=$row[PhilHealth_AccreditationNo]&username=$username&usernameDoctor=$row[username]&password=$row[password]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/DELETE/deleteDoctor.php?username=$username&doctorCode=$row[doctorCode]&name=$row[Name]&show=$show'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>&nbsp;</td>";
echo "</tr>";  
}
echo "</table>";
}



public function getMasterListDoctorService($show,$desc,$username) {

echo "
<style type='text/css'>
.data{
font-size:11.5px;
}

tr:hover{ background-color:yellow; color:black; }

</style>

";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($show == "All") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from DoctorService order by serviceName asc  ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from DoctorService WHERE serviceName like '$desc%%%%' order by serviceName asc  ");
}

echo "<center><table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;Service Name&nbsp;</th>";
echo "<th>&nbsp;Specialization&nbsp;</th>";
echo "<th>&nbsp;Cash&nbsp;</th>";
echo "<th>&nbsp;Company&nbsp;</th>";
echo "<th>&nbsp;PF Share&nbsp;</th>";
echo "<th>&nbsp;Senior Discount&nbsp;</th>";
echo "<th>&nbsp;PHIC&nbsp;</th>";
echo "<th>&nbsp;</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;".$row['serviceName']."&nbsp;</td>";
echo "<td>&nbsp;".$row['specialization']."&nbsp;</td>";
echo "<td>&nbsp;".$row['cashAmount']."&nbsp;</td>";
echo "<td>&nbsp;".$row['companyRate']."&nbsp;</td>";
echo "<td>&nbsp;".$row['doctorShare']."&nbsp;</td>";
echo "<td>&nbsp;".$row['discount']."&nbsp;</td>";
echo "<td>&nbsp;".$row['phic']."&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/EDIT/EditDoctorService.php?serviceNo=$row[serviceNo]&serviceName=$row[serviceName]&specialization=$row[specialization]&cashAmount=$row[cashAmount]&companyRate=$row[companyRate]&doctorShare=$row[doctorShare]&discount=$row[discount]&username=$username'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/DELETE/deleteDoctorService.php?username=$username&serviceNo=$row[serviceNo]&serviceName=$row[serviceName]&specialization=$row[specialization]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>&nbsp;</td>";
echo "</tr>";
  }
echo "</table>";
}


public function getMasterListServices($show,$desc,$username) {

echo "
<style type='text/css'>
.data{
font-size:11.5px;
}

tr:hover{ background-color:yellow; color:black; }

</style>

";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($show == "All") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from Services order by Service asc  ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from Services WHERE Service like '$desc%%%%%' order by Service asc  ");
}
echo "<center><table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;Service&nbsp;</th>";
echo "<th>&nbsp;Category&nbsp;</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;".$row['Service']."&nbsp;</td>";
echo "<td>&nbsp;".$row['Category']."&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/EDIT/editService.php?service=$row[Service]&category=$row[Category]&serviceNo=$row[serviceNo]&username=$username&show=$show&desc=$desc'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/DELETE/deleteService.php?serviceNo=$row[serviceNo]&username=$username&service=$row[Service]&category=$row[Category]&show=$show'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>&nbsp;</td>";
echo "</tr>";
  }
echo "</table>";
}


public function getMasterListCompany($show,$desc,$username) {

echo "
<style type='text/css'>
.data{
font-size:11.5px;
}

tr:hover{ background-color:yellow; color:black; }

</style>

";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($show == "All") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from Company where companyName != '' order by companyName asc  ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from Company where companyName like '$desc%%%%' order by companyName asc  ");
}
echo "<center><table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;Name&nbsp;</th>";
echo "<th>&nbsp;Address&nbsp;</th>";
echo "<th>&nbsp;Rate 1&nbsp;</th>";
echo "<th>&nbsp;Rate 2&nbsp;</th>";
echo "<th>&nbsp;Rate 3&nbsp;</th>";
echo "<th>&nbsp;Rate 4&nbsp;</th>";
echo "<th>&nbsp;Type&nbsp;</th>";
echo "<th></th>";
echo "<th></th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;".$row['companyName']."&nbsp;</td>";
echo "<td>&nbsp;".$row['companyAddress']."&nbsp;</td>";
echo "<td>&nbsp;".$row['rate1']."&nbsp;</td>";
echo "<td>&nbsp;".$row['rate2']."&nbsp;</td>";
echo "<td>&nbsp;".$row['rate3']."&nbsp;</td>";
echo "<td>&nbsp;".$row['rate4']."&nbsp;</td>";
echo "<td>&nbsp;".$row['type']."&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/EDIT/editCompany.php?username=$username&companyName=$row[companyName]&companyAddress=$row[companyAddress]&rate1=$row[rate1]&rate2=$row[rate2]&rate3=$row[rate3]&rate4=$row[rate4]&companyNo=$row[companyNo]&username=$username&show=$show&desc=$desc'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/DELETE/deleteCompany.php?username=$username&companyNo=$row[companyNo]&companyName=$row[companyName]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>&nbsp;</td>";
echo "</tr>";
  }
echo "</table>";

}


public function getMasterListUser($show,$desc,$username) {

echo "
<style type='text/css'>
.data{
font-size:11.5px;
}

tr:hover{ background-color:yellow; color:black; }

</style>

";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($show == "All") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from registeredUser order by username asc  ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from registeredUser WHERE username like '$desc%%%%%%' order by username asc  ");
}
echo "<center><table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;Username&nbsp;</th>";
echo "<th>&nbsp;Password&nbsp;</th>";
echo "<th>&nbsp;Module&nbsp;</th>";
echo "<th>&nbsp;Branch&nbsp;</th>";
echo "<th>&nbsp;Name&nbsp;</th>";
echo "<th></th>";
echo "<th></th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;".$row['username']."&nbsp;</td>";
echo "<td>&nbsp;".$row['password']."&nbsp;</td>";
echo "<td>&nbsp;".$row['module']."&nbsp;</td>";
echo "<td>&nbsp;".$row['branch']."&nbsp;</td>";
echo "<td>&nbsp;".$row['completeName']."&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/EDIT/editUser.php?username=$username&user=$row[username]&password=$row[password]&module=$row[module]&branch=$row[branch]&completeName=$row[completeName]&employeeID=$row[employeeID]&show=$show'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/DELETE/deleteUser.php?username=$username&employeeID=$row[employeeID]&user=$row[username]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>&nbsp;</td>";
echo "</tr>";
  }
echo "</table>";

}



public function getMasterListBranch($show,$desc,$username) {

echo "
<style type='text/css'>
.data{
font-size:11.5px;
}

tr:hover{ background-color:yellow; color:black; }

</style>

";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($show == "All") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from branch order by branch asc  ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from branch WHERE branch like '$desc%%%%' order by branch asc  ");
}
echo "<center><table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;Branch&nbsp;</th>";
echo "<th></th>";
echo "<th></th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;".$row['branch']."&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/EDIT/editBranch.php?branchID=$row[branchID]&branch=$row[branch]&username=$username&show=$show'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/DELETE/deleteBranch.php?branchID=$row[branchID]&branch=$row[branch]&username=$username'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>&nbsp;</td>";
echo "</tr>";
  }
echo "</table>";

}



public function getMasterListPercentage($username) {

echo "
<style type='text/css'>
.data{
font-size:11.5px;
}

tr:hover{ background-color:yellow; color:black; }

</style>

";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from percentage order by percentageType asc  ");
echo "<center>";
echo "<table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;Description&nbsp;</th>";
echo "<th>&nbsp;percentageType&nbsp;</th>";
echo "<th>&nbsp;Amount&nbsp;</th>";
echo "<th></th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;".$row['description']."&nbsp;</td>";
echo "<td>&nbsp;".$row['percentageType']."&nbsp;</td>";
echo "<td>&nbsp;".$row['percentageAmount']."&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/EDIT/editPercentage.php?percentageNo=$row[percentageNo]&description=$row[description]&percentageAmount=$row[percentageAmount]&username=$username'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>&nbsp;</td>";
echo "</tr>";
  }
echo "</table>";

}



public function getMasterListRoom($username,$show,$desc) {

echo "
<style type='text/css'>
.data{
font-size:11.5px;
}

tr:hover{ background-color:yellow; color:black; }

a{ text-decoration:none; color:black; }

</style>

";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));
if($show == "All") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from room order by Description asc  ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from room WHERE Description like '$desc%%%%%%%' order by Description asc  ");
}
echo "<center>";
echo "<table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;Description&nbsp;</th>";
echo "<th>&nbsp;Type&nbsp;</th>";
echo "<th>&nbsp;Rate&nbsp;</th>";
echo "<th>&nbsp;Floor&nbsp;</th>";
echo "<th>&nbsp;Branch&nbsp;</th>";
//echo "<th>&nbsp;Status&nbsp;</th>";
echo "<th>&nbsp;Patient&nbsp;</th>";
echo "<th></th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
$myRoom = preg_split ("/\_/", $row['Description']); 
echo "<td>&nbsp;".$myRoom[0]."&nbsp;</td>";
echo "<td>&nbsp;".$row['type']."&nbsp;</td>";
echo "<td>&nbsp;".$row['rate']."&nbsp;</td>";
echo "<td>&nbsp;".$row['floor']."&nbsp;</td>";
echo "<td>&nbsp;".$row['branch']."&nbsp;</td>";
//echo "<td>&nbsp;".$row['status']."&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/Department/redirect.php?username=&registrationNo=".$this->getPatient_in_the_room($row['Description'])."' target='_blank'>".$this->getPatient_in_the_room($row['Description'])."</a>&nbsp;</td>";


echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/EDIT/editRoom.php?roomNo=$row[roomNo]&description=$row[Description]&type=$row[type]&rate=$row[rate]&branch=$row[branch]&username=$username&show=$show&desc=$desc&floor=$row[floor]&status=$row[status]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>&nbsp;</td>";

echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/DELETE/deleteRoom.php?roomNo=$row[roomNo]&description=$row[Description]&type=$row[type]&rate=$row[rate]&username=$username&show=$show&desc=$desc'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>&nbsp;</td>";
echo "</tr>";
  }
echo "</table>";

}



public function getMasterListFloor($username,$show,$desc) {

echo "
<style type='text/css'>
.data{
font-size:11.5px;
}

tr:hover{ background-color:yellow; color:black; }

</style>

";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));
if($show == "All") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from floor order by description asc  ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from floor WHERE description like '$desc%%%%%%%' order by description asc  ");
}
echo "<center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Floor");
$this->coconutTableHeader("Branch");
$this->coconutTableHeader("");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData($row['description']);
$this->coconutTableData($row['branch']);
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/EDIT/editFloor.php?username=$username&description=$row[description]&branch=$row[branch]&floorNo=$row[floorNo]&show=$show&desc='>".$this->coconutImages_return("pencil.jpeg")."</a>");
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/DELETE/deleteFloor.php?description=$row[description]&branch=$row[branch]&floorNo=$row[floorNo]&username=$username&show=$show&desc=$desc'>".$this->coconutImages_return("delete.jpeg")."</a>");
$this->coconutTableRowStop();
  }
$this->coconutTableStop();

}




public function getMasterListCaseType($username) {

echo "
<style type='text/css'>
.data{
font-size:11.5px;
}

tr:hover{ background-color:yellow; color:black; }

</style>

";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from phicLimit order by casetype asc  ");
echo "<center>";
echo "<table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;Case Type&nbsp;</th>";
echo "<th>&nbsp;Medicine&nbsp;</th>";
echo "<th>&nbsp;Supplies&nbsp;</th>";
echo "<th>&nbsp;Room&nbsp;</th>";
echo "<th>&nbsp;PF&nbsp;</th>";
echo "<th>&nbsp;Supplies Only&nbsp;</th>";
echo "<th></th>";
echo "<th></th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;".$row['casetype']."&nbsp;</td>";
echo "<td>&nbsp;".$row['medicine']."&nbsp;</td>";
echo "<td>&nbsp;".$row['supplies']."&nbsp;</td>";
echo "<td>&nbsp;".$row['room']."&nbsp;</td>";
echo "<td>&nbsp;".$row['pf']."&nbsp;</td>";
echo "<td>&nbsp;".$row['suppliesOnly']."&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/casetype/editCasetype.php?casetype=$row[casetype]&medicine=$row[medicine]&supplies=$row[supplies]&room=$row[room]&pf=$row[pf]&suppliesOnly=$row[suppliesOnly]&username=$username'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/casetype/deleteCasetype.php?username=$username&casetype=$row[casetype]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>&nbsp;</td>";
echo "</tr>";
  }
echo "</table>";

}




public function getMasterListPatientRecord($username,$show,$desc) {

echo "

<style type='text/css'>
#rowz:hover {
background-color:yellow;
}
</style>

";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($show == "All") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientRecord order by completeName asc ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientRecord where completeName like '$desc%%%%%' order by completeName asc ");
}

echo "<table width='230%' rules=all border=1>";
echo "<tr>";

$this->coconutTableHeader("");
$this->coconutTableHeader("");
$this->coconutTableHeader("#");
$this->coconutTableHeader("Patient No");
$this->coconutTableHeader("Last Name");
$this->coconutTableHeader("First Name");
$this->coconutTableHeader("Middle Name");
$this->coconutTableHeader("Complete Name");
$this->coconutTableHeader("BirthDate");
$this->coconutTableHeader("Age");
$this->coconutTableHeader("Gender");
$this->coconutTableHeader("Senior");
$this->coconutTableHeader("Address");
$this->coconutTableHeader("Contact#");
$this->coconutTableHeader("PhilHealth");
$this->coconutTableHeader("Civil Status");
$this->coconutTableHeader("Visits");
$this->coconutTableHeader("");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
$x=1;
while($row = mysqli_fetch_array($result))
  {
echo "<tr id='rowz'>";
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/EDIT/editPatientRecord.php?patientNo=$row[patientNo]&username=$username&lastName=$row[lastName]&firstName=$row[firstName]&middleName=$row[middleName]&completeName=$row[completeName]&Birthdate=$row[Birthdate]&Age=$row[Age]&Gender=$row[Gender]&Senior=$row[Senior]&Address=$row[Address]&contactNo=$row[contactNo]&PHIC=$row[PHIC]&civilStatus=$row[civilStatus]&username=$username&show=$show&desc=$desc'>".$this->coconutImages_return("pencil.jpeg")."</a>");
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/DELETE/verifyDeletePatientRecord.php?patientNo=$row[patientNo]&lastName=$row[lastName]&firstName=$row[firstName]&middleName=$row[middleName]&username=$username&show=$show&desc=$desc'>".$this->coconutImages_return("delete.jpeg")."</a>");
$this->coconutTableData($x++);
$this->coconutTableData($row['patientNo']);
$this->coconutTableData($row['lastName']);
$this->coconutTableData($row['firstName']);
$this->coconutTableData($row['middleName']);
$this->coconutTableData($row['completeName']);
$this->coconutTableData($row['Birthdate']);
$this->coconutTableData($row['Age']);
$this->coconutTableData($row['Gender']);
$this->coconutTableData($row['Senior']);
$this->coconutTableData($row['Address']);
$this->coconutTableData($row['contactNo']);
$this->coconutTableData($row['PHIC']);
$this->coconutTableData($row['civilStatus']);
$this->coconutTableData("<font color=red>".$this->regRecord($row['patientNo'],$username)."</font>");
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/EDIT/editPatientRecord.php?patientNo=$row[patientNo]&username=$username&lastName=$row[lastName]&firstName=$row[firstName]&middleName=$row[middleName]&completeName=$row[completeName]&Birthdate=$row[Birthdate]&Age=$row[Age]&Gender=$row[Gender]&Senior=$row[Senior]&Address=$row[Address]&contactNo=$row[contactNo]&PHIC=$row[PHIC]&civilStatus=$row[civilStatus]&username=$username&show=$show&desc=$desc'>".$this->coconutImages_return("pencil.jpeg")."</a>");
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/DELETE/verifyDeletePatientRecord.php?patientNo=$row[patientNo]&lastName=$row[lastName]&firstName=$row[firstName]&middleName=$row[middleName]&username=$username&show=$show&desc=$desc'>".$this->coconutImages_return("delete.jpeg")."</a>");
echo "</tr>";
  }


$this->coconutTableStop();

}



public function regRecord($patientNo,$username) {

echo "

<style type='text/css'>
a { text-decoration:none; color:red; }
</style>
";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(patientNo) as totalReg from registrationDetails WHERE patientNo = '$patientNo'  ");

while($row = mysqli_fetch_array($result))
  {
return "<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/registrationDetails.php?patientNo=$patientNo&username=$username'>".$row['totalReg']."</a>";
  }


}




public function getMasterListPackage($username) {

echo "
<style type='text/css'>
.data{
font-size:11.5px;
}

tr:hover{ background-color:yellow; color:black; }

</style>

";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from package order by description asc  ");
echo "<center>";
echo "<table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;Description&nbsp;</th>";
echo "<th>&nbsp;Price&nbsp;</th>";
echo "<th>&nbsp;PF&nbsp;</th>";
echo "<th></th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;".$row['description']."&nbsp;</td>";
echo "<td>&nbsp;".$row['price']."&nbsp;</td>";
echo "<td>&nbsp;".$row['pf']."&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/EDIT/editPackage.php?description=$row[description]&price=$row[price]&username=$username&packageNo=$row[packageNo]&pf=$row[pf]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>&nbsp;</td>";
echo "</tr>";
  }
echo "</table>";

}








public function getMasterListRegistrationDetails($patientNo,$username) {


echo "
<style type='text/css'>
a{ text-decoration:none; color:000; }
</style>
";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT rd.*,upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,upper(pr.middleName) as middleName from registrationDetails rd,patientRecord pr WHERE pr.patientNo = rd.patientNo and rd.patientNo = '$patientNo'  ");

echo "<br><center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Reg No#");
$this->coconutTableHeader("Name");
$this->coconutTableHeader("Registration Date");
$this->coconutTableHeader("Branch");
$this->coconutTableHeader("Registered By");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
$this->coconutTableData($row['registrationNo']);
$this->coconutTableData("<a href='#'>".$row['lastName']," ".$row['firstName']." ".$row['middleName']."</a>");
$this->coconutTableData($row['dateRegistered']);
$this->coconutTableData($row['branch']);
$this->coconutTableData("");
echo "</tr>";
  }

$this->coconutTableStop();

}



public $viewCreditLimit_limit;
public $viewCreditLimit_current;
public $viewCreditLimit_payment;
public $viewCreditLimit_allowable;


public function viewCreditLimit($registrationNo,$type,$username) {


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($type == "PATIENT") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from patientCreditLimit WHERE registrationNo = '$registrationNo' and limitTo = 'PATIENT' and limitVia = 'cashUnpaid' order by limitTo");	
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from patientCreditLimit WHERE registrationNo = '$registrationNo' and limitTo != 'PATIENT' order by limitTo	 asc  ");
}


if($type == "PATIENT") {
echo "<br><center><br>";
echo "<table border=1 rules=all cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>Limit To</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>Limit Via</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>Balance</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>Payment</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>Current Bal.</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>Limit</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>Limit By</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'></th>";
echo "<th bgcolor='#3b5998'></th>";
echo "</tr>";
}else {
echo "<br><center><br>";
echo "<table border=1 rules=all cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>Limit To</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>Limit Via</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>Covered</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>Limit</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>Limit By</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'></th>";
echo "<th bgcolor='#3b5998'></th>";
echo "</tr>";
}
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";

$current = $this->getCurrentCredit($registrationNo,$row['limitTo'],$row['limitVia']) - $this->getCurrentPaid($registrationNo,$row['limitTo'],$row['limitVia']);


if($type != "PATIENT") {
$this->viewCreditLimit_limit += $row['amountLimit'];
$this->viewCreditLimit_current += $this->getCurrentCredit($registrationNo,$row['limitTo'],$row['limitVia']);
$this->viewCreditLimit_payment += $this->getCurrentPaid($registrationNo,$row['limitTo'],$row['limitVia']);
}else {
echo "";
}

if($current > 0) {
$this->viewCreditLimit_allowable += $current; //add if current > 0
}else { //leave if current < 0 to pra maiwasan ang pag subtract ng amount once nagkaroon ng negative numbers s allowable
}


echo "<td>&nbsp;".$row['limitTo']."&nbsp;</td>";
echo "<td>&nbsp;".$row['limitVia']."&nbsp;</td>";


if($type=="PATIENT") { //show payment at current Balance header....
echo "<td>&nbsp;".number_format(($this->getCurrentCredit($registrationNo,$row['limitTo'],$row['limitVia'])),2)."&nbsp;</td>";
echo "<td>&nbsp;".number_format($this->getCurrentPaid($registrationNo,$row['limitTo'],$row['limitVia']),2)."&nbsp;</td>";


if($current > $row['amountLimit']) {
echo "<td>&nbsp;<font color=red>".number_format($current,2)."</font> - (<font color=blue>".number_format($current - $row['amountLimit'],2)."</font>)&nbsp;</tD>";
}else if($current < 0) {
echo "<td>&nbsp;<font color=blue>".number_format($current,2)."</font>&nbsp;</tD>";
}else {
echo "<td>&nbsp;<b>".number_format($current,2)."</b>&nbsp;</tD>";
}

}else { //hide payment at current balance


if($this->getCurrentCredit($registrationNo,$row['limitTo'],$row['limitVia']) > $row['amountLimit']) {
echo "<td>&nbsp;<font color=red>".number_format(($this->getCurrentCredit($registrationNo,$row['limitTo'],$row['limitVia'])),2)."</font> - (<font color=blue>".number_format($this->getCurrentCredit($registrationNo,$row['limitTo'],$row['limitVia']) - $row['amountLimit'],2)."</font>)&nbsp;</td>";
}else {
echo "<td>&nbsp;".number_format(($this->getCurrentCredit($registrationNo,$row['limitTo'],$row['limitVia'])),2)."&nbsp;</td>";
}

}
echo "<td>&nbsp;".number_format($row['amountLimit'],2)."&nbsp;</td>";
echo "<td>&nbsp;".$row['username']."&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/creditLimit/editCreditLimit.php?limitTo=$row[limitTo]&limitVia=$row[limitVia]&amountLimit=$row[amountLimit]&username=$username&limitNo=$row[limitNo]&registrationNo=$row[registrationNo]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/creditLimit/verifyDeleteCreditLimit.php?limitNo=$row[limitNo]&registrationNo=$row[registrationNo]&limitTo=$row[limitTo]&username=$username'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>&nbsp;</td>";
echo "</tr>";
  }

echo "<tr>";

if($type =='PATIENT') {
echo "";
}else {
echo "<td><center><b>TOTAL</b></center></tD>";
echo "<Td>&nbsp;</tD>";
echo "<td>&nbsp;".number_format($this->viewCreditLimit_current,2)."&nbsp;</tD>"; // get current covered [PATIENT]
echo "<td>&nbsp;".number_format($this->viewCreditLimit_limit,2)."&nbsp;</tD>"; // get limit [ndi PATIENT]
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
}

echo "</tr>";

echo "</table>";

}



public $viewCreditLimit_setter_limitNo;
public $viewCreditLimit_setter_registrationNo;
public $viewCreditLimit_setter_limitTo;
public $viewCreditLimit_setter_limitVia;
public $viewCreditLimit_setter_amountLimit;

public function viewCreditLimit_setter_limitNo() {
return $this->viewCreditLimit_setter_limitNo;
}
public function viewCreditLimit_setter_registrationNo() {
return $this->viewCreditLimit_setter_registrationNo;
}
public function viewCreditLimit_setter_limitTo() {
return $this->viewCreditLimit_setter_limitTo;
}
public function viewCreditLimit_setter_limitVia() {
return $this->viewCreditLimit_setter_limitVia;
}
public function viewCreditLimit_setter_amountLimit() {
return $this->viewCreditLimit_setter_amountLimit;
}

public function viewCreditLimit_setter($registrationNo,$limitTo,$limitVia,$username) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from patientCreditLimit WHERE registrationNo = '$registrationNo' and limitTo = '$limitTo' and limitVia = '$limitVia' order by limitTo asc  ");

while($row = mysqli_fetch_array($result))
  {
$this->viewCreditLimit_setter_limitNo = $row['limitNo'];
$this->viewCreditLimit_setter_registrationNo = $row['registrationNo'];
$this->viewCreditLimit_setter_limitTo = $row['limitTo'];
$this->viewCreditLimit_setter_limitVia = $row['limitVia'];
$this->viewCreditLimit_setter_amountLimit = $row['amountLimit'];
  }


}





public function countPatientCharges($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select pc.itemNo from patientCharges pc where pc.registrationNo = '$registrationNo' and pc.company != 0 and pc.status = 'UNPAID' ") or die("Query fail: " . mysqli_error()); 

return ($result->num_rows) - 1; // 10 rows binawasan ng isa kc ung una Black font tpos ung 9 nka white font.

}

public function getHmoSOA_sumPatientCharges($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(pc.company) as totCompany from patientCharges pc where pc.registrationNo = '$registrationNo' and pc.company != 0 and pc.status = 'UNPAID' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['totCompany'];
}

}

public $hmoAmount;
public $getHmoSOA_no;
public static $getHmoSOA_registrationNo;
public $getHmoSOA_whiteNo;
public $getHmoSOA_whiteNo_compare;

public function getHmoSOA($type,$company,$fromMonth,$fromDay,$fromYear,$toMonth,$toDay,$toYear,$username,$branch) {

echo "
<style type='text/css'>
.data{
font-size:11.5px;
}

#hmoz:hover{ background-color:yellow; color:black; }

</style>

";

$fromDate = $fromYear."-".$fromMonth."-".$fromDay;
$toDate = $toYear."-".$toMonth."-".$toDay;
$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.branch,rd.registrationNo,upper(pr.lastname) as lastname,upper(pr.firstname) as firstname,pc.description,pc.company,pc.quantity,pc.dateCharge,pc.title,pc.service,pc.chargesCode from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.Company = '$company' and rd.type='$type' and (rd.dateRegistered between '$fromDate' and '$toDate') and pc.company != 0 and status = 'UNPAID' order by rd.dateRegistered,pr.lastName,rd.timeRegistered asc  ");



echo "<table border=0 cellpadding=0 cellspacing=0 >";
echo "<tr>";
echo "<th>&nbsp;<font size=3>Name</font>&nbsp;</th>";
echo "<th>&nbsp;<font size=3>Date Exam</font>&nbsp;</th>";
echo "<th>&nbsp;<font size=2>Exam/Treatment/Medicine</font>&nbsp;</th>";
echo "<th>&nbsp;<font size=3>Amount</font>&nbsp;</th>";
echo "<th>&nbsp;<font size=3 color=red>Total</font>&nbsp;</th>";
echo "</tr>";
$this->hmoAmount=0;
$this->getHmoSOA_no=0;
$counter="";

while($row = mysqli_fetch_array($result))
  {

$date = preg_split ("/\-/", $row['dateCharge']); 

$this->hmoAmount+=$row['company'];
$this->getHmoSOA_whiteNo_compare = $this->getHmoSOA_whiteNo;

echo "<tr id='hmoz'>";

//static pra ma preserve ung last registrationNo sa variable then compare to the new registrationNo from database then compare kung parehas gwen white kung ndi gwen black. ung black ung pnka unang result
if( self::$getHmoSOA_registrationNo != $row['registrationNo'] ) { 
$this->getHmoSOA_no += 1;
$this->getHmoSOA_whiteNo=0;
echo "<td><font size=2>".$this->getHmoSOA_no." <a href='http://".$this->getMyUrl()."/COCONUT/currentPatient/patientInterface1.php?username=$username&registrationNo=$row[registrationNo]' target='_blank' style='text-decoration:none; color:black;'><font size=2>".$row['lastname']." ".$row['firstname']."</font></a>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".$date[1]."/".$date[2]."/".$date[0]."</font></td>";
}else {
$this->getHmoSOA_whiteNo += 1;
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
}



if( $row['title'] == "PROFESSIONAL FEE" ) {
echo "<td>&nbsp;<font size=2>$row[service]</font></td>";
}else {
echo "<td>&nbsp;<font size=2>$row[description]</font></td>";
}
echo "<td align='right'>&nbsp;<font size=2>".number_format($row['company'],2)."</font></td>";


self::$getHmoSOA_registrationNo = $row['registrationNo'];



//pinka last row ng bawat px sa hmo soa
if( $this->getHmoSOA_whiteNo == $this->countPatientCharges($row['registrationNo']) ) {
echo "<td align='right'>&nbsp;&nbsp;&nbsp;<font size=2>".number_format($this->getHmoSOA_sumPatientCharges($row['registrationNo']),2)."</font></td>";
echo "</tr>";
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td style='border-top:1px solid #000;'>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
}else {
echo "<td>&nbsp;<font size=2></font></td>";
echo "</tr>";
}


}


echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font size=2>TOTAL</font></td>";
echo "<td>&nbsp;</td>";
echo "<td style='border-bottom:1px solid #000; text-align:right;' >&nbsp;<a href='#' style='color:black;'><font size=2><b>".number_format($this->hmoAmount,2)."</b></font></a></td>";
echo "</tr>";

echo "</table>";
echo "<br>";



}






public function getMasterListInventory_requesting($inventoryType,$username,$branch,$description,$requestingDepartment,$requestNo,$inventoryLocation) {


echo "
<style type='text/css'>
.data{
font-size:14px;
}

a { text-decoration:none; color:black; }

tr:hover{ background-color:yellow; color:black; }

</style>

";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));
if($branch == "All") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from inventory where inventoryType = '$inventoryType' and inventoryLocation='$inventoryLocation' and description like '$description%%%%%%' and quantity > 0 and status not like 'DELETED_%%%%%%' order by description asc  ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from inventory where inventoryType = '$inventoryType' and inventoryLocation='$inventoryLocation' and description like '$description%%%%%%%' and quantity > 0 and status not like 'DELETED_%%%%%%' order by description asc  ");
}
echo "<center><table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;<font class='data'>Inventory Code</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Description</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Generic</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Unit Cost</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>QTY</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Expiration</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Added By</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Date Added</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Time Added</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Inventory Location</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Inventory Type</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Branch</font>&nbsp;</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;<font class='data'>".$row['inventoryCode']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/availableMedicine/medicineRequest2.php?description=$row[description]&requestTo_department=$inventoryLocation&branch=$branch&requestingDepartment=$requestingDepartment&inventoryCode=$row[inventoryCode]&stockCardNo=$row[stockCardNo]&username=$username&requestNo=$requestNo'>".$row['description']."</a></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['genericName']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['unitcost']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['quantity']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['expiration']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['addedBy']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['dateAdded']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['timeAdded']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['inventoryLocation']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['inventoryType']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['branch']."</font>&nbsp;</td>";
//echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/EDIT/editInventory.php?inventoryCode=$row[inventoryCode]&description=$row[description]&genericName=$row[genericName]&unitcost=$row[unitcost]&quantity=$row[quantity]&expiration=$row[expiration]&addedBy=$row[addedBy]&dateAdded=$row[dateAdded]&timeAdded=$row[timeAdded]&inventoryLocation=$row[inventoryLocation]&inventoryType=$row[inventoryType]&branch=$row[branch]&username=$username'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>&nbsp;</td>";
echo "</tr>";
  }
echo "</table>";


}


public $request;


//No. of request
public function request() {
return $this->request;
}


public function getRequest($requestTo_department,$requestTo_branch,$requestingDepartment,$requestingBranch) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(verificationNo) as request FROM inventoryManager WHERE requestTo_department = '$requestTo_department' and requestingDepartment='$requestingDepartment' and status='requesting' group by requestingUser,requestingDepartment  ");

while($row = mysqli_fetch_array($result))
  {
return $row['request'];
  }

}


public function getRequest_verificationNo($requestTo_department,$requestTo_branch) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT verificationNo FROM inventoryManager WHERE requestTo_department = '$requestTo_department' and requestTo_branch = '$requestTo_branch'  ");

while($row = mysqli_fetch_array($result))
  {
return $row['verificationNo'];
  }

}



public function getReceivingRequest($requestingDepartment,$requestingBranch) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(verificationNo) as verificationNo FROM inventoryManager WHERE requestingDepartment = '$requestingDepartment' and requestingBranch = '$requestingBranch' and status = 'forReceiving'  ");

while($row = mysqli_fetch_array($result))
  {
return $row['verificationNo'];
  }

}



//check kung mei laboratory result n?
public function checkIfLabResultExist($itemNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT itemNo from core2_laboratoryResultChecker where itemNo='$itemNo' and status not like 'DELETED_%%%%%%%%'  ");

while($row = mysqli_fetch_array($result))
  {
return mysqli_num_rows($result);
  }

}


//check kung mei radiology result n?
public function checkIfRadResultExist($itemNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT fileNo from uploadedFiles where itemNo='$itemNo' ");

while($row = mysqli_fetch_array($result))
  {
return mysqli_num_rows($result);
  }

}

public function checkDicom($itemNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT itemNo from uploadedFiles where itemNo='$itemNo' ");

while($row = mysqli_fetch_array($result))
  {
return mysqli_num_rows($result);
  }

}


//check kung mei S.O.A.P n?
public function checkIfSoapExist($itemNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT itemNo from SOAP where itemNo='$itemNo'  ");

while($row = mysqli_fetch_array($result))
  {
return mysqli_num_rows($result);
  }

}



public function checkIfPackageExist($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT itemNo from patientCharges where title='PACKAGE' and registrationNo='$registrationNo'  ");

while($row = mysqli_fetch_array($result))
  {
return mysqli_num_rows($result);
  }

}

public $getPackageNow_cash;
public $getPackageNow_phic;
public $getPackageNow_company;
public $getPackageNo_total;
public $getPackageNow_desc;

public function getPackageNow_cash() {
return $this->getPackageNow_cash;
}
public function getPackageNow_phic() {
return $this->getPackageNow_phic;
}
public function getPackageNow_company() {
return $this->getPackageNow_company;
}
public function getPackageNow_desc() {
return $this->getPackageNow_desc;
}
public function getPackageNow_total() {
return $this->getPackageNow_total;
}

public function getPackageNow($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT description,cashUnpaid,phic,company,total from patientCharges where title='PACKAGE' and registrationNo='$registrationNo'  ");

while($row = mysqli_fetch_array($result))
  {
$this->getPackageNow_cash = $row['cashUnpaid'];
$this->getPackageNow_phic = $row['phic'];
$this->getPackageNow_company = $row['company'];
$this->getPackageNow_desc = $row['description'];
$this->getPackageNow_total = $row['total'];
  }

}


public function sumPackageNow($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(charity) as totalPack from patientCharges where charity > 0 and registrationNo='$registrationNo'  ");

while($row = mysqli_fetch_array($result))
  {
return $row['totalPack'];
  }

}



public function showRequestList($requestingDepartment,$requestTo_department,$username,$checkz,$requestingUser) {

echo "<style type='text/css'>
#data:hover { background-color:yellow; color:black; }
a { text-decoration:none; color:black; }
.data {
font-size:13px;
}
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT description,quantity,requestingUser,dateRequested,timeRequested,requestingDepartment,requestingBranch,verificationNo,inventoryCode,stockCardNo FROM inventoryManager WHERE requestingDepartment like '$requestingDepartment%%%' and requestTo_department like '$requestTo_department%%%' and status='requesting' and requestingUser = '$requestingUser' order by verificationNo asc   ");


$this->coconutFormStart("get","http://".$this->getMyUrl()."/COCONUT/inventory/requestDisp.php");
echo "<br><center>";
echo "<table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;</th>";
echo "<th>&nbsp;</th>";
echo "<th>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Decription</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Quantity</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Time Requested</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Date Requested</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Requested By</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Request From</font>&nbsp;</th>";
echo "<th>&nbsp;</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
$this->coconutHidden("username",$username);
echo "<tr id='data'>";

if( $this->selectNow("inventory","quantity","inventoryCode",$row['inventoryCode']) >= $row['quantity'] ) {


if( $checkz == "no" ) {
echo "<td><input type='checkbox' name='inventoryCode[]' value='$row[inventoryCode]'></td>";
echo "<td><input type='checkbox' name='stockCardNo[]' value='$row[stockCardNo]'></td>";
echo "<td><input type='checkbox' name='verificationNo[]' value='$row[verificationNo]'></td>";
}else {
echo "<td><input type='checkbox' name='inventoryCode[]' value='$row[inventoryCode]' checked></td>";
echo "<td><input type='checkbox' name='stockCardNo[]' value='$row[stockCardNo]' checked></td>";
echo "<td><input type='checkbox' name='verificationNo[]' value='$row[verificationNo]' checked></td>";
}


}else {
//echo "<td><input type='checkbox' name='inventoryCode[]' value='$row[inventoryCode]' readonly></td>";
//echo "<td><input type='checkbox' name='verificationNo[]' value='$row[verificationNo]' readonly></td>";
echo "<tD><input type='hidden' name='inventoryCode' value=''></td>";
echo "<tD><input type='hidden' name='verificationNo' value=''></td>";
}

echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/availableMedicine/dispenseRequest.php?description=$row[description]&quantity=$row[quantity]&requestingDepartment=$row[requestingDepartment]&requestingBranch=$row[requestingBranch]&requestingUser=$row[requestingUser]&timeRequested=$row[timeRequested]&dateRequested=$row[dateRequested]&username=$username&verificationNo=$row[verificationNo]&inventoryCode=$row[inventoryCode]'><font class='data'>".$row['description']."</font></a>&nbsp;</td>";

if( $this->selectNow("inventory","quantity","inventoryCode",$row['inventoryCode']) >= $row['quantity'] ) {
echo "<td>&nbsp;<font class='data'>".$row['quantity']."</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font class='data'>".$row['quantity']."</font>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/availableMedicine/editRequesitionQTY.php?username=$username&requestingDepartment=$requestingDepartment&requestingBranch=$requestingBranch&requestTo_department=$requestTo_department&requestTo_branch=$requestTo_branch&quantity=".$this->selectNow("inventory","quantity","inventoryCode",$row['inventoryCode'])."&verificationNo=$row[verificationNo]'><font size=2 color=red>(".$this->selectNow("inventory","quantity","inventoryCode",$row['inventoryCode']).")</font></a></td>";
}

echo "<td>&nbsp;<font class='data'>".$row['timeRequested']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['dateRequested']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['requestingUser']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['requestingDepartment']." of ".$row['requestingBranch']."</font>&nbsp;</td>";
echo "<Td><a href='http://".$this->getMyUrl()."/COCONUT/requestition/delete.php?verificationNo=$row[verificationNo]&requestingDepartment=$requestingDepartment&requestTo_department=$requestTo_department&username=$username'>".$this->coconutImages_return("delete.jpeg")."</a></td>";
echo "</tr>";
  }
echo "</table>";
echo "<br>";
$this->coconutButton("Proceed");
$this->coconutFormStop();
}




public function showRequestList_onRequest($requestingDepartment,$requestingBranch,$requestTo_department,$requestTo_branch,$username,$checkz) {

echo "<style type='text/css'>
#data:hover { background-color:yellow; color:black; }
a { text-decoration:none; color:black; }
.data {
font-size:13px;
}
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT description,quantity,requestingUser,dateRequested,timeRequested,requestingDepartment,requestingBranch,verificationNo,inventoryCode FROM inventoryManager WHERE requestingDepartment like '$requestingDepartment%%%' and requestingBranch like '$requestingBranch%%%' and requestTo_department like '$requestTo_department%%%' and requestTo_branch like '$requestTo_branch%%%' and status='requesting' order by verificationNo asc   ");


$this->coconutFormStart("get","http://".$this->getMyUrl()."/COCONUT/inventory/requestDisp.php");
echo "<br><center>";
echo "<table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;</th>";
echo "<th>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Decription</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Quantity</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Time Requested</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Date Requested</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Requested By</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Request From</font>&nbsp;</th>";
echo "<th>&nbsp;</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
$this->coconutHidden("username",$username);
echo "<tr id='data'>";

if( $this->selectNow("inventory","quantity","inventoryCode",$row['inventoryCode']) >= $row['quantity'] ) {


if( $checkz == "no" ) {
echo "<td><input type='checkbox' name='inventoryCode[]' value='$row[inventoryCode]'></td>";
echo "<td><input type='checkbox' name='verificationNo[]' value='$row[verificationNo]'></td>";
}else {
echo "<td><input type='checkbox' name='inventoryCode[]' value='$row[inventoryCode]' checked></td>";
echo "<td><input type='checkbox' name='verificationNo[]' value='$row[verificationNo]' checked></td>";
}


}else {
//echo "<td><input type='checkbox' name='inventoryCode[]' value='$row[inventoryCode]' readonly></td>";
//echo "<td><input type='checkbox' name='verificationNo[]' value='$row[verificationNo]' readonly></td>";
echo "<tD><input type='hidden' name='inventoryCode' value=''></td>";
echo "<tD><input type='hidden' name='verificationNo' value=''></td>";
}

echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/availableMedicine/dispenseRequest.php?description=$row[description]&quantity=$row[quantity]&requestingDepartment=$row[requestingDepartment]&requestingBranch=$row[requestingBranch]&requestingUser=$row[requestingUser]&timeRequested=$row[timeRequested]&dateRequested=$row[dateRequested]&username=$username&verificationNo=$row[verificationNo]&inventoryCode=$row[inventoryCode]'><font class='data'>".$row['description']."</font></a>&nbsp;</td>";

if( $this->selectNow("inventory","quantity","inventoryCode",$row['inventoryCode']) >= $row['quantity'] ) {
echo "<td>&nbsp;<font class='data'>".$row['quantity']."</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font class='data'>".$row['quantity']."</font>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/availableMedicine/editRequesitionQTY.php?username=$username&requestingDepartment=$requestingDepartment&requestingBranch=$requestingBranch&requestTo_department=$requestTo_department&requestTo_branch=$requestTo_branch&quantity=".$this->selectNow("inventory","quantity","inventoryCode",$row['inventoryCode'])."&verificationNo=$row[verificationNo]'><font size=2 color=red>(".$this->selectNow("inventory","quantity","inventoryCode",$row['inventoryCode']).")</font></a></td>";
}

echo "<td>&nbsp;<font class='data'>".$row['timeRequested']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['dateRequested']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['requestingUser']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['requestingDepartment']." of ".$row['requestingBranch']."</font>&nbsp;</td>";
echo "<Td><a href='http://".$this->getMyUrl()."/COCONUT/requestition/delete.php?verificationNo=$row[verificationNo]&requestingDepartment=$requestingDepartment&requestingBranch=$requestingBranch&requestTo_department=$requestTo_department&requestTo_branch=$requestTo_branch&username=$username'>".$this->coconutImages_return("delete.jpeg")."</a></td>";
echo "</tr>";
  }
echo "</table>";
echo "<br>";

$this->coconutFormStop();
}



public function getReceivingOfRequest($module,$branch,$username) {

echo "<style type='text/css'>

.data {
font-size:13px;
}

#row:hover {
background-color:yellow; color:black;
}

a { text-decoration:none; color:black; }

</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from inventoryManager where requestingDepartment like '%$module%' and requestingBranch like '%$branch%' and status = 'forReceiving' ");

echo "<center>";
echo "<table border= cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;<font class='data'>Description</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Requested QTY</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Issued QTY</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Issued By</font>&nbsp;</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr id='row'>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/availableMedicine/receivingRequestDetails.php?description=$row[description]&requestedQTY=$row[quantity]&issuedQTY=$row[quantityIssued]&requestTo_department=$row[requestTo_department]&requestTo_branch=$row[requestTo_branch]&issuedBy=$row[issuedBy]&requestingUser=$row[requestingUser]&requestingDepartment=$row[requestingDepartment]&requestingBranch=$row[requestingBranch]&timeRequested=$row[timeRequested]&dateRequested=$row[dateRequested]&dateIssued=$row[dateIssued]&timeIssued=$row[timeIssued]&verificationNo=$row[verificationNo]&inventoryCode=$row[inventoryCode]&username=$username'><font class='data'>".$row['description']."</font></a>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['quantity']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['quantityIssued']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['requestTo_department']." of ".$row['requestTo_branch']." by ".$row['issuedBy']."</font>&nbsp;</td>";
echo "</tr>";
  }

}



public function getInventoryUsages($month,$day,$year,$module,$username,$branch,$fromTime_hour,$fromTime_minutes,$toTime_hour,$toTime_minutes) {


echo "
<style type='text/css'>
.data{
font-size:12px;
}

tr:hover{ background-color:yellow; color:black; }

</style>

";


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

$myDate = $year."-".$month."-".$day;
$fromTime = $fromTime_hour.":".$fromTime_minutes.":00";
$toTime = $toTime_hour.":".$toTime_minutes.":00";

((bool)mysqli_query( $con, "USE " . $this->database));
$date = date("M_d_Y");
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT *,pr.completeName from inventory i,patientCharges pc,registrationDetails rd,patientRecord pr where i.inventoryLocation='$module' and pc.branch='$branch' and i.inventoryCode = pc.chargesCode and pc.registrationNo = rd.registrationNo and rd.patientNo = pr.patientNo and (pc.title = 'MEDICINE' or pc.title='SUPPLIES') and pc.departmentStatus like 'dispensedBy%%%%%' and (pc.departmentStatus_time between '$fromTime' and '$toTime') and pc.dateCharge = '$myDate' order by pc.departmentStatus_time asc  ");

echo "<center><table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;<font class='data'>Name</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Description</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Generic</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Date</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>QTY</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Charge By</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Dispensed By</font>&nbsp;</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
$deptStatus = preg_split ("/\_/", $row['departmentStatus']); 
echo "<tr>";
echo "<td>&nbsp;<font class='data'> ".$row['registrationNo']." -".$row['completeName']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['description']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['genericName']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['dateCharge']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['quantity']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['chargeBy']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$deptStatus['1']." @ ".$row['departmentStatus_time']."</font>&nbsp;</td>";
/*
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/EDIT/editInventory.php?inventoryCode=$row[inventoryCode]&description=$row[description]&genericName=$row[genericName]&unitcost=$row[unitcost]&quantity=$row[quantity]&expiration=$row[expiration]&addedBy=$row[addedBy]&dateAdded=$row[dateAdded]&timeAdded=$row[timeAdded]&inventoryLocation=$row[inventoryLocation]&inventoryType=$row[inventoryType]&branch=$row[branch]&username=$username&transition=$row[transition]&remarks=$row[remarks]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/DELETE/deleteInventory.php?inventoryCode=$row[inventoryCode]&username=$username&description=$row[description]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>&nbsp;</td>";
*/
echo "</tr>";
  }
echo "</table>";


}


public $dateReceived;
public $dateReleased;
public $itemNo;
public $labNo;
public $pathologist;
public $medTech;
public $resultBranch;
public $remarks;


public function getDateReceived() {
return $this->dateReceived;
}

public function getDateReleased() {
return $this->dateReleased;
}

public function getItemNo() {
return $this->itemNo;
}

public function getLabNo() {
return $this->labNo;
}

public function getPathologist()  {
return $this->pathologist;
}

public function getMedTech() {
return $this->medTech;
}

public function getResultBranch() {
return $this->resultBranch;
}

public function getResultRemarks() {
return $this->remarks;
}



public $labResult_remarks;
public $labResult_dateReceived;
public $labResult_dateReleased;

public $labResult_labNo;
public $labResult_registrationNo;
public $labResult_itemNo;
public $labResult_description;
public $labResult_pathologist;
public $labResult_medTech;
public $labResult_receivedMonth;
public $labResult_receivedDay;
public $labResult_receivedYear;
public $labResult_releasedMonth;
public $labResult_releasedDay;
public $labResult_releasedYear;
public $labResult_branch;

public function getValueForEdit($labNo) {

echo "
<style type='text/css'>

#data:hover { background-color:yellow; color:black; }

a { text-decoration:none; color:red; }

.examName {
	border: 1px solid #000;
	color: #000;
	height: 30px;
	width: 200px;
	padding:4px 4px 4px 5px;
}

.examResult {
	border: 1px solid #000;
	color: #000;
	height: 30px;
	width: 100px;
	padding:4px 4px 4px 5px;
}

.txtArea {
	border: 1px solid #000;
	color: #000;
	height: 120px;
	width: 550px;
	padding:4px 4px 4px 5px;
}

</style>

";

echo "<link rel='stylesheet' type='text/css' href='http://".$this->getMyUrl()."/COCONUT/myCSS/coconutCSS.css' />";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT lrv.*,lr.*,pc.description from laboratoryResultsValue lrv,laboratoryResults lr,patientCharges pc where lrv.labNo = lr.labNo and lr.labNo='$labNo' and pc.itemNo = lr.itemNo  ");
echo "<form method='get' action='editResultRemarks.php'>";
echo "<center><br><div style='border:1px solid #000000; width:650px; height:auto; border-color:black black black black;'>";
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<th></th>";
echo "<th></th>";
echo "<th>Examination Name</th>";
echo "<th>Result</th>";
echo "<th>Flag</th>";
echo "<th>Normal Values</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr id='data'>";
$this->labResult_remarks = $row['remarks'];
$dateReceived = preg_split ("/\_/", $row['dateReceived']); 
$dateReleased = preg_split ("/\_/", $row['dateReleased']); 
$this->labResult_dateReceived = preg_split ("/\_/", $row['dateReceived']);
$this->labResult_dateReleased = preg_split ("/\_/", $row['dateReleased']);


$this->labResult_labNo = $row['labNo'];
$this->labResult_registrationNo = $row['registrationNo'];
$this->labResult_itemNo = $row['itemNo'];
$this->labResult_description = $row['description'];
$this->labResult_pathologist = $row['pathologist'];
$this->labResult_medTech = $row['medTech'];
$this->labResult_branch = $row['Branch'];

echo "<input type=hidden name='labNo' value='".$row['labNo']."' checked>";
echo "<td><center><a href='http://".$this->getMyUrl()."/COCONUT/Results/deleteSingleValues.php?valuesNo=$row[valuesNo]&labNo=$row[labNo]&registrationNo=$row[registrationNo]&itemNo=$row[itemNo]&description=$row[description]&pathologist=$row[pathologist]&medTech=$row[medTech]&receivedMonth=$dateReceived[0]&receivedDay=$dateReceived[1]&receivedYear=$dateReceived[2]&releasedMonth=$dateReleased[0]&releasedDay=$dateReleased[1]&releasedYear=$dateReleased[2]&branch=$row[Branch]'>
<img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg' />
</a></center></td>";
echo "<td><center><a href='http://".$this->getMyUrl()."/COCONUT/Results/singleValues.php?valuesNo=$row[valuesNo]&examName=$row[examName]&examResult=$row[examResult]&flag=$row[examFlag]&examValues=$row[examValue]&labNo=$row[labNo]&registrationNo=$row[registrationNo]&itemNo=$row[itemNo]&description=$row[description]&pathologist=$row[pathologist]&medTech=$row[medTech]&receivedMonth=$dateReceived[0]&receivedDay=$dateReceived[1]&receivedYear=$dateReceived[2]&releasedMonth=$dateReleased[0]&releasedDay=$dateReleased[1]&releasedYear=$dateReleased[2]&branch=$row[Branch]'>
<img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg' />
</a></center></td>";
echo "<td><input type=text class='examName' value='".$row['examName']."' readonly></td>";
echo "<td><input type=text class='examResult' value='".$row['examResult']."' readonly></td>";
echo "<td><select class='comboBoxShort'>";
echo "<option value='".$row['examFlag']."'>".$row['examFlag']."</option>";
echo "</select></td>";
echo "<td><input type=text class='examName' value='".$row['examValue']."' readonly></td>";
echo "</tr>";  
}
echo "</table>";
echo "<a href='http://".$this->getMyUrl()."/COCONUT/Results/singleValues_new.php?labNo=".$this->labResult_labNo."&registrationNo=".$this->labResult_registrationNo."&itemNo=".$this->labResult_itemNo."&description=".$this->labResult_description."&pathologist=".$this->labResult_pathologist."&medTech=".$this->labResult_medTech."&receivedMonth=".$this->labResult_dateReceived[0]."&receivedDay=".$this->labResult_dateReceived[1]."&receivedYear=".$this->labResult_dateReceived[2]."&releasedMonth=".$this->labResult_dateReleased[0]."&releasedDay=".$this->labResult_dateReleased[1]."&releasedYear=".$this->labResult_dateReleased[2]."&branch=".$this->labResult_branch."'>Add Another Examination Name</a>";

echo "<br><br>";
echo "<font size=2>Comments/Remarks</font><br>";
echo "<textarea class='txtArea' name='remarks'>".$this->labResult_remarks."</textarea>";
echo "<br><br><input type=submit value='Proceed'>";
echo "</div>";
}




public $flagSwitch; //switch pra sa legends ng flag

//ippkta ung list ng laboratory result ng px
public function getExamResults_result($registrationNo,$labNo,$username,$description) {

echo "
<style type='text/css'>
.data{
font-size:12px;
}

#row:hover{ background-color:yellow; color:black; }

a { text-decoration:none; color:black; }

.fieldz {

	border: 1px solid #fff;
	color: #000;
	height: 20px;
	width: 320px;
	padding:4px 4px 4px 5px;
	font-size:9px;

}

.fieldzPatientz {

	border: 1px solid #fff;
	color: #000;
	height: 20px;
	width: 320px;
	padding:4px 4px 4px 5px;
	font-size:12px;

}

.shortFieldz {

	border: 1px solid #fff;
	color: #000;
	height: 20px;
	width: 40px;
	padding:4px 4px 4px 5px;
	font-size:12px;

}

</style>

";

echo "<link rel='stylesheet' type='text/css' href='http://".$this->getMyUrl()."/COCONUT/myCSS/coconutCSS.css' />";
$this->getMyResults($labNo,$username);
$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><div style='border:1px solid #000000; width:500px; height:auto; border-color:black black black black;'>";
echo "<Center><font size=2><b>".$this->getReportInformation("hmoSOA_name").".<br><font size=2>(".$this->getResultBranch()." Branch)</font><br>&nbsp;".$this->getReportInformation("hmoSOA_address")."</b></font>";
$this->getPatientProfile($registrationNo);
echo "";
echo "<center><br>
<table border=0 cellpadding=0 cellspacing=0>
<tr>
<td><font class='labelz'>Lab#</font></td>
<td><input type=text class='shortFieldz' value='$labNo'</td>
<td><font class='labelz'>Item#</font></td>
<td><input type=text class='shortFieldz' value='".$this->getItemNo()."'</td>
<td><font class='labelz'>Registration#</font></td>
<td><input type=text class='shortFieldz' value='".$registrationNo."'</td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0>
<tr>
<td><font class='labelz'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Patient</font></td>
<td><input type=text class='fieldzPatientz' value='".$this->getPatientRecord_completeName()."'</td>
</tr>
<tr>
<td><font class='labelz'>Date Received</font></td>
<td><input type=text class='fieldz' value='".$this->getDateReceived()."'</td>
</tr>
<tr>
<td><font class='labelz'>Date Released</font></td>
<td><input type=text class='fieldz' value='".$this->getDateReleased()."'</td>
</tr>
</table><br>
<b>$description</b>
<br><table border=1 rules=all cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;<font size=2>Exam Name</font>&nbsp;</th>";
echo "<th>&nbsp;<font size=2>Result</font>&nbsp;</th>";
echo "<th>&nbsp;<font size=2>Flag</font>&nbsp;</th>";
echo "<th>&nbsp;<font size=2>Normal Values</font>&nbsp;</th>";

echo "</tr>";
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from laboratoryResultsValue where labNo='$labNo'  ");

while($row = mysqli_fetch_array($result))
  {

//switch pra mLaman kung keLan iLLbas ung Legends ng Flag
if($row['examFlag'] != "") {
$this->flagSwitch="on";
}else {
$this->flagSwitch="off";
}

echo "<tr id='row'>";
echo "<td>&nbsp;<font size=2>".$row['examName']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".$row['examResult']."</font>&nbsp;</td>";
if($row['examFlag'] != "") {
echo "<td>&nbsp;<font size=2><b>(".$row['examFlag'].")</b></font>&nbsp;</td>";
}else {
echo "<td>&nbsp;</td>";
}
echo "<td>&nbsp;<font size=2>".$row['examValue']."</font>&nbsp;</td>";
echo "</tr>";
  }
echo "</table>";
echo "<br><br>"; 

if($this->getResultRemarks() != "") {
echo "<font size=1>Comments/Remarks</font>";
echo "<div style='border:1px solid #000000; width:410px; padding:2px 2px 20px 2px; height:auto; border-color:black black black black;'>";
echo "<br><font size=2>".$this->getResultRemarks()."</font>";

echo "</div>";
echo "<br><br>";
}else {
echo "";
}
if($this->flagSwitch == "on") {
echo "<div style='border:1px solid #000000; width:410px; height:25px; border-color:black black black black;'>";
echo "<font size=1><b>c* = Comment</b></font>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=1><b>C = Critical</b></font>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=1><b>L = Low</b></font>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=1><b>H = High</b></font>";
echo "</div>";
}else {
echo "";
}
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td><u>&nbsp;&nbsp;&nbsp;&nbsp;<font size=2>".$this->getPathologist()."</font>&nbsp;&nbsp;&nbsp;&nbsp;</u><br><font size=2>Pathologist</font></td>";
echo "<td>&nbsp;&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<td><u>&nbsp;&nbsp;&nbsp;&nbsp;<font size=2>".$this->getMedTech()."</font>&nbsp;&nbsp;&nbsp;&nbsp;</u><br><font size=2>Medical Technician</font></td>";
echo "</tr>";
echo "</table>";
echo "</div>";
}



public function getExamResults($title,$registrationNo,$username) {

echo "
<style type='text/css'>
.data{
font-size:12px;
color:white;
}

tr:hover{ background-color:yellow; color:black; }

a { text-decoration:none; color:black; }

</style>

";



$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.description,lr.labNo,lr.pathologist,lr.dateReceived,lr.dateReleased,lr.medTech,lr.Branch,lr.itemNo from laboratoryResults lr,patientCharges pc where pc.registrationNo = '$registrationNo' and pc.itemNo = lr.itemNo and pc.title='$title'  ");

echo "<center><table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "</tr>";

if($username != "") {
echo "<th bgcolor='#3b5998'>&nbsp;<font class='data'></font></th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font class='data'></font></th>";
}else {

}
echo "<th bgcolor='#3b5998'>&nbsp;<font class='data'>&nbsp;</font></th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font class='data'>&nbsp;Lab#&nbsp;</font></th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font class='data'>&nbsp;Description&nbsp;</font></th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font class='data'>&nbsp;Pathologist&nbsp;</font></th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font class='data'>&nbsp;Med Tech&nbsp;</font></th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font class='data'>&nbsp;Date Received&nbsp;</font></th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font class='data'>&nbsp;Date Released&nbsp;</font></th>";
echo "</th>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td><a href='http://".$this->getMyUrl()."/COCONUT/Results/laboratoryResult.php?registrationNo=$registrationNo&username=$username&labNo=$row[labNo]&pathologist=$row[pathologist]&medTech=$row[medTech]&dateReceived=$row[dateReceived]&dateReleased=$row[dateReleased]&description=$row[description]'>&nbsp;<font color='red' size='3'>View</font>&nbsp;</a></td>";
if($username != "") {
echo "<td><center><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/verifyDeleteResults.php?description=$row[description]&labNo=$row[labNo]'>
<img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg' />
</a></center></td>";


echo "<td><center><a href='http://".$this->getMyUrl()."/COCONUT/Results/editResult.php?labNo=$row[labNo]&description=$row[description]&pathologist=$row[pathologist]&medTech=$row[medTech]&dateReceived=$row[dateReceived]&dateReleased=$row[dateReleased]&branch=$row[Branch]&registrationNo=$registrationNo&username=$username&itemNo=$row[itemNo]'>
<img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg' />
</a></center></td>";
}else {

}

echo "<td>&nbsp;<font size=2>".$row['labNo']."</font>&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Results/laboratoryResult.php?registrationNo=$registrationNo&username=$username&labNo=$row[labNo]&pathologist=$row[pathologist]&medTech=$row[medTech]&dateReceived=$row[dateReceived]&dateReleased=$row[dateReleased]&description=$row[description]'><font size=2>".$row['description']."</font></a>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".$row['pathologist']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".$row['medTech']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".$row['dateReceived']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".$row['dateReleased']."</font>&nbsp;</td>";
echo "</tr>";
  }

}


public function insert_laboratoryResult($labNo,$itemNo,$registrationNo,$dateReceived,$dateReleased,$pathologist,$medTech,$remarks,$branch) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO laboratoryResults (labNo,itemNo,registrationNo,dateReceived,dateReleased,pathologist,medTech,remarks,branch)
VALUES
('$labNo','$itemNo','$registrationNo','$dateReceived','$dateReleased','$pathologist','$medTech','$remarks','$branch')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }
/*
echo "<script type='text/javascript' >";
echo "alert('$service was Successfully Added to the List of Service in $category');";
echo  "window.location='http://".$this->getMyUrl()."/Maintenance/addService.php '";
echo "</script>";
*/
((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function insert_laboratoryResultValue($labNo,$examName,$examResult,$examFlag,$examValue,$remarks) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO laboratoryResultsValue (labNo,examName,examResult,examFlag,examValue,remarks)
VALUES
('$labNo','$examName','$examResult','$examFlag','$examValue','$remarks')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }
/*
echo "<script type='text/javascript' >";
echo "alert('$service was Successfully Added to the List of Service in $category');";
echo  "window.location='http://".$this->getMyUrl()."/Maintenance/addService.php '";
echo "</script>";
*/
((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function insert_soap($itemNo,$registrationNo,$subjective,$objective,$assessment,$plan) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO SOAP (itemNo,registrationNo,subjective,objective,assessment,plan)
VALUES
('$itemNo','$registrationNo','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $subjective) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $objective) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $assessment) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $plan) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }
/*
echo "<script type='text/javascript' >";
echo "alert('$service was Successfully Added to the List of Service in $category');";
echo  "window.location='http://".$this->getMyUrl()."/Maintenance/addService.php '";
echo "</script>";
*/
((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


public function insert_ptNotes($patientNo,$registrationNo,$subjective,$objective,$assessment,$plan,$date,$time,$username) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO ptNotes (patientNo,registrationNo,subjective,objective,assessment,plan,date,time,username)
VALUES
('$patientNo','$registrationNo','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $subjective) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $objective) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $assessment) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $plan) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','$date','$time','$username')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }
/*
echo "<script type='text/javascript' >";
echo "alert('$service was Successfully Added to the List of Service in $category');";
echo  "window.location='http://".$this->getMyUrl()."/Maintenance/addService.php '";
echo "</script>";
*/
((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


public function addFloor($floor,$branch,$username) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO floor (description,branch)
VALUES
('$floor','$branch')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

echo "<script type='text/javascript' >";
echo "alert('$floor was successfully added in $branch branch');";
echo  "window.location='http://".$this->getMyUrl()."/COCONUT/floor/addFloor.php?username=$username '";
echo "</script>";

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}

public function radioResult_insert($itemNo,$registrationNo,$radiologist,$medTech,$dateReceived,$dateReleased,$impression,$branch) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO radiologyResults (itemNo,registrationNo,radiologist,medTech,dateReceived,dateReleased,impression,branch)
VALUES
('$itemNo','$registrationNo','$radiologist','$medTech','$dateReceived','$dateReleased','$impression','$branch')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }
/*
echo "<script type='text/javascript' >";
echo "alert('$service was Successfully Added to the List of Service in $category');";
echo  "window.location='http://".$this->getMyUrl()."/Maintenance/addService.php '";
echo "</script>";
*/
((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


public $radResult_radioNo;
public $radResult_itemNo;
public $radResult_registrationNo;
public $radResult_radiologist;
public $radResult_medTech;
public $radResult_dateReceived;
public $radResult_dateReleased;
public $radResult_impression;
public $radResult_branch;

public function radResult_radioNo() {
return $this->radResult_radioNo;
}
public function radResult_itemNo() {
return $this->radResult_itemNo;
}
public function radResult_registrationNo() {
return $this->radResult_registrationNo;
}
public function radResult_radiologist() {
return $this->radResult_radiologist;
}
public function radResult_medTech() {
return $this->radResult_medTech;
}
public function radResult_dateReceived() {
return $this->radResult_dateReceived;
}
public function radResult_dateReleased() {
return $this->radResult_dateReleased;
}
public function radResult_impression() {
return $this->radResult_impression;
}
public function radResult_branch() {
return $this->radResult_branch;
}

//kkuhain ung radio result
public function getRadioResult($itemNo,$registrationNo){

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from radiologyResults where itemNo = '$itemNo' and registrationNo='$registrationNo'  ");

while($row = mysqli_fetch_array($result))
  {
$this->radResult_radioNo = $row['radioNo'];
$this->radResult_itemNo = $row['itemNo'];
$this->radResult_registrationNo = $row['registrationNo'];
$this->radResult_radiologist = $row['radiologist'];
$this->radResult_medTech = $row['medTech'];
$this->radResult_dateReceived = $row['dateReceived'];
$this->radResult_dateReleased = $row['dateReleased'];
$this->radResult_impression = $row['impression'];
$this->radResult_branch = $row['branch'];
 
  }

}



public function showRadioResult_listed($registrationNo,$username) {

echo "
<style type='text/css'>
.data{
font-size:12px;
color:white;
}

tr:hover{ background-color:yellow; color:black; }

a { text-decoration:none; color:black; }

</style>

";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT rsr.*,pc.*,rd.* from radioSavedReport rsr,patientCharges pc,registrationDetails rd where rd.registrationNo = pc.registrationNo and pc.itemNo = rsr.itemNo and pc.registrationNo='$registrationNo'  ");

echo "<center><table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";

if($username != "") {
echo "<th bgcolor='#3b5998'>&nbsp;<font class='data'></font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font class='data'></font>&nbsp;</th>";
}else {

}

echo "<th bgcolor='#3b5998'>&nbsp;<font class='data'>Radio#</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font class='data'>Description</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font class='data'>Radiologist</font>&nbsp;</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td><a href='http://".$this->getMyUrl()."/COCONUT/Reports/radiologyReport/radioReport_output.php?itemNo=$row[itemNo]&registrationNo=$row[registrationNo]&description=$row[description]'>&nbsp;<font size=3 color=red>View</font>&nbsp;</a></td>";
if($username != "") {


echo "<td><center><a href='http://".$this->getMyUrl()."/COCONUT/Reports/radiologyReport/radioReportSettings_edit.php?registrationNo=$registrationNo&itemNo=$row[itemNo]&description=$row[description]&branch=$row[branch]&username=$username'>
<img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg' />
</a></center></td>";
}else {

}


 echo "<td>&nbsp;<font size=2>".$row['radioSavedNo']."</font>&nbsp;</td>";
 echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Results/Radiology/resultReport.php?itemNo=$row[itemNo]&registrationNo=$row[registrationNo]&description=$row[description]'><font size=2>".$row['description']."</font></a>&nbsp;</td>";
 echo "<td>&nbsp;<font size=2>".$row['physician']."</font>&nbsp;</td>";
echo "</tr>";
  }
echo "</table>";

}

public $totalPat;

public function totalPat() {
return $this->totalPat;
}

public function getDoctorPatient($doctor,$month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,$branch,$type) {

echo "<style type='text/css'>
#data:hover { background-color:yellow; color:black; }
.data{
font-size:14px;
color:white;
}
a { text-decoration:none; color:black; }

</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

$fromTime = $fromTime_hour.":".$fromTime_minutes.":".$fromTime_seconds;
$toTime = $toTime_hour.":".$toTime_minutes.":".$toTime_seconds;

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.itemNo,rd.registrationNo,pc.service,upper(pr.lastName) as lastName,upper(pr.firstName) as firstName from registrationDetails rd,patientCharges pc,patientRecord pr where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type='$type' and pc.description = '$doctor' and (pc.timeCharge between '$fromTime' and '$toTime' ) and pc.dateCharge like '$month%$day%$year' and pc.departmentStatus not like 'doneBy%%%%%' order by lastName asc   ");

echo "<center><font size=2>$doctor</font><div style='border:1px solid #000000; width:500px; height:auto; border-color:black black black black;'>";
echo "<br>";
echo "<table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo "<th bgcolor='#3b5998'><font class='data'>Patient</font></th>";
echo "<th bgcolor='#3b5998'><font class='data'>Service</font></th>";
echo "<th bgcolor='#3b5998'><font class='data'></font></th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr id='data'>";
$this->totalPat++;
//echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/currentPatient/patientInterface1.php?username=$username&registrationNo=$row[registrationNo]' target='_blank'><font size=2>".$row['lastName'].", ".$row['firstName']."</font></a>&nbsp;</td>";
echo "<td><form method='post' action='/COCONUT/currentPatient/patientInterface1.php' target='_blank'><input type='submit' value='".$row['lastName'].", ".$row['firstName']."'> <input type='hidden' name='registrationNo' value='$row[registrationNo]'> <input type='hidden' name='username' value='$username'> </form></td>";
echo "<td>&nbsp;<font size=2>".$row['service']."</font>&nbsp;</td>";
echo "<td><a href='http://".$this->getMyUrl()."/COCONUT/Doctor/donePatient.php?itemNo=$row[itemNo]&doctor=$doctor&month=$month&day=$day&year=$year&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&username=$username&branch=$branch'>&nbsp;<img src='http://".$this->getMyUrl()."/COCONUT/myImages/check.jpeg'>&nbsp;</a></td>";
echo "</tr>";
  }
echo "</table>";
echo "<font size=2>Patient: </font><font size=2 color=red>".$this->totalPat."</font>";
echo "<br><br>";
echo "</div>";
}


public function getDoctorPatient_ipd($doctorName,$type,$username) {

echo "
<style type='text/css'>
#rowz:hover {
background-color:yellow;
color:black;
}
.rowzData {
font-size:15px;
}
a {
text-decoration:none;
color:black;
}
</style>

";


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT rd.registrationNo,upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,rd.room,pc.service from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type='$type' and pc.description = '$doctorName' and rd.dateUnregistered = '' order by pr.lastName,pc.service asc ");

echo "<font size=2>$doctorName</font>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("Room");
$this->coconutTableHeader("Service");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
echo "<tR id='rowz'>";
//$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/currentPatient/patientInterface1.php?username=$username&registrationNo=$row[registrationNo]' target='_blank'><font class='rowzData'>".$row['lastName'].", ".$row['firstName']."</font></a>");

$this->coconutTableData("
 <form method='post' action='http://".$this->getMyUrl()."/COCONUT/currentPatient/patientInterface1.php' target='_blank'>
<input type='hidden' name='registrationNo' value='$row[registrationNo]'>
<input type='hidden' name='username' value='$username'>
<input style='border:1px solid #ff0000; height:50px; width:100%; color:red;' type='submit' value='".$row['lastName'].", ".$row['firstName']."'>
 </form> ");

$this->coconutTableData("<font class='rowzData'>".$row['room']."</font>");
$this->coconutTableData("<font class='rowzData'>".$row['service']."</font>");
echo "</tr>";
  }

$this->coconutTableStop();

}




public function getDoctorPatient_ipdCensus($doctorName,$type,$username) {

echo "
<style type='text/css'>
#rowz:hover {
background-color:yellow;
color:black;
}
.rowzData {
font-size:15px;
}
a {
text-decoration:none;
color:black;
}
</style>

";


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT rd.registrationNo,upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,rd.room,rd.Company,pc.service from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type='$type' and pc.description = '$doctorName' and rd.dateUnregistered = '' order by pr.lastName,pc.service asc ");

echo "<font size=2>$doctorName</font>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("Room");
$this->coconutTableHeader("Service");
$this->coconutTableHeader("Insurance");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
echo "<tR id='rowz'>";
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/currentPatient/patientInterface1.php?username=$username&registrationNo=$row[registrationNo]' target='_blank'><font class='rowzData'>".$row['lastName'].", ".$row['firstName']."</font></a>");
$this->coconutTableData("<font class='rowzData'>".$row['room']."</font>");
$this->coconutTableData("<font class='rowzData'>".$row['service']."</font>");
$this->coconutTableData("<font class='rowzData'>".$row['Company']."</font>");
echo "</tr>";
  }

$this->coconutTableStop();

}


public $doctorDischargedReport_amount;
public $doctorDischargedReport_pf;

public function doctorDischargedReport($m,$d,$y,$m1,$d1,$y1,$doctorName,$type,$username) {

echo "
<style type='text/css'>
#rowz:hover {
background-color:yellow;
color:black;
}
.rowzData {
font-size:15px;
}
a {
text-decoration:none;
color:black;
}
</style>

";


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$fromDate = $m."_".$d."_".$y;
$toDate = $m1."_".$d1."_".$y1;

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT rd.registrationNo,upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,rd.room,pc.service,rd.dateUnregistered,pc.sellingPrice from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type='$type' and pc.description = '$doctorName' and (rd.dateUnregistered between '$fromDate' and '$toDate') order by pr.lastName,pc.service asc ");

echo "<Center>";
echo "<font size=2>$doctorName</font><br>";
echo "<font size=2>($m $d, $y - $m1 $d1, $y1)</font>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("Room");
$this->coconutTableHeader("Service");
$this->coconutTableHeader("Total Amount/PF");
$this->coconutTableHeader("Discharged");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$price = preg_split ("/\//", $row['sellingPrice']); 
$this->doctorDischargedReport_amount += $price[0];
$this->doctorDischargedReport_pf += $price[1];
echo "<tR id='rowz'>";
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/currentPatient/patientInterface1.php?username=$username&registrationNo=$row[registrationNo]' target='_blank'><font class='rowzData'>".$row['lastName'].", ".$row['firstName']."</font></a>");
$this->coconutTableData("<font class='rowzData'>".$row['room']."</font>");
$this->coconutTableData("<font class='rowzData'>".$row['service']."</font>");
$this->coconutTableData("<font class='rowzData'>".$row['sellingPrice']."</font>");
$this->coconutTableData("<font class='rowzData'>".$row['dateUnregistered']."</font>");
echo "</tr>";
  }
echo "<tr>";
echo "<td><Center><b>TOTAL</b></center></td>";
echo "<td>&nbsp;</tD>";
echo "<Td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".number_format($this->doctorDischargedReport_amount,2)."</font> <font color=red>/</font> <font size=2>".number_format($this->doctorDischargedReport_pf,2)."</font>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
$this->coconutTableStop();

}



public $soap_soapNo;
public $soap_subjective;
public $soap_objective;
public $soap_assessment;
public $soap_plan;
public $soap_date;
public $soap_description;
public $soap_service;


public function soap_soapNo() {
return $this->soap_soapNo;
}

public function soap_subjective() {
return $this->soap_subjective;
}

public function soap_objective() {
return $this->soap_objective;
}

public function soap_assessment() {
return $this->soap_assessment;
}

public function soap_plan() {
return $this->soap_plan;
}

public function soap_date() {
return $this->soap_date;
}

public function soap_description() {
return $this->soap_description;
}

public function soap_service() {
return $this->soap_service;
}

public function getSOAP($itemNo,$registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT s.*,pc.* from SOAP s,patientCharges pc where s.itemNo = pc.itemNo and s.itemNo='$itemNo' and s.registrationNo = '$registrationNo'   ");

while($row = mysqli_fetch_array($result))
  {
$this->soap_description = $row['description'];
$this->soap_service = $row['service'];
$this->soap_date = $row['dateCharge'];
$this->soap_soapNo = $row['soapNo'];
$this->soap_subjective = $row['subjective'];
$this->soap_objective = $row['objective'];
$this->soap_assessment = $row['assessment'];
$this->soap_plan = $row['plan'];
 
  }

}



public function showSOAP_listed($registrationNo,$username) {

echo "
<style type='text/css'>
.data{
font-size:12px;
color:white;
}

tr:hover{ background-color:yellow; color:black; }

a { text-decoration:none; color:black; }

</style>

";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT s.*,pc.*,rd.* from SOAP s,patientCharges pc,registrationDetails rd where rd.registrationNo = pc.registrationNo and pc.itemNo = s.itemNo and pc.registrationNo='$registrationNo'  ");

echo "<center><table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
if($username != "") {
echo "<th bgcolor='#3b5998'>&nbsp;<font class='data'></font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font class='data'></font>&nbsp;</th>";
}else {

}
echo "<th bgcolor='#3b5998'>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font class='data'>S.O.A.P#</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font class='data'>Description</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font class='data'>Doctor</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font class='data'>Date</font>&nbsp;</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td><a href='http://".$this->getMyUrl()."/COCONUT/Doctor/doctorModule/soapView.php?itemNo=$row[itemNo]&registrationNo=$row[registrationNo]&username=$username'>&nbsp;<font size='3' color='red'>View</font>&nbsp;</a></td>";
if($username != "") {
echo "<td><center><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/verifyDeleteSOAP.php?description=$row[description]&soapNo=$row[soapNo]'>
<img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg' />
</a></center></td>";


echo "<td><center><a href='http://".$this->getMyUrl()."/COCONUT/Doctor/doctorModule/soapView.php?registrationNo=$row[registrationNo]&itemNo=$row[itemNo]&username=$username'>
<img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg' />
</a></center></td>";
}else {

}


 echo "<td>&nbsp;<font size=2>".$row['soapNo']."</font>&nbsp;</td>";
 echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Doctor/doctorModule/soapView.php?itemNo=$row[itemNo]&registrationNo=$row[registrationNo]'><font size=2>".$row['service']."</font></a>&nbsp;</td>";
 echo "<td>&nbsp;<font size=2>".$row['description']."</font>&nbsp;</td>";
 echo "<td>&nbsp;<font size=2>".$row['dateCharge']."</font>&nbsp;</td>";

echo "</tr>";
  }
echo "</table>";

}


public $getDoctorPatientReport_cash_docPatient;
public $getDoctorPatientReport_cash_grandTotal;

public function getDoctorPatientReport_cash($chargesCode,$doctor,$date,$date1) {

echo "<style type='text/css'>


.dataz{
font-size:14px;
color:white;
}

#tableRow:hover { background-color:yellow; color:black; }

a { text-decoration:none; color:black; }

</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pr.lastName,pr.firstName,rd.registrationNo,pc.cashPaid from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.description = '$doctor' and (pc.datePaid between '$date' and '$date1') and pc.status = 'PAID' and rd.type='OPD'   ");

echo "<center><br><br><font size=3>Dr.$doctor</font><table border=1 cellpadding=0 cellspacing=0  rules=all>";
echo "<tr>";
echo "<th>&nbsp;<font size=4>No.</font>&nbsp;</th>";
echo "<th>&nbsp;<font size='4'>Patient</font>&nbsp;</th>";
echo "<th>&nbsp;<font size='4'>Cash</font>&nbsp;</th>";
echo "</tr>";
$this->getDoctorPatientReport_cash_docPatient = 1;
while($row = mysqli_fetch_array($result))
  {

$this->getDoctorPatientReport_cash_grandTotal += $row['cashPaid'];

echo "<tr id='tableRow'>";
echo "<td>&nbsp;".$this->getDoctorPatientReport_cash_docPatient++."&nbsp;</td>";
echo "<td>&nbsp;".$row['lastName'].", ".$row['firstName']."&nbsp;</td>";
echo "<td>&nbsp;".$row['cashPaid']."&nbsp;</td>";
echo "</tr>";
 
  }
echo "</tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;".number_format($this->getDoctorPatientReport_cash_grandTotal,2)."</td>";
echo "<tr>";
echo "</table>";
}



public $getDoctorPatientReport_company_docPatient;
public $getDoctorPatientReport_company_grandTotal;

public function getDoctorPatientReport_company($chargesCode,$doctor,$date,$date1) {

echo "<style type='text/css'>


.dataz{
font-size:14px;
color:white;
}

#tableRow:hover { background-color:yellow; color:black; }

a { text-decoration:none; color:black; }

</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pr.lastName,pr.firstName,rd.registrationNo,pc.company,rd.Company from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.description = '$doctor' and (pc.dateCharge between '$date' and '$date1') and pc.status = 'UNPAID' and rd.type='OPD' and pc.company != 0   ");

echo "<center><br><br><font size=3>Dr.$doctor</font><table border=1 cellpadding=0 cellspacing=0  rules=all>";
echo "<tr>";
echo "<th>&nbsp;<font size=4>No.</font>&nbsp;</th>";
echo "<th>&nbsp;<font size='4'>HMO</font>&nbsp;</th>";
echo "<th>&nbsp;<font size='4'>Patient</font>&nbsp;</th>";
echo "<th>&nbsp;<font size='4'>Amount</font>&nbsp;</th>";
echo "</tr>";
$this->getDoctorPatientReport_company_docPatient = 1;
while($row = mysqli_fetch_array($result))
  {

$this->getDoctorPatientReport_company_grandTotal += $row['company'];

echo "<tr id='tableRow'>";
echo "<td>&nbsp;".$this->getDoctorPatientReport_company_docPatient++."&nbsp;</td>";
echo "<td>&nbsp;".$row['Company']."&nbsp;</td>";
echo "<td>&nbsp;".$row['lastName'].", ".$row['firstName']."&nbsp;</td>";
echo "<td>&nbsp;".$row['company']."&nbsp;</td>";
echo "</tr>";
 
  }
echo "</tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;".number_format($this->getDoctorPatientReport_company_grandTotal,2)."</td>";
echo "<tr>";
echo "</table>";
}


public $getDoctorPFReport_pxCount_cash_pxCount;
public $getDoctorPFReport_pxCount_cash_totalAmount;

public function getDoctorPFReport_pxCount_cash_pxCount() {
return $this->getDoctorPFReport_pxCount_cash_pxCount;
}

public function getDoctorPFReport_pxCount_cash_totalAmount() {
return $this->getDoctorPFReport_pxCount_cash_totalAmount;
}

public function getDoctorPFReport_pxCount_cash($chargesCode,$date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select count(chargesCode) as totalPx,sum(pc.cashPaid) as totalAmount from registrationDetails rd,patientCharges pc where rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and pc.chargesCode = '$chargesCode' and status = 'PAID' and (pc.dateCharge between '$date' and '$date1') and pc.title = 'PROFESSIONAL FEE' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {
$this->getDoctorPFReport_pxCount_cash_pxCount = $row['totalPx'];
$this->getDoctorPFReport_pxCount_cash_totalAmount = $row['totalAmount'];
}

}


public $getDoctorPFReport_pxCount_company_pxCount;
public $getDoctorPFReport_pxCount_company_totalAmount;

public function getDoctorPFReport_pxCount_company_pxCount() {
return $this->getDoctorPFReport_pxCount_company_pxCount;
}

public function getDoctorPFReport_pxCount_company_totalAmount() {
return $this->getDoctorPFReport_pxCount_company_totalAmount;
}

public function getDoctorPFReport_pxCount_company($chargesCode,$date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select count(chargesCode) as totalPx,sum(pc.company) as totalAmount from registrationDetails rd,patientCharges pc where rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and pc.chargesCode = '$chargesCode' and status not like 'DELETED%%%%%' and pc.company > 0 and (pc.dateCharge between '$date' and '$date1') and pc.title = 'PROFESSIONAL FEE' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {
$this->getDoctorPFReport_pxCount_company_pxCount = $row['totalPx'];
$this->getDoctorPFReport_pxCount_company_totalAmount = $row['totalAmount'];
}

}




public function getDoctorPFReport($type,$username,$month,$day,$year,$month1,$day1,$year1,$show) {

echo "<style type='text/css'>


.dataz{
font-size:14px;
color:white;
}

#tableRow:hover { background-color:yellow; color:black; }

a { text-decoration:none; color:black; }

</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));
$date = $year."-".$month."-".$day;
$date1 = $year1."-".$month1."-".$day1;


$result = mysqli_query($GLOBALS["___mysqli_ston"], "select * from (SELECT pc.description,pc.chargesCode from registrationDetails rd,patientCharges pc where rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and (pc.datePaid between '$date' and '$date1') and pc.title='PROFESSIONAL FEE' and pc.status not like 'DELETED%%%%%' UNION SELECT pc1.description,pc1.chargesCode from registrationDetails rd1,patientCharges pc1 where rd1.registrationNo = pc1.registrationNo and rd1.type = 'OPD' and (pc1.dateCharge between '$date' and '$date1') and pc1.title='PROFESSIONAL FEE' and pc1.company != 0 and pc1.status not like 'DELETED%%%%%') a order by description");


echo "<center><font size=2></font><table cellpadding=0 cellspacing=0  rules=all>";
echo "<tr>";
echo "<td style='border:0px;'>&nbsp;</td>";
echo "<td align='right' style='border:0px;'>&nbsp;<b>PAYING</b></td>";
echo "<td style='border:0px;'>&nbsp;&nbsp;<b>PATIENT</b></td>";
echo "<td style='border:0px;' align='right'><b>HMO</b></td>";
echo "<td style='border:0px;'>&nbsp;<b>ACCOUNT</b></td>";
echo "<td style='border:0px;' align='right'><b>CO.</b></td>";
echo "<td style='border:0px;'>&nbsp;<b>ACCOUNT</b></td>";
echo "</tr>";
echo "<tr>";
echo "<td width='17%' align='center'>&nbsp;<font size=2><b>NAME OF DOCTOR</b></font>&nbsp;</td>";
echo "<td width='7%' align='center'>&nbsp;<font size=2><b>NO. OF PATIENT</b></font>&nbsp;</td>";
echo "<td width='7%' align='center'>&nbsp;<font size=2><b>AMOUNT</b></font>&nbsp;</td>";
echo "<td width='7%' align='center'>&nbsp;<font size=2><b>NO. OF PATIENT</b></font>&nbsp;</td>";
echo "<td width='7%' align='center'>&nbsp;<font size=2><b>AMOUNT</b></font>&nbsp;</td>";
echo "<td width='7%' align='center'>&nbsp;<font size=2><b>NO. OF PATIENT</b></font>&nbsp;</td>";
echo "<td width='7%' align='center'>&nbsp;<font size=2><b>AMOUNT</b></font>&nbsp;</td>";
echo "</tr>";
$this->docPatient = 1;
while($row = mysqli_fetch_array($result))
  {
//$amount = preg_split ("/\//", $row['sellingPrice']); 
$this->getDoctorPFReport_pxCount_cash($row['chargesCode'],$date,$date1);
$this->getDoctorPFReport_pxCount_company($row['chargesCode'],$date,$date1);

echo "<tr id='tableRow'>";
echo "<td>&nbsp;<font size=2>".$row['description']."</font></td>";
echo "<td><a href='http://".$this->getMyUrl()."/COCONUT/Reports/doctorReport/doctorPF_cash.php?chargesCode=$row[chargesCode]&date=$date&date1=$date1&docName=$row[description]' target='_blank'><font size=2><center>".$this->getDoctorPFReport_pxCount_cash_pxCount()."</center></font></a></td>";
echo "<td><font size=2><center>".number_format($this->getDoctorPFReport_pxCount_cash_totalAmount(),2)."</center></font></td>";
echo "<td><a href='http://".$this->getMyUrl()."/COCONUT/Reports/doctorReport/doctorPF_company.php?chargesCode=$row[chargesCode]&date=$date&date1=$date1&docName=$row[description]' target='_blank'><font size=2><center>".$this->getDoctorPFReport_pxCount_company_pxCount()."</center></font></a></td>";
echo "<td><font size=2><center>".number_format($this->getDoctorPFReport_pxCount_company_totalAmount(),2)."</center></font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
 
  }
echo "</table>";

}


public $docPF_docPF_branch;
//kkunin ung pf ni doc sa bawat branch
public function getDoctorPFbyBranch($type,$doctor,$branch,$fromMonth,$fromDay,$fromYear,$toMonth,$toDay,$toYear){

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

$fromDate = $fromYear."-".$fromMonth."-".$fromDay;
$toDate = $toYear."-".$toMonth."-".$toDay;

((bool)mysqli_query( $con, "USE " . $this->database));


if($type == "OPD") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pc.sellingPrice) as sellingPrice from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = pc.registrationNo and pc.description = '$doctor' and (pc.dateCharge between '$fromDate' and '$toDate') and pc.branch = '$branch' and rd.type='$type'  ");
}else if($type == "IPD") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pc.cashUnpaid) as sellingPrice from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = pc.registrationNo and pc.description = '$doctor' and title = 'PROFESSIONAL FEE' and (rd.dateUnregistered between '$fromDate' and '$toDate') and pc.branch = '$branch' and (rd.type='IPD' or rd.type='OR/DR' or rd.type='ICU') and status not like 'DELETED%%%%%%%'  ");
}else {}

$this->docPF_docPF_branch=0;
while($row = mysqli_fetch_array($result))
  {
//$pf_branch = preg_split ("/\//", $row['sellingPrice']); 
return $this->docPF_docPF_branch+=$row['sellingPrice'];
  }

}


public $docTotalPF_branches;

public function docTotalPF_branches() {
return $this->docTotalPF_branches;
}

//ITO UNG MGGING ROW SA REPORT N ANG LAMAN IS UNG TOTAL PF NG BWAT DOCTOR
public function reportRowBranch_PF($type,$doctor,$m,$d,$y,$m1,$d1,$y1) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT branch from branch order by branch asc  ");

$this->docTotalPF_branches=0;
while($row = mysqli_fetch_array($result))
  {
if($this->getDoctorPFbyBranch($type,$doctor,$row['branch'],$m,$d,$y,$m1,$d1,$y1) > 0) {
echo "<td>&nbsp;".number_format($this->getDoctorPFbyBranch($type,$doctor,$row['branch'],$m,$d,$y,$m1,$d1,$y1),2)."&nbsp;</td>";
}else {
echo "<td>&nbsp;</tD>";
}
$this->docTotalPF_branches+=$this->getDoctorPFbyBranch($type,$doctor,$row['branch'],$m,$d,$y,$m1,$d1,$y1);
  }
echo "<Td><center><b>".number_format($this->docTotalPF_branches(),2)."</b></center></td>";
}

//ILLBAS UNG LIST NG DOCTOR AS TABLE ROW
public function listDoctorAsRow($type,$fromMonth,$fromDay,$fromYear,$toMonth,$toDay,$toYear){

echo "<style type='text/css'>
#docPF:hover { background-color:yellow; color:black; }
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from Doctors order by Name asc  ");

while($row = mysqli_fetch_array($result))
  {
echo "<tr id='docPF'>";
if( $type == "OPD" ) {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Reports/doctorReport/doctorPF_list.php?username=admin&month=$fromMonth&day=$fromDay&year=$fromYear&fromTime_hour=00&fromTime_minutes=00&fromTime_seconds=00&toTime_hour=24&toTime_minutes=00&toTime_seconds=00&show=$row[Name]' style='text-decoration:none; color:black;' target='_blank'>".$row['Name']."</a>&nbsp;</td>";
}else {

echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Reports/doctorReport/pf_ipd.php?show=$row[Name]&fromDate_month=$fromMonth&fromDate_day=$fromDay&fromDate_year=$fromYear&toDate_month=$toMonth&toDate_day=$toDay&toDate_year=$toYear' style='text-decoration:none; color:black;' target='_blank'>".$row['Name']."</a>&nbsp;</td>";

}

$this->reportRowBranch_PF($type,$row['Name'],$fromMonth,$fromDay,$fromYear,$toMonth,$toDay,$toYear);
echo "</tr>";
  }


}




public function getResultPatient($title,$type,$chargesCode,$fromDate,$toDate){

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }


((bool)mysqli_query( $con, "USE " . $this->database));


$result = mysqli_query($GLOBALS["___mysqli_ston"], "
select count(pc.itemNo) as total from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.title = '$title' and rd.type = '$type' and (pc.dateCharge between '$fromDate' and '$toDate') and pc.chargesCode = '$chargesCode' and pc.status not like 'DELETED%%%%%'
");

while($row = mysqli_fetch_array($result))
  {
if( $row['total'] > 0 ) {
return $row['total'];
}else {
return "";
}

  }

}



public function getTotalOfTitle_formatted($title,$type,$chargesCode,$fromDate,$toDate){

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }


((bool)mysqli_query( $con, "USE " . $this->database));


$result = mysqli_query($GLOBALS["___mysqli_ston"], "
select sum(pc.total) as total from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.title = '$title' and rd.type = '$type' and (pc.dateCharge between '$fromDate' and '$toDate') and pc.chargesCode = '$chargesCode' and pc.status not like 'DELETED%%%%%'
");

while($row = mysqli_fetch_array($result))
  {
if( $row['total'] > 0 ) {
return number_format($row['total'],2);
}else {
return "";
}

}

}


public function getTotalOfTitle($title,$type,$chargesCode,$fromDate,$toDate){

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }


((bool)mysqli_query( $con, "USE " . $this->database));


$result = mysqli_query($GLOBALS["___mysqli_ston"], "
select sum(pc.total) as total from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.title = '$title' and rd.type = '$type' and (pc.dateCharge between '$fromDate' and '$toDate') and pc.chargesCode = '$chargesCode' and pc.status not like 'DELETED%%%%%'
");

while($row = mysqli_fetch_array($result))
  {
if( $row['total'] > 0 ) {
return $row['total'];
}else {
return "";
}

}

}




public $listExaminationAsRow_totalCount;
public $listExaminationAsRow_totalAmount;
public $listExaminationAsRow_opdCount;
public $listExaminationAsRow_ipdCount;
public $listExaminationAsRow_opdTotal;
public $listExaminationAsRow_ipdTotal;
public $listExaminationAsRow_grandTotalCount;
public $listExaminationAsRow_grandTotalAmount;

public function listExaminationAsRow($title,$fromDate,$toDate){

echo "<style type='text/css'>
#rowz:hover { background-color:yellow; color:black; }
</style>";
$fromDatez = preg_split ("/\-/",$fromDate);
$toDatez = preg_split ("/\-/",$toDate);
$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT Description,chargesCode from availableCharges WHERE Category = '$title' order by Description asc  ");

while($row = mysqli_fetch_array($result))
  {
$this->listExaminationAsRow_totalCount = ( $this->getResultPatient($title,"IPD",$row['chargesCode'],$fromDate,$toDate) + $this->getResultPatient($title,"OPD",$row['chargesCode'],$fromDate,$toDate) );
$this->listExaminationAsRow_totalAmount = ( $this->getTotalOfTitle($title,"IPD",$row['chargesCode'],$fromDate,$toDate) + $this->getTotalOfTitle($title,"OPD",$row['chargesCode'],$fromDate,$toDate) );

$this->listExaminationAsRow_opdCount += $this->getResultPatient($title,"OPD",$row['chargesCode'],$fromDate,$toDate);
$this->listExaminationAsRow_ipdCount += $this->getResultPatient($title,"IPD",$row['chargesCode'],$fromDate,$toDate);
$this->listExaminationAsRow_opdTotal += $this->getTotalOfTitle($title,"OPD",$row['chargesCode'],$fromDate,$toDate);
$this->listExaminationAsRow_ipdTotal += $this->getTotalOfTitle($title,"IPD",$row['chargesCode'],$fromDate,$toDate);

$this->listExaminationAsRow_grandTotalCount += $this->listExaminationAsRow_totalCount;
$this->listExaminationAsRow_grandTotalAmount += $this->listExaminationAsRow_totalAmount;

echo "<tr id='rowz'>";
echo "<td>&nbsp;<a href='/COCONUT/ADMIN/census/labCensus.php?fromYear=$fromDatez[0]&fromMonth=$fromDatez[1]&fromDay=$fromDatez[2]&toYear=$toDatez[0]&toMonth=$toDatez[1]&toDay=$toDatez[2]&exam=$row[chargesCode]&title=$title' target='_blank' style='color:black; text-decoration:none;'>".$row['Description']."</a>&nbsp;</td>";
echo "<td>&nbsp;<font color=red>".$this->getResultPatient($title,"IPD",$row['chargesCode'],$fromDate,$toDate)." - ".$this->getTotalOfTitle_formatted($title,"IPD",$row['chargesCode'],$fromDate,$toDate)."</font>&nbsp;</td>";
echo "<td>&nbsp;<font color=blue>".$this->getResultPatient($title,"OPD",$row['chargesCode'],$fromDate,$toDate)." - ".$this->getTotalOfTitle_formatted($title,"OPD",$row['chargesCode'],$fromDate,$toDate)."</font>&nbsp;</td>";

if( $this->listExaminationAsRow_totalCount > 0 ) {
echo "<td>&nbsp;".$this->listExaminationAsRow_totalCount." - ".number_format($this->listExaminationAsRow_totalAmount,2)."&nbsp</td>";
}else {
echo "<td>&nbsp;</td>";
}

echo "</tr>";
  }

echo "<tr>";
echo "<td>&nbsp;<b>TOTAL</b></td>";
echo "<td>&nbsp;<font color=red>".$this->listExaminationAsRow_ipdCount." - ".number_format($this->listExaminationAsRow_ipdTotal,2)."</font></td>";
echo "<td>&nbsp;<font color=blue>".$this->listExaminationAsRow_opdCount." - ".number_format($this->listExaminationAsRow_opdTotal,2)."</font></td>";
echo "<td>&nbsp;".$this->listExaminationAsRow_grandTotalCount." - ".number_format($this->listExaminationAsRow_grandTotalAmount,2)."</td>";
echo "</tr>";

}



public function getTotalListHMO($hmo,$branch,$m,$d,$y,$m1,$d1,$y1,$type) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$fromDate = $y."-".$m."-".$d;
$toDate = $y1."-".$m1."-".$d1;

if( $type == "IPD" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pc.company) as total from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = pc.registrationNo and rd.Company = '$hmo' and (rd.type='IPD' or rd.type='OR/DR' or rd.type='ICU') and pc.company > 0 and (rd.dateUnregistered between '$fromDate' and '$toDate') and status = 'UNPAID' ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pc.company) as total from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = pc.registrationNo and rd.Company = '$hmo' and rd.type='$type' and pc.company > 0 and (pc.dateCharge between '$fromDate' and '$toDate') and status = 'UNPAID' ");
}



while($row = mysqli_fetch_array($result))
  {
return $row['total'];
}

}


public $listHMO_total;
public function reportRowBranch_listHMO($hmo,$m,$d,$y,$m1,$d1,$y1,$type) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT branch from branch order by branch asc  ");

$this->listHMO_total=0;
while($row = mysqli_fetch_array($result))
  {
if($this->getTotalListHMO($hmo,$row['branch'],$m,$d,$y,$m1,$d1,$y1,$type) > 0) {
echo "<td><center>&nbsp;".number_format($this->getTotalListHMO($hmo,$row['branch'],$m,$d,$y,$m1,$d1,$y1,$type),2)."&nbsp;</center></td>";
}else {
echo "<td><center>&nbsp;&nbsp;</center></td>";
}
$this->listHMO_total+=$this->getTotalListHMO($hmo,$row['branch'],$m,$d,$y,$m1,$d1,$y1,$type);
}

if($this->listHMO_total > 0) {
echo "<td>&nbsp;<b>".number_format($this->listHMO_total,2)."</b>&nbsp;</td>";
}else {
echo "<td>&nbsp;</td>";
}
}


public function listHMO($fromMonth,$fromDay,$fromYear,$toMonth,$toDay,$toYear,$type) {

echo "<style type='text/css'>
#docPF:hover { background-color:yellow; color:black; }
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT companyName from Company WHERE companyName != '' order by companyName asc  ");

while($row = mysqli_fetch_array($result))
  {
echo "<tr id='docPF'>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Reports/hmoSOA1.php?username=admin&company=$row[companyName]&fromMonth=$fromMonth&fromDay=$fromDay&fromYear=$fromYear&toMonth=$toMonth&toDay=$toDay&toYear=$toYear&branch=All' target='_blank' style='text-decoration:none; color:black;'>".$row['companyName']."</a>&nbsp;</td>";
$this->reportRowBranch_listHMO($row['companyName'],$fromMonth,$fromDay,$fromYear,$toMonth,$toDay,$toYear,$type);
echo "</tr>";
  }

}



public $detailed_group_qty;
public $detailed_group_total;
public $detailed_group_phic;
public $detailed_group_cashUnpaid;
public $detailed_group_cashPaid;
public $detailed_group_company;

public function detailed_group_qty() {
return $this->detailed_group_qty;
}
public function detailed_group_total() {
return $this->detailed_group_total;
}
public function detailed_group_phic() {
return $this->detailed_group_phic;
}
public function detailed_group_cashUnpaid() {
return $this->detailed_group_cashUnpaid;
}
public function detailed_group_cashPaid() {
return $this->detailed_group_cashPaid;
}
public function detailed_group_company() {
return $this->detailed_group_company;
}

public function detailed_group($registrationNo,$chargesCode) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pc.quantity) as qty,sum(pc.total) as total,sum(pc.phic) as phic,sum(pc.cashUnpaid) as cashUnpaid,sum(company) as company,sum(cashPaid) as cashPaid from patientCharges pc WHERE pc.registrationNo='$registrationNo' and pc.chargesCode = '$chargesCode' and pc.status not like 'DELETED_%%%%%%%' "); 

while($row = mysqli_fetch_array($result))
  {
$this->detailed_group_qty = $row['qty'];
$this->detailed_group_total = $row['total'];
$this->detailed_group_phic = $row['phic'];
$this->detailed_group_cashUnpaid = $row['cashUnpaid'];
$this->detailed_group_company = $row['company'];
$this->detailed_group_cashPaid = $row['cashPaid'];
  }


}



//handle the total in soa in every header
public $soa_discount;
public $soa_sellingPrice;
public $soa_total;
public $soa_cash;
public $soa_pfCash;
public $soa_company;
public $soa_paid;
public $soa_cashUnpaid;
public $soa_phic;



public function soa_discount() {
return $this->soa_discount;
}
public function soa_sellingPrice() {
return $this->soa_sellingPrice;
}
public function soa_total() {
return $this->soa_total;
}
public function soa_cash() {
return $this->soa_cash;
}
public function soa_pfCash() {
return $this->soa_pfCash;
}
public function soa_company() {
return $this->soa_company;
}
public function soa_paid() {
return $this->soa_paid;
}
public function soa_cashUnpaid() {
return $this->soa_cashUnpaid;
}
public function soa_phic() {
return $this->soa_phic;
}

public function chargesForSOA($registrationNo,$show,$data1,$data2) {

//getTotal($cols,$title,$registrationNo)

echo "<style type='text/css'>
.heading {
font-size:15px;
}

#charges:hover { background-color:yellow; color:black; }

</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($show == "All") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.*,rd.* from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and pc.registrationNo = rd.registrationNo and pc.status = 'UNPAID' order by pc.title asc  ");
}else if($show == "try") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.chargesCode,SUM(pc.quantity) as quantity,pc.description,pc.quantity,pc.sellingPrice,pc.dateCharge,pc.discount,pc.total,pc.cashPaid,pc.company,pc.phic,pc.cashUnpaid,pc.title,rd.* from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and pc.registrationNo = rd.registrationNo and pc.status = 'UNPAID' group by pc.chargesCode order by pc.title asc  ");
}
else if($show == "hmoSOA") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.chargesCode,SUM(pc.quantity) as quantity,pc.description,pc.quantity,pc.sellingPrice,pc.dateCharge,pc.discount,pc.total,pc.cashPaid,pc.company,pc.phic,pc.cashUnpaid,pc.title,rd.* from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and pc.registrationNo = rd.registrationNo group by pc.chargesCode order by pc.title asc  ");
}
else if($show == "Date") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.*,rd.* from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and rd.registrationNo = pc.registrationNo and (dateCharge between '$data1' and '$data2') and pc.status = 'UNPAID' order by pc.description asc  ");
}else if($show == "Category") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.*,rd.* from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and status not like 'DELETED_%%%%%%' and rd.registrationNo = pc.registrationNo and title='$data1' and pc.status = 'UNPAID' order by description asc  ");
}else if($show == "phic") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.*,rd.* from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and rd.registrationNo = pc.registrationNo and phic > 0 and pc.status = 'UNPAID' order by description asc  ");
}else if($show == "company") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.*,rd.* from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and rd.registrationNo = pc.registrationNo and pc.company > 0 and pc.status = 'UNPAID' order by pc.description asc  ");
}else if($show == "cashPaid") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.*,rd.* from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and rd.registrationNo = pc.registrationNo and cashPaid > 0 and pc.status = 'UNPAID' order by description asc  ");
}else if($show == "cashUnpaid") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.*,rd.* from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and rd.registrationNo = pc.registrationNo and cashUnpaid > 0 and pc.status not like 'DELETED_%%%%%%' order by description asc  ");
}else if($show == "selected") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.*,rd.* from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and rd.registrationNo = pc.registrationNo and itemNo='$data1' and pc.status = 'UNPAID' order by description asc  ");
}else {
echo "";
}
echo "<Table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo "<th width='30%'>&nbsp;<font class='heading'><b>Particulars</b></font>&nbsp;</th>";
echo  "<th >&nbsp;<font class='heading'><b>QTY</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PRICE</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PRICE</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>DISC</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>TOTAL</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PAID</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>COMPANY</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PhilHealth</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>UNPAID</b></font>&nbsp;</th>";
echo "</tr>";




while($row = mysqli_fetch_array($result))
  {
$price = preg_split ("/\//", $row['sellingPrice']); 
echo "<tr id='charges'>";
$this->soa_discount+=$row['discount'];



$this->detailed_group($registrationNo,$row['chargesCode']);




echo "<td>&nbsp;<font class='heading'>".$row['description']."</font>&nbsp;</td>";
if( $show == "try" ) {
echo "<td>&nbsp;<font class='heading'>".$this->detailed_group_qty()."</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font class='heading'>".$row['quantity']."</font>&nbsp;</td>";
}






if($row['title'] == "PROFESSIONAL FEE") {
echo "<td>&nbsp;<font class='heading'>".number_format($price[0],2)."</font>&nbsp;</td>";
$this->soa_pfCash+=$price[0];
}else {
$this->soa_sellingPrice+=$row['sellingPrice'];
echo "<td>&nbsp;<font class='heading'>".number_format($row['sellingPrice'],2)."</font>&nbsp;</td>";
}


echo "<Td>&nbsp;<font class='heading'>".$row['dateCharge']."</font>&nbsp;</tD>";
if($row['discount'] > 0) {
echo "<td>&nbsp;<font class='heading'>".$row['discount']."</font>&nbsp;</td>";
}else {
echo "<Td>&nbsp;</tD>";
}
echo "<td>&nbsp;<font class='heading'>".$this->detailed_group_total()."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".$this->detailed_group_cashPaid()."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".$this->detailed_group_company()."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".$this->detailed_group_phic()."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".$this->detailed_group_cashUnpaid()."</font>&nbsp;</td>";

$this->soa_phic+=$this->detailed_group_phic();
$this->soa_company+=$this->detailed_group_company();
$this->soa_paid+=$this->detailed_group_cashPaid();
$this->soa_cashUnpaid+=$this->detailed_group_cashUnpaid();
$this->soa_total+=$this->detailed_group_total();

echo "</tr>";
  }





echo "<tr>";
echo "<Td><center><font class='heading'><b>TOTAL</b></font></center></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b></b></font>&nbsp;</td>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_discount,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_total,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_paid,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_company,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_phic,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_cashUnpaid,2)."</b></font>&nbsp;</td>";
echo "</table>";
echo "<br>__________________________<br><font size=2>Cashier / Billing</font><br>";
}







public function chargesForSOA_hospital($registrationNo,$show,$data1,$data2) {

echo "<style type='text/css'>
.heading {
font-size:15px;
}

#charges:hover { background-color:yellow; color:black; }

</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.*,rd.* from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and pc.registrationNo = rd.registrationNo order by description asc  ");

echo "<Table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo "<th width='30%'>&nbsp;<font class='heading'><b>Particulars</b></font>&nbsp;</th>";
echo  "<th >&nbsp;<font class='heading'><b>QTY</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PRICE</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PRICE</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>DISC</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>TOTAL</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PAID</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>COMPANY</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PhilHealth</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>UNPAID</b></font>&nbsp;</th>";
echo "</tr>";




while($row = mysqli_fetch_array($result))
  {
$price = preg_split ("/\//", $row['sellingPrice']); 
echo "<tr id='charges'>";
$this->soa_discount+=$row['discount'];
$this->soa_cashUnpaid+=$row['cashUnpaid'];
$this->soa_company+=$row['company'];
$this->soa_total+=$row['total'];
$this->soa_paid+=$row['cashPaid'];
$this->soa_phic+=$row['phic'];

if($row['title'] == "MEDICINE" ) {
echo "<td>&nbsp;<font class='heading'>".$this->getGeneric($row['chargesCode'])."</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font class='heading'>".$row['description']."</font>&nbsp;</td>";
}

echo "<td>&nbsp;<font class='heading'>".$row['quantity']."</font>&nbsp;</td>";
if($row['title'] == "PROFESSIONAL FEE") {
echo "<td>&nbsp;<font class='heading'>".number_format($price[0],2)."</font>&nbsp;</td>";
$this->soa_pfCash+=$price[0];
}else {
$this->soa_sellingPrice+=$row['sellingPrice'];
echo "<td>&nbsp;<font class='heading'>".number_format($row['sellingPrice'],2)."</font>&nbsp;</td>";
}
echo "<Td>&nbsp;<font class='heading'>".$row['dateCharge']."</font>&nbsp;</tD>";
if($row['discount'] > 0) {
echo "<td>&nbsp;<font class='heading'>".$row['discount']."</font>&nbsp;</td>";
}else {
echo "<Td>&nbsp;</tD>";
}
echo "<td>&nbsp;<font class='heading'>".$row['total']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".$row['cashPaid']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".$row['company']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".$row['phic']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".$row['cashUnpaid']."</font>&nbsp;</td>";
echo "</tr>";
  }





echo "<tr>";
echo "<Td><center><font class='heading'><b>TOTAL</b></font></center></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format(($this->soa_sellingPrice + $this->soa_pfCash),2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_discount,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_total,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_paid,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_company,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_phic,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_cashUnpaid,2)."</b></font>&nbsp;</td>";
echo "</table>";
echo "<br>__________________________<br><font size=2>Cashier / Billing</font><br>";
}


public function chargesForSOA_ipd_hospital($registrationNo,$show,$data1,$data2) {

echo "<style type='text/css'>
.heading {
font-size:15px;
}

#charges:hover { background-color:yellow; color:black; }

</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.*,rd.* from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and pc.registrationNo = rd.registrationNo and status = 'UNPAID' order by description asc  ");

echo "<Table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo  "<th>&nbsp;<font class='heading'><b>DATE</b></font>&nbsp;</th>";
echo "<th width='30%'>&nbsp;<font class='heading'><b>Particulars</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>QTY</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PRICE</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>DISC</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>TOTAL</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>CASH</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>COMPANY</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PhilHealth</b></font>&nbsp;</th>";
echo "</tr>";




while($row = mysqli_fetch_array($result))
  {
$price = preg_split ("/\//", $row['sellingPrice']); 
echo "<tr id='charges'>";
$this->soa_discount+=$row['discount'];
$this->soa_cashUnpaid+=$row['cashUnpaid'];
$this->soa_company+=$row['company'];
$this->soa_total+=$row['total'];
$this->soa_paid+=$row['cashPaid'];
$this->soa_phic+=$row['phic'];


echo "<Td>&nbsp;<font class='heading'>".$row['dateCharge']."</font>&nbsp;</tD>";

if($row['title'] == "MEDICINE") {
echo "<td>&nbsp;<font class='heading'>".$this->getGeneric($row['chargesCode'])."</font>&nbsp;</td>";
}else {

if( $row['description'] == "admission kit" && $row['title'] == "MISCELLANEOUS" ) {
echo "<td>&nbsp;<font class='heading'>Miscellaneous</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font class='heading'>".$row['description']."</font>&nbsp;</td>";
}


}

echo "<td>&nbsp;<font class='heading'>".$row['quantity']."</font>&nbsp;</td>";
if($row['title'] == "PROFESSIONAL FEE") {
echo "<td>&nbsp;<font class='heading'>".number_format($price[0],2)."</font>&nbsp;</td>";
$this->soa_pfCash+=$price[0];
}else {
$this->soa_sellingPrice+=$row['sellingPrice'];
echo "<td>&nbsp;<font class='heading'>".number_format($row['sellingPrice'],2)."</font>&nbsp;</td>";
}
if($row['discount'] > 0) {
echo "<td>&nbsp;<font class='heading'>".$row['discount']."</font>&nbsp;</td>";
}else {
echo "<Td>&nbsp;</tD>";
}
echo "<td>&nbsp;<font class='heading'>".$row['total']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".$row['cashUnpaid']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".$row['company']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".$row['phic']."</font>&nbsp;</td>";
echo "</tr>";
  }





echo "<tr>";
echo "<Td><center><font class='heading'><b>TOTAL</b></font></center></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;<font class='heading'><b>".number_format(($this->soa_sellingPrice + $this->soa_pfCash),2)."</b></font>&nbsp;</td>";

echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_discount,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_total,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_cashUnpaid,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_company,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_phic,2)."</b></font>&nbsp;</td>";
echo "</table>";
echo "<br>";

//$this->viewPayment_soa($registrationNo,$this->soa_cashUnpaid);


}


public $chargesForSOA_cashUnpaid;
public $chargesForSOA_phic;
public $chargesForSOA_total;
public $chargesForSOA_company;



public function chargesForSOA_ipd($registrationNo,$show,$data1,$data2) {

echo "<style type='text/css'>
.heading {
font-size:15px;
}

#charges:hover { background-color:yellow; color:black; }

</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($show == "All") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.*,rd.* from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and pc.registrationNo = rd.registrationNo and (pc.status = 'UNPAID' or pc.status = 'Discharged') order by title asc  ");
}

else if($show == "try") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.chargesCode,pc.quantity,pc.description,pc.quantity,pc.sellingPrice,pc.dateCharge,pc.discount,pc.total,pc.cashPaid,pc.company,pc.phic,pc.cashUnpaid,pc.title,rd.* from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and pc.registrationNo = rd.registrationNo and (pc.status = 'UNPAID' or pc.status = 'Discharged') order by pc.title asc  ");
}


else if($show == "pharmacy") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.chargesCode,pc.title,pc.quantity,pc.description,pc.quantity,pc.sellingPrice,pc.dateCharge,pc.discount,pc.total,pc.cashPaid,pc.company,pc.phic,pc.cashUnpaid,pc.title,rd.* from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and pc.registrationNo = rd.registrationNo and pc.status = 'UNPAID' and pc.inventoryFrom = 'PHARMACY' order by pc.title,description asc  ");
}

else if($show == "Date") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.*,rd.* from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and rd.registrationNo = pc.registrationNo and (dateCharge between '$data1' and '$data2') and (pc.status = 'UNPAID' or pc.status = 'Discharged') order by pc.description asc  ");
}else if($show == "Category") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.*,rd.* from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and rd.registrationNo = pc.registrationNo and title='$data1' and (pc.status = 'UNPAID' or pc.status = 'Discharged') order by description asc  ");
}else if($show == "phic") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.*,rd.* from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and rd.registrationNo = pc.registrationNo and phic > 0 and (pc.status = 'UNPAID' or pc.status = 'Discharged') order by description asc  ");
}else if($show == "company") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.*,rd.* from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and rd.registrationNo = pc.registrationNo and pc.company > 0 and (pc.status  = 'UNPAID' or pc.status = 'Discharged') order by pc.description asc  ");
}else if($show == "cashPaid") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.*,rd.* from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and rd.registrationNo = pc.registrationNo and cashPaid > 0 and (pc.status = 'UNPAID' or pc.status = 'Discharged') order by description asc  ");
}else if($show == "cashUnpaid") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.*,rd.* from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and rd.registrationNo = pc.registrationNo and cashUnpaid > 0 and (pc.status = 'UNPAID' or pc.status = 'Discharged') order by description asc  ");
}else if($show == "selected") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.*,rd.* from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and rd.registrationNo = pc.registrationNo and itemNo='$data1' and (pc.status = 'UNPAID' or pc.status = 'Discharged') order by description asc  ");
}else {
echo "";
}
echo "<Table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo  "<th>&nbsp;<font class='heading'><b>DATE</b></font>&nbsp;</th>";
echo "<th width='30%'>&nbsp;<font class='heading'><b>Particulars</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>QTY</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PRICE</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>TOTAL</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>CASH</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>COMPANY</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PhilHealth</b></font>&nbsp;</th>";
if( $show == "pharmacy" ) {
echo  "<th>&nbsp;<font class='heading'><b>Type</b></font>&nbsp;</th>";
}else {

}
echo "</tr>";




while($row = mysqli_fetch_array($result))
  {
$price = preg_split ("/\//", $row['sellingPrice']); 
echo "<tr id='charges'>";

$this->detailed_group($registrationNo,$row['chargesCode']);
$this->soa_discount+=$row['discount'];
$this->chargesForSOA_cashUnpaid += $row['cashUnpaid'];
$this->chargesForSOA_phic += $row['phic'];
$this->chargesForSOA_total += $row['total'];
$this->chargesForSOA_company += $row['company'];

echo "<Td>&nbsp;<font class='heading'>".$row['dateCharge']."</font>&nbsp;</tD>";

//admission kit change to miscellaneous kpag ang title ay miscellaneous
if( $row['description'] == "admission kit" && $row['title'] == "MISCELLANEOUS" ) {
echo "<td>&nbsp;<font class='heading'>Miscellaneous</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font class='heading'>".$row['description']."</font>&nbsp;</td>";
}

echo "<td>&nbsp;<font class='heading'>".$row['quantity']."</font>&nbsp;</td>";
if($row['title'] == "PROFESSIONAL FEE") {
echo "<td>&nbsp;<font class='heading'>".number_format($price[0],2)."</font>&nbsp;</td>";
$this->soa_pfCash+=$price[0];
}else {
$this->soa_sellingPrice+=$row['sellingPrice'];
echo "<td>&nbsp;<font class='heading'>".number_format($row['sellingPrice'],2)."</font>&nbsp;</td>";
}
echo "<td>&nbsp;<font class='heading'>".number_format($row['total'],2)."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".number_format($row['cashUnpaid'],2)."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".number_format($row['company'],2)."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".number_format($row['phic'],2)."</font>&nbsp;</td>";
if( $show == "pharmacy" ) {
echo "<td>&nbsp;<font class='heading'>".$row['title']."</font>&nbsp;</td>";
}else {

}


//$this->soa_cashUnpaid+=$this->detailed_group_cashUnpaid();
$this->soa_cashUnpaid += $row['cashUnpaid'];
//$this->soa_company+=$this->detailed_group_company();
$this->soa_company += $row['company'];
//$this->soa_total+=$this->detailed_group_total();
$this->soa_total += $row['total'];
//$this->soa_paid+=$this->detailed_group_cashPaid();
$this->soa_paid += $row['cashPaid'];
//$this->soa_phic+=$this->detailed_group_phic();
$this->soa_phic += $row['phic'];
echo "</tr>";
  }





echo "<tr>";
echo "<Td><center><font class='heading'><b>TOTAL</b></font></center></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b></b></font>&nbsp;</td>";

echo "<td>&nbsp;<font class='heading'><b>&nbsp;</b></font>&nbsp;</td>";

if( $show == "All" ) {
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->chargesForSOA_total,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->chargesForSOA_cashUnpaid,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->chargesForSOA_company,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->chargesForSOA_phic,2)."</b></font>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_total,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_cashUnpaid,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_company,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_phic,2)."</b></font>&nbsp;</td>";
}

echo "</table>";
echo "<br>";

//$this->viewPayment_soa($registrationNo,$this->soa_cashUnpaid);


}

//pra sa selected items for SOA
public function chargesForSOA_selected($registrationNo,$show,$data1,$data2) {

echo "<style type='text/css'>
.heading {
font-size:13px;
}

#charges:hover { background-color:yellow; color:black; }

</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($show == "All") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from patientCharges WHERE registrationNo = '$registrationNo' order by description asc  ");
}else if($show == "Date") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from patientCharges WHERE registrationNo = '$registrationNo' and (dateCharge between '$data1' and '$data2') order by description asc  ");
}else if($show == "Category") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from patientCharges WHERE registrationNo = '$registrationNo' and title='$data1' order by description asc  ");
}else if($show == "phic") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from patientCharges WHERE registrationNo = '$registrationNo' and phic > 0 order by description asc  ");
}else if($show == "company") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from patientCharges WHERE registrationNo = '$registrationNo' and company > 0 order by description asc  ");
}else if($show == "cashPaid") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from patientCharges WHERE registrationNo = '$registrationNo' and cashPaid > 0 order by description asc  ");
}else if($show == "cashUnpaid") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from patientCharges WHERE registrationNo = '$registrationNo' and cashUnpaid > 0 order by description asc  ");
}else {
echo "";
}
echo "<Table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo "<th width='30%'>&nbsp;<font class='heading'><b></b></font>&nbsp;</th>";
echo "<th>&nbsp;<font class='heading'><b>Particulars</b></font>&nbsp;</th>";
echo  "<th width='20%'>&nbsp;<font class='heading'><b>QTY</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PRICE</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>DATE</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>DISC</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>TOTAL</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PAID</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>COMPANY</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PhilHealth</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>UNPAID</b></font>&nbsp;</th>";
echo "</tr>";

echo "<form method='get' action='http://".$this->getMyUrl()."/COCONUT/patientProfile/SOAoption/soaSelected.php'>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='username' value=''>";
echo "<input type=hidden name='show' value='selected'>";

while($row = mysqli_fetch_array($result))
  {
$price = preg_split ("/\//", $row['sellingPrice']); 
echo "<tr id='charges'>";
$this->soa_discount+=$row['discount'];
$this->soa_cashUnpaid+=$row['cashUnpaid'];
$this->soa_company+=$row['company'];
$this->soa_total+=$row['total'];
$this->soa_paid+=$row['cashPaid'];
$this->soa_phic+=$row['phic'];

echo "<td>&nbsp;<input type=checkbox name='itemNo[]' value='".$row['itemNo']."'>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".$row['description']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".$row['quantity']."</font>&nbsp;</td>";
if($row['title'] == "PROFESSIONAL FEE") {
echo "<td>&nbsp;<font class='heading'>".$price[0]."</font>&nbsp;</td>";
$this->soa_pfCash+=$price[0];
}else {
$this->soa_sellingPrice+=$row['sellingPrice'];
echo "<td>&nbsp;<font class='heading'>".$row['sellingPrice']."</font>&nbsp;</td>";
}
echo "<Td>&nbsp;<font class='heading'>".$row['dateCharge']."</font>&nbsp;</tD>";
if($row['discount'] > 0) {
echo "<td>&nbsp;<font class='heading'>".$row['discount']."</font>&nbsp;</td>";
}else {
echo "<Td>&nbsp;</tD>";
}
echo "<td>&nbsp;<font class='heading'>".$row['total']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".$row['cashPaid']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".$row['company']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".$row['phic']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".$row['cashUnpaid']."</font>&nbsp;</td>";
echo "</tr>";
  }

echo "<input type=submit value='Proceed' style='border:1px solid #000000; background:#3b5998 no-repeat 4px 4px; color:white;'>";
echo "</form>";
echo "<tr>";
echo "<td>&nbsp;</tD>";
echo "<Td><center><font class='heading'><b>TOTAL</b></font></center></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format(($this->soa_sellingPrice + $this->soa_pfCash),2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_discount,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_total,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_paid,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_company,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_phic,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_cashUnpaid,2)."</b></font>&nbsp;</td>";
echo "</table>";
echo "<br>__________________________<br><font size=2>Cashier / Billing</font><br>";
}



public function chargesForSOA_selected_ipd($registrationNo,$show,$data1,$data2) {

echo "<style type='text/css'>
.heading {
font-size:13px;
}

#charges:hover { background-color:yellow; color:black; }

</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($show == "All") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from patientCharges WHERE registrationNo = '$registrationNo' order by description asc  ");
}else if($show == "Date") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from patientCharges WHERE registrationNo = '$registrationNo' and (dateCharge between '$data1' and '$data2') order by description asc  ");
}else if($show == "Category") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from patientCharges WHERE registrationNo = '$registrationNo' and title='$data1' order by description asc  ");
}else if($show == "phic") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from patientCharges WHERE registrationNo = '$registrationNo' and phic > 0 order by description asc  ");
}else if($show == "company") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from patientCharges WHERE registrationNo = '$registrationNo' and company > 0 order by description asc  ");
}else if($show == "cashPaid") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from patientCharges WHERE registrationNo = '$registrationNo' and cashPaid > 0 order by description asc  ");
}else if($show == "cashUnpaid") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from patientCharges WHERE registrationNo = '$registrationNo' and cashUnpaid > 0 order by description asc  ");
}else {
echo "";
}
echo "<Table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo "<th>&nbsp;<font class='heading'><b></b></font>&nbsp;</th>";
echo "<th width='30%'>&nbsp;<font class='heading'><b>Particulars</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>QTY</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PRICE</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>DATE</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>DISC</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>CASH</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>COMPANY</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PhilHealth</b></font>&nbsp;</th>";
echo "</tr>";

echo "<form method='get' action='http://".$this->getMyUrl()."/COCONUT/patientProfile/SOAoption/soaSelected_ipd.php'>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='username' value=''>";
echo "<input type=hidden name='show' value='selected'>";

while($row = mysqli_fetch_array($result))
  {
$price = preg_split ("/\//", $row['sellingPrice']); 
echo "<tr id='charges'>";
$this->soa_discount+=$row['discount'];
$this->soa_cashUnpaid+=$row['cashUnpaid'];
$this->soa_company+=$row['company'];
$this->soa_total+=$row['total'];
$this->soa_paid+=$row['cashPaid'];
$this->soa_phic+=$row['phic'];

echo "<td>&nbsp;<input type=checkbox name='itemNo[]' value='".$row['itemNo']."'>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".$row['description']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".$row['quantity']."</font>&nbsp;</td>";
if($row['title'] == "PROFESSIONAL FEE") {
echo "<td>&nbsp;<font class='heading'>".$price[0]."</font>&nbsp;</td>";
$this->soa_pfCash+=$price[0];
}else {
$this->soa_sellingPrice+=$row['sellingPrice'];
echo "<td>&nbsp;<font class='heading'>".$row['sellingPrice']."</font>&nbsp;</td>";
}
echo "<Td>&nbsp;<font class='heading'>".$row['dateCharge']."</font>&nbsp;</tD>";
if($row['discount'] > 0) {
echo "<td>&nbsp;<font class='heading'>".$row['discount']."</font>&nbsp;</td>";
}else {
echo "<Td>&nbsp;</tD>";
}
echo "<td>&nbsp;<font class='heading'>".$row['cashUnpaid']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".$row['company']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".$row['phic']."</font>&nbsp;</td>";
echo "</tr>";
  }

echo "<input type=submit value='Proceed' style='border:1px solid #000000; background:#3b5998 no-repeat 4px 4px; color:white;'>";
echo "</form>";
echo "<tr>";
echo "<td>&nbsp;</tD>";
echo "<Td><center><font class='heading'><b>TOTAL</b></font></center></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format(($this->soa_sellingPrice + $this->soa_pfCash),2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_discount,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_cashUnpaid,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_company,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_phic,2)."</b></font>&nbsp;</td>";

echo "</table>";
echo "<br>__________________________<br><font size=2>Cashier / Billing</font><br>";
}



//show selected item from "chargesSOA_selected"
public function chargesForSOA_showSelected($registrationNo,$itemNo) {

echo "<style type='text/css'>
.heading {
font-size:13px;
}

#charges:hover { background-color:yellow; color:black; }

</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from patientCharges WHERE registrationNo = '$registrationNo' and itemNo='$itemNo' order by description asc  ");


/*
echo "<Table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo "<th width='30%'>&nbsp;<font class='heading'><b>Particulars</b></font>&nbsp;</th>";
echo  "<th width='20%'>&nbsp;<font class='heading'><b>QTY</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PRICE</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>DATE</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>DISC</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>TOTAL</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PAID</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>COMPANY</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PhilHealth</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>UNPAID</b></font>&nbsp;</th>";
echo "</tr>";
*/



while($row = mysqli_fetch_array($result))
  {
$price = preg_split ("/\//", $row['sellingPrice']); 
echo "<tr id='charges'>";
$this->soa_discount+=$row['discount'];
$this->soa_cashUnpaid+=$row['cashUnpaid'];
$this->soa_company+=$row['company'];
$this->soa_total+=$row['total'];
$this->soa_paid+=$row['cashPaid'];
$this->soa_phic+=$row['phic'];

echo "<td>&nbsp;<font class='heading'>".$row['description']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".$row['quantity']."</font>&nbsp;</td>";
if($row['title'] == "PROFESSIONAL FEE") {
echo "<td>&nbsp;<font class='heading'>".$price[0]."</font>&nbsp;</td>";
$this->soa_pfCash+=$price[0];
}else {
$this->soa_sellingPrice+=$row['sellingPrice'];
echo "<td>&nbsp;<font class='heading'>".$row['sellingPrice']."</font>&nbsp;</td>";
}
echo "<Td>&nbsp;<font class='heading'>".$row['dateCharge']."</font>&nbsp;</tD>";
if($row['discount'] > 0) {
echo "<td>&nbsp;<font class='heading'>".$row['discount']."</font>&nbsp;</td>";
}else {
echo "<Td>&nbsp;</tD>";
}
echo "<td>&nbsp;<font class='heading'>".$row['total']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".$row['cashPaid']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".$row['company']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".$row['phic']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".$row['cashUnpaid']."</font>&nbsp;</td>";
echo "</tr>";
  }




/*
echo "<tr>";
echo "<Td><center><font class='heading'><b>TOTAL</b></font></center></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format(($this->soa_sellingPrice + $this->soa_pfCash),2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_discount,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_total,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_paid,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_company,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_phic,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_cashUnpaid,2)."</b></font>&nbsp;</td>";
echo "</table>";
echo "<br>__________________________<br><font size=2>Cashier / Billing</font><br>";
*/


}


public function chargesForSOA_showSelected_ipd($registrationNo,$itemNo) {

echo "<style type='text/css'>
.heading {
font-size:13px;
}

#charges:hover { background-color:yellow; color:black; }

</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from patientCharges WHERE registrationNo = '$registrationNo' and itemNo='$itemNo' order by description asc  ");


/*
echo "<Table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo "<th width='30%'>&nbsp;<font class='heading'><b>Particulars</b></font>&nbsp;</th>";
echo  "<th width='20%'>&nbsp;<font class='heading'><b>QTY</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PRICE</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>DATE</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>DISC</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>TOTAL</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PAID</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>COMPANY</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>PhilHealth</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font class='heading'><b>UNPAID</b></font>&nbsp;</th>";
echo "</tr>";
*/



while($row = mysqli_fetch_array($result))
  {
$price = preg_split ("/\//", $row['sellingPrice']); 
echo "<tr id='charges'>";
$this->soa_discount+=$row['discount'];
$this->soa_cashUnpaid+=$row['cashUnpaid'];
$this->soa_company+=$row['company'];
$this->soa_total+=$row['total'];
$this->soa_paid+=$row['cashPaid'];
$this->soa_phic+=$row['phic'];

echo "<td>&nbsp;<font class='heading'>".$row['description']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".$row['quantity']."</font>&nbsp;</td>";
if($row['title'] == "PROFESSIONAL FEE") {
echo "<td>&nbsp;<font class='heading'></font>&nbsp;</td>";
$this->soa_pfCash+=$price[0];
}else {
$this->soa_sellingPrice+=$row['sellingPrice'];
echo "<td>&nbsp;<font class='heading'></font>&nbsp;</td>";
}
echo "<Td>&nbsp;<font class='heading'></font>&nbsp;</tD>";
if($row['discount'] > 0) {
echo "<td>&nbsp;<font class='heading'></font>&nbsp;</td>";
}else {
echo "<Td>&nbsp;</tD>";
}
echo "<td>&nbsp;<font class='heading'></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'></font>&nbsp;</td>";
echo "</tr>";
  }




/*
echo "<tr>";
echo "<Td><center><font class='heading'><b>TOTAL</b></font></center></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format(($this->soa_sellingPrice + $this->soa_pfCash),2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_discount,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_total,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_paid,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_company,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_phic,2)."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'><b>".number_format($this->soa_cashUnpaid,2)."</b></font>&nbsp;</td>";
echo "</table>";
echo "<br>__________________________<br><font size=2>Cashier / Billing</font><br>";
*/


}



public $phicPF_details_totalPF;
public $phicPF_details_cashUnpaid;
public $phicPF_details_phic;


public function phicPF_details_totalPF() {
return $this->phicPF_details_totalPF;
}

public function phicPF_details_cashUnpaid() {
return $this->phicPF_details_cashUnpaid;
}

public function phicPF_details_phic() {
return $this->phicPF_details_phic;
}

public function phicPF_details($itemNo) {

echo "<style type='text/css'>
#docPF:hover { background-color:yellow; color:black; }
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pc.total) as totalPF,sum(pc.cashUnpaid) as cashUnpaid,sum(pc.phic) as phic from patientCharges pc WHERE pc.itemNo = '$itemNo'  "); 

while($row = mysqli_fetch_array($result))
  {
$this->phicPF_details_totalPF = $row['totalPF'];
$this->phicPF_details_cashUnpaid = $row['cashUnpaid'];
$this->phicPF_details_phic = $row['phic'];
  }

}


public $phic_DrugsMeds_totalCharges;
public $phic_DrugsMed_totalPHIC;
public $phic_DrugsMed_totalUnpaid;

public function phic_DrugsMeds_totalCharges() {
return $this->phic_DrugsMeds_totalCharges;
}

public function phic_DrugsMeds_totalPHIC() {
return $this->phic_DrugsMeds_totalPHIC;
}

public function phic_DrugsMeds($switch,$identificationNo) {

echo "<style type='text/css'>
#docPF:hover { background-color:yellow; color:black; }
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($switch == 1) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pc.total) as total,sum(pc.phic) as totalPHIC from patientCharges pc WHERE pc.title = 'MEDICINE' and pc.registrationNo = '$identificationNo' and pc.status = 'UNPAID' "); 

}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pc.total) as total,sum(pc.phic) as totalPHIC from patientCharges pc WHERE pc.title = 'MEDICINE' and pc.itemNo = '$identificationNo' and pc.status = 'UNPAID' "); 
}
while($row = mysqli_fetch_array($result))
  {
$this->phic_DrugsMeds_totalCharges = $row['total'];
$this->phic_DrugsMeds_totalPHIC = $row['totalPHIC'];
 }

}

public $phic_OTHERS_totalCharges;
public $phic_OTHERS_totalPHIC;
public $phic_OTHERS_totalUnpaid;

public function phic_OTHERS_totalCharges() {
return $this->phic_OTHERS_totalCharges;
}

public function phic_OTHERS_totalPHIC() {
return $this->phic_OTHERS_totalPHIC;
}



public function phic_OTHERS($registrationNo) {

echo "<style type='text/css'>
#docPF:hover { background-color:yellow; color:black; }
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pc.total) as total,sum(pc.phic) as totalPHIC from patientCharges pc WHERE  pc.registrationNo = '$registrationNo' and (pc.title != 'MEDICINE' and pc.title != 'Room And Board' and pc.title != 'PROFESSIONAL FEE' and pc.status = 'UNPAID' ) "); 

while($row = mysqli_fetch_array($result))
  {
$this->phic_OTHERS_totalCharges = $row['total'];
$this->phic_OTHERS_totalPHIC = $row['totalPHIC'];
 }

}


public function searchSupplier($username,$searchme) {

$con=($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
((bool)mysqli_query($con, "USE " . $this->database));

echo "
<style type='text/css'>
<!--
.style1 {font-family: Arial;font-size: 14px;color: #000000;font-weight: bold;}
.style2 {font-family: Arial;font-size: 12px;color: #000000;font-weight: bold;}
.style3 {font-family: Arial;font-size: 14px;color: #0066FF;font-weight: bold;}
.style4 {font-family: Arial;font-size: 12px;color: #FFFFFF;font-weight: bold;}
.style5 {font-family: Arial;font-size: 12px;color: #FF0000;font-weight: bold;}
.style6 {font-family: Arial;font-size: 14px;color: #FF0000;font-weight: bold;}
.textfield1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;}
.button1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;}
.button2 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FFFFFF;background-color: #0066FF;border: 1px solid #000000;}
.button3 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FFFFFF;background-color: #FF9900;border: 1px solid #000000;}
.button4 {font-family: Arial;font-size: 12px;font-weight: bold;color: #999999;background-color: #FFFFFF;border: 1px solid #999999;}
.button5 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FF0000;background-color: #FFFFFF;border: 1px solid #FF0000;}
.button6 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FFFFFF;background-color: #0066FF;border: 1px solid #000000;height: 25px;}
tr:hover { background-color:yellow;color:black;}
-->
</style>

<table width='600' border='1' bordercolor='#000000' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='50' bgcolor='#0066FF'><div align='center' class='style4'>#</div></td>
    <td width='430' bgcolor='#0066FF'><div align='center' class='style4'>Supplier Name</div></td>
    <td width='60' bgcolor='#0066FF'><div align='center' class='style4'>Edit</div></td>
    <td width='60' bgcolor='#0066FF'><div align='center' class='style4'>Delete</div></td>
  </tr>
";

$aplus=1;
if($searchme=='ALL'){
$asql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT supplierCode, supplierName FROM supplier WHERE status='Active' ORDER BY supplierName");
}
else{
$asql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT supplierCode, supplierName FROM supplier WHERE supplierName LIKE '%$searchme%' AND status='Active' ORDER BY supplierName");
}

while($afetch=mysqli_fetch_array($asql)){
$supplierCode=$afetch['supplierCode'];
echo "
  <tr>
    <td><div align='center' class='style2'>".$aplus++."</div></td>
    <td><div align='left' class='style2'>&nbsp;".$afetch['supplierName']."</div></td>
    <td><div align='center'>
      <a href='EditSupplier.php?username=$username&supplierCode=$supplierCode' class='style4'><input type='button' name='Edit' class='button1' value='  E  ' /></a>
    </div></td>
    <td><div align='center'>
      <a href='DeleteSupplier.php?username=$username&supplierCode=$supplierCode' class='style4'><input type='button' name='Delete' class='button5' value='  X  ' /></a>
    </div></td>
  </tr>
";
}

echo "
  <tr>
    <td height='6' bgcolor='#0066FF'></td>
    <td height='6' bgcolor='#0066FF'></td>
    <td height='6' bgcolor='#0066FF'></td>
    <td height='6' bgcolor='#0066FF'></td>
  </tr>
</table>
<br /><br />
<a href='AddSupplier.php?username=$username' class='style3'><input type='button' name='AddSupplier' class='button6' value='Add Supplier' /></a>

";

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);
}



public $phicBack_3_totalCharges;
public $phicBack_3_totalPHIC;
public $phicBack_3_qty;


public function phicBack_3_totalCharges() {
return $this->phicBack_3_totalCharges;
}

public function phicBack_3_totalPHIC() {
return $this->phicBack_3_totalPHIC;
}

public function phicBack_3_qty() {
return $this->phicBack_3_qty;
}

public function phicBack_part3_ByTitle($itemNo,$title,$registrationNo) {

echo "<style type='text/css'>
#docPF:hover { background-color:yellow; color:black; }
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pc.quantity) as qty,sum(pc.total) as total,sum(pc.phic) as totalPHIC from patientCharges pc WHERE pc.title='$title' and pc.chargesCode = '$itemNo' and pc.registrationNo = '$registrationNo' and pc.status = 'UNPAID' "); 

while($row = mysqli_fetch_array($result))
  {
$this->phicBack_3_totalCharges = $row['total'];
$this->phicBack_3_totalPHIC = $row['totalPHIC'];
$this->phicBack_3_qty = $row['qty'];
  }

}





public $phicPF_month;
public $phicPF_day;
public $phicPF_year;
public $varCount=1;
public $accNo1=1;
public $accNo2=1;
public $accNo3=1;
public $accNo4=1;
public $accNo5=1;
public $accNo6=1;
public $accNo7=1;
public $accNo8=1;
public $accNo9=1;
public $accNo10=1;
public $accNo11=1;
public $accNo12=1;
public $doctorService=1;
public $doctorService_date=1;
public $actualDoctorCharges=1;
public $philhealthDoctorCharges=1;
public $amountPaidByMembers=1;
public $dateSigned=1;
public $phicUseOnly=1;
//pra sa doctors pf sa cf2
public function phicProfessionalFee($registrationNo) {

echo "<style type='text/css'>
#docPF:hover { background-color:yellow; color:black; }

.docName{
	border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 215px;
	border-color:white white black white;
	font-size:12px;
	text-align:center;

}

.docName1{
	border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 215px;
	border-color:white white black white;
	font-size:10px;
	text-align:center;

}


.docService{
	border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 195px;
	border-color:white white black white;
	font-size:12px;
	text-align:center;

}


.noBorder{
	border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 195px;
	border-color:white white white white;
	font-size:10px;
	text-align:center;

}

.accNo {
	border: 1px solid #000;
	color: #000;
	height: 18px;
	width: 14px;
	border-color:white black black black;
	text-align:center;
	font-size:12px;
}

.accNo1{
	border: 1px solid #000;
	color: #000;
	height: 18px;
	width: 14px;
	border-color:white black black white;
	text-align:center;
	font-size:12px;
}


.square{
	border: 1px solid #000;
	color: #000;
	height: 58px;
	width: 90px;
	border-color:white white white white;
	text-align:center;
	font-size:12px;
}

</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.*,d.* from patientCharges pc,Doctors d WHERE pc.registrationNo='$registrationNo' and pc.title='PROFESSIONAL FEE' and pc.phic > 0 and pc.chargesCode = d.doctorCode order by d.orderz asc  ");

while($row = mysqli_fetch_array($result))
  {

$dateCharge = preg_split ("/\_/", $row['dateCharge']); 
$accNo = preg_split ("/\-/", $row['PhilHealth_AccreditationNo']); 
$varName = "doctorName".$this->varCount++;
$accNo_1 = "accNo_1_".$this->accNo1++;
$accNo_2 = "accNo_2_".$this->accNo2++;
$accNo_3 = "accNo_3_".$this->accNo3++;
$accNo_4 = "accNo_4_".$this->accNo4++;
$accNo_5 = "accNo_5_".$this->accNo5++;
$accNo_6 = "accNo_6_".$this->accNo6++;
$accNo_7 = "accNo_7_".$this->accNo7++;
$accNo_8 = "accNo_8_".$this->accNo8++;
$accNo_9 = "accNo_9_".$this->accNo9++;
$accNo_10 = "accNo_10_".$this->accNo10++;
$accNo_11 = "accNo_11_".$this->accNo11++;
$accNo_12 = "accNo_12_".$this->accNo12++;
$doctorService = "doctorService".$this->doctorService++;
$doctorService_date = "doctorService_date".$this->doctorService_date++;
$actualDoctorCharges = "actualDoctorCharges".$this->actualDoctorCharges++;
$philhealthDoctorCharges = "philhealthDoctorCharges".$this->philhealthDoctorCharges++;
$amountPaidByMembers = "amountPaidByMembers".$this->amountPaidByMembers++;
$dateSigned = "dateSigned".$this->dateSigned++;
$phicUseOnly = "phicUseOnly".$this->phicUseOnly++;
echo "<tr id='docPF' >";
$this->phicPF_details($row['itemNo']);

if( $row['description'] == "LECHONSITO, JOSEPH GEORGE L." ) {
echo "<td><input class='docName1' type=text value='".$row['description']."'><Br>&nbsp;<input type=text class='accNo' value='".substr($accNo[0],-4,1)."'><input type=text class='accNo1' value='".substr($accNo[0],-3,1)."'><input type=text class='accNo1' value='".substr($accNo[0],-2,1)."'><input type=text class='accNo1' maxlength=1 value='".substr($accNo[0],-1,1)."'>-
<input type=text maxlength=1 class='accNo' value='".substr($accNo[1],-7,1)."'><input type=text maxlength=1 class='accNo1' value='".substr($accNo[1],-6,1)."'><input type=text maxlength=1 class='accNo1' value='".substr($accNo[1],-5,1)."'><input type=text maxlength=1 class='accNo1' value='".substr($accNo[1],-4,1)."'><input type=text maxlength=1 class='accNo1' value='".substr($accNo[1],-3,1)."'><input type=text maxlength=1 class='accNo1' value='".substr($accNo[1],-2,1)."'><input type=text maxlength=1 class='accNo1' value='".substr($accNo[1],-1,1)."'>-
<input type=text maxlength=1 class='accNo' value='".substr($accNo[2],-1,1)."'>
</td>";
}else {
echo "<td><input class='docName' name='$varName' type=text value='".$row['description']."'><Br>&nbsp;
<input type=text class='accNo' name='$accNo_1' value='".substr($accNo[0],-4,1)."'><input type=text class='accNo1' name='$accNo_2' value='".substr($accNo[0],-3,1)."'><input type=text class='accNo1' name='$accNo_3' value='".substr($accNo[0],-2,1)."'><input type=text class='accNo1' name='$accNo_4' maxlength=1 value='".substr($accNo[0],-1,1)."'>-<input type=text maxlength=1 class='accNo'  name='$accNo_5' value='".substr($accNo[1],-7,1)."'><input type=text maxlength=1 class='accNo1' name='$accNo_6' value='".substr($accNo[1],-6,1)."'><input type=text maxlength=1 class='accNo1' name='$accNo_7' value='".substr($accNo[1],-5,1)."'><input type=text maxlength=1 class='accNo1' name='$accNo_8' value='".substr($accNo[1],-4,1)."'><input type=text maxlength=1 class='accNo1' name='$accNo_9' value='".substr($accNo[1],-3,1)."'><input type=text maxlength=1 class='accNo1' name='$accNo_10' value='".substr($accNo[1],-2,1)."'><input type=text maxlength=1 class='accNo1' name='$accNo_11' value='".substr($accNo[1],-1,1)."'>-<input type=text maxlength=1 class='accNo'  name='$accNo_12' value='".substr($accNo[2],-1,1)."'>
</td>";
}

if($dateCharge[0] == "Jan") {
$this->phicPF_month = "01";
}else if($dateCharge[0] == "Feb") {
$this->phicPF_month = "02";
}else if($dateCharge[0] == "Mar") {
$this->phicPF_month = "03";
}else if($dateCharge[0] == "Apr") {
$this->phicPF_month = "04";
}else if($dateCharge[0] == "May") {
$this->phicPF_month = "05";
}else if($dateCharge[0] == "Jun") {
$this->phicPF_month = "06";
}else if($dateCharge[0] == "Jul") {
$this->phicPF_month = "07";
}else if($dateCharge[0] == "Aug") {
$this->phicPF_month = "08";
}else if($dateCharge[0] == "Sep") {
$this->phicPF_month = "09";
}else if($dateCharge[0] == "Oct") {
$this->phicPF_month = "10";
}else if($dateCharge[0] == "Nov") {
$this->phicPF_month = "11";
}else if($dateCharge[0] == "Dec") {
$this->phicPF_month = "12";
}else {
echo "";
}
$this->getPatientProfile($registrationNo);
$dateRegistered = preg_split ("/\_/", $this->getRegistrationDetails_dateRegistered()); 
echo "<td><input type='text' class='docService' name='$doctorService' value='".$row['service']."'><Br><input type=text class='noBorder' name='$doctorService_date' value='".$this->getRegistrationDetails_dateRegistered()." to ".$this->getRegistrationDetails_dateUnregistered()."'></td>";

echo "<td><input type=text class='square' name='$actualDoctorCharges' value='P ".number_format($this->phicPF_details_totalPF(),2)."'></td>";
echo "<td><input type=text class='square' name='$philhealthDoctorCharges' value='P ".number_format($this->phicPF_details_phic(),2)."'></td>";
echo "<td><input type=text class='square' name='$amountPaidByMembers' value='P ".number_format($this->phicPF_details_cashUnpaid(),2)."'></td>";
echo "<td><input type=text class='square' name='$dateSigned' value=''></td>";
echo "<td><input type=text class='square' name='$phicUseOnly' value=''></td>";
echo "</tr>";

}


if( mysqli_num_rows($result) == 1 ) {

echo "<tr>";
echo "<td><input class='docName' type=text name='doctorName2' value=''><Br>&nbsp;<input type=text class='accNo' name='accNo_1_2' value='&nbsp;&nbsp;'><input type=text class='accNo1' name='accNo_2_2' value='&nbsp;&nbsp;'><input type=text class='accNo1' name='accNo_3_2' value='&nbsp;&nbsp;'><input type=text class='accNo1' maxlength=1 name='accNo_4_2' value='&nbsp;&nbsp;'>-
<input type=text maxlength=1 class='accNo' name='accNo_5_2' value='&nbsp;&nbsp;'><input type=text maxlength=1 class='accNo1' name='accNo_6_2' value='&nbsp;&nbsp;'><input type=text maxlength=1 class='accNo1' name='accNo_7_2' value='&nbsp;&nbsp;'><input type=text maxlength=1 class='accNo1' name='accNo_8_2' value='&nbsp;&nbsp;'><input type=text maxlength=1 class='accNo1' name='accNo_9_2' value='&nbsp;&nbsp;'><input type=text maxlength=1 class='accNo1' name='accNo_10_2' value='&nbsp;&nbsp;'><input type=text maxlength=1 class='accNo1' name='accNo_11_2' value='&nbsp;&nbsp;'>-
<input type=text maxlength=1 class='accNo' name='accNo_12_2' value='&nbsp;&nbsp;'>
</td>";
echo "<td><input type='text' class='docService' name='doctorService2' value=''><Br><input type=text class='noBorder' name='doctorService_date2' value=''></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<td><input class='docName' type=text name='doctorName3' value=''><Br>&nbsp;<input type=text class='accNo' name='accNo_1_3' value=''><input type=text class='accNo1' name='accNo_2_3' value=''><input type=text class='accNo1' name='accNo_3_3' value=''><input type=text class='accNo1' maxlength=1 name='accNo_4_3' value=''>-
<input type=text maxlength=1 class='accNo' name='accNo_5_3' value=''><input type=text maxlength=1 class='accNo1' name='accNo_6_3' value=''><input type=text maxlength=1 class='accNo1' name='accNo_7_3' value=''><input type=text maxlength=1 class='accNo1' name='accNo_8_3' value=''><input type=text maxlength=1 class='accNo1' name='accNo_9_3' value=''><input type=text maxlength=1 class='accNo1' name='accNo_10_3' value=''><input type=text maxlength=1 class='accNo1' name='accNo_11_3' value=''>-
<input type=text maxlength=1 class='accNo' name='accNo_12_3' value=''>
</td>";
echo "<td><input type='text' class='docService' value=''><Br><input type=text class='noBorder' value=''></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<td><input class='docName' type=text name='doctorName4' value=''><Br>&nbsp;<input type=text class='accNo' name='accNo_1_4' value=''><input type=text class='accNo1' name='accNo_2_4' value=''><input type=text class='accNo1' name='accNo_3_4' value=''><input type=text class='accNo1' maxlength=1 name='accNo_4_4' value=''>-
<input type=text maxlength=1 class='accNo' name='accNo_5_4' value=''><input type=text maxlength=1 class='accNo1' name='accNo_6_4' value=''><input type=text maxlength=1 class='accNo1' name='accNo_7_4' value=''><input type=text maxlength=1 class='accNo1' name='accNo_8_4' value=''><input type=text maxlength=1 class='accNo1' name='accNo_9_4' value=''><input type=text maxlength=1 class='accNo1' name='accNo_10_4' value=''><input type=text maxlength=1 class='accNo1' name='accNo_11_4' value=''>-
<input type=text maxlength=1 class='accNo' name='accNo_12_4' value=''>
</td>";
echo "<td><input type='text' class='docService' value=''><Br><input type=text class='noBorder' value=''></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

} // if mysql_num_rows 1


else if( mysqli_num_rows($result) == 2 ) {

echo "<tr>";
echo "<td><input class='docName' name='doctorName3' type=text value=''><Br>&nbsp;<input type=text class='accNo' name='accNo_1_3' value=''><input type=text class='accNo1' name='accNo_2_3' value=''><input type=text class='accNo1' name='accNo_3_3' value=''><input type=text class='accNo1' maxlength=1 name='accNo_4_3' value=''>-
<input type=text maxlength=1 class='accNo' name='accNo_5_3' value=''><input type=text maxlength=1 class='accNo1' name='accNo_6_3' value=''><input type=text maxlength=1 name='accNo_7_3' class='accNo1' value=''><input type=text maxlength=1 name='accNo_8_3' class='accNo1' value=''><input type=text maxlength=1 name='accNo_9_3' class='accNo1' value=''><input type=text maxlength=1 name='accNo_10_3' class='accNo1' value=''><input type=text maxlength=1 name='accNo_11_3' class='accNo1' value=''>-
<input type=text maxlength=1 class='accNo' name='accNo_12_3' value=''>
</td>";
echo "<td><input type='text' class='docService' value=''><Br><input type=text class='noBorder' value=''></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<td><input class='docName' name='doctorName4' type=text value=''><Br>&nbsp;<input type=text class='accNo' name='accNo_1_4' value=''><input type=text class='accNo1' name='accNo_2_4' value=''><input type=text class='accNo1' name='accNo_3_4' value=''><input type=text class='accNo1' maxlength=1 name='accNo_4_4' value=''>-
<input type=text maxlength=1 class='accNo' name='accNo_5_4' value=''><input type=text maxlength=1 class='accNo1' name='accNo_6_4' value=''><input type=text maxlength=1 class='accNo1' name='accNo_7_4' value=''><input type=text maxlength=1 class='accNo1' name='accNo_8_4' value=''><input type=text maxlength=1 class='accNo1' name='accNo_9_4' value=''><input type=text maxlength=1 class='accNo1' name='accNo_10_4' value=''><input type=text maxlength=1 class='accNo1' name='accNo_11_4' value=''>-
<input type=text maxlength=1 class='accNo' name='accNo_12_4' value=''>
</td>";
echo "<td><input type='text' class='docService' value=''><Br><input type=text class='noBorder' value=''></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

} // if mysql_num_rows 2


else if( mysqli_num_rows($result) == 3 ) {

echo "<tr>";
echo "<td><input class='docName' name='doctorName4' type=text value=''><Br>&nbsp;<input type=text class='accNo' name='accNo_1_4' value=''><input type=text class='accNo1' name='accNo_2_4' value=''><input type=text class='accNo1' name='accNo_3_4' value=''><input type=text class='accNo1' maxlength=1 name='accNo_4_4' value=''>-
<input type=text maxlength=1 class='accNo' name='accNo_5_4' value=''><input type=text maxlength=1 class='accNo1' name='accNo_6_4' value=''><input type=text maxlength=1 class='accNo1' name='accNo_7_4' value=''><input type=text maxlength=1 class='accNo1' name='accNo_8_4' value=''><input type=text maxlength=1 class='accNo1' name='accNo_9_4' value=''><input type=text maxlength=1 class='accNo1' name='accNo_10_4' value=''><input type=text maxlength=1 class='accNo1' name='accNo_11_4' value=''>-
<input type=text maxlength=1 class='accNo' name='accNo_12_4' value=''>
</td>";
echo "<td><input type='text' class='docService' value=''><Br><input type=text class='noBorder' value=''></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

} // if mysql_num_rows 3


else {

echo "<tr>";
echo "<td>
<input 
style='

border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 230px;
	border-color:white white black white;
	font-size:12px;
	text-align:center;


'
type=text name='doctorName1' value=''><Br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=text class='accNo' name='accNo_1_1' value=''><input type=text class='accNo1' name='accNo_2_1' value=''><input type=text class='accNo1' name='accNo_3_1' value=''><input type=text class='accNo1' maxlength=1 name='accNo_4_1' value=''>-
<input type=text maxlength=1 class='accNo' name='accNo_5_1' value=''><input type=text maxlength=1 class='accNo1' name='accNo_6_1' value=''><input type=text maxlength=1 class='accNo1' name='accNo_7_1' value=''><input type=text maxlength=1 class='accNo1' name='accNo_8_1' value=''><input type=text maxlength=1 class='accNo1' name='accNo_9_1' value=''><input type=text maxlength=1 class='accNo1' name='accNo_10_1' value=''><input type=text maxlength=1 class='accNo1' name='accNo_11_1' value=''>-
<input type=text maxlength=1 class='accNo' name='accNo_12_1' value=''>
</td>";

echo "<td><input type='text'
style='

	border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 230px;
	border-color:white white black white;
	font-size:12px;
	text-align:center;

'
value=''><Br><input type=text class='noBorder' value=''></td>";
echo "<td><input type='text' style='

	border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 75px;
	border-color:white white white white;
	font-size:10px;
	text-align:center;

' ></td>";
echo "<td><input type='text'

style='

	border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 75px;
	border-color:white white white white;
	font-size:10px;
	text-align:center;

'

> &nbsp;</td>";
echo "<td> <input type='text'

style='

	border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 75px;
	border-color:white white white white;
	font-size:10px;
	text-align:center;

'

 > &nbsp;</td>";
echo "<td><input type='text'

style='

	border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 75px;
	border-color:white white white white;
	font-size:10px;
	text-align:center;

'

>&nbsp;</td>";
echo "<td><input type='text'

style='

	border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 75px;
	border-color:white white white white;
	font-size:10px;
	text-align:center;

'

>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<td><input 

style='

border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 230px;
	border-color:white white black white;
	font-size:12px;
	text-align:center;


'


type=text name='doctorName2' value=''><Br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=text class='accNo' name='accNo_1_2' value=''><input type=text class='accNo1' name='accNo_2_2' value=''><input type=text class='accNo1' name='accNo_3_2' value=''><input type=text class='accNo1' maxlength=1 name='accNo_4_2' value=''>-
<input type=text maxlength=1 class='accNo' name='accNo_5_2' value=''><input type=text maxlength=1 class='accNo1' name='accNo_6_2' value=''><input type=text maxlength=1 class='accNo1' name='accNo_7_2' value=''><input type=text maxlength=1 class='accNo1' name='accNo_8_2' value=''><input type=text maxlength=1 class='accNo1' name='accNo_9_2' value=''><input type=text maxlength=1 class='accNo1' name='accNo_10_2' value=''><input type=text maxlength=1 class='accNo1' name='accNo_11_2' value=''>-
<input type=text maxlength=1 class='accNo' name='accNo_12_2' value=''>
</td>";
echo "<td><input type='text'
style='

	border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 230px;
	border-color:white white black white;
	font-size:12px;
	text-align:center;

'
value=''><Br><input type=text class='noBorder' value=''></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<td><input 

style='

border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 230px;
	border-color:white white black white;
	font-size:12px;
	text-align:center;


'


 type=text name='doctorName3' value=''><Br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=text class='accNo' name='accNo_1_3' value=''><input type=text class='accNo1' name='accNo_2_3' value=''><input type=text class='accNo1' name='accNo_3_3' value=''><input type=text class='accNo1' maxlength=1 name='accNo_4_3' value=''>-
<input type=text maxlength=1 class='accNo' name='accNo_5_3' value=''><input type=text maxlength=1 class='accNo1' name='accNo_6_3' value=''><input type=text maxlength=1 class='accNo1' name='accNo_7_3' value=''><input type=text maxlength=1 name='accNo_8_3' class='accNo1' value=''><input type=text maxlength=1 class='accNo1' name='accNo_9_3' value=''><input type=text maxlength=1 name='accNo_10_3' class='accNo1' value=''><input type=text maxlength=1 class='accNo1' name='accNo_11_3' value=''>-
<input type=text maxlength=1 class='accNo' name='accNo_12_3' value=''>
</td>";
echo "<td><input type='text' 

style='

border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 230px;
	border-color:white white black white;
	font-size:12px;
	text-align:center;


'


 value=''><Br><input type=text class='noBorder' value=''></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<td><input 

style='

border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 230px;
	border-color:white white black white;
	font-size:12px;
	text-align:center;


'


type=text name='doctorName4' value=''><Br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=text class='accNo' name='accNo_1_4' value=''><input type=text class='accNo1' name='accNo_2_4' value=''><input type=text class='accNo1' name='accNo_3_4' value=''><input type=text class='accNo1' maxlength=1 name='accNo_4_4' value=''>-
<input type=text maxlength=1 class='accNo' name='accNo_5_4' value=''><input type=text maxlength=1 class='accNo1' name='accNo_6_4' value=''><input type=text maxlength=1 class='accNo1' name='accNo_7_4' value=''><input type=text maxlength=1 class='accNo1' name='accNo_8_4' value=''><input type=text maxlength=1 class='accNo1' name='accNo_9_4' value=''><input type=text maxlength=1 class='accNo1' name='accNo_10_4' value=''><input type=text maxlength=1 class='accNo1' name='accNo_11_4' value=''>-
<input type=text maxlength=1 class='accNo' name='accNo_12_4' value=''>
</td>";
echo "<td><input type='text'
style='

	border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 230px;
	border-color:white white black white;
	font-size:12px;
	text-align:center;

'
value=''><Br><input type=text class='noBorder' value=''></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

}


}



public function phicProfessionalFeePackage($registrationNo) {

echo "<style type='text/css'>
#docPF:hover { background-color:yellow; color:black; }

.docName{
	border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 215px;
	border-color:white white black white;
	font-size:15px;
	text-align:center;

}

.docName1{
	border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 215px;
	border-color:white white black white;
	font-size:12px;
	text-align:center;

}

.docService{
	border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 195px;
	border-color:white white black white;
	font-size:15px;
	text-align:center;

}


.noBorder{
	border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 195px;
	border-color:white white white white;
	font-size:12px;
	text-align:center;

}

.accNo {
	border: 1px solid #000;
	color: #000;
	height: 18px;
	width: 14px;
	border-color:white black black black;
	text-align:center;
	font-size:15px;
}

.accNo1{
	border: 1px solid #000;
	color: #000;
	height: 18px;
	width: 14px;
	border-color:white black black white;
	text-align:center;
	font-size:15px;
}


.square{
	border: 1px solid #000;
	color: #000;
	height: 58px;
	width: 90px;
	border-color:white white white white;
	text-align:center;
	font-size:12px;
}

</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.*,d.* from patientCharges pc,Doctors d WHERE pc.registrationNo='$registrationNo' and pc.title='PROFESSIONAL FEE' and pc.phic > 0 and pc.chargesCode = d.doctorCode order by d.orderz asc  ");

while($row = mysqli_fetch_array($result))
  {

$dateCharge = preg_split ("/\_/", $row['dateCharge']); 
$accNo = preg_split ("/\-/", $row['PhilHealth_AccreditationNo']); 


echo "<tr id='docPF'>";
$this->phicPF_details($row['itemNo']);

if( $row['description'] == "LECHONSITO, JOSEPH GEORGE L." ) {
echo "<td><input class='docName1' type=text value='".$row['description']."'><Br>&nbsp;<input type=text class='accNo' value='".substr($accNo[0],-4,1)."'><input type=text class='accNo1' value='".substr($accNo[0],-3,1)."'><input type=text class='accNo1' value='".substr($accNo[0],-2,1)."'><input type=text class='accNo1' maxlength=1 value='".substr($accNo[0],-1,1)."'>-
<input type=text maxlength=1 class='accNo' value='".substr($accNo[1],-7,1)."'><input type=text maxlength=1 class='accNo1' value='".substr($accNo[1],-6,1)."'><input type=text maxlength=1 class='accNo1' value='".substr($accNo[1],-5,1)."'><input type=text maxlength=1 class='accNo1' value='".substr($accNo[1],-4,1)."'><input type=text maxlength=1 class='accNo1' value='".substr($accNo[1],-3,1)."'><input type=text maxlength=1 class='accNo1' value='".substr($accNo[1],-2,1)."'><input type=text maxlength=1 class='accNo1' value='".substr($accNo[1],-1,1)."'>-
<input type=text maxlength=1 class='accNo' value='".substr($accNo[2],-1,1)."'>
</td>";
}else {
echo "<td><input class='docName' type=text value='".$row['description']."'><Br>&nbsp;<input type=text class='accNo' value='".substr($accNo[0],-4,1)."'><input type=text class='accNo1' value='".substr($accNo[0],-3,1)."'><input type=text class='accNo1' value='".substr($accNo[0],-2,1)."'><input type=text class='accNo1' maxlength=1 value='".substr($accNo[0],-1,1)."'>-
<input type=text maxlength=1 class='accNo' value='".substr($accNo[1],-7,1)."'><input type=text maxlength=1 class='accNo1' value='".substr($accNo[1],-6,1)."'><input type=text maxlength=1 class='accNo1' value='".substr($accNo[1],-5,1)."'><input type=text maxlength=1 class='accNo1' value='".substr($accNo[1],-4,1)."'><input type=text maxlength=1 class='accNo1' value='".substr($accNo[1],-3,1)."'><input type=text maxlength=1 class='accNo1' value='".substr($accNo[1],-2,1)."'><input type=text maxlength=1 class='accNo1' value='".substr($accNo[1],-1,1)."'>-
<input type=text maxlength=1 class='accNo' value='".substr($accNo[2],-1,1)."'>
</td>";

}

if($dateCharge[0] == "Jan") {
$this->phicPF_month = "01";
}else if($dateCharge[0] == "Feb") {
$this->phicPF_month = "02";
}else if($dateCharge[0] == "Mar") {
$this->phicPF_month = "03";
}else if($dateCharge[0] == "Apr") {
$this->phicPF_month = "04";
}else if($dateCharge[0] == "May") {
$this->phicPF_month = "05";
}else if($dateCharge[0] == "Jun") {
$this->phicPF_month = "06";
}else if($dateCharge[0] == "Jul") {
$this->phicPF_month = "07";
}else if($dateCharge[0] == "Aug") {
$this->phicPF_month = "08";
}else if($dateCharge[0] == "Sep") {
$this->phicPF_month = "09";
}else if($dateCharge[0] == "Oct") {
$this->phicPF_month = "10";
}else if($dateCharge[0] == "Nov") {
$this->phicPF_month = "11";
}else if($dateCharge[0] == "Dec") {
$this->phicPF_month = "12";
}else {
echo "";
}
$this->getPatientProfile($registrationNo);
$dateRegistered = preg_split ("/\_/", $this->getRegistrationDetails_dateRegistered()); 
echo "<td><input type='text' class='docService' value='".$row['service']."'><Br><input type=text class='noBorder' value='".$this->getRegistrationDetails_dateRegistered()." to ".$this->getRegistrationDetails_dateUnregistered()."'></td>";

echo "<td><input type=text class='square' value='P 0.00'></td>";
echo "<td><input type=text class='square' value='P 0.00'></td>";
echo "<td><input type=text class='square' value='P 0.00'></td>";
echo "<td><input type=text class='square' value=''></td>";
echo "<td><input type=text class='square' value=''></td>";
echo "</tr>";

}


if( mysqli_num_rows($result) == 1 ) {

echo "<tr>";

if( $row['description'] == "LECHONSITO, JOSEPH GEORGE L." ) {
echo "<td><input class='docName1' type=text value=''><Br>&nbsp;<input type=text class='accNo' value=''><input type=text class='accNo1' value=''><input type=text class='accNo1' value=''><input type=text class='accNo1' maxlength=1 value=''>-
<input type=text maxlength=1 class='accNo' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''>-
<input type=text maxlength=1 class='accNo' value=''>
</td>";
echo "<td><input type='text' class='docService' value=''><Br><input type=text class='noBorder' value=''></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

}else {

echo "<td><input class='docName' type=text value=''><Br>&nbsp;<input type=text class='accNo' value=''><input type=text class='accNo1' value=''><input type=text class='accNo1' value=''><input type=text class='accNo1' maxlength=1 value=''>-
<input type=text maxlength=1 class='accNo' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''>-
<input type=text maxlength=1 class='accNo' value=''>
</td>";
echo "<td><input type='text' class='docService' value=''><Br><input type=text class='noBorder' value=''></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

}



echo "<tr>";
echo "<td><input class='docName' type=text value=''><Br>&nbsp;<input type=text class='accNo' value=''><input type=text class='accNo1' value=''><input type=text class='accNo1' value=''><input type=text class='accNo1' maxlength=1 value=''>-
<input type=text maxlength=1 class='accNo' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''>-
<input type=text maxlength=1 class='accNo' value=''>
</td>";
echo "<td><input type='text' class='docService' value=''><Br><input type=text class='noBorder' value=''></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<td><input class='docName' type=text value=''><Br>&nbsp;<input type=text class='accNo' value=''><input type=text class='accNo1' value=''><input type=text class='accNo1' value=''><input type=text class='accNo1' maxlength=1 value=''>-
<input type=text maxlength=1 class='accNo' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''>-
<input type=text maxlength=1 class='accNo' value=''>
</td>";
echo "<td><input type='text' class='docService' value=''><Br><input type=text class='noBorder' value=''></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

} // if mysql_num_rows 1

else if( mysqli_num_rows($result) == 2 ) {

echo "<tr>";
echo "<td><input class='docName' type=text value=''><Br>&nbsp;<input type=text class='accNo' value=''><input type=text class='accNo1' value=''><input type=text class='accNo1' value=''><input type=text class='accNo1' maxlength=1 value=''>-
<input type=text maxlength=1 class='accNo' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''>-
<input type=text maxlength=1 class='accNo' value=''>
</td>";
echo "<td><input type='text' class='docService' value=''><Br><input type=text class='noBorder' value=''></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<td><input class='docName' type=text value=''><Br>&nbsp;<input type=text class='accNo' value=''><input type=text class='accNo1' value=''><input type=text class='accNo1' value=''><input type=text class='accNo1' maxlength=1 value=''>-
<input type=text maxlength=1 class='accNo' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''>-
<input type=text maxlength=1 class='accNo' value=''>
</td>";
echo "<td><input type='text' class='docService' value=''><Br><input type=text class='noBorder' value=''></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

} // if mysql_num_rows 2


else if( mysqli_num_rows($result) == 3 ) {

echo "<tr>";
echo "<td><input class='docName' type=text value=''><Br>&nbsp;<input type=text class='accNo' value=''><input type=text class='accNo1' value=''><input type=text class='accNo1' value=''><input type=text class='accNo1' maxlength=1 value=''>-
<input type=text maxlength=1 class='accNo' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''>-
<input type=text maxlength=1 class='accNo' value=''>
</td>";
echo "<td><input type='text' class='docService' value=''><Br><input type=text class='noBorder' value=''></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

} // if mysql_num_rows 3



else {

echo "<tr>";
echo "<td>
<input 
style='

border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 230px;
	border-color:white white black white;
	font-size:12px;
	text-align:center;


'
type=text value=''><Br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=text class='accNo' value=''><input type=text class='accNo1' value=''><input type=text class='accNo1' value=''><input type=text class='accNo1' maxlength=1 value=''>-
<input type=text maxlength=1 class='accNo' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''>-
<input type=text maxlength=1 class='accNo' value=''>
</td>";

echo "<td><input type='text'
style='

	border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 230px;
	border-color:white white black white;
	font-size:12px;
	text-align:center;

'
value=''><Br><input type=text class='noBorder' value=''></td>";
echo "<td><input type='text' style='

	border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 75px;
	border-color:white white white white;
	font-size:10px;
	text-align:center;

' ></td>";
echo "<td><input type='text'

style='

	border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 75px;
	border-color:white white white white;
	font-size:10px;
	text-align:center;

'

> &nbsp;</td>";
echo "<td> <input type='text'

style='

	border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 75px;
	border-color:white white white white;
	font-size:10px;
	text-align:center;

'

 > &nbsp;</td>";
echo "<td><input type='text'

style='

	border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 75px;
	border-color:white white white white;
	font-size:10px;
	text-align:center;

'

>&nbsp;</td>";
echo "<td><input type='text'

style='

	border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 75px;
	border-color:white white white white;
	font-size:10px;
	text-align:center;

'

>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<td><input 

style='

border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 230px;
	border-color:white white black white;
	font-size:12px;
	text-align:center;


'


type=text value=''><Br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=text class='accNo' value=''><input type=text class='accNo1' value=''><input type=text class='accNo1' value=''><input type=text class='accNo1' maxlength=1 value=''>-
<input type=text maxlength=1 class='accNo' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''>-
<input type=text maxlength=1 class='accNo' value=''>
</td>";
echo "<td><input type='text'
style='

	border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 230px;
	border-color:white white black white;
	font-size:12px;
	text-align:center;

'
value=''><Br><input type=text class='noBorder' value=''></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<td><input 

style='

border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 230px;
	border-color:white white black white;
	font-size:12px;
	text-align:center;


'


 type=text value=''><Br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=text class='accNo' value=''><input type=text class='accNo1' value=''><input type=text class='accNo1' value=''><input type=text class='accNo1' maxlength=1 value=''>-
<input type=text maxlength=1 class='accNo' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''>-
<input type=text maxlength=1 class='accNo' value=''>
</td>";
echo "<td><input type='text' 

style='

border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 230px;
	border-color:white white black white;
	font-size:12px;
	text-align:center;


'


 value=''><Br><input type=text class='noBorder' value=''></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<td><input 

style='

border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 230px;
	border-color:white white black white;
	font-size:12px;
	text-align:center;


'


type=text value=''><Br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=text class='accNo' value=''><input type=text class='accNo1' value=''><input type=text class='accNo1' value=''><input type=text class='accNo1' maxlength=1 value=''>-
<input type=text maxlength=1 class='accNo' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''><input type=text maxlength=1 class='accNo1' value=''>-
<input type=text maxlength=1 class='accNo' value=''>
</td>";
echo "<td><input type='text'
style='

	border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 230px;
	border-color:white white black white;
	font-size:12px;
	text-align:center;

'
value=''><Br><input type=text class='noBorder' value=''></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

}







  }


public $phicBack_meds_qty;
public $phicBack_meds_actualCharges;
public $phicBack_meds_phicBenefits;

public function phicBack_meds_qty() {
return $this->phicBack_meds_qty;
}
public function phicBack_meds_actualCharges() {
return $this->phicBack_meds_actualCharges;
}
public function phicBack_meds_phicBenefits() {
return $this->phicBack_meds_phicBenefits;
}



public function phicBack_meds_group($registrationNo,$chargesCode) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pc.quantity) as qty,sum(pc.total) as total,sum(pc.phic) as totalPHIC from patientCharges pc WHERE pc.registrationNo='$registrationNo' and pc.chargesCode = '$chargesCode' and pc.title = 'MEDICINE' and pc. status = 'UNPAID' and phic > 0   "); 

while($row = mysqli_fetch_array($result))
  {
$this->phicBack_meds_qty = $row['qty'];
$this->phicBack_meds_actualCharges = $row['total'];
$this->phicBack_meds_phicBenefits = $row['totalPHIC'];
  }


}


public $phicBack_meds_totalActualCharges;
public $phicBack_meds_totalPHIC;


public function phicBack_meds_totalActualCharges() {
return $this->phicBack_meds_totalActualCharges;
}

public function phicBack_meds_totalPHIC() {
return $this->phicBack_meds_totalPHIC;
}

private $phicBack_meds_desc=1;
private $phicBack_meds_preparation_PDF=1;
private $phicBack_meds_qty_PDF=1;
private $phicBack_meds_unitPrice_PDF=1;
private $phicBack_meds_actualCharges_PDF=1;
private $phicBack_meds_phicBenefits_PDF=1;
public function phicBack_meds($registrationNo) {

echo "<style type='text/css'>
#phic:hover { background-color:yellow; color:black; }



.desc{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 310px;
	border-color:white white white white;
	font-size:15px;
	text-align:center;
}

.preparation{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 167px;
	border-color:white white white white;
	font-size:15px;
	text-align:center;
}


.qty{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 67px;
	border-color:white white white white;
	font-size:15px;
	text-align:center;
}

.phic{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 95px;
	border-color:white white white white;
	font-size:15px;
	text-align:center;
}

</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));
//selectNow($table,$cols,$identifier,$identifierData)
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.* from patientCharges pc WHERE pc.registrationNo = '$registrationNo' and pc.title = 'MEDICINE' and pc.phic > 0 and status = 'UNPAID' group by pc.chargesCode   "); 

echo "<table align='center' width='860' border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<td width='35%'><center><font size=4>Generic/Brand Name</font></center></td>";
echo "<td width='20%'><center><font size=4>Preparation</font><br><font size=1>(dose/cap/syrup/injectible<br>/tab with ml/mg/gm content)</font></center></td>";
echo "<Td width='5%'><center><font size=4>Qty</font></center></tD>";
echo "<td width='10%'><center><font size=4>Unit Price</font></center></td>";
echo "<td width='10%'><Center><font size=3>Actual<br>Charges</font></center></td>";
echo "<td width='10%'><center><font size=3>PhilHealth<br>Benefit</font></center></td>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {

$this->phic_DrugsMeds("2",$row['itemNo']);
$this->phicBack_meds_group($row['registrationNo'],$row['chargesCode']);
echo "<tr>";
$this->phicBack_meds_totalActualCharges += $this->phicBack_meds_actualCharges();
$this->phicBack_meds_totalPHIC += $this->phicBack_meds_phicBenefits();

$desc = "phicBack_meds_desc".$this->phicBack_meds_desc++;
$preparation = "phicBack_meds_preparation".$this->phicBack_meds_preparation_PDF++;
$qtyPDF = "phicBack_meds_qty".$this->phicBack_meds_qty_PDF++;
$unitPricePDF = "phicBack_meds_unitPrice".$this->phicBack_meds_unitPrice_PDF++;
$actualChargesPDF = "phicBack_meds_actualCharges".$this->phicBack_meds_actualCharges_PDF++;
$phicBenefitsPDF = "phicBack_meds_phicBenefits".$this->phicBack_meds_phicBenefits_PDF++;

echo "<Td><input type=text class='desc' name='$desc' value='".$this->selectNow("inventory","genericName","inventoryCode",$row['chargesCode'])."/".$row['description']."'></td>";
echo "<Td><input type=text class='preparation' name='$preparation' value='".$this->selectNow("inventory","preparation","inventoryCode",$row['chargesCode'])."'></td>";
echo "<Td><input type=text class='qty'  name='$qtyPDF' value='".$this->phicBack_meds_qty()."'></td>";
echo "<Td><input type=text class='phic' name='$unitPricePDF' value='P ".number_format($row['sellingPrice'],2)."'></td>";
echo "<Td><input type=text class='phic' name='$actualChargesPDF' value='P ".number_format($this->phicBack_meds_actualCharges(),2)."'></td>";
if( $this->phicBack_meds_phicBenefits() != 0 ) {
echo "<Td><input type=text class='phic' name='$phicBenefitsPDF' value='P ".number_format($this->phicBack_meds_phicBenefits(),2)."'></td>";
}else {
echo "<Td><input type=text class='phic' name='$phicBenefitsPDF' value='P ".number_format($this->phicBack_meds_actualCharges(),2)."'></td>";
}

echo "</tr>"; 
 }
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><center><font size=4><b>TOTAL</b></font></center></td>";
echo "<td><input type=text class='phic' name='phicBack_meds_totalActualCharges' value='".number_format($this->phicBack_meds_totalActualCharges(),2)."'></td>";
echo "<td><input type=text class='phic' name='phicBack_meds_totalPHICcharges' value='".number_format($this->phicBack_meds_totalPHIC(),2)."'></td>";
echo "</tr>";
echo "</table>";

}



//ilabas kung ilang meds meron pra alam din kung ilang variable ang kelangan i-declare
public function phicBack_meds_PDF_count($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));
//selectNow($table,$cols,$identifier,$identifierData)
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.* from patientCharges pc WHERE pc.registrationNo = '$registrationNo' and pc.title = 'MEDICINE' and pc.phic > 0 and status = 'UNPAID' group by pc.chargesCode   "); 

return mysqli_num_rows($result);

}

public $phicBack_actualCharges;
public $phicBack_phicBenefits;

public function phicBack_actualCharges() {
return $this->phicBack_actualCharges;
}
public function phicBack_phicBenefits() {
return $this->phicBack_phicBenefits;
}


private $phicBack_part3_desc_PDF=1;
private $phicBack_part3_qty_PDF=1;
private $phicBack_part3_unitPrice_PDF=1;
private $phicBack_part3_actualCharges_PDF=1;
private $phicBack_part3_phicBenefits_PDF=1;
public function phicBack_part3($title,$registrationNo) {

echo "<style type='text/css'>
#part3:hover { background-color:yellow; color:black; }

.descRadio{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 381px;
	border-color:white white white white;
	font-size:15px;
	text-align:center;
}

.qtyRadio{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 80px;
	border-color:white white white white;
	font-size:15px;
	text-align:center;
}

.phicRadio{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 125px;
	border-color:white white white white;
	font-size:15px;
	text-align:center;
}

</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.* from patientCharges pc WHERE pc.title = '$title' and pc.registrationNo = '$registrationNo' and phic > 0 and pc.status = 'UNPAID' group by pc.description order by description asc "); 


while($row = mysqli_fetch_array($result))
  {
$this->phicBack_part3_ByTitle($row['chargesCode'],$title,$registrationNo); // ito ung callee pra mkuha ung actual charges at PHIC benefits
$this->phicBack_actualCharges+=$this->phicBack_3_totalCharges();
$this->phicBack_phicBenefits+=$this->phicBack_3_totalPHIC();



$descPart3 = "phicBack_part3_".$title."_desc_".$this->phicBack_part3_desc_PDF++;
$qtyPart3 = "phicBack_part3_".$title."_qty_".$this->phicBack_part3_qty_PDF++;
$unitPricePart3 = "phicBack_part3_".$title."_unitPrice_".$this->phicBack_part3_unitPrice_PDF++;
$actualChargesPart3 = "phicBack_part3_".$title."_actualCharges_".$this->phicBack_part3_actualCharges_PDF++;
$phicBenefitsPart3 = "phicBack_part3_".$title."_phicBenefits_".$this->phicBack_part3_phicBenefits_PDF++;

echo "<tr>";
echo "<Td width='381'><input type=text class='descRadio' name='$descPart3' value='".$row['description']."'></tD>";
echo "<Td><input type=text class='qtyRadio' name='$qtyPart3' value='".$this->phicBack_3_qty()."'></tD>";
echo "<Td><input type=text class='phicRadio' name='$unitPricePart3' value='".number_format($row['sellingPrice'],2)."'></tD>";
echo "<Td><input type=text class='phicRadio' name='$actualChargesPart3' value='".number_format($this->phicBack_3_totalCharges(),2)."'></tD>";
if( $this->phicBack_3_totalPHIC() != 0 ) {
echo "<Td><input type=text class='phicRadio' name='$phicBenefitsPart3' value='".number_format($this->phicBack_3_totalPHIC(),2)."'></tD>";
}else {
echo "<Td><input type=text class='phicRadio' name='$phicBenefitsPart3' value='".number_format($this->phicBack_3_totalCharges(),2)."'></tD>";
}
echo "</tr>";
  }
/*
echo "<tr>";
echo "<Td width='381'><input type=text class='descRadio' value=''></tD>";
echo "<Td><input type=text class='qtyRadio' value=''></tD>";
echo "<Td><input type=text class='phicRadio' value=''></tD>";
echo "<Td><input type=text class='phicRadio' value=''></tD>";
echo "<Td><input type=text class='phicRadio' value=''></tD>";
echo "</tr>";
*/

//ibalik lahat ng original value ng mga variable na ito....
$this->phicBack_part3_desc_PDF=1; 
$this->phicBack_part3_qty_PDF=1;
$this->phicBack_part3_unitPrice_PDF=1;
$this->phicBack_part3_actualCharges_PDF=1;
$this->phicBack_part3_phicBenefits_PDF=1;

}



public function phicBack_part3_PDF_count($title,$registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.* from patientCharges pc WHERE pc.title = '$title' and pc.registrationNo = '$registrationNo' and phic > 0 and pc.status = 'UNPAID' group by pc.description order by description asc "); 

return mysqli_num_rows($result);

}




public function getPatientICD_code($registrationNo) {

echo "

<style type='text/css'>
.icd{
font-size:14px;
}
</style>

";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from patientICD WHERE registrationNo = '$registrationNo' order by icdNo asc  "); 
echo " <td width='499' class='style7'><font size=2>13. Complete ICD-10 Code/s:</font>&nbsp;";
$x=1;
while($row = mysqli_fetch_array($result))
  {
echo "<font class='icd'><u>(".$x++.")".$row['icdCode']."&nbsp;</u></font>";
  }
echo "</td>";

}



public function getPatientICD_code_2pdf($registrationNo) {

echo "

<style type='text/css'>
.icd{
font-size:14px;
}
</style>

";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from patientICD WHERE registrationNo = '$registrationNo' order by icdNo asc  "); 

$x=1;
while($row = mysqli_fetch_array($result))
  {
$result_array[] =  "<font class='icd'><u>(".$x++.")".$row['icdCode']."&nbsp;</u></font>";
  }
return implode(",",$result_array);

}



//pra sa CF2 diagnosis LLgyan ng number as delimiter
public function getPatientICD_diagnosis($registrationNo) {



$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from patientICD WHERE registrationNo='$registrationNo' order by icdNo asc  "); 
$x=1;
while($row = mysqli_fetch_array($result))
  {
echo "<font size=2>(".$x++.")".$row['diagnosis']."&nbsp;</font>";
  }

}

public function getPatientICD_diagnosis_pdf($registrationNo) {



$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from patientICD WHERE registrationNo='$registrationNo' order by icdNo asc  "); 
$x=1;
while($row = mysqli_fetch_array($result))
  {
$result_array[] = "<font size=2>(".$x++.")".$row['diagnosis']."&nbsp;</font>";
  }
return implode(",",$result_array);

}



public function viewICDcode($registrationNo,$username) {

echo "<style type='text/css'>
tr:hover { background-color:yellow; color:black; }
.data{
font-size:14px;
}

.head {
font-size:13px;
}
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));



$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from patientICD where registrationNo='$registrationNo' order by icdNo asc  ");

echo "<center><table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo "<th bgcolor='#3b5998'>&nbsp;<font class='head' color='white'>ICD Code</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font class='head' color='white'>RVS Code</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font class='head' color='white'>Diagnosis</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font class='head' color='white'>Hospital</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font class='head' color='white'>PF</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'></th>";
echo "<th bgcolor='#3b5998'></th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;<font class='data'>".$row['icdCode']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['rvsCode']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['diagnosis']."</font>&nbsp;</td>";

if( $row['icdCode'] != "" ) {
echo "<td>&nbsp;<font class='data'>".number_format($this->selectNow("availableICD","hospital","icdCode",$row['icdCode']),2)."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".number_format($this->selectNow("availableICD","pf","icdCode",$row['icdCode']),2)."</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font class='data'>".number_format($this->selectNow("availableICD","hospital","rvsCode",$row['rvsCode']),2)."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".number_format($this->selectNow("availableICD","pf","rvsCode",$row['rvsCode']),2)."</font>&nbsp;</td>";
}

echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/ICDcode/editICD.php?icdCode=$row[icdCode]&diagnosis=$row[diagnosis]&icdNo=$row[icdNo]&registrationNo=$registrationNo&username=$username'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>&nbsp;</td>";


echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/ICDcode/verifyDeleteICD.php?icdCode=$row[icdCode]&diagnosis=$row[diagnosis]&icdNo=$row[icdNo]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>&nbsp;</td>"; 
echo "</tr>";
}
echo "</tr>";

}


public $paymentHMO;
public $paymentCASH;

public function paymentHMO() {
return $this->paymentHMO;
}
public function paymentCASH() {
return $this->paymentCASH;
}

public function paymentAssigning($registrationNo,$desc,$username,$type) {


echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
#row:hover { background-color:yellow;color:black;}

.data {
font-size:12px;
}
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($type == "All") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientCharges where registrationNo = '$registrationNo' and status = 'UNPAID' order by description asc ");
}else {
if( $type == "MEDICINE" || $type == "SUPPLIES" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientCharges where registrationNo = '$registrationNo' and status = 'UNPAID' and title = '$type' and departmentStatus like 'dispensedBy_%%%%%%%%' order by description asc ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientCharges where registrationNo = '$registrationNo' and status = 'UNPAID' and title = '$type' order by description asc ");
}

}

echo "<form method='get' action='http://".$this->getMyUrl()."/COCONUT/patientProfile/Payments/assignPayment.php'>";
echo "<input type='hidden' name='registrationNo' value='$registrationNo'>";
echo "<input type='hidden' name='username' value='$username'>";
echo "<input type='hidden' name='type' value='$type'>";
echo "<br><input type=submit value='Assign Payments' style='border:1px solid #ff0000; font-size:13px; background-color:transparent;'><Br><br>";
while($row = mysqli_fetch_array($result))
  {
//$this->getMyResults($this->getResult_labNo($row['itemNo']),$username);
$price = preg_split ("/\//", $row['sellingPrice']); 
$deptStatus = preg_split ("/\_/", $row['departmentStatus']); 
echo "<tr id='row'>";

$this->paymentCASH+=$row['cashUnpaid'];
$this->paymentHMO+=$row['company'];


if($desc == "cash") { // CHECK ALL CASH
echo "<td><Center><input name='assign[]' type=checkbox value='".$row['itemNo']."_cash' checked='checked'></center></td>";
echo "<td><center><input name='assign[]' type=checkbox value='".$row['itemNo']."_hmo'></center></td>";
echo "<td><Center><input name='assign[]' type=checkbox value='".$row['itemNo']."_phic'></center></td>";
}else if($desc == "hmo") { //CHECK ALL HMO
echo "<td><Center><input name='assign[]' type=checkbox value='".$row['itemNo']."_cash'></center></td>";
echo "<td><center><input name='assign[]' type=checkbox value='".$row['itemNo']."_hmo' checked='checked'></center></td>";
echo "<td><Center><input name='assign[]' type=checkbox value='".$row['itemNo']."_phic'></center></td>";
}else if($desc == "phic") { //CHECK ALL PHIC
echo "<td><Center><input name='assign[]' type=checkbox value='".$row['itemNo']."_cash'></center></td>";
echo "<td><center><input name='assign[]' type=checkbox value='".$row['itemNo']."_hmo' ></center></td>";
echo "<td><Center><input name='assign[]' type=checkbox value='".$row['itemNo']."_phic' checked='checked'></center></td>";
}else {
echo "<td><Center><input name='assign[]' type=checkbox value='".$row['itemNo']."_cash'></center></td>";
echo "<td><center><input name='assign[]' type=checkbox value='".$row['itemNo']."_hmo'></center></td>";
echo "<td><Center><input name='assign[]' type=checkbox value='".$row['itemNo']."_phic'></center></td>";
}
if($deptStatus[0] == "dispensedBy") {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&desc=$desc'>".$row['description']." &nbsp;(<font size=1 color=red>Dispensed</font>)</a></font>&nbsp;</td>";
}else if($this->checkIfLabResultExist($row['itemNo']) > 0 && $row['title'] == "LABORATORY" ) {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&desc=$desc'>".$row['description']."</a><br>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Results/laboratoryResult.php?labNo=".$this->getLabNo()."&username=$username&registrationNo=$registrationNo&pathologist=".$this->getPathologist()."&medTech=".$this->getMedTech()."&dateReceived=".$this->getDateReceived()."&dateReleased=".$this->getDateReleased()."&description=$row[description]'>(<font color=red size=1>Test Done</font>)</font></a>&nbsp;</td>";
}else if($this->checkIfRadResultExist($row['itemNo']) > 0 && $row['title'] == "RADIOLOGY" ) {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&desc=$desc'>".$row['description']."</a><br>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Results/Radiology/resultReport.php?itemNo=$row[itemNo]&registrationNo=$row[registrationNo]&description=$row[description]'>(<font color=red size=1>Test Done</font>)</font></a>&nbsp;</td>";
}else if($this->checkIfSoapExist($row['itemNo']) > 0 && $row['title'] == "PROFESSIONAL FEE" ) {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&desc=$desc'>".$row['description']."</a><br>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Doctor/doctorModule/soapView.php?itemNo=$row[itemNo]&registrationNo=$row[registrationNo]'>(<font color=red size=1>S.O.A.P</font>)</font></a>&nbsp;</td>";
}else  {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&desc=$desc'>".$row['description']."</a></font>&nbsp;</td>";
}


if($row['title']=="PROFESSIONAL FEE") {
echo "<td><font class='data'>".number_format($price[0],2)."</font>/<font class='data'>".$price[1]."</font>&nbsp;</td>";
}else {
echo "<td><font class='data'>".number_format($row['sellingPrice'],2)."</font>&nbsp;</td>";
}

echo "<td>&nbsp;<font class='data'>".$row['quantity']."</font>&nbsp;</td>";
//echo "<td>&nbsp;<font class='data'>".$row['discount']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".number_format($row['total'],2)."</font>&nbsp;</td>";
//echo "<td>&nbsp;<font class='data'>".$row['timeCharge']."</font>&nbsp;</td>";
//echo "<td>&nbsp;<font class='data'>".$row['dateCharge']."</font>&nbsp;</td>";
//echo "<td>&nbsp;<font class='data'>".$row['chargeBy']."</font>&nbsp;</td>";

if($row['inventoryFrom'] != "none") {
echo "<td>&nbsp;<font class='data'>".$row['service']."</font><br><font class='data'>".$row['inventoryFrom']."</font>&nbsp;</td>";
}else if($row['inventoryFrom'] == "") {
echo "<td>&nbsp;<font class='data'>".$row['service']."</font>&nbsp;</td>";
}else if($row['title'] == "LABORATORY") {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Results/addResults.php?description=$row[description]&registrationNo=$registrationNo&itemNo=$row[itemNo]&branch=$row[branch]'><font class='data'>".$row['service']."</font></a>&nbsp;</td>";
}else if($row['title'] == "RADIOLOGY") {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Results/Radiology/addRadioResult.php?description=$row[description]&registrationNo=$registrationNo&itemNo=$row[itemNo]&branch=$row[branch]'><font class='data'>".$row['service']."</font></a>&nbsp;</td>";
}else if($row['title'] == "PROFESSIONAL FEE") {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Doctor/doctorModule/soap.php?registrationNo=$registrationNo&itemNo=$row[itemNo]'><font class='data'>".$row['service']."</font></a>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font class='data'>".$row['service']."</font>&nbsp;</td>";
}

if($row['status']=="PAID" ) {
echo "<td>&nbsp;<font class='data' color=blue>".$row['status']."</font>&nbsp;</td>";
}
else if($row['status']=="BALANCE" || $row['status']=="APPROVED") {
echo "<td>&nbsp;<font class='data' color=red>".$row['status']."</font>&nbsp;</td>";
}
else {
echo "<td>&nbsp;<font class='data'>".$row['status']."</font>&nbsp;</td>";
}

echo "<td>&nbsp;<font class='data' color=blue>".$row['paidVia']."</font>&nbsp;</td>";

echo "<td>&nbsp;<center><font class='data' color=black>".number_format($row['discount'],2)."</font></centeR>&nbsp;</td>";
echo "<td>&nbsp;<center><font class='data' color=red>".number_format($row['cashUnpaid'],2)."</font></centeR>&nbsp;</td>";
echo "<td>&nbsp;<center><font class='data' color=blue>".number_format($row['company'],2)."</font></center>&nbsp;</td>";
echo "<td>&nbsp;<center><font class='data' color=darkgreen>".number_format($row['phic'],2)."</font></center>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['cashPaid']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['branch']."</font>&nbsp;</td>";
echo "</tr>";
}
echo "</table>";
echo "</form>";

}





public function paymentTransfer($registrationNo,$username,$show,$desc,$condition) {


echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
#row:hover { background-color:yellow;color:black;}

.data {
font-size:12px;
}
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($show == "All") {
  $result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientCharges where registrationNo = '$registrationNo' and status = 'UNPAID' and remarks $condition 'takeHomeMeds' order by description asc ");
}else if($show == "cash2company" || $show == "cash2phic" || $show == "cash2package") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientCharges where registrationNo = '$registrationNo' and cashUnpaid > 0 and status = 'UNPAID' and remarks $condition 'takeHomeMeds' order by description asc ");
}

else if($show == "company2cash" || $show == "company2phic") {

  $result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientCharges where registrationNo = '$registrationNo' and company > 0 and status = 'UNPAID' and remarks $condition 'takeHomeMeds' order by description asc ");

}else if($show == "phic2cash" || $show == "phic2company") {
  $result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientCharges where registrationNo = '$registrationNo' and phic > 0 and status = 'UNPAID' and remarks $condition 'takeHomeMeds' order by description asc ");
}

else {
  $result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientCharges where registrationNo = '$registrationNo' and description like '$desc%%%%%%' and status = 'UNPAID' and remarks $condition 'takeHomeMeds' order by description asc ");
}

echo "<form method='get' action='http://".$this->getMyUrl()."/COCONUT/patientProfile/Payments/transferPayment.php'>";
echo "<input type='hidden' name='registrationNo' value='$registrationNo'>";
echo "<input type='hidden' name='show' value='$show'>";
echo "<input type='hidden' name='desc' value='$desc'>";

while($row = mysqli_fetch_array($result))
  {
//$this->getMyResults($this->getResult_labNo($row['itemNo']),$username);
$price = preg_split ("/\//", $row['sellingPrice']); 
$deptStatus = preg_split ("/\_/", $row['departmentStatus']); 
echo "<tr id='row'>";

echo "<td><Center><input name='transfer[]' type=checkbox value='".$row['itemNo']."' checked></center></td>";

if($deptStatus[0] == "dispensedBy") {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&show=$show&desc=$desc'>".$row['description']." &nbsp;(<font size=1 color=red>Dispensed</font>)</a></font>&nbsp;</td>";
}else if($this->checkIfLabResultExist($row['itemNo']) > 0 && $row['title'] == "LABORATORY" ) {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&show=$show&desc=$desc'>".$row['description']."</a><br>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Results/laboratoryResult.php?labNo=".$this->getLabNo()."&username=$username&registrationNo=$registrationNo&pathologist=".$this->getPathologist()."&medTech=".$this->getMedTech()."&dateReceived=".$this->getDateReceived()."&dateReleased=".$this->getDateReleased()."&description=$row[description]'>(<font color=red size=1>Test Done</font>)</font></a>&nbsp;</td>";
}else if($this->checkIfRadResultExist($row['itemNo']) > 0 && $row['title'] == "RADIOLOGY" ) {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&show=$show&desc=$desc'>".$row['description']."</a><br>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Results/Radiology/resultReport.php?itemNo=$row[itemNo]&registrationNo=$row[registrationNo]&description=$row[description]'>(<font color=red size=1>Test Done</font>)</font></a>&nbsp;</td>";
}else if($this->checkIfSoapExist($row['itemNo']) > 0 && $row['title'] == "PROFESSIONAL FEE" ) {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&show=$show&desc=$desc'>".$row['description']."</a><br>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Doctor/doctorModule/soapView.php?itemNo=$row[itemNo]&registrationNo=$row[registrationNo]'>(<font color=red size=1>S.O.A.P</font>)</font></a>&nbsp;</td>";
}else  {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&show=$show&desc=$desc'>".$row['description']."</a></font>&nbsp;</td>";
}


if($row['title']=="PROFESSIONAL FEE") {
echo "<td><font class='data'>".number_format($price[0],2)."</font>/<font class='data'>".$price[1]."</font>&nbsp;</td>";
}else if( $row['hmoPrice'] > 0  ) {
echo "<td><font class='data'>".number_format($row['sellingPrice'],2)."</font><br><font size=2 color=red>(Package)</font>&nbsp;</td>";
}else {
echo "<td><font class='data'>".number_format($row['sellingPrice'],2)."</font>&nbsp;</td>";
}

echo "<td>&nbsp;<font class='data'>".$row['quantity']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['discount']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".number_format($row['total'],2)."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['timeCharge']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['dateCharge']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['chargeBy']."</font>&nbsp;</td>";

if($row['inventoryFrom'] != "none") {
echo "<td>&nbsp;<font class='data'>".$row['service']."</font><br><font class='data'>".$row['inventoryFrom']."</font>&nbsp;</td>";
}else if($row['inventoryFrom'] == "") {
echo "<td>&nbsp;<font class='data'>".$row['service']."</font>&nbsp;</td>";
}else if($row['title'] == "LABORATORY") {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Results/addResults.php?description=$row[description]&registrationNo=$registrationNo&itemNo=$row[itemNo]&branch=$row[branch]'><font class='data'>".$row['service']."</font></a>&nbsp;</td>";
}else if($row['title'] == "RADIOLOGY") {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Results/Radiology/addRadioResult.php?description=$row[description]&registrationNo=$registrationNo&itemNo=$row[itemNo]&branch=$row[branch]'><font class='data'>".$row['service']."</font></a>&nbsp;</td>";
}else if($row['title'] == "PROFESSIONAL FEE") {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Doctor/doctorModule/soap.php?registrationNo=$registrationNo&itemNo=$row[itemNo]'><font class='data'>".$row['service']."</font></a>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font class='data'>".$row['service']."</font>&nbsp;</td>";
}

if($row['status']=="PAID" ) {
echo "<td>&nbsp;<font class='data' color=blue>".$row['status']."</font>&nbsp;</td>";
}
else if($row['status']=="BALANCE" || $row['status']=="APPROVED") {
echo "<td>&nbsp;<font class='data' color=red>".$row['status']."</font>&nbsp;</td>";
}
else {
echo "<td>&nbsp;<font class='data'>".$row['status']."</font>&nbsp;</td>";
}
if($row['paidVia']=="Company") {
echo "<td>&nbsp;<font class='data' color=red>".$row['paidVia']."</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font class='data' color=blue>".$row['paidVia']."</font>&nbsp;</td>";
}
echo "<td>&nbsp;<center><font class='data' color=red>".number_format($row['cashUnpaid'],2)."</font></centeR>&nbsp;</td>";
echo "<td>&nbsp;<center><font class='data' color=blue>".number_format($row['company'],2)."</font></center>&nbsp;</td>";
echo "<td>&nbsp;<center><font class='data' color=darkgreen>".number_format($row['phic'],2)."</font></center>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['cashPaid']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['branch']."</font>&nbsp;</td>";
echo "</tr>";
  }
echo "<br><input type=submit value='Transfer Payments' style='border:1px solid #ff0000; font-size:13px; background-color:transparent;'><Br><br>";
echo "</form>";

}



public $room_roomNo;
public $room_Description;
public $room_type;
public $room_rate;
public $room_branch;

public function room_roomNo() {
return $this->room_roomNo;
}
public function room_Description() {
return $this->room_Description;
}
public function room_type() {
return $this->room_type;
}
public function room_rate() {
return $this->room_rate;
}
public function room_branch() {
return $this->room_branch;
}

public function getRoom($description) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM room WHERE Description = '$description' ");

while($row = mysqli_fetch_array($result))
  {

$this->room_roomNo = $row['roomNo'];
$this->room_Description = $row['Description'];
$this->room_type = $row['type'];
$this->room_rate = $row['rate'];
$this->room_branch = $row['branch'];

  }

}



public $viewPayment_total;

public function viewPayment($registrationNo,$username) {

echo "

<style type='text/css'>
#payment:hover {
background-color:yellow;
color:black;
}
</style>

";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientPayment WHERE registrationNo = '$registrationNo' order by datePaid asc ");
echo "<br><center><br>	";
echo "<table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>Payment For</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>Hospital Bill</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>PF</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>TOTAL</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>Credit Card#</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>Time Paid</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>Date Paid</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>Paid By</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>Paid Via</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'></th>";
echo "</tr>";


while($row = mysqli_fetch_array($result))
  {

echo "<tr id='payment'>";
$this->viewPayment_total+=$row['amountPaid'];
echo "<td>&nbsp;".$row['paymentFor']."&nbsp;</td>";
echo "<td>&nbsp;".number_format($row['amountPaid'],2)."&nbsp;</td>";
echo "<td>&nbsp;".number_format($row['pf'],2)."&nbsp;</td>";
echo "<td>&nbsp;".number_format(($row['pf'] + $row['amountPaid']) + $row['admitting'],2)."&nbsp;</td>";
if( $this->selectNow("registeredUser","module","username",$username) == "CASHIER" ) {
echo "<td>&nbsp;<font color=red>".$this->ENCRYPT_DECRYPT($row['creditCardNo'])."</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font color=red>xxx-xxxx-xxxx</font></td>";
}
echo "<td>&nbsp;".$row['timePaid']."&nbsp;</td>";
echo "<td>&nbsp;".$row['datePaid']."&nbsp;</td>";
echo "<td>&nbsp;".$row['paidBy']."&nbsp;</td>";
echo "<td>&nbsp;".$row['paidVia']."&nbsp;</td>";


//echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/Payments/editPayment_new.php?paymentFor=$row[paymentFor]&amountPaid=$row[amountPaid]&timePaid=$row[timePaid]&datePaid=$row[datePaid]&username=$username&registrationNo=$registrationNo&paymentNo=$row[paymentNo]&pf=$row[pf]&admitting=$row[admitting]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>&nbsp;</td>";

echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/Payments/verifyDeletePayment.php?paymentFor=$row[paymentFor]&amountPaid=$row[amountPaid]&registrationNo=$registrationNo&paymentNo=$row[paymentNo]&username=$username'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>&nbsp;</td>";
echo "</tr>";

  }

echo "<tr>";

echo "</table>";

}



public function sumPartialPayment($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(amountPaid) as total FROM patientPayment WHERE registrationNo = '$registrationNo' ");

while($row = mysqli_fetch_array($result))
  {
return $row['total'];

  }

}


public $descPartialPayment_total;

public function descPartialPayment_total() {
return $this->descPartialPayment_total;
}

public function descPartialPayment($registrationNo,$username) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT paymentFor,( amountPaid + pf + admitting ) as total,orNo,creditCardNo FROM patientPayment WHERE registrationNo = '$registrationNo' and paymentFor != 'REFUND' ");

while($row = mysqli_fetch_array($result))
  {

if( $row['creditCardNo'] == "" ) {
echo "<tr>";
$this->descPartialPayment_total += $row['total'];
echo "<tD>". $row['paymentFor']."<br><font size=2 color=blue>OR#:".$row['orNo']."</font></td>";
echo "<TD>&nbsp;</tD>";
echo "<TD>&nbsp;</tD>";
echo "<TD>&nbsp;</tD>";
echo "<TD>&nbsp;".number_format($row['total'],2)."</tD>";
echo "</tr>";
}else {
echo "<tr>";
$this->descPartialPayment_total += $row['total'];
if( $this->selectNow("registeredUser","module","username",$username) == "CASHIER" ) {
echo "<tD>". $row['paymentFor']."<br><font size=2 color=blue>OR#:".$row['orNo']."</font><br><font size=2 color=red>Credit Card#:<Br>".$this->ENCRYPT_DECRYPT($row['creditCardNo'])."</font></td>";
}else {
echo "<tD>". $row['paymentFor']."<br><font size=2 color=blue>OR#:".$row['orNo']."</font><br><font size=2 color=red>Credit Card#:<Br>xx-xx-xx</font></td>";
}
echo "<TD>&nbsp;</tD>";
echo "<TD>&nbsp;</tD>";
echo "<TD>&nbsp;</tD>";
echo "<TD>&nbsp;".number_format($row['total'],2)."</tD>";
echo "</tr>";
} 

  }

}




public function descPartialPayment_company1($registrationNo,$username) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT paymentFor,( amountPaid + pf + admitting ) as total,orNo,creditCardNo FROM patientPayment WHERE registrationNo = '$registrationNo' and paymentFor != 'REFUND' ");

while($row = mysqli_fetch_array($result))
  {

if( $row['creditCardNo'] == "" ) {
echo "<tr>";
$this->descPartialPayment_total += $row['total'];
echo "<tD>". $row['paymentFor']."<br><font size=2 color=blue>OR#:".$row['orNo']."</font></td>";
echo "<TD>&nbsp;</tD>";
echo "<TD>&nbsp;</tD>";
echo "<TD>&nbsp;</tD>";
echo "<TD>&nbsp;".number_format($row['total'],2)."</tD>";
echo "</tr>";
}else {
echo "<tr>";
$this->descPartialPayment_total += $row['total'];
if( $this->selectNow("registeredUser","module","username",$username) == "CASHIER" ) {
echo "<tD>". $row['paymentFor']."<br><font size=2 color=blue>OR#:".$row['orNo']."</font><br><font size=2 color=red>Credit Card#:<Br>".$this->ENCRYPT_DECRYPT($row['creditCardNo'])."</font></td>";
}else {
echo "<tD>". $row['paymentFor']."<br><font size=2 color=blue>OR#:".$row['orNo']."</font><br><font size=2 color=red>Credit Card#:<Br>xx-xx-xx</font></td>";
}
echo "<TD>&nbsp;</tD>";
echo "<TD>&nbsp;</tD>";
echo "<TD>&nbsp;</tD>";
echo "<TD>&nbsp;</tD>";
echo "<TD>&nbsp;".number_format($row['total'],2)."</tD>";
echo "</tr>";
} 

  }

}



public $viewPayment_rowOnly_total;

public function viewPayment_rowOnly_total() {
return $this->viewPayment_rowOnly_total;
}

public function viewPayment_rowOnly($registrationNo) {

echo "

<style type='text/css'>
#payment:hover {
background-color:yellow;
color:black;
}
</style>

";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientPayment WHERE registrationNo = '$registrationNo' order by datePaid asc ");


while($row = mysqli_fetch_array($result))
  {

echo "<tr id='payment'>";
$this->viewPayment_rowOnly_total+=$row['amountPaid'];
echo "<td>&nbsp;".$row['datePaid']."&nbsp;</td>";
echo "<td>&nbsp;".$row['orNo']."&nbsp;</td>";
echo "<td>&nbsp;".number_format($row['amountPaid'],2)."&nbsp;</td>";
echo "<td>&nbsp;".$row['paidBy']."&nbsp;</td>";

//echo "<td>&nbsp;".$row['timePaid']."&nbsp;</td>";
//echo "<td>&nbsp;".$row['datePaid']."&nbsp;</td>";
//echo "<td>&nbsp;".$row['paidBy']."&nbsp;</td>";
//echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/Payments/editPayment.php?paymentFor=$row[paymentFor]&amountPaid=$row[amountPaid]&timePaid=$row[timePaid]&datePaid=$row[datePaid]&username=$username&registrationNo=$registrationNo&paymentNo=$row[paymentNo]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>&nbsp;</td>";
//echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/Payments/verifyDeletePayment.php?paymentFor=$row[paymentFor]&amountPaid=$row[amountPaid]&registrationNo=$registrationNo&paymentNo=$row[paymentNo]&username=$username'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>&nbsp;</td>";
echo "</tr>";

  }

}









public $viewPayment_setter_paymentNo;
public $viewPayment_setter_registrationNo;
public $viewPayment_setter_amountPaid;
public $viewPayment_setter_datePaid;
public $viewPayment_setter_timePaid;
public $viewPayment_setter_paidBy;
public $viewPayment_setter_paymentFor;

public function viewPayment_setter_paymentNo() {
return $this->viewPayment_setter_paymentNo;
}
public function viewPayment_setter_registrationNo() {
return $this->viewPayment_setter_registrationNo;
}
public function viewPayment_setter_amountPaid() {
return $this->viewPayment_setter_amountPaid;
}
public function viewPayment_setter_datePaid() {
return $this->viewPayment_setter_datePaid;
}
public function viewPayment_setter_timePaid() {
return $this->viewPayment_setter_timePaid;
}
public function viewPayment_setter_paidBy() {
return $this->viewPayment_setter_paidBy;
}
public function viewPayment_setter_paymentFor() {
return $this->viewPayment_setter_paymentFor;
}

public function viewPayment_setter($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientPayment WHERE registrationNo = '$registrationNo' ");

while($row = mysqli_fetch_array($result))
  {
$this->viewPayment_setter_paymentNo = $row['paymentNo'];
$this->viewPayment_setter_registrationNo = $row['registrationNo'];
$this->viewPayment_setter_amountPaid = $row['amountPaid'];
$this->viewPayment_setter_datePaid = $row['datePaid'];
$this->viewPayment_setter_timePaid = $row['timePaid'];
$this->viewPayment_setter_paidBy = $row['paidBy'];  
$this->viewPayment_setter_paymentFor = $row['paymentFor'];
}

}

public $viewPayment_soa_amountPaid;

public function viewPayment_soa($registrationNo,$total) {

 echo "

<style type='text/css'>
.heading {
font-size:13px;
}
</style>

";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientPayment WHERE registrationNo = '$registrationNo' ");

echo "<font size=1>Payment History</font><Br><table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<Tr>";
echo "<Th>&nbsp;<font class='heading'>Date</font>&nbsp;</th>";
echo "<Th>&nbsp;<font class='heading'>Paid</font>&nbsp;</th>";
echo "<Th>&nbsp;<font class='heading'>Total</font>&nbsp;</th>";
echo "<Th>&nbsp;<font class='heading'>Balance	</font>&nbsp;</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<Tr>";
$this->viewPayment_soa_amountPaid+=$row['amountPaid'];
echo "<td>&nbsp;<font class='heading'>".$row['datePaid']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='heading'>".number_format($row['amountPaid'],2)."</font>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
}
echo "<tr>";
echo "<Td>&nbsp;<b>TOTAL</b>&nbsp;</td>";
echo "<Td>&nbsp;<font class='heading'><b>".number_format($this->viewPayment_soa_amountPaid,2)."</b></font>&nbsp;</td>";
echo "<Td>&nbsp;<font class='heading'><b>".number_format($total,2)."</b></font>&nbsp;</td>";
echo "<Td>&nbsp;<font class='heading'><b>".number_format(($total - $this->viewPayment_soa_amountPaid),2)."</b></font>&nbsp;</td>";
echo "</tr>";
echo "</table>";
echo "<br>__________________________<br><font size=2>Cashier / Billing</font><br>";
}



//get total credit ng patient
public function getCurrentCredit($registrationNo,$title,$via) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($title == "PATIENT") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(cashUnpaid) as total FROM patientCharges WHERE registrationNo = '$registrationNo' ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum($via) as total FROM patientCharges WHERE registrationNo = '$registrationNo' and title = '$title' ");
}
while($row = mysqli_fetch_array($result))
  {

return $row['total'];

  }

}



public function getTotalPatientPayment($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT paymentFor,( amountPaid + pf + admitting ) as total FROM patientPayment WHERE registrationNo = '$registrationNo' and paymentFor != 'REFUND' ");

while($row = mysqli_fetch_array($result))
{
return $row['total'];
}

}


//mei credit limit ba ang patient as "PATIENT"???
public function checkCreditLimit($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientCreditLimit WHERE registrationNo = '$registrationNo' and limitTo = 'PATIENT' and limitVia = 'cashUnpaid'  ");

while($row = mysqli_fetch_array($result))
  {
return mysqli_num_rows($result);
  }

}


//mei credit limit ba ang patient as "NOT PATIENT"???
public function checkCreditLimit_others($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientCreditLimit WHERE registrationNo = '$registrationNo' and limitTo != 'PATIENT' and limitVia = 'cashUnpaid'  ");

while($row = mysqli_fetch_array($result))
  {
return mysqli_num_rows($result);
  }

}


public $getPatientInTheRoom_name;
public $getPatientInTheRoom_registrationNo;

public function getPatientInTheRoom_name() {
return $this->getPatientInTheRoom_name;
}
public function getPatientInTheRoom_registrationNo() {
return $this->getPatientInTheRoom_registrationNo;
}


//setter pra mkuha ung details ng patient sa isang room
public function getPatientInTheRoom($room) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,rd.registrationNo FROM patientRecord pr,registrationDetails rd WHERE pr.patientNo = rd.patientNo and rd.room = '$room' and rd.dateUnregistered = ''  ");
while($row=mysqli_fetch_array($result)) {
return $row['registrationNo']."_".$row['lastName'].", ".$row['firstName'];
}

}



public function showFloorAsUpperMenu($branch) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT floor FROM room WHERE branch = '$branch' group by floor order by floor  ");
while($row=mysqli_fetch_array($result)) {
echo "<li><a href='http://".$this->getMyUrl()."/COCONUT/NURSING/nursingStation1.php?username=&module=&branch=$branch&floor=$row[floor]' target='nsX'>$row[floor]</a></li>";

//$this->coconutUpperMenu_headingMenu("http://".$this->getMyUrl()."/COCONUT/NURSING/nursingStation.php?username=&module=&branch=$branch&floor=".$row['floor'],$row['floor']);
}

}


public function showFloorAsUpperMenu_billing($branch,$username) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT floor FROM room WHERE branch = '$branch' group by floor order by floor  ");
while($row=mysqli_fetch_array($result)) {
echo "<li><a href='http://".$this->getMyUrl()."/COCONUT/billing/billingStation.php?username=$username&module=&branch=$branch&floor=$row[floor]' target='departmentX'>$row[floor]</a></li>";

//$this->coconutUpperMenu_headingMenu("http://".$this->getMyUrl()."/COCONUT/NURSING/nursingStation.php?username=&module=&branch=$branch&floor=".$row['floor'],$row['floor']);
}

}


public function showFloorAsUpperMenu_admin($username,$module) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT floor,branch FROM room group by floor order by floor asc  ");
while($row=mysqli_fetch_array($result)) {

echo "<li><a href='http://".$this->getMyUrl()."/COCONUT/billing/billingStation.php?username=$username&module=$module&branch=$row[branch]&floor=$row[floor]' target='departmentX'>$row[floor]</a></li>";

//$this->coconutUpperMenu_headingMenu("http://".$this->getMyUrl()."/COCONUT/NURSING/nursingStation.php?username=&module=&branch=$branch&floor=".$row['floor'],$row['floor']);
}

}



public function showFloor() {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT floor FROM room group by floor order by floor  ");
while($row=mysqli_fetch_array($result)) {
echo "<option value='".$row['floor']."'>".$row['floor']."</option>";
}

}


public $showAllRoom_room;
public $showAllRoom_occupied;
public $showAllRoom_vacant;
public $showAllRoom_credit;


//iLbas Lhat ng room sa branch
public function showAllRoom($branch,$username,$module,$desc) {

echo "

<style type='text/css'>
.head {
color:white;
}

.roomData {
font-size:13px;
}

#selected:hover {
background-color:yellow;
color:black;
}

.exceeded {
border-color:red;
color:red;
}

.unExceed {text-decoration:none; color:black; }
.Exceed {text-decoration:none; color:red; }
</style>

";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($module == "BILLING") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM room WHERE branch = '$branch' order by Description asc ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM room WHERE branch = '$branch' and floor='$desc' order by Description asc ");
}
echo "<br><center><font size=2>Admitted Patient in $desc of $branch</font><div style='border:1px solid #000000; width:600px; height:auto; border-color:black black black black;'>";
echo "<center><br><table width='75%' border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo "<th bgcolor='#3b5998'>&nbsp;<font class='head'>Beds</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font class='head'>Patient</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font class='head'>Pharmacy</font>&nbsp;</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
 $patientData = preg_split ("/\_/",$this->getPatientInTheRoom($row['Description'])); //source of data

 $credit = $this->getCurrentCredit($patientData[0],"PATIENT","") - ($this->getCurrentPaid($patientData[0],"PATIENT","cashUnpaid")); //total Credit [cashUnpaid] as PATIENT
 
 $this->viewCreditLimit_setter($patientData[0],"PATIENT","cashUnpaid","");  //credit Limit ng Patient..
 $limit = $this->viewCreditLimit_setter_amountLimit(); //amountLimit ng patient from "viewCreditLimit_setter()"

echo "<tr id='selected' >";

/*******start counter****/
$this->showAllRoom_room++; //count total rooms

if($patientData[0] != "") { //check kung may patient
$this->showAllRoom_occupied+=1; // kung meron +1
}else {
$this->showAllRoom_vacant+=1; // kung wLa +1
}

$this->showAllRoom_credit+=$credit;

/*********end counter************/


if($this->checkCreditLimit($patientData[0]) == 0) { //check kung mei credit Limit n nka set sa patient...kpg meron execute code below kung wLa execute notifier

echo "<Td>&nbsp;<font class='roomData'>".$row['Description']."</font>&nbsp;</td>";
if($patientData[0] != "") {

////////////////ORIGINAL EXCEED/////////////////////
///getTotal($cols,$title,$registrationNo)
$allowedBalance = ( $this->getTotal("cashUnpaid","MEDICINE",$patientData[0]) + $this->getTotal("cashUnpaid","SUPPLIES",$patientData[0]) );
if( $allowedBalance > $this->selectNow("registrationDetails","LimitCASH","registrationNo",$patientData[0]) ) { //gwen red kpg exceed sa limit
echo "<Td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/unknownUser/verifyUser.php?registrationNo=".$patientData[0]."' target='_blank' class='Exceed'><font class='roomData'>".$patientData[1]."</font></a>&nbsp;</td>";
}else {
echo "<Td>&nbsp;<a href='http://".$this->getMyUrl()."/Department/redirect.php?username=$username&registrationNo=".$patientData[0]."' target='_blank' class='unExceed'><font class='roomData'>".$patientData[1]."</font></a>&nbsp;</td>";
}
/////////////////////////////////////////////////

}else {
echo "<td>&nbsp;</td>";
}
if($patientData[0] != "") {
echo "<Td>&nbsp;<font class='roomData'>".number_format($allowedBalance,2 )."</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;</td>";
}

}else { //execute notifier kpg meron credit limit n nka set sa patient as "PATIENT"

 $this->viewCreditLimit_setter($patientData[0],"PATIENT","cashUnpaid","");  //credit Limit ng Patient..

$allowedBalance1 = ( $this->getTotal("cashUnpaid","MEDICINE",$patientData[0]) + $this->getTotal("cashUnpaid","SUPPLIES",$patientData[0]) );
if($allowedBalance1 > $this->selectNow("registrationDetails","LimitCASH","registrationNo",$patientData[0]) ) { //gwen red kpg Lagpas n sa limit

echo "<Td class='exceeded'>&nbsp;<font class='roomData'>".$row['Description']."</font>&nbsp;</td>";
if($patientData[0] != "") {
echo "<Td class='exceeded'>&nbsp;<a href='http://".$this->getMyUrl()."/Department/redirect.php?username=$username&registrationNo=".$this->viewCreditLimit_setter_registrationNo()."' target='_blank' class='Exceed'><font class='roomData'>".$patientData[1]."</font></a>&nbsp;</td>";
}else {
echo "<td class='exceeded'>&nbsp;</td>";
}

if($patientData[0] != "") {
echo "<Td class='exceeded'>&nbsp;<font class='roomData'>".number_format($credit,2 )."</font>&nbsp;</td>";
}else {
echo "<td class='exceeded'>&nbsp;</td>";
}

}else { //gwen black kpg ndi n Lgpas sa limit

echo "<Td>&nbsp;<font class='roomData'>".$row['Description']."</font>&nbsp;</td>";
if($patientData[0] != "") {
echo "<Td>&nbsp;<a href='http://".$this->getMyUrl()."/Department/redirect.php?username=$username&registrationNo=".$this->viewCreditLimit_setter_registrationNo()."' target='_blank' class='unExceed'><font class='roomData'>".$patientData[1]."</font></a>&nbsp;</td>";
}else {
echo "<td>&nbsp;</td>";
}
if($patientData[0] != "") {
echo "<Td>&nbsp;<font class='roomData'>".number_format($allowedBalance1,2 )."</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;</td>";
}

}

}

echo "</tr>";
  }

echo "<tr>";
echo "<td>&nbsp;<font size=2><b>".$this->showAllRoom_room." Rooms</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>Occupied&nbsp;<b>".$this->showAllRoom_occupied."</b>&nbsp;|&nbsp;Vacant&nbsp;<b>".$this->showAllRoom_vacant."</b></font>&nbsp;</td>";
echo "<td>&nbsp;<font size=2><b>".number_format($this->showAllRoom_credit,2)."</b></font>&nbsp;</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
echo "</div>";
}


public $dischargedReport_admin_payment;
public $dischargedReport_admin_paid;
public $dischargedReport_admin_balance;

//dischargedReport pra sa admin
public function dischargedReport_admin($m,$d,$y,$m1,$d1,$y1,$username,$branch) {


echo "
<style type='text/css'>
#rowz:hover {
background-color:yellow;
color:black;
}
</style>

";


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$fromDate = $y."-".$m."-".$d;
$toDate = $y1."-".$m1."-".$d1;

if($branch == "All") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "select upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,rd.dateRegistered,rd.dateUnregistered,rd.registrationNo from patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and rd.type='IPD' and (rd.dateUnregistered between '$fromDate' and '$toDate') order by pr.lastName ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "select upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,rd.dateRegistered,rd.dateUnregistered,rd.registrationNo from patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and rd.type='IPD' and (rd.dateUnregistered between '$fromDate' and '$toDate') order by pr.lastName ");
}
echo "<center>";
echo "<font size=6>Discharged Patient</font><br>";
echo "<font size=3>$branch Branch</font><br>";
echo "<font size=2>($m $d, $y - $m1 $d1, $y1)</font>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("");
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("Final Diagnosis");
$this->coconutTableHeader("Admitted");
$this->coconutTableHeader("Discharged");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
$x=1;
while($row=mysqli_fetch_array($result)) {
echo "<tr id='rowz'>";
$this->coconutTableData("".$x++);
$this->coconutTableData($row['lastName'].", ".$row['firstName']);
$this->coconutTableData($this->selectNow("patientICD","diagnosis","registrationNo",$row['registrationNo']));
$this->coconutTableData($row['dateRegistered']);
$this->coconutTableData($row['dateUnregistered']);
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/soaOption.php?registrationNo=$row[registrationNo]&username=$username' style='text-decoration:none;' target='_blank'><font size=2 color=red>View S.O.A</font></a>");
echo "</tr>";
}

$this->coconutTableStop();

}	


public $showCart_discount;
public $showCart_total;

//iLLbas Lhat ng chinarge
public function showCart($registrationNo,$batchNo,$username) {


echo "
<style type='text/css'>
.data {
font-size:13px;
}

#rowz:hover {
background-color:yellow;
}

</style>


";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.* FROM patientCharges pc where pc.registrationNo='$registrationNo' and status not like 'DELETED_%%%%%%%%' and pc.batchNo='$batchNo' order by pc.description asc  ");

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("");
$this->coconutTableHeader("Description");
$this->coconutTableHeader("Price");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("Discount");
$this->coconutTableHeader("Total");
$this->coconutTableRowStop();

$totall=0;
while($row=mysqli_fetch_array($result)) {
echo "<tr id='rowz'>";
$this->showCart_discount += $row['discount'];
$this->showCart_total += $row['total'];


if( $this->selectNow("patientCharges","dispenseFlag","itemNo",$row['itemNo']) == "dispense" ) {
echo "<td><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/ECART/deleteCart.php?registrationNo=$registrationNo&batchNo=$batchNo&itemNo=$row[itemNo]&username=$username'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a></td>";
$this->coconutTableData("<font size=2>".$row['description']."</font><br><font size=1 color=red>(".$row['departmentStatus'].")</font>");
}else {
echo "<td><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/ECART/deleteCart.php?registrationNo=$registrationNo&batchNo=$batchNo&itemNo=$row[itemNo]&username=$username'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a></td>";
$this->coconutTableData("<font size=2>".$row['description']."</font>");
}

$vat=$this->selectNow("patientCharges","vat","itemNo",$row['itemNo']);

if($row['title'] == "PROFESSIONAL FEE") {
$price = preg_split ("/\//", $row['sellingPrice']); 
$this->coconutTableData(number_format($price[0],2));
}else if( $row['title'] == "MEDICINE" || $row['title'] == "SUPPLIES" ) {

if( $this->selectNow("registeredUser","module","username",$username) == "PHILHEALTH" || $this->selectNow("registeredUser","module","username",$username) == "HMO" || $this->selectNow("registeredUser","module","username",$username) == "BILLING" || $this->selectNow("registeredUser","module","username",$username) == "CASHIER" || $this->selectNow("registeredUser","module","username",$username) == "PHARMACY" ) { //kpg allowed ma-view ung price
$this->coconutTableData("<font size=2>".number_format($row['sellingPrice'],2)."</font>");
}else { //kpg ndi allowed ma-view ung price
//$this->coconutTableData("<font size=2 color=red>Confidential</font>");
$this->coconutTableData("<font size=2>".number_format($row['sellingPrice'],2)."</font>");
}

}
else {
$this->coconutTableData("<font size=2>".number_format($row['sellingPrice'],2)."</font>");
}
$this->coconutTableData("<font size=2>".$row['quantity']."</font>");
$this->coconutTableData("<font size=2>".number_format($row['discount'],2)."</font>");

if( $row['title'] == "MEDICINE" || $row['title'] == "SUPPLIES" ) {
if( $this->selectNow("registeredUser","module","username",$username) == "PHILHEALTH" || $this->selectNow("registeredUser","module","username",$username) == "HMO" || $this->selectNow("registeredUser","module","username",$username) == "BILLING" || $this->selectNow("registeredUser","module","username",$username) == "CASHIER" || $this->selectNow("registeredUser","module","username",$username) == "PHARMACY" ) {

if($vat==''){
$this->coconutTableData("<font size=2>".number_format($row['total'],2)."</font>");
}
else{
$this->coconutTableData("<font size=2>".number_format($row['total'],2)."</font> (<font size=2 color='red'>".number_format($row['vat'],2)."</font>)");
}

}else {
//$this->coconutTableData("<font color=red size=2>Confidential</font>");

if($vat==''){
$this->coconutTableData("<font size=2>".number_format($row['total'],2)."</font>");
}
else{
$this->coconutTableData("<font size=2>".number_format($row['total'],2)."</font> (<font size=2 color='red'>".number_format($row['vat'],2)."</font>)");
}

}
}else {
$this->coconutTableData("<font size=2>".number_format($row['total'],2)."</font>");
}
echo "</tr>";

$totall+=$row['total'];
}


$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;<b><font size=2>Balance</font></b>");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
//$this->coconutTableData("&nbsp;".number_format($this->getTotalByBatch("cashUnpaid",$row['title'],$registrationNo,$batchNo),2));
$this->coconutTableData("&nbsp;<font size=2>".number_format($totall,2)."</font>");
$this->coconutTableRowStop();
$this->coconutTableStop();

if( $this->selectNow("registeredUser","module","username",$username) == "PHARMACY" || $this->selectNow("registeredUser","module","username",$username) == "CASHIER" ) {
echo "&nbsp;<Br><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/individualPayment/showMeds.php?registrationNo=$registrationNo&username=$username&checkz=yes&batchNo=$batchNo' style='text-decoration:none;' target='_blank'><font color=red>CHECK OUT >></font></a>";
}else { }

}



public function hmoSOA_HB($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(company) as total FROM patientCharges where registrationNo = '$registrationNo' and title != 'PROFESSIONAL FEE' and status = 'UNPAID' ");

while($row = mysqli_fetch_array($result))
  {
return $row['total'];
  }

}

public function hmoSOA_PF($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(company) as total FROM patientCharges where registrationNo = '$registrationNo' and title = 'PROFESSIONAL FEE' and status = 'UNPAID' ");

while($row = mysqli_fetch_array($result))
  {
return $row['total'];
  }

}

public $hmoSOA_ipd_hb;
public $hmoSOA_ipd_pf;

public function hmoSOA_ipd($company,$fromDate_month,$fromDate_day,$fromDate_year,$toDate_month,$toDate_day,$toDate_year,$branch) {




$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


$fromDate = $fromDate_year."-".$fromDate_month."-".$fromDate_day;
$toDate = $toDate_year."-".$toDate_month."-".$toDate_day;
if($branch == "All") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,rd.*,pc.* FROM patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.Company='$company' and rd.type='IPD' and (rd.dateUnregistered between '$fromDate' and '$toDate')  group by rd.registrationNo order by lastName asc ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,rd.*,pc.* FROM patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.branch='$branch' and rd.Company='$company' and rd.type='IPD' and (rd.dateUnregistered between '$fromDate' and '$toDate') group by rd.registrationNo order by lastName asc ");
}

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("Confinement Period");
$this->coconutTableHeader("Hospital Bill");
$this->coconutTableHeader("Professional Fee");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {

$this->coconutTableRowStart();
$this->hmoSOA_ipd_hb += $this->hmoSOA_HB($row['registrationNo']);
$this->hmoSOA_ipd_pf += $this->hmoSOA_PF($row['registrationNo']);
$this->coconutTableData($row['lastName'].", ".$row['firstName']);
$this->coconutTableData($row['dateRegistered']." - ".$row['dateUnregistered']);
$this->coconutTableData(number_format($this->hmoSOA_HB($row['registrationNo']),2));
$this->coconutTableData(number_format($this->hmoSOA_PF($row['registrationNo']),2));
$this->coconutTableRowStop();
  }
$this->coconutTableRowStart();
$this->coconutTableData("<b>Grand Total</b>");
$this->coconutTableData("");
$this->coconutTableData(number_format($this->hmoSOA_ipd_hb,2));
$this->coconutTableData(number_format($this->hmoSOA_ipd_pf,2));
$this->coconutTableRowStop();

$this->coconutTableStop();

}



public $collectionIPD_paid;
public $collectionIPD_pf;
public $collectionIPD_admitting;

public function collectionIPD($fromMonth,$fromDay,$fromYear,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$branch) {

echo "<style type='text/css'>
#rowz:hover { background-color:yellow; color:black; }
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$fromDate = $fromMonth."_".$fromDay."_".$fromYear;

$fromTime = $fromTime_hour.":".$fromTime_minutes.":".$fromTime_seconds;
$toTime = $toTime_hour.":".$toTime_minutes.":".$toTime_seconds;


$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,rd.*,pp.* from patientRecord pr,registrationDetails rd,patientPayment pp WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pp.registrationNo and rd.branch='$branch' and pp.datePaid='$fromDate' and (pp.timePaid between '$fromTime' and '$toTime')  "); 

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("Room");
$this->coconutTableHeader("Balance");
$this->coconutTableHeader("Paid");
$this->coconutTableHeader("Received By");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
echo "<Tr id='rowz'>";
$current = $this->getCurrentCredit($row['registrationNo'],"PATIENT","cashUnpaid") - $this->getCurrentPaid($row['registrationNo'],"PATIENT","cashUnpaid");
$this->collectionIPD_paid += $row['amountPaid'];
$this->coconutTableData($row['lastName'].", ".$row['firstName']);
$this->coconutTableData($row['room']);
$this->coconutTableData(number_format($current,2));
$this->coconutTableData(number_format($row['amountPaid'],2));
$this->coconutTableData($row['paidBy']);
echo "</tr>";
  }
echo "<tr>";
$this->coconutTableData("<b>TOTAL</b>");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData(number_format($this->collectionIPD_paid,2));
$this->coconutTableData("");
echo "</tr>";
echo "</tr>";
$this->coconutTableStop();

}


public function collectionIPD_admin($fromMonth,$fromDay,$fromYear,$toMonth,$toDay,$toYear) {

echo "<style type='text/css'>
#rowz:hover { background-color:yellow; color:black; }
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$fromDate = $fromYear."-".$fromMonth."-".$fromDay;
$toDate = $toYear."-".$toMonth."-".$toDay;

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,rd.*,pp.*,rd.discount from patientRecord pr,registrationDetails rd,patientPayment pp WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pp.registrationNo and (pp.datePaid between '$fromDate' and '$toDate') order by rd.registrationNo asc  "); 

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("Payment For");
$this->coconutTableHeader("OR#");
$this->coconutTableHeader("Bill");
$this->coconutTableHeader("Discount");
$this->coconutTableHeader("Paid");
$this->coconutTableHeader("Received By");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
echo "<Tr id='rowz'>";
$current = $this->getCurrentCredit($row['registrationNo'],"PATIENT","cashUnpaid") - $this->getCurrentPaid($row['registrationNo'],"PATIENT","cashUnpaid");
//$this->collectionIPD_paid += $row['amountPaid'];
$this->collectionIPD_pf += $row['pf'];
$this->collectionIPD_admitting += $row['admitting'];

$amountPd = ( ($row['amountPaid'] + $row['pf']) + $row['admitting'] );
$this->collectionIPD_paid += $amountPd;


$this->coconutTableData($row['lastName'].", ".$row['firstName']);
$this->coconutTableData($row['paymentFor']);
$this->coconutTableData($row['orNo']);
$this->coconutTableData("<font color=red>".number_format(($current - $row['discount']),2)."</font>");
$this->coconutTableData($row['discount']);
$this->coconutTableData("<font color=blue>".number_format($amountPd,2)."</font>");
$this->coconutTableData($row['paidBy']);
echo "</tr>";
  }
echo "<tr>";
$this->coconutTableData("<b>TOTAL</b>");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData(number_format($this->collectionIPD_paid,2));
$this->coconutTableData("");
echo "</tr>";
echo "</tr>";
$this->coconutTableStop();

}




public $doctorPF_ipd_price;
public $doctorPF_ipd_pf;

public function doctorPF_ipd($fromDate_month,$fromDate_day,$fromDate_year,$toDate_month,$toDate_day,$toDate_year,$show) {

echo "
<style type='text/css'>

#rowz:hover {
background-color:yellow;
}

</style>
";


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$fromDate = $fromDate_year."-".$fromDate_month."-".$fromDate_day;
$toDate = $toDate_year."-".$toDate_month."-".$toDate_day;

if( $show == "All" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,rd.*,pc.* FROM patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (rd.dateUnregistered between '$fromDate' and '$toDate') and pc.title = 'PROFESSIONAL FEE' and status not like 'DELETED_%%%%%%%' order by pc.description,pr.lastName asc ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,rd.*,pc.* FROM patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (rd.dateUnregistered between '$fromDate' and '$toDate') and type='IPD' and status not like 'DELETED_%%%%%%%' and pc.title = 'PROFESSIONAL FEE' and pc.description='$show' order by pc.description,pr.lastName asc ");
}


echo "<br><center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Name");
$this->coconutTableHeader("Branch");
$this->coconutTableHeader("Confinement Period");
$this->coconutTableHeader("Doctor");
$this->coconutTableHeader("Service");
$this->coconutTableHeader("Price / PF");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
echo "<tr id='rowz'>";
//$price = preg_split ("/\//", $row['sellingPrice']); 
$this->doctorPF_ipd_price += $row['cashUnpaid'];
$this->doctorPF_ipd_pf += $row['cashUnpaid'];
$this->coconutTableData($row['lastName'].", ".$row['firstName']);
$this->coconutTableData($row['branch']);
$this->coconutTableData($row['dateRegistered']." - ".$row['dateUnregistered']);
$this->coconutTableData($row['description']);
$this->coconutTableData($row['service']);
$this->coconutTableData($row['cashUnpaid']);
echo "</tr>";
  }
echo "<tr>";
$this->coconutTableData("<b>TOTAL</b>");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData($this->doctorPF_ipd_price."<font color=red>/</font>".$this->doctorPF_ipd_pf);
echo "</tr>";
$this->coconutTableStop();

}



public $censusRegistered_patient;

public function censusRegistered($month,$day,$year,$month1,$day1,$year1,$type,$dept) {

echo "
<style type='text/css'>
#rowz:hover {
background-color:yellow;
}
</style>
";


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$fromRegistered = $year."-".$month."-".$day;
$toRegistered = $year1."-".$month1."-".$day1;

if( $dept != "" ) {
if($type == "IPD") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,upper(pr.middleName) as middleName,rd.*,pr.Age,pr.Gender,pr.phic FROM patientRecord pr,registrationDetails rd WHERE pr.patientNo = rd.patientNo and (dateRegistered between '$fromRegistered' and '$toRegistered' ) and rd.type in ('IPD','ER','OR/DR','ICU') and rd.registeredFrom='$dept' order by CAST(rd.pxCount AS UNSIGNED), rd.pxCount asc ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,upper(pr.middleName) as middleName,rd.*,pr.Age,pr.Gender,pr.phic FROM patientRecord pr,registrationDetails rd WHERE pr.patientNo = rd.patientNo and (dateRegistered between '$fromRegistered' and '$toRegistered') and rd.type='$type' and rd.registeredFrom='$dept' order by CAST(rd.pxCount AS UNSIGNED), rd.pxCount asc ");
}
}else {

if($type == "IPD") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,upper(pr.middleName) as middleName,rd.*,pr.Age,pr.Gender,pr.phic FROM patientRecord pr,registrationDetails rd WHERE pr.patientNo = rd.patientNo and (dateRegistered between '$fromRegistered' and '$toRegistered' ) and rd.type in ('IPD','ER','OR/DR','ICU') order by CAST(rd.pxCount AS UNSIGNED), rd.pxCount asc ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,upper(pr.middleName) as middleName,rd.*,pr.Age,pr.Gender,pr.phic FROM patientRecord pr,registrationDetails rd WHERE pr.patientNo = rd.patientNo and (dateRegistered between '$fromRegistered' and '$toRegistered') and rd.type='$type' order by CAST(rd.pxCount AS UNSIGNED), rd.pxCount asc ");
}

}


echo "<br>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("PX Count");
$this->coconutTableHeader("Name");
$this->coconutTableHeader("Age");
$this->coconutTableHeader("Gender");
$this->coconutTableHeader("Service");
$this->coconutTableHeader("PHIC");
$this->coconutTableHeader("Insurance");
$this->coconutTableHeader("Attending");
$this->coconutTableHeader("Registered");
$this->coconutTableHeader("Registered By");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
echo "<Tr id='rowz'>";
$this->censusRegistered_patient += 1;
$this->coconutTableData($row['pxCount']);
$this->coconutTableData($row['lastName']." ".$row['firstName']." ".$row['middleName']);
$this->coconutTableData($row['Age']);
$this->coconutTableData($row['Gender']);
$this->coconutTableData($this->selectNow("Doctors","Specialization1","Name",$this->getAttendingDoc($row['registrationNo'],"ATTENDING")));

if( $row['phic'] == "YES" ) {
$this->coconutTableData("NH");
}else {
$this->coconutTableData("NN");
}
$this->coconutTableData($row['Company']);
$this->coconutTableData($this->getAttendingDoc($row['registrationNo'],"ATTENDING"));
$this->coconutTableData($row['timeRegistered']."@".$row['dateRegistered']);
$this->coconutTableData($row['registeredBy']);
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/Reports/Census/registrationCensusDelete.php?registrationNo=$row[registrationNo]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>");
echo "</tr>";
  }

echo "
<tr>
<td colspan='11' height='30'>&nbsp;<b>TOTAL PATIENT: ".$this->censusRegistered_patient."</b></td>
</tr>
";

//$this->coconutTableData("");
//$this->coconutTableData("<b>TOTAL PATIENT</b>");
//$this->coconutTableData("<b>".$this->censusRegistered_patient."</b>");
//$this->coconutTableData("");
//$this->coconutTableData("");
//$this->coconutTableData("");
//$this->coconutTableData("");
//$this->coconutTableData("");
$this->coconutTableStop();

}


public $specialRoom_patient;

public function getPatientSpecialRoom($type,$branch) {

echo "
<style type='text/css'>
#rowz:hover {
background-color:yellow;
}

a { text-decoration:none; color:black; }

</style>

";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,rd.registrationNo FROM patientRecord pr,registrationDetails rd WHERE pr.patientNo = rd.patientNo and rd.type='$type' and rd.branch='$branch' order by lastName asc ");

echo "<br><center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Registration#");
$this->coconutTableHeader("Name");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
echo "<tr id='rowz'>";
$this->specialRoom_patient += 1;
echo "<td>&nbsp;".$row['registrationNo']."&nbsp;</td>";
echo "<tD>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/currentPatient/patientInterface1.php?registrationNo=$row[registrationNo]' target='_blank'>".$row['lastName'].", ".$row['firstName']."</a>&nbsp;<tD>";
echo "</tr>";
  }
echo "<Tr>";
echo "<Td>&nbsp;<b>Total</b>&nbsp;</tD>";
echo "<td>&nbsp;".$this->specialRoom_patient."&nbsp;</tD>";
echo "</tr>";
echo "</table>";
}


public function checkCode($patientNo,$registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT patientNo,registrationNo FROM registrationDetails where patientNo='$patientNo' and registrationNo='$registrationNo' ");

if(mysqli_num_rows($result) == 1) {
session_start();
$_SESSION['registrationNo'] = $registrationNo;
header("Location:/COCONUT/Homepage/patientProfile_handler_homepage.php");
}else {
echo "
<script type='text/javascript'>
alert('No Matches to your Patient Code');
history.back();
</script>

";
}

}



public function transmitalDiagnosis($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT diagnosis FROM patientICD where registrationNo = '$registrationNo' ");
$x=1;
echo "<td>";
while($row = mysqli_fetch_array($result)){
echo "<font size=2>(".$x++.")".$row['diagnosis']."</font><br>";
  }
echo "</tD>";

}


public $phicTransmital_totalClaimed;

public function phicTransmital($month,$day,$year,$type) {


echo "
<style type='text/css'>

.data {
font-size:12px;
}

</style>

";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$datez = $month."_".$day."_".$year;

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT rd.registrationNo,pr.lastName,pr.firstName,pr.middleName,rd.dateRegistered,rd.dateUnregistered,sum(pc.phic) as phic FROM patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pr.phicType = '$type' and rd.dateUnregistered = '$datez' order by lastName asc ");

$x=1;

while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
$this->phicTransmital_totalClaimed += $row['phic'];
echo "<td border=0 >&nbsp;<font class='data'>".$x++."</font>&nbsp;</td>";
echo "<td width='18%'>&nbsp;<font class='data'>xxx</font> </td>";
echo "<td width='18%'><input type=text value='".$row['lastName'].", ".$row['firstName']."' style='border:0px; font-size:13px; width:auto; '> </td>";
echo "<td width='18%'><input type=text value='".$row['lastName'].", ".$row['firstName']."' style='border:0px; font-size:13px; width:auto; '> </td>";
echo "<td width='18%'><input type=text value='".$row['dateRegistered']." - ".$row['dateUnregistered']."' style='border:0px; font-size:13px; width:auto; '> </td>";
$this->transmitalDiagnosis($row['registrationNo']);
echo "<td width='18%'><input type=text value='".number_format($row['phic'],2)."' style='border:0px; font-size:15px; text-align:center; width:120px; '> </td>";
echo "</tr>";
  }
echo "<tr>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;<font size=2><b>TOTAL</b></font></tD>";
echo "<td>&nbsp;<font size=2>".number_format($this->phicTransmital_totalClaimed,2)."</font></tD>";
echo "</tR>";

}


public function addNewNote($registrationNo,$noteType,$noteBy,$noteMessage,$date,$time) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }
((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO patientNotes (registrationNo,noteType,noteBy,noteMessage,date,time)
VALUES
('".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $registrationNo) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $noteType) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $noteBy) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $noteMessage) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $date) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $time) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }


echo "<script type='text/javascript' >";
echo "alert('Your comment was Successfully Added');";
//echo  "window.location='http://".$this->getMyUrl()."/Maintenance/addCharges.php?module=$category&username=$username '";
echo "</script>";



((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



//notes kapag nka login para ma-edit at ma-delete ng user
public function showNotes($registrationNo,$noteType) {

echo "
<style type='text/css'>
#rowz:hover {
background-color:yellow;
}
a{
color:black;
text-decoration:none;
}
</style>

";


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientNotes where registrationNo = '$registrationNo' order by date asc ");

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Note By");
$this->coconutTableHeader("Date");
$this->coconutTableHeader("Time");
$this->coconutTableHeader("");
$this->coconutTableHeader("");
$this->coconutTableRowStop();


while($row = mysqli_fetch_array($result))
  {
echo "<Tr id='rowz'>";
$this->coconutTableData($row['noteBy']);
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/patientNotes/viewDetailedNote.php?noteNo=$row[noteNo]&noteType=$row[noteType]&noteBy=$row[noteBy]&registrationNo=$row[registrationNo]&noteMessage=$row[noteMessage]'>".$row['date']."</a>");
$this->coconutTableData($row['time']);
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientNotes/editNote.php?noteNo=$row[noteNo]&registrationNo=$row[registrationNo]&noteMessage=$row[noteMessage]&noteType=$row[noteType]&noteBy=$row[noteBy]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientNotes/verifyDeleteNotes.php?noteNo=$row[noteNo]&noteBy=$row[noteBy]&noteType=$row[noteType]&date=$row[date]&registrationNo=$row[registrationNo]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>&nbsp;</td>";
$this->coconutTableRowStop();
  }

$this->coconutTableStop();

}


//para sa online viewing ng patient .. wla itong edit at delete
public function showNotesGuest($registrationNo,$noteType) {

echo "
<style type='text/css'>
#rowz:hover {
background-color:yellow;
}
a{
color:black;
text-decoration:none;
}
</style>

";


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientNotes where registrationNo = '$registrationNo' order by date asc ");

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("");
$this->coconutTableHeader("Note By");
$this->coconutTableHeader("Date");
$this->coconutTableHeader("Time");
$this->coconutTableRowStop();


while($row = mysqli_fetch_array($result))
  {
echo "<Tr id='rowz'>";
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/patientNotes/viewDetailedNote.php?noteNo=$row[noteNo]&noteType=$row[noteType]&noteBy=$row[noteBy]&registrationNo=$row[registrationNo]&noteMessage=$row[noteMessage]'><font size='3' color=red>View</font></a>");
$this->coconutTableData($row['noteBy']);
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/patientNotes/viewDetailedNote.php?noteNo=$row[noteNo]&noteType=$row[noteType]&noteBy=$row[noteBy]&registrationNo=$row[registrationNo]&noteMessage=$row[noteMessage]'>".$row['date']."</a>");
$this->coconutTableData($row['time']);
//echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientNotes/editNote.php?noteNo=$row[noteNo]&registrationNo=$row[registrationNo]&noteMessage=$row[noteMessage]&noteType=$row[noteType]&noteBy=$row[noteBy]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>&nbsp;</td>";
//echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientNotes/verifyDeleteNotes.php?noteNo=$row[noteNo]&noteBy=$row[noteBy]&noteType=$row[noteType]&date=$row[date]&registrationNo=$row[registrationNo]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>&nbsp;</td>";
$this->coconutTableRowStop();
  }

$this->coconutTableStop();

}



public function getGuestComment() {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT noteBy,noteMessage,date FROM patientNotes where noteType = 'guest' order by noteNo desc  ") or die("Query fail: " . mysqli_error()); 


while($row = mysqli_fetch_array($result))
  {

if( $row['noteBy'] == "ricky" ) {
echo "<center><br><div width='auto' height='auto' style='border:1px solid blue;' >";
echo "<font size=1 color=blue>r1cky</font><br><font size=2 color=blue>".strip_tags($row['noteMessage'])."</font>";
$this->coconutBoxStop();
}else {
$this->coconutBoxStart_red("auto","auto");
echo "<font size=1 color=red>".$row['date']."</font><br><font size=2>".$row['noteMessage']."</font>";
$this->coconutBoxStop();
}

}
$connection->close();
}



/*
public function getGuestComment() {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT noteMessage,date FROM patientNotes where noteType = 'guest' order by noteNo desc ");

while($row = mysql_fetch_array($result))
  {
$this->coconutBoxStart_red("auto","auto");
echo "<font size=1 color=red>".$row['date']."</font><br><font size=2>".strip_tags($row['noteMessage'])."</font>";
$this->coconutBoxStop();
  }

mysql_close($con);

}
*/


public function expiration($month,$day,$year,$month1,$day1,$year1,$username) {


echo "
<style type='text/css'>
.data{
font-size:12px;
}

tr:hover{ background-color:yellow; color:black; }

</style>

";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$fromDate = $year."-".$month."-".$day;
$toDate = $year1."-".$month1."-".$day1;

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from inventory where (expiration between '$fromDate' and '$toDate') and status not like 'DELETED_%%%%%' order by description asc  ");

echo "<center><table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;<font class='data'>Inventory Code</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Description</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Generic</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Preparation</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Unit Cost</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>QTY</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Expiration</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Added By</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Date Added</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Time Added</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Inventory Location</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Inventory Type</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Branch</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Transition</font>&nbsp;</th>";
echo "<th>&nbsp;<font class='data'>Remarks</font>&nbsp;</th>";
//echo "<th></th>";
//echo "<th></th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;<font class='data'>".$row['inventoryCode']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['description']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['genericName']."</font>&nbsp;</td>";
echo "<td>&nbsp;<center><font class='data'>".$row['preparation']."</font></center>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['unitcost']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['quantity']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data' color=red>".$row['expiration']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['addedBy']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['dateAdded']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['timeAdded']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['inventoryLocation']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['inventoryType']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['branch']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['transition']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['remarks']."</font>&nbsp;</td>";
//echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/EDIT/editInventory.php?inventoryCode=$row[inventoryCode]&description=$row[description]&genericName=$row[genericName]&unitcost=$row[unitcost]&quantity=$row[quantity]&expiration=$row[expiration]&addedBy=$row[addedBy]&dateAdded=$row[dateAdded]&timeAdded=$row[timeAdded]&inventoryLocation=$row[inventoryLocation]&inventoryType=$row[inventoryType]&branch=$row[branch]&username=$username&transition=$row[transition]&remarks=$row[remarks]&preparation=$row[preparation]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>&nbsp;</td>";
///echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/DELETE/deleteInventory.php?inventoryCode=$row[inventoryCode]&username=$username&description=$row[description]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>&nbsp;</td>";
echo "</tr>";
  }
echo "</table>";


}


public function getMisc($username) {

echo "<style type='text/css'>";
echo "tr:hover{ background-color:yellow; color:black; }";
echo "</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM reportHeading order by reportName asc ");

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Function");
$this->coconutTableHeader("Description");
$this->coconutTableHeader("Value");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData($row['reportName']);
$this->coconutTableData($row['description']);
$this->coconutTableData($row['information']);
$this->coconutTableData("<a href='miscValue.php?function=$row[reportName]&description=$row[description]&value=$row[information]&id=$row[headingNo]&username=$username'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>");
$this->coconutTableRowStop();
  }

$this->coconutTableStop();

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}




public function getLabHeader($labTest,$itemNo,$registrationNo,$branch,$logNo,$medTech,$pathologist) {

echo "<style type='text/css'>";
//echo "tr:hover{ background-color:yellow; color:black; }";
echo "</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM labTest where labTest = '$labTest' ");

$this->coconutFormStart("get","http://".$this->getMyUrl()."/COCONUT/Results/clinicalChemistry/labTest1.php");
echo "<input type='hidden' name='registrationNo' value='$registrationNo'>";
echo "<input type='hidden' name='itemNo' value='$itemNo'>";
echo "<input type='hidden' name='labTest' value='$labTest'>";
echo "<input type='hidden' name='branch' value='$branch'>";
echo "<input type='hidden' name='logNo' value='$logNo'>";
echo "<input type='hidden' name='medTech' value='$medTech'>";
echo "<input type='hidden' name='pathologist' value='$pathologist'>";
echo "<br><br><center>";
echo "<table cellpadding=0 cellspacing=0 width='98%' rules=all border=1>";
echo "<tr>";
echo "<th>Test</th>";
echo "<th>Result</th>";
echo "<th>Normal Values</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
//echo "<td><input type=checkbox name='control[]' value='".$row['description']."' checked ></td>";
echo "<td>&nbsp;<input type=text name='desc[]' value='".$row['description']."' style='border:0px;'>&nbsp;</td>";
echo "<td width='20%'>&nbsp;<input type=text name='result[]' value='".$row['result']."' style='border:0px;'>&nbsp;</td>";
echo "<td>&nbsp;<input type=text name='normalValues[]' value='".$row['normalValues']."' style='border:0px; width:98%; font-size:13px; '>&nbsp;</td>";
echo "</tr>";
  }
$this->coconutFormStop();

echo "</table><br><br>";
$this->coconutButton("Add Result");
((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function addLabTest($labTest,$description,$normalValues) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO labTest (labTest,description,normalValues)
VALUES
('$labTest','$description','$normalValues')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

echo "<script type='text/javascript' >";
echo "alert('$description was Successfully Added to the List of Lab Test');";
//echo  "window.location='http://".$this->getMyUrl()."/Maintenance/addCharges.php?module=$category&username=$username '";
echo "</script>";



((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


public function addLabResult($logNo,$registrationNo,$itemNo,$description,$result,$normalValues,$labTest,$pathologist,$medtech) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO labTest_done (logNo,registrationNo,itemNo,description,result,normalValues,labTest,datePerformed,pathologist,medtech)
VALUES
('$logNo','$registrationNo','$itemNo','$description','$result','$normalValues','$labTest','".date("M d, Y")."','$pathologist','$medtech')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

//echo "<script type='text/javascript' >";
//echo "alert('$description was Successfully Added to the List of Lab Test');";
//echo  "window.location='http://".$this->getMyUrl()."/Maintenance/addCharges.php?module=$category&username=$username '";
//echo "</script>";



((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function getLabTest_done($registrationNo,$username) {

echo "<style type='text/css'>";
echo "tr:hover{ background-color:yellow; color:black; }";
echo "a { color:black; text-decoration:none; }";
echo "</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM labSavedResult where registrationNo = '$registrationNo' group by savedNo ");
/*
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Lab Test");
$this->coconutTableHeader("Date");
$this->coconutTableHeader("");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
*/
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
$this->coconutTableData("<a href='#'>".$row['savedNo']."</a>");
$this->coconutTableData("&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Laboratory/resultList/resultForm_output.php?registrationNo=$registrationNo&itemNo=$row[itemNo]'>".$this->selectNow("patientCharges","description","itemNo",$row['itemNo'])."</a>");
$this->coconutTableData($row['date']);

if( $this->selectNow("registeredUser","module","username",$username) == "LABORATORY" ) {
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/Results/clinicalChemistry/delete.php?savedNo=$row[savedNo]&itemNo=$row[itemNo]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>");
$this->coconutTableRowStop();
}else {
echo "<td>&nbsp;</td>";
}


  }

//$this->coconutTableStop();

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function getLabDetailed($logNo) {

echo "<style type='text/css'>";
//echo "tr:hover{ background-color:yellow; color:black; }";
echo "</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM labTest_done where logNo='$logNo' ");

echo "<br><br><center>";
echo "<table cellpadding=0 cellspacing=0 width='98%' rules=all border=1>";
echo "<tr>";
echo "<th>Test</th>";
echo "<th>Result</th>";
echo "<th>Normal Values</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;".$row['description']."&nbsp;</td>";
echo "<td>&nbsp;".$row['result']."&nbsp;</td>";
echo "<td>&nbsp;".$row['normalValues']."&nbsp;</td>";
echo "</tr>";
  }
echo "</table><br><br>";

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}





public function getRecord($patientNo,$username) {

echo "<style type='text/css'>";
echo "a { text-decoration:none; color:black; }";
echo "</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM registrationDetails where patientNo='$patientNo' order by registrationNo desc ");

echo "<br><br><center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Reg#");
$this->coconutTableHeader("Date Registered");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/Department/redirect.php?username=$username&registrationNo=$row[registrationNo]' target='window.parent'>".$row['registrationNo']."</a>");
$this->coconutTableData("<a href='#'>".$row['dateRegistered']."</a>");
$this->coconutTableRowStop();
  }
$this->coconutTableStop();
echo "<br><br>";

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public $getPHIClimit_medicine;
public $getPHIClimit_supplies;
public $getPHIClimit_room;
public $getPHIClimit_pf;
public $getPHIClimit_suppliesOnly;


public function getPHIClimit_medicine() {
return $this->getPHIClimit_medicine;
}
public function getPHIClimit_supplies() {
return $this->getPHIClimit_supplies;
}
public function getPHIClimit_room() {
return $this->getPHIClimit_room;
}
public function getPHIClimit_pf() {
return $this->getPHIClimit_pf;
}
public function getPHIClimit_suppliesOnly() {
return $this->getPHIClimit_suppliesOnly;
}

public function getPHIClimit_setter($caseType) {

echo "<style type='text/css'>";
echo "a { text-decoration:none; color:black; }";
echo "</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM phicLimit where casetype = '$caseType' ");


while($row = mysqli_fetch_array($result))
  {
$this->getPHIClimit_medicine = $row['medicine'];
$this->getPHIClimit_supplies = $row['supplies'];
$this->getPHIClimit_room = $row['room'];
$this->getPHIClimit_pf = $row['pf'];
$this->getPHIClimit_suppliesOnly = $row['suppliesOnly'];
  }
((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}




public function getPHIClimit($caseType) {

echo "<style type='text/css'>";
echo "a { text-decoration:none; color:black; }";
echo "</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM phicLimit where casetype = '$caseType' ");

echo "<br><br><center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Casetype");
$this->coconutTableHeader("Medicine");
$this->coconutTableHeader("Supplies");
$this->coconutTableHeader("Room");
$this->coconutTableHeader("PF");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData("".$row['casetype']);
$this->coconutTableData("&nbsp;".$row['medicine']);
$this->coconutTableData("&nbsp;".$row['supplies']);
$this->coconutTableData("&nbsp;".$row['room']);
$this->coconutTableData("&nbsp;".$row['pf']);
$this->coconutTableRowStop();
  }
$this->coconutTableStop();
echo "<br><br>";

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


public function getCurrentPHIC_check($registrationNo,$title) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

//if($title == "SUPPLIES") {
//$result = mysql_query("SELECT sum(pc.phic) as totalPHIC FROM registrationDetails rd,patientCharges pc where rd.registrationNo = '$registrationNo' and rd.registrationNo = pc.registrationNo and pc.phic >0 and (pc.title = 'LABORATORY' or pc.title = 'ECG' or pc.title = 'SUPPLIES' or pc.title = 'RADIOLOGY') and status = 'UNPAID' ");

//}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pc.phic) as totalPHIC FROM registrationDetails rd,patientCharges pc where rd.registrationNo = '$registrationNo' and rd.registrationNo = pc.registrationNo and pc.phic >0 and pc.title = '$title' and status = 'UNPAID' ");
//}


while($row = mysqli_fetch_array($result))
  {
return $row['totalPHIC'];
  }

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


//dispaly meds/supplies as dispense
public function dispensedNow($batchNo,$username) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE patientCharges SET departmentStatus = 'dispensedBy_$username'
WHERE batchNo='$batchNo' ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


public function compensable_checker($itemNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT inventory.phic FROM inventory,patientCharges where patientCharges.itemNo='$itemNo' and  patientCharges.chargesCode = inventory.inventoryCode ");

while($row = mysqli_fetch_array($result))
  {
return $row['phic'];
  }

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function hmo_checker($itemNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT rd.company FROM registrationDetails rd,patientCharges pc where pc.itemNo = '$itemNo' and pc.registrationNo = rd.registrationNo  ");

while($row = mysqli_fetch_array($result))
  {
return $row['company'];
  }

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


public function senior_checker($itemNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pr.senior FROM registrationDetails rd,patientCharges pc,patientRecord pr where pc.itemNo = '$itemNo' and pc.registrationNo = rd.registrationNo and rd.patientNo = pr.patientNo  ");

while($row = mysqli_fetch_array($result))
  {
return $row['senior'];
  }

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function phicLimit_compare($cols,$casetype) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT ($cols) as cols FROM phicLimit where casetype = '$casetype' ");

while($row = mysqli_fetch_array($result))
  {
return $row['cols'];
  }

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}




public function add_PHIC_limit($casetype,$medicine,$supplies,$room,$pf,$suppliesOnly) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO phicLimit (casetype,medicine,supplies,room,pf,suppliesOnly)
VALUES
('$casetype','$medicine','$supplies','$room','$pf','$suppliesOnly')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

//echo "<script type='text/javascript' >";
//echo "alert('$description was Successfully Added to the List of Lab Test');";
//echo  "window.location='http://".$this->getMyUrl()."/Maintenance/addCharges.php?module=$category&username=$username '";
//echo "</script>";



((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


public function getTotal($cols,$title,$registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($title != "") {

if( $title == "MEDICINE" || $title == "SUPPLIES" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum($cols) as cols FROM patientCharges where registrationNo = '$registrationNo' and title='$title' and  status = 'UNPAID' and departmentStatus like 'dispensedBy%%%%%%%%'  ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum($cols) as cols FROM patientCharges where registrationNo = '$registrationNo' and title='$title' and (status = 'UNPAID' or status = 'Discharged') and title not in ('MEDICINE','SUPPLIES')");
}

}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum($cols) as cols FROM patientCharges where registrationNo = '$registrationNo' and (status = 'UNPAID' or status = 'Discharged' or status = 'BALANCE') ");
}


while($row = mysqli_fetch_array($result))
  {
return $row['cols'];
  }

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);


}




public function getTotal_opd($cols,$title,$registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($title != "") {

if( $title == "MEDICINE" || $title == "SUPPLIES" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum($cols) as cols FROM patientCharges where registrationNo = '$registrationNo' and title='$title' and  (status = 'UNPAID' or status = 'PAID') and departmentStatus like 'dispensedBy%%%%%%%%'  ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum($cols) as cols FROM patientCharges where registrationNo = '$registrationNo' and title='$title' and (status = 'UNPAID' or status = 'Discharged' or status = 'PAID') ");
}

}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum($cols) as cols FROM patientCharges where registrationNo = '$registrationNo' and (status = 'UNPAID' or status = 'Discharged' or status = 'PAID') ");
}


while($row = mysqli_fetch_array($result))
  {
return $row['cols'];
  }

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);


}






public function getTotal_No_pf($cols,$title,$registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($title != "") {

if( $title == "MEDICINE" || $title == "SUPPLIES" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum($cols) as cols FROM patientCharges where registrationNo = '$registrationNo' and title='$title' and  status = 'UNPAID' and departmentStatus like 'dispensedBy%%%%%%%%'  ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum($cols) as cols FROM patientCharges where registrationNo = '$registrationNo' and title='$title' and (status = 'UNPAID' or status = 'Discharged') and title not in ('MEDICINE','SUPPLIES')");
}

}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum($cols) as cols FROM patientCharges where registrationNo = '$registrationNo' and (status = 'UNPAID' or status = 'Discharged' or status = 'BALANCE') and title not in ('PROFESSIONAL FEE') ");
}


while($row = mysqli_fetch_array($result))
  {
return $row['cols'];
  }

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);


}



public function getTotalByBatch($cols,$title,$registrationNo,$batchNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($title != "") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum($cols) as cols FROM patientCharges where registrationNo = '$registrationNo' and title='$title' and status = 'UNPAID' and batchNo = '$batchNo' ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum($cols) as cols FROM patientCharges where registrationNo = '$registrationNo' and status = 'UNPAID' and batchNo = '$batchNo' ");
}


while($row = mysqli_fetch_array($result))
  {
return $row['cols'];
  }

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);


}





public function getHighestCharges($title,$payment,$registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($title != "") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT max(total) as mataas FROM patientCharges where registrationNo = '$registrationNo' and title='$title' and $payment > 0 ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT max(total) as mataas FROM patientCharges where registrationNo = '$registrationNo' and $payment > 0 ");
}


while($row = mysqli_fetch_array($result))
  {
return $row['mataas'];
  }

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);


}


public $highestCharges_getItemNo;
public $highestCharges_getPHIC;
public $highestCharges_getCash;


public function highestCharges_getItemNo() {
return $this->highestCharges_getItemNo;
}
public function highestCharges_getPHIC() {
return $this->highestCharges_getPHIC;
}
public function highestCharges_getCash() {
return $this->highestCharges_getCash;
}


public function getHighestCharges_itemNo($title,$registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($title != "") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT itemNo,max(phic) as phic,cashUnpaid FROM patientCharges where registrationNo = '$registrationNo' and title='$title' ");
}else if($title == "") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT itemNo,phic,cashUnpaid FROM patientCharges where registrationNo = '$registrationNo' and title in ('SUPPLIES','LABORATORY','RADIOLOGY','OR/DR FEE','MISCELLANEOUS','NURSING-CHARGES') and phic > $phic ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT itemNo,phic,cashUnpaid FROM patientCharges where registrationNo = '$registrationNo' and phic > $phic");
}


while($row = mysqli_fetch_array($result))
  {
$this->highestCharges_getItemNo =  $row['itemNo'];
$this->highestCharges_getPHIC = $row['phic']; 
$this->highestCharges_getCash = $row['cashUnpaid']; 
}

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);


}

public $highestCharges_getItemNo_reverse;
public $highestCharges_getCashUnpaid_reverse;

public function highestCharges_getItemNo_reverse() {
return $this->highestCharges_getItemNo_reverse;
}
public function highestCharges_getCashUnpaid_reverse() {
return $this->highestCharges_getCashUnpaid_reverse;
}


public function getHighestCharges_itemNo_reverse($title,$registrationNo,$cash) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($title != "") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT itemNo,cashUnpaid FROM patientCharges where registrationNo = '$registrationNo' and title='$title' and cashUnpaid > $cash ");
}else if($title == "") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT itemNo,cashUnpaid FROM patientCharges where registrationNo = '$registrationNo' and (title != 'MEDICINE' or title != 'Room And Board' or title != 'PROFESSIONAL FEE') and cashUnpaid > $cash ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT itemNo,cashUnpaid FROM patientCharges where registrationNo = '$registrationNo' and cashUnpaid > $cash ");
}


while($row = mysqli_fetch_array($result))
  {
$this->highestCharges_getItemNo_reverse =  $row['itemNo'];
$this->highestCharges_getCashUnpaid_reverse = $row['cashUnpaid']; 
 }

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);


}


public $creditCharges_cash;
public $creditCharges_company;
public $creditCharges_phic;

public function creditCharges($registrationNo,$casetype) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM patientCharges where registrationNo = '$registrationNo'  ");


$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("");
$this->coconutTableHeader("Description");
$this->coconutTableHeader("Price");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("TOTAL");
$this->coconutTableHeader("Cash");
$this->coconutTableHeader("Company");
$this->coconutTableHeader("PHIC");
$this->coconutTableRowStop();


$this->coconutFormStart("get","http://".$this->getMyUrl()."/COCONUT/patientProfile/phicLimit/itemChecker.php");
$this->coconutHidden("casetype",$casetype);
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->checkCase_cash += $row['cashUnpaid'];
$this->checkCase_company += $row['company'];
$this->checkCase_phic += $row['phic'];

$this->coconutTableData("<input type='checkbox' name='itemNoz[]' value='$row[itemNo]' checked>");
$this->coconutTableData($row['description']);
$this->coconutTableData($row['sellingPrice']);
$this->coconutTableData($row['quantity']);
$this->coconutTableData($row['total']);
$this->coconutTableData($row['cashUnpaid']);
$this->coconutTableData($row['company']);
$this->coconutTableData($row['phic']);
$this->coconutTableRowStop();
  }

echo "<Tr>";
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData($this->checkCase_cash);
$this->coconutTableData($this->checkCase_company);
$this->coconutTableData($this->checkCase_phic);
echo "</tr>";
$this->coconutButton("Case Type");
$this->coconutFormStop();
$this->coconutTableStop();

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);


}



public $checkCase_phic;
public $checkCase_company;
public $checkCase_cash;

public function checkCase_phic() {
return $this->checkCase_phic;
}
public function checkCase_company() {
return $this->checkCase_company;
}
public function checkCase_cash() {
return $this->checkCase_cash;
}

public function checkCase($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


$result = mysqli_query($GLOBALS["___mysqli_ston"], " SELECT * FROM patientCharges where registrationNo = '$registrationNo'  ");

while($row = mysqli_fetch_array($result))
  {
$this->checkCase_phic = $row['phic'];
$this->checkCase_company = $row['company'];
$this->checkCase_cash = $row['cashUnpaid'];
  }

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);


}


public $getPaymentHistory_showUp_paid;

public function getPaymentHistory_showUp_paid() {
return $this->getPaymentHistory_showUp_paid;
}

public function getPaymentHistory_showUp($registrationNo) {


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


$result = mysqli_query($GLOBALS["___mysqli_ston"], " SELECT * FROM patientPayment where registrationNo = '$registrationNo' group by paymentNo ");

echo "<table border=1 cellspacing=0 celllpadding=1>";
echo "<tr>";
echo "<th>Date</th>";

echo "<th>OR#</th>";
echo "<th>Amount</th>";
echo "<th>Paid By</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
$this->getPaymentHistory_showUp_paid+=$row['amountPaid'];
echo "<td>&nbsp;".$row['datePaid']."&nbsp;</tD>";
echo "<td>&nbsp;".$row['orNo']."&nbsp;</tD>";
echo "<td>&nbsp;".number_format($row['amountPaid'],2)."&nbsp;</tD>";
echo "<td>&nbsp;".$row['paidBy']."&nbsp;</tD>";
echo "</tr>";
  }
//$this->viewPayment_rowOnly($registrationNo);
//echo "<tr>";
//echo "<td>&nbsp;<b>TOTAL</b>&nbsp;</tD>";
//echo "<tD>&nbsp;</td>";
//echo "<tD>&nbsp;".number_format( ($this->getPaymentHistory_showUp_paid + $this->viewPayment_rowOnly_total() ) ,2)."&nbsp;</td>";
//echo "<tD>&nbsp;</td>";
//echo "</tr>";
echo "</table>";


((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);


}

public $getPaymentHistory_showUp_returnPaid;

public function getPaymentHistory_showUp_returnPaid() {
return $this->getPaymentHistory_showUp_returnPaid;
}

public function getPaymentHistory_showUp_returnPaid_setter($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


$result = mysqli_query($GLOBALS["___mysqli_ston"], " SELECT sum(amountPaid) as total FROM patientPayment where registrationNo = '$registrationNo'  ");


while($row = mysqli_fetch_array($result))
  {
$this->getPaymentHistory_showUp_returnPaid+=$row['total'];
  }
((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);


}



public $getDischargedPatient_amountPaid;

public function getDischargedPatient($month,$day,$year,$month1,$day1,$year1,$branch) {

$fromDate = $year."-".$month."-".$day;
$toDate = $year1."-".$month1."-".$day1;

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


$result = mysqli_query($GLOBALS["___mysqli_ston"], " SELECT rd.registrationNo,pr.lastName,pr.firstName,rd.room FROM registrationDetails rd,patientRecord pr WHERE rd.patientNo = pr.patientNo and (rd.dateUnregistered between '$fromDate' and '$toDate') ");

echo "<Table border=1 cellpadding=1 cellspacing=0>";
echo "<tr>";
echo "<th>Patient</th>";
echo "<th>Room</th>";
echo "<th>&nbsp;Amount Paid&nbsp;</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
$this->getPaymentHistory_showUp_returnPaid_setter($row['registrationNo']);
echo "<td>&nbsp;".$row['lastName'].", ".$row['firstName']."&nbsp;</td>";
echo "<td>&nbsp;".$row['room']."&nbsp;</td>";
echo "<tD>&nbsp;".$this->getPaymentHistory_showUp_returnPaid()."&nbsp;</tD>";
$this->getDischargedPatient_amountPaid+=$this->getPaymentHistory_showUp_returnPaid();
echo "</tr>";
  }
echo "<Tr>";
echo "<Td>&nbsp;<b>Total</b></tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;<b>".$this->getDischargedPatient_amountPaid."</b></tD>";
echo "</tr>";
echo "</table>";



}




public function getCriticalLevel($dept) {


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


$result = mysqli_query($GLOBALS["___mysqli_ston"], " SELECT description,genericName,quantity,criticalLevel FROM inventory where criticalLevel >= quantity and criticalLevel != 0 and status not like 'DELETED_%%%%%%%' and inventoryLocation = '$dept' ");

echo "<Table border=1 cellpadding=1 cellspacing=0>";
echo "<tr>";
echo "<th>Description</th>";
echo "<th>Generic</th>";
echo "<th>&nbsp;QTY&nbsp;</th>";
echo "<th>Critical Level</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;".$row['description']."&nbsp;</tD>";
echo "<td>&nbsp;".$row['genericName']."&nbsp;</tD>";
echo "<td>&nbsp;".$row['quantity']."&nbsp;</tD>";
echo "<td>&nbsp;".$row['criticalLevel']."&nbsp;</tD>";
echo "</tr>";
  }

echo "</table>";

}




public function getMedCensus($description,$month,$day,$year) {

$date = $month."_".$day."_".$year;

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


$result = mysqli_query($GLOBALS["___mysqli_ston"], " SELECT sum(quantity) as totalQTY FROM patientCharges where description = '$description' and dateCharge = '$date' and departmentStatus like 'dispensedBy%%%%%'   ");


while($row = mysqli_fetch_array($result))
  {
return $row['totalQTY'];
  }



}

public function requestDeletion($itemNo,$registrationNo,$description,$quantity,$username,$show,$desc,$reason,$requestDeleteBy) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO forDeletion (itemNo,registrationNo,description,quantity,username,showType,descType,reason,requestDeleteBy)
VALUES
('$itemNo','$registrationNo','$description','$quantity','$username','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $show) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','$desc','$reason','$requestDeleteBy')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

$this->gotoPage("http://".$this->getMyUrl()."/COCONUT/patientProfile/patientCharges.php?registrationNo=$registrationNo&username=$requestDeleteBy&show=$show&desc=$desc");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function getRequestToDelete($username) {

echo "<style type='text/css'>
tr:hover { background-color:yellow; color:black; }
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM forDeletion where approvedBy = '' ");


echo "<center><Br><font size=2 color=red>Request to Delete</font><br>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Name - Description");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("Request By");
$this->coconutTableHeader("Reason");
$this->coconutTableHeader("");
$this->coconutTableHeader("");
$this->coconutTableRowStop();

while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$descriptionZ = preg_split ("/\-/", $row['description']); 
$this->coconutTableData($row['description']);
$this->coconutTableData($row['quantity']);
$this->coconutTableData($row['requestDeleteBy']);
$this->coconutTableData($row['reason']);
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/verifyDelete_requested.php?itemNo=$row[itemNo]&registrationNo=$row[registrationNo]&description=$row[description]&quantity=$row[quantity]&username=$row[username]&show=$row[showType]&desc=$row[descType]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/check.jpeg'></a>");
$this->coconutTableData("<a href='cancelRequest.php?itemNo=$row[itemNo]&username=$username'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>");
$this->coconutTableRowStop();
  }

$this->coconutTableStop();

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


public $summarizeCol_grandTotal;
public $summarizeCol_payment;
public $summarizeCol_bal;

public function getSummarizeCollection($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$type) {

$myDatez = $year."-".$month."-".$day;
$myFrom = $fromTime_hour.":".$fromTime_minutes.":".$fromTime_seconds;
$myTo = $toTime_hour.":".$toTime_minutes.":".$toTime_seconds;

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($type == "OPD") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.paidBy,pr.lastName,pr.firstName,rd.room,sum(pc.cashUnpaid) as totalBal,sum(cashPaid) as totalPaid FROM patientCharges pc,registrationDetails rd,patientRecord pr WHERE pc.registrationNo = rd.registrationNo and rd.patientNo = pr.patientNo and pc.datePaid = '$myDatez' and ( pc.timePaid between '$myFrom' and '$myTo' ) and rd.type like 'OPD%%%%' group by pc.registrationNo order by pc.paidBy,pr.lastName ");
}else  {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pp.paidBy,pp.amountPaid,pp.datePaid,rd.room,sum(pc.total) as total,pr.lastName,pr.firstName from patientPayment pp,registrationDetails rd,patientCharges pc,patientRecord pr WHERE pp.registrationNo = rd.registrationNo and rd.patientNo = pr.patientNo and pp.datePaid = '$myDatez' and (pp.timePaid between '$myFrom' and '$myTo' ) and pp.paymentFor not in ('BILLED','REFUND') and rd.type='IPD' group by pp.paymentNo ");
}


echo "<center><br>";
echo "<table border='1' cellspacing=0>";
echo "<tr>";
echo "<th>Patient</th>";
echo "<th>Room</th>";
if($type == "OPD") {
echo "<th>Grand Total</th>";
}else {

}

echo "<th>Payment</th>";
if($type == "OPD") {
echo "<th>Balance</th>";
}else {

}
echo "<th>Received By</th>";
echo "</tr>";

while($row = mysqli_fetch_array($result))
  {

if($type == "OPD") {
  echo "<tr>";
$this->summarizeCol_grandTotal+=($row['totalPaid'] + $row['totalBal'] );
$this->summarizeCol_payment+=$row['totalPaid'];
$this->summarizeCol_bal+=$row['totalBal'];


  echo "<td>" . $row['lastName'] . ", ".$row['firstName']."</td>";
  echo "<td>" . $row['room'] . "</td>";
  echo "<td>&nbsp;" . ($row['totalPaid'] + $row['totalBal'] ) . "</td>";
  echo "<td>&nbsp;" . $row['totalPaid'] . "</td>";
    echo "<td>&nbsp;" . $row['totalBal'] . "</td>";
    echo "<td>&nbsp;" . $row['paidBy'] . "</td>";
  echo "</tr>";
}else {
$this->summarizeCol_payment+=$row['amountPaid'];
  echo "<td>&nbsp;" . $row['lastName'] . ", ".$row['firstName']."&nbsp;</td>";
  echo "<td>&nbsp;" . $row['room'] . "&nbsp;</td>";
  //echo "<td>&nbsp;</td>";
  echo "<td>&nbsp;".number_format($row['amountPaid'],2)."&nbsp;</td>";
   // echo "<td>&nbsp;</td>";
    echo "<td>&nbsp;".$row['paidBy']."</td>";
  echo "</tr>";
}  



}
echo "<Tr>";
echo "<td><b><center>Total</center></b></tD>";
echo "<td>&nbsp;</td>";
if($type == "OPD") {
echo "<td>&nbsp;".number_format($this->summarizeCol_grandTotal,2)."</td>";
}else {

}

echo "<td>&nbsp;".number_format($this->summarizeCol_payment,2)."</td>";
if($type == "OPD") {
echo "<td>&nbsp;".number_format($this->summarizeCol_bal,2)."</td>";
}else {

}
echo "<tD>&nbsp;</tD>";
echo "</tr>";
echo "</table>";

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}






public function getAttendingDoc($registrationNo,$service) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT description from patientCharges where registrationNo = '$registrationNo' and service like '%$service%' and status = 'UNPAID'  ");

while($row = mysqli_fetch_array($result))
  {
return $row['description'];
  }

}






public function sumPartial($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(amountPaid) as total FROM patientPayment WHERE registrationNo = '$registrationNo' ");

while($row = mysqli_fetch_array($result))
  {
return $row['total'];
  }

}

public function rounded($n,$x=5) {
return round( ($n+$x/2) / $x ) * $x;
}


public $soap_objectivez;
public $soap_subjectivez;
public $soap_assessmentz;
public $soap_planz;

public function soap_objectivez() {
return $this->soap_objectivez;
}
public function soap_subjectivez() {
return $this->soap_subjectivez;
}
public function soap_assessmentz() {
return $this->soap_assessmentz;
}
public function soap_planz() {
return $this->soap_planz;
}
public function soap_setter($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT subjective,objective,assessment,plan FROM SOAP WHERE registrationNo = '$registrationNo' ");

while($row = mysqli_fetch_array($result))
  {
$this->soap_objectivez = $row['objective'];
$this->soap_subjectivez = $row['subjective'];
$this->soap_assessmentz = $row['assessment'];
$this->soap_planz = $row['plan'];
  }

}





public function addNewPackage($description,$price,$pf) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }
((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO package (description,price,pf)
VALUES
('".$description."','".$price."','".$pf."')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }


echo "<script type='text/javascript' >";
echo "alert('Package Successfully Added');";
//echo  "window.location='http://".$this->getMyUrl()."/Maintenance/addCharges.php?module=$category&username=$username '";
echo "</script>";



((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}




public function soap_charges_auto($registrationNo,$title) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT description FROM patientCharges WHERE registrationNo = '$registrationNo' and title = '$title' ");

$x=1;
while($row = mysqli_fetch_array($result))
  {
echo $row['description']." , ";
  }

}




public function totalItems($registrationNo,$title) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(description) as total FROM patientCharges WHERE registrationNo = '$registrationNo' and title = '$title' ");

while($row = mysqli_fetch_array($result))
  {
return $row['total'];
  }

}






public $individual_doc_PF_hmo;
public $individual_doc_PF_phic;
public $individual_doc_PF_cash;
public $individual_doc_PF_total;
public $individual_doc_PF_patient=0;

public function individual_doc_PF($name,$month,$day,$year,$month1,$day1,$year1) {

echo "
<style type='text/css'>
#xxx:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$datez = $year."-".$month."-".$day;
$datez1 = $year1."-".$month1."-".$day1;

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT rd.registrationNo,rd.dateUnregistered,rd.dateRegistered,pr.lastName,pr.firstName,rd.Company,pc.service,pc.total,pc.timeCharge,pc.company,pc.phic,pc.cashUnpaid FROM patientCharges pc,registrationDetails rd,patientRecord pr WHERE pc.registrationNo = rd.registrationNo and rd.patientNo = pr.patientNo and pc.description = '$name' and (rd.dateUnregistered between '$datez' and '$datez1' and status not like 'DELETED%%%%%%%') and (rd.type='IPD' or rd.type='OR/DR' or rd.type='ICU') order by pr.lastName   ");

echo "

<font size=4>$name</font><br>
<Br><br><center><table width='80%' border=1 cellpadding=0 cellspacing=0 rules='all'>";
echo "<tr>";
echo "<Th>Patient</th>";
echo "<Th>&nbsp;</th>";
echo "<th>&nbsp;<font size=2>Admission</font>&nbsp;</th>";
echo "<Th>&nbsp;HMO&nbsp;</th>";
echo "<Th>&nbsp;PHIC&nbsp;</th>";
echo "<Th>&nbsp;CASH&nbsp;</th>";
echo "<Th>&nbsp;TOTAL PF&nbsp;</th>";
echo "</tR>";
while($row = mysqli_fetch_array($result))
  {

$this->individual_doc_PF_hmo += $row['company'];
$this->individual_doc_PF_phic += $row['phic'];
$this->individual_doc_PF_cash += $row['cashUnpaid'];
$this->individual_doc_PF_total += $row['total'];
$this->individual_doc_PF_patient ++;
echo "<tR id='xxx' >";
echo "<Td>&nbsp;".strtoupper($row['lastName']).", ".strtoupper($row['firstName'])."&nbsp;</td>";
echo "<td>&nbsp;".$row['Company']."</td>";
echo "<Td>&nbsp;".$row['dateRegistered']." to ".$row['dateUnregistered']."&nbsp;</tD>";
echo "<td>&nbsp;".number_format($row['company'],2)."</td>";
echo "<td>&nbsp;".number_format($row['phic'],2)."</td>";
echo "<td>&nbsp;".number_format($row['cashUnpaid'],2)."</td>";
echo "<td>&nbsp;".number_format($row['total'],2)."</td>";
echo "</tr>";
}
echo "<tr>";
echo "<td>&nbsp;Total Patient:&nbsp;".$this->individual_doc_PF_patient."</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;".number_format($this->individual_doc_PF_hmo,2)."</td>";
echo "<td>&nbsp;".number_format($this->individual_doc_PF_phic,2)."</td>";
echo "<td>&nbsp;".number_format($this->individual_doc_PF_cash,2)."</td>";
echo "<td>&nbsp;".number_format($this->individual_doc_PF_total,2)."</td>";
echo "</tr>";
echo "</table>";
}

//START NG BAGONG PHIC TRANSMITAL

public function checkTransmitted($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT registrationNo from phicTransmit WHERE registrationNo='$registrationNo' "); 

return mysqli_num_rows($result);

}

public function getPatientICD_diagnosis_transmittal_check($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT diagnosis from patientICD WHERE registrationNo='$registrationNo'  "); 

while($row = mysqli_fetch_array($result))
  {
return mysqli_num_rows($result);
  }

}

public function getPatientICD_diagnosis_transmittal($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT diagnosis from patientICD WHERE registrationNo='$registrationNo' order by icdCode asc "); 
echo "<td>";
while($row = mysqli_fetch_array($result))
  {
echo "<font size=2>".$row['diagnosis'].",</font>";
  }
echo "</td>";
}


public $getTransmital_room;
public $getTransmital_lab;
public $getTransmital_meds;
public $getTransmital_or;
public $getTransmital_doc;
public $getTransmital_subTotal;
public $getTransmital_totalAmount;

public function getTransmital($dateDischarged,$dateDischarged1,$package,$type) {

echo "<style type='text/css'>";

echo "

.member{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 100%;
	border-color:white white white white;
	font-size:13px;

}

";

echo "</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


if( $type == "All" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT rd.registrationNo,rd.PIN,pr.lastName,pr.firstName,pr.age,pr.gender,rd.dateRegistered,rd.dateUnregistered from registrationDetails rd,patientRecord pr where pr.patientNo = rd.patientNo and pr.PHIC = 'YES' and (rd.dateUnregistered between '$dateDischarged' and '$dateDischarged1') order by pr.lastName asc ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT rd.registrationNo,rd.PIN,pr.lastName,pr.firstName,pr.age,pr.gender,rd.dateRegistered,rd.dateUnregistered from registrationDetails rd,patientRecord pr where pr.patientNo = rd.patientNo and (rd.dateUnregistered between '$dateDischarged' and '$dateDischarged1') and pr.phicType like '$type%' order by pr.lastName asc ");
}


$this->coconutFormStart("get","readyTransmit.php");
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";


$this->getTransmital_room += $this->getTotal("phic","Room And Board",$row['registrationNo']);
$this->getTransmital_lab += $this->getTotal("phic","LABORATORY",$row['registrationNo']);
$this->getTransmital_meds += $this->getTotal("phic","MEDICINE",$row['registrationNo']);
$this->getTransmital_or += $this->getTotal("phic","OR/DR/ER Fee",$row['registrationNo']);
$this->getTransmital_doc += $this->getTotal("phic","PROFESSIONAL FEE",$row['registrationNo']);
$this->getTransmital_subTotal += ( $this->getTotal("phic","Room And Board",$row['registrationNo']) + $this->getTotal("phic","LABORATORY",$row['registrationNo']) + $this->getTotal("phic","MEDICINE",$row['registrationNo']) + $this->getTotal("phic","OR/DR/ER Fee",$row['registrationNo']) );
$this->getTransmital_totalAmount += ( $this->getTotal("phic","Room And Board",$row['registrationNo']) + $this->getTotal("phic","LABORATORY",$row['registrationNo']) + $this->getTotal("phic","MEDICINE",$row['registrationNo']) + $this->getTotal("phic","OR/DR/ER Fee",$row['registrationNo']) + $this->getTotal("phic","PROFESSIONAL FEE",$row['registrationNo']) );

/*
if( $this->checkTransmitted($row['registrationNo']) == 0 ) {
echo "<td><input type='checkbox' name='regNo[]' value='".$row['registrationNo']."'></tD>";
}else if( $this->checkTransmitted($row['registrationNo']) > 0 ) {
echo "<Td>&nbsp;</td>";
}else { }
*/

echo "<td><font size=2>".$row['PIN']."</font></tD>"; // header [ PHIC NUMBER ]
echo "<Td><input type=text class='member' value='".$row['lastName'].", ".$row['firstName']."'></td>"; // header [ NAME OF MEMBER ]
echo "<Td><font size=2>".$row['lastName'].", ".$row['firstName']."</font></td>"; // header [ NAME/RELATIONSHIP ] 
//echo "<Td>&nbsp;".$row['phicType']."</td>"; // header [ member ]
//echo "<Td><font size=2>".$row['age']."</font></td>"; // header [ age ]
//echo "<Td><font size=2>".$row['gender']."</font></td>"; // header [ sex ]
echo "<td><font size=2>".$row['dateRegistered']." - ".$row['dateUnregistered']."</font></tD>"; // header [ Confinement Period ]
if( $this->getPatientICD_diagnosis_transmittal_check($row['registrationNo']) > 0 ) {
$this->getPatientICD_diagnosis_transmittal($row['registrationNo']); // header [ ICD - FINAL DIAGNOSIS ] 
}else {
echo "<td>&nbsp;</td>";
}

if( $this->checkTransmitted($row['registrationNo']) == 0 ) {
echo "<td><input type='checkbox' name='regNo[]' value='".$row['registrationNo']."'></tD>";
}else if( $this->checkTransmitted($row['registrationNo']) > 0 ) {
echo "<Td>&nbsp;</td>";
}else { }

if($package == "no") {
//echo "<td>&nbsp;<font size=2>".$this->getTotal("phic","Room And Board",$row['registrationNo'])."</font></td>"; // header [ ROOM ]
//echo "<td>&nbsp;<font size=2>".number_format($this->getTotal("phic","LABORATORY",$row['registrationNo']),2)."</font></td>"; // header [ LAB ]
//echo "<td>&nbsp;<font size=2>".number_format($this->getTotal("phic","MEDICINE",$row['registrationNo']),2)."</font></td>"; // header [ MEDS ]
//echo "<td>&nbsp;<font size=2>".number_format($this->getTotal("phic","OR/DR/ER Fee",$row['registrationNo']),2)."</font></td>"; // header [ O.R ]
//echo "<td>&nbsp;<font size=2>".number_format($this->getTotal("phic","PROFESSIONAL FEE",$row['registrationNo']),2)."</font></td>"; // header [ DOCTOR CHARGES ]
//echo "<td>&nbsp;<font size=2>".number_format( $this->getTotal("phic","Room And Board",$row['registrationNo']) + $this->getTotal("phic","LABORATORY",$row['registrationNo']) + $this->getTotal("phic","MEDICINE",$row['registrationNo']) + $this->getTotal("phic","OR/DR/ER Fee",$row['registrationNo']),2 )."</font></td>"; // header [ SUB TOTAL ]
}else {
//echo "<td>&nbsp;</tD>";
//echo "<td>&nbsp;</tD>";
//echo "<td>&nbsp;</tD>";
//echo "<td>&nbsp;</tD>";
//echo "<td>&nbsp;</tD>";
//echo "<td>&nbsp;</tD>";
}
//echo "<td>&nbsp;<font size=2>".number_format( $this->getTotal("phic","Room And Board",$row['registrationNo']) + $this->getTotal("phic","LABORATORY",$row['registrationNo']) + $this->getTotal("phic","MEDICINE",$row['registrationNo']) + $this->getTotal("phic","OR/DR/ER Fee",$row['registrationNo']) + $this->getTotal("phic","PROFESSIONAL FEE",$row['registrationNo']) + $this->getTotal("phic","SUPPLIES",$row['registrationNo']) ,2 )."</font></td>"; // header [ TOTAL AMOUNT ]
echo "</tr>";  
}
echo "<centeR>";
$this->coconutButton("Transmit");
echo "</center>";
$this->coconutFormStop();
echo "<tr>";
echo "<td>&nbsp;</tD>"; // PHIC NO#
echo "<td>&nbsp;</tD>";// NAME OF MEMBER
echo "<td>&nbsp;</tD>";// NAME/RELATIONSHIP
//echo "<td>&nbsp;</tD>";// member
//echo "<td>&nbsp;</tD>";// AGE
//echo "<td>&nbsp;</tD>";//SEX
echo "<td>&nbsp;</tD>";// CONFINEMENT PERIOD
//echo "<td>&nbsp;<b><font size=2>GRAND TOTAL</font></b></tD>";// FINAL DIAGNOSIS
echo "<td>&nbsp;</tD>";// ICD CODE HEADER
//echo "<td>&nbsp;".number_format($this->getTransmital_room,2)."</tD>"; // ROOM
//echo "<td>&nbsp;".number_format($this->getTransmital_lab,2)."</tD>"; // LAB
//echo "<td>&nbsp;".number_format($this->getTransmital_meds,2)."</tD>"; // MEDS
//echo "<td>&nbsp;".number_format($this->getTransmital_or,2)."</tD>"; // O.R
//echo "<td>&nbsp;".number_format($this->getTransmital_doc,2)."</tD>"; // DOCTORS CHARGES
//echo "<td>&nbsp;".number_format($this->getTransmital_subTotal,2)."</tD>"; // SUBTOTAL
//echo "<td>&nbsp;".number_format($this->getTransmital_totalAmount,2)."</tD>"; //TOTAL AMOUNT
echo "<td>&nbsp;</td>";
echo "</tr>";
echo "</table>";

}


public $getTransmitted_room;
public $getTransmitted_lab;
public $getTransmitted_meds;
public $getTransmitted_or;
public $getTransmitted_doc;
public $getTransmitted_subTotal;
public $getTransmitted_totalAmount;


public function getTransmitted($dateDischarged,$dateDischarged1,$package,$type,$switch) {

echo "<style type='text/css'>";

echo "

.member{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 130px;
	border-color:white white white white;
	font-size:13px;

}

";

echo "</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


if( $type == "All"  ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT rd.registrationNo,rd.PIN,UPPER(pr.lastName) as lastName,UPPER(pr.firstName) as firstName,pr.age,pr.gender,rd.dateRegistered,rd.dateUnregistered,pt.transmitNo from registrationDetails rd,patientRecord pr,phicTransmit pt where pr.patientNo = rd.patientNo and (rd.dateUnregistered between '$dateDischarged' and '$dateDischarged1') and pr.PHIC = 'YES' and pt.registrationNo = rd.registrationNo group by pt.registrationNo order by pr.lastName asc ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT rd.registrationNo,rd.PIN,pr.lastName,pr.firstName,pr.age,pr.gender,rd.dateRegistered,rd.dateUnregistered,pt.transmitNo from registrationDetails rd,patientRecord pr,phicTransmit pt where pr.patientNo = rd.patientNo and (rd.dateUnregistered between '$dateDischarged' and '$dateDischarged1') and pr.phicType like '$type%' and pt.registrationNo = rd.registrationNo group by pt.registrationNo order by pr.lastName asc ");
}

$this->coconutFormStart("get","transmitted_selected.php");
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";

$this->getTransmitted_room += $this->getTotal("phic","Room And Board",$row['registrationNo']);
$this->getTransmitted_lab += $this->getTotal("phic","LABORATORY",$row['registrationNo']);
$this->getTransmitted_meds += $this->getTotal("phic","MEDICINE",$row['registrationNo']);
$this->getTransmitted_or += $this->getTotal("phic","OR/DR/ER Fee",$row['registrationNo']);
$this->getTransmitted_doc += $this->getTotal("phic","PROFESSIONAL FEE",$row['registrationNo']);
$this->getTransmitted_subTotal += ( $this->getTotal("phic","Room And Board",$row['registrationNo']) + $this->getTotal("phic","LABORATORY",$row['registrationNo']) + $this->getTotal("phic","MEDICINE",$row['registrationNo']) + $this->getTotal("phic","OR/DR/ER Fee",$row['registrationNo'])  + $this->getTotal("phic","SUPPLIES",$row['registrationNo']) );

if( $package == "no" ) {
$this->getTransmitted_totalAmount += ( $this->getTotal("phic","Room And Board",$row['registrationNo']) + $this->getTotal("phic","LABORATORY",$row['registrationNo']) + $this->getTotal("phic","MEDICINE",$row['registrationNo']) + $this->getTotal("phic","OR/DR/ER Fee",$row['registrationNo']) + $this->getTotal("phic","PROFESSIONAL FEE",$row['registrationNo']) );
}else { $this->getTransmitted_totalAmount += $this->selectNow("phicTransmit","package","registrationNo",$row['registrationNo']);  }



//echo "<td><input type='checkbox' name='transmitNo[]' value='$row[transmitNo]'></tD>";
echo "<td><font size=3>".$row['PIN']."</font></tD>"; // header [ PHIC NUMBER ]
//echo "<Td><input type=text class='member' value='".$row['lastName'].", ".$row['firstName']."'></td>"; // header [ NAME OF MEMBER ]

if($this->selectNow("phicTransmit","reconciled","transmitNo",$row['transmitNo']) != "yes") {
echo "<Td><font size=3>".$row['lastName'].", ".$row['firstName']."</font></td>"; // header [ NAME/RELATIONSHIP ] 
}else {
echo "<Td><font size=3 color=red>".$row['lastName'].", ".$row['firstName']."</font></td>"; // header [ NAME/RELATIONSHIP ] 
}
//echo "<Td>&nbsp;".$row['phicType']."</td>"; // header [ member ]
//echo "<Td><font size=2>".$row['age']."</font></td>"; // header [ age ]
//echo "<Td><font size=2>".$row['gender']."</font></td>"; // header [ sex ]
echo "<td><font size=3>".$row['dateRegistered']." - ".$row['dateUnregistered']."</font></tD>"; // header [ Confinement Period ]
if( $this->getPatientICD_diagnosis_transmittal_check($row['registrationNo']) > 0 ) {
$this->getPatientICD_diagnosis_transmittal($row['registrationNo']); // header [ ICD - FINAL DIAGNOSIS ] 
}else {
echo "<td>&nbsp;</td>";
}

if($package == "no") {
//echo "<td>&nbsp;<font size=2>".number_format($this->getTotal("phic","Room And Board",$row['registrationNo']),2)."</font></td>"; // header [ ROOM ]
//echo "<td>&nbsp;<font size=2>".number_format($this->getTotal("phic","LABORATORY",$row['registrationNo']),2)."</font></td>"; // header [ LAB ]
//echo "<td>&nbsp;<font size=2>".number_format($this->getTotal("phic","MEDICINE",$row['registrationNo']),2)."</font></td>"; // header [ MEDS ]
//echo "<td>&nbsp;<font size=2>".number_format($this->getTotal("phic","OR/DR/ER Fee",$row['registrationNo']),2)."</font></td>"; // header [ O.R ]
//echo "<td>&nbsp;<font size=2>".number_format($this->getTotal("phic","PROFESSIONAL FEE",$row['registrationNo']),2)."</font></td>"; // header [ DOCTOR CHARGES ]
//echo "<td>&nbsp;<font size=2>".number_format( $this->getTotal("phic","Room And Board",$row['registrationNo']) + $this->getTotal("phic","LABORATORY",$row['registrationNo']) + $this->getTotal("phic","MEDICINE",$row['registrationNo']) + $this->getTotal("phic","OR/DR/ER Fee",$row['registrationNo']),2 )."</font></td>"; // header [ SUB TOTAL ]
//echo "<td>&nbsp;<input type=text name='totalAmount' value='".number_format( $this->getTotal("phic","Room And Board",$row['registrationNo']) + $this->getTotal("phic","LABORATORY",$row['registrationNo']) + $this->getTotal("phic","MEDICINE",$row['registrationNo']) + $this->getTotal("phic","OR/DR/ER Fee",$row['registrationNo']) + $this->getTotal("phic","PROFESSIONAL FEE",$row['registrationNo']) + $this->getTotal("phic","SUPPLIES",$row['registrationNo']) ,2 )."' style='border:0px; width:150px; height:20px; font-size:16px; color:black;' ></td>"; // header [ TOTAL AMOUNT ]
}else {
//echo "<td>&nbsp;</tD>";
//echo "<td>&nbsp;</tD>";
//echo "<td>&nbsp;</tD>";
//echo "<td>&nbsp;</tD>";
//echo "<td>&nbsp;</tD>";
//echo "<td>&nbsp;</tD>";
if( $this->selectNow("phicTransmit","package","registrationNo",$row['registrationNo']) > 0 ) {
echo "<td>&nbsp;".number_format($this->selectNow("phicTransmit","package","registrationNo",$row['registrationNo']),2)."</tD>";
}else { echo "<Td>&nbsp;</tD>";  }
}


if( $switch == "on" ) {
echo "<td>&nbsp;<a href='/COCONUT/philhealth/editTransmitter.php?registrationNo=$row[registrationNo]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>&nbsp;</td>";
}else { }

echo "<td><input type='checkbox' name='transmitNo[]' value='$row[transmitNo]'></tD>";



echo "</tr>";  
}
echo "<tr>";
echo "<td>&nbsp;</tD>"; // PHIC NO#
echo "<td>&nbsp;</tD>";// NAME OF MEMBER
echo "<td>&nbsp;</tD>";// NAME/RELATIONSHIP
//echo "<td>&nbsp;</tD>";// member
//echo "<td>&nbsp;</tD>";// AGE
//echo "<td>&nbsp;</tD>";//SEX
echo "<td>&nbsp;</tD>";// CONFINEMENT PERIOD
//echo "<td>&nbsp;<b><font size=2></font></b></tD>";// FINAL DIAGNOSIS
//echo "<td>&nbsp;</td>";
if( $package == "no" ) {
//echo "<td>&nbsp;".number_format($this->getTransmitted_room,2)."</tD>"; // ROOM
//echo "<td>&nbsp;".number_format($this->getTransmitted_lab,2)."</tD>"; // LAB
//echo "<td>&nbsp;".number_format($this->getTransmitted_meds,2)."</tD>"; // MEDS
//echo "<td>&nbsp;".number_format($this->getTransmitted_or,2)."</tD>"; // O.R
//echo "<td>&nbsp;".number_format($this->getTransmitted_doc,2)."</tD>"; // DOCTORS CHARGES
//echo "<td>&nbsp;".number_format($this->getTransmitted_subTotal,2)."</tD>"; // SUBTOTAL
//echo "<td>&nbsp;".number_format($this->getTransmitted_totalAmount,2)."</tD>"; //TOTAL AMOUNT

}else {
//echo "<Td>&nbsp;</tD>";
//echo "<Td>&nbsp;</tD>";
//echo "<Td>&nbsp;</tD>";
//echo "<Td>&nbsp;</tD>";
//echo "<Td>&nbsp;</tD>";
//echo "<Td>&nbsp;</tD>";
//echo "<Td>&nbsp;".number_format($this->getTransmitted_totalAmount,2)."</tD>";

}


echo "</tr>";
echo "<center>";
$this->coconutButton("Print");
echo "</center>";
$this->coconutFormStop();

echo "</table>";

}

//END NG BAGONG PHIC TRANSMITAL








///////////////////DITO AQ NAGSIMULA NG BAGONG CODING PRA SA PHIC FULLER

public function getMaximumTotal($registrationNo,$case) { //kkuhain ang maximum sa medicine 

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if($case == "ordinaryCase") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT MAX(pc.cashUnpaid) as totalz,pc.itemNo from patientCharges pc,inventory i where pc.chargesCode = i.inventoryCode and pc.registrationNo = '$registrationNo' and pc.sellingPrice > 0 and pc.title = 'MEDICINE' and pc.phic = 0 and i.phic = 'yes' and pc.status = 'UNPAID' ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT MAX(pc.cashUnpaid) as totalz,pc.itemNo from patientCharges pc,inventory i where pc.chargesCode = i.inventoryCode and pc.registrationNo = '$registrationNo' and pc.sellingPrice > 0 and pc.title = 'MEDICINE' and pc.phic = 0 and pc.status = 'UNPAID' ");
}




while($row = mysqli_fetch_array($result))
  {
return $row['totalz']."_".$row['itemNo'];
  }

}



public function getMaximumTotal_checker($registrationNo,$case) { //check kung meron pang pde Lagay sa phic 

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if( $case == "ordinaryCase" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT MAX(pc.cashUnpaid) as totalz,pc.itemNo from patientCharges pc,inventory i where pc.chargesCode = i.inventoryCode and pc.registrationNo = '$registrationNo' and pc.title = 'MEDICINE' and pc.phic = 0 and i.phic='yes' ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT MAX(pc.cashUnpaid) as totalz,pc.itemNo from patientCharges pc,inventory i where pc.chargesCode = i.inventoryCode and pc.registrationNo = '$registrationNo' and pc.title = 'MEDICINE' and pc.phic = 0 ");
}



while($row = mysqli_fetch_array($result))
  {
return mysqli_num_rows($result);
  }

}



///PF 

public function getMaximumTotal_PF($registrationNo,$case) { //kkuhain ang maximum sa medicine 

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


if( $case == "ordinaryCase" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT MAX(pc.cashUnpaid) as totalz,pc.itemNo from patientCharges pc,DoctorService ds where pc.service = ds.serviceName and pc.registrationNo = '$registrationNo' and pc.title = 'PROFESSIONAL FEE' and pc.phic = 0 and ds.phic = 'yes' ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT MAX(pc.cashUnpaid) as totalz,pc.itemNo from patientCharges pc,DoctorService ds where pc.service = ds.serviceName and pc.registrationNo = '$registrationNo' and pc.title = 'PROFESSIONAL FEE' and pc.phic = 0 ");
}



while($row = mysqli_fetch_array($result))
  {
return $row['totalz']."_".$row['itemNo'];
  }

}


public function getMaximumTotal_checker_PF($registrationNo,$case) { //check kung meron pang pde Lagay sa phic 

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if( $case == "ordinaryCase" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT MAX(pc.cashUnpaid) as totalz,pc.itemNo from patientCharges pc,DoctorService ds where pc.service = ds.serviceName and pc.registrationNo = '$registrationNo' and pc.title = 'PROFESSIONAL FEE' and pc.phic = 0 and ds.phic='yes' ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT MAX(pc.cashUnpaid) as totalz,pc.itemNo from patientCharges pc,DoctorService ds where pc.service = ds.serviceName and pc.registrationNo = '$registrationNo' and pc.title = 'PROFESSIONAL FEE' and pc.phic = 0 ");
}

while($row = mysqli_fetch_array($result))
  {
return mysqli_num_rows($result);
  }

}
//PF



public function getMaximumTotal_supplies($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT MAX(cashUnpaid) as totalz,itemNo from patientCharges where registrationNo = '$registrationNo' and title IN ('LABORATORY','RADIOLOGY','SUPPLIES','ECG') and phic = 0 and sellingPrice > 0 and status = 'UNPAID' ");




while($row = mysqli_fetch_array($result))
  {
return $row['totalz']."_".$row['itemNo'];
  }

}



public function getMaximumTotal_supplies_checker($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT MAX(cashUnpaid) as totalz,itemNo from patientCharges where registrationNo = '$registrationNo' and title IN ('LABORATORY','RADIOLOGY','SUPPLIES','NURSING-CHARGES','MISCELLANEOUS') and phic = 0 ");


while($row = mysqli_fetch_array($result))
  {
return mysqli_num_rows($result);
  }

}




public function getMaximumTotal_any($registrationNo,$title) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT MAX(cashUnpaid) as totalz,itemNo from patientCharges where registrationNo = '$registrationNo' and title='$title' and phic = 0 ");


while($row = mysqli_fetch_array($result))
  {
return $row['totalz']."_".$row['itemNo'];
  }

}



public function getMaximumTotal_any_checker($registrationNo,$title) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT MAX(cashUnpaid) as totalz,itemNo from patientCharges where registrationNo = '$registrationNo' and title='$title' and phic = 0 ");


while($row = mysqli_fetch_array($result))
  {
return mysqli_num_rows($result);
  }

}



public function getReady_PHIClimit($registrationNo,$itemNo,$total) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE patientCharges SET cashUnpaid = '$total',company = 0,phic = 0
WHERE itemNo = '$itemNo' and registrationNo = '$registrationNo' ");

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);
}







public function getReadyAllChargesForPHICLimit($registrationNo,$type) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


if( $type == "supplies" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT itemNo,total,description from patientCharges where registrationNo = '$registrationNo' and status = 'UNPAID' and (title = 'LABORATORY' or title = 'RADIOLOGY' or title = 'SUPPLIES' ) ");
}else if( $type == "medicine" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT itemNo,total,description from patientCharges where registrationNo = '$registrationNo' and status = 'UNPAID' and title = 'MEDICINE' ");
}else if( $type == "pf" ) { 
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT itemNo,total,description from patientCharges where registrationNo = '$registrationNo' and status = 'UNPAID' and title = 'PROFESSIONAL FEE' ");
}else if( $type == "room" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT itemNo,total,description from patientCharges where registrationNo = '$registrationNo' and status = 'UNPAID' and title = 'Room And Board' ");
}else { }


echo "<table border=0>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
$this->getReady_PHIClimit($registrationNo,$row['itemNo'],$row['total']);
echo "</tr>";  
}

echo "</table>";

}





/////////////// END NG BAGONG CODING PRA SA PHIC FULLER




public function getBilledPx() {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT rd.registrationNo,pp.paidVia,upper(pr.completeName) as completeName,pp.paymentFor,pp.paidBy,pp.datePaid,pp.amountPaid FROM patientPayment pp,patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and pp.registrationNo = rd.registrationNo and rd.registrationNo = pc.registrationNo and pp.paymentFor = 'BILLED' group by paymentNo order by completeName asc ");


while($row = mysqli_fetch_array($result))
  {

if( $this->shouldPay($row['registrationNo']) > 0 && $this->alreadyPay($row['registrationNo']) == 0  ) { // check ung mga patient n bill pru kLangan pren mgbyad sa cashier
echo "<tr>";
echo "<td>&nbsp;<font color=red>".$row['completeName']."</font>&nbsp;</td>";
echo "<td>&nbsp;".$row['paymentFor']."&nbsp;</td>";
echo "<td>&nbsp;".$row['amountPaid']."&nbsp;</td>";
echo "<td>&nbsp;".number_format("1",2)."&nbsp;</td>";
echo "<td>&nbsp;".number_format("0",2)."&nbsp;</td>";
echo "<td>&nbsp;".$row['amountPaid']."&nbsp;</td>";
echo "<td>&nbsp;".number_format(0,2)."&nbsp;</td>";
echo "<td>&nbsp;".$row['amountPaid']." - (".$row['paidVia'].")&nbsp;</td>";
echo "<td>&nbsp;".$row['paidBy']."&nbsp;</td>";
//$this->collection_salesTotal+=$row['total'];
//$this->collection_salesUnpaid+=$row['cashUnpaid'];
//$this->collection_salesPaid+=$row['cashPaid'];
/*
if($row['paidVia'] == "Cash") {
$this->collection_cash += $row['cashPaid'];
}else {
$this->collection_creditCard += $row['cashPaid'];
}
*/
echo "</tr>";

}else { }

  }

}



public function shouldPay($registrationNo) { //mga patient n bill pru may bbyran p rin sa cashier 

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pc.cashUnpaid) as totalCash from patientCharges pc where registrationNo = '$registrationNo' ");

while($row = mysqli_fetch_array($result))
  {
return $row['totalCash'];
}


}



function calculate_age($bday)
{
    $today = new DateTime();
    $diff = $today->diff(new DateTime($bday));

    if ($diff->y)
    {
        return $diff->y . ' Years Old';
    }
    elseif ($diff->m)
    {
        return $diff->m . ' Months Old';
    }
    else
    {
        return $diff->d . ' Days Old';
    }
}




public function getPxCount($date) {

$count="";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT count(registrationNo) as pxCount from registrationDetails where dateRegistered = '$date' and pxCount > 0 ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {
return $row['pxCount']+1;
}

}



public function transferMedicine($stockCardNo,$description,$generic,$unitcost,$quantity,$expiration,$addedBy,$dateAdded,$timeAdded,$inventoryLocation,$inventoryType,$branch,$transition,$remarks,$preparation,$phic,$added,$criticalLevel,$supplier,$begCapital,$begQTY,$suppliesUNITCOST,$autoDispense,$status,$classification,$description1,$genericName1,$ipdPrice,$opdPrice,$unitOfMeasure,$biQTY,$biInventoryCode,$encodedQTY,$fromInventoryCode) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO inventory (stockCardNo,description,genericName,unitcost,quantity,expiration,addedBy,dateAdded,timeAdded,inventoryLocation,inventoryType,branch,transition,remarks,preparation,phic,Added,criticalLevel,supplier,beginningCapital,beginningQTY,suppliesUNITCOST,autoDispense,classification,ipdPrice,opdPrice,unitOfMeasure,lastEnd_QTY,lastEnd_inventoryCode,encodedQTY,from_inventoryCode)
VALUES
('$stockCardNo','$description','$generic','$unitcost','$quantity','$expiration','$addedBy','$dateAdded','$timeAdded','$inventoryLocation','$inventoryType','$branch','$transition','$remarks','$preparation','$phic','$added','$criticalLevel','$supplier','$begCapital','$begQTY','$suppliesUNITCOST','$autoDispense','$classification','$ipdPrice','$opdPrice','$unitOfMeasure','$biQTY','$biInventoryCode','$encodedQTY','$fromInventoryCode')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

echo "<Center><br><br><br>Added <Br> $description - $quantity pcs  to $inventoryLocation</center>";

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}




}


?>
