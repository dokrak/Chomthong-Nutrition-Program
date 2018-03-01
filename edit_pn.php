<?php 

include 'common.php';
if(!is_usr())
{
header("location:index.php");
}
require_once('Connections/hospital.php');
mysql_query("SET NAMES UTF8");

$level = u::is("level")?u::get():"";
$hid = u::is("hid")?u::get():"";

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
  $updateSQL = sprintf("UPDATE pn SET nameP=%s, vol=%s, cho=%s, prot=%s, fat=%s, n=%s, cal=%s, Na=%s, K=%s, Ca=%s, Mg=%s, P=%s, Cl=%s, Acetate=%s, SO4=%s, Z=%s, osmole=%s,other=%s WHERE id=%s",
                       GetSQLValueString($_POST['nameP'], "text"),
                       GetSQLValueString($_POST['vol'], "int"),
                       GetSQLValueString($_POST['cho'], "int"),
                       GetSQLValueString($_POST['prot'], "int"),
                       GetSQLValueString($_POST['fat'], "int"),
                       GetSQLValueString($_POST['n'], "int"),
                       GetSQLValueString($_POST['cal'], "int"),
                       GetSQLValueString($_POST['Na'], "int"),
                       GetSQLValueString($_POST['K'], "int"),
                       GetSQLValueString($_POST['Ca'], "int"),
                       GetSQLValueString($_POST['Mg'], "int"),
                       GetSQLValueString($_POST['P'], "int"),
                       GetSQLValueString($_POST['Cl'], "int"),
                       GetSQLValueString($_POST['Acetate'], "int"),
                       GetSQLValueString($_POST['SO4'], "int"),
                       GetSQLValueString($_POST['Z'], "int"),
                       GetSQLValueString($_POST['osmole'], "int"),
					   GetSQLValueString($_POST['other'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_hospital, $hospital);
  $Result1 = mysql_query($updateSQL, $hospital) or die(mysql_error());

	echo ('<script >');
 	echo('alert("เปลี่ยนแปลงข้อมูลสำเร็จ");');
 	echo('window.location.href="/hospital/edit_formular.php";');
 	echo('</script>');
 
}

$colname_pn = "-1";
if (isset($_GET['id'])) {
  $colname_pn = $_GET['id'];
}

mysql_select_db($database_hospital, $hospital);
$query_pn = sprintf("SELECT * FROM pn WHERE id = %s", GetSQLValueString($colname_pn, "int"));
$pn = mysql_query($query_pn, $hospital) or die(mysql_error());
$row_pn = mysql_fetch_assoc($pn);
$totalRows_pn = mysql_num_rows($pn);
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
      <td colspan="2" align="right" nowrap="nowrap"><div align="center"><a href="http://chomthonghospital.go.th/cth2015/"><img src="<?PHP $logo="img/".$hid.".jpg"; echo $logo; ?>" alt="" width="75" height="95" /></a></div></td>
    </tr>
    <tr bgcolor="#CCCCCC" valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Id:</td>
      <td><?php echo $row_pn['id']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">ชื่อสารอาหาร :</td>
      <td><input type="text" name="nameP" value="<?php echo htmlentities($row_pn['nameP'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">ปริมาณ(Volume) :</td>
      <td><input type="text" name="vol" value="<?php echo htmlentities($row_pn['vol'], ENT_COMPAT, 'UTF-8'); ?>" size="10" /> 
        ml/set</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Carbohydrate:</td>
      <td><input type="text" name="cho" value="<?php echo htmlentities($row_pn['cho'], ENT_COMPAT, 'UTF-8'); ?>" size="10" />
        gm/set</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Protein :</td>
      <td><input type="text" name="prot" value="<?php echo htmlentities($row_pn['prot'], ENT_COMPAT, 'UTF-8'); ?>" size="10" /> 
        gm/set</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fat :</td>
      <td><input type="text" name="fat" value="<?php echo htmlentities($row_pn['fat'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">N:</td>
      <td><input type="text" name="n" value="<?php echo htmlentities($row_pn['n'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Cal:</td>
      <td><input type="text" name="cal" value="<?php echo htmlentities($row_pn['cal'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Na:</td>
      <td><input type="text" name="Na" value="<?php echo htmlentities($row_pn['Na'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">K:</td>
      <td><input type="text" name="K" value="<?php echo htmlentities($row_pn['K'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ca:</td>
      <td><input type="text" name="Ca" value="<?php echo htmlentities($row_pn['Ca'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Mg:</td>
      <td><input type="text" name="Mg" value="<?php echo htmlentities($row_pn['Mg'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">P:</td>
      <td><input type="text" name="P" value="<?php echo htmlentities($row_pn['P'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Cl:</td>
      <td><input type="text" name="Cl" value="<?php echo htmlentities($row_pn['Cl'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Acetate:</td>
      <td><input type="text" name="Acetate" value="<?php echo htmlentities($row_pn['Acetate'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">SO4:</td>
      <td><input type="text" name="SO4" value="<?php echo htmlentities($row_pn['SO4'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Z:</td>
      <td><input type="text" name="Z" value="<?php echo htmlentities($row_pn['Z'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Osmole:</td>
      <td><input type="text" name="osmole" value="<?php echo htmlentities($row_pn['osmole'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap">Other:</td>
      <td align="right" nowrap="nowrap"><textarea name="other" cols="32" rows="2"><?php echo htmlentities($row_pn['other'], ENT_COMPAT, 'UTF-8'); ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap"><div align="center">
        <input type="submit" value="Update record" />
      </div></td>
    </tr>
    <tr bgcolor="#CCCCCC" valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap"><div align="center"><a href="/hospital/edit_formular.php">Back</a></div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id" value="<?php echo $row_pn['id']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($pn);
mysql_query("SET NAMES UTF8");
?>
