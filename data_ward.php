<?php 
require_once('Connections/hospital.php');
include 'common.php';

//$hid = u::is("hid")?u::get():"";


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

if (u::is("hid"))
    $hid = u::get();


$dptmnt = db::select(array("tbl" => "department", "where" => "hid='" . $hid . "'"));

$row_dptmnt = db::arr($dptmnt);


mysql_select_db($database_hospital, $hospital);
$query_ward = "SELECT * FROM department where hid='" . $hid . "'";
$ward = mysql_query($query_ward, $hospital) or die(mysql_error());
$row_ward = mysql_fetch_assoc($ward);
$totalRows_ward = mysql_num_rows($ward);

$hosp = db::select(array("tbl" => "hospital", "where" => "hid='" . $hid . "'"));

$hospital = db::arr($hosp);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="80%" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <th   scope="col">&nbsp;</th>
    <th  scope="col"><a href="http://chomthonghospital.go.th/cth2015/"><img src="/nutrition/file/picture/logo1.jpg" alt="" width="77" height="95" /></a></th>
    <th  scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th width="24%"   scope="col">&nbsp;</th>
    <th width="54%" bgcolor="#B4ED78" scope="col"><span style="text-shadow:#C33; background-color: #D8F2B8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้อมูลหน่วยงาน&nbsp;
      <br /><input readonly="readonly" style="background-color: #D8F2B8; text-align:center; font-size:12px"  name="hosp" type="text" id="hosp" value="<?php echo "รพ.".$hospital['hosName']; ?>" size="40" /> 
    &nbsp;</span></th>
    <th width="22%"  scope="col">&nbsp;</th>
  </tr>
  <tr align="center">
    <td height="50" colspan="3"><form id="form1" name="form1" method="post" action="">
      <table width="465" border="1" cellpadding="1" cellspacing="0">
        <tr align="center">
          <td align="center" width="61">id</td>
          <td width="306">dptname</td>
          <td width="84">&nbsp;</td>
        </tr>
        <?php do { ?>
          <tr>
            <td align="center"><?php echo $row_ward['id']; ?></td>
            <td align="center"><?php echo $row_ward['dptname']; ?></td>
            <td align="center"><?php echo $row_ward['hid']; ?></td>
            <td align="center"><a href="/hospital/edit_ward.php?id=<?php echo $row_ward['id']; ?>">edit</a></td>
          </tr>
          <?php } while ($row_ward = mysql_fetch_assoc($ward)); ?>
      </table>
      <div align="center"></div>
    </form></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="#FFCC33"><div align="center"><a href="/hospital/editdata.php">Back </a></div></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($ward);
?>
