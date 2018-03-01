<?php 

//require_once('Connections/hospital.php'); 
include("common.php");
if(!is_usr())
{
header("location:index.php");
}

$hid = u::is("hid")?u::get():"";

$ward = db::select(array("tbl" => "hospital", "where" => "hid='" . $hid . "'"));

$hospital = db::arr($ward);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="jquery-3.2.1.min.js"></script>


<script type="text/javascript" src="doctor.js"></script>
<title>Untitled Document</title>
</head>

<body>
<table width="80%" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <th   scope="col">&nbsp;</th>
    <th  scope="col"><a href="http://chomthonghospital.go.th/cth2015/"><img src="<?PHP $logo="img/".$hid.".jpg"; echo $logo; ?>" alt="" width="75" height="95" /></a></th>
    <th " scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th width="24%"   scope="col">&nbsp;</th>
    <th width="54%" bgcolor="#B4ED78" scope="col"><span style="text-shadow:#C33; background-color: #D8F2B8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เพิ่มรายชื่อแพทย์&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <br><input readonly="readonly" style="background-color:#EFFDC2; text-align:center; font-size:12px"  name="hosp" type="text" id="hosp" value="<?php echo $hospital['hosName']; ?>" size="40" />
    </span></th>
    <th width="22%" " scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td height="105" colspan="3"><form   action='#' name="form2" id="form2">
        <table  align="center">
          <tr valign="baseline">
            <td bgcolor="#B4ED78" nowrap="nowrap" align="right">ชื่อ:</td>
            <td bgcolor="#B4ED78"><input type="text" name="Fname" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td bgcolor="#B4ED78" nowrap="nowrap" align="right">นามสกุล:</td>
            <td bgcolor="#B4ED78"><input type="text" name="Lname" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td bgcolor="#B4ED78" nowrap="nowrap" align="right">เลขที่ ว.:</td>
            <td bgcolor="#B4ED78"><input placeholder="Optional" name="code" type="text" id="code" value="" size="32" maxlength="5" /></td>
          </tr>
          <tr valign="baseline">
            <td bgcolor="#B4ED78" colspan="2" align="right" nowrap="nowrap"><div align="center">
              <input name="save"  type="submit" id="save" value="Save" />
            </div></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form2" />
    </form></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="#B4ED78"><div align="center"><a href="data_doc.php">แก้ไขข้อมูลแพทย์</a> <br />
      <a href="/hospital/editdata.php">Back </a></div></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
