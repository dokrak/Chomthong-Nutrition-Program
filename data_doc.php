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

$maxRows_Recordset1 = 1000;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$hid = u::is("hid")?u::get():"";



mysql_select_db($database_hospital, $hospital);
$query_Recordset1 = "SELECT * FROM doctor where hid='".$hid."'";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $hospital) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

$hosp = db::select(array("tbl" => "hospital", "where" => "hid='" . $hid . "'"));
$hospital = db::arr($hosp);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;




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
    <th width="54%" bgcolor="#B4ED78" scope="col"><span style="text-shadow:#C33; background-color: #D8F2B8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้อมูลแพทย์&nbsp;
      <input readonly="readonly" style="background-color:#EFFDC2; text-align:center; font-size:14px"  name="hosp" type="text" id="hosp" value="<?php echo $hospital['hosName']; ?>" size="40" />
    &nbsp;&nbsp;</span></th>
    <th width="22%"  scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td height="50" colspan="3"><form id="form1" name="form1" method="post" action="">
      <table width="597" border="1" align="center" cellpadding="1" cellspacing="0">
        <tr align="center">
          <td align="center" width="100">id</td>
          <td width="130">ชื่อ</td>
          <td width="130">นามสกุล</td>
          <td width="119">เลขที่ ว.</td>
          <td align="center" width="39">&nbsp;</td>
          </tr>
        <?php do { ?>
          <tr>
            <td align="center"><?php echo $row_Recordset1['id']; ?></td>
            <td><?php echo $row_Recordset1['Fname']; ?></td>
            <td><?php echo $row_Recordset1['Lname']; ?></td>
            <td><?php echo $row_Recordset1['code']; ?></td>
            <td align="center"><a href="/hospital/edit_doc.php?id=<?php echo $row_Recordset1['id']; ?>">edit</a></td>
            </tr>
          <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
      </table>
    </form></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td  bgcolor="#D2E0E9"><div align="center">
      <p><a href="/hospital/doctor.php">เพิ่มรายชื่อแพทย์</a> </p>
      <p><a href="/hospital/editdata.php">Back</a></p>
    </div></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
