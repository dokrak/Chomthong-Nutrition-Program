<?php 
include("common.php");
if(!is_usr())
{
header("location:index.php");
}

$hid = u::is("hid")?u::get():"";

$ward = db::select(array("tbl" => "hospital", "where" => "hid='" . $hid . "'"));

$hospital = db::arr($ward);

mysql_query("SET NAMES UTF8");


function home(){
	
  	$msg = "บันทึกข้อมูลสำเร็จแล้ว ต้องการเพิ่มชื่อเจ้าหน้าที่ใหม่หรือไม่ ?";
  	$confrm="<script type='text/javascript'>
	if(confirm('$msg')==true){window.location.href='reporter.php';}else{
	window.location.href='screening.php';}
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
  $insertSQL = sprintf("INSERT INTO reporter (Fname, Lname, code) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['Fname'], "text"),
                       GetSQLValueString($_POST['Lname'], "text"),
                       GetSQLValueString($_POST['code'], "text"));

  mysql_select_db($database_nutrition, $nutrition);
  $Result1 = mysql_query($insertSQL, $nutrition) or die(mysql_error());
  home();
}


mysql_select_db($database_nutrition, $nutrition);
$query_reporter = "SELECT * FROM reporter";
$reporter = mysql_query($query_reporter, $nutrition) or die(mysql_error());
$row_reporter = mysql_fetch_assoc($reporter);
$totalRows_reporter = mysql_num_rows($reporter);
?>
<?php virtual('/nutrition/Connections/nutrition.php');
mysql_query("SET NAMES UTF8"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<script>
function hn(){
	alert("hello ");
	var hn=document.getElementById("HN").value;
	alert(hn);
	if(<?php echo $row_patient['HN'];?>==0)
	alert("ok");
	}
function chkhn(){
	alert("shecked ok");
	exit;
	}
	
function cancel(){
	alert("cancel?");
	}
</script>
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
    รพ.
    <input readonly="readonly" style="background-color:#EFFDC2; text-align:center; font-size:12px"  name="hosp" type="text" id="hosp" value="<?php echo $hospital['hosName']; ?>" size="40" /></span></th>
    <th width="22%" " scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td height="105" colspan="3"><form   action="<?php echo $editFormAction; ?>" method="POST" name="form2" id="form2">
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
            <td bgcolor="#B4ED78" nowrap="nowrap" align="right">รพ.:</td>
            <td bgcolor="#B4ED78"><input placeholder="Optional" name="code" type="text" id="code" value="" size="40" maxlength="10" /></td>
          </tr>
          <tr valign="baseline">
            <td bgcolor="#B4ED78" align="right" nowrap="nowrap"><div align="center">Username :</div></td>
            <td bgcolor="#B4ED78" align="right" nowrap="nowrap"><input type="text" name="uname" value="" size="40" id="uname" /></td>
          </tr>
          <tr valign="baseline">
            <td bgcolor="#B4ED78" align="right" nowrap="nowrap">Password :</td>
            <td bgcolor="#B4ED78" align="right" nowrap="nowrap"><input type="text" name="pswd" value="" size="40" id="pswd" /></td>
          </tr>
          <tr valign="baseline">
            <td bgcolor="#B4ED78" align="right" nowrap="nowrap">Levle :
              <div align="center"></div></td>
            <td bgcolor="#B4ED78" align="right" nowrap="nowrap"><input type="text" name="pswd2" value="" size="40" id="pswd2" /></td>
          </tr>
          <tr valign="baseline">
            <td bgcolor="#B4ED78" align="right" nowrap="nowrap">Email :</td>
            <td bgcolor="#B4ED78" align="right" nowrap="nowrap"><input type="text" name="pswd3" value="" size="40" id="pswd3" /></td>
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
      <p><a href="/nutrition/file/data/data_rpt.php">แก้ไขข้อมูลเจ้าหน้าที่</a></p>
      <p><a href="/nutrition/file/screening.php">Back to home</a></p>
    </div></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($reporter);

mysql_free_result($patient);

?>
