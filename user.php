<?php 
include("common.php");
if(!is_usr())
{
header("location:index.php");
}

$level = u::is("level")?u::get():"";
//require_once("Connections/hospital.php");

$hid = u::is("hid")?u::get():"";

$ward = db::select(array("tbl" => "hospital", "where" => "hid='" . $hid . "'" ));

$hospital = db::arr($ward);

mysql_query("SET NAMES UTF8");
?>
<?php 
/*

function home(){
	
  	$msg = "บันทึกข้อมูลสำเร็จแล้ว ต้องการเพิ่มชื่อเจ้าหน้าที่ใหม่หรือไม่ ?";
  	$confrm="<script type='text/javascript'>
	if(confirm('$msg')==true){window.location.href='user.php';}else{
	window.location.href='editdata.php';}
	</script>";
	echo($confrm);
	}


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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {


$hid = u::is("hid")?u::get():"";

  $insertSQL = sprintf("INSERT INTO user (Fname, Lname, uname,pw,level,email,hid) VALUES (%s, %s, %s,%s,%s, %s, %s)",
                       GetSQLValueString($_POST['Fname'], "text"),
                       GetSQLValueString($_POST['Lname'], "text"),
                       GetSQLValueString($_POST['uname'], "text"),
					   GetSQLValueString($_POST['pw'], "text"),
					   GetSQLValueString($_POST['level'], "text"),
					   GetSQLValueString($_POST['email'], "text"),
                       "'". $hid."'");

  mysql_select_db($database_hospital, $hospital);
  $Result1 = mysql_query($insertSQL, $hospital) or die(mysql_error());
  home();
}


mysql_select_db($database_hospital, $hospital);
$query_usr = "SELECT * FROM user";
$usr = mysql_query($query_usr, $hospital) or die(mysql_error());
$row_usr = mysql_fetch_assoc($usr);
$totalRows_usr= mysql_num_rows($usr);
*/
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<script src="jquery-3.2.1.min.js"></script>


<script type="text/javascript" src="user.js"></script>

<?php
if($level < 2)
{
?>
<script>
alert("คุณไม่มีสิทธิ์เข้าถึงการแก้ไขข้อมูลส่วนนี้ (Level3 only!)");
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
    <th  scope="col"><a href="http://chomthonghospital.go.th/cth2015/"><img src="/nutrition/file/picture/logo1.jpg" width="77" height="95" /></a></th>
    <th " scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th width="24%"   scope="col">&nbsp;</th>
    <th width="54%" bgcolor="#B4ED78" scope="col"><span style="text-shadow:#C33; background-color: #D8F2B8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เพิ่มรายชื่อผู้ใช้งาน&nbsp;
    <br>
    <input readonly="readonly" style="background-color:#EFFDC2; text-align:center; font-size:12px"  name="hosp" type="text" id="hosp" value="<?php echo "รพ.".$hospital['hosName']; ?>" size="40" /></span></th>
    <th width="22%" " scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td height="105" colspan="3"><form   action="#"  name="form2" id="form2">
        <table  align="center">
          <tr valign="baseline">
            <td bgcolor="#B4ED78" nowrap="nowrap" align="right">ชื่อ :</td>
            <td bgcolor="#B4ED78"><input type="text" name="Fname" value="" size="40" /></td>
          </tr>
          <tr valign="baseline">
            <td bgcolor="#B4ED78" nowrap="nowrap" align="right">นามสกุล :</td>
            <td bgcolor="#B4ED78"><input type="text" name="Lname" value="" size="40" /></td>
          </tr>
          <tr valign="baseline">
            <td bgcolor="#B4ED78" align="right" nowrap="nowrap"><div align="center">Username :</div></td>
            <td bgcolor="#B4ED78" align="right" nowrap="nowrap"><input type="text" name="uname" value="" size="40" id="uname" /></td>
          </tr>
          <tr valign="baseline">
            <td bgcolor="#B4ED78" align="right" nowrap="nowrap">Password :</td>
            <td bgcolor="#B4ED78" align="right" nowrap="nowrap"><input type="text" name="pw" value="" size="40" id="pw" /></td>
          </tr>
          <tr valign="baseline">
            <td bgcolor="#B4ED78" align="right" nowrap="nowrap">Levle :
              <div align="center"></div></td>
            <td bgcolor="#B4ED78" align="right" nowrap="nowrap"><label for="level"></label>
              <div align="left">
                <?PHP if($level<3)
				{echo'<select name="level" id="level">
                  <option value="1">1</option>
                  <option value="2">2</option>
                </select>';
				  echo'<font size="-2" color="#3333CC"">&nbsp;คุณมีสิทธิ์เพิ่ม user ได้ถึง level 2 เท่านั้น</font> ';
				}else{
				echo'<select name="level" id="level">
                  <option value="1">1</option>
                  <option value="2">2</option>
                 <option value="3">3</option>
                </select>';
				 echo'<font size="-2" color="#336666"">&nbsp;คุณมีสิทธิ์เพิ่ม user ได้ถึง level 3</font> ';
					}
				?>
                
            </div></td>
          </tr>
          <tr valign="baseline">
            <td bgcolor="#B4ED78" align="right" nowrap="nowrap">Email :</td>
            <td bgcolor="#B4ED78" align="right" nowrap="nowrap"><input type="text" name="mail" value="" size="40" id="mail" /></td>
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
      <p><a href="/hospital/data_user.php">แก้ไขข้อมูลผู้ใช้</a></p>
      <p><a href="/hospital/editdata.php">Back</a></p>
    </div></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php


?>
