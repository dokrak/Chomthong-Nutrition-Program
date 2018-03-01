<?php 

include 'common.php';
if(!is_usr())
{
header("location:index.php");
}
if (!isset($_GET['HN'])) {
  header("location:index.php");
}
$HN = $_GET['HN'];

$res = db::query("SELECT p.Fname,p.Lname,p.age,p.sex,p.address,p.hid,t.* FROM triagent as t inner join TbPatient as p on t.hn=p.hn WHERE t.HN='".$HN."' order by t.id desc");
 
$row_triagent1 = db::arr($res);
$Phn=$row_triagent1['hn'];

if (!isset($_GET['case'])) {
  header("location:index.php");
}

echo "<script>var risk = '".$_GET['case']."';</script>";

       
/*
$colname_triagent2 = "-1";
if (isset($_GET['id'])) {
  $colname_triagent2 = $_GET['id'];
}
mysql_select_db($database_nutrition, $nutrition);
$query_triagent2 = sprintf("SELECT * FROM triagent WHERE id = %s", GetSQLValueString($colname_triagent2, "int"));
$triagent2 = mysql_query($query_triagent2, $nutrition) or die(mysql_error());
$row_triagent2 = mysql_fetch_assoc($triagent2);
$totalRows_triagent2 = mysql_num_rows($triagent2);
*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="jquery-3.2.1.min.js"></script>

<script type="text/javascript" src="reportTriagent.js"></script>
<title>Untitled Document</title>
<script>

</script>
</head >

<body onload="prnt()">
<form  id="form1" name="form1" method="get" action=""><table width="800" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <th colspan="4" scope="col"><a href="http://chomthonghospital.go.th/cth2015/"><img src="/nutrition/file/picture/logo1.jpg" alt="" width="68" height="72" longdesc="/nutrition/file/picture/logo1.jpg" /></a></th>
  </tr>
  <tr>
    <th colspan="4" scope="col"><p align="center"><b><font size="+1">การคัดกรองความเสี่ยงของภาวะทุพโภชนาการ</font></b> <b><font size="+1">เบื้องต้น</font></b> (Initial Triage)</p>
      <p align="center"><font size="+1">รพ.
          <input  style="border:none; text-align:left; text-emphasis" name="hosp" type="hidden" id="hosp" value="<?php echo $row_triagent1['hosp']; ?>" size="25" />
      <?php echo $row_triagent1['hosp']; ?></p></th>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><div align="center">เลขที่ Triage : 
      <label for="id"></label>
      <input style="border:none; text-align:center" name="id" type="text" id="id" value="<?php echo $row_triagent1['id']; ?>" size="10" />
      &nbsp;&nbsp;วันที่ :
  <input style="border:none; text-align:center" name="Tdate" type="text" id="Tdate" value="<?php echo $row_triagent1['Tdate']; ?>" size="15" />
      &nbsp;&nbsp;Warrd :
      <?php echo $row_triagent1['ward']; ?></div>
      <label for="Tdate"></label>
      <div align="center"></div></td>
    </tr>
  <tr>
    <td width="1%">&nbsp;</td>
    <td colspan="3"><div align="left"><dd>ชื่อ-นามสกุล:
      <input style="background-color:#CDEEFE;text-align:center; border:none"   name="fname" type="text" id="fname"  value="<?php echo $row_triagent1['Fname'].' '.$row_triagent1['Lname']; ?>" size="20" />
      HN :
      <input style="border:none; text-align:left;background-color:#FFD8F7" name="HN" id="HN" type="text" value="<?php echo $row_triagent1['hn']; ?>" size="15" />
      AN:
      <input style="border:none; text-align:left;background-color:#FFD8F7" name="AN" id="AN" type="text" value="<?php echo $row_triagent1['AN']; ?>" size="15" />
    </div></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><dd>Age :
      <input style="border:none; text-align:left;background-color:#CDEEFE" name="age" type="text" id="age" value="<?php echo $row_triagent1['age']; ?>" size="5" />
      Sex:
  <input style="border:none; text-align:left;background-color:#CDEEFE" name="sex" type="text" id="sex4" value="<?php echo $row_triagent1['sex']; ?>" size="10" />
      Address :
      <?php echo $row_triagent1['address']; ?></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><dd>BW :
      <input style="text-align:center;background-color:#FFC" name="bw" type='text' id='input1' onkeyup='nStr()' value="<?php echo $row_triagent1['bw']; ?>" size="10" />
      Kg.&nbsp;&nbsp;&nbsp;Ht :
  <input style="text-align:center;background-color: #FFC" name="ht" type='text' id='input2' onkeyup='nStr()' value="<?php echo $row_triagent1['ht']; ?>" size="10" />
      cm.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BMI=<input style=" text-align:center;background-color:#FFC " value="<?php echo $row_triagent1['bmi']; ?>" size="10"/></td>
    </tr>
  <tr>
    <td><div align="center"></div></td>
    <td colspan="2"><dd>ผู้ป่วยมีภาวะต่อไปนี้หรือไม่</td>
    <td width="19%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="9%"><dd></td>
    <td width="71%"><dd>1.)ผู้ป่วยกินได้น้อยลง?</td>
    <td><?php echo $row_triagent1['diet']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><dd>2.)ผู้ป่วยมีภาวะน้ำหนักตัวลดลงหรือไม่ </dd></td>
    <td><?php  echo $row_triagent1['wtloss']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>  <blockquote>3.)ผู้ป่วยมีภาวะวิกฤติ หรือกึ่งวิกฤติหรือไม่</blockquote></td>
    <td><?php echo $row_triagent1['critical']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><dd>4.) ผู้ป่วยมี BMI &lt;= 18.5 หรือ BMI &gt;= 25 ใช่หรือไม่?</dd></td>
    <td><?php 
		if(!isset($b)){$b=$row_triagent1['bmi'];}
		
		
			if($b>18.5&&$b<25){
				echo('ไมใช่ ');
			}else if($b<=18.5||$b>=25){
				echo('ใช่ ');
			}else if($b==""){
				echo('');
			}
			
				
	?></td>
  </tr>
  <tr>
    <td><div align="center"></div></td>
    <td colspan="2"><dd>คะแนน=<?php  echo $row_triagent1['score']; ?> &nbsp;สรุป ผู้ป่วยรายนี้ : <font size="+1" style="background-color:#FF9"  id="show1" color="">&nbsp;</font><?php   echo $row_triagent1['risk']; ?>&nbsp;ต่อการเกิดภาวะทุพโชนาการ </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"><div align="center">คำแนะนำ : 
      <input style="border:none; text-align:left; background:#F0F0F0" value="<?PHP $row_triagent1['score']=0; if($row_triagent1['score']>=2){echo('ควรทำการประเมินอย่างละเอียดด้วย BNT / NT2013 ต่อไป');}else{echo('ควรทำการ Triage : ซ้ำทุก 7 วัน');} ?>"  name="rec" type="text" id="rec" size="50" />
    </div></td>
  </tr>
  <tr>
    <td colspan="4"><div align="center">ผู้คัดกรอง
        <input style="text-align:center" name="reporter" type="text" id="reporter" size="30" value="<?php echo $row_triagent1['reporter']; ?>" />
    </div>
      <label for="reporter"></label>
      <div align="center"></div></td>
    </tr>
  <tr>
    <td colspan="4"><div align="center">
     
      
      <p><br />
        <a href="/hospital/chose.php">
         ทำ  Assessment ต่อ
          </a>
          &nbsp;&nbsp;<button name="print" id="print" value="Print" />print</button><br />
        <a href="/hospital/screening.php">Back to home </a></p>
      <p><font size="-2" color="#336633"><strong><em>Copyright @ 2017 EKKAWIT ALL RIGHTS RESERVED</em></strong></font></p>
    </div></td>
    </tr>
</table> 
</form>

</body>
</html>
 