<?php 

include_once("common.php");
if(!is_usr())
{
header("location:index.php");
}
if (u::is("hid"))
    $hid = u::get();

if(session::is('hn'))
$HN = session::get();
else
header("location:screening.php");

$row_patient = patient_wrapper::load_by_hn($HN);

if(session::is('adv'))
$adv = session::get();
else
header("location:screening.php");

$query = sprintf("SELECT * FROM ".$adv." WHERE HN = %s order by screenNo DESC limit 1", GetSQLValueString($HN, "text"));

$res = db::query($query);
$row = db::arr($res);
$total = db::num($res);
   	if($total==""||$total==0){echo("<script>");
	echo("alert('ไม่พบข้อมูลการคัดกรองตามเลข Screen ID ที่ระบุ');");
	echo("window.location.href='/hospital/screening.php';");
	echo("</script>");
	}
        else
        {
            echo("<script>");
            echo("var HN='$row[HN]';");
            //echo("var Fn=$row_NT2013[Fname];");
            //echo("alert('ชื่อ :'+Fn);");
            //echo("var cnfrm='confirm('ใช่?');'");
            //echo("alert('ตรวจสอบ HN ผู้ป่วย ='+ HN);");
            echo("if(confirm('กรุณาตรวจสอบ: HN ผู้ป่วย ='+ HN+'?')==false){window.location.href='/hospital/screening.php';};");
            echo("</script>");
        }
		
 $query_pn = "SELECT * FROM pn";
$pn = db::query($query_pn);
$row_pn = db::arrs($pn);

$totalRows_pn = db::num($pn);

 $query_en = "SELECT * FROM en";
$en = db::query($query_en);
$row_en = db::arrs($en);
$totalRows_en = db::num($en);




$colname_treatNT = "-1";
if (isset($row['HN'])) {
  $colname_treatNT = $row['HN'];
}
$query_treatNT = sprintf("SELECT * FROM treatnt WHERE HN = %s ORDER BY treat_No desc", GetSQLValueString($colname_treatNT, "text"));
$treatNT = db::query($query_treatNT);

$row_treatNT = db::arr($treatNT);

$totalRows_treatNT = db::num($treatNT);
$treat_No = $totalRows_treatNT;

//echo "treatNo=".($treat_No+1);
	if($totalRows_treatNT==""||$totalRows_treatNT==0)
	{echo("<script>");
	echo("alert('ยังไม่เคยให้การรักษาผู้ป่วยรายนี้');");
	
	echo("</script>");}else{echo("<script>");
					  echo("alert('ผู้ป่วยรายนี้ เคยบันทึกให้การรักษาไป $treat_No ครั้ง ');");
					  echo("</script>");}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Treatment Calculation</title>

<script src="jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="treat_calNT.js"></script>
</head>

