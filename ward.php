<?php
include("common.php");
$hid = u::is("hid")?u::get():"";

$ward = db::select(array("tbl" => "hospital", "where" => "hid='" . $hid . "'"));


$hospital = db::arr($ward);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="jquery-3.2.1.min.js"></script>

<script type="text/javascript" src="ward.js"></script>

<title>Untitled Document</title>
</head>
<body>
<table width="80%" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <th   scope="col">&nbsp;</th>
    <th  scope="col"><a href="http://chomthonghospital.go.th/cth2015/"><img src="<?PHP $logo="img/".$hid.".jpg"; echo $logo; ?>" alt="" width="75" height="95" /></a></th>
    <th  scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th width="18%"   scope="col">&nbsp;</th>
    <th width="67%" bgcolor="#B4ED78" scope="col"><div><span style="text-shadow:#C33; background-color: #D8F2B8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เพิ่มรายชื่อหน่วยงาน&nbsp;&nbsp;</span>
    <br /><input readonly="readonly" style="border:none; font-size:14px; background-color:#D3E3F3; text-align:center" maxlength="9" name="hosp2" type="text" id="hosp2" value="<?php echo  "รพ.".$hospital['hosName'];?>" size="40" /></div></th>
    <th width="15%"  scope="col">&nbsp;</th>
  </tr>
  <tr>
                                       

    <td height="105" colspan="3"><form  name="form2" id="form2">
        <table width="461"  align="center">
          <tr valign="baseline">
            <td colspan="2" align="right" nowrap="nowrap" bgcolor="#B4ED78"><div align="center"></div></td>
          </tr>
          <tr valign="baseline">
            <td bgcolor="#B4ED78" nowrap="nowrap" align="right">Ward :</td>
            <td bgcolor="#B4ED78"><input name="dptname" type="text" id="dptname" value="" size="50" /></td>
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
    <td bgcolor="#B4ED78"><div align="center">
      <p><a href="data_ward.php">แก้ไขรายชื่อหน่วยงาน</a></p>
      <p><a href="/hospital/editdata.php">Back</a></p>
    </div></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
