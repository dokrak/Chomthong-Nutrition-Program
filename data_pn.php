<?php require_once('Connections/hospital.php'); 
mysql_query('SET NAMES UTF8');
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

mysql_select_db($database_hospital, $hospital);
$query_pn = "SELECT * FROM pn";
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
<table align="center"  bgcolor="#E0EEFC" border="1" cellpadding="1" cellspacing="1">
  <tr bgcolor="#D3D3D3">
    <td align="center" colspan="20"><div align="center"><a href="http://chomthonghospital.go.th/cth2015/"><img src="/hospital/img/logo1.jpg" alt="" width="68" height="72"  /></a></div></td>
    
  </tr>
  <tr bgcolor="#D3D3D3">
    <td align="center" colspan="19"><font size="+1">รายการสารอาหารที่ให้ทางหลอดเลือดดำ</font></td>
    <td width="55">&nbsp;</td>
  </tr>
  <tr style="text-align:center" bgcolor="#E0C1E6">
    <td width="45">id</td>
    <td width="75">รายการ</td>
    <td width="52">ขนาดบรรจุ (ml)</td>
    <td width="56">ปริมาณ carbohydrate (gm/set)</td>
    <td width="59">ปริมาณ protein (gm/set)</td>
    <td width="49">ปริมาณ fat (gm/set)</td>
    <td width="41">ปริมาณ nitrogen (gm/set)</td>
    <td width="51">ปริมาณ calory (Kcal/set)</td>
    <td width="53">Na</td>
    <td width="46">K</td>
    <td width="52">Ca</td>
    <td width="55">Mg</td>
    <td width="43">P</td>
    <td width="48">Cl</td>
    <td width="81">Acetate</td>
    <td width="63">SO4</td>
    <td width="43">Z</td>
    <td width="77">Osmole</td>
     <td width="80">Other</td>
    <td>&nbsp;</td>
  </tr>
  <?php do { ?>
    <tr>
      <td align="center"><?php echo $row_pn['id']; ?></td>
      <td><?php echo $row_pn['nameP']; ?></td>
      <td align="center"><?php echo $row_pn['vol']; ?></td>
      <td align="center"><?php echo $row_pn['cho']; ?></td>
      <td align="center"><?php echo $row_pn['prot']; ?></td>
      <td align="center"><?php echo $row_pn['fat']; ?></td>
      <td align="center"><?php echo $row_pn['n']; ?></td>
      <td align="center"><?php echo $row_pn['cal']; ?></td>
      <td align="center"><?php echo $row_pn['Na']; ?></td>
      <td align="center"><?php echo $row_pn['K']; ?></td>
      <td align="center"><?php echo $row_pn['Ca']; ?></td>
      <td align="center"><?php echo $row_pn['Mg']; ?></td>
      <td align="center"><?php echo $row_pn['P']; ?></td>
      <td align="center"><?php echo $row_pn['Cl']; ?></td>
      <td align="center"><?php echo $row_pn['Acetate']; ?></td>
      <td align="center"><?php echo $row_pn['SO4']; ?></td>
      <td align="center"><?php echo $row_pn['Z']; ?></td>
      <td align="center"><?php echo $row_pn['osmole']; ?></td>
      <td align="center"><?php echo $row_pn['other']; ?></td>
      <td align="center"><a href="/hospital/edit_pn.php?id=<?php echo $row_pn['id']; ?>"> Edit </a></td>
    </tr>
    <?php } while ($row_pn = mysql_fetch_assoc($pn)); ?>
</table>
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td><div align="center">
      <p>&nbsp;</p>
      <p><a style="text-decoration:none"  href="/hospital/add_pn.php">เพิ่มข้อมูลรายการ Parenteral Products</a></p>
      <p><a href="/hospital/edit_formular.php">Back</a></p>
    </div></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($pn);
?>