<body>
<div  id=txt>
<form id="form1" name="form1" method="POST" action="#">
<table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th bgcolor="#D7DFFB" colspan="5" scope="col"><a href="http://chomthonghospital.go.th/cth2015/"><img src="<?PHP $logo="img/".$hid.".jpg"; echo $logo; ?>" alt="" width="75" height="95"class="img-rounded" /></a></th>
  </tr>
  <tr>
    <th bgcolor="#D7DFFB" colspan="5" scope="col"><p>แบบฟอร์มคำนวณทางโภชนบำบัด  รพ.จอมทอง</p>
      <p>ใช้งานใน รพ. : 
        
        <input style="text-align:center" name="hosp" type="text" id="hosp"  value="<?php echo $row['hosp']; ?>" size="30" />
      </p></th>
  </tr>
  <tr>
    <td colspan="5"><div align="center"><font size="-1">Assessment</font><font size="-1"> ID :
          <input style="text-align:center; background-color:#FFC" name="screen_id" type="text" id="screen_id" value="<?php echo $row['screenid']; ?>" size="10" />
    </font></div></td>
  </tr>
  <tr>
    <td colspan="5"><font size="-1">คำนวนจาก : &nbsp;การประเมินด้วย&nbsp; <?PHP if(strstr($row['level'],"NAF")){ echo "NAF";} else {echo "BNT-2013";}?>&nbsp;ครั้งที่ : <?php echo $row['screenNo']; ?>&nbsp;      &nbsp;
      
      &nbsp;เมื่อวันที่  : <?php echo $row['screendate']; ?>&nbsp;</font></td>
  </tr>
  <tr>
    <td colspan="5"><div align="left">
      <dd><font size="-1">Name : <?php echo $row['Fname']; ?> <font size="-1">
        <input name="Fname" type="hidden" id="Fname" value="<?php echo $row['Fname']; ?>" size="2" />
      </font>&nbsp;&nbsp;<?php echo $row['Lname']; ?>&nbsp;<font size="-1">
      <input name="Lname" type="hidden" id="Lname" value="<?php echo $row['Lname']; ?>" size="2" />
      </font>&nbsp;&nbsp;&nbsp;HN:
            <input name="HN" type="text" id="HN" value="<?php echo $row['HN']; ?>" size="10" />
          AN: 
          <input name="AN" type="text" id="AN"  value="<?php echo $row['AN']; ?>" size="15" />
          อายุ : <?php echo $row['age']; ?><font size="-1">
          <input name="age" type="hidden" id="age" value="<?php echo $row['age']; ?>" size="2" />
          </font>&nbsp;&nbsp;เพศ : <?php echo $row['sex']; ?> <font size="-1">
          <input name="sex" type="hidden" id="sex" value="<?php echo  $row['sex']; ?>" size="2" />
          </font>&nbsp;&nbsp;&nbsp;<BR />
          &nbsp;Actual BW :<?php echo $row['bw']; ?> &nbsp;&nbsp;Ideal BW :<?php echo $row['IBW']; ?>&nbsp;&nbsp;BMI:<?php echo $row['bmi1']; ?>&nbsp;&nbsp; </font></dd>
    </div>
      
      <div align="left"></div></td>
  </tr>
  <tr>
    <td colspan="5"><dd><font size="-1">ECOG score : <?php echo $row['ecog']; ?></font>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5"><div align="left">
      <dd><font size="-1">Principle Diagnosis :</font><font size="-1" id="show7" color="">
        <input name="diag" type='text' id='diag'   style="text-align:left; background-color: #E8F6C9; text-indent:inherit " value="<?php echo $row['diag']; ?>"  size="80" />
      </font></dd>
    </div></td>
  </tr>
  <tr>
    <td height="20" colspan="5"><div align="center"><font size="-1"> 
	<?php if(strstr($row['level'],"NAF")){ echo "NAF score =";} else {echo "BNT score=";} ?><font id="show10" color="">
    <input  name="score1" type='text' id='score1' style="text-align:center; background-color:#CCF; text-shadow:#F33; size:auto; text-size:max-size"  " value="<?php echo $row['score']; ?>"  size="5"  readonly="readonly" />
 </font> <br> แปลผล :&nbsp;<font style="border-color:#F30; background-color: " id="result2" size="+1" color="#3333FF">&nbsp;&nbsp;</font>&nbsp;<font color="">
<input name="level" type='text' id='result3' style="text-align:center; background-color:#CF9" value="<?php echo $row['level']; ?>"  size="40" readonly="readonly" />
</font> <font color="">
<input name="result1" type='text' id='result1' style="text-align:center; background-color:#CF9" value="<?php if(array_key_exists('result1',$row))echo $row['result1']; ?>"  size="20" readonly="readonly" />
</font><font color=""><br />
</font></font></div></td>
  </tr>
  <tr>
    <td height="20" colspan="5">&nbsp;</td>
    </tr>
  <tr>
    <td><p></p></td>
    <td  bgcolor="#E1DBEC" height="20" colspan="3"><div align="center">Target Requirement</div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="22%">
      <font color="">
      <label for="CAL"></label>
      <div align="center"><font size="-1">Calory Requirement 
        (kcal/d)</font><br /><input name="cal_req" type='text' id='cal_req' style="text-align:center; background-color: #E6E6E6 " value="<?php echo $row['cal_req']; ?>"  size="10" readonly="readonly" />
      </div>
      </font>
    <div align="center"></div>      <div align="left"></div></td>
    <td height="20"><div align="center"><font size="-1" color="">Volume requirement 
      (ml/d)<br /><input value="<?php echo $row['vol_req']; ?>" readonly="readonly" style="text-align:center; background-color: #E6E6E6 " name="vol_req" type='text' id='vol_req'  size="10" />
      </font><font size="-1"><font size="-1">
     
      </font></font></div>
    <div align="left"></div></td>
    <td width="20%" height="20"><div align="center"><font size="-1" color="">
      </font><font size="-1">Protein requirement</font> <font size="-1" color="">
        (gm/d)<br /><input name="prot_req" type='text' id='prot_req' style="text-align:center; background-color: #E6E6E6" value="<?php echo $row['prot_req']; ?>"  size="10" readonly="readonly" />
      </font></div>
    <div align="left"></div></td>
    <td width="19%"><div align="center"><font size="-1">Fat requirement</font><font size="-1" color="">
      (gm/d)<br /><input value="<?php echo $row['fat_req']; ?>" readonly="readonly" style="text-align:center; background-color: #E6E6E6" name="fat_req" type='text' id='fat_req'  size="10" />
    </font></div></td>
    <td width="19%"><div align="center"><font size="-1">NPC:N ที่ควรได้</font><font size="-1" color="">
      <br /><input value="<?php echo $row['npc']; ?>" readonly="readonly" style="text-align:center; background-color: #E6E6E6" name="npc" type='text' id='npc'  size="10" />
    </font></div></td>
  </tr>
  <tr>
    <td colspan="5"> 
      <table width="103%" border="0" align="center" cellpadding="2" cellspacing="2">
        <tr bgcolor="#EDEDED">
          <td bgcolor="#CCCCCC" colspan="4" scope="col"><div align="center">การรักษาที่ให้ ครั้งที่ 
            <input style="text-align:center; background-color:#FC9" name="treat_No" type="text" id="treat_no" value="<?php ECHO $treat_No+1; ?>" size="5" />
          Date : 
            <input name="Tdate" type="text" id="Tdate" placeholder="yyyy-mm-dd" value="<?php $today=date('Y-m-d');echo $today;?>" size="15" />
            <br />
          </div></td>
          </tr>
        <tr bgcolor="#EDEDED">
          <td width="57%" scope="col"><div align="left">
            <p align="center">Nutrition support ที่ให้</p>
          </div></td>
          <td align="center" colspan="3"  scope="col">  สารอาหารและพลังงานที่ได้รับ</td>
          </tr>
        <tr bgcolor="#EDEDED">
          <td valign="middle" width="57%" scope="col"><img src="/nutrition/file/picture/Green-Apple.jpg" width="15" height="15" align="middle" /> Enteral Nutrition :
            <label for="er"></label>
            <label for="pr1"></label>
            <select onchange="en()" name="en1" id="en1">
              <?php
