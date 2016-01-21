<?php



class sandigLab{


public $myhost="localhost";
public $username="root";
public $password="test";
public $mydatabase="Coconut";

public function addHematology($regno,$testno,$reqdate,$testdate,$reqphy,$patho,$medtech,$specimen,$examination,$lab1,$lab2,$lab3,$lab4,$lab5,$lab6,$lab7,$lab8,$lab9,$lab10,$lab11,$lab12,$lab13,$lab14,$lab15,$lab16,$lab17,$lab18,$lab19,$lab20,$lab21,$lab22,$lab23,$lab24,$lab25,$lab26,$lab27,$lab28,$lab29,$patname,$gender,$gender1,$resultType,$itemNo){


$con = mysql_connect($this->myhost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->mydatabase, $con);

$sql="INSERT INTO sandigLabResult (regno,testno,reqdate,testdate,reqphy,patho,medtech,specimen,examination,lab1,lab2,lab3,lab4,lab5,lab6,lab7,lab8,lab9,lab10,lab11,lab12,lab13,lab14,lab15,lab16,lab17,lab18,lab19,lab20,lab21,lab22,lab23,lab24,lab25,lab26,lab27,lab28,lab29,patname,gender,gender1,resultType,itemNo)
VALUES ('$regno','$testno','$reqdate','$testdate','$reqphy','$patho','$medtech','$specimen','$examination','$lab1','$lab2','$lab3','$lab4','$lab5','$lab6','$lab7','$lab8','$lab9','$lab10','$lab11','$lab12','$lab13','$lab14','$lab15','$lab16','$lab17','$lab18','$lab19','$lab20','$lab21','$lab22','$lab23','$lab24','$lab25','$lab26','$lab27','$lab28','$lab29','$patname','$gender','$gender1','$resultType','$itemNo')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "TEST DONE!";
mysql_close($con);


}

public $lab1;
public $lab2;
public $lab3;
public $lab4;
public $lab5;
public $lab6;
public $lab7;
public $lab8;
public $lab9;
public $lab10;
public $lab11;
public $lab12;
public $lab13;
public $lab14;
public $lab15;
public $lab16;
public $lab17;
public $lab18;
public $lab19;
public $lab20;
public $lab21;
public $lab22;
public $lab23;
public $lab24;
public $lab25;
public $lab26;
public $lab27;
public $lab28;
public $lab29;
public $doc;
public $patname;
public $medtech;


public function lab1() {
return $this->lab1;
}
public function lab2() {
return $this->lab2;
}
public function lab3() {
return $this->lab3;
}
public function lab4() {
return $this->lab4;
}
public function lab5() {
return $this->lab5;
}
public function lab6() {
return $this->lab6;
}
public function lab7() {
return $this->lab7;
}
public function lab8() {
return $this->lab8;
}
public function lab9() {
return $this->lab9;
}
public function lab10() {
return $this->lab10;
}
public function lab11() {
return $this->lab11;
}
public function lab12() {
return $this->lab12;
}
public function lab13() {
return $this->lab13;
}
public function lab14() {
return $this->lab14;
}
public function lab15() {
return $this->lab15;
}
public function lab16() {
return $this->lab16;
}
public function lab17() {
return $this->lab17;
}
public function lab18() {
return $this->lab18;
}
public function lab19() {
return $this->lab19;
}
public function lab20() {
return $this->lab20;
}
public function lab21() {
return $this->lab21;
}
public function lab22() {
return $this->lab22;
}
public function lab23() {
return $this->lab23;
}
public function lab24() {
return $this->lab24;
}
public function lab25() {
return $this->lab25;
}
public function lab26() {
return $this->lab26;
}
public function lab27() {
return $this->lab27;
}
public function lab28() {
return $this->lab28;
}
public function lab29() {
return $this->lab29;
}
public function doc() {
return $this->doc;
}
public function patname() {
return $this->patname;
}
public function medtech() {
return $this->medtech;
}


public function showLabResult($regNo,$itemNo,$resultType){
$con = mysql_connect($this->myhost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->mydatabase, $con);

$result = mysql_query("SELECT * FROM sandigLabResult WHERE itemNo='$itemNo' and regno='$regNo' AND resultType='$resultType'");



while($row = mysql_fetch_array($result))
  {
  
$this->lab1=$row["lab1"];
$this->lab2=$row["lab2"];
$this->lab3=$row["lab3"];
$this->lab4=$row["lab4"];
$this->lab5=$row["lab5"];
$this->lab6=$row["lab6"];
$this->lab7=$row["lab7"];
$this->lab8=$row["lab8"];
$this->lab9=$row["lab9"];
$this->lab10=$row["lab10"];
$this->lab11=$row["lab11"];
$this->lab12=$row["lab12"];
$this->lab13=$row["lab13"];
$this->lab14=$row["lab14"];
$this->lab15=$row["lab15"];
$this->lab16=$row["lab16"];
$this->lab17=$row["lab17"];
$this->lab18=$row["lab18"];
$this->lab19=$row["lab19"];
$this->lab20=$row["lab20"];
$this->lab21=$row["lab21"];
$this->lab22=$row["lab22"];
$this->lab23=$row["lab23"];
$this->lab24=$row["lab24"];
$this->lab25=$row["lab25"];
$this->lab26=$row["lab26"];
$this->lab27=$row["lab27"];
$this->lab28=$row["lab28"];
$this->lab29=$row["lab29"];
$this->doc=$row["patho"];
$this->patname = $row["patname"];
$this->medtech = $row['medtech'];  
  }


mysql_close($con);

}

//kukuhain yung total per account title ilabas sa summary discharge report //
public function showSum($paymentType,$accountTitle,$registrationNo){
$con = mysql_connect($this->myhost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->mydatabase, $con);

$result = mysql_query("SELECT sum($paymentType) as payment FROM patientCharges WHERE title='$accountTitle' AND registrationNo='$registrationNo'");


while($row = mysql_fetch_array($result))
  {
 
 return $row['payment'];
  }


mysql_close($con);

}










public $getDischarged_phic,$getDischarged_company,$getDischarged_Debit,$getDischarged_med,$getDischarged_sup,$getDischarged_room,$getDischarged_Lab,$getDischarged_Radio;



public function getDischarged($fromMonth,$fromDay,$fromYear,$toMonth,$toDay,$toYear){
$myFrom = $fromMonth."_".$fromDay."_".$fromYear;
$myTo = $toMonth."_".$toDay."_".$toYear;
$con = mysql_connect($this->myhost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->mydatabase, $con);

$result = mysql_query("SELECT rd.*,pr.*,sum(pc.phic) as totalPhic ,sum(pc.company) as totalcompany  FROM registrationDetails rd,patientRecord pr,patientCharges pc WHERE (rd.dateUnregistered BETWEEN '$myFrom' AND '$myTo') AND rd.patientNo=pr.patientNo and rd.registrationNo=pc.registrationNo GROUP BY registrationNo");



while($row = mysql_fetch_array($result))
  {
  
echo "<tr>";
$this->getDischarged_phic += $row['totalPhic'];
$this->getDischarged_company+=$row['totalcompany'];
$this->getDischarged_Debit+=($row['totalPhic'] + $row['totalcompany']);
$this->getDischarged_med+=$this->showSum("cashPaid","MEDICINE",$row['registrationNo']);
$this->getDischarged_sup+=$this->showSum("cashPaid","SUPPLIES",$row['registrationNo']);
$this->getDischarged_room+=$this->showSum("cashPaid","Room and Board",$row['registrationNo']);
$this->getDischarged_Lab+=$this->showSum("cashPaid","Laboratory",$row['registrationNo']);
$this->getDischarged_Lab+=$this->showSum("cashPaid","RADIOLOGY",$row['registrationNo']);
echo "<td>".$row['lastName'].", ".$row['firstName']." ".$row['middleName']." </td>";
echo "<td></td>"; 
echo "<td></td>"; 
echo "<td></td>"; 
echo "<td>&nbsp;".number_format($row['totalPhic'],2)."&nbsp;</td>"; 
echo "<td>&nbsp;".number_format($row['totalcompany'],2)."&nbsp;</td>";  
echo "<td></td>"; 
echo "<td></td>";
echo "<td>&nbsp;".number_format($row['totalPhic']+ $row['totalcompany'],2)."&nbsp;</td>"; 
echo "<td>".number_format($this->showSum("cashPaid","MEDICINE",$row['registrationNo']),2)."</td>"; 
echo "<td>".$this->showSum("cashPaid","SUPPLIES",$row['registrationNo'])."</td>"; 
echo "<td>".$this->showSum("cashPaid","LABORATORY",$row['registrationNo'])."</td>"; 
echo "<td>".$this->showSum("cashPaid","RADIOLOGY",$row['registrationNo'])."</td>";  
echo "<td></td>"; 
echo "<td></td>"; 
echo "<td></td>"; 
echo "<td></td>"; 
echo "<td></td>"; 
echo "<td></td>"; 
echo "<td></td>"; 
echo "<td>".$this->showSum("cashPaid","Room and Board",$row['registrationNo'])."</td>";
echo "<td></td>"; 
echo "<td></td>"; 
echo "<td></td>"; 
echo "<td></td>"; 
echo "<td></td>"; 
echo "<td>&nbsp;".($this->showSum("cashPaid","MEDICINE",$row['registrationNo']) + $this->showSum("cashPaid","SUPPLIES",$row['registrationNo']) + $this->showSum("cashPaid","Room and Board",$row['registrationNo'] )  + $this->showSum("cashPaid","LABORATORY",$row['registrationNo'] )   )."&nbsp;</td>";
 echo "</tr>";
}
echo "<tr>";
echo "<td>TOTAL</td>";
echo "<td></td>"; 
echo "<td></td>"; 
echo "<td></td>"; 
echo "<td>&nbsp;".number_format($this->getDischarged_phic,2)."&nbsp;</td>"; 
echo "<td>&nbsp;".number_format($this->getDischarged_company,2)."&nbsp;</td>";
echo "<td></td>"; 
echo "<td></td>";
echo "<td>&nbsp;".number_format($this->getDischarged_Debit,2)."&nbsp;</td>"; 
echo "<td>&nbsp;".number_format($this->getDischarged_med,2)."&nbsp;</td>";
echo "<td>&nbsp;".number_format($this->getDischarged_sup,2)."&nbsp;</td>";
echo "<td>&nbsp;".number_format($this->getDischarged_Lab,2)."&nbsp;</td>";
echo "<td></td>"; 
echo "<td></td>"; 
echo "<td></td>"; 
echo "<td></td>"; 
echo "<td></td>"; 
echo "<td></td>"; 
echo "<td></td>"; 
echo "<td></td>"; 
echo "<td>&nbsp;".number_format($this->getDischarged_room,2)."&nbsp;</td>";
echo "<td></td>"; 
echo "<td></td>"; 
echo "<td></td>"; 
echo "<td></td>"; 
echo "<td></td>"; 
echo "<td>&nbsp;".($this->getDischarged_med + $this->getDischarged_sup + $this->getDischarged_room + $this->getDischarged_Lab)."&nbsp;</td>";
echo "</tr>";

mysql_close($con);

}








}




?>
