<?php 

include 'common.php';
if(!is_usr())
{
header("location:index.php");
}
$level = u::is("level")?u::get():"";//กำหนด level

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

$maxRows_usr = 10000;
$pageNum_usr = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_usr = $_GET['pageNum_Recordset1'];
}
$startRow_usr = $pageNum_usr * $maxRows_usr;

$hid = u::is("hid")?u::get():"";



mysql_select_db($database_hospital, $hospital);
$query_usr = "SELECT * FROM user where hid='".$hid."' and level<='".$level."'";
$query_limit_usr = sprintf("%s LIMIT %d, %d", $query_usr, $startRow_usr, $maxRows_usr);
$usr = mysql_query($query_limit_usr, $hospital) or die(mysql_error());
$row_usr = mysql_fetch_assoc($usr);

$hosp = db::select(array("tbl" => "hospital", "where" => "hid='" . $hid . "'"));
$hospital = db::arr($hosp);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_usr = $_GET['totalRows_Recordset1'];
} else {
  $all_usr = mysql_query($query_usr);
  $totalRows_usr = mysql_num_rows($all_usr);
}
$totalPages_usr = ceil($totalRows_usr/$maxRows_usr)-1;




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
    <th width="54%" bgcolor="#B4ED78" scope="col"><span style="text-shadow:#C33; background-color: #D8F2B8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้อมูลผู้เข้าใช้งาน
        <input readonly="readonly" style="background-color:#EFFDC2; text-align:center; font-size:14px"  name="hosp" type="text" id="hosp" value="<?php echo $hospital['hosName']; ?>" size="40" />
    &nbsp;&nbsp;</span></th>
    <th width="22%"  scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td height="50" colspan="3"><form id="form1" name="form1" method="post" action="">
      <table width="681" border="1" align="center" cellpadding="1" cellspacing="0">
        <tr align="center">
          <td align="center" width="69">id</td>
          <td width="99">ชื่อ</td>
          <td width="99">นามสกุล</td>
          <td width="93">Username</td>
          <td width="93">Password</td>
          <td width="93">Level</td>
          <td width="93">Email</td>
          <td align="center" width="58">&nbsp;</td>
          </tr>
        <?php do { ?>
          <tr>
            <td align="center"><?php echo $row_usr['uid']; ?></td>
            <td><?php echo $row_usr['Fname']; ?></td>
            <td><?php echo $row_usr['Lname']; ?></td>
            <td><?php echo $row_usr['uname']; ?></td>
            <td><?php echo $row_usr['pw']; ?></td>
            <td width="63"><?php echo $row_usr['level']; ?></td>
            <td width="60"><?php echo $row_usr['mail']; ?></td>
            <td width="70" align="center"><a href="/hospital/edit_user.php?id=<?php echo $row_usr['uid']; ?>">edit</a></td>
            </tr>
          <?php } while ($row_usr = mysql_fetch_assoc($usr)); ?>
      </table>
    </form></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td  bgcolor="#D2E0E9"><div align="center">
      <p><a href="/hospital/doctor.php">เพิ่มรายชื่อผู้ใช้</a></p>
      <p><a href="/hospital/editdata.php">Back</a></p>
    </div></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($usr);
?>
