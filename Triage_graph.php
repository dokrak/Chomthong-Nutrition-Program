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
$query_triagent = sprintf("SELECT * FROM triagent WHERE hosp = %s and triagent.Tdate>=%s and triagent.Tdate<=%s", GetSQLValueString($hosp1_triagent, "text"),GetSQLValueString($Sdate_triagent, "date"),GetSQLValueString($Edate_triagent, "date"));
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

$HR=$row_risk['count'];
$LR=$row_Lrisk['count'];

echo($HR."#".$LR);
?>
<?php
mysql_free_result($triagent);

mysql_free_result($risk);
mysql_free_result($Lrisk);
mysql_query('SET NAMES UTF8');
?>
