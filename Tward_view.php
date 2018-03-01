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

$hosp1_triagent = "-1";
if (isset($_GET['hosp1'])) {
  $hosp1_triagent = $_GET['hosp1'];
}
$Sdate_triagent = "-1";
if (isset($_GET['Sdate'])) {
  $Sdate_triagent = $_GET['Sdate'];
}
$Edate_triagent = "-1";
if (isset($_GET['Edate'])) {
  $Edate_triagent = $_GET['Edate'];
}
mysql_select_db($database_hospital, $hospital);
$query_triagent = sprintf("SELECT * FROM triagent WHERE hosp=%s and Tdate>=%s and Tdate <=%s ", GetSQLValueString($hosp1_triagent, "text"),GetSQLValueString($Sdate_triagent, "date"),GetSQLValueString($Edate_triagent, "date"));
$triagent = mysql_query($query_triagent, $hospital) or die(mysql_error());
$row_triagent = mysql_fetch_assoc($triagent);
$totalRows_triagent = mysql_num_rows($triagent);


$hosp1_risk = "-1";
if (isset($_GET['hosp1'])) {
  $hosp1_risk = $_GET['hosp1'];
}
$Sdate_risk = "-1";
if (isset($_GET['Sdate'])) {
  $Sdate_risk = $_GET['Sdate'];
}
$Edate_risk = "-1";
if (isset($_GET['Edate'])) {
  $Edate_risk = $_GET['Edate'];
}


mysql_select_db($database_hospital, $hospital);
$query_risk = sprintf("SELECT count(id) as count FROM triagent WHERE hosp=%s and Tdate>=%s and Tdate<=%s and risk='High Risk'", GetSQLValueString($hosp1_risk, "text"),GetSQLValueString($Sdate_risk, "date"),GetSQLValueString($Edate_risk, "date"));
$risk = mysql_query($query_risk, $hospital) or die(mysql_error());
$row_risk = mysql_fetch_assoc($risk);
$totalRows_risk = mysql_num_rows($risk);

mysql_select_db($database_hospital, $hospital);
$query_Lrisk = sprintf("SELECT count(id) as count FROM triagent WHERE hosp=%s and Tdate>=%s and Tdate<=%s and risk='Low Risk'", GetSQLValueString($hosp1_risk, "text"),GetSQLValueString($Sdate_risk, "date"),GetSQLValueString($Edate_risk, "date"));
$Lrisk = mysql_query($query_Lrisk, $hospital) or die(mysql_error());
$row_Lrisk = mysql_fetch_assoc($Lrisk);
$totalRows_Lrisk = mysql_num_rows($Lrisk);

$ward_count = "-1";
if (isset($_GET['ward'])) {
  $ward_count = $_GET['ward'];
}
$Sdate_count = "-1";
if (isset($_GET['Sdate'])) {
  $Sdate_count = $_GET['Sdate'];
}
$Edate_count = "-1";
if (isset($_GET['Edate'])) {
  $Edate_count = $_GET['Edate'];
}
mysql_select_db($database_hospital, $hospital);
$query_count = sprintf("SELECT count(id) FROM triagent WHERE hid='".$hid."' and ward = %s and Tdate>=%s and Tdate<=%s", GetSQLValueString($ward_count, "text"),GetSQLValueString($ward_count, "text"),GetSQLValueString($Sdate_count, "date"),GetSQLValueString($Edate_count, "date"));
$count = mysql_query($query_count, $hospital) or die(mysql_error());
$row_count = mysql_fetch_assoc($count);
$totalRows_count = mysql_num_rows($count);




$HR=$row_risk['count'];
$LR=$row_Lrisk['count'];



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
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
<p align="center">แสดงผลการคัดกรองความเสี่ยงต่อภาวะทุพโภชนาเบื้องต้นแยกตามหน่วยงาน</p>
<p align="center"> โรงพยาบาล
  <label for="hosp"></label>
  <?php echo $_GET['hosp1']; ?></p>
<p>ตั้งแต่ 
  <label for="Sdate"></label>
  
  <input style="text-align:center" value="<?php echo $_GET['Sdate']; ?>" type="text" name="Sdate" id="Sdate" />
-
<label for="Edate"></label>
<input style="text-align:center" value="<?php echo $_GET['Edate']; ?>" type="text" name="Edate" id="Edate" />
</p>
<p>&nbsp;พบข้อมูลทั้งหมด =<?php echo $totalRows_triagent ?> records </p>

  <font color="#333399">
  <table align="center" cellpadding="1" cellspacing="1">

   <tr bgcolor="#DBDFE8">
     <td colspan="14">&nbsp;</td>
   </tr>
   <tr bgcolor="#F5F2FF">
     <td align="center" colspan="14"><table bordercolor="#FFFFFF" width="50%" border="1" align="center" cellpadding="0" cellspacing="0">
       <tr>
         <td><font color="#006666">Low risk</font></td>
         <td><font color="#CC0000">High risk</font></td>
       </tr>
       <tr>
         <td><font color="#006666"><?PHP echo $LR." (".number_format($LR*100/($HR+$LR),2,'.','')."%)";?></font></td>
         <td><font color="#CC0000"><?PHP echo $HR." (".number_format($HR*100/($HR+$LR),2,'.','')."%)";?></font></td>
       </tr>
     </table></td>
    </tr>
   <tr bgcolor="#DCE9FA">
    <td>ID</td>
    <td>HN</td>
    <td>hosp</td>
    <td>AN</td>
    <td>Ward</td>
    <td>BW</td>
    <td>Ht</td>
    <td>Diet</td>
    <td>Wtloss</td>
    <td>Critical</td>
    <td>BMI</td>
    <td>Score</td>
    <td>Risk</td>
    <td   >Reporter</td>
  </tr ></font>
  <?php do { ?>
    <tr <?PHP if($row_triagent['risk']=="High Risk"){ echo "bgcolor='#FEF0EF'";}else{ echo "bgcolor='#FDFDFD'";}?>>
      <td><?php echo $row_triagent['id']; ?></td>
      <td><?php echo $row_triagent['hn']; ?></td>
      <td><?php echo $row_triagent['hosp']; ?></td>
      <td><?php echo $row_triagent['AN']; ?></td>
      <td><?php echo $row_triagent['ward']; ?></td>
      <td><?php echo $row_triagent['bw']; ?></td>
      <td><?php echo $row_triagent['ht']; ?></td>
      <td><?php echo $row_triagent['diet']; ?></td>
      <td><?php echo $row_triagent['wtloss']; ?></td>
      <td><?php echo $row_triagent['critical']; ?></td>
      <td><?php echo $row_triagent['bmi']; ?></td>
      <td><?php echo $row_triagent['score']; ?></td>
      <td ><?php echo $row_triagent['risk']; ?></td>
      <td><?php echo $row_triagent['reporter']; ?></td>
    </tr>
    <?php } while ($row_triagent = mysql_fetch_assoc($triagent)); ?>
</table>

</body>
</html>
<?php
mysql_free_result($triagent);
mysql_free_result($risk);
mysql_free_result($Lrisk);

mysql_free_result($count);
mysql_query('SET NAMES UTF8');
?>