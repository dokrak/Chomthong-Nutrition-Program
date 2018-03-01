<?php
include 'common.php';

if(!is_usr())
{
header("location:index.php");
}

$level = u::is("level")?u::get():"";
$hid = u::is("hid")?u::get():"";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>

<?php
if($level < 2)
{
?>
<script>
alert("คุณไม่มีสิทธิ์เข้าถึงข้อมูล");
window.location = "screening.php";
</script>
<?php
}
?>
</head>

<body>
<table  width="85%" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <th height="22" colspan="3" bgcolor="#EEFFF1" scope="col"><a href="http://chomthonghospital.go.th/cth2015/"><img src="<?PHP $logo="img/".$hid.".jpg"; echo $logo; ?>" alt="" width="75" height="95" /></a></th>
  </tr>
  <tr>
    <th bgcolor="#C4BEFA" colspan="3" scope="col"><font size="+1">เปลี่ยนแปลงข้อมูลพื้นฐาน</font></th>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="#E0E0E0"><div align="center">สำหรับหัวหน้างาน ( Level 2-3)</div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="16%"><div align="right"><a style="text-shadow:#F36; text-decoration: inherit" href="/nutrition/file/doctor.php"><img src="/nutrition/file/picture/push.jpg" width="38" height="31" alt="" /></a></div></td>
    <td width="71%"><a href="/hospital/doctor.php">เพิ่มรายชื่อแพทย์</a></td>
    <td width="13%">&nbsp;</td>
  </tr>
  <tr>
    <td><div align="right"><a style="text-shadow:#F36; text-decoration: inherit" href="/nutrition/file/reporter.php"><img src="/nutrition/file/picture/push.jpg" width="38" height="31" alt="" /></a></div></td>
    <td><a href="user.php">เพิ่ม user</a></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="right"><a style="text-shadow:#F36; text-decoration: inherit" href="/nutrition/file/ward.php"><img src="/nutrition/file/picture/push.jpg" width="38" height="31" alt="" /></a></div></td>
    <td><a href="/hospital/ward.php">เพิ่มรายชื่อหน่วยงาน<br>
    </a>      <div align="left"></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="#ECECEC"><div align="center">สำหรับ Admin (Level 3)</div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="right"><a style="text-shadow:#F36; text-decoration: inherit" href="/nutrition/file/ward.php"><img src="/nutrition/file/picture/push.jpg" width="38" height="31" alt="" /></a></div></td>
    <td><a href="edit_formular.php">เพิ่ม-เปลี่ยนแปลงรายชื่อสารอาหาร</a></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="right"><a style="text-shadow:#F36; text-decoration: inherit" href="/nutrition/file/ward.php"><img src="/nutrition/file/picture/push.jpg" width="38" height="31" alt="" /></a></div></td>
    <td><a href="/hospital/add_hosp.php">เพิ่มรายชื่อ รพ.</a></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="right"></div></td>
    <td><div align="center"><a href="screening.php">Back to Home</a></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="59" colspan="3" bgcolor="#EEFFF1"><p align="center"><font size="-2" color="#336633"><strong><em>Copyright @ 2017 EKKAWIT ALL RIGHTS RESERVED</em></strong></font></p></td>
  </tr>
</table>
</body>
</html>