<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Test Codes</title>
<script type="text/JavaScript">
<!--
function placeFocus() {
if (document.forms.length > 0) {
var field = document.forms[0];
for (i = 0; i < field.length; i++) {
if ((field.elements[i].type == "text") || (field.elements[i].type == "textarea") || (field.elements[i].type.toString().charAt(0) == "s")) {
document.forms[0].elements[i].focus();
break;
         }
      }
   }
}

//-->
</script>
<style type="text/css">
<!--
.style1 {
	font-family: Arial;
	font-size: 14px;
	font-weight: bold;
	color: #000000;
}
.style2 {
	font-family: Arial;
	font-size: 14px;
	font-weight: bold;
	color: #000000;
}
.textfield01 {
	font-family: Arial;
	font-size: 12px;
	font-weight: bold;
	color: #000000;
	background-color: #FFFFFF;
	border: 1px solid #000000;
}
.button01 {
	font-family: Arial;
	font-size: 12px;
	font-weight: bold;
	color: #000000;
	background-color: #FFFFFF;
	border: 1px solid #000000;
}
-->
</style>
</head>

<body onload="placeFocus()">

<div align="left">
  <table width="500" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><div align="left" class="style1">Search Patinet </div></td>
    </tr>
    <tr>
      <form id="Search" name="Search" method="get" action="SearchResult.php">
	  <td>
        <table width="100" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><input name="lastName" type="text" class="textfield01" id="lastName" placeholder="Last Name" /></td>
            <td><input name="firstName" type="text" class="textfield01" id="firstName" placeholder="First Name" /></td>
            <td><input name="Submit" type="submit" class="button01" value="Submit" /></td>
          </tr>
        </table>
	  </td>
	  </form>
    </tr>
  </table>
  <br />
  <br />
</div>
</body>
</html>
