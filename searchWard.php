
<?php require_once('Connections/hospital.php'); ?>
<?php require_once('Connections/hospital.php'); ?>
<?php 
include 'common.php';

if(!is_usr())
{
header("location:index.php");
}

$reporter = u::is("Fname")?u::get()." ":"";
$reporter .= u::is("Lname")?u::get():"";

$reporter = trim($reporter);

if (u::is("hid"))
    $hid = u::get();

$hp = db::select(array("tbl" => "hospital", "where" => "hid='" .$hid. "'"));	
$hosname=db::arr($hp);







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

$colname_hosp = "-1";
if (isset($_GET['hid'])) {
  $colname_hosp = $_GET['hid'];
}
mysql_select_db($database_hospital, $hospital);
$query_hosp = sprintf("SELECT * FROM hospital WHERE hid ='".$hid."'");
$hosp = mysql_query($query_hosp, $hospital) or die(mysql_error());
$row_hosp = mysql_fetch_assoc($hosp);

mysql_select_db($database_hospital, $hospital);
$list=sprintf("select * from hospital");
$HList=mysql_query($list,$hospital) or die("can not connect hospital");
$Hname=mysql_fetch_assoc($HList);
?>
<?php
$hosp_ward = "-1";
if (isset($_GET['hosp'])) {
  $hosp_ward = $_GET['hosp'];
}
mysql_select_db($database_hospital, $hospital);
$query_ward = sprintf("SELECT distinct(ward) FROM triagent WHERE %s =%s ", GetSQLValueString($hosp_ward, "text"),GetSQLValueString($hosp_ward, "text"));
$ward = mysql_query($query_ward, $hospital) or die(mysql_error());
$row_ward = mysql_fetch_assoc($ward);
$totalRows_ward = mysql_num_rows($ward);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Search Data</title>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="jquery.ui-1.5.2/jquery-1.2.6.js" type="text/javascript"></script>
<script src="jquery.ui-1.5.2/ui/ui.datepicker.js" type="text/javascript"></script>

<link href="jquery.ui-1.5.2/themes/ui.datepicker.css" rel="stylesheet" type="text/css" />


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="searchWard.js" type="text/javascript"></script>
</head>

<body>
<table width="850" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <th bgcolor="#FBFBFB"   scope="col"><p><a href="http://chomthonghospital.go.th/cth2015/"><img src="<?PHP $logo="img/".$hid.".jpg"; echo $logo; ?>" alt="" width="75" height="95"class="img-rounded" /></a>
      <input  style="border:none; background-color:#D3E3F3; text-align:center" maxlength="9" name="hid" type="hidden" id="hid" value="<?PHP echo $hid; ?>" size="20" />
      </p></th>
  </tr>
  <tr>
    <th  bgcolor="#FF9933" scope="col"><font size="+1"    color="#333399" style="background-color: #FC6">&nbsp;&nbsp;&nbsp;ค้นข้อมูลการประเมินภาวะทุพโภชนาการ  โรงพยาบาล
        <input readonly="readonly" style="border:none; background-color:#D3E3F3; text-align:center" maxlength="9" name="hosp" type="text" id="hosp" value="<?php echo $row_hosp['hosName'];?>" size="20" />
      &nbsp;&nbsp;&nbsp;&nbsp;</font></th>
  </tr>
  <tr>
    <th bgcolor="#E2D9EE" scope="col"><form id="form2" name="form2" method="get" action="BNT2013_view.php?hosp=$_GET['hosp1']&amp;Sdate=$_GET['jQueryUICalendar1']&amp;Edate=$_GET['jQueryUICalendar2']">
      <p>
        <label for="hosp1">Ward </label>
        <label for="hosp1"></label>
        <label for="ward"></label>
        <label for="ward"></label>
        <select name="ward" id="ward">
          <?php
do {  
?>
          <option value="<?php echo $row_ward['ward']?>"><?php echo $row_ward['ward']?></option>
          <?php
} while ($row_ward = mysql_fetch_assoc($ward));
  $rows = mysql_num_rows($ward);
  if($rows > 0) {
      mysql_data_seek($ward, 0);
	  $row_ward = mysql_fetch_assoc($ward);
  }
?>
        </select>
        <label for="sdate">ตั้งแต่วันที่</label>
        <input type="text" size="15" name="Sdate"value="Click to show datepicker" id="jQueryUICalendar3"/>-
        <input type="text" size="15" name="Edate"value="Click to show datepicker" id="jQueryUICalendar4"/>
      </p>
      <script type="text/javascript">
// BeginWebWidget jQuery_UI_Calendar: jQueryUICalendar3
jQuery("#jQueryUICalendar3").datepicker({dateFormat:('yy-mm-dd')});

// EndWebWidget jQuery_UI_Calendar: jQueryUICalendar3
     
// BeginWebWidget jQuery_UI_Calendar: jQueryUICalendar3
jQuery("#jQueryUICalendar4").datepicker({dateFormat:('yy-mm-dd')});

// EndWebWidget jQuery_UI_Calendar: jQueryUICalendar3
      </script>
      <p>
        <input  onclick="TriageWard($('#hid').val(),$('#ward').val(), $('#jQueryUICalendar3').val(), $('#jQueryUICalendar4').val())" type="button" name="triage" id="triage" value="Triage" />
        -
      
        <input onclick="BntSearch($('#hosp1').val(), $('#jQueryUICalendar3').val(), $('#jQueryUICalendar4').val())" type="button" name="show" id="show" value="BNT-2013" />
        -
        <input onclick="NafSearch($('#hosp1').val(), $('#jQueryUICalendar3').val(), $('#jQueryUICalendar4').val())" type="button" name="naf" id="naf" value="NAF" />
      </p>
    </form></th>
  </tr>
  <tr bordercolor="#CCCCCC">
    <th   scope="col"><div style="background-color:#F7F6FA" id="ShowGraph"></div></th>
  </tr>
  <tr bordercolor="#CCCCCC">
    <th   scope="col"><div style="background-color: #EEE" id="showBnt"></div></th>
  </tr>
  <tr bordercolor="#CCCCCC">
    <th   scope="col"><font size="-2" color="#336633"><strong><em>Copyright @ 2017 EKKAWIT ALL RIGHTS RESERVED</em></strong></font></th>
  </tr>
</table>

</body>
</html>
<?php
mysql_free_result($ward);

mysql_free_result($hosp);

mysql_query('SET NAMES UTF8');
?>
