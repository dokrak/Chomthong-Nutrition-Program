<?php require_once('Connections/hospital.php'); ?>
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

$hosp1_bnt = "-1";
if (isset($_GET['hosp1'])) {
  $hosp1_bnt = $_GET['hosp1'];
}
$Sdate_bnt = "-1";
if (isset($_GET['Sdate'])) {
  $Sdate_bnt = $_GET['Sdate'];
}
$Edate_bnt = "-1";
if (isset($_GET['Edate'])) {
  $Edate_bnt = $_GET['Edate'];
}
mysql_select_db($database_hospital, $hospital);
$query_bnt = sprintf("SELECT * FROM nt2013 WHERE hosp = %s and nt2013.screendate>=%s and nt2013.screendate<=%s order by ward ,screenid ASC", GetSQLValueString($hosp1_bnt, "text"),GetSQLValueString($Sdate_bnt, "date"),GetSQLValueString($Edate_bnt, "date"));
$bnt = mysql_query($query_bnt, $hospital) or die(mysql_error());
$row_bnt = mysql_fetch_assoc($bnt);
$totalRows_bnt = mysql_num_rows($bnt);


$hosp_severe = "-1";
if (isset($_GET['hosp1'])) {
  $hosp_severe = $_GET['hosp1'];
}
mysql_select_db($database_hospital, $hospital);
$query_severe = sprintf("SELECT  count(nt2013.screenid) as count FROM nt2013 WHERE hosp=%s and nt2013.score>=11 and screendate>='".$Sdate_bnt."'and screendate<='".$Edate_bnt."'", GetSQLValueString($hosp_severe, "text"));
$severe = mysql_query($query_severe, $hospital) or die(mysql_error());
$row_severe = mysql_fetch_assoc($severe);
$totalRows_severe = mysql_num_rows($severe);

$hosp1_moderate = "-1";
if (isset($_GET['hosp1'])) {
  $hosp1_moderate = $_GET['hosp1'];
}
mysql_select_db($database_hospital, $hospital);
$query_moderate = sprintf("SELECT  count(screenid) as count FROM nt2013  WHERE hosp = %s and score>=8 and score<=10 and screendate>='".$Sdate_bnt."'and screendate<='".$Edate_bnt."'", GetSQLValueString($hosp1_moderate, "text"));
$moderate = mysql_query($query_moderate, $hospital) or die(mysql_error());
$row_moderate = mysql_fetch_assoc($moderate);
$totalRows_moderate = mysql_num_rows($moderate);

$hosp1_mild = "-1";
if (isset($_GET['hosp1'])) {
  $hosp1_mild = $_GET['hosp1'];
}
mysql_select_db($database_hospital, $hospital);
$query_mild = sprintf("SELECT count(screenid) as count FROM nt2013 WHERE hosp=%s and score>=5 and score<=7 and screendate>='".$Sdate_bnt."'and screendate<='".$Edate_bnt."'", GetSQLValueString($hosp1_mild, "int"));
$mild = mysql_query($query_mild, $hospital) or die(mysql_error());
$row_mild = mysql_fetch_assoc($mild);
$totalRows_mild = mysql_num_rows($mild);

$hosp1_normal = "-1";
if (isset($_GET['hosp1'])) {
  $hosp1_normal = $_GET['hosp1'];
}
mysql_select_db($database_hospital, $hospital);
$query_normal = sprintf("SELECT count(screenid) as count FROM nt2013 WHERE hosp = %s and score<=4 and score>=0 and screendate>='".$Sdate_bnt."'and screendate<='".$Edate_bnt."'", GetSQLValueString($hosp1_normal, "text"));
$normal = mysql_query($query_normal, $hospital) or die(mysql_error());
$row_normal = mysql_fetch_assoc($normal);
$totalRows_normal = mysql_num_rows($normal);



$total=$totalRows_bnt ;

 
 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Show DATA BNT2013</title>

<style type="text/css">
central {
	text-align: center;
}
tr td {
	text-align: center;
	color: #000066;
}
#form1 table {
	color: #006;
}
table {
	color: #039;
}
</style>
</head>

<body>
<p>แสดงผลการประเมินคัดกรองภาวะโภชนาการด้วย BNT-2013 โรงพยาบาล 
  <label for="hosp"></label>
  <?php echo $hosp1_bnt; ?></p>
