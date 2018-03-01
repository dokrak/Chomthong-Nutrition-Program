<?php
include 'common.php';

if(!is_usr())
{
header("location:index.php");
}
$totalRows_patient = patient_wrapper::total();

if(u::is("hid"))
{
    $hid = u::get();
    
    $res = db::select(array("tbl"=>"hospital","where"=>"hid='".$hid."'"));
       
    $hospital = db::arr($res);
}

/*
function confrm(){
	$hn=$_POST["HN1"];
  	$message = "บันทึกข้อมูลผู้ป่วยใหม่สำเร็จแล้ว เข้าสู่การคัดกรองเบื้องต้น?";
  	$confrm="<script type='text/javascript'>if(confirm('$message')==true){window.location.href='triagent.php?HN='+'$hn';
	}else{window.location.href='screening.php';}
	</script>";
  	echo($confrm);
	}
	*/

$colname_patient = "-1";
if (isset($_POST['HN'])) {
  $colname_patient = $_POST['HN'];
  
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
	if($_POST['sex_0'].checked){echo("male");}else{echo"female";}	
  $insertSQL = sprintf("INSERT INTO TbPatient ( HN, hosp,Fname, Lname, age, sex, address) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                      
                       GetSQLValueString($_POST['HN1'], "text"),
					   GetSQLValueString($_POST['hosp'], "text"),
                       GetSQLValueString($_POST['Fname'], "text"),
                       GetSQLValueString($_POST['Lname'], "text"),
                       GetSQLValueString($_POST['age'], "int"),
                       GetSQLValueString($_POST['sex'], "text"),
                       GetSQLValueString($_POST['address'], "text"));

  mysql_select_db($database_nutrition, $nutrition);
  $Result1 = mysql_query($insertSQL, $nutrition) or die(mysql_error());

  confrm();

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script src="jquery-3.2.1.min.js"></script>

<script type="text/javascript" src="new_ptnt.js"></script>

<title>register</title>

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
    <th width="54%" bgcolor="#B4ED78" scope="col"><span style="text-shadow:#C33; background-color: #D8F2B8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;บันทึกข้อมูลผู้ป่วยใหม่&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></th>
    <th width="22%"  scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td height="218" colspan="3"><form>
        <table  align="center">
          <tr valign="baseline">
            <td bgcolor="#B4ED78" nowrap="nowrap" align="right">HN:</td>
            <td bgcolor="#B4ED78"><input name="HN1" type="text" id="HN1" onblur="chkhn()" size="32" maxlength="13" /></td>
          </tr>
          <tr valign="baseline">
            <td bgcolor="#B4ED78" nowrap="nowrap" align="right">รพ.</td>
            <td bgcolor="#B4ED78"><label for="hosp"></label>
                <input readonly id="hosp" value ="<?php echo is_array($hospital)?$hospital["hosName"]:""?>"/>
                
</td>
          </tr>
          <tr valign="baseline">
            <td bgcolor="#B4ED78" nowrap="nowrap" align="right">ชื่อ:</td>
            <td bgcolor="#B4ED78"><input type="text" name="Fname" value="" size="32"  /></td>
          </tr>
          <tr valign="baseline">
            <td bgcolor="#B4ED78" nowrap="nowrap" align="right">นามสกุล:</td>
            <td bgcolor="#B4ED78"><input type="text" name="Lname" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td bgcolor="#B4ED78" nowrap="nowrap" align="right">อายุ:</td>
            <td bgcolor="#B4ED78"><input maxlength="3" type="text" name="age" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td bgcolor="#B4ED78" nowrap="nowrap" align="right">เพศ:</td>
            <td bgcolor="#B4ED78"><table width="200">
                <tr>
                    <td><label for="sex"></label>
                      <select name="sex" id="sex">
                        <option value="male">ชาย</option>
                        <option value="female">หญิง</option>
                  </select></td>
                  </tr>
                  
                </table></td>
          </tr>
          <tr valign="baseline">
            <td bgcolor="#B4ED78" nowrap="nowrap" align="right">ที่อยู่:</td>
            <td bgcolor="#B4ED78"><input type="text" name="address" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td bgcolor="#B4ED78" colspan="2" align="right" nowrap="nowrap"><div align="center">
              <input  type="submit" value="Insert record" />
             <a href="screening.php"> <input  name="cancel"  type="button" id="cancel" value="Cancel" /></a>
            </div></td>
          </tr>
        </table>
    </form></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center" bgcolor=#B4ED7"><a class="link" href="/hospital/screening.php">Back to home</a></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center" bgcolor=#B4ED7"><font size="-2" color="#336633"><strong><em>Copyright @ 2017 EKKAWIT ALL RIGHTS RESERVED</em></strong></font></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>

