<?php


class synapse {

public $myHost;
public $username;
public $password;
public $database;

public function __construct() {
$this->myHost = $_SERVER['DB_HOST'];
$this->username = $_SERVER['DB_USER'];
$this->password = $_SERVER['DB_PASS'];
$this->database = $_SERVER['DB_DB'];
}

public function getMyUrl() {

$con = mysql_connect($this->myHost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT ipaddress FROM ipaddress ");

while($row = mysql_fetch_array($result))
  {
return $row['ipaddress'];
  }

}


public function getSynapseModule() {

$con = mysql_connect($this->myHost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT * FROM module where status = 'on' order by name asc ");
$x=1;
while($row = mysql_fetch_array($result))
  {

if($row['name'] == "REGISTRATION") {
echo "<li><a href='http://".$this->getMyUrl()."/COCONUT/opdRegistration.php?module=$row[name]&from=main'>".$x++.". ".$row['name']."</a></li>";
}else if($row['name'] == "NURSING") {
echo "<li><a href='http://".$this->getMyUrl()."/COCONUT/NURSING/nursingPage.php?module=$row[name]'>".$x++.". ".$row['name']."</a></li>";
}else if($row['name'] == "OR/DR") {
echo "<li><a href='http://".$this->getMyUrl()."/COCONUT/specialRoom/specialRoom.php?module=$row[name]' target='welcome'>".$x++.". ".$row['name']."</a></li>";
}else if($row['name'] == "REQUISTITION" ) {
echo "<li><a href='http://".$this->getMyUrl()."/COCONUT/requestition/batchRequest/requestLogin.php?module=$row[name]' target='welcome'>".$x++.". ".$row['name']."</a></li>";
}

else {
echo "<li><a href='http://".$this->getMyUrl()."/LOGINPAGE/loginpage.php?module=$row[name]&from=$row[name]'>".$x++.". ".$row['name']."</a></li>";
}

 }

}


public $UserName,$UserPassword,$UserModule,$UserEmployeeID;

public function getUserName() {
return $this->UserName;
}
public function getUserPassword() {
return $this->UserPassword;
}
public function getUserModule() {
return $this->UserModule;
}
public function getUserEmployeeID() {
return $this->UserEmployeeID;
}

public function LogIn($username,$password,$module) {

$con = mysql_connect($this->myHost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

if($module == "DOCTOR") {
$result = mysql_query("SELECT doctorCode,username,password,module FROM Doctors where username = '".mysql_real_escape_string($username)."' and password='".mysql_real_escape_string($password)."' and module = '".mysql_real_escape_string($module)."' ");
}else {
$result = mysql_query("SELECT employeeID,username,password,module FROM registeredUser where username = '".mysql_real_escape_string($username)."' and password='".mysql_real_escape_string($password)."' and (module = '".mysql_real_escape_string($module)."' or module = 'ADMIN' ) ");
}

while($row = mysql_fetch_array($result))
  {
$this->UserName = $row['username'];
$this->UserPassword = $row['password'];
$this->UserModule = $row['module'];
if( $module == "DOCTOR" ) {
$this->UserEmployeeID = $row['doctorCode'];
}else {
$this->UserEmployeeID = $row['employeeID'];
}


  }

}



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
public function coconutHeading($module) {
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
        <li><a href="http://'.$this->getMyUrl().'/LOGINPAGE/module.php"><font color=white>Home</font><span class="arrow"></span></a></li>
        <li><a href="#" class="odd"><font color=yellow>'.$module.'</font><span class="arrow"></span></a></li>

    <li>&nbsp;&nbsp;</li>
</ol>
';
}
/*******************end ng breadcrumb******************************/

public function coconutHidden($name,$value) {
echo "<input type=hidden name='$name' value='$value'>";
}
public function coconutTextBox($name,$value) {
echo "<input type=text name='$name' value='$value' class='txtBox'>";
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

//UNIVERSAL OPTION PRA SA COMOBOX
public function showOption($table,$cols) {

$con = mysql_connect($this->myHost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT ($cols) cols FROM $table order by cols asc ");

while($row = mysql_fetch_array($result))
  {
echo "<option value='".$row['cols']."'>".$row['cols']."</option>";
  }

}


public function showFloor() {

$con = mysql_connect($this->myHost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT floor FROM room group by floor order by floor  ");
while($row=mysql_fetch_array($result)) {
echo "<option value='".$row['floor']."'>".$row['floor']."</option>";
}

}


public function showFloorAsUpperMenu($branch) {

$con = mysql_connect($this->myHost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT floor FROM room WHERE branch = '$branch' group by floor order by floor  ");
while($row=mysql_fetch_array($result)) {
echo "<li><a href='http://".$this->getMyUrl()."/COCONUT/NURSING/nursingStation1.php?username=&module=&branch=$branch&floor=$row[floor]' target='nsX'>$row[floor]</a></li>";

//$this->coconutUpperMenu_headingMenu("http://".$this->getMyUrl()."/COCONUT/NURSING/nursingStation.php?username=&module=&branch=$branch&floor=".$row['floor'],$row['floor']);
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

$con = mysql_connect($this->myHost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

if($module == "BILLING") {
$result = mysql_query("SELECT * FROM room WHERE branch = '$branch' order by Description asc ");
}else {
$result = mysql_query("SELECT * FROM room WHERE branch = '$branch' and floor='$desc' order by Description asc ");
}
echo "<br><center><font size=2>Admitted Patient in $desc of $branch</font><div style='border:1px solid #000000; width:600px; height:auto; border-color:black black black black;'>";
echo "<center><br><table width='75%' border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo "<th bgcolor='#3b5998'>&nbsp;<font class='head'>Room</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font class='head'>Patient</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font class='head'>Credit</font>&nbsp;</th>";
echo "</tr>";
while($row = mysql_fetch_array($result))
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
echo "<Td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/currentPatient/patientInterface1.php?username=$username&registrationNo=".$this->viewCreditLimit_setter_registrationNo()."' target='_blank' class='unExceed'><font class='roomData'>".$patientData[1]."</font></a>&nbsp;</td>";
}else {
echo "<td>&nbsp;</td>";
}
if($patientData[0] != "") {
echo "<Td>&nbsp;<font class='roomData'>".number_format($credit,2 )."</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;</td>";
}

}else { //execute notifier kpg meron credit limit n nka set sa patient as "PATIENT"

if($credit > $limit) { //gwen red kpg Lagpas n sa limit

echo "<Td class='exceeded'>&nbsp;<font class='roomData'>".$row['Description']."</font>&nbsp;</td>";
if($patientData[0] != "") {
echo "<Td class='exceeded'>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/currentPatient/patientInterface1.php?username=$username&registrationNo=".$this->viewCreditLimit_setter_registrationNo()."' target='_blank' class='Exceed'><font class='roomData'>".$patientData[1]."</font></a>&nbsp;</td>";
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
echo "<Td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/currentPatient/patientInterface1.php?username=$username&registrationNo=".$this->viewCreditLimit_setter_registrationNo()."' target='_blank' class='unExceed'><font class='roomData'>".$patientData[1]."</font></a>&nbsp;</td>";
}else {
echo "<td>&nbsp;</td>";
}
if($patientData[0] != "") {
echo "<Td>&nbsp;<font class='roomData'>".number_format($credit,2 )."</font>&nbsp;</td>";
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

$con = mysql_connect($this->myHost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,rd.registrationNo FROM patientRecord pr,registrationDetails rd WHERE pr.patientNo = rd.patientNo and rd.room = '$room' and rd.dateUnregistered = ''  ");
while($row=mysql_fetch_array($result)) {
return $row['registrationNo']."_".$row['lastName'].", ".$row['firstName'];
}

}


//get total credit ng patient
public function getCurrentCredit($registrationNo,$title,$via) {

$con = mysql_connect($this->myHost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

if($title == "PATIENT") {
$result = mysql_query("SELECT sum(cashUnpaid) as total FROM patientCharges WHERE registrationNo = '$registrationNo' ");
}else {
$result = mysql_query("SELECT sum($via) as total FROM patientCharges WHERE registrationNo = '$registrationNo' and title = '$title' ");
}
while($row = mysql_fetch_array($result))
  {

return $row['total'];

  }

}


//get total paid ng patient
public function getCurrentPaid($registrationNo,$paymentFor,$via) {

$con = mysql_connect($this->myHost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

if($via == "cashUnpaid") {
$result = mysql_query("SELECT sum(amountPaid) as amountPaid FROM patientPayment WHERE registrationNo = '$registrationNo' and paymentFor = '$paymentFor' ");
}else {
$result = mysql_query("SELECT sum($via) as amountPaid FROM patientCharges WHERE registrationNo = '$registrationNo' and title = '$paymentFor' ");
}


while($row = mysql_fetch_array($result))
  {

return $row['amountPaid'];

  }

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

$con = mysql_connect($this->myHost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT * from patientCreditLimit WHERE registrationNo = '$registrationNo' and limitTo = '$limitTo' and limitVia = '$limitVia' order by limitTo asc  ");

while($row = mysql_fetch_array($result))
  {
$this->viewCreditLimit_setter_limitNo = $row['limitNo'];
$this->viewCreditLimit_setter_registrationNo = $row['registrationNo'];
$this->viewCreditLimit_setter_limitTo = $row['limitTo'];
$this->viewCreditLimit_setter_limitVia = $row['limitVia'];
$this->viewCreditLimit_setter_amountLimit = $row['amountLimit'];
  }


}

//mei credit limit ba ang patient as "PATIENT"???
public function checkCreditLimit($registrationNo) {

$con = mysql_connect($this->myHost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT * FROM patientCreditLimit WHERE registrationNo = '$registrationNo' and limitTo = 'PATIENT' and limitVia = 'cashUnpaid'  ");

while($row = mysql_fetch_array($result))
  {
return mysql_num_rows($result);
  }

}


//mei credit limit ba ang patient as "NOT PATIENT"???
public function checkCreditLimit_others($registrationNo) {

$con = mysql_connect($this->myHost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT * FROM patientCreditLimit WHERE registrationNo = '$registrationNo' and limitTo != 'PATIENT' and limitVia = 'cashUnpaid'  ");

while($row = mysql_fetch_array($result))
  {
return mysql_num_rows($result);
  }

}

//BASED ON USERNAME AND MODULE
public function getUserBranch_username($username,$module) {

$con = mysql_connect($this->myHost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT branch from registeredUser where username='$username' and module = '$module'  ");

while($row = mysql_fetch_array($result))
  {
return $row['branch'];
  }

}


}


?>
