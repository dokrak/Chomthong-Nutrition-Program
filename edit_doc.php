<?php 
include 'common.php';
if(!is_usr())
{
header("location:index.php");
}

require_once('Connections/hospital.php'); 



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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE doctor SET Fname=%s, Lname=%s, code=%s WHERE id=%s",
                       GetSQLValueString($_POST['Fname'], "text"),
                       GetSQLValueString($_POST['Lname'], "text"),
                       GetSQLValueString($_POST['code'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_hospital, $hospital);
  $Result1 = mysql_query($updateSQL, $hospital) or die(mysql_error());

   $goto="<script>alert('แก้ไขข้อมูลสำเร็จ');window.location.href='/hospital/editdata.php';</script>";
  echo($goto);
}




$colname_Recordset1 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset1 = $_GET['id'];
}




mysql_select_db($database_hospital, $hospital);
$query_Recordset1 = sprintf("SELECT * FROM doctor WHERE id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $hospital) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$hid = u::is("hid")?u::get():"";

$ward = db::select(array("tbl" => "hospital", "where" => "hid='" . $hid . "'"));

$hospital = db::arr($ward);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
    <th width="24%"   scope="col">&nbsp;</th>
    <th width="54%" bgcolor="#B4ED78" scope="col"><span style="text-shadow:#C33; background-color: #D8F2B8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แก้ไขข้อมูลแพทย์&nbsp;&nbsp;&nbsp; 
     <br /> <input readonly="readonly" style="text-align:center; font-size:12px; background-color: #D1F8BF"  name="hosp" type="text" id="hosp" value="<?php echo "รพ.".$hospital['hosName']; ?>" size="40" />
    </span></th>
    <th width="22%"  scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td height="218" colspan="3"><form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
        <table align="center">
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Id:</td>
            <td><?php echo $row_Recordset1['id']; ?></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Fname:</td>
            <td><input type="text" name="Fname" value="<?php echo htmlentities($row_Recordset1['Fname'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Lname:</td>
            <td><input type="text" name="Lname" value="<?php echo htmlentities($row_Recordset1['Lname'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Code:</td>
            <td><input type="text" name="code" value="<?php echo htmlentities($row_Recordset1['code'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value="Update record" /></td>
          </tr>
        </table>
        <input type="hidden" name="MM_update" value="form2" />
        <input type="hidden" name="id" value="<?php echo $row_Recordset1['id']; ?>" />
      </form>
    <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td style="background-color:#BAD2F6" align="center" ><a class="link" href="/hospital/editdata.php">Back</a></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
