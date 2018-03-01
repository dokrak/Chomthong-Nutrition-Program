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
if($level < 3)
{
?>
<script>
alert("คุณไม่มีสิทธิ์เข้าถึงการแก้ไขข้อมูลส่วนนี้");
window.location = "editdata.php";
</script>
<?php
}
?>
</head>

<body>
<table  width="71%" border="0" align="center" cellpadding="0" cellspacing="1">
  <tr>
    <th height="22" colspan="3" bgcolor="#EEFFF1" scope="col"><a href="http://chomthonghospital.go.th/cth2015/"><img src="<?PHP $logo="img/".$hid.".jpg"; echo $logo; ?>" alt="" width="75" height="95" /></a></th>
  </tr>
  <tr>
    <th bgcolor="#C4BEFA" colspan="3" scope="col"><font size="+1">เปลี่ยนแปลงข้อมูลพื้นฐาน</font></th>
  </tr>
  <tr>
    <td width="16%" rowspan="6">&nbsp;</td>
    <td bgcolor="#EBEBEB">รายการสารอาหารที่ให้ทางเส้นเลือดดำ (Parenteral nutrition)</td>
    <td width="13%" rowspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td><blockquote>
      <p><a href="/hospital/data_pn.php">แก้ไขรายการ Parenteral nutrition</a></p>
    </blockquote></td>
  </tr>
  <tr>
    <td><blockquote>
      <p>&nbsp;</p>
    </blockquote></td>
  </tr>
  <tr>
    <td bgcolor="#E7E7E7">รายการสารอาหารที่ให้ทางลำไส้(Enteral nutrition)<br>    </td>
  </tr>
  <tr>
    <td><blockquote><a href="/hospital/data_en.php">แก้ไขรายการ Enteral formular</a></blockquote></td>
  </tr>
  <tr>
    <td><blockquote><a href="/nutrition/file/data/data_en.php"></a></blockquote></td>
  </tr>
  <tr>
    <td height="59" colspan="3" bgcolor="#EEFFF1"><p align="center"><a href="editdata.php">BACK</a></p></td>
  </tr>
  <tr>
    <td height="59" colspan="3" bgcolor="#EEFFF1"><div align="center"><font size="-2" color="#336633"><strong><em>Copyright @ 2017 EKKAWIT ALL RIGHTS RESERVED</em></strong></font></div></td>
  </tr>
</table>
</body>
</html>
<?php

?>
