<?php

include("common.php");

$query_en = "SELECT * FROM en";
$en = db::query($query_en);
$rows_en = db::arrs($en);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td height="30"><div align="center">รายการอาหารที่ให้ทาง Enteral route</div></td>
  </tr>
  <tr>
    <td><div align="center">
      <table border="0" cellpadding="1" cellspacing="0">
        <tr style="text-align:center" align="center" >
          <td colspan="8"><a href="http://chomthonghospital.go.th/cth2015/"><img src="/nutrition/file/picture/logo1.jpg" alt="" width="68" height="72" longdesc="/nutrition/file/picture/logo1.jpg" /></a></td>
          </tr>
        <tr style="text-align:center" align="center" bgcolor="#CCCCCC">
          <td>ลำดับที่</td>
          <td><em>รายการสารอาหาร </em></td>
          <td>ปริมาณ calory (Kcal/10000ml)</td>
          <td>ปริมาณ carbohydrate (gm/1000ml)</td>
          <td>ปริมาณ protein (gm/1000ml)</td>
          <td>ปริมาณ fat (gm/1000ml)</td>
          <td>ความจำเพาะต่อโรค</td>
          <td>&nbsp;</td>
        </tr>
        <?php do {

$row_en = current($rows_en);
 ?>
          <tr>
            <td align="center"><?php echo $row_en['id']; ?></td>
            <td><?php echo $row_en['nameE']; ?></td>
            <td align="center"><?php echo $row_en['cal']; ?></td>
            <td align="center"><?php echo $row_en['cho']; ?></td>
            <td align="center"><?php echo $row_en['prot']; ?></td>
            <td align="center"><?php echo $row_en['fat']; ?></td>
            <td><?php echo $row_en['spec_dis']; ?></td>
            <td><a href="/hospital/edit_en.php?id=<?php echo $row_en['id']; ?>">Edit</a></td>
          </tr>
          <?php } while (next($rows_en)); ?>
      </table>
    </div></td>
  </tr>
  <tr>
    <td><div align="center">
      <p><a href="/hospital/edit_formular.php">Back</a> </p>
      <p><a href="/hospital/add_en.php">เพิ่มรายการ</a></p>
    </div></td>
  </tr>
</table>
</body>
</html>