do {  
    $c = current($row_en);
?>
              <option value="<?php echo $c['id']?>"><?php echo $c['nameE']?></option>
              <?php
} while (next($row_en));
  
?>
            </select>
<BR /> &nbsp;&nbsp;&nbsp;&nbsp;
ความเข้มข้น :
<label for="conc"></label>
<select onchange="con()" name="conc" id="conc">
  <option value="1">1 : 1</option>
  <option value="0.5">0.5 : 1</option>
  <option value="1.5">1.5 : 1</option>
  <option value="2">2 : 1</option>
</select>
ปริมาณ :
<input style="text-align:center" name="er" type="text" id="er"  value="0" size="5" />
(ml/d)  +น้ำ 
<input style="text-align:center" name="water" type="text" id="water" value="0" size="5" />
ml/d</td>
          <td width="9%" align="right" scope="col">Total Cal =</td>
          <td width="13%" align="right" scope="col"><div align="left">
            <input style="text-align:center" name="tcal" type="text" id="tcal" size="7" />
           <font size="-1"> (Kcal/d)</font></div></td>
          <td width="21%" align="left" scope="col"> =
            <input style="text-align:center" name="tcal2" type="text" id="tcal2" size="7" />
% <font size="-1">of Target</font></td>
        </tr>
        <tr bgcolor="#EDEDED">
          <td width="57%" scope="col"> &nbsp;&nbsp;&nbsp;&nbsp;Other Enteral feeding :
            <input name="en2" type="text" id="en2" size="40" /></td>
          <td align="right" scope="col">Protein =</td>
          <td align="right" scope="col"><div align="left">
            <input style="text-align:center" name="tprot" type="text" id="tprot" size="7" />
            <font size="-1">(g/d)</font></div>            <div align="center"></div></td>
          <td align="left" scope="col">=
            <input style="text-align:center" name="tprot2" type="text" id="tprot2" size="7" />
% <font size="-1">of Target</font></td>
          </tr>
        <tr bgcolor="#EDEDED">
          <td width="57%" scope="col"><img src="/nutrition/file/picture/Green-Apple.jpg" width="15" height="15" align="middle" />Parenteral Nutrition 1 :
            <label for="pn4"></label>
            <select onchange="p_1()" name="pn1" id="pn1">
              <option value="-">-</option>
              <?php
do {  
    $c = current($row_pn);
   
?>
              <option value="<?php echo $c['id'];?>"><?php echo $c['nameP'];?></option>
              <?php
} while (next($row_pn));
  
?>
            </select>
Rate :
<input onfocus="fopr_1()" name="pr1" type="text" id="pr1"  value="0" size="5" />
(ml/hr) </td>
          <td align="right" scope="col">Fat =</td>
          <td align="right" scope="col"><div align="left">
            <input style="text-align:center" name="tfat" type="text" id="tfat" size="7" />
            <font size="-1">(g/d)</font> </div></td>
          <td align="left" scope="col">=
            <input style="text-align:center" name="tfat2" type="text" id="tfat2" size="7" />