<p>ตั้งแต่ 
  <label for="Sdate"></label>
  
  <input style="text-align:center" value="<?php echo $_GET['Sdate']; ?>" type="text" name="Sdate" id="Sdate" />
-
<label for="Edate"></label>
<input style="text-align:center" value="<?php echo $_GET['Edate']; ?>" type="text" name="Edate" id="Edate" />
</p>
<p>&nbsp;พบข้อมูลทั้งหมด =<font  color="#6633CC"><?php echo $totalRows_bnt ?></font> records</p>
<form id="form1" name="form1" method="post" action="">
  <font color="#003366">
  <table width="900" align="center" boder="1" bordercolor=""cellpadding="1" cellspacing="1">
    <tr >
      <td colspan="11"><table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr bgcolor="#FDF3DB">
          <td>Normal (NT-1) </td>
          <td>Mild (NT-2)</td>
          <td>Moderate (NT-3)</td>
          <td>Severe (NT-4)</td>
        </tr>
        <tr bgcolor="#FFF6FC">
          <td><?PHP echo $row_normal['count']."(".number_format($row_normal['count']*100/($total),2,'.','')."%)";?></td>
          <td><?PHP echo $row_mild['count']."(".number_format($row_mild['count']*100/($total),2,'.','')."%)";?></td>
          <td><?PHP echo $row_moderate['count']."(".number_format($row_moderate['count']*100/($total),2,'.','')."%)";?></td>
          <td><?PHP echo $row_severe['count']."(".number_format($row_severe['count']*100/($total),2,'.','')."%)";?></td>
        </tr>
        <tr bgcolor="#FFF6FC">
          <td colspan="4"><div style="background-color:#F7F6FA" id="ShowGraph"></div></td>
          </tr>
      </table></td>
    </tr>
    <tr bgcolor="#D8DFF6">
      <td><font color="#003366">ลำดับที่</font></td>
      <td>HN</td>
      <td width="100"><font color="#003366">วันที่</font></td>
      <td>เลขที่ screen</td>
      <td><font color="#003366">โรงพยาบาล</font></td>
      <td>Ward</td>
      <td bgcolor="#D8E5FC"><font color="#003366">ชื่อ</font></td>
      <td><font color="#003366">นามสกุล</font></td>
      <td><font color="#003366">อายุ</font></td>
      <td><font color="#003366">เพศ</font></td>
      <td><font color="#003366">ระดับภาวะทุพโภชนาการ</font></td>
    </tr> </font><font color="#3333CC">
    <?php do { ?>
      <tr>
        <td ><?php echo $row_bnt['screenid']; ?></td>
        <td><?php echo $row_bnt['HN']; ?></td>
        <td><?php echo $row_bnt['screendate']; ?></td>
        <td><?php echo $row_bnt['screenNo']; ?></td>
        <td><?php echo $row_bnt['hosp']; ?></td>
        <td><?php echo $row_bnt['ward']; ?></td>
        <td align="left"><?php echo $row_bnt['Fname']; ?></td>
        <td align="left"><?php echo $row_bnt['Lname']; ?></td>
        <td><?php echo $row_bnt['age']; ?></td>
        <td><?php echo $row_bnt['sex']; ?></td>
        <td bgcolor="<?PHP if(substr($row_bnt['level'],3,1)=='4'){ echo'#FF8075';}else if(substr($row_bnt['level'],3,1)=='3'){ echo'#F3F3C1';}else if(substr($row_bnt['level'],3,1)=='2'){ echo'#D4F6C8';}else {echo'#EFF0F7';} ?>" align="left" ><?php echo $row_bnt['level']; ?></td>
      </tr></font>
      <tr>
        <td bgcolor="#E3E3F6" align="center" colspan="11"></td>         
      <tr>
        <?php } while ($row_bnt = mysql_fetch_assoc($bnt)); ?>
  </table>
 
</form>
<p align="center"><a href="screening.php">Back to Home</a></p>
</body>
</html>
<?php
mysql_free_result($bnt);

mysql_free_result($severe);

mysql_free_result($moderate);

mysql_free_result($mild);

mysql_free_result($normal);

mysql_query('SET NAMES UTF8');

?>