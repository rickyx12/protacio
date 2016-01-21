<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Protacio Hospital</title>
<style type="text/css">
<!--
.style1 {font-family: Arial; font-size: 12; color: #FFFFFF; font-weight: bold; }
.style2 {font-family: Arial; font-size: 14px; color: #000000; font-weight: bold; }
.style3 {font-family: Arial; font-size: 11px; color: #FF0000; font-weight: bold; }

-->
</style>
<script type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_changeProp(objName,x,theProp,theValue) { //v6.0
  var obj = MM_findObj(objName);
  if (obj && (theProp.indexOf("style.")==-1 || obj.style)){
    if (theValue == true || theValue == false)
      eval("obj."+theProp+"="+theValue);
    else eval("obj."+theProp+"='"+theValue+"'");
  }
}

function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
</head>

<body>
<?php
include("../myDatabase.php");
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$username=$_GET['username'];

echo "
<div align='left'>
  <table width='300' border='0' cellspacing='0' cellpadding='0'>
    <tr>
      <td width='15'>&nbsp;</td>
      <td width='285'>&nbsp;</td>
    </tr>
    <tr>
      <td height='25'>&nbsp;</td>
      <td class='style2'><div align='left' id='cr' onmouseover=MM_changeProp('cr','','style.color','#FF0000','DIV') onmouseout=MM_changeProp('cr','','style.color','#000000','DIV') onclick=MM_goToURL('parent.frames[\'mainFrame\']','CreateReceivingReport.php?username=$username');return document.MM_returnValue>Receiving</div></td>
    </tr>
    <tr>
      <td height='25'>&nbsp;</td>
      <td class='style2'><div align='left' id='vr' onmouseover=MM_changeProp('vr','','style.color','#FF0000','DIV') onmouseout=MM_changeProp('vr','','style.color','#000000','DIV') onclick=MM_goToURL('parent.frames[\'mainFrame\']','ViewPurchasesSD.php?username=$username');return document.MM_returnValue>View Receiving Reports</div></td>
    </tr>
    <tr>
      <td height='25'>&nbsp;</td>
      <td class='style2'><div align='left' id='vpop' onmouseover=MM_changeProp('vpop','','style.color','#FF0000','DIV') onmouseout=MM_changeProp('vpop','','style.color','#000000','DIV') onclick=MM_goToURL('parent.frames[\'mainFrame\']','Accounting/ViewPOPayablesSelect.php?username=$username');return document.MM_returnValue>View Unpaid P.O.</div></td>
    </tr>
    <tr>
      <td height='25'>&nbsp;</td>
      <td class='style2'><div align='left' id='aes' onmouseover=MM_changeProp('aes','','style.color','#FF0000','DIV') onmouseout=MM_changeProp('aes','','style.color','#000000','DIV') onclick=MM_goToURL('parent.frames[\'mainFrame\']','SearchSupplier.php?username=$username');return document.MM_returnValue>Add/Edit Supplier</div></td>
    </tr>
    <tr>
      <td height='25'>&nbsp;</td>
      <td class='style2'><div align='left' id='rl' onmouseover=MM_changeProp('rl','','style.color','#FF0000','DIV') onmouseout=MM_changeProp('rl','','style.color','#000000','DIV') onclick=MM_goToURL('parent.frames[\'mainFrame\']','ReOrderList.php?username=$username&show=Medicine&sort=1');return document.MM_returnValue>Reorder List</div></td>
    </tr>
    <tr>
      <td height='25'>&nbsp;</td>
      <td class='style2'><div align='left' id='vpo' onmouseover=MM_changeProp('vpo','','style.color','#FF0000','DIV') onmouseout=MM_changeProp('vpo','','style.color','#000000','DIV') onclick=MM_goToURL('parent.frames[\'mainFrame\']','ViewPurchaseOrdersSD.php?username=$username');return document.MM_returnValue>View Purchase Orders</div></td>
    </tr>
    <tr>
      <td height='25'>&nbsp;</td>
      <td class='style2'><div align='left' id='rpt' onmouseover=MM_changeProp('rpt','','style.color','#FF0000','DIV') onmouseout=MM_changeProp('rpt','','style.color','#000000','DIV') onclick=MM_goToURL('parent.frames[\'mainFrame\']','Reports.php?username=$username');return document.MM_returnValue>Reports</div></td>

    </tr>
  </table>
</div>
";
?>
</body>
</html>
