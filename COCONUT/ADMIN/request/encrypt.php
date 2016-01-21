<?php
include("../../../myDatabase.php");

class Encryption extends database
{
    const CYPHER = MCRYPT_RIJNDAEL_256;
    const MODE   = MCRYPT_MODE_CBC;
    const KEY    = 'r1c4rd0-0s1t';

    public static function encrypt($plaintext)
    {
        $td = mcrypt_module_open(self::CYPHER, '', self::MODE, '');
        $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        mcrypt_generic_init($td, self::KEY, $iv);
        $crypttext = mcrypt_generic($td, $plaintext);
        mcrypt_generic_deinit($td);
        return base64_encode($iv.$crypttext);
    }

    public static function decrypt($crypttext)
    {
        $crypttext = base64_decode($crypttext);
        $plaintext = '';
        $td        = mcrypt_module_open(self::CYPHER, '', self::MODE, '');
        $ivsize    = mcrypt_enc_get_iv_size($td);
        $iv        = substr($crypttext, 0, $ivsize);
        $crypttext = substr($crypttext, $ivsize);
        if ($iv)
        {
            mcrypt_generic_init($td, self::KEY, $iv);
            $plaintext = mdecrypt_generic($td, $crypttext);
        }
        return trim($plaintext);
    }


 public static function ENCRYPT_DECRYPT($Str_Message) {
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
$result = mysql_query("SELECT employeeID,username,password,module FROM registeredUser where username = '".mysql_real_escape_string($username)."' and module = '".mysql_real_escape_string($module)."' ");


while($row = mysql_fetch_array($result))
  {

$this->UserPassword = Encryption::decrypt(Encryption::ENCRYPT_DECRYPT($row['password']));
$this->UserName = $row['username'];
$this->UserModule = $row['module'];
$this->UserEmployeeID = $row['employeeID'];
}

} 


}

?>
