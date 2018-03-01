<?php
include 'common.php';


if(!is_usr())
{
header("location:index.php");
}


$query_hos = "SELECT max(id)+1 as hid  from hospital";
$ward = db::query($query_hos);
$row_hos  = db::arr($ward);

$level = u::is("level")?u::get():"";
$hid = u::is("hid")?u::get():"";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="jquery-3.2.1.min.js"></script>

<script type="text/javascript" src="add_hosp.js"></script>
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
<table width="80%" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <th   scope="col">&nbsp;</th>
    <th  scope="col"><a href="http://chomthonghospital.go.th/cth2015/"><img src="<?PHP $logo="img/".$hid.".jpg"; echo $logo; ?>" alt="" width="75" height="95"class="img-rounded" /></a></th>
    <th scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th width="24%"   scope="col">&nbsp;</th>
    <th width="54%" bgcolor="#B4ED78" scope="col"><span style="text-shadow:#C33; background-color: #D8F2B8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เพิ่มรายชื่อ รพ.&nbsp;&nbsp;&nbsp;&nbsp;</span></th>
    <th width="22%" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td height="105" colspan="3"><form name="form1" id="form1">
        <table align="center">
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">ลำดับที่</td>
            <td style="text-align:center"><div align="right">
              <input readonly="readonly" name="hid" type="text" id="hid" placeholder="ถ้าไม่ทราบ กดค้นหาจาก linkได้ " style="text-align:left; background-color: #C2F8C3" value="<?php echo $row_hos['hid']; ?>" size="32" />
            </div></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><a href="http://203.157.10.8/hcode_2014/query_set.php?p=3">รหัสหน่วยบริการ</a> :</td>
            <td><input style="text-align:center" placeholder="ถ้าไม่ทราบ กดค้นหาจาก linkได้ " type="text" name="hosID" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">HosName:</td>
            <td><input type="text" name="hosName" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Province:</td>
            <td><input type="text" name="province" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value="Insert record" /></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1" />
      </form>
    <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="#B4ED78"><div align="center">
      <p><a href="/hospital/screening.php">Back to home</a></p>
      <p><a href="http://203.157.10.8/hcode_2014/query_set.php?p=3">ค้นหารหัสหน่วยบริการ</a></p>
    </div></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
