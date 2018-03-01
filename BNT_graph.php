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
$query_bnt = sprintf("SELECT * FROM nt2013 WHERE hosp = %s and nt2013.screendate>=%s and nt2013.screendate<=%s", GetSQLValueString($hosp1_bnt, "text"),GetSQLValueString($Sdate_bnt, "date"),GetSQLValueString($Edate_bnt, "date"));
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
$nt4=$row_severe['count'];
$totalRows_severe = mysql_num_rows($severe);

$hosp1_moderate = "-1";
if (isset($_GET['hosp1'])) {
  $hosp1_moderate = $_GET['hosp1'];
}
mysql_select_db($database_hospital, $hospital);
$query_moderate = sprintf("SELECT  count(screenid) as count FROM nt2013  WHERE hosp = %s and score>=8 and score<=10 and screendate>='".$Sdate_bnt."'and screendate<='".$Edate_bnt."'", GetSQLValueString($hosp1_moderate, "text"));
$moderate = mysql_query($query_moderate, $hospital) or die(mysql_error());
$row_moderate = mysql_fetch_assoc($moderate);
$nt3=$row_moderate['count'];
$totalRows_moderate = mysql_num_rows($moderate);

$hosp1_mild = "-1";
if (isset($_GET['hosp1'])) {
  $hosp1_mild = $_GET['hosp1'];
}
mysql_select_db($database_hospital, $hospital);
$query_mild = sprintf("SELECT count(screenid) as count FROM nt2013 WHERE hosp=%s and score>=5 and score<=7 and screendate>='".$Sdate_bnt."'and screendate<='".$Edate_bnt."'", GetSQLValueString($hosp1_mild, "int"));
$mild = mysql_query($query_mild, $hospital) or die(mysql_error());
$row_mild = mysql_fetch_assoc($mild);
$nt2=$row_mild['count'];
$totalRows_mild = mysql_num_rows($mild);

$hosp1_normal = "-1";
if (isset($_GET['hosp1'])) {
  $hosp1_normal = $_GET['hosp1'];
}
mysql_select_db($database_hospital, $hospital);
$query_normal = sprintf("SELECT count(screenid) as count FROM nt2013 WHERE hosp = %s and score<=4 and score>=0 and screendate>='".$Sdate_bnt."'and screendate<='".$Edate_bnt."'", GetSQLValueString($hosp1_normal, "text"));
$normal = mysql_query($query_normal, $hospital) or die(mysql_error());
$row_normal = mysql_fetch_assoc($normal);
$nt1=$row_normal['count'];
$totalRows_normal = mysql_num_rows($normal);
 
echo($nt1."#".$nt2."#".$nt2."#".$nt4);
?>


<?php
mysql_free_result($bnt);

mysql_free_result($severe);

mysql_free_result($moderate);

mysql_free_result($mild);

mysql_free_result($normal);
?>