% <font size="-1">of Target</font></td>
          </tr>
        <tr bgcolor="#EDEDED">
          <td width="57%" scope="col"><img src="/nutrition/file/picture/Green-Apple.jpg" width="15" height="15" align="middle" />Parenteral Nutrition 2 :
            <select onchange="p_2()" name="pn2" id="pn2">
              <option value="-">-</option>
              <?php
              
              reset($row_pn);
do {  
    $c = current($row_pn);
?>
              <option value="<?php echo $c['id']?>"><?php echo $c['nameP']?></option>
              <?php
} while (next($row_pn));
  
?>
            </select>
Rate :
<input onfocus="fopr_2()" name="pr2" type="text" id="pr2" value="0" size="5" />
(ml/hr) </td>
          <td align="right" scope="col">NPC : N =</td>
          <td colspan="2" align="right" scope="col"><div align="left">
            <input style="text-align:center" name="tNPC" type="text" id="tNPC" size="7" />
          </div></td>
          </tr>
        <tr bgcolor="#EDEDED">
          <td width="57%" scope="col">&nbsp;&nbsp;&nbsp;&nbsp;Other Parenteral
              :
            <input name="pn3" type="text" id="pn3" size="40" /></td>
          <td align="right" scope="col">Volume=</td>
          <td align="right" scope="col"><div align="left">
            <input style="text-align:center" name="vol" type="text" id="vol" size="7" />
            <font size="-1">(ml/d)</font></div></td>
          <td align="left" scope="col">=
            <input style="text-align:center" name="tvol" type="text" id="tvol" size="7" />
            % <font size="-1">of Target</font></td>
          </tr>
        <tr>
          <td colspan="4" bgcolor="#CCCCCC"><div align="center">สัดส่วน Enteral feeding = 
            <input style="text-align:center" name="en_pn" type="text" id="en_pn" size="7" />
            % ของ  Required Calory ====&gt; 
            <input style="text-align:center" name="en_pn2" type="text" id="en_pn2" size="35" />
            <p><font  id='sum'></font></p>
          </div></td>
        </tr>
        </table>
   </td>
  </tr>
  <tr>
    <td colspan="5"><p align="center"><font id="show12" color="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>แพทย์ : <font id="show11" color="">
        <input name="doctor" type='text' id='doctor' style="text-align:center; background-color: #FFC; border-top:#933" value="<?php echo $row['doctor']; ?>"  size="25" readonly="readonly" />
      </font> </p></td>
  </tr>
  <tr>
    <td bgcolor="#C8F1A0" colspan="5"><div align="center">
      <input name="Save and Print" type="submit" onClick="window.print()" id="Save and Print" value="Save" />
     
    </div></td>
  </tr>
  <tr>
    <td colspan="5"><div align="center"><a href="/hospital/screening.php">Back to home</a></div></td>
  </tr>
  <tr>
    <td colspan="5"><div align="center">
      <input style="visibility:hidden" name="cal3" type="text" id="cal3" value="0" size="5" />
      <input style="visibility:hidden" name="prot3" type="text" id="prot3" value="0" size="5" />
      <input  style="visibility:hidden" name="fat3" type="text" id="fat3" value="0" size="5" />
      <input  style="visibility:hidden" name="N3" type="text" id="N3" value="0" size="5" />
      <input  style="visibility:hidden" name="cal1" type="text" id="cal1" value="10" size="5" />
      <input  style="visibility:hidden" name="prot1" type="text" id="prot1" value="0" size="5" />
      <input  style="visibility:hidden" name="fat1" type="text" id="fat1" value="0" size="5" />
      <input  style="visibility:hidden" name="N1" type="text" id="N1" value="0" size="5" />
      <input  style="visibility:hidden" name="cal2" type="text" id="cal2" value="0" size="5" />
      <input  style="visibility:hidden" name="prot2" type="text" id="prot2" value="0" size="5" />
      <input  style="visibility:hidden" name="fat2" type="text" id="fat2" value="0" size="5" />
      <input  style="visibility:hidden" name="N2" type="text" id="N2" value="0" size="5" />
      <input  style="visibility:hidden" name="pname1" type="text" id="pname1" value="0" size="5" />
      <input  style="visibility:hidden" name="pname2" type="text" id="pname2" value="0" size="5" />
      <input  style="visibility:hidden" name="nameE1" type="text" id="nameE1" value="0" size="5" />
    </div></td>
  </tr>
</table>

</form>
</div>

</body>
</html>
<?php
mysql_query("SET NAMES UTF8");
?>
