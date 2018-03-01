<?php 
include 'common.php';
if(!is_usr())
{
header("location:index.php");
}
require_once('Connections/hospital.php');
mysql_query("SET NAMES UTF8"); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO en (id, cal, nameE, cho, prot, fat, spec_dis) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['cal'], "int"),
                       GetSQLValueString($_POST['nameE'], "text"),
                       GetSQLValueString($_POST['cho'], "int"),
                       GetSQLValueString($_POST['prot'], "int"),
                       GetSQLValueString($_POST['fat'], "int"),
                       GetSQLValueString($_POST['spec_dis'], "text"));

  mysql_select_db($database_hospital, $hospital);
  $Result1 = mysql_query($insertSQL, $hospital) or die(mysql_error());
  	echo ('<script >');
 	echo('alert("บันทึกข้อมูลสำเร็จ");');
 	echo('window.location.href="/hospital/edit_formular.php";');
 	echo('</script>');
  
}

mysql_select_db($database_hospital, $hospital);
$query_enteral = "SELECT * FROM en";
$enteral = mysql_query($query_enteral, $hospital) or die(mysql_error());
$row_enteral = mysql_fetch_assoc($enteral);
$totalRows_enteral = mysql_num_rows($enteral);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
<table width="483" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th width="75%" bgcolor="#D7DFFB" scope="col"><a href="http://chomthonghospital.go.th/cth2015/"><img src="/nutrition/file/picture/logo1.jpg" width="68" height="72" longdesc="/nutrition/file/picture/logo1.jpg" align="middle" /></a></th>
  </tr>
  <tr>
    <th bgcolor="#D7DFFB" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th bgcolor="#D7DFFB" scope="col">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        </table>
      <table align="center">
        <tr valign="baseline">
          <td bgcolor="#CCCCCC" colspan="2" align="right" nowrap="nowrap"><div align="center">แบบเพิ่มรายการอาหารที่ให้ผ่านทาง Enteral route</div></td>
          </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">ชื่ผลิตภัณฑ์:</td>
          <td><input name="nameE" type="text" id="nameE" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">ปริมาณ Calory /1000 ml:</td>
          <td><input type="text" name="cal" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">ปริมาณ Carbohydrate (gm/1000 ml):</td>
          <td><input type="text" name="cho" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">ปริมาณ Protein (gm/1000 ml):</td>
          <td><input type="text" name="prot" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">ปริมาณ Fat (gm/1000ml):</td>
          <td><input type="text" name="fat" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">ใช้เฉพาะกับโรค:</td>
          <td><input type="text" name="spec_dis" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr valign="baseline">
          <td bgcolor="#CCCCCC" colspan="2" align="right" nowrap="nowrap"><div align="center">
            <input name="save" type="submit" id="save" value="Save" />
          </div></td>
          </tr>
        <tr valign="baseline">
          <td colspan="2" align="right" nowrap="nowrap"><div align="center"><a href="/hospital/edit_formular.php">Back</a></div></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form2" />
    </th>
  </tr>
  <tr>
    <th bgcolor="#D7DFFB" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th bgcolor="#D7DFFB" scope="col">&nbsp;</th>
  </tr>
</table></form>
</body>
</html>
<?php
mysql_free_result($enteral);
?>
