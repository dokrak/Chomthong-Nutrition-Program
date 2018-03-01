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

$hosp1_naf = "-1";
if (isset($_GET['hosp1'])) {
  $hosp1_naf = $_GET['hosp1'];
}
$Sdate_naf = "-1";
if (isset($_GET['Sdate'])) {
  $Sdate_naf = $_GET['Sdate'];
}
$Edate_naf = "-1";
if (isset($_GET['Edate'])) {
  $Edate_naf = $_GET['Edate'];
}
mysql_select_db($database_hospital, $hospital);
$query_naf = sprintf("SELECT * FROM naf WHERE hosp = %s and screendate>=%s and screendate<=%s", GetSQLValueString($hosp1_naf, "text"),GetSQLValueString($Sdate_naf, "date"),GetSQLValueString($Edate_naf, "date"));
$naf = mysql_query($query_naf, $hospital) or die(mysql_error());
$row_naf = mysql_fetch_assoc($naf);
$totalRows_naf = mysql_num_rows($naf);$hosp1_naf = "-1";
if (isset($_GET['hosp1'])) {
  $hosp1_naf = $_GET['hosp1'];
}
$Sdate_naf = "-1";
if (isset($_GET['Sdate'])) {
  $Sdate_naf = $_GET['Sdate'];
}
$Edate_naf = "-1";
if (isset($_GET['Edate'])) {
  $Edate_naf = $_GET['Edate'];
}
mysql_select_db($database_hospital, $hospital);
$query_naf = sprintf("SELECT * FROM naf WHERE hosp = %s and screendate>=%s and screendate<=%s", GetSQLValueString($hosp1_naf, "text"),GetSQLValueString($Sdate_naf, "date"),GetSQLValueString($Edate_naf, "date"));
$naf = mysql_query($query_naf, $hospital) or die(mysql_error());
$row_naf = mysql_fetch_assoc($naf);
$totalRows_naf = mysql_num_rows($naf);

$hosp_severe = "-1";
if (isset($_GET['hosp1'])) {
  $hosp_severe = $_GET['hosp1'];
}
mysql_select_db($database_hospital, $hospital);
$query_severe = sprintf("SELECT  count(screenid) as count FROM naf WHERE hosp=%s and score>=15 and screendate>='".$Sdate_naf."'and screendate<='".$Edate_naf."'", GetSQLValueString($hosp_severe, "text"));
$severe = mysql_query($query_severe, $hospital) or die(mysql_error());
$row_severe = mysql_fetch_assoc($severe);
$nafC=$row_severe['count'];
$totalRows_severe = mysql_num_rows($severe);

$hosp1_moderate = "-1";
if (isset($_GET['hosp1'])) {
  $hosp1_moderate = $_GET['hosp1'];
}
mysql_select_db($database_hospital, $hospital);
$query_moderate = sprintf("SELECT  count(screenid) as count FROM naf  WHERE hosp = %s and score>=6 and score<=14 and screendate>='".$Sdate_naf."'and screendate<='".$Edate_naf."'", GetSQLValueString($hosp1_moderate, "text"));
$moderate = mysql_query($query_moderate, $hospital) or die(mysql_error());
$row_moderate = mysql_fetch_assoc($moderate);
$nafB=$row_moderate['count'];
$totalRows_moderate = mysql_num_rows($moderate);

$hosp1_normal = "-1";
if (isset($_GET['hosp1'])) {
  $hosp1_normal = $_GET['hosp1'];
}
mysql_select_db($database_hospital, $hospital);
$query_normal = sprintf("SELECT count(screenid) as count FROM naf WHERE hosp = %s and score<=5 and score>=0 and screendate>='".$Sdate_naf."'and screendate<='".$Edate_naf."'", GetSQLValueString($hosp1_normal, "text"));
$normal = mysql_query($query_normal, $hospital) or die(mysql_error());
$row_normal = mysql_fetch_assoc($normal);
$nafA=$row_normal['count'];
$totalRows_normal = mysql_num_rows($normal);
 
echo($nafA."#".$nafB."#".$nafC);
?>
<?php
mysql_free_result($naf);

mysql_free_result($severe);

mysql_free_result($moderate);

mysql_free_result($normal);
mysql_query('SET NAMES UTF8');
?>
