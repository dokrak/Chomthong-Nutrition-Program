<?php require_once('Connections/hospital.php'); ?>
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

mysql_select_db($database_hospital, $hospital);
$query_count4 = "SELECT count(screenid) as count FROM nt2013 WHERE score >10";
$count4 = mysql_query($query_count4, $hospital) or die(mysql_error());
$row_count4 = mysql_fetch_assoc($count4);
$totalRows_count4 = mysql_num_rows($count4);

mysql_select_db($database_hospital, $hospital);
$query_count2 = "SELECT screenid FROM nt2013 WHERE score < 6 group by hid";
$count2 = mysql_query($query_count2, $hospital) or die(mysql_error());
$row_count2 = mysql_fetch_assoc($count2);
$totalRows_count2 = mysql_num_rows($count2);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<p>ข้อมูลการทำ BNT-2013</p>
<form id="form1" name="form1" method="post" action="">
  <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td>&nbsp;</td>
      <td>severe</td>
      <td>mild</td>
    </tr>
    <tr>
      <?php do { ?>
        <td>&nbsp;</td>
        <td><?php echo $row_count4['count']; ?></td>
        <td><?php echo $row_count2['screenid']; ?></td>
        <?php } while ($row_count4 = mysql_fetch_assoc($count4)); ?>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($count4);

mysql_free_result($count2);
?>
