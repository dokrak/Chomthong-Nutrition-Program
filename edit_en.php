<?php 

include 'common.php';
if(!is_usr())
{
header("location:index.php");
}
require_once('Connections/hospital.php');
mysql_query("SET NAMES UTF8");
?>

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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE en SET cal=%s, nameE=%s, cho=%s, prot=%s, fat=%s, spec_dis=%s WHERE id=%s",
                       GetSQLValueString($_POST['cal'], "int"),
                       GetSQLValueString($_POST['nameE'], "text"),
                       GetSQLValueString($_POST['cho'], "double"),
                       GetSQLValueString($_POST['prot'], "double"),
                       GetSQLValueString($_POST['fat'], "double"),
                       GetSQLValueString($_POST['spec_dis'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_hospital, $hospital);
  $Result1 = mysql_query($updateSQL, $hospital) or die(mysql_error());

	echo ('<script >');
 	echo('alert("เปลี่ยนแปลงข้อมูลสำเร็จ");');
 	echo('window.location.href="/hospital/edit_formular.php";');
 	echo('</script>');
}

$colname_en = "-1";
if (isset($_GET['id'])) {
  $colname_en = $_GET['id'];
}


mysql_select_db($database_hospital, $hospital);
$query_en = sprintf("SELECT * FROM en WHERE id = %s", GetSQLValueString($colname_en, "int"));
$en = mysql_query($query_en, $hospital) or die(mysql_error());
$row_en = mysql_fetch_assoc($en);
$totalRows_en = mysql_num_rows($en);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap"><div align="center"><a href="http://chomthonghospital.go.th/cth2015/"><img src="/nutrition/file/picture/logo1.jpg" alt="" width="68" height="72" longdesc="/nutrition/file/picture/logo1.jpg" /></a></div></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap"><div align="center">ปรับเปลี่ยนรายละเอียด</div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Id :</td>
      <td><?php echo $row_en['id']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">ชื่อสูตรอาหาร :</td>
      <td><input type="text" name="nameE" value="<?php echo htmlentities($row_en['nameE'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">ปริมาณ Calory :</td>
      <td><input type="text" name="cal" value="<?php echo htmlentities($row_en['cal'], ENT_COMPAT, 'UTF-8'); ?>" size="10" /> 
        Cal/1000ml</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">ปริมาณ Carbohydrate :</td>
      <td><input type="text" name="cho" value="<?php echo htmlentities($row_en['cho'], ENT_COMPAT, 'UTF-8'); ?>" size="10" />
      gm/1000ml</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">ปริมาณ Protein :</td>
      <td><input type="text" name="prot" value="<?php echo htmlentities($row_en['prot'], ENT_COMPAT, 'UTF-8'); ?>" size="10" />
      gm/1000ml</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">ปริมาณ Fat :</td>
      <td><input type="text" name="fat" value="<?php echo htmlentities($row_en['fat'], ENT_COMPAT, 'UTF-8'); ?>" size="10" />
      gm/1000ml</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Spec_dis:</td>
      <td><input type="text" name="spec_dis" value="<?php echo htmlentities($row_en['spec_dis'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap"><div align="center">
        <input type="submit" value="Update record" />
      </div></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap"><div align="center"><a href="/hospital/edit_formular.php">Back</a></div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id" value="<?php echo $row_en['id']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($en);
?>
