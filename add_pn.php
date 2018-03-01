<?php 

include 'common.php';
if(!is_usr())
{
header("location:index.php");
}
require_once('Connections/hospital.php');
mysql_query("SET NAMES UTF8");

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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO pn (nameP, vol, cho, prot, fat, n, cal, Na, K, Ca, Mg, P, Cl, Acetate, SO4, Z, osmole,other) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
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
					   GetSQLValueString($_POST['other'], "text"));

  mysql_select_db($database_hospital, $hospital);
  $Result1 = mysql_query($insertSQL, $hospital) or die(mysql_error());
 	echo ('<script >');
 	echo('alert("บันทึกข้อมูลสำเร็จ");');
 	echo('window.location.href="/hospital/edit_formular.php";');
 	echo('</script>');
}

mysql_select_db($database_hospital, $hospital);
$query_pn = "SELECT * FROM pn";
$pn = mysql_query($query_pn, $hospital) or die(mysql_error());
$row_pn = mysql_fetch_assoc($pn);
$totalRows_pn = mysql_num_rows($pn);

mysql_free_result($pn);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td bgcolor="#CCCCCC" colspan="2" align="right" nowrap><div align="center"><a href="http://chomthonghospital.go.th/cth2015/"><img src="/hospital/img/logo1.jpg" alt="" width="68" height="72"  /></a></div></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#CCCCCC" colspan="2" align="right" nowrap><div align="center">เพิ่มรายการ Parenteral Nutrition</div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#CECECE" nowrap align="right">ชื่อ Parenteral Nutrition :</td>
      <td><input type="text" name="nameP" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#CECECE" nowrap align="right">ปริมาตรต่อถุง (ml) :</td>
      <td><input type="text" name="vol" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#CECECE" nowrap align="right">ปริมาณ Carbohydrate (gm) :</td>
      <td><input type="text" name="cho" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#CECECE" nowrap align="right">ปริมาณ Protein (gm) :</td>
      <td><input type="text" name="prot" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#CECECE" nowrap align="right">ปริมาณ Fat (gm) :</td>
      <td><input type="text" name="fat" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#CECECE" nowrap align="right">ปริมาณ Nitrogen (gm) :</td>
      <td><input type="text" name="n" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#CECECE" nowrap align="right"> ปริมาณ Calory ต่อถุง :</td>
      <td><input type="text" name="cal" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#CECECE" nowrap align="right">Na:</td>
      <td><input type="text" name="Na" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#CECECE" nowrap align="right">K:</td>
      <td><input type="text" name="K" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#CECECE" nowrap align="right">Ca:</td>
      <td><input type="text" name="Ca" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#CECECE" nowrap align="right">Mg:</td>
      <td><input type="text" name="Mg" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#CECECE" nowrap align="right">P:</td>
      <td><input type="text" name="P" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#CECECE" nowrap align="right">Cl:</td>
      <td><input type="text" name="Cl" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#CECECE" nowrap align="right">Acetate:</td>
      <td><input type="text" name="Acetate" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#CECECE" nowrap align="right">SO4:</td>
      <td><input type="text" name="SO4" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#CECECE" nowrap align="right">Z:</td>
      <td><input type="text" name="Z" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#CECECE" nowrap align="right">Osmole:</td>
      <td><input type="text" name="osmole" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#CCCCCC" align="right" nowrap>Other : </td>
      <td bgcolor="#CCCCCC" align="right" nowrap><textarea name="other" cols="32" rows="2" id="other"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#CCCCCC" colspan="2" align="right" nowrap><div align="center">
        <input type="submit" value="Insert record">
      </div></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#CCCCCC" colspan="2" align="right" nowrap><div align="center"><a href="/hospital/edit_formular.php">Back</a></div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
</body>
</html>
